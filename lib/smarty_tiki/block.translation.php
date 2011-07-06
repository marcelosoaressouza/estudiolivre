<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Smarty {translation lang=XX}{/translation} block plugin
 *
 * Type:     block function<br>
 * Name:     translation<br>
 * Purpose:  Support many languages in a template, only showing block
             if language matches
 * @param array
 * <pre>
 * Params:   lang: string (language, ex: en, pt-br)
 * </pre>
 * @param string contents of the block
 * @param Smarty clever simulation of a method
 * @return string string $content re-formatted
 */

//this script may only be included - so its better to die if called directly.
if(strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

function smarty_block_translation($params, $content, &$smarty)
{
  if(isset($content)) {
    $lang = $params['lang'];

    if($smarty->get_template_vars('language') == $lang) {
      return $content;
    }

    else {
      return '';
    }
  }
}

/* vim: set expandtab: */

?>
