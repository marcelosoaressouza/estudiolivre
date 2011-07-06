<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-upload_file.php,v 1.28.2.9 2007/03/02 12:23:26 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once('tiki-setup.php');

include_once('lib/filegals/filegallib.php');

if($feature_file_galleries != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_file_galleries");

  $smarty->display("error.tpl");
  die;
}

// Now check permissions to access this page
if($tiki_p_upload_files != 'y') {
  $smarty->assign('msg', tra("Permission denied you cannot upload files"));

  $smarty->display("error.tpl");
  die;
}

$foo = parse_url($_SERVER["REQUEST_URI"]);
$foo1 = str_replace("tiki-upload_file", "tiki-download_file", $foo["path"]);
$smarty->assign('url_browse', $tikilib->httpPrefix(). $foo1);

if(!isset($_REQUEST["description"]))
  $_REQUEST["description"] = '';

$smarty->assign('show', 'n');

if(isset($_REQUEST['fileId']))
  $editFileId = $_REQUEST['fileId'];

$editFile = false;

if(!empty($editFileId)) {
  $fileInfo = $filegallib->get_file_info($editFileId);

  if(empty($fileInfo) || $fileInfo == null || $fileInfo['galleryId'] != $_REQUEST['galleryId']) {
    $smarty->assign('msg', tra("Could not find the file requested"));
    $smarty->display("error.tpl");
    die;
  }

  if(!empty($_REQUEST['name']))
    $fileInfo['name']=$_REQUEST['name'];

  if(!empty($_REQUEST['description']))
    $fileInfo['description']=$_REQUEST['description'];

  $smarty->assign('fileInfo',$fileInfo);
  $smarty->assign('editFileId',$editFileId);
  $editFile = true;
}

// Process an upload here
if(isset($_REQUEST["upload"])) {
  check_ticket('upload-file');
  // Check here if it is an upload or an URL
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

  if($tiki_p_admin_file_galleries == 'y') {
    $tiki_p_upload_files = 'y';
  }

  if($tiki_p_upload_files != 'y') {
    $smarty->assign('msg', tra("Permission denied you cannot upload files"));

    $smarty->display("error.tpl");
    die;
  }

  $gal_info = $tikilib->get_file_gallery($_REQUEST["galleryId"]);

  // Check the user to be admin or owner or the gallery is public
  if($tiki_p_admin_file_galleries != 'y' && (!$user || $user != $gal_info["user"]) && $gal_info["public"] != 'y') {
    $smarty->assign('msg', tra("Permission denied you can upload files but not to this file gallery"));

    $smarty->display("error.tpl");
    die;
  }

  $error_msg = '';

  $errors = array();
  $uploads = array();

  $didFileReplace = false;

  for($i = 1; $i <= 6; $i++) {
    // We process here file uploads
    if(isset($_FILES["userfile$i"]) && !empty($_FILES["userfile$i"]['name'])) {
      // Were there any problems with the upload?  If so, report here.
      if(!is_uploaded_file($_FILES["userfile$i"]['tmp_name'])) {
        $errors[] = tra('Upload was not successful').': '.FileGalLib::convert_error_to_string($_FILES["userfile$i"]['error']);
        continue;
      }


      // Check the name
      if(!empty($fgal_match_regex)) {
        if(!preg_match("/$fgal_match_regex/", $_FILES["userfile$i"]['name'], $reqs)) {
          $errors[] = tra('Invalid filename (using filters for filenames)'). ': ' . $_FILES["userfile$i"]['name'];
        }
      }

      if(!empty($fgal_nmatch_regex)) {
        if(preg_match("/$fgal_nmatch_regex/", $_FILES["userfile$i"]['name'], $reqs)) {
          $errors[] = tra('Invalid filename (using filters for filenames)'). ': ' . $_FILES["userfile$i"]['name'];
        }
      }

      $name = $_FILES["userfile$i"]['name'];

      if(isset($_REQUEST["isbatch"]) && $_REQUEST["isbatch"] == 'on' && strtolower(substr($name, strlen($name) - 3)) == 'zip') {
        if($tiki_p_batch_upload_files == 'y') {
          $filegallib->process_batch_file_upload($_REQUEST["galleryId"], $_FILES["userfile$i"]['tmp_name'],
                                                 $user, $_REQUEST["description"]);

          header("location: tiki-list_file_gallery.php?galleryId=" . $_REQUEST["galleryId"]);
          die;
        }

        else {
          $smarty->assign('msg', tra('No permission to upload zipped file packages'));

          $smarty->display("error.tpl");
          die;
        }
      }

      $file_name = $_FILES["userfile$i"]['name'];
      $file_tmp_name = $_FILES["userfile$i"]['tmp_name'];
      $tmp_dest = $tmpDir . "/" . $file_name.".tmp";

      if(!move_uploaded_file($file_tmp_name, $tmp_dest)) {
        $smarty->assign('msg', tra('Errors detected'));
        $smarty->display("error.tpl");
        die();
      }


      $fp = fopen($tmp_dest, "rb");

      if(!$fp) {
        $errors[] = tra('Cannot read file');
      }

      $data = '';
      $fhash = '';

      if($fgal_use_db == 'n') {
        $fhash = md5($name = $_FILES["userfile$i"]['name']);

        $fhash = md5(uniqid($fhash));
        @$fw = fopen($fgal_use_dir . $fhash, "wb");

        if(!$fw) {
          $errors[] = tra('Cannot write to this file:').$fgal_use_dir.$fhash;
        }
      }

      while(!feof($fp)) {
        if($fgal_use_db == 'y') {
          $data .= fread($fp, 8192 * 16);
        }

        else {
          $data = fread($fp, 8192 * 16);

          fwrite($fw, $data);
        }
      }

      fclose($fp);
      // remove file after copying it to the right location or database
      @unlink($tmp_dest);

      if($fgal_use_db == 'n') {
        fclose($fw);

        $data = '';
      }

      $size = $_FILES["userfile$i"]['size'];
      $name = $_FILES["userfile$i"]['name'];
      $type = $_FILES["userfile$i"]['type'];

      if(count($errors)) {
        break;
      }

      if($fgal_use_db == 'y') {
        if(!isset($data) || strlen($data) < 1) {
          $errors[] = tra('Upload was not successful'). ': ' . $name;
        }
      }

      if(!isset($_REQUEST['name']))
        $_REQUEST['name'] = $name;

      if(isset($data)) {
        if($editFile) {
          $fileId = $filegallib->replace_file($editFileId, $_REQUEST["name"], $_REQUEST["description"], $name, $data, $size, $type, $user, $fhash);
          $didFileReplace = true;
        }

        else
          $fileId = $filegallib->insert_file($_REQUEST["galleryId"], $_REQUEST["name"], $_REQUEST["description"], $name, $data, $size, $type, $user, $fhash);

        if(!$fileId) {
          $errors[] = tra('Upload was not successful'). ': ' . $name;

          if($fgal_use_db == 'n') {
            @unlink($fgal_use_dir . $fhash);
          }

        }

        if(count($errors) == 0) {
          $aux['name'] = $name;

          $aux['size'] = $size;
          $aux['fileId'] = $fileId;
          $uploads[] = $aux;
        }
      }
    }
  }

  if($editFile && !$didFileReplace) {
    $filegallib->update_file($editFileId, $_REQUEST["name"], $_REQUEST["description"],$user);
    $fileChangedMessage = tra('File update was successful').': '.$_REQUEST['name'];
    $smarty->assign('fileChangedMessage',$fileChangedMessage);
  }

  $smarty->assign('errors', $errors);
  $smarty->assign('uploads', $uploads);
}

