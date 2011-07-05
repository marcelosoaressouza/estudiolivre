<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

class ElTagLib extends FreetagLib {

    var $_normalized_valid_chars = '[^,]';

    function _parse_tag($tag_string) {
	if(get_magic_quotes_gpc()) {
	    $query = stripslashes(trim($tag_string));
	} else {
	    $query = trim($tag_string);
	}

	$words = preg_split('/\s*,\s*/', $query,-1,PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);
	$delim = 0;
	$newwords = array();
	foreach ($words as $key => $word) {
		$word = preg_replace('/\s+/',' ',$word);
		$word = preg_replace('/^\s|\s$/','',$word);
	    $newwords[] = $word;
	}

	return $newwords;
    }

	function get_distinct_tag_suggestion($exclude = '', $offset = 0, $maxRecords = -1) {
	
		$query = "select distinct(t.tag), t.tagId from `tiki_freetags` t, `tiki_freetagged_objects` o, `tiki_objects` tko where t.`tagId`=o.`tagId` and o.`objectId`=tko.`objectId` order by hits desc";
		$result = $this->query($query, array(), $maxRecords, $offset);
	
		$tags = array();
		$index = array();
		while ($row = $result->fetchRow()) {
		    $tag = $row['tag'];
		    if (!isset($index[$tag]) && !preg_match("/$tag/",$exclude)) {
				$tags[] = $tag;
				$index[$tag] = 1;
		    }
		}
	
		return $tags;
	}
	
	function count_distinct_tags($user = '') {
	    
		$bindvals = array();
	
		if (isset($user) && (!empty($user))) {
		    $mid = "AND `user` = ?"; 
		    $bindvals[] = $user;
		} else {
		    $mid = "";
		}
		    
		$query = "select count(distinct(t.`tagId`)) from `tiki_freetags` t, `tiki_freetagged_objects` o where o.`tagId` = t.`tagId`	$mid";
	
		return $this->getOne($query, $bindvals);

    }
    
    //TODO: move to objectlib
    function delete_object($type, $itemId) {
    	$objId = $this->getOne("select `objectId` from `tiki_objects` where `type`=? and `itemId`=?", array($type, $itemId));
    	if (!$objId) {
    		return false;
    	}
    	
    	$bindvals = array($objId);
    	$this->query("delete from `tiki_objects` where `objectId`=?", $bindvals);
    	$this->query("delete from `tiki_categorized_objects` where `catObjectId`=?", $bindvals);
    	$this->query("delete from `tiki_category_objects` where `catObjectId`=?", $bindvals);
    	$this->query("delete from `tiki_freetagged_objects` where `objectId`=?", $bindvals);
    	
    	return true;
    
    }

	function get_objects_with_tag_union($tagArray, $type = '', $user = '', $offset = 0, $maxRecords = -1) {
	
		if (!isset($tagArray) || !is_array($tagArray)) {
		    return false;
		}
		
		if (count($tagArray) == 0) {
		    return array('data' => array(),
				 'cant' => 0);
		}
		
		$bindvals = $tagArray;
		
		$mid = '';
		
		if (isset($user) && !empty($user)) {
		    $mid = "AND `user` = ?";
		    $bindvals[] = $user;
		}
		
		if (isset($type) && !empty($type)) {
		    $mid .= " AND `type` = ?";
		    $bindvals[] = $type;
		}
		
		$tag_sql = "?";
		for ($i=1; $i<count($tagArray); $i++) { $tag_sql .= ",?"; }
		
		// We must adjust for duplicate normalized tags appearing multiple times in the join by 
		// counting only the distinct tags. It should also work for an individual user.
		
		$query = "SELECT o.*, t.`tag`";
		
		$query_end = "
				FROM `tiki_objects` o,
					 `tiki_freetagged_objects` fto,
				     `tiki_freetags` t
				WHERE t.`tag` IN ($tag_sql) AND
	                              fto.`tagId` = t.`tagId` AND
	                              fto.`objectId` = o.`objectId`                              
	                        $mid";
		
		$query .= $query_end . " GROUP BY o.`objectId`";
		$query_cant = "SELECT COUNT(DISTINCT o.`objectId`) " . $query_end;
		
		$result = $this->query($query, $bindvals, $maxRecords, $offset);
		
		$ret = array();
		while ($row = $result->fetchRow()) {
		    $ret[] = $row;
		}
		
		$cant = $this->getOne($query_cant, $bindvals);
		
		return array('data' => $ret,
			     'cant' => $cant);
    }

}

global $dbTiki;
$freetaglib = new FreetagLib($dbTiki);

?>
