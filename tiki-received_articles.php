<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-received_articles.php,v 1.14.2.6 2007/03/02 12:23:24 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once ('tiki-setup.php');

include_once ('lib/commcenter/commlib.php');
include_once ('lib/articles/artlib.php');

if ($feature_comm != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_comm");

	$smarty->display("error.tpl");
	die;
}

if ($tiki_p_admin_received_articles != 'y') {
	$smarty->assign('msg', tra("You do not have permission to use this feature"));

	$smarty->display("error.tpl");
	die;
}

if (!isset($_REQUEST["receivedArticleId"])) {
	$_REQUEST["receivedArticleId"] = 0;
}

$smarty->assign('receivedArticleId', $_REQUEST["receivedArticleId"]);

if ($_REQUEST["receivedArticleId"]) {
	$info = $commlib->get_received_article($_REQUEST["receivedArticleId"]);

	$info["topic"] = 1;
} else {
	$info = array();

	$info["title"] = '';
	$info["authorName"] = '';
	$info["size"] = 0;
	$info["useImage"] = 'n';
	$info["image_name"] = '';
	$info["image_type"] = '';
	$info["image_size"] = 0;
	$info["image_x"] = 0;
	$info["image_y"] = 0;
	$info["image_data"] = '';
	$info["publishDate"] = date("U");
	$info["expireDate"] = mktime (0,0,0,date("m"),  date("d"),  date("Y")+1);
	$info["created"] = date("U");
	$info["heading"] = '';
	$info["body"] = '';
	$info["hash"] = '';
	$info["author"] = '';
	$info["topic"] = 1;
	$info["type"] = 'Article';
	$info["rating"] = 5;
}

$smarty->assign('view', 'n');

if (isset($_REQUEST["view"])) {
	$info = $tikilib->get_received_article($_REQUEST["view"]);

	$smarty->assign('view', 'y');
	$info["topic"] = 1;
}

if (isset($_REQUEST["accept"])) {
	check_ticket('received-articles');
	// CODE TO ACCEPT A PAGE HERE
	$publishDate = mktime($_REQUEST["Time_Hour"], $_REQUEST["Time_Minute"],
		0, $_REQUEST["Date_Month"], $_REQUEST["Date_Day"], $_REQUEST["Date_Year"]);
	$expireDate = mktime($_REQUEST["expire_Hour"], $_REQUEST["expire_Minute"],
		0, $_REQUEST["expire_Month"], $_REQUEST["expire_Day"], $_REQUEST["expire_Year"]);

	$commlib->update_received_article($_REQUEST["receivedArticleId"], $_REQUEST["title"], $_REQUEST["authorName"],
		$_REQUEST["useImage"], $_REQUEST["image_x"], $_REQUEST["image_y"],
		$publishDate, $expireDate, $_REQUEST["heading"], $_REQUEST["body"], $_REQUEST["type"], $_REQUEST["rating"]);
	$commlib->accept_article($_REQUEST["receivedArticleId"], $_REQUEST["topic"]);
	$smarty->assign('preview', 'n');
	$smarty->assign('receivedArticleId', 0);
}

$smarty->assign('preview', 'n');
$smarty->assign('topic', $info["topic"]);

if (isset($_REQUEST["preview"])) {
	$smarty->assign('preview', 'y');

	$info["publishDate"] = mktime($_REQUEST["Time_Hour"], $_REQUEST["Time_Minute"],
		0, $_REQUEST["Date_Month"], $_REQUEST["Date_Day"], $_REQUEST["Date_Year"]);
	$info["expireDate"] = mktime($_REQUEST["expire_Hour"], $_REQUEST["expire_Minute"],
		0, $_REQUEST["expire_Month"], $_REQUEST["expire_Day"], $_REQUEST["expire_Year"]);
	$info["title"] = $_REQUEST["title"];
	$info["authorName"] = $_REQUEST["authorName"];
	$info["receivedArticleId"] = $_REQUEST["receivedArticleId"];
	$info["useImage"] = $_REQUEST["useImage"];
	$info["image_name"] = $_REQUEST["image_name"];
	$info["image_size"] = $_REQUEST["image_size"];
	$info["image_x"] = $_REQUEST["image_x"];
	$info["image_y"] = $_REQUEST["image_y"];
	$info["created"] = $_REQUEST["created"];
	$info["heading"] = $_REQUEST["heading"];
	$info["body"] = $_REQUEST["body"];
	$info["topic"] = $_REQUEST["topic"];
	$info["type"] = $_REQUEST["type"];
	$info["rating"] = $_REQUEST["rating"];
}

