<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-directory_admin.php,v 1.8.2.3 2007/03/02 12:23:16 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once('tiki-setup.php');

include_once('lib/directory/dirlib.php');

if($feature_directory != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_directory");

  $smarty->display("error.tpl");
  die;
}

if($tiki_p_admin_directory
    != 'y' && $tiki_p_admin_directory_sites != 'y' && $tiki_p_admin_directory_cats != 'y' && $tiki_p_validate_links != 'y') {
  $smarty->assign('msg', tra("Permission denied"));

  $smarty->display("error.tpl");
  die;
}

// This will only display a menu to
// admin_categories
// admin_sites
// validate_sites
// configuration (in tiki admin if admin)
//

// Get number of invalid sites
// Get number of sites
// Get number of categories
// Get number of searches
$stats = $dirlib->dir_stats();
$smarty->assign_by_ref('stats', $stats);

// This page should be displayed with Directory section options
$section='directory';
include_once('tiki-section_options.php');

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

// Display the template
$smarty->assign('mid', 'tiki-directory_admin.tpl');
$smarty->display("tiki.tpl");

?>
