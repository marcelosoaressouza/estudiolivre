<?php

// $Header: /cvsroot/tikiwiki/tiki/lib/wiki-plugins/Attic/wikiplugin_sup.php,v 1.1.2.2 2008/01/31 18:58:55 marclaporte Exp $

// Wiki plugin to output superscript <sup>...</sup>
// based on sub plugin

function wikiplugin_sup_help() {
        return tra("Displays text in superscript.").":<br />~np~{SUP()}text{SUP}~/np~";
}

function wikiplugin_sup($data, $params)
{
        global $tikilib;

        extract ($params,EXTR_SKIP);
	return "<sup>$data</sup>";
}

?>
