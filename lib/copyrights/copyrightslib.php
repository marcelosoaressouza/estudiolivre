<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

class CopyrightsLib extends TikiLib {
	function CopyrightsLib($db) {
		if (!$db) {
			die ("Invalid db object passed to CopyrightsLib constructor");
		}
		$this->db = $db;
	}

	function list_copyrights($page) {
		$query = "select * from `tiki_copyrights` WHERE `page`=? order by ".$this->convert_sortmode("copyright_order_asc");
		$query_cant = "select count(*) from `tiki_copyrights` WHERE `page`=?";
		$result = $this->query($query, array($page));
		$cant = $this->getOne($query_cant, array($page));
		$ret = array();

		while ($res = $result->fetchRow()) {
			$ret[] = $res;
		}

		$retval = array();
		$retval["data"] = $ret;
		$retval["cant"] = $cant;
		return $retval;
	}

	function top_copyright_order($page) {
		$query = "select MAX(`copyright_order`) from `tiki_copyrights` where `page` like ?";
		return $this->getOne($query, array($page));
	}

	function unique_copyright($page, $title) {
		$query = "select `copyrightID` from `tiki_copyrights` where `page`=? and `title`=?";
		return $this->getOne($query, array($page,$title));
	}

	function add_copyright($page, $title, $year, $authors, $user) {

		//$unique = $this->unique_copyright($page,$title);

		//if($unique != 0) {
		// security here?
		//$this->edit_copyright($unique,$title,$year,$authors,$user);
		//return;
		//}
		$top = $this->top_copyright_order($page);
		$order = $top + 1;
		$query = "insert `tiki_copyrights` (`page`, `title`, `year`, `authors`, `copyright_order`, `userName`) values (?,?,?,?,?,?)";
		$this->query($query,array($page,$title,$year,$authors,$order,$user));
		return true;
	}

	function edit_copyright($id, $title, $year, $authors, $user) {
		$query = "update `tiki_copyrights` SET `year`=?, `title`=?, `authors`=?, `userName`=? where `copyrightId`=?";
		$this->query($query,array($year,$title,$authors,$user,(int)$id));
		return true;
	}

	function remove_copyright($id) {
		$query = "delete from `tiki_copyrights` where `copyrightId`=?";
		$this->query($query,array((int)$id));
		return true;
	}

	function up_copyright($id) {
		$query = "update `tiki_copyrights` set `copyright_order`=`copyright_order`-1 where `copyrightId`=?";
		$result = $this->query($query,array((int)$id));
		return true;
	}

	function down_copyright($id) {
		$query = "update `tiki_copyrights` set `copyright_order`=`copyright_order`+1 where `copyrightId`=?";
		$result = $this->query($query,array((int)$id));
		return true;
	}
}

?>
