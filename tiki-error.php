<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-error.php,v 1.9.2.6 2007/03/02 12:23:10 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once ('tiki-setup.php');
include_once('lib/wiki/wikilib.php');

ask_ticket('error');

$page='';
$type='';

if (isset( $feature_usability ) && $feature_usability == 'y' ) {
  if (!isset($_REQUEST["error"])) {
/*
    if ( !empty($_REQUEST['page'])) {
      $page = $_REQUEST['page'];
      $_REQUEST["error"] = tra("Page") . " '".$page."' ".tra("cannot be found");
      $type="404";
    } else
*/
    if ( ($_SERVER["REQUEST_URI"] && !(preg_match('/tiki-error.php/',$_SERVER["REQUEST_URI"])) ) ) {
      $page = $_SERVER["REQUEST_URI"];
      $page = substr($page,strrpos($page,'/')+1);
      $_REQUEST["error"] = tra("Page") . " '".$page."' ".tra("cannot be found");
      $type="404";
    } else  {
      $_REQUEST["error"] = tra('unknown error');
    }
  }
} else {
  if (!isset($_REQUEST["error"])) $_REQUEST["error"] = tra('unknown error');
}

// This can be useful for putting custom code inside error page.
// ie: in error.tpl {$referer) will hold "login" if user came from tiki-login.php
// if this gets useful we can integrate with tickets, this was just a hack to show to LarsKl
// during a chat.
if (!empty($_SERVER['HTTP_REFERER']) && preg_match('/tiki-([a-z_]+?)\.php/', $_SERVER['HTTP_REFERER'], $m)) {
    $smarty->assign('referer',$m[1]);
}

// Display the template
$smarty->assign('msg', strip_tags($_REQUEST["error"]));
if ( isset($type) && $type == "404" ) {
  $likepages = $wikilib->get_like_pages($page);
  /* if we have exactly one match, redirect to it */
  if(count($likepages) == 1 ) {
    header("Location: tiki-index.php?page=$likepages[0]");
    die;
  }
  $smarty->assign_by_ref('likepages', $likepages);
  header ("Status: 404 Not Found"); /* PHP3 */
  header ("HTTP/1.0 404 Not Found"); /* PHP4 */
  $smarty->assign('errortitle', strip_tags($_REQUEST["error"]. " (404)"));
  $smarty->assign('page', $page);
  $smarty->assign('errortype', $type);
} else {
}

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

$smarty->display("error.tpl");
?>
