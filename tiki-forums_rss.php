<?php
// $Header: /cvsroot/tikiwiki/tiki/tiki-forums_rss.php,v 1.17.2.8 2007/03/02 12:23:25 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

require_once('tiki-setup.php');
require_once('lib/tikilib.php');
require_once('lib/rss/rsslib.php');

if($rss_forums != 'y') {
  $errmsg=tra("rss feed disabled");
  require_once('tiki-rss_error.php');
}

if($tiki_p_admin_forum != 'y' && $tiki_p_forum_read != 'y') {
  $errmsg=tra("Permission denied you cannot view this section");
  require_once('tiki-rss_error.php');
}

$feed = "forums";
$uniqueid = $feed;
$output = $rsslib->get_from_cache($uniqueid);

if($output["data"]=="EMPTY") {
  $title = (!empty($title_rss_forums)) ? $title_rss_forums :  tra("Tiki RSS feed for forums");
  $desc = (!empty($desc_rss_forums)) ? $desc_rss_forums : tra("Last topics in forums.");
  $now = date("U");
  $id = "forumId";
  $param = "threadId";
  $descId = "data";
  $dateId = "commentDate";
  $authorId = "userName";
  $titleId = "title";
  $readrepl = "tiki-view_forum_thread.php?$id=%s&comments_parentId=%s";

  $tmp = $tikilib->get_preference('title_rss_'.$feed, '');

  if($tmp<>'') $title = $tmp;

  $tmp = $tikilib->get_preference('desc_rss_'.$feed, '');

  if($desc<>'') $desc = $tmp;

  $changes = $tikilib -> list_all_forum_topics(0, $max_rss_forums, $dateId.'_desc', '');
  $output = $rsslib->generate_feed($feed, $uniqueid, '', $changes, $readrepl, $param, $id, $title, $titleId, $desc, $descId, $dateId, $authorId);
}

header("Content-type: ".$output["content-type"]);
print $output["data"];

?>
