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
 * Name:     show_extension
 * Purpose:  takes mime type and makes it human readable. 
 * -------------------------------------------------------------
 */
function smarty_modifier_show_extension($mimeType) {

	preg_match("/.+\/(.+)/", $mimeType, $arqFormato);

	return $arqFormato[1];

}

?>
