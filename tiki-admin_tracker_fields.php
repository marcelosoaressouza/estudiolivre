<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-admin_tracker_fields.php,v 1.28.2.18 2007/12/10 04:28:34 kerrnel22 Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once('tiki-setup.php');

include_once('lib/trackers/trackerlib.php');

if($feature_trackers != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_trackers");

  $smarty->display("error.tpl");
  die;
}

// To admin tracker fields the user must have permission to admin trackers
if($tiki_p_admin != 'y' && $tiki_p_admin_trackers != 'y') {
  $smarty->assign('msg', tra("You don't have permission to use this feature"));
  $smarty->display("error.tpl");
  die;
}

if(!isset($_REQUEST["trackerId"])) {
  $smarty->assign('msg', tra("No tracker indicated"));
  $smarty->display("error.tpl");
  die;
}

if($tiki_p_admin == 'y') {
  $smarty->assign('tiki_p_admin', $tiki_p_admin);
}

$smarty->assign('trackerId', $_REQUEST["trackerId"]);
$tracker_info = $trklib->get_tracker($_REQUEST["trackerId"]);

if($t = $trklib->get_tracker_options($_REQUEST['trackerId']))
  $tracker_info = array_merge($tracker_info, $t);

$smarty->assign('tracker_info', $tracker_info);

$field_types = $trklib->field_types();
$smarty->assign('field_types', $field_types);

if(!isset($_REQUEST["fieldId"])) {
  $_REQUEST["fieldId"] = 0;
}

$smarty->assign('fieldId', $_REQUEST["fieldId"]);

if(!isset($_REQUEST['position'])) {
  $_REQUEST['position'] = $trklib->get_last_position($_REQUEST["trackerId"])+1;
}

if(!isset($_REQUEST['options'])) {
  $_REQUEST['options'] = '';
}

if($_REQUEST["fieldId"]) {
  $info = $trklib->get_tracker_field($_REQUEST["fieldId"]);
}

else {
  $info = array();
  $info["name"] = '';
  $info["options"] = '';
  $info["position"] = $trklib->get_last_position($_REQUEST["trackerId"])+1;
  $info["type"] = 'o';
  $info["isMain"] = 'n';
  $info["isSearchable"] = 'n';
  $info["isTblVisible"] = 'n';
  $info["isPublic"] = 'n';
  $info["isHidden"] = 'n';
  $info["isMandatory"] = 'n';
}

if(isset($_REQUEST['up']) && $_REQUEST['fieldId']) {
  if(empty($_REQUEST['delta']))
    $_REQUEST['delta'] = 1;

  $trklib->move_up_last_fields($_REQUEST['trackerId'], $info['position'], $_REQUEST['delta']);
  $info['position'] += $_REQUEST['delta'] ;
}

$smarty->assign('name', $info["name"]);
$smarty->assign('type', $info["type"]);
$smarty->assign('options', $info["options"]);
$smarty->assign('position', $info["position"]);
$smarty->assign('isMain', $info["isMain"]);
$smarty->assign('isSearchable', $info["isSearchable"]);
$smarty->assign('isTblVisible', $info["isTblVisible"]);
$smarty->assign('isPublic', $info["isPublic"]);
$smarty->assign('isHidden', $info["isHidden"]);
$smarty->assign('isMandatory', $info["isMandatory"]);


if(isset($_REQUEST["remove"]) and($tracker_info['useRatings'] != 'y' or $info['name'] != 'Rating')) {
  $area = 'deltrackerfield';

  if($feature_ticketlib2 != 'y' or(isset($_POST['daconfirm']) and isset($_SESSION["ticket_$area"]))) {
    key_check($area);
    $trklib->remove_tracker_field($_REQUEST["remove"],$_REQUEST["trackerId"]);
    $logslib->add_log('admintrackerfields','removed tracker field '.$_REQUEST["remove"].' from tracker '.$tracker_info['name']);
  }

  else {
    key_get($area);
  }
}

