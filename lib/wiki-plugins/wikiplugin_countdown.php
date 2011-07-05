<?php
/* Tiki-Wiki Countdown plugin
 *
 * This is an example plugin to indicate a countdown to a date.
 * Plugins are called using the syntax
 * {COUNTDOWN(end=>string date)} to reach all targets!{COUNTDOWN}
 * Name must be in uppercase!
 * params is in the form: name=>value,name2=>value2 (don't use quotes!)
 * If the plugin doesn't use params use {NAME()}content{NAME}
 *
 * The function will receive the plugin content in $data and the params
 * in the asociative array $params (using extract to pull the arguments
 * as in the example is a good practice)
 * The function returns some text that will replace the content in the
 * wiki page.
 */
function wikiplugin_countdown_help() {
	return tra("Example").":<br />~np~{COUNTDOWN(enddate=>April 1 2004[,locatetime=>on])}".tra("text")."{COUNTDOWN}~/np~";
}
function wikiplugin_countdown($data, $params) {
	extract ($params,EXTR_SKIP);

	if (!isset($enddate)) {
		return ("<b>COUNTDOWN: Missing 'enddate' parameter for plugin</b><br />");
	}

	if (isset($localtime) && $localtime == 'on')
		$tz = 0;
	else
		$tz = $_COOKIE['tz_offset'];

	$now = strtotime ("now") + $tz;
	$then = strtotime ($enddate);
	$difference = $then - $now;
	$num = $difference/86400;
	$days = intval($num);
	$num2 = ($num - $days)*24;
	$hours = intval($num2);
	$num3 = ($num2 - $hours)*60;
	$mins = intval($num3);
	$num4 = ($num3 - $mins)*60;
	$secs = intval($num4);
	$ret = "$days ".tra("days").", $hours ".tra("hours").", $mins ".tra("minutes")." ".tra("and")." $secs ".tra("seconds")." $data";
	return $ret;
}

?>
