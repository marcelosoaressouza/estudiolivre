<?php

class EmailField extends StringField {
    
    function EmailField($field = "email", $title = "E-mail", $fieldOpts = array()) {
	parent::StringField($field, $title, $fieldOpts);
    }

    function getMD5() {
	return md5($this->getValue());
    }
}

?>
