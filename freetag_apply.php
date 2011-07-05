<?php 
// $Header: /cvsroot/arca/estudiolivre/patch/tiki-1.10/_freetag-new_files.patch,v 1.4 2007-07-25 17:04:33 sampaioprimo Exp $

// Copyright (c) 2002-2005, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

//this script may only be included - so its better to err & die if called directly.
//smarty is not there - we need setup
require_once('tiki-setup.php');  

global $feature_freetags;
global $tiki_p_freetags_tag;

if ($feature_freetags == 'y' and $tiki_p_freetags_tag == 'y') {

    global $freetaglib;
    if (!is_object($freetaglib)) {
	include_once('lib/freetag/freetaglib.php');
    }

    $tag_string = $_REQUEST['freetag_string'];
    
    // Use same parameters passed to categorize.php, makes simpler implementation
    // and keep consistency
    $old_tags = $freetaglib->get_tags_on_object($cat_objid, $cat_type);

    global $user;

    if (!isset($cat_desc)) $cat_desc = '';
    if (!isset($cat_name)) $cat_name = '';
    if (!isset($cat_href)) $cat_href = '';

    $freetaglib->add_object($cat_type, $cat_objid, $cat_desc, $cat_name, $cat_href);	
    $freetaglib->update_tags($user, $cat_objid, $cat_type, $tag_string);

}

?>
