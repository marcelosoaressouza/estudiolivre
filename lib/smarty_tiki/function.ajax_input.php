<?php

if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

include_once("function.truncate.php");

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     ajax_input
 * Purpose:  TODO
 * -------------------------------------------------------------
 * {ajax_input class="gUpTitle" id="titulo" value=$arquivo.titulo default="Titulo"}
 */
function smarty_function_ajax_input($params, &$smarty) {
	$id = $params['id'];
	$class = $params['class'];
	$value = $params['value'];
	$default = $params['default'];
	$display = $params['display'];
	$mode = $params['mode'];
	$noclear = $params['noclear'];
	$truncate = (int)$params['truncate'];
	$permission = $params['permission'];
	
	$callSave = isset($params['file']) ? "saveField(this, " . $params['file'] . ")" : "saveField(this)";

	$trucated = truncate($value, $truncate);

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
		$output .= ($trucated ? $trucated : $default);
		$output .= "</div>";
		return $output;	
	} else {
		$class .= " editable";
	}
	
	$output = '';
	$output .= '<div id="show-'. $id .'" class="'.$class.'" style="display:' . ($edit ? 'none' : $display ) . '" onClick="editaCampo(' . "'" . $id . "'" . ');">';
	$output .= ($edit ? $default : $trucated);
	$output .= "</div>";
	// TODO: escape value
	$output .= '<input class="'.$class.'" id="input-'.$id.'" value="'. ($value ? $value : $default) .'" ';
	if (!$value && !$noclear) { 
	    $output .= " onFocus=\"limpaCampo('$id');\"";
	}
	$output .= " onChange=\"mudado['$id']=1; editing['$id'] = false;\" onBlur=\"$callSave\" style=\"display:" . ($edit ? $display : 'none') . "\">";
	
	$output .= "<img id=\"error-$id\" class=\"gUpErrorImg\" style=\"display: none\" src=\"styles/estudiolivre/errorImg.png\" onMouseover=\"tooltip(errorMsg_$id);\" onMouseout=\"nd();\"> ";
	
	$output .= '<script language="JavaScript">';
	$output .= '  display["'.$id.'"] = "'.$display.'";errorMsg_'.$id.' = "";';
	if ($truncate) {
    	$output .= '  truncations["'.$id.'"] = "'.$truncate.'";';
	}
    $output .= '</script>';
		
	return $output;
}

?>

