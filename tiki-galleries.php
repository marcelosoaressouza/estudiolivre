<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-galleries.php,v 1.27.2.27 2007/05/01 13:46:05 mose Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once('tiki-setup.php');

include_once("lib/imagegals/imagegallib.php");
include_once('lib/categories/categlib.php');
include_once('lib/map/usermap.php');

if($feature_galleries != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_galleries");

  $smarty->display("error.tpl");
  die;
}

if(isset($_REQUEST["find"])) {
  $find = $_REQUEST["find"];
}

else {
  $find = '';
}

$smarty->assign('find', $find);

if(!isset($_REQUEST["galleryId"])) {
  $_REQUEST["galleryId"] = 0;
}

$smarty->assign('galleryId', $_REQUEST["galleryId"]);

// This check should be done before checking individual permissions
if($tiki_p_view_image_gallery != 'y') {
  $smarty->assign('msg', tra("Permission denied you can not view this section"));

  $smarty->display("error.tpl");
  die;
}

// Individual permissions are checked because we may be trying to edit the gallery

// Check here for indivdual permissions the objectType is 'image galleries' and the id is galleryId
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

$foo = parse_url($_SERVER["REQUEST_URI"]);
$foo["path"] = str_replace("tiki-galleries", "tiki-browse_gallery", $foo["path"]);
$smarty->assign('url', $tikilib->httpPrefix(). $foo["path"]);

if(isset($_REQUEST['edit']) || isset($_REQUEST['preview']) || $_REQUEST["galleryId"] == 0) {
  if(!isset($_REQUEST['description'])) $_REQUEST['description'] = '';

  if(!isset($_REQUEST['maxRows'])) $_REQUEST['maxRows'] = 10;

  if(!isset($_REQUEST['rowImages'])) $_REQUEST['rowImages'] = 6;

  if(!isset($_REQUEST['thumbSizeX'])) $_REQUEST['thumbSizeX'] = 80;

  if(!isset($_REQUEST['thumbSizeY'])) $_REQUEST['thumbSizeY'] = 80;

  if(!isset($_REQUEST['sortorder'])) $_REQUEST['sortorder'] = 'created';

  if(!isset($_REQUEST['sortdirection'])) $_REQUEST['sortdirection'] = 'desc';

  if(!isset($_REQUEST['galleryimage'])) $_REQUEST['galleryimage'] = 'first';

  if(!isset($_REQUEST['parentgallery'])) $_REQUEST['parentgallery'] = -1;

  if(!isset($_REQUEST['defaultscale'])) $_REQUEST['defaultscale'] = 'o';
}

// Init smarty variables to blank values
//$smarty->assign('theme','');
$smarty->assign('name', '');
$smarty->assign('description', '');
$smarty->assign('maxRows', 10);
$smarty->assign('rowImages', 6);
$smarty->assign('thumbSizeX', 80);
$smarty->assign('thumbSizeY', 80);
$smarty->assign('public', 'n');
$smarty->assign('edited', 'n');
$smarty->assign('visible', 'y');
$smarty->assign('owner', $user);
$smarty->assign('geographic', 'n');
$smarty->assign('edit_mode', 'n');
$options_sortorder=array(tra('id') => 'imageId',
                         tra('Name') => 'name',
                         tra('Creation Date') => 'created',
                         tra('Owner') => 'user',
                         tra('Hits') => 'hits',
                         tra('Size') => 'filesize');
$smarty->assign_by_ref('options_sortorder',$options_sortorder);
$smarty->assign('sortorder','imageId');
$smarty->assign('sortorder','created');
$smarty->assign('sortdirection','desc');
$smarty->assign('showname','y');
$smarty->assign('showimageid','n');
$smarty->assign('showdescription','n');
$smarty->assign('showcreated','n');
$smarty->assign('showuser','n');
$smarty->assign('showhits','y');
$smarty->assign('showxysize','y');
$smarty->assign('showfilesize','n');
$smarty->assign('showfilename','n');
$options_galleryimage=array(tra('first uploaded image') => 'firstu',
                            tra('last uploaded image') => 'lastu',
                            tra('first image') => 'first',
                            tra('last image') => 'last',
                            tra('random image') => 'random');
$smarty->assign_by_ref('options_galleryimage',$options_galleryimage);
$smarty->assign('galleryimage','first');
$galleries_list=$imagegallib->list_galleries(0,-1,'name_desc',$user);
$smarty->assign_by_ref('galleries_list',$galleries_list['data']);
$smarty->assign('defaultscale','o');
$smarty->assign('parentgallery',-1);

