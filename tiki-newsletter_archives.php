<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-newsletter_archives.php,v 1.1.2.6 2007/03/02 12:23:33 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once ('tiki-setup.php');

include_once ('lib/newsletters/nllib.php');

if ($feature_newsletters != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_newsletters");

	$smarty->display("error.tpl");
	die;
}

if (!empty($_REQUEST['nlId'])) {
	$smarty->assign('nlId', $_REQUEST["nlId"]);
	$nl_info = $nllib->get_newsletter($_REQUEST["nlId"]);
	$smarty->assign_by_ref('nl_info', $nl_info);
}

if (isset($_REQUEST['remove']) && !empty($_REQUEST['nlId'])) {
	if (!$tikilib->user_has_perm_on_object($user, $_REQUEST['nlId'], 'newsletter', 'tiki_p_admin_newsletters')) {
		$smarty->assign('msg', tra("You do not have permission to use this feature"));
		$smarty->display("error.tpl");
		die;
	}
	$area = 'delnewsletter';
	if ($feature_ticketlib2 != 'y' or (isset($_POST['daconfirm']) and isset($_SESSION["ticket_$area"]))) {
		key_check($area);
		$nllib->remove_edition($_REQUEST["id"], $_REQUEST["remove"]);
	} else {
		key_get($area);
	}
}

if (!isset($_REQUEST["sort_mode"])) {
	$sort_mode = 'sent_desc';
} else {
	$sort_mode = $_REQUEST["sort_mode"];
}

if (!isset($_REQUEST["offset"])) {
	$offset = 0;
} else {
	$offset = $_REQUEST["offset"];
}

$smarty->assign_by_ref('offset', $offset);

if (isset($_REQUEST["find"])) {
	$find = $_REQUEST["find"];
} else {
	$find = '';
}

$smarty->assign('find', $find);

$smarty->assign_by_ref('sort_mode', $sort_mode);
if (isset($_REQUEST["nlId"]))
	$channels = $nllib->list_editions($_REQUEST["nlId"], $offset, $maxRecords, $sort_mode, $find, 'tiki_p_subscribe_newsletters');
else
	$channels = $nllib->list_editions(0, $offset, $maxRecords, $sort_mode, $find, 'tiki_p_subscribe_newsletters');

$cant_pages = ceil($channels["cant"] / $maxRecords);
$smarty->assign_by_ref('cant_pages', $cant_pages);
$smarty->assign('actual_page', 1 + ($offset / $maxRecords));

if ($channels["cant"] > ($offset + $maxRecords)) {
	$smarty->assign('next_offset', $offset + $maxRecords);
} else {
	$smarty->assign('next_offset', -1);
}

// If offset is > 0 then prev_offset
if ($offset > 0) {
	$smarty->assign('prev_offset', $offset - $maxRecords);
} else {
	$smarty->assign('prev_offset', -1);
}
$smarty->assign_by_ref('channels', $channels["data"]);
$smarty->assign('url', "tiki-newsletter_archives.php");

if (isset($_REQUEST['editionId'])) {
	foreach ($channels['data'] as $edition) {
		if ($edition['editionId'] == $_REQUEST['editionId']) {
			$edition["dataparsed"] = $tikilib->parse_data($edition["data"]);
			$smarty->assign_by_ref('edition', $edition);
			break;
		}
	}	
}

ask_ticket('newsletters');

$section='newsletters';
include_once('tiki-section_options.php');

// Display the template
$smarty->assign('mid', 'tiki-newsletter_archives.tpl');
$smarty->display("tiki.tpl");

?>
