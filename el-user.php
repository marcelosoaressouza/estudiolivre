<?php
// migrado pra 2.0!
// Initialization
if (!isset($_POST['xajax']) || $_POST['xajax'] != 'upload_info') {
	require_once("tiki-setup.php");
	require_once("lib/persistentObj/PersistentObjectController.php");

	if (isset($_REQUEST['view_user'])) {
		$view_user = $_REQUEST['view_user'];
		if ($view_user == $user) 
			$permission = true;
		else 
			$permission = false;
	} else {
		if ($user) {
			$view_user = $user;
			$permission = true;
		} else {
			$noUser = true;
			$permission = false;
		}
	}

	include_once ('lib/userprefs/scrambleEmail.php');
	require_once('lib/messu/messulib.php');
	require_once("el-gallery_ajax.php");
	require_once("el-license_ajax.php");

} else {
	$feature_ajax = "y";
	$user = '';
	$permission = false;
}

require_once("el-user_ajax.php");
$ajaxlib->processRequests();

require_once('lib/blogs/bloglib.php');
require_once('lib/commentslib.php');
$commentslib = new Comments($dbTiki);

if (isset($noUser)) {
	$smarty->assign('msg', tra("You are not logged in and no user indicated"));
	$smarty->display("error.tpl");
	die;
}

if (!$userlib->user_exists($view_user)) {
	$smarty->assign('msg', tra("Unknown user"));
	$smarty->display("error.tpl");
	die;
}

if ($tiki_p_admin != 'y' && !$permission) {
	$isPublic = $tikilib->get_user_preference($view_user, 'isPublic', '1');
	if (!$isPublic) {
		$smarty->assign('msg', tra("The user has chosen to make his information private"));
		$smarty->display("error.tpl");
		die;
	}
}

$smarty->assign('headtitle', $view_user);
elAddCrumb($view_user);

$page = "Usuário_" . $view_user;
$info = $tikilib->get_page_info($page);
$smarty->assign('pageName', $page);
if(is_array($info)) {
	$pdata = $tikilib->parse_data($info["data"],$info["is_html"]);
	foreach($info as $infoName => $value) {
		if($infoName != "user") {
			$smarty->assign($infoName, $value);
		} else {
			$smarty->assign('modifUser', $value);
		}
	}	
}
$smarty->assign_by_ref('userWiki', $pdata);

$sort_mode = 'publishDate_desc';
$controller = new PersistentObjectController("Publication");
$filters = array("actualClass" => array("AudioPublication",
										"VideoPublication",
										"ImagePublication",
										"TextPublication"),
				 "user" => $view_user,
				 "publishDate" => true);
$uploads = $controller->findAll($filters, 0, 5, $sort_mode);
$smarty->assign_by_ref('arquivos',$uploads);

$total = $controller->countAll($filters);

$smarty->assign('dontAskDelete', $tikilib->get_user_preference($user, 'el_dont_check_delete', 0));

$smarty->assign('permission', $permission);
$smarty->assign('userName', $view_user);
$smarty->assign('maxRecords', 5);
$smarty->assign('offset', 0);
$smarty->assign('sort_mode', $sort_mode);
$smarty->assign('total', $total);
$smarty->assign('find', '');
$smarty->assign('filters', array());
$smarty->assign('page', 1);
$smarty->assign('lastPage', ceil($total/5));

// licenca padrao
if ($licencaId = $tikilib->get_user_preference($view_user, 'licencaPadrao')) {
	$lController = new PersistentObjectController("License");
	$licenca = $lController->noStructureFindAll(array("id" => $licencaId));
	$smarty->assign('licenca', $licenca[0]);
}

$userPosts = $bloglib->list_user_posts($view_user, 0, 5);
for($i = 0; $i < sizeof($userPosts['data']); $i++) {
	$userPosts['data'][$i]['commentsCount'] = $commentslib->count_comments('post:' . $userPosts['data'][$i]['postId']);
}
$smarty->assign('userPosts', $userPosts);

$liveChannels = array();
$result = $tikilib->query('select * from el_ice where user = ?', array($view_user));
while($row = $result->fetchRow()) {
	$liveChannels[] = $row;
}
$smarty->assign('liveChannels', $liveChannels);

$userMessages = $messulib->list_user_messages($view_user, 0, 5, 'date_desc', '', '', '', '', 'messages');
$total = $userMessages['cant'];

$smarty->assign('userMessages', $userMessages);	
$smarty->assign('msgMaxRecords', 5);
$smarty->assign('msgOffset', 0);
$smarty->assign('msgTotal', $total);
$smarty->assign('msgPage', 1);
$smarty->assign('msgLastPage', ceil($total/5));

$smarty->assign('uploadId',rand() . '.' . time());

//coisas herdadas do tiki-user_information.php
//include("tiki-user_information.php");

/* coisa que podem ser uteis
$user_language = $tikilib->get_language($view_user);
$smarty->assign_by_ref('user_language',$user_language);
$country = $tikilib->get_user_preference($view_user,'country','');
$smarty->assign('country',$country);
$anonpref = $tikilib->get_preference('userbreadCrumb',4);
$userbreadCrumb = $tikilib->get_user_preference($view_user,'userbreadCrumb',$anonpref);
$smarty->assign_by_ref('userbreadCrumb',$userbreadCrumb);
$avatar = $tikilib->get_user_avatar($view_user);
$smarty->assign('avatar', $avatar);
$homePage = $tikilib->get_user_preference($view_user,'site','');
$smarty->assign_by_ref('site',$homePage);
$timezone_options = $tikilib->get_timezone_list(true);
$smarty->assign_by_ref('timezone_options', $timezone_options);
$server_time = new Date();
$display_timezone = $tikilib->get_user_preference($view_user, 'display_timezone', $server_time->tz->getID());
$smarty->assign_by_ref('display_timezone', $display_timezone);
$userPage = $feature_wiki_userpage_prefix.$userinfo['login'];
$exist = $tikilib->page_exists($userPage);
$smarty->assign("userPage_exists", $exist);
********************************/

$user_style = $tikilib->get_user_preference($view_user, 'theme', 'bolha.css');
$smarty->assign_by_ref('user_style',$user_style);

$allowMsgs = $tikilib->get_user_preference($view_user,'allowMsgs',1);
$smarty->assign('allowMsgs',$allowMsgs);
$realName = $tikilib->get_user_preference($view_user,'realName','');
$local = $tikilib->get_user_preference($view_user,'local','');
$smarty->assign('local',$local);
$smarty->assign_by_ref('realName',$realName);
$site = $tikilib->get_user_preference($view_user,'site','');
$smarty->assign_by_ref('site',$site);

$isPublic = $tikilib->get_user_preference($view_user, 'isPublic', '1');
$smarty->assign('isPublic', $isPublic);

$userinfo = $userlib->get_user_info($view_user);
$smarty->assign_by_ref('userinfo', $userinfo);

$email_isPublic = $tikilib->get_user_preference($view_user, 'email is public', 'y');
if ($email_isPublic != 'n') {
	$userinfo['email'] = scrambleEmail($userinfo['email'], $email_isPublic);
}
$smarty->assign_by_ref('email_isPublic',$email_isPublic);


$smarty->assign('mid', 'el-user.tpl');
$smarty->display("tiki.tpl");

?>
