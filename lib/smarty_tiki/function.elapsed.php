<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

function smarty_function_elapsed($params, &$smarty)
{
    global $tiki_timer;
    
    $ela = number_format($tiki_timer->elapsed(),2);
    print($ela);
}

/* vim: set expandtab: */

?>
