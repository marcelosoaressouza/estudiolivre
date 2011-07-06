<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-edit_image.php,v 1.10.2.9 2007/03/02 12:23:24 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once('tiki-setup.php');

include_once("lib/imagegals/imagegallib.php");

if($feature_categories == 'y') {
  global $categlib;

  if(!is_object($categlib)) {
    include_once('lib/categories/categlib.php');
  }
}

if($feature_galleries != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_galleries");

  $smarty->display("error.tpl");
  die;
}

// Sanity anyone?
if(!$_REQUEST['edit'] or !$_REQUEST['galleryId']) {
  $smarty->assign('msg', tra("Invalid request to edit an image"));

  $smarty->display("error.tpl");
  die;
}

// Now check permissions to access this page
if($tiki_p_upload_images != 'y') {
  $smarty->assign('msg', tra("Permission denied you cannot edit images"));

  $smarty->display("error.tpl");
  die;
}

$foo = parse_url($_SERVER["REQUEST_URI"]);
$foo1 = str_replace("tiki-edit_image", "tiki-browse_image", $foo["path"]);
$foo2 = str_replace("tiki-edit_image", "show_image", $foo["path"]);
$smarty->assign('url_browse', $tikilib->httpPrefix(). $foo1);
$smarty->assign('url_show', $tikilib->httpPrefix(). $foo2);

if(isset($_REQUEST["editimage"])) {
  check_ticket('edit-image');
  $smarty->assign('individual', 'n');

  if($userlib->object_has_one_permission($_REQUEST["galleryId"], 'image gallery')) {
    $smarty->assign('individual', 'y');

    if($tiki_p_admin != 'y') {
      // Now get all the permissions that are set for this type of permissions 'image gallery'
      $perms = $userlib->get_permissions(0, -1, 'permName_desc', '', 'image galleries');

      foreach($perms["data"] as $perm) {
        $permName = $perm["permName"];

        if($userlib->object_has_permission($user, $_REQUEST["galleryId"], 'image gallery', $permName)) {
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
    $perms_array = $categlib->get_object_categories_perms($user, 'image gallery', $_REQUEST['galleryId']);

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


  if($tiki_p_admin_galleries == 'y') {
    $tiki_p_view_image_gallery = 'y';

    $tiki_p_upload_images = 'y';
    $tiki_p_create_galleries = 'y';
  }

  if($tiki_p_upload_images != 'y') {
    $smarty->assign('msg', tra("Permission denied you cannot edit images"));

    $smarty->display("error.tpl");
    die;
  }

  $gal_info = $imagegallib->get_gallery($_REQUEST["galleryId"]);

  if($gal_info["thumbSizeX"] == 0)
    $gal_info["thumbSizeX"] = 80;

  if($gal_info["thumbSizeY"] == 0)
    $gal_info["thumbSizeY"] = 80;

  // Check the user to be admin or owner or the gallery is public
  if($tiki_p_admin_galleries != 'y' && (!$user || $user != $gal_info["user"]) && $gal_info["public"] != 'y') {
    $smarty->assign('msg', tra("Permission denied you can edit images but not in this gallery"));

    $smarty->display("error.tpl");
    die;
  }

  $error_msg = '';

  // Avoid warnings
  if($feature_maps != 'y') {
    $_REQUEST['lat'] = '';
    $_REQUEST['lon'] = '';
  }

  if($imagegallib->edit_image($_REQUEST['edit'], $_REQUEST['name'], $_REQUEST['description'],$_REQUEST['lat'],$_REQUEST['lon'])) {
    $smarty->assign('show', 'y');
    $cat_type = 'image';
    $cat_objid = $_REQUEST["edit"];
    $cat_desc = $_REQUEST['description'];
    $cat_lat = $_REQUEST['lat'];
    $cat_lon = $_REQUEST['lon'];
    $cat_name = $_REQUEST['name'];
    $cat_href = "tiki-browse_image.php?imageId=".$cat_objid;
    include_once("categorize.php");

  }

  else {
    $smarty->assign('msg', tra("Failed to edit the image"));

    $smarty->display("error.tpl");
    die;
  }
}

$info = $imagegallib->get_image($_REQUEST["edit"]);
$smarty->assign('show', 'n');
$smarty->assign_by_ref('imageId', $_REQUEST['edit']);
$smarty->assign_by_ref('galleryId', $info['galleryId']);
$smarty->assign_by_ref('name', $info['name']);
$smarty->assign_by_ref('description', $info['description']);
$smarty->assign_by_ref('lat', $info['lat']);
$smarty->assign_by_ref('lon', $info['lon']);

$cat_type = 'image';
$cat_objid = $_REQUEST["edit"];
include_once("categorize_list.php");

ask_ticket('edit-image');

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

// Display the template
$smarty->assign('mid', 'tiki-edit_image.tpl');
$smarty->display("tiki.tpl");

?>
