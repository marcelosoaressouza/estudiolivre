<?php
// $Header: /cvsroot/tikiwiki/tiki/lib/wiki-plugins/wikiplugin_trackerfilter.php,v 1.1.2.13 2007/09/02 15:23:17 sylvieg Exp $
function wikiplugin_trackerfilter_help() {
  $help = tra("Filters the items of a tracker, fields are indicated with numeric ids.").":\n";
  $help .= "~np~{TRACKERFILTER(filters=>2/d:4/r:5,action=>Name of submit button,TRACKERLIST_params )}Notice{TRACKERFILTER}~/np~";
  return $help;
}
function wikiplugin_trackerfilter($data, $params) {
	global $smarty;
	global $trklib; include_once('lib/trackers/trackerlib.php');
	extract($params, EXTR_SKIP);
	$dataRes = '';
	if (isset($_REQUEST['msgTrackerFilter'])) 
		$smarty->assign('msgTrackerFilter', $_REQUEST['msgTrackerFilter']);
	if (isset($_REQUEST['filter']) || isset($_REQUEST['tr_offset']) || isset($_REQUEST['tr_sort_mode'])) {
	  
	  if (!isset($fields) && (empty($_REQUEST['trackerId']) || empty($trackerId))) {
			$smarty->assign('msg', tra("missing parameters"));
			return $smarty->fetch("error_simple.tpl");
		}
		foreach ($_REQUEST as $key =>$val) {
			if (substr($key, 0, 2) == 'f_' && $val[0] != '') {
				$ffs[] = substr($key, 2);
				$values[] = $val;
			}
		}
		$params['fields'] = $fields;
		if (empty($params['trackerId'] ))
			$params['trackerId'] = $_REQUEST['trackerId'];
		unset($params['filterfield']); unset($params['filtervalue']);
		if (!empty($ffs)) {
			$params['filterfield'] = $ffs;
			$params['exactvalue'] = $values;
		}
		include_once('lib/wiki-plugins/wikiplugin_trackerlist.php');
		$dataRes .= wikiplugin_trackerlist($data, $params);
		$dataRes .= '<br />';
	} else {
		$data = '';
	}
	if (!isset($filters)) {
		$smarty->assign('msg', tra("missing parameters"));
		return $dataRes.$smarty->fetch("error_simple.tpl");
	}
	$listfields = split(':',$filters);

	$filters = array();
	if (!isset($trackerId))
		$trackerId = 0;
	foreach ($listfields as $f) {
	if (strchr($f, '/')) {
		list($fieldId, $format) = split('/',$f);
 	} else {
 		$fieldId = $f;
		$format = 'r'; // radio as default
	}
	$field = $trklib->get_tracker_field($fieldId);
	if ($trackerId) {
		if ($field['trackerId'] != $trackerId) {
			$smarty->assign('msg', tra('All fields must be from the same tracker'));
			return $dataRes.$smarty->fetch('error_simple.tpl');
		}
	} else {
		$trackerId = $field['trackerId'];
	}

	$selected = false;
	switch ($field['type']){
	case 'e': // category
		global $categlib;
		include_once('lib/categories/categlib.php');
		$res = $categlib->get_child_categories($field['options']);
		$opts = array();
		foreach ($res as $opt) {
			$opt['id'] = $opt['categId'];
			if (!empty($_REQUEST['f_'.$fieldId]) && in_array($opt['id'], $_REQUEST['f_'.$fieldId])) {
				$opt['selected'] = 'y';
				$selected = true;
			} else {
				$opt['selected'] = 'n';
			}
			$opts[] = $opt;
		}
		break;
	case 'd': // drop down list
	  $res = array_unique(split(',', $field['options']));
		$opts = array();
		foreach ($res as $val) {
			$opt['id'] = $val;
			$opt['name'] = $val;
			if (!empty($_REQUEST['f_'.$fieldId]) && $_REQUEST['f_'.$fieldId][0] == $val) {
				$opt['selected'] = 'y';
				$selected = true;
			} else {
				$opt['selected'] = 'n';
			}
			$opts[] = $opt;
		}
		break;
	case 'n':case 't': case 'a': case 'm': case 'y':
		if (isset($status))
			$res = $trklib->list_tracker_field_values($fieldId, $status);
		else
			$res = $trklib->list_tracker_field_values($fieldId);
		$opts = array();
		foreach ($res as $val) {
			$opt['id'] = $val;
			$opt['name'] = $val;
			if (!empty($_REQUEST['f_'.$fieldId]) && ($_REQUEST['f_'.$fieldId][0] == $val || in_array($val, $_REQUEST['f_'.$fieldId]))) {
				$opt['selected'] = 'y';
				$selected = true;
			} else {
				$opt['selected'] = 'n';
			}
			$opts[] = $opt;
		}
		break;		
		
	default:
		$smarty->assign('msg', tra("tracker field type not processed yet"));
		return $dataRes.$smarty->fetch("error_simple.tpl");
	}
	if (!isset($action)) {
		$action = 'filter';// tra('filter');
	}
	$smarty->assign('action', $action);
	$filters[] = array('name' => $field['name'], 'fieldId' => $field['fieldId'], 'format'=>$format, 'opts' => $opts, 'selected'=>$selected);
	}
	$smarty->assign('filters', $filters);
	$smarty->assign('trackerId', $trackerId);
	$dataF = $smarty->fetch('wiki-plugins/wikiplugin_trackerfilter.tpl');
	return $data.$dataRes.$dataF;
}
?>
