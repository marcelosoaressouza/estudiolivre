<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

// Lib for user administration, groups and permissions
// This lib uses pear so the constructor requieres
// a pear DB object

// some definitions for helping with authentication
define("USER_VALID", 2);

define("SERVER_ERROR", -1);
define("PASSWORD_INCORRECT", -3);
define("USER_NOT_FOUND", -5);
define("ACCOUNT_DISABLED", -6);

class UsersLib extends TikiLib {
# var $db;  // The PEAR db object used to access the database

    // change this to an email address to receive debug emails from the LDAP code
    var $debug = false;

    var $usergroups_cache;
    var $groupperm_cache;
    var $groupinclude_cache;
    var $userobjectperm_cache; // used to cache queries in object_has_one_permission()

    function UsersLib($db) {
	$this->db = $db;

	// Initialize caches
	$this->usergroups_cache = array();
	$this->groupperm_cache = array(array());
	$this->groupinclude_cache = array();
    }

    function set_admin_pass($pass) {
	global $feature_clear_passwords;

	$query = "select `email` from `users_users` where `login` = ?";
	$email = $this->getOne($query, array('admin'));
	$hash = md5("admin" . $pass);

	if ($feature_clear_passwords == 'n')
	    $pass = '';

	$query = "update `users_users` set `password` = ?, hash = ?
	    where `login` = ?";
	$result = $this->query($query, array($pass, $hash, 'admin'));
	return true;
    }

