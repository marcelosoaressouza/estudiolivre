<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-pagehistory.php,v 1.15.2.26 2007/07/03 13:14:35 sylvieg Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
$section = 'wiki';
require_once('tiki-setup.php');

include_once('lib/wiki/histlib.php');

if($feature_wiki != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_wiki");

  $smarty->display("error.tpl");
  die;
}

if($feature_history != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_history");

  $smarty->display("error.tpl");
  die;
}

// Get the page from the request var or default it to HomePage
if(!isset($_REQUEST["page"])) {
  $smarty->assign('msg', tra("No page indicated"));

  $smarty->display("error.tpl");
  die;
}

else {
  $page = $_REQUEST["page"];

  $smarty->assign_by_ref('page', $_REQUEST["page"]);
}

include_once("tiki-pagesetup.php");

// Now check permissions to access this page
if(!$tikilib->user_has_perm_on_object($user, $_REQUEST["page"],'wiki page','tiki_p_view')  || (isset($tiki_p_wiki_view_history) && $tiki_p_wiki_view_history != 'y')) {
  $smarty->assign('msg', tra("Permission denied you cannot browse this page history"));

  $smarty->display("error.tpl");
  die;
}

// If the page doesn't exist then display an error
if(!$tikilib->page_exists($page)) {
  $smarty->assign('msg', tra("Page cannot be found"));

  $smarty->display("error.tpl");
  die;
}

if(isset($_REQUEST["delete"]) && isset($_REQUEST["hist"])) {
  check_ticket('page-history');
  foreach(array_keys($_REQUEST["hist"])as $version) {
    $histlib->remove_version($_REQUEST["page"], $version);
  }
}

$info = $tikilib->get_page_info($page);
$smarty->assign_by_ref('info', $info);

if(isset($_REQUEST['oldver'])) {
  $oldver=(int)$_REQUEST["oldver"];
}

else $oldver=0;

if(isset($_REQUEST['newver'])) {
  $newver=(int)$_REQUEST["newver"];
}

else $newver=0;

if(isset($_REQUEST['source'])) $source=$_REQUEST['source'];

if(isset($_REQUEST['version'])) $rversion=$_REQUEST['version'];

if(isset($_REQUEST['preview'])) $preview=$_REQUEST["preview"];

$smarty->assign('source', false);

if(isset($source)) {
  if($source == '' && isset($rversion)) {
    $source = $rversion;
  }

  if($source == $info["version"] || $source == 0) {
    $smarty->assign('sourced', nl2br($info["data"]));
    $smarty->assign('source', $info['version']);
  }

  else {
    $version = $histlib->get_version($page, $source);

    if($version) {
      $smarty->assign('sourced', nl2br($version["data"]));
      $smarty->assign('source', $source);
    }
  }

  if($source == 0) {
    $smarty->assign('noHistory', true);
  }
}

$smarty->assign('preview', false);

if(isset($preview)) {
  if($preview == '' && isset($rversion)) {
    $preview = $rversion;
  }

  if($preview == $info["version"] || $preview == 0) {
    $previewd = $tikilib->parse_data($info["data"]);
    $smarty->assign_by_ref('previewd', $previewd);
    $smarty->assign('preview', $info['version']);
  }

  else {
    $version = $histlib->get_version($page, $preview);

    if($version) {
      $previewd = $tikilib->parse_data($version["data"]);
      $smarty->assign_by_ref('previewd', $previewd);
      $smarty->assign('preview', $preview);
    }
  }

  if($preview == 0) {
    $smarty->assign('noHistory', true);
  }
}

// fetch page history, but omit the actual page content (to save memory)
$history = $histlib->get_page_history($page,false);
$smarty->assign_by_ref('history', $history);

if(isset($_REQUEST["diff2"])) {  // previous compatibility
  if($_REQUEST["diff2"] == '' && isset($rversion)) {
    $_REQUEST["diff2"] = $rversion;
  }

  $_REQUEST["compare"] = "y";
  $oldver = (int)$_REQUEST["diff2"];
}

if(!isset($newver)) {
  $newver = 0;
}

if(isset($_REQUEST["compare"])) {
  if($oldver == 0 || $oldver == $info["version"]) {
    $old = & $info;
    $smarty->assign_by_ref('old', $info);
  }

  else {
    // fetch the required page from history, including its content
    if($histlib->version_exists($page, $oldver)) {
      $old = $histlib->get_page_from_history($page,$oldver,true);
      $smarty->assign_by_ref('old', $old);
    }
  }

  if($newver == 0 || $newver == $info["version"]) {
    $new =& $info;
    $smarty->assign_by_ref('new', $info);
  }

  else {
    // fetch the required page from history, including its content
    if($histlib->version_exists($page, $newver)) {
      $new = $histlib->get_page_from_history($page,$newver,true);
      $smarty->assign_by_ref('new', $new);
    }
  }

  if(!isset($_REQUEST["diff_style"]) || $_REQUEST["diff_style"] == "old")
    $_REQUEST["diff_style"] = 'unidiff';

  $smarty->assign('diff_style', $_REQUEST["diff_style"]);

  if($_REQUEST["diff_style"] == "sideview") {
    $old["data"] = $tikilib->parse_data($old["data"]);
    $new["data"] = $tikilib->parse_data($new["data"]);
  }

  else {
    require_once('lib/diff/difflib.php');
    $html = diff2($old["data"], $new["data"], $_REQUEST["diff_style"]);
    $smarty->assign_by_ref('diffdata', $html);
  }
}

else
  $smarty->assign('diff_style', '');

if($info["flag"] == 'L')
  $smarty->assign('lock',true);

else
  $smarty->assign('lock',false);

$smarty->assign('page_user',$info['user']);

ask_ticket('page-history');

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

$cat_type = 'wiki page';
$cat_objid = $page;
include_once('tiki-section_options.php');

// Display the template
$smarty->assign('mid', 'tiki-pagehistory.tpl');
$smarty->assign('show_page_bar', 'y');
$smarty->display("tiki.tpl");

?>
