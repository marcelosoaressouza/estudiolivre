<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-admin.php,v 1.100.2.41 2007/12/23 16:59:13 mose Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once('tiki-setup.php');

include_once('lib/admin/adminlib.php');

$tikifeedback = array();

if($tiki_p_admin != 'y') {
  $smarty->assign('msg', tra("You do not have permission to use this feature"));

  $smarty->display("error.tpl");
  die;
}

function simple_set_toggle($feature) {
  global $_REQUEST, $tikilib, $smarty, $tikifeedback, $$feature;

  if(isset($_REQUEST[$feature]) && $_REQUEST[$feature] == "on") {
    if(isset($$feature) && $$feature != 'y') {
      $tikilib->set_preference($feature, 'y');
      $smarty->assign($feature, 'y');
      $tikifeedback[] = array('num'=>1,'mes'=>sprintf(tra("%s enabled"),$feature));
    }
  }

  else {
    if(isset($$feature) && $$feature != 'n') {
      $tikilib->set_preference($feature, 'n');
      $smarty->assign($feature, 'n');
      $tikifeedback[] = array('num'=>1,'mes'=>sprintf(tra("%s disabled"),$feature));
    }
  }
}

function simple_set_value($feature) {
  global $_REQUEST, $tikilib, $smarty;

  if(isset($_REQUEST[$feature])) {
    $tikilib->set_preference($feature, $_REQUEST[$feature]);

    $smarty->assign($feature, $_REQUEST[$feature]);
  }
}

function simple_set_int($feature) {
  global $_REQUEST, $tikilib, $smarty;

  if(isset($_REQUEST[$feature]) && is_numeric($_REQUEST[$feature])) {
    $tikilib->set_preference($feature, $_REQUEST[$feature]);
    $smarty->assign($feature, $_REQUEST[$feature]);
  }
}

function byref_set_value($feature, $pref = "") {
  global $_REQUEST, $tikilib, $smarty;

  if(isset($_REQUEST[$feature])) {
    if(strlen($pref) > 0) {
      $tikilib->set_preference($pref, $_REQUEST[$feature]);
      // also assign the ref appareantly --gongo
      $smarty->assign_by_ref($pref, $_REQUEST[$feature]);
    }

    else {
      $tikilib->set_preference($feature, $_REQUEST[$feature]);
    }

    $smarty->assign_by_ref($feature, $_REQUEST[$feature]);
  }
}

$home_blog = $tikilib->get_preference("home_blog", 0);
$smarty->assign('home_blog', $home_blog);

$home_forum = $tikilib->get_preference("home_forum", 0);
$smarty->assign('home_forum', $home_forum);

$home_gallery = $tikilib->get_preference("home_gallery", 0);
$smarty->assign('home_gallery', $home_gallery);

$home_file_gallery = $tikilib->get_preference("home_file_gallery", 0);
$smarty->assign('home_file_gallery', $home_file_gallery);

$crumbs[] = new Breadcrumb(tra('Administration'),
                           tra('Sections'),
                           'tiki-admin.php',
                           'Admin+Home',
                           tra('Help on Administration Home'));

