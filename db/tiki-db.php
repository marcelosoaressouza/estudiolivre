<?php

if(strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

$api_tiki       = 'adodb';
$db_tiki     = 'mysql';
$dbversion_tiki = '1.9';
$host_tiki   = 'localhost';
$user_tiki   = 'root';
$pass_tiki   = '';
$dbs_tiki    = 'tiki';
$tikidomain  = '';

if(!isset($local_php) or !is_file($local_php)) {
  $local_php = 'local.php';
}

else {
  $local_php = preg_replace(array('/\.\./','/^db\//'),array('',''),$local_php);
}

if(is_file('db/virtuals.inc')) {
  if(!isset($multi)) {
    if(isset($_SERVER['TIKI_VIRTUAL']) and is_file('db/'.$_SERVER['TIKI_VIRTUAL'].'/local.php')) {
      $multi = $_SERVER['TIKI_VIRTUAL'];
    }

    elseif(isset($_SERVER['SERVER_NAME']) and is_file('db/'.$_SERVER['SERVER_NAME'].'/local.php')) {
      $multi = $_SERVER['SERVER_NAME'];
    }
    elseif(isset($_SERVER['HTTP_HOST']) and is_file('db/'.$_SERVER['HTTP_HOST'].'/local.php')) {
      $multi = $_SERVER['HTTP_HOST'];
    }
  }

  if(isset($multi)) {
    $local_php = "$multi/local.php";
    $tikidomain = $multi;
  }
}

if(is_file('db/'.$local_php)) {
  require_once('db/'.$local_php);
}

else {
  die("<b style=\"color:red;\">$local_php not found.</b><br /><br />Please run <a href=tiki-install.php>tiki-install.php</a>");
}

if(preg_match('/^adodb$/i', $api_tiki)) {
  TikiInit::prependIncludePath('lib/adodb');
  TikiInit::prependIncludePath('lib/pear');
#error_reporting (E_ALL);       # show any error messages triggered
  define('ADODB_FORCE_NULLS', 1);
  define('ADODB_ASSOC_CASE', 2);
  define('ADODB_CASE_ASSOC', 2); // typo in adodb's driver for sybase?
  include_once('adodb.inc.php');
  include_once('adodb-pear.inc.php');

  if($db_tiki == 'pgsql') {
    $db_tiki = 'postgres7';
  }

  if($db_tiki == 'sybase') {
    ini_set('sybct.min_server_severity', '11');
  }

  $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
}

else {
  // Database connection for the tiki system
  include_once('DB.php');
}

$dsn = "$db_tiki://$user_tiki:$pass_tiki@$host_tiki/$dbs_tiki";
$dbTiki = &ADONewConnection($db_tiki);
$dbTiki->memCache = true;
$dbTiki->memCacheHost = array("127.0.0.1");
$dbTiki->memCachePort = 11211;
$dbTiki->memCacheCompress = false;

$conn = $dbTiki->Connect($host_tiki, $user_tiki, $pass_tiki, $dbs_tiki);

if(!$conn) {
  echo "<html><body><center><img src=\"styles/bolha/img/logoTop.png\"><h2>Estamos em manuten&ccedil;&atilde;o</h2><h3>Volte mais tarde</h3></center><br/>";
  exit;
}

// Forget db info so that malicious PHP may not get password etc.
$host_tiki = NULL;
$user_tiki = NULL;
$pass_tiki = NULL;
$dbs_tiki = NULL;

unset($host_map);
unset($api_tiki);
unset($db_tiki);
unset($host_tiki);
unset($user_tiki);
unset($pass_tiki);
unset($dbs_tiki);

?>
