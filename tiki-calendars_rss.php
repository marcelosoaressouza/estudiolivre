<?php
// $Header: /cvsroot/tikiwiki/tiki/tiki-calendars_rss.php,v 1.1.2.7 2007/03/02 12:23:32 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

require_once ('tiki-setup.php');
require_once ('lib/tikilib.php');
require_once ('lib/rss/rsslib.php');
require_once ('lib/calendar/calendarlib.php');

if (!isset($rss_calendar) || $rss_calendar != 'y') {
	$errmsg=tra("rss feed disabled");
	require_once ('tiki-rss_error.php');
}

if ($tiki_p_view_calendar != 'y') {
        $errmsg=tra("Permission denied you cannot view this section");
        require_once ('tiki-rss_error.php');
}

$feed = "calendars";
$calendarIds=array();
if (isset($_REQUEST["calendarIds"])) {
    $calendarIds = $_REQUEST["calendarIds"];
    if (!is_array($calendarIds)) {
	$calendarIds = array($calendarIds);
    }	
    $uniqueid = $feed.".".implode(".",$calendarIds);
} else {
    $uniqueid = $feed;
    $calendarIds = array();
}
$output = $rsslib->get_from_cache($uniqueid);

if ($output["data"]=="EMPTY") {
	$tmp = tra("Tiki RSS feed for calendars");
	$title = (!empty($title_rss_calendar)) ? $title_rss_calendar : $tmp;
	$tmp = tra("Upcoming events.");
	$desc = (!empty($desc_rss_calendar)) ? $desc_rss_calendar : $tmp;
	$now = date("U");
	$id = "calitemId";
	$titleId = "name";
	$descId = "body";
	$dateId = "start";
	$authorId = "user";
	$readrepl = "tiki-calendar.php?editmode=details&$id=%s";

	$tmp = $tikilib->get_preference('title_rss_'.$feed, '');
	if ($tmp<>'') $title = $tmp;
	$tmp = $tikilib->get_preference('desc_rss_'.$feed, '');
	if ($desc<>'') $desc = $tmp;

	$allCalendars = $calendarlib->list_calendars();

	// build a list of viewable calendars
	$calendars = array();
	foreach ($allCalendars['data'] as $cal) {

	    $visible = false;
	    if (sizeof($calendarIds) == 0 || in_array($cal['calendarId'],$calendarIds)) {
			if ($cal["personal"] == "y") {
			    if ($user) {
					$visible = true;
			    }
			} else {
			    if ($userlib->object_has_one_permission($cal['calendarId'],'calendar')) {
					if ($userlib->object_has_permission($user, $cal['calendarId'], 'calendar', 'tiki_p_view_calendar')) {
					    $visible = true;
					} 
			    } else {
					$visible = ($tiki_p_view_calendar == 'y');
			    }
			}
	    }
	    if ($visible) {
			$calendars[] = $cal['calendarId'];
	    }
	}

	$maxCalEntries = $tikilib->get_preference("max_rss_calendar", $maxRecords);
	$items = $calendarlib->list_raw_items($calendars, "", $now, $now+365*24*60*60, 0, $maxCalEntries);

	require_once("lib/smarty_tiki/modifier.tiki_long_datetime.php");

	for ($i = 0; $i < sizeof($items); $i++) {
	    $items[$i]["body"] = tra("Start:") . " " .smarty_modifier_tiki_long_datetime($items[$i]["start"])."<br />\n";
	    $items[$i]["body"] .= tra("End:") . " " .smarty_modifier_tiki_long_datetime($items[$i]["end"])."<br />\n";
	    $items[$i]["body"] .= $tikilib->parse_data($items[$i]["description"]);
	}

	$changes = array('data' => $items);
	unset($items);

	$output = $rsslib->generate_feed($feed, $uniqueid, '', $changes, $readrepl, '', $id, $title, $titleId, $desc, $descId, $dateId, $authorId);
}
header("Content-type: ".$output["content-type"]);
print $output["data"];

?>
