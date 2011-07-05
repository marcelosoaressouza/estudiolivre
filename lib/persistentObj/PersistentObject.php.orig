<?php 
/*
 * Created on 28/11/2006
 *
 * by: nano (thenano@gmail.com)
 * 
 * this is an abstract class (shouldn't be instanciated)
 * for class->database persistence.
 * all the subclasses should have a table with the same name as the class,
 * and all the properties for the table rows, except id, wich belongs to 
 * this class. errors are triggered as E_USER_ERROR and should be caught 
 * by the implementing system
 * 
 */

require_once ('PersistentObjectFactory.php');
require_once ('PersistentObjectStructure.php');

/* this is an option to add extraStructure beyond your class hierarchy
 * to ise this, you must create the file bellow in your application
 * in this file you add methods to this class with the name pattern
 * actionExtra, i.e. insertTag. action must be insert, update, delete or select 
 */
@include_once ('PersistentObjectExtra.php');

class PersistentObject extends PersistentObjectStructure {
	
	var $table;
	var $id;
	var $hasMany = array();
	var $belongsTo = array();
	var $hasManyAndBelongsTo = array();
	var $peerFields = array();
	var $extraStructure = array();
	var $fields = array();
    var $properties = array();

	
	/* This is the base constructor for the framework. it relies on the 
	 * basis that if you send an id, you want to retrieve, and if you send 
	 * fields, you want to insert a new entry. modification is done by retrieving
	 * and then modifying.
	 * The second parameter serves the purpose of stopping infinite loops when selecting
	 * objects with 1 <-> N or N <-> N (not yet implemented) relations
	 */
	function PersistentObject($fields, $referenced = false) { 

	    $this->setup();
	    
	    $this->table = strtolower(get_class($this));
	    if (is_array($fields)) {
	    	if (count($fields)) {
	    		if (isset($this->actualClass))
			    	$fields['actualClass'] = get_class($this);
		    	$this->_populateObject($fields);
		    	$this->id = $this->insert($fields);
	    		$this->_insertIndex();
			$this->_extraStructure('insert');
	    	} else trigger_error("Incorrect parameters, need array with at least one field to create object", E_USER_ERROR);
	    } elseif (is_int($fields)) {
	    	$this->id = $fields;
	    	$this->select($referenced);
	    } elseif ((string)$fields == "control") {
		    // do nothing, this is a control object just to access the field objects
	    } else trigger_error("Incorrect parameters, need array or integer of 'id' to fetch", E_USER_ERROR); 
	    return $this;
	}

    /*
     * hash getFields
     */
    function getFields() {
	return $this->fields;
    }

    function setup() {
	// Should be implemented by subclasses

	$vars = get_class_vars(get_class($this));
	foreach ($vars as $var => $value) {
	    if (is_object($this->$var) && preg_match('/field/i', get_class($this->$var))) {
		$this->fields[$var] = $this->$var;
	    }
	    $this->properties[$var] = 1;
	}
    }

    // Checks if this class has a property
    function has($property) {
	return isset($this->properties[$property]);
    }

    function load($property) {
	$methods = array('_getParent','_getChildren', '_getPeers');
	for ($i=0; $i < sizeof($methods) && !isset($this->$property); $i++) {
	    $method = $methods[$i];
	    $this->$method($property);
	}

	return $this->$property;
    }

    function _getValue($value) {
	if (is_object($value)) {
	    return $value->getValue();
	} else {
	    return $value;
	}
    }

    function _setValue($key, &$value) {
	if (isset($this->$key) && is_object($this->$key)) {
	    $this->$key->setValue($value);
	} else {
	    $this->$key = $value;
	}
    }

	function _populateObject($fields) {
		$errors = "";
		foreach ($fields as $key => $value) {
			$errors .= $this->_checkField($key, $value);
			$this->_setValue($key, $value);
		}
		return $errors;
	}
	
	function query($query, $bindvals = array()) {
		global $dbConnection;
		foreach ($bindvals as $key => $value) {
		    $bindVals[$key] = $this->_getValue($value);
		}
		return $dbConnection->query($query, $bindvals);
	}
		
