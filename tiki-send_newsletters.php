<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-send_newsletters.php,v 1.16.2.31 2007/03/02 12:23:13 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once ('tiki-setup.php');

include_once ('lib/newsletters/nllib.php');

$sender_email = $userlib->get_user_email($user);

if ($feature_newsletters != 'y') {
	$smarty->assign('msg', tra("This feature is disabled").": feature_newsletters");
	$smarty->display("error.tpl");
	die;
}

if (!isset($_REQUEST["nlId"])) $_REQUEST["nlId"] = 0;
$smarty->assign('nlId', $_REQUEST["nlId"]);

$newsletters = $nllib->list_newsletters(0, -1, 'created_desc', '', '', array("tiki_p_admin_newsletters", "tiki_p_send_newsletters"));

if (($user=="admin") && (count($newsletters["data"])==0)) {
	$smarty->assign('msg', tra("No newsletters available."));
	$smarty->display("error.tpl");
	die;
}

if (!$newsletters["cant"]) {
	$smarty->assign('msg', tra("You do not have permission to use this feature"));
	$smarty->display("error.tpl");
	die;
}

$smarty->assign('newsletters', $newsletters["data"]);

if ($_REQUEST["nlId"]) {
	$nl_info = $nllib->get_newsletter($_REQUEST["nlId"]);

	if (!isset($_REQUEST["editionId"])) $_REQUEST["editionId"] = 0;

	if ($_REQUEST["editionId"]) {
		$info = $nllib->get_edition($_REQUEST["editionId"]);
	} else {
		$info = array();
		$info["data"] = '';
		$info["subject"] = '';
	}
	$smarty->assign('info', $info);
}

if (isset($_REQUEST["remove"])) {
	$area = 'delnewsletter';
	if ($feature_ticketlib2 != 'y' or (isset($_POST['daconfirm']) and isset($_SESSION["ticket_$area"]))) {
		key_check($area);
		$nllib->remove_edition($_REQUEST["nlId"], $_REQUEST["remove"]);
	} else {
		key_get($area);
	}
}

if (isset($_REQUEST["templateId"]) && $_REQUEST["templateId"] > 0 && (!isset($_REQUEST['previousTemplateId']) || $_REQUEST['previousTemplateId'] != $_REQUEST['templateId'])) {
	$template_data = $tikilib->get_template($_REQUEST["templateId"]);
	$_REQUEST["data"] = $template_data["content"];
	$_REQUEST["preview"] = 1;
	$smarty->assign("templateId", $_REQUEST["templateId"]);
}

$smarty->assign('preview', 'n');

if (isset($_REQUEST["preview"])) {
	$smarty->assign('preview', 'y');
	//if (eregi("\<[ \t]*html[ \t\>]",  $_REQUEST["data"]))  // html newsletter - this will be the text sent with the html part
	//	$smarty->assign('txt', nl2br(strip_tags($_REQUEST["data"])));
	//TODO: the sent text version is not pretty: the text must be a textarea
	if (isset($_REQUEST["subject"])) {
		$info["subject"] = $_REQUEST["subject"];
	} else {
		$info["subject"] = '';
	}
	if (isset($_REQUEST["data"])) {
		$info["data"] = $_REQUEST["data"];
	} else {
		$info["data"] = '';
	}
	if (!empty($_REQUEST["usedTpl"])) {
		$smarty->assign('dataparsed', $tikilib->parse_data($info["data"]));
		$smarty->assign('subject', $info["subject"]);
		$info["dataparsed"]  = $smarty->fetch("newsletters/".$_REQUEST["usedTpl"]);
	        if (stristr($info['dataparsed'], "<body>") === false) {
        	        $info['dataparsed'] = "<html><body>".$info['dataparsed']."</body></html>";
        	}
		$smarty->assign("usedTpl", $_REQUEST["usedTpl"]);
	} else {
		$info["dataparsed"] = "<html><body>".$tikilib->parse_data($info["data"])."</body></html>";
	}
	$smarty->assign('info', $info);
}

$smarty->assign('presend', 'n');

if (isset($_REQUEST["save"])) {
	check_ticket('send-newsletter');
	// Now send the newsletter to all the email addresses and save it in sent_newsletters
	$smarty->assign('presend', 'y');

	$subscribers = $nllib->get_all_subscribers($_REQUEST["nlId"], "");
	$smarty->assign('nlId', $_REQUEST["nlId"]);
	$smarty->assign('data', $_REQUEST["data"]);
	$parsed = '';
	if (!empty($_REQUEST["usedTpl"])) {
		$smarty->assign('dataparsed', $tikilib->parse_data($_REQUEST["data"]));
		$smarty->assign('subject', $_REQUEST["subject"]);
		$parsed = $smarty->fetch("newsletters/".$_REQUEST["usedTpl"]);
	} else {
		$parsed = $tikilib->parse_data($_REQUEST["data"]);
	}
	if (stristr($parsed, "<body>") === false) {
		$parsed = "<html><body>$parsed</body></html>";
	}
	$smarty->assign('dataparsed',$parsed);
	
	$smarty->assign('subject', $_REQUEST["subject"]);
	$cant = count($subscribers);
	$smarty->assign('subscribers', $cant);
}

