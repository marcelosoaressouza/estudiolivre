<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

class HistLib extends TikiLib {
	function HistLib($db) {
		# this is probably uneeded now
		if (!$db) {
			die ("Invalid db object passed to HistLib constructor");
		}

		$this->db = $db;
	}

	// Removes a specific version of a page
	function remove_version($page, $version, $comment = '') {
		$query = "delete from `tiki_history` where `pageName`=? and `version`=?";
		$result = $this->query($query,array($page,$version));
		$action = "Removed version $version";
		$t = date("U");
		$query = "insert into `tiki_actionlog`(`action`,`pageName`,`lastModif`,`user`,`ip`,`comment`) values(?,?,?,?,?,?)";
		$result = $this->query($query,array($action,$page,$t,"admin",$_SERVER["REMOTE_ADDR"],$comment));
		return true;
	}

	function use_version($page, $version, $comment = '') {
		$this->invalidate_cache($page);
		
		// Store the current page in tiki_history before rolling back
		if (strtolower($page) != 'sandbox') {
			$info = $this->get_page_info($page);
			$old_version = $this->get_page_latest_version($page) + 1;
		    $lastModif = $info["lastModif"];
		    $user = $info["user"];
		    $ip = $info["ip"];
		    $comment = $info["comment"];
		    $data = $info["data"];
		    $description = $info["description"];
			$query = "insert into `tiki_history`(`pageName`, `version`, `lastModif`, `user`, `ip`, `comment`, `data`, `description`)
		    			values(?,?,?,?,?,?,?,?)";
		    $this->query($query,array($page,(int) $old_version,(int) $lastModif,$user,$ip,$comment,$data,$description));
		}
		
		$query = "select * from `tiki_history` where `pageName`=? and `version`=?";
		$result = $this->query($query,array($page,$version));

		if (!$result->numRows())
			return false;

		$res = $result->fetchRow();
		$query
			= "update `tiki_pages` set `data`=?,`lastModif`=?,`user`=?,`comment`=?,`version`=`version`+1,`ip`=? where `pageName`=?";
		$result = $this->query($query,array($res["data"],$res["lastModif"],$res["user"],$res["comment"],$res["ip"],$page));
		$query = "delete from `tiki_links` where `fromPage` = ?";
		$result = $this->query($query,array($page));
		$this->clear_links($page);
		$pages = $this->get_pages($res["data"]);

		foreach ($pages as $a_page) {
			$this->replace_link($page, $a_page);
		}

		//$query="delete from `tiki_history` where `pageName`='$page' and version='$version'";
		//$result=$this->query($query);
		//
		$action = "Changed actual version to $version";
		$t = date("U");
		$query = "insert into `tiki_actionlog`(`action`,`pageName`,`lastModif`,`user`,`ip`,`comment`) values(?,?,?,?,?,?)";
		$result = $this->query($query,array($action,$page,$t,'admin',$_SERVER["REMOTE_ADDR"],$comment));
		return true;
	}

	function get_user_versions($user) {
		$query
			= "select `pageName`,`version`, `lastModif`, `user`, `ip`, `comment` from `tiki_history` where `user`=? order by `lastModif` desc";

		$result = $this->query($query,array($user));
		$ret = array();

		while ($res = $result->fetchRow()) {
			$aux = array();

			$aux["pageName"] = $res["pageName"];
			$aux["version"] = $res["version"];
			$aux["lastModif"] = $res["lastModif"];
			$aux["ip"] = $res["ip"];
			$aux["comment"] = $res["comment"];
			$ret[] = $aux;
		}

		return $ret;
	}

	// Returns information about a specific version of a page
	function get_version($page, $version) {

		$query = "select * from `tiki_history` where `pageName`=? and `version`=?";
		$result = $this->query($query,array($page,$version));
		$res = $result->fetchRow();
		return $res;
	}

	// Returns all the versions for this page
	// without the data itself
	function get_page_history($page,$fetchdata=true) {

		$query = "select `pageName`, `description`, `version`, `lastModif`, `user`, `ip`, `data`, `comment` from `tiki_history` where `pageName`=? order by `version` desc";
		$result = $this->query($query,array($page));
		$ret = array();

		while ($res = $result->fetchRow()) {
			$aux = array();

			$aux["version"] = $res["version"];
			$aux["lastModif"] = $res["lastModif"];
			$aux["user"] = $res["user"];
			$aux["ip"] = $res["ip"];
			if ($fetchdata==true) $aux["data"] = $res["data"];
			$aux["pageName"] = $res["pageName"];
			$aux["description"] = $res["description"];
			$aux["comment"] = $res["comment"];
			//$aux["percent"] = levenshtein($res["data"],$actual);
			$ret[] = $aux;
		}

		return $ret;
	}

