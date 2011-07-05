<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

class TooltipLib extends TikiLib {
	function TooltipLib($db) {
		# this is probably uneeded now
		if (!$db) {
			die ("Invalid db object passed to TooltipLib constructor");
		}

		$this->db = $db;
	}
	
	function register_user_click($tipName) {
		global $user;
		if (!$user) return false;
		
		$bindvals = array($user, $tipName);
		if ($this->getOne("select count(*) from `tiki_tooltip_clicks` where `user`=? and `tipName`=?", $bindvals)) {
			$this->query("update `tiki_tooltip_clicks` set `clicks`=`clicks`+1 where `user`=? and `tipName`=?",$bindvals);
		} else {
			$bindvals[] = 1;
			$this->query("insert into `tiki_tooltip_clicks` (`user`,`tipName`,`clicks`) values (?,?,?)", $bindvals);
		}
	}
	
	function get_user_clicks($tipName) {
		global $user;
		if (!$user) return 0;
		
		$bindvals = array($user, $tipName);
		$count = $this->getOne("select `clicks` from `tiki_tooltip_clicks` where `user`=? and `tipName`=?",$bindvals);
		if (!$count) {
			return 0;
		}
		return $count;
	}
}

global $tooltiplib, $dbTiki;
$tooltiplib = new TooltipLib($dbTiki);

?>