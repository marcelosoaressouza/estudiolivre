<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-browse_categories.php,v 1.18.2.23 2007/03/14 17:40:34 sylvieg Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.





// Initialization
require_once('tiki-setup.php');

include_once('lib/categories/categlib.php');
include_once('lib/tree/categ_browse_tree.php');

if($feature_categories != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_categories");

  $smarty->display("error.tpl");
  die;
}

if($tiki_p_view_categories != 'y') {
  $smarty->assign('msg', tra("You do not have permission to use this feature"));
  $smarty->display("error.tpl");
  die;
}

// Check for parent category or set to 0 if not present
if(!isset($_REQUEST["parentId"])) {
  $_REQUEST["parentId"] = 0;
}

$smarty->assign('parentId', $_REQUEST["parentId"]);

if(!isset($_REQUEST["sort_mode"])) {
  $sort_mode = 'name_asc';
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

if(!isset($_REQUEST["type"])) {
  $type = '';
}

else {
  $type = $_REQUEST["type"];
}

$smarty->assign('type', $type);

if(isset($_REQUEST["find"])) {
  $find = $_REQUEST["find"];
}

else {
  $find = '';
}

$smarty->assign('find', $find);
$smarty->assign_by_ref('sort_mode', $sort_mode);

if(isset($_REQUEST["deep"]) && $_REQUEST["deep"] == 'on') {
  $deep = 'on';
  $smarty->assign('deep', 'on');
}

else {
  $deep = 'off';
  $smarty->assign('deep', 'off');
}

$canView = false;

if(is_array($_REQUEST['parentId'])) {
  foreach($_REQUEST['parentId'] as $p) {
    $paths[] = $categlib->get_category_path($p);
    $p_info = $categlib->get_category($p);

    if($userlib->user_has_perm_on_object($user,$p_info['categId'],'category','tiki_p_view_categories')) {
      $canView = true;
    }
  }
  $smarty->assign('paths', $paths);
}

else {
// If the parent category is not zero get the category path
  if($_REQUEST["parentId"]) {
    $path = $categlib->get_category_path($_REQUEST["parentId"]);
    $p_info = $categlib->get_category($_REQUEST["parentId"]);
    $father = $p_info["parentId"];
    $smarty->assign_by_ref('p_info', $p_info);

    if($userlib->user_has_perm_on_object($user,$p_info['categId'],'category','tiki_p_view_categories')) {
      $canView = true;
    }
  }

  else {
    $path = tra("TOP");
    $father = 0;
    $canView = true;
  }

  $smarty->assign('path', $path);
  $smarty->assign('father', $father);
}

if(!$canView) {
  $smarty->assign('msg',tra("Permission denied you cannot view this page"));
  $smarty->display("error.tpl");
  die;
}

//$ctall = $categlib->get_all_categories();
$ctall = $categlib->get_all_categories_respect_perms($user, 'tiki_p_view_categories');

if($feature_phplayers == 'y') {
  if(!function_exists("mktree")) {
    function mktree($ind,$indent="",$back) {
      global $ctall, $deep, $type;
      include_once('lib/smarty_tiki/modifier.tr_if.php');
      $kids = array();
      foreach($ctall as $v) {
        if($v['parentId'] == $ind) {
          $kids[] = $v;
        }
      }

      if(count($kids)) {
        foreach($kids as $k) {
          $back.= $indent."|";
          $back.= smarty_modifier_tr_if($k['name']);
          $back.= "|tiki-browse_categories.php?parentId=".$k['categId']."&amp;type=".urlencode($type)."&amp;deep=$deep\n";
          $back.= mktree($k['categId'],".$indent","");
        }
        return $back;
      }

      else {
        return "";
      }
    }
  }

  $itall = mktree(0,".","");
  include_once("lib/phplayers/lib/PHPLIB.php");
  include_once("lib/phplayers_tiki/lib/layersmenu-common.inc.php");  // include Tiki's modified version of that file to keep original intact (luci)
  include_once("lib/phplayers/lib/treemenu.inc.php");
  $phplayers = new TreeMenu();
  $phplayers->setDirrootCommon("lib/phplayers");
  $phplayers->setLibjsdir("lib/phplayers/libjs/");
  $phplayers->setImgdir("lib/phplayers/images/");
  $phplayers->setImgwww("lib/phplayers/menuimages/");
  $phplayers->setTpldirCommon("lib/phplayers/templates/");

  if($itall) {
    $phplayers->setMenuStructureString($itall);
  }

  $phplayers->parseStructureForMenu("treemenu1");
  $phpitall = $phplayers->newTreeMenu("treemenu1");
  $smarty->assign('tree', $phpitall);
}

else {
  $tree_nodes = array();
  foreach($ctall as $c) {
    $tree_nodes[] = array(
                      "id" => $c["categId"],
                      "parent" => $c["parentId"],
                      "data" => '<a class="catname" href="tiki-browse_categories.php?parentId=' . $c["categId"] . '&amp;deep='.$deep.'&amp;type='.urlencode($type).'">' . $c["name"] . '</a><br />'
                    );
  }
  $tm = new CatBrowseTreeMaker("categ");
  $res = $tm->make_tree($_REQUEST["parentId"], $tree_nodes);
  $smarty->assign('tree', $res);
}

$objects = $categlib->list_category_objects($_REQUEST["parentId"], $offset, $maxRecords, $sort_mode, $type, $find, $deep=='on', (!empty($_REQUEST['and']))?true:false);

if($deep == 'on') {
  for($i = count($objects["data"]) - 1; $i >=0; --$i)
    $objects['data'][$i]['categName'] = $tikilib->other_value_in_tab_line($ctall, $objects['data'][$i]['categId'], 'categId', 'name');
}

$smarty->assign_by_ref('objects', $objects["data"]);
$smarty->assign_by_ref('cantobjects', $objects["cant"]);

$cant_pages = ceil($objects["cant"] / $maxRecords);
$smarty->assign_by_ref('cant_pages', $cant_pages);
$smarty->assign('actual_page', 1 + ($offset / $maxRecords));

if($objects["cant"] > ($offset + $maxRecords)) {
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

$section = 'categories';
include_once('tiki-section_options.php');
ask_ticket('browse-categories');

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

// Display the template
$smarty->assign('mid', 'tiki-browse_categories.tpl');
$smarty->display("tiki.tpl");

?>
