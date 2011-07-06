<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-view_tracker.php,v 1.72.2.82 2007/12/10 04:28:34 kerrnel22 Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once('tiki-setup.php');

include_once('lib/trackers/trackerlib.php');
global $notificationlib;
include_once('lib/notifications/notificationlib.php');

if($feature_categories == 'y') {
  global $categlib;

  if(!is_object($categlib)) {
    include_once('lib/categories/categlib.php');
  }
}

if($feature_trackers != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_trackers");
  $smarty->display("error.tpl");
  die;
}

$_REQUEST["itemId"] = 0;
$smarty->assign('itemId', $_REQUEST["itemId"]);

if(!isset($_REQUEST["trackerId"])) {
  $smarty->assign('msg', tra("No tracker indicated"));
  $smarty->display("error.tpl");
  die;
}

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

elseif($tiki_p_admin != 'y' && $feature_categories == 'y') {
  $perms_array = $categlib->get_object_categories_perms($user, 'tracker', $_REQUEST['trackerId']);

  if($perms_array) {
    $is_categorized = TRUE;
    foreach($perms_array as $perm => $value) {
      $$perm = $value;
    }

    if($tiki_p_view_categories == 'y' || $tiki_p_admin_categories == 'y') {
      $tiki_p_view_categories = 'y';
      $tiki_p_view_trackers = 'y';
      $smarty->assign('tiki_p_view_trackers', 'y');
    }
  }

  else {
    $is_categorized = FALSE;
  }

  if($is_categorized && isset($tiki_p_view_categories) && $tiki_p_view_categories != 'y') {
    if(!isset($user)) {
      $smarty->assign('msg',$smarty->fetch('modules/mod-login_box.tpl'));
      $smarty->assign('errortitle',tra("Please login"));
    }

    else {
      $smarty->assign('msg',tra("Permission denied you cannot view this page"));
    }

    $smarty->display("error.tpl");
    die;
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

if(!empty($_REQUEST['show']) && $_REQUEST['show'] == 'view') {
  $cookietab = '1';
}

elseif(!empty($_REQUEST['show']) && $_REQUEST['show'] == 'mod') {
  $cookietab = '2';
}
elseif(empty($_REQUEST['cookietab'])) {
  if(!($tiki_p_view_trackers == 'y' || $tiki_p_admin == 'y' || $tiki_p_admin_trackers == 'y') && $tiki_p_create_tracker_items  == 'y')
    $cookietab = "2";

  else
    $cookietab = "1";
}

else {
  $cookietab = $_REQUEST['cookietab'];
}

$defaultvalues = array();

if(isset($_REQUEST['vals']) and is_array($_REQUEST['vals'])) {
  $defaultvalues = $_REQUEST['vals'];
  $cookietab = "2";
}

elseif(isset($_REQUEST['new'])) {
  $cookietab = "2";
}
$smarty->assign('defaultvalues', $defaultvalues);

$my = '';
$ours = '';

if(isset($_REQUEST['my'])) {
  if($tiki_p_admin_trackers == 'y') {
    $my = $_REQUEST['my'];
  }

  elseif($user) {
    $my = $user;
  }
}

elseif(isset($_REQUEST['ours'])) {
  if($tiki_p_admin_trackers == 'y') {
    $ours = $_REQUEST['ours'];
  }

  elseif($group) {
    $ours = $group;
  }
}

$tracker_info = $trklib->get_tracker($_REQUEST["trackerId"]);

if(empty($tracker_info)) {
  $smarty->assign('msg', tra("No tracker indicated"));
  $smarty->display("error.tpl");
  die;
}

if($t = $trklib->get_tracker_options($_REQUEST["trackerId"]))
  $tracker_info = array_merge($tracker_info,$t);

if($tiki_p_view_trackers != 'y') {
  if(!$my and isset($tracker_info['writerCanModify']) and $tracker_info['writerCanModify'] == 'y') {
    $my = $user;
  }

  elseif(!$ours and isset($tracker_info['writergroupCanModify']) and $tracker_info['writergroupCanModify'] == 'y') {
    $ours = $group;
  }
  elseif($tiki_p_create_tracker_items != 'y') {
    if(!isset($user)) {
      $smarty->assign('msg',$smarty->fetch('modules/mod-login_box.tpl'));
      $smarty->assign('errortitle',tra("Please login"));
    }

    else {
      $smarty->assign('msg', tra("You do not have permission to use this feature"));
    }

    $smarty->display("error.tpl");
    die;
  }
}

$smarty->assign('my', $my);
$smarty->assign('ours', $ours);

$field_types = $trklib->field_types();
$smarty->assign('field_types', $field_types);

$status_types = array();
$status_raw = $trklib->status_types();

if(isset($_REQUEST['status'])) {
  $sts = preg_split('//', $_REQUEST['status'], -1, PREG_SPLIT_NO_EMPTY);
}

elseif(isset($tracker_info["defaultStatus"])) {
  $sts = preg_split('//', $tracker_info["defaultStatus"], -1, PREG_SPLIT_NO_EMPTY);
  $_REQUEST['status'] = $tracker_info["defaultStatus"];
}

else {
  $sts = array('o');
  $_REQUEST['status'] = 'o';
}

foreach($status_raw as $let=>$sta) {
  if((isset($$sta['perm']) and $$sta['perm'] == 'y') or($my or $ours)) {
    if(in_array($let,$sts)) {
      $sta['class'] = 'statuson';
      $sta['statuslink'] = str_replace($let,'',implode('',$sts));
    }

    else {
      $sta['class'] = 'statusoff';
      $sta['statuslink'] = implode('',$sts).$let;
    }

    $status_types["$let"] = $sta;
  }
}
$smarty->assign('status_types', $status_types);

if(count($status_types) == 0) {
  $tracker_info["showStatus"] = 'n';
}

$xfields = $trklib->list_tracker_fields($_REQUEST["trackerId"], 0, -1, 'position_asc', '');

if(!empty($tracker_info['showPopup'])) {
  $popupFields = explode(',', $tracker_info['showPopup']);
  $smarty->assign_by_ref('popupFields', $popupFields);
}

else {
  $popupFields = array();
}

$writerfield = '';
$writergroupfield = '';
$mainfield = '';
$orderkey = false;
$listfields = array();

$usecategs = false;
$ins_categs = array();
$textarea_options = false;

$counter=0;
$temp_max = count($xfields["data"]);

for($i = 0; $i < $temp_max; $i++) {
  $fid = $xfields["data"][$i]["fieldId"];

  $ins_id = 'ins_' . $fid;
  $xfields["data"][$i]["ins_id"] = $ins_id;
  $xfields["data"][$i]["id"] = $fid;

  $filter_id = 'filter_' . $fid;
  $xfields["data"][$i]["filter_id"] = $filter_id;

  if(!empty($tracker_info['defaultOrderKey']) and $tracker_info['defaultOrderKey'] == $xfields["data"][$i]['fieldId']) {
    $orderkey = true;
  }

  if(($xfields["data"][$i]['isTblVisible'] == 'y' or $xfields["data"][$i]['isSearchable'] == 'y' or in_array($fid, $popupFields))
//    and ($xfields["data"][$i]['isPublic'] == 'y' or $tiki_p_admin_trackers == 'y') ispublic is for tracker plugin not normal view
      and($xfields["data"][$i]['isHidden'] == 'n' or $xfields["data"][$i]['isHidden'] == '-' or $tiki_p_admin_trackers == 'y')
    ) {

    $listfields[$fid]['type'] = $xfields["data"][$i]["type"];
    $listfields[$fid]['name'] = $xfields["data"][$i]["name"];
    $listfields[$fid]['options'] = $xfields["data"][$i]["options"];
    $listfields[$fid]['options_array'] = split(',',$xfields["data"][$i]["options"]);
    $listfields[$fid]['isMain'] = $xfields["data"][$i]["isMain"];
    $listfields[$fid]['isTblVisible'] = $xfields["data"][$i]["isTblVisible"];
    $listfields[$fid]['isHidden'] = $xfields["data"][$i]["isHidden"];
    $listfields[$fid]['isSearchable'] = $xfields["data"][$i]["isSearchable"];

    if($listfields[$fid]['type'] == 'e') {  //category
      $parentId = $listfields[$fid]["options"];
      $listfields[$fid]['categories'] = $categlib->get_child_categories($parentId);
    }

  }

  if(($xfields["data"][$i]['isHidden'] == 'n' or $xfields["data"][$i]['isHidden'] == '-') or $tiki_p_admin_trackers == 'y') {
    $ins_fields["data"][$i] = $xfields["data"][$i];
    $fields["data"][$i] = $xfields["data"][$i];

    if($fields["data"][$i]["type"] == 'f') {  // date and time
      $fields["data"][$i]["value"] = '';
      $ins_fields["data"][$i]["value"] = '';

      if(isset($_REQUEST["$ins_id" . "Day"])) {
        $dc = $tikilib->get_date_converter($user);
        $ins_fields["data"][$i]["value"] = $dc->getServerDateFromDisplayDate(mktime($_REQUEST["$ins_id" . "Hour"], $_REQUEST["$ins_id" . "Minute"],
                                           0, $_REQUEST["$ins_id" . "Month"], $_REQUEST["$ins_id" . "Day"], $_REQUEST["$ins_id" . "Year"]));
      }

      else {
        $ins_fields["data"][$i]["value"] = date("U");
      }
    }

    elseif($fields["data"][$i]["type"] == 'e') {  // category
      include_once('lib/categories/categlib.php');
      $parentId = $fields["data"][$i]["options"];
      $fields["data"][$i]['categories'] = $categlib->get_child_categories($parentId);
      $categId = "ins_cat_$fid";

      if(isset($_REQUEST[$categId])) {
        if(is_array($_REQUEST[$categId])) {
          foreach($_REQUEST[$categId] as $c)
          $fields["data"][$i]['cat'][$c] = 'y';
          $ins_categs = array_merge($ins_categs, $_REQUEST[$categId]);
        }

        else {
          $fields["data"][$i]['cat'][$_REQUEST[$categId]] = 'y';
          $ins_categs[] = $_REQUEST[$categId];
        }
      }

      $ins_fields["data"][$i]["value"] = '';

    }
    elseif($fields["data"][$i]["type"] == 'u') {  // user selection
      if(isset($_REQUEST["$ins_id"]) and $_REQUEST["$ins_id"] and(!$fields["data"][$i]["options"] or $tiki_p_admin_trackers == 'y')) {
        $ins_fields["data"][$i]["value"] = $_REQUEST["$ins_id"];
      }

      else {
        if($fields["data"][$i]["options"] == 1 and $user) {
          $ins_fields["data"][$i]["value"] = $user;
        }

        else {
          $ins_fields["data"][$i]["value"] = '';
        }
      }

      if($fields["data"][$i]["options"] == 1 and !$writerfield) {
        $writerfield = $fid;
      }

      elseif(isset($_REQUEST["$filter_id"])) {
        $fields["data"][$i]["value"] = $_REQUEST["$filter_id"];
      }

      else {
        $fields["data"][$i]["value"] = '';
      }

    }
    elseif($fields["data"][$i]["type"] == 'g') {  // group selection
      if(isset($_REQUEST["$ins_id"]) and $_REQUEST["$ins_id"] and(!$fields["data"][$i]["options"] or $tiki_p_admin_trackers == 'y')) {
        $ins_fields["data"][$i]["value"] = $_REQUEST["$ins_id"];
      }

      else {
        if($fields["data"][$i]["options"] == 1 and $group) {
          $ins_fields["data"][$i]["value"] = $group;
        }

        else {
          $ins_fields["data"][$i]["value"] = '';
        }
      }

      if($fields["data"][$i]["options"] == 1 and !$writergroupfield) {
        $writergroupfield = $fid;
      }

      elseif(isset($_REQUEST["$filter_id"])) {
        $fields["data"][$i]["value"] = $_REQUEST["$filter_id"];
      }

      else {
        $fields["data"][$i]["value"] = '';
      }

    }
    elseif($fields["data"][$i]["type"] == 'c') {  // checkbox
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
    elseif($fields["data"][$i]["type"] == 'a') {  // textarea
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

      if($fields["data"][$i]["options_array"][0])  {
        $textarea_options = true;
      }

    }
    elseif($fields["data"][$i]["type"] == 's') { // system - special
      if($fields["data"][$i]["name"] == "Rating") {  // Rating
        if(isset($_REQUEST["$ins_id"])) {
          $newItemRate = $_REQUEST["$ins_id"];
          $newItemRateField = $fields["data"]["$i"]["fieldId"];
        }

        else {
          $newItemRate = NULL;
        }
      } // Do nothing for "ItemID" here.

    }
    elseif($fields["data"][$i]["type"] == 'y') {    // country list
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
      $fields["data"][$i]['flags'] = $flags;
      $fields["data"][$i]['defaultvalue'] = 'None';

    }

    else {
      if(isset($_REQUEST["$ins_id"])) {
        $ins_fields["data"][$i]["value"] = $_REQUEST["$ins_id"];
      }

      else {
        $ins_fields["data"][$i]["value"] = '';
      }

      if($fields['data'][$i]['type'] == 'D' && !empty($_REQUEST[$ins_id.'_other'])) {  // drop down with other
        $ins_fields['data'][$i]['value'] = $_REQUEST[$ins_id.'_other'];
      }

      if(isset($_REQUEST["$filter_id"])) {
        $fields["data"][$i]["value"] = $_REQUEST["$filter_id"];
      }

      else {
        $fields["data"][$i]["value"] = '';
      }

      if($fields["data"][$i]["type"] == 'r') {  // item link
        if($tiki_p_admin_trackers == 'y') {
          $stt = 'opc';
        }

        else {
          $stt = 'o';
        }

        $fields["data"][$i]["list"] = $trklib->get_all_items($fields["data"][$i]["options_array"][0],$fields["data"][$i]["options_array"][1],$stt);
      }

      elseif($fields["data"][$i]["type"] == 'i') {  // image
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
          //$fhash = md5($name = $_FILES["$ins_id"]['name']);
          $data = '';

          while(!feof($fp)) {
            $data .= fread($fp, 8192 * 16);
          }

          fclose($fp);
          $ins_fields["data"][$i]["value"] = $data;
          $ins_fields['data'][$i]['file_type'] = $_FILES["$ins_id"]['type'];
          //$ins_fields["data"][$i]["value"] = $_FILES["$ins_id"]['name'];
          $ins_fields["data"][$i]["file_size"] = $_FILES["$ins_id"]['size'];
          $ins_fields["data"][$i]["file_name"] = $_FILES["$ins_id"]['name'];
        }
      }
    }
  }

  // store values to have them available when there is
  // an error in the values typed by an user for a field type.
  if(isset($fields['data'][$i]['fieldId']))
    $fields['data'][$i]['value'] = isset($ins_fields['data'][$i]['value'])?$ins_fields['data'][$i]['value']: '';

  if(empty($mainfield) and isset($fields['data'][$i]['isMain']) && $fields["data"][$i]["isMain"] == 'y' and !empty($fields["data"][$i]["value"])) {
    $mainfield = $fields["data"][$i]["value"];
  }

}

if($textarea_options) {
  include_once('lib/quicktags/quicktagslib.php');
  $quicktags = $quicktagslib->list_quicktags(0,-1,'taglabel_desc','','wiki');
  $smarty->assign_by_ref('quicktags', $quicktags["data"]);
}

if($tiki_p_admin_trackers == 'y' and isset($_REQUEST["remove"])) {
  $area = 'deltrackeritem';

  if($feature_ticketlib2 != 'y' or(isset($_POST['daconfirm']) and isset($_SESSION["ticket_$area"]))) {
    key_check($area);
    $trklib->remove_tracker_item($_REQUEST["remove"]);
  }

  else {
    key_get($area);
  }
}


$smarty->assign('mail_msg', '');
$smarty->assign('email_mon', '');

if($user) {
  if(isset($_REQUEST["monitor"])) {
    check_ticket('view-trackers');
    $user_email = $userlib->get_user_email($user);
    $emails = $notificationlib->get_mail_events('tracker_modified', $_REQUEST["trackerId"]);

    if(in_array($user_email, $emails)) {
      $notificationlib->remove_mail_event('tracker_modified', $_REQUEST["trackerId"], $user_email);
      $mail_msg = tra('Your email address has been removed from the list of addresses monitoring this tracker');
    }

    else {
      $notificationlib->add_mail_event('tracker_modified', $_REQUEST["trackerId"], $user_email);
      $mail_msg = tra('Your email address has been added to the list of addresses monitoring this tracker');
    }

    $smarty->assign('mail_msg', $mail_msg);
  }

  $user_email = $userlib->get_user_email($user);
  $emails = $notificationlib->get_mail_events('tracker_modified', $_REQUEST["trackerId"]);

  if(in_array($user_email, $emails)) {
    $smarty->assign('email_mon', 'Cancel monitoring');
  }

  else {
    $smarty->assign('email_mon', 'Monitor');
  }
}

if(isset($_REQUEST['import'])) {
  if(isset($_FILES['importfile']) && is_uploaded_file($_FILES['importfile']['tmp_name'])) {
    $fp = fopen($_FILES['importfile']['tmp_name'], "rb");
    $trklib->import_items($_REQUEST["trackerId"],$_REQUEST["indexfield"],$fp);
    fclose($fp);
  }
}

elseif(isset($_REQUEST["save"])) {

  if($tiki_p_create_tracker_items == 'y') {

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

    // values are OK, then lets add a new item
    if(count($field_errors['err_mandatory']) == 0  && count($field_errors['err_value']) == 0) {

      $smarty->assign('input_err', '0'); // no warning to display

      check_ticket('view-trackers');

      if(empty($user) && $feature_antibot == 'y' && (!isset($_SESSION['random_number']) || $_SESSION['random_number'] != $_REQUEST['antibotcode'])) {
        $smarty->assign('msg',tra("You have mistyped the anti-bot verification code; please try again."));
        $smarty->display("error.tpl");
        die;
      }

      if(!isset($_REQUEST["status"]) or($tracker_info["showStatus"] != 'y' and $tiki_p_admin_trackers != 'y')) {
        $_REQUEST["status"] = '';
      }

      $itemid = $trklib->replace_item($_REQUEST["trackerId"], $_REQUEST["itemId"], $ins_fields, $_REQUEST['status'], $ins_categs);
      $cookietab = "1";
      $smarty->assign('itemId', '');
      $trklib->categorized_item($_REQUEST["trackerId"], $itemid, $mainfield, $ins_categs);

      if(isset($newItemRate)) {
        $trackerId = $_REQUEST["trackerId"];
        $trklib->replace_rating($trackerId,$itemid,$newItemRateField,$user,$newItemRate);
      }

      if(isset($_REQUEST["viewitem"])) {
        header("location: tiki-view_tracker_item.php?trackerId=".$_REQUEST["trackerId"]."&itemId=".$itemid);
        die;
      }

      if(isset($tracker_info["defaultStatus"])) {
        $_REQUEST['status'] = $tracker_info["defaultStatus"];
      }
    }

    else {
      $cookietab = "2";
      $smarty->assign('input_err', '1'); // warning to display
    }
  }
}

if(!isset($_REQUEST["sort_mode"])) {
  if(isset($tracker_info['defaultOrderKey'])) {
    if($tracker_info['defaultOrderKey'] == -1)
      $sort_mode = 'lastModif';

    elseif($tracker_info['defaultOrderKey'] == -2)
    $sort_mode = 'created';
    elseif($orderkey) {
      $sort_mode = 'f_'.$tracker_info['defaultOrderKey'];
    }

    else {
      $sort_mode = 'lastModif';
    }

    if(!empty($sort_mode)) {
      if(isset($tracker_info['defaultOrderDir'])) {
        $sort_mode.= "_".$tracker_info['defaultOrderDir'];
      }

      else {
        $sort_mode.= "_asc";
      }
    }

    else {
      $sort_mode = '';
    }
  }

  else {
    $sort_mode = '';
  }
}

else {
  $sort_mode = $_REQUEST["sort_mode"];
}

$sorts = split('_',$sort_mode);

if(is_array($sorts) and isset($sorts[1]) and isset($listfields["{$sorts[1]}"]['type']) and($listfields["{$sorts[1]}"]['type'] == 'n' or $listfields["{$sorts[1]}"]['type'] == 'q')) {
  $numsort = true;
}

else {
  $numsort = false;
}

$smarty->assign_by_ref('sort_mode', $sort_mode);

if(!isset($_REQUEST["offset"])) {
  $offset = 0;
}

else {
  $offset = $_REQUEST["offset"];
}

$smarty->assign_by_ref('offset', $offset);

if(!empty($_REQUEST["maxRecords"])) {
  $maxRecords = $_REQUEST['maxRecords'];
  $smarty->assign('maxRecords', $maxRecords);
}

if(isset($_REQUEST["initial"])) {
  $initial = $_REQUEST["initial"];
}

else {
  $initial = '';
}

$smarty->assign('initial', $initial);
$smarty->assign('initials', split(' ','a b c d e f g h i j k l m n o p q r s t u v w x y z'));

if(empty($_REQUEST['initialFieldId'])) {
  $_REQUEST['initialFieldId'] = $trklib->get_initial_field($listfields, $sort_mode);
}

$smarty->assign('initialFieldId', $_REQUEST['initialFieldId']);

if($my and $writerfield) {
  $filterfield = $writerfield;
}

elseif($ours and $writergroupfield) {
  $filterfield = $writergroupfield;
}

else {
  if(isset($_REQUEST["filterfield"])) {
    $filterfield = $_REQUEST["filterfield"];
  }

  else {
    $filterfield = '';
  }
}

$smarty->assign('filterfield', $filterfield);

if($my and $writerfield) {
  $exactvalue = $my;
  $filtervalue = '';
  $_REQUEST['status'] = 'opc';
}

elseif($ours and $writergroupfield) {
  $exactvalue = $ours;
  $filtervalue = '';
  $_REQUEST['status'] = 'opc';
}

else {
  if(isset($_REQUEST["filtervalue"]) and is_array($_REQUEST["filtervalue"]) and isset($_REQUEST["filtervalue"]["$filterfield"])) {
    $filtervalue = $_REQUEST["filtervalue"]["$filterfield"];
  }

  else if(isset($_REQUEST["filtervalue"])) {
    $filtervalue = $_REQUEST["filtervalue"];
  }

  else {
    $filtervalue = '';
  }

  if(isset($_REQUEST['filtervalue_other'])) {
    $filtervalue = $_REQUEST['filtervalue_other'];
  }

  $exactvalue = '';
}

$smarty->assign('filtervalue', $filtervalue);


$smarty->assign('status', $_REQUEST["status"]);

// this isn't too beautiful, but works and doesn't break anything existing - amette
if(isset($_REQUEST["trackerId"])) $trackerId = $_REQUEST["trackerId"];

if(isset($_REQUEST["rateitemId"])) $rate_itemId = $_REQUEST["rateitemId"];

if(isset($tracker_info['useRatings']) and $tracker_info['useRatings'] == 'y'
    and $user and isset($_REQUEST['rateitemId']) and isset($_REQUEST["rate_$trackerId"])
    and isset($_REQUEST['fieldId']) and isset($_REQUEST["trackerId"])
    and in_array($_REQUEST["rate_$trackerId"],split(',',$tracker_info['ratingOptions']))) {
  if($_REQUEST["rate_$trackerId"] == 'NULL') $_REQUEST["rate_$trackerId"] = NULL;

  $trklib->replace_rating($trackerId,$rate_itemId,$_REQUEST['fieldId'],$user,$_REQUEST["rate_$trackerId"]);
}

$items = $trklib->list_items($_REQUEST["trackerId"], $offset, $maxRecords, $sort_mode, $listfields, $filterfield, $filtervalue, $_REQUEST["status"],$initial,$exactvalue,$numsort, $_REQUEST['initialFieldId']);
//var_dump($_REQUEST["trackerId"], $offset, $maxRecords, $sort_mode, $listfields, $filterfield, $filtervalue, $_REQUEST["status"],$initial,$exactvalue,$numsort);
//die;
//var_dump($items);die();
$urlquery['status'] = $_REQUEST["status"];
$urlquery['initial'] = $initial;
$urlquery['trackerId'] = $_REQUEST["trackerId"];
$urlquery['sort_mode'] = $sort_mode;
$urlquery['exactvalue'] = $exactvalue;
$urlquery['filterfield'] = $filterfield;

if(is_array($filtervalue)) {
  foreach($filtervalue as $fil) {
    $urlquery["filtervalue[".$filterfield."][]"] = $fil;
  }
}

else {
  $urlquery["filtervalue[".$filterfield."]"] = $filtervalue;
}

$smarty->assign_by_ref('urlquery', $urlquery);
$cant = $items['cant'];
include "tiki-pagination.php";

if($tracker_info['useComments'] == 'y' && $tracker_info['showComments'] == 'y') {
  foreach($items['data'] as $itkey=>$oneitem) {
    $items['data'][$itkey]['comments'] = $trklib->get_item_nb_comments($items['data'][$itkey]['itemId']);
  }
}

if($tracker_info['useAttachments'] == 'y' && $tracker_info['showAttachments'] == 'y') {
  foreach($items["data"] as $itkey=>$oneitem) {
    $res = $trklib->get_item_nb_attachments($items["data"][$itkey]['itemId']);
    $items["data"][$itkey]['attachments']  = $res['attachments'];
    $items["data"][$itkey]['downloads'] = $res['downloads'];
  }
}

// If the special system ItemID field is set, then
// generate static item ID's
foreach($items["data"] as $itkey=>$oneitem) {
  foreach($oneitem['field_values'] as $ifld=>$valfld) {
    if($valfld['type'] == 's' && $valfld['name'] == "ItemID") {
      $items["data"][$itkey]['field_values'][$ifld]['value'] = $oneitem['itemId'];
    }
  }
}

$smarty->assign('trackerId', $_REQUEST["trackerId"]);
$smarty->assign('tracker_info', $tracker_info);

if(isset($fields['data']))
  $smarty->assign('fields', $fields['data']);

$smarty->assign_by_ref('items', $items["data"]);
$smarty->assign_by_ref('item_count', $items['cant']);
$smarty->assign_by_ref('listfields', $listfields);

$users = $userlib->list_all_users();
$groups = $userlib->list_all_groups();
$smarty->assign('users', $users);
$smarty->assign('groups', $groups);

$section = 'trackers';
include_once('tiki-section_options.php');

$smarty->assign('uses_tabs', 'y');

if($feature_jscalendar) {
  $smarty->assign('uses_jscalendar', 'y');
}

$smarty->assign('show_filters', 'n');

if(isset($fields['data']) && count($fields['data'])>0) {
  foreach($fields['data'] as $it) {
    if($it['isSearchable'] == 'y' and $it['isTblVisible'] == 'y') {
      $smarty->assign('show_filters', 'y');
      break;
    }
  }
}

// Set special system field vars
if($items['data']) {
  foreach($items['data'] as $f=>$v) {
    $items['data'][$f]['my_rate'] = $tikilib->get_user_vote("tracker.".$_REQUEST["trackerId"].'.'.$items['data'][$f]['itemId'],$user);
    $items['data'][$f]['ItemID']['value'] = $f;
  }
}

setcookie('tab',$cookietab);
$smarty->assign('cookietab',$cookietab);

ask_ticket('view-trackers');

// Display the template
$smarty->assign('mid', 'tiki-view_tracker.tpl');
$smarty->display("tiki.tpl");
//echo "<!-- ";var_dump($filtervalue); echo " -->";
?>
