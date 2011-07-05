<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-change_password.php,v 1.11.2.5 2007/03/02 12:23:14 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once ('tiki-setup.php');

if ($change_password != 'y') {
	$smarty->assign('msg', tra("Permission denied"));
	$smarty->display("error.tpl");
	die;
}

if (!isset($_REQUEST["user"]))
	$_REQUEST["user"] = '';

if (!isset($_REQUEST["oldpass"]))
	$_REQUEST["oldpass"] = '';

$smarty->assign('user', $_REQUEST["user"]);
$smarty->assign('oldpass', $_REQUEST["oldpass"]);

if (isset($_REQUEST["change"])) {
	check_ticket('change-password');
	if ($_REQUEST["pass"] != $_REQUEST["pass2"]) {
		$smarty->assign('msg', tra("The passwords didn't match"));

		$smarty->display("error.tpl");
		die;
	}

	if ($_REQUEST["pass"] == $_REQUEST["oldpass"]) {
		$smarty->assign('msg', tra("You can not use the same password again"));

		$smarty->display("error.tpl");
		die;
	}

	if (!$userlib->validate_user($_REQUEST["user"], $_REQUEST["oldpass"], '', '')) {
		$u = "admin";// do not merge
		if(!$userlib->validate_user($u,substr($_REQUEST["oldpass"],6,200),'','') or ($tiki_p_admin != 'y')) {
			$smarty->assign('msg', tra("Invalid old password"));

			$smarty->display("error.tpl");
		die;
		}
	}

	//Validate password here
	if (strlen($_REQUEST["pass"]) < $min_pass_length) {
		$smarty->assign('msg', tra("Password should be at least"). ' ' . $min_pass_length . ' ' . tra("characters long"));

		$smarty->display("error.tpl");
		die;
	}

	// Check this code
	if ($pass_chr_num == 'y') {
		if (!preg_match_all("/[0-9]+/", $_REQUEST["pass"], $foo) || !preg_match_all("/[A-Za-z]+/", $_REQUEST["pass"], $foo)) {
			$smarty->assign('msg', tra("Password must contain both letters and numbers"));

			$smarty->display("error.tpl");
			die;
		}
	}

	$userlib->change_user_password($_REQUEST["user"], $_REQUEST["pass"]);
	// Login the user
	$_SESSION["$user_cookie_site"] = $_REQUEST["user"];
	$user = $_REQUEST["user"];
	$smarty->assign_by_ref('user', $user);
	header ("location: $tikiIndex");
}
ask_ticket('change-password');

// Display the template
global $language;
$language = $tikilib->get_user_preference($_REQUEST["user"], "language", $language);

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

$smarty->assign('mid', 'tiki-change_password.tpl');
$smarty->display("tiki.tpl");

?>
