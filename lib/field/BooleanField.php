<?

class BooleanField extends Field {

    var $dbRep = "bool";	
	
    function setValue($v) {
	parent::setValue((boolean)$v);
    }
}

?>
