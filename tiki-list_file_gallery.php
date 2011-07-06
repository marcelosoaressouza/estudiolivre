<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-list_file_gallery.php,v 1.19.2.14 2007/03/02 12:23:26 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once('tiki-setup.php');

include_once('lib/filegals/filegallib.php');
include_once('lib/stats/statslib.php');

if($feature_categories == 'y') {
  global $categlib;

  if(!is_object($categlib)) {
    include_once('lib/categories/categlib.php');
  }
}

if($feature_file_galleries != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_file_galleries");

  $smarty->display("error.tpl");
  die;
}

if(!isset($_REQUEST["galleryId"])) {
  $smarty->assign('msg', tra("No gallery indicated"));

  $smarty->display("error.tpl");
  die;
}

if($_REQUEST["galleryId"] == 0) {
  $smarty->assign('msg', tra("Non-existent gallery"));

  $smarty->display("error.tpl");
  die;
}

if($_REQUEST["galleryId"] != 0) {
  $gal_info = $tikilib->get_file_gallery($_REQUEST["galleryId"]);
}

else {
  // This is an unreachable block. Remove this code or the verification above?
  // rbschmidt and lfagundes
  $gal_info["galleryId"] = 0;

  $gal_info["user"] = 'admin';
  $gal_info["name"] = 'System';
  $gal_info["public"] = 'y';
  $gal_info["description"] = 'System Gallery';
}

$smarty->assign('individual', 'n');

if($userlib->object_has_one_permission($_REQUEST["galleryId"], 'file gallery')) {
  $smarty->assign('individual', 'y');

  if($tiki_p_admin != 'y') {
    // Now get all the permissions that are set for this type of permissions 'file gallery'
    $perms = $userlib->get_permissions(0, -1, 'permName_desc', '', 'file galleries');

    foreach($perms["data"] as $perm) {
      $permName = $perm["permName"];

      if($userlib->object_has_permission($user, $_REQUEST["galleryId"], 'file gallery', $permName)) {
        $$permName = 'y';

        $smarty->assign("$permName", 'y');
      }

      else {
        $$permName = 'n';

        $smarty->assign("$permName", 'n');
      }
    }
  }
}

