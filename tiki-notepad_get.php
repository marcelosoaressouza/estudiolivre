<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-notepad_get.php,v 1.6.2.2 2007/03/02 12:23:15 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
require_once('tiki-setup.php');

include_once('lib/notepad/notepadlib.php');

if($feature_notepad != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_notepad");

  $smarty->display("error.tpl");
  die;
}

if(!$user) {
  $smarty->assign('msg', tra("Must be logged to use this feature"));

  $smarty->display("error.tpl");
  die;
}

if($tiki_p_notepad != 'y') {
  $smarty->assign('msg', tra("Permission denied to use this feature"));

  $smarty->display("error.tpl");
  die;
}

if(!isset($_REQUEST["noteId"])) {
  $smarty->assign('msg', tra("No note indicated"));

  $smarty->display("error.tpl");
  die;
}

$info = $notepadlib->get_note($user, $_REQUEST["noteId"]);

header("Content-type: text/plain");
//header( "Content-Disposition: attachment; filename=$file" );
header("Content-Disposition: inline; filename=tiki-calendar");
echo $info['data'];

?>
