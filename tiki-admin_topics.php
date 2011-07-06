<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-admin_topics.php,v 1.15.2.6 2007/03/02 12:23:25 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
require_once('tiki-setup.php');

include_once('lib/articles/artlib.php');

if($feature_articles != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_articles");

  $smarty->display("error.tpl");
  die;
}

// PERMISSIONS: NEEDS p_admin
if($tiki_p_admin_cms != 'y') {
  $smarty->assign('msg', tra("You do not have permission to use this feature"));

  $smarty->display("error.tpl");
  die;
}

if(isset($_REQUEST["addtopic"])) {
  check_ticket('admin-topics');

  if(isset($_FILES['userfile1']) && is_uploaded_file($_FILES['userfile1']['tmp_name'])) {
    $fp = fopen($_FILES['userfile1']['tmp_name'], "rb");

    $data = fread($fp, filesize($_FILES['userfile1']['tmp_name']));
    fclose($fp);
    $imgtype = $_FILES['userfile1']['type'];
    $imgsize = $_FILES['userfile1']['size'];
    $imgname = $_FILES['userfile1']['name'];
  }

  else {
    $data = '';
    $imgtype = '';
    $imgsize = '';
    $imgname = '';
  }

  // Store the image
  $artlib->add_topic($_REQUEST["name"], $imgname, $imgtype, $imgsize, $data);
}

if(isset($_REQUEST["remove"])) {
  $area = 'delarttopic';

  if($feature_ticketlib2 != 'y' or(isset($_POST['daconfirm']) and isset($_SESSION["ticket_$area"]))) {
    key_check($area);
    $artlib->remove_topic($_REQUEST["remove"]);
  }

  else {
    key_get($area);
  }
}

if(isset($_REQUEST["removeall"])) {
  $area = 'delarttopicall';

  if($feature_ticketlib2 != 'y' or(isset($_POST['daconfirm']) and isset($_SESSION["ticket_$area"]))) {
    key_check($area);
    $artlib->remove_topic($_REQUEST["removeall"], 1);
  }

  else {
    key_get($area);
  }
}

if(isset($_REQUEST["activate"])) {
  check_ticket('admin-topics');
  $artlib->activate_topic($_REQUEST["activate"]);
}

if(isset($_REQUEST["deactivate"])) {
  check_ticket('admin-topics');
  $artlib->deactivate_topic($_REQUEST["deactivate"]);
}

$topics = $artlib->list_topics();

$temp_max = count($topics);

for($i = 0; $i < $temp_max; $i++) {
  if($userlib->object_has_one_permission($topics[$i]["topicId"], 'topic')) {
    $topics[$i]["individual"] = 'y';

    if($userlib->object_has_permission($user, $topics[$i]["topicId"], 'topic', 'tiki_p_topic_read')) {
      $topics[$i]["individual_tiki_p_topic_read"] = 'y';
    }

    else {
      $topics[$i]["individual_tiki_p_topic_read"] = 'n';
    }

    if($tiki_p_admin == 'y' || $userlib->object_has_permission($user, $topics[$i]["topicId"], 'topic', 'tiki_p_admin_cms')) {
      $topics[$i]["individual_tiki_p_topic_read"] = 'y';
    }
  }

  else {
    $topics[$i]["individual"] = 'n';
  }
}

$smarty->assign('topics', $topics);
ask_ticket('admin-topics');
$section = 'cms';
include_once('tiki-section_options.php');

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

$smarty->assign('mid', 'tiki-admin_topics.tpl');
$smarty->display("tiki.tpl");

?>
