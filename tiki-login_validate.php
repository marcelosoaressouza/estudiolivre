<?php

// $Header: /cvsroot/tikiwiki/tiki/tiki-login_validate.php,v 1.9.2.10 2008/02/21 19:35:58 lphuberdeau Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

// Initialization
require_once('tiki-setup.php');

if($validateUsers != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": validateUsers");

  $smarty->display("error.tpl");
  die;
}

$isvalid = false;

if(isset($_REQUEST["user"])) {
  if(isset($_REQUEST["pass"])) {
    $isvalid = $userlib->validate_user($_REQUEST["user"], $_REQUEST["pass"],'','');
  }
}

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

if($isvalid) {
  $user = $_REQUEST['user'];
  $userlib->confirm_user($user);

  if($tikilib->get_preference('validateRegistration','n') == 'y') {
    $foo = parse_url($_SERVER["REQUEST_URI"]);
    $foo1 = str_replace('tiki-login_validate','tiki-login_scr',$foo['path']);
    $machine =$tikilib->httpPrefix().$foo1;
    $smarty->assign('mail_machine',$machine);
    $smarty->assign('mail_site',$_SERVER['SERVER_NAME']);
    $smarty->assign('mail_user',$user);
    $email = $userlib->get_user_email($user);
    include_once("lib/webmail/tikimaillib.php");
    $mail = new TikiMail();
    $mail->setText($smarty->fetch('mail/moderate_activation_mail.tpl'));
    $mail->setSubject($smarty->fetch('mail/moderate_activation_mail_subject.tpl'));
    $mail->send(array($email));
    $logslib->add_log('register','validated account '.$user);
  }

  else {
    $_SESSION["$user_cookie_site"] = $user;
  }

  $smarty->assign('msg', tra("Account validated successfully."));
  $smarty->display("information.tpl");
}

else {
  $smarty->assign('msg', tra("Invalid username or password"));
  $smarty->display("error.tpl");
}

?>
