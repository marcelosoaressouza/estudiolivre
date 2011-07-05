<?php

if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     css
 * Purpose:  insert the css for the tpl which called it, preserving theme scope.
 * you may want to include another css, but not the one relative to the current
 * tpl, for this use 'only'
 * WARNING: always put the {css} function at the start of the tpl
 * -------------------------------------------------------------
 * {css extra=css1,css2} or {css} or {css only=general}
 */
 
function smarty_function_css($params, &$smarty) {
	global $currentTpl;

	if ($params['extra']) {
		$extras = $params['extra'];
		$extras = split(",",$extras);
	}
	
	if (!$params['only']) {
		$currentTplStrip = preg_replace("/(.*\/)?(.*)\.tpl/","$2",$currentTpl);
		$output .= cssLinkRel($currentTplStrip);
	} else {
		$extras = $params['only'];
		$extras = split(",",$extras);
	}
	
	if ($extras) {
		foreach ($extras as $item) {
			$output .= cssLinkRel($item);
		}
	}
	
	return $output;
}

function cssLinkRel ($css) {
	global $style;
	$currentStyle=preg_replace("/\.css/","",$style);
	$path = "styles/$currentStyle/css/$css.css";
	
	// verify that the css file exists. this allows the use off {css} on the default template 
	// without forcing the theme to include a corresponding css file  
	if (file_exists($path)) {
		return "<link rel=\"StyleSheet\"  href=\"$path\" type=\"text/css\" />\n";
	} else {
		return '';
	}
}

?>
