<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

class UserFilesLib extends TikiLib {
	function UserFilesLib($db) {
		# this is probably uneeded now
		if (!$db) {
			die ("Invalid db object passed to UserFilesLib constructor");
		}

		$this->db = $db;
	}

	function userfiles_quota($user) {
		if ($user == 'admin') {
			return 0;
		}

		$part1 = $this->getOne("select sum(`filesize`) from `tiki_userfiles` where `user`=?",array($user));
		$part2 = $this->getOne("select sum(`size`) from `tiki_user_notes` where `user`=?",array($user));
		return $part1 + $part2;
	}

	function upload_userfile($user, $name, $filename, $filetype, $filesize, $data, $path) {

		$now = date("U");
		$query = "insert into `tiki_userfiles`(`user`,`name`,`filename`,`filetype`,`filesize`,`data`,`created`,`hits`,`path`)
    values(?,?,?,?,?,?,?,?,?)";
		$this->query($query,array($user,$name,$filename,$filetype,(int) $filesize,$data,(int) $now,0,$path));
	}

	function list_userfiles($user, $offset, $maxRecords, $sort_mode, $find) {

		if ($find) {
			$findesc = '%' . $find . '%';

			$mid = " and (`filename` like ?)";
			$bindvars=array($user,$findesc);
		} else {
			$mid = " ";
			$bindvars=array($user);
		}

		$query = "select `fileId`,`user`,`name`,`filename`,`filetype`,`filesize`,`created`,`hits` from `tiki_userfiles` where `user`=? $mid order by ".$this->convert_sortmode($sort_mode);
		$query_cant = "select count(*) from `tiki_userfiles` where `user`=? $mid";
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

	function get_userfile($user, $fileId) {
		$query = "select * from `tiki_userfiles` where `user`=? and `fileId`=?";

		$result = $this->query($query,array($user,(int) $fileId));
		$res = $result->fetchRow();
		return $res;
	}

	function remove_userfile($user, $fileId) {
		global $uf_use_dir;

		$path = $this->getOne("select `path` from `tiki_userfiles` where `user`=? and `fileId`=?",array($user,(int) $fileId));

		if ($path) {
			@unlink ($uf_use_dir . $path);
		}

		$query = "delete from `tiki_userfiles` where `user`=? and `fileId`=?";
		$this->query($query,array($user,(int) $fileId));
	}
}
global $dbTiki;
$userfileslib = new UserFilesLib($dbTiki);

?>
