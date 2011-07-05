<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

// A library to handle comments on object (notes, articles, etc)
// This is just a test
class Comments extends TikiLib {
#  var $db;  // The PEAR db object used to access the database
    var $time_control = 0;

    function Comments($db) {
	if (!$db) {
	    die ("Invalid db object passed to CommentsLib constructor");
	}

	$this->db = $db;
    }

    /* Functions for the forums */
    function report_post($forumId, $parentId, $threadId, $user, $reason = '') {

	$now = date("U");

	$query = "delete from `tiki_forums_reported` where `forumId`=?";
	$bindvars=array($forumId);
	$this->query($query,$bindvars,-1,-1,false);

	$query = "insert into `tiki_forums_reported`(`forumId`,
	`parentId`, `threadId`, `user`, `reason`, `timestamp`)
	    values(?,?,?,?,?,?)";
	$bindvars=array($forumId,$parentId,$threadId,$user,$reason,$now);
	$this->query($query,$bindvars);
    }

    function list_reported($forumId, $offset, $maxRecords, $sort_mode, $find) {

	if ($find) {
	    $findesc = '%' . $find . '%';

	    $mid = " and `reason` like ? or `user` like ?";
	    $bindvars=array($forumId, $findesc, $findesc );
	} else {
	    $mid = "";
	    $bindvars=array($forumId);
	}

	$query = "select `forumId`, tfr.`threadId`, tfr.`parentId`,
	tfr.`reason`, tfr.`user`, `title` from `tiki_forums_reported`
	    tfr,  `tiki_comments` tc where tfr.`threadId` = tc.`threadId`
	    and `forumId`=? $mid order by ".
	    $this->convert_sortmode($sort_mode);
	$query_cant = "select count(*) from `tiki_forums_reported` tfr,
	`tiki_comments` tc where tfr.`threadId` = tc.`threadId` and
	    `forumId`=? $mid";
	$result = $this->query($query, $bindvars, $maxRecords, $offset);
	$cant = $this->getOne($query_cant, $bindvars);
	$now = date("U");
	$ret = array();

	while ($res = $result->fetchRow()) {
	    $ret[] = $res;
	}

	$retval = array();
	$retval["data"] = $ret;
	$retval["cant"] = $cant;
	return $retval;
    }

    function is_reported($threadId) {
	return $this->getOne("select count(*) from `tiki_forums_reported` where `threadId`=?",array($threadId));
    }

    function remove_reported($threadId) {
	$query = "delete from `tiki_forums_reported` where `threadId`=?";

	$this->query($query,array((int) $threadId));
    }

    function get_num_reported($forumId) {
	return $this->getOne("select count(*) from `tiki_forums_reported` where `forumId`=?",array((int) $forumId));
    }

    function mark_comment($user, $forumId, $threadId) {
	if (!$user)
	    return false;

	$now = time();

	$query = "delete from `tiki_forum_reads` where `user`=? and `threadId`=?";
	$bindvars=array($user,(int) $threadId);
	$this->query($query,$bindvars,-1,-1,false);

	$query = "insert into `tiki_forum_reads`(`user`,`threadId`,`forumId`,`timestamp`)
	    values(?,?,?,?)";
	$bindvars=array($user,(int) $threadId,(int) $forumId,(int) $now);
	$this->query($query,$bindvars);
    }

    function unmark_comment($user, $forumId, $threadId) {
	$query = "delete from `tiki_forum_reads` where `user`=? and `threadId`=?";

	$this->query($query,array($user,(int) $threadId));
    }

    function is_marked($threadId) {
	global $user;

	if (!$user)
	    return false;

	return $this->getOne("select count(*) from `tiki_forum_reads` where `user`=? and `threadId`=?",array($user,$threadId));
    }

    function add_thread_attachment( $forum_info, $threadId, $fp = '', $data = '', $name, $type, $size, $inbound_mail = 0, $qId = 0 )
    {
	global $smarty;
	global $tiki_p_admin_forum, $tiki_p_forum_attach;

	// Deal with attachment
	if( $forum_info['att'] == 'att_all'
		    || ($forum_info['att'] == 'att_admin' && $tiki_p_admin_forum == 'y')
		    || ($forum_info['att'] == 'att_perm' && $tiki_p_forum_attach == 'y') )
	{

	    $fhash = '';

	    if ($forum_info['att_store'] == 'dir') {
		$fhash = md5(uniqid('.'));
		// Just in case the directory doesn't have the trailing slash
		if (substr($forum_info['att_store_dir'], strlen($forum_info['att_store_dir']) - 1, 1) == '\\') {
		    $forum_info['att_store_dir'] = substr($forum_info['att_store_dir'],
			    0, strlen($forum_info['att_store_dir']) - 1). '/';
		} elseif (
			substr($forum_info['att_store_dir'], strlen($forum_info['att_store_dir']) - 1, 1) != '/') {
		    $forum_info['att_store_dir'] .= '/';
		}

		@$fw = fopen($forum_info['att_store_dir'] . $fhash, "wb");
		if (!$fw && ! $inbound_mail ) {
		    $smarty->assign('msg', tra('Cannot write to this file: '). $forum_info['att_store_dir'] . $fhash);
		    $smarty->display("error.tpl");
		    die;
		}
	    }
	    if( $fp )
	    {
		while (!feof($fp)) {
		    if ($forum_info['att_store'] == 'db') {
			$data .= fread($fp, 8192 * 16);
		    } else {
			$data = fread($fp, 8192 * 16);
			fwrite($fw, $data);
		    }
		}
		fclose ($fp);
	    } else {
		fwrite($fw, $data);
	    }

	    if ($forum_info['att_store'] == 'dir') {
		fclose ($fw);
		$data = '';
	    }

	    if ($size > $forum_info['att_max_size'] && ! $inbound_mail ) {
		$smarty->assign('msg', tra('Cannot upload this file maximum upload size exceeded'));
		$smarty->display("error.tpl");
		die;
	    }

	    return $this->attach_file($threadId, $qId, $name, $type, $size, $data,
		    $fhash, $forum_info['att_store_dir'], $_REQUEST['forumId']);
	/* attachment */
	} else {
	    return false;
	}
    }

    function attach_file($threadId, $qId, $name, $type, $size, $data, $fhash, $dir, $forumId) {
	$now = time();

	if ($fhash) {
	    // Do not store data if we have a file
	    $data = '';
	}

	$query = "insert into
	    `tiki_forum_attachments`(`threadId`, `qId`, `filename`,
		    `filetype`, `filesize`, `data`, `path`, `created`, `dir`,
		    `forumId`)
	    values(?,?,?,?,?,?,?,?,?,?)";
	$this->query($query,array($threadId,$qId,$name,$type,$size,$data,$fhash,$now,$dir,$forumId));
	// Now the file is attached and we can proceed.
    }

    function get_thread_attachments($threadId, $qId) {
	if ($threadId) {
	    $cond = " where `threadId`=?";
	    $bindvars=array($threadId);
	} else {
	    $cond = " where `qId`=?";
	    $bindvars=array($qId);
	}

	$query = "select `filename`,`filesize`,`attId` from `tiki_forum_attachments` $cond";
	$result = $this->query($query,$bindvars);
	$ret = array();

	while ($res = $result->fetchRow()) {
	    $ret[] = $res;
	}

	return $ret;
    }

    function get_thread_attachment($attId) {
	$query = "select * from `tiki_forum_attachments` where `attId`=?";

	$result = $this->query($query,array($attId));
	$res = $result->fetchRow();
	$forum_info = $this->get_forum($res['forumId']);

	$res['forum_info'] = $forum_info;
	return $res;
    }

    function remove_thread_attachment($attId) {
	$query = "delete from `tiki_forum_attachments` where `attId`=?";

	$this->query($query,array($attId));
    }

    function parse_output(&$obj, &$parts, $i) {
	if (!empty($obj->parts)) {
	    $temp_max = count($obj->parts);
	    for ($i = 0; $i < $temp_max; $i++)
		$this->parse_output($obj->parts[$i], $parts, $i);
	} else {
	    $ctype = $obj->ctype_primary . '/' . $obj->ctype_secondary;

	    switch ($ctype) {
		case 'text/plain':
		case 'TEXT/PLAIN':
		    if (!empty($obj->disposition)AND $obj->disposition == 'attachment') {
			$names = split(';', $obj->headers["content-disposition"]);

			$names = split('=', $names[1]);
			$aux['name'] = $names[1];
			$aux['content-type'] = $obj->headers["content-type"];
			$aux['part'] = $i;
			$parts['attachments'][] = $aux;
		    } else {
			if(isset($obj->ctype_parameters) && ($obj->ctype_parameters['charset'] == "iso-8859-1" || $obj->ctype_parameters['charset'] == "ISO-8859-1"))
			{
			    $parts['text'][] = utf8_encode($obj->body);
			} else {
			    $parts['text'][] = $obj->body;
			}
		    }

		    break;

		case 'text/html':
		case 'TEXT/HTML':
		    if (!empty($obj->disposition)AND $obj->disposition == 'attachment') {
			$names = split(';', $obj->headers["content-disposition"]);

			$names = split('=', $names[1]);
			$aux['name'] = $names[1];
			$aux['content-type'] = $obj->headers["content-type"];
			$aux['part'] = $i;
			$parts['attachments'][] = $aux;
		    } else {
			$parts['html'][] = $obj->body;
		    }

		    break;

		default:
		    $names = split(';', $obj->headers["content-disposition"]);

		    $names = split('=', $names[1]);
		    $aux['name'] = $names[1];
		    $aux['content-type'] = $obj->headers["content-type"];
		    $aux['part'] = $i;
		    $parts['attachments'][] = $aux;
	    }
	}
    }

    function process_inbound_mail($forumId)
    {
	// require_once ("lib/webmail/pop3.php");
	require_once ("lib/webmail/net_pop3.php");

	require_once ("lib/mail/mimelib.php");
	//require_once ("lib/webmail/mimeDecode.php");
	include_once ("lib/webmail/class.rc4crypt.php");
	include_once ("lib/webmail/htmlMimeMail.php");
	$info = $this->get_forum($forumId);

	// for any reason my sybase test machine adds a space to
	// the inbound_pop_server field in the table.
	$info["inbound_pop_server"]=trim($info["inbound_pop_server"]);

	if (!$info["inbound_pop_server"] || empty($info["inbound_pop_server"]))
	    return;

	$pop3 = new Net_POP3();
	$pop3->connect($info["inbound_pop_server"]);
	$pop3->login($info["inbound_pop_user"], $info["inbound_pop_password"]);
	
	if (!$pop3)
	    return;

	$mailsum = $pop3->numMsg();

	$pop3->disconnect();

	for ($i = 1; $i <= $mailsum; $i++) {

	    // Just changed the code to close and re-open the POP3 session for
	    // each message; it used to try to retrieve everything in one
	    // session.
	    //
	    // We close and re-open for each message because POP3 won't
	    // delete mail until the client quits (so you can back out of
	    // accidental deletions in a real user client).  This doesn't apply
	    // here, and as it stands if the mailbox gets very full, we end up
	    // hitting the mailbox over and over without changing anything,
	    // because eventually the session times out.
	    //
	    // As a side effect, $i doesn't really get used (we're always
	    // retrieving the first message).
	    //
	    // -Robin Powell, 8 Nov 2004

	    $pop3->connect($info["inbound_pop_server"]);
	    $pop3->login($info["inbound_pop_user"], $info["inbound_pop_password"]);

	    $aux = $pop3->getParsedHeaders( 1 );

	    // If the connection is done, or the mail has an error, or whatever,
	    // we try to delete the current mail (because something is wrong with it)
	    // and continue on. --rlpowell
	    if( $aux == FALSE ) {
		$pop3->deleteMsg( 1 );
		continue;
	    }

	    if (!isset($aux["From"]))
	    {
		$aux['From'] = $aux['Return-path'];
	    }

	    preg_match('/<?([-!#$%&\'*+\.\/0-9=?A-Z^_`a-z{|}~]+@[-!#$%&\'*+\/0-9=?A-Z^_`a-z{|}~]+\.[-!#$%&\'*+\.\/0-9=?A-Z^_`a-z{|}~]+)>?/',$aux["From"],$mail);

	    $email = $mail[1];
			
	    $full = $pop3->getMsg( 1 );
	    $message = $pop3->getBody( 1 );

	    // print( "<pre>" );
	    // print_r( $full );
	    // print( "</pre>" );

	    $output = mime::decode($full);
	    //unset ($parts);
	    //$this->parse_output($output, $parts, 0);

	    // print( "<pre>" );
	    // print_r( $output );
	    // print( "</pre>" );

	    if (isset($output["text"][0])) {
		$body = $output["text"][0];
	    } elseif (isset($output['parts'][0]["text"][0])) {
		$body = $output['parts'][0]["text"][0];
	    } elseif (isset($output['body'])) {
		$body = $output['body'];
	    } else {
		$body = "";
	    }

	    // print( "<pre>" );
	    // print_r( $body );
	    // print( "</pre>" );

	    // Remove 're:' and [forum]. -rlpowell
	    $title = trim(
		    preg_replace( "/[rR][eE]:/", "", 
			preg_replace( "/\[[-A-Za-z _:]*\]/", "", 
			    $output['header']['subject'] 
			    )
			)
		    );

	    if (stristr($aux['Subject'], "=?iso-8859-1?") == $aux['Subject'])
		$title = utf8_encode($title);

	    //Todo: check permissions
	    $message_id = substr($output['header']["message-id"], 1,
		    strlen($output['header']["message-id"])-2);

	    if( isset( $output['header']["in-reply-to"] ) )
	    {
		$in_reply_to = substr($output['header']["in-reply-to"], 1,
			strlen($output['header']["in-reply-to"])-2);
	    } else {
		$in_reply_to = '';
	    }
	    // Determine user from email
	    $userName = $this->getOne("select `login` from `users_users` where `email`=?",array($email));

	    if (!$userName)
		$user = '';

	    // Determine if the thread already exists.
	    $parentId = $this->getOne(
		    "select `threadId` from `tiki_comments` where
		    `object`=? and `objectType` = 'forum' and
		    `parentId`=0 and `title`=?",
		    array($forumId, $title) 
		    );

	    // print( "<pre>parentid:" );
	    // print_r( $parentId );
	    // print( "</pre>" );

	    if (!$parentId)
	    {
		// No thread already; create it.

		$temp_msid = '';

		$parentId = $this->post_new_comment(
			'forum:' . $forumId, 0,
			$userName, $title, 
			sprintf(tra("Use this thread to discuss the %s page."), "[tiki-index.php?page=$title|$title]"),
			$temp_msid, $in_reply_to
			);

	        $this->register_forum_post($forumId,0);

		// First post is in reply to this one
		$in_reply_to = $temp_msid;
	    }

	    // post
	    $threadid = $this->post_new_comment( 'forum:' . $forumId,
		    $parentId, $userName, $title, $body,
		    $message_id, $in_reply_to);

	    $this->register_forum_post($forumId,$parentId);

	    // Process attachments
	    if( array_key_exists( 'parts', $output ) && count( $output['parts'] ) > 1 )
	    {
		foreach( $output['parts'] as $part )
		{
		    if( array_key_exists( 'disposition', $part ) && $part['disposition'] == "attachment" )
		    {
			if( strlen( $part['d_parameters']['filename'] ) > 0 )
			{
			    $part_name = $part['d_parameters']['filename'];
			} else {
			    $part_name = "Unnamed File";
			}

			$forum_info = $this->get_forum( $forumId );
			$this->add_thread_attachment(
				$forum_info, $threadid, '', $part['body'],
				$part_name, $part['type'],
				strlen( $part['body'] ),
				1 );
		    }
		}
	    }

	    // Deal with mail notifications.
	    if( array_key_exists( 'outbound_mails_reply_link', $info )
		&& $info['outbound_mails_for_inbound_mails'] == 'y' )
	    {
	    //phpinfo();
		include_once('lib/notifications/notificationemaillib.php');
		sendForumEmailNotification('forum_post_thread',
			$threadid, $info,
			$title, $body, $userName,
			$title, $message_id, $in_reply_to,
			$threadid, $parentId);
	    }


	    $pop3->deleteMsg( 1 );

	    $pop3->disconnect();

	}

    }

    /* queue management */
    function replace_queue($qId, $forumId, $object, $parentId, $user, $title, $data, $type = 'n', $topic_smiley = '', $summary = '',
	    $topic_title = '') {
	// timestamp

	$hash2 = md5($title . $data);

	if ($qId == 0 && $this->getOne("select count(*) from
		    `tiki_forums_queue` where `title`=? and `data`=?",array($title,$hash2)))
	    return false;

	$now = date("U");

	if ($qId) {
	    $query = "update `tiki_forums_queue` set
		`object` = ?,
	    `parentId`=?,
	    `user`=?,
	    `title`=?,
	    `data`=?,
	    `forumId`=?,
	    `type`=?,
	    `hash`=?,
	    `topic_title`=?,
	    `topic_smiley`=?,
	    `summary` = ?,
	    `timestamp` = ?
		where `qId`=?
		";

	    $this->query($query,array($object,$parentId,$user,$title,$data,$forumId,$type,$hash2,$topic_title,$topic_smiley,$summary,$now,$qId));
	    return $qId;
	} else {
	    $query = "insert into
		`tiki_forums_queue`(`object`, `parentId`, `user`,
			`title`, `data`, `type`, `topic_smiley`, `summary`,
			`timestamp`, `topic_title`, `hash`, `forumId`)
		values(?,?,?,?,?,?,?,?,?,?,?,?)";

	    $this->query($query, array($object, $parentId, $user,
			$title, $data, $type, $topic_smiley, $summary, $now,
			$topic_title, $hash2, $forumId));
	    $qId = $this->getOne("select max(`qId`) from
		    `tiki_forums_queue` where `hash`=? and
		    `timestamp`=?",array($hash2,$now));
	}

	return $qId;
    }

    function get_num_queued($object) {
	return $this->getOne("select count(*) from
		`tiki_forums_queue` where `object`=?",array($object));
    }

    function list_forum_queue($object, $offset, $maxRecords, $sort_mode, $find) {

	if ($find) {
	    $findesc = '%' . $find . '%';

	    $mid = " and `title` like $findesc or `data` like $findesc";
	    $bindvars=array($findesc,$findesc,$object);
	} else {
	    $mid = "";
	    $bindvars=array($object);
	}

	$query = "select * from `tiki_forums_queue` where `object`=? $mid order by ".$this->convert_sortmode($sort_mode);
	$query_cant = "select count(*) from `tiki_forums_queue` where `object`=? $mid";

	$result = $this->query($query, $bindvars,$maxRecords,$offset );
	$cant = $this->getOne($query_cant, $bindvars );
	$now = date("U");
	$ret = array();

	while ($res = $result->fetchRow()) {
	    $res['parsed'] = $this->parse_comment_data($res['data']);

	    $res['attachments'] = $this->get_thread_attachments(0, $res['qId']);
	    $ret[] = $res;
	}

	$retval = array();
	$retval["data"] = $ret;
	$retval["cant"] = $cant;
	return $retval;
    }

    function queue_get($qId) {
	$query = "select * from `tiki_forums_queue` where `qId`=?";

	$result = $this->query($query,array((int) $qId));
	$res = $result->fetchRow();
	$res['attachments'] = $this->get_thread_attachments(0, $res['qId']);
	return $res;
    }

    function remove_queued($qId) {
	$query = "delete from `tiki_forums_queue` where `qId`=?";

	$this->query($query,array((int) $qId));
	$query = "delete from `tiki_forum_attachments` where `qId`=?";
	$this->query($query,array((int) $qId));
    }

    //Approve queued message -> post as new comment
    function approve_queued($qId) {
	$info = $this->queue_get($qId);

	$message_id = '';
	$threadId = $this->post_new_comment(
		'forum:' . $info['forumId'], $info['parentId'],
		$info['user'], $info['title'], $info['data'], 
		$message_id, '', //in_reply_to
		$info['type'],
		$info['summary'], $info['topic_smiley']
		);
    if ($threadId) {
		$query = "update `tiki_forum_attachments` set `threadId`=$threadId, `qId`=0 where `qId`=$qId";
		$this->query($query);
	}
	$this->remove_queued($qId);

	/* This all looks redundant to me -dheltzel (not completely redundant - nkoth - added above)
	   if ($threadId) {
	   $query = "update `tiki_forum_attachments` set `threadId`=$threadId where `qId`=$qId";

	   $this->query($query);
	   $query = "delete from `tiki_forum_attachments` where `qId`=$qId";
	   $this->query($query);
	   }
	 */
    }

    function get_forum_topics($forumId, $offset = 0, $max = -1,
	    $sort_mode = 'commentDate_asc') {
	if ($sort_mode == 'points_asc') {
	    $sort_mode = 'average_asc';
	}
	if ($this->time_control) {
	    $limit = time() - $this->time_control;
	    $time_cond = " and a.`commentDate` > ? ";
	    $bind_time = array((int) $limit);
	} else {
	    $time_cond = '';
	    $bind_time = array();
	}

	$ret = array();
	foreach (array('=', '<>') as $stickytest) {
	    $query = "select a.`threadId`,a.`object`,a.`objectType`,a.`parentId`,
	    a.`userName`,a.`commentDate`,a.`hits`,a.`type`,a.`points`,
	    a.`votes`,a.`average`,a.`title`,a.`data`,a.`hash`,a.`user_ip`,
	    a.`summary`,a.`smiley`,a.`message_id`,a.`in_reply_to`,a.`comment_rating`,".
		$this->ifNull("max(b.`commentDate`)","a.`commentDate`")." as `lastPost`,
	    count(b.`threadId`) as `replies`
		from `tiki_comments` a left join `tiki_comments` b 
		on b.`parentId`=a.`threadId`
		where a.`object`=?
		and a.`type` $stickytest ?  and a.`objectType` = 'forum'
		and a.`parentId` = ? $time_cond group by a.`threadId`";
	    global $ADODB_LASTDB;
	    if($ADODB_LASTDB != 'sybase') {
		$query .=",a.`object`,a.`objectType`,a.`parentId`,a.`userName`,a.`commentDate`,a.`hits`,a.`type`,a.`points`,a.`votes`,a.`average`,a.`title`,a.`data`,a.`hash`,a.`user_ip`,a.`summary`,a.`smiley`,a.`message_id`,a.`in_reply_to`,a.`comment_rating` ";
	    }
	    $query .="order by ".$this->convert_sortmode($sort_mode).", `threadId`";
	    $result = $this->query($query, array_merge(array((string) $forumId, 's', 0),
			$bind_time), $max, $offset);

	    while ($res = $result->fetchRow()) {
		$tid = $res['threadId'];
		if ($res["lastPost"]!=$res["commentDate"]) {
		    // last post data is for tiki-view_forum.php. 
		    // you can see the title and author of last post
		    $query = "select * from `tiki_comments`
			where `parentId` = ? and `commentDate` = ?
			order by `threadId` desc";
		    $r2 = $this->query($query, array($tid, $res['lastPost']));
		    $res['lastPostData'] = $r2->fetchRow();
		}

		// Has the user read it?
		$res['is_marked'] = $this->is_marked($tid);
		$ret[] = $res;
	    }
	}

	return $ret;
    }

    function get_last_forum_posts($forumId, $maxRecords = -1)
    {
	$mid = " where `objectType` = ? and `object`=? ";
	$bind_mid = array('forum', $forumId);
	$sort_mode = 'commentDate_desc';

	$query = "select * from `tiki_comments` $mid order by ".$this->convert_sortmode($sort_mode);
	$result = $this->query($query, $bind_mid, $maxRecords, 0);

	$ret = array();
	while ($res = $result->fetchRow()) {
	    $ret[] = $res;
	}

	return $ret;
    }

    function replace_forum($forumId, $name, $description, $controlFlood,
	    $floodInterval, $moderator, $mail, $useMail,
	    $usePruneUnreplied, $pruneUnrepliedAge, $usePruneOld,
	    $pruneMaxAge, $topicsPerPage, $topicOrdering,
	    $threadOrdering, $section, $topics_list_reads,
	    $topics_list_replies, $topics_list_pts,
	    $topics_list_lastpost, $topics_list_author, $vote_threads,
	    $show_description, $inbound_pop_server, $inbound_pop_port,
	    $inbound_pop_user, $inbound_pop_password, $outbound_address,
	    $outbound_mails_for_inbound_mails, $outbound_mails_reply_link,
	    $outbound_from, $topic_smileys, $topic_summary, $ui_avatar,
	    $ui_flag, $ui_posts, $ui_level, $ui_email, $ui_online,
	    $approval_type, $moderator_group, $forum_password,
	    $forum_use_password, $att, $att_store, $att_store_dir,
	    $att_max_size,$forum_last_n)
    {
	if ($forumId)
	{
	    $query = "update `tiki_forums` set
		`name` = ?,  	
	    `description` = ?,
	    `controlFlood` = ?,
	    `floodInterval` = ?,
	    `moderator` = ?,
	    `mail` = ?,
	    `useMail` = ?,
	    `section` = ?,
	    `usePruneUnreplied` = ?,
	    `pruneUnrepliedAge` = ?,
	    `usePruneOld` = ?,
	    `vote_threads` = ?,
	    `topics_list_reads` = ?,
	    `topics_list_replies` = ?,
	    `show_description` = ?,
	    `inbound_pop_server` = ?,
	    `inbound_pop_port` = ?,
	    `inbound_pop_user` = ?,
	    `inbound_pop_password` = ?,
	    `outbound_address` = ?,
	    `outbound_mails_for_inbound_mails` = ?,
	    `outbound_mails_reply_link` = ?,
	    `outbound_from` = ?,
	    `topic_smileys` = ?,
	    `topic_summary` = ?,
	    `ui_avatar` = ?,
	    `ui_flag` = ?,
	    `ui_posts` = ?,
	    `ui_level` = ?,
	    `ui_email` = ?,
	    `ui_online` = ?,
	    `approval_type` = ?,
	    `moderator_group` = ?,
	    `forum_password` = ?,
	    `forum_use_password` = ?,
	    `att` = ?,
	    `att_store` = ?,
	    `att_store_dir` = ?,
	    `att_max_size` = ?, 
	    `topics_list_pts` = ?,
	    `topics_list_lastpost` = ?,
	    `topics_list_author` = ?,
	    `topicsPerPage` = ?,
	    `topicOrdering` = ?,
	    `threadOrdering` = ?,
	    `pruneMaxAge` = ?,
	    `forum_last_n` = ?
		where `forumId` = ?";
	    $result = $this->query(
		    $query,
		    array(
			$name,  	
			$description,
			$controlFlood,
			(int) $floodInterval,
			$moderator,
			$mail,
			$useMail,
			$section,
			$usePruneUnreplied,
			(int) $pruneUnrepliedAge,
			$usePruneOld,
			$vote_threads,
			$topics_list_reads,
			$topics_list_replies,
			$show_description,
			$inbound_pop_server,
			$inbound_pop_port,
			$inbound_pop_user,
			$inbound_pop_password,
			$outbound_address,
			$outbound_mails_for_inbound_mails,
			$outbound_mails_reply_link,
			$outbound_from,
			$topic_smileys,
			$topic_summary,
			$ui_avatar,
			$ui_flag,
			$ui_posts,
			$ui_level,
			$ui_email,
			$ui_online,
			$approval_type,
			$moderator_group,
			$forum_password,
			$forum_use_password,
			$att,
			$att_store,
			$att_store_dir,
			(int) $att_max_size,
			$topics_list_pts,
			$topics_list_lastpost,
			$topics_list_author,
			(int) $topicsPerPage,
			$topicOrdering,
			$threadOrdering,
			(int) $pruneMaxAge,
			(int) $forum_last_n,
			(int) $forumId
			    )
			    );
	} else {
	    $now = date("U");

	    $query = "insert into `tiki_forums`(`name`, `description`,
	    `created`, `lastPost`, `threads`, `comments`,
	    `controlFlood`,`floodInterval`, `moderator`, `hits`, `mail`,
	    `useMail`, `usePruneUnreplied`, `pruneUnrepliedAge`,
	    `usePruneOld`,`pruneMaxAge`, `topicsPerPage`,
	    `topicOrdering`, `threadOrdering`,`section`,
	    `topics_list_reads`, `topics_list_replies`,
	    `topics_list_pts`, `topics_list_lastpost`,
	    `topics_list_author`, `vote_threads`, `show_description`,
	    `inbound_pop_server`,`inbound_pop_port`,`inbound_pop_user`,`inbound_pop_password`,
	    `outbound_address`, `outbound_mails_for_inbound_mails`,
	    `outbound_mails_reply_link`, `outbound_from`,
	    `topic_smileys`,`topic_summary`,
	    `ui_avatar`, `ui_flag`, `ui_posts`, `ui_level`, `ui_email`,
	    `ui_online`, `approval_type`, `moderator_group`,
	    `forum_password`, `forum_use_password`, `att`, `att_store`,
	    `att_store_dir`, `att_max_size`,`forum_last_n`) 
		values (?,?,?,?,?,?,?,?,?,?,
			?,?,?,?,?,?,?,?,?,?,
			?,?,?,?,?,?,?,?,?,?,
			?,?,?,?,?,?,?,?,?,?,
			?,?,?,?,?,?,?,?,?,?,?,?)";
	    $bindvars=array($name, $description, (int) $now, (int) $now, 0, 0,
		    $controlFlood, (int) $floodInterval, $moderator, 0, $mail,
		    $useMail, $usePruneUnreplied, (int) $pruneUnrepliedAge,
		    $usePruneOld, (int) $pruneMaxAge, (int) $topicsPerPage,  $topicOrdering,
		    $threadOrdering, $section, $topics_list_reads,
		    $topics_list_replies, $topics_list_pts,
		    $topics_list_lastpost, $topics_list_author, $vote_threads,
		    $show_description, $inbound_pop_server, $inbound_pop_port,
		    $inbound_pop_user, $inbound_pop_password, $outbound_address,
		    $outbound_mails_for_inbound_mails,
		    $outbound_mails_reply_link,
		    $outbound_from,  $topic_smileys, $topic_summary, $ui_avatar,
		    $ui_flag, $ui_posts, $ui_level, $ui_email, $ui_online,
		    $approval_type, $moderator_group, $forum_password,
		    $forum_use_password, $att, $att_store, $att_store_dir,
		    (int) $att_max_size,(int) $forum_last_n);

	    $result = $this->query($query,$bindvars);
	    $forumId = $this->getOne("select max(`forumId`)
		    from `tiki_forums` where `name`=? and `created`=?",
		    array($name,(int) $now));
	}

	return $forumId;
    }

    function get_forum($forumId) {
	$query = "select * from `tiki_forums` where `forumId`=?";

	$result = $this->query($query,array((int) $forumId));
	$res = $result->fetchRow();
	return $res;
    }

    function remove_forum($forumId) {
	$query = "delete from `tiki_forums` where `forumId`=?";
	$result = $this->query($query, array((int) $forumId ) );
	$this->remove_object("forum", $forumId);
	$query = "delete from `tiki_forum_attachments` where `forumId`=?";
	$this->query($query, array((int) $forumId ) );
	$query = "delete from `tiki_forums_queue` where `forumId`=?";
	$this->query($query, array((int) $forumId ) );
	$query = "delete from `tiki_forum_reads` where `forumId`=?";
	$this->query($query, array((int) $forumId ) );
	$query = "delete from `tiki_user_watches` where `event`=? and `object`=?";
	$this->query($query,array('forum_post_topic', $forumId));	
	$query = "delete from `tiki_user_watches` where `event`=? and `url` like ?";
	$this->query($query,array('forum_post_thread', '%forumId='.$forumId.'%'));
	return true;
    }

    function list_forums($offset, $maxRecords, $sort_mode, $find) {

	if ($find) {
	    $findesc = '%' . $find . '%';

	    $mid = " where `name` like ? or `description` like ? ";
	    $bindvars=array($findesc,$findesc);
	} else {
	    $mid = "";
	    $bindvars=array();
	}

	$query = "select * from `tiki_forums` $mid order by `section` asc,".$this->convert_sortmode($sort_mode);
	$query_cant = "select count(*) from `tiki_forums` $mid";
	$result = $this->query($query,$bindvars);
	$cant = $this->getOne($query_cant,$bindvars);
	$now = date("U");
	$ret = array();
	$count = 0;
	$off = 0;
	while (($res = $result->fetchRow()) && ($maxRecords == -1 || $count < $maxRecords)) {
	    global $user;
	    if ($this->user_has_perm_on_object($user, $res['forumId'], 'forum', 'tiki_p_forum_read')) {
		    if ($off++ < $offset)
			continue;
		    $forum_age = ceil(($now - $res["created"]) / (24 * 3600));

		    $res["age"] = $forum_age;

		    if ($forum_age) {
				$res["posts_per_day"] = $res["comments"] / $forum_age;
		    } else {
				$res["posts_per_day"] = 0;
		    }

		    // Now select users
		    $query = "select distinct `userName` from
					`tiki_comments` where `object`=? and `objectType` =
					'forum'";
		    $result2 = $this->query($query,array((string) $res["forumId"]));
		    $res["users"] = $result2->numRows();

		    if ($forum_age) {
				$res["users_per_day"] = $res["users"] / $forum_age;
		    } else {
				$res["users_per_day"] = 0;
		    }

		    $query2 = "select * from `tiki_comments`,`tiki_forums`
					where `object`=".$this->sql_cast('`forumId`','string')." and `objectType` = ?
					and `commentDate`=?";
		    $result2 = $this->query($query2,array('forum',(int) $res["lastPost"]));
		    $res2 = $result2->fetchRow();
		    $res["lastPostData"] = $res2;
		    $ret[] = $res;
		    ++$count;
		}
	}

	$retval = array();
	$retval["data"] = $ret;
	$retval["cant"] = $cant;
	return $retval;
    }

    function list_forums_by_section($section, $offset, $maxRecords, $sort_mode, $find) {

	if ($find) {
	    $findesc = '%' . $find . '%';

	    $mid = " where `section`=? and `name` like ? or `description` like ?";
	    $bindvars=array($section,$findesc,$findesc);
	} else {
	    $mid = " where `section`=? ";
	    $bindvars=array($section);
	}

	$query = "select * from `tiki_forums` $mid order by ".$this->convert_sortmode($sort_mode);
	$query_cant = "select count(*) from `tiki_forums`";
	$result = $this->query($query,$bindvars,$maxRecords,$offset);
	$cant = $this->getOne($query_cant,array());
	$now = date("U");
	$ret = array();

	while ($res = $result->fetchRow()) {
	    $forum_age = ceil(($now - $res["created"]) / (24 * 3600));

	    $res["age"] = $forum_age;

	    if ($forum_age) {
		$res["posts_per_day"] = $res["comments"] / $forum_age;
	    } else {
		$res["posts_per_day"] = 0;
	    }

	    // Now select users
	    $query = "select distinct(`username`) from `tiki_comments`
		where `object`=? and `objectType` = 'forum'";
	    $result2 = $this->query($query, array( $res["forumId"] ));
	    $res["users"] = $result2->numRows();

	    if ($forum_age) {
		$res["users_per_day"] = $res["users"] / $forum_age;
	    } else {
		$res["users_per_day"] = 0;
	    }

	    $query2 = "select * from `tiki_comments`,`tiki_forums` where
		`object`=`forumId` and `objectType` = 'forum' and
		`commentDate` = ?";
	    $result2 = $this->query($query2, array($res["lastPost"]));
	    $res2 = $result2->fetchRow();
	    $res["lastPostData"] = $res2;
	    $ret[] = $res;
	}

	$retval = array();
	$retval["data"] = $ret;
	$retval["cant"] = $cant;
	return $retval;
    }

    function user_can_edit_post( $user, $threadId )
    {
	$result = $this->getOne( "select `userName` from `tiki_comments`
		where `threadId` = ?", array( $threadId ) );

	if( $result == $user )
	{
	    return true;
	} else {
	    return false;
	}
    }

    function user_can_post_to_forum($user, $forumId) {
	// Check flood interval for the forum
	$forum = $this->get_forum($forumId);

	if ($forum["controlFlood"] != 'y')
	    return true;

	if ($user) {
	    $query = "select max(`commentDate`) from `tiki_comments`
		where `object` = ? and `objectType` = 'forum' and
		`userName` = ?";
	    $maxDate = $this->getOne($query, array( $forumId, $user) );

	    if (!$maxDate) {
		return true;
	    }

	    $now = date("U");

	    if ($maxDate + $forum["floodInterval"] > $now) {
		return false;
	    } else {
		return true;
	    }
	} else {
	    // Anonymous users
	    if (!isset($_SESSION["lastPost"])) {
		return true;
	    } else {
		$now = date("U");

		if ($_SESSION["lastPost"] + $forum["floodInterval"] > $now) {
		    return false;
		} else {
		    return true;
		}
	    }
	}
    }

    function register_forum_post($forumId, $parentId) {
	$now = date("U");

	if (!$parentId) {
	    $query = "update `tiki_forums` set `threads`=`threads`+1, `comments`=`comments`+1 where `forumId`=?";
	} else {
	    $query = "update `tiki_forums` set `comments`=`comments`+1 where `forumId`=?";
	}

	$result = $this->query($query,array((int) $forumId));

	$lastPost = $this->getOne("select max(`commentDate`) from
		`tiki_comments`,`tiki_forums` where `object` = ".$this->sql_cast("`forumId`","string").
		"and `objectType` = 'forum' and
		`forumId` = ?", array( (int) $forumId ) );
	$query = "update `tiki_forums` set `lastPost`=? where
	    `forumId`=? ";
	$result = $this->query($query, array( (int) $lastPost, (int) $forumId ));

	$this->forum_prune($forumId);
	return true;
    }

    function register_remove_post($forumId, $parentId) {
	$this->forum_prune($forumId);
	$nb = 1; //TODO: needs to count all the posts depending on this post
	$query = 'update `tiki_forums` set `comments`=`comments`- ?, `threads`=`threads`-1 where `forumId`=?';
	$result = $this->query($query, array((int)$nb, (int)$forumId));
    }

    function forum_add_hit($forumId) {
	global $count_admin_pvs;

	global $user;

	if ($count_admin_pvs == 'y' || $user != 'admin') {
	    $query = "update `tiki_forums` set `hits`=`hits`+1 where
		`forumId`=?";

	    $result = $this->query($query, array( (int) $forumId ) );
	    $this->forum_prune($forumId);
	}

	return true;
    }

    function comment_add_hit($threadId) {
	global $count_admin_pvs;

	global $user;

	if ($count_admin_pvs == 'y' || $user != 'admin') {
	    $query = "update `tiki_comments` set `hits`=`hits`+1 where
		`threadId`=?";

	    $result = $this->query($query, array( (int) $threadId ) );
	    //$this->forum_prune($forumId);
	}

	return true;
    }

    function forum_prune($forumId) {
	$forum = $this->get_forum($forumId);

	if ($forum["usePruneUnreplied"] == 'y') {
	    $age = $forum["pruneUnrepliedAge"];

	    // Get all unreplied threads
	    // Get all the top_level threads
	    $now = date("U");
	    $oldage = $now - $age;
	    $query = "select `threadId` from `tiki_comments` where
	    `parentId`=0  and `commentDate`<? and `object`=? and `objectType` = 'forum'";
	    $result = $this->query($query, array( (int) $oldage, $forumId ));

	    while ($res = $result->fetchRow()) {
		// Check if this old top level thread has replies
		$id = $res["threadId"];
		if ($id == 0)
			continue;	// in the case there is an error ...

		$query2 = "select count(*) from `tiki_comments`
		    where `parentId`=?";
		$cant = $this->getOne($query2, array( (int) $id ));

		if ($cant == 0) {
		    // Remove this old thread without replies
		    $query3 = "delete from `tiki_comments` where
			`threadId` = ?";

		    $result3 = $this->query($query3, array( (int) $id ));
		}
	    }
	}

	if ($forum["usePruneOld"] == 'y') { // this is very dangerous as you can delete some posts in the middle or root of a tree strucuture
	    $maxAge = $forum["pruneMaxAge"];

	    $old = date("U") - $maxAge;
	    $query = "delete from `tiki_comments` where `object`=?
		and `objectType` = 'forum' and `commentDate`<?";
	    $result = $this->query($query, array($forumId, (int) $old));
	}

	if ($forum["usePruneUnreplied"] == 'y' || $forum["usePruneOld"] == 'y') {	// Recalculate comments and threads
		$query = "select count(*) from `tiki_comments` where `objectType` = 'forum' and `object`=?";
		$comments = $this->getOne($query, array( $forumId ) );
		$query = "select count(*) from `tiki_comments` where `objectType` = 'forum' and `object`=? and `parentId`=0";
		$threads = $this->getOne($query, array( $forumId ));
		$query = "update `tiki_forums` set `comments`=?, `threads`=? where `forumId`=?";
		$result = $this->query($query, array( (int) $comments, (int) $threads, (int) $forumId) );
	}
	return true;
    }

    // FORUMS END
    function get_comment($id, $message_id=null) {
	if ($message_id) {
		$query = "select * from `tiki_comments` where `message_id`=?";
		$result = $this->query($query, array($message_id ) );
	}
	else {
		$query = "select * from `tiki_comments` where `threadId`=?";
		$result = $this->query($query, array( (int) $id ) );
	}
	$res = $result->fetchRow();
	if($res) { //if there is a comment with that id
	   $this->add_comments_extras($res);
	}

	return $res;
    }

    function add_comments_extras(&$res) { 
	    // this function adds some extras to the referenced array. 
	    // This array should already contain the contents of the tiki_comments table row
	    // used in $this->get_comment and $this->get_comments

	    $res["parsed"] = $this->parse_comment_data($res["data"]);

	    // these could be cached or probably queried along with the original query of the tiki_comments table
	    $result2=$this->query("select `posts`, `level` from `tiki_user_postings` where `user`=?",
	    	array( $res['userName'] ) );
            $res2=$result2->fetchRow();
	    $res['user_posts'] = $res2['posts'];
	    $res['user_level'] = $res2['level'];

	    if ($this->get_user_preference($res['userName'], 'email is public', 'n') == 'y') {
		$res['user_email'] = $this->getOne("select `email` from
			`users_users` where `login`=?",
			array( $res['userName'] ) );
	    } else {
		$res['user_email'] = '';
	    }

	    $res['attachments'] = $this->get_thread_attachments($res['threadId'], 0);
	    // is the 'is_reported' really used? can be queried with orig table i think
	    $res['is_reported'] = $this->is_reported($res['threadId']);
	    $res['user_online'] = 'n';
	    if ($res['userName']) {
		$res['user_online'] = $this->is_user_online($res['userName'])? 'y' : 'n';
	    }
    }

    function get_comment_father($id) {
	static $cache;
	if ( isset($cache[$id]) ) {
	    return $cache[$id];
	}
	$query = "select `parentId` from `tiki_comments` where `threadId`=?";

	$ret = $this->getOne($query, array( $id ));
	$cache[$id] = $ret;

	return $ret;
    }

    function count_comments($objectId) {
	$object = explode( ":", $objectId, 2);
	if ($object[0] == 'topic') {
		$query = 'select count(*) from `tiki_comments` where `objectType`=? and `parentId`=?';
		$cant = $this->getOne($query, array('forum', $object[1]));
	} else {
		$query = 'select count(*) from `tiki_comments` where `objectType`=? and `object`=?';
		$cant = $this->getOne($query, $object );
	}
	return $cant;
    }

    function count_comments_threads($objectId) {
	$object = explode( ":", $objectId, 2);
	$query = "select count(*) from `tiki_comments` where `objectType`=? and `object`=? and `parentId`=0";
	$cant = $this->getOne($query, $object );
	return $cant;
    }
    function get_comment_replies($id, $sort_mode, $offset, $orig_offset, $maxRecords, $orig_maxRecords, $threshold = 0, $find = '', $message_id = "", $forum = 0 )
    {
	$retval = array();

	if( $maxRecords <= 0 && $orig_maxRecords != 0)
	{
	    $retval['numReplies'] = 0;
	    $retval['totalReplies'] = 0;
	    return $retval;
	}

	if( $forum )
	{
	    $real_id = $message_id;
	} else {
	    $real_id = (int) $id;
	}

	$query = "select `threadId` from `tiki_comments`";

	if( $forum )
	{
	    $query = $query . " where `in_reply_to`=? and `average`>=? ";
	} else {
	    $query = $query . " where `parentId`=? and `average`>=? ";
	}

	if ($find)
	{
	    $findesc = '%' . $find . '%';

	    $query = $query . " and (`title` like ? or `data` like ?) ";
	    $bind=array($real_id, (int) $threshold, $findesc, $findesc);
	} else {
	    $bind=array($real_id, (int) $threshold );
	}

	$query = $query . " order by " . $this->convert_sortmode($sort_mode);

	if($sort_mode != 'commentDate_desc') {
	    $query.=",`commentDate` desc";
	}

	$result = $this->query($query,$bind);


	$ret = array();

	global $userlib;

	while ($res = $result->fetchRow()) {
	    $res = $this->get_comment( $res['threadId'] );

	    /* Trim to maxRecords, including replies! */
	    if( $offset >= 0  && $orig_offset != 0 )
	    {
		$offset = $offset - 1;
	    }
	    $maxRecords = $maxRecords - 1;

	    if( $offset >= 0 && $orig_offset != 0)
	    {
		$res['doNotShow'] = 1;
	    }

	    if( $maxRecords <= 0 && $orig_maxRecords != 0)
	    {
		$ret[] = $res;
		break;
	    }

	    if( $forum )
	    {
		$res['replies_info'] =
		    $this->get_comment_replies($res['parentId'],
			    $sort_mode, $offset, $orig_offset, $maxRecords, $orig_maxRecords, $threshold, $find,
			    $res['message_id'], $forum);
	    } else {
		$res['replies_info'] =
		    $this->get_comment_replies($res['threadId'],
			    $sort_mode, $offset, $orig_offset, $maxRecords, $orig_maxRecords, $threshold, $find);
	    }

	    if( $offset >= 0  && $orig_offset != 0 )
	    {
		$offset = $offset - $res['replies_info']['totalReplies'];
	    }
	    $maxRecords = $maxRecords - $res['replies_info']['totalReplies'];

	    if( $offset >= 0 && $orig_offset != 0)
	    {
		$res['doNotShow'] = 1;
	    }

	    if( $maxRecords <= 0 && $orig_maxRecords != 0)
	    {
		$ret[] = $res;
		break;
	    }

	    $ret[] = $res;
	}

	$retval['replies'] = $ret;

	$retval['numReplies'] = count( $ret );
	$retval['totalReplies'] = $this->total_replies( $ret, count( $ret ) );

	return $retval;
    }

    function total_replies( $reply_array, $seed = 0 )
    {
	$retval = $seed;

	foreach ( $reply_array as $key=>$res )
	{
	    if( is_array( $res ) && array_key_exists( 'replies_info', $res ) )
	    {
		if( array_key_exists( 'numReplies', $res['replies_info'] ) )
		{
		    $retval = $retval + $res['replies_info']['numReplies'];
		}
		$retval = $retval + $this->total_replies( $res['replies_info']['replies'] );
	    }
	}

	return $retval;
    }

    function flatten_comment_replies(&$replies, &$rep_flat, $level = 0)
    {
	$reps = $replies['numReplies'];
	for ($i = 0; $i < $reps; $i++) {
	    $replies['replies'][$i]['level'] = $level;
	    $rep_flat[] = &$replies['replies'][$i];
	    if (isset($replies['replies'][$i]['replies_info'])) {
		$this->flatten_comment_replies(
			$replies['replies'][$i]['replies_info'],
			$rep_flat, $level + 1);
	    }
	}
    }

    function parse_smileys($data) {
	global $feature_smileys;

	if ($feature_smileys == 'y') {
	    $data = preg_replace("/\(:([^:]+):\)/", "<img alt=\"$1\" src=\"img/smiles/icon_$1.gif\" />", $data);
	}

	return $data;
    }

    function pick_cookie() {
	$cant = $this->getOne("select count(*) from `tiki_cookies`",array());

	if (!$cant)
	    return '';

	$bid = rand(0, $cant - 1);
	$cookie = $this->query("select `cookie` from `tiki_cookies`",array(),1,$bid);
	$cookie = str_replace("\n", "", $cookie);
	return 'Cookie: ' . $cookie . '';
    }

    function parse_comment_data($data) {
	global $feature_forum_parse;

	global $tikilib;

	if ($feature_forum_parse == 'y') {
	    return $this->parse_data($data);
	}

	// Cookies
	if (preg_match_all("/\{cookie\}/", $data, $rsss)) {
	    $temp_max = count($rsss[0]);
	    for ($i = 0; $i < $temp_max; $i++) {
		$cookie = $this->pick_cookie();

		$data = str_replace($rsss[0][$i], $cookie, $data);
	    }
	}

	// Fix up special characters, so it can link to pages with ' in them.  -rlpowell
	$data = htmlspecialchars( $data, ENT_QUOTES );
	$data = preg_replace("/\[([^\|\]]+)\|([^\]]+)\]/", '<a class="commentslink" href="$1">$2</a>', $data);
	// Segundo intento reemplazar los [link] comunes
	$data = preg_replace("/\[([^\]\|]+)\]/", '<a class="commentslink" href="$1">$1</a>', $data);

	// Llamar aqui a parse smileys
	$data = $this->parse_smileys($data);
	$data = preg_replace("/---/", "<hr/>", $data);
	// Reemplazar --- por <hr/>
	return nl2br($data);
    }

    /*****************/
    function set_time_control($time) {
	$this->time_control = $time;
    }

    function get_comments($objectId, $parentId, $offset = 0, $maxRecords = -1,
	    $sort_mode = 'commentDate_asc', $find = '', $threshold = 0, $style = 'commentStyle_threaded', $reply_threadId=0)
    {
	global $userlib;
	// Turn maxRecords into maxRecords + offset, so we can increment it without worrying too much.
	$maxRecords = $offset + $maxRecords;

	$orig_maxRecords = $maxRecords;
	$orig_offset = $offset;

	if ($sort_mode == 'points_asc') {
	    $sort_mode = 'average_asc';
	}

	if ($this->time_control) {
	    $limit = date("U") - $this->time_control;

	    $time_cond = " and `commentDate` > ? ";
	    $bind_time = array($limit);
	} else {
	    $time_cond = '';
	    $bind_time = array();
	}

	$old_sort_mode = '';

	if (in_array($sort_mode, array(
			'replies_desc',
			'replies_asc'
			))) {
	    $old_offset = $offset;

	    $old_maxRecords = $maxRecords;
	    $old_sort_mode = $sort_mode;
	    $sort_mode = 'title_desc';
	    $offset = 0;
	    $maxRecords = -1;
	}

	// Break out the type and object parameters.
	$object = explode( ":", $objectId, 2);

	$query = "select count(*) from `tiki_comments` where
	    `objectType`=? and `object`=? and `average` < ? $time_cond";
	$below = $this->getOne($query, array_merge(
		    array($object[0], $object[1], (float) $threshold), $bind_time) );

	if ($find) {
	    $findesc = '%' . $find . '%';

	    $mid = " where tc1.`objectType` = ? and tc1.`object`=? and
		tc1.`parentId`=? and tc1.`average`>=? and (tc1.`title`
			like ? or tc1.`data` like ?) ";
	    $bind_mid=array($object[0],  $object[1],  (int) $parentId,
		    (int) $threshold, $findesc, $findesc);
	} else {
	    $mid = " where tc1.`objectType` = ? and tc1.`object`=? and tc1.`parentId`=? and tc1.`average`>=? ";
	    $bind_mid=array($object[0], $object[1], (int) $parentId, (int) $threshold);
	}

	if( $object[0] == "forum" && $style != 'commentStyle_plain' )
	{
	    $query = "select `message_id` from `tiki_comments` where `threadId` = ?";
	    $parent_message_id = $this->getOne($query, array( $parentId ) );

	    $query = "select tc1.`threadId`, tc1.`object`, tc1.`objectType`, tc1.`parentId`, tc1.`userName`, tc1.`commentDate`, tc1.`hits`, tc1.`type`, tc1.`points`, tc1.`votes`, tc1.`average`, tc1.`title`, tc1.`data`, tc1.`hash`, tc1.`user_ip`, tc1.`summary`, tc1.`smiley`, tc1.`message_id`, tc1.`in_reply_to`, tc1.`comment_rating`  from `tiki_comments` as tc1
		left outer join `tiki_comments` as tc2 on tc1.`in_reply_to` = tc2.`message_id`
		and tc1.`parentId` = ?
		and tc2.`parentId` = ?
		$mid 
		and (tc1.`in_reply_to` = ?
		or (tc2.`in_reply_to` = \"\" or tc2.`in_reply_to` is null or tc2.message_id is null or tc2.parentid = 0))
		$time_cond order by tc1.".$this->convert_sortmode($sort_mode).",tc1.`threadId`";
		$bind_mid_cant = $bind_mid;
		$bind_mid = array_merge(array($parentId,$parentId), $bind_mid, array($parent_message_id));

		$query_cant = "select count(*) from `tiki_comments` as tc1 $mid $time_cond";
	} else {
	    $query_cant = "select count(*) from `tiki_comments` as tc1 $mid $time_cond";
	    $query = "select * from `tiki_comments` as tc1 $mid $time_cond order by tc1.".$this->convert_sortmode($sort_mode).",`threadId`";
	    $bind_mid_cant = $bind_mid;
	}

	$ret = array();
	$logins = array();
	$threadIds = array();

//	if ($parentId > 0 && $style == 'commentStyle_threaded' && $object[0] != "forum") {
	if ($reply_threadId > 0 && $style == 'commentStyle_threaded') {
		$ret[] = $this->get_comments_fathers($reply_threadId, $ret);
		$cant = 1;
	} else {
		$result = $this->query($query,array_merge($bind_mid,$bind_time));
		$cant = $this->getOne($query_cant,array_merge($bind_mid_cant,$bind_time));
		while ( $row = $result->fetchRow() ) {
			$this->add_comments_extras($row);
			$ret[] = $row;
		}
	}

//	print "<pre>query: ";
//	print_r($query_cant);
//	print "\n,";
//	print_r(array_merge($bind_mid,$bind_time));
//	print "\n,";
//	print_r($cant);
//	print "</pre>";

	foreach ( $ret as $key=>$res )
	{
	    if( $offset > 0  && $orig_offset != 0 )
	    {
		$ret[$key]['doNotShow'] = 1;
	    }

	    if( $maxRecords <= 0  && $orig_maxRecords != 0 )
	    {
		array_splice( $ret, $key );
		break;
	    }

	    // Get the grandfather
	    if ($res["parentId"] > 0) {
		$ret[$key]["grandFather"] = $this->get_comment_father($res["parentId"]);
	    } else {
		$ret[$key]["grandFather"] = 0;
	    }

	    /* Trim to maxRecords, including replies! */
	    if( $offset >= 0  && $orig_offset != 0 )
	    {
		$offset = $offset - 1;
	    }
	    $maxRecords = $maxRecords - 1;

	    if( !( $maxRecords <= 0  && $orig_maxRecords != 0 ) )
	    {
		// Get the replies
		if ($parentId == 0 || $style != 'commentStyle_threaded' || $object[0] == "forum")
		{
		    if( $object[0] == "forum" )
		    {
			// For plain style, don't handle replies at all.
			if( $style == 'commentStyle_plain' )
			{
			    $ret[$key]['replies_info']['numReplies'] = 0;
			    $ret[$key]['replies_info']['totalReplies'] = 0;
			} else {
			    $ret[$key]['replies_info'] = $this->get_comment_replies($res["parentId"], $sort_mode, $offset, $orig_offset, $maxRecords, $orig_maxRecords, $threshold, $find, $res["message_id"], 1);
			}
		    } else {
			$ret[$key]['replies_info'] = $this->get_comment_replies($res["threadId"], $sort_mode, $offset, $orig_offset, $maxRecords, $orig_maxRecords, $threshold, $find );
		    }

		    /* Trim to maxRecords, including replies! */
		    if( $offset >= 0  && $orig_offset != 0 )
		    {
			$offset = $offset - $ret[$key]['replies_info']['totalReplies'];
		    }
		    $maxRecords = $maxRecords - $ret[$key]['replies_info']['totalReplies'];
		}
	    }

	    if (empty($res["data"])) {
		$ret[$key]["isEmpty"] = 'y';
	    } else {
		$ret[$key]["isEmpty"] = 'n';
	    }
	}

	if ($old_sort_mode == 'replies_asc') {
	    usort($ret, 'compare_replies');
	}

	if ($old_sort_mode == 'replies_desc') {
	    usort($ret, 'r_compare_replies');
	}

	if (in_array($old_sort_mode, array(
			'replies_desc',
			'replies_asc',
			))) {
	    $ret = array_slice($ret, $old_offset, $old_maxRecords);
	}

	$retval = array();
	$retval["data"] = $ret;
	$retval["below"] = $below;
	$retval["cant"] = $cant;

	$msgs = count($retval['data']);
	for ($i = 0; $i < $msgs; $i++) {
	    $r = &$retval['data'][$i]['replies_info'];
	    $retval['data'][$i]['replies_flat'] = array();
	    $rf = &$retval['data'][$i]['replies_flat'];
	    $this->flatten_comment_replies($r, $rf);
	}

	return $retval;
    }

	/* @brief: gets the comments of the thread and of all its fathers (ex cept first one for forum)
 	*/
	function get_comments_fathers($threadId, $ret = null, $message_id = null) {
		$com = $this->get_comment($threadId, $message_id);

		if ($com['objectType'] == 'forum' && $com['parentId'] == 0 ) {// don't want the 1 level
			return $ret;
		}
		if ($ret) {
			$com['replies_info']['replies'][0] = $ret;
			$com['replies_info']['numReplies'] = 1;
			$com['replies_info']['totalReplies'] = 1;
		}
		if ($com['objectType'] == 'forum' && $com['in_reply_to']) {
			return $this->get_comments_fathers(null, $com, $com['in_reply_to']);
		}
		else if ($com['parentId'] > 0) {
			return $this->get_comments_fathers($com['parentId'], $com);
		}
		else{
			return $com;
		}
	}

    function lock_comment($threadId) {
	$query = "update `tiki_comments`
	    set `type`='l' where `threadId`=?";

	$this->query($query, array( (int) $threadId ) );
    }

    function set_comment_object($threadId, $objectId) {
	// Break out the type and object parameters.
	$object = explode( ":", $objectId, 2);

	$query = "update `tiki_comments`
	    set `objectType` = ?, `object`=? where `threadId`=? or
	    `parentId`=?";
	$this->query($query, array( $object[0], $object[1],
		    (int) $threadId, (int) $threadId ) );
    }

    function set_parent($threadId, $parentId) {
	$query = "select `message_id` from `tiki_comments` where `threadId` = ?";
	$parent_message_id = $this->getOne($query, array( $parentId ) );

	$query = "update `tiki_comments`
	    set `parentId`=?, `in_reply_to`=? where `threadId`=?";

	$this->query($query, array( (int) $parentId, $parent_message_id, (int) $threadId ) );
    }

    function unlock_comment($threadId) {
	$query = "update `tiki_comments`
	    set `type`='n' where `threadId`=?";

	$this->query($query, array( (int) $threadId ) );
    }

    function update_comment($threadId, $title, $comment_rating, $data, $type = 'n', $summary = '', $smiley = '') {
	$query = "update `tiki_comments` set `title`=?, `comment_rating`=?,
	`data`=?, `type`=?, `summary`=?, `smiley`=?
	    where `threadId`=?";
	$result = $this->query($query, array( $title, (int) $comment_rating, $data, $type,
		    $summary, $smiley, (int) $threadId ) );
    }

    function post_new_comment($objectId, $parentId, $userName,
	    $title, $data, &$message_id, $in_reply_to = '', $type = 'n',
	    $summary = '', $smiley = ''
	    )
    {
	if (!$userName) {
	    $_SESSION["lastPost"] = date("U");
	}

	if (!isset($_SERVER['REMOTE_ADDR']))
	    $_SERVER['REMOTE_ADDR'] = '127.0.0.1';

	// Check for banned userName or banned IP or IP in banned range

	// Check for duplicates.
	$title = strip_tags($title);

	if (!$userName) {
	    $userName = tra('Anonymous');
	} else {
	    $now = (int) date("U");

	    if ($this->getOne("select count(*) from 
			`tiki_user_postings` where `user`=?",
			array( $userName ),false))
	    {
		$query = "update `tiki_user_postings` ".
		    "set `last`=?, `posts` = `posts` + 1 where `user`=?";

		$this->query($query, array( $now, $userName ) );
	    } else {
		$posts = $this->getOne("select count(*) ".
			"from `tiki_comments` where `userName`=?",
			array( $userName),false);

		if (!$posts)
		    $posts = 1;

		$query = "insert into 
		    `tiki_user_postings`(`user`,`first`,`last`,`posts`) 
		    values( ?, ?, ?, ? )";
		$this->query($query,  array($userName, (int) $now, (int) $now,(int) $posts) );
	    }

	    // Calculate max
	    $max = $this->getOne("select max(`posts`) from `tiki_user_postings`",array());
	    $min = $this->getOne("select min(`posts`) from `tiki_user_postings`",array());

	    if ($min == 0)
		$min = 1;

	    $ids = $this->getOne("select count(*) from `tiki_user_postings`",array());
	    $tot = $this->getOne("select sum(`posts`) from `tiki_user_postings`",array());
	    $average = $tot / $ids;
	    $range1 = ($min + $average) / 2;
	    $range2 = ($max + $average) / 2;

	    $posts = $this->getOne("select `posts` ".
		    "from `tiki_user_postings` where `user`=?",
		    array($userName),false);

	    if ($posts == $max) {
		$level = 5;
	    } elseif ($posts > $range2) {
		$level = 4;
	    } elseif ($posts > $average) {
		$level = 3;
	    } elseif ($posts > $range1) {
		$level = 2;
	    } else {
		$level = 1;
	    }

	    $query = "update `tiki_user_postings` ".
		"set `level`=? where `user`=?";
	    $this->query($query, array( $level, $userName ) );
	}

	$hash = md5($title . $data);
	$query = "select `threadId` from `tiki_comments` where `hash`=?";
	$result = $this->query($query, array( $hash ) );

	// print( "<pre>result:" );
	// print_r( $result );
	// print( "</pre>" );

	// Check if we were passed a message-id.
	if ( ! $message_id )
	{
	    // Construct a message id via proctological
	    // extraction.  -rlpowell
	    $message_id = $userName . "-" .
		$parentId . "-" .
		substr( $hash, 0, 10 ) .
		"@" . $_SERVER["SERVER_NAME"];
	}

	// If this post was not already found.
	if (!$result->numRows())
	{
	    $now = (int) date("U");

	    // Break out the type and object parameters.
	    $object = explode( ":", $objectId, 2);

	    $query = "insert into
		`tiki_comments`(`objectType`, `object`,
			`commentDate`, `userName`, `title`, `data`, `votes`,
			`points`, `hash`, `parentId`, `average`, `hits`,
			`type`, `summary`, `smiley`, `user_ip`,
			`message_id`, `in_reply_to`)
		values ( ?, ?, ?, ?, ?, ?,
			0, 0, ?, ?, 0, 0, ?, ?, 
			?, ?, ?, ?)";
	    $result = $this->query($query, 
		    array( $object[0], (string) $object[1],(int) $now, $userName,
			$title, $data, $hash, (int) $parentId, $type,
			$summary, $smiley, $_SERVER["REMOTE_ADDR"],
			$message_id, $in_reply_to)
		    );
	} else {
			global $smarty;
			$smarty->assign('msg', tra("Another post with the same title and content already exists"));
			$smarty->display("error.tpl");
			die;
	}	

	$threadId = $this->getOne("select `threadId` from
		`tiki_comments` where `hash`=?", array( $hash ) );

	/* Force an index refresh of the data */
	include_once("lib/search/refresh-functions.php");
	refresh_index_comments( $threadId );

	return $threadId;
	//return $return_result;
    }

    // Check if a particular topic exists.
    function check_for_topic( $title, $data )
    {
	$hash = md5($title . $data);

	$threadId = $this->getOne("select `threadId` from
		`tiki_comments` where `hash`=?", array( $hash ) );
	return $threadId;
    }

    function remove_comment($threadId) {
	if ($threadId == 0)
		return false;
	$query = "delete from `tiki_comments` where `threadId`=? or `parentId`=?";

	$result = $this->query($query, array( (int) $threadId, (int) $threadId ) );
	$query = "delete from `tiki_forum_attachments` where `threadId`=?";
	$this->query($query, array( (int) $threadId ) );
	$this->remove_reported($threadId);
	$query = "delete from `tiki_user_watches` where `event`=? and `object`=?";
	$this->query($query,array('forum_post_thread', $threadId));
	$this->remove_object('forum post', $threadId);
	return true;
    }

    function vote_comment($threadId, $user, $vote) {

	// Select user points for the user who is voting (it may be anonymous!)
	$query = "select `points`,`voted` from `tiki_userpoints` where `user`=?";

	$result = $this->query($query, array( $user ) );

	if ($result->numRows()) {
	    $res = $result->fetchRow();

	    $user_points = $res["points"];
	    $user_voted = $res["voted"];
	} else {
	    $user_points = 0;

	    $user_voted = 0;
	}

	// Calculate vote weight (the Karma System)
	if ($user_voted == 0) {
	    $user_weight = 1;
	} else {
	    $user_weight = $user_points / $user_voted;
	}

	$vote_weight = ($vote * $user_weight) / 5;
	//print("User weight: $user_weight<br />");
	//print("Vote: $vote vote_weight: $vote_weight<br />");

	// Get the user that posted the comment being voted
	$query = "select `userName` from `tiki_comments` where `threadId`=?";
	$comment_user = $this->getOne($query, array( (int) $threadId ) );

	if ($comment_user && ($comment_user == $user)) {
	    // The user is voting a comment posted by himself then bail out
	    return false;
	}

	//print("Comment user: $comment_user<br />");
	if ($comment_user) {
	    // Update the user points adding this new vote
	    $query = "select `user` from `tiki_userpoints` where `user`=?";

	    $result = $this->query($query, array( $comment_user ) );

	    if ($result->numRows()) {
		$query = "update `tiki_userpoints`
		    set `points` = `points` + ?, `voted`=`voted`+1
		    where `user`=?";
		$result = $this->query($query, array( $vote, $user ) );
	    } else {
		$query = "insert into
		    `tiki_userpoints`(`user`,`points`,`voted`)
		    values( ?, ?, 1 )";
		$result = $this->query($query, array( $comment_user, $vote ) );
	    }
	}

	$query = "update `tiki_comments`
	    set `points` = `points` + ?, `votes` = `votes`+1
	    where `threadId`=?";
	$result = $this->query($query, array( $vote_weight, $threadId ) );
	$query = "update `tiki_comments` set `average` = `points`/`votes`
	    where `threadId`=?";
	$result = $this->query($query, array( $threadId ) );
	return true;
    }
}

function compare_replies($ar1, $ar2) {
    if (($ar1['type'] == 's' && $ar2['type'] == 's') ||
	    ($ar1['type'] != 's' && $ar2['type'] != 's')) {
	return $ar1["replies_info"]["numReplies"] - $ar2["replies_info"]["numReplies"];
    } else {
	return $ar1['type'] == 's' ? -1 : 1;
    }
}

function compare_lastPost($ar1, $ar2) {
    if (($ar1['type'] == 's' && $ar2['type'] == 's') ||
	    ($ar1['type'] != 's' && $ar2['type'] != 's')) {
	return $ar1["lastPost"] - $ar2["lastPost"];
    } else {
	return $ar1['type'] == 's' ? -1 : 1;
    }
}

function r_compare_replies($ar1, $ar2) {
    if (($ar1['type'] == 's' && $ar2['type'] == 's') ||
	    ($ar1['type'] != 's' && $ar2['type'] != 's')) {
	return $ar2["replies_info"]["numReplies"] - $ar1["replies_info"]["numReplies"];
    } else {
	return $ar1['type'] == 's' ? -1 : 1;
    }
}

function r_compare_lastPost($ar1, $ar2) {
    if (($ar1['type'] == 's' && $ar2['type'] == 's') ||
	    ($ar1['type'] != 's' && $ar2['type'] != 's')) {
	return $ar2["lastPost"] - $ar1["lastPost"];
    } else {
	return $ar1['type'] == 's' ? -1 : 1;
    }
}

?>
