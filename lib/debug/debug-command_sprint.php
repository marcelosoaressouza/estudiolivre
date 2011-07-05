<?php
/** \file
 * $Header: /cvsroot/tikiwiki/tiki/lib/debug/debug-command_sprint.php,v 1.3.12.1 2008/02/21 19:10:04 marclaporte Exp $
 *
 * \brief Print Smarty vars
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

/**
 * \brief Debugger command to print smarty vars
 */
class DbgSPrint extends DebuggerCommand {
	/// \b Must have function to announce command name in debugger console
	function name() {
		return 'sprint';
	}

	/// \b Must have function to provide help to debugger console
	function description() {
		return 'Print Smarty variable';
	}

	/// \b Must have function to provide help to debugger console
	function syntax() {
		return 'sprint var1 var2 var3 ...';
	}

	/// \b Must have functio to show example of usage of given command
	function example() {
		return 'sprint user feature_left_column';
	}

	/// Execute command with given set of arguments.
	function execute($params) {
		global $smarty;

		$this->set_result_type(TEXT_RESULT);
		$result = '';
		$vars = explode(" ", $params);

		foreach ($vars as $v) {
			$v = trim(str_replace("$", "", $v));

			if (strlen($v) != 0) {
				$tmp = $smarty->get_template_vars();

				if (is_array($tmp) && isset($tmp[$v]))
					$result .= $v . ' = ' . print_r($tmp[$v], true). "\n";
				else
					$result .= 'Smarty variable "' . $v . '" not found';
			}
		}

		return $result;
	}
}

/// Class factory to create instances of defined commands
function dbg_command_factory_sprint() {
	return new DbgSPrint();
}

?>