<?php
/*
 * Created on 11/12/2006
 *
 * by nano: Class that stores comments for publications and filereferences
 * 
 */

require_once "lib/persistentObj/PersistentObject.php";

class Comment extends PersistentObject {
	
	var $user;
	var $comment;
	var $date;
	
	var $belongsTo = array("Publication");
	var $publicationId;
	
	function Comment($fields, $referenced = false) {
		parent::PersistentObject($fields, $referenced);
		if (!$this->date) {
			$this->update(array("date" => time()));
		}
	}
	
}

?>
