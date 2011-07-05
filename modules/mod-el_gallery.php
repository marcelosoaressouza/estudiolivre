<?php
// migrado pra 2.0!
//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

require_once("lib/persistentObj/PersistentObjectController.php");

$controller = new PersistentObjectController("Publication");
$pending = $controller->findAll(array('user' => $user, 'publishDate' => false));
$smarty->assign('pendingUploadFiles', $pending);

?>