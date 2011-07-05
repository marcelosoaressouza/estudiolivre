<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-minical_reminders.php,v 1.9.2.4 2008/02/21 19:35:58 lphuberdeau Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
include_once("lib/init/initlib.php");
include_once ('tiki-setup_base.php');

include_once ('lib/minical/minicallib.php');

if ($feature_minical != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_minical");

	$smarty->display("error.tpl");
	die;
}

if (!$minical_reminders)
	die;

//$refresh=$_REQUEST['refresh']*1000;
$refresh = 1000 * 60 * 1;
$evs = $minicallib->minical_get_events_to_remind($user, $minical_reminders);

foreach ($evs as $ev) {
	$command = "<script type='text/javascript'>alert('event " . $ev['title'] . " will start at " . date(
		"h:i", $ev['start']). "');</script>";

	print ($command);
	$minicallib->minical_event_reminded($user, $ev['eventId']);
}

?>

<?php

print ('<body onload="window.setInterval(\'location.reload()\',' . $refresh . ');">');

?>