if(isset($_REQUEST["page"])) {
  $adminPage = $_REQUEST["page"];
  $helpUrl='';

  if($adminPage == "features") {
    $admintitle = "Features"; //get_strings tra("Features")
    $description = "Enable/disable Tiki features here, but configure them elsewhere"; //get_strings tra("Enable/disable Tiki features here, but configure them elsewhere") TODO FOR EACH DESCRIPTION
    $helpUrl = "Features+Admin";
    include_once('tiki-admin_include_features.php');
  }

  else if($adminPage == "general") {
    $admintitle = "General";//get_strings tra("General")
    $description = "General preferences and settings";//get_strings tra("General preferences and settings")
    $helpUrl = "General+Admin";
    include_once('tiki-admin_include_general.php');
  }

  else if($adminPage == "login") {
    $admintitle = "Login";//get_strings tra("Login")
    $description = "User registration, login and authentication";//get_strings tra("User registration, login and authentication")
    $helpUrl = "Login+Config";
    include_once('tiki-admin_include_login.php');
  }

  else if($adminPage == "wiki") {
    $admintitle = "Wiki";//get_strings tra("Wiki")
    $helpUrl = "Wiki+Config";
    $description = "Wiki settings";//get_strings tra("Wiki settings")
    include_once('tiki-admin_include_wiki.php');
  }

  else if($adminPage == "wikiatt") {
    $admintitle = "Wiki Attachments";//get_strings tra("Wiki Attachments")
    $description = "Wiki attachments";//get_strings tra("Wiki attachments")
    include_once('tiki-admin_include_wikiatt.php');
  }

  else if($adminPage == "gal") {
    $admintitle = "Image Gallery";//get_strings tra("Image Gallery")
    $helpUrl = "Image+Gallery+Config";
    $description = "Image galleries";//get_strings tra("Image galleries")
    include_once('tiki-admin_include_gal.php');
  }

  else if($adminPage == "fgal") {
    $admintitle = "File Gallery";//get_strings tra("File Gallery")
    $helpUrl = "File+Gallery+Config";
    $description = "File galleries";//get_strings tra("File galleries")
    include_once('tiki-admin_include_fgal.php');
  }

  else if($adminPage == "cms") {
    $admintitle = "Articles";//get_strings tra("Articles")
    $helpUrl = "Articles+Config";
    $description = "Article/CMS settings";//get_strings tra("Article/CMS settings")
    include_once('tiki-admin_include_cms.php');
  }

  else if($adminPage == "polls") {
    $admintitle = "Polls";//get_strings tra("Polls")
    $helpUrl = "Polls";
    $description = "Poll comments settings";//get_strings tra("Poll comments settings")
    include_once('tiki-admin_include_polls.php');
  }

  else if($adminPage == "blogs") {
    $admintitle = "Blogs";//get_strings tra("Blogs")
    $helpUrl = "Blog+Config";
    $description = "Configuration options for all blogs on your site";//get_strings tra("Configuration options for all blogs on your site")
    include_once('tiki-admin_include_blogs.php');
  }

  else if($adminPage == "forums") {
    $admintitle = "Forums";//get_strings tra("Forums")
    $helpUrl = "Forums";
    $description = "Forums settings";//get_strings tra("Forums settings")
    include_once('tiki-admin_include_forums.php');
  }

  else if($adminPage == "faqs") {
    $admintitle = "FAQs";//get_strings tra("FAQs")
    $helpUrl = "FAQ";
    $description = "FAQ comments settings";//get_strings tra("FAQ comments settings")
    include_once('tiki-admin_include_faqs.php');
  }

  else if($adminPage == "trackers") {
    $admintitle = "Trackers";//get_strings tra("Trackers")
    $description = "Trackers settings";//get_strings tra("Trackers settings")
    $helpUrl = "Trackers";
    include_once('tiki-admin_include_trackers.php');
  }

  else if($adminPage == "webmail") {
    $admintitle = "Webmail";//get_strings tra("Webmail")
    $description = "Webmail";
    $helpUrl = "Webmail";
    include_once('tiki-admin_include_webmail.php');
  }

  else if($adminPage == "rss") {
    $admintitle = "RSS feeds";//get_strings tra("RSS feeds")
    $helpUrl = "RSS+admin";
    $description = "RSS settings";//get_strings tra("RSS settings")
    include_once('tiki-admin_include_rss.php');
  }

  else if($adminPage == "directory") {
    $admintitle = "Directory";//get_strings tra("Directory")
    $helpUrl = "Directory+admin";
    $description = "Directory settings";//get_strings tra("Directory settings")
    include_once('tiki-admin_include_directory.php');
  }

  else if($adminPage == "userfiles") {
    $admintitle = "User Files";//get_strings tra("User files")
    $helpUrl = "User+Files";
    $description = "User files";//get_strings tra("User files")
    include_once('tiki-admin_include_userfiles.php');
  }

  else if($adminPage == "maps") {
    $admintitle = "Maps";//get_strings tra("Maps")
    $helpUrl = "Map";
    $description = "Maps configuration";//get_strings tra("Maps configuration")
    include_once('tiki-admin_include_maps.php');
  }

  else if($adminPage == "metatags") {
    $admintitle = "Meta Tags";//get_strings tra("Meta Tags")
    $helpUrl = "Meta+Tags";
    $description = "Meta Tags settings";//get_strings tra("Meta Tags settings")
    include_once('tiki-admin_include_metatags.php');
  }

  else if($adminPage == "search") {
    $admintitle = "Search";//get_strings tra("Search")
    $helpUrl = "Search+Admin";
    $description = "Search settings";//get_strings tra("Search settings")
    include_once('tiki-admin_include_search.php');
  }

  else if($adminPage == "score") {
    $admintitle = "Score";//get_strings tra("Score")
    $helpUrl = "Score";
    $description = "Score settings";//get_strings tra("Score settings")
    include_once('tiki-admin_include_score.php');
  }

  else if($adminPage == "community") {
    $admintitle = "Community";//get_strings tra("Community")
    $helpUrl = "Community";
    $description = "Community settings";//get_strings tra("Community settings")
    include_once('tiki-admin_include_community.php');
  }

  else if($adminPage == "siteid") {
    $admintitle = "Site Identity";//get_strings tra("Site Identity")
    $helpUrl = "Site+Identity";
    $description = "Site Identity features";//get_strings tra("Site Identity features")
    include_once('tiki-admin_include_siteid.php');
  }

  else if($adminPage == "calendar") {
    $admintitle = "Calendar";//get_strings tra("Calendar")
    $helpUrl = "Calendar+Admin";
    $description = "Calendar settings";//get_strings tra("Calendar settings")
    include_once('tiki-admin_include_calendar.php');
  }

  else if($adminPage == "intertiki") {
    $admintitle = "Intertiki";//get_strings tra("Intertiki")
    $helpUrl = "InterTiki";
    $description = "Intertiki settings";//get_strings tra("Intertiki settings")
    include_once('tiki-admin_include_intertiki.php');
  }

  else if($adminPage == "gmap") {
    $admintitle = "Google Maps";//get_strings tra("Google Maps")
    $description = "Google Maps";//get_strings tra("Google Maps")
    $helpUrl = "gmap";
    include_once('tiki-admin_include_gmap.php');
  }

  else if($adminPage == "i18n") {
    $admintitle = "i18n";//get_strings tra("i18n")
    $description = "Internationalization";//get_strings tra("i18n")
    $helpUrl = "i18n";
    include_once('tiki-admin_include_i18n.php');
  }

  else if($adminPage == "category") {
    $admintitle = "Category";//get_strings tra("Category")
    $description = "Category";//get_strings tra("Category")
    $helpUrl = "Category";
    include_once('tiki-admin_include_category.php');
  }

  else if($adminPage == "module") {
    $admintitle = "Module";//get_strings tra("Module")
    $description = "Module";//get_strings tra("Module")
    $helpUrl = "Module";
    include_once('tiki-admin_include_module.php');
  }

  else if($adminPage == "theme") {
    $admintitle = "Theme";//get_strings tra("Theme")
    $description = "Theme";//get_strings tra("Theme")
    $helpUrl = "Theme";
    include_once('tiki-admin_include_theme.php');
  }

  else if($adminPage == "textarea") {
    $admintitle = "Text area";//get_strings tra("Text area")
    $description = "Text area";//get_strings tra("Text area")
    $helpUrl = "Text+area";
    include_once('tiki-admin_include_textarea.php');
  }

  $url = 'tiki-admin.php'.'?page='.$adminPage;

  if(!$helpUrl) {
    $helpUrl = ucfirst($adminPage)."+Config";
  }

  $helpDescription = "Help on $admintitle Config";//get_strings tra("Help on $admintitle Config")
}

