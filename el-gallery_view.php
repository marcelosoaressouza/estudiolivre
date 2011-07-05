<?php
// migrado pra 2.0!
require_once("tiki-setup.php");
include_once("el-gallery_set_publication.php");
require_once("el-gallery_file_edit_ajax.php");
require_once("el-gallery_view_ajax.php");
require_once("el-gallery_stream_ajax.php");

$ajaxlib->processRequests();

if (!$arquivoId) {
	$smarty->assign('msg',tra('Você não escolheu nenhum arquivo!'));
	$smarty->display('error.tpl');
	exit;
}   

if (!$arquivo || !$arquivo->publishDate) {
	$smarty->assign('msg',tra('Arquivo inexistente!'));
	$smarty->display('error.tpl');
	exit;
}  

$tagString = '';
foreach ($arquivo->tags as $t) {
	$tagString .= $t['tag'] . ", ";
}
$tagString = substr($tagString, 0, strlen($tagString)-2);
$arquivo->tagString = $tagString;

$smarty->assign('headtitle', $arquivo->title);
elAddCrumb($arquivo->title);

$smarty->assign('category', 'gallery');

if (isset($_REQUEST['file'])) $key = (int)$_REQUEST['file'];
elseif (isset($arquivo->mainFile)) $key = $arquivo->mainFile;
if (isset($key)) {
	$smarty->assign('viewFile', $key);
	$arquivo->filereferences[$key]->hitStream();
}
$smarty->assign('arquivoId',$arquivoId);
$smarty->assign_by_ref('arquivo',$arquivo);

$fileThumbs = array();
foreach ($arquivo->filereferences as $key => $file) {
	if ($file->thumbnail) $fileThumbs[$key] = $file->fileName;
}
$smarty->assign('fileThumbs', $fileThumbs);

if ($userHasPermOnFile) {
	$smarty->assign('permission', true);
}

$smarty->assign('dontAskDelete', $tikilib->get_user_preference($user, 'el_dont_check_delete', 0));


$smarty->assign('mid','el-gallery_view.tpl');
$smarty->display('tiki.tpl');

?>
