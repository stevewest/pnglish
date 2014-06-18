<?php session_start();
/**
 * This work is licenced under the Creative Commons
 * Attribution-Non-Commercial-Share Alike 2.0 UK: England & Wales License. To
 * view a copy of this licence, visit
 * http://creativecommons.org/licenses/by-nc-sa/2.0/uk/ or send a letter to
 * Creative Commons, 171 Second Street, Suite 300, San Francisco,
 * California 94105, USA.
 *
 * @copyright Steve "Uru" West 2010
 * @author Steve "Uru" West
 * @version 2010-01-07
 */

//Include the encryption information
require('encoding.php');

$errors = array();

$indent = 0;
/**
 * Indents the given line by X ammount if $newline is true
 * @param <String> $str The string to indent
 * @param <int> $indent the ammount to indent by
 * @param <boolean> $newline if this is a new line
 * @return <type> The indented string
 */
function indent($str,$indent,$newline) {
    $i=0;
    if ( $indent > 0 && $newline ) {
        while($i!=$indent) {
            $indent_enter .= '	';
            $i++;
        }
    }
    return $indent_enter.$str;
}

/**
 * Removes the last char from a string
 * @param <String> $var
 * @return <String> $var with the last char removed
 */
function removeLast( $var ){
    return substr( $var,0,-1);
}

/**
 * Creates a file
 * @param <String> $file_n file name
 * @param <String> $content file content
 * @param <String> $mode file write mode (see fopen in the php manual)
 */
function makeFile($file_n,$content,$mode='w+') {
    $file = fopen($file_n,$mode);
    fwrite($file, $content);
    fclose($file);
    return true;
}

/**
 * Converts the given string into the "encoded binary" format
 * @global <array> $chars the assocative array containing the translations
 * @global <String> $language the language code of the file
 * @param <String> $text the text to covert
 * @return <String> The converted text
 */
function binaryify($text) {
    global $chars, $language;
    //Add the language definition
    $add_lang = str_pad($language, 5, ' ', STR_PAD_RIGHT);
    //Add the rest of the header
    $text = $add_lang.'PNGlish encoded .wolf'.$text;
    //Create a new var to hold the output
    $out = '';
    //Split into each char
    $nfo = str_split($text);
    //Loop through and convert each char
    foreach($nfo as $t) {
        $out .= $chars[$t];
    }
    return $out;
}

/**
 * Does the same as binaryify but in reverse
 * @global <type> $chars
 * @param <type> $text
 * @return <type> 
 */
function debinaryify($text) {
    global $chars;
    $nchars = array_flip($chars);
    $out = '';
    $nfo = str_split($text,8);

    foreach($nfo as $t) {
        $out .= $nchars[$t];
    }
    return $out;
}

//Work out what language has been selected
$language = (array_key_exists('lang', $_POST))?$_POST['lang']:'php';

//Define the varous temp dirs
$raw_dir = 'temp/raw/';
$compile_dir = 'temp/com/';

//Loop through and remove any old temp files, this stops them building up on the server
$dir=dir($raw_dir);
while($filename=$dir->read()) {
    //If it's not a special case
    if ( $filename != '.' && $filename != '..' && $filename != 'index.php' && $filename != '.htaccess' ) {
        //Work out the filetime
        $f = explode("_",$filename);
        if ( $f[0] <= (time()-300) ) {
            //If it's old remove it
            unlink($raw_dir.$filename);
        }
    }
}
//Close the dir
$dir->close();
//Do the same as above but for the compile_dir ( this should be a function really)
$dir=dir($compile_dir);
while($filename=$dir->read()) {
    if ( $filename != '.' && $filename != '..' && $filename != 'index.php' && $filename != '.htaccess' ) {
        $f = explode("_",$filename);
        if ( $f[0] <= (time()-300) ) {
            unlink($compile_dir.$filename);
        }
    }
}
$dir->close();

//Get any input
$lines = array();
$input = '';
if (array_key_exists('input', $_POST))
{
	$input = $_POST['input'];
	//Convert it to an array of lines
	$lines = explode("\n",$_POST['input']);
}

//Check to see if we are opening a file
if ( array_key_exists('action', $_POST) && $_POST['action'] == 'Open') {
    //Clear out the lines
    $lines = '';
    //Grab the uploaded file
    $content = file($_FILES['file']['tmp_name']);
    //Get the number of lines
    $numLines = count($content);
    $len = 0;
    //Loop through, recording the new lines and keeping count
    for ($i = 0; $i < $numLines; $i++) {
        $len += strlen($content[$i]);
        //Make sure it's converted back
        $lines .= debinaryify($content[$i]);
    }

    $skip = false; //True if the rest of the file loading needs to be skipped

    //Split it all into groups of 5
    $enc = str_split($lines,5);
    //Get the first 5 for the language
    $language = trim($enc[0]);
    //Remove the language
    array_shift($enc);

    //Convert it back to an array
    $lines = implode($enc);

    //Split into groups of 21 chars
    $q_test = str_split($lines,21);
    //Check if the header is correct
    if ( $q_test[0] != 'PNGlish encoded .wolf') {
        //If not report the error and whipe the lines
        $erorrs[] .= 'Invalid File! Header not found.';
        $lines = '';
        $skip = true;
    }

    //Check if there is the correct number of chars
    if ( $len % 8 != 0 ) {
        //If not stop
        $errors[] .= 'Invalid File! Binary miscount.';
        $lines = '';
        $skip = true;
    }

    if( !$skip ){
        //Remove the header
        $lines = substr($lines, 21);
        //Assign the read lines to the input
        $input = $lines;
        //Convert lines back to an array
        $lines = explode("\n",$lines);
        
    } else {
        $lines = array();
        $language = ($_POST['lang'])?$_POST['lang']:'php';;
    }
}

