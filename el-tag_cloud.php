<?php
require_once("tiki-setup.php");
require_once('lib/tikilib.php');

if (isset($_REQUEST['tagsForUser']) && $_REQUEST['tagsForUser'] != '') {
	$tagsForUser = $_REQUEST['tagsForUser'];
	if (!$userlib->user_exists($tagsForUser)) {
		$smarty->assign('msg', tra("Unknown user"));
		$smarty->display("error.tpl");
		die;
	}
	$smarty->assign('tagsForUser',$tagsForUser);
} else {
	$tagsForUser = '';
}

if ($feature_freetags == 'y') {     // And get the Tags for the posts
    include_once("lib/freetag/freetaglib.php");
    $freetaglib->max_cloud_text_size = 25;
    $tags = $freetaglib->get_most_popular_tags($tagsForUser, 0, 100);
    $smarty->assign('popularTags',$tags);
}

$smarty->assign('mid','el-tag_cloud.tpl');
$smarty->display('tiki.tpl');

?>
