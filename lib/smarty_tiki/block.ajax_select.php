<?php

if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

include_once("function.truncate.php");

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     block
 * Name:     ajax_select
 * Purpose:  SELECT block
 * -------------------------------------------------------------
 */
function smarty_block_ajax_select($params, $text) {
	$id = $params['id'];
	$class = $params['class'];
	$value = $params['value'];
	$default = $params['default'];
	$display = $params['display'];
	$mode = $params['mode'];
	$noclear = $params['noclear'];
	$permission = $params['permission'];

	if ($mode == 'edit') {
	    $edit = 1;
	} elseif ($mode == 'show') {
	    $edit = 0;
	} else {
	    $edit = $value ? 0 : 1;
	}
	
	if (!$display) $display = 'block';
	
	if (!$permission) {
		$output .= '<div id="show-'. $id .'" class="'.$class.'" style="display:' . $display .'">';
		$output .= ($value ? $value : $default);
		$output .= "</div>";
		return $output;	
	} else {
		$class .= " editable";
	}
	
	$output = '';
	$output .= '<div id="show-'. $id .'" class="'.$class.'" style="display:' . ($edit ? 'none' : $display ) . '" onClick="editaCampo(' . "'" . $id . "'" . ');">';
	$output .= ($edit ? $default : $value);
	$output .= "</div>";
	// TODO: escape value
	$output .= '<select class="'.$class.'" id="input-'.$id.'" value="'. ($value ? $value : $default) .'"';
	
	$output .= " onChange=\"mudado['$id']=1;  editing['$id'] = false; saveField(this)\" style=\"display:" . ($edit ? $display : 'none') . "\">";
	$output .= $text;
	$output .= "</select>";
	
	$output .= "<img id=\"error-$id\" class=\"gUpErrorImg\" style=\"display: none\" src=\"styles/mapsys/errorImg.png\" onMouseover=\"tooltip(errorMsg_$id);\" onMouseout=\"nd();\"> ";
	
	$output .= '<script language="JavaScript">';
	$output .= '  display["'.$id.'"] = "'.$display.'";errorMsg_'.$id.' = "";';
	
	$output .= '</script>';
	
	return $output;
}

?>

