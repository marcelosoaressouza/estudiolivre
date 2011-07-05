<?php
/** \file
 * $Header: /cvsroot/tikiwiki/tiki/lib/usermodules/usermoduleslib.php,v 1.28.2.2 2005/12/14 14:08:19 sylvieg Exp $
 *
 * \brief Manage user assigned modules
 */

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

/**
 * \brief Class to manage user assigned modules
 *
 * Useful only if the feature "A user can assign modules has been set" ($user_assigned_modules)
 *
 * The first time, a user displays the page to assign modules(tiki-user_assigned_modules.php), 
 * the list of modules are copied from tiki_modules to tiki_user_assigned_modules
 * This list is rebuilt if the user asks for a "restore default"
 *
 */
class UserModulesLib extends TikiLib {
	function UserModulesLib($db) {
		# this is probably uneeded now
		if (!$db) {
			die ("Invalid db object passed to UserModulesLib constructor");
		}

		$this->db = $db;
	}

	function unassign_user_module($name, $user) {
		$query = "delete from `tiki_user_assigned_modules` where `name`=? and `user`=?";

		$result = $this->query($query,array($name, $user));
	}

	function up_user_module($name, $user) {
		$query = "update `tiki_user_assigned_modules` set `ord`=`ord`-1 where `name`=? and `user`=?";

		$result = $this->query($query,array($name, $user));
	}

	function down_user_module($name, $user) {
		$query = "update `tiki_user_assigned_modules` set `ord`=`ord`+1 where `name`=? and `user`=?";

		$result = $this->query($query,array($name, $user));
	}

	function set_column_user_module($name, $user, $position) {
		$query = "update `tiki_user_assigned_modules` set `position`=? where `name`=? and `user`=?";
		$result = $this->query($query,array($position,$name, $user));
	}

	function assign_user_module($module, $position, $order, $user) {
		$query = "select * from `tiki_modules` where `name`=?";
		$result = $this->query($query,array($module));
		$res = $result->fetchRow();
		$query="delete from `tiki_user_assigned_modules` where `name`=? and `user`=?";
		$result=$this->query($query,array($module,$user),-1,-1,false);
		$query = 'insert into `tiki_user_assigned_modules`(`user`,`name`,`position`,`ord`,`type`) values(?,?,?,?,?)';
		$bindvars = array($user,$module,$position,(int) $order,$res['type']);
		$result = $this->query($query, $bindvars);
	}

	function get_user_assigned_modules($user) {
		$query = "select * from `tiki_user_assigned_modules` where `user`=? order by `position` asc,`ord` asc";

		$result = $this->query($query,array($user));
		$ret = array();

		while ($res = $result->fetchRow()) {
			$ret[] = $res;
		}

		return $ret;
	}

	function get_user_assigned_modules_pos($user, $pos) {
		$query = "select * from `tiki_user_assigned_modules` where `user`=? and `position`=? order by `ord` asc";

		$result = $this->query($query,array($user, $pos));
		$ret = array();

		while ($res = $result->fetchRow()) {
			$ret[] = $res;
		}

		return $ret;
	}

	function get_assigned_modules_user($user, $position) {
                //changed 10/14/03 by dheltzel to use the tiki_modules table for non-customizable fields.
		//$query = "select * from `tiki_user_assigned_modules` where `user`=? and `position`=? order by `ord` asc";
		$query = "select `umod`.`name`, `umod`.`position`, `umod`.`ord`, `umod`.`type`,
                  `mod`.`title`, `mod`.`cache_time`, `mod`.`rows`, `mod`.`params`,
                  `mod`.`groups`, `umod`.`user` 
                  from `tiki_user_assigned_modules` `umod`, `tiki_modules` `mod`
                  where `umod`.`name`=`mod`.`name` and `umod`.`user`=? and `umod`.`position`=? order by `umod`.`ord` asc";

		$result = $this->query($query,array($user, $position));
		$ret = array();

		while ($res = $result->fetchRow()) {
			$ret[] = $res;
		}

		return $ret;
	}

	function user_has_assigned_modules($user) {
		$query = "select count(`name`) from `tiki_user_assigned_modules` where `user`=?";

		$result = $this->getOne($query,array($user));
		return $result;
	}

