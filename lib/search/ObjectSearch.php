<?php

// TODO: "$filters" is not working yet ...
class ObjectSearch {
    function findObjects($words, $filters=array(), $offset=0, $maxRecords=-1) {
	$aWords = preg_split("/[\s,.]+/", $words);
	$conditions = $this->_prepareQueryConditions($aWords, $filters);
	$query = "select idObj, type from _searchindex " . $conditions[0] . "group by idObj"; 
        $result = $this->query($query, $conditions[1]);
	$objs = array();
	
	while ($row = $result->fetchRow()) {
	    $type = $row['type'];
	    $objs[] = new $type((int)$row['idObj']);
	}
	return $objs;
    }

    function query($query, $bindvals = array(), $offset = 0, $maxRecords = -1, $sortMode = false) {
        global $dbConnection;

        if ($sortMode) {
            $query .= " order by " . preg_replace("/\_/", " ", $sortMode);
        } else {
            $query .= " order by sum(weight) desc";
        }
        if ($maxRecords > 0) {
            $query .= " limit $offset,$maxRecords";
        }

        $result = $dbConnection->query($query, $bindvals);
        return $result;
    } 

    function _prepareQueryConditions($bindvals, $filters) {
	$conditions = "where ";
	foreach ($bindvals as $word) {
	    $conditions .= "word like ? OR ";
	}
        $conditions = substr($conditions, 0, -3);
	
	return array($conditions, $bindvals);
    }
    
    function findWords($words=false, $filters=array()) {
	if (!$words) {
	    return array();
	}	
	$aWords = preg_split("/[\s,.]+/", $words);
	foreach($aWords as $index => $word) {
	    $aWords[$index] = $word . "%";
	}
	$conditions = $this->_prepareQueryConditions($aWords, $filters);
	
        $query = "select word from _searchindex " . $conditions[0] . "group by word";   
        $result = $this->query($query, $conditions[1]);
	
	$words_matched = array();
	
	while(($row = $result->fetchRow())) {
	    $words_matched[] = $row['word'];
	}
        return $words_matched;
    }
}

?>
