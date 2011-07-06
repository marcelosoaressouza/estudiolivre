<?php
// $Header: /cvsroot/tikiwiki/tiki/tiki-calendar.php,v 1.38.2.54 2007/05/14 18:29:44 nkoth Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.

// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
require_once('tiki-setup.php');

include_once('lib/calendar/calendarlib.php');
include_once('lib/categories/categlib.php');
include_once('lib/newsletters/nllib.php');

# perms are
#   $tiki_p_view_calendar
#   $tiki_p_admin_calendar
#   $tiki_p_change_events
#   $tiki_p_add_events

if($feature_calendar != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_calendar");
  $smarty->display("error.tpl");
  die;
}

$bufid = array();
$bufdata = array();
$modifiable = array();
$cookietab = 1;
$rawcals = $calendarlib->list_calendars();
$viewOneCal = $tiki_p_view_calendar;
$modifTab = 0;

if($feature_theme_control == 'y' and isset($_REQUEST['calIds'])) {
  $cat_type = "calendar";
  $cat_objid = $_REQUEST['calIds'][0];
  include('tiki-tc.php');
}

foreach($rawcals["data"] as $cal_id=>$cal_data) {
  if($tiki_p_admin == 'y') {
    $cal_data["tiki_p_view_calendar"] = 'y';
    $cal_data["tiki_p_add_events"] = 'y';
    $cal_data["tiki_p_change_events"] = 'y';
  }

  elseif($cal_data["personal"] == "y") {
    if($user) {
      $cal_data["tiki_p_view_calendar"] = 'y';
      $cal_data["tiki_p_add_events"] = 'y';
      $cal_data["tiki_p_change_events"] = 'y';
    }

    else {
      $cal_data["tiki_p_view_calendar"] = 'n';
      $cal_data["tiki_p_add_events"] = 'n';
      $cal_data["tiki_p_change_events"] = 'n';
    }
  }

  else {
    if($userlib->user_has_perm_on_object($user, $cal_id, 'calendar', 'tiki_p_view_calendar')) {
      $cal_data["tiki_p_view_calendar"] = 'y';
    }

    else {
      $cal_data["tiki_p_view_calendar"] = 'n';
    }

    if($userlib->user_has_perm_on_object($user, $cal_id, 'calendar', 'tiki_p_add_events')) {
      $cal_data["tiki_p_add_events"] = 'y';
      $tiki_p_add_events = "y";
      $smarty->assign("tiki_p_add_events", "y");
    }

    else {
      $cal_data["tiki_p_add_events"] = 'n';
    }

    if($userlib->user_has_perm_on_object($user, $cal_id, 'calendar', 'tiki_p_change_events')) {
      $cal_data["tiki_p_change_events"] = 'y';
      $smarty->assign("tiki_p_change_events", "y");
    }

    else {
      $cal_data["tiki_p_change_events"] = 'n';
    }

    if($userlib->user_has_perm_on_object($user, $cal_id, 'calendar', 'tiki_p_admin_calendar')) {
      $cal_data["tiki_p_view_calendar"] = 'y';
      $cal_data["tiki_p_add_events"] = 'y';
      $cal_data["tiki_p_change_events"] = 'y';
    }
  }

  if($cal_data["tiki_p_view_calendar"] == 'y') {
    $viewOneCal = 'y';
    $bufid[] = $cal_id;
    $bufdata["$cal_id"] = $cal_data;
  }

  if($cal_data["tiki_p_add_events"] == 'y') {
    $modifTab = 1;
  }

  if($cal_data["tiki_p_change_events"] == 'y') {
    $modifTab = 1;
    $modifiable[] = $cal_id;
  }
}

