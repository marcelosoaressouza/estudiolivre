<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

// Load configuration of the Galaxia Workflow Engine
include_once (dirname(__FILE__) . '/config.php');

include_once (GALAXIA_LIBRARY.'/src/API/Process.php');
include_once (GALAXIA_LIBRARY.'/src/API/Instance.php');
include_once (GALAXIA_LIBRARY.'/src/API/BaseActivity.php');
include_once (GALAXIA_LIBRARY.'/src/API/activities/Activity.php');
include_once (GALAXIA_LIBRARY.'/src/API/activities/End.php');
include_once (GALAXIA_LIBRARY.'/src/API/activities/Join.php');
include_once (GALAXIA_LIBRARY.'/src/API/activities/Split.php');
include_once (GALAXIA_LIBRARY.'/src/API/activities/Standalone.php');
include_once (GALAXIA_LIBRARY.'/src/API/activities/Start.php');
include_once (GALAXIA_LIBRARY.'/src/API/activities/SwitchActivity.php');
include_once (GALAXIA_LIBRARY.'/src/Observers/Logger.php');

$process = new Process($dbGalaxia);
$instance = new Instance($dbGalaxia);
$baseActivity = new BaseActivity($dbGalaxia);

?>
