<?php
// $Header: /cvsroot/tikiwiki/tiki/lib/smarty_tiki/block.tikimodule.php,v 1.4.2.7 2007/02/08 23:12:20 sylvieg Exp $
/**
 * \brief Smarty {tikimodule}{/tikimodule} block handler
 *
 * To make a module it is enough to place smth like following
 * into corresponding mod-name.tpl file:
 * \code
 *  {tikimodule name="module_name" title="Module title"}
 *    <!-- module Smarty/HTML code here -->
 *  {/tikimodule}
 * \endcode
 *
 * This block may (can) use 2 Smarty templates:
 *  1) module.tpl = usual template to generate module look-n-feel
 *  2) module-error.tpl = to generate diagnostic error message about
 *     incorrect {tikimodule} parameters
 *
 * It also supports the param flip="y" to make this module flippable.
 * flip="n" is the default.
 * and the param decorations="n" to suppress module decorations
 * decorations="y" is the default.

\Note
error was used only in case the name was not there.
I fixed that error case. -- mose

 */

//this script may only be included - so its better to die if called directly.
if(strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}


function smarty_block_tikimodule($params, $content, &$smarty) {
  global $user_flip_modules;
  extract($params);

  if(!isset($content))   return "";

  if(!isset($overflow))  $overflow = false;

  if(!isset($title))     $title = substr(strip_tags($content),0,12)."...";

  if(!isset($name))      $name  = ereg_replace("[^-_a-zA-Z0-9]","",$title);

  if(!isset($flip) || $flip != 'y') $flip = 'n';

  if(!isset($decorations) || $decorations != 'n') $decorations = 'y';

  if(isset($user_flip_modules) && ($user_flip_modules != 'module')) {
    $flip = $user_flip_modules;
  }

  if($decorations == 'y') {
    $smarty->assign('module_overflow', $overflow);
    $smarty->assign('module_title', $title);
    $smarty->assign('module_name', $name);
    $smarty->assign('module_flip', $flip);
    $smarty->assign('module_decorations', $decorations);
    $smarty->assign_by_ref('module_content', $content);
    return $smarty->fetch('module.tpl');
  }

  else {
    return $content.$module_error;
  }
}
?>
