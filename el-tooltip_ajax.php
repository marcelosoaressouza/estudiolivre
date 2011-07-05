<?php

require_once("lib/ajax/ajaxlib.php");

$ajaxlib->registerFunction('register_tooltip_click');
function register_tooltip_click($tipName) {
	global $tooltiplib;
	
	$tooltiplib->register_user_click($tipName);	
				
	return new xajaxResponse();
}



?>
