<?php
if ($user) {
	global $messulib, $tikilib;
	require_once('lib/messu/messulib.php');
	$mod_allowMsgs = $tikilib->get_user_preference($user,'allowMsgs',1);
	$smarty->assign('mod_allowMsgs',$mod_allowMsgs);
	$smarty->assign('mod_userMessages', $messulib->list_user_messages($user, 0, 5, 'date_desc', '', 'isRead', 'n', '', 'messages'));
	$modUnread = $tikilib->user_unread_messages($user);
	$smarty->assign('modUnread', $modUnread);
}
?>
