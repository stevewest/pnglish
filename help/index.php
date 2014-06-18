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

 //Open up the languages folder
$dir=dir('../languages/');
while($filename=$dir->read()) {

    if ( $filename != '.' && $filename != '..' && $filename != 'index.php' && $filename != '.htaccess' ) {
        if (is_dir('../languages/'.$filename)) {
            //Load the info for each language
            require('../languages/'.$filename.'/info.php');
        }
    }
}
$dir->close();

$lang = ($_GET['lang'])?$_GET['lang']:"php";

require( "../languages/".$lang."/help.php" );

$art_nfo = $info[$_GET['id']];
$_SESSION['id'] = $_GET['id'];

if ($_GET['size'] == 'frame') {
    $width = '400';
    $height ='600';
}
else {
    $width = '600';
    $height ='600';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
    <head>
        <title>PNGlish - Php eNtraGrated english, Manual</title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="../css.css" />
    </head>
    <body class="tight">
        <table border="0" width="<?php echo $width; ?>" height="<?php echo $height; ?>" cellspacing="0" cellpadding="5">
            <tr>
                <th colspan="2" align="center" height="50"><?php echo $art_nfo[0]; ?></th>
            </tr>
            <tr>
                <td class="links" valign="top" width="90"><?php
                    foreach($info as $key => $i) {
                        echo '<span class="red">&rsaquo;</span><a href="?id='.$key.'&amp;size='.$_GET['size'].'&amp;lang='.$lang.'">'.$i[0].'</a><br />';
                    }
                    ?></td>
                <td valign="top">
                    <table border="0" width="100%" height="100%">
                        <tr>
                            <td valign="top" height="10"><?php echo $art_nfo[1]; ?></td>
                        </tr>
                        <?php
                        if($art_nfo[2]) {
                            ?>
                            <tr>
                                <td valign="bottom" class="ex_title">Example:</td>
                            </tr>
                            <tr>
                                <td valign="bottom" class="ex"><?php echo $art_nfo[2]; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <tr>
                            <td valign="bottom" class="small">
                                <?php
                                foreach( $codes as $c ){
                                    if( $c[2] ){
                                        echo "<a href=\"?size={$_GET[size]}&amp;lang={$c[1]}\">{$c[0]}</a> ";
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>