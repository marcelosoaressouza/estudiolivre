<?php

if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

global $dbConnection;
$dbConnection =& $dbTiki;

$feature_tooltip = $userlib->get_user_preference($user, 'feature_tooltip', 'y');
$feature_tooltip_max_clicks = $userlib->get_user_preference($user,'feature_tooltip_max_clicks', 5);

if ($feature_tooltip == 'y') {
	require_once("lib/tooltip/tooltiplib.php");
	require_once("el-tooltip_ajax.php");	
}

require_once("el-gallery_stream_ajax.php");

$userbreadCrumb = $tikilib->get_user_preference($user,'userbreadCrumb',$userbreadCrumb);
$smarty->assign('userbreadCrumb',$userbreadCrumb);
require_once("el-breadcrumbs.php");

//verificando versão do ie
ereg('MSIE ([0-9]\.[0-9])',$_SERVER['HTTP_USER_AGENT'],$reg);
if(!isset($reg[1]))
	$isIE = false;
else
	$isIE = floatval($reg[1]);
	
$smarty->assign('isIE',$isIE);

$showIeMsg = false;
if ($isIE) {
    if (!isset($_COOKIE['ieMsgSeen']) || !$_COOKIE['ieMsgSeen']) {
	$showIeMsg = true;
	setcookie('ieMsgSeen',1,time()+60*60*24*7);
    }
}

$smarty->assign('showIeMsg',$showIeMsg);

$smarty->assign('showTeste', preg_match('/teste\.estudioli.re\.org/',$ownurl));

//TODO descobrir pq precisa dessa bosta aqui pra traducao funcionar
tra('');
TikiSetup::prependIncludePath('lib/elgal/model');
// TODO: Fazer ieGIF2PNG q substitui o {if $isIE}gif{else}png{/if}

?>
