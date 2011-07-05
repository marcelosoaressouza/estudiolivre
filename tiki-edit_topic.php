<?php
require_once('tiki-setup.php');
include_once('lib/articles/artlib.php');

if($feature_articles != 'y') {
  $smarty->assign('msg', tra("This feature is disabled").": feature_articles");
  $smarty->display("error.tpl");
  die;  
}


// PERMISSIONS: NEEDS p_admin

  if($tiki_p_admin_cms != 'y') {
    $smarty->assign('msg',tra("You do not have permission to use this feature"));
    $smarty->display("error.tpl");
    die;
  }

if (!isset($_REQUEST["topicid"])) {
  $smarty->assign('msg', tra("No topic id specified"));
  $smarty->display("error.tpl");
  die;
}

$topic_info = $artlib->get_topic($_REQUEST["topicid"]);
if ($topic_info == DB_ERROR) {
  $smarty->assign('msg', tra("Invalid topic id specified"));
  $smarty->display("error.tpl");
  die;
}
$smarty->assign_by_ref('topic_info', $topic_info);

if(isset($_REQUEST["edittopic"])) {
  if(isset($_FILES['userfile1'])&&is_uploaded_file($_FILES['userfile1']['tmp_name'])) {
    $fp = fopen($_FILES['userfile1']['tmp_name'],"rb");
    $data = fread($fp,filesize($_FILES['userfile1']['tmp_name']));
    fclose($fp);
    $imgtype = $_FILES['userfile1']['type'];
    $imgsize = $_FILES['userfile1']['size'];
    $imgname = $_FILES['userfile1']['name'];

    $artlib->replace_topic_image($_REQUEST["topicid"], $imgname, $imgtype, $imgsize, $data);
  }

  if(isset($_REQUEST["name"])) {
    $artlib->replace_topic_name($_REQUEST["topicid"], $_REQUEST["name"]);
  }

  header("Location: tiki-admin_topics.php");
}
$section = 'cms';
include_once ('tiki-section_options.php');

// disallow robots to index page:
$smarty->assign('metatag_robots', 'NOINDEX, NOFOLLOW');

$smarty->assign('mid','tiki-edit_topic.tpl');
$smarty->display("tiki.tpl");

?>
