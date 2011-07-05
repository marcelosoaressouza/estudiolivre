<?php

// $Header: /cvsroot/tikiwiki/tiki/banner_click.php,v 1.7.2.3 2008/02/21 20:47:50 marclaporte Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
include_once ('tiki-setup.php');

if ($feature_banners != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_banners");
	$smarty->display("error.tpl");
	die;
}


include_once ('lib/banners/bannerlib.php');

if (!isset($bannerlib)) {
	$bannerlib = new BannerLib($dbTiki);
}

$bannerlib->add_click($_REQUEST["id"]);
$url = urldecode($_REQUEST["url"]);
header ("location: $url");

?>
