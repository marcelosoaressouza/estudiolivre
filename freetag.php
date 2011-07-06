<?php
// $Header: /cvsroot/arca/estudiolivre/patch/tiki-1.10/_freetag-new_files.patch,v 1.4 2007-07-25 17:04:33 sampaioprimo Exp $

// Copyright (c) 2002-2005, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

//this script may only be included - so its better to err & die if called directly.
//smarty is not there - we need setup
require_once('tiki-setup.php');
$access->check_script($_SERVER["SCRIPT_NAME"],basename(__FILE__));

global $feature_freetags;

if($feature_freetags == 'y') {

  global $freetaglib;

  if(!is_object($freetaglib)) {
    include_once('lib/freetag/freetaglib.php');
  }

  if(isset($_REQUEST["freetag_save"]) && $_REQUEST["freetag_save"]) {

    $tag_string = $_REQUEST['freetag_string'];

    global $user;
    // Use same parameters passed to categorize.php, makes simpler implementation
    // and keep consistency
    $freetaglib->tag_object($user, $cat_objid, $cat_type, $tag_string);
  }

  $taglist = $freetaglib->get_tags_on_object($cat_objid, $cat_type);

  $smarty->assign('taglist',$taglist);
}

?>