// If we are editing an existing gallery prepare smarty variables
if(isset($_REQUEST["edit_mode"]) && $_REQUEST["edit_mode"]) {
  check_ticket('galleries');

  // Get information about this galleryID and fill smarty variables
  $smarty->assign('edit_mode', 'y');

  $smarty->assign('edited', 'y');

  if($_REQUEST["galleryId"] > 0) {
    if($info = $imagegallib->get_gallery_info($_REQUEST["galleryId"])) {

      $scaleinfo = $imagegallib->get_gallery_scale_info($_REQUEST["galleryId"]);
      $gallery_images = $imagegallib->get_images(0,-1,'name_asc',false,$_REQUEST['galleryId']);
      foreach($gallery_images['data'] as $key => $item) {
        $options_galleryimage[tra('Image').' '.$item['name']]=$item['imageId'];
      }
      //$smarty->assign_by_ref('theme',$info["theme"]);
      $smarty->assign_by_ref('name', $info["name"]);
      $smarty->assign_by_ref('description', $info["description"]);
      $smarty->assign_by_ref('maxRows', $info["maxRows"]);
      $smarty->assign_by_ref('rowImages', $info["rowImages"]);
      $smarty->assign_by_ref('thumbSizeX', $info["thumbSizeX"]);
      $smarty->assign_by_ref('thumbSizeY', $info["thumbSizeY"]);
      $smarty->assign_by_ref('public', $info["public"]);
      $smarty->assign_by_ref('visible', $info["visible"]);
      $smarty->assign_by_ref('owner', $info["user"]);
      $smarty->assign('sortorder',$info['sortorder']);
      $smarty->assign('sortdirection',$info['sortdirection']);
      $smarty->assign('galleryimage',$info['galleryimage']);
      $smarty->assign('parentgallery',$info['parentgallery']);
      $smarty->assign('showname',$info['showname']);
      $smarty->assign('showimageid',$info['showimageid']);
      $smarty->assign('showdescription',$info['showdescription']);
      $smarty->assign('showcreated',$info['showcreated']);
      $smarty->assign('showuser',$info['showuser']);
      $smarty->assign('showhits',$info['showhits']);
      $smarty->assign('showxysize',$info['showxysize']);
      $smarty->assign('showfilesize',$info['showfilesize']);
      $smarty->assign('showfilename',$info['showfilename']);
      $smarty->assign('defaultscale',$info['defaultscale']);
      $smarty->assign_by_ref('geographic', $info["geographic"]);
      $smarty->assign_by_ref('scaleinfo', $scaleinfo);
    }
  }
}

