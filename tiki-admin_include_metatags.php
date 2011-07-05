<?php
// $Header: /cvsroot/tikiwiki/tiki/tiki-admin_include_metatags.php,v 1.1.10.5 2007/03/02 12:23:22 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

if (isset($_REQUEST["metatags"])) {

	$tikilib->set_preference('metatag_keywords', $_REQUEST["metatag_keywords"]);
	$smarty->assign("metatag_keywords", $_REQUEST["metatag_keywords"]);
        $tikilib->set_preference('metatag_description', $_REQUEST["metatag_description"]);
        $smarty->assign("metatag_description", $_REQUEST["metatag_description"]);
        $tikilib->set_preference('metatag_author', $_REQUEST["metatag_author"]);
        $smarty->assign("metatag_author", $_REQUEST["metatag_author"]);
        $tikilib->set_preference('metatag_geoposition', $_REQUEST["metatag_geoposition"]);
        $smarty->assign("metatag_geoposition", $_REQUEST["metatag_geoposition"]);
        $tikilib->set_preference('metatag_georegion', $_REQUEST["metatag_georegion"]);
        $smarty->assign("metatag_georegion", $_REQUEST["metatag_georegion"]);
        $tikilib->set_preference('metatag_geoplacename', $_REQUEST["metatag_geoplacename"]);
        $smarty->assign("metatag_geoplacename", $_REQUEST["metatag_geoplacename"]);
        $tikilib->set_preference('metatag_robots', $_REQUEST["adm_metatag_robots"]);
        $smarty->assign("adm_metatag_robots", $_REQUEST["adm_metatag_robots"]);
        $tikilib->set_preference('metatag_revisitafter', $_REQUEST["metatag_revisitafter"]);
        $smarty->assign("metatag_revisitafter", $_REQUEST["metatag_revisitafter"]);

} else {
	$smarty->assign("metatag_keywords", $tikilib->get_preference("metatag_keywords", ''));
        $smarty->assign("metatag_description", $tikilib->get_preference("metatag_description", ''));
        $smarty->assign("metatag_author", $tikilib->get_preference("metatag_author", ''));
        $smarty->assign("metatag_geoposition", $tikilib->get_preference("metatag_geoposition", ''));
        $smarty->assign("metatag_georegion", $tikilib->get_preference("metatag_georegion", ''));
        $smarty->assign("metatag_geoplacename", $tikilib->get_preference("metatag_geoplacename", ''));
        $smarty->assign("adm_metatag_robots", $tikilib->get_preference("metatag_robots", ''));
        $smarty->assign("metatag_revisitafter", $tikilib->get_preference("metatag_revisitafter", ''));

}

?>
