<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-handlers.php,v 1.6.2.4 2008/02/21 20:28:17 lphuberdeau Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// You can define here handlers to be used for parsing
// wiki pages, articles, FAQs and other objects (anything
// that is parsed

//function foo($data) {
// return 'foo'.$data.'foo';
//}
//
//$tikilib->add_pre_handler("foo");
//$tikilib->add_pos_handler("foo");
//$tikilib->add_postedit_handler("foo");

if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

?>
