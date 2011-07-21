<?php
// $Header: /cvsroot/tikiwiki/tiki/lib/smarty_tiki/block.sortlinks.php,v 1.1.14.5 2007/02/10 19:16:37 sylvieg Exp $
/*
* Smarty plugin
* -------------------------------------------------------------
* File: block.sortlinks.php
* Type: block
* Name: sortlinks
* Purpose: sort a list of options or links lines on the value of the line. Each line has the form <..>value</...>
* inspiration : block repeat - Scott Matthewman <scott@matthewman.net>
* -------------------------------------------------------------
*/

//this script may only be included - so its better to die if called directly.
if(strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

function smarty_block_sortlinks($params, $content, &$smarty)
{
  if($content) {

    $links=preg_split("/\n/", $content);
    $links2=array();
    foreach($links as $value) {
      preg_match('/.*(<[^>]*>)(.*)(<\/[^¨>]*>)/U', $value, $splitted);

//    $splitted=preg_split("/[<>]/",$value,-1,PREG_SPLIT_NO_EMPTY);
      if(isset($splitted[2])) {
        $splitted[2] = str_replace(array("Î","É","È"), array('I','E','E'), $splitted[2]);
        $links2[$splitted[2]]=$value;
      }
    }

    ksort($links2);
    foreach($links2 as $value) {
      echo $value;
    }
  }
}
?>
