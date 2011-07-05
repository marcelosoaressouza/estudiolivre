<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

/*
PhpLayers in tikiwiki !

That smarty function is mostly intended to be used in .tpl files
syntax: {phplayers [type=tree|phptree|plain] [id=1] [file=/path/to/menufile]}

*/
function smarty_function_phplayers($params, &$smarty) {
	global $tikilib,$smarty,$feature_phplayers, $wikilib;
	if ($feature_phplayers != 'y') {
	  echo "phplayers are not available on this site";
	} else {
	$smarty->assign('uses_phplayers','y');
	extract($params);

	$types['vert'] = 'layersmenu.inc.php';
        $types['horiz'] = 'layersmenu.inc.php';
	$types['tree'] = 'treemenu.inc.php';
	$types['phptree'] = 'phptreemenu.inc.php';
	$types['plain'] = 'phptreemenu.inc.php';

	$classes['vert'] = 'LayersMenu';
        $classes['horiz'] = 'LayersMenu';
	$classes['tree'] = 'TreeMenu';
	$classes['phptree'] = 'PHPTreeMenu';
	$classes['plain'] = 'PlainMenu';
	
	$struct['vert'] = 'vermenu2';
        $struct['horiz'] = 'hormenu3';
	$struct['tree'] = 'treemenu1';
	$struct['phptree'] = 'treemenu1';
	$struct['plain'] = 'treemenu1';

	$new['vert'] = 'newVerticalMenu';
        $new['horiz'] = 'newHorizontalMenu';
	$new['tree'] = 'newTreeMenu';
	$new['phptree'] = 'newTreeMenu';
	$new['plain'] = 'newTreeMenu';

	if (empty($type)) {
		$type = 'tree';
	}

	include_once ("lib/phplayers/lib/PHPLIB.php");
	include_once ("lib/phplayers_tiki/lib/layersmenu-common.inc.php"); // include Tiki's modified version of that file to keep original intact (luci)
	include_once ("lib/phplayers/lib/layersmenu.inc.php");
	include_once ("lib/phplayers/lib/".$types["$type"]);
	// beware ! that below is a variable class declaration
	$class = $classes["$type"];
	$phplayers = new $class();
	$phplayers->setDirrootCommon("lib/phplayers");
	$phplayers->setLibjsdir("lib/phplayers/libjs/");
	$phplayers->setImgdir("lib/phplayers/images/");
	$phplayers->setImgwww("lib/phplayers/menuimages/");
	$phplayers->setTpldirCommon("lib/phplayers/templates/");
	
	if (!empty($id)) {
		$menu_info = $tikilib->get_menu($id);
		$channels = $tikilib->list_menu_options($id,0,-1,'position_asc','');
		$indented = '';
		$output = '';
		$url = urldecode($_SERVER['REQUEST_URI']);
		global $wikilib; include_once('lib/wiki/wikilib.php');
		$url = str_replace('tiki-editpage.php', 'tiki-index.php', $url);
		$homePage = strtolower($wikilib->get_default_wiki_page());
		if (preg_match('/.*tiki.index.php$/', $url)) {
			$url .= "?page=$homePage";
		} elseif (preg_match('/tiki-index.php/', $url)) {
			$url = strtolower($url);
		}

		$realKey = 0;
		$level = 0;
		foreach ($channels['data'] as $key=>$cd) {
			$cd["name"] = tra($cd["name"]);
			if ($cd['type'] == 'o') {
				$output .= $indented;
			} elseif ($cd['type'] == 's' or $cd['type'] == 'r') {
				$indented = '.';
				$level = 1;
			} elseif ($cd['type'] == '-') {
				$indented = substr($indented, 1);
				--$level;
				continue;
			} else {
				$indented = str_pad('', $cd['type'], '.');
				$level = $cd['type'] + 1;
				$output .= $indented;
				$indented .= '.';
			}
			++$realKey;
			if (!empty($cd['url']) && empty($curOption)) {
				if ($cd['url'] == 'tiki-index.php') {
					$cd['url'] .= "?page=$homePage";
				}
				if (preg_match('/tiki-index.php/', $cd['url'])) {
					$cd['url'] = strtolower($cd['url']);
				}
				if (($pos = strpos($url, $cd['url'])) !== false && ($pos == 0 || $url[$pos -1] == '/' || $url[$pos - 1] == '\\' || $url[$pos-1] == '=')) {
					$last = $pos + strlen($cd['url']);

					if ($last >= strlen($url) || $url['last'] == '#' || $url['last'] == '?' || $url['last'] == '&') {
						$curOption = $realKey;
						if ($cd['type'] != 's' && $cd['type'] != 'r') {
							for ($i = $level - 1; $i >= 0; --$i) {
								$output = str_replace($cur[$i], $cur[$i].'||||1', $output);
							}
						}
					}
				}
			}
			$output.= ".|".$cd["name"]."|".$cd["url"];
			if (empty($curOption) && $cd['type'] != 'o' && $cd['type'] != '-') {
				$cur[$level - 1] = $output;
			}
 			$output .= "\n";
		}
		$phplayers->setMenuStructureString($output);
	} elseif (!empty($file)) {
		if (is_file($file)) {	
			$phplayers->setMenuStructureFile($file);
		} else {
			$phplayers->setMenuStructureFile("lib/phplayers/layersmenu-vertical-2.txt");
		}
	}

	$phplayers->parseStructureForMenu($struct["$type"]);
	if (!empty($curOption))
		$phplayers->setSelectedItemByCount($struct[$type], $curOption);
	if ($type == 'vert') {
		$phplayers->setDownArrowImg("down-galaxy.png");
		$phplayers->setForwardArrowImg("forward-galaxy.png");
		$phplayers->setVerticalMenuTpl("layersmenu-vertical_menu-galaxy.ihtml");
		$phplayers->setSubMenuTpl("layersmenu-sub_menu-galaxy.ihtml");
		$phplayers->$new["$type"]($struct["$type"]);
		$phplayers->printHeader();
		$phplayers->printMenu($struct["$type"]);
		$phplayers->printFooter();
	} elseif ($type == 'horiz') {
		$phplayers->setDownArrowImg("down-galaxy.png");
		$phplayers->setForwardArrowImg("forward-galaxy.png");
		$phplayers->setHorizontalMenuTpl("layersmenu-horizontal_menu.ihtml");
		$phplayers->setSubMenuTpl("layersmenu-sub_menu-galaxy.ihtml");
		$phplayers->$new["$type"]($struct["$type"]);
		$phplayers->printHeader();
		$phplayers->printMenu($struct["$type"]);
		$phplayers->printFooter();
	} else {
		echo $phplayers->$new["$type"]($struct["$type"]);
	}
	}
}
?>
