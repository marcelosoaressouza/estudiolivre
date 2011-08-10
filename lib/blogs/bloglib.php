<?php

// $Header: /cvsroot/tikiwiki/tiki/lib/blogs/bloglib.php,v 1.33.2.17 2006/12/22 22:39:48 mose Exp $
//this script may only be included - so its better to die if called directly.
if(strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

class BlogLib extends TikiLib {
  function BlogLib($db) {
# this is probably uneeded now

    if(!$db) {
      die("Invalid db object passed to BlogsLib constructor");
    }

    $this->db = $db;
  }

  //Special parsing for multipage articles
  function get_number_of_pages($data) {
    $parts = explode("...page...", $data);
    return count($parts);
  }

  function get_page($data, $i) {
    // Get slides
    $parts = explode("...page...", $data);

    $ret = $parts[$i - 1];

    if(substr($parts[$i - 1], 1, 5) == "<br/>") $ret = substr($parts[$i - 1], 6);

    if(substr($parts[$i - 1], 1, 6) == "<br />") $ret = substr($parts[$i - 1], 7);

    return $ret;
  }

  function send_trackbacks($id, $trackbacks) {
    return array();
  }

  function add_trackback_from($postId, $url, $title = '', $excerpt = '', $blog_name = '') {
    if(!$this->getOne("select count(*) from `tiki_blog_posts` where `postId`=?",array($postId)))
      return false;

    $tbs = $this->get_trackbacks_from($postId);
    $aux = array(
             'title' => $title,
             'excerpt' => $excerpt,
             'blog_name' => $blog_name
           );

    $tbs[$url] = $aux;
    $st = serialize($tbs);
    $query = "update `tiki_blog_posts` set `trackbacks_from`=? where `postId`=?";
    $this->query($query,array($st,$postId));
    return true;
  }

  function remove_trackback_from($postId, $url) {
    if(!$this->getOne("select count(*) from `tiki_blog_posts` where `postId`=?",array($postId)))
      return false;

    $tbs = $this->get_trackbacks_from($_REQUEST["postId"]);
    $newtbs = array();
    foreach($tbs as $key => $oldtbs) {
      if($key != $_REQUEST["deltrack"]) {
        $newtbs["$key"] = $oldtbs;
      }
    }
    $st = serialize($newtbs);
    $query = "update `tiki_blog_posts` set `trackbacks_from`=? where `postId`=?";
    $this->query($query,array($st,$postId));
    return true;
  }

  function get_trackbacks_from($postId) {
    $st = $this->db->getOne("select `trackbacks_from` from `tiki_blog_posts` where `postId`=?",array($postId));

    return unserialize($st);
  }

  function get_trackbacks_to($postId) {
    $st = $this->db->getOne("select `trackbacks_to` from `tiki_blog_posts` where `postId`=?",array($postId));

    return unserialize($st);
  }

  function clear_trackbacks_from($postId) {
    $empty = serialize(array());

    $query = "update `tiki_blog_posts` set `trackbacks_from` = ? where `postId`=?";
    $this->query($query,array($empty,$postId));
  }

  function clear_trackbacks_to($postId) {
    $empty = serialize(array());

    $query = "update `tiki_blog_posts` set `trackbacks_to` = ? where `postId`=?";
    $this->query($query,array($empty,$postId));
  }

  function add_blog_hit($blogId) {
    global $count_admin_pvs;

    global $user;

    if($count_admin_pvs == 'y' || $user != 'admin') {
      $query = "update `tiki_blogs` set `hits` = `hits`+1 where `blogId`=?";

      $result = $this->query($query,array((int) $blogId));
    }

    return true;
  }

  function insert_post_image($postId, $filename, $filesize, $filetype, $data) {

    $query = "insert into `tiki_blog_posts_images`(`postId`,`filename`,`filesize`,`filetype`,`data`)
             values(?,?,?,?,?)";
    $this->query($query,array($postId,$filename,$filesize,$filetype,$data));
  }

  function get_post_image($imgId) {
    $query = "select * from `tiki_blog_posts_images` where `imgId`=?";

    $result = $this->query($query,array($imgId));
    $res = $result->fetchRow();
    return $res;
  }

  function get_post_images($postId) {
    global $tikilib;
    $query = "select `postId`,`filename`,`filesize`,`imgId` from `tiki_blog_posts_images` where `postId`=?";

    $result = $this->query($query,array((int) $postId));
    $ret = array();

    while($res = $result->fetchRow()) {
      $imgId = $res['imgId'];

      $res['link'] = "<img src='tiki-view_blog_post_image.php?imgId=$imgId' border='0' alt='image' />";
      $parts = parse_url($_SERVER['REQUEST_URI']);
      $path = str_replace('tiki-blog_post.php', 'tiki-view_blog_post_image.php', $parts['path']);
      $res['absolute'] = $tikilib->httpPrefix(). $path . "?imgId=$imgId";
      $ret[] = $res;
    }

    return $ret;
  }

  function remove_post_image($imgId) {
    $query = "delete from `tiki_blog_posts_images` where `imgId`=?";

    $this->query($query,array($imgId));
  }

  function replace_blog($title, $description, $user, $public, $maxPosts, $blogId, $heading, $use_title, $use_find,
                        $allow_comments, $show_avatar) {
    $now = date("U");

    if($blogId) {
      $query = "update `tiki_blogs` set `title`=? ,`description`=?,`user`=?,`public`=?,`lastModif`=?,`maxPosts`=?,`heading`=?,`use_title`=?,`use_find`=?,`allow_comments`=?,`show_avatar`=? where `blogId`=?";

      $result = $this->query($query,array($title,$description,$user,$public,$now,$maxPosts,$heading,$use_title,$use_find,$allow_comments,$show_avatar,$blogId));
    }

    else {
      $query = "insert into `tiki_blogs`(`created`,`lastModif`,`title`,`description`,`user`,`public`,`posts`,`maxPosts`,`hits`,`heading`,`use_title`,`use_find`,`allow_comments`,`show_avatar`)
               values(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

      $result = $this->query($query,array((int) $now,(int) $now,$title,$description,$user,$public,0,(int) $maxPosts,0,$heading,$use_title,$use_find,$allow_comments,$show_avatar));
      $query2 = "select max(`blogId`) from `tiki_blogs` where `lastModif`=?";
      $blogId = $this->getOne($query2,array((int) $now));

      global $feature_score;

      if($feature_score == 'y') {
        $this->score_event($user, 'blog_new');
      }
    }

    return $blogId;
  }

  function list_blog_posts($blogId, $offset = 0, $maxRecords = -1, $sort_mode = 'created_desc', $find = '', $date = '') {

    if($find) {
      $findesc = '%' . $find . '%';

      $mid = " where `blogId`=? and (`data` like ? or `title` like ?) ";
      $bindvars = array((int)$blogId,$findesc, $findesc);
    }

    else {
      $mid = " where `blogId`=? ";
      $bindvars = array((int) $blogId);
    }

    if($date) {
      $mid .= " and  `created`<=? ";
      $bindvars[]=(int) $date;
    }

    $query = "select * from `tiki_blog_posts` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_blog_posts` $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {
      $cant_com = $this->getOne("select count(*)
                                from `tiki_comments` where
                                `object`=? and `objectType` = 'post'", array(
                                  $res["postId"]));

      $res["comments"] = $cant_com;

      if($res['trackbacks_from']!=null)
        $res['trackbacks_from'] = unserialize($res['trackbacks_from']);

      if(!is_array($res['trackbacks_from']))
        $res['trackbacks_from'] = array();

      $res['trackbacks_from_count'] = count(array_keys($res['trackbacks_from']));

      if($res['trackbacks_to']!=null)
        $res['trackbacks_to'] = unserialize($res['trackbacks_to']);

      $res['trackbacks_to_count'] = count($res['trackbacks_to']);
      $res['pages'] = $this->get_number_of_pages($res['data']);
      $res['avatar'] = $this->get_user_avatar($res['user']);
      $ret[] = $res;
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  function list_all_blog_posts($offset = 0, $maxRecords = -1, $sort_mode = 'created_desc', $find = '', $date = '') {

    if($find) {
      $findesc = '%' . $find . '%';

      $mid = " where (`data` like ?) ";
      $bindvars=array($findesc);
    }

    else {
      $mid = "";
      $bindvars=array();
    }

    if($date) {
      $bindvars[]=$date;

      if($mid) {
        $mid .= " and  `created`<=? ";
      }

      else {
        $mid .= " where `created`<=? ";
      }
    }

    $query = "select * from `tiki_blog_posts` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_blog_posts` $mid";
    $result = $this->query($query,$bindvars,$maxRecords,$offset);
    $cant = $this->getOne($query_cant,$bindvars);
    $ret = array();

    while($res = $result->fetchRow()) {

      $add = TRUE;
      global $feature_categories;
      global $userlib;
      global $user;
      global $tiki_p_admin;

      if($tiki_p_admin != 'y' && $userlib->object_has_one_permission($res['blogId'], 'blog')) {
        // quiz permissions override category permissions
        if(!$userlib->object_has_permission($user, $res['blogId'], 'blog', 'tiki_p_read_blog'))
        {
          $add = FALSE;
        }
      }

      elseif($tiki_p_admin != 'y' && $feature_categories == 'y') {
        // no quiz permissions so now we check category permissions
        global $categlib;

        if(!is_object($categlib)) {
          include_once('lib/categories/categlib.php');
        }

        unset($tiki_p_view_categories); // unset this var in case it was set previously
        $perms_array = $categlib->get_object_categories_perms($user, 'blog', $res['blogId']);

        if($perms_array) {
          $is_categorized = TRUE;
          foreach($perms_array as $perm => $value) {
            $$perm = $value;
          }
        }

        else {
          $is_categorized = FALSE;
        }

        if($is_categorized && isset($tiki_p_view_categories) && $tiki_p_view_categories != 'y') {
          $add = FALSE;
        }
      }

      if($add) {
        $query2 = "select `title` from `tiki_blogs` where `blogId`=?";
        $title = $this->getOne($query2,array($res["blogId"]));
        $res["blogtitle"] = $title;
        $ret[] = $res;
      }
    }

    $retval = array();
    $retval["data"] = $ret;
    $retval["cant"] = $cant;
    return $retval;
  }

  function blog_post($blogId, $data, $user, $title = '', $trackbacks = '') {
    // update tiki_blogs and call activity functions
    global $smarty;
    global $tikilib;

    global $feature_user_watches;
    global $sender_email;
    $tracks = serialize(explode(',', $trackbacks));
    $data = strip_tags($data, '<a><b><i><h1><h2><h3><h4><h5><h6><ul><li><ol><br><p><table><tr><td><img><pre>');
    $now = date("U");
    $query = "insert into `tiki_blog_posts`(`blogId`,`data`,`created`,`user`,`title`,`trackbacks_from`,`trackbacks_to`) values(?,?,?,?,?,?,?)";
    $result = $this->query($query,array((int) $blogId,$data,(int) $now,$user,$title,serialize(array()),serialize(array())));
    $query = "select max(`postId`) from `tiki_blog_posts` where `created`=? and `user`=?";
    $id = $this->getOne($query,array((int) $now,$user));
    // Send trackbacks recovering only successful trackbacks
    $trackbacks = serialize($this->send_trackbacks($id, $trackbacks));
    // Update post with trackbacks successfully sent
    $query = "update `tiki_blog_posts` set `trackbacks_from`=?, `trackbacks_to` = ? where `postId`=?";
    $this->query($query,array(serialize(array()),$trackbacks,(int) $id));
    $query = "update `tiki_blogs` set `lastModif`=?,`posts`=`posts`+1 where `blogId`=?";
    $result = $this->query($query,array((int) $now,(int) $blogId));
    $this->add_blog_activity($blogId);

    if($feature_user_watches == 'y') {
      $nots = $this->get_event_watches('blog_post', $blogId);

      if(!isset($_SERVER["SERVER_NAME"])) {
        $_SERVER["SERVER_NAME"] = $_SERVER["HTTP_HOST"];
      }

      if(count($nots)) {
        include_once("lib/notifications/notificationemaillib.php");


        $smarty->assign('mail_site', $_SERVER["SERVER_NAME"]);
        $query = "select `title` from `tiki_blogs` where `blogId`=?";
        $blogTitle = $this->getOne($query, array((int)$blogId));
        $smarty->assign('mail_title', $blogTitle);
        $smarty->assign('mail_post_title', $title);
        $smarty->assign('mail_blogid', $blogId);
        $smarty->assign('mail_postid', $id);
        $smarty->assign('mail_date', date("U"));
        $smarty->assign('mail_user', $user);
        $smarty->assign('mail_data', $data);
        $foo = parse_url($_SERVER["REQUEST_URI"]);
        $machine = $tikilib->httpPrefix(). $foo["path"];
        $smarty->assign('mail_machine', $machine);
        $parts = explode('/', $foo['path']);

        if(count($parts) > 1)
          unset($parts[count($parts) - 1]);

        $smarty->assign('mail_machine_raw', $tikilib->httpPrefix(). implode('/', $parts));
        sendEmailNotification($nots, "watch", "user_watch_blog_post_subject.tpl", $_SERVER["SERVER_NAME"], "user_watch_blog_post.tpl");
        //@mail($not['email'], tra('Blog post'). ' ' . $blogTitle, $mail_data, "From: $sender_email\r\nContent-type: text/plain;charset=utf-8\r\n");
      }
    }

    global $feature_score;

    if($feature_score == 'y') {
      $this->score_event($user, 'blog_post');
    }

    return $id;
  }

  function remove_blog($blogId) {
    $query = "delete from `tiki_blogs` where `blogId`=?";

    $result = $this->query($query,array((int) $blogId));
    $query = "delete from `tiki_blog_posts` where `blogId`=?";
    $result = $this->query($query,array((int) $blogId));
    $this->remove_object('blog', $blogId);
    return true;
  }

  function remove_post($postId) {
    $query = "select `blogId` from `tiki_blog_posts` where `postId`=?";

    $blogId = $this->getOne($query,array((int) $postId));

    if($blogId) {
      $query = "delete from `tiki_blog_posts` where `postId`=?";

      $result = $this->query($query,array((int) $postId));
      $query = "update `tiki_blogs` set `posts`=`posts`-1 where `blogId`=?";
      $result = $this->query($query,array((int) $blogId));
    }

    $query = "delete from `tiki_blog_posts_images` where `postId`=?";
    $this->query($query,array((int) $postId));

    $this->remove_object('blog post', $postId);

    return true;
  }

  function get_post($postId) {
    $query = "select * from `tiki_blog_posts` where `postId`=?";

    $result = $this->query($query,array((int) $postId));

    if($result->numRows()) {
      $res = $result->fetchRow();
      $res['trackbacks_from'] = stripslashes(trim($res['trackbacks_from']));

      if(!$res['trackbacks_from'] || $res['trackbacks_from']===null)
      {
        $res['trackbacks_from'] = serialize(array());
      }

      if(!$res['trackbacks_to'] || $res['trackbacks_to']===null)
      {
        $res['trackbacks_to'] = serialize(array());
      }
// Problema no Serialize - Debugando
//      $res['trackbacks_from_count'] = count(array_keys(unserialize($res['trackbacks_from'])));
//      $res['trackbacks_from'] = unserialize($res['trackbacks_from']);
      $res['trackbacks_to'] = unserialize($res['trackbacks_to']);
      $res['trackbacks_to_count'] = count($res['trackbacks_to']);
    }

    else {
      return false;
    }

    return $res;
  }

  function update_post($postId, $blogId, $data, $user, $title = '', $trackbacks = '') {
    $trackbacks = serialize($this->send_trackbacks($postId, $trackbacks));
    $query = "update `tiki_blog_posts` set `blogId`=?,`trackbacks_to`=?,`data`=?,`user`=?,`title`=? where `postId`=?";
    $result = $this->query($query,array($blogId,$trackbacks,$data,$user,$title,$postId));
  }

  function list_user_posts($user, $offset = 0, $maxRecords = -1, $sort_mode = 'created_desc', $find = '') {

    if($find) {
      $findesc = '%' . $find . '%';

      $mid = " where `user`=? and (`data` like ?) ";
      $bindvars=array($user,$findesc);
    }

    else {
      $mid = ' where `user`=? ';
      $bindvars=array($user);
    }

    $query = "select * from `tiki_blog_posts` $mid order by ".$this->convert_sortmode($sort_mode);
    $query_cant = "select count(*) from `tiki_blog_posts` $mid";
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

  function add_blog_activity($blogId) {

    //Caclulate activity, update tiki_blogs and purge activity table
    $today = mktime(0, 0, 0, date("m"), date("d"), date("Y"));

    $day0 = $today - (24 * 60 * 60);
    $day1 = $today - (2 * 24 * 60 * 60);
    $day2 = $today - (3 * 24 * 60 * 60);
    // Purge old activity
    $query = "delete from `tiki_blog_activity` where `day`<?";
    $result = $this->query($query,array((int) $day2));
    /* this code enables you to reset blog activity if activity too old at each blog post
        $query = "select b.`blogId` from `tiki_blogs` b left join `tiki_blog_activity`a on a.`blogId`= b.`blogId` where b.`activity` > 0 and a.`blogId` is null";
        $result = $this->query($query);
        $dead = '';
        while ($res = $result->fetchRow()) {
          if ($dead)
            $dead .= ',';
          $dead .= $res['blogId'];
        }
        if ($dead) {
          $query = "update `tiki_blogs` set `activity`=NULL where `blogId` in (?)";
          $result = $this->query($query, array($dead));
        }
    */
    // Register new activity
    $query = "select count(*) from `tiki_blog_activity` where `blogId`=? and `day`=?";
    $result = $this->getOne($query,array((int) $blogId,(int)$today));

    if($result) {
      $query = "update `tiki_blog_activity` set `posts`=`posts`+1 where `blogId`=? and `day`=?";
    }

    else {
      $query = "insert into `tiki_blog_activity`(`blogId`,`day`,`posts`) values(?,?,1)";
    }

    $result = $this->query($query,array((int) $blogId,(int) $today));
    // Calculate activity
    $query = "select `posts` from `tiki_blog_activity` where `blogId`=? and `day`=?";
    $vtoday = $this->getOne($query,array((int) $blogId,(int) $today));
    $day0 = $this->getOne($query,array((int) $blogId,(int) $day0));
    $day1 = $this->getOne($query,array((int) $blogId,(int) $day1));
    $day2 = $this->getOne($query,array((int) $blogId,(int) $day2));
    $activity = (2 * $vtoday) + ($day0)+(0.5 * $day1) + (0.25 * $day2);
    // Update tiki_blogs with activity information
    $query = "update `tiki_blogs` set `activity`=? where `blogId`=?";
    $result = $this->query($query,array($activity,(int) $blogId));
  }
}

global $dbTiki;
$bloglib = new BlogLib($dbTiki);

?>
