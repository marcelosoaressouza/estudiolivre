<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-tc.php,v 1.6.2.5 2007/03/02 12:23:22 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

//this script may only be included - so its better to die if called directly.
if(strpos($_SERVER["SCRIPT_NAME"],"comments.php")!=FALSE) {
  //smarty is not there - we need setup
  require_once('tiki-setup.php');
  $smarty->assign('msg',tra("This script cannot be called directly"));
  $smarty->display("error.tpl");
  die;
}

if($feature_theme_control == 'y') {
  // defined: $cat_type and cat_objid
  // search for theme for $cat_type
  // then search for theme for md5($cat_type.cat_objid)
  include_once('lib/themecontrol/tcontrol.php');

  include_once('lib/categories/categlib.php');

  $tc_theme = '';

  //SECTIONS
  if(isset($section)) {
    $tc_theme = $tcontrollib->tc_get_theme_by_section($section);
  }

  // CATEGORIES
  if(isset($cat_type) && isset($cat_objid)) {
    $tc_categs = $categlib->get_object_categories($cat_type, $cat_objid);

    if(count($tc_categs)) {
      foreach($tc_categs as $cat) {
        if($cat_theme = $tcontrollib->tc_get_theme_by_categ($cat)) {
          $tc_theme = $cat_theme;
          $catt=$categlib->get_category($cat);
          $smarty->assign_by_ref('category', $catt["name"]);
          break;
        }
      }
    }
  }

  // OBJECTS - if object has been particularly set, override SECTION or CATEGORIES $tc_theme
  // if not set, make sure we don't squash whatever $tc_theme may have been
  if(isset($cat_type) && isset($cat_objid)) {
    if($obj_theme = $tcontrollib->tc_get_theme_by_object($cat_type, $cat_objid)) {
      $tc_theme = $obj_theme;
    }
  }

  if($tc_theme) {
    $style = $tc_theme;

    $tc_parts = explode('.', $style);
    $style_base = $tc_parts[0];

    if($tikidomain and is_file("styles/$tikidomain/$style")) {
      $smarty->assign('style', "$tikidomain/$style");
    }

    else {
      $smarty->assign('style', $style);
    }

    $smarty->assign('style_base', $style_base);
  }
}

?>
