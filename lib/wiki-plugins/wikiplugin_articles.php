<?php
// Includes articles listing in a wiki page
// Usage:
// {ARTICLES(max=>3,topic=>topicId)}{ARTICLES}
//
// Damian added the following parameter
// topic=>topicId

function wikiplugin_articles_help() {
  return tra("~np~{~/np~ARTICLES(max=>3,topic=>topicName,type=>type,categId=>Category parent ID)}{ARTICLES} Insert articles into a wikipage");
}

function wikiplugin_articles($data,$params) {
  global $smarty;
  global $tikilib;
  global $feature_articles;
  global $tiki_p_read_article;
  global $dbTiki;
  global $feature_multilingual;
  global $pageLang;

  extract($params,EXTR_SKIP);

  if(($feature_articles !=  'y') || ($tiki_p_read_article != 'y')) {
    //    the feature is disabled or the user can't read articles
    return("");
  }

  if(!isset($max)) {
    $max='3';
  }

  if(!isset($start)) {
    $start='0';
  }

  // Addes filtering by topic if topic is passed
  if(!isset($topic)) {
    $topic='';
  }

  else {
    $topic = $tikilib->fetchtopicId($topic);
  }

  // Adds filtering by type if type is passed
  if(!isset($type))
    $type='';

  if(!isset($categId))
    $categId = '';

  if(!isset($lang))
    $lang = '';

  $now = date("U");

  include_once("lib/commentslib.php");
  $commentslib = new Comments($dbTiki);

  $listpages = $tikilib->list_articles($start, $max, 'publishDate_desc', '', $now, 'admin', $type, $topic, 'y', '', $categId, $lang);

  if($feature_multilingual == 'y') {
    global $multilinguallib;
    include_once("lib/multilingual/multilinguallib.php");
    $listpages['data'] = $multilinguallib->selectLangList('article', $listpages['data'], $pageLang);
  }

  for($i = 0; $i < count($listpages["data"]); $i++) {
    $listpages["data"][$i]["parsed_heading"] = $tikilib->parse_data($listpages["data"][$i]["heading"]);
    $comments_prefix_var='article:';
    $comments_object_var=$listpages["data"][$i]["articleId"];
    $comments_objectId = $comments_prefix_var.$comments_object_var;
    $listpages["data"][$i]["comments_cant"] = $commentslib->count_comments($comments_objectId);
    //print_r($listpages["data"][$i]['title']);
  }

  require_once('lib/articles/artlib.php');

// Unsure of reasoning, but Ive added a isset around here for when Articles plugin is called
// multiple times on a page. - Damian aka Damosoft
  If(isset($artlib)) {
    $topics = $artlib->list_topics();
    $smarty->assign_by_ref('topics', $topics);
  }

  If(isset($artlib)) {
    $type = $artlib->list_types();
    $smarty->assign_by_ref('type', $type);
  }

  // If there're more records then assign next_offset
  $smarty->assign_by_ref('listpages', $listpages["data"]);

  return "~np~ ".$smarty->fetch('tiki-view_articles.tpl')." ~/np~";
  //return str_replace("\n","",$smarty->fetch('tiki-view_articles.tpl')); // this considers the hour in the header like a link
}
?>