// Process the insertion or modification of a gallery here
if(isset($_REQUEST["edit"])) {
  check_ticket('galleries');

  // Saving information
  // If the user is not gallery admin
  if($tiki_p_admin_galleries != 'y') {
    if($tiki_p_create_galleries != 'y') {
      // If you can't create a gallery then you can't edit a gallery because you can't have a gallery
      $smarty->assign('msg', tra("Permission denied you cannot create galleries and so you cant edit them"));

      $smarty->display("error.tpl");
      die;
    }

    // If the user can create a gallery then check if he can edit THIS gallery
    if($_REQUEST["galleryId"] > 0) {
      $info = $imagegallib->get_gallery_info($_REQUEST["galleryId"]);

      if(!$user || $info["user"] != $user) {
        $smarty->assign('msg', tra("Permission denied you cannot edit this gallery"));

        $smarty->display("error.tpl");
        die;
      }
    }
  }

  // Everything is ok so we proceed to edit the gallery
  $smarty->assign('edit_mode', 'y');
  //$smarty->assign_by_ref('theme',$_REQUEST["theme"]);
  $smarty->assign_by_ref('name', $_REQUEST["name"]);
  $smarty->assign_by_ref('owner', $_REQUEST["owner"]);
  $smarty->assign_by_ref('description', $_REQUEST["description"]);
  $smarty->assign_by_ref('maxRows', $_REQUEST["maxRows"]);
  $smarty->assign_by_ref('rowImages', $_REQUEST["rowImages"]);
  $smarty->assign_by_ref('thumbSizeX', $_REQUEST["thumbSizeX"]);
  $smarty->assign_by_ref('thumbSizeY', $_REQUEST["thumbSizeY"]);
  $smarty->assign('sortorder',$_REQUEST['sortorder']);
  $smarty->assign('sortdirection',$_REQUEST['sortdirection']);
  $smarty->assign('galleryimage',$_REQUEST['galleryimage']);
  $smarty->assign('parentgallery',$_REQUEST['parentgallery']);
  $smarty->assign('defaultscale',$_REQUEST['defaultscale']);
  $auxarray=array('showname','showimageid','showdescription','showcreated','showuser','showhits','showxysize','showfilesize','showfilename');
  foreach($auxarray as $key => $item) {
    if(!isset($_REQUEST[$item])) {
      $_REQUEST[$item]='n';
    }

    $smarty->assign($item,$_REQUEST[$item]);
  }



  if(isset($_REQUEST["visible"]) && $_REQUEST["visible"] == "on") {
    $smarty->assign('visible', 'y');
    $visible = 'y';
  }

  else {
    $visible = 'n';
  }

  $smarty->assign_by_ref('visible', $visible);

  if(isset($_REQUEST["geographic"]) && $_REQUEST["geographic"] == "on") {
    $smarty->assign('geographic', 'y');
    $geographic = 'y';
  }

  else {
    $geographic = 'n';
  }

  $smarty->assign_by_ref('geographic', $geographic);

  if(isset($_REQUEST["public"]) && $_REQUEST["public"] == "on") {
    $smarty->assign('public', 'y');

    $public = 'y';
  }

  else {
    $public = 'n';
  }

  $smarty->assign_by_ref('public', $public);
  $gid = $imagegallib->replace_gallery($_REQUEST["galleryId"], $_REQUEST["name"], $_REQUEST["description"],
                                       '', $_REQUEST["owner"], $_REQUEST["maxRows"], $_REQUEST["rowImages"], $_REQUEST["thumbSizeX"], $_REQUEST["thumbSizeY"], $public,
                                       $visible,$_REQUEST['sortorder'],$_REQUEST['sortdirection'],$_REQUEST['galleryimage'],$_REQUEST['parentgallery'],
                                       $_REQUEST['showname'],$_REQUEST['showimageid'],$_REQUEST['showdescription'],$_REQUEST['showcreated'],
                                       $_REQUEST['showuser'],$_REQUEST['showhits'],$_REQUEST['showxysize'],$_REQUEST['showfilesize'],$_REQUEST['showfilename'],$_REQUEST['defaultscale'],$geographic);

#add scales

  if(isset($_REQUEST["scaleSize"])) {
    if(strstr($_REQUEST["scaleSize"],',')) {
      $sc = split(',',$_REQUEST["scaleSize"]);
      foreach($sc as $thisc) {
        $thisc = trim($thisc);

        if(is_numeric($thisc)) {
          $imagegallib->add_gallery_scale($gid, $thisc);
        }
      }
    }

    elseif(is_numeric($_REQUEST["scaleSize"])) {
      $imagegallib->add_gallery_scale($gid, $_REQUEST["scaleSize"]);
    }
  }

#remove scales
  $scaleinfo = $imagegallib->get_gallery_scale_info($_REQUEST["galleryId"]);

# loop though scales to determine if a scale has to be removed

  while(list($num, $sci) = each($scaleinfo)) {
    $removestr = 'removescale_'.$sci['scale'];

    if(isset($_REQUEST[$removestr]) && $_REQUEST[$removestr] == 'on') {
      $imagegallib->remove_gallery_scale($_REQUEST["galleryId"], $sci['scale']);
    }
  }

  $cat_type = 'image gallery';
  $cat_objid = $gid;
  $cat_desc = substr($_REQUEST["description"], 0, 200);
  $cat_name = $_REQUEST["name"];
  $cat_href = "tiki-browse_gallery.php?galleryId=" . $cat_objid;
  include_once("categorize.php");

  $smarty->assign('edit_mode', 'n');
  $smarty->assign('galleryId', '');
  $_REQUEST["galleryId"] = 0;
}

if(isset($_REQUEST["removegal"])) {
  if($tiki_p_admin_galleries != 'y') {
    $info = $imagegallib->get_gallery_info($_REQUEST["removegal"]);

    if(!$user || $info["user"] != $user) {
      $smarty->assign('msg', tra("Permission denied you cannot remove this gallery"));

      $smarty->display("error.tpl");
      die;
    }
  }

  $area = 'delgal';

  if($feature_ticketlib2 != 'y' or(isset($_POST['daconfirm']) and isset($_SESSION["ticket_$area"]))) {
    key_check($area);
    $imagegallib->remove_gallery($_REQUEST["removegal"]);
  }

  else {
    key_get($area);
  }
}

