<?php
// Initialization
require_once('tiki-setup.php');
require_once('lib/tikilib.php');
# httpScheme()
include_once('lib/registration/registrationlib.php');
include_once('lib/notifications/notificationlib.php');
include_once('lib/webmail/tikimaillib.php');
include_once('lib/userprefs/userprefslib.php');

// Permission: needs p_register and not to be a slave
if($allowRegister != 'y' || ($feature_intertiki == 'y' && !empty($feature_intertiki_mymaster))) {
  header("location: index.php");
  exit;
  die;
}

$smarty->assign('showmsg','n');

// novalidation is set to yes if a user confirms his email is correct after tiki fails to validate it
if(!isset($_REQUEST['novalidation'])) {
  $novalidation = '';
}

else {
  $novalidation = $_REQUEST['novalidation'];
}

//get custom fields
$customfields = array();
$customfields = $userprefslib->get_userprefs('CustomFields');
$smarty->assign_by_ref('customfields', $customfields);

if(isset($_REQUEST['register']) && !empty($_REQUEST['name']) && isset($_REQUEST['pass'])) {
  check_ticket('register');

  if($novalidation != 'yes' and($_REQUEST["pass"] <> $_REQUEST["passAgain"])) {
    $smarty->assign('msg',tra("The passwords don't match"));
    $smarty->display("error.tpl");
    die;
  }

  if($userlib->user_exists($_REQUEST["name"])) {
    $smarty->assign('msg',tra("User already exists"));
    $smarty->display("error.tpl");
    die;
  }

  if($rnd_num_reg == 'y') {
    if($novalidation != 'yes' and(!isset($_SESSION['random_number']) || $_SESSION['random_number']!=$_REQUEST['regcode'])) {
      $smarty->assign('msg',tra("Wrong registration code"));
      $smarty->display("error.tpl");
      die;
    }
  }

  // VALIDATE NAME HERE
  $n = strtolower($_REQUEST['name']);

  if($n =='admin' || $n == 'anonymous' || $n == 'registered' || $n == strtolower(tra('Anonymous')) || $n == strtolower(tra('Registered'))) {
    $smarty->assign('msg',tra("Invalid username"));
    $smarty->display("error.tpl");
    die;
  }

  if(strlen($_REQUEST["name"])>37) {
    $smarty->assign('msg',tra("Username is too long"));
    $smarty->display("error.tpl");
    die;
  }

  if(strstr($_REQUEST["name"],' ')) {
    $smarty->assign('msg',tra("Username cannot contain whitespace"));
    $smarty->display("error.tpl");
    die;
  }

  if(empty($_REQUEST["email"]))
  {
    $smarty->assign('msg',tra("Campo E-Mail está vazio. Você precisa preencher esta campo."));
    $smarty->display("error.tpl");
    die;
  }
  else
  {
    if(strstr($_REQUEST["email"],' '))
    {
      $smarty->assign('msg',tra("Campo E-Mail não pode conter espaços em branco"));
      $smarty->display("error.tpl");
      die;
    }

    if (!preg_match("/^[^@]*@[^@]*\.[^@]*$/", $_REQUEST["email"]))
    {
      $smarty->assign('msg',tra("Formato de E-Mail Inválido"));
      $smarty->display("error.tpl");
      die;
    }
  }

  //Validate password here
  if(strlen($_REQUEST["pass"])<$min_pass_length) {
    $smarty->assign('msg',tra("Password should be at least").' '.$min_pass_length.' '.tra("characters long"));
    $smarty->display("error.tpl");
    die;
  }

  // Check this code
  if($pass_chr_num == 'y') {
    if(!preg_match("/[0-9]/",$_REQUEST["pass"]) || !preg_match("/[A-Za-z]/",$_REQUEST["pass"])) {
      $smarty->assign('msg',tra("Password must contain both letters and numbers"));
      $smarty->display("error.tpl");
      die;
    }
  }

  if(!preg_match($patterns['login'],$_REQUEST["name"])) {
    $smarty->assign('msg',tra("Invalid username"));
    $smarty->display("error.tpl");
    die;
  }

  // Check the mode
  if($useRegisterPasscode == 'y') {
    if(($_REQUEST["passcode"]!=$tikilib->get_preference("registerPasscode",md5($tikilib->genPass()))))
    {
      $smarty->assign('msg',tra("Wrong passcode you need to know the passcode to register in this site"));
      $smarty->display("error.tpl");
      die;
    }
  }


  $email_valid = 'yes';

  if($validateEmail=='y') {
    $ret = $registrationlib->SnowCheckMail($_REQUEST["email"],$sender_email,'mini'); // check syntax and domain only

    if(!$ret[0]) {
      if($ret[1] == 'not_recognized') {
        $smarty->assign('notrecognized','y');
        $smarty->assign('email',$_REQUEST['email']);
        $smarty->assign('login',$_REQUEST['name']);
        $smarty->assign('password',$_REQUEST['pass']);
        $email_valid = 'no';
      }

      else {
//      $smarty->assign('msg',"$ret[1]");
        $smarty->assign('msg',tra("Invalid email address. You must enter a valid email address"));
        $smarty->display("error.tpl");
        $email_valid = 'no';
        die;
      }
    }
  }

  elseif(preg_match('/[ ;,:]/',trim($_REQUEST["email"]))) {
    $smarty->assign('msg',tra("Invalid email address. You must enter a valid email address"));
    $smarty->display("error.tpl");
    die;
  }

  if($email_valid != 'no') {
    if($validateUsers == 'y' || (isset($validateRegistration) && $validateRegistration == 'y')) {
      $apass = addslashes(md5($tikilib->genPass()));
      $userlib->send_validation_email($_REQUEST['name'], $apass, $_REQUEST['email']);
      $userlib->add_user($_REQUEST["name"], $apass, $_REQUEST["email"], $_REQUEST["pass"], '', 'n');
      $logslib->add_log('register','created account '.$_REQUEST["name"]);
      $smarty->assign('showmsg','y');
    }

    else {
      $userlib->add_user($_REQUEST["name"],$_REQUEST["pass"],$_REQUEST["email"],'','');
      $logslib->add_log('register','created account '.$_REQUEST["name"]);
      $smarty->assign('msg',$smarty->fetch('mail/user_welcome_msg.tpl'));
      $smarty->assign('showmsg','y');
    }

    // save default user preferences
    $tikilib->set_user_preference($_REQUEST["name"], 'theme', $style);
    $tikilib->set_user_preference($_REQUEST["name"], 'userbreadCrumb', 4);
    $tikilib->set_user_preference($_REQUEST["name"], 'language', $language);
    $tikilib->set_user_preference($_REQUEST["name"], 'display_timezone', 'Local');
    $tikilib->set_user_preference($_REQUEST["name"], 'user_information', 'private');
    $tikilib->set_user_preference($_REQUEST["name"], 'user_dbl', 'n');
    $tikilib->set_user_preference($_REQUEST["name"], 'diff_versions', 'n');
    $tikilib->set_user_preference($_REQUEST["name"], 'show_mouseover_user_info', 'n');
    $tikilib->set_user_preference($_REQUEST["name"], 'email is public', 'n');
    $tikilib->set_user_preference($_REQUEST["name"], 'mailCharset', 'utf-8');
    $tikilib->set_user_preference($_REQUEST["name"], 'realName', '');
    $tikilib->set_user_preference($_REQUEST["name"], 'homePage', '');
    $tikilib->set_user_preference($_REQUEST["name"], 'lat', floatval(0));
    $tikilib->set_user_preference($_REQUEST["name"], 'lon', floatval(0));
    $tikilib->set_user_preference($_REQUEST["name"], 'country', '');
    $tikilib->set_user_preference($_REQUEST["name"], 'mess_maxRecords', 10);
    $tikilib->set_user_preference($_REQUEST["name"], 'mess_archiveAfter', 0);
    $tikilib->set_user_preference($_REQUEST["name"], 'mess_sendReadStatus', 'n');
    $tikilib->set_user_preference($_REQUEST["name"], 'minPrio', 6);
    $tikilib->set_user_preference($_REQUEST["name"], 'allowMsgs', (($allowmsg_by_default == 'y')?'y':'n'));
    $tikilib->set_user_preference($_REQUEST["name"], 'mytiki_pages', 'n');
    $tikilib->set_user_preference($_REQUEST["name"], 'mytiki_blogs', 'n');
    $tikilib->set_user_preference($_REQUEST["name"], 'mytiki_gals', 'n');
    $tikilib->set_user_preference($_REQUEST["name"], 'mytiki_msgs', 'n');
    $tikilib->set_user_preference($_REQUEST["name"], 'mytiki_tasks', 'n');
    $tikilib->set_user_preference($_REQUEST["name"], 'mytiki_items', 'n');
    $tikilib->set_user_preference($_REQUEST["name"], 'mytiki_workflow', 'n');
    $tikilib->set_user_preference($_REQUEST["name"], 'tasks_maxRecords', 10);

    // Custom fields
    foreach($customfields as $custpref=>$prefvalue) {
      //print $_REQUEST[$customfields[$custpref]['prefName']];
      $tikilib->set_user_preference($_REQUEST["name"], $customfields[$custpref]['prefName'], $_REQUEST[$customfields[$custpref]['prefName']]);
    }

    $emails = $notificationlib->get_mail_events('user_registers','*');

    if(count($emails)) {
      include_once("lib/notifications/notificationemaillib.php");
      $smarty->assign('mail_user',$_REQUEST["name"]);
      $smarty->assign('mail_date',date("U"));
      $smarty->assign('mail_site',$_SERVER["SERVER_NAME"]);
      sendEmailNotification($emails, "email", "new_user_notification_subject.tpl", null, "new_user_notification.tpl");
    }

  }

}


ask_ticket('register');

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

$smarty->assign('mid','tiki-register.tpl');
$smarty->display("tiki.tpl");
?>

<!-- Begin QapTcha and jQuery files -->
<link rel="stylesheet" href="js/Qaptcha/jquery/QapTcha.jquery.css" type="text/css" />
                            <script type="text/javascript" src="js/Qaptcha/jquery/jquery.js"></script>
                                <script type="text/javascript" src="js/Qaptcha/jquery/jquery-ui.js"></script>
                                    <script type="text/javascript" src="js/Qaptcha/jquery/jquery.ui.touch.js"></script>
                                        <script type="text/javascript" src="js/Qaptcha/jquery/QapTcha.jquery.js"></script>

                                            <script type="text/javascript">
$(document).ready(function() {
  $('#QapTcha').QapTcha();
});
</script>



<!-- End QapTcha and jQuery files -->

