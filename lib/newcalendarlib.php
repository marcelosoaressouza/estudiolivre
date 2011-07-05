<?php
/*! \mainpage Tikiwiki Calendar Library
 * $Header: /cvsroot/tikiwiki/tiki/lib/Attic/newcalendarlib.php,v 1.1.2.1 2007/12/17 13:30:59 kerrnel22 Exp $
 *
 * Copyright (c)2002-2003
 * \author Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
 * \author All Rights Reserved. See copyright.txt for details and a complete list of
 * \author authors. Licensed under the GNU LESSER GENERAL PUBLIC LICENSE.
 * \author See license.txt for details.
 *
 * This script is a library and may only be included! Die if called directly...
 */

// This script may only be included! Die if called directly...
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
	header("location: index.php");
	die();
}

/** CalendarLib.
 * A class to handle all of the Calendar-type features within Tikiwiki.
 * All queries, data manipulation, and module display type functions related
 * to any of the Tiki calendar systems are consolidated in this class.
 */
class CalendarLib extends TikiLib {

	/** Constructor for the Calendar library.  Accepts an array containing
	 * a list of classes to include since we won't need them all all the
	 * time, so it centralizes the calendar functions in one library.  If
	 * no array is provided, or it has no values in it, then only the
	 * common QUERY functions are available.
	 *
	 * \param $db an ADOdb pointer to the Tiki database.
	 * \param $includes NULL or array() of keywords representing additional
	 *	sub-classes to include as-needed.
	 */
	function CalendarLib($db, $includes = NULL) {

		// Verify the DB handle.
		$this->TikiLib($db);

		if ($includes) {
			foreach ($includes as $inc) {
				switch ($inc) {
				// Functions used to add, delete, or otherwise
				// change calendar information in the database.
				case "change":
					include_once ('calendar/change_class.php');
					break;
				// Functions used for HTML display boxes by
				// modules.
				case "display":
					include_once ('calendar/display_class.php');
					break;
				}
			}
		}
	}

/*!
 * Common Calendar-ish functions.
 */


}
?>

