<?php

//this script may only be included - so its better to die if called directly.
if(strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

function smarty_function_count($params, &$smarty) {
  extract($params);

  if(empty($var)) {
    $smarty->trigger_error("count: missing 'var' parameter");
    return;
  }

  print(count($var));
}

/* vim: set expandtab: */

?>
