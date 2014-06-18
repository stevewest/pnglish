<?php
/**
 * This work is licenced under the Creative Commons
 * Attribution-Non-Commercial-Share Alike 2.0 UK: England & Wales License. To
 * view a copy of this licence, visit
 * http://creativecommons.org/licenses/by-nc-sa/2.0/uk/ or send a letter to
 * Creative Commons, 171 Second Street, Suite 300, San Francisco,
 * California 94105, USA.
 *
 * @@copyright Steve "Uru" West 2010
 * @author Steve "Uru" West
 * @version 2010-01-07
 */
 
if( $_GET[f] != "source" ){
    header('Content-type: 	text/plain');
    $fpath = explode( "/", $_GET[f] );
    header('Content-Disposition: attachment; filename="'.$fpath[count($fpath)-1].'"');
    readfile( $_GET[f] );
    
} else {
    //Package the source
    require( "zip.php" );

    $createZip = new createDirZip;
    $createZip->add_dir('./');
    $createZip->get_files_from_folder('./', 'PNGlish/');
    
    header("Content-type: application/octet-stream");
    header("Content-disposition: attachment; filename=zipfile.zip");
    echo $createZip->file();

}
?>
