<?php

// $Header: /cvsroot/tikiwiki/tiki/display_banner.php,v 1.12.2.4 2008/02/21 20:47:50 marclaporte Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

include_once ('tiki-setup.php');

if ($feature_banners != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_banners");
	$smarty->display("error.tpl");
	die;
}

// Only to be called from edit_banner or view_banner to display the banner without adding
// impressions to the banner
if (!isset($_REQUEST["id"])) {
	die;
}


include_once ('lib/banners/bannerlib.php');

if (!isset($bannerlib)) {
	$bannerlib = new BannerLib($dbTiki);
}

$data = $bannerlib->get_banner($_REQUEST["id"]);
$id = $data["bannerId"];

switch ($data["which"]) {
case 'useHTML':
	$raw = $data["HTMLData"];

	break;

case 'useImage':
	$raw = "<img border=\"0\" src=\"banner_image.php?id=" . $id . "\" />";

	break;

case 'useFixedURL':
	$fp = fopen($data["fixedURLData"], "r");

	if ($fp) {
		$raw = '';

		while (!feof($fp)) {
			$raw .= fread($fp, 8192);
		}
	}

	fclose ($fp);
	break;

case 'useText':
	$raw = $data["textData"];

	break;
}

print ($raw);

?>
