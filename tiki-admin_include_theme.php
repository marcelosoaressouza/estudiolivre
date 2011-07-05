<?php

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

if (isset($_REQUEST["style"])) {
    check_ticket('admin-inc-general');
    byref_set_value("site_style", "style");
}

if (isset($_REQUEST["themesetup"])) {
ask_ticket('admin-inc-theme');

    $pref_toggles = array(
	"feature_tabs",
	"feature_theme_control",
	"feature_edit_templates",
	"feature_editcss",
	"feature_view_tpl",
    );



    foreach ($pref_toggles as $toggle) {
        simple_set_toggle ($toggle);
    }

    $pref_byref_values = array(
        "slide_style"
    );

    foreach ($pref_byref_values as $britem) {
        byref_set_value ($britem);
    }
    
    // Set value(s) with alternate pref name
    byref_set_value("site_style", "style");
}

$llist = $tikilib->list_styles();
$smarty->assign_by_ref( "styles", $llist);

// Get list of available slideshow styles
$slide_styles = array();
$h = opendir("styles/slideshows");
while ($file = readdir($h)) {
    if (strstr($file, "css")) {
        $slide_styles[] = $file;
    }
}
closedir ($h);

$smarty->assign("style_site", $tikilib->get_preference("style", "default.css"));
$smarty->assign_by_ref("slide_styles", $slide_styles);

?>