else {
  $smarty->assign('headtitle', breadcrumb_buildHeadTitle($crumbs));
  $smarty->assign('description', $crumbs[0]->description);
}

if(isset($admintitle)) {
  $admintitle = tra($admintitle);
  $crumbs[] = new Breadcrumb($admintitle,
                             $description,
                             $url,
                             $helpUrl,
                             $helpDescription);

  $smarty->assign_by_ref('admintitle', $admintitle);
  $headtitle = breadcrumb_buildHeadTitle($crumbs);
  $smarty->assign_by_ref('headtitle', $headtitle);
}

if(!empty($_GET['forcecheck'])) {
  $tiki_release = $adminlib->get_last_version($tiki_branch);

  if($tiki_release != $tiki_version) {
    $tiki_needs_upgrade = 'y';
  }

  else {
    $tiki_needs_upgrade = 'n';
    $tikifeedback[] = array('num'=>1,'mes'=>sprintf(tra("Current version is up to date : %s"),$tiki_version));
  }

  $smarty->assign('tiki_needs_upgrade', $tiki_needs_upgrade);

  if($feature_version_checks == 'y') {
    $tikilib->set_preference('tiki_needs_upgrade', $tiki_needs_upgrade);
    $tikilib->set_preference('tiki_release', $tiki_release);
  }
}

if($feature_version_checks == 'y') {
  if($tiki_needs_upgrade == 'y' && $tiki_release == $tiki_version) {
    // need to reset $tiki_needs_upgrade in case new upgrades do not update $tiki_needs_upgrade in prefs
    $tiki_needs_upgrade = 'n';
    $tikilib->set_preference('tiki_needs_upgrade', $tiki_needs_upgrade);
    $smarty->assign('tiki_needs_upgrade', $tiki_needs_upgrade);
  }

  if($tiki_needs_upgrade != 'y' and $tikilib->now > ($tiki_version_last_check + $tiki_version_check_frequency)) {

    $tikilib->set_preference('tiki_version_last_check',$tikilib->now);

    $tiki_release = $adminlib->get_last_version($tiki_branch);
    $tikilib->set_preference('tiki_release',$tiki_release);
    $smarty->assign('tiki_release', $tiki_release);

    if($tiki_release != $tiki_version) {
      $tiki_needs_upgrade = 'y';
      $tikilib->set_preference('tiki_needs_upgrade', $tiki_needs_upgrade);
      $smarty->assign('tiki_needs_upgrade', $tiki_needs_upgrade);
    }
  }
}

$smarty->assign_by_ref('tikifeedback', $tikifeedback);

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

// Display the template
$smarty->assign('mid', 'tiki-admin.tpl');

if(isset($helpUrl)) $smarty->assign_by_ref('sectionhelp', $helpUrl);

if(isset($description)) $smarty->assign('description', $description);

$smarty->assign('trail', $crumbs);
$smarty->assign('crumb', count($crumbs)-1);
$smarty->display("tiki.tpl");

?>