elseif($tiki_p_admin != 'y' && $feature_categories == 'y') {
  $perms_array = $categlib->get_object_categories_perms($user, 'file gallery', $_REQUEST['galleryId']);

  if($perms_array) {
    $is_categorized = TRUE;
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

if($tiki_p_admin_file_galleries == 'y') {
  $tiki_p_view_file_gallery = 'y';

  $smarty->assign("tiki_p_view_file_gallery", 'y');
  $tiki_p_upload_files = 'y';
  $smarty->assign("tiki_p_upload_files", 'y');
  $tiki_p_download_files = 'y';
  $smarty->assign("tiki_p_download_files", 'y');
  $tiki_p_create_file_galleries = 'y';
  $smarty->assign("tiki_p_create_file_galleries", 'y');

  if(isset($_REQUEST['delsel_x'])) {
    check_ticket('list-fgal');
    foreach(array_values($_REQUEST['file'])as $file) {
//Watches
      if($_REQUEST['file'] > 0) {
        $info = $filegallib->get_file_info($file);

        $smarty->assign('fileId', $file);
        $smarty->assign('galleryId', $_REQUEST['galleryId']);
        $smarty->assign_by_ref('filename', $info['filename']);
        $smarty->assign_by_ref('fname', $info['name']);
        $smarty->assign_by_ref('fdescription', $info['description']);
      }

      //      $filegallib->remove_file($file);
      $filegallib->remove_file($file, $_REQUEST['galleryId'], $info['name'], $info['filename'], $user);

    }
  }

  if(isset($_REQUEST['movesel'])) {
    check_ticket('list-fgal');
    foreach(array_values($_REQUEST['file'])as $file) {
      // To move a topic you just have to change the object
      $filegallib->set_file_gallery($file, $_REQUEST['moveto']);
    }
  }
}

if($tiki_p_view_file_gallery != 'y') {
  $smarty->assign('msg', tra("Permission denied you can not view this section"));

  $smarty->display("error.tpl");
  die;
}

$smarty->assign_by_ref('gal_info', $gal_info);
$smarty->assign_by_ref('owner', $gal_info["user"]);
$smarty->assign_by_ref('public', $gal_info["public"]);
$smarty->assign_by_ref('galleryId', $_REQUEST["galleryId"]);

$tikilib->add_file_gallery_hit($_REQUEST["galleryId"]);

if(isset($_REQUEST["remove"])) {
  // To remove an image the user must be the owner or admin
  if($tiki_p_admin_file_galleries != 'y' && (!$user || $user != $gal_info["user"])) {
    $smarty->assign('msg', tra("Permission denied you cannot remove files from this gallery"));
    $smarty->display("error.tpl");
    die;
  }

  $area = 'delfile';

  if($feature_ticketlib2 != 'y' or(isset($_POST['daconfirm']) and isset($_SESSION["ticket_$area"]))) {
    key_check($area);

//Watches
    if($_REQUEST['remove'] > 0) {
      $info = $filegallib->get_file_info($_REQUEST['remove']);

      $smarty->assign('fileId', $_REQUEST['remove']);
      $smarty->assign('galleryId', $_REQUEST['galleryId']);
      $smarty->assign_by_ref('filename', $info['filename']);
      $smarty->assign_by_ref('fname', $info['name']);
      $smarty->assign_by_ref('fdescription', $info['description']);
    }

    $filegallib->remove_file($_REQUEST['remove'], $_REQUEST['galleryId'], $info['name'], $info['filename'], $user);

    //$filegallib->remove_file($_REQUEST["remove"]);

  }

  else {
    key_get($area);
  }
}

$foo = parse_url($_SERVER["REQUEST_URI"]);
$smarty->assign('url', $tikilib->httpPrefix(). $foo["path"]);

// Init smarty variables to blank values
$smarty->assign('fname', '');
$smarty->assign('fdescription', '');

if(isset($_REQUEST["edit_mode"])and($_REQUEST['edit_mode'])) {
  $smarty->assign('edit_mode', 'y');

  $smarty->assign('edited', 'y');

  if($_REQUEST['fileId'] > 0) {
    $info = $filegallib->get_file_info($_REQUEST['fileId']);

    $smarty->assign('fileId', $_REQUEST['fileId']);
    $smarty->assign('galleryId', $_REQUEST['galleryId']);
    $smarty->assign_by_ref('filename', $info['filename']);
    $smarty->assign_by_ref('fname', $info['name']);
    $smarty->assign_by_ref('fdescription', $info['description']);
  }
}

if(isset($_REQUEST['edit'])) {
  check_ticket('list-fgal');

  if($tiki_p_admin_file_galleries != 'y') {
    if($tiki_p_upload_files != 'y') {
      // If you can't upload files then you can't edit a file you can't have a file
      $smarty->assign('msg', tra("Permission denied you can't upload files so you can't edit them"));

      $smarty->display("error.tpl");
      die;
    }

    // If the user can upload a file then check if he can edit THIS file
    if($_REQUEST["fileId"] > 0) {
      $info = $filegallib->get_file_info($_REQUEST["fileId"]);

      if(!$user || $info["user"] != $user) {
        $smarty->assign('msg', tra("Permission denied you cannot edit this file"));

        $smarty->display("error.tpl");
        die;
      }
    }
  }

  // Everything is ok so we proceed to edit the file
  $smarty->assign('edit_mode', 'y');
  $smarty->assign_by_ref('fname', $_REQUEST["fname"]);
  $smarty->assign_by_ref('fdescription', $_REQUEST["fdescription"]);

  $fid = $filegallib->replace_file($_REQUEST["fileId"], $_REQUEST["fname"], $_REQUEST["fdescription"]);

  /*
    $cat_type='file gallery';
    $cat_objid = $fgid;
    $cat_desc = substr($_REQUEST["description"],0,200);
    $cat_name = $_REQUEST["name"];
    $cat_href="tiki-list_file_gallery.php?galleryId=".$cat_objid;
    include_once("categorize.php");
  */
  $smarty->assign('edit_mode', 'n');
}

if(!isset($gal_info["maxRows"]))
  $gal_info["maxRows"] = 10;

if($gal_info["maxRows"] == 0)
  $gal_info["maxRows"] = 10;

$maxRecords = $gal_info["maxRows"];
$smarty->assign('maxRecords', $maxRecords);
$smarty->assign_by_ref('name', $gal_info["name"]);
$smarty->assign_by_ref('description', $gal_info["description"]);

if(!isset($_REQUEST["sort_mode"])) {
  $sort_mode = 'created_desc';

  $_REQUEST["sort_mode"] = 'created_desc';
}

else {
  $sort_mode = $_REQUEST["sort_mode"];
}

$smarty->assign_by_ref('sort_mode', $sort_mode);

// If offset is set use it if not then use offset =0
// use the maxRecords php variable to set the limit
// if sortMode is not set then use lastModif_desc
if(!isset($_REQUEST["offset"])) {
  $offset = 0;

  $_REQUEST["offset"] = 0;
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

  $_REQUEST["find"] = '';
}

$smarty->assign('find', $find);

$images = $tikilib->get_files($offset, $maxRecords, $sort_mode, $find, $_REQUEST["galleryId"]);
$cant_pages = ceil($images["cant"] / $maxRecords);
$smarty->assign_by_ref('cant_pages', $cant_pages);
$smarty->assign('actual_page', 1 + ($offset / $maxRecords));

if($images["cant"] > ($offset + $maxRecords)) {
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

$smarty->assign_by_ref('images', $images["data"]);

if($feature_file_galleries_comments == 'y') {
  $comments_per_page = $file_galleries_comments_per_page;

  $comments_default_ordering = $file_galleries_comments_default_ordering;
  $comments_vars = array(
                     'galleryId',
                     'offset',
                     'sort_mode'
                   );

  $comments_prefix_var = 'file gallery:';
  $comments_object_var = 'galleryId';
  include_once("comments.php");
}

$section = 'file_galleries';
include_once('tiki-section_options.php');

if($feature_theme_control == 'y') {
  $cat_type = 'file gallery';

  $cat_objid = $_REQUEST["galleryId"];
  include('tiki-tc.php');
}

// Watches
$galleryId = $_REQUEST["galleryId"];

if(!isset($_REQUEST["galleryName"])) {
  $galleryName = '';
}

else {
  $galleryName = $_REQUEST["galleryName"];
}

if($feature_user_watches == 'y') {
  if($user && isset($_REQUEST['watch_event'])) {
    check_ticket('index');

    if($_REQUEST['watch_action']=='add') {
      $tikilib->add_user_watch($user,$_REQUEST['watch_event'],$_REQUEST['watch_object'],'File Gallery',$galleryName,"tiki-list_file_gallery.php?galleryId=$galleryId");
    }

    else {
      $tikilib->remove_user_watch($user,$_REQUEST['watch_event'],$_REQUEST['watch_object']);
    }
  }

  $smarty->assign('user_watching_file_gallery','n');

  if($user && $watch = $tikilib->get_user_event_watches($user,'file_gallery_changed',$galleryId)) {
    $smarty->assign('user_watching_file_gallery','y');
  }
}



$all_galleries = $filegallib->list_file_galleries(0, -1, 'name_asc', $user, '');
$smarty->assign('all_galleries', $all_galleries['data']);
ask_ticket('list-fgal');

//add a hit
$statslib->stats_hit($gal_info["name"],"file gallery",$galleryId);

// Display the template
$smarty->assign('mid', 'tiki-list_file_gallery.tpl');
$smarty->display("tiki.tpl");

?>