// Get the list of galleries to display the select box in the template
if(isset($_REQUEST["galleryId"])) {
  $smarty->assign_by_ref('galleryId', $_REQUEST["galleryId"]);
}

else {
  $smarty->assign('galleryId', '');
}

if($tiki_p_admin_file_galleries != 'y') {
  $galleries = $tikilib->list_visible_file_galleries(0, -1, 'lastModif_desc', $user, '');
}

else {
  $galleries = $filegallib->list_file_galleries(0, -1, 'lastModif_desc', $user, '');
}

$temp_max = count($galleries["data"]);

for($i = 0; $i < $temp_max; $i++) {
  if($userlib->object_has_one_permission($galleries["data"][$i]["galleryId"], 'file gallery')) {
    $galleries["data"][$i]["individual"] = 'y';

    if($userlib->object_has_permission($user, $galleries["data"][$i]["galleryId"], 'file gallery', 'tiki_p_view_file_gallery'))
    {
      $galleries["data"][$i]["individual_tiki_p_view_file_gallery"] = 'y';
    }

    else {
      $galleries["data"][$i]["individual_tiki_p_view_file_gallery"] = 'n';
    }

    if($userlib->object_has_permission($user, $galleries["data"][$i]["galleryId"], 'file gallery', 'tiki_p_upload_files')) {
      $galleries["data"][$i]["individual_tiki_p_upload_files"] = 'y';
    }

    else {
      $galleries["data"][$i]["individual_tiki_p_upload_files"] = 'n';
    }

    if($userlib->object_has_permission($user, $galleries["data"][$i]["galleryId"], 'file gallery', 'tiki_p_download_files')) {
      $galleries["data"][$i]["individual_tiki_p_download_files"] = 'y';
    }

    else {
      $galleries["data"][$i]["individual_tiki_p_download_files"] = 'n';
    }

    if($userlib->object_has_permission($user, $galleries["data"][$i]["galleryId"], 'file gallery',
                                       'tiki_p_create_file_galleries')) {
      $galleries["data"][$i]["individual_tiki_p_create_file_galleries"] = 'y';
    }

    else {
      $galleries["data"][$i]["individual_tiki_p_create_file_galleries"] = 'n';
    }

    if($tiki_p_admin == 'y' || $userlib->object_has_permission($user, $galleries["data"][$i]["galleryId"], 'file gallery',
        'tiki_p_admin_file_galleries')) {
      $galleries["data"][$i]["individual_tiki_p_create_file_galleries"] = 'y';

      $galleries["data"][$i]["individual_tiki_p_download_files"] = 'y';
      $galleries["data"][$i]["individual_tiki_p_upload_files"] = 'y';
      $galleries["data"][$i]["individual_tiki_p_view_file_gallery"] = 'y';
    }
  }

  else {
    $galleries["data"][$i]["individual"] = 'n';
  }
}

$smarty->assign_by_ref('galleries', $galleries["data"]);

$section = 'file_galleries';
include_once('tiki-section_options.php');

ask_ticket('upload-file');

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

// Display the template
$smarty->assign('mid', 'tiki-upload_file.tpl');
$smarty->display("tiki.tpl");

?>
