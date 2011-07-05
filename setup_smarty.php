<?php

// $Header: /cvsroot/tikiwiki/tiki/setup_smarty.php,v 1.27.2.11 2007/03/02 13:59:00 luciash Exp $

// Copyright (c) 2002-2007, Luis Argerich, Garland Foster, Eduardo Polidor, et. al.
// All Rights Reserved. See copyright.txt for details and a complete list of authors.
// Licensed under the GNU LESSER GENERAL PUBLIC LICENSE. See license.txt for details.

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== FALSE) {
  header("location: index.php");
  exit;
	die();
}

// uncomment and adapt the following line if you use smarty external to tiki
// define('SMARTY_DIR', 'lib/smarty/');

require_once ( 'lib/smarty/libs/Smarty.class.php');

class Smarty_Tikiwiki extends Smarty {
	
	function Smarty_Tikiwiki($tikidomain = "") {
		if ($tikidomain) { $tikidomain.= '/'; }
		$this->template_dir = 'templates/';
		$this->compile_dir = "templates_c/$tikidomain";
		$this->config_dir = "configs/";
		$this->cache_dir = "templates_c/$tikidomain";
		$this->caching = 0;
		$this->assign('app_name', 'Tikiwiki');
		$this->plugins_dir = array(	// the directory order must be like this to overload a plugin
			dirname(dirname(SMARTY_DIR))."/smarty_tiki",
			SMARTY_DIR."plugins"
		);


		
		// In general, it's better that use_sub_dirs = false
		// If ever you are on a very large/complex/multilingual site and your
		// templates_c directory is > 10 000 files, (you can check at tiki-admin_system.php)
		// you can change to true and maybe you will get better performance.
		// http://smarty.php.net/manual/en/variable.use.sub.dirs.php

			$this->use_sub_dirs = false;
	}

	function _smarty_include($params) {
		global $style, $style_base, $tikidomain;

		$isIe = preg_match('/MSIE/', $_SERVER['HTTP_USER_AGENT']) && 
 		    !preg_match('/Opera/', $_SERVER['HTTP_USER_AGENT']);

		if (isset($style) && isset($style_base)) {
			if ($tikidomain and file_exists("templates/$tikidomain/styles/$style_base/".$params['smarty_include_tpl_file'])) {
				$params['smarty_include_tpl_file'] = "$tikidomain/styles/$style_base/".$params['smarty_include_tpl_file'];
			} elseif ($tikidomain and file_exists("templates/$tikidomain/".$params['smarty_include_tpl_file'])) {
				$params['smarty_include_tpl_file'] = "$tikidomain/".$params['smarty_include_tpl_file'];
			} elseif (file_exists("templates/styles/$style_base/".$params['smarty_include_tpl_file'])) {
			    if ($isIe && file_exists("templates/styles/$style_base/ie-".$params['smarty_include_tpl_file'])) {
				$params['smarty_include_tpl_file'] = 'ie-' . $params['smarty_include_tpl_file'];
			    }
			    $params['smarty_include_tpl_file'] = "styles/$style_base/".$params['smarty_include_tpl_file'];
			} elseif ($isIe && file_exists("templates/ie-" . $params['smarty_include_tpl_file'])) {
			    $params['smarty_include_tpl_file'] = 'ie-' . $params['smarty_include_tpl_file'];
			}
		}
		global $currentTpl;
		$currentTpl = $params['smarty_include_tpl_file'];

		return parent::_smarty_include($params);
	}

