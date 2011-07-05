<?php

// This will probably get obsolete with gravatar.com

class ThumbField extends Field {

    var $dbRep;
    var $default = 'default.gif';

    function ThumbField($field = 'thumb', $title = 'Foto', $dir = 'img/thumb', $fieldOpts = array()) {
	$this->imgDir = preg_replace("/\/?$/","/",$dir);

	parent::Field($field, $title, $fieldOpts);
    }

    function setValue($path) {
	if (!file_exists($this->imgDir . $path)) {
	    $path = $this->default;
	}
	parent::setValue($path);
    }

    function getValue() {
	return $this->imgDir . parent::getValue();
    }

}

?>