if($feature_categories == 'y' and isset($_REQUEST['calIds'])) {
  $is_categorized = FALSE;
  foreach($_REQUEST['calIds'] as $calId) {
    $perms_array = $categlib->get_object_categories_perms($user, 'calendar', $calId);

    if($perms_array) {
      foreach($perms_array as $perm => $value) {
        $$perm = $value;
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
}

if($viewOneCal != 'y') {
  $smarty->assign('msg', tra("Permission denied you cannot view the calendar"));
  $smarty->display("error.tpl");
  die;
}

if(isset($_REQUEST['calitemId'])) {
  $info = $calendarlib->get_item($_REQUEST["calitemId"]);

  if(!$userlib->user_has_perm_on_object($user,$info['calendarId'], 'calendar', 'tiki_p_admin_calendar')) {
    if((isset($_REQUEST['delete']) && !$userlib->user_has_perm_on_object($user,$info['calendarId'], 'calendar', 'tiki_p_change_events'))
        || ((isset($_REQUEST['copy']) || isset($_REQUEST['save'])) && !$userlib->user_has_perm_on_object($user,$info['calendarId'], 'calendar', 'tiki_p_add_events'))
        || !$userlib->user_has_perm_on_object($user,$info['calendarId'], 'calendar', 'tiki_p_view_calendar')) {
      $smarty->assign('msg', tra("Permission denied you cannot view the calendar"));
      $smarty->display("error.tpl");
      die;
    }
  }
}

$listcals = $bufid;
$infocals["data"] = $bufdata;

$smarty->assign('infocals', $infocals["data"]);
$smarty->assign('listcals', $listcals);
$smarty->assign('modifTab', $modifTab);

// set up list of groups
if(isset($_REQUEST["calIds"])and is_array($_REQUEST["calIds"])and count($_REQUEST["calIds"])) {
  $_SESSION['CalendarViewGroups'] = array_intersect($_REQUEST["calIds"], $listcals);
}

elseif(isset($_REQUEST["calIds"])and !is_array($_REQUEST["calIds"])) {
  $_SESSION['CalendarViewGroups'] = array_intersect(array($_REQUEST["calIds"]), $listcals);
}
elseif(!isset($_SESSION['CalendarViewGroups'])) {
  $_SESSION['CalendarViewGroups'] = $listcals;
}
elseif(isset($_REQUEST["refresh"])and !isset($_REQUEST["calIds"])) {
  $_SESSION['CalendarViewGroups'] = array();
}

else {
  $_SESSION['CalendarViewGroups'] = array_intersect($_SESSION['CalendarViewGroups'], $listcals);
}

// setup list of tiki items displayed
if(isset($_REQUEST["tikicals"])and is_array($_REQUEST["tikicals"])and count($_REQUEST["tikicals"])) {
  $_SESSION['CalendarViewTikiCals'] = $_REQUEST["tikicals"];
}

elseif(!isset($_SESSION['CalendarViewTikiCals'])) {
  $_SESSION['CalendarViewTikiCals'] = array();
}
elseif(isset($_REQUEST["refresh"])and !isset($_REQUEST["tikicals"])) {
  $_SESSION['CalendarViewTikiCals'] = array();
}


// that should be a global array set up in tiki-setup.php
$tikiItems = array(
               "wiki" => array(
                 "label" => tra("Wiki"),
                 "feature" => "$feature_wiki",
                 "right" => "$tiki_p_view"
               ),
               "gal" => array(
                 "label" => tra("Image Gallery"),
                 "feature" => "$feature_galleries",
                 "right" => "$tiki_p_view_image_gallery"
               ),
               "art" => array(
                 "label" => tra("Articles"),
                 "feature" => "$feature_articles",
                 "right" => "$tiki_p_read_article"
               ),
               "blog" => array(
                 "label" => tra("Blogs"),
                 "feature" => "$feature_blogs",
                 "right" => "$tiki_p_read_blog"
               ),
               "forum" => array(
                 "label" => tra("Forums"),
                 "feature" => "$feature_forums",
                 "right" => "$tiki_p_forum_read"
               ),
               "dir" => array(
                 "label" => tra("Directory"),
                 "feature" => "$feature_directory",
                 "right" => "$tiki_p_view_directory"
               ),
               "fgal" => array(
                 "label" => tra("File Gallery"),
                 "feature" => "$feature_file_galleries",
                 "right" => "$tiki_p_view_file_gallery"
               ),
               "faq" => array(
                 "label" => tra("FAQs"),
                 "feature" => $feature_faqs,
                 "right" => $tiki_p_view_faqs
               ),
               "quiz" => array(
                 "label" => tra("Quizzes"),
                 "feature" => $feature_quizzes,
                 "right" => $tiki_p_take_quiz
               ),
               "track" => array(
                 "label" => tra("Trackers"),
                 "feature" => "$feature_trackers",
                 "right" => "$tiki_p_view_trackers"
               ),
               "surv" => array(
                 "label" => tra("Survey"),
                 "feature" => "$feature_surveys",
                 "right" => "$tiki_p_take_survey"
               ),
               "nl" => array(
                 "label" => tra("Newsletter"),
                 "feature" => "$feature_newsletters",
                 "right" => "$tiki_p_subscribe_newsletters"
               ),
               "eph" => array(
                 "label" => tra("Ephemerides"),
                 "feature" => "$feature_eph",
                 "right" => "$tiki_p_view_eph"
               ),
               "chart" => array(
                 "label" => tra("Charts"),
                 "feature" => "$feature_charts",
                 "right" => "$tiki_p_view_chart"
               )
             );

$smarty->assign('tikiItems', $tikiItems);

$smarty->assign('displayedcals', $_SESSION['CalendarViewGroups']);
$smarty->assign('displayedtikicals', $_SESSION['CalendarViewTikiCals']);

$thiscal = array();
$checkedCals = array();

foreach($listcals as $thatid) {
  if(is_array($_SESSION['CalendarViewGroups']) && (in_array("$thatid", $_SESSION['CalendarViewGroups']))) {
    $thiscal["$thatid"] = 1;
    $checkedCals[] = $thatid;
  }

  else {
    $thiscal["$thatid"] = 0;
  }
}

$smarty->assign('thiscal', $thiscal);

$tikical = array();

foreach($_SESSION['CalendarViewTikiCals'] as $calt) {
  $tikical["$calt"] = 1;
}

$trunc = "20"; // put in a pref, number of chars displayed in cal cells
$smarty->assign('tikical', $tikical);
$dc = $tikilib->get_date_converter($user);

if(isset($_REQUEST["todate"]) && $_REQUEST['todate']) {
  $_SESSION['CalendarFocusDate'] = $_REQUEST['todate'];
}

elseif(isset($_SESSION['CalendarFocusDate']) && $_SESSION['CalendarFocusDate']) {
  $_REQUEST["todate"] = $_SESSION['CalendarFocusDate'];
}

else {
  $focusdate = $dc->getDisplayDateFromServerDate(mktime(date('G'),date('i'),date('s'), date('m'), date('d'), date('Y'))); /* user date */
  $_SESSION['CalendarFocusDate'] = $focusdate;
  $_REQUEST["todate"] = $_SESSION['CalendarFocusDate'];
}

$focusdate = $_REQUEST['todate'];
list($focus_day, $focus_month, $focus_year) = array(
      date("d", $focusdate),
      date("m", $focusdate),
      date("Y", $focusdate)
    );

$focuscell = mktime(0,0,0,$focus_month,$focus_day,$focus_year); /* server date */
$focusdate = mktime(date('G'),date('i'),date('s'),$focus_month,$focus_day,$focus_year); /* server date */

if(isset($_REQUEST["viewmode"]) and $_REQUEST["viewmode"]) {
  $_SESSION['CalendarViewMode'] = $_REQUEST["viewmode"];
}

if(!isset($_SESSION['CalendarViewMode']) or !$_SESSION['CalendarViewMode']) {
  $_SESSION['CalendarViewMode'] = 'month';
}

$smarty->assign_by_ref('viewmode', $_SESSION['CalendarViewMode']);

if(isset($_REQUEST["viewlist"])) {
  $viewlist = $_REQUEST["viewlist"];
  $_SESSION['CalendarViewList'] = $viewlist;
}

else
  $viewlist = "";

$smarty->assign_by_ref('viewlist', $_SESSION['CalendarViewList']);

if(isset($_REQUEST["delete"])and($_REQUEST["delete"]) and isset($_REQUEST["calitemId"])) {
  $area = 'delcalevent';

  if($feature_ticketlib2 != 'y' or(isset($_POST['daconfirm']) and isset($_SESSION["ticket_$area"]))) {
    key_check($area);
    $calendarlib->drop_item($user, $_REQUEST["calitemId"]);
    $_REQUEST["calitemId"] = 0;
  }

  else {
    key_get($area);
  }
}

if(!isset($_REQUEST["calitemId"]))
  $_REQUEST["calitemId"] = 0;

if(!isset($_REQUEST["locationId"]))
  $_REQUEST["locationId"] = 0;

if(!isset($_REQUEST["categoryId"]))
  $_REQUEST["categoryId"] = 0;

if(!isset($_REQUEST["organizers"]))
  $_REQUEST["organizers"] = "";

if(!isset($_REQUEST["participants"]))
  $_REQUEST["participants"] = "";

if(!isset($_REQUEST["newloc"]))
  $_REQUEST["newloc"] = "";

if(!isset($_REQUEST["newcat"]))
  $_REQUEST["newcat"] = "";

if(!isset($_REQUEST["priority"]))
  $_REQUEST["priority"] = "5";

if(!isset($_REQUEST["lang"]))
  $_REQUEST["lang"] = $language;

if(!isset($_REQUEST["nlId"]))
  $_REQUEST["nlId"] = 0;

if(!isset($_REQUEST["status"]))
  $_REQUEST["status"] = 0;

if(isset($_REQUEST["copy"])and($_REQUEST["copy"])) {
  check_ticket('calendar');
  $_REQUEST["calitemId"] = 0;
  $_REQUEST["save"] = true;
  $_REQUEST["calendarId"] = $_REQUEST["calendarId2"];
}

$error = "n";

if(isset($_REQUEST["save"])and($_REQUEST["save"])) {
  check_ticket('calendar');

  if(!isset($_REQUEST["name"])or !(trim($_REQUEST["name"]))) {
    $_REQUEST["name"] = tra("event without name");
  }

  if(isset($_REQUEST["start_date_input"]) and $_REQUEST["start_date_input"]) {
    $event_start = $_REQUEST["start_date_input"];
  }

  else {
    if(isset($_REQUEST["start_freeform"])and $_REQUEST["start_freeform"]) {
      if(($event_start = strtotime($_REQUEST["start_freeform"])) == -1) {
        $error = "y";
        $smarty->assign('start_freeform', $_REQUEST["start_freeform"]);
        $smarty->assign('start_freeform_error', "y");
      }
    }

    if(!isset($event_start)) {
      $event_start = mktime($_REQUEST["starth_Hour"], $_REQUEST["starth_Minute"],
                            0, $_REQUEST["start_Month"], $_REQUEST["start_Day"], $_REQUEST["start_Year"]);
    }
  }

  if(isset($_REQUEST["end_date_input"]) and $_REQUEST["end_date_input"]) {
    $event_end = $_REQUEST["end_date_input"];
  }

  else {
    if(isset($_REQUEST["end_freeform"])and $_REQUEST["end_freeform"]) {
      if(($event_end = strtotime($_REQUEST["end_freeform"])) == -1) {
        $error = "y";
        $smarty->assign('end_freeform', $_REQUEST["end_freeform"]);
        $smarty->assign('end_freeform_error', "y");
      }
    }

    if(!isset($event_end)) {
      $event_end = mktime($_REQUEST["endh_Hour"], $_REQUEST["endh_Minute"],
                          0, $_REQUEST["end_Month"], $_REQUEST["end_Day"], $_REQUEST["end_Year"]);
    }
  }

  if(isset($_REQUEST["endChoice"]) && $_REQUEST["endChoice"] == "duration") {
    if(!isset($_REQUEST["duration_hours"])) $_REQUEST["duration_hours"] = 0;

    if(!isset($_REQUEST["duration_minutes"])) $_REQUEST["duration_minutes"] = 0;

    $event_end = $event_start + $_REQUEST["duration_hours"] * 60 *60 + $_REQUEST["duration_minutes"]*60;
  }

  if($event_start > $event_end) {
    $error = "y";
    $smarty->assign('end_error', "y");
  }

  if($error == "n") {
    $_REQUEST["calitemId"] = $calendarlib->set_item($user, $_REQUEST["calitemId"], array(
                               "user" => $user,
                               "organizers" => $_REQUEST["organizers"],
                               "participants" => $_REQUEST["participants"],
                               "calendarId" => $_REQUEST["calendarId"],
                               "start" => $event_start,
                               "end" => $event_end,
                               "locationId" => $_REQUEST["locationId"],
                               "newloc" => $_REQUEST["newloc"],
                               "categoryId" => $_REQUEST["categoryId"],
                               "newcat" => $_REQUEST["newcat"],
                               "priority" => $_REQUEST["priority"],
                               "status" => $_REQUEST["status"],
                               "url" => $_REQUEST["url"],
                               "lang" => $_REQUEST["lang"],
                               "nlId" => $_REQUEST["nlId"],
                               "name" => $_REQUEST["name"],
                               "description" => $_REQUEST["description"]
                             ));
    $_REQUEST["editmode"] = '';
  }

  $_SESSION["defaultAddCal"] = $_REQUEST["calendarId"];
  //$_REQUEST["calitemId"] = 0;
}

if($_REQUEST["calitemId"] && !isset($_REQUEST["preview"])) {
  $info = $calendarlib->get_item($_REQUEST["calitemId"]);
  $info['modifiable'] = in_array($info['calendarId'], $modifiable)? "y": "n";
}

elseif($error  == "y" || isset($_REQUEST["preview"])) {
  if(isset($_REQUEST["preview"])) {
    $info["parsedDescription"] = $tikilib->parse_data($_REQUEST["description"]);
    $smarty->assign('preview', 'y');
  }

  $info["calitemId"] = $_REQUEST["calitemId"];
  $info["calendarId"] = $_REQUEST["calendarId"];
  $info["user"] = $user;
  $info["calname"] = isset($_REQUEST["calname"])? $_REQUEST["calname"]: "";
  $info["organizers"] = $_REQUEST["organizers"];
  $info["participants"] = $_REQUEST["participants"];

  if(isset($_REQUEST["start_date_input"]) and $_REQUEST["start_date_input"]) {
    $info["start"] = $_REQUEST["start_date_input"];
  }

  elseif(!isset($event_start)) {
    $info["start"] = mktime($_REQUEST["starth_Hour"], $_REQUEST["starth_Minute"],
                            0, $_REQUEST["start_Month"], $_REQUEST["start_Day"], $_REQUEST["start_Year"]);
  }

  else {
    $info["start"] = $event_start;
  }

  if(isset($_REQUEST["end_date_input"]) and $_REQUEST["end_date_input"]) {
    $info["end"] = $_REQUEST["end_date_input"];
  }

  elseif(!isset($event_end)) {
    $info["end"] = mktime($_REQUEST["endh_Hour"], $_REQUEST["endh_Minute"],
                          0, $_REQUEST["end_Month"], $_REQUEST["end_Day"], $_REQUEST["end_Year"]);
  }

  else {
    $info["end"] = $event_end;
  }

  $info["locationId"] = $_REQUEST["locationId"];
  $info["locationName"] = $_REQUEST["newloc"];
  $info["categoryId"] = $_REQUEST["categoryId"];
  $info["categoryName"] = $_REQUEST["newcat"];
  $info["priority"] = $_REQUEST["priority"];
  $info["url"] = $_REQUEST["url"];
  $info["lang"] = $_REQUEST["lang"];
  $info["nlId"] = $_REQUEST["nlId"];
  $info["name"] = $_REQUEST["name"];
  $info["description"] = $_REQUEST["description"];
  $info["created"] = isset($_REQUEST["created"]) ? $_REQUEST["created"]: time();
  $info["lastModif"] = isset($_REQUEST["lastModif"])? $_REQUEST["lastModif"]: time();
  $info["status"] = $_REQUEST["status"];
  $info['modifiable'] = in_array($info['calendarId'], $modifiable)? "y": "n";
}

else {
  $info = array();

  $info["calitemId"] = "";
  $info["calendarId"] = "";
  $info["user"] = "";
  $info["calname"] = "";
  $info["organizers"] = $user . ",";
  $info["participants"] = $user . ":0,";
  $info["start"] = $focusdate;
  $info["end"] = $info["start"] +  2 * 60 * 60;
  $info["locationId"] = 0;
  $info["locationName"] = '';
  $info["categoryId"] = 0;
  $info["categoryName"] = '';
  $info["priority"] = 5;
  $info["url"] = '';
  $info["lang"] = $tikilib->get_user_preference($user, "language");
  $info["nlId"] = 0;
  $info["name"] = isset($_REQUEST["name"])? $_REQUEST["name"]: '';
  $info["description"] = isset($_REQUEST["description"])? $_REQUEST["description"]: '';
  $info["created"] = time();
  $info["lastModif"] = time();
  $info["status"] = '0';
  $info["customlocations"] = 'n';
  $info["customcategories"] = 'n';
  $info["customlanguages"] = 'n';
  $info["custompriorities"] = 'n';
  $info["customparticipants"] = 'n';
  $info["customsubscription"] = 'n';
  $info["modifiable"] = "y";
}

$info["duration_hours"] = intval(($info["end"] - $info["start"]) / (60*60));
$info["duration_minutes"] = intval(($info["end"] - $info["start"]) - ($info["duration_hours"] *60*60))/60;

if(!isset($_REQUEST["calendarId"])or !$_REQUEST["calendarId"]) {
  $_REQUEST["calendarId"] = $info["calendarId"];
}

$smarty->assign('calitemId', $info["calitemId"]);
$smarty->assign('organizers', $info["organizers"]);
$smarty->assign('participants', $info["participants"]);
$smarty->assign('calname', $info["calname"]);
$smarty->assign('start', $info["start"]); /* user time */
$smarty->assign('end', $info["end"]);
$smarty->assign('locationId', $info["locationId"]);
$smarty->assign('locationName', $info["locationName"]);
$smarty->assign('categoryId', $info["categoryId"]);
$smarty->assign('categoryName', $info["categoryName"]);
$smarty->assign('priority', $info["priority"]);
$smarty->assign('url', $info["url"]);
$smarty->assign('lang', $info["lang"]);
$smarty->assign('nlId', $info["nlId"]);
$smarty->assign('name', $info["name"]);
$smarty->assign('description', $info["description"]);
$smarty->assign('parsedDescription', $tikilib->parse_data($info["description"]));
$smarty->assign('created', $info["created"]);
$smarty->assign('lastModif', $info["lastModif"]);
$smarty->assign('lastUser', $info["user"]);
$smarty->assign('status', $info["status"]);
$smarty->assign('duration_hours', $info["duration_hours"]);
$smarty->assign('duration_minutes', $info["duration_minutes"]);
$smarty->assign('modifiable', $info['modifiable']);

if((isset($_REQUEST["editmode"]) && $_REQUEST["editmode"]) || $error == "y") { /* 1 for edit item - add for new item - details for view item*/
  $cookietab = 3;
  $smarty->assign("editmode", $_REQUEST["editmode"]);
}

if(isset($_REQUEST["calendarId"]) && $_REQUEST["calendarId"] !='')
  $defaultAddCal = $_REQUEST["calendarId"];

elseif(count($checkedCals) == 1)
$defaultAddCal = $checkedCals[0];
elseif(isset($_SESSION["calendar"]))
$defaultAddCal = $_SESSION["calendar"];
elseif(isset($_SESSION["defaultAddCal"]))
$defaultAddCal = $_SESSION["defaultAddCal"];
else
  $defaultAddCal = "";

$smarty->assign('defaultAddCal', $defaultAddCal);

if($defaultAddCal) {
  $thatcal = $calendarlib->get_calendar($defaultAddCal);

  $info["customlocations"] = $thatcal["customlocations"];
  $info["customcategories"] = $thatcal["customcategories"];
  $info["customlanguages"] = $thatcal["customlanguages"];
  $info["custompriorities"] = $thatcal["custompriorities"];
  $info["customparticipants"] = $thatcal["customparticipants"];
  $info["customsubscription"] = $thatcal["customsubscription"];
  $listcat = array();
  $listloc = array();
  $listpeople = array();
  $languages = array();
  $subscrips = array();

  if($thatcal["customcategories"] == 'y') {
    $listcat = $calendarlib->list_categories($defaultAddCal);
  }

  if($thatcal["customsubscription"] == 'y') {
    $subscrips = $nllib->list_avail_newsletters();
//gg    $subscrips = $tikilib->list_languages();
  }

  if($thatcal["customlocations"] == 'y') {
    $listloc = $calendarlib->list_locations($defaultAddCal);
  }

  if($thatcal["customlanguages"] == 'y') {
    $languages = $tikilib->list_languages();
  }

  $smarty->assign('listcat', $listcat);
  $smarty->assign('listloc', $listloc);
  $smarty->assign_by_ref('languages', $languages);
  $smarty->assign_by_ref('subscrips', $subscrips);
}

$smarty->assign('calendarId', $_REQUEST["calendarId"]);
$smarty->assign('customlocations', $info["customlocations"]);
$smarty->assign('customcategories', $info["customcategories"]);
$smarty->assign('customlanguages', $info["customlanguages"]);
$smarty->assign('custompriorities', $info["custompriorities"]);
$smarty->assign('customparticipants', $info["customparticipants"]);
$smarty->assign('customsubscription', $info["customsubscription"]);

if(isset($_REQUEST["find"])) {
  $find = $_REQUEST["find"];
}

else {
  $find = '';
}

$smarty->assign('find', $find);

if(isset($_REQUEST['drop'])) {
  check_ticket('calendar');

  if(is_array($_REQUEST['drop'])) {
    foreach($_REQUEST['drop'] as $dropme) {
      $calendarlib->drop_item($user, $dropme);
    }
  }

  else {
    $calendarlib->drop_item($user, $_REQUEST['drop']);
  }
}

$z = date("z");

if(($firstDayofWeek = $tikilib->get_user_preference($user, "")) == "") {  /* 0 for Sundays, 1 for Mondays */
  $strRef = "First day of week: Sunday (its ID is 0) - translators you need to localize this string!";

//get_strings tra("First day of week: Sunday (its ID is 0) - translators you need to localize this string!");
  if(($str = tra($strRef)) != $strRef) {
    $firstDayofWeek = ereg_replace("[^0-9]", "",$str);

    if($firstDayofWeek < 0 || $firstDayofWeek > 9)
      $firstDayofWeek = 0;
  }

  else
    $firstDayofWeek = 0;
}

$smarty->assign('firstDayofWeek', $firstDayofWeek);

$strRef = tra("%H:%M %Z");

if(strstr($strRef, "%h") || strstr($strRef, "%g"))
  $timeFormat12_24 = "12";

else
  $timeFormat12_24 = "24";

$smarty->assign('timeFormat12_24', $timeFormat12_24);

$short_format_day = tra("%m/%d");
$smarty->assign('short_format_day', $short_format_day);

// Windows requires clean dates!
$focus_prevday = mktime(0, 0, 0, $focus_month, $focus_day - 1, $focus_year);
$focus_nextday = mktime(0, 0, 0, $focus_month, $focus_day + 1, $focus_year);
$focus_prevweek = mktime(0, 0, 0, $focus_month, $focus_day - 7, $focus_year);
$focus_nextweek = mktime(0, 0, 0, $focus_month, $focus_day + 7, $focus_year);
$focus_prevmonth = mktime(0, 0, 0, $focus_month - 1, $focus_day, $focus_year);
$focus_nextmonth = mktime(0, 0, 0, $focus_month + 1, $focus_day, $focus_year);

$smarty->assign('daybefore', $focus_prevday);
$smarty->assign('weekbefore', $focus_prevweek);
$smarty->assign('monthbefore', $focus_prevmonth);
$smarty->assign('dayafter', $focus_nextday);
$smarty->assign('weekafter', $focus_nextweek);
$smarty->assign('monthafter', $focus_nextmonth);
$smarty->assign('focusmonth', $focus_month);
$smarty->assign('focusdate', $focusdate);
$smarty->assign('focuscell', $focuscell);
$now = mktime(date('G'), date('i'), date('s'), date('n'), date('d'), date('Y')); /* server date */
$smarty->assign('now', $now); /* server date */
$smarty->assign('nowUser', $dc->getDisplayDateFromServerDate($now)); /* user time */


$weekdays = range(0, 6);
$hours = range(0, 23);

$d = 60 * 60 * 24;
$currentweek = date("W", $focusdate);
$wd = date('w', $focusdate);

#if ($wd == 0) $w = 7;
#$wd--;

//prepare for select first day of week (Hausi)
if($firstDayofWeek == 1) {
  $wd--;

  if($wd == -1) {
    $wd=6;
  }
}

if(isset($_REQUEST['mon']) && !empty($_REQUEST['mon'])) {
  $focus_month = $_REQUEST['mon'];
}

if(isset($_REQUEST['day']) && !empty($_REQUEST['day'])) {
  $focus_day = $_REQUEST['day'];
}

if(isset($_REQUEST['year']) && !empty($_REQUEST['year'])) {
  $focus_year = $_REQUEST['year'];
}

$smarty->assign('viewmonth', $focus_month);
$smarty->assign('viewday', $focus_day);
$smarty->assign('viewyear', $focus_year);

// calculate timespan for sql query
if($_SESSION['CalendarViewMode'] == 'month' || $_SESSION['CalendarViewMode'] == 'quarter' || $_SESSION['CalendarViewMode'] == 'semester') {
  $daystart = mktime(0,0,0, $focus_month, 1, $focus_year);
}

elseif($_SESSION['CalendarViewMode'] == 'year') {
  $daystart = mktime(0,0,0, 1, 1, $focus_year);
}

else {
  $daystart = mktime(0,0,0,$focus_month, $focus_day, $focus_year);
}

$viewstart = $daystart; // viewstart is the beginning of the display, daystart is the beginning of the selected period

if($_SESSION['CalendarViewMode'] == 'month' ||
    $_SESSION['CalendarViewMode'] == 'quarter' ||
    $_SESSION['CalendarViewMode'] == 'semester' ||
    $_SESSION['CalendarViewMode'] == 'year') {
  $TmpWeekday = date("w",$viewstart);

//prepare for select first day of week (Hausi)
  if($firstDayofWeek == 1) {
    $TmpWeekday--;

    if($TmpWeekday == -1) {
      $TmpWeekday=6;
    }
  }

  // move viewstart back to Sunday....
  $viewstart -= $TmpWeekday * $d;

  // this is the last day of $focus_month
  if($_SESSION['CalendarViewMode'] == 'month') {
    $viewend = mktime(0,0,0,$focus_month + 1, 1, $focus_year);
  }

  elseif($_SESSION['CalendarViewMode'] == 'quarter') {
    $viewend = mktime(0,0,0,$focus_month + 3, 1, $focus_year);
  }
  elseif($_SESSION['CalendarViewMode'] == 'semester') {
    $viewend = mktime(0,0,0,$focus_month + 6, 1, $focus_year);
  }
  elseif($_SESSION['CalendarViewMode'] == 'year') {
    $viewend = mktime(0,0,0,1, 1, $focus_year+1);
  }

  else {
    $viewend = mktime(0,0,0,$focus_month + 1, 0, $focus_year);
  }

  $viewend -= 1;
  $dayend=$viewend;
  $TmpWeekday = date("w", $viewend);
  $viewend += (6 - $TmpWeekday) * $d;
  // ISO weeks --- kinda mangled because ours begin on Sunday...
  $firstweek = date("W", $viewstart + $d);
  $lastweek = date("W", $viewend);

  if($lastweek <= $firstweek) {
    $startyear = date("Y",$daystart-1);
    $weeksinyear = date("W",mktime(0,0,0,12,31,$startyear));

    if($weeksinyear == 1) {
      $weeksinyear = date("W",mktime(0,0,0,12,28,$startyear));
    }

    $lastweek += $weeksinyear;
  }

  $numberofweeks = $lastweek - $firstweek;
}

elseif($_SESSION['CalendarViewMode'] == 'week') {
  $firstweek = $currentweek;
  $lastweek = $currentweek;
  // then back up to the preceding Sunday;
  $viewstart -= $wd * $d;
  $daystart=$viewstart;
  // then go to the end of the week for $viewend
  $viewend = $viewstart + ((7 * $d) - 1);
  $dayend=$viewend;
  $numberofweeks = 0;
}

else {
  $firstweek = $currentweek;
  $lastweek = $currentweek;
  $viewend = $viewstart + ($d - 1);
  $dayend = $daystart;
  $weekdays = array(date('w',$focusdate));
  $numberofweeks = 0;
}

// untested (by me, anyway!) function grabbed from the php.net site:
// [2004/01/05:rpg]
function m_weeks($y, $m) {
  // monthday array
  $monthdays = array(1=>31, 3=>31, 4=>30, 5=>31, 6=>30,7=>31,
                     8=>31, 9=>30, 10=>31, 11=>30, 12=>31);
  // weekdays remaining in a week starting on 7 - Sunday...(could be changed)
  $weekdays = array(7=>7, 1=>6, 2=>5, 3=>4, 4=>3, 5=>2, 6=>1);
  $date = mktime(0, 0, 0, $m, 1, $y);
  $leap = date("L", $date);
  // if it is a leap year set February to 29 days, otherwise 28
  $monthdays[2] = ($leap ? 29 : 28);
  // get the weekday of the first day of the month
  $wn = strftime("%u",$date);
  $days = $monthdays[$m] - $weekdays[$wn];
  return (ceil($days/7) + 1);
}


$smarty->assign('viewstart', $viewstart);
$smarty->assign('viewend', $viewend);
$smarty->assign('numberofweeks', $numberofweeks);
$smarty->assign('daystart', $daystart);
$smarty->assign('dayend', $dayend);

$daysnames = array();

if($firstDayofWeek == 0)
  $daysnames[] = tra("Sunday");

array_push($daysnames,
           tra("Monday"),
           tra("Tuesday"),
           tra("Wednesday"),
           tra("Thursday"),
           tra("Friday"),
           tra("Saturday")
          );

if($firstDayofWeek != 0)
  $daysnames[] = tra("Sunday");

$weeks = array();
$cell = array();

if($_SESSION['CalendarViewGroups']) {
  if($_SESSION['CalendarViewList'] == "list") {
    if(isset($_REQUEST["sort_mode"])) {
      $sort_mode = $_REQUEST["sort_mode"];
      $smarty->assign_by_ref('sort_mode', $sort_mode);
    }

    else
      $sort_mode = "start_asc";

    $listevents = $calendarlib->list_raw_items($_SESSION['CalendarViewGroups'], $user, $viewstart, $viewend, 0, 50, $sort_mode);

    for($i = count($listevents) - 1; $i >= 0; --$i)
      $listevents[$i]['modifiable'] = in_array($listevents[$i]['calendarId'], $modifiable)? "y": "n";
  }

  else {
    $listevents = $calendarlib->list_items($_SESSION['CalendarViewGroups'], $user, $viewstart, $viewend, 0, 50);
  }

  $smarty->assign_by_ref('listevents', $listevents);
}

else {
  $listevents = array();
}

if($_SESSION['CalendarViewTikiCals']) {
  $listtikievents = $calendarlib->list_tiki_items($_SESSION['CalendarViewTikiCals'], $user, $viewstart, $viewend, 0, 50, 'name_desc', '');
  $smarty->assign_by_ref('listtikievents', $listtikievents);
}

else {
  $listtikievents = array();
}

define("weekInSeconds", 604800);
$mloop = date("m", $viewstart);
$dloop = date("d", $viewstart);
$yloop = date("Y", $viewstart);

// note that number of weeks starts at ZERO (i.e., zero = 1 week to display).
for($i = 0; $i <= $numberofweeks; $i++) {
  $wee = date("W",$viewstart + ($i * weekInSeconds) + $d);

  $weeks[] = $wee;

  // $startOfWeek is a unix timestamp
  $startOfWeek = $viewstart + $i * weekInSeconds;

  foreach($weekdays as $w) {
    $leday = array();
    If($_SESSION['CalendarViewMode'] == 'day') {
      $dday = $daystart;
    }

    else {
      //$dday = $startOfWeek + $d * $w;
      $dday = mktime(0,0,0, $mloop, $dloop++, $yloop);
    }

    $cell[$i][$w]['day'] = $dday;

    If($_SESSION['CalendarViewMode'] == 'day' or($dday>=$daystart && $dday<=$dayend)) {
      $cell[$i][$w]['focus'] = true;
    }

    else {
      $cell[$i][$w]['focus'] = false;
    }

    if(isset($listevents["$dday"])) {
      $e = 0;

      foreach($listevents["$dday"] as $le) {
        $le['modifiable'] = in_array($le['calendarId'], $modifiable)? "y": "n";
        $leday["{$le['time']}$e"] = $le;

        $smarty->assign_by_ref('cellhead', $le["head"]);
        $smarty->assign_by_ref('cellprio', $le["prio"]);
        $smarty->assign_by_ref('cellcalname', $le["calname"]);
        $smarty->assign_by_ref('celllocation', $le["location"]);
        $smarty->assign_by_ref('cellcategory', $le["category"]);
        $smarty->assign_by_ref('cellname', $le["name"]);
        $smarty->assign_by_ref('cellurl', $le["url"]);
        $smarty->assign_by_ref('cellid', $le["calitemId"]);
        $smarty->assign('celldescription', $tikilib->parse_data($le["description"]));
        $smarty->assign_by_ref('cellmodif', $le['modifiable']);
        $leday["{$le['time']}$e"]["over"] = $smarty->fetch("tiki-calendar_box.tpl");
        $e++;
      }
    }

    if(isset($listtikievents["$dday"])) {
      $e = 0;

      foreach($listtikievents["$dday"] as $lte) {
        $leday["{$lte['time']}$e"] = $lte;

        $smarty->assign_by_ref('cellhead', $lte["head"]);
        $smarty->assign_by_ref('cellprio', $lte["prio"]);
        $smarty->assign_by_ref('cellcalname', $lte["calname"]);
        $smarty->assign('celllocation', "");
        $smarty->assign('cellcategory', "");
        $smarty->assign_by_ref('cellname', $lte["name"]);
        $smarty->assign('cellid', "");
        $smarty->assign_by_ref('celldescription', $lte["description"]);
        $leday["{$lte['time']}$e"]["over"] = $smarty->fetch("tiki-calendar_box.tpl");
        $e++;
      }
    }

    if(is_array($leday)) {
      ksort($leday);
      $cell[$i][$w]['items'] = array_values($leday);
    }
  }
}

$hrows = array();
$hours = array();

if($_SESSION['CalendarViewMode'] == 'day') {
  $hours = array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23);
  foreach($cell[0]["{$weekdays[0]}"]['items'] as $dayitems) {
    $rawhour = intval(substr($dayitems['time'],0,2));
    $dayitems['mins'] = substr($dayitems['time'],2);
    $hrows["$rawhour"][] = $dayitems;
  }
}

$smarty->assign('hrows', $hrows);
$smarty->assign('hours', $hours);
$smarty->assign('mrows', array(0=>"00", 5=>"05", 10=>"10", 15=>"15", 20=>"20", 25=>"25", 30=>"30", 35=>"35", 40=>"40", 45=>"45", 50=>"50", 55=>"55"));

$smarty->assign('trunc', $trunc);
$smarty->assign('daformat', $tikilib->get_long_date_format()." ".tra("at")." %H:%M");
$smarty->assign('daformat2', $tikilib->get_long_date_format());
$smarty->assign('currentweek', $currentweek);
$smarty->assign('firstweek', $firstweek);
$smarty->assign('lastweek', $lastweek);
$smarty->assign('weekdays', $weekdays);
$smarty->assign('weeks', $weeks);
$smarty->assign('daysnames', $daysnames);
$smarty->assign('cell', $cell);
$smarty->assign('var', '');

$section = 'calendar';
include_once('tiki-section_options.php');

setcookie('tab',$cookietab);
$smarty->assign('cookietab',$cookietab);

include_once('lib/quicktags/quicktagslib.php');
$quicktags = $quicktagslib->list_quicktags(0,-1,'taglabel_desc','','wiki');
$smarty->assign_by_ref('quicktags', $quicktags["data"]);
include_once("textareasize.php");

ask_ticket('calendar');

include_once('tiki-jscalendar.php');
$smarty->assign('uses_tabs', 'y');

if(isset($_REQUEST['editmode']) && ($_REQUEST['editmode'] == 'add' || $_REQUEST['editmode'] == 'edit')) {
  $smarty->assign('mid', 'tiki-calendar_add_event.tpl');
}

else {
  $smarty->assign('mid', 'tiki-calendar.tpl');
}

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

$smarty->display("tiki.tpl");
?>
