<?php
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
 * @version 2010-01-08

This file is responsible for how the PNGlish code is actually processed.
The basic idea is that $input will contain what ever the user entered,
and $output will contain the result.

My method is to loop through each line, then for each line loop through each word
and process accordingly. The method that you use is totally up you to you. The
only restraints are the ones that the PHP language impose.

Ignore this q.q p.p
$file = $_SERVER["SCRIPT_NAME"];
$break = Explode('/', $file);
$pfile = $break[count($break) - 1]; 
 
 */
$string_open = false;
$varmode = false;
$if_condition = false;
$comment_open = false;
$blockmode = false;
$blockparammode = false;
$callmode = false;
$blocknames = array();
$indent = 0;
$breakProcessing = false;

$output = "<?php\n";

$linecount = 1;
$wordcount = 1;

foreach ( $lines as $l ) {
    $newline = true;
    $change_newline = true;
    $l = trim($l);
    $line_nfo = explode(" ", $l);

    foreach ( $line_nfo as $li) {
        if( $breakProcessing ){
            break;
        }

        if( $blockparammode == true ){
            $pref = ",";
        } else {
            $pref = "";
        }

        if( $blockmode ) {
            if( $callmode ){
                //If it's not a known function give an error
                if( !in_array( $li, $blocknames) ){
                    $output = "Error on line:$linecount.$wordcount Unknown block name: ".$li;
                    $breakProcessing = true;
                    break;
                }
            }

            $blocknames[] = $li;
            $output .= indent($li."(",$indent,true);
            $blockmode = false;
        }
        if ( $li == 'TAKES' ){
            $blockparammode = true;
        }

        if ($string_open == false && $varmode == false) {
            $li = strtoupper($li);
        }
        //Check for a number
        if (is_numeric($li)) {
            $output .= $li.$pref;
        }
        //Check for single line comment
        elseif ($li == 'COMMENT') {
            $output .= indent('/*',$indent,$newline);
            $string_open = true;
            $comment_open = true;
        }
        //Check for a new string
        elseif ($li == ">>" && $string_open == false) {
            $string_open = true;
            $output .= '"';
        }
        elseif ($string_open == true) {
        //check for the end of a comment
            if($li == 'ENDCOMMENT') {
                $output = trim($output);
                $output .= '*/';
                $string_open = false;
                $comment_open = false;
            }
            //Check for the end of a string
            elseif ($li == "<<" && $comment_open == false) {
                $string_open = false;
                $varmode = false;
                $output = trim($output);
                $output .= '"'.$pref;
            }
            //Check if the $li is part of a string
            else
                $output .= $li.' ';
        }
        elseif ($varmode == true) {
            $varmode = false;
            
            $output .= indent('$'.$li.$pref,$indent,$newline);
        }
        //Check for the end of a line
        elseif ($li == 'NEWLINE' ) {
            if( $blockparammode ){
                $output = removeLast( $output );
            }
            if($if_condition == true) {
                $if_condition = false;

                $blockparammode = false;
                $output .= ")\n".indent("{",$indent,true);
                $indent++;
            }
            elseif( $callmode ){
                $output .= indent(");",$indent,$newline);
                $callmode = false;
            }
            else{
                $output .= ';';
            }
        }
        
        
        
        //Check for an echo statement
        elseif ($li == 'SAY')
            $output .= indent('echo ',$indent,$newline);
        //Check for a a join
        elseif ($li == 'JOIN')
            $output .= '.';
        //Check for a variable
        elseif ($li == 'VAR') {
            $varmode = true;
            $change_newline = false;
        }
        //Check for add
        elseif ($li == 'ADD')
            $output .= '+';
        //Check for subtract
        elseif ($li == 'SUB')
            $output .= '-';
        //Check for mutiply
        elseif ($li == 'MUL')
            $output .= '*';
        //Check for devide
        elseif ($li == 'DEV')
            $output .= '/';
        //Check for ++
        elseif ($li == 'INCREMENT')
            $output .= '++';
        elseif ($li == 'DECREMENT')
            $output .= '--';
        //Check for an is
        elseif ($li == 'IS'){
            if( $blockparammode ){
                $output = removeLast( $output );
            }
            $output .= ' = ';
        }
        //Check for true
        elseif ($li == 'TRUE')
            $output .= 'true';
        //check for false
        elseif ($li == 'FALSE')
            $output .= 'false';
        //Check for an if
        elseif ($li == 'IF') {
            $output .= indent('if(',$indent,$newline);
            $if_condition = true;
        }
        elseif ($li == 'WHILE') {
            $output .= indent('while(',$indent,$newline);
            $if_condition = true;
        }
        elseif ($if_condition == true) {
            if($li == 'AND')
                $output .= ' && ';
            elseif($li == 'OR')
                $output .= ' || ';
            elseif($li == 'SAMEAS')
                $output .= ' == ';
            elseif($li == 'NOTSAMEAS')
                $output .= ' != ';
            elseif($li == 'BIGGERTHAN')
                $output .= ' > ';
            elseif($li == 'SMALLERTHAN')
                $output .= ' < ';
        }
        //Check for end if
        elseif ($li == 'ENDIF' || $li == "ENDBLOCK" || $li == 'ENDWHILE' ) {
            $indent--;
            $output .= indent('}',$indent,$newline);
        }
        //Check for else
        elseif ($li == 'ELSE') {
            $indent--;
            $output .= indent("}\n",$indent,$newline);
            $output .= indent("else\n{",$indent,$newline);
            $indent++;
        }
        //Check for else if
        elseif ($li == 'ELSEIF') {
            $indent--;
            $output .= indent("}\n",$indent,$newline);
            $output .= indent("elseif(",$indent,$line);
            $if_condition = true;
        }
        elseif ( $li == 'BLOCK' ) {
            $output .= indent("function ",$indent,$newline);
            $if_condition = true;
            $blockmode = true;
        } else if( $li == "RETURN" ){
            $output .= indent("return ",$indent,$newline);
        }
        if( $li == "CALL" ){
            $callmode = true;
            $blockmode = true;
        }
        if ($change_newline) {
            $newline = false;
        }

        $wordcount++;
    }
    $output .= "\n";

    $wordcount = 1;
    $linecount++;
}
if( substr($output, 0, 5) != "Error" ){
    $output .= '?>';
}
?>
