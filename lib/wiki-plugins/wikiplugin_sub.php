<?php

// $Header: /cvsroot/tikiwiki/tiki/lib/wiki-plugins/wikiplugin_sub.php,v 1.1.2.5 2005/03/04 20:45:12 sylvieg Exp $

// Wiki plugin to output <sub>...</sub>
// - rlpowell

function wikiplugin_sub_help() {
        return tra("Displays text in subscript.").":<br />~np~{SUB()}text{SUB}~/np~";
}

function wikiplugin_sub($data, $params)
{
        global $tikilib;

        extract ($params,EXTR_SKIP);
	return "<sub>$data</sub>";
}

?>
