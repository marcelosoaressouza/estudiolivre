<?php
/** \file
 * $Header: /cvsroot/tikiwiki/tiki/lib/debug/debug-command_dmsg.php,v 1.4.12.1 2008/02/21 19:10:04 marclaporte Exp $
 *
 * \brief 'debugger command' to show user messages in tab
 *
 * \author zaufi <zaufi@sendmail.ru>
 *
 */

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

require_once ('lib/debug/debugger-ext.php');

global $debugger;
require_once ('lib/debug/debugger.php');

/**
 * \brief Command 'watch'
 */
class DbgCmd_DebugMessages extends DebuggerCommand {
	/// Function to create interface part of command: return ["button name"] = <html code>
	function draw_interface() {
		global $smarty;

		global $debugger;
		$smarty->assign_by_ref('messages', $debugger->dmsgs);
		return $smarty->fetch("debug/tiki-debug_dmsg_tab.tpl");
	}

	/// Function to return caption string to draw plugable tab in interface
	function caption() {
		return "debug messages";
	}

	/// Need to display button if we have smth to show
	function have_interface() {
		global $debugger;

		// At least one message is always exists ... It is debugger itself say that started :)
		return count($debugger->dmsgs) > 1;
	}
}

/// Class factory
function dbg_command_factory_dmsg() {
	return new DbgCmd_DebugMessages();
}

?>