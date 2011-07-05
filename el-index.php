<?php
require_once("tiki-setup.php");
require_once('lib/tikilib.php');

if ($_REQUEST["el_nao_ver_apresentacao"]){
    setcookie("el_nao_ver_apresentacao", 1);
}

if ($tikilib->get_user_preference($user, 'el_dynamic_home', 0) == 1 || isset($_COOKIE["el_nao_ver_apresentacao"])) {
    header("location: tiki-index.php");
}

$info = $tikilib->get_page_info('Estática');
$pdata = $tikilib->parse_data($info["data"],$info["is_html"]);
$smarty->assign_by_ref('estatica', $pdata);

$smarty->display('el-index.tpl');
?>