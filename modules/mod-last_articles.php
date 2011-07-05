<?php
// $Header: /cvsroot/tikiwiki/tiki/modules/mod-last_articles.php,v 1.5.4.6 2007/03/27 13:16:04 sylvieg Exp $

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

if (!function_exists('mod_last_articles_help')) {
	function mod_last_articles_help() {
		return "type=Article|Event|..., topicId=1,topic=xx,categId=1,lang=en";
	}
}
// Parameter absurl set if the last_article url is absolute or not [y|n].
// If not set, default = relative

// filter for type, topicId or topic...
// if ! is in front of type or topic, the result is inversed
$mod_type = isset($module_params["type"]) ? $module_params["type"] : '';
$mod_topicId = isset($module_params["topicId"]) ? $module_params["topicId"] : '';
$mod_topic = isset($module_params["topic"]) ? $module_params["topic"] : '';
$smarty->assign('type',$mod_type);
$smarty->assign('topicId',$mod_topicId);
$categId = isset($module_params['categId']) ? $module_params['categId'] : '';
$l = isset($module_params['lang']) ? $module_params['lang'] : '';

$ranking = $tikilib->list_articles(0,$module_rows,'publishDate_desc', '', date("U"), '', $mod_type, $mod_topicId, 'y', $mod_topic, $categId, $l);
$smarty->assign('modLastArticles',$ranking["data"]);
$smarty->assign('nonums', isset($module_params["nonums"]) ? $module_params["nonums"] : 'n');
$smarty->assign('absurl', isset($module_params["absurl"]) ? $module_params["absurl"] : 'n');
$module_rows = count($ranking["data"]);
$smarty->assign('module_rows', $module_rows);
?>
