<?php

// $Header: /cvsroot/tikiwiki/tiki/index.php,v 1.4.2.3 2007/03/02 12:23:14 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
require_once ('tiki-setup.php');
if(!(headers_sent())){
header ("location: $tikiIndex");
}
die("header already sent");

?>
