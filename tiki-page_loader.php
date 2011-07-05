<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-page_loader.php,v 1.9.2.3 2008/02/21 19:35:58 lphuberdeau Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.
include_once ('tiki-setup.php');

include_once ('lib/htmlpages/htmlpageslib.php');

if ($feature_html_pages != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_html_pages");

	$smarty->display("error.tpl");
	die;
}

$refresh = 1000 * $_REQUEST["refresh"];

?>

<html>
	<head>
		<script language = 'Javascript' type = 'text/javascript'>

		<?php

		$zones = $htmlpageslib->list_html_page_content($_REQUEST["pageName"], 0, -1, 'zone_asc', '');
		$cmds = array();

		$temp_max = count($zones["data"]);
		for ($i = 0; $i < $temp_max; $i++) {
			$cmd = 'top.document.getElementById("' . $zones["data"][$i]["zone"] . '").innerHTML="' . $zones["data"][$i]["content"] . '";';

			echo $cmd;
		}

		?>

		</script>
	</head>

	<body onload = "window.setInterval('location.reload()','<?php echo $refresh ?>');">
		<?php

		//print_r($cmds);

		?>

	</body>
</html>
