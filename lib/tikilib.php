<?php

// CVS: $Id: tikilib.php,v 1.514.2.315 2007/10/26 12:13:14 niclone Exp $
//this script may only be included - so its better to die if called directly.
if(strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

require_once('lib/pear/Date.php');
require_once('lib/tikidate.php');
require_once('lib/tikidblib.php');
//performance collecting:
//require_once ('lib/tikidblib-debug.php');

// This class is included by all the Tiki php scripts, so it's important
// to keep the class as small as possible to improve performance.
// What goes in this class:
// * generic functions that MANY scripts must use
// * shared functions (marked as /*shared*/) are functions that are
//   called from Tiki modules.
class TikiLib extends TikiDB {
  var $db; // The ADODB db object used to access the database

  var $buffer;
  var $flag;
  var $parser;
  var $pre_handlers = array();
  var $pos_handlers = array();
  var $postedit_handlers = array();
  var $usergroups_cache = array();

  var $num_queries = 0;
  var $now;

  // Constructor receiving a PEAR::Db database object.
  function TikiLib($db) {
    if(!$db) {
      die("Invalid db object passed to TikiLib constructor");
    }

    $this->db = $db;
    $this->now = date('U');
  }


  /*shared*/
  function httprequest($url, $reqmethod = "GET") {
    global $use_proxy,$proxy_host,$proxy_port;

    // test url :
    if(!preg_match("/^[-_a-zA-Z0-9:\/\.\?&;=\+~%,]*$/",$url)) return false;

    // rewrite url if sloppy # added a case for https urls
    if((substr($url,0,7) <> "http://") and
        (substr($url,0,8) <> "https://")
      ) {
      $url = "http://" . $url;
    }

    // (cdx) params for HTTP_Request.
    // The timeout may be defined by a DEFINE("HTTP_TIMEOUT",5) in some file...
    $aSettingsRequest=array("method"=>$reqmethod,"timeout"=>5);

    if(substr_count($url, "/") < 3) {
      $url .= "/";
    }

    // Proxy settings
    if($use_proxy == 'y') {
      $aSettingsRequest["proxy_host"]=$proxy_host;
      $aSettingsRequest["proxy_port"]=$proxy_port;
    }

    include_once('lib/pear/HTTP/Request.php');
    $req = &new HTTP_Request($url, $aSettingsRequest);
    $data="";

    // (cdx) return false when can't connect
    // I prefer throw a PEAR_Error. You decide ;)
    if(PEAR::isError($oError=$req->sendRequest())) {
      return(false);
      /* Please people, don't use fopen. It's potentially unsafe
       * because if any form does not check the url, you can upload
       * /etc/passwd and other file from the local host.
       * it's also more safe to use httprequest, because the admin can set
       * a proxy so that noone can upload files in tiki from behind a
       * firewall (safes the net where tiki runs in).
      $fp = fopen($url, "r");

      if ($fp) {
        $data = '';
        while(!feof($fp)) {
          $data .= fread($fp,4096);
        }
      fclose ($fp);
      }
      if ($data =="") return false;
      */
    }

    else $data = $req->getResponseBody();

    return $data;
  }

  /*shared*/
  function get_dsn_by_name($name) {
    if($name == 'local') {
      return true;
    }

    return $this->getOne("select `dsn`  from `tiki_dsn` where `name`='$name'");
  }

  /* convert data to iso-8601 format */
  function iso_8601($timestamp) {
    $main_date = date("Y-m-d\TH:i:s", $timestamp);

    $tz = date("O", $timestamp);
    $tz = substr_replace($tz, ':', 3, 0);

    $return = $main_date . $tz;

    return $return;
  }

  /*shared*/
  function check_rules($user, $section) {
    // Admin is never banned
    if($user == 'admin')
      return false;

    $ips = explode('.', $_SERVER["REMOTE_ADDR"]);
    $now = date("U");
    $query = "select tb.`message`,tb.`user`,tb.`ip1`,tb.`ip2`,tb.`ip3`,tb.`ip4`,tb.`mode` from `tiki_banning` tb, `tiki_banning_sections` tbs where tbs.`banId`=tb.`banId` and tbs.`section`=? and ( (tb.`use_dates` = ?) or (tb.`date_from` <= ? and tb.`date_to` >= ?))";
    $result = $this->query($query,array($section,'n',(int)$now,(int)$now));

    while($res = $result->fetchRow()) {
      if(!$res['message']) {
        $res['message'] = tra('You are banned from'). ':' . $section;
      }

      if($user && $res['mode'] == 'user') {
        // check user
        $pattern = '/' . $res['user'] . '/';

        if(preg_match($pattern, $user)) {
          return $res['message'];
        }
      }

      else {
        // check ip
        if(count($ips) == 4) {
          if(($ips[0] == $res['ip1'] || $res['ip1'] == '*') && ($ips[1] == $res['ip2'] || $res['ip2'] == '*')
              && ($ips[2] == $res['ip3'] || $res['ip3'] == '*') && ($ips[3] == $res['ip4'] || $res['ip4'] == '*')) {
            return $res['message'];
          }
        }
      }
    }

    return false;
  }

  /*shared*/
  function replace_note($user, $noteId, $name, $data) {
    $now = date("U");
    $size = strlen($data);

    if($noteId) {
      $query = "update `tiki_user_notes` set `name` = ?, `data` = ?, `size` = ?, `lastModif` = ?  where `user`=? and `noteId`=?";
      $this->query($query,array($name,$data,(int)$size,(int)$now,$user,(int)$noteId));
      return $noteId;
    }

    else {
      $query = "insert into `tiki_user_notes`(`user`,`noteId`,`name`,`data`,`created`,`lastModif`,`size`) values(?,?,?,?,?,?,?)";
      $this->query($query,array($user,(int)$noteId,$name,$data,(int)$now,(int)$now,(int)$size));
      $noteId = $this->getOne("select max(`noteId`) from `tiki_user_notes` where `user`=? and `name`=? and `created`=?",array($user,$name,(int)$now));
      return $noteId;
    }
  }

  /*shared*/
  function add_user_watch($user, $event, $object, $type, $title, $url) {
    global $userlib;

    $hash = md5(uniqid('.'));
    $email = $userlib->get_user_email($user);
    $query = "delete from `tiki_user_watches` where ".$this->convert_binary()." `user`=? and `event`=? and `object`=?";
    $this->query($query,array($user,$event,$object));
    $query = "insert into `tiki_user_watches`(`user`,`event`,`object`,`email`,`hash`,`type`,`title`,`url`) ";
    $query.= "values(?,?,?,?,?,?,?,?)";
    $this->query($query,array($user,$event,$object,$email,$hash,$type,$title,$url));
    return true;
  }

  /*shared*/
  function remove_user_watch_by_hash($hash) {
    $query = "delete from `tiki_user_watches` where `hash`=?";
    $this->query($query,array($hash));
  }

  /*shared*/
  function remove_user_watch($user, $event, $object) {
    $query = "delete from `tiki_user_watches` where ".$this->convert_binary()." `user`=? and `event`=? and `object`=?";
    $this->query($query,array($user,$event,$object));
  }

  /*shared*/
  function get_user_watches($user, $event = '') {
    $mid = '';
    $bindvars=array($user);

    if($event) {
      $mid = " and `event`=? ";
      $bindvars[]=$event;
    }

    $query = "select * from `tiki_user_watches` where ".$this->convert_binary()." `user`=? $mid";
    $result = $this->query($query,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res;
    }

    return $ret;
  }

  /*shared*/
  function get_watches_events() {
    $query = "select distinct `event` from `tiki_user_watches`";
    $result = $this->query($query,array());
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res['event'];
    }

    return $ret;
  }

  /*shared*/
  function get_user_event_watches($user, $event, $object) {
    /* don't look in the translation as this function is only for the eye buttom */
    $query = "select * from `tiki_user_watches` where `user`=? and `event`=? and `object`=?";
    $result = $this->query($query,array($user,$event,$object));

    if(!$result->numRows())
      return false;

    $res = $result->fetchRow();
    return $res;
  }

  /*shared*/
  function get_event_watches($event, $object, $info=null) {
    global $feature_user_watches_translations, $dbTiki;
    $ret = array();

    $where = array();
    $mid = '';

    if($feature_user_watches_translations == 'y'  && $event == 'wiki_page_changed') {
      // If $feature_user_watches_translations is turned on, also look for
      // pages in a translation group.
      $mid = "`event`=?";
      $bindvars[] = $event;
      global $multilinguallib;
      include_once("lib/multilingual/multilinguallib.php");
      $page_info = $this->get_page_info($object);
      $pages = $multilinguallib->getTranslations('wiki page', $page_info['page_id'], $object, '');
      foreach($pages as $page) {
        $mids[] = "`object`=?";
        $bindvars[] = $page['objName'];
      }
      $mid .= 'and ('.implode(' or ', $mids).')';
    }

    else if($event == 'forum_post_topic') {
      $mid = "(`event`=? or `event`=?) and `object`=?";
      $bindvars[] = $event;
      $bindvars[] = 'forum_post_topic_and_thread';
      $bindvars[] = $object;
    }

    else if($event == 'forum_post_thread') {
      $mid = "(`event`=? and `object`=?) or ( `event`=? and `object`=?)";
      $bindvars[] = $event;
      $bindvars[] = $object;
      $bindvars[] = 'forum_post_topic_and_thread';
      $forumId = $info['forumId'];
      $bindvars[] = $forumId;
    }

    else {
      $mid = "`event`=? and `object`=?";
      $bindvars[] = $event;
      $bindvars[] = $object;
    }

    $query = "select * from `tiki_user_watches` where $mid";
    $result = $this->query($query,$bindvars);

    if(!$result->numRows()) {
      return $ret;
    }

    while($res = $result->fetchRow()) {
      switch($event) {
      case 'wiki_page_changed':
        $res['perm']=($this->user_has_perm_on_object($res['user'],$object,'wiki page','tiki_p_view') ||
                      $this->user_has_perm_on_object($res['user'],$object,'wiki page','tiki_p_admin_wiki'));
        break;

      case 'blog_post':
        $res['perm']=($this->user_has_perm_on_object($res['user'],$object,'blog','tiki_p_read_blog') ||
                      $this->user_has_perm_on_object($res['user'],$object,'blog','tiki_p_admin_blog'));
        break;

      case 'map_changed':
        $res['perm']=$this->user_has_perm_on_object($res['user'],$object,'map','tiki_p_map_view');
        break;

      case 'forum_post_topic':
        $res['perm']=($this->user_has_perm_on_object($res['user'],$object,'forum','tiki_p_forum_read') ||
                      $this->user_has_perm_on_object($res['user'],$object,'forum','tiki_p_admin_forum'));
        break;

      case 'forum_post_thread':
        $res['perm']=($this->user_has_perm_on_object($res['user'],$forumId,'forum','tiki_p_forum_read') ||
                      $this->user_has_perm_on_object($res['user'],$object,'forum','tiki_p_admin_forum'));
        break;

      case 'file_gallery_changed':
        $res['perm']=($this->user_has_perm_on_object($res['user'],$object,'blog','tiki_p_view_file_gallery') ||
                      $this->user_has_perm_on_object($res['user'],$object,'blog','tiki_p_download_files'));
        break;

      case 'article_submitted':
        global $userlib, $topicId;
        $res['perm']= ($userlib->user_has_permission($res['user'],'tiki_p_read_article') &&
                       $this->user_has_perm_on_object($res['user'],$topicId,'topic','tiki_p_topic_read'));
        break;

      case 'image_gallery_changed':
        $res['perm'] = $this->user_has_perm_on_object($res['user'],$object,'image gallery','tiki_p_view_image_gallery');
        break;

      default:
        // for security we deny all others.
        $res['perm']=FALSE;
        break;
      }

      if($res['perm']) {
        $ret[] = $res;
      }

    }

    return $ret;
  }



  /*shared*/
  function dir_stats() {
    $aux = array();
    $aux["valid"] = $this->db->getOne("select count(*) from `tiki_directory_sites` where `isValid`=?",array('y'));
    $aux["invalid"] = $this->db->getOne("select count(*) from `tiki_directory_sites` where `isValid`=?",array('n'));
    $aux["categs"] = $this->db->getOne("select count(*) from `tiki_directory_categories`",array());
    $aux["searches"] = $this->db->getOne("select sum(`hits`) from `tiki_directory_search`",array());
    $aux["visits"] = $this->db->getOne("select sum(`hits`) from `tiki_directory_sites`",array());
    return $aux;
  }

  /*shared*/
  function dir_list_all_valid_sites2($offset, $maxRecords, $sort_mode, $find) {

    if($find) {
      $mid = " where `isValid`=? and (`name` like ? or `description` like ?)";
      $bindvars=array('y','%'.$find.'%','%'.$find.'%');
    }

    else {
      $mid = " where `isValid`=? ";
      $bindvars=array('y');
    }

    $query = "select * from `tiki_directory_sites` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_directory_sites` $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res;
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  /*shared*/
  function get_directory($categId) {
    $query = "select * from `tiki_directory_categories` where `categId`=?";
    $result = $this->query($query,array($categId));

    if(!$result->numRows()) return false;

    $res = $result->fetchRow();
    return $res;
  }

  /*shared*/
  function user_unread_messages($user) {
    $cant = $this->getOne("select count(*) from `messu_messages` where `user`=? and `isRead`=?",array($user,'n'));
    return $cant;
  }

  /*shared*/
  function get_online_users() {
    if(!isset($this->online_users_cache)) {
      $this->online_users_cache=array();
      $query = "select s.`user`, p.`value` as 'realName', `timestamp`, `tikihost` from `tiki_sessions` s left join `tiki_user_preferences` p on s.`user`<>? and s.`user` = p.`user` and p.`prefName` = 'realName' where s.`user` is not null;";
      $result = $this->query($query,array(''));
      $ret = array();

      while($res = $result->fetchRow()) {
        $res['user_information'] = $this->get_user_preference($res['user'], 'user_information', 'public');
        $res['allowMsgs'] = $this->get_user_preference($res['user'], 'allowMsgs', 'y');
        $this->online_users_cache[$res['user']] = $res;
      }
    }

    return $this->online_users_cache;
  }

  /*shared*/
  function is_user_online($whichuser) {
    if(!isset($this->online_users_cache)) {
      $this->get_online_users();
    }

    return(isset($this->online_users_cache[$whichuser]));
  }


  /*shared*/
  function get_user_items($user) {
    $items = array();

    $query = "select ttf.`trackerId`, tti.`itemId` from `tiki_tracker_fields` ttf, `tiki_tracker_items` tti, `tiki_tracker_item_fields` ttif";
    $query .= " where ttf.`fieldId`=ttif.`fieldId` and ttif.`itemId`=tti.`itemId` and `type`=? and tti.`status`=? and `value`=?";
    $result = $this->query($query,array('u','o',$user));
    $ret = array();

    while($res = $result->fetchRow()) {
      $itemId = $res["itemId"];

      $trackerId = $res["trackerId"];
      // Now get the isMain field for this tracker
      $fieldId = $this->getOne("select `fieldId`  from `tiki_tracker_fields` ttf where `isMain`=? and `trackerId`=?",array('y',(int)$trackerId));
      // Now get the field value
      $value = $this->getOne("select `value`  from `tiki_tracker_item_fields` where `fieldId`=? and `itemId`=?",array((int)$fieldId,(int)$itemId));
      $tracker = $this->getOne("select `name`  from `tiki_trackers` where `trackerId`=?",array((int)$trackerId));
      $aux["trackerId"] = $trackerId;
      $aux["itemId"] = $itemId;
      $aux["value"] = $value;
      $aux["name"] = $tracker;

      if(!in_array($itemId, $items)) {
        $ret[] = $aux;
        $items[] = $itemId;
      }
    }

    $groups = $this->get_user_groups($user);

    foreach($groups as $group) {
      $query = "select ttf.`trackerId`, tti.`itemId` from `tiki_tracker_fields` ttf, `tiki_tracker_items` tti, `tiki_tracker_item_fields` ttif ";
      $query .= " where ttf.`fieldId`=ttif.`fieldId` and ttif.`itemId`=tti.`itemId` and `type`=? and tti.`status`=? and `value`=?";
      $result = $this->query($query,array('g','o',$group));

      while($res = $result->fetchRow()) {
        $itemId = $res["itemId"];

        $trackerId = $res["trackerId"];
        // Now get the isMain field for this tracker
        $fieldId = $this->getOne("select `fieldId`  from `tiki_tracker_fields` ttf where `isMain`=? and `trackerId`=?",array('y',(int)$trackerId));
        // Now get the field value
        $value = $this->getOne("select `value`  from `tiki_tracker_item_fields` where `fieldId`=? and `itemId`=?",array((int)$fieldId,(int)$itemId));
        $tracker = $this->getOne("select `name`  from `tiki_trackers` where `trackerId`=?",array((int)$trackerId));
        $aux["trackerId"] = $trackerId;
        $aux["itemId"] = $itemId;
        $aux["value"] = $value;
        $aux["name"] = $tracker;

        if(!in_array($itemId, $items)) {
          $ret[] = $aux;
          $items[] = $itemId;
        }
      }
    }

    return $ret;
  }

  /*shared*/
  function get_actual_content($contentId) {
    $data = '';

    $now = date("U");
    $query = "select max(`publishDate`) from `tiki_programmed_content` where `contentId`=? and `publishDate`<=?";
    $res = $this->getOne($query,array((int)$contentId,$now));

    if(!$res)
      return '';

    $query = "select `data`  from `tiki_programmed_content` where `contentId`=? and `publishDate`=?";
    $data = $this->getOne($query,array((int)$contentId,$res));
    return $data;
  }

  /*shared*/
  function get_quiz($quizId) {
    $query = "select * from `tiki_quizzes` where `quizId`=?";

    $result = $this->query($query,array((int) $quizId));

    if(!$result->numRows())
      return false;

    $res = $result->fetchRow();
    return $res;
  }


  function compute_quiz_stats() {
    $query = "select `quizId`  from `tiki_user_quizzes`";

    $result = $this->query($query,array());

    while($res = $result->fetchRow()) {
      $quizId = $res["quizId"];

      $quizName = $this->getOne("select `name`  from `tiki_quizzes` where `quizId`=?",array((int)$quizId));
      $timesTaken = $this->getOne("select count(*) from `tiki_user_quizzes` where `quizId`=?",array((int)$quizId));
      $avgpoints = $this->getOne("select avg(`points`) from `tiki_user_quizzes` where `quizId`=?",array((int)$quizId));
      $maxPoints = $this->getOne("select max(`maxPoints`) from `tiki_user_quizzes` where `quizId`=?",array((int)$quizId));
      $avgavg = ($maxPoints != 0) ? $avgpoints / $maxPoints * 100 : 0.0;
      $avgtime = $this->getOne("select avg(`timeTaken`) from `tiki_user_quizzes` where `quizId`=?",array((int)$quizId));
      $querydel = "delete from `tiki_quiz_stats_sum` where `quizId`=?";
      $resultdel = $this->query($querydel,array((int)$quizId),-1,-1,false);
      $query2 = "insert into `tiki_quiz_stats_sum`(`quizId`,`quizName`,`timesTaken`,`avgpoints`,`avgtime`,`avgavg`)
                values(?,?,?,?,?,?)";
      $result2 = $this->query($query2,array((int)$quizId,$quizName,(int)$timesTaken,(float)$avgpoints,$avgtime,$avgavg));
    }
  }


  /*shared*/
  function list_quizzes($offset, $maxRecords, $sort_mode, $find) {

    $bindvars = array();
    $mid = "";

    if($find) {
      $findesc = '%' . $find . '%';

      $mid = " where (`name` like ? or `description` like ?)";
      $bindvars = array($findesc,$findesc);
    }

    $query = "select * from `tiki_quizzes` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_quizzes` $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {

      global $user;
      $add=$this->user_has_perm_on_object($user,$res['quizId'],'quiz',array('tiki_p_take_quiz','tiki_p_view_quiz_stats'));

      if($add) {
        $res["questions"] = $this->getOne("select count(*) from `tiki_quiz_questions` where `quizId`=?",array((int) $res["quizId"]));
        $res["results"] = $this->getOne("select count(*) from `tiki_quiz_results` where `quizId`=?",array((int) $res["quizId"]));
        $ret[] = $res;
      }
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  /*shared*/
  function list_quiz_sum_stats($offset, $maxRecords, $sort_mode, $find) {
    $this->compute_quiz_stats();

    if($find) {
      $findesc = '%' . $find . '%';

      $mid = "  `quizName` like ? ";
      $bindvars=array($findesc);
    }

    else {
      $mid = "  ";
      $bindvars=array();
    }

    $query = "select * from `tiki_quiz_stats_sum` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_quiz_stats_sum` $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res;
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  function get_tracker($trackerId) {
    $query = "select * from `tiki_trackers` where `trackerId`=?";
    $result = $this->query($query,array((int) $trackerId));

    if(!$result->numRows()) return false;

    $res = $result->fetchRow();
    return $res;
  }
  /*shared*/


  function list_trackers($offset, $maxRecords, $sort_mode, $find) {

    if($find) {
      $findesc = '%' . $find . '%';

      $mid = " where (`name` like ? or `description` like ?)";
      $bindvars=array($findesc,$findesc);
    }

    else {
      $mid = "";
      $bindvars=array();
    }

    $query = "select * from `tiki_trackers` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_trackers` $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    $list = array();

    while($res = $result->fetchRow()) {

      global $user;
      $add=$this->user_has_perm_on_object($user,$res['trackerId'],'tracker','tiki_p_view_trackers');

      if($add) {
        $qu = "select count(*) from`tiki_tracker_items` where `trackerId`=? ";
        $res['items'] = $this->getOne($qu,array((int)$res['trackerId']));
        $ret[] = $res;
        $list[$res['trackerId']] = $res['name'];
      }
    }

    $retval = array();
    $retval["list"] = $list;
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  /*shared*/
  function list_surveys($offset, $maxRecords, $sort_mode, $find) {

    if($find) {
      $findesc = '%' . $find . '%';

      $mid = " where (`name` like ? or `description` like ?)";
      $bindvars=array($findesc,$findesc);
    }

    else {
      $mid = " ";
      $bindvars=array();
    }

    $query = "select * from `tiki_surveys` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_surveys` $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {

      global $user;
      $add=$this->user_has_perm_on_object($user,$res['surveyId'],'survey',array('tiki_p_take_survey','tiki_p_view_survey_stats'));

      if($add) {
        $res["questions"] = $this->getOne("select count(*) from `tiki_survey_questions` where `surveyId`=?",array((int) $res["surveyId"]));
        $ret[] = $res;
      }
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  /* experimental shared */
  function get_item_id($trackerId,$fieldId,$value) {
    $query = "select ttif.`itemId` from `tiki_tracker_items` tti, `tiki_tracker_fields` ttf, `tiki_tracker_item_fields` ttif ";
    $query.= " where tti.`trackerId`=ttf.`trackerId` and ttif.`fieldId`=ttf.`fieldId` and ttf.`trackerId`=? and ttf.`fieldId`=? and ttif.`value`=?";
    $itemId = $this->getOne($query,array((int) $trackerId,(int)$fieldId,$value));
    return $itemId;
  }


  /*shared*/
  function list_tracker_items($trackerId, $offset, $maxRecords, $sort_mode, $fields, $status = '', $initial = '') {
    $filters = array();

    if($fields) {
      $temp_max = count($fields["data"]);

      for($i = 0; $i < $temp_max; $i++) {
        $fieldId = $fields["data"][$i]["fieldId"];
        $filters[$fieldId] = $fields["data"][$i];
      }
    }

    $csort_mode = '';

    if(substr($sort_mode,0,2) == "f_") {
      list($a,$csort_mode,$corder) = split('_',$sort_mode);
    }

    $trackerId = (int) $trackerId;

    if($trackerId == -1) {
      $mid = " where 1=1 ";
      $bindvars = array();
    }

    else {
      $mid = " where tti.`trackerId`=? ";
      $bindvars = array($trackerId);
    }

    if($status) {
      $mid.= " and tti.`status`=? ";
      $bindvars[] = $status;
    }

    if($initial) {
      $mid.= "and ttif.`value` like ?";
      $bindvars[] = $initial.'%';
    }

    if(!$sort_mode) {
      $temp_max = count($fields["data"]);

      for($i = 0; $i < $temp_max; $i++) {
        if($fields['data'][$i]['isMain'] == 'y') {
          $csort_mode = $fields['data'][$i]['name'];
          break;
        }
      }
    }

    if($csort_mode) {
      $sort_mode = $csort_mode."_desc";
      $bindvars[] = $csort_mode;
      $query = "select tti.*, ttif.`value` from `tiki_tracker_items` tti, `tiki_tracker_item_fields` ttif, `tiki_tracker_fields` ttf  ";
      $query.= " $mid and tti.`itemId`=ttif.`itemId` and ttf.`fieldId`=ttif.`fieldId` and ttf.`name`=? order by ttif.`value`";
      $query_cant = "select count(*) from `tiki_tracker_items` tti, `tiki_tracker_item_fields` ttif, `tiki_tracker_fields` ttf  ";
      $query_cant.= " $mid and tti.`itemId`=ttif.`itemId` and ttf.`fieldId`=ttif.`fieldId` and ttf.`name`=? ";
    }

    else {
      if(!$sort_mode) {
        $sort_mode = "lastModif_desc";
      }

      $query = "select * from `tiki_tracker_items` tti $mid order by ".$this->convert_sortmode($sort_mode);
      $query_cant = "select count(*) from `tiki_tracker_items` tti $mid ";
    }

    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      $fields = array();

      $itid = $res["itemId"];
      $query2 = "select ttif.`fieldId`,`name`,`value`,`type`,`isTblVisible`,`isMain`,`position`
                from `tiki_tracker_item_fields` ttif, `tiki_tracker_fields` ttf
                where ttif.`fieldId`=ttf.`fieldId` and `itemId`=? order by `position` asc";
      $result2 = $this->query($query2,array((int) $res["itemId"]));
      $pass = true;

      $kx = "";

      while($res2 = $result2->fetchRow()) {
        // Check if the field is visible!
        $fieldId = $res2["fieldId"];

        if(count($filters) > 0) {
          if(isset($filters["$fieldId"]["value"]) and $filters["$fieldId"]["value"]) {
            if($filters["$fieldId"]["type"] == 'a' || $filters["$fieldId"]["type"] == 't') {
              if(!stristr($res2["value"], $filters["$fieldId"]["value"]))
                $pass = false;
            }

            else {
              if(strtolower($res2["value"]) != strtolower($filters["$fieldId"]["value"])) {
                $pass = false;
              }
            }
          }

          if(ereg_replace("[^a-zA-Z0-9]","",$res2["name"]) == $csort_mode) {
            $kx = $res2["value"].$itid;
          }
        }

        $fields[] = $res2;
      }

      $res["field_values"] = $fields;
      $res["comments"] = $this->getOne("select count(*) from `tiki_tracker_item_comments` where `itemId`=?",array((int) $itid));

      if($pass) {
        $kl = $kx.$itid;
        $ret["$kl"] = $res;
      }
    }

    ksort($ret);
    //$ret=$this->sort_items_by_condition($ret,$sort_mode);
    $retval = array();
    $retval["data"] = array_values($ret);
    $retval["cant"] = $cant;
    return $retval;
  }

  /*
   * Score methods begin
   */

  // All information about an event type
  // shared
  function get_event($event) {
    $query = "select * from `tiki_score` where `event`=?";
    $result = $this->query($query,array($event));
    return $result->fetchRow();
  }


  /*
   * Checks if an event should be scored and grants points to proper user
   * $multiplier is for rating events, in which the score will
   * be multiplied by other user's rating. Not yet used
   *
   * shared
   */
  function score_event($user, $event_type, $id = '', $multiplier=false) {
    global $scorelib;

    if(!is_object($scorelib)) {
      include_once("lib/score/scorelib.php");
    }

    if($user == 'admin' || !$user) {
      return;
    }

    $event = $scorelib->get_event($event_type);

    if(!$event || !$event['score']) {
      return;
    }

    $score = $event['score'];

    if($multiplier) {
      $score *= $multiplier;
    }

    if($id || $event['expiration']) {
      $expire = $event['expiration'];
      $event_id = $event_type . '_' . $id;

      $query = "select count(*) from `tiki_users_score` where `user`=? and `event_id`=?";
      $bindvars = array($user, $event_id);

      if($expire) {
        $query .= " and `expire` > ?";
        $bindvars[] = time();
      }

      if($this->getOne($query, $bindvars)) {
        return;
      }

      $query = "delete from `tiki_users_score` where `user`=? and `event_id`=?";
      $this->query($query, array($user, $event_id));

      $query = "insert into `tiki_users_score` (`user`, `event_id`, `expire`) values (?, ?, ?)";
      $this->query($query, array($user, $event_id, time() + ($expire*60)));
    }

    $query = "update `users_users` set `score` = `score` + ? where `login`=?";
    $event['id'] = $id; // just for debug

    $this->query($query, array($score, $user));
    return;
  }

  // List users by best scoring
  // shared
  function rank_users($limit = 10, $start = 0) {
    if(!$start) {
      $start = "0";
    }

    // admin doesn't go on ranking
    $query = "select `userId`, `login`, `score` from `users_users` where `login` <> 'admin' order by `score` desc";

    $result = $this->query($query,array(),$limit,$start);
    $ranking = array();

    while($res = $result->fetchRow()) {
      $res['position'] = ++$start;
      $ranking[] = $res;
    }

    return $ranking;
  }

  // Returns html <img> tag to star corresponding to user's score
  // shared
  function get_star($score) {
    $star = '';

    $star_colors = array(0 => 'grey',
                         100 => 'blue',
                         500 => 'green',
                         1000 => 'yellow',
                         2500 => 'orange',
                         5000 => 'red',
                         10000 => 'purple');

    foreach($star_colors as $boundary => $color) {
      if($score >= $boundary) {
        $star = 'star_'.$color.'.gif';
      }
    }

    if(!empty($star)) {
      $alt = sprintf(tra("%d points"), $score);
      $star = "<img src='img/icons/$star' height='11' width='11' alt='$alt' />&nbsp;";
    }

    return $star;
  }

  /*
   * Score methods end
   */


  //shared
  // \todo remove all hardcoded html in get_user_avatar()
  function get_user_avatar($user, $float = "") {
    global $userlib;

    if(empty($user))
      return '';

    $query = "select `login`,`avatarType`,`avatarLibName` from `users_users` where `login`=?";
    $result = $this->query($query,array($user));

    $res = $result->fetchRow();

    if(!$res) {
      return '';
    }

    $type = $res["avatarType"];
    $libname = $res["avatarLibName"];

    $ret = '';
    $style = '';

    if(strcasecmp($float, "left") == 0) {
      $style = "style='float:left;margin-right:5px;'";
    }

    else if(strcasecmp($float, "right") == 0) {
      $style = "style='float:right;margin-left:5px;'";
    }

    switch($type) {
    case 'n':
      $ret = '';
      break;

    case 'l':
      $ret = "<img border='0' width='45' height='45' src='" . $libname . "' " . $style . " alt='$user' />";
      break;

    case 'u':
      $ret = "<img border='0' width='45' height='45' src='tiki-show_user_avatar.php?user=$user' " . $style . " alt='$user' />";
      break;
    }

    return $ret;
  }

  /*shared*/
  function get_forum_sections() {
    $query = "select distinct `section` from `tiki_forums` where `section`<>?";
    $result = $this->query($query,array(''));
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res["section"];
    }

    return $ret;
  }

  /* Referer stats */
  /*shared*/
  function register_referer($referer) {
    $now = date("U");
    $cant = $this->getOne("select count(*) from `tiki_referer_stats` where `referer`=?",array($referer));

    if($cant) {
      $query = "update `tiki_referer_stats` set `hits`=`hits`+1,`last`=? where `referer`=?";
    }

    else {
      $query = "insert into `tiki_referer_stats`(`last`,`referer`,`hits`) values(?,?,1)";
    }

    $result = $this->query($query,array((int)$now,$referer));
  }

  // File attachments functions for the wiki ////
  /*shared*/
  function add_wiki_attachment_hit($id) {
    global $count_admin_pvs, $user;

    if($count_admin_pvs == 'y' || $user != 'admin') {
      $query = "update `tiki_wiki_attachments` set `downloads`=`downloads`+1 where `attId`=?";
      $result = $this->query($query,array((int)$id));
    }

    return true;
  }

  /*shared*/
  function get_wiki_attachment($attId) {
    $query = "select * from `tiki_wiki_attachments` where `attId`=?";
    $result = $this->query($query,array((int)$attId));

    if(!$result->numRows()) return false;

    $res = $result->fetchRow();
    return $res;
  }

  /*shared*/
  function get_random_image($galleryId = -1) {
    $whgal = "";
    $bindvars = array();

    if(((int)$galleryId) != -1) {
      $whgal = " where `galleryId`=? ";
      $bindvars[] = (int) $galleryId;
    }

    $query = "select count(*) from `tiki_images` $whgal";
    $cant = $this->getOne($query,$bindvars);
    $ret = array();

    if($cant) {
      $pick = rand(0, $cant - 1);

      $query = "select `imageId` ,`galleryId`,`name` from `tiki_images` $whgal";
      $result = $this->query($query,$bindvars,1,$pick);
      $res = $result->fetchRow();
      $ret["galleryId"] = $res["galleryId"];
      $ret["imageId"] = $res["imageId"];
      $ret["name"] = $res["name"];
      $query = "select `name`  from `tiki_galleries` where `galleryId` = ?";
      $ret["gallery"] = $this->getOne($query,array((int)$res["galleryId"]));
    }

    else {
      $ret["galleryId"] = 0;

      $ret["imageId"] = 0;
      $ret["name"] = tra("No image yet, sorry.");
    }

    return ($ret);
  }

  /*shared*/
  function get_gallery($id) {
    $query = "select * from `tiki_galleries` where `galleryId`=?";
    $result = $this->query($query,array((int) $id));
    $res = $result->fetchRow();
    return $res;
  }

  // Last visit module ////
  /*shared*/
  function get_news_from_last_visit($user) {
    if(!$user) return false;

    $last = $this->getOne("select `lastLogin`  from `users_users` where `login`=?",array($user));
    $ret = array();

    if(!$last) {
      $last = time();
    }

    $ret["lastVisit"] = $last;
    $ret["images"] = $this->getOne("select count(*) from `tiki_images` where `created`>?",array((int)$last));
    $ret["pages"] = $this->getOne("select count(*) from `tiki_pages` where `lastModif`>?",array((int)$last));
    $ret["files"] = $this->getOne("select count(*) from `tiki_files` where `created`>?",array((int)$last));
    $ret["comments"] = $this->getOne("select count(*) from `tiki_comments` where `commentDate`>?",array((int)$last));
    $ret["users"] = $this->getOne("select count(*) from `users_users` where `registrationDate`>?",array((int)$last));
    $ret["trackers"] = $this->getOne("select count(*) from `tiki_tracker_items` where `lastModif`>?",array((int)$last));
    return $ret;
  }

  // Templates ////
  /*shared*/
  function list_templates($section, $offset, $maxRecords, $sort_mode, $find) {
    $bindvars = array($section);

    if($find) {
      $findesc = '%'.$find.'%';
      $mid = " and (`content` like ?)";
      $bindvars[] = $findesc;
    }

    else {
      $mid = "";
    }

    $query = "select `name` ,`created`,tcts.`templateId` from `tiki_content_templates` tct, `tiki_content_templates_sections` tcts ";
    $query.= " where tcts.`templateId`=tct.`templateId` and `section`=? $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_content_templates` tct, `tiki_content_templates_sections` tcts ";
    $query_cant.= "where tcts.`templateId`=tct.`templateId` and `section`=? $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      $query2 = "select `section`  from `tiki_content_templates_sections` where `templateId`=?";

      $result2 = $this->query($query2,array((int)$res["templateId"]));
      $sections = array();

      while($res2 = $result2->fetchRow()) {
        $sections[] = $res2["section"];
      }

      $res["sections"] = $sections;
      $ret[] = $res;
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  /*shared*/
  function get_template($templateId) {
    $query = "select * from `tiki_content_templates` where `templateId`=?";
    $result = $this->query($query,array((int)$templateId));

    if(!$result->numRows()) return false;

    $res = $result->fetchRow();
    return $res;
  }
  // templates ////

  /*shared*/
  function list_games($offset, $maxRecords, $sort_mode, $find) {
    $bindvars = array();

    if($find) {
      $findesc = '%'.$find.'%';
      $mid = " where (`gameName` like ?)";
      $bindvars[] = $findesc;
    }

    else {
      $mid = "";
    }

    $query = "select * from `tiki_games` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_games` $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      $parts = explode('.', $res["gameName"]);

      $res["thumbName"] = $parts[0];
      $ret[] = $res;
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  /*shared*/
  function pick_cookie() {
    $cant = $this->getOne("select count(*) from `tiki_cookies`",array());

    if(!$cant) return '';

    $bid = rand(0, $cant - 1);
    //$cookie = $this->getOne("select `cookie`  from `tiki_cookies` limit $bid,1"); getOne seems not to work with limit
    $result = $this->query("select `cookie`  from `tiki_cookies`",array(),1,$bid);

    if($res = $result->fetchRow()) {
      $cookie = str_replace("\n", "", $res['cookie']);
      return preg_replace('/^(.+?)(\s*--.+)?$/','<i>"$1"</i>$2',$cookie);
    }

    else
      return "";
  }

  function get_pv_chart_data($days) {
    $now = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
    $dfrom = 0;

    if($days != 0) $dfrom = $now - ($days * 24 * 60 * 60);

    $query = "select `day`, `pageviews` from `tiki_pageviews` where `day`<=? and `day`>=?";
    $result = $this->query($query,array((int)$now,(int)$dfrom));
    $ret = array();
    $n = ceil($result->numRows() / 10);
    $i = 0;
    $xdata=array();
    $ydata=array();

    while($res = $result->fetchRow()) {
      if($i % $n == 0) {
        $xdata[] = date("j M", $res["day"]);
      }

      else {
        $xdata = '';
      }

      $ydata[] = $res["pageviews"];
    }

    $ret['xdata']=$xdata;
    $ret['ydata']=$ydata;
    return $ret;
  }

  function add_pageview() {
    $dayzero = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
//echo "PAGEVIEW:".date('r', $dayzero).'<br>';
    $cant = $this->getOne("select count(*) from `tiki_pageviews` where `day`=?",array((int)$dayzero));

    if($cant) {
      $query = "update `tiki_pageviews` set `pageviews`=`pageviews`+1 where `day`=?";
    }

    else {
      $query = "insert into `tiki_pageviews`(`day`,`pageviews`) values(?,1)";
    }

    $result = $this->query($query,array((int)$dayzero),-1,-1,false);
  }

  function get_usage_chart_data() {
    $this->compute_quiz_stats();
    $data['xdata'][] = tra('wiki');
    $data['ydata'][] = $this->getOne('select sum(`hits`) from `tiki_pages`',array());

    $data['xdata'][] = tra('img-g');
    $data['ydata'][] = $this->getOne('select sum(`hits`) from `tiki_galleries`',array());

    $data['xdata'][] = tra('file-g');
    $data['ydata'][] = $this->getOne('select sum(`hits`) from `tiki_file_galleries`',array());

    $data['xdata'][] = tra('faqs');
    $data['ydata'][] = $this->getOne('select sum(`hits`) from `tiki_faqs`',array());

    $data['xdata'][] = tra('quizzes');
    $data['ydata'][] = $this->getOne('select sum(`timesTaken`) from `tiki_quiz_stats_sum`',array());

    $data['xdata'][] = tra('arts');
    $data['ydata'][] = $this->getOne('select sum(`nbreads`) from `tiki_articles`',array());

    $data['xdata'][] = tra('blogs');
    $data['ydata'][] = $this->getOne('select sum(`hits`) from `tiki_blogs`',array());

    $data['xdata'][] = tra('forums');
    $data['ydata'][] = $this->getOne('select sum(`hits`) from `tiki_forums`',array());

    $data['xdata'][] = tra('games');
    $data['ydata'][] = $this->getOne('select sum(`hits`) from `tiki_games`',array());
    return $data;
  }

  // User assigned modules ////
  /*shared*/
  function get_user_id($user) {
    $id = $this->getOne("select `userId` from `users_users` where `login`=?", array($user),-1,-1,false);
    return $id;
  }

  /*shared*/
  function get_groups_all($group) {
    $query = "select `groupName`  from `tiki_group_inclusion` where `includeGroup`=?";
    $result = $this->query($query, array($group));
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res["groupName"];
      $ret2 = $this->get_groups_all($res["groupName"]);
      $ret = array_merge($ret, $ret2);
    }

    return array_unique($ret);
  }

  /*shared*/
  function get_included_groups($group) {
    $query = "select `includeGroup`  from `tiki_group_inclusion` where `groupName`=?";
    $result = $this->query($query, array($group));
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res["includeGroup"];
      $ret2 = $this->get_included_groups($res["includeGroup"]);
      $ret = array_merge($ret, $ret2);
    }

    return array_unique($ret);
  }

  /*shared*/
  function get_user_groups($user) {
    global $feature_intertiki,$interlist,$feature_intertiki_mymaster;

    if(!$user) {
      $ret = array();
      $ret[] = "Anonymous";
      return $ret;
    }

    elseif($feature_intertiki == 'y' and empty($feature_intertiki_mymaster) and strstr($user,'@')) {
      $realm = substr($user,strpos($user,'@')+1);
      $user = substr($user,0,strpos($user,'@'));

      if(isset($interlist[$realm])) {
        $groups = $interlist[$realm]['groups'].',Anonymous';
        return split(',',$interlist[$realm]['groups']);
      }
    }
    elseif(!isset($this->usergroups_cache[$user])) {
      $userid = $this->get_user_id($user);
      $query = "select `groupName`  from `users_usergroups` where `userId`=?";
      $result=$this->query($query,array((int) $userid));
      $ret = array();

      while($res = $result->fetchRow()) {
        $ret[] = $res["groupName"];
        $included = $this->get_included_groups($res["groupName"]);
        $ret = array_merge($ret, $included);
      }

      $ret[] = "Registered";
      $ret[] = "Anonymous";
      $ret = array_unique($ret);
      $this->usergroups_cache[$user] = $ret;
      return $ret;
    }

    else {
      return $this->usergroups_cache[$user];
    }
  }

  function get_user_cache_id($user) {
    $groups = $this->get_user_groups($user);
    sort($groups, SORT_STRING);
    $cacheId = implode(":", $groups);

    if($user == 'admin') {
      // in this case user get permissions from no group
      $cacheId = 'ADMIN:'.$cacheId;
    }

    return $cacheId;
  }


  // Functions for FAQs ////
  /*shared*/
  function list_faqs($offset, $maxRecords, $sort_mode, $find) {

    if($find) {
      $findesc = '%' . $find . '%';
      $mid = " where (`title` like ? or `description` like ?)";
      $bindvars=array($findesc,$findesc);
    }

    else {
      $mid = "";
      $bindvars=array();
    }

    $query = "select * from `tiki_faqs` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_faqs` $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {

      global $user;
      $add=$this->user_has_perm_on_object($user,$res['faqId'],'faq','tiki_p_view_faqs');

      if($add) {
        $res["suggested"] = $this->getOne("select count(*) from `tiki_suggested_faq_questions` where `faqId`=?",array((int) $res["faqId"]));
        $ret[] = $res;
      }

    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  /*shared */
  function get_faq($faqId) {
    $query = "select * from `tiki_faqs` where `faqId`=?";
    $result = $this->query($query,array((int)$faqId));

    if(!$result->numRows()) return false;

    $res = $result->fetchRow();
    return $res;
  }
  // End Faqs ////

  /*shared*/
  function genPass() {
    $length=8;
    $vocales = "aeiouAEIOU";
    $consonantes = "bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ0123456789_";
    $r = '';

    for($i = 0; $i < $length; $i++) {
      if($i % 2) {
        $r .= $vocales {rand(0, strlen($vocales) - 1)};
      }

      else {
        $r .= $consonantes {rand(0, strlen($consonantes) - 1)};
      }
    }

    return $r;
  }

  // generate a random string (for unsubscription code etc.)
  function genRandomString($base="") {
    if($base == "") $base = $this->genPass();

    $base .= microtime();
    return md5($base);
  }

  // This function calculates the pageRanks for the tiki_pages
  // it can be used to compute the most relevant pages
  // according to the number of links they have
  // this can be a very interesting ranking for the Wiki
  // More about this on version 1.3 when we add the pageRank
  // column to tiki_pages
  function pageRank($loops = 16) {
    $query = "select `pageName`  from `tiki_pages`";
    $result = $this->query($query,array());
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res["pageName"];
    }

    // Now calculate the loop
    $pages = array();

    foreach($ret as $page) {
      $val = 1 / count($ret);

      $pages[$page] = $val;
      // Fixed query.  -rlpowell
      $query = "update `tiki_pages` set `pageRank`=? where `pageName`= ?";
      $result = $this->query($query, array((int)$val, $page));
    }

    for($i = 0; $i < $loops; $i++) {
      foreach($pages as $pagename => $rank) {
        // Get all the pages linking to this one
        // Fixed query.  -rlpowell
        $query = "select `fromPage`  from `tiki_links` where `toPage` = ?";
        $result = $this->query($query, array($pagename));
        $sum = 0;

        while($res = $result->fetchRow()) {
          $linking = $res["fromPage"];

          if(isset($pages[$linking])) {
            // Fixed query.  -rlpowell
            $q2 = "select count(*) from `tiki_links` where `fromPage`= ?";
            $cant = $this->getOne($q2, array($linking));

            if($cant == 0) $cant = 1;

            $sum += $pages[$linking] / $cant;
          }
        }

        $val = (1 - 0.85) + 0.85 * $sum;
        $pages[$pagename] = $val;
        // Fixed query.  -rlpowell
        $query = "update `tiki_pages` set `pageRank`=? where `pageName`=?";
        $result = $this->query($query, array((int)$val, $pagename));

        // Update
      }
    }

    arsort($pages);
    return $pages;
  }

  // Spellchecking routine
  // Parameters:
  // what: what to spell check (a text)
  // where: where to replace (maybe the same text)
  // language: language to use
  // element: element where the text is going to be replaced (a textarea or similar)
  /*shared*/
  // \todo replace the hardcoded html by smarty template
  function spellcheckreplace($what, $where, $language, $element) {
    global $smarty;

    $trl = '';
    $words = preg_split("/\s/", $what);

    foreach($words as $word) {
      if(preg_match("/^[A-Z]?[a-z]+$/", $word) && strlen($word) > 1) {
        $result = $this->spellcheckword($word, $language);

        if(count($result) > 0) {
          // Replace the word with a warning color in the edit_data
          // Prepare the replacement
          $sugs = $result[$word];

          $first = 1;
          $repl = '';

          $popup_text = '';

          if(count($sugs) > 0) {
            $asugs = array_keys($sugs);

            $temp_max = count($asugs);

            for($i = 0; $i < $temp_max && $i < 5; $i++) {
              $sug = $asugs[$i];

              // If you want to use the commented out line below, please remove the \ in <\/script>; it was breaking vim highlighting.  -rlpowell
              // $repl.="<script type='text/javascript'>param_${word}_$i = new Array(\\\"$element\\\",\\\"$word\\\",\\\"$sug\\\");<\/script><a href=\\\"javascript:replaceLimon(param_${word}_$i);\\"."\">$sug</a><br />";
              $repl .= "<a href=\'javascript:param=doo_${word}_$i();replaceLimon(param);\'>".addslashes($sug)."</a><br />";
              $trl .= "<script type='text/javascript'>function doo_${word}_$i(){ aux = new Array(\"$element\",\"$word\",\"$sug\"); return aux;}</script>";
            }

            //$popup_text = " <a title=\"".$sug."\" style=\"text-decoration:none; color:red;\" onclick='"."return overlib(".'"'.$repl.'"'.",STICKY,CAPTION,".'"'."SpellChecker suggestions".'"'.");'>".$word.'</a> ';
            $popup_text = " <a title=\"Click for a list of spelling suggestions\" style=\"text-decoration: none; color:red;\" onclick=\"return overlib('$repl',STICKY,CAPTION,'Spellchecker suggestions');\">$word</a> ";
          }

          //print("popup: <pre>".htmlentities($popup_text)."</pre><br />");
          if($popup_text) {
            $where = preg_replace("/\s$word\s/", $popup_text, $where);
          }

          else {
            $where = preg_replace("/\s$word\s/", ' <span style="color:red;">' . $word . '</span> ', $where);
          }

          $smarty->assign('trl', $trl);
          //$parsed = preg_replace("/\s$word\s/",' <a style="color:red;">'.$word.'</a> ',$parsed);
        }
      }
    }

    return $where;
  }

  /*shared*/
  function spellcheckword($word, $lang) {
    include_once("bablotron.php");

    $b = new bablotron($this->db, $lang);
    $result = $b->spellcheck_word($word);
    return $result;
  }

  /*shared*/
  function list_all_forum_topics($offset, $maxRecords, $sort_mode, $find) {
    $bindvars = array("forum",0);

    if($find) {
      $findesc = '%'.$find.'%';
      $mid = " and (`title` like ? or `data` like ?)";
      $bindvars[] = $findesc;
      $bindvars[] = $findesc;
    }

    else {
      $mid = "";
    }

    $query = "select * from `tiki_comments`,`tiki_forums` ";
    $query.= " where `object`=`forumId` and `objectType`=? and `parentId`=? $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_comments`,`tiki_forums` ";
    $query_cant.= " where `object`=`forumId` and `objectType`=? and `parentId`=? $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $now = date("U");
    $ret = array();

    while($res = $result->fetchRow()) {

      global $user;
      $add=$this->user_has_perm_on_object($user,$res['forumId'],'forums','tiki_p_forum_read');

      if($add) {
        $ret[] = $res;
      }
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  /*shared*/
  function list_forum_topics($forumId, $offset, $maxRecords, $sort_mode, $find) {
    $bindvars = array($forumId,$forumId,'forum',0);

    if($find) {
      $findesc = '%'.$find.'%';
      $mid = " and (`title` like ? or `data` like ?)";
      $bindvars[] = $findesc;
      $bindvars[] = $findesc;
    }

    else {
      $mid = "";
    }

    $query = "select * from `tiki_comments`,`tiki_forums` where ";
    $query.= " `forumId`=? and `object`=? and `objectType`=? and `parentId`=? $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_comments`,`tiki_forums` where ";
    $query_cant.= " `forumId`=? and `object`=? and `objectType`=? and `parentId`=? $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $now = date("U");
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res;
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  /*shared*/
  function remove_object($type, $id) {
    global $categlib, $dbTiki;

    if(!is_object($categlib)) {
      require_once("lib/categories/categlib.php");
    }

    $categlib->uncategorize_object($type, $id);
    // Now remove comments
    $object = $type . $id;
    $query = "delete from `tiki_comments` where `object`=?  and `objectType`=?";
    $result = $this->query($query, array($id, $type));
    // Remove individual permissions for this object if they exist
    $query = "delete from `users_objectpermissions` where `objectId`=? and `objectType`=?";
    $result = $this->query($query,array(md5($object),$type));
    // remove object
    global $objectlib;
    $objectlib->delete_object($type, $id);
    return true;
  }

  /*shared*/
  // function enhancing php in_array() function
  function in_multi_array($needle, $haystack) {
    $in_multi_array = false;

    if(in_array($needle, $haystack)) {
      $in_multi_array = true;
    }

    else {
      while(list($tmpkey, $tmpval) = each($haystack)) {
        if(is_array($haystack[$tmpkey])) {
          if($this->in_multi_array($needle, $haystack[$tmpkey])) {
            $in_multi_array = true;
            break;
          }
        }
      }
    }

    return $in_multi_array;
  }

  /*shared*/
  function list_received_pages($offset, $maxRecords, $sort_mode = 'pageName_asc', $find) {
    $bindvars = array();

    if($find) {
      $findesc = '%'.$find.'%';
      $mid = " where (`pagename` like ? or `data` like ?)";
      $bindvbars[] = $findesc;
      $bindvbars[] = $findesc;
    }

    else {
      $mid = "";
    }

    $query = "select * from `tiki_received_pages` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_received_pages` $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      if($this->page_exists($res["pageName"])) {
        $res["exists"] = 'y';
      }

      else {
        $res["exists"] = 'n';
      }

      $ret[] = $res;
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  // Functions for the menubuilder and polls////
  /*Shared*/
  function get_menu($menuId) {
    $query = "select * from `tiki_menus` where `menuId`=?";
    $result = $this->query($query,array((int)$menuId));

    if(!$result->numRows()) return false;

    $res = $result->fetchRow();
    return $res;
  }

  /*shared*/
  function list_menu_options($menuId, $offset, $maxRecords, $sort_mode, $find, $full=false) {
    global $smarty,$user, $tiki_p_admin;
    $ret = array();
    $retval = array();
    $bindvars = array((int)$menuId);

    if($find) {
      $mid = " where `menuId`=? and (`name` like ? or `url` like ?)";
      $bindvars[] = '%'. $find . '%';
      $bindvars[] = '%'. $find . '%';
    }

    else {
      $mid = " where `menuId`=? ";
    }

    $query = "select * from `tiki_menu_options` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_menu_options` $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);

    while($res = $result->fetchRow()) {
      if(!$full) {
        $display = true;

        if(isset($res['section']) and $res['section']) {
          $sections = split(",",$res['section']);
          foreach($sections as $sec) {
            if(!isset($smarty->_tpl_vars["$sec"]) or $smarty->_tpl_vars["$sec"] != 'y') {
              $display = false;
              break;
            }
          }
        }

        if($display && $tiki_p_admin != 'y') {
          if(isset($res['perm']) and $res['perm']) {
            $sections = split(",",$res['perm']);
            foreach($sections as $sec) {
              if(!isset($smarty->_tpl_vars["$sec"]) or $smarty->_tpl_vars["$sec"] != 'y') {
                $display = false;
                break;
              }
            }
          }
        }

        if($display && $tiki_p_admin != 'y') {
          $usergroups = $this->get_user_groups($user);

          if(isset($res['groupname']) and $res['groupname']) {
            $sections = split(",",$res['groupname']);
            foreach($sections as $sec) {
              if($sec and !in_array($sec,$usergroups)) {
                $display = false;
              }
            }
          }
        }

        if($display) {
          $pos = $res['position'];
          $ret["$pos"] = $res;
        }
      }

      else {
        $ret[] = $res;
      }
    }

    $retval["data"] = array_values($ret);
    $retval["cant"] = $cant;
    return $retval;
  }

  /* shared
   * gets result from list_menu_options and sorts "sorted section" sections.
   */
  function sort_menu_options($channels) {

    $sorted_channels = array();

    if(isset($channels['data'])) {
      $cant = $channels['cant'];
      $channels = $channels['data'];
    }

    $temp_max = sizeof($channels);

    for($i=0; $i < $temp_max; $i++) {
      $sorted_channels[$i] = $channels[$i];

      if($sorted_channels[$i]['type'] == 'r') {  // sorted section
        $sorted_channels[$i]['type'] = 's'; // common section, let's make it transparent
        $i++;
        $section = array();

        while($i < sizeof($channels) && $channels[$i]['type'] == 'o') {
          $section[] = $channels[$i];
          $i++;
        }

        $i--;
        include_once('lib/smarty_tiki/function.menu.php');
        usort($section, "compare_menu_options");
        $sorted_channels = array_merge($sorted_channels, $section);
      }
    }

    if(isset($cant)) {
      $sorted_channels = array('data' => $sorted_channels,
                               'cant' => $cant);
    }

    return $sorted_channels;
  }

  // Menubuilder ends ////

  // User voting system ////
  // Used to vote everything (polls,comments,files,submissions,etc) ////
  // Checks if a user has voted
  /*shared*/
  function user_has_voted($user, $id) {
    // If user is not logged in then check the session
    if(!$user) {
      $votes = $_SESSION["votes"];

      if(in_array($id, $votes)) {
        $ret = true;
      }

      else {
        $ret = false;
      }
    }

    else {
      $query = "select count(*) from `tiki_user_votings` where `user`=? and `id`=?";
      $result = $this->getOne($query,array($user,(string) $id));

      if($result) {
        $ret = true;
      }

      else {
        $ret = false;
      }
    }

    return $ret;
  }

  // Registers a user vote
  /*shared*/
  function register_user_vote($user, $id, $optionId=false) {
    // If user is not logged in then register in the session
    if(!$user) {
      $_SESSION["votes"][] = $id;
    }

    else {
      if($optionId !== false)
      {
        $query = "delete from `tiki_user_votings` where `user`=? and `id`=?";
        $result = $this->query($query,array($user,(string) $id));
        $query = "insert into `tiki_user_votings`(`user`,`id`, `optionId` ) values(?,?,?)";
        $result = $this->query($query,array($user,(string) $id, $optionId));
      }

      else {
        $query = "delete from `tiki_user_votings` where `user`=? and `id`=?";
        $result = $this->query($query,array($user,(string) $id));
        $query = "insert into `tiki_user_votings`(`user`,`id` ) values(?,?)";
        $result = $this->query($query,array($user,(string) $id));
      }
    }
  }

  function get_user_vote($id,$user) {
    return $this->getOne("select `optionId` from `tiki_user_votings` where `user` = ? and `id` = ?",array($user, $id));
  }
  // end of user voting methods

  // FILE GALLERIES ////
  /*shared*/
  function list_files($offset, $maxRecords, $sort_mode, $find) {
    $bindvars = array();

    if($find) {
      $findesc = '%' . $find . '%';
      $mid = " where (`name` like ? or `description` like ?)";
      $bindvars[] = '%'. $find . '%';
      $bindvars[] = '%'. $find . '%';
    }

    else {
      $mid = "";
    }

    $query = "select `fileId` ,`name`,`description`,`created`,`filename`,`filesize`,`user`,`downloads` ";
    $query.= " from `tiki_files` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_files` $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res;
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  /*shared*/
  function get_file($id) {
    $query = "select `path`,`galleryId`,`filename`,`filetype`,`data`,`filesize`,`name`,`description` from `tiki_files` where `fileId`=?";
    $query = "select `path` ,`galleryId`,`filename`,`filetype`,`data`,`filesize` from `tiki_files` where `fileId`=?";
    $result = $this->query($query,array((int) $id));
    $res = $result->fetchRow();
    return $res;
  }

  /*shared: added by AW*/
  function get_file_by_name($galleryId, $name) {
    $query = "select `fileId`,`path`,`galleryId`,`filename`,`filetype`,`data`,`filesize`,`name`,`description`, `created` from `tiki_files` where `galleryId`=? AND `name`=? ORDER BY created DESC LIMIT 1";
    $result = $this->query($query,array((int) $galleryId, $name));
    $res = $result->fetchRow();
    return $res;
  }

  /*Shared*/
  function get_files($offset, $maxRecords, $sort_mode, $find, $galleryId) {

    if($find) {
      $findesc='%' . $find . '%';
      $mid = " where `galleryId`=? and (upper(`name`) like upper(?) or upper(`description`) like upper(?))";
      $bindvars=array((int) $galleryId,$findesc,$findesc);
    }

    else {
      $mid = "where `galleryId`=?";
      $bindvars=array((int) $galleryId);
    }

    $query = "select `fileId` ,`name`,`description`,`created`,`filename`,`filesize`,`user`,`downloads`,`lastModif`,`lastModifUser` from `tiki_files` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_files` $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res;
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  /*shared*/
  function add_file_hit($id) {
    global $count_admin_pvs, $user;

    if($count_admin_pvs == 'y' || $user != 'admin') {
      $query = "update `tiki_files` set `downloads`=`downloads`+1 where `fileId`=?";
      $result = $this->query($query,array((int) $id));
    }

    global $feature_score;

    if($feature_score == 'y') {
      $this->score_event($user, 'fgallery_download', $id);
      $query = "select `user` from `tiki_files` where `fileId`=?";
      $owner = $this->getOne($query, array((int)$id));
      $this->score_event($owner, 'fgallery_is_downloaded', "$user:$id");
    }

    return true;
  }

  /*shared*/
  function add_file_gallery_hit($id) {
    global $count_admin_pvs, $user;

    if($count_admin_pvs == 'y' || $user != 'admin') {
      $query = "update `tiki_file_galleries` set `hits`=`hits`+1 where `galleryId`=?";
      $result = $this->query($query,array((int) $id));
    }

    return true;
  }

  /*shared*/
  function get_file_gallery($id) {
    $query = "select * from `tiki_file_galleries` where `galleryId`=?";
    $result = $this->query($query,array((int) $id));
    $res = $result->fetchRow();
    return $res;
  }

  /*shared*/
  function list_visible_file_galleries($offset = 0, $maxRecords = -1, $sort_mode = 'name_desc', $user, $find) {
    // If $user is admin then get ALL galleries, if not only user galleries are shown

    $old_sort_mode = '';
    $bindvars = array('y');
    $whuser = "";

    if(in_array($sort_mode, array('files_desc', 'files_asc'))) {
      $old_offset = $offset;
      $old_maxRecords = $maxRecords;
      $old_sort_mode = $sort_mode;
      $sort_mode = 'user_desc';
      $offset = 0;
      $maxRecords = -1;
    }

    // If the user is not admin then select `it` 's own galleries or public galleries
    if($user != 'admin') {
      $whuser.= " and (`user`=? or `public`=?)";
      $bindvars[] = $user;
      $bindvars[] = "y";
    }

    if($find) {
      $findesc = '%' . $find . '%';
      $whuser .= " and (`name` like ? or `description` like ?)";
      $bindvars[] = $findesc;
      $bindvars[] = $findesc;
    }

    $query = "select * from `tiki_file_galleries` where `visible`=? $whuser order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_file_galleries` where `visible`=? $whuser";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      $aux = array();

      $aux["name"] = $res["name"];
      $gid = $res["galleryId"];
      $aux["id"] = $gid;
      $aux["visible"] = $res["visible"];
      $aux["galleryId"] = $res["galleryId"];
      $aux["description"] = $res["description"];
      $aux["created"] = $res["created"];
      $aux["lastModif"] = $res["lastModif"];
      $aux["user"] = $res["user"];
      $aux["hits"] = $res["hits"];
      $aux["public"] = $res["public"];
//  The file count is not needed by any caller, so save the query. GG
//      $aux["files"] = $this->getOne("select count(*) from `tiki_files` where `galleryId`=?",array((int)$gid));
      $ret[] = $aux;
    }

    if($old_sort_mode == 'files_asc') {
      usort($ret, 'compare_files');
    }

    if($old_sort_mode == 'files_desc') {
      usort($ret, 'r_compare_files');
    }

    if(in_array($old_sort_mode, array('files_desc', 'files_asc'))) {
      $ret = array_slice($ret, $old_offset, $old_maxRecords);
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  // Semaphore functions ////
  function get_semaphore_user($semName) {
    return $this->getOne("select `user` from `tiki_semaphores` where `semName`=?",array($semName));
  }

  function semaphore_is_set($semName, $limit) {
    $now = date("U");
    $lim = $now - $limit;
    $query = "delete from `tiki_semaphores` where `semName`=? and `timestamp`<?";
    $result = $this->query($query,array($semName,(int)$lim));
    $query = "select `semName`  from `tiki_semaphores` where `semName`=?";
    $result = $this->query($query,array($semName));
    return $result->numRows();
  }

  function semaphore_set($semName) {
    global $user;

    if($user == '') {
      $user = 'anonymous';
    }

    $now = date("U");
    //  $cant=$this->getOne("select count(*) from `tiki_semaphores` where `semName`='$semName'");
    $query = "delete from `tiki_semaphores` where `semName`=?";
    $this->query($query,array($semName));
    $query = "insert into `tiki_semaphores`(`semName`,`timestamp`,`user`) values(?,?,?)";
    $result = $this->query($query,array($semName,(int)$now,$user));
    return $now;
  }

  function semaphore_unset($semName, $lock) {
    $query = "delete from `tiki_semaphores` where `semName`=? and `timestamp`=?";
    $result = $this->query($query,array($semName,(int)$lock));
  }

  // Hot words methods ////
  /*shared*/
  function get_hotwords() {
    static $cache_hotwords;

    if(isset($cache_hotwords)) {
      return $cache_hotwords;
    }

    $query = "select * from `tiki_hotwords`";
    $result = $this->query($query, array(),-1,-1, false);
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[$res["word"]] = $res["url"];
    }

    $cache_hotwords = $ret;
    return $ret;
  }

  // FRIENDS METHODS //
  function list_user_friends($user, $offset = 0, $maxRecords = -1, $sort_mode = 'login_asc', $find = '')
  {
    global $userlib;

    $sort_mode = $this->convert_sortmode($sort_mode);

    if($find) {
      $findesc = '%'.$find.'%';
      $mid=" and (u.`login` like ? or p.`value` like ?) ";
      $bindvars=array($user,$findesc,$findesc);
    }

    else {
      $mid='';
      $bindvars=array($user);
    }

    // TODO: same as list_users
    $query = "select u.*, p.`value` as realName from `tiki_friends` as f, `users_users` as u left join `tiki_user_preferences` p on u.`login`=p.`user` and p.`prefName` = 'realName' where u.`login`=f.`friend` and f.`user`=? and f.`user` <> f.`friend` $mid order by $sort_mode";
    $query_cant = "select count(*) from `tiki_friends` as f, `users_users` as u left join `tiki_user_preferences` p on u.`login`=p.`user` and p.`prefName` = 'realName' where u.`login`=f.`friend` and f.`user`=? $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = Array();

    while($res = $result->fetchRow()) {
      $res['realname'] = $this->get_user_preference($res['login'], 'realName');
      $ret[] = $res;
    }

    $retval = Array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;

  }

  function verify_friendship($user, $friend)
  {
    if($user == $friend) {
      return 0;
    }

    $query = "select count(*) from `tiki_friends` where `user`=? and `friend`=?";
    return $this->getOne($query, array($user, $friend));
  }

  function get_friends_count($user) {
    global $cachelib;
    $cacheKey = 'friends_count_'.$user;

    if($cachelib->isCached($cacheKey)) {
      return $cachelib->getCached($cacheKey);
    }

    else {
      $query = "select count(*) from `tiki_friends` where `user`=?";
      $count = $this->getOne($query, array($user));
      $cachelib->cacheItem($cacheKey, $count);
      return $count;
    }
  }


  function list_users($offset = 0, $maxRecords = -1, $sort_mode = 'realName', $find = '')
  {
    global $user;

    if($find) {
      $findesc = '%'.$find.'%';
      $mid=" where (`login` like ? or p.`value` like ?) ";
      $bindvars=array($user,$findesc,$findesc);
      $bindvars2=array($findesc,$findesc);
    }

    else {
      $mid='';
      $bindvars=array($user);
      $bindvars2=array();
    }

    $sort_mode = $this->convert_sortmode($sort_mode);

    // TODO: This is lousy, later we have to configure what fields would be fetched
    // but how to get preferences avoiding the join, sort by any field and paginate without
    // loading all user list in memory?

    // This query is not database independent. the "is not null" and the left join syntax should be replaced

    // Fixed the not null. After some research i came to the conclusion that only these dbms that i use
    // lack a ansi outer join syntax. I guess using outer joins should be ok. redflo.
    if(substr($sort_mode,1,5)=="local") {
      $query = "select u.*, f.`user` as friend, p.`value` as local from `users_users` as u left join `tiki_friends` as f on u.`login`=f.`friend` and f.`user`=? left join `tiki_user_preferences` p on u.`login`=p.`user` and p.`prefName`='local' $mid order by $sort_mode";
    }

    else {
      $query = "select u.*, f.`user` as friend, p.`value` as realName from `users_users` as u left join `tiki_friends` as f on u.`login`=f.`friend` and f.`user`=? left join `tiki_user_preferences` p on u.`login`=p.`user` and p.`prefName`='realName' $mid order by $sort_mode";
    }

    $query_cant = "select count(*) from `users_users` u left join `tiki_user_preferences` p on u.`login`=p.`user` and p.`prefName`='realName' $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars2);
    $ret = Array();

    while($res = $result->fetchRow()) {
      $res['friend']=!($res['friend']=='');
      $ret[] = $res;
    }

    for($i=0; $i<count($ret); $i++) {
      $query = "select * from `tiki_user_preferences` where `user`=?";
      $result = $this->query($query,array($ret[$i]["login"]));
      $retuser = array();

      while($res = $result->fetchRow()) {
        $retuser[] = $res;
      }

      $ret[$i]["preferences"]=$retuser;
    }

    $retval = Array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  // BLOG METHODS ////
  /*shared*/
  function list_blogs($offset = 0, $maxRecords = -1, $sort_mode = 'created_desc', $find = '') {

    if($find) {
      $findesc = '%' . $find . '%';

      $mid = " where (`title` like ? or `description` like ?) ";
      $bindvars=array($findesc,$findesc);
    }

    else {
      $mid = '';
      $bindvars=array();
    }

    $query = "select * from `tiki_blogs` $mid order by ".$this->convert_sortmode($sort_mode);
    $result = $this->query($query,$bindvars);
    $ret = array();
    $cant = 0;
    $nb = 0;
    $i = 0;

    while($res = $result->fetchRow()) {
      global $user;

      if($this->user_has_perm_on_object($user,$res['blogId'],'blog','tiki_p_read_blog')) {
        ++$cant;

        if($maxRecords == - 1 || ($i >= $offset && $nb < $maxRecords)) {
          $ret[] = $res;
          ++$nb;
        }

        ++$i;
      }
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  /*shared*/
  function get_blog($blogId) {
    $query = "select * from `tiki_blogs` where `blogId`=?";
    $result = $this->query($query,array((int)$blogId));

    if($result->numRows()) {
      $res = $result->fetchRow();
    }

    else {
      return false;
    }

    global $feature_score, $user;

    if($feature_score == 'y' && $user != $res['user']) {
      $this->score_event($user, 'blog_read', $blogId);
      $this->score_event($res['user'], 'blog_is_read', "$user:$blogId");
    }

    return $res;
  }

  /*shared*/
  function list_user_blogs($user, $include_public = false) {
    $query = "select * from `tiki_blogs` where `user`=? ";
    $bindvars=array($user);

    if($include_public) {
      $query .= " or `public`=?";
      $bindvars[]='y';
    }

    $query .= "order by `title` asc";
    $result = $this->query($query,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res;
    }

    return $ret;
  }

  function list_blogs_user_can_post($user, $include_public = false) {
    $query = "select * from `tiki_blogs` order by `title` asc";
    $result = $this->query($query);
    $ret = array();

    while($res = $result->fetchRow()) {
      if($res['user'] == $user || ($include_public && $res['public'] == 'y') || $this->user_has_perm_on_object($user, $res['blogId'], 'blog', 'tiki_p_blog_post'))
        $ret[] = $res;
    }

    return $ret;
  }

  function list_posts($offset = 0, $maxRecords = -1, $sort_mode = 'created_desc', $find = '', $filterByBlogId = -1) {

    if($filterByBlogId >= 0) {
      // get posts for a given blogId:
      $mid = " where ( `blogId` = ? ) ";
      $bindvars = array($filterByBlogId);
    }

    else {
      // get posts from all blogs
      $mid = '';
      $bindvars = array();
    }

    if($find) {
      $findesc = '%' . $find . '%';

      if($mid == "") {
        $mid = " where ";
      }

      else {
        $mid .= " and ";
      }

      $mid .= " ( `data` like ? ) ";
      $bindvars[] = $findesc;
    }

    $query = "select * from `tiki_blog_posts` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_blog_posts` $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      $blogId = $res["blogId"];

      $query = "select `title`  from `tiki_blogs` where `blogId`=?";
      $cant_com = $this->getOne("select count(*) from
                                `tiki_comments` where `object`=? and `objectType` = ?",
                                array((string) $res["postId"],'blog'));
      $res["comments"] = $cant_com;
      $res["blogTitle"] = $this->getOne($query,array((int)$blogId));
      $res["size"] = strlen($res["data"]);
      $ret[] = $res;
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  // CMS functions -ARTICLES- & -SUBMISSIONS- ////

  /*shared*/
# Returns a topicname from passed topicid
  function fetchtopicId($topic) {
    $topicId = '';
    $query = "select `topicId`  from `tiki_topics` where `name` = ?";
    $topicId = $this->getOne($query, array($topic));
    return $topicId;
  }

  /*shared*/
  function list_articles($offset = 0, $maxRecords = -1, $sort_mode = 'publishDate_desc', $find = '', $date = '', $user=false, $type = '', $topicId = '', $visible_only = 'y', $topic='', $categId='', $lang='') {
    global $userlib, $user;

    $mid = '';
    $bindvars=array();
    $fromSql = '';

    if($find) {
      $findesc = '%' . $find . '%';
      $mid = " where (`title` like ? or `heading` like ? or `body` like ?) ";
      $bindvars=array($findesc,$findesc,$findesc);
    }

    // type=>[!]a+b+c+d+...
    if($type) {
      $invert = "";
      $connect = " or ";

      // parameter list negated?
      if(substr($type,0,1)=="!") {
        $type = substr($type,1);
        $invert = "!";
        $connect = " and ";
      }

      $add = "";
      $rest = $type;

      while($rest <> "") {
        @list($type, $rest) = split("\+", $rest, 2);  //split 'x+y+z' into 'x' and 'y+z'

        if($type <>"") {
          if($add == "") {
            if($mid) {
              $mid .= " and ";
            }

            else {
              $mid = " where ";
            }
          }

          else {
            $add .= $connect;
          }

          $add .= " `tiki_articles`.`type`$invert=? ";
          $bindvars[] = $type;
        }
      }

      if($add <> "") {
        $mid .= " ( ".$add." ) ";
      }
    }

    // topicId=>[!]a+b+c+d+...
    if(($topicId) || ($topicId=="0")) {
      $invert = "";
      $connect = " or ";

      // parameter list negated?
      if(substr($topicId,0,1)=="!") {
        $topicId = substr($topicId,1);
        $invert = "!";
        $connect = " and ";
      }

      $add = "";
      $rest = $topicId;

      while($rest <> "") {
        @list($topicId, $rest) = split("\+", $rest, 2);  //split 'x+y+z' into 'x' and 'y+z'

        if($topicId <>"") {
          if($add == "") {
            if($mid) {
              $mid .= " and ";
            }

            else {
              $mid = " where ";
            }
          }

          else {
            $add .= $connect;
          }

          $add .= " `tiki_articles`.`topicId`$invert=? ";
          $bindvars[] = $topicId;
        }
      }

      if($add <> "") {
        $mid .= " ( ".$add." ) ";
      }
    }

    // topic=>[!]a+b+c+d+...
    if($topic) {
      $invert = "";
      $connect = " or ";

      // parameter list negated?
      if(substr($topic,0,1)=="!") {
        $topic = substr($topic,1);
        $invert = "!";
        $connect = " and ";
      }

      $add = "";
      $rest = $topic;

      while($rest <> "") {
        @list($topic, $rest) = split("\+", $rest, 2);  //split 'x+y+z' into 'x' and 'y+z'

        if($topic <>"") {
          if($add == "") {
            if($mid) {
              $mid .= " and ";
            }

            else {
              $mid = " where ";
            }
          }

          else {
            $add .= $connect;
          }

          $add .= " `tiki_articles`.`topicName`$invert=? ";
          $bindvars[] = $topic;
        }
      }

      if($add <> "") {
        $mid .= " ( ".$add." ) ";
      }
    }

    if(($visible_only) && ($visible_only <> 'n')) {
      if($date !== false) { // looking for articles on a specific date (or today)
        if($date === "") { // show articles published today
          $date = date('U');
        }

        $bindvars[]=(int) $date;
        $bindvars[]=(int) date('U');
        $condition = "(`tiki_articles`.`publishDate`<? or `tiki_article_types`.`show_pre_publ`='y') and (`tiki_articles`.`expireDate`>? or `tiki_article_types`.`show_post_expire`='y')";
      }

      else { // looking for all articles not expired
        $condition = "(`tiki_articles`.`expireDate`>? or `tiki_article_types`.`show_post_expire`='y')";
        $bindvars[]=date('U');
      }

      if($mid) {
        $mid .= " and $condition";
      }

      else {
        $mid .= " where $condition";
      }
    }

    if(!empty($lang)) {
      $condition = '`tiki_articles`.`lang`=?';
      $mid .= ($mid)? ' and ': ' where ';
      $mid .= $condition.' ';
      $bindvars[] = $lang;
    }

    if($mid)
      $mid2 = " and ";

    else
      $mid2 = " where ";

    $mid2 .= "  `tiki_articles`.`type` = `tiki_article_types`.`type`";

    if($categId) {
      global $categlib;
      require_once('lib/categories/categlib.php');
      $categlib->getSqlJoin($categId, 'article', '`tiki_articles`.`articleId`', $fromSql, $mid2, $bindvars);
    }

    $query = "select `tiki_articles`.*,
             `tiki_article_types`.`use_ratings`,
             `tiki_article_types`.`show_pre_publ`,
             `tiki_article_types`.`show_post_expire`,
             `tiki_article_types`.`heading_only`,
             `tiki_article_types`.`allow_comments`,
             `tiki_article_types`.`show_image`,
             `tiki_article_types`.`show_avatar`,
             `tiki_article_types`.`show_author`,
             `tiki_article_types`.`show_pubdate`,
             `tiki_article_types`.`show_expdate`,
             `tiki_article_types`.`show_reads`,
             `tiki_article_types`.`show_size`,
             `tiki_article_types`.`show_topline`,
             `tiki_article_types`.`show_subtitle`,
             `tiki_article_types`.`show_linkto`,
             `tiki_article_types`.`show_image_caption`,
             `tiki_article_types`.`show_lang`,
             `tiki_article_types`.`creator_edit`
             from `tiki_articles`, `tiki_article_types`$fromSql
             $mid $mid2 order by ".$this->convert_sortmode($sort_mode);
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $query_cant = "select count(*) from  `tiki_articles`, `tiki_article_types` $fromSql $mid $mid2";
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      if($res['topicId'] != 0 && $userlib->object_has_one_permission($res['topicId'], 'topic')) { // if no topic or if topic has no special perm don't have to check for topic perm
        $add=$this->user_has_perm_on_object($user,$res['topicId'],'topic','tiki_p_topic_read');
      }

      else
        $add = true;

      if($add)
        $add = $this->user_has_perm_on_object($user, $res['articleId'],'article', 'tiki_p_read_article');

      // no need to do all of the following if we are not adding this article to the array
      if($add) {
        $res["entrating"] = floor($res["rating"]);

        if(empty($res["body"])) {
          $res["isEmpty"] = 'y';
        }

        else {
          $res["isEmpty"] = 'n';
        }

        if(strlen($res["image_data"]) > 0) {
          $res["hasImage"] = 'y';
        }

        else {
          $res["hasImage"] = 'n';
        }

        $res['count_comments'] = 0;

        // Determine if the article would be displayed in the view page
        $res["disp_article"] = 'y';
        $now = date("U");

        //if ($date) {
        if(($res["show_pre_publ"] != 'y') and($now < $res["publishDate"])) {
          $res["disp_article"] = 'n';
        }

        if(($res["show_post_expire"] != 'y') and($now > $res["expireDate"])) {
          $res["disp_article"] = 'n';
        }

        //}
//      if ($add) { // moved this check to the top
        $ret[] = $res;
      }
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  /*shared*/
  function list_submissions($offset = 0, $maxRecords = -1, $sort_mode = 'publishDate_desc', $find = '', $date = '') {

    if($find) {
      $findesc = $this->qstr('%' . $find . '%');
      $mid = " where (`title` like ? or `heading` like ? or `body` like ?) ";
      $bindvars = array($findesc,$findesc,$findesc);
    }

    else {
      $mid = '';
      $bindvars = array();
    }

    if($date) {
      if($mid) {
        $mid .= " and `publishDate` <= ? ";
      }

      else {
        $mid = " where `publishDate` <= ? ";
      }

      $bindvars[] = $date;
    }

    $query = "select * from `tiki_submissions` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_submissions` $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      $res["entrating"] = floor($res["rating"]);

      if(empty($res["body"])) {
        $res["isEmpty"] = 'y';
      }

      else {
        $res["isEmpty"] = 'n';
      }

      if(strlen($res["image_data"]) > 0) {
        $res["hasImage"] = 'y';
      }

      else {
        $res["hasImage"] = 'n';
      }

      $ret[] = $res;
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  function get_article($articleId) {
    global $user, $tiki_p_admin_cms;

    if($tiki_p_admin_cms != 'y' && !$this->user_has_perm_on_object($user, $articleId, 'article','tiki_p_read_article'))
      return false;

    $mid = " where `tiki_articles`.`type` = `tiki_article_types`.`type` ";
    $query = "select `tiki_articles`.*,
             `users_users`.`avatarLibName`,
             `tiki_article_types`.`use_ratings`,
             `tiki_article_types`.`show_pre_publ`,
             `tiki_article_types`.`show_post_expire`,
             `tiki_article_types`.`heading_only`,
             `tiki_article_types`.`allow_comments`,
             `tiki_article_types`.`comment_can_rate_article`,
             `tiki_article_types`.`show_image`,
             `tiki_article_types`.`show_avatar`,
             `tiki_article_types`.`show_author`,
             `tiki_article_types`.`show_pubdate`,
             `tiki_article_types`.`show_expdate`,
             `tiki_article_types`.`show_reads`,
             `tiki_article_types`.`show_size`,
             `tiki_article_types`.`show_topline`,
             `tiki_article_types`.`show_subtitle`,
             `tiki_article_types`.`show_linkto`,
             `tiki_article_types`.`show_image_caption`,
             `tiki_article_types`.`show_lang`,
             `tiki_article_types`.`creator_edit`
             from (`tiki_articles`, `tiki_article_types`) left join `users_users` on `tiki_articles`.`author` = `users_users`.`login`  $mid and `tiki_articles`.`articleId`=?";
    //$query = "select * from `tiki_articles` where `articleId`=?";
    $result = $this->query($query,array((int)$articleId));

    if($result->numRows()) {
      $res = $result->fetchRow();
      $res["entrating"] = floor($res["rating"]);
    }

    else {
      return false;
    }

    global $feature_score, $user;

    if($feature_score == 'y') {
      $this->score_event($user, 'article_read', $articleId);
      $this->score_event($res['author'], 'article_is_read', $articleId . '_' . $user);
    }

    return $res;
  }

  function get_submission($subId) {
    $query = "select * from `tiki_submissions` where `subId`=?";
    $result = $this->query($query,array((int) $subId));

    if($result->numRows()) {
      $res = $result->fetchRow();
      $res["entrating"] = floor($res["rating"]);
    }

    else {
      return false;
    }

    return $res;
  }

  /*shared*/
  function get_topic_image($topicId) {
    // Fixed query. -rlpowell
    $query = "select `image_name` ,`image_size`,`image_type`, `image_data` from `tiki_topics` where `topicId`=?";
    $result = $this->query($query, array((int) $topicId));
    $res = $result->fetchRow();
    return $res;
  }

  /*shared*/
  function get_article_image($id) {
    $query = "select `image_name` ,`image_size`,`image_type`, `image_data` from `tiki_articles` where `articleId`=?";
    $result = $this->query($query, array((int) $id));
    $res = $result->fetchRow();
    return $res;
  }

  /*shared*/
  function get_featured_links($max = 10) {
    $query = "select * from `tiki_featured_links` where `position` > ? order by ".$this->convert_sortmode("position_asc");
    $result = $this->query($query, array(0), (int)$max, 0);
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res;
    }

    return $ret;
  }

  function update_session($sessionId) {
    global $user;

    if($user === false) $user = '';

    $now = date("U");
    $oldy = $now - (5 * 60);
    $query = "delete from `tiki_sessions` where `sessionId`=? or `timestamp`<?";
    $bindvars = array($sessionId, $oldy);

    if($user) {
      $query .= " or `user`=?";
      $bindvars[] = $user;
    }

    $this->query($query, $bindvars, -1, -1, false);
    $query = "insert into `tiki_sessions`(`sessionId`,`timestamp`,`user`,`tikihost`) values(?,?,?,?)";
    $result = $this->query($query, array($sessionId, (int)$now, $user,$_SERVER["HTTP_HOST"]), -1, -1, false);
    return true;
  }

  function count_sessions() {
    $query = "select count(*) from `tiki_sessions`";
    $cant = $this->getOne($query,array());
    return $cant;
  }

  function count_cluster_sessions() {
    $query = "select `tikihost`, count(`tikihost`) as cant from `tiki_sessions` group by `tikihost`";
    $result = $this->query($query, array());
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[$res["tikihost"]]=$res["cant"];
    }

    return($ret);
  }

  /*shared*/
  function get_assigned_modules($position, $displayed="n") {
    $filter = '';

    if($displayed != 'n') {
      $filter = " and (`type` is null or `type` !='h')";
    }

    $query = "select `params`,`name`,`title`,`position`,`ord`,`cache_time`,`rows`,`groups` from `tiki_modules` ";
    $query.= " where `position`= ? $filter order by ".$this->convert_sortmode("ord_asc");

    $result = $this->query($query, array($position));
    $ret = array();

    while($res = $result->fetchRow()) {
      if($res["groups"] && strlen($res["groups"]) > 1) {
        $grps = @unserialize($res["groups"]);

        $res["module_groups"] = '';

        if(is_array($grps)) {
          foreach($grps as $grp) {
            $res["module_groups"] .= " $grp ";
          }
        }
      }

      else {
        $res["module_groups"] = '&nbsp;';
      }

      $ret[] = $res;
    }

    return $ret;
  }

  /*shared*/
  function is_user_module($name) {
    $query = "select `name`  from `tiki_user_modules` where `name`=?";
    $result = $this->query($query,array($name));
    return $result->numRows();
  }

  /*shared*/
  function get_user_module($name) {
    $query = "select * from `tiki_user_modules` where `name`=?";
    $result = $this->query($query,array($name));
    $res = $result->fetchRow();
    return $res;
  }

  function cache_links($links) {
    $cachepages = $this->get_preference("cachepages", 'y');

    if($cachepages != 'y') return false;

    foreach($links as $link) {
      if(!$this->is_cached($link)) {
        $this->cache_url($link);
      }
    }
  }

  function get_links($data) {
    $links = array();

    // Match things like [...], but ignore things like [[foo].
    // -Robin
    if(preg_match_all("/(?<!\[)\[([^\[\|\]]+)(\||\])/", $data, $r1)) {
      $res = $r1[1];
      $links = array_unique($res);
    }

    return $links;
  }

  function get_links_nocache($data) {
    $links = array();

    if(preg_match_all("/\[([^\]]+)/", $data, $r1)) {
      $res = array();

      foreach($r1[1] as $alink) {
        $parts = explode('|', $alink);

        if(isset($parts[1]) && $parts[1] == 'nocache') {
          $res[] = $parts[0];
        }

        else {
          if(isset($parts[2]) && $parts[2] == 'nocache') {
            $res[] = $parts[0];
          }
        }

        // avoid caching URLs with common binary file extensions
        $extension = substr($parts[0], -4);
        $binary = array(
                    '.arj',
                    '.asf',
                    '.avi',
                    '.bz2',
                    '.com',
                    '.dat',
                    '.doc',
                    '.exe',
                    '.hqx',
                    '.mid',
                    '.mov',
                    '.mp3',
                    '.mpg',
                    '.ogg',
                    '.pdf',
                    '.ram',
                    '.rar',
                    '.rpm',
                    '.rtf',
                    '.sea',
                    '.sit',
                    '.tar',
                    '.tgz',
                    '.wav',
                    '.wmv',
                    '.xls',
                    '.zip',
                    'ar.Z', // .tar.Z
                    'r.gz'  // .tar.gz
                  );

        if(in_array($extension, $binary)) {
          $res[] = $parts[0];
        }

      }

      $links = array_unique($res);
    }

    return $links;
  }

  function is_cacheable($url) {
    // simple implementation: future versions should analyse
    // if this is a link to the local machine
    if(strstr($url, 'tiki-')) {
      return false;
    }

    if(strstr($url, 'messu-')) {
      return false;
    }

    return true;
  }

  function is_cached($url) {
    $query = "select `cacheId`  from `tiki_link_cache` where `url`=?";
    $result = $this->query($query, array($url));
    $cant = $result->numRows();
    return $cant;
  }

  function list_cache($offset, $maxRecords, $sort_mode, $find) {

    if($find) {
      $findesc = '%' . $find . '%';

      $mid = " where (`url` like ?) ";
      $bindvars=array($findesc);
    }

    else {
      $mid = "";
      $bindvars=array();
    }

    $query = "select `cacheId` ,`url`,`refresh` from `tiki_link_cache` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_link_cache` $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res;
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  function refresh_cache($cacheId) {
    $query = "select `url`  from `tiki_link_cache`
             where `cacheId`=?";

    $url = $this->getOne($query, array($cacheId));
    $data = $this->httprequest($url);
    $refresh = date("U");
    $query = "update `tiki_link_cache`
             set `data`=?, `refresh`=?
             where `cacheId`=? ";
    $result = $this->query($query, array($data, $refresh, $cacheId));
    return true;
  }

  function remove_cache($cacheId) {
    $query = "delete from `tiki_link_cache` where `cacheId`=?";

    $result = $this->query($query, array($cacheId));
    return true;
  }

  function get_cache($cacheId) {
    $query = "select * from `tiki_link_cache`
             where `cacheId`=?";

    $result = $this->query($query, array($cacheId));
    $res = $result->fetchRow();
    return $res;
  }

  function get_cache_id($url) {
    if(!$this->is_cached($url))
      return false;

    $query = "select `cacheId`  from `tiki_link_cache`
             where `url`=?";
    $id = $this->getOne($query, array($url));
    return $id;
  }

  function vote_page($page, $points) {
    $query = "update `pages`
             set `points`=`points`+$points, `votes`=`votes`+1
             where `pageName`=?";
    $result = $this->query($query, array($page));
  }

  function get_votes($page) {
    $query = "select `points` ,`votes`
             from `pages` where `pageName`=?";
    $result = $this->query($query, array($page));
    $res = $result->fetchRow();
    return $res;
  }

  // This funcion return the $limit most accessed pages
  // it returns pageName and hits for each page
  function get_top_pages($limit) {
    $query = "select `pageName` , `hits`
             from `tiki_pages`
             order by `hits` desc";

    $result = $this->query($query, array(),$limit);
    $ret = array();

    while($res = $result->fetchRow()) {
      $aux["pageName"] = $res["pageName"];

      $aux["hits"] = $res["hits"];
      $ret[] = $aux;
    }

    return $ret;
  }

  // Returns the name of "n" random pages
  function get_random_pages($n) {
    $query = "select count(*) from `tiki_pages`";

    $cant = $this->getOne($query,array());

    // Adjust the limit if there are not enough pages
    if($cant < $n)
      $n = $cant;

    // Now that we know the number of pages to pick select `n`  random positions from `0` to cant
    $positions = array();

    for($i = 0; $i < $n; $i++) {
      $pick = rand(0, $cant - 1);

      if(!in_array($pick, $positions))
        $positions[] = $pick;
    }

    // Now that we have the positions we just build the data
    $ret = array();

    $temp_max = count($positions);

    for($i = 0; $i < $temp_max; $i++) {
      $index = $positions[$i];

      $query = "select `pageName`  from `tiki_pages`";
      $name = $this->getOne($query,array(),1,$index);
      $ret[] = $name;
    }

    return $ret;
  }

  // Returns the name of all pages
  function get_all_pages() {

    $query = "select `pageName` from `tiki_pages`";
    $result = $this->query($query,array());
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res;
    }

    return $ret;
  }

  /**
   * \brief Cache given url
   * If \c $data present (passed) it is just associated \c $url and \c $data.
   * Else it will request data for given URL and store it in DB.
   * Actualy (currently) data may be proviced by TIkiIntegrator only.
   */
  function cache_url($url, $data = '') {
    // Avoid caching internal references... (only if $data not present)
    // (cdx) And avoid other protocols than http...
    // 03-Nov-2003, by zaufi
    // preg_match("_^(mailto:|ftp:|gopher:|file:|smb:|news:|telnet:|javascript:|nntp:|nfs:)_",$url)
    // was removed (replaced to explicit http[s]:// detection) bcouse
    // I now (and actualy use in my production Tiki) another bunch of protocols
    // available in my konqueror... (like ldap://, ldaps://, nfs://, fish://...)
    // ... seems like it is better to enum that allowed explicitly than all
    // noncacheable protocols.
    if(((strstr($url, 'tiki-') || strstr($url, 'messu-')) && $data == '')
        || (substr($url, 0, 7) != 'http://' && substr($url, 0, 8) != 'https://'))
      return false;

    // Request data for URL if nothing given in parameters
    // (reuse $data var)
    if($data == '') $data = $this->httprequest($url);

    // If stuff inside [] is *really* malformatted, $data
    // will be empty.  -rlpowell
    if($data)
    {
      $refresh = date("U");
      $query = "insert into `tiki_link_cache`(`url`,`data`,`refresh`) values(?,?,?)";
      $result = $this->queryError($query, $error, array($url,$data,$refresh));
      return !isset($error);
    }

    else return false;
  }

  // Removes all the versions of a page and the page itself
  /*shared*/
  function remove_all_versions($page, $comment = '') {
    global $dbTiki, $user;
    global $wikilib;
    include_once('lib/wiki/wikilib.php');
    global $multilinguallib;

    if(!is_object($multilinguallib)) {
      include_once('lib/multilingual/multilinguallib.php');// must be done even in feature_multilingual not set
    }

    $multilinguallib->detachTranslation('wiki page', $multilinguallib->get_page_id_from_name($page));
    $this->invalidate_cache($page);
    //Delete structure references before we delete the page
    $query  = "select `page_ref_id` ";
    $query .= "from `tiki_structures` ts, `tiki_pages` tp ";
    $query .= "where ts.`page_id`=tp.`page_id` and `pageName`=?";
    $result = $this->query($query, array($page));

    while($res = $result->fetchRow()) {
      $this->remove_from_structure($res["page_ref_id"]);
    }

    $query = "delete from `tiki_pages` where `pageName` = ?";
    $result = $this->query($query, array($page));
    $query = "delete from `tiki_history` where `pageName` = ?";
    $result = $this->query($query, array($page));
    $query = "delete from `tiki_links` where `fromPage` = ?";
    $result = $this->query($query, array($page));
    $action = "Removed"; //get_strings tra("Removed");
    $t = date("U");
    $query = "insert into ";
    $query .= "`tiki_actionlog`(`action`,`pageName`,`lastModif`,`user`,`ip`,`comment`) ";
    $query .= "values(?,?,?,?,?,?)";
    $result = $this->query($query, array(
                             $action,$page,(int) $t,$user,$_SERVER["REMOTE_ADDR"],$comment
                           ));
    $query = "update `users_groups` set `groupHome`=? where `groupHome`=?";
    $this->query($query, array(NULL, $page));

    $this->remove_object('wiki page', $page);

    $query = "delete from `tiki_user_watches` where `event`=? and `object`=?";
    $this->query($query,array('wiki_page_changed', $page));

    $atts = $wikilib->list_wiki_attachments($page, 0, -1, 'created_desc', '');
    foreach($atts["data"] as $at) {
      $wikilib->remove_wiki_attachment($at["attId"]);
    }

    $wikilib->remove_footnote('', $page);

    return true;
  }

  /*shared*/
  function remove_from_structure($page_ref_id) {
    // Now recursively remove
    $query  = "select `page_ref_id` ";
    $query .= "from `tiki_structures` as ts, `tiki_pages` as tp ";
    $query .= "where ts.`page_id`=tp.`page_id` and `parent_id`=?";
    $result = $this->query($query, array($page_ref_id));

    while($res = $result->fetchRow()) {
      $this->remove_from_structure($res["page_ref_id"]);
    }

    $query = "delete from `tiki_structures` where `page_ref_id`=?";
    $result = $this->query($query, array($page_ref_id));
    return true;
  }

  /*shared*/
  function list_galleries($offset = 0, $maxRecords = -1, $sort_mode = 'name_desc', $user, $find) {
    // If $user is admin then get ALL galleries, if not only user galleries are shown
    global $tiki_p_admin_galleries;

    $old_sort_mode = '';

    if(in_array($sort_mode, array(
                  'images desc',
                  'images asc'
                ))) {
      $old_offset = $offset;

      $old_maxRecords = $maxRecords;
      $old_sort_mode = $sort_mode;
      $sort_mode = 'user desc';
      $offset = 0;
      $maxRecords = -1;
    }

    // If the user is not admin then select `it` 's own galleries or public galleries
    if(($tiki_p_admin_galleries == 'y') or($user == 'admin')) {
      $whuser = "";
      $bindvars=array();
    }

    else {
      $whuser = "where `user`=? or public=?";
      $bindvars=array($user,'y');
    }

    if($find) {
      $findesc = '%' . $find . '%';

      if(empty($whuser)) {
        $whuser = "where `name` like ? or `description` like ?";
        $bindvars=array($findesc,$findesc);
      }

      else {
        $whuser .= " and `name` like ? or `description` like ?";
        $bindvars[]=$findesc;
        $bindvars[]=$findesc;
      }
    }

    // If sort mode is versions then offset is 0, maxRecords is -1 (again) and sort_mode is nil
    // If sort mode is links then offset is 0, maxRecords is -1 (again) and sort_mode is nil
    // If sort mode is backlinks then offset is 0, maxRecords is -1 (again) and sort_mode is nil
    $query = "select * from `tiki_galleries` $whuser order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_galleries` $whuser";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {

      global $user;
      $add=$this->user_has_perm_on_object($user,$res['galleryId'],'image gallery','tiki_p_view_image_gallery');

      if($add) {
        $aux = array();

        $aux["name"] = $res["name"];
        $gid = $res["galleryId"];
        $aux["visible"] = $res["visible"];
        $aux["id"] = $gid;
        $aux["galleryId"] = $res["galleryId"];
        $aux["description"] = $res["description"];
        $aux["created"] = $res["created"];
        $aux["lastModif"] = $res["lastModif"];
        $aux["user"] = $res["user"];
        $aux["hits"] = $res["hits"];
        $aux["public"] = $res["public"];
        $aux["theme"] = $res["theme"];
        $aux["geographic"] = $res["geographic"];
        $aux["images"] = $this->getOne("select count(*) from `tiki_images` where `galleryId`=?",array($gid));
        $ret[] = $aux;
      }
    }

    if($old_sort_mode == 'images asc') {
      usort($ret, 'compare_images');
    }

    if($old_sort_mode == 'images desc') {
      usort($ret, 'r_compare_images');
    }

    if(in_array($old_sort_mode, array(
                  'images desc',
                  'images asc'
                ))) {
      $ret = array_slice($ret, $old_offset, $old_maxRecords);
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  /*shared*/
  function list_visible_galleries($offset = 0, $maxRecords = -1, $sort_mode = 'name_desc', $user, $find) {
    global $tiki_p_admin_galleries;
    // If $user is admin then get ALL galleries, if not only user galleries are shown

    $old_sort_mode = '';

    if(in_array($sort_mode, array(
                  'images desc',
                  'images asc'
                ))) {
      $old_offset = $offset;

      $old_maxRecords = $maxRecords;
      $old_sort_mode = $sort_mode;
      $sort_mode = 'user desc';
      $offset = 0;
      $maxRecords = -1;
    }

    // If the user is not admin then select `it` 's own galleries or public galleries
    if(($user != 'admin') and($tiki_p_admin_galleries != 'y')) {
      $whuser = "and `user`=? or `public`=?";
      $bindvars=array('y',$user,'y');
    }

    else {
      $whuser = "";
      $bindvars=array('y');
    }

    if($find) {
      $findesc = '%' . $find . '%';

      if(empty($whuser)) {
        $whuser = " and (`name` like ? or `description` like ?)";
        $bindvars=array('y',$findesc,$findesc);
      }

      else {
        $whuser .= " and (`name` like ? or `description` like ?)";
        $bindvars[]=$findesc;
        $bindvars[]=$findesc;
      }
    }

    // If sort mode is versions then offset is 0, maxRecords is -1 (again) and sort_mode is nil
    // If sort mode is links then offset is 0, maxRecords is -1 (again) and sort_mode is nil
    // If sort mode is backlinks then offset is 0, maxRecords is -1 (again) and sort_mode is nil
    $query = "select * from `tiki_galleries` where `visible`=? $whuser order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_galleries` where `visible`=? $whuser";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      $aux = array();

      $aux["name"] = $res["name"];
      $gid = $res["galleryId"];
      $aux["visible"] = $res["visible"];
      $aux["id"] = $gid;
      $aux["galleryId"] = $res["galleryId"];
      $aux["description"] = $res["description"];
      $aux["created"] = $res["created"];
      $aux["lastModif"] = $res["lastModif"];
      $aux["user"] = $res["user"];
      $aux["hits"] = $res["hits"];
      $aux["public"] = $res["public"];
      $aux["theme"] = $res["theme"];
      $aux["geographic"] = $res["geographic"];
      $aux["images"] = $this->getOne("select count(*) from `tiki_images` where `galleryId`=?",array($gid));
      $ret[] = $aux;
    }

    if($old_sort_mode == 'images asc') {
      usort($ret, 'compare_images');
    }

    if($old_sort_mode == 'images desc') {
      usort($ret, 'r_compare_images');
    }

    if(in_array($old_sort_mode, array(
                  'images desc',
                  'images asc'
                ))) {
      $ret = array_slice($ret, $old_offset, $old_maxRecords);
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  function last_pages($maxRecords = -1) {
    global $user;
    $query = "select `pageName`,`lastModif`,`user`,`comment` from `tiki_pages` order by ".$this->convert_sortmode('lastModif_desc');
    $result = $this->query($query,array(),$maxRecords,0);
    $ret = array();

    while($res = $result->fetchRow()) {
      //WYSIWYCA hack: the $maxRecords will not be respected
      if($this->user_has_perm_on_object($user,$res["pageName"],'wiki page','tiki_p_view')) {
        $ret[] = $res;
      }
    }

    return $ret;
  }


  function last_major_pages($maxRecords = -1) {
    global $user;
    $query = "select distinct(tp.`pageName`),tp.`lastModif`,tp.`user` from `tiki_pages` tp left join `tiki_actionlog` ta
             on tp.`pageName`=ta.`pageName` where ta.`action`!='' order by tp.".$this->convert_sortmode('lastModif_desc');
    $result = $this->query($query,array(),$maxRecords,0);
    $ret = array();

    while($res = $result->fetchRow()) {
      //WYSIWYCA hack: the $maxRecords will not be respected
      if($this->user_has_perm_on_object($user,$res["pageName"],'wiki page','tiki_p_view')) {
        $ret[] = $res;
      }
    }

    return $ret;
  }
  // use this function to speed up when pagename is only needed (the 3 getOne can killed tikiwith more that 3000 pages)
  function list_pageNames($offset = 0, $maxRecords = -1, $sort_mode = 'pageName_desc', $find = '') {
    return $this->list_pages($offset, $maxRecords, $sort_mode, $find, '', true, true);
  }

  function list_pages($offset = 0, $maxRecords = -1, $sort_mode = 'pageName_desc', $find = '', $initial = '', $exact_match = true, $onlyName=false, $forListPages=false, $only_orphan_pages = false, $filter='') {
    global $wiki_list_links, $wiki_list_versions, $wiki_list_backlinks;

    $join_tables = '';
    $join_bindvars = array();

    if($sort_mode == 'size_desc') {
      $sort_mode = 'page_size_desc';
    }

    if($sort_mode == 'size_asc') {
      $sort_mode = 'page_size_asc';
    }

    $old_sort_mode = '';

    if(in_array($sort_mode, array(
                  'versions_desc',
                  'versions_asc',
                  'links_asc',
                  'links_desc',
                  'backlinks_asc',
                  'backlinks_desc'
                ))) {
      $old_offset = $offset;
      $old_maxRecords = $maxRecords;
      $old_sort_mode = $sort_mode;
      $sort_mode = 'user_desc';
      $offset = 0;
      $maxRecords = -1;
    }

    if(is_array($find)) {  // you can use an array of pages
      $mid = " where `pageName` IN (".implode(',',array_fill(0,count($find),'?')).")";
      $bindvars = $find;
    }

    elseif(is_string($find) && !empty($find)) {  // or a string
      if(!$exact_match && $find) {
        $find = preg_replace("/(\w+)/","%\\1%",$find);
        $find = preg_split("/[\s]+/",$find,-1,PREG_SPLIT_NO_EMPTY);
        $mid = " where `pageName` like ".implode(' or `pageName` like ',array_fill(0,count($find),'?'));
        $bindvars = $find;
      }

      else {
        $mid = " where `pageName` like ? ";
        $bindvars = array('%' . $find . '%');
      }
    }

    else {
      $mid = "";
      $bindvars = array();
    }

    if(!empty($filter)) {
      foreach($filter as $type=>$val) {
        if($type == 'categId') {
          $join_tables = " inner join `tiki_categorized_objects` as tco on (tco.`objId`= tp.`pageName` and tco.`type`= ?) inner join `tiki_category_objects` as tc on (tc.`catObjectId`=tco.`catObjectId` and tc.`categId`=?) ";
          $join_bindvars = array('wiki page', $val);
        }

        elseif($type == 'lang') {
          $mid .= empty($mid)? ' where ': ' and ';
          $mid .= '`lang`=? ';
          $bindvars[] = $val;
        }
      }
    }

    if($initial) {
      $mid = " where `pageName` like ?";
      $mmid = $mid;
      $bindvars = array($initial.'%');
      $mbindvars = $bindvars;
    }

    if(!empty($join_bindvars)) {
      $bindvars = empty($bindvars)? $join_bindvars : array_merge($join_bindvars, $bindvars);
    }

    // If sort mode is versions then offset is 0, maxRecords is -1 (again) and sort_mode is nil
    // If sort mode is links then offset is 0, maxRecords is -1 (again) and sort_mode is nil
    // If sort mode is backlinks then offset is 0, maxRecords is -1 (again) and sort_mode is nil
    $query = "select tp.* ";
    $query.= " from `tiki_pages` as tp $join_tables $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_pages` as tp $join_tables $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);

    if($initial) {
      $cant = $this->getOne($query_cant,$mbindvars);
    }

    else {
      $cant = $this->getOne($query_cant,$bindvars);
    }

    $ret = array();

    while($res = $result->fetchRow()) {
      global $user;
      $add=$this->user_has_perm_on_object($user,$res["pageName"],'wiki page','tiki_p_view');


      if($add) {
        $aux = array();
        $aux["pageName"] = $res["pageName"];
        $res['len'] = $res['page_size'];

        if(!$onlyName) {
          $page = $aux["pageName"];
          $aux["hits"] = $res["hits"];
          $aux["lastModif"] = $res["lastModif"];
          $aux["user"] = $res["user"];
          $aux["ip"] = $res["ip"];
          $aux["len"] = $res["len"];
          $aux["comment"] = $res["comment"];
          $aux["creator"] = $res["creator"];
          $aux["version"] = $res["version"];
          $aux['lang'] = $res['lang'];
          $aux["flag"] = $res["flag"] == 'L' ? 'locked' : 'unlocked';

          if($forListPages && $wiki_list_versions == 'y')
            $aux["versions"] = $this->getOne("select count(*) from `tiki_history` where `pageName`=?",array($page));

          if($forListPages && $wiki_list_links == 'y')
            $aux["links"] = $this->getOne("select count(*) from `tiki_links` where `fromPage`=?",array($page));

          if($forListPages && $wiki_list_backlinks == 'y')
            $aux["backlinks"] = $this->getOne("select count(*) from `tiki_links` where `toPage`=?",array($page));

          $aux["description"] = $res["description"];
        }

        $ret[] = $aux;
      }
    }

    // If sortmode is versions, links or backlinks sort using the ad-hoc function and reduce using old_offse and old_maxRecords
    if($old_sort_mode == 'versions_asc') {
      usort($ret, 'compare_versions');
    }

    if($old_sort_mode == 'versions_desc') {
      usort($ret, 'r_compare_versions');
    }

    if($old_sort_mode == 'links_desc') {
      usort($ret, 'compare_links');
    }

    if($old_sort_mode == 'links_asc') {
      usort($ret, 'r_compare_links');
    }

    if($old_sort_mode == 'backlinks_desc') {
      usort($ret, 'compare_backlinks');
    }

    if($old_sort_mode == 'backlinks_asc') {
      usort($ret, 'r_compare_backlinks');
    }

    if(in_array($old_sort_mode, array(
                  'versions_desc',
                  'versions_asc',
                  'links_asc',
                  'links_desc',
                  'backlinks_asc',
                  'backlinks_desc'
                ))) {
      $ret = array_slice($ret, $old_offset, $old_maxRecords);
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }


  // Function that checks for:
  // - tiki_p_admin
  // - the permission itself
  // - individual permission
  // - category permission
  // if O.K. this function shall replace similar constructs in list_pages and other functions above.
  // $categperm is the category permission that should grant $perm. if none, pass 0
  function user_has_perm_on_object($user,$object,$objtype,$perm,$categperm='tiki_p_view_categories') {
    global $feature_categories;
    global $userlib;

    // superadmin
    if($userlib->user_has_permission($user, 'tiki_p_admin')) {
      return(TRUE);
    }

    if($userlib->object_has_one_permission($object, $objtype)) {
      // wiki permissions override category permissions
      //handle multiple permissions
      if(is_array($perm)) {
        foreach($perm as $p) {
          if(!$userlib->object_has_permission($user, $object, $objtype,$p)) {
            return(FALSE);
          }
        }
      }

      else {
        if(!$userlib->object_has_permission($user, $object, $objtype,$perm))
        {
          return(FALSE);
        }
      }

      return (TRUE);
    }

    elseif($feature_categories == 'y' && $categperm !== 0) {
      // no wiki permissions so now we check category permissions
      global $categlib;

      if(!is_object($categlib)) {
        include_once('lib/categories/categlib.php');
      }

      unset($tiki_p_view_categories); // unset this var in case it was set previously
      $perms_array = $categlib->get_object_categories_perms($user, $objtype, $object);

      if($perms_array) {
        $is_categorized = TRUE;
        foreach($perms_array as $p => $value) {
          $$p = $value;
        }

        if($tiki_p_admin_categories == 'y' && $tiki_p_view_categories == 'n')
          $tiki_p_view_categories = 'y';
      }

      else {
        $is_categorized = FALSE;
      }

      if($is_categorized && !empty($categperm) && $$categperm != 'y') {
        return (FALSE);
      }

      // if it has no category perms or the user does not have
      // the perms, continue to check individual perms!
    }

    // no individual and no category perms. So has the user the perm itself?
    if(is_array($perm)) {
      foreach($perm as $p) {
        if(!$userlib->user_has_permission($user, $p)) {
          return(FALSE);
        }
      }
    }

    else {
      if(!$userlib->user_has_permission($user, $perm)) {
        return(FALSE);
      }
    }

    return(TRUE);
  }

  /* get all the perm of an object either in a table or global and smarty set
   * OPTIMISATION: better to test tiki_p_admin outside for global=false
   * TODO: all the objectType
   * global = true set the global perm and smarty var, otherwise return an array of perms
   */
  function get_perm_object($objectId, $objectType, $global=true) {
    global $tiki_p_admin, $user, $feature_categories, $userlib, $smarty;
    $ret = array();

    if($tiki_p_admin == 'y') {
      if(!$global) {
        $perms = $userlib->get_permissions(0, -1, 'permName_desc', '', $this->get_permGroup_from_objectType($objectType));
        foreach($perms['data'] as $perm) {
          $ret[$perm['permName']] = 'y';
        }
      }

      /* else : all the perms have already been set in tiki-setup_base */
    }

    elseif($userlib->object_has_one_permission($objectId, $objectType)) {
      $perms = $userlib->get_permissions(0, -1, 'permName_desc', '', $this->get_permGroup_from_objectType($objectType));
      foreach($perms['data'] as $perm) {  // foreach perm of the same group of perms
        $permName = $perm['permName'];
        global $$permName;

        if($userlib->object_has_permission($user, $objectId, $objectType, $permName)) {
          $ret[$permName] = 'y';

          if($global) {
            $$permName = 'y';
            $smarty->assign("$permName", 'y');
          }

          if($permName == $this->get_adminPerm_from_objectType($objectType)) {  // admin sets all the other perms
            foreach($perms['data'] as $perm) {
              $perm = $perm['permName'];
              $ret[$perm] = 'y';

              if($global) {
                global $$perm;
                $$perm = 'y';
                $smarty->assign("$perm", 'y');
              }
            }
            return $ret;
          }
        }

        else {
          $ret[$permName] = 'n';

          if($global) {
            $$permName = 'n';
            $smarty->assign("$permName", 'n');
          }
        }
      }
      return $ret; // special perms - no look at categ
    }
    elseif($feature_categories == 'y') {
      global $categlib;
      include_once('lib/categories/categlib.php');
      $perms = $categlib->get_object_categories_perms($user, $objectType, $objectId);

      if(!empty($perms)) {
        $result = $this->get_perm_from_categPerms($perms, $objectType);
        foreach($result as $perm=>$value) {
          if($global) {
            global $$perm;
            $$perm = $value;
          }

          else {
            $ret[$perm] = $value;
          }
        }
        return $ret; // special perms - do not look further
      }
    }

    if(!$global) {
      $perms = $userlib->get_permissions(0, -1, 'permName_desc', '', $this->get_permGroup_from_objectType($objectType));
      foreach($perms['data'] as $perm) {
        global $$perm['permName'];
        $ret[$perm['permName']] = $$perm['permName'];
      }
    }

    return $ret;
  }
  function get_permGroup_from_objectType($objectType) {
    switch($objectType) {
    case 'tracker':
      return 'trackers';

    case 'image gallery':
    case 'image':
      return 'image galleries';

    case 'file gallery':
    case 'file':
      return 'file galleries';

    case 'article':
    case 'submission':
      return 'cms';

    case 'forum':
      return 'forums';

    case 'blog':
    case 'blog post':
      return 'blogs';

    case 'wiki page':
    case 'history':
      return 'wiki';

    case 'faq':
      return 'faqs';

    case 'survey':
      return 'surveys';

    case 'newsletter':
      return 'newsletters';

      /* TODO */
    default:
      return $objectType;
    }
  }
  function get_adminPerm_from_objectType($objectType) {
    switch($objectType) {
    case 'tracker':
      return 'tiki_p_admin_trackers';

    case 'image gallery':
    case 'image':
      return 'tiki_p_admin_galleries';

    case 'file gallery':
    case 'file':
      return 'tiki_p_admin_file_galleries';

    case 'article':
    case 'submission':
      return 'tiki_p_admin_cms';

    case 'forum':
      return 'tiki_p_admin_forum';

    case 'blog':
    case 'blog post':
      return 'tiki_p_blog_admin';

    case 'wiki page':
    case 'history':
      return 'tiki_p_admin_wiki';

    case 'faq':
      return 'tiki_p_admin_faqs';

    case 'survey':
      return 'tiki_p_admin_surveys';

    case 'newsletter':
      return 'tiki_p_admin_newsletters';

      /* TODO */
    default:
      return "tiki_p_admin_$objectType";
    }
  }
  /* this function will change if we got a table categ<->perm
   */
  function get_perm_from_categPerms($categPerms, $objectType) {
    global $userlib;
    $ret = array();
    $perms = $userlib->get_permissions(0, -1, 'permName_desc', '', $this->get_permGroup_from_objectType($objectType));
    foreach($perms['data'] as $perm) {
      $ret[$perm['permName']] = 'n';
    }

    if(empty($categPerms['tiki_p_view_categories'])) {
      $categPerms['tiki_p_view_categories'] = 'n';
    }

    if(empty($categPerms['tiki_p_edit_categories'])) {
      $categPerms['tiki_p_edit_categories'] = 'n';
    }

    if(empty($categPerms['tiki_p_admin_categories'])) {
      $categPerms['tiki_p_admin_categories'] = 'n';
    }

    switch($objectType) {
    case 'tracker':
      if($categPerms['tiki_p_view_categories'] == 'y' || $categPerms['tiki_p_edit_categories'] == 'y' || $categPerms['tiki_p_admin_categories'] == 'y') {
        $ret['tiki_p_view_trackers'] = 'y';
      }

      if($categPerms['tiki_p_edit_categories'] == 'y' || $categPerms['tiki_p_admin_categories'] == 'y') {
        $ret['tiki_p_modify_tracker_items'] = 'y';
        $ret['tiki_p_create_tracker_items'] = 'y';
      }

      break;

    case 'image gallery':
    case 'image':
      if($categPerms['tiki_p_view_categories'] == 'y' || $categPerms['tiki_p_edit_categories'] == 'y' || $categPerms['tiki_p_admin_categories'] == 'y') {
        $ret['tiki_p_view_image_gallery'] = 'y';
        $ret['tiki_p_download_files'] = 'y';
      }

      if($categPerms['tiki_p_edit_categories'] == 'y' || $categPerms['tiki_p_admin_categories'] == 'y') {
        $ret['tiki_p_upload_images'] = 'y';
      }

      break;

    case 'file gallery':
    case 'file':
      if($categPerms['tiki_p_view_categories'] == 'y' || $categPerms['tiki_p_edit_categories'] == 'y' || $categPerms['tiki_p_admin_categories'] == 'y') {
        $ret['tiki_p_view_file_gallery'] = 'y';
      }

      if($categPerms['tiki_p_edit_categories'] == 'y' || $categPerms['tiki_p_admin_categories'] == 'y') {
        $ret['tiki_p_upload_files'] = 'y';
      }

      break;

    case 'article':
    case 'submission':
      if($categPerms['tiki_p_view_categories'] == 'y' || $categPerms['tiki_p_edit_categories'] == 'y' || $categPerms['tiki_p_admin_categories'] == 'y') {
        $ret['tiki_p_read_article'] = 'y';
      }

      if($categPerms['tiki_p_edit_categories'] == 'y' || $categPerms['tiki_p_admin_categories'] == 'y') {
        $ret['tiki_p_edit_article'] = 'y';
        $ret['tiki_p_submit_article'] = 'y';
      }

      break;

    case 'forum':
      if($categPerms['tiki_p_view_categories'] == 'y' || $categPerms['tiki_p_edit_categories'] == 'y' || $categPerms['tiki_p_admin_categories'] == 'y') {
        $ret['tiki_p_forum_read'] = 'y';
      }

      if($categPerms['tiki_p_edit_categories'] == 'y' || $categPerms['tiki_p_admin_categories'] == 'y') {
        $ret['tiki_p_forum_post_topic'] = 'y';
        $ret['tiki_p_forum_post'] = 'y';
      }

      break;

    case 'blog':
    case 'blog post':
      if($categPerms['tiki_p_view_categories'] == 'y' || $categPerms['tiki_p_edit_categories'] == 'y' || $categPerms['tiki_p_admin_categories'] == 'y') {
        $ret['tiki_p_read_blog'] = 'y';
      }

      if($categPerms['tiki_p_edit_categories'] == 'y' || $categPerms['tiki_p_admin_categories'] == 'y') {
        $ret['tiki_p_create_blogs'] = 'y';
        $ret['tiki_p_blog_post'] = 'y';
      }

      break;

    case 'wiki page':
    case 'history':
      if($categPerms['tiki_p_view_categories'] == 'y' || $categPerms['tiki_p_edit_categories'] == 'y' || $categPerms['tiki_p_admin_categories'] == 'y') {
        $ret['tiki_p_view'] = 'y';
      }

      if($categPerms['tiki_p_edit_categories'] == 'y' || $categPerms['tiki_p_admin_categories'] == 'y') {
        $ret['tiki_p_edit'] = 'y';
      }

      break;

    case 'faq':
      if($categPerms['tiki_p_view_categories'] == 'y' || $categPerms['tiki_p_edit_categories'] == 'y' || $categPerms['tiki_p_admin_categories'] == 'y') {
        $ret['tiki_p_view_faqs'] = 'y';
      }

      break;

    case 'survey':
      break;

    case 'newsletter':
      if($categPerms['tiki_p_view_categories'] == 'y' || $categPerms['tiki_p_edit_categories'] == 'y' || $categPerms['tiki_p_admin_categories'] == 'y') {
        $ret['tiki_p_subscribe_newsletters'] = 'y';
      }

      break;

      /* TODO */
    default:
      if($categPerms['tiki_p_view_categories'] == 'y' || $categPerms['tiki_p_edit_categories'] == 'y' || $categPerms['tiki_p_admin_categories'] == 'y') {
        $ret["tiki_p_view_$objectType"] = 'y';
      }

      break;
    }

    return $ret;
  }

  function get_all_preferences() {
    global $preferences;

    if(empty($preferences)) {
      $query = "select `name` ,`value` from `tiki_preferences`";

      $result = $this->query($query,array());
      $preferences = array();

      while($res = $result->fetchRow()) {
        $preferences[$res["name"]] = $res["value"];
      }
    }

    return $preferences;
  }

function get_preference($name, $default = '') {
    global $preferences;

    if(empty($preferences)) {
      $preferences = $this->get_all_preferences();
    }

    if(empty($preferences[$name])) {
      $preferences[$name] = $default;
    }

    return $preferences[$name];
  }

  function set_preference($name, $value) {
    global $preferences;
    global $tikidomain;

    @unlink("templates_c/$tikidomain/preferences.php");

    //refresh cache
    if(isset($preferences[$name])) {
      unset($preferences[$name]);

      $preferences[$name] = $value;
    }

    $query = "delete from `tiki_preferences` where `name`=?";
    $result = $this->query($query,array($name),-1,-1,false);
    $query = "insert into `tiki_preferences`(`name`,`value`) values(?,?)";
    $result = $this->query($query,array($name,$value));
    return true;
  }

function get_user_preference($user, $name, $default = '') {
    global $user_preferences;

    if(!isset($user_preferences[$user][$name])) {
      $query = "select `value` from `tiki_user_preferences` where `prefName`=? and `user`=?";

      $result = $this->query($query, array($name, $user));
      $row = $result->fetchRow();

      if(!is_array($row)) {
        $user_preferences[$user][$name] = $default;
      }

      else {
        $user_preferences[$user][$name] = $row['value'];
      }
    }

    return $user_preferences[$user][$name];
  }

  function set_user_preference($user, $name, $value) {
    global $user_preferences, $cachelib;

    require_once("lib/cache/cachelib.php");
    $cachelib->invalidate('user_details_'.$user);

    $user_preferences[$user][$name] = $value;
    $query = "delete from `tiki_user_preferences` where `user`=? and `prefName`=?";
    $bindvars=array($user,$name);
    $result = $this->query($query, $bindvars, -1,-1,false);
    $query = "insert into `tiki_user_preferences`(`user`,`prefName`,`value`) values(?, ?, ?)";
    $bindvars[]=$value;
    $result = $this->query($query, $bindvars);

    return true;
  }

  // similar to set_user_preference, but set all at once.
  function set_user_preferences($user, $preferences) {
    global $user_preferences, $cachelib;

    require_once("lib/cache/cachelib.php");
    $cachelib->invalidate('user_details_'.$user);

    $user_preferences = $preferences;

    $query = "delete from `tiki_user_preferences` where `user`=?";

    $result = $this->query($query, array($user), -1,-1,false);

    foreach($preferences as $prefName => $value) {
      $query = "insert into `tiki_user_preferences`(`user`,`prefName`,`value`) values(?, ?, ?)";
      $result = $this->query($query, array($user,$prefName,$value));
    }

    return true;
  }

  // This implements all the functions needed to use Tiki
  /*shared*/
  function page_exists($pageName, $casesensitive=false) {
    $query = "select `pageName` from `tiki_pages` where `pageName` = ?";
    $result = $this->query($query, array($pageName));

    // if casesensitive, check the name of the returned page:
    if(($casesensitive) && ($result->numRows())) {
      $res = $result->fetchRow();

      if($res["pageName"] <> $pageName) return 0;
    }

    return $result->numRows();
  }

  function page_exists_desc($pageName) {
    $query = "select `description`  from `tiki_pages`
             where `pageName` = ?";
    $result = $this->query($query, array($pageName));

    if(!$result->numRows())
      return false;

    $res = $result->fetchRow();

    if(!$res["description"])
      $res["description"] = tra('no description');

    return $res["description"];
  }

  function page_exists_modtime($pageName) {
    $query = "select `lastModif`  from `tiki_pages`
             where `pageName` = ?";
    $result = $this->query($query, array($pageName));

    if(!$result->numRows())
      return false;

    $res = $result->fetchRow();

    if(!$res["lastModif"])
      $res["lastModif"] = 0;

    return $res["lastModif"];
  }

  function add_hit($pageName) {
    $query = "update `tiki_pages` set `hits`=`hits`+1 where `pageName` = ?";
    $result = $this->query($query, array($pageName));
    return true;
  }

  function create_page($name, $hits, $data, $lastModif, $comment, $user = 'admin', $ip = '0.0.0.0', $description = '', $lang='', $is_html = false) {
    global $smarty;
    global $dbTiki;
    global $sender_email;
    include_once("lib/commentslib.php");

    $commentslib = new Comments($dbTiki);

    // Collect pages before modifying data
    $pages = $this->get_pages($data);

    // This *really* shouldn't be necessary now that the
    // query itself has been fixed up, and it causes much
    // badness to the phpwiki import.  -rlpowell
    //  $name = addslashes($name);
    //  $description = addslashes($description);
    //  $data = addslashes($data);
    //  $comment = addslashes($comment);

    if(!isset($_SERVER["SERVER_NAME"])) {
      $_SERVER["SERVER_NAME"] = $_SERVER["HTTP_HOST"];
    }

    if($this->page_exists($name))
      return false;

    $html=$is_html?1:0;

    if($lang) {   // not sure it is necessary
      $query = "insert into `tiki_pages`(`pageName`,`hits`,`data`,`lastModif`,`comment`,`version`,`user`,`ip`,`description`,`creator`,`page_size`,`lang`,`is_html`,`created`) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
      $result = $this->query($query, array($name, (int)$hits, $data, (int)$lastModif, $comment, 1, $user, $ip, $description, $user, (int)strlen($data), $lang, $html, mktime()));
    }

    else  {
      $query = "insert into `tiki_pages`(`pageName`,`hits`,`data`,`lastModif`,`comment`,`version`,`user`,`ip`,`description`,`creator`,`page_size`,`is_html`,`created`) values(?,?,?,?,?,?,?,?,?,?,?,?,?)";
      $result = $this->query($query, array($name, (int)$hits, $data, (int)$lastModif, $comment, 1, $user, $ip, $description, $user, (int)strlen($data), $html,mktime()));
    }

    $this->clear_links($name);

    // Pages are collected before adding slashes
    foreach($pages as $a_page) {
      $this->replace_link($name, $a_page);
    }

    // Update the log
    if(strtolower($name) != 'sandbox') {
      $action = "Created";//get_strings tra("Created");

      $query = "insert into `tiki_actionlog`(`action`,`pageName`,`lastModif`,`user`,`ip`,`comment`) values(?,?,?,?,?,?)";
      $result = $this->query($query, array(
                               $action,
                               $name,
                               (int)$lastModif,
                               $user,
                               $ip,
                               $comment
                             ));

      //  Deal with mail notifications.
      include_once('lib/notifications/notificationemaillib.php');
      //This is put away: sender_email must be enough!
      //  if( $this->get_preference('wiki_forum') ) {
      //      $forums = $commentslib->list_forums( 0, 1, 'name_asc', $this->get_preference('wiki_forum') );
      //    if ($forums)
      //      $fromEmail = $forums["data"][0]["outbound_from"];
      //    else
      //      $fromEmail = $sender_email;
      //  }
      $foo = parse_url($_SERVER["REQUEST_URI"]);
      $machine = $this->httpPrefix(). dirname($foo["path"]);
      sendWikiEmailNotification('wiki_page_created', $name, $user, $comment, 1, $data, $machine);
    }

    //if there are links to this page, clear cache to avoid linking to edition
    $result = $this->query("select `fromPage` from `tiki_links` where `toPage`=?",array($name));

    while($res = $result->fetchRow()) {
      $this->invalidate_cache($res['fromPage']);
    }

    global $feature_score;

    if($feature_score == 'y') {
      $this->score_event($user, 'wiki_new');
    }

    return true;
  }

  function get_user_pages($user, $max, $who='user') {
    $query = "select `pageName` from `tiki_pages` where `$who`=?";

    $result = $this->query($query,array($user),$max);
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res;
    }

    return $ret;
  }

  function get_user_galleries($user, $max) {
    $query = "select `name` ,`galleryId`  from `tiki_galleries` where `user`=? order by `name` asc";

    $result = $this->query($query,array($user),$max);
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res;
    }

    return $ret;
  }

  function get_page_info($pageName) {
    $query = "select * from `tiki_pages` where `pageName`=?";

    $result = $this->query($query, array($pageName));

    if(!$result->numRows())
      return false;

    else
      return $result->fetchRow();
  }
  function get_page_info_from_id($page_id) {
    $query = "select * from `tiki_pages` where `page_id`=?";

    $result = $this->query($query, array($page_id));

    if(!$result->numRows())
      return false;

    else
      return $result->fetchRow();
  }


  function get_page_name_from_id($page_id) {
    $query = "select `pageName`  from `tiki_pages` where `page_id`=?";
    return $this->getOne($query, array((int)$page_id));
  }

  function get_page_id_from_name($page) {
    $query = "select `page_id` from `tiki_pages` where `pageName`=?";
    return $this->getOne($query, array($page));
  }

  function how_many_at_start($str, $car) {
    $cant = 0;

    $i = 0;

    while(($i < strlen($str)) && (isset($str {$i})) && ($str {$i}== $car)) {
      $i++;

      $cant++;
    }

    return $cant;
  }

  function parse_data_raw($data) {
    $data = $this->parse_data($data);

    $data = str_replace("tiki-index", "tiki-index_raw", $data);
    return $data;
  }

  function add_pre_handler($name) {
    if(!in_array($name, $this->pre_handlers)) {
      $this->pre_handlers[] = $name;
    }
  }

  function add_pos_handler($name) {
    if(!in_array($name, $this->pos_handlers)) {
      $this->pos_handlers[] = $name;
    }
  }

  // add a post edit filter which is called when a wiki page is edited and before
  // it is committed to the database (see tiki-handlers.php on its usage)
  function add_postedit_handler($name)
  {
    if(!in_array($name,$this->postedit_handlers)) {
      $this->postedit_handlers[]=$name;
    }
  }

  // apply all the post edit handlers to the wiki page data
  function apply_postedit_handlers($data) {
    // Process editpage_handlers here
    foreach($this->postedit_handlers as $handler) {
      $data = $handler($data);
    }
    return $data;
  }

  // This function handles wiki codes for those special HTML characters
  // that textarea won't leave alone.
  function parse_htmlchar(&$data) {
    // cleaning some user input
    $data = preg_replace("/&(?!([a-z]{1,7};))/", "&amp;", $data);

    // oft-used characters (case insensitive)
    $data = preg_replace("/~bs~/i", "&#92;", $data);
    $data = preg_replace("/~hs~/i", "&nbsp;", $data);
    $data = preg_replace("/~amp~/i", "&amp;", $data);
    $data = preg_replace("/~ldq~/i", "&ldquo;", $data);
    $data = preg_replace("/~rdq~/i", "&rdquo;", $data);
    $data = preg_replace("/~lsq~/i", "&lsquo;", $data);
    $data = preg_replace("/~rsq~/i", "&rsquo;", $data);
    $data = preg_replace("/~c~/i", "&copy;", $data);
    $data = preg_replace("/~--~/", "&mdash;", $data);
    $data = preg_replace("/ -- /", " &mdash; ", $data);
    $data = preg_replace("/~lt~/i", "&lt;", $data);
    $data = preg_replace("/~gt~/i", "&gt;", $data);

    // HTML numeric character entities
    $data = preg_replace("/~([0-9]+)~/", "&#$1;", $data);
  }

  // Reverses parse_first.
  function replace_preparse(&$data, &$preparsed, &$noparsed)
  {
    $data1 = $data;
    $data2 = "";

    // Cook until done.  Handles nested cases.
    while($data1 != $data2)
    {
      $data1 = $data;

      if(isset($noparsed["key"]) and count($noparsed["key"]) and count($noparsed["key"]) == count($noparsed["data"]))
      {
        $data = preg_replace($noparsed["key"], $noparsed["data"], $data);
      }

      if(isset($preparsed["key"]) and count($preparsed["key"]) and count($preparsed["key"]) == count($preparsed["data"]))
      {
        $data = preg_replace($preparsed["key"], $preparsed["data"], $data);
      }

      $data2 = $data;
    }
  }

  function plugin_match(&$data, &$plugins)
  {
    $matcher = "/\{([A-Z]+)\(|~pp~|~np~|&lt;[pP][rR][eE]&gt;/";

    preg_match($matcher, $data, $plugins);

    /*
       print "<pre>Plugin match begin:";
       print_r( $plugins );
       print "</pre>";
     */

    // Check to make sure there was a match.
    if(
      count($plugins) > 0 &&
      count($plugins[0])  > 0
    )
    {
      // If it is a true plugin
      if($plugins[0][0] == "{")
      {
        $pos = strpos($data, $plugins[0]);   // where plugin starts

        $pos_end = $pos+strlen($plugins[0]); // where character after ( is

        // Here we're going to look for the end of the arguments for the plugin.

        $i = $pos_end;
        $last_data = strlen($data);

        // We start with one open curly brace, and one open paren.
        $curlies = 1;
        $parens = 1;

        // While we're not at the end of the string, and we still haven't found both closers
        while($i < $last_data)
        {
          //print "<pre>Data char: $data[$i], $curlies, $parens\n.</pre>\n";
          if($data[$i] == "{")
          {
            $curlies++;
          }

          else if($data[$i] == "(") {
            $parens++;
          }

          else if($data[$i] == "}") {
            $curlies--;
          }

          else if($data[$i] == ")") {
            $parens--;
            $lastParens = $i;
          }

          // If we found the end of the match...
          if($curlies == 0 && $parens == 0)
          {
            break;
          }

          $i++;
        }

        if($curlies == 0 && $parens == 0)
        {
          $plugins[2] = (string) substr($data, $pos_end, $lastParens - $pos_end);
          $plugins[0] = $plugins[0] .(string) substr($data, $pos_end, $i - $pos_end + 1);
          /*
             print "<pre>Match found: ";
             print( $plugins[2] );
             print "</pre>";
           */
        }
      }

      else {
        $plugins[1] = $plugins[0];
        $plugins[2] = "";
      }
    }

    /*
       print "<pre>Plugin match end:";
       print_r( $plugins );
       print "</pre>";
     */

  }

  // This recursive function handles pre- and no-parse sections and plugins
  function parse_first(&$data, &$preparsed, &$noparsed) {
    global $dbTiki;

    if(strlen($data) <= 1)
    {
      return;
    }

    // Find the plugins
    $this->plugin_match($data, $plugins);

    $data1 = $data;
    $data2 = "";

    // Cook until done.
    while(count($plugins) > 0 && ($data1 != $data2))
    {
      $data1 = $data;
      $plugin_start = $plugins[0];

      /*
       print "<pre>real data: :".htmlspecialchars( $data ) .":</pre>";

         print "<pre>plugins:";
         print_r( $plugins );
         print "</pre>";
         print "<pre>start: :".htmlspecialchars( $plugin_start ) .":</pre>";
       */

      if(count($plugins) > 1)
      {
        $plugin = $plugins[1];
      }

      // print "<pre>plugin: :".htmlspecialchars( $plugin ) .":</pre>";

      $pos = strpos($data, $plugins[0]);   // where the plugin starts

      // where the part after the plugin arguments starts
      $pos_middle = $pos + strlen($plugins[0]);

      // print "<pre>pos's: :$pos, $pos_middle:</pre>";

      // process "short" plugins here: {PLUGIN(par1=>val1)/} - melmut
      if(preg_match("/\/ *\}$/",$plugin_start))
      {
        $plugin_end='';
        $pos_end = $pos + strlen($plugin_start);
      }

      else if(preg_match("/^ *~pp~|^ *~np~/", $plugin_start)) {
        $plugin_end = preg_replace('/^(.)/', '$1/', $plugin_start);
        $pos_end = strpos($data, $plugin_end, $pos); // where plugin data ends
      }

      else if(preg_match("/^ *&lt;[pP][rR][eE]&gt;/", $plugin_start)) {
        preg_match("/&lt;\/[pP][rR][eE]&gt;/", $data, $plugin_ends, 0, $pos); // where plugin data ends
        $plugin_end = $plugin_ends[0];
        $pos_end = strpos($data, $plugin_end, $pos); // where plugin data ends
      }

      else {
        $plugin_end = '{' . $plugin;
        $count=1;

        while($count) { // this takes care of possible nested plugins with same name
          $pos_end = strpos($data, $plugin_end, $pos_middle);

          if($pos_end === false) {
            break;
          }

          $pos_middle = $pos_end+strlen($plugin_end);

          if($data {$pos_middle} == '}') $count--;
          else if($data {$pos_middle} == '(') $count++;
        }

        $plugin_end .= '}'; // where plugin data ends
      }

      /*
         print "<pre>pos's2: :$pos, $pos_middle, $pos_end:</pre>";
         print "<pre>plugin_end: :".htmlspecialchars( $plugin_end ) .":</pre>";
       */

      // Extract the plugin data
      if($pos_end === false) {
        $pos_end = strlen($data);
      }

      $plugin_data_len = $pos_end - $pos - strlen($plugins[0]);
      $plugin_data = substr($data, $pos + strlen($plugin_start), $plugin_data_len);

      /*
         print "<pre>data: :".htmlspecialchars( $plugin_data ) .":</pre>";
         print "<pre>end: :".htmlspecialchars( $plugin_end ) .":</pre>";
       */

      if(preg_match("/^ *&lt;[pP][rR][eE]&gt;|^ *~pp~|^ *~np~/", $plugin_start))
        // ~pp~ type "plugins"
      {
        $key = md5($this->genPass());
        $noparsed["key"][] = "/". preg_quote($key)."/";

        $plugin_data = str_replace('\\','\\\\',$plugin_data);

        if(strstr($plugin_data, '$'))
        {
          $plugin_data = str_replace('$', '\$', $plugin_data);
        }

        if($plugin_start == "~pp~")
        {
          $noparsed["data"][] = "<pre>" . $plugin_data . "</pre>";
        }

        else if(preg_match("/^ *&lt;[pP][rR][eE]&gt;/", $plugin_start)) {
          preg_match("/^ *&lt;([pP][rR][eE])&gt;/", $plugin_start, $plugins);
          $plugin_start2 = $plugins[1];
          preg_match("/^ *&lt;\/([pP][rR][eE])&gt;/", $plugin_end, $plugins);
          $plugin_end2 = $plugins[1];
          $noparsed["data"][] = "<" . $plugin_start2 . ">" . $plugin_data . "</" . $plugin_end2 . ">";
        }

        else {
          $noparsed["data"][] = $plugin_data;
        }

        // Replace plugin section with its output in data
        $data = substr_replace($data, $key, $pos, $pos_end - $pos + strlen($plugin_end));
      }

      else {
        // print "<pre>args1: :".htmlspecialchars( $plugins[2] ) .":</pre>";
        // Handle nested plugins in the arguments.
        $this->parse_first($plugins[2], $preparsed, $noparsed);
        // print "<pre>args2: :".htmlspecialchars( $plugins[2] ) .":</pre>";

        // Normal plugins

        // Construct plugin file pathname
        $php_name = 'lib/wiki-plugins/wikiplugin_';
        $php_name .= strtolower($plugins[1]). '.php';

        // Construct plugin function name
        $func_name = 'wikiplugin_' . strtolower($plugins[1]);

        $params_string = $plugins[2];

        // the following str_replace line is to decode the &gt; char when html is turned off
        // perhaps the plugin syntax should be changed in 1.8 not to use any html special chars
        $params_string = str_replace('&gt;', '>', $params_string);
        $params_string = str_replace('&lt;', '<', $params_string);
        $params_string = str_replace('&quot;', '"', $params_string);
        $params_string = str_replace('&amp;', '&', $params_string);

        // Construct argument list array
        $params = $this->quotesplit(',', trim($params_string));
        $arguments = array();

        foreach($params as $param) {
          $parts = $this->quotesplit('=>?', $param);

          if(isset($parts[0]) && isset($parts[1])) {
            $name = trim($parts[0]);
            $argument = trim($parts[1]);
            // the following preg_replace removes more unwanted css attributes passed after ";" (including)
            $argument = preg_replace('/([^\;]+)\;.*/','$1;',$argument);

            // The following strips quotes at the beginning and end, if both are found
            if(preg_match('/^".*"$/', $argument))
            {
              $argument = preg_replace('/^"/', '', $argument);
              $argument = preg_replace('/"$/', '', $argument);
            }

            $arguments[$name] = $argument;
          }
        }

        if(file_exists($php_name)) {
          include_once($php_name);

          // We store CODE stuff out of the way too, but then process it as a plugin as well.
          if(preg_match('/^ *\{CODE\(/', $plugin_start))
          {
            $ret = $func_name($plugin_data, $arguments);

            // Pull the np out.
            preg_match("/~np~(.*)~\/np~/s", $ret, $stuff);

            if(count($stuff) > 0)
            {
              $key = md5($this->genPass());
              $noparsed["key"][] = "/". preg_quote($key)."/";
              $noparsed["data"][] = $stuff[1];

              $ret = preg_replace("/~np~.*~\/np~/s", $key, $ret);
            }

          }

          else {
            // Handle nested plugins.
            $this->parse_first($plugin_data, $preparsed, $noparsed);

            $ret = $func_name($plugin_data, $arguments);
          }
        }

        else {
          // Handle nested plugins.
          $this->parse_first($plugin_data, $preparsed, $noparsed);

          $ret = tra("__WARNING__: No such module $plugin! ") . $plugin_data;
        }

        // Handle pre- & no-parse sections and plugins inserted by this plugin
        $this->parse_first($ret, $preparsed, $noparsed);
        //$ret = $this->parse_data($ret);

        // Replace plugin section with its output in data
        $data = substr_replace($data, $ret, $pos, $pos_end - $pos + strlen($plugin_end));

      }

      // Find the plugins
      // note: [1] is plugin name, [2] is plugin arguments
      $this->plugin_match($data, $plugins);

      $data2 = $data;

    } // while

    // print "<pre>real done data: :".htmlspecialchars( $data ) .":</pre>";
  }

  function quotesplit($splitter=',', $repl_string)
  {
    $matches = preg_match_all('/"[^"]*"/', $repl_string, $quotes);

    $quote_keys = array();

    if($matches)
    {
      foreach(array_unique($quotes) as $quote)
      {
        $key = md5($this->genPass());

        $aux["key"] = $key;
        $aux["data"] = $quote;
        $quote_keys[] = $aux;
        $repl_string = str_replace($quote, $key, $repl_string);
      }
    }

    $result = preg_split("/".$splitter."/", $repl_string);

    if($matches)
    {
      // Loop through the result sections
      while(list($rarg, $rval) = each($result))
      {
        // Replace all stored strings
        foreach($quote_keys as $qval)
        {
          $replacement = $qval["data"][0];
          $result[$rarg] = str_replace($qval["key"], $replacement, $rval);
        }
      }
    }

    return $result;
  }


  // Replace hotwords in given line
  function replace_hotwords($line, $words) {
    global $feature_hotwords;
    global $feature_hotwords_nw;
    $hotw_nw = ($feature_hotwords_nw == 'y') ? "target='_blank'" : '';

    // Replace Hotwords
    if($feature_hotwords == 'y') {
      foreach($words as $word => $url) {
        // \b is a word boundary, \s is a space char
        $pregword = preg_replace("/\//","\/",$word);
        $line = preg_replace("/(=(\"|')[^\"']*[ \n\t\r\,\;'])$pregword([ \n\t\r\,\;][^\"']*(\"|'))/i","$1:::::$word,:::::$3",$line);
        $line = preg_replace("/([ \n\t\r\,\;']|^)$pregword($|[ \n\t\r\,\;])/i","$1<a class=\"wiki\" href=\"$url\" $hotw_nw>$word</a>$2",$line);
        $line = preg_replace("/:::::$pregword,:::::/i","$word",$line);
      }
    }

    return $line;
  }

  // Make plain text URIs in text into clickable hyperlinks
  function autolinks($text) {
    //  check to see if autolinks is enabled before calling this function
    //    global $feature_autolinks;

    //    if ($feature_autolinks == "y") {
    global $feature_wiki_ext_icon;
    $attrib = '';

    if($this->get_preference('popupLinks', 'n') == 'y')
      $attrib .= 'target="_blank" ';

    if($feature_wiki_ext_icon == 'y') {
      $attrib .= 'class="wiki external" ';
      $ext_icon = "";
    }

    else {
      $attrib .= 'class="wiki" ';
      $ext_icon = "";
    }

    // add a space so we can match links starting at the beginning of the first line
    $text = " " . $text;
    // match prefix://suffix, www.prefix.suffix/optionalpath, prefix@suffix
    $patterns = array("#([\n ])([a-z0-9]+?)://([^<, \n\r]+)#i", "#([\n ])www\.([a-z0-9\-]+)\.([a-z0-9\-.\~]+)((?:/[^<, \n\r]*)?)#i", "#([\n ])([a-z0-9\-_.]+?)@([\w\-]+\.([\w\-\.]+\.)*[\w]+)#i", "#([\n ])magnet\:\?([^<, \n\r]+)#i");
    $replacements = array("\\1<a $attrib href=\"\\2://\\3\">\\2://\\3$ext_icon</a>", "\\1<a $attrib href=\"http://www.\\2.\\3\\4\">www.\\2.\\3\\4$ext_icon</a>", "\\1<a class='wiki' href=\"mailto:\\2@\\3\">\\2@\\3</a>", "\\1<a class='wiki' href=\"magnet:?\\2\">magnet:?\\2</a>");
    $text = preg_replace($patterns, $replacements, $text);
    // strip the space we added
    $text = substr($text, 1);
    return $text;

    //    } else {
    //      return $text;
    //    }
  }


  //Updates a dynamic variable found in some object
  /*Shared*/ function update_dynamic_variable($name,$value) {
    $query = "delete from `tiki_dynamic_variables` where `name`=?";
    $this->query($query,array($name),-1,-1,false);
    $query = "insert into `tiki_dynamic_variables`(`name`,`data`) values(?,?)";
    $this->query($query,Array($name,$value));
    return true;
  }


  // split string into a list of
  function split_tag($string) {
    $_splts = preg_split('/&quot;/', $string);
    $inside = FALSE;
    $cleanup= TRUE;  // @todo: make this an option for other code
    $parts = array();
    $index=0;

    foreach($_splts as $i)  {
      if($cleanup) {
        $i = str_replace('}', '', $i);
        $i = str_replace('{', '', $i);
        $i = str_replace('\'', '', $i);
        $i = str_replace('"', '', $i);
        // IE silently removes null-byte html char \0, so let's remove it anyways
        $i = str_replace('\\0', '', $i);
      }

      if($inside) {   // inside "foo bar" - append
        if($index>0) {
          $parts[$index-1] .= $i;
        }

        else {      // else: first element (should never happen)
          $parts[] = $i;
        }
      }

      else {          //
        $_spl = preg_split("/ /", $i);
        foreach($_spl as $j) {
          $parts[$index++] = $j;
        }
      }

      $inside = ! $inside;
    }
    return $parts;
  }

  function split_assoc_array($parts, $assoc) {
    //$assoc = array();
    foreach($parts as $part) {
      $res=array();
      $assoc[$part] = '';
      preg_match("/(\w+)\s*=\s*(.*)/", $part, $res);

      if($res) {
        $assoc[$res[1]] = $res[2];
      }
    }
    return $assoc;
  }

  /**
   * close_blocks - Close out open paragraph, lists, and div's
   *
   * During parse_data, information is kept on blocks of text (paragraphs, lists, divs)
   * that need to be closed out. This function does that, rather than duplicating the
   * code inline.
   *
   * @param $data     - Output data
   * @param $in_paragraph   - TRUE if there is an open paragraph
   * @param $listbeg    - array of open list terminators
   * @param $divdepth   - array indicating how many div's are open
   * @param $close_paragraph  - TRUE if open paragraph should be closed.
   * @param $close_lists    - TRUE if open lists should be closed.
   * @param $close_divs   - TRUE if open div's should be closed.
   */
  /* private */
  function close_blocks(&$data,
                        &$in_paragraph,
                        &$listbeg,
                        &$divdepth,
                        $close_paragraph,
                        $close_lists,
                        $close_divs)
  {
    $closed = 0;  // Set to non-zero if something has been closed out

    // Close the paragraph if inside one.
    if($close_paragraph && $in_paragraph) {
      $data .= "</p>";
      $in_paragraph = 0;
      $closed++;
    }

    // Close open lists
    if($close_lists) {
      while(count($listbeg)) {
        $data .= array_shift($listbeg);
        $closed++;
      }
    }

    // Close open divs
    if($close_divs) {
      $temp_max = count($divdepth);

      for($i = 1; $i <= $temp_max; $i++) {
        $data .= '</div>';
        $closed++;
      }
    }

    if($closed) {
      $data .= "\n";
    }

    return $closed;
  }

  //PARSEDATA
  function parse_data($data, $is_html=false) {
    global $page_regex;

    global $slidemode;
    global $feature_hotwords;
    global $feature_autolinks;
    global $cachepages;
    global $ownurl_father;
    global $feature_drawings;
    global $tiki_p_admin_drawings;
    global $tiki_p_edit_drawings;
    global $tiki_p_edit_dynvar;
    global $feature_wiki_pictures;
    global $tiki_p_upload_picture;
    global $feature_wiki_plurals;
    global $feature_wiki_tables;
    global $page;
    global $page_ref_id;
    global $rsslib;
    global $dbTiki;
    global $structlib;
    global $user;
    global $tikidomain;
    global $feature_wikiwords;
    global $feature_wiki_paragraph_formatting;
    global $feature_wikiwords_usedash;
    global $feature_multilingual;
    global $feature_best_language;
    // melmut - if $is_html is set, check $wiki_wikisyntax_in_html,
    //  which can be set to 'full' (default), 'partial' or 'none'
    global $wiki_wikisyntax_in_html;
    $simple_wiki=false;

    if($is_html)
    {
      // if it is set to 'none', don't parse anything
      if($wiki_wikisyntax_in_html=='none')
        return $data;

      // if it is set to 'partial', disable some wiki syntax
      // basically, allow wiki plugins, wiki links and almost
      // everything between {}
      $simple_wiki=$wiki_wikisyntax_in_html!='full';
    }

    // Process pre_handlers here
    if(is_array($this->pre_handlers)) {
      foreach($this->pre_handlers as $handler) {
        $data = $handler($data);
      }
    }

    // Handle pre- and no-parse sections and plugins
    $preparsed = array('data'=>array(),'key'=>array());
    $noparsed = array('data'=>array(),'key'=>array());
    $this->parse_first($data, $preparsed, $noparsed);

    global $feature_wiki_attachments;

    if($feature_wiki_attachments == 'y')
    {
      // Handle wiki file links by turning them into ATTACH module calls.
      preg_match_all("/(\{file [^\}]+})/", $data, $pages);

      foreach(array_unique($pages[1])as $page_parse) {
        $parts = $this->split_tag($page_parse);

        $filedata = array();      // pre-set preferences
        $filedata["name"] = '';
        $filedata["desc"] = '';
        $filedata["showdesc"] = '';
        $filedata["page"] = '';
        $filedata["image"] = '';
        $filedata = $this->split_assoc_array($parts, $filedata);

        $middle = "";

        if(! $filedata["name"])
        {
          continue;
        }

        $repl = "{ATTACH(file=>".$filedata["name"];

        if($filedata["desc"])
        {
          $repl .= ",inline=>1";
          $middle = $filedata["desc"];
        }

        if($filedata["page"])
        {
          $repl .= ",page=>" . $filedata["page"];
        }

        if($filedata["showdesc"])
        {
          $repl .= ",showdesc=>1";
        }

        if($filedata["image"])
        {
          $repl .= ",image=>1";
        }

        $repl .= ")}$middle{ATTACH}";

        $data = str_replace($page_parse, $repl, $data);
      }
    }

    // ESTUDIOLIVRE HACK - wiki template
    $this->getWikiTemplate($data);

    $this->parse_first($data, $preparsed, $noparsed);

    // Extract [link] sections (to be re-inserted later)
    $noparsedlinks = array();

    // This section matches [...].
    // Added handling for [[foo] sections.  -rlpowell
    if(!$simple_wiki) {
      preg_match_all("/(?<!\[)\[([^\[][^\]]+)\]/", $data, $noparseurl);

      foreach(array_unique($noparseurl[1])as $np) {
        $key = md5($this->genPass());

        $aux["key"] = $key;
        $aux["data"] = $np;
        $noparsedlinks[] = $aux;
        $data = str_replace("$np", $key, $data);
      }
    }

    // Replace special characters
    //done after url catching because otherwise urls of dyn. sites will be modified
    if(!$simple_wiki)
      $this->parse_htmlchar($data);

    // Now replace a TOC
    preg_match_all("/\{toc\s?(order=(desc|asc))?\s?(showdesc=(0|1))?\s?(shownum=(0|1))?\s?(type=(plain|fancy))?\s?(maxdepth=(\d+))?\s?\}/i", $data, $tocs);

    // Loop over all the case-specific versions of {toc} used
    // (if the user is consistent, this is a loop of count 1)
    $temp_max = count($tocs[0]);

    for($i = 0; $i < $temp_max; $i++) {

      //If there are instances of {toc} on this page
      if(count($tocs[0]) > 0) {
        $order = 'asc';
        $showdesc = false;
        $shownum = false;
        $type = 'plain';
        $maxdepth = 0;

        if($tocs[2][$i] == 'desc') {
          $order = 'desc';
        }

        if($tocs[4][$i] == 1) {
          $showdesc = true;
        }

        if($tocs[6][$i] == 1) {
          $shownum = true;
        }

        if($tocs[8][$i] == 'fancy') {
          $type = 'fancy';
        }

        if($tocs[10][$i] != '') {
          $maxdepth = $tocs[10][$i];
        }

        include_once("lib/structures/structlib.php");
        //And we are currently viewing a structure
        $page_info = $structlib->s_get_page_info($page_ref_id);

        if(isset($page_info)) {
          $html = $structlib->get_toc($page_ref_id,$order,$showdesc,$shownum,'',$type,$maxdepth);
          $data = str_replace($tocs[0][$i], $html, $data);
        }

        else {
          //Dont display the {toc} string for non structure pages
          $data = str_replace($tocs[0][$i], '', $data);
        }
      }
    }

    // Now search for images uploaded by users
    if($feature_wiki_pictures == 'y') {
      preg_match_all("/\{picture file=([^\}]+)\}/", $data, $pics);

      $temp_max = count($pics[0]);

      for($i = 0; $i < $temp_max; $i++) {
        // Check if the image exists
        $name = $pics[1][$i];

        if($tikidomain) {
          $name = preg_replace("~img/wiki_up/~","img/wiki_up/$tikidomain/",$name);
        }

        if(file_exists($name) and(preg_match('/(gif|jpe?g|png)$/i',$name))) {
          // Replace by the img tag to show the image
          $repl = "<span class='img'><img src='$name' alt='$name' /></span>";
        }

        else {
          $repl = tra('picture not found')." $name";
        }

        // Replace by $repl
        $data = str_replace($pics[0][$i], $repl, $data);
      }
    }

    //$data = strip_tags($data);
    // BiDi markers
    $bidiCount = 0;
    $bidiCount = preg_match_all("/(\{l2r\})/", $data, $pages);
    $bidiCount += preg_match_all("/(\{r2l\})/", $data, $pages);

    $data = preg_replace("/\{l2r\}/", "<div dir='ltr'>", $data);
    $data = preg_replace("/\{r2l\}/", "<div dir='rtl'>", $data);
    $data = preg_replace("/\{lm\}/", "&lrm;", $data);
    $data = preg_replace("/\{rm\}/", "&rlm;", $data);
    // smileys
    $data = $this->parse_smileys($data);

    // Replace links to slideshows
    if($feature_drawings == 'y') {
      // Replace drawings
      // Replace rss modules
      $pars = parse_url($_SERVER["REQUEST_URI"]);

      $pars_parts = split('/', $pars["path"]);
      $pars = array();

      $temp_max = count($pars_parts) - 1;

      for($i = 0; $i < $temp_max; $i++) {
        $pars[] = $pars_parts[$i];
      }

      $pars = join('/', $pars);

      if(preg_match_all("/\{draw +name=([A-Za-z_\-0-9]+) *\}/", $data, $draws)) {
        //$this->invalidate_cache($page);
        $temp_max = count($draws[0]);

        for($i = 0; $i < $temp_max; $i++) {
          $id = $draws[1][$i];

          $repl = '';

          if($tikidomain) {
            $name = $tikidomain.'/'.$id . '.gif';
          }

          else {
            $name = $id . '.gif';
          }

          if(file_exists("img/wiki/$name")) {
            if($tiki_p_edit_drawings == 'y' || $tiki_p_admin_drawings == 'y') {
              $repl = "<a href='#' onclick=\"javascript:window.open('tiki-editdrawing.php?page=" . urlencode($page). "&amp;path=$pars&amp;drawing={$id}','','menubar=no,width=252,height=25');\"><img border='0' src='img/wiki/$name' alt='click to edit' /></a>";
            }

            else {
              $repl = "<img border='0' src='img/wiki/$name' alt='a drawing' />";
            }
          }

          else {
            if($tiki_p_edit_drawings == 'y' || $tiki_p_admin_drawings == 'y') {
              $repl = "<a class='wiki' href='#' onclick=\"javascript:window.open('tiki-editdrawing.php?page=" . urlencode($page). "&amp;path=$pars&amp;drawing={$id}','','menubar=no,width=252,height=25');\">click here to create draw $id</a>";
            }

            else {
              $repl = tra('drawing not found');
            }
          }

          $data = str_replace($draws[0][$i], $repl, $data);
        }
      }
    }

    // Replace cookies
    if(preg_match_all("/\{cookie\}/", $data, $rsss)) {
      $temp_max = count($rsss[0]);

      for($i = 0; $i < $temp_max; $i++) {
        $cookie = $this->pick_cookie();

        $data = str_replace($rsss[0][$i], $cookie, $data);
      }
    }

    // Replace dynamic variables
    // Dynamic variables are similar to dynamic content but they are editable
    // from the page directly, intended for short data, not long text but text
    // will work too
    //     Now won't match HTML-style '%nn' letter codes.
    if(preg_match_all("/%([^% 0-9][^% 0-9][^% ]*)%/",$data,$dvars)) {
      // remove repeated elements
      $dvars = array_unique($dvars[1]);
      // Now replace each dynamic variable by a pair composed of the
      // variable value and a text field to edit the variable. Each
      foreach($dvars as $dvar) {
        $query = "select `data` from `tiki_dynamic_variables` where `name`=?";
        $result = $this->query($query,Array($dvar));

        if($result->numRows()) {
          $value = $result->fetchRow();
          $value = $value["data"];
        }

        else {
          //Default value is NULL
          $value = "NaV";
        }

        // Now build 2 divs
        $id = 'dyn_'.$dvar;

        if(isset($tiki_p_edit_dynvar)&& $tiki_p_edit_dynvar=='y') {
          $span1 = "<span  style='display:inline;' id='dyn_".$dvar."_display'><a class='dynavar' onclick='javascript:toggle_dynamic_var(\"$dvar\");' title='".tra('Click to edit dynamic variable').": $dvar'>$value</a></span>";
          $span2 = "<span style='display:none;' id='dyn_".$dvar."_edit'><input type='text' name='dyn_".$dvar."' value='".$value."' />".'<input type="submit" name="_dyn_update" value="'.tra('Update variables').'"/></span>';
        }

        else {
          $span1 = "<span class='dynavar' style='display:inline;' id='dyn_".$dvar."_display'>$value</span>";
          $span2 = '';
        }

        $html = $span1.$span2;
        //It's important to replace only once
        $dvar_preg = preg_quote($dvar);
        $data = preg_replace("+%$dvar_preg%+",$html,$data,1);
        //Further replacements only with the value
        $data = str_replace("%$dvar%",$value,$data);

      }
      //At the end put an update button
      //<br /><div align="center"><input type="submit" name="dyn_update" value="'.tra('Update variables').'"/></div>
      $data='<form method="post" name="dyn_vars">'."\n".$data.'</form>';
    }

    // Replace dynamic content occurrences
    if(preg_match_all("/\{content +id=([0-9]+)\}/", $data, $dcs)) {
      $temp_max = count($dcs[0]);

      for($i = 0; $i < $temp_max; $i++) {
        $repl = $this->get_actual_content($dcs[1][$i]);
        $data = str_replace($dcs[0][$i], $repl, $data);
      }
    }

    // Replace Dynamic content with random selection
    if(preg_match_all("/\{rcontent +id=([0-9]+)\}/", $data, $dcs)) {
      global $dcslib;
      include_once("dcs/dcslib.php");
      $temp_max = count($dcs[0]);

      for($i = 0; $i < $temp_max; $i++) {
        $repl = $dcslib->get_random_content($dcs[1][$i]);

        $data = str_replace($dcs[0][$i], $repl, $data);
      }
    }

    if(!$simple_wiki) {
      // Replace boxes
      $data = preg_replace("/\^([^\^]+)\^/", "<div class=\"simplebox\">$1</div>", $data);
      // Replace colors ~~color:text~~
      $data = preg_replace("/\~\~([^\:]+):([^\~]+)\~\~/", "<span style=\"color:$1;\">$2</span>", $data);
      // Underlined text
      $data = preg_replace("/===([^\=]+)===/", "<span style=\"text-decoration:underline;\">$1</span>", $data);
      // Center text
      $data = preg_replace("/::(.+?)::/", "<div align=\"center\">$1</div>", $data);
    }

    // definitively put out the protected words ))protectedWord((
    preg_match_all("/\)\)(\S*?)\(\(/", $data, $matches);
    $noParseWikiLinksK = array();
    $noParseWikiLinksT = array();
    foreach($matches[0] as $mi=>$match) {
      do {
        $randNum = chr(0xff).rand(0, 1048576).chr(0xff);
      }
      while(strstr($data, $randNum));

      $data = str_replace($match, $randNum, $data);
      $noParseWikiLinksK[] = $randNum;
      $noParseWikiLinksT[] = $matches[1][$mi];
    }

    // New syntax for wiki pages ((name|desc)) Where desc can be anything
    // preg_match_all("/\(\(($page_regex)\|(.+?)\)\)/", $data, $pages);
    // match ((name|desc)) as well as ((name|))
    preg_match_all("/\(\(($page_regex)\|([^\)]*?)\)\)/", $data, $pages);

    $temp_max = count($pages[1]);

    for($i = 0; $i < $temp_max; $i++) {
      $pattern = $pages[0][$i];

      $pattern = preg_quote($pattern, "/");

      $pattern = "/" . $pattern . "/";

      // Replace links to external wikis
      $repl2 = true;

      if(strstr($pages[1][$i], ':')) {
        $wexs = explode(':', $pages[1][$i]);

        if(count($wexs) == 2) {
          $wkname = $wexs[0];

          if($this->db->getOne("select count(*) from `tiki_extwiki` where `name`=?",array($wkname)) == 1) {
            $wkurl = $this->db->getOne("select `extwiki`  from `tiki_extwiki` where `name`=?",array($wkname));

            $wkurl = '<a href="' . str_replace('$page', urlencode($wexs[1]), $wkurl). '" class="wiki external">' . $wexs[1] . '</a>';
            $data = preg_replace($pattern, "$wkurl", $data);
            $repl2 = false;
          }
        }
      }

      if($repl2) {
        // 24-Jun-2003, by zaufi
        // TODO: future optimize: get page description and modification time at once.

        // text[0] = link description (previous format)
        // text[1] = timeout in seconds (new field)
        // text[2..N] = drop
        $text = explode("|", $pages[5][$i]);

        if($desc = $this->page_exists_desc($pages[1][$i])) {
          // why the preg_replace? ex: ((page||Page-Desc)) the desc must stay Page-Desc, and not ))Page-Desc((
          $desc1 = $desc;
          $desc = preg_replace("/([ \n\t\r\,\;]|^)([A-Z][a-z0-9_\-]+[A-Z][a-z0-9_\-]+[A-Za-z0-9\-_]*)($|[ \n\t\r\,\;\.])/s", "$1))$2(($3", $desc);
          $bestLang = ($feature_multilingual == 'y' && $feature_best_language == 'y')? "&amp;bl" : "";
          $uri_ref = "tiki-index.php?page=" . urlencode($pages[1][$i]).$bestLang;

          // check to see if desc is blank in ((page|desc))
          if(strlen(trim($text[0])) > 0) {
            $linktext = $text[0];
          }

          elseif($desc != $pages[1][$i]) {
            // desc is blank; use the page description instead
            $linktext = $pages[1][$i] . ': ' . $desc;
          }

          else {
            // there is no page description
            $linktext = $pages[1][$i];
          }

          $repl = '<a href="'.$uri_ref.'" class="wiki">' . $linktext . '</a>';

          // Check is timeout expired?
          if(isset($text[1]) && (time() - intval($this->page_exists_modtime($pages[1][$i]))) < intval($text[1]))
            // Append small 'new' image. TODO: possible 'updated' image more suitable...
            $repl .= '&nbsp;<img src="img/icons/new.gif" border="0" alt="'.tra("new").'" />';
        }

        else {
          $uri_ref = "tiki-editpage.php?page=" . urlencode($pages[1][$i]);

          $repl = (strlen(trim($text[0])) > 0 ? $text[0] : $pages[1][$i]) . '<a href="'.$uri_ref.'" title="'.tra("Create page:")." ".urlencode($pages[1][$i]).'" class="wiki wikinew">?</a>';
        }

        $data = preg_replace($pattern, "$repl", $data);
      }
    }

    // New syntax for wiki pages ((name)) Where name can be anything
    preg_match_all("/\(\( *($page_regex) *\)\)/", $data, $pages);

    foreach(array_unique($pages[1]) as $page_parse) {
      $repl2 = true;

      if(strstr($page_parse, ':')) {
        $wexs = explode(':', $page_parse);

        if(count($wexs) == 2) {
          $wkname = $wexs[0];

          if($this->db->getOne("select count(*) from `tiki_extwiki` where `name`=?",array($wkname)) == 1) {
            $wkurl = $this->db->getOne("select `extwiki`  from `tiki_extwiki` where `name`=?",array($wkname));

            $wkurl = '<a href="' . str_replace('$page', urlencode($wexs[1]), $wkurl). '" class="wiki external">' . $wexs[1] . '</a>';
            $data = preg_replace("/\(\($page_parse\)\)/", "$wkurl", $data);
            $repl2 = false;
          }
        }
      }

      if($repl2) {
        if($desc = $this->page_exists_desc($page_parse)) {
          // why the preg_replace? ex: ((page||Page-Desc)) the desc must stay Page-Desc in the title, and not ))Page-Desc((
          //$desc = preg_replace("/([ \n\t\r\,\;]|^)([A-Z][a-z0-9_\-]+[A-Z][a-z0-9_\-]+[A-Za-z0-9\-_]*)($|[ \n\t\r\,\;\.])/s", "$1))$2(($3", $desc);
          $bestLang = ($feature_multilingual == 'y' && $feature_best_language == 'y')? "&amp;bl" : ""; // to choose the best page language
          $repl = "<a title=\"$desc\" href='tiki-index.php?page=" . urlencode($page_parse).$bestLang. "' class='wiki'>$page_parse</a>";
        }

        else {
          $repl = $page_parse.'<a href="tiki-editpage.php?page=' . urlencode($page_parse). '" title="'.tra("Create page:").' '.urlencode($page_parse).'"  class="wiki wikinew">?</a>';
        }

        $page_parse_pq = preg_quote($page_parse, "/");
        $data = preg_replace("/\(\($page_parse_pq\)\)/", "$repl", $data);
      }
    }

    // Links to internal pages
    // If they are parenthesized then don't treat as links
    // Prevent ))PageName(( from being expanded \"\'
    //[A-Z][a-z0-9_\-]+[A-Z][a-z0-9_\-]+[A-Za-z0-9\-_]*
    if(!$simple_wiki&&$feature_wikiwords == 'y') {
      // The first part is now mandatory to prevent [Foo|MyPage] from being converted!
      if($feature_wikiwords_usedash == 'y') {
        preg_match_all("/(?<=[ \n\t\r\,\;]|^)([A-Z][a-z0-9_\-\x80-\xFF]+[A-Z][a-z0-9_\-\x80-\xFF]+[A-Za-z0-9\-_\x80-\xFF]*)(?=$|[ \n\t\r\,\;\.])/", $data, $pages);
      }

      else {
        preg_match_all("/(?<=[ \n\t\r\,\;]|^)([A-Z][a-z0-9\x80-\xFF]+[A-Z][a-z0-9\x80-\xFF]+[A-Za-z0-9\x80-\xFF]*)(?=$|[ \n\t\r\,\;\.])/", $data, $pages);
      }

      //TODO to have a real utf8 Wikiword where the capitals can be a utf8 capital
      $words = $this->get_hotwords();
      foreach(array_unique($pages[1])as $page_parse) {
        if(!array_key_exists($page_parse, $words)) {
          if($desc = $this->page_exists_desc($page_parse)) {
            //$desc = preg_replace("/([ \n\t\r\,\;]|^)([A-Z][a-z0-9_\-]+[A-Z][a-z0-9_\-]+[A-Za-z0-9\-_]*)($|[ \n\t\r\,\;\.])/s", "$1))$2(($3", $desc);
            $repl = '<a title="' . htmlspecialchars($desc) . '" href="tiki-index.php?page=' . urlencode($page_parse). '" class="wiki">' . $page_parse . '</a>';
          }

          elseif($feature_wiki_plurals == 'y' && $this->get_locale() == 'en_US') {
# Link plural topic names to singular topic names if the plural
# doesn't exist, and the language is english
            $plural_tmp = $page_parse;
# Plurals like policy / policies
            $plural_tmp = preg_replace("/ies$/", "y", $plural_tmp);
# Plurals like address / addresses
            $plural_tmp = preg_replace("/sses$/", "ss", $plural_tmp);
# Plurals like box / boxes
            $plural_tmp = preg_replace("/([Xx])es$/", "$1", $plural_tmp);
# Others, excluding ending ss like address(es)
            $plural_tmp = preg_replace("/([A-Za-rt-z])s$/", "$1", $plural_tmp);
            if($desc = $this->page_exists_desc($plural_tmp)) {
              // $desc = preg_replace("/([ \n\t\r\,\;]|^)([A-Z][a-z0-9_\-]+[A-Z][a-z0-9_\-]+[A-Za-z0-9\-_]*)($|[ \n\t\r\,\;\.])/s", "$1))$2(($3", $desc);
              // $repl = "<a title=\"".$desc."\" href=\"tiki-index.php?page=$plural_tmp\" class=\"wiki\" title=\"spanner\">$page_parse</a>";
              $repl = "<a title='".$desc."' href='tiki-index.php?page=$plural_tmp' class='wiki'>$page_parse</a>";
            } else {
              $repl = $page_parse.'<a href="tiki-editpage.php?page='.urlencode($page_parse).'" title="'.tra("Create page:").' '.urlencode($page_parse).'" class="wiki wikinew">?</a>';
            }
          } else {
            $repl = $page_parse.'<a href="tiki-editpage.php?page=' . urlencode($page_parse). '"  title="'.tra("Create page:").' '.urlencode($page_parse).'" class="wiki wikinew">?</a>';
          }

          $data = preg_replace("/(?<=[ \n\t\r\,\;]|^)$page_parse(?=$|[ \n\t\r\,\;\.])/", "$1" . "$repl" . "$2", $data);
          //$data = str_replace($page_parse,$repl,$data);
        }
      }
    }

    // Reinsert ))Words((
    $data = str_replace($noParseWikiLinksK, $noParseWikiLinksT, $data);

    // reinsert hash-replaced links into page
    foreach ($noparsedlinks as $np) {
      $data = str_replace($np["key"], $np["data"], $data);
    }

    // Images
    preg_match_all("/(\{img [^\}]+})/", $data, $pages);

    foreach (array_unique($pages[1])as $page_parse) {
      $parts = $this->split_tag( $page_parse);

      $imgdata = array();      // pre-set preferences
      $imgdata["src"] = '';
      $imgdata["height"] = '';
      $imgdata["width"] = '';
      $imgdata["link"] = '';
      $imgdata["align"] = '';
      $imgdata["desc"] = '';
      $imgdata["imalign"] = '';
      $imgdata["alt"] = '';
      $imgdata["usemap"] = '';
      $imgdata["class"] = '';
      $imgdata["hspace"] = '';

      $imgdata = $this->split_assoc_array( $parts, $imgdata);

      if (stristr(str_replace(' ', '', $imgdata["src"]),'javascript:')) {
        $imgdata["src"]  = '';
      }
      if ($tikidomain) {
        $imgdata["src"] = preg_replace("~img/wiki_up/~","img/wiki_up/$tikidomain/",$imgdata["src"]);
      }
      $repl = '<img alt="' . $imgdata["alt"] . '" src="'.$imgdata["src"].'" border="0" ';

      if ($imgdata["width"])
        $repl .= ' width="' . $imgdata["width"] . '"';

      if ($imgdata["height"])
        $repl .= ' height="' . $imgdata["height"] . '"';

      if ($imgdata["imalign"]) {
        $repl .= ' align="' . $imgdata["imalign"] . '"';
      }
      if ($imgdata["usemap"]) {
        $repl .= ' usemap="#'.$imgdata["usemap"].'"';
      }
      if ($imgdata["class"]) {
        $repl .= ' class="'.$imgdata["class"].'"';
      }
      if ($imgdata["hspace"]) {
        $repl .= ' hspace="'.$imgdata["hspace"].'"';
      }

      $repl .= ' />';

      if ($imgdata["link"]) {
        $imgtarget= '';
        if ($this->get_preference('popupLinks', 'n') == 'y')
        {
          $imgtarget = ' target="_blank"';
        }
        $repl = '<a href="' . $imgdata["link"] .'"' . $imgtarget . '>' . $repl . '</a>';
      }

      if ($imgdata["desc"]) {
        $repl = '<table cellpadding="0" cellspacing="0"><tr><td>' . $repl . '</td></tr><tr><td class="mini">' . $imgdata["desc"] . '</td></tr></table>';
      }

      if ($imgdata["align"]) {
        $repl = '<div class="img" align="' . $imgdata["align"] . '">' . $repl . "</div>";
      } else {
        $repl = '<span class="img">' . $repl . "</span>";
      }

      $data = str_replace($page_parse, $repl, $data);
    }

    // *****
    // This section handles external links of the form [url] and such.
    // *****

    $links = $this->get_links($data);

    $notcachedlinks = $this->get_links_nocache($data);

    $cachedlinks = array_diff($links, $notcachedlinks);

    $this->cache_links($cachedlinks);

    // Note that there're links that are replaced
    foreach($links as $link)
    {
      $target = '';
      $class = 'class="wiki"';
      $ext_icon = '';

      if($this->get_preference('popupLinks', 'n') == 'y')
      {
        $target = 'target="_blank"';
      }

      if(isset($_SERVER['SERVER_NAME'])) {
        $_SERVER['SERVER_NAME'] = $_SERVER['HTTP_HOST'];
      }

      if(empty($_SERVER['SERVER_NAME']) || strstr($link, $_SERVER["SERVER_NAME"]) || !strstr($link, '//'))
      {
        $target = '';
      }
      else {
        global $feature_wiki_ext_icon;

        if($feature_wiki_ext_icon == 'y') {
          if(preg_match("|^http://|",$link) && !preg_match("/estudiolivre\.org/", $link)) {
            $class = 'class="wiki external"';
            $ext_icon = "";
          }
        }
      }

      // The (?<!\[) stuff below is to give users an easy way to
      // enter square brackets in their output; things like [[foo]
      // get rendered as [foo]. -rlpowell

      if($cachepages == 'y' && $this->is_cached($link))
      {
        //use of urlencode for using cached versions of dynamic sites
        $cosa = "<a class=\"wikicache\" target=\"_blank\" href=\"tiki-view_cache.php?url=".urlencode($link)."\">(cache)</a>";

        //$link2 = str_replace("/","\/",$link);
        //$link2 = str_replace("?","\?",$link2);
        //$link2 = str_replace("&","\&",$link2);
        $link2 = str_replace("/", "\/", preg_quote($link));
        $pattern = "/(?<!\[)\[$link2\|([^\]\|]+)\|([^\]]+)\]/";
        $data = preg_replace($pattern, "<a $class $target href=\"$link\">$1</a>$ext_icon", $data);
        $pattern = "/(?<!\[)\[$link2\|([^\]\|]+)\]/";
        $data = preg_replace($pattern, "<a $class $target href=\"$link\">$1</a>$ext_icon $cosa", $data);
        $pattern = "/(?<!\[)\[$link2\]/";
        $data = preg_replace($pattern, "<a $class $target href=\"$link\">$link</a>$ext_icon $cosa", $data);
      }
      else {
        //$link2 = str_replace("/","\/",$link);
        //$link2 = str_replace("?","\?",$link2);
        //$link2 = str_replace("&","\&",$link2);
        $link2 = str_replace("/", "\/", preg_quote($link));

        $pattern = "/(?<!\[)\[$link2\|([^\]\|]+)([^\]])*\]/";
        $data = preg_replace($pattern, "<a $class $target href=\"$link\">$1</a>$ext_icon", $data);
        $pattern = "/(?<!\[)\[$link2\]/";
        $data = preg_replace($pattern, "<a $class $target href=\"$link\">$link</a>$ext_icon", $data);
      }

    }

    // Handle double square brackets.  -rlpowell
    $data = str_replace("[[", "[", $data);

    /*
     * Wiki Tables syntax
     */
    // tables in old style
    if($feature_wiki_tables != 'new') {
      if(preg_match_all("/\|\|(.*)\|\|/", $data, $tables)) {
        $maxcols = 1;

        $cols = array();

        $temp_max = count($tables[0]);

        for($i = 0; $i < $temp_max; $i++) {
          $rows = explode('||', $tables[0][$i]);
          $temp_max2 = count($rows);

          for($j = 0; $j < $temp_max2; $j++) {
            $cols[$i][$j] = explode('|', $rows[$j]);

            if(count($cols[$i][$j]) > $maxcols)
              $maxcols = count($cols[$i][$j]);
          }
        } // for ($i ...

        $temp_max3 = count($tables[0]);

        for($i = 0; $i < $temp_max3; $i++) {
          $repl = '<table class="wikitable">';

          $temp_max4 = count($cols[$i]);

          for($j = 0; $j < $temp_max4; $j++) {
            $ncols = count($cols[$i][$j]);

            if($ncols == 1 && !$cols[$i][$j][0])
              continue;

            $repl .= '<tr>';

            for($k = 0; $k < $ncols; $k++) {
              $repl .= '<td class="wikicell" ';

              if($k == $ncols - 1 && $ncols < $maxcols)
                $repl .= ' colspan="' .($maxcols - $k).'"';

              $repl .= '>' . $cols[$i][$j][$k] . '</td>';
            } // // for ($k ...

            $repl .= '</tr>';
          } // for ($j ...

          $repl .= '</table>';
          $data = str_replace($tables[0][$i], $repl, $data);
        } // for ($i ...
      } // if (preg_match_all("/\|\|(.*)\|\|/", $data, $tables))
    }

    else


    {
      // New syntax for tables
      // REWRITE THIS CODE
      if(!$simple_wiki) {
        if(preg_match_all("/\|\|(.*?)\|\|/s", $data, $tables)) {
          $maxcols = 1;

          $cols = array();

          $temp_max5 = count($tables[0]);

          for($i = 0; $i < $temp_max5; $i++) {
            $rows = split("\n|\<br\/\>", $tables[0][$i]);

            $col[$i] = array();

            $temp_max6 = count($rows);

            for($j = 0; $j < $temp_max6; $j++) {
              $rows[$j] = str_replace('||', '', $rows[$j]);

              $cols[$i][$j] = explode('|', $rows[$j]);

              if(count($cols[$i][$j]) > $maxcols)
                $maxcols = count($cols[$i][$j]);
            }
          }

          $temp_max7 = count($tables[0]);

          for($i = 0; $i < $temp_max7; $i++) {
            $repl = '<table class="wikitable">';

            $temp_max8 = count($cols[$i]);

            for($j = 0; $j < $temp_max8; $j++) {
              $ncols = count($cols[$i][$j]);

              if($ncols == 1 && !$cols[$i][$j][0])
                continue;

              $repl .= '<tr>';

              for($k = 0; $k < $ncols; $k++) {
                $repl .= '<td class="wikicell" ';

                if($k == $ncols - 1 && $ncols < $maxcols)
                  $repl .= ' colspan="' .($maxcols - $k).'"';

                $repl .= '>' . $cols[$i][$j][$k] . '</td>';
              }

              $repl .= '</tr>';
            }

            $repl .= '</table>';
            $data = str_replace($tables[0][$i], $repl, $data);
          }
        }
      }
    }

    if(!$simple_wiki) {
      // 26-Jun-2003, by zaufi
      //
      // {maketoc} --> create TOC from '!', '!!', '!!!' in current document
      //
      preg_match_all("/\{maketoc.*?\}/", $data, $tocs);
      $anch = array();
      $pageNum = 1;

      // 08-Jul-2003, by zaufi
      // HotWords will be replace only in ordinal text
      // It looks __really__ goofy in Headers or Titles

      if($feature_hotwords == 'y') {
        // Get list of HotWords
        $words = $this->get_hotwords();
      }

      // Now tokenize the expression and process the tokens
      // Use tab and newline as tokenizing characters as well  ////
      $lines = explode("\n", $data);
      $data = '';
      $listbeg = array();
      $divdepth = array();
      $inTable = 0;

      // loop: process all lines
      $in_paragraph = 0;
      foreach($lines as $line) {
        $line = rtrim($line); // Trim off trailing white space

        // Check for titlebars...
        // NOTE: that title bar should start at the beginning of the line and
        //     be alone on that line to be autoaligned... otherwise, it is an old
        //     styled title bar...
        if(substr(ltrim($line), 0, 2) == '-=' && substr($line, -2, 2) == '=-') {
          // Close open paragraph and lists, but not div's
          $this->close_blocks($data, $in_paragraph, $listbeg, $divdepth, 1, 1, 0);
          //
          $align_len = strlen($line) - strlen(ltrim($line));

          // My textarea size is about 120 space chars.
          //define('TEXTAREA_SZ', 120);

          // NOTE: That strict math formula (split into 3 areas) gives
          //     bad visual effects...
          // $align = ($align_len < (TEXTAREA_SZ / 3)) ? "left"
          //    : (($align_len > (2 * TEXTAREA_SZ / 3)) ? "right" : "center");
          //
          // Going to introduce some heuristic here :)
          // Visualy (remember that space char is thin) center starts at 25 pos
          // and 'right' from 60 (HALF of full width!) -- thats all :)
          //
          // NOTE: Guess align only if more than 10 spaces before -=title=-
          if($align_len > 10) {
            $align = ($align_len < 25) ? "left" : (($align_len > 60) ? "right" : "center");

            $align = ' style="text-align: ' . $align . ';"';
          }

          else
            $align = '';

          //
          $line = trim($line);
          $line = '<div class="titlebar"' . $align . '>' . substr($line, 2, strlen($line) - 4). '</div>';
          $data .= $line . "\n";
          // TODO: Case is handled ...  no need to check other conditions
          //     (it is apriori known that they are all false, moreover sometimes
          //     check procedure need > O(0) of compexity)
          //     -- continue to next line...
          //     MUST replace all remaining parse blocks to the same logic...
          continue;
        }

        // Replace old styled titlebars
        if(strlen($line) != strlen($line = preg_replace("/-=(.+?)=-/", "<div class='titlebar'>$1</div>", $line))) {
          // Close open paragraph, but not lists (why not?) or div's
          $this->close_blocks($data, $in_paragraph, $listbeg, $divdepth, 1, 0, 0);
          $data .= $line . "\n";

          continue;
        }

        // check if we are inside a table, if so, ignore monospaced and do
        // not insert <br />
        $inTable += substr_count(strtolower($line), "<table");
        $inTable -= substr_count(strtolower($line), "</table");

        // If the first character is ' ' and we are not in pre then we are in pre
        global $feature_wiki_monosp;

        if(substr($line, 0, 1) == ' ' && $feature_wiki_monosp == 'y' && $inTable == 0) {
          // Close open paragraph and lists, but not div's
          $this->close_blocks($data, $in_paragraph, $listbeg, $divdepth, 1, 1, 0);

          // If the first character is space then make font monospaced.
          // For fixed formatting, use ~pp~...~/pp~
          $line = '<tt>' . $line . '</tt>';
        }

        if($feature_hotwords == 'y') {
          // Replace Hotwords before begin
          $line = $this->replace_hotwords($line, $words);
        }

        // Make plain URLs clickable hyperlinks
        if($feature_autolinks == 'y') {
          $line = $this->autolinks($line);
        }

        // Replace monospaced text
        $line = preg_replace("/-\+(.*?)\+-/", "<code>$1</code>", $line);
        // Replace bold text
        $line = preg_replace("/__(.*?)__/", "<b>$1</b>", $line);
        // Replace italic text
        $line = preg_replace("/\'\'(.*?)\'\'/", "<i>$1</i>", $line);
        // Replace definition lists
        $line = preg_replace("/^;([^:]*):([^\/\/].*)/", "<dl><dt>$1</dt><dd>$2</dd></dl>", $line);
        $line = preg_replace("/^;(<a [^<]*<\/a>):([^\/\/].*)/", "<dl><dt>$1</dt><dd>$2</dd></dl>", $line);

        /* this code following if (0) is never executed, right?
              if (0) {
            $line = preg_replace("/\[([^\|]+)\|([^\]]+)\]/", "<a class='wiki' $target href='$1'>$2</a>", $line);

            // Segundo intento reemplazar los [link] comunes
            $line = preg_replace("/\[([^\]]+)\]/", "<a class='wiki' $target href='$1'>$1</a>", $line);
            $line = preg_replace("/\-\=([^=]+)\=\-/", "<div class='wikihead'>$1</div>", $line);
              }
        */

        // This line is parseable then we have to see what we have
        if(substr($line, 0, 3) == '---') {
          // This is not a list item --- close open paragraph and lists, but not div's
          $this->close_blocks($data, $in_paragraph, $listbeg, $divdepth, 1, 1, 0);
          $line = '<hr />';
        }

        else {
          $litype = substr($line, 0, 1);

          if($litype == '*' || $litype == '#') {
            // Close open paragraph, but not lists or div's
            $this->close_blocks($data, $in_paragraph, $listbeg, $divdepth, 1, 0, 0);
            $listlevel = $this->how_many_at_start($line, $litype);
            $liclose = '</li>';
            $addremove = 0;

            if($listlevel < count($listbeg)) {
              while($listlevel != count($listbeg)) $data .= array_shift($listbeg);

              if(substr(current($listbeg), 0, 5) != '</li>') $liclose = '';
            }

            elseif($listlevel > count($listbeg)) {
              $listyle = '';

              while($listlevel != count($listbeg)) {
                array_unshift($listbeg, ($litype == '*' ? '</ul>' : '</ol>'));

                if($listlevel == count($listbeg)) {
                  $listate = substr($line, $listlevel, 1);

                  if(($listate == '+' || $listate == '-') && !($litype == '*' && !strstr(current($listbeg), '</ul>') || $litype == '#' && !strstr(current($listbeg), '</ol>'))) {
                    $thisid = 'id' . microtime() * 1000000;

                    if(preg_match("|tiki-print.php|",$_SERVER['REQUEST_URI'])) {
                      // $data .= '<br /><img class="flipper" id="flipper' . $thisid . '" class="pointer" onclick="flip(\'' . $thisid . '\');toggleImage(this,\'iArrowGreyRight.png\')" src="styles/estudiolivre/iArrowGreyDown.png">';
                      $listyle = ' id="' . $thisid . '"';
                    }

                    else {
                      $data .= '<br /><img class="flipper" id="flipper' . $thisid . '" class="pointer" onclick="flip(\'' . $thisid . '\');toggleImage(this,\'iArrowGrey' .($listate == '-' ? 'Down' : 'Right') . '.png\')" src="styles/estudiolivre/iArrowGrey' .($listate == '-' ? 'Right' : 'Down') . '.png">';
                      $listyle = ' id="' . $thisid . '" style="display:' .($listate == '+' ? 'block' : 'none') . ';"';
                    }

                    $addremove = 1;
                  }
                }

                $data.=($litype=='*'?"<ul$listyle>":"<ol$listyle>");
              }

              $liclose='';
            }

            if($litype == '*' && !strstr(current($listbeg), '</ul>') || $litype == '#' && !strstr(current($listbeg), '</ol>')) {
              $data .= array_shift($listbeg);
              $listyle = '';
              $listate = substr($line, $listlevel, 1);

              if(($listate == '+' || $listate == '-')) {
                $thisid = 'id' . microtime() * 1000000;

                if(preg_match("|tiki-print.php|",$_SERVER['REQUEST_URI'])) {
                  $listate = '-';
                }

                $data .= '<br /><img class="flipper" id="flipper' . $thisid . '" class="pointer" onclick="flip(\'' . $thisid . '\');toggleImage(this,\'iArrowGrey' .($listate == '-' ? 'Down' : 'Right') . '.png\')" src="styles/estudiolivre/iArrowGrey' .($listate == '-' ? 'Right' : 'Down') . '.png">';
                $listyle = ' id="' . $thisid . '" style="display:' .($listate == '+' ? 'block' : 'none') . ';"';
                $addremove = 1;
              }

              $data .= ($litype == '*' ? "<ul$listyle>" : "<ol$listyle>");
              $liclose = '';
              array_unshift($listbeg, ($litype == '*' ? '</li></ul>' : '</li></ol>'));
            }

            $line = $liclose . '<li>' . substr($line, $listlevel + $addremove);

            if(substr(current($listbeg), 0, 5) != '</li>') array_unshift($listbeg, '</li>' . array_shift($listbeg));
          }

          elseif($litype == '+') {
            // Close open paragraph, but not list or div's
            $this->close_blocks($data, $in_paragraph, $listbeg, $divdepth, 1, 0, 0);
            $listlevel = $this->how_many_at_start($line, $litype);

            // Close lists down to requested level
            while($listlevel < count($listbeg)) $data .= array_shift($listbeg);

            // Must append paragraph for list item of given depth...
            $listlevel = $this->how_many_at_start($line, $litype);

            if(count($listbeg)) {
              if(substr(current($listbeg), 0, 5) != '</li>') {
                array_unshift($listbeg, '</li>' . array_shift($listbeg));
                $liclose = '<li>';
              }

              else $liclose = '<br />';
            }

            else $liclose = '';

            $line = $liclose . substr($line, count($listbeg));
          }

          else {
            // This is not a list item - close open lists,
            // but not paragraph or div's. If we are
            // closing a list, there really shouldn't be a
            // paragraph open anyway.
            $this->close_blocks($data, $in_paragraph, $listbeg, $divdepth, 0, 1, 0);
            // Get count of (possible) header signs at start
            $hdrlevel = $this->how_many_at_start($line, '!');

            // If 1st char on line is '!' and its count less than 6 (max in HTML)
            if($litype == '!' && $hdrlevel > 0 && $hdrlevel <= 6) {
              // Close open paragraph (lists already closed above)
              $this->close_blocks($data, $in_paragraph, $listbeg, $divdepth, 1, 0, 0);

              // Close lower level divs if opened
              for(; current($divdepth) >= $hdrlevel; array_shift($divdepth)) $data .= '</div>';

              // Remove possible hotwords replaced :)
              //   Umm, *why*?  Taking this out lets page
              //   links in headers work, which can be nice.
              //   -rlpowell
              // $line = strip_tags($line);

              // OK. Parse headers here...
              $anchor = '';
              $aclose = '';
              $aopen = '';
              $addremove = 0;

              // May be special signs present after '!'s?
              $divstate = substr($line, $hdrlevel, 1);

              if($divstate == '+' || $divstate == '-') {
                // OK. Must insert flipper after HEADER, and then open new div...
                $thisid = 'id' . microtime() * 1000000;

                if(preg_match("|tiki-print.php|",$_SERVER['REQUEST_URI'])) {
                  $divstate = '+';
                }

                $aopen = '<span class="hiddenPointer" onclick="flip(\'' . $thisid . '\');toggleImage(document.getElementById(\'flipper' . $thisid . '\'),\'iArrowGrey' .($divstate == '-' ? 'Down' : 'Right') . '.png\')"> <img class="flipper pointer" id="flipper' . $thisid . '" src="styles/estudiolivre/iArrowGrey' .($divstate == '-' ? 'Right' : 'Down') . '.png">';
                $aclose .= '<div id="' . $thisid . '" style="display:' .($divstate == '+' ? 'block' : 'none') . ';"> </span>';
                array_unshift($divdepth, $hdrlevel);
                $addremove = 1;
              }

              // create stable anchors for all headers
              // use header but replace non-word character sequences
              // with one underscore (for XHTML 1.0 compliance)
              $thisid=preg_replace("/[^a-zA-Z0-9]+/", "_", substr($line,$hdrlevel+$addremove));
              $anchor="<a name='$thisid'></a>";

              // Is any {maketoc} present on page?
              if(count($tocs[0]) > 0) {
                // OK. Must collect TOC entry
                $pageNumLink = ($pageNum >= 2)? "tiki-index.php?page=$page&pagenum=$pageNum": "";
                array_push($anch, str_repeat("*", $hdrlevel). " <a href='$pageNumLink#$thisid' class='link'>" . substr($line, $hdrlevel + $addremove). '</a>');
              }

              $line = $anchor . "<h$hdrlevel>" . $aopen . substr($line, $hdrlevel + $addremove). "</h$hdrlevel>" . $aclose;
            }

            elseif(!strcmp($line, "...page...")) {
              // Close open paragraph, lists, and div's
              $this->close_blocks($data, $in_paragraph, $listbeg, $divdepth, 1, 1, 1);
              // Leave line unchanged... tiki-index.php will split wiki here
              $line = "...page...";
              $pageNum += 1;
            }

            else {
              /** Usual paragraph.
               *
               * If the
               * $feature_wiki_paragraph_formatting
               * is on, then consecutive lines of
               * text will be gathered into a block
               * that is surrounded by HTML
               * paragraph tags. One or more blank
               * lines, or another special Wiki line
               * (e.g., heading, titlebar, etc.)
               * signifies the end of the
               * paragraph. If the paragraph
               * formatting feature is off, the
               * original Tikiwiki behavior is used,
               * in which each line in the source is
               * terminated by an explicit line
               * break (br tag).
               *
               * @since Version 1.9
               */
              if($inTable == 0) {
                if($feature_wiki_paragraph_formatting == 'y') {
                  if($in_paragraph && (0 == strcmp("", trim($line)))) {
                    // Blank line; end the paragraph
                    $this->close_blocks($data, $in_paragraph, $listbeg, $divdepth, 1, 0, 0);
                  }

                  elseif(!$in_paragraph && (0 != strcmp("", trim($line)))) {
                    // First non-blank line; start a paragraph
                    $data .= "<p>";
                    $in_paragraph = 1;
                  }

                  else {
                    // A normal in-paragraph line or a consecutive blank line.
                    // Leave it as is.
                  }
                }
                else {
                  $line .= '<br />';
                }
              }
            }
          }
        }

        $data .= $line . "\n";
      }

      // Close open paragraph, lists, and div's
      $this->close_blocks($data, $in_paragraph, $listbeg, $divdepth, 1, 1, 1);

      // 26-Jun-2003, by zaufi
      // Replace {maketoc} from collected list of headers
      $html = '';

      // replacement for {maketoc}
      foreach($anch as $tocentry) {
        $html .= $tocentry . "\n";
      }

      if(count($anch)) {
        $html = $this->parse_data($html);
        $html= preg_replace("/^<ul>/", '<ul class="toc">', $html);
      }

      $data = str_replace("{maketoc}", $html, $data);

      $html = '';

      // replacement for {maketoc:box}
      $html .= "<table id='toc' class='toc' summary='".tra("index")."'>\n";
      $html .= "<tr>";
      $html .= "<td>";
      $html .= "<div id='toctitle'>";
      $html .= "<h3>".tra("index")."</h3>";
      $html .= "</div>";
      $html .= "<ul>\n";

      foreach($anch as $tocentry) {
        $tocdepth=0;

        while(substr($tocentry,0,1)=="*") {
          $tocdepth++;
          $tocentry = substr($tocentry,1);
        }

        $html .= "<li class='toclevel-".$tocdepth."'>".$tocentry."</li>\n";
      }

      if(count($anch)) {
        $html = $this->parse_data($html);
        $html= preg_replace("'link'", "'toclink'", $html);
      }

      $html .= "</ul>";
      $html .= "</td>";
      $html .= "</tr>";
      $html .= "</table>\n";
      $html .= "<p><script type='text/javascript'>\n";
      $html .= "//<![CDATA[\n";
      $html .= " if (window.showTocToggle) { var tocShowText = '".tra("show")."'; var tocHideText = '".tra("hide")."'; showTocToggle(); }\n";
      $html .= "//]]>;\n";
      $html .= "</script></p>\n";

      $data = str_replace("{maketoc:box}", $html, $data);

// closing if ($simple_wiki){
    }

    // Replace rss modules
    if(preg_match_all("/\{rss +id=([0-9]+) *(max=([0-9]+))? *\}/", $data, $rsss)) {
      global $rsslib;
      include_once('lib/rss/rsslib.php');

      $temp_max = count($rsss[0]);

      for($i = 0; $i < $temp_max; $i++) {
        $id = $rsss[1][$i];

        $max = $rsss[3][$i];

        if(empty($max))
          $max = 99;

        $rssdata = $rsslib->get_rss_module_content($id);
        $items = $rsslib->parse_rss_data($rssdata, $id);

        if(!$items) {
          $data = str_replace($rsss[0][$i], 'Undefined rss id ' . $id, $data);
          continue;
        }

        $repl="";

        if($items[0]["isTitle"]=="y") {
          $repl .= '<div class="wiki"><a target="_blank" href="'.$items[0]["link"].'">'.$items[0]["title"].'</a></div>';
          $items = array_slice($items, 1);
        }

        $repl .= '<ul class="rsslist">';
        $temp_max2 = count($items);

        for($j = 0; $j < $temp_max2 && $j < $max; $j++) {
          $repl .= '<li class="rssitem"><a target="_blank" href="' . $items[$j]["link"] . '" class="rsslink">' . $items[$j]["title"] . '</a>';

          if(isset($items[$j]["pubDate"]) && $items[$j]["pubDate"] <> '') {
            $repl .= ' <span class="rssdate">('.$items[$j]["pubDate"].')</span>';
          }

          $repl .= '</li>';
        }

        $repl .= '</ul>';
        $data = str_replace($rsss[0][$i], $repl, $data);
      }
    }

    // linebreaks using %%%
    $data = str_replace("%%%", "<br />", $data);

    // Close BiDi DIVs if any
    for($i = 0; $i < $bidiCount; $i++) {
      $data .= "</div>";
    }

    // Put removed strings back.
    $this->replace_preparse($data, $preparsed, $noparsed);

    // Process pos_handlers here
    foreach($this->pos_handlers as $handler) {
      $data = $handler($data);
    }

    return $data;
  }


  function getWikiTemplate(&$data) {
    global $templateStack;
    $template = array();
    $matches = array();

    preg_match_all("/(?s)\{\{(.*?)(?:\|\|(.*?))?\}\}/", $data, $template);

    if($template) {

      for($j=0; $j<sizeof($template[0]); $j++) {

        if(isset($templateStack[$template[1][$j]]) && $templateStack[$template[1][$j]]) {
          global $smarty;
          $smarty->assign('msg', tra("Você tentou inserir um template dentro dele mesmo, isso causaria um loop infinito. Por favor conserte isso na edição da página."));
          $smarty->display("error.tpl");
          die;
        }

        $templateStack[$template[1][$j]] = true;
        $info = $this->get_page_info($template[1][$j]);
        $pdata = $info["data"];
        $this->getWikiTemplate($pdata);
        $templateStack[$template[1][$j]] = false;

        if(isset($template[2][$j])) {
          preg_match_all("/(?s)(.+?)\=(.+?)(?:\|\||$)/", $template[2][$j], $matches);

          for($i=0; $i<sizeof($matches[0]); $i++) {
            $pdata = preg_replace("/" . trim($matches[1][$i]) . "/", trim($matches[2][$i]), $pdata);
          }
        }

        $data = preg_replace("/(?s)\{\{(.*?)\}\}/", trim($pdata), $data, 1);
      }
    }
  }

  function parse_smileys($data) {
    global $feature_smileys;

    if($feature_smileys == 'y') {
      $data = preg_replace("/\(:([^:]+):\)/", "<img alt=\"$1\" src=\"img/smiles/icon_$1.gif\" />", $data);
    }

    return $data;
  }

  function get_pages($data) {
    global $page_regex;

    global $feature_wikiwords;

    if($feature_wikiwords == 'y') {
      preg_match_all("/\(\( *($page_regex) *\)\)/", $data, $pages2);
      preg_match_all("/\(\( *($page_regex) *\|(.+?)\)\)/", $data, $pages3);
      preg_match_all("/([ \n\t\r\,\;]|^)?([A-Z][a-z0-9_\-]+[A-Z][a-z0-9_\-]+[A-Za-z0-9\-_]*)($|[ \n\t\r\,\;\.])/", $data, $pages);
      $pages = array_unique(array_merge($pages[2], $pages2[1], $pages3[1]));
    }

    else {
      preg_match_all("/\(\( *($page_regex) *\)\)/", $data, $pages);
      preg_match_all("/\(\( *($page_regex) *\|(.+?)\)\)/", $data, $pages2);
      $pages = array_unique(array_merge($pages[1], $pages2[1]));
    }

    return $pages;
  }

  function clear_links($page) {
    $query = "delete from `tiki_links` where `fromPage`=?";
    $result = $this->query($query, array($page));
  }

  function replace_link($pageFrom, $pageTo) {
    $query = "delete from `tiki_links` where `fromPage`=? and `toPage`=?";
    $result = $this->query($query, array($pageFrom,$pageTo));
    $query = "insert into `tiki_links`(`fromPage`,`toPage`) values(?, ?)";
    $result = $this->query($query, array($pageFrom,$pageTo));
  }

  function invalidate_cache($page) {
    $query = "update `tiki_pages` set `cache_timestamp`=? where `pageName`=?";
    $this->query($query, array(0,$page));
  }

  function update_page($pageName, $edit_data, $edit_comment, $edit_user, $edit_ip, $description = '', $minor = false, $lang='', $is_html=false) {
    global $smarty;

    global $dbTiki;
    global $feature_user_watches;
    global $wiki_watch_author;
    global $wiki_watch_comments;
    global $sender_email;
    global $histlib, $feature_wiki_history_full;
    include_once("lib/wiki/histlib.php");
    include_once("lib/commentslib.php");

    $commentslib = new Comments($dbTiki);

    $this->invalidate_cache($pageName);
    // Collect pages before modifying edit_data (see update of links below)
    $pages = $this->get_pages($edit_data);

    if(!$this->page_exists($pageName))
      return false;

    $t = date("U");
    // Get this page information
    $info = $this->get_page_info($pageName);
    // Store the old version of this page in the history table
    // Use largest version +1 in history table rather than tiki_page because versions used to be bugged
    //    $old_version = $info["version"];
    $old_version = $histlib->get_page_latest_version($pageName) + 1;
    $lastModif = $info["lastModif"];
    $user = $info["user"];
    $ip = $info["ip"];
    $comment = $info["comment"];
    $data = $info["data"];
    // WARNING: POTENTIAL BUG
    // The line below is not consistent with the rest of Tiki
    // (I commented it out so it can be further examined by CVS change control)
    //$pageName=addslashes($pageName);
    // But this should work (comment added by redflo):
    $version = $old_version + 1;

    $html=$is_html?1:0;

    if($lang) { // not sure it is necessary
      $query = "update `tiki_pages` set `description`=?, `data`=?, `comment`=?, `lastModif`=?, `version`=?, `user`=?, `ip`=?, `page_size`=?, `lang`=?, `is_html`=?  where `pageName`=?";
      $result = $this->query($query,array($description,$edit_data,$edit_comment,(int) $t,$version,$edit_user,$edit_ip,(int)strlen($edit_data),$lang,$html,$pageName));
    }

    else {
      $query = "update `tiki_pages` set `description`=?, `data`=?, `comment`=?, `lastModif`=?, `version`=?, `user`=?, `ip`=?, `page_size`=?, `is_html`=? where `pageName`=?";
      $result = $this->query($query,array($description,$edit_data,$edit_comment,(int) $t,$version,$edit_user,$edit_ip,(int)strlen($edit_data),$html,$pageName));
    }

    // Parse edit_data updating the list of links from this page
    $this->clear_links($pageName);

    // Pages collected above
    foreach($pages as $page) {
      $this->replace_link($pageName, $page);
    }

    // Update the log
    if(strtolower($pageName) != 'sandbox' && !$minor) {
      $action = "Updated"; //get_strings tra("Updated")

      $query = "insert into `tiki_actionlog`(`action`,`pageName`,`lastModif`,`user`,`ip`,`comment`) values(?,?,?,?,?,?)";
      $result = $this->query($query,array($action,$pageName,(int) $t,$edit_user,$edit_ip,$edit_comment));
      $maxversions = $this->get_preference("maxVersions", 0);

      if($maxversions && ($nb = $histlib->get_nb_history($pageName)) > $maxversions) {
        // Select only versions older than keep_versions days
        $keep = $this->get_preference('keep_versions', 0);

        $now = date("U");
        $oktodel = $now - ($keep * 24 * 3600);
        $query = "select `pageName` ,`version` from `tiki_history` where `pageName`=? and `lastModif`<=? order by `lastModif` asc";
        $result = $this->query($query,array($pageName,$oktodel),$nb - $maxversions);
        $toelim = $result->numRows();

        while($res = $result->fetchRow()) {
          $page = $res["pageName"];

          $version = $res["version"];
          $query = "delete from `tiki_history` where `pageName`=? and `version`=?";
          $this->query($query,array($pageName,$version));
        }
      }
    }

    // This if no longer checks for minor-ness of the change; sendWikiEmailNotification does that.
    if($feature_wiki_history_full == 'y' || $data != $edit_data || $description != $info["description"] || $comment != $edit_comment) {
      if(strtolower($pageName) != 'sandbox') {
        $query = "insert into `tiki_history`(`pageName`, `version`, `lastModif`, `user`, `ip`, `comment`, `data`, `description`)
        values(?,?,?,?,?,?,?,?)";
# echo "<pre>";print_r(get_defined_vars());echo "</pre>";die();
        $result = $this->query($query,array($pageName,(int) $old_version,(int) $lastModif,$user,$ip,$comment,$data,$description));
        /* the following doesn't work because tiki dies if the above query fails
        if (!$result) {
          $query2 = "delete from `tiki_history` where `pageName`=? and `version`=?";
          $result = $this->query($query2,array($pageName,(int) $version));
          $result = $this->query($query,array($pageName,(int) $version,(int) $lastModif,$user,$ip,$comment,$data,$description));
        }
        */
      }

      global $feature_user_watches;

      if($feature_user_watches == 'y') {
        //  Deal with mail notifications.
        include_once('lib/notifications/notificationemaillib.php');
        global $histlib;
        include_once("lib/wiki/histlib.php");
        $old = $histlib->get_version($pageName, $old_version);
        $foo = parse_url($_SERVER["REQUEST_URI"]);
        $machine = $this->httpPrefix(). dirname($foo["path"]);
        require_once('lib/diff/difflib.php');
        $diff = diff2($old["data"] , $edit_data, "unidiff");
        sendWikiEmailNotification('wiki_page_changed', $pageName, $edit_user, $edit_comment, $old_version, $edit_data, $machine, $diff, $minor);
      }

      global $feature_score;

      if($feature_score == 'y') {
        $this->score_event($user, 'wiki_edit');
      }

    }

  }

  function update_page_version($pageName, $version, $edit_data, $edit_comment, $edit_user, $edit_ip, $lastModif, $description = '', $lang='') {
    global $smarty;

    if(strtolower($pageName) == 'sandbox')
      return;

    // Collect pages before modifying edit_data
    $pages = $this->get_pages($edit_data);

    if(!$this->page_exists($pageName))
      return false;

    $t = date("U");
    $query = "delete from `tiki_history` where `pageName`=? and `version`=?";
    $result = $this->query($query, array($pageName,(int) $version));
    $query = "insert into `tiki_history`(pageName, version, lastModif, user, ip, comment, data,description) values(?,?,?, ?,?,?, ?,?)";
    $result = $this->query($query, array($pageName,(int) $version, (int) $lastModif, $edit_user, $edit_ip, $edit_comment, $edit_data, $description)
                          );

    //print("version: $version<br />");
    // Get this page information
    $info = $this->get_page_info($pageName);

    if($version >= $info["version"]) {
      if($lang) {  // not sure it is necessary
        $query = "update `tiki_pages` set `data`=?, `comment`=?, `lastModif`=?, `version`=?, `user`=?, `ip`=?, `description`=?,`page_size`=?,`lang`=?  where `pageName`=?";
        $result = $this->query($query, array($edit_data, $edit_comment, (int) $t, (int) $version, $edit_user, $edit_ip, $description, (int) strlen($edit_data), $lang, $pageName));
      }

      else {
        $query = "update `tiki_pages` set `data`=?, `comment`=?, `lastModif`=?, `version`=?, `user`=?, `ip`=?, `description`=?,`page_size`=? where `pageName`=?";
        $result = $this->query($query, array($edit_data, $edit_comment, (int) $t, (int) $version, $edit_user, $edit_ip, $description, (int) strlen($edit_data), $pageName));
      }

      // Parse edit_data updating the list of links from this page
      $this->clear_links($pageName);

      // Pages are collected at the top of the function before adding slashes
      foreach($pages as $page) {
        $this->replace_link($pageName, $page);
      }
    }
  }

# TODO move all of these date/time functions to a static class: TikiDate
  function get_timezone_list($use_default = false) {
    static $timezone_options;

    if(!$timezone_options) {
      $timezone_options = array();

      if($use_default)
        $timezone_options['default'] = '-- Use Default Time Zone --';

      foreach($GLOBALS['_DATE_TIMEZONE_DATA'] as $tz_key => $tz) {
        $offset = $tz['offset'];

        $absoffset = abs($offset /= 60000);
        $plusminus = $offset < 0 ? '-' : '+';
        $gmtoff = sprintf("GMT%1s%02d:%02d", $plusminus, $absoffset / 60, $absoffset - (intval($absoffset / 60) * 60));
        $tzlongshort = $tz['longname'] . ' (' . $tz['shortname'] . ')';
        $timezone_options[$tz_key] = sprintf('%-28.28s: %-36.36s %s', $tz_key, $tzlongshort, $gmtoff);
      }
    }

    return $timezone_options;
  }

  function get_server_timezone() {
    static $server_timezone;

    if(!$server_timezone) {
      $server_time = new Date();

      $server_timezone = $server_time->tz->getID();
    }

    return $server_timezone;
  }

# TODO rename get_site_timezone()
  function get_display_timezone($user = false) {
    static $display_timezone = false;

    if(!$display_timezone) {
      $server_time = $this->get_server_timezone();

      if($user) {
        $display_timezone = $this->get_user_preference($user, 'display_timezone');

        if(!$display_timezone || $display_timezone == 'default') {
          $display_timezone = $this->get_preference('display_timezone', $server_time);
        }
      }

      else {
        $display_timezone = $this->get_preference('display_timezone', $server_time);
      }
    }

    return $display_timezone;
  }

  /**
   * Retrieves the user's preferred offset for displaying dates.
   *
   * $user: the logged-in user.
   * returns: the preferred offset to UTC.
   */
  function get_display_offset($_user = false) {

    // Cache preference from DB
    $display_tz = "UTC";

    // Default to UTCget_display_offset
    $display_offset = 0;

    // Load pref from DB is cache is empty
    if($_user)
      $display_tz = $this->get_display_timezone($_user);

    else if(isset($_COOKIE["tz_offset"]))  // if an anonymous has a cookie, we pick up his tz
      $display_tz = "";

    // Recompute offset each request in case DST kicked in
    if($display_tz != "UTC" && isset($_COOKIE["tz_offset"]))
      $display_offset = intval($_COOKIE["tz_offset"]);

    return $display_offset;
  }

  /**
   * Retrieves a TikiDate object for converting to/from display/UTC timezones
   *
   * $user: the logged-in user
   * returns: reference to a TikiDate instance with the appropriate offsets
   */
  function &get_date_converter($_user = false) {
    static $date_converter;

    if(!$date_converter) {
      $display_offset = $this->get_display_offset($_user);

      $date_converter = &new TikiDate($display_offset);
    }

    return $date_converter;
  }

  function get_long_date_format() {
    static $long_date_format = false;

    if(!$long_date_format)
      $long_date_format = $this->get_preference('long_date_format', '%A %d of %B, %Y');

    return $long_date_format;
  }

  function get_short_date_format() {
    static $short_date_format = false;

    if(!$short_date_format)
      $short_date_format = $this->get_preference('short_date_format', '%a %d of %b, %Y');

    return $short_date_format;
  }

  function get_long_time_format() {
    static $long_time_format = false;

    if(!$long_time_format)
      $long_time_format = $this->get_preference('long_time_format', '%H:%M:%S %Z');

    return $long_time_format;
  }

  function get_short_time_format() {
    static $short_time_format = false;

    if(!$short_time_format)
      $short_time_format = $this->get_preference('short_time_format', '%H:%M %Z');

    return $short_time_format;
  }

  function get_long_datetime_format() {
    static $long_datetime_format = false;

    if(!$long_datetime_format) {
      $t = trim($this->get_long_time_format());

      if(!empty($t)) {
        $t = ' ['.$t.']';
      }

      $long_datetime_format = $this->get_long_date_format().$t;
    }

    return $long_datetime_format;
  }

  function get_short_datetime_format() {
    static $short_datetime_format = false;

    if(!$short_datetime_format) {
      $t = trim($this->get_short_time_format());

      if(!empty($t)) {
        $t = ' ['.$t.']';
      }

      $short_datetime_format = $this->get_short_date_format().$t;
    }

    return $short_datetime_format;
  }

  function server_time_to_site_time($timestamp, $user = false) {
    $date = new Date($timestamp);

    $date->setTZbyID($this->get_server_timezone());
    $date->convertTZbyID($this->get_display_timezone($user));
    return $date->getTime();
  }

  /**

   */
  function get_site_date($timestamp, $user = false) {
    static $localed = false;

    if(!$localed) {
      $this->set_locale($user);

      $localed = true;
    }

    $original_tz = date('T', $timestamp);

    $format = '%b %e, %Y';
    $rv = strftime($format, $timestamp);
    $rv .= " =timestamp\n";
    $rv .= strftime('%Z', $timestamp);
    $rv .= " =strftime('%Z')\n";
    $rv .= date('T', $timestamp);
    $rv .= " =date('T')\n";

    $date = &new Date($timestamp);

# Calling new Date() changes the timezone of the $timestamp var!
# so we only change the timezone to UTC if the original TZ wasn't UTC
# to begin with.
# This seems really buggy, but I don't have time to delve into right now.
    $rv .= date('T', $timestamp);
    $rv .= " =date('T')\n";

    $rv .= $date->format($format);
    $rv .= " =new Date()\n";

    $rv .= date('T', $timestamp);
    $rv .= " =date('T')\n";

    if($original_tz == 'UTC') {
      $date->setTZbyID('UTC');

      $rv .= $date->format($format);
      $rv .= " =setTZbyID('UTC')\n";
    }

    $tz_id = $this->get_display_timezone($user);

    if($date->tz->getID() != $tz_id) {
# let's convert to the displayed timezone
      $date->convertTZbyID($tz_id);

      $rv .= $date->format($format);
      $rv .= " =convertTZbyID($tz_id)\n";
    }

#return $rv;

# if ($format == "%b %e, %Y")
#   $format = $tikilib->get_short_date_format();
    return $date;
  }

  function date_format($format, $timestamp, $user = false) {
    //$date = $this->get_site_date($timestamp, $user);
    // JJ - ignore conversion - we have no idea what TZ they're using

    // PEAR dates caused a bug wherein the timezone would revert to GMT,
    // for example when editing a calendar event. See: http://dev.tikiwiki.org/tiki-view_tracker_item.php?itemId=536
    // $date = new Date($timestamp);
    // return $date->format($format);

    return strftime($format,$timestamp);
  }

  function get_long_date($timestamp, $user = false) {
    return $this->date_format($this->get_long_date_format(), $timestamp, $user);
  }

  function get_short_date($timestamp, $user = false) {
    return $this->date_format($this->get_short_date_format(), $timestamp, $user);
  }

  function get_long_time($timestamp, $user = false) {
    return $this->date_format($this->get_long_time_format(), $timestamp, $user);
  }

  function get_short_time($timestamp, $user = false) {
    return $this->date_format($this->get_short_time_format(), $timestamp, $user);
  }

  function get_long_datetime($timestamp, $user = false) {
    return $this->date_format($this->get_long_datetime_format(), $timestamp, $user);
  }

  function get_short_datetime($timestamp, $user = false) {
    return $this->date_format($this->get_short_datetime_format(), $timestamp, $user);
  }

  function get_site_timezone_shortname($user = false) {
    // UTC, or blank for local
    $dc = &$this->get_date_converter($user);

    return $dc->getTzName();
  }

  function get_server_timezone_shortname($user = false) {
    // Site time is always UTC, from the user's perspective.
    return "UTC";
  }

  /**
    get_site_time_difference - Return the number of seconds needed to add to a
    'system' time to return a 'site' time.
   */
  function get_site_time_difference($user = false) {
    $dc = &$this->get_date_converter($user);

    $display_offset = $dc->display_offset;
    $server_offset = $dc->server_offset;
    return $display_offset - $server_offset;
  }

  /**
    Timezone saavy replacement for mktime()
   */
  function make_time($hour, $minute, $second, $month, $day, $year, $timezone_id = false) {
    global $user;
# ugh!

    if($year <= 69)
      $year += 2000;

    if($year <= 99)
      $year += 1900;

    $date = new Date();
    $date->setHour($hour);
    $date->setMinute($minute);
    $date->setSecond($second);
    $date->setMonth($month);
    $date->setDay($day);
    $date->setYear($year);

#$rv = sprintf("make_time(): $date->format(%D %T %Z)=%s<br />\n", $date->format('%D %T %Z'));
#print "<pre> make_time() start";
#print_r($date);

    if($timezone_id)
      $date->setTZbyID($timezone_id);

#print_r($date);
#$rv .= sprintf("make_time(): $date->format(%D %T %Z)=%s<br />\n", $date->format('%D %T %Z'));
#print $rv;
    return $date->getTime();
  }

  /**
    Timezone saavy replacement for mktime()
   */
  function make_server_time($hour, $minute, $second, $month, $day, $year, $timezone_id = false) {
    global $user;
# ugh!

    if($year <= 69)
      $year += 2000;

    if($year <= 99)
      $year += 1900;

    $date = new Date();
    $date->setHour($hour);
    $date->setMinute($minute);
    $date->setSecond($second);
    $date->setMonth($month);
    $date->setDay($day);
    $date->setYear($year);

#print "<pre> make_server_time() start\n";
#print_r($date);

    if($timezone_id)
      $date->setTZbyID($timezone_id);

#print_r($date);
    $date->convertTZbyID($this->get_server_timezone());
#print_r($date);
#print "make_server_time() end\n</pre>";
    return $date->getTime();
  }

  /**
    Per http://www.w3.org/TR/NOTE-datetime
   */
  function get_iso8601_datetime($timestamp, $user = false) {
    return $this->date_format('%Y-%m-%dT%H:%M:%S%O', $timestamp, $user);
  }

  function get_rfc2822_datetime($timestamp = false, $user = false) {
    if(!$timestamp)
      $timestamp = time();

# rfc2822 requires dates to be en formatted
    $saved_locale = @setlocale(0);
    @setlocale('en_US');
#was return date('D, j M Y H:i:s ', $time) . $this->timezone_offset($time, 'no colon');
    $rv = $this->date_format('%a, %e %b %Y %H:%M:%S', $timestamp, $user). $this->get_rfc2822_timezone_offset($timestamp, $user);

# switch back to the 'saved' locale

    if($saved_locale)
      @setlocale($saved_locale);

    return $rv;
  }

  function get_rfc2822_timezone_offset($time = false, $no_colon = false, $user = false) {
    if($time === false)
      $time = time();

    $secs = $this->date_format('%Z', $time, $user);

    if($secs < 0) {
      $sign = '-';

      $secs = -$secs;
    }

    else {
      $sign = '+';
    }

    $colon = $no_colon ? '' : ':';
    $mins = intval(($secs + 30) / 60);

    return sprintf("%s%02d%s%02d", $sign, $mins / 60, $colon, $mins % 60);
  }

  function list_languages($path = false, $short=null) {
    $languages = array();

    if(!$path)
      $path = "lang";

    if(!is_dir($path))
      return array();

    $h = opendir($path);

    while($file = readdir($h)) {
      if(strpos($file,'.') === false && $file != 'CVS' && $file != 'index.php' && is_dir("$path/$file") && file_exists("$path/$file/language.php")) {
        $languages[] = $file;
      }
    }

    closedir($h);

    // Format and return the list
    return $this->format_language_list($languages, $short);
  }

  function list_styles() {
    global $tikidomain;

    $sty = array();

    if(is_dir("styles/")) {
      $h = opendir("styles/");

      while($file = readdir($h)) {
        if(preg_match("/\.css$/", $file)) {
          $sty[$file] = 1;
        }
      }

      closedir($h);
    }

    /* What is this $tikidomain section?
     * Some files that call this method used to list styles without considering
     * $tikidomain, now they do. They're listed below:
                       *
                       *  tiki-theme_control.php
                       *  tiki-theme_control_objects.php
                       *  tiki-theme_control_sections.php
                       *  tiki-my_tiki.php
                       *  modules/mod-switch_theme.php
                       *
                       *  lfagundes
     */

    if($tikidomain) {
      if(is_dir("styles/$tikidomain")) {
        $h = opendir("styles/$tikidomain");

        while($file = readdir($h)) {
          if(strstr($file, ".css") and substr($file,0,1) != '.') {
            $sty["$file"] = 1;
          }
        }

        closedir($h);
      }
    }

    $styles = array_keys($sty);
    sort($styles);
    return $styles;
  }

  // Comparison function used to sort languages by their name in the
  // current locale.
  function formatted_language_compare($a, $b) {
    return strcmp($a['name'], $b['name']);
  }
  // Returns a list of languages formatted as a twodimensionel array
  // with 'value' being the language code and 'name' being the name of
  // the language.
  // if $short is 'y' returns only the localized language names array
  function format_language_list($languages, $short=null) {
    // The list of available languages so far with both English and
    // translated names.
    global $langmapping;
    include_once("lang/langmapping.php");
    $formatted = array();

    // run through all the language codes:
    if(isset($short) && $short == "y") {
      foreach($languages as $lc) {
        if(isset($langmapping[$lc]))
          $formatted[] = array('value' => $lc, 'name' => $langmapping[$lc][0]);

        else
          $formatted[] = array('value' => $lc, 'name' => $lc);
      }
      usort($formatted, array('TikiLib', 'formatted_language_compare'));
      return $formatted;
    }

    foreach($languages as $lc) {
      if(isset($langmapping[$lc])) {
        // known language
        if($langmapping[$lc][0] == $langmapping[$lc][1]) {
          // Skip repeated text, 'English (English, en)' looks silly.
          $formatted[] = array(
            'value' => $lc,
            'name' => $langmapping[$lc][0] . " ($lc)"
          );
        }

        else {
          $formatted[] = array(
            'value' => $lc,
            'name' => $langmapping[$lc][1] . ' (' . $langmapping[$lc][0] . ', ' . $lc . ')'
          );
        }
      }

      else {
        // unknown language
        $formatted[] = array(
          'value' => $lc,
          'name' => tra("Unknown language"). " ($lc)"
        );
      }
    }

    // Sort the languages by their name in the current locale
    usort($formatted, array('TikiLib', 'formatted_language_compare'));
    return $formatted;
  }

  function get_language($user = false) {
    static $language = false;

    if(!$language) {
      if($user) {
        $language = $this->get_user_preference($user, 'language', 'default');

        if(!$language || $language == 'default')
          $language = $this->get_preference('language', 'en');
      }

      else
        $language = $this->get_preference('language', 'en');
    }

    return $language;
  }

  function get_locale($user = false) {
# TODO move to admin preferences screen
    static $locales = array(
      'cs' => 'cs_CZ',
      'de' => 'de_DE',
      'dk' => 'da_DK',
      'en' => 'en_US',
      'fr' => 'fr_FR',
      'he' => 'he_IL', # hebrew
      'it' => 'it_IT', # italian
      'pl' => 'pl_PL', # polish
      'po' => 'po',
      'ru' => 'ru_RU',
      'es' => 'es_ES',
      'sw' => 'sw_SW', # swahili
      'tw' => 'tw_TW',
    );

    if(!isset($locale) or !$locale) {
      $locale = '';

      if(isset($locales[$this->get_language($user)]))
        $locale = $locales[$this->get_language($user)];

#print "<pre>get_locale(): locale=$locale\n</pre>";
    }

    return $locale;
  }

  function set_locale($user = false) {
    static $locale = false;

    if(!$locale) {
# breaks the RFC 2822 code
      $locale = @setlocale(LC_TIME, $this->get_locale($user));
#print "<pre>set_locale(): locale=$locale\n</pre>";
    }

    return $locale;
  }

  function read_raw($text) {
    $file = split("\n",$text);
    $back = '';
    foreach($file as $line) {
      $r = $s = '';

      if(substr($line,0,1) != "#") {
        if(ereg("^\[([A-Z0-9]+)\]",$line,$r)) {
          $var = strtolower($r[1]);
        }

        if(isset($var) and(ereg("^([-_/ a-zA-Z0-9]+)[ \t]+[:=][ \t]+(.*)",$line,$s))) {
          $back[$var][trim($s[1])] = trim($s[2]);
        }
      }
    }
    return $back;
  }


  function httpScheme() {
    $https=$this->get_preference('https','auto');

    switch($https) {
    case 'auto':
    default:
      $e=((isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on')) ? 's' : '');
      break;

    case 'http':
      $e='';
      break;

    case 'https':
      $e='s';
      break;
    }

    return 'http' .$e;
  }

  function httpPrefix() {
    return $this->httpScheme().'://'.$_SERVER['HTTP_HOST'];
  }

  function distance($lat1,$lon1,$lat2,$lon2) {
    // This function uses a pure spherical model
    // it could be improved to use the WGS84 Datum
    // Franck Martin
    $lat1rad=deg2rad($lat1);
    $lon1rad=deg2rad($lon1);
    $lat2rad=deg2rad($lat2);
    $lon2rad=deg2rad($lon2);
    $distance=6367*acos(sin($lat1rad)*sin($lat2rad)+cos($lat1rad)*cos($lat2rad)*cos($lon1rad-$lon2rad));
    return($distance);
  }

  /**
  * returns a list of usergroups where the user is a member and the group has the right perm
  * sir-b
  **/
  function get_groups_to_user_with_permissions($user,$perm) {
    $userid = $this->get_user_id($user);
    $query = "SELECT DISTINCT `users_usergroups`.`groupName` AS `groupName`";
    $query.= "FROM  `users_grouppermissions`, `users_usergroups` ";
    $query.= "WHERE `users_usergroups`.`userId` = ? AND ";
    $query.= "`users_grouppermissions`.`groupName` = `users_usergroups`.`groupName` AND ";
    $query.= "`users_grouppermissions`.`permName` = ? ";
    $query.= "ORDER BY `groupName`";
    $result = $this->query($query, array((int)$userid, $perm));
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res;
    }

    return $ret;
  }

  function list_sections() {
    return array(
      'wiki',
      'galleries',
      'file_galleries',
      'cms',
      'blogs',
      'forums',
      'chat',
      'categories',
      'games',
      'faqs',
      'html_pages',
      'quizzes',
      'surveys',
      'webmail',
      'trackers',
      'featured_links',
      'directory',
      'user_messages',
      'newsreader',
      'mytiki',
      'calendar',
      'workflow',
      'charts'
    );
  }
  function other_value_in_tab_line($tab, $valField1, $field1, $field2) {
    foreach($tab as $line) {
      if($line[$field1] == $valField1)
        return $line[$field2];
    }
  }
  function list_votes($id, $offset=0, $maxRecords=-1, $sort_mode='user_asc', $find='', $table='', $column='') {
    $mid = 'where  `id`=?';
    $bindvars[] = $id;
    $select = '';
    $join = '';

    if(!empty($find)) {
      $mid .= " and `user` like ?";
      $bindvars[] = '%'.$find.'%';
    }

    if(!empty($table) && !empty($column)) {
      $select = ", `$table`.`$column` as title";
      $join = "left join `$table` on (`tiki_user_votings`.`optionId` = `$table`.`optionId`)";
    }

    $query = "select * $select from `tiki_user_votings` $join $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_user_votings` $mid";
    $result = $this->query($query, $bindvars, $maxRecords, $offset);
    $cant = $this->getOne($query_cant, $bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      $ret[] = $res;
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }


}

// end of class ------------------------------------------------------

// function to check if a file or directory is in the path
// returns FALSE if incorrect
// returns the canonicalized absolute pathname otherwise
function inpath($file,$dir) {
  $realfile=realpath($file);
  $realdir=realpath($dir);

  if(!$realfile) return (FALSE);

  if(!$realdir) return (FALSE);

  if(substr($realfile,0,strlen($realdir))!= $realdir) {
    return(FALSE);
  }

  else {
    return($realfile);
  }
}

function compare_links($ar1, $ar2) {
  return $ar1["links"] - $ar2["links"];
}

function compare_backlinks($ar1, $ar2) {
  return $ar1["backlinks"] - $ar2["backlinks"];
}

function r_compare_links($ar1, $ar2) {
  return $ar2["links"] - $ar1["links"];
}

function r_compare_backlinks($ar1, $ar2) {
  return $ar2["backlinks"] - $ar1["backlinks"];
}

function compare_images($ar1, $ar2) {
  return $ar1["images"] - $ar2["images"];
}

function r_compare_images($ar1, $ar2) {
  return $ar2["images"] - $ar1["images"];
}

function compare_files($ar1, $ar2) {
  return $ar1["files"] - $ar2["files"];
}

function r_compare_files($ar1, $ar2) {
  return $ar2["files"] - $ar1["files"];
}

function compare_versions($ar1, $ar2) {
  return $ar1["versions"] - $ar2["versions"];
}

function r_compare_versions($ar1, $ar2) {
  return $ar2["versions"] - $ar1["versions"];
}

function compare_changed($ar1, $ar2) {
  return $ar1["lastChanged"] - $ar2["lastChanged"];
}

function r_compare_changed($ar1, $ar2) {
  return $ar2["lastChanged"] - $ar1["lastChanged"];
}

function chkgd2() {
  if(!isset($_SESSION['havegd2'])) {
#   TODO test this logic in PHP 4.3
#   if (version_compare(phpversion(), "4.3.0") >= 0) {
#  $_SESSION['havegd2'] = true;
#   } else {
    ob_start();

    phpinfo(INFO_MODULES);
    $_SESSION['havegd2'] = preg_match('/GD Version.*2.0/', ob_get_contents());
    ob_end_clean();
# }
  }

  return $_SESSION['havegd2'];
}

function detect_browser_language() {

  // Get supported languages
  if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
    $supported = preg_split('/\s*,\s*/', preg_replace('/;q=[0-9.]+/','',$_SERVER['HTTP_ACCEPT_LANGUAGE']));

  else
    return '';

  // Get available languages
  $available = array();
  $available_aprox = array();

  if(is_dir("lang")) {
    $dh = opendir("lang");

    while($lang = readdir($dh)) {
      if(!strpos($lang,'.') and is_dir("lang/$lang") and file_exists("lang/$lang/language.php")) {
        $available[] = $lang;
        $available_aprox[substr($lang, 0, 2)] = $lang;
      }
    }
  }

  // Check better language
  // First try an exact match, then an aproximate
  $aproximate_lang = '';
  foreach($supported as $supported_lang) {
    $lang = strtolower($supported_lang);

    if(in_array($lang, $available)) {
      return $lang;
    }

    else {
      $lang = substr($lang, 0, 2);

      if(in_array($lang, array_keys($available_aprox))) {
        $aproximate_lang = $available_aprox[$lang];
      }
    }
  }

  return $aproximate_lang;
}


if(!function_exists('file_get_contents')) {
  function file_get_contents($f) {
    if(is_file($f)) {
      ob_start();
      $retval = @readfile($f);

      if(false !== $retval) {  // no readfile error
        $retval = ob_get_contents();
      }

      ob_end_clean();
      return $retval;
    }

    else {
      return false;
    }
  }
}

/**
 * Replace html_entity_decode()
 *
 * Borrowed from PEAR:PHP_Compat
 * @author      David Irvine <dave@codexweb.co.za>
 * @author      Aidan Lister <aidan@php.net>
 * @internal    Setting the charset will not do anything
 */
if(!function_exists('html_entity_decode')) {
  function html_entity_decode($string, $quote_style = ENT_COMPAT, $charset = null)
  {
    $trans_tbl = get_html_translation_table(HTML_ENTITIES);
    $trans_tbl = array_flip($trans_tbl);

    // Add single quote to translation table;
    $trans_tbl['&#039;'] = '\'';

    // Not translating double quotes
    if($quote_style & ENT_NOQUOTES) {
      // Remove double quote from translation table
      unset($trans_tbl['&quot;']);
    }

    return strtr($string, $trans_tbl);
  }
}

/**
 * Replace floatval()
 *
 * Borrowed from PEAR:PHP_Compat
 * @author      David Irvine <dave@codexweb.co.za>
 * @author      Aidan Lister <aidan@php.net>
 */
if(!function_exists('floatval')) {
  function floatval($var) {
    return (float) $var;
  }
}

/* This alters db column 'value' of tiki_preferences to support more than 255 characters (up to 65535 actually) */
/* ML: 20070912 This is no longer used and could be deleted? */
function alterprefs() {
  global $tikilib;

  if(!$tikilib->query("ALTER TABLE `tiki_preferences` MODIFY `value` TEXT", array())) {
    $smarty->assign("msg", tra('Altering database table failed'));
    $smarty->display("error.tpl");
    die;
  }

  return true;
}
?>
