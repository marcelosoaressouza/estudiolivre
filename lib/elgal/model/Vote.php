<?php
/*
 * Created on 01/12/2006
 *
 * by: nano
 * 
 * Class that stores the vote for a given user to a given file
 * 
 */

require_once "lib/persistentObj/PersistentObject.php";

class Vote extends PersistentObject {
	
	var $user;
	var $rating;
	var $publicationId;
	
	var $belongsTo = array("Publication");
	
}

?>
