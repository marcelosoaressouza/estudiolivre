<?php
// migrado pra 2.0!
require_once("tiki-setup.php");
require_once("lib/persistentObj/PersistentObjectFactory.php");

include_once("el-gallery_set_publication.php");

if ($arquivoId && $userHasPermOnFile){
	if(isset($_REQUEST['dontAskAgain']) && $_REQUEST['dontAskAgain'] == '1')
		$userlib->set_user_preference($user, "el_dont_check_delete", true);
	$arquivo->delete();
	if(preg_match("/el-gallery_view.php\?arquivoId=(\d+)/", $_SERVER['HTTP_REFERER'], $match) && $match[1] == $arquivoId)
		header("location: el-gallery_home.php");
	else
		header("location: " . $_SERVER['HTTP_REFERER']);
}

?>