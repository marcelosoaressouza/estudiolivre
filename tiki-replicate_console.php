<?php
// $Header: /cvsroot/tikiwiki/tiki/tiki-replicate_console.php,v 1.2.2.1 2005/01/05 19:45:28 jburleyebuilt Exp $

require_once ('tiki-setup.php');
include_once 'lib/logs/logslib.php';

if ($tiki_p_admin != 'y') {
	if (!$user) {
		$smarty->assign('msg',$smarty->fetch('modules/mod-login_box.tpl'));
		$smarty->assign('errortitle',tra("Please login"));
	} else {
		$smarty->assign('msg', tra("You do not have permission to use this feature"));
	}
	$smarty->display("error.tpl");
	die;
}

$dumps = array();
$path = "backups";
if ($tikidomain) { $path.= "/$tikidomain"; }
$h = opendir($path);
while ($file = readdir($h)) {
	if (strstr($file, ".sql") and substr($file,0,1) != '.') {
		$dumps[] = $file;
	}
}
$smarty->assign('dumps', $dumps);

ask_ticket('replicate');

$smarty->display('tiki-replicate_console.tpl');
?>
