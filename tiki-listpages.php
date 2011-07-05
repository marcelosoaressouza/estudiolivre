<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-listpages.php,v 1.13.2.14 2007/04/09 12:49:45 sylvieg Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once ('tiki-setup.php');

if ($feature_wiki != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_wiki");

	$smarty->display("error.tpl");
	die;
}

if ($feature_listPages != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_listPages");

	$smarty->display("error.tpl");
	die;
}

// Now check permissions to access this page
if ($tiki_p_view != 'y') {
	$smarty->assign('msg', tra("Permission denied you cannot view pages"));

	$smarty->display("error.tpl");
	die;
}

/* mass-remove: 
   the checkboxes are sent as the array $_REQUEST["checked[]"], values are the wiki-PageNames, 
   e.g. $_REQUEST["checked"][3]="HomePage"
   $_REQUEST["submit_mult"] holds the value of the "with selected do..."-option list
   we look if any page's checkbox is on and if remove_pages is selected.
   then we check permission to delete pages.
   if so, we call histlib's method remove_all_versions for all the checked pages.
*/
if (isset($_REQUEST["submit_mult"]) && isset($_REQUEST["checked"]) && $_REQUEST["submit_mult"] == "remove_pages") {
	check_ticket('list-pages');

	// Now check permissions to remove the selected pages
	if ($tiki_p_remove != 'y') {
		$smarty->assign('msg', tra("Permission denied you cannot remove pages"));

		$smarty->display("error.tpl");
		die;
	}

	// permissions ok: go!
	include_once ('lib/wiki/histlib.php');

	foreach ($_REQUEST["checked"] as $deletepage) {
		$histlib->remove_all_versions($deletepage);
	}
}

// This script can receive the thresold
// for the information as the number of
// days to get in the log 1,3,4,etc
// it will default to 1 recovering information for today
if (!isset($_REQUEST["sort_mode"])) {
	$sort_mode = 'pageName_asc';
} else {
	$sort_mode = $_REQUEST["sort_mode"];
}

$smarty->assign_by_ref('sort_mode', $sort_mode);

// If offset is set use it if not then use offset =0
// use the maxRecords php variable to set the limit
// if sortMode is not set then use lastModif_desc
if (!isset($_REQUEST["offset"])) {
	$offset = 0;
} else {
	$offset = $_REQUEST["offset"];
}

$smarty->assign_by_ref('offset', $offset);

if (!empty($_REQUEST["find"])) {
	$find = strip_tags($_REQUEST["find"]);
} else {
	$find = '';
}

$smarty->assign('find', $find);

$filter = '';
if (!empty($_REQUEST['lang'])) {
	$filter['lang'] = $_REQUEST['lang'];
	$smarty->assign_by_ref('find_lang', $_REQUEST['lang']);
}
if (!empty($_REQUEST['categId'])) {
	$filter['categId'] = $_REQUEST['categId'];
	$smarty->assign_by_ref('find_categId', $_REQUEST['categId']);
}

if (isset($_REQUEST["initial"])) {
	$initial = $_REQUEST["initial"];
} else {
	$initial = '';
}
$smarty->assign('initial', $initial);

if (isset($_REQUEST["exact_match"])) {
	$exact_match = true;
	$smarty->assign('exact_match', 'y');
} else {
	$exact_match = false;
	$smarty->assign('exact_match', 'n');
}                 

$smarty->assign('initials', split(' ','a b c d e f g h i j k l m n o p q r s t u v w x y z'));

// Get a list of last changes to the Wiki database
$listpages = $tikilib->list_pages($offset, $maxRecords, $sort_mode, $find, $initial, $exact_match, false, true, false, $filter);
// If there're more records then assign next_offset
$cant_pages = ceil($listpages["cant"] / $maxRecords);
$smarty->assign_by_ref('cant_pages', $cant_pages);
$smarty->assign('actual_page', 1 + ($offset / $maxRecords));

if ($listpages["cant"] > ($offset + $maxRecords)) {
	$smarty->assign('next_offset', $offset + $maxRecords);
} else {
	$smarty->assign('next_offset', -1);
}

// If offset is > 0 then prev_offset
if ($offset > 0) {
	$smarty->assign('prev_offset', $offset - $maxRecords);
} else {
	$smarty->assign('prev_offset', -1);
}

if ($feature_categories == 'y') {
	global $categlib; include_once ('lib/categories/categlib.php');
	$categories = $categlib->get_all_categories_ext();
	$smarty->assign_by_ref('categories', $categories);
	if ((isset($wiki_list_categories) && $wiki_list_categories == 'y') || (isset($wiki_list_categories_path) && $wiki_list_categories_path == 'y')) {
		foreach ($listpages['data'] as $i=>$page) {
			$cats = $categlib->get_object_categories('wiki page',$page['pageName']);
			foreach ($cats as $cat) {
				$listpages['data'][$i]['categpath'][] = $cp = $categlib->get_category_path_string($cat);
				if ($s = strrchr($cp, ':'))
					$listpages['data'][$i]['categname'][] = substr($s, 1);
				else
					$listpages['data'][$i]['categname'][] = $cp;
			}
		}
	}
}

if ($feature_multilingual == 'y') {
        $languages = array();
        $languages = $tikilib->list_languages(false, 'y');
        $smarty->assign_by_ref('languages', $languages);
        $available_languages = unserialize($tikilib->get_preference("available_languages"));
        $smarty->assign_by_ref('available_languages', $available_languages);
}

$smarty->assign_by_ref('listpages', $listpages["data"]);
//print_r($listpages["data"]);
ask_ticket('list-pages');

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

// Display the template
$smarty->assign('mid', 'tiki-listpages.tpl');
$smarty->display("tiki.tpl");

?>
