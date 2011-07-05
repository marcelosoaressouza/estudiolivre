<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-searchresults.php,v 1.27.2.11 2007/03/02 12:23:13 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once ('tiki-setup.php');

require_once ('lib/searchlib.php'); 

$searchlib = &new SearchLib($tikilib->db);

if ($feature_search != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_search");

	$smarty->display("error.tpl");
	die;
}
if(isset($_REQUEST["highlight"]) && !empty($_REQUEST["highlight"])) {
	$_REQUEST["words"] = $_REQUEST["highlight"];
}

if ($feature_search_stats == 'y') {
	$searchlib->register_search(isset($_REQUEST["words"]) ? $_REQUEST["words"] : '');
}

if (!isset($_REQUEST["where"])) {
	$where = 'pages';
} else {
	$where = $_REQUEST["where"];
}

$find_where='find_'.$where;
$smarty->assign('where',$where);
$smarty->assign('where2',tra($where));

if($where=='wikis') {
  if ($feature_wiki != 'y') {
    $smarty->assign('msg', tra("This feature is disabled").": feature_wiki");
    $smarty->display("error.tpl");
    die;
  }
}

if($where=='directory') {
	if ($feature_directory != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_directory");
  $smarty->display("error.tpl");
  die;
	}
  if($tiki_p_admin_directory != 'y' && $tiki_p_view_directory != 'y') {
    $smarty->assign('msg',tra("Permission denied"));
    $smarty->display("error.tpl");
    die;  
  }
}

if($where=='faqs') {
	if ($feature_faqs != 'y') {
	  $smarty->assign('msg', tra("This feature is disabled").": feature_faqs");
	  $smarty->display("error.tpl");
	  die;
	}
	if($tiki_p_admin_faqs != 'y' && $tiki_p_view_faqs != 'y') {
		$smarty->assign('msg',tra("You do not have permission to use this feature"));
    $smarty->display("error.tpl");
    die;
	}
}

if($where=='forums') {
	if ($feature_forums != 'y') {
	  $smarty->assign('msg', tra("This feature is disabled").": feature_forums");
  	$smarty->display("error.tpl");
  	die;
	}
  if($tiki_p_admin_forum != 'y' && $tiki_p_forum_read != 'y') {
		$smarty->assign('msg',tra("You do not have permission to use this feature"));
		$smarty->display("error.tpl");
	  die;
  }
}

if($where=='files') {
	if ($feature_file_galleries !='y') {
	  $smarty->assign('msg', tra("This feature is disabled").": feature_file_galleries");
	  $smarty->display("error.tpl");
	  die;
	}
}

if($where=='articles') {
	if ($feature_articles != 'y') {
	  $smarty->assign('msg', tra("This feature is disabled").": feature_articles");
	  $smarty->display("error.tpl");
	  die;
	}
}

if (($where=='galleries' || $where=='images')) {
	if ($feature_galleries != 'y') {
	  $smarty->assign('msg', tra("This feature is disabled").": feature_galleries");
	  $smarty->display("error.tpl");
	  die;
	}
}

if(($where=='blogs' || $where=='posts')) {
	if ($feature_blogs != 'y') {
	  $smarty->assign('msg', tra("This feature is disabled").": feature_blogs");
	  $smarty->display("error.tpl");
	  die;
	}
}

if (($where == 'blogs' || $where == 'posts') and $feature_blogs != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_blogs");

	$smarty->display("error.tpl");
	die;
}
// Already assigned above! $smarty->assign('where',$where);
if (!isset($_REQUEST["offset"])) {
	$offset = 0;
} else {
	$offset = $_REQUEST["offset"];
}

$smarty->assign_by_ref('offset', $offset);

$fulltext = $feature_search_fulltext == 'y';

// Build the query using words
if ((!isset($_REQUEST["words"])) || (empty($_REQUEST["words"]))) {
	$results = array('cant'=>0);

	$smarty->assign('words', '');
} else {
	$words = strip_tags($_REQUEST["words"]);
	$results = $searchlib->$find_where($words, $offset, $maxRecords, $fulltext);

	$smarty->assign('words', $words);
}

//if ($fulltext == 'y') {
//	$CurrentIndex = -1;
//	$CurrentData = NULL;
//	foreach ($results["data"] as $current) {
//		if ($current["relevance"] > 0) {
//			$CurrentData[++$CurrentIndex] = $current;
//		}
//	}
//	$results['data'] = $CurrentData;
//	$results['cant'] = $CurrentIndex + 1;
//}

$cant_pages = ceil($results["cant"] / $maxRecords);
$smarty->assign('cant_results', $results["cant"]);
$smarty->assign_by_ref('cant_pages', $cant_pages);
$smarty->assign('actual_page', 1 + ($offset / $maxRecords));

if ($results["cant"] > ($offset + $maxRecords)) {
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

// Find search results (build array)
$smarty->assign_by_ref('results', $results["data"]);

ask_ticket('searchresults');

$smarty->assign('pageExists',$tikilib->page_exists($words));

// Display the template
$smarty->assign('mid', 'tiki-searchresults.tpl');
// $smarty->assign('searchNoResults', 'true');       // false is default
// $smarty->assign('searchStyle', 'menu');           // buttons is default
// $smarty->assign('searchOrientation', 'horiz');    // vert is default 
$smarty->display("tiki.tpl");

?>
