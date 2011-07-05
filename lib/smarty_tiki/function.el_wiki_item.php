<?php

if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     el_wiki_item
 * Purpose:  TODO
 * -------------------------------------------------------------
 * {el_wiki_item id=$arquivoId}
 */
function smarty_function_el_wiki_item($params, &$smarty) {
	$id = $params['id'];

	if (!$id) return '';

	global $smarty, $tikilib;
	
	$info = $tikilib->get_page_info($id);
	//gambi pra usar o mesmo template da busca
	$result['hits'] = $info['hits'];
	$result['pageName'] = $info['pageName'];
	$result['data'] = substr(strip_tags($info['data']), 0, 250);
	$result['lastModif'] = $info['lastModif'];
	$result['href'] = "tiki-index.php?page=".$info['pageName'];
	$smarty->assign('feature_search_fulltext', "n");
	$smarty->assign_by_ref('result', $result);
	return $smarty->fetch('searchresult-item.tpl');
}

?>

