<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-g-user_processes.php,v 1.8.2.5 2007/03/02 12:23:23 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
require_once('tiki-setup.php');

include_once('lib/Galaxia/GUI.php');

if($feature_workflow != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_workflow");

  $smarty->display("error.tpl");
  die;
}

if($tiki_p_use_workflow != 'y') {
  $smarty->assign('msg', tra("Permission denied"));

  $smarty->display("error.tpl");
  die;
}

// When $user is null, it means an anonymous user is trying to use Galaxia
$user = is_null($user) ? "Anonymous" : $user;

// Filtering data to be received by request and  used to build the where part of a query
// filter_active, filter_valid, find, sort_mode, filter_process
$where = '';
$wheres = array();

/*
if(isset($_REQUEST['filter_active'])&&$_REQUEST['filter_active']) $wheres[]="isActive='".$_REQUEST['filter_active']."'";
if(isset($_REQUEST['filter_valid'])&&$_REQUEST['filter_valid']) $wheres[]="isValid='".$_REQUEST['filter_valid']."'";
if(isset($_REQUEST['filter_process'])&&$_REQUEST['filter_process']) $wheres[]="pId=".$_REQUEST['filter_process']."";
$where = implode(' and ',$wheres);
*/
if(!isset($_REQUEST["sort_mode"])) {
  $sort_mode = 'procname_asc';
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
$smarty->assign('where', $where);
$smarty->assign_by_ref('sort_mode', $sort_mode);

$items = $GUI->gui_list_user_processes($user, $offset, $maxRecords, $sort_mode, $find, $where);
$smarty->assign('cant', $items['cant']);

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

$section = 'workflow';
include_once('tiki-section_options.php');

$sameurl_elements = array(
                      'offset',
                      'sort_mode',
                      'where',
                      'find',
                      'filter_valid',
                      'filter_process',
                      'filter_active',
                      'pid'
                    );
ask_ticket('g-user-processes');

$smarty->assign('mid', 'tiki-g-user_processes.tpl');
$smarty->display("tiki.tpl");

?>
