<?php

// $Header: /cvsroot/tikiwiki/tiki/Attic/tiki-eph.php,v 1.10.2.6 2007/03/02 12:23:29 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
require_once('tiki-setup.php');

include_once('lib/ephemerides/ephlib.php');
include_once("lib/class_calendar.php");

if($feature_eph != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_eph");

  $smarty->display("error.tpl");
  die;
}

if($tiki_p_view_eph != 'y') {
  $smarty->assign('msg',tra("You do not have permission to use this feature"));
  $smarty->display("error.tpl");
  die;
}


/*
Modified by Wells Wang to solve eph wrong date problem
if(isset($_SESSION['thedate'])) {
  $pdate = $_SESSION['thedate'];
} else {
  $pdate = date("U");
}
if(!isset($_REQUEST['day'])) $_REQUEST['day']=date("d");
if(!isset($_REQUEST['mon'])) $_REQUEST['mon']=date("m");
if(!isset($_REQUEST['year'])) $_REQUEST['year']=date("Y");
*/
if(isset($_REQUEST['day']) && isset($_REQUEST['mon']) && isset($_REQUEST['year'])) {
  $pdate = mktime(23, 59, 59, $_REQUEST['mon'], $_REQUEST['day'], $_REQUEST['year']);
}

else {
  $pdate = date("U");
}

if(!isset($_REQUEST['day']))
  $_REQUEST['day'] = date("d", $tikilib->server_time_to_site_time(time(), $user));

if(!isset($_REQUEST['mon']))
  $_REQUEST['mon'] = date("m", $tikilib->server_time_to_site_time(time(), $user));

if(!isset($_REQUEST['year']))
  $_REQUEST['year'] = date("Y", $tikilib->server_time_to_site_time(time(), $user));

// end of modif
$smarty->assign('day', $_REQUEST['day']);
$smarty->assign('mon', $_REQUEST['mon']);
$smarty->assign('year', $_REQUEST['year']);
$pdate = mktime(23, 59, 59, $_REQUEST['mon'], $_REQUEST['day'], $_REQUEST['year']);

if(!isset($_REQUEST['ephId']))
  $_REQUEST['ephId'] = 0;

$smarty->assign('ephId', $_REQUEST['ephId']);

if(!$_REQUEST['ephId']) {
  $info = array();

  $info['title'] = '';
  $info['textdata'] = '';
  $info['publish'] = date("U");
}

else {
  $info = $ephlib->get_eph($_REQUEST['ephId']);

  $pdate = $info["publish"];
}

$smarty->assign('info', $info);
$smarty->assign('pdate', $pdate);

if(!isset($_REQUEST["sort_mode"])) {
  $sort_mode = 'title_desc';
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

$channels = $ephlib->list_eph($offset, $maxRecords, $sort_mode, $find, $pdate);
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

// don't seem to be used in .tpl // is it required ?
ask_ticket('eph');

// end of existential question
$smarty->assign('mid', 'tiki-eph.tpl');
$smarty->display("tiki.tpl");

?>
