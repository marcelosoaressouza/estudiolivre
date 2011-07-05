<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-download_forum_attachment.php,v 1.8.2.6 2007/07/09 18:30:56 nkoth Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
$output_zip = 'n';
require_once ('tiki-setup.php');

include_once ('lib/commentslib.php');

// roysinn: shouldn't need attach permission for download . . .
//if ($tiki_p_forum_attach != 'y') {
//	die;
//}

if (!isset($_REQUEST["attId"])) {
	die;
}

$commentslib = new Comments($dbTiki);
$info = $commentslib->get_thread_attachment($_REQUEST["attId"]);

if ($tiki_p_forum_read != 'y' or !$tikilib->user_has_perm_on_object($user,$info["forumId"],'forum','tiki_p_forum_read')) {
		$smarty->assign('msg',tra("Permission denied you cannot view this page"));
	    $smarty->display("error.tpl");
		die;
}

$type = &$info["filetype"];
$file = &$info["filename"];
$content = &$info["data"];

session_write_close();
header ("Content-type: $type");
header ("Content-Disposition: inline; filename=\"$file\"");

// Added Damian March04 request of Akira123
header ("Expires: 0");
header ("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header ("Pragma: Public");

if ($info["dir"]) {
	readfile ($info["dir"] . $info["path"]);
} else {
	echo "$content";
}

?>
