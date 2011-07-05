<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-show_user_avatar.php,v 1.6.2.3 2007/03/02 12:23:27 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

include_once("lib/init/initlib.php");
include_once ("tiki-setup_base.php");

include_once ('lib/userprefs/userprefslib.php');

// application to display an image from the database with 
// option to resize the image dynamically creating a thumbnail on the fly.
// you have to check if the user has permission to see this gallery
if (!isset($_REQUEST["user"])) {
	die;
}

$info = $userprefslib->get_user_avatar_img($_REQUEST["user"]);
$type = $info["avatarFileType"];
$content = $info["avatarData"];

if ($content) {
	header ("Content-type: $type");
	echo "$content";
} else{
	header ("Content-type: image/png");
	$user_style = $tikilib->get_user_preference($user, 'theme', $style);
	$curstyle=str_replace(".css", "", $user_style);
	readfile("styles/".$curstyle."/img/iThumbUser.png");
}

?>
