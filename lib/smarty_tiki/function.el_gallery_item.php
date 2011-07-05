<?php
// migrado pra 2.0!!!
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     el_gallery_item
 * Purpose:  TODO
 * -------------------------------------------------------------
 * {el_gallery_item id=$arquivoId}
 */
function smarty_function_el_gallery_item($params, &$smarty) {
	$id = $params['id'];

	if (!$id) return '';

	global $smarty;
	
	require_once("lib/persistentObj/PersistentObjectFactory.php");
	$arquivo = PersistentObjectFactory::createObject("Publication", (int)$id);
	$smarty->assign_by_ref('arquivo', $arquivo);
	return $smarty->fetch('el-gallery_list_item.tpl');
}

?>

