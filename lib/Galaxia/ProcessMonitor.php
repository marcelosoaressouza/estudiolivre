<?php

// Load configuration of the Galaxia Workflow Engine

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

include_once (dirname(__FILE__) . '/config.php');

include_once (GALAXIA_LIBRARY.'/src/ProcessMonitor/ProcessMonitor.php');

$processMonitor = new ProcessMonitor($dbGalaxia);

?>
