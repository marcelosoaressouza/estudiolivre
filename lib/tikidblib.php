<?php
//
// $Header: /cvsroot/tikiwiki/tiki/lib/tikidblib.php,v 1.11.2.9 2006/11/02 18:37:08 sylvieg Exp $
//

//this script may only be included - so its better to die if called directly.
if(strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

class TikiDB {
// Database access functions

  var $db; // The ADODB db object used to access the database

  function TikiDB($db)
  {
    if(!$db) die("Invalid db object passed to TikiLib constructor");

    $this->db = $db;
  }

// Use ADOdb->qstr() for 1.8
  function qstr($str) {
    if(function_exists('mysql_real_escape_string')) {
      return "'" . mysql_real_escape_string($str). "'";
    }

    else {
      return "'" . mysql_escape_string($str). "'";
    }
  }

  // Queries the database, *returning* an error if one occurs, rather
  // than exiting while printing the error.
  // -rlpowell
  function queryError($query, &$error, $values = null, $numrows = -1,
                      $offset = -1)
  {
    $numrows = intval($numrows);
    $offset = intval($offset);
    $this->convert_query($query);

    if($numrows == -1 && $offset == -1)
      $result = $this->db->CacheExecute($query, $values);
    else
      $result = $this->db->CacheSelectLimit($query, $numrows, $offset, $values);

    if(!$result)
    {
      $error = $this->db->ErrorMsg();
      $result=false;
    }

    //count the number of queries made
    global $num_queries;
    $num_queries++;

    return $result;
  }

  function query($query, $values = null, $numrows = -1,
                 $offset = -1, $reporterrors = true, $cached = true)
  {
    $numrows = intval($numrows);
    $offset = intval($offset);
    $this->convert_query($query);

    if ($cached == false)
    {
	$cacheTime = 0;
    }
    else
    {
	$cacheTime = 3600;
    }

    if($numrows == -1 && $offset == -1)
    {
      $result = $this->db->CacheExecute($cacheTime, $query, $values);
    }
    else
    {
      $result = $this->db->CacheSelectLimit($cacheTime, $query, $numrows, $offset, $values);
    }

    // Caso a query seja INSERT ou UPDATE faz um Flush no memcached
    if (preg_match("/insert/", strtolower($query)) || preg_match("/update/", strtolower($query)))
    {
      $flush_result = $this->db->CacheFlush($query, $values);
    }

    if(!$result)
    {
      if($reporterrors)
      {
        $this->sql_error($query, $values, $result);
      }
    }

    //count the number of queries made
    global $num_queries;
    $num_queries++;

    return $result;
  }

// Gets one column for the database.
  function getOne($query, $values = null, $reporterrors = true, $offset = 0) {
    $this->convert_query($query);

    if(preg_match("/tags/", $query))
      $result = $this->db->CacheSelectLimit(0, $query, 1, $offset, $values);

    else
      $result = $this->db->CacheSelectLimit($query, 1, $offset, $values);

    if(!$result) {
      if($reporterrors) {
        $this->sql_error($query, $values, $result);
      }

      else {
        return $result;
      }
    }

    $res = $result->fetchRow();

    //count the number of queries made
    global $num_queries;
    $num_queries++;
    //$this->debugger_log($query, $values);

    if($res === false)
      return (NULL); //simulate pears behaviour

    list($key, $value) = each($res);
    return $value;
  }


  // Reports SQL error from PEAR::db object.
  function sql_error($query, $values, $result) {
    global $ADODB_LASTDB, $smarty;

    $outp = "<div class='simplebox'><b>".tra("An error occured in a database query!")."</b></div>";
    $outp.= "<br /><table class='form'>";
    $outp.= "<tr class='heading'><td colspan='2'>Context:</td></tr>";
    $outp.= "<tr class='formcolor'><td>File</td><td>".basename($_SERVER['SCRIPT_NAME'])."</td></tr>";
    $outp.= "<tr class='formcolor'><td>Url</td><td>".basename($_SERVER['REQUEST_URI'])."</td></tr>";
    $outp.= "<tr class='heading'><td colspan='2'>Query:</td></tr>";
    $outp.= "<tr class='formcolor'><td colspan='2'><tt>$query</tt></td></tr>";
    $outp.= "<tr class='heading'><td colspan='2'>Values:</td></tr>";
    foreach($values as $k=>$v) {
      $outp.= "<tr class='formcolor'><td>$k</td><td>$v</td></tr>";
    }
    $outp.= "<tr class='heading'><td colspan='2'>Message:</td></tr><tr class='formcolor'><td>Error Message</td><td>".$this->db->ErrorMsg()."</td></tr>\n";
    $outp.= "</table>";
    require_once('tiki-setup.php');

    if($smarty) {
      $smarty->assign('msg',$outp);
      $smarty->display("error.tpl");
    }

    else {
      echo $outp;
    }

    die;
  }

  function ifNull($narg1,$narg2) {
    return $this->db->ifNull($narg1,$narg2);
  }

// functions to support DB abstraction
  function convert_query(&$query) {
    global $ADODB_LASTDB;

    switch($ADODB_LASTDB) {
    case "oci8":
      $query = preg_replace("/`/", "\"", $query);

      // convert bind variables - adodb does not do that
      $qe = explode("?", $query);
      $query = '';

      $temp_max = sizeof($qe) - 1;

      for($i = 0; $i < $temp_max; $i++) {
        $query .= $qe[$i] . ":" . $i;
      }

      $query .= $qe[$i];
      break;

    case "postgres7":
    case "sybase":
      $query = preg_replace("/`/", "\"", $query);

      break;

    case "mssql":
      $query = preg_replace("/`/","",$query);
      $query = preg_replace("/\?/","'?'",$query);
      break;

    case "sqlite":
      $query = preg_replace("/`/", "", $query);
      break;
    }

  }

  function blob_encode(&$blob) {
    switch($this->db->blobEncodeType) {
    case 'I':
      $blob=$this->db->BlobEncode($blob);
      break;

    case 'C':
      $blob=$this->db->qstr($this->db->BlobEncode($blob));
      break;

    case 'false':
    default:
    }
  }

  function convert_sortmode($sort_mode) {
    global $ADODB_LASTDB;

    if(!$sort_mode) {
      return '';
    }

    // parse $sort_mode for evil stuff
    $sort_mode = preg_replace('/[^A-Za-z_,]/', '', $sort_mode);
    $sep = strrpos($sort_mode, '_');

    // force ending to either _asc or _desc
    if(substr($sort_mode, $sep)!=='_asc') {
      $sort_mode = substr($sort_mode, 0, $sep) . '_desc';
    }

    switch($ADODB_LASTDB) {
    case "postgres7":
    case "oci8":
    case "sybase":
    case "mssql":
      // Postgres needs " " around column names
      //preg_replace("#([A-Za-z]+)#","\"\$1\"",$sort_mode);
      $sort_mode = preg_replace("/_asc$/", "\" asc", $sort_mode);
      $sort_mode = preg_replace("/_desc$/", "\" desc", $sort_mode);
      $sort_mode = str_replace(",", "\",\"",$sort_mode);

      $sort_mode = "\"" . $sort_mode;
      break;

    case "sqlite":
      $sort_mode = preg_replace("/_asc$/", " asc", $sort_mode);
      $sort_mode = preg_replace("/_desc$/", " desc", $sort_mode);
      break;

    case "mysql3":
    case "mysql":
    default:
      $sort_mode = preg_replace("/_asc$/", "` asc", $sort_mode);
      $sort_mode = preg_replace("/_desc$/", "` desc", $sort_mode);
      $sort_mode = str_replace(",", "`,`",$sort_mode);
      $sort_mode = "`" . $sort_mode;
      break;
    }

    return $sort_mode;
  }

  function convert_binary() {
    global $ADODB_LASTDB;

    switch($ADODB_LASTDB) {
    case "oci8":
    case "postgres7":
    case "sqlite":
      return;

      break;

    case "mysql3":
    case "mysql":
      return "binary";

      break;
    }
  }

  function sql_cast($var,$type) {
    global $ADODB_LASTDB;

    switch($ADODB_LASTDB) {
    case "sybase":
      switch($type) {
      case "int":
        return " CONVERT(numeric(14,0),$var) ";
        break;

      case "string":
        return " CONVERT(varchar(255),$var) ";
        break;

      case "float":
        return " CONVERT(numeric(10,5),$var) ";
        break;
      }

      break;

    default:
      return($var);
      break;
    }

  }
  function debugger_log($query, $values)
  {
    // Will spam only if debug parameter present in URL
    // \todo DON'T FORGET TO REMOVE THIS BEFORE 1.8 RELEASE
    if(!isset($_REQUEST["debug"])) return;

    // spam to debugger log
    include_once('lib/debug/debugger.php');
    global $debugger;

    if(is_array($values) && strpos($query, '?'))
      foreach($values as $v)
    {
      $q = strpos($query, '?');

      if($q)
      {
        $tmp = substr($query, 0, $q)."'".$v."'".substr($query, $q + 1);
        $query = $tmp;
      }
    }

    $debugger->msg($this->num_queries.': '.$query);
  }
}


?>
