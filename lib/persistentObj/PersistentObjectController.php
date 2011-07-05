<?php
/*
 * Created on 30/11/2006
 *
 * by: nano (thenano@gmail.com)
 * 
 * 
 */

require_once ('PersistentObjectFactory.php');
require_once ('PersistentObjectStructure.php');

class PersistentObjectController extends PersistentObjectStructure {
	
	var $controlledClass;
	var $table;
	
	function PersistentObjectController($class) {
		@include_once($class . ".php");
		if (!class_exists($class)) trigger_error("Incorrect parameter, must provide a valid class.", E_USER_ERROR);
		for ($super = strtolower(get_parent_class($class)); $super; $super = strtolower(get_parent_class($super))) {
			if ($super == 'persistentobject') {
				$pass = true;
				break;
			}	
		}
		if (!$pass) trigger_error("Incorrect parameter, must provide a valid subclass of PersistentObject.", E_USER_ERROR);
		$this->controlledClass = $class;
		$this->table = strtolower($class);

	}
	
	function query($query, $bindvals = array(), $offset = 0, $maxRecords = -1, $sortMode = false) {
		global $dbConnection;
		if ($sortMode) {
			$query .= " order by " . preg_replace("/\_/", " ", $sortMode);
		}
		if ($maxRecords > 0) {
			$query .= " limit $offset,$maxRecords";
		}
	    return $dbConnection->query($query, $bindvals);
	}
	
	function _prepQueryConditions($fields) {
			$bindvals = array();
			$where = " where 1=1 and ";
			$tables = array();

			$struct = $this->_splitFields($fields);
			foreach ($struct as $table => $fields) {
			    $tables[] = $table;
			    if ($table != $this->table) {
				$where .= " $table.id = $this->table.id and ";
			    }
			    foreach ($fields as $key => $value) {
				if (is_array($value)) {
					$where .= "$table.$key in (";
					if (count($value)) {
						foreach ($value as $param) {
							$where .= "?,";
							if (!is_object($param)) {
							    $bindvals[] = $param;
							} else {
							    $bindvals[] = $param->id;
							}
						}
					} else {
						$where .= "'',";
					}
					$where = substr($where, 0, strlen($where)-1);
					$where .= ") and ";
				} else if (is_object($value)) {
				    $where .= "(";
					foreach ($value->keys as $f) {
						$where .= "$f like ? or ";
						$bindvals[] = "%" . $key . "%";
					}
					$where = substr($where, 0, strlen($where)-4);
					$where .= ") and ";
				} else if (is_bool($value)) {
					if ($value)
						$where .= "$table.$key and ";
					else
						$where .= "!$table.$key and ";
				} else {
					$where .= "$table.$key = ? and "; // coloquei 'like' aqui, pode dar problema? - bgola // acho que sim, pq vc colocou like? tirei.. - nano
					$bindvals[] = $value;
				}
			    }
			}
			$where = substr($where, 0, strlen($where)-5);
			$from = implode(",", $tables);
			return array($from, $where, $bindvals);
	}
	
	function findAll($filters = array(), $offset = 0, $maxRecords = -1, $sortMode = false) {
		$queryParams = $this->_prepQueryConditions($filters);
		return $this->_query2ObjectList("select $this->table.id from " . $queryParams[0] . $queryParams[1], $queryParams[2], $offset, $maxRecords, $sortMode);
	}
    
    function _query2ObjectList($query, $bindvals = array(), $offset = 0, $maxRecords = -1, $sortMode = false) {
	$result = $this->query($query, $bindvals, $offset, $maxRecords, $sortMode);

	if (strtolower(get_class($result)) == 'pear_error') {
	    // TODO debug mode
	    if (false) {
		echo "Error: $query\n<br>\n<br>";
		print_r($bindvals);
	    }
	    exit;
	}
	
	$objs = array();
	while ($row = $result->fetchRow()) {
	    $objs[] = PersistentObjectFactory::createObject($this->controlledClass, (int)$row['id']);
	}
	return $objs;
    }
    
    function findOne($filters = array()) {
		$queryParams = $this->_prepQueryConditions($filters);
		$result = $this->query("select $this->table.id from " . $queryParams[0] . $queryParams[1], $queryParams[2]);
		if ($row = $result->fetchRow()) {
			// agora retorna um objeto e nao a linha do resultado da query - bgola
			return PersistentObjectFactory::createObject($this->controlledClass, (int)$row['id']);
		}
		return false;
    }

	
	function countAll($filters = array()) {
		$queryParams = $this->_prepQueryConditions($filters);
		return $this->getOne("select count($this->table.id) from " . $queryParams[0] . $queryParams[1], $queryParams[2]);
	}
	
	function noStructureFindAll($filters = array(), $offset = 0, $maxRecords = -1, $sortMode = false) {
		$queryParams = $this->_prepQueryConditions($filters);
		$result = $this->query("select * from " . $queryParams[0] . $queryParams[1], $queryParams[2], $offset, $maxRecords, $sortMode);
		$objs = array();
		while ($row = $result->fetchRow()) {
			$objs[] = $row;
		}
		return $objs;
	}

    function getFields($filters = array()) {
	$class = $this->controlledClass;
	$controlObj = new $class('control');
	$fields = $controlObj->fields;
	foreach ($filters as $field => $value) {
	    $fields[$field]->setValue($value);
	}
	return $fields;
    }
	
}

?>