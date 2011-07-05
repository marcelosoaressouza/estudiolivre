<?php

if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     block
 * Name:     tooltip
 * Purpose:  Show tooltip when user passes mouse over an element, 
 * depending on user preferences  
  
 * -------------------------------------------------------------
 */
function smarty_block_tooltip($params, $text) {
 	$tip = tra($params['text']);
 	$tipName = $params['name'];
 	
 	global $tooltiplib, $feature_tooltip, $feature_tooltip_max_clicks;
 	
	if (!$tipName) {
	    $tipName = md5($tip);
	}

 	$clicks = $tooltiplib->get_user_clicks($tipName);
 	
 	if ($feature_tooltip == 'y' && ($clicks <= $feature_tooltip_max_clicks || !$feature_tooltip_max_clicks)) {
 		$text = "<span onMouseover=\"tooltip('".tra($tip)."');\" onMouseout=\"nd();\" onMousedown=\"xajax_register_tooltip_click('$tipName');\">".$text."</span>";
 	}
 	return $text;
}

?>
