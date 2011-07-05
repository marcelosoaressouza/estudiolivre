<?php

// $Header: /cvsroot/tikiwiki/tiki/modules/mod-top_forum_posters.php,v 1.2.2.3 2005/12/14 17:48:24 sylvieg Exp $

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

global $ranklib; include_once ('lib/rankings/ranklib.php');
$posters = $ranklib->forums_top_posters($module_rows);

$smarty->assign('modTopForumPosters', $posters["data"]);
$smarty->assign('nonums', isset($module_params["nonums"]) ? $module_params["nonums"] : 'n');

?>
