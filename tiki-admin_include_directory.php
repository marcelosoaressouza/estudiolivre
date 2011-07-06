<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-admin_include_directory.php,v 1.7.2.4 2007/03/02 12:23:24 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

//this script may only be included - so its better to die if called directly.
if(strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

if(isset($_REQUEST["directory"])) {
  check_ticket('admin-inc-directory');

  if(isset($_REQUEST["directory_validate_urls"]) && $_REQUEST["directory_validate_urls"] == "on") {
    $tikilib->set_preference('directory_validate_urls', 'y');
    $smarty->assign('directory_validate_urls', 'y');
  }

  else {
    $tikilib->set_preference('directory_validate_urls', 'n');
    $smarty->assign('directory_validate_urls', 'n');
  }

  if(isset($_REQUEST["directory_cool_sites"]) && $_REQUEST["directory_cool_sites"] == "on") {
    $tikilib->set_preference('directory_cool_sites', 'y');
    $smarty->assign('directory_cool_sites', 'y');
  }

  else {
    $tikilib->set_preference('directory_cool_sites', 'n');
    $smarty->assign('directory_cool_sites', 'n');
  }

  $tikilib->set_preference('directory_columns', $_REQUEST["directory_columns"]);
  $tikilib->set_preference('directory_links_per_page', $_REQUEST["directory_links_per_page"]);
  $tikilib->set_preference('directory_open_links', $_REQUEST["directory_open_links"]);
  $smarty->assign('directory_columns', $_REQUEST['directory_columns']);
  $smarty->assign('directory_links_per_page', $_REQUEST['directory_links_per_page']);
  $smarty->assign('directory_open_links', $_REQUEST['directory_open_links']);
}

ask_ticket('admin-inc-directory');
?>
