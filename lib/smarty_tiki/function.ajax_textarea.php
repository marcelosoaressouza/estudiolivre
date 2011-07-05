<?php

if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     ajax_textarea
 * Purpose:  TODO
 * -------------------------------------------------------------
 * {ajax_input class="gUpTitle" id="titulo" value=$arquivo.titulo default="Titulo"}
 */
function smarty_function_ajax_textarea($params, &$smarty) {
	$id = $params['id'];
	$class = $params['class'];
	$value = $params['value'];
	$default = $params['default'];
	$display = $params['display'];
	$mode = $params['mode'];
	$noclear = $params['noclear'];
	$style = $params['style'];
	$permission = $params['permission'];
	$wikiParsed = $params['wikiParsed'];

	$callSave = $params['file'] ? "saveField(this, " . $params['file'] . ")" : "saveField(this)";
	
	global $tikilib;

	$show_value = $wikiParsed ? $tikilib->parse_data($value) : $value;

	if ($mode == 'edit') {
	    $edit = 1;
	} elseif ($mode == 'show') {
	    $edit = 0;
	} else {
	    $edit = $value ? 0 : 1;
	}

	if (!$display) $display = 'block';
	
	if (!$permission) {
		$output .= '<div id="show-'. $id .'" class="'.$class.'" style="display:' . $display . '">';
		$output .= ($value ? $show_value : $default);
		$output .= "</div>";
		
		return $output;	
	} else {
		$class .= " editable";
	}
	
	$output = '';
	$output .= '<div id="show-'. $id .'" class="'.$class.'" style="display:' . ($edit ? 'none' : $display ) . '" onClick="editaCampo(' . "'" . $id . "'" . ');">';
	$output .= ($value ? $show_value : $default);
	$output .= "</div>";
	
	$output .= "<img id=\"error-$id\" class=\"gUpErrorImg\" style=\"display: none\" src=\"styles/estudiolivre/errorImg.png\" onMouseover=\"tooltip(errorMsg_$id);\" onMouseout=\"nd();\"> ";
	
	$output .= '<textarea id="input-'.$id. '"  onBlur="' . $callSave . '" style="display:' . ($edit ? $display : "none") . '; ' . $style . '" '; 
	if (!$value && !$noclear) { 
	    $output .= " onFocus=\"limpaCampo('$id');\"";
	}
	$output .= " onChange=\"mudado['$id']=1; editing['$id'] = false;\">" . ($value ? htmlspecialchars($value) : $default) .'</textarea>';
	
	$output .= '<script language="JavaScript">display["'.$id.'"] = "'.$display.'";errorMsg_'.$id.' = "";</script>';
	
	return $output;	 	
}

?>
