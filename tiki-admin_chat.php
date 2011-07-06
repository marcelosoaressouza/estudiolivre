<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-admin_chat.php,v 1.9.2.8 2007/08/11 20:30:46 marclaporte Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once('tiki-setup.php');

include_once('lib/chat/chatlib.php');

if($feature_chat != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_chat");

  $smarty->display("error.tpl");
  die;
}


if($tiki_p_admin_chat != 'y') {
  $smarty->assign('msg', tra("You do not have permission to use this feature"));

  $smarty->display("error.tpl");
  die;
}

if(!isset($_REQUEST["channelId"])) {
  $_REQUEST["channelId"] = 0;
}

$smarty->assign('channelId', $_REQUEST["channelId"]);

if($_REQUEST["channelId"]) {
  $info = $chatlib->get_channel($_REQUEST["channelId"]);
}

else {
  $info = array();

  $info["name"] = '';
  $info["description"] = '';
  $info["active"] = 'y';
  $info["refresh"] = 3000;
}

$smarty->assign('name', $info["name"]);
$smarty->assign('description', $info["description"]);
$smarty->assign('active', $info["active"]);
$smarty->assign('refresh', $info["refresh"]);

if(isset($_REQUEST["remove"])) {
  $area = "delchatchannel";

  if($feature_ticketlib2 != 'y' or(isset($_POST['daconfirm']) and isset($_SESSION["ticket_$area"]))) {
    key_check($area);
    $chatlib->remove_channel($_REQUEST["remove"]);
  }

  else {
    key_get($area);
  }
}

if(isset($_REQUEST["save"])) {
  check_ticket('admin-chat');

  if(isset($_REQUEST["active"]) && $_REQUEST["active"] == 'on') {
    $active = 'y';
  }

  else {
    $active = 'n';
  }

  $chatlib->replace_channel($_REQUEST["channelId"], $_REQUEST["name"], $_REQUEST["description"], 0,
                            'n', $active, $_REQUEST["refresh"]);
}

if(!isset($_REQUEST["sort_mode"])) {
  $sort_mode = 'name_desc';
}

else {
  $sort_mode = $_REQUEST["sort_mode"];
}

if(!isset($_REQUEST["offset"])) {
  $offset = 0;
}

else {
  $offset = $_REQUEST["offset"];
}

$smarty->assign_by_ref('offset', $offset);

if(isset($_REQUEST["find"])) {
  $find = $_REQUEST["find"];
}

else {
  $find = '';
}

$smarty->assign('find', $find);

$smarty->assign_by_ref('sort_mode', $sort_mode);

$channels = $chatlib->list_channels($offset, $maxRecords, $sort_mode, $find);

$cant_pages = ceil($channels["cant"] / $maxRecords);
$smarty->assign_by_ref('cant_pages', $cant_pages);
$smarty->assign('actual_page', 1 + ($offset / $maxRecords));

if($channels["cant"] > ($offset + $maxRecords)) {
  $smarty->assign('next_offset', $offset + $maxRecords);
}

else {
  $smarty->assign('next_offset', -1);
}

// If offset is > 0 then prev_offset
if($offset > 0) {
  $smarty->assign('prev_offset', $offset - $maxRecords);
}

else {
  $smarty->assign('prev_offset', -1);
}

$smarty->assign_by_ref('channels', $channels["data"]);

ask_ticket('admin-chat');

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

// Display the template
$smarty->assign('mid', 'tiki-admin_chat.tpl');
$smarty->display("tiki.tpl");

?>
