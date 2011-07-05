<?

// Será q essa classe faz sentido? talvez baste o histórico... vamos ver

// Ela não pode extender DateField ? bgola
class LastModifField extends Field {

    function LastModifField($field = "lastModif", $title = "Última modificação", $fieldOpts = array()) {
	parent::Field($field, $title, $fieldOpts);
    }

}

?>
