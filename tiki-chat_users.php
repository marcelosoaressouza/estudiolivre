<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-chat_users.php,v 1.10.2.4 2008/02/21 19:52:40 lphuberdeau Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

$section = 'chat';
require_once ("tiki-setup.php");

if ($feature_chat != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_chat");

	$smarty->display("error.tpl");
	die;
}

include_once ('lib/chat/chatlib.php');

if (isset($_REQUEST['channelId'])) {
    $chatusers = $chatlib->get_chat_users($_REQUEST["channelId"]);
} else {
    $chatusers = array();
}

$smarty->assign('chatusers',$chatusers);

$smarty->display('tiki-chat_users.tpl');

?>