$smarty->assign('topic', $info["topic"]);
$smarty->assign('title', $info["title"]);
$smarty->assign('authorName', $info["authorName"]);
$smarty->assign('useImage', $info["useImage"]);
$smarty->assign('image_name', $info["image_name"]);
$smarty->assign('image_size', $info["image_size"]);
$smarty->assign('image_x', $info["image_x"]);
$smarty->assign('image_y', $info["image_y"]);
$smarty->assign('publishDate', $info["publishDate"]);
$smarty->assign('expireDate', $info["expireDate"]);
$smarty->assign('created', $info["created"]);
$smarty->assign('heading', $info["heading"]);
$smarty->assign('body', $info["body"]);
$smarty->assign('type', $info["type"]);
$smarty->assign('rating', $info["rating"]);

// Assign parsed
$smarty->assign('parsed_heading', $tikilib->parse_data($info["heading"]));
$smarty->assign('parsed_body', $tikilib->parse_data($info["body"]));

if (isset($_REQUEST["remove"])) {
  $area = 'delreceivedarticle';
  if ($feature_ticketlib2 != 'y' or (isset($_POST['daconfirm']) and isset($_SESSION["ticket_$area"]))) {
    key_check($area);
		$commlib->remove_received_article($_REQUEST["remove"]);
  } else {
    key_get($area);
  }
}

if (isset($_REQUEST["save"])) {
	check_ticket('received-articles');
	$publishDate = mktime($_REQUEST["Time_Hour"], $_REQUEST["Time_Minute"],
		0, $_REQUEST["Date_Month"], $_REQUEST["Date_Day"], $_REQUEST["Date_Year"]);
	$expireDate = mktime($_REQUEST["expire_Hour"], $_REQUEST["expire_Minute"],
		0, $_REQUEST["Date_Month"], $_REQUEST["Date_Day"], $_REQUEST["Date_Year"]);

	$commlib->update_received_article($_REQUEST["receivedArticleId"], $_REQUEST["title"], $_REQUEST["authorName"],
		$_REQUEST["useImage"], $_REQUEST["image_x"], $_REQUEST["image_y"], $publishDate, $expireDate, $_REQUEST["heading"], $_REQUEST["body"]);
	$smarty->assign('receivedArticleId', $_REQUEST["receivedArticleId"]);
	$smarty->assign('title', $_REQUEST["title"]);
	$smarty->assign('authorName', $_REQUEST["authorName"]);
	$smarty->assign('size', strlen($_REQUEST["body"]));
	$smarty->assign('useImage', $_REQUEST["useImage"]);
	$smarty->assign('image_x', $_REQUEST["image_x"]);
	$smarty->assign('image_y', $_REQUEST["image_y"]);
	$smarty->assign('publishDate', $publishDate);
	$smarty->assign('expireDate', $expireDate);
	$smarty->assign('heading', $_REQUEST["heading"]);
	$smarty->assign('body', $_REQUEST["body"]);
}

if (!isset($_REQUEST["sort_mode"])) {
	$sort_mode = 'receivedDate_desc';
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
$channels = $commlib->list_received_articles($offset, $maxRecords, $sort_mode, $find);

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

$topics = $artlib->list_topics();
$smarty->assign_by_ref('topics', $topics);

$types = $artlib->list_types();
$smarty->assign_by_ref('types', $types);


ask_ticket('received-articles');

// Display the template
$smarty->assign('mid', 'tiki-received_articles.tpl');
$smarty->display("tiki.tpl");

?>
