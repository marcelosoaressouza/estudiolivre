<?php
/*
 * $Header: /cvsroot/tikiwiki/tiki/lib/wiki-plugins/wikiplugin_div.php,v 1.1.4.8 2006/08/26 20:12:40 sampaioprimo Exp $
 *
 * DIV plugin. Creates a division block for the content. Forces the content 
 * to be aligned (left by default).
 * 
 * Syntax:
 * 
 *  {DIV([align=>left|right|center|justify][, bg=color][, width=>num[%]][, float=>left|right])}
 *   some content
 *  {DIV}
 * 
 */
function wikiplugin_div_help() {
	return tra("Insert a division block on wiki page").":<br />~np~{DIV(class=>class, type=>div|span|pre|i|b|tt|blockquote, align=>left|right|center|justify, bg=>color, width=>num[%], float=>left|right])}".tra("text")."{DIV}~/np~";
}

function wikiplugin_div($data, $params) {

	extract ($params,EXTR_SKIP);
	$possibletypes = array('div','span','pre','b','i','tt','p','blockquote');
	$t    = (isset($type) and in_array($type,$possibletypes)) ? "$type"  : "div";
	$c    = (isset($class)) ? " class='$class'"  : "";
	$w    = (isset($width)) ? " width: $width;"  : "";
	$bg   = (isset($bg))    ? " background: $bg;" : "";
	$al   = (isset($align) && ($align == 'right' || $align == "center" || $align == "justify")) ? " text-align: $align;" : " text-align: left;";
	$fl   = (isset($float) && ($float == 'left' || $float == "right")) ? " float: $float;"  : " float: none;";

	$begin  = "<$t style=\"$bg$al$w$fl\"$c>";
	$end = "</$t>";
	return $begin . $data . $end;
}
?>
