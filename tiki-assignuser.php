<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-assignuser.php,v 1.11.2.12 2007/03/02 12:23:28 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// This script is used to assign groups to a particular user
// ASSIGN USER TO GROUPS
// Initialization
require_once ('tiki-setup.php');

if ($tiki_p_admin != 'y' && $tiki_p_admin_users != 'y') {
	$smarty->assign('msg', tra("You do not have permission to use this feature"));
	$smarty->display("error.tpl");
	die;
}

if (!isset($_REQUEST["assign_user"])) {
	$smarty->assign('msg', tra("Unknown user"));

	$smarty->display("error.tpl");
	die;
}

$assign_user = $_REQUEST["assign_user"];
$smarty->assign_by_ref('assign_user', $assign_user);

if (!$userlib->user_exists($assign_user)) {
	$smarty->assign('msg', tra("User doesnt exist"));

	$smarty->display("error.tpl");
	die;
}

if (isset($_REQUEST["action"])) {
	check_ticket('admin-assign-user');
	
	if (!isset($_REQUEST["group"])) {
		$smarty->assign('msg', tra("You have to indicate a group"));
		$smarty->display("error.tpl");
		die;
	}
	if ($tiki_p_admin != 'y')
			$groups = $userlib->get_user_groups_inclusion($user);
	if ($_REQUEST["action"] == 'assign') {
		if (!$userlib->group_exists($_REQUEST["group"])) {
			$smarty->assign('msg', tra("This group is invalid"));
			$smarty->display("error.tpl");
			die;
		}
		if ($tiki_p_admin == 'y' || array_key_exists($_REQUEST["group"], $groups)) {
			$userlib->assign_user_to_group($_REQUEST["assign_user"], $_REQUEST["group"]);
			$logslib->add_log('perms',sprintf("Assigned %s in group %s",$_REQUEST["assign_user"], $_REQUEST["group"]));
		}			
	} elseif ($_REQUEST["action"] == 'removegroup') {
		$area = 'deluserfromgroup';
		if ($feature_ticketlib2 != 'y' or (isset($_POST['daconfirm']) and isset($_SESSION["ticket_$area"]))) {
			key_check($area);
			if ($tiki_p_admin == 'y' || array_key_exists($_REQUEST["group"], $groups)) {
				$userlib->remove_user_from_group($_REQUEST["assign_user"], $_REQUEST["group"]);
				$logslib->add_log('perms',sprintf("Removed %s from group %s",$_REQUEST["assign_user"], $_REQUEST["group"]));
			}
		} else {
			key_get($area);
		}
	}
}

if(isset($_REQUEST['set_default'])) {
	$userlib->set_default_group($_REQUEST['login'],$_REQUEST['defaultgroup']);
}

$user_info = $userlib->get_user_info($assign_user,true);
$smarty->assign_by_ref('user_info', $user_info);

if (!isset($_REQUEST["sort_mode"])) {
	$sort_mode = 'groupName_desc';
} else {
	$sort_mode = $_REQUEST["sort_mode"];
}

$smarty->assign_by_ref('sort_mode', $sort_mode);

// If offset is set use it if not then use offset =0
// use the maxRecords php variable to set the limit
// if sortMode is not set then use lastModif_desc
if (!isset($_REQUEST["offset"])) {
	$offset = 0;
} else {
	$offset = $_REQUEST["offset"];
}

$smarty->assign_by_ref('offset', $offset);

if (isset($_REQUEST["find"])) {
	$find = $_REQUEST["find"];
} else {
	$find = '';
}

$smarty->assign('find', $find);

if ($tiki_p_admin != 'y')
	$groups = $userlib->get_user_groups_inclusion($user);
else
	$groups = '';
$users = $userlib->get_groups($offset, $maxRecords, $sort_mode, $find,'','y', $groups);
			
$cant_pages = ceil($users["cant"] / $maxRecords);
$smarty->assign_by_ref('cant_pages', $cant_pages);
$smarty->assign('actual_page', 1 + ($offset / $maxRecords));

if ($users["cant"] > ($offset + $maxRecords)) {
	$smarty->assign('next_offset', $offset + $maxRecords);
} else {
	$smarty->assign('next_offset', -1);
}

// If offset is > 0 then prev_offset
if ($offset > 0) {
	$smarty->assign('prev_offset', $offset - $maxRecords);
} else {
	$smarty->assign('prev_offset', -1);
}

// Get users (list of users)
$smarty->assign_by_ref('users', $users["data"]);

ask_ticket('admin-assign-user');

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

// Display the template
$smarty->assign('mid', 'tiki-assignuser.tpl');
$smarty->display("tiki.tpl");

?>
