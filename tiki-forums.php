<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-forums.php,v 1.11.2.6 2007/03/02 12:23:26 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once ('tiki-setup.php');

if ($feature_forums != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_forums");

	$smarty->display("error.tpl");
	die;
}

if ($tiki_p_forum_read != 'y') {
	$smarty->assign('msg', tra("Permission denied you cannot view this section"));

	$smarty->display("error.tpl");
	die;
}

// This shows a list of forums everybody can use this listing
include_once ("lib/commentslib.php");
$commentslib = new Comments($dbTiki);

if (!isset($_REQUEST["sort_mode"])) {
	$sort_mode = $forums_ordering;
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
$channels = $commentslib->list_forums($offset, $maxRecords, $sort_mode, $find);

$temp_max = count($channels["data"]);
for ($i = 0; $i < $temp_max; $i++) {
	if ($userlib->object_has_one_permission($channels["data"][$i]["forumId"], 'forum')) {
		$channels["data"][$i]["individual"] = 'y';

		// forums that user cannot read are not displayed at all
		$channels["data"][$i]["individual_tiki_p_forum_read"] = 'y';

		if ($userlib->object_has_permission($user, $channels["data"][$i]["forumId"], 'forum', 'tiki_p_forum_post')) {
			$channels["data"][$i]["individual_tiki_p_forum_post"] = 'y';
		} else {
			$channels["data"][$i]["individual_tiki_p_forum_post"] = 'n';
		}

		if ($userlib->object_has_permission($user, $channels["data"][$i]["forumId"], 'forum', 'tiki_p_forum_vote')) {
			$channels["data"][$i]["individual_tiki_p_forum_vote"] = 'y';
		} else {
			$channels["data"][$i]["individual_tiki_p_forum_vote"] = 'n';
		}

		if ($userlib->object_has_permission($user, $channels["data"][$i]["forumId"], 'forum', 'tiki_p_forum_post_topic')) {
			$channels["data"][$i]["individual_tiki_p_forum_post_topic"] = 'y';
		} else {
			$channels["data"][$i]["individual_tiki_p_forum_post_topic"] = 'n';
		}

		if ($tiki_p_admin
			== 'y' || $userlib->object_has_permission($user, $channels["data"][$i]["forumId"], 'forum', 'tiki_p_admin_forum')) {
			$channels["data"][$i]["individual_tiki_p_forum_post_topic"] = 'y';

			$channels["data"][$i]["individual_tiki_p_forum_vote"] = 'y';
			$channels["data"][$i]["individual_tiki_p_admin_forum"] = 'y';
			$channels["data"][$i]["individual_tiki_p_forum_post"] = 'y';
			$channels["data"][$i]["individual_tiki_p_forum_read"] = 'y';
		}
	} else {
		$channels["data"][$i]["individual"] = 'n';
	}
}

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
$section = 'forums';
include_once ('tiki-section_options.php');

if ($feature_mobile =='y' && isset($_REQUEST['mode']) && $_REQUEST['mode'] == 'mobile') {
	include_once ("lib/hawhaw/hawtikilib.php");

	HAWTIKI_forums($channels["data"], $tiki_p_forum_read, $offset, $maxRecords, $channels["cant"]);
}

ask_ticket('forums');

// Display the template
$smarty->assign('mid', 'tiki-forums.tpl');
$smarty->display("tiki.tpl");

?>
