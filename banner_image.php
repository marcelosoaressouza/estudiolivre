<?php

// $Header: /cvsroot/tikiwiki/tiki/banner_image.php,v 1.8.2.7 2008/02/21 20:47:50 marclaporte Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.


// application to display an image from the database with
// option to resize the image dynamically creating a thumbnail on the fly.

// Initialization
include_once ('tiki-setup.php');

if ($feature_banners != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_banners");
	$smarty->display("error.tpl");
	die;
}

if (!isset($_REQUEST["id"])) {
	die;
}


$bannercachefile = "temp";
if ($tikidomain) { $bannercachefile.= "/$tikidomain"; }
$bannercachefile.= "/banner.".$_REQUEST["id"];

if (is_file($bannercachefile) and (!isset($_REQUEST["reload"]))) {
	$size = getimagesize($bannercachefile);
	$type = $size['mime'];
} else {
	include_once ('lib/tikilib.php');
	$tikilib = new Tikilib($dbTiki);
	include_once ('lib/banners/bannerlib.php');
	if (!isset($bannerlib)) {
		$bannerlib = new BannerLib($dbTiki);
	}
	$data = $bannerlib->get_banner($_REQUEST["id"]);
	$type = $data["imageType"];
	$data = $data["imageData"];
	if ($data) {
		$fp = fopen($bannercachefile,"wb");
		fputs($fp,$data);
		fclose($fp);
	}
}

header ("Content-type: $type");
if (is_file($bannercachefile)) {
	readfile($bannercachefile);
} else {
	echo $data;
}

?>
