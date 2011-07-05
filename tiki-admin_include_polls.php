<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-admin_include_polls.php,v 1.8.2.3 2007/03/02 12:23:12 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}


if (isset($_REQUEST["pollprefs"])) {
	check_ticket('admin-inc-polls');
	if (isset($_REQUEST["poll_comments_per_page"])) {
		$tikilib->set_preference("poll_comments_per_page", $_REQUEST["poll_comments_per_page"]);

		$smarty->assign('poll_comments_per_page', $_REQUEST["poll_comments_per_page"]);
	}

	if (isset($_REQUEST["poll_comments_default_ordering"])) {
		$tikilib->set_preference("poll_comments_default_ordering", $_REQUEST["poll_comments_default_ordering"]);

		$smarty->assign('poll_comments_default_ordering', $_REQUEST["poll_comments_default_ordering"]);
	}

	if (isset($_REQUEST["feature_poll_comments"]) && $_REQUEST["feature_poll_comments"] == "on") {
		$tikilib->set_preference("feature_poll_comments", 'y');

		$smarty->assign("feature_poll_comments", 'y');
	} else {
		$tikilib->set_preference("feature_poll_comments", 'n');

		$smarty->assign("feature_poll_comments", 'n');
	}

	if (isset($_REQUEST["feature_poll_anonymous"]) && $_REQUEST["feature_poll_anonymous"] == "on") {
		$tikilib->set_preference("feature_poll_anonymous", 'y');

		$smarty->assign("feature_poll_anonymous", 'y');
	} else {
		$tikilib->set_preference("feature_poll_anonymous", 'n');

		$smarty->assign("feature_poll_anonymous", 'n');
	}
}
ask_ticket('admin-inc-polls');
?>
