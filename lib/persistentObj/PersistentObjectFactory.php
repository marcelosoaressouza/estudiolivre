<?php
/*
 * Created on Apr 4, 2007
 *
 * by: nano/rodrigo
 * builds PersistentObjects
 * this is necessary to permit a call to construct an abstract superclass
 * and get the actual instanciated subclass  
 */
 
class PersistentObjectFactory {
	
	function PersistentObjectFactory() {
		trigger_error("Static class! Should not be instanciated.", E_USER_ERROR);
	}
	
	function createObject($class, $fields, $referenced = false) {
		require_once($class . ".php");
		$tableName = strtolower($class);
		if (is_int($fields)) {
			global $dbConnection;
		    $result = $dbConnection->query("select * from $tableName where id = ?", array($fields));
		    $row = $result->fetchRow();
		    if (isset($row['actualClass'])) {
		    	$class = $row['actualClass'];
		    	require_once($class . ".php");
		    }
		    $obj = new $class($fields, $referenced);
		}
		return $obj;
		
	}
	
}

?>