    function assign_object_permission($groupName, $objectId, $objectType, $permName) {
	$objectId = md5($objectType . strtolower($objectId));

	$query = "delete from `users_objectpermissions`
	    where `groupName` = ? and
	    `permName` = ? and
	    `objectId` = ?";
	$result = $this->query($query, array($groupName, $permName,
		    $objectId), -1, -1, false);

	$query = "insert into `users_objectpermissions`(`groupName`,
	`objectId`, `objectType`, `permName`)
	    values(?, ?, ?, ?)";
	$result = $this->query($query, array($groupName, $objectId,
		    $objectType, $permName));
	return true;
    }

    function object_has_permission($user, $objectId, $objectType, $permName) {
	$groups = $this->get_user_groups($user);
	$objectId = md5($objectType . strtolower($objectId));
	$mid = implode(',',array_fill(0,count($groups),'?'));
	$query = "select count(*) from `users_objectpermissions` where `groupName` in ($mid) and `objectId` = ? and `objectType` = ? and `permName` = ?";
    $bindvars = array_merge($groups, array($objectId, $objectType, $permName));
    $result = $this->getOne($query, $bindvars);
    if ($result > 0) {
		return true;
	} else {
		return false;
	}

    }

    function remove_object_permission($groupName, $objectId, $objectType, $permName) {
	$objectId = md5($objectType . strtolower($objectId));

	$query = "delete from `users_objectpermissions`
	    where `groupName` = ? and `objectId` = ?
	    and `objectType` = ? and `permName` = ?";
	$bindvars = array($groupName, $objectId, $objectType,
		$permName);
	$result = $this->query($query, $bindvars);
	return true;
    }

    function copy_object_permissions($objectId,$destinationObjectId,$objectType) {
	$objectId = md5($objectType . strtolower($objectId));

	$query = "select `permName`, `groupName`
	    from `users_objectpermissions`
	    where `objectId` =? and
	    `objectType` = ?";
	$bindvars = array($objectId, $objectType);
	$result = $this->query($query, $bindvars);
	while($res = $result->fetchRow()) {
	    $this->assign_object_permission($res["groupName"],$destinationObjectId,$objectType,$res["permName"]);
	}
	return true;
    }
    
    // assign permissions for an individual object according to the global permissions for that object type
    function inherit_global_permissions($objectId, $objectType) {
    	global $cachelib;
    	
		// check for annoying cases where some tables in the DB use singular and others use plural
    	if ($objectType == 'category') {
    		$objectType2 = 'categories';
    	} else {
    		$objectType2 = $objectType;
    	}
    	
		$groups = $this->get_groups();
		if (!$cachelib->isCached($objectType2 . "_permission_names")) {
			$perms = $this->get_permissions(0, -1, 'permName_desc', $objectType2);
			$cachelib->cacheItem($objectType2 . "_permission_names",serialize($perms));
		} else {
			$perms = unserialize($cachelib->getCached($objectType2 . "_permission_names"));
		}
		foreach ($groups['data'] as $group) {
			foreach ($perms['data'] as $perm) {
				if (in_array($perm['permName'], $group['perms'])) {
					$this->assign_object_permission($group['groupName'], $objectId, $objectType, $perm['permName']);
				}
			}
		}
    }

    function get_object_permissions($objectId, $objectType) {
	$objectId = md5($objectType . strtolower($objectId));

	$query = "select `groupName`, `permName`
	    from `users_objectpermissions`
	    where `objectId` = ? and
	    `objectType` = ?";
	$bindvars = array($objectId, $objectType);
	$result = $this->query($query, $bindvars);
	$ret = array();

	while ($res = $result->fetchRow()) {
	    $ret[] = $res;
	}

	return $ret;
    }

    function object_has_one_permission($objectId, $objectType) {
	$objectId = md5($objectType . strtolower($objectId));

	if(!isset($this->userobjectperm_cache) || !is_array($this->userobjectperm_cache) 
	   || !isset($this->userobjectperm_cache[$objectId])) {
	// i think, we really dont need the "and `objectType`=?" because the objectId should be unique due to the md5()
	$query = "select count(*) from `users_objectpermissions` where `objectId`=? and `objectType`=?";
	$this->userobjectperm_cache[$objectId]= $this->getOne($query, array(
		    $objectId,
		    $objectType
		    ));
	}

	return $this->userobjectperm_cache[$objectId];
    }

    function user_exists($user) {
	static $rv = array();

	if (!isset($rv[$user])) {
	    $query = "select count(*) from `users_users` where `login` = ?";

	    $result = $this->getOne($query, array($user));
	    $rv[$user] = $result;
	}

	return $rv[$user];
    }

    function group_exists($group) {
	static $rv = array();

	if (!isset($rv[$group])) {
	    $query = "select count(`groupName`)  from `users_groups` where `groupName` = ?";

	    $result = $this->getOne($query, array($group));
	    $rv[$group] = $result;
	}

	return $rv[$group];
    }

    function user_logout($user) {
			$query = 'delete from `tiki_user_preferences` where `prefName`=? and `user`=?';
			$user = $this->query($query, array('cookie',(string)$user));
    }
    
    function user_logout_cas() {
    	global $tikilib;
    	
    	// just make sure we're supposed to be here
		if ($tikilib->get_preference('auth_method', 'tiki') != 'cas') {
		    return false;
		}
		
		$cas_version = $tikilib->get_preference('cas_version', '1.0');
		$cas_hostname = $tikilib->get_preference('cas_hostname');
		$cas_port = $tikilib->get_preference('cas_port');
		$cas_path = $tikilib->get_preference('cas_path');
		
		// import phpCAS lib
		include_once('phpcas/CAS.php');

		phpCAS::setDebug();

		// initialize phpCAS
		phpCAS::client($cas_version, "$cas_hostname", (int) $cas_port, "$cas_path");
		
		// Logout
    	phpCAS::logout();
    }

    function genPass() {
	// AWC: enable mixed case and digits, don't return too short password
	global $min_pass_length;                                          //AWC

	$vocales = "AaEeIiOoUu13580";                                     //AWC
	$consonantes = "BbCcDdFfGgHhJjKkLlMmNnPpQqRrSsTtVvWwXxYyZz24679"; //AWC
	$r = '';
	$passlen = ($min_pass_length > 5) ? $min_pass_length : 5;         //AWC

	for ($i = 0; $i < $passlen; $i++) {                               //AWC
	    if ($i % 2) {
		$r .= $vocales{rand(0, strlen($vocales) - 1)};
	    } else {
		$r .= $consonantes{rand(0, strlen($consonantes) - 1)};
	    }
	}

	return $r;
    }

    function generate_challenge() {
	$val = md5($this->genPass());

	return $val;
    }

    function validate_hash($user, $hash) {
	return $this->db->getOne(
		"select count(*) from `users_users` where " . $this->convert_binary(). " `login` = ? and `hash`=?",
		array($user, $hash)
		);
    }

    function validate_user(&$user, $pass, $challenge, $response) {
	global $tikilib, $sender_email, $feature_intertiki, $feature_intertiki_mymaster, $min_pass_length;

	if ($user != 'admin' && $feature_intertiki == 'y' && !empty($feature_intertiki_mymaster)) {
	    // slave intertiki sites should never check passwords locally, just for admin
	    return false;
	}

	if (strlen($pass) < $min_pass_length) {
		return false;
	}
	// these will help us keep tabs of what is going on
	$userTiki = false;
	$userTikiPresent = false;
	$userAuth = false;
	$userAuthPresent = false;

	// see if we are to use PAM
	$auth_pam = ($tikilib->get_preference("auth_method", "tiki") == "pam");
	$pam_create_tiki = ($tikilib->get_preference("pam_create_user_tiki", "n") == "y");
	$pam_skip_admin = ($tikilib->get_preference("pam_skip_admin", "n") == "y");

	// see if we are to use PEAR::Auth
	$auth_pear = ($tikilib->get_preference("auth_method", "tiki") == "auth");
	$create_tiki = ($tikilib->get_preference("auth_create_user_tiki", "n") == "y");
	$create_auth = ($tikilib->get_preference("auth_create_user_auth", "n") == "y");
	$skip_admin = ($tikilib->get_preference("auth_skip_admin", "n") == "y");
	
	// see if we are to use CAS
	$auth_cas = ($tikilib->get_preference('auth_method', 'tiki') == 'cas');
	$cas_create_tiki = ($tikilib->get_preference('cas_create_user_tiki', 'n') == 'y');
	$cas_skip_admin = ($tikilib->get_preference('cas_skip_admin', 'n') == 'y');

	// first attempt a login via the standard Tiki system
	if (!$auth_cas || $user == 'admin') {
		$result = $this->validate_user_tiki($user, $pass, $challenge, $response);
	} else {
		$result = NULL;
	}
	switch ($result) {
	    case USER_VALID:
		$userTiki = true;

		$userTikiPresent = true;
		break;

	    case PASSWORD_INCORRECT:
		$userTikiPresent = true;

		break;
	}

	// if we aren't using LDAP this will be quick
	if ((!$auth_pear && !$auth_pam && !$auth_cas) || ((($auth_pear && $skip_admin) || ($auth_pam && $pam_skip_admin) || ($auth_cas && $cas_skip_admin)) && $user == "admin")) {
	    // if the user verified ok, log them in
	    if ($userTiki)
		return $this->update_lastlogin($user);
	    // if the user password was incorrect but the account was there, give an error
	    elseif ($userTikiPresent)
		return false;
	    // if the user was not found, give an error
	    // this could be for future uses
	    else
		return false;
	}
	// next see if we need to check PAM
	elseif ($auth_pam) {

		$result = $this->validate_user_pam($user, $pass);
		switch ($result) {
		case USER_VALID:
			$userPAM = true;

			break;
		case PASSWORD_INCORRECT:
			$userPAM = false;

			break;
		}

    	// start off easy
	    // if the user verified in Tiki and PAM, log in
	    if ($userPAM && $userTiki) {
			return $this->update_lastlogin($user);
	    }
	    // if the user wasn't found in either system, just fail
	    elseif (!$userTikiPresent && !$userPAM) {
			return false;
	    }
	    // if the user was logged into PAM but not found in Tiki
	    elseif ($userPAM && !$userTikiPresent) {
			// see if we can create a new account
			if ($pam_create_tiki) {
			    // need to make this better! *********************************************************
			    $result = $this->add_user($user, $pass, '', '');

			    // if it worked ok, just log in
			    if ($result == USER_VALID)
					// before we log in, update the login counter
					return $this->update_lastlogin($user);
			    // if the server didn't work, do something!
			    elseif ($result == SERVER_ERROR) {
					// check the notification status for this type of error
					return false;
			    }
			    // otherwise don't log in.
			    else
					return false;
			}
			// otherwise
			else
			    // just say no!
			    return false;
	    }
	    // if the user was logged into PAM and found in Tiki (no password in Tiki user table necessary)
	    elseif ($userPAM && $userTikiPresent)
			return $this->update_lastlogin($user);
	}

	// next see if we need to check CAS
	elseif ($auth_cas) {
		$result = $this->validate_user_cas($user);
		switch ($result) {
		case USER_VALID:
			$userCAS = true;

			break;
		case PASSWORD_INCORRECT:
			$userCAS = false;

			break;
		}
		if ($this->user_exists($user)) {
			$userTikiPresent = true;
		} else {
			$userTikiPresent = false;
		}

    	// start off easy
	    // if the user verified in Tiki and by CAS, log in
	    if ($userCAS && $userTiki) {
			return $this->update_lastlogin($user);
	    }
	    // if the user wasn't authenticated through CAS, just fail
	    elseif (!$userCAS) {
			return false;
	    }
	    // if the user was authenticated by CAS but not found in Tiki
	    elseif ($userCAS && !$userTikiPresent) {
			// see if we can create a new account
			if ($cas_create_tiki) {
			    // need to make this better! *********************************************************
			    $randompass = $this->genPass();
			    // in case CAS auth is turned off accidentally;
			    // we don't want ppl to be able to login as any user with blank passwords
			    $result = $this->add_user($user, $randompass, '', '');

			    // if it worked ok, just log in
			    if ($result == USER_VALID)
					// before we log in, update the login counter
					return $this->update_lastlogin($user);
			    // if the server didn't work, do something!
			    elseif ($result == SERVER_ERROR) {
					// check the notification status for this type of error
					return false;
			    }
			    // otherwise don't log in.
			    else
					return false;
			}
			// otherwise
			else
			    // just say no!
			    return false;
	    }
	    // if the user was authenticated by CAS and found in Tiki (no password in Tiki user table necessary)
	    elseif ($userCAS && $userTikiPresent)
			return $this->update_lastlogin($user);
	}

	// next see if we need to check PEAR::Auth
	else {
	    // check the user account
	    $result = $this->validate_user_auth($user, $pass);

	    switch ($result) {
		case USER_VALID:
		    $userAuth = true;

		    $userAuthPresent = true;
		    break;

		case PASSWORD_INCORRECT:
		    $userAuthPresent = true;

		    break;
	    }

	    // start off easy
	    // if the user verified in Tiki and Auth, log in
	    if ($userAuth && $userTiki) {
		return $this->update_lastlogin($user);
	    }
	    // if the user wasn't found in either system, just fail
	    elseif (!$userTikiPresent && !$userAuthPresent) {
		return false;
	    }
	    // if the user was logged into Tiki but not found in Auth
	    elseif ($userTiki && !$userAuthPresent) {
		// see if we can create a new account
		if ($create_auth) {
		    // need to make this better! *********************************************************
		    $result = $this->create_user_auth($user, $pass);

		    // if it worked ok, just log in
		    if ($result == USER_VALID)
			// before we log in, update the login counter
			return $this->update_lastlogin($user);
		    // if the server didn't work, do something!
		    elseif ($result == SERVER_ERROR) {
			// check the notification status for this type of error
			return false;
		    }
		    // otherwise don't log in.
		    else
			return false;
		}
		// otherwise
		else
		    // just say no!
		    return false;
	    }

	    // if the user was logged into Auth but not found in Tiki
	    elseif ($userAuth && !$userTikiPresent) {
		// see if we can create a new account
		if ($create_tiki) {
		    // need to make this better! *********************************************************
		    $result = $this->add_user($user, $pass, '', '');

		    // if it worked ok, just log in
		    if ($result == USER_VALID)
			// before we log in, update the login counter
			return $this->update_lastlogin($user);
		    // if the server didn't work, do something!
		    elseif ($result == SERVER_ERROR) {
			// check the notification status for this type of error
			return false;
		    }
		    // otherwise don't log in.
		    else
			return false;
		}
		// otherwise
		else
		    // just say no!
		    return false;
	    }
	    // if the user was logged into Auth and found in Tiki (no password in Tiki user table necessary)
	    elseif ($userAuth && $userTikiPresent)
		return $this->update_lastlogin($user);
	}

	// we will never get here
	return false;
    }

  // validate the user through PAM
    function validate_user_pam($user, $pass) {
	global $tikilib;

	// just make sure we're supposed to be here
	if ($tikilib->get_preference("auth_method", "tiki") != "pam")
	    return false;

	// get all of the PAM options from the database
	$pam_service = $tikilib->get_preference("pam_service", "tikiwiki");

// Read page AuthPAM at tw.o, it says about a php module required.
// maybe and if extension line could be added here... module requires $error
// as reference.
	if (pam_auth($user, $pass, $error)) {
		return USER_VALID;
	} else {
	// Uncomment the following to see errors on that
	// error_log("TIKI ERROR PAM:  $error User: $user Pass: $pass");
		return PASSWORD_INCORRECT;
	}
    }
    
	// validate the user through CAS
	function validate_user_cas(&$user) {
		global $tikilib;

		// just make sure we're supposed to be here
		if ($tikilib->get_preference('auth_method', 'tiki') != 'cas') {
		    return false;
		}

		$cas_version = $tikilib->get_preference('cas_version', '1.0');
		$cas_hostname = $tikilib->get_preference('cas_hostname');
		$cas_port = $tikilib->get_preference('cas_port');
		$cas_path = $tikilib->get_preference('cas_path');
		
		// import phpCAS lib
		include_once('phpcas/CAS.php');

		phpCAS::setDebug();

		// initialize phpCAS
		phpCAS::client($cas_version, "$cas_hostname", (int) $cas_port, "$cas_path");

		// check CAS authentication
		phpCAS::forceAuthentication();

		// at this step, the user has been authenticated by the CAS server
		// and the user's login name can be read with phpCAS::getUser().
		
		$user = phpCAS::getUser();
		
		if (isset($user)) {
			return USER_VALID;
		} else {
			return PASSWORD_INCORRECT;
		}
    }

    // validate the user in the PEAR::Auth system
    function validate_user_auth($user, $pass) {
	global $tikilib;

	include_once ("Auth/Auth.php");

	// just make sure we're supposed to be here
	if ($tikilib->get_preference("auth_method", "tiki") != "auth")
	    return false;

	// set the Auth options based on auth_type
    if ($tikilib->get_preference("auth_type","LDAP") == "LDAP") {
	    // get all of the LDAP options from the database
	    $options["host"] = $tikilib->get_preference("auth_pear_host", "localhost");
	    $options["port"] = $tikilib->get_preference("auth_pear_port", "389");
	    $options["url"] = $tikilib->get_preference("auth_ldap_url", "");
	    $options["scope"] = $tikilib->get_preference("auth_ldap_scope", "sub");
	    $options["basedn"] = $tikilib->get_preference("auth_ldap_basedn", "");
	    $options["userdn"] = $tikilib->get_preference("auth_ldap_userdn", "");
	    $options["userattr"] = $tikilib->get_preference("auth_ldap_userattr", "uid");
	    $options["useroc"] = $tikilib->get_preference("auth_ldap_useroc", "posixAccount");
	    $options["groupdn"] = $tikilib->get_preference("auth_ldap_groupdn", "");
	    $options["groupattr"] = $tikilib->get_preference("auth_ldap_groupattr", "cn");
	    $options["groupoc"] = $tikilib->get_preference("auth_ldap_groupoc", "groupOfUniqueNames");
	    $options["memberattr"] = $tikilib->get_preference("auth_ldap_memberattr", "uniqueMember");
	    $options["memberisdn"] = ($tikilib->get_preference("auth_ldap_memberisdn", "y") == "y");

	    $a = new Auth("LDAP", $options, "", false, $user, $pass);
    } else if ($tikilib->get_preference("auth_type","IMAP") == "IMAP") {
        $options["host"] = $tikilib->get_preference("auth_pear_host", "localhost");
        $options["port"] = $tikilib->get_preference("auth_pear_port", "143");
        $options["baseDSN"] = $tikilib->get_preference("auth_imap_pop3_basedsn", "");
        $options["checkServer"] = "false";

        $a = new Auth("IMAP", $options, "", false, $user, $pass);
    } else if ($tikilib->get_preference("auth_type","POP3") == "POP3") {
        $a = new Auth("POP3", $options, "", false, $user, $pass);
    } else if ($tikilib->get_preference("auth_type","vpopmail") == "vpopmail") {
        $a = new Auth("vpopmail", $options, "", false, $user, $pass);
    }


	// check if the login correct
	$a->login();
	switch ($a->checkAuth()) {
		case AUTH_LOGIN_OK:
			return USER_VALID;

		case AUTH_USER_NOT_FOUND:
			return USER_NOT_FOUND;

		case AUTH_WRONG_LOGIN:
			return PASSWORD_INCORRECT;

		default:
			return SERVER_ERROR;
	}
    }

    // validate the user in the Tiki database
    function validate_user_tiki($user, $pass, $challenge, $response) {
	global $feature_challenge;

	// first verify that the user exists
	$query = "select `email` from `users_users` where " . $this->convert_binary(). " `login` = ?";
	$result = $this->query($query, array($user) );

	if (!$result->numRows())
	{
	    return USER_NOT_FOUND;
	}


	$res = $result->fetchRow();
	$hash=md5($user.$pass.trim($res['email']));
	$hash2 = md5($user.$pass);
	$hash3 = md5($pass);

	// next verify the password with 2 hashes methods, the old one (pass?)) and the new one (login.pass;email)
	if ($feature_challenge == 'n' || empty($response)) {
	    $query
		= "select `login` from `users_users` where " . $this->convert_binary(). " `login` = ? and (`hash`=? or `hash`=? or `hash`=?)";

	    $result = $this->query($query, array(
			$user,
			$hash,
			$hash2,
			$hash3
			));

	    if ($result->numRows()) {
//		$t = date("U");
//
		// Check
//		$current = $this->getOne("select `currentLogin` from `users_users` where `login`=?", array($user));
//
//		if (is_null($current)) {
//		    // First time
//		    $current = $t;
//		}

//		$query = "update `users_users` set `lastLogin`=? where `login`=?";
//		$result = $this->query($query, array(
//			    (int)$current,
//			    $user
//			    ));
		// check
//		$query = "update `users_users` set `currentLogin`=? where `login`=?";
//		$result = $this->query($query, array(
//			    (int)$t,
//			    $user
//			    ));

		return true;
	    }
	} else {
	    // Use challenge-reponse method
	    // Compare pass against md5(user,challenge,hash)
	    $hash = $this->getOne("select `hash`  from `users_users` where " . $this->convert_binary(). " `login`=?",
		    array($user) );

	    if (!isset($_SESSION["challenge"]))
		return false;

	    //print("pass: $pass user: $user hash: $hash <br />");
	    //print("challenge: ".$_SESSION["challenge"]." challenge: $challenge<br />");
	    //print("response : $response<br />");
	    if ($response == md5($user . $hash . $_SESSION["challenge"])) {
		$t = date("U");

		// Check
		$current = $this->getOne("select `currentLogin` from `users_users` where `login`=?", array($user));

		if (is_null($current)) {
		    // First time
		    $current = $t;
		}

		$query = "update `users_users` set `lastLogin`=? where `login`=?";
		$result = $this->query($query, array(
			    (int)$current,
			    $user
			    ));

		// check
		$query = "update `users_users` set `currentLogin`=? where `login`=?";
		$result = $this->query($query, array(
			    (int)$t,
			    $user
			    ));

		return true;
	    } else {
		return false;
	    }
	}

	return PASSWORD_INCORRECT;
    }

    // update the lastlogin status on this user
    function update_lastlogin($user) {
	$t = date("U");

	// Check
	$current = $this->getOne("select `currentLogin` from `users_users` where `login`= ?", array($user));

	if (is_null($current)) {
	    // First time
	    $current = $t;
	}

	$query = "update `users_users` set `lastLogin`=? where `login`=?";
	$result = $this->query($query, array(
		    (int)$current,
		    $user
		    ));

	// check
	$query = "update `users_users` set `currentLogin`=? where `login`=?";
	$result = $this->query($query, array(
		    (int)$t,
		    $user
		    ));

	return true;
    }

    // create a new user in the Auth directory
    function create_user_auth($user, $pass) {
	global $tikilib, $sender_email;

	$options = array();
	$options["url"] = $tikilib->get_preference("auth_ldap_url", "");
	$options["host"] = $tikilib->get_preference("auth_pear_host", "localhost");
	$options["port"] = $tikilib->get_preference("auth_pear_port", "389");
	$options["scope"] = $tikilib->get_preference("auth_ldap_scope", "sub");
	$options["basedn"] = $tikilib->get_preference("auth_ldap_basedn", "");
	$options["userdn"] = $tikilib->get_preference("auth_ldap_userdn", "");
	$options["userattr"] = $tikilib->get_preference("auth_ldap_userattr", "uid");
	$options["useroc"] = $tikilib->get_preference("auth_ldap_useroc", "posixAccount");
	$options["groupdn"] = $tikilib->get_preference("auth_ldap_groupdn", "");
	$options["groupattr"] = $tikilib->get_preference("auth_ldap_groupattr", "cn");
	$options["groupoc"] = $tikilib->get_preference("auth_ldap_groupoc", "groupOfUniqueNames");
	$options["memberattr"] = $tikilib->get_preference("auth_ldap_memberattr", "uniqueMember");
	$options["memberisdn"] = ($tikilib->get_preference("auth_ldap_memberisdn", "y") == "y");
	$options["adminuser"] = $tikilib->get_preference("auth_ldap_adminuser", "");
	$options["adminpass"] = $tikilib->get_preference("auth_ldap_adminpass", "");

	// set additional attributes here
	$userattr = array();
	$userattr["email"] = $this->getOne("select `email` from `users_users`
			where `login`=?", array($user));

	// set the Auth options
	$a = new Auth("LDAP", $options);

	// check if the login correct
	if ($a->addUser($user, $pass, $userattr) === true)
	    $status = USER_VALID;

	// otherwise use the error status given back
	else
	    $status = $a->getStatus();


	return $status;
    }

    function get_users_names($offset = 0, $maxRecords = -1, $sort_mode = 'login_asc', $find = '') {

	// Return an array of users indicating name, email, last changed pages, versions, lastLogin
	if ($find) {
	    $findesc = '%' . $find . '%';
	    $mid = " where `login` like ?";
	    $bindvars=array($findesc);
	} else {
	    $mid = '';
	    $bindvars=array();
	}

	$query = "select `login` from `users_users` $mid order by ".$this->convert_sortmode($sort_mode);
	$result = $this->query($query,$bindvars,$maxRecords,$offset);
	$ret = array();

	while ($res = $result->fetchRow()) {
	    $ret[] = $res["login"];
	}

	return ($ret);
    }

function get_users($offset = 0, $maxRecords = -1, $sort_mode = 'login_asc', $find = '', $initial = '', $inclusion=false) {
	
	$now = date('U');
	$mid = '';
	$bindvars = array();
	$mmid = '';
	$mbindvars = array();
	// Return an array of users indicating name, email, last changed pages, versions, lastLogin 
	if ($find) {
	    $mid = " where `login` like ?";
			$mmid = $mid;
	    $bindvars = array('%'.$find.'%');
			$mbindvars = $bindvars;
	}

	if ($initial) {
		$mid = " where `login` like ?";
		$mmid = $mid;
		$bindvars = array($initial.'%');
		$mbindvars = $bindvars;
	}

	$query = "select * from `users_users` $mid order by ".$this->convert_sortmode($sort_mode);

	$query_cant = "select count(*) from `users_users` $mmid";
	$result = $this->query($query, $bindvars, $maxRecords, $offset);
	$cant = $this->getOne($query_cant, $mbindvars);
	$ret = array();

	while ($res = $result->fetchRow()) {
	    $aux = array();

	    $aux["user"] = $res["login"];
	    $aux["userId"] = $res["userId"];
	    $aux["default_group"] = $res["default_group"];
	    $user = $aux["user"];
	    $aux["email"] = $res["email"];
	    $aux["lastLogin"] = $res["lastLogin"];
	    if ($inclusion) {
	    	$groups = $this->get_user_groups_inclusion($user);
	    } else {
	    	$groups = $this->get_user_groups($user);
	    }
	    $aux["groups"] = $groups;
	    $aux["currentLogin"] = $res["currentLogin"];
	    $aux["age"] = $now - $res["registrationDate"];
		$aux['provpass'] = $res['provpass'];
	    $ret[] = $aux;
	}

	$retval = array();
	$retval["data"] = $ret;
	$retval["cant"] = $cant;
	return $retval;
}

    function group_inclusion($group, $include) {
	$query = "insert into `tiki_group_inclusion`(`groupName`,`includeGroup`)
		values(?,?)";
	$result = $this->query($query, array($group, $include));
    }

function get_included_groups($group) {
	$engroup = urlencode($group);
	if (!isset($this->groupinclude_cache[$engroup])) {
		$query = "select `includeGroup`  from `tiki_group_inclusion` where `groupName`=?";
		$result = $this->query($query, array($group));
		$ret = array();
		while ($res = $result->fetchRow()) {
			$ret[] = $res["includeGroup"];
			$ret2 = $this->get_included_groups($res["includeGroup"]);
			$ret = array_merge($ret, $ret2);
		}
		$back = array_unique($ret);
		$this->groupinclude_cache[$engroup] = $back;
		return $back; 
	} else {
		return $this->groupinclude_cache[$engroup];
	}
}

    function remove_user_from_group($user, $group) {
	global $cachelib;
	require_once("lib/cache/cachelib.php");
	$cachelib->invalidate('user_details_'.$user);

	$userid = $this->get_user_id($user);

	$query = "delete from `users_usergroups` where `userId` = ? and
		`groupName` = ?";
	$result = $this->query($query, array($userid, $group));
    }

    function get_groups($offset = 0, $maxRecords = -1, $sort_mode = 'groupName_desc', $find = '', $initial = '', $details="y", $inGroups='') {

	$mid = "";
	$bindvars = array();
	if ($find) {
	    $mid = " where `groupName` like ?";
	    $bindvars[] = "%" . $find . "%";
	}

	if ($initial) {
	    $mid = " where `groupName` like ?";
	    $bindvars = array($initial . "%");
	}
	if ($inGroups) {
		$mid .= $mid? ' and ': ' where ';
		$mid .= '`groupName` in (';
		$cpt = 0;
		foreach ($inGroups as $grp=>$value) {
			if ($cpt++)
				$mid .= ',';
			$mid .= '?';
			$bindvars[] = $grp;
		}
		$mid .= ')';
	}

	$query = "select `groupName` , `groupDesc` from `users_groups` $mid order by ".$this->convert_sortmode($sort_mode);
	$query_cant = "select count(*) from `users_groups` $mid";
	$result = $this->query($query, $bindvars, $maxRecords, $offset);
	$cant = $this->getOne($query_cant, $bindvars);
	$ret = array();

	while ($res = $result->fetchRow()) {
	    $aux = array();

	    $aux["groupName"] = $res["groupName"];
	    $aux["groupDesc"] = $res["groupDesc"];
	    if ($details == "y") {
	    	$perms = $this->get_group_permissions($aux["groupName"]);
	    	$aux["perms"] = $perms;
		$aux["permcant"] = count($perms);
	    	$groups = $this->get_included_groups($aux["groupName"]);
	    	$aux["included"] = $groups;
	    }
	    $ret[] = $aux;
	}
	
	$retval = array();
	$retval["data"] = $ret;
	$retval["cant"] = $cant;
	return $retval;
    }
	
	function list_all_users() {
		global $cachelib;
		if (!$cachelib->isCached("userslist")) {
			$users = array();
			$result = $this->query("select `login`,`userId` from `users_users` order by `login`", array());
			while ($res = $result->fetchRow()) {
				$users["{$res['userId']}"] = $res['login'];
			}
			$cachelib->cacheItem("userslist",serialize($users));
			return $users;
		} else {
			return unserialize($cachelib->getCached("userslist"));
		}
	}

	function list_all_groups() {
		global $cachelib;
		if (!$cachelib->isCached("grouplist")) {
			$groups = array();
			$result = $this->query("select `groupName` from `users_groups` order by `groupName`", array());
			while ($res = $result->fetchRow()) {
				$groups[] = $res['groupName'];
			}
			$cachelib->cacheItem("grouplist",serialize($groups));
			return $groups;
		} else {
			return unserialize($cachelib->getCached("grouplist"));
		}
	}
	
	function list_can_include_groups($group) {
		
		$list = array();
    		$query = "select `groupName` from `users_groups`";
		$result = $this->query($query);
		while($res = $result->fetchRow()) {
			if($res['groupName'] != $group) {
				$includedGroups = $this->get_included_groups($res['groupName']);
				if(!in_array($group, $includedGroups)) {
					$list[] = $res['groupName'];
				}
			}
		}
		return $list;
	}


    function get_user_id($user) {
	$id = $this->getOne("select `userId` from `users_users` where `login`=?", array($user));

	$id = ($id === NULL) ? -1 : $id;
	return $id;
    }

    function remove_user($user) {
		global $cachelib;
	$userId = $this->getOne("select `userId`  from `users_users` where `login` = ?", array($user));

	$query = "delete from `users_users` where `login` = ?";
	$result = $this->query($query, array( $user ) );
	$query = "delete from `users_usergroups` where `userId`=?";
	$result = $this->query($query, array( $userId ) );
	$query = "delete from `tiki_user_watches` where `user`=?";
	$result = $this->query($query, array($user));
	$query = "delete from `tiki_user_preferences` where `user`=?";
	$result = $this->query($query, array($user));
	$query = "delete from `tiki_newsletter_subscriptions` where `email`=? and `isUser`=?";
	$result = $this->query($query, array($user, 'y'));

	$cachelib->invalidate('userslist');
	return true;
    }

	function change_login($from,$to) {
		global $cachelib;
		$userId = $this->getOne("select `userId`  from `users_users` where `login` = ?", array($from));
		if ($userId) {
			$this->query("update `users_users` set `login`=? where `userId` = ?", array($to,(int)$userId));
			$this->query("update `tiki_wiki_attachments` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_webmail_messages` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_webmail_contacts` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_users` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_userpoints` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_userfiles` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_user_watches` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_user_votings` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_user_tasks` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_user_tasks` set `creator`=? where `creator`=?", array($to,$from));
			$this->query("update `tiki_user_tasks_history` set `lasteditor`=? where `lasteditor`=?", array($to,$from));
			$this->query("update `tiki_user_taken_quizzes` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_user_quizzes` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_user_preferences` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_user_postings` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_user_notes` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_user_modules` set `name`=? where `name`=?", array($to,$from));
			$this->query("update `tiki_user_menus` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_user_mail_accounts` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_user_bookmarks_urls` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_user_bookmarks_folders` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_user_assigned_modules` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_tags` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_suggested_faq_questions` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_submissions` set `author`=? where `author`=?", array($to,$from));
			$this->query("update `tiki_shoutbox` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_sessions` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_semaphores` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_received_pages` set `receivedFromUser`=? where `receivedFromUser`=?", array($to,$from));
			$this->query("update `tiki_received_articles` set `author`=? where `author`=?", array($to,$from));
			$this->query("update `tiki_private_messages` set `poster`=? where `poster`=?", array($to,$from));
			$this->query("update `tiki_private_messages` set `toNickname`=? where `toNickname`=?", array($to,$from));
			$this->query("update `tiki_pages` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_pages` set `creator`=? where `creator`=?", array($to,$from));
			$this->query("update `tiki_page_footnotes` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_newsreader_servers` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_newsreader_marks` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_minical_topics` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_minical_events` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_minical_topics` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_mailin_accounts` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_minical_topics` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_live_support_requests` set `user`=? where `operator`=?", array($to,$from));
			$this->query("update `tiki_live_support_requests` set `tiki_user`=? where `tiki_user`=?", array($to,$from));
			$this->query("update `tiki_live_support_requests` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_live_support_operators` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_live_support_messages` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_live_support_messages` set `username`=? where `username`=?", array($to,$from));
			$this->query("update `tiki_images` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_history` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_galleries` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_forums_reported` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_forums_queue` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_forums` set `moderator`=? where `moderator`=?", array($to,$from));
			$this->query("update `tiki_forum_reads` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_files` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_files` set `lastModifUser`=? where `lastModifUser`=?", array($to,$from));
			$this->query("update `tiki_file_galleries` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_drawings` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_download` set `userId`=? where `userId`=?", array((int)$userId,(int)$userId));
			$this->query("update `tiki_copyrights` set `userName`=? where `userName`=?", array($to,$from));
			$this->query("update `tiki_comments` set `userName`=? where `userName`=?", array($to,$from));
			$this->query("update `tiki_chat_users` set `nickname`=? where `nickname`=?", array($to,$from));
			$this->query("update `tiki_chat_messages` set `poster`=? where `poster`=?", array($to,$from));
			$this->query("update `tiki_chat_channels` set `moderator`=? where `moderator`=?", array($to,$from));
			$this->query("update `tiki_charts_votes` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_calendars` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_calendar_roles` set `username`=? where `username`=?", array($to,$from));
			$this->query("update `tiki_calendar_items` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_blogs` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_blogs` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_banning` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_banners` set `client`=? where `client`=?", array($to,$from));
			$this->query("update `tiki_articles` set `author`=? where `author`=?", array($to,$from));
			$this->query("update `tiki_actionlog` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `messu_messages` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `messu_messages` set `user_from`=? where `user_from`=?", array($to,$from));
			$this->query("update `galaxia_workitems` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `galaxia_user_roles` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `galaxia_instances` set `owner`=? where `owner`=?", array($to,$from));
			$this->query("update `galaxia_instances` set `nextUser`=? where `nextUser`=?", array($to,$from));
			$this->query("update `galaxia_instance_comments` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `galaxia_instance_activities` set `user`=? where `user`=?", array($to,$from));
			$this->query("update `tiki_newsletter_subscriptions` set `email`=? where `email`=? and `isUser`=?", array($to,$from, 'y'));

			$cachelib->invalidate('userslist');
			return true;
		} else {
			return false;
		}
	}

    function remove_group($group) {
	global $cachelib;
	if ( $group == 'Anonymous' || $group == 'Registered' || $group == 'Admins' ) return false;
	$query = "delete from `users_groups` where `groupName` = ?";
	$result = $this->query($query, array($group));
	$query = "delete from `tiki_group_inclusion` where `groupName` = ? or `includeGroup` = ?";
	$result = $this->query($query, array($group, $group));
	$query = "delete from `users_usergroups` where `groupName` = ?";
	$result = $this->query($query, array($group));
	$query = "delete from `users_grouppermissions` where `groupName` = ?";
	$result = $this->query($query, array($group));
	$query = "delete from `users_objectpermissions` where `groupName` = ?";
	$result = $this->query($query, array($group));
	$query = "delete from `tiki_newsletter_groups` where `groupName` = ?";
	$result = $this->query($query, array($group));
	$query = "delete from `tiki_newsreader_marks` where `groupName` = ?";
	$result = $this->query($query, array($group));
	
	$cachelib->invalidate('grouplist');
	return true;
    }

	function get_user_default_group($user) {
  	        if (!isset($user)) {
		    return 'Anonymous';
		}  
		$query = "select `default_group` from `users_users` where `login` = ?";
		$result = $this->getOne($query, array($user));
		$ret = '';
		if (!is_null($result) && $result != "") {
			$ret = $result;
		} else {
			$groups = $this->get_user_groups($user);
			foreach ($groups as $gr) {
				if ($gr != "Anonymous" and $gr != "Registered") {
					$ret = $gr;
					break;
				}
			}
			if (!$ret) {
				$ret = "Registered";
			}
		}
		return $ret;
	}
	function get_user_default_homepage($user) {
	    if (!$user) return $this->get_group_home('Anonymous');

		$query = "select `default_group` from `users_users` where `login` = ?";
		$result = $this->getOne($query, array($user));
		if (!is_null($result)) {
			$home = $this->get_group_home($result);
			if ($home != '')
				return $home;
		}
		$query = "select g.`groupHome`, g.`groupName` from `users_usergroups` as gu, `users_users` as u, `users_groups`as g where gu.`userId`= u.`userId` and u.`login`=? and gu.`groupName`= g.`groupName` and g.`groupHome` != '' and g.`groupHome` is not null";
		$result = $this->query($query,array($user));
		$home = '';
		while ($res = $result->fetchRow()) {
			if ($home != '') {
				$groups = $this->get_included_groups($res["groupName"]);
				if (in_array($group, $groups)) {
					$home = $res["groupHome"];
					$group = $res["groupName"];
				}
			}
			$home = $res["groupHome"];
			$group = $res["groupName"];
		}
		return $home;
	}

    //modified get_user_groups() to know if the user is part of the group directly or through groups inclusion
        function get_user_groups_inclusion($user) {
	    $userid = $this->get_user_id($user);

	    $query = "select `groupName` from `users_usergroups` where `userId`=?";
	    $result = $this->query($query, array((int)$userid));
	    $real = array(); //really assigned groups (not (only) included)
	    $ret = array();
	    while ($res = $result->fetchRow()) {
		$real[] = $res["groupName"];
		foreach ($this->get_included_groups($res["groupName"]) as $group) {
			$ret[$group] = "included";
	        }
	    }
	    foreach ($real as $group) {
		$ret[$group] = "real";
	    }
	    return $ret;
    }
    
	function get_group_home($group) {
		$query = "select `groupHome` from `users_groups` where `groupName`=?";
		$result = $this->getOne($query,array($group));
		$ret ='';
		if (!is_null($result)) {
			$ret = $result;
		}
		return $ret;
	}

    function get_group_users($group) {
	$query = "select `login`  from `users_users` uu, `users_usergroups` ug where uu.`userId`=ug.`userId` and `groupName`=?";
	$result = $this->query($query,array($group));
	$ret = array();
	while ($res = $result->fetchRow()) {
	    $ret[] = $res["login"];
	}
	return $ret;
    }

    function get_user_info($user, $inclusion=false) {
	$query = "select * from `users_users` where `login`=?";
	$result = $this->query($query,array($user));
	$res = $result->fetchRow();
	if ($inclusion) {
		$groups = $this->get_user_groups_inclusion($user);
	} else {
		$groups = $this->get_user_groups($user);
	}
	$res["groups"] = $groups;
	$res["age"] = date('U') - $res['registrationDate'];
	return $res;
    }
    
    // this is not being used anywhere until now in remote.php
    // refactoring to use new cachelib instead of global var in memory - batawata 2006-02-07
    function get_user_details($login, $item = false) {
	global $cachelib;
	require_once("lib/cache/cachelib.php");

	$cacheKey = 'user_details_'.$login;

	$user_details = array();

	if ($cachelib->isCached($cacheKey)) {
	    return unserialize($cachelib->getCached($cacheKey));
	} else {
	    $query  = 'SELECT `userId` , `login`, `email` , `lastLogin` , `currentLogin` , `registrationDate` , `created` ,  `avatarName` , `avatarSize` , `avatarFileType` , `avatarLibName` , `avatarType` FROM `users_users` WHERE `login` = ?';
	    
	    $result = $this->query($query, array($login));
	    
	    $user_details['info'] = $result->fetchRow();
	    
	    $query  = 'SELECT `prefName` , `value` FROM `tiki_user_preferences` WHERE `user` = ?';
	    $result = $this->query($query, array($login));
	    
	    $user_details['preferences'] = array();
	    $aUserPrefs = array('realName','homePage','country');
	    while ( $row = $result->fetchRow() ) {
		$user_details['preferences'][$row['prefName']] = $row['value'];

		// atention: this is redundant, for intertiki slave mode
		// we insert, delete and insert again this information, 
		// because of nature of user information as being preferences
		if (in_array($row['prefName'], $aUserPrefs)) {
		    $user_details['info'][$row['prefName']] = $row['value'];
		}
		
	    }

	    $user_details['groups'] = $this->get_user_groups($login);

	    $cachelib->cacheItem($cacheKey, serialize($user_details));

	    global $user_preferences;
	    $user_preferences[$login] = $user_details['preferences'];

	    return $user_details;
	}
    }

    function set_default_group($user,$group) {
    	// if user is not in group, assign user to group before setting default group
    	$user_groups = $this->get_user_groups($user);
		if (!in_array($group, $user_groups)) {
			$this->assign_user_to_group($user, $group);
		}
	$query = "update `users_users` set `default_group` = ?
		where `login` = ?";
	$this->query($query, array($group, $user));
    }

    function change_permission_level($perm, $level) {
    global $cachelib;

    $cachelib->invalidate("allperms");

	$query = "update `users_permissions` set `level` = ?
		where `permName` = ?";
	$this->query($query, array($level, $perm));
    }

    function assign_level_permissions($group, $level) {
    global $cachelib;
    $cachelib->invalidate("allperms");

	$query = "select `permName` from `users_permissions` where `level` = ?";
	$result = $this->query($query, array($level));
	$ret = array();

	while ($res = $result->fetchRow()) {
	    $this->assign_permission_to_group($res['permName'], $group);
	}
    }

    function remove_level_permissions($group, $level) {
    global $cachelib;

    $cachelib->invalidate("allperms");

	$query = "select `permName` from `users_permissions` where `level` = ?";

	$result = $this->query($query, array($level));
	$ret = array();

	while ($res = $result->fetchRow()) {
	    $this->remove_permission_from_group($res['permName'], $group);
	}
    }

    function create_dummy_level($level) {
    global $cachelib;

    $cachelib->invalidate("allperms");

	$query = "delete from `users_permissions` where `permName` = ? and `level` = ?";
	$result = $this->query($query, array('', $level));
	$query = "insert into `users_permissions`(`permName`, `permDesc`,
		`type`, `level`) values('','','',?)";
	$this->query($query, array($level));
    }

    function get_permission_levels() {
	$query = "select distinct(`level`) from `users_permissions`";

	$result = $this->query($query);
	$ret = array();

	while ($res = $result->fetchRow()) {
	    $ret[] = $res['level'];
	}

	return $ret;
    }

    function get_userid_info($user) {
	$query = "select * from `users_users` where `userId` = ?";
	$result = $this->query($query, array((int)$user));
	$res = $result->fetchRow();
	$res["groups"] = $this->get_user_groups($res['login']);
	if (isset($res['registrationDate']))
		$res["age"] = date('U') - $res['registrationDate'];
	return $res;
    }

	function get_tracker_usergroup($user) {
		$query = "select `default_group` from `users_users` where `login` = ?";
		$result = $this->getOne($query, array($user));
		$ret = '';
		$userTrackerId = $ret;
		if (!is_null($result)) {
			$ret = $this->get_usertrackerid($result);
			if ($ret) {
				$userTrackerId = $ret;
			}
		} 
		if (!$userTrackerId) {
			$groups = $this->get_user_groups($user);
			foreach ($groups as $gr) {
				if ($gr != "Anonymous" and $gr != "Registered") {
					$ret = $this->get_usertrackerid($gr);
					if ($ret) {
						$userTrackerId = $ret;
						break;
					}
				}
			}
		}
		return $ret;
	}

	function get_grouptrackerid($group) {
		$res = $this->query("select `groupTrackerId`,`groupFieldId` from `users_groups` where `groupName`=?",array($group));
		$ret = $res->fetchRow();
		if (!$ret['groupTrackerId'] or !$ret['groupFieldId']) {
			$groups = $this->get_included_groups($group);
			foreach ($groups as $gr) {
				$res = $this->query("select `groupTrackerId`,`groupFieldId` from `users_groups` where `groupName`=?",array($gr));
				$ret = $res->fetchRow();
				if ($ret['groupTrackerId'] and $ret['groupFieldId']) {
					return $ret;
				}
			}
		} else {
			return $ret;
		}
		return false;
	}

	function get_usertrackerid($group) {
		$res = $this->query("select `usersTrackerId`,`usersFieldId` from `users_groups` where `groupName`=?",array($group));
		$ret = $res->fetchRow();
		if (!$ret['usersTrackerId'] or !$ret['usersFieldId']) {
			$groups = $this->get_included_groups($group);
			foreach ($groups as $gr) {
				$res = $this->query("select `usersTrackerId`,`usersFieldId` from `users_groups` where `groupName`=?",array($gr));
				$ret = $res->fetchRow();
				if ($ret['usersTrackerId'] and $ret['usersFieldId']) {
					return $ret;
				}
			}
		} else {
			return $ret;
		}
		return false;
	}

	
	function get_usertracker($uid) {
		$utr = $this->get_userid_info($uid);
		$utr["usersTrackerId"] = '';
		foreach ($utr['groups']  as $gr) {
			$utrid = $this->get_usertrackerid($gr);
			if ($utrid['usersTrackerId'] and $utrid['usersFieldId']) {
				$utrid['group'] = $gr;
				$utrid['user'] = $utr['login'];
				$utr = $utrid;
				break;
			}
		}
		return $utr;
	}

  function get_permissions($offset = 0, $maxRecords = -1, $sort_mode = 'permName_desc', $find = '', $type = '', $group = '') {
	$values = array();
	$sort_mode = $this->convert_sortmode($sort_mode);
	$mid = '';
	if ($type) {
	    $mid = ' where `type`= ? ';
	    $values[] = $type;
	}

	if ($find) {
	    if ($mid) {
		$mid .= " and `permName` like ?";
		$values[] = '%'.$find.'%';
	    } else {
		$mid .= " where `permName` like ?";
		$values[] = '%'.$find.'%';
	    }
	}

	$query = "select `permName`,`type`,`level`,`permDesc` from `users_permissions` $mid order by $sort_mode ";

#	$query_cant = "select count(*) from `users_permissions` $mid";
	$result = $this->query($query, $values, $maxRecords, $offset);
#	$cant = $this->getOne($query_cant, $values);
	$cant = 0;
	$ret = array();

	while ($res = $result->fetchRow()) {
	    $cant++;
	    if ($group && $this->group_has_permission($group, $res['permName'])) {
		$hasPerm = 'y';
	    } else {
		$hasPerm = 'n';
	    }

	    $ret[] = array(
		    'permName' => $res['permName'],
		    'permDesc' => $res['permDesc'],
		    'type' => $res['type'],
		    'level' => $res['level'],
		    'hasPerm' => $hasPerm,
		    );
	}

	return array(
		'data' => $ret,
		'cant' => $cant,
		);
    }

    function get_group_permissions($group) {
	$query = "select `permName` from `users_grouppermissions` where `groupName`=?";

	$result = $this->query($query, array($group));
	$ret = array();

	while ($res = $result->fetchRow()) {
	    $ret[] = $res["permName"];
	}

	return $ret;
    }

    function assign_permission_to_group($perm, $group) {
    global $cachelib;

    $cachelib->invalidate("allperms");

	$query = "delete from `users_grouppermissions` where `groupName` = ?
		and `permName` = ?";
	$result = $this->query($query, array($group, $perm));
	$query = "insert into `users_grouppermissions`(`groupName`, `permName`)
		values(?, ?)";
	$result = $this->query($query, array($group, $perm));
	return true;
    }

    function get_user_permissions($user) {
	//debug
	//echo "<pre>userslib.php: get_user_permissions\n</pre>";
	// admin has all the permissions
	$groups = $this->get_user_groups($user);

	$ret = array();

	foreach ($groups as $group) {
	    $perms = $this->get_group_permissions($group);

	    foreach ($perms as $perm) {
		$ret[] = $perm;
	    }
	}

	return $ret;
    }

    function user_has_permission($user, $perm) {
	// admin has all the permissions
	if ($user == 'admin')
	    return true;

	// Get user_groups ?
	$groups = $this->get_user_groups($user);

	foreach ($groups as $group) {
	    if ($this->group_has_permission($group, $perm))
		return true;
	}

	return false;
    }

    function group_has_permission($group, $perm) {
		$engroup = urlencode($group);
	if (!isset($perm, $this->groupperm_cache[$engroup][$perm])) {
	    $query = "select count(*) from `users_grouppermissions` where `groupName`=? and `permName`=?";
	    $result = $this->getOne($query, array( $group, $perm));
	    $this->groupperm_cache[$engroup][$perm] = $result;
	    return $result;
	} else {
	    return $this->groupperm_cache[$engroup][$perm];
	}
    }

    function remove_permission_from_group($perm, $group) {
    global $cachelib;

    $cachelib->invalidate("allperms");

	$query = "delete from `users_grouppermissions` where `permName` = ?
		and `groupName` = ?";
	$result = $this->query($query, array($perm, $group));
	return true;
    }

    function get_group_info($group) {
	$query = "select * from `users_groups` where `groupName`=?";

	$result = $this->query($query, array($group));
	$res = $result->fetchRow();
	$perms = $this->get_group_permissions($group);
	$res["perms"] = $perms;
	return $res;
    }

    function assign_user_to_group($user, $group) {
	global $cachelib;
	require_once("lib/cache/cachelib.php");
	$cachelib->invalidate('user_details_'.$user);

	$group_ret = false;
	$userid = $this->get_user_id($user);

	if ( $userid > 0 ){
	    $query = "insert into `users_usergroups`(`userId`,`groupName`) values(?,?)";
	    $result = $this->query($query, array(
		    $userid,
		    $group
		    ), -1, -1, false);
	    $group_ret = true;
	}
	return $group_ret;
    }

    function assign_user_to_groups($user, $groups) {
	global $cachelib;
	require_once("lib/cache/cachelib.php");
	$cachelib->invalidate('user_details_'.$user);

	$userid = $this->get_user_id($user);

	$query = "delete from `users_usergroups` where `userId`=?";
	$this->query($query, array($userid));

	foreach ($groups as $grp) {
	    $this->assign_user_to_group($user, $grp);
	}
	    
    }

    function confirm_user($user) {
	global $feature_clear_passwords,$cachelib;

	$query = "select `provpass`, `login` from `users_users` where `login`=?";
	$result = $this->query($query, array($user));
	$res = $result->fetchRow();
	// $hash = md5($res["login"] . $res["provpass"] . $res["email"]);
	$hash = md5($res["login"] . $res["provpass"]);
	$provpass = $res["provpass"];

	if ($feature_clear_passwords == 'n') {
	    $provpass = '';
	}

	$query = "update `users_users` set `password`=? ,`hash`=? ,`provpass`=?,valid=? where `login`=?";
	$result = $this->query($query, array(
		    $provpass,
		    $hash,
		    '',
			NULL,
		    $user
		    ));
			$cachelib->invalidate('userslist');
    }

    function add_user($user, $pass, $email, $provpass = '', $valid=NULL, $realName='') {
	global $pass_due, $tikilib, $cachelib, $patterns;
	global $feature_clear_passwords;
	// Generate a unique hash; this is also done below in set_user_fields()
	//$hash = md5($user . $pass . $email);
	$hash = md5($user . $pass);

	if ($valid == 'n') {
		$valid = $pass;
	}
	if ($feature_clear_passwords == 'n')
	    $pass = '';

	if ($this->user_exists($user) || empty($user) || !preg_match($patterns['login'],$user))
	    return false;

	$now = date("U");
	$new_pass_due = $now + (60 * 60 * 24 * $pass_due);
	$query = "insert into
	    `users_users`(`login`, `password`, `email`, `provpass`,
		    `registrationDate`, `hash`, `pass_due`, `created`, `valid`)
	    values(?,?,?,?,?,?,?,?,?)";
	$result = $this->query($query, array(
		    $user,
		    $pass,
		    $email,
		    $provpass,
		    (int) $now,
		    $hash,
		    (int) $new_pass_due,
		    (int) $now,
			$valid
		    ));

	$this->assign_user_to_group($user, 'Registered');

	if( $tikilib->get_preference("eponymousGroups", 'n') == 'y' )
	{
	    // Create a group just for this user, for permissions
	    // assignment.
	    $this->add_group($user, "Personal group for $user.", '',0,0);

	    $this->assign_user_to_group($user, $user);
	}
	if (!empty($realName))
		$this->set_user_preference($user, 'realName', $realName);

	$cachelib->invalidate('userslist');
	return true;
    }

	function change_user_name($username, $realname) {
		$query = "update `tiki_user_preferences` set `value`='$realname' where `user`='$username' and `prefName`='realName'";
		$result = $this->query($query);
		return true;
	}

    function change_user_email($user, $email, $pass) {
    // Need to change the email-address for notifications, too
	global $notificationlib; include_once('lib/notifications/notificationlib.php');
    $oldMail = $this->get_user_email($user);
    $notificationlib->update_mail_address($oldMail, $email);
    
	$query = "update `users_users` set `email`=? where " . $this->convert_binary(). " `login`=?";

	$result = $this->query($query, array(
		    $email,
		    $user
		    ));

	// that block stays here for a time (compatibility)
	// lfagundes - only if pass is provided, admin doesn't need it
	// is this still necessary?
	if (!empty($pass)) {
	    $hash = md5($user . $pass);
	    $query = "update `users_users` set `hash`=?  where " . $this->convert_binary(). " `login`=?";
	    $result = $this->query($query, array(
						 $hash,
						 $user
						 ));
	}

	$query = "update `tiki_user_watches` set `email`=? where " . $this->convert_binary(). " `user`=?";
	$result = $this->query($query, array( $email, $user));

	$query = "update `tiki_live_support_requests` set `email`=? where " . $this->convert_binary(). " `user`=?";
	$result = $this->query($query, array( $email, $user));
				return true;
    }

    function get_user_password($user) {
	$query = "select `password`,`provpass`  from `users_users` where " . $this->convert_binary(). " `login`=?";

	$result = $this->query($query, array($user));
	$res = $result->fetchRow();
	if (empty($res['provpass']))
		return $res['password'];
	else
		return $res['provpass'];
    }

    function get_user_email($user) {
        return $this->getOne("select `email` from `users_users` where " . $this->convert_binary(). " `login`=?", array($user));
    }

    function get_user_name($username) {
		$query = "select `value` from `tiki_user_preferences` where `user`=? and `prefName`=?";
        return $this->getOne($query, array($username, 'realName'));
    }

    /**
     *  Returns the contact users' email if set and permitted by Admin->Features settings
     */
    function get_admin_email() {
        global $user, $contact_anon, $feature_contact, $tikilib, $contact_user;
        if (( !isset($user) && isset($contact_anon) && $contact_anon == 'y' ) ||
                ( isset($user) && $user != "" && isset($feature_contact) && $feature_contact == 'y' )) {
            return $tikilib->get_preference('sender_email', $this->get_user_email($contact_user));
        }
    }

    function get_user_hash($user) {
	$query = "select `hash`  from `users_users` where " .
		$this->convert_binary(). " `login` = ?";
	$pass = $this->getOne($query, array($user));
	return $pass;
    }

    function get_user_by_hash($hash) {
	$query = "select `login` from `users_users` where `hash`=?";
	$pass = $this->getOne($query, array($hash));
	return $pass;
    }

  function create_user_cookie($user) {
    global $remembertime;
    $hash = md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']);
    $hash.= ".". (date('U') + $remembertime);
    $this->set_user_preference($user,'cookie',$hash);
    return $hash;
  }

  function get_user_by_cookie($hash) {
	list($check,$expire,$userCookie) = explode('.',$hash, 3);
    if ($check == md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'])) {
      $query = 'select `user` from `tiki_user_preferences` where `prefName`=? and `value`=? and `user`=?';
      $user = $this->getOne($query, array('cookie',"$check.$expire", $userCookie));
      if ($user) {
        if ($expire < date('U')) {
          $query = 'delete from `tiki_user_preferences` where `prefName`=? and `value`=?';
          $user = $this->query($query, array('cookie',$hash));
          return false;
        } else {
          return $user;
        }
      }
    }
    return false;
  }

    function get_user_by_email($email) {
    $query = "select `login` from `users_users` where `email`=?";
    $pass = $this->getOne($query, array($email));
    return $pass;
    }
    
    function is_due($user) {
    	global $change_password;
    	// if CAS auth is enabled, don't check if password is due since CAS does not use local Tiki passwords
    	if ($this->get_preference('auth_method', 'tiki') == 'cas' || $change_password != 'y') {
    		return false;
    	}
    	
	$due = $this->getOne("select `pass_due`  from `users_users` where " . $this->convert_binary(). " `login`=?", array($user));

	if ($due <= date("U"))
	    return true;

	return false;
    }

    function renew_user_password($user) {
		$pass = $this->genPass();
		// Note that tiki-generated passwords are due inmediatley
		// Note: ^ not anymore. old pw is usable until the URL in the password reminder mail is clicked
		$now = date("U");
		$query = "update `users_users` set `provpass` = ? where " . $this->convert_binary() . " `login`=?";
		$result = $this->query($query, array($pass, $user));
		return $pass;
    }

    function activate_password($user, $actpass) {
		// move provpass to password and generate new hash, afterwards clean provpass
		$query = "select `provpass`  from `users_users` where " . $this->convert_binary() . " `login`=?";
		$pass = $this->getOne($query, array($user));
		if (($pass <> '') && ($actpass == md5($pass))) {
			$hash = md5($user . $pass);
			$now = date("U");
			$query = "update `users_users` set `password`=?, `hash`=?, `pass_due`=? where " . $this->convert_binary() . " `login`=?";
			$result = $this->query($query, array("", $hash, (int)$now, $user));
			return $pass;
		}
		return false;
    }

    function change_user_password($user, $pass) {
	global $pass_due;

	global $feature_clear_passwords;
	/*anybody know what this is for? thenano 2006-01-18
	$query = "select `email` from `users_users` where `login` = ?";
	$email = $this->getOne($query, array($user));
	$email=trim($email);
	//$hash = md5($user . $pass . $email);
	**********/
	$hash = md5($user . $pass);
	$now = date("U");
	$new_pass_due = $now + (60 * 60 * 24 * $pass_due);

	if ($feature_clear_passwords == 'n') {
	    $pass = '';
	}

	$query = "update `users_users` set `hash`=? ,`password`=? ,`pass_due`=?, `provpass`=? where " . $this->convert_binary(). " `login`=?";
	$result = $this->query($query, array(
		    $hash,
		    $pass,
		    $new_pass_due,
		    "",
		    $user
		    ));
			return true;
    }

	function add_group($group, $desc, $home, $utracker=0, $gtracker=0) {
		global $cachelib;  
		if ($this->group_exists($group))
			return false;
		$query = "insert into `users_groups`(`groupName`, `groupDesc`, `groupHome`,`usersTrackerId`,`groupTrackerId`) values(?,?,?,?,?)";
		$result = $this->query($query, array($group, $desc, $home, (int)$utracker, (int)$gtracker) );
		$cachelib->invalidate('grouplist');
		return true;
	}

	function change_group($olgroup,$group,$desc,$home,$utracker=0,$gtracker=0,$ufield=0,$gfield=0) {
		global $cachelib;  

//		marclaporte: commenting below because it is possible to edit some things for these groups (ex.: group home page).
//		There is a protection in the tpl to prevent renaming.
//		if ( $olgroup == 'Anonymous' || $olgroup == 'Registered' ) return false;

		if (!$this->group_exists($olgroup))
			return $this->add_group($group, $desc, $home,$utracker,$gtracker);
		$query = "update `users_groups` set `groupName`=?, `groupDesc`=?, `groupHome`=?, ";
		$query.= " `usersTrackerId`=?, `groupTrackerId`=?, `usersFieldId`=?, `groupFieldId`=? where `groupName`=?";
		$result = $this->query($query, array($group, $desc, $home, (int)$utracker, (int)$gtracker, (int)$ufield, (int)$gfield, $olgroup));
		$query = "update `users_usergroups` set `groupName`=? where `groupName`=?";
		$result = $this->query($query, array($group, $olgroup));
		$query = "update `users_grouppermissions` set `groupName`=? where `groupName`=?";
		$result = $this->query($query, array($group, $olgroup));
		$query = "update `users_objectpermissions` set `groupName`=? where `groupName`=?";
		$result = $this->query($query, array($group, $olgroup));
		$query = "update `tiki_group_inclusion` set `groupName`=? where `groupName`=?";
		$result = $this->query($query, array($group, $olgroup));
		$query = "update `tiki_group_inclusion` set `includeGroup`=? where `includeGroup`=?";
		$result = $this->query($query, array($group, $olgroup));
		$query = "update `tiki_newsreader_marks` set `groupName`=? where `groupName`=?";
		$result = $this->query($query, array($group, $olgroup));
		$query = "update `tiki_newsletter_groups` set `groupName`=? where `groupName`=?";
		$result = $this->query($query, array($group, $olgroup));
		
		// must unserialize before replacing the groups
		$query = "select `name`, `groups` from `tiki_modules` where `groups` like ?";
		$result = $this->query($query, array('%'.$olgroup.'%'));
		while ($res = $result->fetchRow()) {
			$aux = array();
			$aux["name"] = $res["name"];
			$aux["groups"] = unserialize($res["groups"]);
			$aux["groups"] = str_replace($olgroup, $group, $aux["groups"]);
			$aux["groups"] = serialize($aux["groups"]);
			$query = "update `tiki_modules` set `groups`=? where `name`=?";
			$this->query($query, array($aux["groups"],$aux["name"]));
		}

		$cachelib->invalidate('grouplist');
		return true;
	}

    function remove_all_inclusions($group) {
	if (!$this->group_exists($group))
	    return false;

	$query = "delete from `tiki_group_inclusion` where `groupName` = ?";
	$result = $this->query($query, array($group));
	$this->groupinclude_cache = array();
	return true;
    }

    function set_user_fields($u) {
	global $feature_clear_passwords;

	$q = array();
	$bindvars = array();

	if (@$u['password']) {
	    if ($feature_clear_passwords == 's') {
		$q[] = "`password` = ?";
		$bindvars[] = strip_tags($u['password']);
	    }

	    // I don't think there are currently cases where login and email are undefined
	    //$hash = md5($u['login'] . $u['password'] . $u['email']);
	    $hash = md5($u['login'] . $u['password']);
	    $q[] = "`hash` = ?";
	    $bindvars[] = $hash;
	}

	if (@$u['email']) {
	    $q[] = "`email` = ?";
	    $bindvars[] = strip_tags($u['email']);
	}

	if (sizeof($q) > 0) {
	    $query = "update `users_users` set " . implode(",", $q). " where " .
		$this->convert_binary(). " `login` = ?";
	    $bindvars[] = $u['login'];
	    $result = $this->query($query, $bindvars);
	}


	$aUserPrefs = array('realName','homePage','country');
	foreach ($aUserPrefs as $pref){
		if (@$u[$pref]) {
		    $bindvars = array();

		    $bindvars[] = strip_tags($u[$pref]);
		    $bindvars[] = $u['login'];
		    $bindvars[] = $pref;

		    if ($this->getOne("select `user` from `tiki_user_preferences` where `user`=? and `prefName`=?",array($u['login'],$pref))) {
			$query = "UPDATE `tiki_user_preferences` set `value`=? where `user`=? and `prefName`=?";
		    } else {
			$query = "INSERT INTO `tiki_user_preferences` (`value`,`user`,`prefName`) VALUES (?,?,?)";
		    }
		    $this->query($query, $bindvars);
		}
	}

	return $result;
    }

    //this function sets ione user field
    function set_user_field($name, $value) {

	global $user;

	$aUserPrefs = array('realName','site','local', 'isPublic', 'licencaPadrao', 'allowMsgs');
	if (in_array($name, $aUserPrefs)) {
	    $result = $this->set_user_preference($user, $name, $value);
	} else {
	    $query = "UPDATE `users_users` set `$name`='$value' where `login`='$user'";
	    $result = $this->query($query);
	}

	return $result;
    }

    // damian aka damosoft
    function count_users($group) {
        static $rv = array();

        if (!isset($rv[$group])) {
            if ($group == '') {
                $query = "select count(login) from `users_users`";
                $result = $this->getOne($query);
            } else {
                $query = "select count(userId) from `users_usergroups` where `groupName` = ?";
                $result = $this->getOne($query, array($group));
            }
            $rv[$group] = $result;
        }

        return $rv[$group];
    }

    // Friends methods
    // TODO: if there's already a friendship request from friend to user, accept it
    function request_friendship($user, $friend)
    {
	if (empty($user) || empty($friend) || $user == $friend) {
	    return false;
	}

	$query = "delete from `tiki_friendship_requests` where `userFrom`=? and `userTo`=?";
	$this->query($query, array($user, $friend));

	$query = "insert into `tiki_friendship_requests` (`userFrom`, `userTo`) values (?, ?)";
	$result = $this->query($query, array($user, $friend));

	if (!$result)
	    return false;

	return true;
    }

    function accept_friendship($user, $friend)
    {
	$exists = $this->getOne("select count(*) from `tiki_friendship_requests` where `userTo`=? and `userFrom`=?",
				array($user, $friend));

	if (!$exists)
	    return false;

	if (empty($user) || empty($friend)) {
	    return false;
	}

	$query = "delete from `tiki_friends` where `user`=? and `friend`=?";
	$this->query($query, array($user, $friend));
	$this->query($query, array($friend, $user));

	$query = "insert into `tiki_friends` (`user`, `friend`) values (?,?)";
	$this->query($query, array($user, $friend));
	$this->query($query, array($friend, $user));

	$query = "delete from `tiki_friendship_requests` where `userFrom`=? and `userTo`=?";
	$this->query($query, array($user, $friend));
	$this->query($query, array($friend, $user));

	$this->score_event($user,'friend_new',$friend);
	$this->score_event($friend,'friend_new',$user);

	global $cachelib;
	$cachelib->invalidate('friends_count_'.$user);
	$cachelib->invalidate('friends_count_'.$friend);

	return true;
    }

    function refuse_friendship($user, $friend)
    {
	$exists = $this->getOne("select count(*) from `tiki_friendship_requests` where `userTo`=? and `userFrom`=?",
				array($user, $friend));

	if (!$exists)
	    return false;

	$query = "delete from `tiki_friendship_requests` where `userFrom`=? and `userTo`=?";
	$this->query($query, array($user, $friend));
	$this->query($query, array($friend, $user));

	return true;
    }

    function list_pending_friendship_requests($user)
    {

	$query = "select * from `tiki_friendship_requests` where `userTo`=? order by tstamp";
	$result = $this->query($query, array($user));

	$requests = array();
	while ($res = $result->fetchRow(DB_FETCHMODE_ASSOC)) {
	    $requests[$res['userFrom']] = $res['tstamp'];
	}

	return $requests;
    }

    function list_waiting_friendship_requests($user)
    {
	$query = "select * from `tiki_friendship_requests` where `userFrom`=? order by tstamp";
	$result = $this->query($query, array($user));

	$requests = array();
	while ($res = $result->fetchRow(DB_FETCHMODE_ASSOC)) {
	    $requests[$res['userTo']] = $res['tstamp'];
	}

	return $requests;
    }



    function break_friendship($user, $friend)
    {

	$query = "delete from `tiki_friends` where `user`=? and `friend`=?";
	$this->query($query, array($user, $friend));
	$this->query($query, array($friend, $user));

	global $cachelib;
	$cachelib->invalidate('friends_count_'.$user);
	$cachelib->invalidate('friends_count_'.$friend);
    }

  
		// Case-sensitivity regression only. used for patching
	function get_object_case_permissions($objectId, $objectType) {
		$query = "select `groupName`, `permName` from `users_objectpermissions` where `objectId` = ? and `objectType` = ?";
		$result = $this->query($query, array(md5($objectType . $objectId),$objectType));
		$ret = array();
		while ($res = $result->fetchRow()) {
			$ret[] = $res;
		}
		return $ret;
	}

	function object_has_one_case_permission($objectId, $objectType) {
		$query = "select count(*) from `users_objectpermissions` where `objectId`=? and `objectType`=?";
		$result = $this->getOne($query, array( md5($objectType . $objectId), $objectType));
		return $result;
	}

	function remove_object_case_permission($groupName, $objectId, $objectType, $permName) {
		$query = "delete from `users_objectpermissions` where `groupName` = ? and `objectId` = ?  and `objectType` = ? and `permName` = ?";
		$result = $this->query($query, array($groupName, md5($objectType . $objectId), $objectType, $permName));
		return true;
	}

	function get_permissions_types() {
		$query = "select `type` from `users_permissions` group by `type`";
		$result = $this->query($query,array());
		$ret = array();
		while ($res = $result->fetchRow()) { $ret[] = $res['type']; }
		return $ret;									
	}
	function send_validation_email($name, $apass, $email, $again='') {
		global $tikilib, $validateRegistration, $validateUsers, $sender_email, $smarty, $contact_user;
		$foo = parse_url($_SERVER['REQUEST_URI']);
		$foo1 = str_replace('tiki-register', 'tiki-login_validate',$foo['path']);
		$foo1 = str_replace('tiki-remind_password', 'tiki-login_validate',$foo1);
		$machine = $tikilib->httpPrefix().$foo1;
		$smarty->assign('mail_machine',$machine);
		$smarty->assign('mail_site', $_SERVER['SERVER_NAME']);
		$smarty->assign('mail_user', $name);
		$smarty->assign('mail_apass', $apass);
		$smarty->assign('mail_email', $email);
		$smarty->assign('mail_again', $again);
		include_once('lib/webmail/tikimaillib.php');
		if ($validateRegistration == 'y') {
			$mail_data = $smarty->fetch('mail/moderate_validation_mail.tpl');
			$mail_subject = $smarty->fetch('mail/moderate_validation_mail_subject.tpl');
			if ($sender_email == NULL or !$sender_email) {
				if ($feature_messages != 'y') {
        				$smarty->assign('msg', tra("The registration mail can't be sent because there is no server email address set, and this feature is disabled").": feature_messages");
        				return false;
				}
				include_once('lib/messu/messulib.php');
				$messulib->post_message($contact_user, $contact_user, $contact_user, '', $mail_subject, $mail_data, 5);
				$smarty->assign('msg',$smarty->fetch('mail/user_admin_validation_msg.tpl'));
			} else {
				$mail = new TikiMail();
				$mail->setText($mail_data);
				$mail->setSubject($mail_subject);
				if (!$mail->send(array($sender_email))) {
					$smarty->assign('msg', tra("The registration mail can't be sent. Contact the administrator"));
					return false;
				} elseif (empty($again)) {
					$smarty->assign('msg', $smarty->fetch('mail/user_validation_waiting_msg.tpl'));
				} else {
					$smarty->assign('msg', tra('The administrator has not yet validated your account. Please wait.'));
				}
			}
		} elseif ($validateUsers == 'y') {
			$mail_data = $smarty->fetch('mail/user_validation_mail.tpl');
			$mail = new TikiMail();
			$mail->setText($mail_data);
			$mail_data = $smarty->fetch('mail/user_validation_mail_subject.tpl');
			$mail->setSubject($mail_data);
			if (!$mail->send(array($email))) {
				$smarty->assign('msg', tra("The registration mail can't be sent. Contact the administrator"));
				return false;
			} elseif (empty($again)) {
				$smarty->assign('msg',$smarty->fetch('mail/user_validation_msg.tpl'));
			} else {
				$smarty->assign('msg', tra('You must validate your account first. An email has been sent to you'));
			}
		}
		return true;
	}

}

?>
