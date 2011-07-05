<?php

require_once('tiki-setup.php');
require_once('lib/elgal/elIce/IceStats.php');
require_once("el-gallery_stream_ajax.php");

$ajaxlib->processRequests();

$smarty->assign('category', 'gallery');

$iceStats = new IceStats();
$sources = $iceStats->iceinfo('estudiolivre.org', '8000', 'admin', 'xupa2006-admin');

$smarty->assign('sources', $sources); 
$smarty->assign('mid', 'el-liveInfo.tpl');
$smarty->display('tiki.tpl');

?>