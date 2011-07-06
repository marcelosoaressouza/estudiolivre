<?php
// $Header: /cvsroot/tikiwiki/tiki/lib/logs/logslib.php,v 1.4.2.4 2007/09/02 13:36:32 sylvieg Exp $

//this script may only be included - so its better to die if called directly.
if(strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

class LogsLib extends TikiLib {

  function LogsLib($db) {
    $this->db = $db;
  }

  function add_log($type,$message,$who='',$ip='',$client='',$time='') {
    global $user;

    if(!$who) {
      if($user) {
        $who = $user;
      }

      else {
        $who = 'Anonymous';
      }
    }

    if(!$ip) {
      $ip = $_SERVER['REMOTE_ADDR'];
    }

    if(!$client) {
      if(!$_SERVER['HTTP_USER_AGENT']) {
        $client = 'NO USER AGENT';
      }

      else {
        $client = $_SERVER['HTTP_USER_AGENT'];
      }
    }

    if(!$time) {
      $time = date("U");
    }

    $query = "insert into `tiki_logs` (`logtype`,`logmessage`,`loguser`,`logip`,`logclient`,`logtime`) values (?,?,?,?,?,?)";
    $result = $this->query($query,array($type,$message,$who,$ip,$client,(int)$time));
  }

  function list_logs($type='',$user='',$offset=0,$maxRecords=-1,$sort_mode='logtime_desc',$find='',$min=0,$max=0) {
    $bindvars = array();
    $amid = array();
    $mid = '';

    if($find) {
      $findesc = '%'.$find.'%';
      $amid[] = "`logmessage` like ?";
      $bindvars[] = $findesc;
    }

    if($type) {
      $amid[] = "`logtype` = ?";
      $bindvars[] = $type;
    }

    if($user) {
      $amid[] = "`loguser` = ?";
      $bindvars[] = $user;
    }

    if($min) {
      $amid[] = "`logtime` > ?";
      $bindvars[] = $min;
    }

    if($max) {
      $amid[] = "`logtime` < ?";
      $bindvars[] = $max;
    }

    if(count($amid)) {
      $mid = " where ".implode(" and ",$amid)." ";
    }

    $query = "select `logId`,`loguser`,`logtype`,`logmessage`,`logtime`,`logip`,`logclient` ";
    $query.= " from `tiki_logs` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_logs` $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res;
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }
  function clean_logs($date) {
    $query = "delete from `tiki_logs` where `logtime`<=?";
    $this->query($query, array((int)$date));
  }

}

global $dbTiki;
$logslib = new LogsLib($dbTiki);

?>
