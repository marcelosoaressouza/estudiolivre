<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

function smarty_function_jspopup($params, &$smarty)
{
    extract($params);
    // Param = zone
    if(empty($href)) {
        $smarty->trigger_error("assign: missing href parameter");
        return;
    }
    if(!isset($scrollbars)) $scrollbars='yes';
    if(!isset($menubar)) $menubar='no';
    if(!isset($resizable))  $resizable='yes';
    if(!isset($height)) $height='400';
    if(!isset($width)) $width='600';
    print("href='#' onclick='javascript:window.open(\"$href\",\"\",\"menubar=$menubar,scrollbars=$scrollbars,resizable=$resizable,height=$height,width=$width\");' ");
}

/* vim: set expandtab: */

?>
