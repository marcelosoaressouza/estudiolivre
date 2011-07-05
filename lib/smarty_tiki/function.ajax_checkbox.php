<?php

if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     ajax_checkbox
 * Purpose:  TODO
 * -------------------------------------------------------------
 * {ajax_checkbox class="gUpTitle" id="titulo" value=$arquivo.titulo default="Titulo"}
 * ATENCAO: o valor default do banco de dados deve ser o mesmo passado aqui.
 */
function smarty_function_ajax_checkbox($params, &$smarty) {
	$id = $params['id'];
	$class = $params['class'];
	$value = $params['value'] ? 1 : 0;
	$permission = $params['permission'];
	
	$callSave = isset($params['file']) ? "saveField(this, " . $params['file'] . ")" : "saveField(this)";
	
	if (!$permission) {
		$output .= $value;
		
		return $output;	
	}	
	
	$checked = $value ? "checked" : ""; 
	 
	return '<input type="checkbox" class="'.$class.'" id="input-'.$id.'" onClick="' . $callSave . '" '.$checked.'>';
}

?>