$map_error="";

if(isset($_REQUEST["make_map"])) {
  if($_REQUEST["galleryId"] > 0) {
    $info = $imagegallib->get_gallery_info($_REQUEST["galleryId"]);

    if($tiki_p_admin != 'y' || !$user || $info["user"] != $user) {
      $smarty->assign('msg', tra("Permission denied you cannot make the map of this gallery"));
      $smarty->display("error.tpl");
      die;
    }

    $tdo = "gal.".strtr(trim($info["name"])," ","_");

    if($tikidomain) {
      $tdo = "$tikidomain.".$tdo;
    }

    $map_error=$mapslib->makeimagemap($tdo,$_REQUEST["galleryId"]);
  }
}

$smarty->assign('map_error', $map_error);

if(!isset($_REQUEST["sort_mode"])) {
  $sort_mode = 'name_asc';
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
}

else {
  $offset = $_REQUEST["offset"];
}

$smarty->assign_by_ref('offset', $offset);

// Get the list of libraries available for this user (or public galleries)
global $imagegallib;

if(!is_object($imagegallib)) {
  require_once('lib/imagegals/imagegallib.php');
}

$galleries = $imagegallib->list_galleries($offset, $maxRecords, $sort_mode, 'admin', $find);

if(!empty($_REQUEST['filter']))
  $smarty->assign('filter', $_REQUEST["filter"]);

$temp_max = count($galleries["data"]);

for($i = 0; $i < $temp_max; $i++) {

  // check if has subgalleries (parent of any children)
  $maxImages = 1;
  $subgals = $imagegallib->get_subgalleries($offset, $maxImages, '', '', $galleries["data"][$i]["galleryId"]);

  if(count($subgals['data']) > 0) {
    $galleries["data"][$i]["parentgal"] = 'y';
  }

  else {
    $galleries["data"][$i]["parentgal"] = 'n';
  }

  if($userlib->object_has_one_permission($galleries["data"][$i]["galleryId"], 'image gallery')) {
    $galleries["data"][$i]["individual"] = 'y';

    $galleries["data"][$i]["individual_tiki_p_view_image_gallery"] = 'y';

    if($userlib->object_has_permission($user, $galleries["data"][$i]["galleryId"], 'image gallery', 'tiki_p_upload_images')) {
      $galleries["data"][$i]["individual_tiki_p_upload_images"] = 'y';
    }

    else {
      $galleries["data"][$i]["individual_tiki_p_upload_images"] = 'n';
    }

    if($userlib->object_has_permission($user, $galleries["data"][$i]["galleryId"], 'image gallery', 'tiki_p_create_galleries'))
    {
      $galleries["data"][$i]["individual_tiki_p_create_galleries"] = 'y';
    }

    else {
      $galleries["data"][$i]["individual_tiki_p_create_galleries"] = 'n';
    }

    if($tiki_p_admin == 'y' || $userlib->object_has_permission($user, $galleries["data"][$i]["galleryId"], 'image gallery',
        'tiki_p_admin_galleries')) {
      $galleries["data"][$i]["individual_tiki_p_create_galleries"] = 'y';

      $galleries["data"][$i]["individual_tiki_p_upload_images"] = 'y';
      $galleries["data"][$i]["individual_tiki_p_view_image_gallery"] = 'y';
    }
  }

  else {
    $galleries["data"][$i]["individual"] = 'n';
  }
}

// If there're more records then assign next_offset
$cant_pages = ceil($galleries["cant"] / $maxRecords);
$smarty->assign_by_ref('cant_pages', $cant_pages);
$smarty->assign('actual_page', 1 + ($offset / $maxRecords));

if($galleries["cant"] > ($offset + $maxRecords)) {
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

$smarty->assign_by_ref('galleries', $galleries["data"]);
//print_r($galleries["data"]);
$cat_type = 'image gallery';
$cat_objid = $_REQUEST["galleryId"];
include_once("categorize_list.php");

$defaultRows = 5;
include_once("textareasize.php");

$section = 'galleries';
include_once('tiki-section_options.php');
ask_ticket('galleries');

// Display the template
$smarty->assign('mid', 'tiki-galleries.tpl');
$smarty->display("tiki.tpl");

?>
