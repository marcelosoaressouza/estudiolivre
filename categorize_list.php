<?php

// $Header: /cvsroot/tikiwiki/tiki/categorize_list.php,v 1.10.2.10 2007/06/30 12:09:21 sylvieg Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

//this script may only be included - so its better to die if called directly.
if(strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== FALSE) {
  //smarty is not there - we need setup
  require_once('tiki-setup.php');
  $smarty->assign('msg',tra("This script cannot be called directly"));
  $smarty->display("error.tpl");
  die;
}

if($feature_categories == 'y') {
  global $categlib, $user;
  include_once('lib/categories/categlib.php');
  $smarty->assign('cat_categorize', 'n');

  if(isset($_REQUEST["cat_categorize"]) && $_REQUEST["cat_categorize"] == 'on') {
    $smarty->assign('cat_categorize', 'y');
  }

  $cats = $categlib->get_object_categories($cat_type, $cat_objid);
  $all_categories = $categlib->list_categs();
  $categories = array();

  for($i = 0; $i < count($all_categories); $i++) {
    if($userlib->user_has_perm_on_object($user,$all_categories[$i]['categId'],'category','tiki_p_view_categories')) {
      $categories[] = $all_categories[$i];
    }
  }

  if(isset($categories)) {
    $num_categories = count($categories);
  }

  else {
    $num_categories = 0;
  }

  for($i = 0; $i < $num_categories; $i++) {
    if(!empty($cats) && in_array($categories[$i]["categId"], $cats)) {
      $categories[$i]["incat"] = 'y';
    }

    else {
      $categories[$i]["incat"] = 'n';
    }

    if(isset($_REQUEST["cat_categories"]) && isset($_REQUEST["cat_categorize"]) && $_REQUEST["cat_categorize"] == 'on') {
      if(in_array($categories[$i]["categId"], $_REQUEST["cat_categories"])) {
        $categories[$i]["incat"] = 'y';
        // allow to preselect categories when creating a new article
        // like this: /tiki-edit_article.php?cat_categories[]=1&cat_categorize=on
        $smarty->assign('categ_checked', 'y');
      }

      else {
        $categories[$i]["incat"] = 'n';
      }
    }
  }

  if(!empty($cats)) {
    $smarty->assign('catsdump', implode(',',$cats));
  }

  $smarty->assign_by_ref('categories', $categories);

  // check if this page is categorized
  if($categlib->is_categorized($cat_type, $cat_objid)) {
    $cat_categorize = 'y';
  }

  else {
    $cat_categorize = 'n';
  }

  $smarty->assign('cat_categorize', $cat_categorize);
}

?>
