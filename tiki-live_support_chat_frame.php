<?php

// $Header$

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
require_once('tiki-setup.php');

if($feature_live_support != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_live_support");

  $smarty->display("error.tpl");
  die;
}

?>
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                                        <link rel="StyleSheet"  href="styles/<?php echo($style)?>" type="text/css" />
                                            </head>
                                            <body style="margin-left:4px;"></body>
                                                </html>
