<?php

function smarty_block_xEditBlock($params, $text) {

    $name = $params['name'];

    if (isset($params['itemType'])) {
	$itemType = $params['itemType'];
    } else {
	$itemType = $_REQUEST['tipo'];
    }
    
    if (isset($params['itemId'])) {
	$itemId = $params['itemId'];
    } else {
	$itemId = $_REQUEST['id'];
    }

    $itemId = (int)$itemId;

    global $smarty;

    $smarty->assign('itemType',$itemType);
    $smarty->assign('itemId',$itemId);
    $smarty->assign('blockName',$name);
    $smarty->assign('blockText', $text);

    return $smarty->fetch("fields/xEditBlock.tpl");

}

?>