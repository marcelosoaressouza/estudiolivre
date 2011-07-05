<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

class TagLineLib extends TikiLib {
	function TagLineLib($db) {
		# this is probably uneeded now
		if (!$db) {
			die ("Invalid db object passed to TaglineLib constructor");
		}
		$this->db = $db;
	}

	function list_cookies($offset, $maxRecords, $sort_mode, $find) {
		if ($find) {
			$mid = " where (`cookie` like ?)";
			$bindvars = array('%' . $find . '%');
		} else {
			$mid = "";
			$bindvars = array();
		}
		$query = "select * from `tiki_cookies` $mid order by ".$this->convert_sortmode($sort_mode);
		$query_cant = "select count(*) from `tiki_cookies` $mid";
		$result = $this->query($query,$bindvars,$maxRecords,$offset);
		$cant = $this->getOne($query_cant,$bindvars);
		$ret = array();
		while ($res = $result->fetchRow()) {
			$ret[] = $res;
		}
		$retval = array();
		$retval["data"] = $ret;
		$retval["cant"] = $cant;
		return $retval;
	}

	function replace_cookie($cookieId, $cookie) {
//		$cookie = addslashes($cookie);
		// Check the name
		if ($cookieId) {
			$query = "update `tiki_cookies` set `cookie`=? where `cookieId`=?";
			$bindvars = array($cookie,(int)$cookieId);
		} else {
			$bindvars = array($cookie);
			$query = "delete from `tiki_cookies` where `cookie`=?";
			$result = $this->query($query,$bindvars);
			$query = "insert into `tiki_cookies`(`cookie`) values(?)";
		}
		$result = $this->query($query,$bindvars);
		return true;
	}

	function remove_cookie($cookieId) {
		$query = "delete from `tiki_cookies` where `cookieId`=?";
		$result = $this->query($query,array((int)$cookieId));
		return true;
	}

	function get_cookie($cookieId) {
		$query = "select * from `tiki_cookies` where `cookieId`=?";
		$result = $this->query($query,array((int)$cookieId));
		if (!$result->numRows())
			return false;

		$res = $result->fetchRow();
		return $res;
	}

	function remove_all_cookies() {
		$query = "delete from `tiki_cookies`";
		$result = $this->query($query,array());
	}
}
global $dbTiki;
$taglinelib = new TagLineLib($dbTiki);

?>
