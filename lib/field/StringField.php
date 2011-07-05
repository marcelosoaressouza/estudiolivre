<?php

class StringField extends Field {

    var $dbRep;

    function StringField($field, $title, $fieldOpts=array()) {
	$size = isset($fieldOpts['size']) ? $fieldOpts['size'] : 255;
	$this->dbRep = "varchar($size)";    
	parent::Field($field, $title, $fieldOpts);
    }

}

?>