<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-view_tracker_item.php,v 1.69.2.102 2007/12/10 04:28:34 kerrnel22 Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once('tiki-setup.php');

include_once('lib/trackers/trackerlib.php');
include_once('lib/notifications/notificationlib.php');

if($feature_trackers != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_trackers");
  $smarty->display("error.tpl");
  die;
}

$special = false;

if(!isset($_REQUEST['trackerId']) && $userTracker == 'y') {
  if(isset($_REQUEST['view']) and $_REQUEST['view'] == ' user') {
    $utid = $userlib->get_usertrackerid($group);

    if($utid['usersTrackerId']) {
      $_REQUEST['trackerId'] = $utid['usersTrackerId'];
      $_REQUEST["itemId"] = $trklib->get_item_id($_REQUEST['trackerId'],$utid['usersFieldId'],$user);

      if($_REQUEST['itemId'] == NULL) {
        $addit['data'][0]['fieldId'] = $utid['usersFieldId'];
        $addit['data'][0]['type'] = 'u';
        $addit['data'][0]['value'] = $user;
        $i = 1;

        if($f = $trklib->get_field_id_from_type($_REQUEST['trackerId'], "u", 1)) {
          if($f != $utid['usersFieldId']) {
            $addit['data'][1]['fieldId'] = $f;
            $addit['data'][1]['type'] = 'u';
            $addit['data'][1]['value'] = $user;
            ++$i;
          }
        }

        if($f = $trklib->get_field_id_from_type($_REQUEST['trackerId'], "g", 1)) {
          $addit['data'][$i]['fieldId'] = $f;
          $addit['data'][$i]['type'] = 'g';
          $addit['data'][$i]['value'] = $group;
        }

        $_REQUEST['itemId'] = $trklib->replace_item($_REQUEST["trackerId"], 0, $addit, 'o');
      }

      $special = 'user';
    }
  }

  elseif(isset($_REQUEST["usertracker"]) and $tiki_p_admin == 'y') {
    $thatgroup = $userlib->get_user_default_group($_REQUEST["usertracker"]);
    $utid = $userlib->get_usertrackerid($thatgroup);
    $_REQUEST['trackerId'] = $utid['usersTrackerId'];
    $_REQUEST["itemId"] = $trklib->get_item_id($_REQUEST['trackerId'],$utid['usersFieldId'],$_REQUEST["usertracker"]);
  }
}

if(!isset($_REQUEST['trackerId']) && $groupTracker == 'y') {
  if(isset($_REQUEST['view']) and $_REQUEST['view'] == ' group') {
    $gtid = $userlib->get_grouptrackerid($group);

    if($gtid['groupTrackerId']) {
      $_REQUEST["trackerId"] = $gtid['groupTrackerId'];
      $_REQUEST["itemId"] = $trklib->get_item_id($_REQUEST['trackerId'],$gtid['groupFieldId'],$group);

      if($_REQUEST['itemId'] == NULL) {
        $addit['data'][0]['fieldId'] = $gtid['groupFieldId'];
        $addit['data'][0]['type'] = 'g';
        $addit['data'][0]['value'] = $group;
        $_REQUEST['itemId'] = $trklib->replace_item($_REQUEST["trackerId"], 0, $addit, 'o');
      }

      $special = 'group';
    }
  }

  elseif(isset($_REQUEST["grouptracker"]) and $tiki_p_admin == 'y') {
    $gtid = $userlib->get_grouptrackerid($_REQUEST["grouptracker"]);
    $_REQUEST["trackerId"] = $gtid['groupTrackerId'];
    $_REQUEST["itemId"] = $trklib->get_item_id($_REQUEST['trackerId'],$gtid['groupFieldId'],$_REQUEST["grouptracker"]);
  }
}

$smarty->assign_by_ref('special', $special);

if((!isset($_REQUEST["trackerId"]) || !$_REQUEST["trackerId"]) && isset($_REQUEST["itemId"])) {
  $item_info = $trklib->get_tracker_item($_REQUEST["itemId"]);
  $_REQUEST['trackerId'] = $item_info['trackerId'];
}

if(!isset($_REQUEST["trackerId"]) || !$_REQUEST["trackerId"]) {
  $smarty->assign('msg', tra("No tracker indicated"));
  $smarty->display("error.tpl");
  die;
}

if(!isset($utid) and !isset($gtid) and(!isset($_REQUEST["itemId"]) or !$_REQUEST["itemId"])) {
  $smarty->assign('msg', tra("No item indicated"));
  $smarty->display("error.tpl");
  die;
}

