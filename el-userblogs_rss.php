<?php

require_once ('tiki-setup.php');
require_once('lib/blogs/bloglib.php');
require_once ('lib/rss/rsslib.php');

if (!isset($_REQUEST['user'])) {
	$errmsg=tra("Você precisa definir o usuário");
	require_once ('tiki-rss_error.php');
} else {
	$userName = $_REQUEST['user'];
}

$feed = "user_blogs";
$id = "postId";
$title = tra("Feed RSS para blogs de $userName");
$desc = "Os 10 últimos posts de $userName";
$now = date("U");
$descId = "data";
$dateId = "created";
$authorId = "user";
$titleId = "title";
$urlparam = "postId";
$readrepl = "tiki-view_blog_post.php?postId=%s";
$uniqueid = $feed;

$posts = $bloglib->list_user_posts($userName, 0, 10);

for($i = 0; $i < sizeof($posts["data"]); $i++) {
	$posts["data"][$i]["data"] = nl2br($posts["data"][$i]["data"]);
}

$output = $rsslib->generate_feed($feed, $uniqueid, "", $posts, $readrepl, $urlparam, $id, $title, $titleId, $desc, $descId, $dateId, $authorId);

header("Content-type: ".$output["content-type"]);
print $output["data"];

?>