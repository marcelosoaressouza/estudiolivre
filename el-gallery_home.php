<?php
// migrado pra 2.0!
require_once("tiki-setup.php");
require_once("lib/persistentObj/PersistentObjectController.php");
require_once("el-gallery_ajax.php");

$ajaxlib->processRequests();

$smarty->assign('headtitle', "acervo");
elAddCrumb('acervo');

$smarty->assign('category', 'gallery');

$info = $tikilib->get_page_info('destak');
$pdata = $tikilib->parse_data($info["data"],$info["is_html"]);
$smarty->assign_by_ref('destak', $pdata);

if(isset($_COOKIE['sortMode'])) {
	$sortField = $_COOKIE['sortMode'];
} else {
	$sortField = 'publishDate';
}
if(isset($_COOKIE['sortDirection'])) {
	if($_COOKIE['sortDirection'] == '_desc') {
		$smarty->assign('sortDirection', 'Down');
		$sortDirection = '_desc';
	}
	else {
		$smarty->assign('sortDirection', 'Up');
		$sortDirection = '_asc';
	}	
} else {
	$smarty->assign('sortDirection', 'Down');
	$sortDirection = '_desc';	
}
$smarty->assign('sortMode', $sortField);
$sort_mode =  $sortField .  $sortDirection;
$smarty->assign('sort_mode', $sort_mode);

$localTipos = array('Audio', 'Imagem', 'Video', 'Texto', 'Outro');
$tipos = array();
for($i = 0; $i < sizeof($localTipos); $i++) {
	if(isset($_COOKIE[$localTipos[$i]])) {
		if($_COOKIE[$localTipos[$i]] == '1') {
			$tipos[] = $localTipos[$i];
		}
	}
}
if(!sizeof($tipos)) {
	$tipos = $localTipos;
}
$smarty->assign('tipos', $tipos);
$actualClass = array("Video" => "VideoPublication",
					 "Audio" => "AudioPublication",
					 "Imagem" => "ImagePublication",
					 "Texto" => "TextPublication",
					 "Outro" => "OtherPublication");
$filters = array("actualClass" => array());
foreach ($tipos as $tipo) {
	$filters["actualClass"][] = $actualClass[$tipo];
}

if(isset($_REQUEST['highlight'])) {
	$find = $_REQUEST['highlight'];
} else {
	$find = '';
}
if ($find) {
	require_once("lib/elgal/model/Find.php");
	$key = new Find(array("title", "description"));
	$filters[$find] = $key;
}
$filters["publishDate"] = true;
$controller = new PersistentObjectController("Publication");
$files = $controller->findAll($filters, 0, 10, $sort_mode);
$total = $controller->countAll($filters);

$smarty->assign('maxRecords', 10);
$smarty->assign('offset', 0);
$smarty->assign('total', $total);
$smarty->assign('find', $find);
$smarty->assign('page', 1);
$smarty->assign('lastPage', ceil($total/10));
$smarty->assign_by_ref('arquivos',$files);

$smarty->assign('dontAskDelete', $tikilib->get_user_preference($user, 'el_dont_check_delete', 0));

$smarty->assign('mid', 'el-gallery_home.tpl');
$smarty->display('tiki.tpl');

?>
