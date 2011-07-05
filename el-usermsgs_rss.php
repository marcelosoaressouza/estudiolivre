<?php

require_once ('tiki-setup.php');
require_once('lib/messu/messulib.php');
require_once ('lib/rss/rsslib.php');

//TODO apenas o proprio usuario recebe rss das msgs dele..

if (!isset($_REQUEST['user'])) {
	$errmsg=tra("Você precisa definir o usuário");
	require_once ('tiki-rss_error.php');
} else {
	$userName = $_REQUEST['user'];
}

$feed = "user_msgs";
$id = "user_from";
$title = tra("Feed RSS das mensagens enviadas para $userName");
$desc = "As 10 últimas mensagens enviadas para $userName";
$now = date("U");
$descId = "body";
$dateId = "date";
$authorId = "user_from";
$titleId = "user_from";
$urlparam = "user_from";
$readrepl = "el-user.php?view_user=%s";
$uniqueid = $feed;

$msgs = $messulib->list_user_messages($userName, 0, 10, 'date_desc', '', '', '', '', 'messages');

for($i = 0; $i < sizeof($msgs["data"]); $i++) {
	$msgs["data"][$i]["body"] = nl2br($msgs["data"][$i]["body"]);
}

$output = $rsslib->generate_feed($feed, $uniqueid, "", $msgs, $readrepl, $urlparam, $id, $title, $titleId, $desc, $descId, $dateId, $authorId);

header("Content-type: ".$output["content-type"]);
print $output["data"];

?>