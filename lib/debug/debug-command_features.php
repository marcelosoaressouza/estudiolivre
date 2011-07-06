<?php
/** \file
 * $Header: /cvsroot/tikiwiki/tiki/lib/debug/debug-command_features.php,v 1.3.12.1 2008/02/21 19:10:04 marclaporte Exp $
 *
 * \brief Show features state in a convenient way
 *
 * \author zaufi <zaufi@sendmail.ru>
 *
 */

//this script may only be included - so its better to die if called directly.
if(strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

require_once('lib/debug/debugger-ext.php');

/**
 * \brief Debugger command to show features on/off state
 */
class DbgFeatures extends DebuggerCommand {
  /// \b Must have function to announce command name in debugger console
  function name() {
    return 'features';
  }

  /// \b Must have function to provide help to debugger console
  function description() {
    return 'Show features on/off state';
  }

  /// \b Must have function to provide help to debugger console
  function syntax() {
    return 'features [partial-name]';
  }

  /// \b Must have function to show example of usage of given command
  function example() {
    return 'features' . "\n" . 'features wiki';
  }

  /// Execute command with given set of arguments.
  function execute($params) {
    $this->set_result_type(TPL_RESULT);

    $this->set_result_tpl('debug/tiki-debug_features.tpl');
    // Is regex to match against var name given?
    $p = explode(" ", trim($params));
    $mask = count($p) > 0 ? str_replace('$', '', trim($p[0])) : '';
    // Get list of all vars
    global $smarty;
    $tpl_vars = $smarty->get_template_vars();
    // convert to vector of names, filter permissions only, and sort
    $perms = array();
    $len = strlen($mask);

    foreach($tpl_vars as $key => $val) {
      if((!$len || $len && preg_match('/' . $mask . '/', $key)) && preg_match('/feature_/', $key))
        $perms[] = array(
                     'name' => $key,
                     'value' => $val
                   );
    }

    return $perms;
  }
}

/// Class factory to create instances of defined commands
function dbg_command_factory_features() {
  return new DbgFeatures();
}

?>