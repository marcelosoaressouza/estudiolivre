<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-pdf.php,v 1.8.2.6 2008/02/21 20:25:17 marclaporte Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once('tiki-setup.php');


if($feature_wiki_pdf != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_wiki_pdf");

  $smarty->display("error.tpl");
  die;
}


include_once('lib/structures/structlib.php');
include_once('lib/wiki/wikilib.php');

// Create the HomePage if it doesn't exist
if(!$tikilib->page_exists($wikiHomePage)) {
  $tikilib->create_page($wikiHomePage, 0, '', date("U"), 'Tiki initialization');
}

if(!isset($_SESSION["thedate"])) {
  $thedate = date("U");
}

else {
  $thedate = $_SESSION["thedate"];
}

// Get the page from the request var or default it to HomePage
if(!isset($_REQUEST["page"])) {
  $page = $wikiHomePage;

  $smarty->assign('page', $wikiHomePage);
}

else {
  $page = $_REQUEST["page"];

  $smarty->assign_by_ref('page', $_REQUEST["page"]);
}

require_once('tiki-pagesetup.php');

// If the page doesn't exist then display an error
if(!$tikilib->page_exists($page)) {
  $smarty->assign('msg', tra("Page cannot be found"));

  $smarty->display("error.tpl");
  die;
}

// Now check permissions to access this page
if(!$tikilib->user_has_perm_on_object($user, $page,'wiki page','tiki_p_view')) {
  $smarty->assign('msg', tra("Permission denied you cannot view this page"));

  $smarty->display("error.tpl");
  die;
}

// Now increment page hits since we are visiting this page
if($count_admin_pvs == 'y' || $user != 'admin') {
  $tikilib->add_hit($page);
}

// Get page data
$info = $tikilib->get_page_info($page);

// Verify lock status
if($info["flag"] == 'L') {
  $smarty->assign('lock', true);
}

else {
  $smarty->assign('lock', false);
}

$pdata = $tikilib->parse_data($info["data"]);

//$smarty->assign_by_ref('parsed',$pdata);
//$smarty->assign_by_ref('lastModif',date("l d of F, Y  [H:i:s]",$info["lastModif"]));
//$smarty->assign_by_ref('lastModif',$info["lastModif"]);
if(empty($info["user"])) {
  $info["user"] = 'anonymous';
}

//$smarty->assign_by_ref('lastUser',$info["user"]);

// Parse the Data into PDF format (:TODO:)
//
include_once("lib/pdflib/class.ezpdf.php");
$pdf = &new Cezpdf();
$pdf->selectFont('lib/fonts/Helvetica');
$pdf->ezText("Hello world", 14);
$pdf->ezText($info["data"], 12);
$pdf->ezStream();

// Display the Index Template
/*
$smarty->assign('mid','tiki-show_page.tpl');
$smarty->assign('show_page_bar','y');
$smarty->display("tiki.tpl");
*/

?>