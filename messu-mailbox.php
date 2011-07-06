<?php

// $Header: /cvsroot/tikiwiki/tiki/messu-mailbox.php,v 1.13.2.12 2007/03/02 12:23:14 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
require_once('tiki-setup.php');

include_once('lib/messu/messulib.php');

if(!$user) {
  $smarty->assign('msg', tra("You are not logged in"));
  $smarty->assign('errortype', '402');
  $smarty->display("error.tpl");
  die;
}

if($feature_messages != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_messages");
  $smarty->display("error.tpl");
  die;
}

if($tiki_p_messages != 'y') {
  $smarty->assign('msg', tra("Permission denied"));
  $smarty->display("error.tpl");
  die;
}

$maxRecords = $messulib->get_user_preference($user, 'mess_maxRecords', 20);

// auto-archiving of read mails?
$mess_archiveAfter = $messulib->get_user_preference($user, 'mess_archiveAfter', 0);
$smarty->assign_by_ref('mess_archiveAfter', $mess_archiveAfter);

if($mess_archiveAfter>0) {
  // get date of last check. if not set yet, set it to 'before 10 minutes'
  $mess_archiveLast = $messulib->get_user_preference($user, 'mess_archiveLast', date("U")-600);

  // only run auto-archive job every 10 minutes:
  if(date("U")-$mess_archiveLast>=600) {
    $messulib->set_user_preference($user, 'mess_archiveLast', date("U"));
    $messulib->archive_messages($user, $mess_archiveAfter);
  }
}

// Mark messages if the mark button was pressed
if(isset($_REQUEST["mark"]) && isset($_REQUEST["msg"])) {
  foreach(array_keys($_REQUEST["msg"])as $msg) {
    $parts = explode('_', $_REQUEST['action']);
    $messulib->flag_message($user, $msg, $parts[0], $parts[1]);
  }
}

// Delete messages if the delete button was pressed
if(isset($_REQUEST["delete"]) && isset($_REQUEST["msg"])) {
  check_ticket('messu-mailbox');
  foreach(array_keys($_REQUEST["msg"])as $msg) {
    $messulib->delete_message($user, $msg);
  }
}

// Archive messages if the archive button was pressed
if(isset($_REQUEST["archive"]) && isset($_REQUEST["msg"])) {
  check_ticket('messu-mailbox');
  $tmp = $messulib->count_messages($user, 'archive');
  foreach(array_keys($_REQUEST["msg"])as $msg) {
    if(($messu_archive_size>0) && ($tmp>=$messu_archive_size)) {
      $smarty->assign('msg', tra("Archive is full. Delete some messages from archive first."));
      $smarty->display("error.tpl");
      die;
    }

    $messulib->archive_message($user, $msg);
    $tmp++;
  }
}

// Download messages if the download button was pressed
if(isset($_REQUEST["download"])) {
  check_ticket('messu-mailbox');

  // if message ids are handed over, use them:
  if(isset($_REQUEST["msg"])) {
    foreach(array_keys($_REQUEST["msg"])as $msg) {
      $tmp = $messulib->get_message($user, $msg, 'messages');
      $items[] = $tmp;
    }
  }

  else {
    $items = $messulib->get_messages($user, 'messages', '', '', '');
  }

  $smarty->assign_by_ref('items', $items);

  header("Content-type: application/download ");
  header("Content-Disposition: attachment; filename=tiki-msg-mailbox-".time("U").".txt ");
  $smarty->display("messu-download.tpl");
  die;
}

if(isset($_REQUEST['filter'])) {
  if($_REQUEST['flags'] != '') {
    $parts = explode('_', $_REQUEST['flags']);

    $_REQUEST['flag'] = $parts[0];
    $_REQUEST['flagval'] = $parts[1];
  }
}

$orig_or_reply="r";

if(!isset($_REQUEST["replyto"]))
  $_REQUEST["replyto"] = '';

if(isset($_REQUEST["origto"])) {
  $_REQUEST["replyto"] = $_REQUEST["origto"];
  $orig_or_reply="o";
}

if(!isset($_REQUEST["priority"]))
  $_REQUEST["priority"] = '';

if(!isset($_REQUEST["flag"]))
  $_REQUEST["flag"] = '';

if(!isset($_REQUEST["flagval"]))
  $_REQUEST["flagval"] = '';

if(!isset($_REQUEST["sort_mode"])) {
  $sort_mode = 'date_desc';
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

if(isset($_REQUEST["find"])) {
  $find = $_REQUEST["find"];
}

else {
  $find = '';
}

$smarty->assign_by_ref('flag', $_REQUEST['flag']);
$smarty->assign_by_ref('priority', $_REQUEST['priority']);
$smarty->assign_by_ref('flagval', $_REQUEST['flagval']);
$smarty->assign_by_ref('offset', $offset);
$smarty->assign_by_ref('sort_mode', $sort_mode);
$smarty->assign('find', $find);
// What are we paginating: items
$items = $messulib->list_user_messages($user, $offset, $maxRecords, $sort_mode,
                                       $find, $_REQUEST["flag"], $_REQUEST["flagval"], $_REQUEST['priority'], '', $_REQUEST["replyto"], $orig_or_reply);

$cant_pages = ceil($items["cant"] / $maxRecords);
$smarty->assign_by_ref('cant_pages', $cant_pages);
$smarty->assign('actual_page', 1 + ($offset / $maxRecords));

if($items["cant"] > ($offset + $maxRecords)) {
  $smarty->assign('next_offset', $offset + $maxRecords);
}

else {
  $smarty->assign('next_offset', -1);
}

if($offset > 0) {
  $smarty->assign('prev_offset', $offset - $maxRecords);
}

else {
  $smarty->assign('prev_offset', -1);
}

$smarty->assign_by_ref('items', $items["data"]);

$cellsize = 200;
$percentage = 1;

if($messu_mailbox_size>0) {
  $current_number = $messulib->count_messages($user);
  $smarty->assign('messu_mailbox_number', $current_number);
  $smarty->assign('messu_mailbox_size', $messu_mailbox_size);
  $percentage = ($current_number / $messu_mailbox_size) * 100;
  $cellsize = round($percentage / 100 * 200);

  if($current_number>$messu_mailbox_size) $cellsize=200;

  if($cellsize<1) $cellsize=1;

  $percentage = round($percentage);
}

$smarty->assign('cellsize', $cellsize);
$smarty->assign('percentage', $percentage);

$section = 'user_messages';
include_once('tiki-section_options.php');

include_once('tiki-mytiki_shared.php');
ask_ticket('messu-mailbox');

$smarty->assign('mid', 'messu-mailbox.tpl');
$smarty->display("tiki.tpl");

?>