	// Creates user assigned modules copying from tiki_modules
	function create_user_assigned_modules($user) {
		$query = "delete from `tiki_user_assigned_modules` where `user`=?";

		$result = $this->query($query,array($user));
		global $modallgroups;
		$query = "select * from `tiki_modules`";
		$result = $this->query($query,array());
		$ret = array();
		$user_groups = $this->get_user_groups($user);

		while ($res = $result->fetchRow()) {
			$mod_ok = 0;
			if ($res['type'] != "h") {
				if ($res["groups"] && $modallgroups != 'y') {
					$groups = unserialize($res["groups"]);

					$ins = array_intersect($groups, $user_groups);

					if (count($ins) > 0) {
						$mod_ok = 1;
					}
				} else {
					$mod_ok = 1;
				}
			}

			if ($mod_ok) {
				$query="delete from `tiki_user_assigned_modules` where `name`=? and `user`=?";
				$result2=$this->query($query,array($res['name'],$user),-1,-1,false);

				$query = "insert into `tiki_user_assigned_modules`
				(`user`,`name`,`position`,`ord`,`type`) values(?,?,?,?,?)";
				$bindvars = array($user,$res['name'],$res['position'],$res['ord'],$res['type']);
				$result2 = $this->query($query, $bindvars);
			}
		}
	}
	// Return the list of modules that can be assigned by the user
	function get_user_assignable_modules($user) {
		global $modallgroups;

		$query = "select * from `tiki_modules`";
		$result = $this->query($query,array());
		$ret = array();
		$user_groups = $this->get_user_groups($user);

		while ($res = $result->fetchRow()) {
			$mod_ok = 0;

			// The module must not be assigned
			$isas = $this->getOne(
				"select count(*) from `tiki_user_assigned_modules` where `name`=? and `user`=?",array($res["name"],$user));

			if (!$isas) {
				if ($res["groups"] && $modallgroups != 'y' && $user != 'admin') {
					$groups = unserialize($res["groups"]);

					$ins = array_intersect($groups, $user_groups);

					if (count($ins) > 0) {
						$mod_ok = 1;
					}
				} else {
					$mod_ok = 1;
				}

				if ($mod_ok) {
					$ret[] = $res;
				}
			}
		}

		return $ret;
	}
    /// Swap current module and above one
	function swap_up_user_module($name, $user)
    {
        $this->swap_adjacent($name, $user, '<');
	}
    /// Swap current module and below one
	function swap_down_user_module($name, $user)
    {
        $this->swap_adjacent($name, $user, '>');
    }
    /// Function to swap (up/down) two adjacent modules
    function swap_adjacent($name, $user, $op)
    {
        // Get position and order of module to swap
	    $query = "select `ord`,`position` from `tiki_user_assigned_modules` where `name`=? and user=?";
    	$r = $this->query($query, array($name, $user));
        $cur = $r->fetchRow();
        // Get name and order of module to swap with
	    $query = "select `name`,`ord` from `tiki_user_assigned_modules` where `position`=? and `ord`".$op."? and `user`=? order by `ord` ".($op == '<' ? 'desc' : '');
        $r = $this->query($query, array($cur['position'], $cur['ord'], $user));
        $swap = $r->fetchRow();
        if (!empty($swap))
        {
            // Swap 2 adjacent modules
            $query = "update `tiki_user_assigned_modules` set `ord`=? where `name`=? and `user`=?";
  	        $this->query($query, array($swap['ord'], $name, $user));
            $query = "update `tiki_user_assigned_modules` set `ord`=? where `name`=? and `user`=?";
  	        $this->query($query, array($cur['ord'], $swap['name'], $user));
        }
 	}
    /// Toggle module position
    function move_module($name, $user)
    {
        // Get current position
	    $query = "select `position` from `tiki_user_assigned_modules` where `name`=? and `user`=?";
    	$r = $this->query($query, array($name, $user));
        $res = $r->fetchRow();
        $this->set_column_user_module($name, $user, ($res['position'] == 'r' ? 'l' : 'r'));
    }
	/// Add a module to all the user who have assigned module and who don't have already this module
	function add_module_users($name,$title,$position,$order,$cache_time,$rows,$groups,$params,$type) {
		// for the user who already has this module, update only the type
		$this->query("update `tiki_user_assigned_modules` set `type`=? where `name`=?",array($type,$name)) ;
		// for the user who doesn't have this module
		$query = "select distinct t1.`user` from `tiki_user_assigned_modules` as t1 left join `tiki_user_assigned_modules` as t2 on t1.`user`=t2.`user` and t2.`name`=? where t2.`name` is null";   
		$result = $this->query($query,array($name));
		while ($res = $result->fetchRow()) {
 			$user = $res["user"];
//DH Fix
			$query = "insert into `tiki_user_assigned_modules`(`user`,`name`,`position`,`ord`,`type`)
			values(?,?,?,?,?)";
 			$this->query($query,array($user,$name,$position,(int) $order,$type));
		}
	} 
}
global $dbTiki;
$usermoduleslib = new UserModulesLib($dbTiki);

?>