	// this does not check anything, an actual method 
	// per field must be implemented in subclasses
	// the check methods should trigger E_USER_ERROR
	function _checkField($name, $value) {
		$methodName = "checkField_" . $name;
	  	if (method_exists($this, $methodName)) {
	  		return $this->$methodName($value);
	  	}
	}
	
	// builds the insertion values and cuts out the last ","
	function _prepInsertQuery($fields, $table) {
		if (count($fields)) {
			$query = "insert into $table (";
			$queryVals = "values(";
			foreach ($fields as $key => $value) {
				$query .= "$key,";
				$queryVals .= "?,";
			}
			$query = substr($query, 0, strlen($query)-1);
			$queryVals = substr($queryVals, 0, strlen($queryVals)-1);
			$query .= ") ";
			$queryVals .= ")";
			return $query . $queryVals;
		} else {
			return "insert into $table () values()";
		}
	}
	
	function _prepQueryConditions($fields) {
		if (count($fields)) {
			$query = "where ";
			foreach ($fields as $key => $value) {
				$query .= "$key = ? and ";
			}
			$query = substr($query, 0, strlen($query)-5);
			return $query;
		}
	}
	
	function insert($fields, $table = false) {
	    $fieldStructure = $this->_splitFields($fields, $table);

	    $id = 0;

	    foreach ($fieldStructure as $table => $fields) {
		if ($id) {
		    $fields['id'] = $id;
		}
		$this->query($this->_prepInsertQuery($fields, $table), $fields);
		if (!$id) {
		    $id = (int)$this->getOne("select max(id) from $table " . $this->_prepQueryConditions($fields), $fields);
		}
	    }
	    
	    
	    return $id;
	}
    
	function update($fields, $user = false) {
		$changes = $this->_getChanges($fields);
		$errors = $this->_populateObject($fields);
		if ($errors) return $errors;
		$this->_doUpdate($fields);	
		$this->_extraStructure('update', $fields);
		$this->_updateIndex();
		if ($user) {
		    $this->_registerTransaction($changes, $user);
		}
		return $fields;
	}
	
	function _doUpdate($fields, $table = false) {
	    $fieldStructure = $this->_splitFields($fields, $table);
	    foreach ($fieldStructure as $table => $fields) {
		if (count($fields)) {
		    $this->_updateLevel($fields, $table);
		}
	    }
	}
	
	function _updateLevel($fields, $table) {
		$query = "update $table set ";
		foreach ($fields as $key => $value) {
		    if (!isset($this->peerFields[$key])) {
			$query .= "$key = ?,";
		    } else {
			unset($fields[$key]);
			$this->_commitRelations($key);
		    }
		}
		if (!sizeof($fields)) return;
		$query = substr($query, 0, strlen($query)-1);
		$query .= " where id = ?";
		$fields[] = $this->id;
		$this->query($query, $fields);
	}
		
	function delete() {
		$this->query("delete from $this->table where id = ?", array($this->id));
		for ($table = strtolower(get_parent_class($this->table)); !preg_match('/persistentobject/', $table); $table = strtolower(get_parent_class($table))) {
			$this->query("delete from $table where id = ?", array($this->id));
		}
		$this->_deleteRelations();
		$this->_extraStructure('delete');
		$this->_deleteIndex();
	}
	
	// deletes 1 to N and N to N relations
	function _deleteRelations() {
		foreach ($this->hasMany as $child => $me) {
			$varName = strtolower($child) . "s";
			foreach ($this->$varName as $child)
				$child->delete();
		}
		foreach ($this->hasManyAndBelongsTo as $peer => $me) {
			$myName = strtolower($me);
			$peerName = strtolower($peer);
			if ($peerName < $myName) $tableName = $peerName . "_" .  $myName;
			else $tableName = $myName . "_" .  $peerName;
			$this->query("delete from $tableName where ${myName}Id = ?", array($this->id));
		}
	}


    /* Search related functions */
    	
