<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

class NotificationLib extends TikiLib {
	function NotificationLib($db) {
		# this is probably uneeded now
		if (!$db) {
			die ("Invalid db object passed to NotificationLib constructor");
		}

		$this->db = $db;
	}

	function list_mail_events($offset, $maxRecords, $sort_mode, $find) {

		if ($find) {
			$findesc = '%' . $find . '%';

			$mid = " where (`event` like ? or `email` like ?)";
			$bindvars=array($findesc,$findesc);
		} else {
			$mid = " ";
			$bindvars=array();
		}

		$query = "select * from `tiki_mail_events` $mid order by ".$this->convert_sortmode($sort_mode);
		$query_cant = "select count(*) from `tiki_mail_events` $mid";
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

	function add_mail_event($event, $object, $email) {
		$query = "insert into `tiki_mail_events`(`event`,`object`,`email`) values(?,?,?)";
		$result = $this->query($query, array($event,$object,$email) );
	}

	function remove_mail_event($event, $object, $email) {
		$query = "delete from `tiki_mail_events` where `event`=? and `object`=? and `email`=?";
		$result = $this->query($query,array($event,$object,$email));
	}
	
	function update_mail_address($oldMail, $newMail) {
		$query = "update `tiki_mail_events` set `email`=? where `email`=?";
		$result = $this->query($query,array($newMail,$oldMail));
	}

	function get_mail_events($event, $object) {
		$query = "select `email` from `tiki_mail_events` where `event`=? and (`object`=? or `object`='*')";
		$result = $this->query($query, array($event,$object) );
		$ret = array();

		while ($res = $result->fetchRow()) {
			$ret[] = $res["email"];
		}

		return $ret;
	}
}

global $dbTiki;
$notificationlib = new NotificationLib($dbTiki);

?>
