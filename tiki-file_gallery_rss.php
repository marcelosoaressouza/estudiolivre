<?php
// $Header: /cvsroot/tikiwiki/tiki/tiki-file_gallery_rss.php,v 1.22.2.8 2007/03/02 12:23:29 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

require_once ('tiki-setup.php');
require_once ('lib/tikilib.php');
require_once ('lib/rss/rsslib.php');

if ($rss_file_gallery != 'y') {
        $errmsg=tra("rss feed disabled");
        require_once ('tiki-rss_error.php');
}

if ($tiki_p_view_file_gallery != 'y' or !$tikilib->user_has_perm_on_object($user,$_REQUEST['galleryId'],'file gallery','tiki_p_view_file_gallery')) {
        $errmsg=tra("Permission denied you cannot view this section");
        require_once ('tiki-rss_error.php');
}

if (!isset($_REQUEST["galleryId"])) {
        $errmsg=tra("No galleryId specified");
        require_once ('tiki-rss_error.php');
}

$feed = "filegal";
$uniqueid = "$feed.id=".$_REQUEST["galleryId"];
$output = $rsslib->get_from_cache($uniqueid);

if ($output["data"]=="EMPTY") {
	$tmp = $tikilib->get_file_gallery($_REQUEST["galleryId"]);
	$title = tra("Tiki RSS feed for the file gallery: ").$tmp["name"];
	$desc = $tmp["description"];
	$now = date("U");
	$id = "fileId";
	$descId = "description";
	$dateId = "lastModif";
	$authorId = "user";
	$titleId = "filename";
	$readrepl = "tiki-download_file.php?$id=%s";

	$tmp = $tikilib->get_preference('title_rss_'.$feed, '');
	if ($tmp<>'') $title = $tmp;
	$tmp = $tikilib->get_preference('desc_rss_'.$feed, '');
	if ($desc<>'') $desc = $tmp;

	$changes = $tikilib->get_files( 0,10,$dateId.'_desc', '', $_REQUEST["galleryId"]);
	$output = $rsslib->generate_feed($feed, $uniqueid, '', $changes, $readrepl, '', $id, $title, $titleId, $desc, $descId, $dateId, $authorId);
}
header("Content-type: ".$output["content-type"]);
print $output["data"];

?>
