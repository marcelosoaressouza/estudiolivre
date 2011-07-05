<?php

if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     elcrumbs
 * Purpose:  TODO
 * -------------------------------------------------------------
 * {elcrumbs crumbs=$crumbs}
 */
function smarty_function_elcrumbs($params, &$smarty) {
	$crumbs = $params['crumbs'];
	
	$output = '<div class="elcrumbs">';
	
	foreach ($crumbs as $crumb) {
		
		$output .= '<a href="' . $crumb['url'] . '">' . $crumb['title'] . '</a>';
		$output .= ' <br> ';
	}
	
	//$output = preg_replace("/> $/", '', $output);
	
	$output .= "</div>"; 
	
	return $output;
}
?>
