<?php
// migrado pra 2.0!
function wikiplugin_acervo_help() {
    $help = tra("Mostra lista de arquivos do acervo com determinada tag ou por id") . "<br/>";
    $help.= "~np~{ACERVO(tag=>MinhaTag)}{ACERVO}~/np~" . "<br/>";
    $help.= "~np~{ACERVO(tag=>MinhaTag, sort_mode=>created_desc)}{ACERVO}~/np~" . "<br/>";
    $help.= "~np~{ACERVO(id=>idDoArquivo)}{ACERVO}~/np~" . "<br/>";
    $help.= "~np~O parâmetro sort_mode recebe o nome do campo no banco seguido de asc para ascendente ou desc para descendente.~/np~";
    return $help;
}

function retrieveFileInfo($id) {
	require_once("lib/persistentObj/PersistentObjectFactory.php");
	return PersistentObjectFactory::createObject("Publication", (int)$id);
}

function wikiplugin_acervo($data, $params) {

    global $smarty, $freetaglib, $style; 
    
    require_once("lib/freetag/freetaglib.php");
    
    $styleUrl = "styles/" . preg_replace('/\.css/', '', $style) . "/css/el-gallery_list_item.css";
	if (file_exists($styleUrl)) {
	    $result = "<link rel='StyleSheet'  href='$styleUrl' type='text/css' />";
	} else {
		$result = "";
	}
    
    if(isset($params['id']) && $params['id'] > 0) {
		$smarty->assign_by_ref("arquivo", retrieveFileInfo($params['id']));
		$result .= $smarty->fetch('el-gallery_list_item.tpl');
	    return "~np~$result~/np~";
    }
    if(!isset($params['tag']) && isset($params['tags'])) { $params['tag'] = $params['tags']; }

    if(!isset($params['sort_mode'])) {  
    	$objects = $freetaglib->get_objects_with_tag_combo(split(",",$params['tag']), 'gallery');
    } else {
    	$objects = $freetaglib->get_objects_with_tag_combo(split(",",$params['tag']), 'gallery', '', 0, -1, $params['sort_mode']);
    }
    
    foreach ($objects['data'] as $object) {
		$smarty->assign_by_ref("arquivo", retrieveFileInfo($object['itemId']));
		$result .= $smarty->fetch('el-gallery_list_item.tpl');
    }

    return "~np~$result~/np~";
    
}

?>