$smarty->assign('emited', 'n');

if (isset($_REQUEST["send"])) {
	include_once ('lib/webmail/tikimaillib.php');
	check_ticket('send-newsletter');

	$mail = new TikiMail();
	$txt = strip_tags(str_replace(array("\r\n","&nbsp;") , array("\n"," ") , $_REQUEST["data"]));
	if (stristr($_REQUEST["dataparsed"], "<body>") === false) {
		$html = "<html><body>".$tikilib->parse_data($_REQUEST["dataparsed"])."</body></html>";
	} else {
		$html = $_REQUEST["dataparsed"];
	}
	$sent = 0;
	$unsubmsg = '';
	$errors =  array();

	$users = $nllib->get_all_subscribers($_REQUEST["nlId"], $nl_info["unsubMsg"]);
	foreach ($users as $us) {
		$userEmail  = $us["login"];
		$email = $us["email"];
		if ($email == "") {
			$errors[] = array("user"=>$userEmail, "email"=>"");
			continue;
		}
		if ($userEmail == "")
			$userEmail = $userlib->get_user_by_email($email);
		if ($userEmail)
			$mail->setUser($userEmail);
		$mail->setFrom($tikilib->get_preference("sender_email",""));
		$mail->setSubject($_REQUEST["subject"]); // htmlMimeMail memorised the encoded subject 
		$languageEmail = !$userEmail? $language: $tikilib->get_user_preference($userEmail, "language", $language);
 		if ($nl_info["unsubMsg"] == 'y') {
			$unsubmsg = $nllib->get_unsub_msg($_REQUEST["nlId"], $userEmail, $languageEmail, $us["code"], $userEmail);
			if (stristr($html, "</body>") === false)
				$msg = $html.nl2br($unsubmsg);
			else
				$msg = str_replace("</body>", nl2br($unsubmsg)."</body>", $html);
		} else
			$msg = $html;
		$mail->setHtml($msg, $txt.strip_tags($unsubmsg));
		$mail->buildMessage();
		if ($mail->send(array($email)))
			$sent++;
		else
			$errors[] = array("user"=>$userEmail, "email"=>$email);
	}

	$smarty->assign('sent', $sent);
	$smarty->assign('emited', 'y');
	if (count($errors) > 0)
		$smarty->assign_by_ref('errors', $errors);
	$nllib->replace_edition($_REQUEST["nlId"], $_REQUEST["subject"], $_REQUEST["data"], $sent);
}

if (!isset($_REQUEST["sort_mode"])) {
	$sort_mode = 'sent_desc';
} else {
	$sort_mode = $_REQUEST["sort_mode"];
}

if (!isset($_REQUEST["offset"])) {
	$offset = 0;
} else {
	$offset = $_REQUEST["offset"];
}

$smarty->assign_by_ref('offset', $offset);

if (isset($_REQUEST["find"])) {
	$find = $_REQUEST["find"];
} else {
	$find = '';
}

$smarty->assign('find', $find);

$smarty->assign_by_ref('sort_mode', $sort_mode);
$channels = $nllib->list_editions($_REQUEST["nlId"], $offset, $maxRecords, $sort_mode, $find);
$smarty->assign('url', "tiki-send_newsletters.php");

$cant_pages = ceil($channels["cant"] / $maxRecords);
$smarty->assign_by_ref('cant_pages', $cant_pages);
$smarty->assign('actual_page', 1 + ($offset / $maxRecords));

if ($channels["cant"] > ($offset + $maxRecords)) {
	$smarty->assign('next_offset', $offset + $maxRecords);
} else {
	$smarty->assign('next_offset', -1);
}

// If offset is > 0 then prev_offset
if ($offset > 0) {
	$smarty->assign('prev_offset', $offset - $maxRecords);
} else {
	$smarty->assign('prev_offset', -1);
}
$smarty->assign_by_ref('channels', $channels["data"]);

if ($tiki_p_use_content_templates == 'y') {
	$templates = $tikilib->list_templates('newsletters', 0, -1, 'name_asc', '');
}
$smarty->assign_by_ref('templates', $templates["data"]);
$tpls = $nllib->list_tpls();
if (count($tpls) > 0) {
	$smarty->assign_by_ref('tpls', $tpls);
}
include_once("textareasize.php");
include_once ('lib/quicktags/quicktagslib.php');
$quicktags = $quicktagslib->list_quicktags(0,-1,'taglabel_desc','','newsletters');
$smarty->assign_by_ref('quicktags', $quicktags["data"]);

$section = 'newsletters';
include_once ('tiki-section_options.php');

ask_ticket ('send-newsletter');

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

// Display the template
$smarty->assign('mid', 'tiki-send_newsletters.tpl');
$smarty->display("tiki.tpl");

?>

