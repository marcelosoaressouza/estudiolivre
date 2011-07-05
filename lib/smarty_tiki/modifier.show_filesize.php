<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     modifier
 * Name:     show_filesize
 * Purpose:  takes a number of bytes and expresses it in bytes,
             kb, mb or gb accordinly. 
 * -------------------------------------------------------------
 */
function smarty_modifier_show_filesize($size)
{

    if ($size < 1024)
	return "$size bytes";

    $size /= 1024;

    if ($size < 1024)
	return sprintf("%.2f","$size") . " Kb";

    $size /= 1024;

    if ($size < 1024)
	return sprintf("%.2f","$size") . " Mb";

    $size /= 1024;

    return sprintf("%.2f","$size") . " Gb";

}

?>
