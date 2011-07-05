<?php # $CVSHeader$

# Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
# All Rights Reserved. See copyright.txt for details and a complete list of authors.
# Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// I call index.php because tiki may not be setup when people attempt to call this.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== FALSE) {
	header ("location: index.php");
	die;
}



error_reporting (E_ALL);

require_once ('irclib.php');

echo '$Id: split_logs.php,v 1.3.4.3 2008/02/21 21:29:29 marclaporte Exp $', "\n";

if ($argc < 2) {
	echo "
Usage: {$argv[0]} filespec[s]

Examples:

{$argv[0]} tikiwiki.irc
{$argv[0]} tikiwiki.irc php.irc
{$argv[0]} /home/me/irclogs/tikiwiki.irc
{$argv[0]} /home/me/irclogs
";

	exit;
}

for ($i = 1; $i < $argc; ++$i) {
	IRC_Log_Parser::splitFiles($argv[$i]);
}

echo "Done.\n";

?>