function replace_tracker_from_request($tracker_info)
{
  global $trklib, $logslib, $smarty;

  check_ticket('admin-tracker-fields');

  if(isset($_REQUEST["isMain"]) && ($_REQUEST["isMain"] == 'on' || $_REQUEST["isMain"] == 'y')) {
    $isMain = 'y';
  }

  else {
    $isMain = 'n';
  }

  if(isset($_REQUEST["isSearchable"]) && ($_REQUEST["isSearchable"] == 'on' || $_REQUEST["isSearchable"] == 'y')) {
    $isSearchable = 'y';
  }

  else {
    $isSearchable = 'n';
  }

  if(isset($_REQUEST["isTblVisible"]) && ($_REQUEST["isTblVisible"] == 'on' || $_REQUEST["isTblVisible"] == 'y')) {
    $isTblVisible = 'y';
  }

  else {
    $isTblVisible = 'n';
  }

  if(isset($_REQUEST["isPublic"]) && ($_REQUEST["isPublic"] == 'on' || $_REQUEST["isPublic"] == 'y')) {
    $isPublic = 'y';
  }

  else {
    $isPublic = 'n';
  }

  if(isset($_REQUEST["isHidden"])) {
    if($_REQUEST["isHidden"] == 'y') {
      $isHidden = 'y';
    }

    elseif($_REQUEST["isHidden"] == 'p') {
      $isHidden = 'p';
    }

    else {
      $isHidden = 'n';
    }
  }

  else {
    $isHidden = 'n';
  }

  if(isset($_REQUEST["isMandatory"]) && ($_REQUEST["isMandatory"] == 'on' || $_REQUEST["isMandatory"] == 'y')) {
    $isMandatory = 'y';
  }

  else {
    $isMandatory = 'n';
  }

  //$_REQUEST["name"] = str_replace(' ', '_', $_REQUEST["name"]);
  $trklib->replace_tracker_field($_REQUEST["trackerId"], $_REQUEST["fieldId"], $_REQUEST["name"], $_REQUEST["type"], $isMain, $isSearchable,
                                 $isTblVisible, $isPublic, $isHidden, $isMandatory, $_REQUEST["position"], $_REQUEST["options"]);
  $logslib->add_log('admintrackerfields','changed or created tracker field '.$_REQUEST["name"].' in tracker '.$tracker_info['name']);
  $smarty->assign('fieldId', 0);
  $smarty->assign('name', '');
  $smarty->assign('type', '');
  $smarty->assign('options', '');
  $smarty->assign('isMain', $isMain);
  $smarty->assign('isSearchable', $isSearchable);
  $smarty->assign('isTblVisible', $isTblVisible);
  $smarty->assign('isPublic', $isPublic);
  $smarty->assign('isHidden', $isHidden);
  $smarty->assign('isMandatory', $isMandatory);
  $smarty->assign('position', $trklib->get_last_position($_REQUEST["trackerId"])+1);
}

if(isset($_REQUEST["save"])) {

  if(isset($_REQUEST['import']) and isset($_REQUEST['rawmeat'])) {
    $raw = $tikilib->read_raw($_REQUEST['rawmeat']);

    foreach($raw as $field=>$value)
    {

      foreach($value as $it=>$da) {
        $_REQUEST["$it"] = $da;
      }

      replace_tracker_from_request($tracker_info);

    }
  }

  else {
    replace_tracker_from_request($tracker_info);
  }
}

if(!isset($_REQUEST["sort_mode"])) {
  $sort_mode = 'position_asc';
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

if(isset($_REQUEST["max"])) {
  $max = $_REQUEST["max"];
}

else {
  $max = $maxRecords;
}

$smarty->assign('max', $max);

$smarty->assign_by_ref('sort_mode', $sort_mode);
$channels = $trklib->list_tracker_fields($_REQUEST["trackerId"], $offset, $max, $sort_mode, $find, false);
$plug = array();
foreach($channels['data'] as $c) {
  if($c['isPublic'] == 'y') {
    $plug[] = $c['fieldId'];
  }
}
$smarty->assign('plug', implode(':',$plug));

$urlquery['find'] = $find;
$urlquery['sort_mode'] = $sort_mode;
$smarty->assign_by_ref('urlquery', $urlquery);
$cant = $channels["cant"];
include "tiki-pagination.php";

$smarty->assign_by_ref('channels', $channels["data"]);
ask_ticket('admin-tracker-fields');

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

// Display the template
$smarty->assign('mid', 'tiki-admin_tracker_fields.tpl');
$smarty->display("tiki.tpl");

?>
