<?php
/*
 * Created on 30/11/2006
 *
 * by: nano
 * License is the class who handles licenses of publications
 * OneToMany relation with publication
 * 
 */

require_once "lib/persistentObj/PersistentObject.php";

class License extends PersistentObject {
	
	var $type;
	var $name;
	var $description;
	var $imageName;
	var $humanReadableLink;
	var $answer;

	var $hasMany = array("Publication" => "License");
	var $publications = array();
}

?>
