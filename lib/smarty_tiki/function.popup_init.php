<?php
/* $Header: /cvsroot/tikiwiki/tiki/lib/smarty_tiki/function.popup_init.php,v 1.1.2.3 2008/02/21 19:41:17 marclaporte Exp $ */
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * This file overrides default smarty popup_init function and has
 * been modified not to load the same file twice. overlib doesn't work
 * in IE if overlib.js has been included twice.

/**
 * Smarty {popup_init} function plugin
 *
 * Type:     function<br>
 * Name:     popup_init<br>
 * Purpose:  initialize overlib
 * @link http://smarty.php.net/manual/en/language.function.popup.init.php {popup_init}
 *          (Smarty online manual)
 * @param array
 * @param Smarty
 * @return string
 */


//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}


function smarty_function_popup_init($params, &$smarty)
{
    global $popup_init_cache;
    if (!isset($popup_init_cache)) {
        $popup_init_cache = array();
    }

    if (isset($popup_init_cache[$params['src']]))
        return;

    $zindex = 1000;

    if (!empty($params['zindex'])) {
        $zindex = $params['zindex'];
    }

    if (!empty($params['src'])) {
        $popup_init_cache[$params['src']] = 1;
        return '<div id="overDiv" style="position: absolute; visibility: hidden; z-index:'.$zindex.';"></div>' . "\n"
         . '<script type="text/javascript" src="'.$params['src'].'"></script>' . "\n";
    } else {
        $smarty->trigger_error("popup_init: missing src parameter");
    }

}

/* vim: set expandtab: */

?>
