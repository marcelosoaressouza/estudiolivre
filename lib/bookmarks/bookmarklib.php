<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

class BookmarkLib extends TikiLib {
	function BookmarkLib($db) {
		# this is probably uneeded now
		if (!$db) {
			die ("Invalid db object passed to BookmarkLib constructor");
		}

		$this->db = $db;
	}

	function get_folder_path($folderId, $user) {
		$path = '';

		$info = $this->get_folder($folderId, $user);
		$path = '<a class="link" href=tiki-user_bookmarks.php?parentId="' . $info["folderId"] . '">' . $info["name"] . '</a>';

		while ($info["parentId"] != 0) {
			$info = $this->get_folder($info["parentId"], $user);

			$path
				= $path = '<a class="link" href=tiki-user_bookmarks.php?parentId="' . $info["folderId"] . '">' . $info["name"] . '</a>' . '>' . $path;
		}

		return $path;
	}

	function get_folder($folderId, $user) {
		$query = "select * from `tiki_user_bookmarks_folders` where `folderId`=? and `user`=?";

		$result = $this->query($query,array($folderId,$user));

		if (!$result->numRows())
			return false;

		$res = $result->fetchRow();
		return $res;
	}

	function get_url($urlId) {
		$query = "select * from `tiki_user_bookmarks_urls` where `urlId`=?";

		$result = $this->query($query,array($urlId));

		if (!$result->numRows())
			return false;

		$res = $result->fetchRow();
		return $res;
	}

	function remove_url($urlId, $user) {
		$query = "delete from `tiki_user_bookmarks_urls` where `urlId`=? and user=?";

		$result = $this->query($query,array($urlId,$user));
		return true;
	}

	function remove_folder($folderId, $user) {
		// Delete the category
		$query = "delete from `tiki_user_bookmarks_folders` where `folderId`=? and `user`=?";

		$result = $this->query($query,array($folderId,$user));
		// Remove objects for this category
		$query = "delete from `tiki_user_bookmarks_urls` where `folderId`=? and `user`=?";
		$result = $this->query($query,array($folderId,$user));
		// SUbfolders
		$query = "select `folderId` from `tiki_user_bookmarks_folders` where `parentId`=? and `user`=?";
		$result = $this->query($query,array($folderId,$user));

		while ($res = $result->fetchRow()) {
			// Recursively remove the subcategory
			$this->remove_folder($res["folderId"], $user);
		}

		return true;
	}

	function update_folder($folderId, $name, $user) {

		$query = "update `tiki_user_bookmarks_folders` set `name`=? where `folderId`=? and `user`=?";
		$result = $this->query($query,array($name,$folderId,$user));
	}

	function add_folder($parentId, $name, $user) {
		// Don't allow empty/blank folder names.
		if (empty($name))
			return false;

		$query = "insert into `tiki_user_bookmarks_folders`(`name`,`parentId`,`user`) values(?,?,?)";
		$result = $this->query($query,array($name,$parentId,$user));
	}

	function replace_url($urlId, $folderId, $name, $url, $user) {
		$now = date("U");

		if ($urlId) {
			$query = "update `tiki_user_bookmarks_urls` set `user`=?,`lastUpdated`=?,`folderId`=?,`name`=?,`url`=? where `urlId`=?";
			$bindvars=array($user,(int) $now,$folderId,$name,$url,$urlId);
		} else {
			$query = " insert into `tiki_user_bookmarks_urls`(`name`,`url`,`data`,`lastUpdated`,`folderId`,`user`)
      values(?,?,?,?,?,?)";
      			$bindvars=array($name,$url,'',(int) $now,$folderId,$user);
		}

		$result = $this->query($query,$bindvars);
		$id = $this->getOne("select max(`urlId`) from `tiki_user_bookmarks_urls` where `url`=? and `lastUpdated`=?",array($url,(int) $now));
		return $id;
	}

	function refresh_url($urlId) {
		$info = $this->get_url($urlId);

		if (strstr($info["url"], 'tiki-') || strstr($info["url"], 'messu-'))
			return false;

		$data=@$this->httprequest($info["url"]);

		if (!$data)
			return;

		$now = date("U");
		$query = "update `tiki_user_bookmarks_urls` set `lastUpdated`=?, `data`=? where `urlId`=?";
		$result = $this->query($query,array((int) $now,$data,$urlId));
		return true;
	}

	function list_folder($folderId, $offset, $maxRecords, $sort_mode = 'name_asc', $find, $user) {

		if ($find) {
			$findesc = '%' . $find . '%';

			$mid = " and `name` like ? or `url` like ?";
			$bindvars=array($folderId,$user,$findesc,$findesc);
		} else {
			$mid = "";
			$bindvars=array($folderId,$user);
		}

		$query = "select * from `tiki_user_bookmarks_urls` where `folderId`=? and `user`=? $mid order by ".$this->convert_sortmode($sort_mode);
		$query_cant = "select count(*) from `tiki_user_bookmarks_urls` where `folderId`=? and user=? $mid";
		$result = $this->query($query,$bindvars,$maxRecords,$offset);
		$cant = $this->getOne($query_cant,$bindvars);
		$ret = array();

		while ($res = $result->fetchRow()) {
			$res["datalen"] = strlen($res["data"]);

			$ret[] = $res;
		}

		$retval = array();
		$retval["data"] = $ret;
		$retval["cant"] = $cant;
		return $retval;
	}

	function get_child_folders($folderId, $user) {
		$ret = array();

		$query = "select * from `tiki_user_bookmarks_folders` where `parentId`=? and `user`=?";
		$result = $this->query($query,array($folderId,$user));

		while ($res = $result->fetchRow()) {
			$cant = $this->getOne("select count(*) from `tiki_user_bookmarks_urls` where `folderId`=?",array($res["folderId"]));

			$res["urls"] = $cant;
			$ret[] = $res;
		}

		return $ret;
	}
}
global $dbTiki;
$bookmarklib = new BookmarkLib($dbTiki);

?>
