<?php

// $Header: /cvsroot/tikiwiki/tiki/select_banner.php,v 1.7.2.3 2008/02/21 20:47:50 marclaporte Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

include_once ('tiki-setup.php');

if ($feature_banners != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_banners");
	$smarty->display("error.tpl");
	die;
}

// application to display an image from the database with
// option to resize the image dynamically creating a thumbnail on the fly.
if (!isset($_REQUEST["zone"])) {
	die;
}


include_once ('lib/banners/bannerlib.php');

if (!isset($bannerlib)) {
	$bannerlib = new BannerLib($dbTiki);
}

$tikilib = new Tikilib($dbTiki);
$banner = $bannerlib->select_banner($_REQUEST["zone"]);
print ($banner);

?>
