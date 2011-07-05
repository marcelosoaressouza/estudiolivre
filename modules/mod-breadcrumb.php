<?php
/** $Header: /cvsroot/tikiwiki/tiki/modules/mod-breadcrumb.php,v 1.5.2.1 2004/08/26 17:39:15 mose Exp $
 * \param maxlen = max number of displayed characters for the page name
 */

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

if (!isset($_SESSION["elBreadCrumbs"])) {
	$_SESSION["elBreadCrumbs"] = array();
}

$bbreadCrumb = $_SESSION["elBreadCrumbs"];
$smarty->assign('elCrumbs', $bbreadCrumb);
$smarty->assign('maxlen', isset($module_params["maxlen"]) ? $module_params["maxlen"] : 0);
?>
