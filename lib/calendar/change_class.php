<?php
// $Header: /cvsroot/tikiwiki/tiki/lib/calendar/Attic/change_class.php,v 1.1.2.2 2008/02/21 22:36:56 lphuberdeau Exp $
//
// Copyright (c)2002-2003
// Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of
// authors. Licensed under the GNU LESSER GENERAL PUBLIC LICENSE.
// See license.txt for details.

// This script may only be included! Die if called directly...
if(strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

/** change_class Encompases functions that alter calendar data in the
 * database.  Extends the CalendarLib class.
 */
class delete_class extends CalendarLib {

  // Constructor for the change_class library.
  function delete_class() {
    // Do nothing at the moment.
  }

  /*
   * Common Calendar-ish functions.
   */

}

?>
