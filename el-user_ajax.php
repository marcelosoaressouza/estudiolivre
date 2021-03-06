<?php
require_once("dumb_progress_meter.php");

$ajaxlib->registerFunction('upload_info');
function upload_info($uploadId, $callback = 'updateProgressMeter') {
  $objResponse = new xajaxResponse();
  $uploadInfo = upload_progress_meter_get_info($uploadId);
  $objResponse->addScriptCall($callback,$uploadInfo);
  return $objResponse;
}

$ajaxlib->setPermission('save_field', $permission);
$ajaxlib->registerFunction('save_field');
function save_field($name, $value) {

  global $user, $userlib;

  if(!$user) {
    return false;
  }

  $objResponse = new xajaxResponse();

  $result = $userlib->set_user_field($name, $value);

  if(!$result) {
    $objResponse->addAlert("nao foi possivel editar o campo $name");
  }

  else {
    $objResponse->addScriptCall('exibeCampo', $name, $value);
  }

  return $objResponse;

}

$ajaxlib->setPermission('sendMsg', $user && $tikilib->get_user_preference($view_user,'allowMsgs',1));
$ajaxlib->registerFunction('sendMsg');
function sendMsg($subject = '', $body = '', $priority = 3, $cc = '') {

  global $messulib, $user, $view_user, $smarty, $permission;
  $messulib->post_message($view_user, $user, $view_user, $cc, $subject, $body, $priority);
  $objResponse = new xajaxResponse();

  $smarty->assign('permission', $permission);
  $smarty->assign('userMessages', $messulib->list_user_messages($view_user, 0, 5, 'date_desc', '', '', '', '', 'messages'));

  $objResponse->addAssign("ajax-userMsgs", "innerHTML", $smarty->fetch("el-user_msg.tpl"));

  return $objResponse;

}

$ajaxlib->setPermission('delMsg', $user);
$ajaxlib->registerFunction('delMsg');
function delMsg($userFrom, $msgId) {

  global $messulib, $user, $smarty, $permission, $view_user;

  $objResponse = new xajaxResponse();

  if($permission || $user == $userFrom) {

    $messulib->delete_message($view_user, $msgId);

    $smarty->assign('permission', $permission);
    $smarty->assign('userMessages', $messulib->list_user_messages($view_user, 0, 5, 'date_desc', '', '', '', '', 'messages'));
    $objResponse->addAssign("ajax-userMsgs", "innerHTML", $smarty->fetch("el-user_msg.tpl"));

  }

  return $objResponse;

}

$ajaxlib->setPermission('markMsgRead', $user);
$ajaxlib->registerFunction('markMsgRead');
function markMsgRead($msgId) {

  global $messulib, $user, $smarty, $permission, $view_user;

  $objResponse = new xajaxResponse();

  if($permission) {

    $messulib->flag_message($view_user, $msgId, 'isRead', 'y');

    $smarty->assign('permission', $permission);
    $smarty->assign('userMessages', $messulib->list_user_messages($view_user, 0, 5, 'date_desc', '', '', '', '', 'messages'));
    $objResponse->addAssign("ajax-userMsgs", "innerHTML", $smarty->fetch("el-user_msg.tpl"));
    include_once("modules/mod-el_msgs.php");
    $objResponse->addAssign("ajax-mod-el_msgs", "innerHTML", $smarty->fetch("modules/mod-el_msgs.tpl"));
  }

  return $objResponse;

}

$ajaxlib->registerFunction('pgMsg');
function pgMsg($offset = 0, $maxRecords = 5) {

  global $messulib, $view_user, $smarty, $permission;
  $objResponse = new xajaxResponse();

  $userMessages = $messulib->list_user_messages($view_user, $offset, $maxRecords, 'date_desc', '', '', '', '', 'messages');
  $total = $userMessages['cant'];

  $smarty->assign('msgMaxRecords', $maxRecords);
  $smarty->assign('msgOffset', $offset);
  $smarty->assign('msgTotal', $total);
  $smarty->assign('msgPage', ($offset/$maxRecords)+1);
  $smarty->assign('msgLastPage', ceil($total/$maxRecords));

  $smarty->assign('permission', $permission);
  $smarty->assign('userMessages', $userMessages);

  $objResponse->addAssign("ajax-msgListNav", "innerHTML", $smarty->fetch("el-msg_pagination.tpl"));
  $objResponse->addAssign("ajax-userMsgs", "innerHTML", $smarty->fetch("el-user_msg.tpl"));

  return $objResponse;

}

