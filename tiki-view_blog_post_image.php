<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-view_blog_post_image.php,v 1.5.2.3 2008/02/21 20:33:31 marclaporte Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once ('tiki-setup.php');

if ($feature_blogs != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_blogs");

	$smarty->display("error.tpl");
	die;
}

include_once ('lib/blogs/bloglib.php');

if (!isset($_REQUEST["imgId"])) {
	die;
}

$info = $bloglib->get_post_image($_REQUEST["imgId"]);
$type = &$info["filetype"];
$file = &$info["filename"];
$content = &$info["data"];
header ("Content-type: $type");
header ("Content-Disposition: inline; filename=$file");
echo "$content";

?>
