<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-admin_include_siteid.php,v 1.1.2.10 2007/09/12 14:41:29 marclaporte Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.


//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

// Site Identity Settings
if (isset($_REQUEST["siteidentityset"])) {
 check_ticket('admin-inc-siteid');
 
 if (isset($_REQUEST["alter_tiki_prefs_table"])) {
	 $alter_result = alterprefs();
 }

 	$pref_toggles = array(
  			"feature_sitemycode",
				"feature_breadcrumbs",
				"feature_siteloclabel",
				"feature_sitelogo",
				"feature_sitenav",
				"feature_sitead",
				"feature_sitesearch",
				"feature_sitemenu",
				"sitemycode_publish",
				"sitead_publish"
    );

    foreach ($pref_toggles as $toggle) {
        simple_set_toggle ($toggle);
    }

 	$pref_simple_values = array(
				"sitelogo_src",
				"sitelogo_bgcolor",
				"sitelogo_title",
				"sitelogo_alt",
				"sitemycode",
				"sitead",
				"sitenav",
				"sender_email"

    );

    foreach ($pref_simple_values as $svitem) {
        simple_set_value ($svitem);
    }

    $pref_byref_values = array(
        "feature_siteloc",
        "feature_sitetitle",
        "feature_sitedesc",
        "siteTitle"
    );

    foreach ($pref_byref_values as $britem) {
        byref_set_value ($britem);
    }

}

ask_ticket('admin-inc-siteid');
?>
