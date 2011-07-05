<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-export_tracker.php,v 1.1.2.7 2007/03/02 12:23:29 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once('tiki-setup.php');

include_once('lib/trackers/trackerlib.php');
include_once('lib/notifications/notificationlib.php');
if ($feature_trackers != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_trackers");
	$smarty->display("error.tpl");
	die;
}

if (!isset($_REQUEST["trackerId"])) {
	$smarty->assign('msg', tra("No tracker indicated"));
	$smarty->display("error.tpl");
	die;
}

if ($feature_categories == 'y') {
  global $categlib;
  if (!is_object($categlib)) {
    include_once('lib/categories/categlib.php');
  }
}

if ($tiki_p_admin_trackers != 'y') {
	if (!isset($user)){
		$smarty->assign('msg',$smarty->fetch('modules/mod-login_box.tpl'));
		$smarty->assign('errortitle',tra("Please login"));
	} else {
		$smarty->assign('msg',tra("Permission denied you cannot view this page"));
	}
	$smarty->display("error.tpl");
	die;
}

$xfields = $trklib->list_tracker_fields($_REQUEST["trackerId"], 0, -1, 'position_asc', '');
$listfields = array();
$usecategs = false;
$temp_max = count($xfields["data"]);
for ($i = 0; $i < $temp_max; $i++) {
	$fid = $xfields["data"][$i]["fieldId"];
	$listfields[$fid] = $xfields["data"][$i];
	if ($xfields["data"][$i]["type"] == 'e') {
		$usecategs = true;
	}
}
$smarty->assign_by_ref('listfields', $listfields);

$items = $trklib->list_items($_REQUEST["trackerId"], 0, -1, '', $listfields, '', '', "opc",'','','');

$smarty->assign_by_ref('items', $items["data"]);
$smarty->assign_by_ref('item_count', $items['cant']);

if ($usecategs and $items['data']) {
	foreach ($items['data'] as $f=>$v) {
		$cat = $categlib->get_object_categories("tracker ".$_REQUEST["trackerId"],$v["itemId"]);
		$items['data'][$f]['categs'] = implode(',',$cat);
	}
}

header('Content-type: text/csv; charset=utf-8');
header ("Content-Disposition: attachment; filename=\"{$siteTitle}_tracker_".$_REQUEST["trackerId"].".csv\"");


$smarty->display('tiki-export_tracker.tpl');

?>