//Open up the languages folder
$dir=dir('languages/');
while($filename=$dir->read()) {
    
    if ( $filename != '.' && $filename != '..' && $filename != 'index.php' && $filename != '.htaccess' ) {
        if (is_dir('languages/'.$filename)) {
            //Load the info for each language
            require('languages/'.$filename.'/info.php');
        }
    }
}
$dir->close();

//Loop through each found language
$lang_sel = '';
foreach ($codes as $c) {
    //If it's assigned to be included
    if($c[2]) {
        //Check to see if it's selected
        $picked = ($c[1] == $language)?' checked="checked"':'';
        //Build the select radio button
        $lang_sel .= '<label>'.$c[0].': <input type="radio" name="lang" value="'.$c[1].'"'.$picked.' /></label>';
    }
}

$onLoad = '';

//If the source download button has been pressed
if ( array_key_exists('action', $_POST) && $_POST['action'] == 'Download Source' ) {
    //Encrypt the content
    $content = binaryify($_POST['input']);
    //Work out a temp file name
    $filename = $raw_dir.time().'_'.rand(10,99).'.wolf';
    //Make the file
    makeFile($filename,$content);
    //Offer it for download
    $onLoad = 'downloadFile(\''.$filename.'\');';

//If the user wants to download the compiled version
} else if ( array_key_exists('action', $_POST) && $_POST['action'] == 'Download Compiled') {
    //Create the temp file name
    $filename = $compile_dir.time().'_'.rand(10,99).'.'.$language.'.wolf';
    //Make the file
    makeFile($filename,$output);
    //Offer it for download
    $onLoad = 'downloadFile(\''.$filename.'\');';
}

//run the parser for the selected language
require('languages/'.$language.'/data.php');

//If there is no input, clear the output
if ( array_key_exists('input', $_POST) && $_POST['input'] == '' ) {
    $output = '';
}

//If there are any assigned errors, show them
if( count($errors) > 0){
    $output = "";

    foreach( $errors as $e ){
        $output .= $e."\n";
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <title>PNGlish - Php eNtraGrated English, compiler</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="css.css" />
        <script type="text/javascript" src="script.js"></script>
    </head>

    <body onLoad="<?php echo $onLoad; ?>" class="tight">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="main" enctype="multipart/form-data" method="post">
            <table border="0" width="100%" height="100%">
                <tr>
                    <td colspan="3" align="left"><input type="submit" name="submit" value="Run" title="Compile the PNGlish code." /><input type="reset" value="Revert" title="Change the code back to the last compiled script." /> Please note that this has been designed to be viewed on a 1280 x 1024 resolution.</td>
                </tr>

                <tr>
                    <td colspan="2" align="left">Language: <?php echo $lang_sel; ?></td>
                    <td rowspan="3" valign="top">
                        <table border="0" width="100%" height="100%">
                            <tr>
                                <td valign="top" height="100">
                                    PNGlish:<br />
                                    <input type="submit" name="action" value="Download Source" title="Download the current PNGlish code" /><br />
                                    Open:<br />
                                    <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                                    <input type="file" name="file" /><br /><input type="submit" name="action" value="Open" />
                                    <br /><br />
                                    Compiled:<br />
                                    <input type="submit" name="action" value="Download Compiled" title="Download the compiled PNGlish code" /><br /><br />
                                    General:<br />
                                    <input type="button" onClick="resetText()" value="Clear" title="Clear the current PNGlish code" />
                                    <br />&nbsp;
                                </td>
                            </tr>
                            <tr valign="top">
                                <td>
                                    <div class="scroll">
                                        <?php require('languages/'.$language.'/buttons.php'); ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <textarea cols="63" rows="40" name="input" id="input" wrap="off"><?php echo stripslashes($input); ?></textarea>
                    </td>
                    <td align="right">
                        <textarea cols="63" rows="40" name="output" id="output" wrap="off"><?php echo  stripslashes($output); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <ul>
							<li>Hid away the warnings</li>
                            <li>Added RETURN and made the help extensible</li>
                            <li>Added BLOCKs</li>
                            <li>Added GUI + loads of behind the scenes stuff</li>
                            <li>Added comments</li>
                            <li>Added basic numeric operations</li>
                            <li>Added the documentation scripts, content is on its way</li>
                            <li>Added boolean support</li>
                        </ul>
                    </td>
                    <td align="right" valign="bottom">
                        <table border="0" width="100%" height="100%">
                            <tr>
                                <td align="right" valign="top"><a href="javascript:newWindow('./help?id=intro&lang=<?php echo $language; ?>')">Click here to open the help in a new window.</a></td>
                            </tr>
                            <tr>
                                <td align="right" valign="bottom" class="small">
                                    PNGlish is &copy; 2010 Steve "Uru" West<br />
                                    <a href="http://github.com/stevewest/pnglish">Source here</a>
                                    <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.0/uk/">
                                        <img alt="Creative Commons License" title="Creative Commons License" src="http://i.creativecommons.org/l/by-nc-sa/2.0/uk/88x31.png" />
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
        <script type="text/javascript">
            createTextAreaWithLines('input');
            createTextAreaWithLines('output');
        </script>
    </body>
</html>