	// Returns one version of the page from the history
	// without the data itself
	function get_page_from_history($page,$version,$fetchdata=false) {

		$query = "select `pageName`, `description`, `version`, `lastModif`, `user`, `ip`, `data`, `comment` from `tiki_history` where `pageName`=? and `version`=?";
		$result = $this->query($query,array($page,$version));

		$ret = array();

		while ($res = $result->fetchRow()) {
			$aux = array();

			$aux["version"] = $res["version"];
			$aux["lastModif"] = $res["lastModif"];
			$aux["user"] = $res["user"];
			$aux["ip"] = $res["ip"];
			if ($fetchdata==true) $aux["data"] = $res["data"];
			$aux["pageName"] = $res["pageName"];
			$aux["description"] = $res["description"];
			$aux["comment"] = $res["comment"];
			//$aux["percent"] = levenshtein($res["data"],$actual);
			$ret[] = $aux;
		}

		return $ret[0];
	}
	
	function get_page_latest_version($page) {

		$query = "select `version` from `tiki_history` where `pageName`=? order by `version` desc";
		$result = $this->query($query,array($page),1);
		$ret = array();
		
		if ($res = $result->fetchRow()) {
			$ret = $res['version'];
		} else {
			$ret = FALSE;
		}

		return $ret;
	}

	function version_exists($pageName, $version) {

		$query = "select `pageName` from `tiki_history` where `pageName` = ? and `version`=?";
		$result = $this->query($query,array($pageName,$version));
		return $result->numRows();
	}

	// This function get the last changes from pages from the last $days days
	// if days is 0 this gets all the registers
	// function parameters modified by ramiro_v on 11/03/2002
	function get_last_changes($days, $offset = 0, $limit = -1, $sort_mode = 'lastModif_desc', $findwhat = '') {
	        global $user;

		$where = "where (th.`version` != 0 or tp.`version` != 0) ";
		$bindvars = array();
		if ($findwhat) {
			$findstr='%' . $findwhat . '%';
			$where.= " and ta.`pageName` like ? or ta.`user` like ? or ta.`comment` like ?";
			$bindvars = array($findstr,$findstr,$findstr);
		}

		if ($days) {
			$toTime = mktime(23, 59, 59, date("m"), date("d"), date("Y"));
			$fromTime = $toTime - (24 * 60 * 60 * $days);
			$where .= " and ta.`lastModif`>=? and ta.`lastModif`<=? ";
			$bindvars[] = $fromTime;
			$bindvars[] = $toTime;
		}

		$query = "select ta.`action`, ta.`lastModif`, ta.`user`, ta.`ip`, ta.`pageName`,ta.`comment`, th.`version` as version, tp.`version` as versionlast from `tiki_actionlog` ta 
			left join `tiki_history` th on  ta.`pageName`=th.`pageName` and ta.`lastModif`=th.`lastModif` 
			left join `tiki_pages` tp on ta.`pageName`=tp.`pageName` and ta.`lastModif`=tp.`lastModif` " . $where . " order by ta.".$this->convert_sortmode($sort_mode);
		$query_cant = "select count(*) from `tiki_actionlog` ta 
			left join `tiki_history` th on  ta.`pageName`=th.`pageName` and ta.`lastModif`=th.`lastModif` 
			left join `tiki_pages` tp on ta.`pageName`=tp.`pageName` and ta.`lastModif`=tp.`lastModif` " . $where;

		$result = $this->query($query,$bindvars,$limit,$offset);
		$cant = $this->getOne($query_cant,$bindvars);
		$ret = array();
		$retval = array();
		while ($res = $result->fetchRow()) {
		   //WYSIWYCA hack: the $limit will not be respected
		   if($this->user_has_perm_on_object($user,$res["pageName"],'wiki page','tiki_p_view')) {
			$ret[] = $res;
		   }
		}
		$retval["data"] = $ret;
		$retval["cant"] = $cant;
		return $retval;
	}
	function get_nb_history($page) {
		$query_cant = "select count(*) from `tiki_history` where `pageName` = ?";
		$cant = $this->getOne($query_cant, array($page));
		return $cant;
	}
}

global $dbTiki;
$histlib = new HistLib($dbTiki);

?>