	function fetch($_smarty_tpl_file, $_smarty_cache_id = null, $_smarty_compile_id = null, $_smarty_display = false) {
		global $language, $style, $style_base, $tikidomain;

		if (isset($style) && isset($style_base)) {
			if ($tikidomain and file_exists("templates/$tikidomain/styles/$style_base/$_smarty_tpl_file")) {
				$_smarty_tpl_file = "$tikidomain/styles/$style_base/$_smarty_tpl_file";
			} elseif ($tikidomain and file_exists("templates/$tikidomain/$_smarty_tpl_file")) {
				$_smarty_tpl_file = "$tikidomain/$_smarty_tpl_file";
			} elseif (file_exists("templates/styles/$style_base/$_smarty_tpl_file")) {
				$_smarty_tpl_file = "styles/$style_base/$_smarty_tpl_file";
			}
		}
		$_smarty_cache_id = $language . $_smarty_cache_id;
		$_smarty_compile_id = $language . $_smarty_compile_id;
		return parent::fetch($_smarty_tpl_file, $_smarty_cache_id, $_smarty_compile_id, $_smarty_display);
	}
	/* fetch in a specific language  without theme consideration */
	function fetchLang($lg, $_smarty_tpl_file, $_smarty_cache_id = null, $_smarty_compile_id = null, $_smarty_display = false)  {
		global $language;
		global $lang;
		global $style, $style_base, $tikidomain;
		
                if (isset($style) && isset($style_base)) {
			if ($tikidomain and file_exists("templates/$tikidomain/styles/$style_base/$_smarty_tpl_file")) {
				$_smarty_tpl_file = "$tikidomain/styles/$style_base/$_smarty_tpl_file";
			} elseif ($tikidomain and file_exists("templates/$tikidomain/$_smarty_tpl_file")) {
				$_smarty_tpl_file = "$tikidomain/$_smarty_tpl_file";
			} elseif (file_exists("templates/styles/$style_base/$_smarty_tpl_file")) {
				$_smarty_tpl_file = "styles/$style_base/$_smarty_tpl_file";
			}
		}

		$_smarty_cache_id = $lg . $_smarty_cache_id;
		$_smarty_compile_id = $lg . $_smarty_compile_id;
		$this->_compile_id = $lg . $_smarty_compile_id; // not pretty but I don't know how to change id for get_compile_path
		$isCompiled = $this->_is_compiled($_smarty_tpl_file, $this->_get_compile_path($_smarty_tpl_file));
		if (!$isCompiled) {
			$lgSave = $language;
			$language = $lg;
			include("lang/$language/language.php");
			if (file_exists("lang/$language/el-additional_strings.php"))
			    include_once("lang/$language/el-additional_strings.php");
				// the language file needs to be included again:
				// the file could have been included before: prefilter.tr using include_once will not reload the file
				// but the $lang can be from another language
		}
		$res = parent::fetch($_smarty_tpl_file, $_smarty_cache_id, $_smarty_compile_id, $_smarty_display);
		if (!$isCompiled) {
			$language = $lgSave;
			include ("lang/$language/language.php");
			if (file_exists("lang/$language/el-additional_strings.php"))
			    include_once("lang/$language/el-additional_strings.php");
		}

		return ereg_replace("^[ \t]*", "", $res);
	}
	function is_cached($_smarty_tpl_file, $_smarty_cache_id = null, $_smarty_compile_id = null) {
		global $language, $style, $style_base, $tikidomain;

		if (isset($style) && isset($style_base)) {
			if ($tikidomain and file_exists("templates/$tikidomain/styles/$style_base/$_smarty_tpl_file")) {
				$_smarty_tpl_file = "$tikidomain/styles/$style_base/$_smarty_tpl_file";
			} elseif ($tikidomain and file_exists("templates/$tikidomain/$_smarty_tpl_file")) {
				$_smarty_tpl_file = "$tikidomain/$_smarty_tpl_file";
			} elseif (file_exists("templates/styles/$style_base/$_smarty_tpl_file")) {
				$_smarty_tpl_file = "styles/$style_base/$_smarty_tpl_file";
			}
		}
		$_smarty_cache_id = $language . $_smarty_cache_id;
		$_smarty_compile_id = $language . $_smarty_compile_id;
		return parent::is_cached($_smarty_tpl_file, $_smarty_cache_id, $_smarty_compile_id);
	}
	function clear_cache($_smarty_tpl_file = null, $_smarty_cache_id = null, $_smarty_compile_id = null, $_smarty_exp_time=null) {
		global $language, $style, $style_base, $tikidomain;

		if (isset($style) && isset($style_base) && isset($_smarty_tpl_file)) {
			if ($tikidomain and file_exists("templates/$tikidomain/styles/$style_base/$_smarty_tpl_file")) {
				$_smarty_tpl_file = "$tikidomain/styles/$style_base/$_smarty_tpl_file";
			} elseif ($tikidomain and file_exists("templates/$tikidomain/$_smarty_tpl_file")) {
				$_smarty_tpl_file = "$tikidomain/$_smarty_tpl_file";
			} elseif (file_exists("templates/styles/$style_base/$_smarty_tpl_file")) {
				$_smarty_tpl_file = "styles/$style_base/$_smarty_tpl_file";
			}
		}
		$_smarty_cache_id = $language . $_smarty_cache_id;
		$_smarty_compile_id = $language . $_smarty_compile_id;
		return parent::clear_cache($_smarty_tpl_file, $_smarty_cache_id, $_smarty_compile_id, $_smarty_exp_time);
	}
	// Returns the file name associated to the template name
	function get_filename($template) {
		global $tikidomain, $style_base;
		if (!empty($tikidomain) && is_file($this->template_dir.'/'.$tikidomain.'/styles/'.$style_base.'/'.$template)) {
    			$file = "/$tikidomain/styles/$style_base/";
  		} elseif (!empty($tikidomain) && is_file($this->template_dir.'/'.$tikidomain.'/'.$template)) {
    			$file = "/$tikidomain/";
  		} elseif (is_file($this->template_dir.'/styles/'.$style_base.'/'.$template)) {
			$file = "/styles/$style_base/";
  		} else {
    			$file = '';
  		}
		return $this->template_dir.$file.$template;
	}
	function display($resource_name, $cache_id=null, $compile_id = null) {
	    global $feature_ajax, $ajaxlib;
		if ($feature_ajax == 'y') {
		    $ajaxlib->processRequests();
		}
		if ($resource_name == 'confirm.tpl' || $resource_name == 'error.tpl' || $resource_name == 'information.tpl' || $resource_name == 'error_ticket.tpl' || $resource_name == 'error_simple.tpl') {
			include_once('tiki-modules.php');
		} elseif (($tpl = $this->get_template_vars('mid')) && $resource_name == 'tiki.tpl') {
			global $currentTpl;
			$currentTpl = $tpl;
			$data = $this->fetch($tpl, $cache_id, $compile_id);//must get the mid because the modules can overwrite smarty variables
			$this->assign('mid_data', $data);
			include_once('tiki-modules.php');
		}
		return parent::display($resource_name, $cache_id, $compile_id);
	}
}

$smarty = new Smarty_Tikiwiki($tikidomain);
$smarty->load_filter('pre', 'tr');
// $smarty->load_filter('output','trimwhitespace');
?>
