<?php 
/*
 * Created on 28/11/2006
 *
 * by: lfagundes (lfagundes gmail com)
 * 
 * This is an abstract class (shouldn't be instanciated)
 * for rendering persistentObjects to user using Smarty.
 * 
 *
 */


class RenderablePersistentObject extends PersistentObject {

    function display($strategy = false) {
	echo $this->render($strategy);
	exit;	
    }

    function render($strategy = false, $propertyName = false) {

	if ($propertyName) {
	    $object = $this->$propertyName;
	} else {
	    $object = $this;
	}
	
	if (is_object($object)) {
	    if (!$strategy) $strategy = 'view';

	    // TODO catch error
	    return $object->_renderSelf($strategy);

	} elseif (is_array($object)) {
	    if (!$strategy) $strategy = 'list';
	    $content = '';
	    foreach ($object as $child) {
		$content .= $child->_renderSelf($strategy);
	    }
	    return $content;
	} else {
	    return $this->renderError("$object não é objeto");
	}
    }

    function _renderSelf($strategy) {
	global $smarty;

	$class = $this->getRenderableClass($strategy);

	if ($class) {
	    $template = $this->getTemplate($class, $strategy);
	    $smarty->assign_by_ref($class, $this);
	    return $smarty->fetch($template);
	} else {
	    return "Não há templates para $strategy de " . strtolower(get_class($this));
	}
    }
    
    function getRenderableClass($strategy) {
	$class = strtolower(get_class($this));
	$template = $this->getTemplate($class, $strategy);
	global $smarty;
	while (!file_exists("$smarty->template_dir/" . $template) && !preg_match("/persistentobject/", $class)) {  
	    $class = strtolower(get_parent_class($class));
	    $template = $this->getTemplate($class, $strategy);
	}

	if ($class != $topClass) {
	    return $class;
	} else {
	    return false;
	}
    }

    function getTemplate($class, $strategy) {
	return "components/${class}_$strategy.tpl";
    }

    function renderError($msg) {
	return "<!-- $msg -->";
    }

    // metodo que era da EditablePO
    function getFieldsContent($strategy, $fields) {

	$contentMap = array();

	foreach ($fields as $fieldId) {
	    if (is_object($this->$fieldId)) {
		$contentMap[$fieldId] = $this->$fieldId->render($strategy);
	    } else {
		return error("$fieldId não é objeto");
	    }
	}

	return $contentMap;
    }

}

?>
