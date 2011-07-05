<?php

class Field {

    var $value;
    var $title;
    var $dbRep;
    var $fieldOpts;

    function Field($field, $title, $fieldOpts = array()) {
	$this->field = $field;
        $this->title = $title;

        $this->fieldOpts = $fieldOpts;
    }

    function setValue($v) {
        $this->value = $v;
    }

    function getTitle() { return $this->title; }
    function getValue() { return $this->value; }
    function getName() { return $this->field; }

    function getWeight() {
	// this method should be implemented by (some) subclasses of Field
        if ($this->isIndexable()) {
	    return $this->fieldOpts['weight'];
	} 
    }

    function getWords() {
        // this method should be implemented by (some) subclasses of Field
        return preg_split("/[\s,.]+/", (string)$this->getValue());
    }

    /*
     * In case $this->getValue is a data structure, subclass must implement 
     * serialized() and unserialize($serialized)
     */
    function serialized() { return $this->getValue(); }
    function unserialize($serialized) { return $serialized; }


    /*
     * boolean _test
     * string $opt
     */
    function _test($opt) {
        return (isset($this->fieldOpts[$opt]) 
		&& $this->fieldOpts[$opt]);
    }

    function isIndexable() { return $this->_test('weight'); }
    function isSuggestedFilter() { return $this->_test('suggestedFilter'); }
    function isSuggestedField() { return $this->_test('suggestedField'); }
    function isVersionable() { return $this->_test('versionable'); }

    function renderView() { return $this->render("view"); }
    function renderEdit() { return $this->render("edit"); }
    function renderFilter() { return $this->render("filter", false); }

    function render($strategy = "view", $renderContainer = true) {
    	global $smarty;

	// If this is an ajax request container is already rendered
	if (isset($_REQUEST['xajax'])) {
	    $renderContainer = false;
	}

	$smarty->assign("value", $this->getValue());
	$smarty->assign("field", $this->field);
	$smarty->assign("title", $this->title);
	$smarty->assign("fieldType", strtolower(get_class($this)));
	foreach ($this->fieldOpts as $key => $value) {
	    $smarty->assign($key, $value);
	}

	$content = $smarty->fetch($this->_getTemplate($strategy));
	if (!$renderContainer) {
	    return $content;
	} else {
	    // This is main request, render container
	    $smarty->assign("content", $content);
	    return $smarty->fetch($this->_getTemplate());
	}
    }

    function _getTemplate($strategy = '') {
    	global $smarty;
	if (!empty($strategy)) {
	    $strategy = "_$strategy";
	}
	$class = strtolower(get_class($this));
	$template = false;
	while (strlen($class) > 0 && (!$template || !file_exists($smarty->template_dir . "/" . $template))) {
		$template = "fields/" . $class . $strategy . ".tpl";
		$class = strtolower(get_parent_class($class));
        }
	if (!file_exists($smarty->template_dir . "/" . $template)) {
	    return $smarty->error("Template $template não encontrado: " . $smarty->template_dir);
	}
	return $template;
    }
}

?>