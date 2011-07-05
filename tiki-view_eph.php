<?php

// $Header: /cvsroot/tikiwiki/tiki/Attic/tiki-view_eph.php,v 1.3.2.3 2008/02/21 20:24:29 marclaporte Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once ('tiki-setup.php');


if ($feature_eph != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_eph");

	$smarty->display("error.tpl");
	die;
}

include_once ('lib/ephemerides/ephlib.php');

if (!isset($_REQUEST["ephId"])) {
	die;
}

$info = $ephlib->get_eph($_REQUEST["ephId"]);
$type = &$info["filetype"];
$file = &$info["filename"];
$content = &$info["data"];

header ("Content-type: $type");
header ("Content-Disposition: inline; filename=$file");
echo "$content";

?>