    function _insertIndex() {
        foreach($this->fields as $field) {
            if (is_object($field)) {
                if ($field->isIndexable()) {   
                    $weight = $field->getWeight();
		    $words = $field->getWords();
		    foreach ($words as $word) {
			// its as a word only if it's lenght > 2 :)
			if (strlen($word) > 2){
			    $this->_indexWord($word, $weight);
                        }
                    }
                } 
            }
        }
    }

    function _updateIndex() {
        $this->_deleteIndex();
        $this->_insertIndex();
    }

    function _deleteIndex() {
        $result = $this->query('delete from _searchindex where idObj = ?', array($this->id));
    }

    function _indexWord($word, $weight) {
        $actualWeight = $this->_getWordWeight($word);
	if ($actualWeight > 0) {
	    $weight += $actualWeight;
	    $this->query("update _searchindex set weight = ? where idObj = ? and word = ?", array($weight, $this->id, $word));
	} else {   
	    $values = array($this->id, get_class($this), $word, $weight);
	    $this->query("insert into _searchindex (idObj, type, word, weight) values (?, ?, ?, ?)", $values);
        }	
    }

    function _getWordWeight($word) {
        $result = $this->query('select weight from _searchindex where idObj = ? and word = ?', array($this->id, $word));
	if (preg_match('/error/i', get_class($result))) {
		return 0;
	}
	$row = $result->fetchrow();
	$weight = $row['weight'];
        return $weight;
    }

    /* 
     * Functions related to versioning 
     * 
     * If object contains versionable fields, (verified by Field::isVersionable()),
     * then on every edition it will be checked for a change, and old and new values
     * will be saved in table _updatehistory
     *
     */

    function _getChanges($fields) {
	$changes = array();
        foreach($fields as $field => $newValue) {
            if (is_object($this->$field) && $this->$field->isVersionable()) {
		$oldValue = $this->$field->serialized();
		if ($newValue != $oldValue) {
		    $changes[$field] = array('old' => $oldValue,
					     'new' => $newValue);
		}
            }
        }
	return $changes;
    }

    function _registerTransaction($changes, $responsibleObj) {
	if (sizeof($changes) > 0) {
	    $this->query("insert into _updatehistory (objType, objId, tstamp, version, responsibleType, responsibleId, title, changes) values (?,?,?,?,?,?,?,?)",
			 array(get_class($this), 
			       $this->id, 
			       time(), 
			       $this->getVersion(), 
			       get_class($responsibleObj), 
			       $responsibleObj->id,
			       $this->_makeTransactionTitle($changes),
			       serialize($changes)));

	    $this->_version++;
	}
	
    }

    function _makeTransactionTitle($changed) {
	return implode(', ', array_keys($changed));
    }

    function getVersion() {

	if (isset($this->_version)) return $this->_version;
	    
	$version = $this->getOne("select max(version) from _updatehistory where objType=? and objId=?",
				 array(get_class($this), $this->id));
	if (!$version) $version = 0;

	return $this->_version = $version + 1;
    }

    function rollback($version, $user) {
	$type = get_class($this);
	$id = $this->id;
	$result = $this->query("select * from _updatehistory where objType=? and objId=? and version=?",
			       array($type, $id, $version));
	if (!$row = $result->fetchRow())
	    trigger_error("There's no version $version for $type $id");

	$changes = unserialize($row['changes']);
	$fields = array();
	foreach ($changes as $field => $changed) {
	    $fields[$field] = $changed['old'];
	}

	$this->update($fields, $user);
    }


	function select($referenced = false) {
		$tables = "$this->table";
		$conditions = "where "; 
		for ($table = strtolower(get_parent_class($this)); !preg_match("/persistentobject/", $table); $table = strtolower(get_parent_class($table))) {
			$tables .= ",$table";
			$conditions .= "$this->table.id = $table.id and ";
		}
		$conditions .= "$this->table.id = ?";
		$result = $this->query("select * from $tables $conditions", array($this->id));
		if ($row = $result->fetchRow()) $this->_populateObject($row);
		else trigger_error("Incorrect parameters, id $this->id doesn't exist in $this->table", E_USER_ERROR);
		if (!$referenced) {
			$this->_getParent();
			$this->_getPeers();
			$this->_getChildren();
		}
		$this->_extraStructure('select');
	}
	
