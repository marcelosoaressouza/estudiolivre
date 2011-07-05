<?php
// Initialization
require_once('tiki-setup.php');
include_once('lib/directory/dirlib.php');

if($feature_directory != 'y') {
  $smarty->assign('msg',tra("This feature is disabled"));
  $smarty->display("error.tpl");
  die;  
}

// Set parent category to 2 ("tiki sites")
$_REQUEST["parent"]=2;
$smarty->assign('parent',$_REQUEST["parent"]);
$all=0;
$parent_info = $dirlib->dir_get_category($_REQUEST['parent']);
$parent_name = $parent_info['name'];
$smarty->assign('parent_name',$parent_name);

// Now get the path to the parent category
$path = $dirlib->dir_get_category_path_admin($_REQUEST["parent"]);
$smarty->assign_by_ref('path',$path);

// If no site is being edited set it to zero
$_REQUEST["siteId"]=0;
$smarty->assign('siteId',$_REQUEST["siteId"]);

if (empty($_REQUEST["name"])) {
  $smarty->assign('msg',tra("Must enter a name to add a site"));
  $smarty->display("error.tpl");
  die;  
}

if (empty($_REQUEST["url"])) {
  $smarty->assign('msg',tra("Must enter a url to add a site"));
  $smarty->display("error.tpl");
  die;  
}

if ((substr($_REQUEST["url"],0,7)<>'http://') && (substr($_REQUEST["url"],0,8)<>'https://')) {
  $_REQUEST["url"]='http://'.$_REQUEST["url"];
}
  
if($dirlib->dir_url_exists($_REQUEST['url'])) {
  $smarty->assign('msg',tra("URL already added to the directory. Duplicate site?"));
  $smarty->display("error.tpl");
  die;  
}
  
if($directory_validate_urls == 'y') {
  @$fsh = fopen($_REQUEST['url'],'r');
  if(!$fsh) {
    $smarty->assign('msg',tra("URL cannot be accessed: wrong URL or site is offline and cannot be added to the directory"));
    $smarty->display("error.tpl");
    die;  
  }
}
  
$siteId=$dirlib->dir_replace_site($_REQUEST["siteId"],$_REQUEST["name"],$_REQUEST["description"], $_REQUEST["url"], $_REQUEST["country"], 'n');
$dirlib->dir_add_site_to_category($siteId,$_REQUEST["parent"]);

$info = Array();
$info["name"]=$_REQUEST['name'];
$info["description"]=$_REQUEST['description'];
$info["url"]=$_REQUEST['url'];
$info["country"]=$_REQUEST['country'];
$info["isValid"]='n';
$smarty->assign_by_ref('info',$info);

$countries=Array();
$h=opendir("img/flags");
while($file=readdir($h)) {
  if(is_file('img/flags/'.$file)) {
    $name=explode('.',$file);
    $countries[]=$name[0];
  }
}
closedir($h);
$smarty->assign_by_ref('countries',$countries);

$section = 'directory';
include_once ('tiki-section_options.php');

$smarty->assign('save','y');

// Display the template
$smarty->assign('mid','tiki-register_site.tpl');
$smarty->display("tiki.tpl");
?>
