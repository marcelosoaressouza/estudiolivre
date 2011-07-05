<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-edit_translation.php,v 1.3.2.11 2007/03/02 12:23:29 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

//TODO: add permission, sea surfing controlling, add new object type
//TODO: list_articles must be replaced by something lighter
//TODO: list languages must used browser preferences
//QUESTION: can we translated all the objects or only those the user can see - if yes filter list_pages

// Initialization
require_once('tiki-setup.php');

include_once('lib/multilingual/multilinguallib.php');

if ($feature_multilingual != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_multilingual");
	$smarty->display("error.tpl");
	die;
}

if (!(isset($_REQUEST['page']) && $_REQUEST['page']) && !(isset($_REQUEST['id']) && $_REQUEST['id'])) {
	$smarty->assign('msg',tra("No object indicated"));
	$smarty->display("error.tpl");
	die;
}

if (isset($_REQUEST['page']) && $_REQUEST['page']) {
	$info = $tikilib->get_page_info($_REQUEST['page']);
	if (empty($info)) {
		$smarty->assign('msg',tra("Page cannot be found"));
		$smarty->display("error.tpl");
		die;
	}
	$name = $_REQUEST['page'];
	$type = "wiki page";
	$objId = $info['page_id'];
	$langpage = $info['lang'];
}
else if ($_REQUEST['id']) {
	if (!isset($_REQUEST['type'])) {
		$smarty->assign('msg',tra("No type indicated"));
		$smarty->display("error.tpl");
		die;
	}
	if ($_REQUEST['type'] == "wiki page") {
		$info = $tikilib->get_page_info_from_id($_REQUEST['id']);
		if (empty($info)) {
			$smarty->assign('msg',tra("Page cannot be found"));
			$smarty->display("error.tpl");
			die;
		}
		$name = $info['pageName'];
		$type = "wiki page";
		$objId = $info['page_id'];
		$langpage = $info['lang'];
	}
	else if ($_REQUEST['type'] == "article") {
		$info = $tikilib->get_article($_REQUEST["id"]);
		if (empty($info)) {
			$smarty->assign('msg', tra("Article not found"));
			$smarty->display("error.tpl");
			die;
		}
		$name = $info['title'];
		$type = "article";
		$objId = $_REQUEST['id'];
		$langpage = $info['lang'];
		$articles = $tikilib->list_articles(0, -1, 'title_asc', '', '', $user);
		$smarty->assign_by_ref('articles', $articles["data"]);
	}
}

if ($type == "wiki page") {
  if (!($tiki_p_admin_wiki== 'y' || $tikilib->user_has_perm_on_object($user, $page, 'wiki page', 'tiki_p_edit') || ($wiki_creator_admin == 'y' && $user && $info['creator'] == $user))) {
		$smarty->assign('msg', tra("Permission denied you cannot edit this page"));
		$smarty->display("error.tpl");
		die;
	}
  $pages = $tikilib->list_pages(0, -1, 'pageName_asc', '', '',true, false, true);
	$smarty->assign_by_ref('pages', $pages["data"]);
}
else if ($type == "article") {
	if ($tiki_p_admin_cms != 'y' && !$tikilib->user_has_perm_on_object($user, $id, 'article', 'tiki_p_edit_article') and ($info['author'] != $user or $info['creator_edit'] != 'y')) {
		$smarty->assign('msg', tra("Permission denied you cannot edit this article"));
		$smarty->display("error.tpl");
		die;
	}
}

$smarty->assign('name', $name);
$smarty->assign('type', $type);
$smarty->assign('id', $objId);

if (isset($_REQUEST['langpage']) && !empty($_REQUEST['langpage']) && $_REQUEST['langpage'] != "NULL"
				&& $langpage != $_REQUEST['langpage']) { // update the language

	$error = $multilinguallib->updatePageLang($type, $objId, $_REQUEST['langpage']);
	if ($error)
		$smarty->assign('error', $error);
	else {
		$info['lang'] = $_REQUEST['langpage'];	
		$langpage = $_REQUEST['langpage'];
	}
}
$smarty->assign('langpage', $langpage);

if (isset($_REQUEST['detach']) && isset($_REQUEST['srcId'])) { // detach from a translation set
	check_ticket('edit-translation');
	$multilinguallib->detachTranslation($type, $_REQUEST['srcId']);
}
 else if (isset($_REQUEST['set']) && !empty($_REQUEST['srcName'])) { // attach to a translation set
	check_ticket('edit-translation');
	if (empty($langpage) || $langpage == "NULL") {
		$error = "traLang";
		$smarty->assign('error', $error);
	}
	else {
		$srcInfo = $tikilib->get_page_info($_REQUEST['srcName']);
		if (empty($srcInfo)) {
			$error = "srcExists";
			$smarty->assign('error', $error);
		}
		else 
			if (!(isset($srcInfo['lang']) && $srcInfo['lang'])) {
				$error = "srcLang";
				$smarty->assign('error', $error);
			}
			elseif ($srcInfo['page_id'] != $objId) {
				$error = $multilinguallib->insertTranslation($type, $srcInfo['page_id'], $srcInfo['lang'], $objId, $langpage);
				if ($error)
					$smarty->assign('error', $error);
				else
					$_REQUEST['srcName'] = "";
			}
	}
	$smarty->assign('srcName', $_REQUEST['srcName']);
}
else if  (isset($_REQUEST['set']) && !empty($_REQUEST['srcId'])) {
	check_ticket('edit-translation');
	if (empty($langpage) || $langpage == "NULL") {
		$error = "traLang";
		$smarty->assign('error', $error);
	}
	else {
		$srcInfo = $tikilib->get_article($_REQUEST["srcId"]);
	if (empty($srcInfo)) {
			$error = "srcExists";
			$smarty->assign('error', $error);
		}
		else 
			if (!(isset($srcInfo['lang']) && $srcInfo['lang'])) {
				$error = "srcLang";
				$smarty->assign('error', $error);
			}
			else {
				$error = $multilinguallib->insertTranslation($type, $srcInfo['articleId'], $srcInfo['lang'], $objId, $langpage);
				if ($error)
					$smarty->assign('error', $error);
				else
					$_REQUEST['srcName'] = "";
			}
	}
	$smarty->assign('srcId', $_REQUEST['srcId']);
}

$trads = $multilinguallib->getTranslations($type, $objId, $name, $langpage, true);
$smarty->assign('trads', $trads);

$languages = $tikilib->list_languages();
$available_languages = unserialize($tikilib->get_preference("available_languages"));
$smarty->assign_by_ref('languages', $languages);
$smarty->assign_by_ref('available_languages', $available_languages);

ask_ticket('edit-translation');

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

// Display the template
$smarty->assign('mid', 'tiki-edit_translation.tpl');
$smarty->display("tiki.tpl");

?>
