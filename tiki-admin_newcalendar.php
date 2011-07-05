<?php
// $Header: /cvsroot/tikiwiki/tiki/Attic/tiki-admin_newcalendar.php,v 1.1.2.2 2008/02/21 22:36:53 lphuberdeau Exp $
//
// Copyright (c)2002-2003
// Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of 
// authors. Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. 
// See license.txt for details.

//! TikiWiki Calendar Feature Rewrite for v1.9.8.3+ and v1.10
/****************************************************************************
 ** TikiWiki Calendar Feature Rewrite                           12/20/2007 **
 ****************************************************************************
 ** ReWritten by Mike Kerr (kerrnel22)
 ** 
 ** This script replaces the admin script for the old calendar system.
 ** Consolidated in this rewrite are:
 **
 **    - System calendars                 - Personal Calendars
 **    - Group Calendars                  - Public Calendars
 **   
 ** New functionality make it compatible with iCal for import/export, however
 ** the initial rewrite may not have that functionality immediately.
 **
 ** STATE OF THE CODE
 ** -----------------
 **
 ** THIS CODE IS NOT USABLE - STILL BEING WORKED ON.  Contact kerrnel22
 ** (tiki.kerrnel@kerris.com) for info on this.
 ** Associated files:
 ** /tiki-admin_newcalendar.php
 ** /template/tiki-admin_newcalendar.tpl
 ** /lib/newcalendarlib.php
 ** /lib/calendar/change_class.php
 ** /lib/calendar/display_class.php
 **
 ****************************************************************************/

// Initialization
require_once ('tiki-setup.php');
include_once ('lib/newcalendarlib.php');

// 110: REMOVE THE FOLLOWING LINE OF CODE IN 1.10!
if (isset($feature_forums)) { $prefs['feature_forums'] == $feature_forums; }

// Do a permission check, but do not do a feature check since the system
// utilizes the calendars even if users don't, so by default it is enabled.
// Will have to do feature checks if trying to access non-system calendars.
if ($tiki_p_admin != 'y' && $tiki_p_admin_calendar != 'y') {
	$smarty->assign('msg', tra("You do not have permission to admin the calendars."));
	$smarty->display("error.tpl");
	die;
}



/*
 * Set the display parameters for the template.
 */
ask_ticket('admin-calendars');

// 110:  UNCOMMENT THE FOLLOWING TWO LINES FOR TIKI 1.10 VERSION
//$section = 'calendar';
//include_once ('tiki-section_options.php');

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

// Display the page
$smarty->assign('uses_tabs', 'y');
$smarty->assign('mid', 'tiki-admin_newcalendar.tpl');
$smarty->display("tiki.tpl");

exit;

?>

