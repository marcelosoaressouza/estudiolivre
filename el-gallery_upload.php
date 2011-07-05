<?php
// migrado pra 2.0!!
if (!isset($_POST['xajax']) || $_POST['xajax'] != 'upload_info') {
	require_once("tiki-setup.php");
	require_once("lib/persistentObj/PersistentObjectController.php");
	require_once("lib/freetag/freetaglib.php");
	include_once("el-gallery_set_publication.php");
	require_once("el-license_ajax.php");
	require_once("el-tags_ajax.php");
}  else {
        session_start();
        $feature_ajax = "y";
        require_once("lib/ajax/ajaxlib.php");
}

require_once("el-gallery_upload_ajax.php");
$ajaxlib->processRequests();

// Now check permissions to access this page
if (!$user) {
  $smarty->assign('msg', tra("You are not logged in"));
  $smarty->display("error.tpl");
  die;
}

if ($el_p_upload_files != 'y') {
    $smarty->assign('msg', tra("Permission denied you cannot upload files"));
    $smarty->display("error.tpl");
    die;
}

$smarty->assign('headtitle', "subir arquivo");

$smarty->assign('category', 'gallery');

$smarty->assign('tag_suggestion', $freetaglib->get_distinct_tag_suggestion('', 0, 10));
$smarty->assign('moreTagsOffset', 10);

//isto eh uma conveniencia, so pra bloquear a mudanca de campo no cliente
//nao garante seguranca
$smarty->assign('permission', $el_p_upload_files == 'y');

// licenca padrao
if ($licencaId = $tikilib->get_user_preference($user, 'licencaPadrao')) {
	$lController = new PersistentObjectController("License");
	$licenca = $lController->noStructureFindAll(array("id" => $licencaId));
	$smarty->assign('licenca', $licenca[0]);
}

$controller = new PersistentObjectController("Publication");
$pending = $controller->findAll(array('user' => $user, 'publishDate' => false));
$smarty->assign('pending', $pending);

if(isset($arquivo) && $arquivo->user == $user) {
	$tagString = '';
	foreach ($arquivo->tags as $t) {
		$tagString .= $t['tag'] . ", ";
	}
	$tagString = substr($tagString, 0, strlen($tagString)-2);
	$arquivo->tagString = $tagString;
	$smarty->assign_by_ref("arquivo", $arquivo);
	if (isset($arquivo->license)) {
		$license = array();
		$license["imageName"] = $arquivo->license->imageName;
		$smarty->assign("licenca", $license);
	} else {
		$smarty->assign("licenca", '');
	}
}

$smarty->assign('uploadId',rand() . '.' . time());

$smarty->assign('mid','el-gallery_upload.tpl');
$smarty->display('tiki.tpl');

?>