	/* Populates the "1" side of a 1 to N relation
	 * note that the superclass wich corresponds to the "1" side
	 * will not be instanciated, only the subclasses will
	 */
	function _getParent($type = false) {
		foreach ($this->belongsTo as $parent) {
		    $varName = strtolower($parent);
		    if (!$type || $varName == strtolower($type)) {
				$idName = $varName . "Id";
				if (isset($this->$idName) && (int)$this->$idName) {
				    $this->_setValue($varName, PersistentObjectFactory::createObject($parent, (int)$this->$idName, true));
				}
		    }
		}
	}
	
	/* Populates the "N" side of a 1 to N relation
	 * note that the superclass wich corresponds to the "N" side
	 * will not be instanciated, only the subclasses will
	 */
	function _getChildren($type = false) {
		foreach ($this->hasMany as $child => $parent) {
		    $childName = strtolower($child);
		    if (!$type || $childName == strtolower($type)) {
				require_once($child . ".php");
				$idName = strtolower($parent) . "Id";
				$result = $this->query("select id from $childName where $idName = ?", array($this->id));
				$children = array();
				while ($row = $result->fetchRow()) {
					array_push($children, PersistentObjectFactory::createObject($child, (int)$row['id'], true));
				}
				$this->_setValue($childName . "s", $children);
		    }
		}
	}
	
	/* populates "N" to "N" relations
	 */
	function _getPeers($type = false) {
		foreach ($this->hasManyAndBelongsTo as $peer => $me) {
		    $peerName = strtolower($peer);
		    if (!$type || $peerName == strtolower($type)) {
				require_once($peer . ".php");
				$myName = strtolower($me);
				$tableName = $this->_getRelationTable($peerName, $myName);
				$result = $this->query("select ${peerName}Id as id from $tableName where ${myName}Id = ?", array($this->id));
				$peers = array();
				while ($row = $result->fetchRow()) {
					if (isset($row['actualClass'])) $actualClass = $row['actualClass'];
					else $actualClass = $peer;
					array_push($peers, new $actualClass((int)$row['id'], true));
				}
	
				$varName = $peerName . "s";
				$this->_setValue($varName, $peers);
				$this->peerFields[$varName] = $myName;
		    }
		}
	}

    

	/*
         * Check a list of peers and update relations in database
	 */
	function _commitRelations($key) {
	    $peers = $this->_getValue($this->$key);
	    if (is_array($peers)) {
		$peerName = preg_replace('/s$/','',$key);
		$myName = $this->peerFields[$key];
		$relTable = $this->_getRelationTable($peerName, $myName);
		$this->query("delete from $relTable where ${myName}Id = ?", array($this->id));

		foreach ($peers as $peerObj) {
		    $this->query("INSERT INTO $relTable (${myName}Id, ${peerName}Id) VALUES (?,?)",
				 array($this->id, $peerObj->id));
		}

		/*
                 * In case peer class has the "popularity" property, let's recalculate it.
		 * This property is an index of relation count.
		 * By now don't support many n-n relations
                 *
		 * TODO: diff old and new peer list and just update popularity as necessary,
                 *       to be more efficient and support many kinds of peers
                 */
		if ($this->has('popularity')) {
		    $this->query("update `${peerName}` p set `popularity`=(select count(*) from `$relTable` where `${peerName}Id`=p.`id`");
		}
	    }
	}

	function _getRelationTable($peerName, $myName) {
	    if ($peerName < $myName) 
		return $peerName . "_" .  $myName;
	    else return $myName . "_" .  $peerName;
	}

	function _extraStructure($action, $fields = false) {
		foreach($this->extraStructure as $structure) {
			$methodName = $action . $structure;
			if (class_exists("PersistentObjectExtra")) {
				if (is_array($fields)) PersistentObjectExtra::$methodName($this, $fields);
				else PersistentObjectExtra::$methodName($this);
			}
		}
	}
	
}

?>