$ajaxlib->setPermission('set_licenca', $permission);
$ajaxlib->registerFunction('set_licenca');
function set_licenca($r1, $r2, $r3) {

  require_once("lib/persistentObj/PersistentObjectController.php");
  global $userlib, $tikilib;

  $controller = new PersistentObjectController("License");
  $objResponse = new xajaxResponse();

  $answer = $r1 . $r2;

  if($r3 != '-1') $answer .= $r3;

  $licenca = $controller->noStructureFindAll(array("answer" => $answer));
  $licenca =& $licenca[0];

  $result = $userlib->set_user_field('licencaPadrao', $licenca["id"]);

  if(!$result) {
    $objResponse->addAlert("nao foi possivel definir a licença padrao");
  }

  else {
    $objResponse->addAssign('ajax-uLicence', 'src', 'styles/estudiolivre/h_' . $licenca['imageName'] . '?rand='.rand());
  }

  return $objResponse;
}

$ajaxlib->setPermission('set_mount_point', $permission);
$ajaxlib->registerFunction('set_mount_point');
function set_mount_point($mountPoint, $pass) {
  global $tikilib, $user, $smarty;
  $objResponse = new xajaxResponse();

  if(!preg_match('/^[a-zA-Z0-9.]+$/', $pass) || !preg_match('/^[a-zA-Z0-9]+$/', $mountPoint)) {
    $objResponse->addAssign('ajax-liveError', 'innerHTML', tra('O ponto de montagem e a senha devem ser compostos apenas por letras (sem acento) e números, sem espaços.'));
    return $objResponse;
  }

  if($tikilib->getOne('select mountPoint from el_ice where user != ? and mountPoint = ?', array($user, $mountPoint))) {
    $objResponse->addAssign('ajax-liveError', 'innerHTML', tra('Esse ponto de montagem já existe, por favor escolha outro.'));
    return $objResponse;
  }

  if($tikilib->getOne('select mountPoint from el_ice where user = ? and mountPoint = ?', array($user, $mountPoint))) {
    exec(escapeshellcmd("perl /noe/data/dominios/estudiolivre.org/htdocs/lib/elgal/elIce/iceWriter.pl update $mountPoint $pass"), $a, $out);
    $action = 'modificado';
  }

  else {
    exec(escapeshellcmd("perl /noe/data/dominios/estudiolivre.org/htdocs/lib/elgal/elIce/iceWriter.pl add $mountPoint $pass"), $a, $out);
    $action = 'criado';
  }

  // se tiver saida = 0, nao deu erro (herdado de shell, porque die no perl retorna 255)
  if(!$out) {
    require_once('lib/elgal/elIce/IceStats.php');
    $objResponse->addAssign('ajax-liveError', 'innerHTML', '');
    $tikilib->query("replace into el_ice values(?, ?, ?)", array($user, $mountPoint, $pass));
    $objResponse->addScript("flip('ajax-elIce');document.getElementById('ajax-livePoint').value='';document.getElementById('ajax-livePass').value='';");

    if($action == 'criado') {
      $smarty->assign('channel', array('mountPoint' => $mountPoint, 'password' => $pass));
      $smarty->assign('permission', true);
      $objResponse->addAppend('ajax-liveCont', 'innerHTML', $smarty->fetch('el-live_channels.tpl'));
    }
  }

  else {
    $objResponse->addAssign('ajax-liveError', 'innerHTML', tra('Esse ponto de montagem já existe, por favor escolha outro.'));
  }

  return $objResponse;
}

$ajaxlib->setPermission('delete_mount_point', $permission);
$ajaxlib->registerFunction('delete_mount_point');
function delete_mount_point($mountPoint) {
  global $tikilib, $user;
  $objResponse = new xajaxResponse();

  if(!$tikilib->getOne('select mountPoint from el_ice where user = ? and mountPoint = ?', array($user, $mountPoint))) {
    return $objResponse;
  }

  exec(escapeshellcmd("perl /noe/data/dominios/estudiolivre.org/htdocs/lib/elgal/elIce/iceWriter.pl delete $mountPoint"), $a, $out);

  if(!$out) {
    require_once('lib/elgal/elIce/IceStats.php');
    $tikilib->query("delete from el_ice where mountPoint = ?", array($mountPoint));
    $objResponse->addScript('fixedTooltip("Seu ponto de transmissão no EstúdioLivre foi removido com sucesso!")');
    $objResponse->addRemove("ajax-live$mountPoint");
  }

  return $objResponse;
}

?>
