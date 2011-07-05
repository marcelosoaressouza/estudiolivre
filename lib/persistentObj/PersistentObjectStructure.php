<?php

// Abstract class

class PersistentObjectStructure {

    // Gets a list of $fields, a table/class, and returns a hash containing
    // parts of $fields distributed to correct tables in $table => $fields pairs.
    function _splitFields($fields, $table = false) {

	if (!$table) $table = $this->table;
	
	$struct = array();

	$super = strtolower(get_parent_class($table));
	
	$parentProperties = get_class_vars($super);
	if (isset($fields["id"])) unset($parentProperties["id"]);
	$parentFields = $this->__array_intersect_key($fields, $parentProperties);
	$localFields = $this->__array_diff_key($fields, $parentProperties);

	$struct[$table] = $localFields;

	if (!preg_match("/persistentobject/", $super)) {
	    // Order here is important, because final struct must have base classes first
	    // Otherwise in insert we can take the id from a child class and it may conflict with
	    // id of other object with diferent class
	    $struct = array_merge($this->_splitFields($parentFields, $super), $struct);
	}

	return $struct;
    }

    // Returns a list of classes that this one belongs to (this class and all its parents)
    function _getClasses() {
	$classes = array();
	$class = $this->table;
	while (!preg_match('/persistentobject/i', $class) && strlen($class) > 0) {
	    $classes[] = $class;
	    $class = get_parent_class($class);
	}

	return $classes;	
    }

    // PHP4 hack
    function __array_diff_key($a1, $a2) {
	$diff = array();
	foreach ($a1 as $key => $value) {
	    if (!array_key_exists($key, $a2)) {
		$diff[$key] = $value;
	    }
	}
	return $diff;
    }
    
    // PHP4 hack
    function __array_intersect_key($a1, $a2) {
	$diff = array();
	foreach ($a1 as $key => $value) {
	    if (array_key_exists($key, $a2)) {
		$diff[$key] = $value;
	    }
	}
	return $diff;
    }

	function getOne($query, $bindvals = array()) {
		global $dbConnection;
	    return $dbConnection->getOne($query, $bindvals);
	}

}

