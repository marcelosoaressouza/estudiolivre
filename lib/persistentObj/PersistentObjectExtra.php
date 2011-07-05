<?php
/*
 * Created on Apr 2, 2007
 *
 * by: nano/rodrigo
 * 
 * specific estudiolivre implementation of extra structure for the
 * persistentObject framework
 */
 
class PersistentObjectExtra {
	
	function insertTikiTags(&$obj) {
		$obj->query("insert into `tiki_objects` (`type`, `itemId`, `name`, `description`, `href`, `created`) values (?,?,?,?,?,?)",
		             array($obj->tagType, $obj->id, '', '', 'el-gallery_view.php?id=' . $obj->id, time()));
	}
	
	function deleteTikiTags(&$obj) {
		$bindvals = array($obj->tagType, $obj->id);
		$obj->query("delete from tiki_freetagged_objects where objectId=(select objectId from tiki_objects where type=? and itemId=?)", $bindvals);
		$obj->query("delete from tiki_categorized_objects where catObjectId=(select objectId from tiki_objects where type=? and itemId=?)", $bindvals);
		$obj->query("delete from tiki_category_objects where catObjectId=(select objectId from tiki_objects where type=? and itemId=?)", $bindvals);
		$obj->query("delete from tiki_objects where type=? and itemId=?", $bindvals);
	}
	
	function selectTikiTags(&$obj) {
		$obj->tags = array();
		$result = $obj->query("select t.tagId, t.tag, tf.user from tiki_freetags t, tiki_freetagged_objects tf, tiki_objects tob where t.tagId = tf.tagId and tf.objectId = tob.objectId and tob.itemId = ? and tob.type = ?;", array($obj->id,$obj->tagType));
		while ($row = $result->fetchRow()) {
			$obj->tags[] = $row;
		}
	}

	function updateTikiTags(&$obj, $fields) {
		$query = "update `tiki_objects` set ";
		$bindvals = array();
		if (isset($fields['title'])) {
	    	$query .= "`name`=? and ";
	    	$bindvals[] = $fields['title'];
		}
		if (isset($fields['description'])) {
		    $query .= "`description`=? and ";
	    	$bindvals[] = $fields['description'];
		}
		if (count($bindvals)) {
			$query = substr($query, 0, strlen($query)-4);
	    	$query .= "where `itemId`=? and `type`=?";
			$bindvals[] = $obj->id;
			$bindvals[] = $obj->tagType;
			$obj->query($query, $bindvals);			
		}
	}
	
}
 
?>