if(!isset($_REQUEST["sort_mode"])) {
  $sort_mode = 'created_desc';
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

// ************* previous/next **************
$urlquery = array();
foreach(array('status', 'filterfield', 'filtervalue', 'initial', 'exactvalue', 'reloff') as $reqfld) {
  $trynam = 'try'.$reqfld;

  if(isset($_REQUEST[$reqfld]) && is_string($_REQUEST[$reqfld])) {
    $$trynam = $urlquery[$reqfld] = $_REQUEST[$reqfld];
  }

  else {
    $$trynam = '';
  }
}

if(isset($_REQUEST["filtervalue"]) and is_array($_REQUEST["filtervalue"]) and isset($_REQUEST["filtervalue"]["$tryfilterfield"])) {
  $tryfiltervalue = $_REQUEST["filtervalue"]["$tryfilterfield"];
  $urlquery["filtervalue[".$tryfilterfield."]"] = $tryfiltervalue;
}

if(isset($_REQUEST["move"])) {
  $move = ($_REQUEST["move"] == 'prev') ? -1 : 1;

  if($offset + ($tryreloff += $move) >= 0) {
    $trymove =
      $trklib->list_items($_REQUEST["trackerId"], $offset + $tryreloff, 1,
                          $_REQUEST["sort_mode"], array(),
                          $tryfilterfield, $tryfiltervalue, $trystatus, $tryinitial, $tryexactvalue);
  }

  if(isset($trymove["data"][0]["itemId"])) {
    $_REQUEST["itemId"] = $trymove["data"][0]["itemId"];
    unset($item_info);
    $urlquery['reloff'] = $tryreloff;
  }

  elseif($move > 0) {
    $smarty->assign('nextmsg', tra("Last page"));
  }
}

if($offset + $tryreloff <= 0) {
  $smarty->assign('prevmsg', tra("First page"));
}

$smarty->assign_by_ref('urlquery', $urlquery);
//*********** that's all for prev/next *****************

$smarty->assign('itemId', $_REQUEST["itemId"]);

if(!isset($item_info))
  $item_info = $trklib->get_tracker_item($_REQUEST["itemId"]);

$smarty->assign('item_info', $item_info);

$smarty->assign('individual', 'n');

if($userlib->object_has_one_permission($_REQUEST["trackerId"], 'tracker')) {
  $smarty->assign('individual', 'y');

  if($tiki_p_admin != 'y') {
    $perms = $userlib->get_permissions(0, -1, 'permName_desc', '', 'trackers');
    foreach($perms["data"] as $perm) {
      $permName = $perm["permName"];

      if($userlib->object_has_permission($user, $_REQUEST["trackerId"], 'tracker', $permName)) {
        $$permName = 'y';
        $smarty->assign("$permName", 'y');

        if($permName == 'tiki_p_admin_trackers') {
          $propagate = true;
        }
      }

      else {
        $$permName = 'n';
        $smarty->assign("$permName", 'n');
      }
    }
  }
}

if(!empty($propagate) && $propagate) {  // if local set of tiki_p_admin_trackers, need to other perm
  $perms = $userlib->get_permissions(0, -1, 'permName_desc', '', 'trackers');
  foreach($perms['data'] as $perm) {
    $perm = $perm['permName'];
    $smarty->assign("$perm", 'y');
    $$perm = 'y';
  }
}

$tracker_info = $trklib->get_tracker($_REQUEST["trackerId"]);

if($t = $trklib->get_tracker_options($_REQUEST["trackerId"]))
  $tracker_info = array_merge($tracker_info,$t);

if(!isset($tracker_info["writerCanModify"]) or(isset($utid) and($_REQUEST['trackerId'] != $utid['usersTrackerId']))) {
  $tracker_info["writerCanModify"] = 'n';
}

if(!isset($tracker_info["writerGroupCanModify"]) or(isset($gtid) and($_REQUEST['trackerId'] != $gtid['groupTrackerId']))) {
  $tracker_info["writerGroupCanModify"] = 'n';
}

if($tiki_p_view_trackers != 'y' and $tracker_info["writerCanModify"] != 'y' and $tracker_info["writerGroupCanModify"] != 'y'&& !$special) {
  if(!$user) {
    $smarty->assign('msg',$smarty->fetch('modules/mod-login_box.tpl'));
    $smarty->assign('errortitle',tra("Please login"));
  }

  else {
    $smarty->assign('msg', tra("You do not have permission to use this feature"));
  }

  $smarty->display("error.tpl");
  die;
}

$status_types = $trklib->status_types();
$smarty->assign('status_types', $status_types);

$xfields = $trklib->list_tracker_fields($_REQUEST["trackerId"], 0, -1, 'position_asc', '');
$fields = array();
$ins_fields = array();

$usecategs = false;
$ins_categs = array();
$textarea_options = false;
$tabi = 1;

foreach($xfields["data"] as $i=>$array) {
  $fid = $xfields["data"][$i]["fieldId"];

  $ins_id = 'ins_' . $fid;
  $xfields["data"][$i]["ins_id"] = $ins_id;

  $filter_id = 'filter_' . $fid;
  $xfields["data"][$i]["filter_id"] = $filter_id;

  if(!isset($mainfield) and $xfields["data"][$i]['isMain'] == 'y') {
    $mainfield = $i;
  }

  if($xfields["data"][$i]['type'] == 's') {   // Special system variable
    if($xfields["data"][$i]['name'] == "Rating") {  // Ratings
      $ins_fields["data"][$i] = $xfields["data"][$i];
      $rateFieldId = $fid;
      //$fields["data"][$i] = $xfields["data"][$i];
    } // Do nothing for ItemID here.
  }

  elseif($xfields["data"][$i]['isHidden'] != 'y' or $tiki_p_admin_trackers == 'y') {
    $ins_fields["data"][$i] = $xfields["data"][$i];
    $fields["data"][$i] = $xfields["data"][$i];

    if($fields["data"][$i]["type"] == 'f') {
      $fields["data"][$i]["value"] = '';
      $ins_fields["data"][$i]["value"] = '';

      if(isset($_REQUEST["$ins_id" . "Day"])) {
        $dc = $tikilib->get_date_converter($user);
        $ins_fields["data"][$i]["value"] = $dc->getServerDateFromDisplayDate(mktime($_REQUEST["$ins_id" . "Hour"], $_REQUEST["$ins_id" . "Minute"], 0, $_REQUEST["$ins_id" . "Month"], $_REQUEST["$ins_id" . "Day"], $_REQUEST["$ins_id" . "Year"]));
      }

      else {
        $ins_fields["data"][$i]["value"] = date("U");
      }

    }

    elseif($fields["data"][$i]["type"] == 'e') {
      include_once('lib/categories/categlib.php');
      $k = $ins_fields["data"][$i]["options"];
      $fields["data"][$i]["$k"] = $categlib->get_child_categories($k);
      $categId = "ins_cat_$fid";

      if(isset($_REQUEST[$categId]) and is_array($_REQUEST[$categId])) {
        $ins_categs = array_merge($ins_categs,$_REQUEST[$categId]);
      }

      $ins_fields["data"][$i]["value"] = '';

    }
    elseif($fields["data"][$i]["type"] == 'c') {
      if(isset($_REQUEST["$ins_id"]) && $_REQUEST["$ins_id"] == 'on') {
        $ins_fields["data"][$i]["value"] = 'y';
      }

      else {
        $ins_fields["data"][$i]["value"] = 'n';
      }

      if(isset($_REQUEST["$filter_id"])) {
        $fields["data"][$i]["value"] = $_REQUEST["$filter_id"];
      }

      else {
        $fields["data"][$i]["value"] = '';
      }

    }
    elseif($fields["data"][$i]["type"] == 'u' and isset($fields["data"][$i]["options"]) and $user) {
      if(isset($_REQUEST["$ins_id"]) and($fields["data"][$i]["options"] < 1 or $tiki_p_admin_trackers == 'y')) {
        $ins_fields["data"][$i]["value"] = $_REQUEST["$ins_id"];
      }

      else {
        if($fields["data"][$i]["options"] == 2) {
          $ins_fields["data"][$i]["value"] = $user;
        }

        elseif($fields["data"][$i]["options"] == 1) {
          if(isset($tracker_info["writerCanModify"]) and $tracker_info["writerCanModify"] == 'y') {
            $tracker_info["authorfield"] = $fid;
          }

          unset($ins_fields["data"][$i]["fieldId"]);
        }

        else {
          $ins_fields["data"][$i]["value"] = '';
        }
      }

      if(isset($_REQUEST["$filter_id"])) {
        $fields["data"][$i]["value"] = $_REQUEST["$filter_id"];
      }

      else {
        $fields["data"][$i]["value"] = '';
      }

    }
    elseif($fields["data"][$i]["type"] == 'g' and isset($fields["data"][$i]["options"]) and $group)  {
      if(isset($_REQUEST["$ins_id"])) {
        $ins_fields["data"][$i]["value"] = $_REQUEST["$ins_id"];
      }

      else {
        if($fields["data"][$i]["options"] == 2) {
          $ins_fields["data"][$i]["value"] = $group;
        }

        elseif($fields["data"][$i]["options"] == 1)  {
          if(isset($tracker_info["writerGroupCanModify"]) and $tracker_info["writerGroupCanModify"] == 'y') {
            $tracker_info["authorgroupfield"] = $fid;
          }

          unset($ins_fields["data"][$i]["fieldId"]);
        }

        else {
          $ins_fields["data"][$i]["value"] = '';
        }
      }

      if(isset($_REQUEST["$filter_id"])) {
        $fields["data"][$i]["value"] = $_REQUEST["$filter_id"];
      }

      else {
        $fields["data"][$i]["value"] = '';
      }

    }
    elseif($fields["data"][$i]["type"] == 'a' and isset($fields["data"][$i]["options_array"][2]))  {
      if(isset($_REQUEST["$ins_id"])) {
        if(isset($fields["data"][$i]["options_array"][3]) and $fields["data"][$i]["options_array"][3] > 0 and strlen($_REQUEST["$ins_id"]) > $fields["data"][$i]["options_array"][3]) {
          if(function_exists('mb_substr')) {
            $ins_fields["data"][$i]["value"] = mb_substr($_REQUEST["$ins_id"],0,$fields["data"][$i]["options_array"][3])." (...)";
          }

          else {
            $ins_fields["data"][$i]["value"] = substr($_REQUEST["$ins_id"],0,$fields["data"][$i]["options_array"][3])." (...)";
          }
        }

        else {
          $ins_fields["data"][$i]["value"] = $_REQUEST["$ins_id"];
        }
      }

      else {
        $ins_fields["data"][$i]["value"] = '';
      }

      if(isset($_REQUEST["$filter_id"])) {
        $fields["data"][$i]["value"] = $_REQUEST["$filter_id"];
      }

      else {
        $fields["data"][$i]["value"] = '';
      }

      if(1 or $fields["data"][$i]["options_array"][0]) {
        $textarea_options = true;
      }

    }
    elseif($fields["data"][$i]["type"] == 'y') {  // country list
      if(isset($_REQUEST["$ins_id"])) {
        $ins_fields["data"][$i]["value"] = $_REQUEST["$ins_id"];
      }

      // Get flags here
      $flags = array();
      $h = opendir("img/flags/");

      while($file = readdir($h)) {
        if(strstr($file, ".gif")) {
          $parts = explode('.', $file);
          $flags[] = $parts[0];
        }
      }

      closedir($h);
      sort($flags, SORT_STRING);
      $ins_fields["data"][$i]['flags'] = $flags;

    }

    else {

      if(isset($_REQUEST["$ins_id"])) {
        $ins_fields["data"][$i]["value"] = $_REQUEST["$ins_id"];
      }

      else {
        $ins_fields["data"][$i]["value"] = '';
      }

      if($ins_fields['data'][$i]['type'] == 'D' && !empty($_REQUEST[$ins_id.'_other'])) {  // drop down with other
        $ins_fields['data'][$i]['value'] = $_REQUEST[$ins_id.'_other'];
      }

      if(isset($_REQUEST["$filter_id"])) {
        $fields["data"][$i]["value"] = $_REQUEST["$filter_id"];
      }

      else {
        $fields["data"][$i]["value"] = '';
      }

      if($fields["data"][$i]["type"] == 'i') {
        if(isset($_FILES["$ins_id"]) && is_uploaded_file($_FILES["$ins_id"]['tmp_name'])) {
          if(!empty($gal_match_regex)) {
            if(!preg_match("/$gal_match_regex/", $_FILES["$ins_id"]['name'], $reqs)) {
              $smarty->assign('msg', tra('Invalid imagename (using filters for filenames)'));
              $smarty->display("error.tpl");
              die;
            }
          }

          if(!empty($gal_nmatch_regex)) {
            if(preg_match("/$gal_nmatch_regex/", $_FILES["$ins_id"]['name'], $reqs)) {
              $smarty->assign('msg', tra('Invalid imagename (using filters for filenames)'));
              $smarty->display("error.tpl");
              die;
            }
          }

          $fp = fopen($_FILES["$ins_id"]['tmp_name'], 'rb');
          $data = '';

          while(!feof($fp)) {
            $data .= fread($fp, 8192 * 16);
          }

          fclose($fp);
          $ins_fields["data"][$i]["value"] = $data;

          //$ins_fields["data"][$i]["value"] = $_FILES["$ins_id"]['name'];
          $ins_fields["data"][$i]["file_type"] = $_FILES["$ins_id"]['type'];//mime_content_type( $_FILES["$ins_id"]['tmp_name'] );
          $ins_fields["data"][$i]["file_size"] = $_FILES["$ins_id"]['size'];
          $ins_fields["data"][$i]["file_name"] = $_FILES["$ins_id"]['name'];
        }
      }
    }
  }
  elseif($xfields["data"][$i]["type"] == "u" and isset($xfields["data"][$i]["options"]) and $user and $xfields["data"][$i]["options"] == 1 and isset($tracker_info["writerCanModify"]) and $tracker_info["writerCanModify"] == 'y') {
    // even if field is hidden need to pick up user for perm
    $tracker_info["authorfield"] = $fid;
  }
  elseif($xfields["data"][$i]["type"] == "g" and isset($xfields["data"][$i]["options"]) and $group and $xfields["data"][$i]["options"] == 1 and isset($tracker_info["writerGroupCanModify"]) and $tracker_info["writerGroupCanModify"] == 'y') {
    // even if field hidden need to pick up the group for perm
    $tracker_info["authorgroupfield"] = $fid;
  }
}

if(isset($tracker_info["authorgroupfield"])) {
  $tracker_info['authorgroup'] = $trklib->get_item_value($_REQUEST["trackerId"],$_REQUEST["itemId"],$tracker_info["authorgroupfield"]);

  if($tracker_info['authorgroup'] == $group) {
    $tiki_p_modify_tracker_items = 'y';
    $smarty->assign("tiki_p_modify_tracker_items","y");
    $tiki_p_attach_trackers = 'y';
    $smarty->assign("tiki_p_attach_trackers","y");
    $tiki_p_comment_trackers = 'y';
    $smarty->assign("tiki_p_comment_trackers","y");
    $tiki_p_view_trackers = 'y';
    $smarty->assign("tiki_p_view_trackers","y");
  }
}

if(isset($tracker_info["authorfield"])) {
  $tracker_info['authorindiv'] = $trklib->get_item_value($_REQUEST["trackerId"],$_REQUEST["itemId"],$tracker_info["authorfield"]);

  if($tracker_info['authorindiv'] == $user or $tracker_info['authorindiv'] == '') {
    $tiki_p_modify_tracker_items = 'y';
    $smarty->assign("tiki_p_modify_tracker_items","y");
    $tiki_p_attach_trackers = 'y';
    $smarty->assign("tiki_p_attach_trackers","y");
    $tiki_p_comment_trackers = 'y';
    $smarty->assign("tiki_p_comment_trackers","y");
    $tiki_p_view_trackers = 'y';
    $smarty->assign("tiki_p_view_trackers","y");
  }
}

if($tiki_p_view_trackers != 'y' && !$special) {
  $smarty->assign('msg', tra("You do not have permission to use this feature"));
  $smarty->display("error.tpl");
  die;
}

if(!isset($mainfield)) {
  $mainfield = 0;
}

if($textarea_options) {
  include_once('lib/quicktags/quicktagslib.php');
  $quicktags = $quicktagslib->list_quicktags(0,-1,'taglabel_desc','','wiki');
  $smarty->assign('quicktags', $quicktags["data"]);
}

if($tiki_p_admin_trackers == 'y') {
  if(isset($_REQUEST["remove"])) {
    check_ticket('view-trackers-items');
    $trklib->remove_tracker_item($_REQUEST["remove"]);
  }
}

if($tiki_p_modify_tracker_items == 'y' || $special) {
  if(isset($_REQUEST["save"]) || isset($_REQUEST["save_return"])) {

    // Check field values for each type and presence of mandatory ones
    $mandatory_missing = array();
    $err_fields = array();
    $ins_categs = array();
    $categorized_fields = array();

    while(list($postVar, $postVal) = each($_REQUEST)) {
      if(preg_match("/^ins_cat_([0-9]+)/", $postVar, $m)) {
        foreach($postVal as $v)
        $ins_categs[] = $v;
        $categorized_fields[] = $m[1];
      }
    }

    $field_errors = $trklib->check_field_values($ins_fields, $categorized_fields);
    $smarty->assign('err_mandatory', $field_errors['err_mandatory']);
    $smarty->assign('err_value', $field_errors['err_value']);

    // values are OK, then lets save the item
    if(count($field_errors['err_mandatory']) == 0  && count($field_errors['err_value']) == 0) {

      $smarty->assign('input_err', '0'); // no warning to display

      check_ticket('view-trackers-items');

      if(!isset($_REQUEST["edstatus"]) or($tracker_info["showStatus"] != 'y' and $tiki_p_admin_trackers != 'y')) {
        $_REQUEST["edstatus"] = $tracker_info["modItemStatus"];
      }

      $trklib->replace_item($_REQUEST["trackerId"], $_REQUEST["itemId"], $ins_fields, $_REQUEST["edstatus"], $ins_categs);

      if(isset($_REQUEST["newItemRate"])) {
        $trklib->replace_rating($_REQUEST["trackerId"],$_REQUEST["itemId"],$rateFieldId,$user,$_REQUEST["newItemRate"]);
      }

      $mainfield = $ins_fields["data"][$mainfield]["value"];

      $_REQUEST['show']  = 'view';

      foreach($fields["data"] as $i=>$array) {
        if(isset($fields["data"][$i])) {
          $fid = $fields["data"][$i]["fieldId"];
          $ins_id = 'ins_' . $fid;
          $ins_fields["data"][$i]["value"] = '';
        }
      }
      $item_info = $trklib->get_tracker_item($_REQUEST["itemId"]);
      $smarty->assign('item_info', $item_info);
      $trklib->categorized_item($_REQUEST["trackerId"], $_REQUEST["itemId"], $mainfield, $ins_categs);
    }

    else {
      $error = $ins_fields;
      $tabi = "2";
      $smarty->assign('input_err', '1'); // warning to display

      // can't go back if there are errors
      if(isset($_REQUEST['save_return'])) {
        $_REQUEST['save'] = 'save';
        unset($_REQUEST['save_return']);
      }
    }

    if(isset($_REQUEST['from'])) {
      header('Location: tiki-index.php?page='.urlencode($_REQUEST['from']));
      exit;
    }
  }
}

// remove image from an image field
if(isset($_REQUEST["removeImage"])) {
  $img_field = array('data' => array());
  $img_field['data'][] = array('fieldId' => $_REQUEST["fieldId"], 'type' => 'i', 'name' => $_REQUEST["fieldName"], 'value' => 'blank');
  $trklib->replace_item($_REQUEST["trackerId"], $_REQUEST["itemId"], $img_field);
  $_REQUEST['show'] = "mod";
}

// ************* return to list ***************************
if(isset($_REQUEST["returntracker"]) || isset($_REQUEST["save_return"])) {
  $urlreturn = "tiki-view_tracker.php?trackerId={$_REQUEST['trackerId']}&sort_mode={$_REQUEST['sort_mode']}&offset={$_REQUEST['offset']}";
  foreach($urlquery as $fldkey=>$fldval) {
    if($fldval) {
      $urlreturn .= "&{$fldkey}=".urlencode($fldval);
    }
  }
  header("Location: $urlreturn");
  die;
}

// ********************************************************

if(isset($tracker_info['useRatings']) and $tracker_info['useRatings'] == 'y' and $tiki_p_tracker_view_ratings == 'y') {
  if($user and $tiki_p_tracker_vote_ratings == 'y' and isset($_REQUEST['rate']) and isset($_REQUEST['fieldId'])) {
    $trklib->replace_rating($_REQUEST['trackerId'],$_REQUEST['itemId'],$_REQUEST['fieldId'],$user,$_REQUEST["rate"]);
    header('Location: tiki-view_tracker_item.php?trackerId='.$_REQUEST['trackerId'].'&itemId='.$_REQUEST['itemId']);
  }

  $my_rate = $tikilib->get_user_vote("tracker.".$_REQUEST['trackerId'].'.'.$_REQUEST['itemId'],$user);
  $smarty->assign('my_rate',$my_rate);
}

if($_REQUEST["itemId"]) {
  $info = $trklib->get_tracker_item($_REQUEST["itemId"]);

  if(!isset($info['trackerId'])) $info['trackerId'] = $_REQUEST['trackerId'];

  if((isset($info['status']) and $info['status'] == 'p' && !$tikilib->user_has_perm_on_object($user, $info['trackerId'], 'tracker', 'tiki_p_view_trackers_pending'))
      || (isset($info['status']) and $info['status'] == 'c' && !$tikilib->user_has_perm_on_object($user, $info['trackerId'], 'tracker', 'tiki_p_view_trackers_closed'))
      || ($tiki_p_admin_trackers != 'y' && !$tikilib->user_has_perm_on_object($user, $info['trackerId'], 'tracker', 'tiki_p_view_trackers') &&
          (!isset($utid) || $_REQUEST['trackerId'] != $utid['usersTrackerId']) &&
          (!isset($gtid) || $_REQUEST['trackerId'] != $utid['groupTrackerId'])
         )) {
    $smarty->assign('msg', tra('Permission denied'));
    $smarty->display('error.tpl');
    die;
  }

  $last = array();
  $lst = '';

  foreach($xfields["data"] as $i=>$array) {
    if($xfields["data"][$i]['isHidden'] != 'y' or $tiki_p_admin_trackers == 'y') {
      $fields["data"][$i] = $xfields["data"][$i];

      if($fields["data"][$i]["type"] != 'h') {
        $fid = $fields["data"][$i]["fieldId"];
        $ins_fields["data"][$i]["id"] = $fid;

        if($fields["data"][$i]["type"] == 'c') {
          if(!isset($info["$fid"])) $info["$fid"] = 'n';
        }

        else {
          if(!isset($info["$fid"])) $info["$fid"] = '';
        }

        if($fields["data"][$i]["type"] == 'e') {
          global $categlib;
          include_once('lib/categories/categlib.php');
          $k = $fields["data"][$i]["options"];
          $ins_fields["data"][$i]["$k"] = $categlib->get_child_categories($k);

          if(!isset($cat)) {
            $cat = $categlib->get_object_categories("tracker ".$_REQUEST["trackerId"],$_REQUEST["itemId"]);
          }

          if(isset($_REQUEST['save']) || isset($_REQUEST['save_return'])) {
            foreach($ins_categs as $c) {
              $ins_fields['data'][$i]['cat']["$c"] = 'y';
            }
          }

          else {
            foreach($cat as $c) {
              $ins_fields['data'][$i]['cat']["$c"] = 'y';
            }
          }
        }

        elseif($fields["data"][$i]["type"] == 'l') {
          if(isset($fields["data"][$i]["options_array"][3])) {

            //if (isset($last["{$fields["data"][$i]["options_array"][2]}"])) {
            if(isset($last[$fields["data"][$i]["options_array"][2]])) {
              //$lst = $last["{$fields["data"][$i]["options_array"][2]}"];
              $lst = $last[$fields["data"][$i]["options_array"][2]];
            }

            else {
              $lst = $trklib->get_item_value($_REQUEST['trackerId'], $_REQUEST['itemId'],
                                             $fields["data"][$i]["options_array"][2]);
            }

            $ins_fields["data"][$i]['links'] = array();

            if($lst) {
              $links = $trklib->get_items_list($fields["data"][$i]["options_array"][0],$fields["data"][$i]["options_array"][1],$lst);
              foreach($links as $link) {
                $ins_fields["data"][$i]['links'][$link] = $trklib->get_item_value($fields["data"][$i]["options_array"][0],$link,$fields["data"][$i]["options_array"][3]);
              }
              $ins_fields["data"][$i]['trackerId'] = $fields["data"][$i]["options_array"][0];
            }
          }

          //ob_start();var_dump($last);$output = ob_get_contents();ob_end_clean();
          //$ins_fields["data"][$i]["links"][] = $output;
        }
        elseif($fields["data"][$i]["type"] == 'r') {
          $ins_fields["data"][$i]["linkId"] = $trklib->get_item_id($fields["data"][$i]["options_array"][0],$fields["data"][$i]["options_array"][1],$info[$fid]);
          $ins_fields["data"][$i]["value"] = $info[$fid];

          if($tiki_p_admin_trackers == 'y') {
            $stt = 'opc';
          }

          else {
            $stt = 'o';
          }

          $ins_fields["data"][$i]["list"] = $trklib->get_all_items($fields["data"][$i]["options_array"][0],$fields["data"][$i]["options_array"][1],$stt);
        }
        elseif($fields["data"][$i]["type"] == 'u') {
          if($fields["data"][$i]['options'] == 2 and !$info["$fid"]) {
            $ins_fields["data"][$i]["defvalue"] = $user;
          }

          $ins_fields["data"][$i]["value"] = $info["$fid"];
        }
        elseif($fields["data"][$i]["type"] == 'g') {
          if($fields["data"][$i]['options'] == 2 and !$info["$fid"]) {
            $ins_fields["data"][$i]["defvalue"] = $group;
          }

          $ins_fields["data"][$i]["value"] = $info["$fid"];
        }
        elseif($fields["data"][$i]["type"] == 'a') {
          $ins_fields["data"][$i]["value"] = $info["$fid"];
          $ins_fields["data"][$i]["pvalue"] = $tikilib->parse_data(htmlspecialchars($info["$fid"]));
        }

        else {
          $ins_fields["data"][$i]["value"] = $info["$fid"];
        }

        if($fields['data'][$i]['type'] == 'i' && !empty($ins_fields["data"][$i]['options_array'][2]) && !empty($ins_fields['data'][$i]['value'])) {
          global $imagegallib;
          include_once('lib/imagegals/imagegallib.php');

          if($imagegallib->readimagefromfile($ins_fields['data'][$i]['value'])) {
            $imagegallib->getimageinfo();

            if(!isset($ins_fields["data"][$i]['options_array'][3]))
              $ins_fields["data"][$i]['options_array'][3] = 0;

            $t = $imagegallib->ratio($imagegallib->xsize, $imagegallib->ysize, $ins_fields["data"][$i]['options_array'][2], $ins_fields["data"][$i]['options_array'][3]);
            $ins_fields['data'][$i]['options_array'][2] = $t * $imagegallib->xsize;
            $ins_fields['data'][$i]['options_array'][3] = $t * $imagegallib->ysize;
          }
        }

        if(isset($ins_fields["data"][$i]["value"])) {
          $last[$fid] = $ins_fields["data"][$i]["value"];
        }
      }

      if($fields['data'][$i]['isMain'] == 'y')
        $smarty->assign('tracker_item_main_value', $ins_fields['data'][$i]['value']);
    }
  }

  /* **************** seems it is only 1.8
    for ($i = 0; $i < count($fields["data"]); $i++) {
      $name = $fields["data"][$i]["name"];

      $ins_name = 'ins_' . $name;
          if ($fields["data"][$i]['type'] == 'f') {
              $ins_fields["data"][$i]["value"] =
                      smarty_make_timestamp($info["$name"]);
          } else {
              $ins_fields["data"][$i]["value"] = $info["$name"];
          }
    }
  ******************* */
}

//restore types values if there is an error
if(isset($error)) {
  foreach($ins_fields["data"] as $i=>$array) {
    if(isset($error["data"][$i]["value"])) {
      $ins_fields["data"][$i]["value"] = $error["data"][$i]["value"];
    }
  }
}

// Do ID fills as necessary to support the showID stuff
if(isset($_REQUEST["itemId"]) && $_REQUEST["itemId"]) {
  $leadingZeroesId = str_pad($_REQUEST["itemId"], 9, '0', STR_PAD_LEFT);
  $hyphenatedId = substr($leadingZeroesId, 0, 3) . '-' . substr($leadingZeroesId, 3, 3) . '-' . substr($leadingZeroesId, 6);
  $smarty->assign('leadingZeroesId', $leadingZeroesId);
  $smarty->assign('hyphenatedId', $hyphenatedId);
}

$smarty->assign('trackerId', $_REQUEST["trackerId"]);
$smarty->assign('tracker_info', $tracker_info);
$smarty->assign_by_ref('info', $info);
$smarty->assign_by_ref('fields', $fields["data"]);
$smarty->assign_by_ref('ins_fields', $ins_fields["data"]);

$users = $userlib->list_all_users();
$smarty->assign_by_ref('users', $users);
$groups = $userlib->list_all_groups();
$smarty->assign_by_ref('groups', $groups);

$smarty->assign('mail_msg', '');
$smarty->assign('email_mon', '');

if($user) {
  if(isset($_REQUEST["monitor"])) {
    check_ticket('view-trackers-items');
    $user_email = $userlib->get_user_email($user);
    $emails = $notificationlib->get_mail_events('tracker_item_modified', $_REQUEST["itemId"]);

    if(in_array($user_email, $emails)) {
      $notificationlib->remove_mail_event('tracker_item_modified', $_REQUEST["itemId"], $user_email);
      $mail_msg = tra('Your email address has been removed from the list of addresses monitoring this item');
    }

    else {
      $notificationlib->add_mail_event('tracker_item_modified', $_REQUEST["itemId"], $user_email);
      $mail_msg = tra('Your email address has been added to the list of addresses monitoring this item');
    }

    $smarty->assign('mail_msg', $mail_msg);
  }

  $user_email = $userlib->get_user_email($user);
  $emails = $notificationlib->get_mail_events('tracker_item_modified', $_REQUEST["itemId"]);

  if(in_array($user_email, $emails)) {
    $smarty->assign('email_mon', tra('Cancel monitoring'));
  }

  else {
    $smarty->assign('email_mon', tra('Monitor'));
  }
}

if($tracker_info["useComments"] == 'y') {
  if($tiki_p_admin_trackers == 'y' and isset($_REQUEST["remove_comment"])) {
    $area = 'deltrackercomment';

    if($feature_ticketlib2 != 'y' or(isset($_POST['daconfirm']) and isset($_SESSION["ticket_$area"]))) {
      key_check($area);
      $trklib->remove_item_comment($_REQUEST["remove_comment"]);
    }

    else {
      key_get($area);
    }
  }

  if(isset($_REQUEST["commentId"])) {
    $comment_info = $trklib->get_item_comment($_REQUEST["commentId"]);
    $smarty->assign('comment_title', $comment_info["title"]);
    $smarty->assign('comment_data', $comment_info["data"]);
    $tabi = 2;
  }

  else {
    $_REQUEST["commentId"] = 0;
    $smarty->assign('comment_title', '');
    $smarty->assign('comment_data', '');
  }

  $smarty->assign('commentId', $_REQUEST["commentId"]);

  if($_REQUEST["commentId"] && $tiki_p_admin_trackers != 'y') {
    $_REQUEST["commentId"] = 0;
  }

  if($tiki_p_comment_tracker_items == 'y') {
    if(isset($_REQUEST["save_comment"])) {
      check_ticket('view-trackers-items');

      if(empty($user) && $feature_antibot == 'y' && (!isset($_SESSION['random_number']) || $_SESSION['random_number'] != $_REQUEST['antibotcode'])) {
        $smarty->assign('msg',tra("You have mistyped the anti-bot verification code; please try again."));
        $smarty->display("error.tpl");
        die;
      }

      $trklib->replace_item_comment($_REQUEST["commentId"], $_REQUEST["itemId"], $_REQUEST["comment_title"], $_REQUEST["comment_data"], $user);
      $smarty->assign('comment_title', '');
      $smarty->assign('comment_data', '');
      $smarty->assign('commentId', 0);
    }
  }

  $comments = $trklib->list_item_comments($_REQUEST["itemId"], 0, -1, 'posted_desc', '');
  $smarty->assign_by_ref('comments', $comments["data"]);
  $smarty->assign_by_ref('commentCount', $comments["cant"]);
}

if($tracker_info["useAttachments"] == 'y') {
  if(isset($_REQUEST["removeattach"])) {
    check_ticket('view-trackers-items');
    $owner = $trklib->get_item_attachment_owner($_REQUEST["removeattach"]);

    if(($user && ($owner == $user)) || ($tiki_p_wiki_admin_attachments == 'y')) {
      $area = 'deltrackerattach';

      if($feature_ticketlib2 != 'y' or(isset($_POST['daconfirm']) and isset($_SESSION["ticket_$area"]))) {
        key_check($area);
        $trklib->remove_item_attachment($_REQUEST["removeattach"]);
      }

      else {
        key_get($area);
      }
    }

    $_REQUEST["show"] = "att";
  }

  if(isset($_REQUEST["editattach"])) {
    $att = $trklib->get_item_attachment($_REQUEST["editattach"]);
    $smarty->assign("attach_comment", $att['comment']);
    $smarty->assign("attach_version", $att['version']);
    $smarty->assign("attach_longdesc", $att['longdesc']);
    $smarty->assign("attach_file", $att["filename"]);
    $smarty->assign("attId", $att["attId"]);
    $_REQUEST["show"] = "att";
  }

  if(isset($_REQUEST["attach"]) && ($tiki_p_attach_trackers == 'y')) {
    // Process an attachment here
    if(isset($_FILES['userfile1']) && is_uploaded_file($_FILES['userfile1']['tmp_name'])) {
      $fp = fopen($_FILES['userfile1']['tmp_name'], "rb");
      $data = '';
      $fhash = '';

      if($t_use_db == 'n') {
        $fhash = md5($name = $_FILES['userfile1']['name']);
        $fw = fopen($t_use_dir . $fhash, "wb");

        if(!$fw) {
          $smarty->assign('msg', tra('Cannot write to this file:'). $fhash);
          $smarty->display("error.tpl");
          die;
        }
      }

      while(!feof($fp)) {
        if($t_use_db == 'y') {
          $data .= fread($fp, 8192 * 16);
        }

        else {
          $data = fread($fp, 8192 * 16);
          fwrite($fw, $data);
        }
      }

      fclose($fp);

      if($t_use_db == 'n') {
        fclose($fw);
        $data = '';
      }

      $size = $_FILES['userfile1']['size'];
      $name = $_FILES['userfile1']['name'];
      $type = $_FILES['userfile1']['type'];
    }

    else {
      $name = "";
      $size = "";
      $type = "";
      $data = "";
      $fhash="";
    }

    if(empty($_REQUEST["attId"]) || $_REQUEST["attId"] == 0) {
      $trklib->item_attach_file($_REQUEST["itemId"], $name, $type, $size, $data, $_REQUEST["attach_comment"], $user, $fhash,$_REQUEST["attach_version"],$_REQUEST["attach_longdesc"]);
    }

    else {
      $trklib->replace_item_attachment($_REQUEST["attId"], $name, $type, $size, $data, $_REQUEST["attach_comment"], $user, $fhash,$_REQUEST["attach_version"],$_REQUEST["attach_longdesc"]);
    }

    $_REQUEST["attId"] = 0;
    $_REQUEST['show'] = "att";
  }

  // If anything below here is changed, please change lib/wiki-plugins/wikiplugin_attach.php as well.
  $attextra = 'n';

  if(strstr($tracker_info["orderAttachments"],'|')) {
    $attextra = 'y';
  }

  $attfields = split(',',strtok($tracker_info["orderAttachments"],'|'));
  $atts = $trklib->list_item_attachments($_REQUEST["itemId"], 0, -1, 'comment_asc', '');
  $smarty->assign('atts', $atts["data"]);
  $smarty->assign('attCount', $atts["cant"]);
  $smarty->assign('attfields', $attfields);
  $smarty->assign('attextra', $attextra);
}

if(isset($_REQUEST['show'])) {
  if($_REQUEST['show'] == 'view') {
    $tabi = 1;
  }

  elseif($tracker_info["useComments"] == 'y' and $_REQUEST['show'] == 'com') {
    $tabi = 2;
  }
  elseif($_REQUEST['show'] == "mod") {
    $tabi = 2;

    if($tracker_info["useAttachments"] == 'y') $tabi++;

    if($tracker_info["useComments"] == 'y') $tabi++;
  }
  elseif($_REQUEST['show'] == "att") {
    $tabi = 2;

    if($tracker_info["useComments"] == 'y') $tabi = 3;
  }
}

setcookie("tab",$tabi);
$smarty->assign('cookietab',$tabi);

if(isset($_REQUEST['from'])) {
  $from = $_REQUEST['from'];
}

else {
  $from = false;
}

$smarty->assign('from',$from);

$section = 'trackers';
include_once('tiki-section_options.php');

$smarty->assign('uses_tabs', 'y');

if($feature_jscalendar) {
  $smarty->assign('uses_jscalendar', 'y');
}

ask_ticket('view-trackers-items');

// Display the template
$smarty->assign('mid', 'tiki-view_tracker_item.tpl');
$smarty->display("tiki.tpl");

?>
