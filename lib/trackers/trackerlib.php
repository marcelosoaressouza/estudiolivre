<?php
// $Header: /cvsroot/tikiwiki/tiki/lib/trackers/trackerlib.php,v 1.97.2.142 2007/12/10 04:28:34 kerrnel22 Exp $
//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

global $notificationlib; include_once ('lib/notifications/notificationlib.php');

class TrackerLib extends TikiLib {

	var $trackerinfo_cache;

	// allowed types for image fields
	var $imgMimeTypes;
	var $imgMaxSize;

	function TrackerLib($db) {
		parent::TikiLib($db);

		$this->imgMimeTypes = array('image/jpeg', 'image/gif', 'image/png', 'image/pjpeg');
		$this->imgMaxSize = (1048576 * 4); // 4Mo
	}

	// check that the image type is good
	function check_image_type($mimeType) {
		return in_array( $mimeType, $this->imgMimeTypes );
	}

	function get_image_filename($imageFileName, $itemId, $fieldId) {
		return $file_name = 'img/trackers/'.md5( "$imageFileName.$itemId.$fieldId" );
	}

	function remove_field_images($fieldId) {
		$query = 'select `value` from `tiki_tracker_item_fields` where `fieldId`=?';
		$result = $this->query( $query, array((int)$fieldId) );
		while( $r = $result->fetchRow() ) {
			if( file_exists($r['value']) ) {
				unlink( $r['value'] );
			}
		}
	}

	function add_item_attachment_hit($id) {
		global $count_admin_pvs, $user;
		if ($user != 'admin' || $count_admin_pvs == 'y' ) {
			$query = "update `tiki_tracker_item_attachments` set `downloads`=`downloads`+1 where `attId`=?";
			$result = $this->query($query,array((int) $id));
		}
		return true;
	}

	function get_item_attachment_owner($attId) {
		return $this->getOne("select `user` from `tiki_tracker_item_attachments` where `attId`=?",array((int) $attId));
	}

	function list_item_attachments($itemId, $offset, $maxRecords, $sort_mode, $find) {
		if ($find) {
			$findesc = '%' . $find . '%';
			$mid = " where `itemId`=? and (`filename` like ?)";
			$bindvars=array((int) $itemId,$findesc);
		} else {
			$mid = " where `itemId`=? ";
			$bindvars=array((int) $itemId);
		}
		$query = "select `user`,`attId`,`itemId`,`filename`,`filesize`,`filetype`,`downloads`,`created`,`comment`,`longdesc`,`version` ";
		$query.= " from `tiki_tracker_item_attachments` $mid order by ".$this->convert_sortmode($sort_mode);
		$query_cant = "select count(*) from `tiki_tracker_item_attachments` $mid";
		$result = $this->query($query,$bindvars,$maxRecords,$offset);
		$cant = $this->getOne($query_cant,$bindvars);
		$ret = array();

		while ($res = $result->fetchRow()) {
			$ret[] = $res;
		}

		$retval = array();
		$retval["data"] = $ret;
		$retval["cant"] = $cant;
		return $retval;
	}

	function get_item_nb_attachments($itemId) {
		$query = "select sum(downloads) as downloads, count(*) as attachments from `tiki_tracker_item_attachments` where `itemId`=?";
		$result = $this->query($query, array($itemId));
		if ($res = $result->fetchRow())
			return $res;
		return array();
	}

	function get_item_nb_comments($itemId) {
		return $this->getOne('select count(*) from `tiki_tracker_item_comments` where `itemId`=?', array((int)$itemId));
	}

	function list_all_attachements($offset=0, $maxRecords=-1, $sort_mode='created_desc', $find='') {
		if ($find) {
			$findesc = '%' . $find . '%';
			$mid = " where `filename` like ?";
			$bindvars=array($findesc);
		} else {
			$mid = "";
			$bindvars=array();
		}
		$query = "select `user`,`attId`,`itemId`,`filename`,`filesize`,`filetype`,`downloads`,`created`,`comment`,`path` ";
		$query.= " from `tiki_tracker_item_attachments` $mid order by ".$this->convert_sortmode($sort_mode);
		$query_cant = "select count(*) from `tiki_tracker_item_attachments` $mid";
		$result = $this->query($query,$bindvars,$maxRecords,$offset);
		$cant = $this->getOne($query_cant,$bindvars);
		$ret = array();
		while ($res = $result->fetchRow()) {
			$ret[] = $res;
		}
		$retval = array();
		$retval["data"] = $ret;
		$retval["cant"] = $cant;
		return $retval;
	}

	function file_to_db($path,$attId) {
		if (is_file($path)) {
			$fp = fopen($path,'rb');
			$data = '';
			while (!feof($fp)) {
				$data .= fread($fp, 8192 * 16);
			}
			fclose ($fp);
			$query = "update `tiki_tracker_item_attachments` set `data`=?,`path`=? where `attId`=?";
			if ($this->query($query,array($data,'',(int)$attId))) {
				unlink($path);
			}
		}
	}

	function db_to_file($path,$attId) {
		$fw = fopen($path,'wb');
		$data = $this->getOne("select `data` from `tiki_tracker_item_attachments` where `attId`=?",array((int)$attId));
		if ($data) {
			fwrite($fw, $data);
		}
		fclose ($fw);
		if (is_file($path)) {
			$query = "update `tiki_tracker_item_attachments` set `data`=?,`path`=? where `attId`=?";
			$this->query($query,array('',basename($path),(int)$attId));
		}
	}

	function item_attach_file($itemId, $name, $type, $size, $data, $comment, $user, $fhash, $version, $longdesc) {
		$comment = strip_tags($comment);
		$now = date("U");
		$query = "insert into `tiki_tracker_item_attachments`(`itemId`,`filename`,`filesize`,`filetype`,`data`,`created`,`downloads`,`user`,";
		$query.= "`comment`,`path`,`version`,`longdesc`) values(?,?,?,?,?,?,?,?,?,?,?,?)";
		$result = $this->query($query,array((int) $itemId,$name,$size,$type,$data,(int) $now,0,$user,$comment,$fhash,$version,$longdesc));
	}

	function get_item_attachment($attId) {
		$query = "select * from `tiki_tracker_item_attachments` where `attId`=?";
		$result = $this->query($query,array((int) $attId));
		if (!$result->numRows()) return false;
		$res = $result->fetchRow();
		return $res;
	}

	function remove_item_attachment($attId) {
		global $t_use_dir;
		$path = $this->getOne("select `path` from `tiki_tracker_item_attachments` where `attId`=?",array((int) $attId));
		if ($path) @unlink ($t_use_dir . $path);
		$query = "delete from `tiki_tracker_item_attachments` where `attId`=?";
		$result = $this->query($query,array((int) $attId));
	}

	function replace_item_attachment($attId, $filename, $type, $size, $data, $comment, $user, $fhash, $version, $longdesc) {
		$comment = strip_tags($comment);
		if (empty($filename)) {
			$query = "update `tiki_tracker_item_attachments` set `comment`=?,`user`=?,`version`=?,`longdesc`=? where `attId`=?";
			$result = $this->query($query,array($comment, $user, $version, $longdesc, $attId));
		} else {
			global $t_use_dir;
			$path = $this->getOne("select `path` from `tiki_tracker_item_attachments` where `attId`=?",array((int) $attId));
			if ($path) @unlink ($t_use_dir . $path);
			$query = "update `tiki_tracker_item_attachments` set `filename`=?,`filesize`=?,`filetype`=?, `data`=?,`comment`=?,`user`=?,`path`=?, `version`=?,`longdesc`=? where `attId`=?";
			$result = $this->query($query,array($filename, $size, $type, $data, $comment, $user, $fhash, $version, $longdesc, (int)$attId));
		}
	}

	function replace_item_comment($commentId, $itemId, $title, $data, $user) {
		global $smarty;
		global $notificationlib;
		global $sender_email;
		$title = strip_tags($title);
		$data = strip_tags($data, "<a>");

		if ($commentId) {
			$query = "update `tiki_tracker_item_comments` set `title`=?, `data`=? , `user`=? where `commentId`=?";

			$result = $this->query($query,array($title,$data,$user,(int) $commentId));
		} else {
			$now = date("U");

			$query = "insert into `tiki_tracker_item_comments`(`itemId`,`title`,`data`,`user`,`posted`) values (?,?,?,?,?)";
			$result = $this->query($query,array((int) $itemId,$title,$data,$user,(int) $now));
			$commentId
				= $this->getOne("select max(`commentId`) from `tiki_tracker_item_comments` where `posted`=? and `title`=? and `itemId`=?",array((int) $now,$title,(int)$itemId));
		}

		$trackerId = $this->getOne("select `trackerId` from `tiki_tracker_items` where `itemId`=?",array((int) $itemId));
		$trackerName = $this->getOne("select `name` from `tiki_trackers` where `trackerId`=?",array((int) $trackerId));
		$emails = $notificationlib->get_mail_events('tracker_modified', $trackerId);
		$emails2 = $notificationlib->get_mail_events('tracker_item_modified', $itemId);
		$emails = array_merge($emails, $emails2);
		if (count($emails > 0)) {
			$smarty->assign('mail_date', date("U"));
			$smarty->assign('mail_user', $user);
			$smarty->assign('mail_action', 'New comment added for item:' . $itemId . ' at tracker ' . $trackerName);
			$smarty->assign('mail_data', $title . "\n\n" . $data);
			$smarty->assign('mail_itemId', $itemId);
			$smarty->assign('mail_trackerId', $trackerId);
			$smarty->assign('mail_trackerName', $trackerName);
			$foo = parse_url($_SERVER["REQUEST_URI"]);
			$machine = $this->httpPrefix(). $foo["path"];
			$smarty->assign('mail_machine', $machine);
			$parts = explode('/', $foo['path']);
			if (count($parts) > 1)
				unset ($parts[count($parts) - 1]);
			$smarty->assign('mail_machine_raw', $this->httpPrefix(). implode('/', $parts));
			if (!isset($_SERVER["SERVER_NAME"])) {
				$_SERVER["SERVER_NAME"] = $_SERVER["HTTP_HOST"];
			}
			include_once ('lib/webmail/tikimaillib.php');
			$mail = new TikiMail();
			$smarty->assign('server_name', $_SERVER['SERVER_NAME']);
			$mail->setSubject($smarty->fetch('mail/tracker_changed_notification_subject.tpl'));
			$mail_data = $smarty->fetch('mail/tracker_changed_notification.tpl');
			$mail->setText($mail_data);
			$mail->setHeader("From", $sender_email);
			$mail->send($emails);
		}

		return $commentId;
	}

	function remove_item_comment($commentId) {
		$query = "delete from `tiki_tracker_item_comments` where `commentId`=?";
		$result = $this->query($query,array((int) $commentId));
	}

	function list_item_comments($itemId, $offset, $maxRecords, $sort_mode, $find) {
		if ($find) {
			$findesc = '%' . $find . '%';
			$mid = " and (`title` like ? or `data` like ?)";
			$bindvars = array((int) $itemId,$findesc,$findesc);
		} else {
			$mid = "";
			$bindvars = array((int) $itemId);
		}

		$query = "select * from `tiki_tracker_item_comments` where `itemId`=? $mid order by ".$this->convert_sortmode($sort_mode);
		$query_cant = "select count(*) from `tiki_tracker_item_comments` where `itemId`=? $mid";
		$result = $this->query($query,$bindvars,$maxRecords,$offset);
		$cant = $this->getOne($query_cant,$bindvars);
		$ret = array();

		while ($res = $result->fetchRow()) {
			$res["parsed"] = nl2br($res["data"]);

			$ret[] = $res;
		}

		$retval = array();
		$retval["data"] = $ret;
		$retval["cant"] = $cant;
		return $retval;
	}

	function list_last_comments($trackerId = 0, $itemId = 0, $offset, $maxRecords) {
	    $mid = "1=1";
	    $bindvars = array();

	    if ($itemId != 0) {
		$mid .= " and `itemId`=?";
		$bindvars[] = (int) $itemId;
	    }

	    if ($trackerId != 0) {
		$query = "select t.* from `tiki_tracker_item_comments` t left join `tiki_tracker_items` a on t.`itemId`=a.`itemId` where $mid and a.`trackerId`=? order by t.`posted` desc";
		$bindvars[] = $trackerId;
		$query_cant = "select count(*) from `tiki_tracker_item_comments` t left join `tiki_tracker_items` a on t.`itemId`=a.`itemId` where $mid and a.`trackerId`=? order by t.`posted` desc";
	    }
	    else {
		$query = "select * from `tiki_tracker_item_comments` where $mid order by `posted` desc";
		$query_cant = "select count(*) from `tiki_tracker_item_comments` where $mid";
	    }
	    $result = $this->query($query,$bindvars,$maxRecords,$offset);
	    $cant = $this->getOne($query_cant,$bindvars);
	    $ret = array();

	    while ($res = $result->fetchRow()) {
		$res["parsed"] = nl2br($res["data"]);
		$ret[] = $res;
	    }

	    $retval = array();
	    $retval["data"] = $ret;
	    $retval["cant"] = $cant;

	    return $retval;
	}


	function get_item_comment($commentId) {
		$query = "select * from `tiki_tracker_item_comments` where `commentId`=?";
		$result = $this->query($query,array((int) $commentId));
		if (!$result->numRows()) return false;
		$res = $result->fetchRow();
		return $res;
	}

	function get_last_position($id) {
		return $this->getOne("select max(`position`) from `tiki_tracker_fields` where `trackerId` = ?",array((int)$id));
	}

	function get_tracker_item($itemid) {
		$query = "select * from `tiki_tracker_items` where `itemId`=?";

		$result = $this->query($query,array((int) $itemid));

		if (!$result->numrows())
			return false;

		$res = $result->fetchrow();
		$query = "select * from `tiki_tracker_item_fields` ttif, `tiki_tracker_fields` ttf where ttif.`fieldId`=ttf.`fieldId` and `itemId`=?";
		$result = $this->query($query,array((int) $itemid));
		$fields = array();

		while ($res2 = $result->fetchrow()) {
			$id = $res2["fieldId"];
			$res["$id"] = $res2["value"];
		}

		return $res;
	}

	function get_item_id($trackerId,$fieldId,$value) {
		$query = "select distinct ttif.`itemId` from `tiki_tracker_items` tti, `tiki_tracker_fields` ttf, `tiki_tracker_item_fields` ttif ";
		$query.= " where tti.`trackerId`=ttf.`trackerId` and ttif.`fieldId`=ttf.`fieldId` and ttf.`trackerId`=? and ttf.`fieldId`=? and ttif.`value`=?";
		$ret = $this->getOne($query,array((int) $trackerId,(int)$fieldId,$value));
		return $ret;
	}

	function get_item($trackerId,$fieldId,$value) {
		$itemId = $this->get_item_id($trackerId,$fieldId,$value);
		return $this->get_tracker_item($itemId);
	}

	/* experimental shared */
	function get_item_value($trackerId,$itemId,$fieldId) {
		$query = "select ttif.`value` from `tiki_tracker_items` tti, `tiki_tracker_fields` ttf, `tiki_tracker_item_fields` ttif ";
		$query.= " where tti.`trackerId`=ttf.`trackerId` and ttif.`fieldId`=ttf.`fieldId` and ttf.`trackerId`=? and ttf.`fieldId`=? and ttif.`itemId`=?";
		return $this->getOne($query,array((int) $trackerId,(int)$fieldId,(int)$itemId));
	}

	/* experimental shared */
	function get_items_list($trackerId,$fieldId,$value,$status='o') {
		$query = "select distinct ttif.`itemId` from `tiki_tracker_items` tti, `tiki_tracker_fields` ttf, `tiki_tracker_item_fields` ttif ";
		$query.= " where tti.`trackerId`=ttf.`trackerId` and ttif.`fieldId`=ttf.`fieldId` and ttf.`trackerId`=? and ttf.`fieldId`=? and ttif.`value`=? and tti.`status`=?";
		$result = $this->query($query,array((int) $trackerId,(int)$fieldId,$value,$status));
		$ret = array();
		while ($res = $result->fetchRow()) {
			$ret[] = $res['itemId'];
		}
		return $ret;
	}

	function get_all_items($trackerId,$fieldId,$status='o') {
		global $cachelib;
		$sort_mode = "value_asc";
		$cache = 'trackerfield'.$trackerId.'-'.$fieldId.$status;
		if (!$cachelib->isCached($cache)) {
			$sts = preg_split('//', $status, -1, PREG_SPLIT_NO_EMPTY);
			$mid = " and (".implode('=? or ',array_fill(0,count($sts),'tti.`status`'))."=?) ";
			$bindvars = array_merge(array((int)$fieldId),$sts);
			$query = "select ttif.`itemId` , ttif.`value` FROM `tiki_tracker_items` tti,`tiki_tracker_item_fields` ttif ";
			$query.= " WHERE ttif.`fieldId` =? $mid and  tti.`itemId` = ttif.`itemId` order by ".$this->convert_sortmode($sort_mode);
			$result = $this->query($query,$bindvars);
			$ret = array();
			while ($res = $result->fetchRow()) {
				$k = $res['itemId'];
				$ret[$k] = $res['value'];
			}
			$cachelib->cacheItem($cache,serialize($ret));
			return $ret;
		} else {
			return unserialize($cachelib->getCached($cache));
		}
	}

	function getSqlStatus($status, &$mid, &$bindvars) {
		global $tiki_p_view_trackers_pending,$tiki_p_view_trackers_closed;
		if ($tiki_p_view_trackers_pending != 'y')
			$status = str_replace('p','',$status);
		if ($tiki_p_view_trackers_closed != 'y')
			$status = str_replace('c','',$status);
		if (!$status) {
			return false;
		} elseif (strlen($status) > 1) {
			$sts = preg_split('//', $status, -1, PREG_SPLIT_NO_EMPTY);
			if (count($sts)) {
				$mid.= " and (".implode('=? or ',array_fill(0,count($sts),'`status`'))."=?) ";
				$bindvars = array_merge($bindvars,$sts);
			}
		} else {
			$mid.= " and tti.`status`=? ";
			$bindvars[] = $status;
		}
		return true;
	}
	
	/* experimental shared */
	function list_items($trackerId, $offset, $maxRecords, $sort_mode, $listfields, $filterfield='', $filtervalue='', $status = '', $initial = '',$exactvalue='',$numsort=false, $initialFieldId='') {
		global $tiki_p_view_trackers_pending,$tiki_p_view_trackers_closed,$tiki_p_admin_trackers, $feature_categories;
		$cat_table = '';
		$trackerId = (int) $trackerId;
		$mid = " where tti.`trackerId`=? ";
		$bindvars = array($trackerId);
		if ($status) {
			if (!$this->getSqlStatus($status, $mid, $bindvars))
				return (array("cant"=>0, "data"=>''));
		}
		if ($initial) {
			if (!empty($initialFieldId)) {
				$mid .= ' and ttif.`fieldId`=? ';
				$bindvars[] = $initialFieldId ;
			}
			$mid.= "and ttif.`value` like ?";
			$bindvars[] = $initial.'%';
		}
		if (!$sort_mode) {
			$sort_mode = "lastModif_desc";
		}

		if (substr($sort_mode,0,2) == "f_" or $filtervalue or $exactvalue) {
		        $cat_table='';
		        if (substr($sort_mode,0,2) == "f_") {
			  list($a,$asort_mode,$corder) = split('_',$sort_mode);
			  $cat_table .= ", `tiki_tracker_item_fields` sf ";
			  $mid .= " and tti.`itemId`=sf.`itemId` and sf.`fieldId`=? ";
			  $bindvars[] = $asort_mode;
			  $csort_mode = "sf.`value` ";
			} else {
			  list($csort_mode,$corder) = split('_',$sort_mode);
			  $csort_mode = "tti.`".$csort_mode."` ";
			}

			if (is_array($filterfield)) {
				for ($i = count($filterfield) - 1; $i >=0; --$i) {
					$cat_table .= ", `tiki_tracker_item_fields` ttif$i";
					$this->getSqlFilter($trackerId, $filterfield[$i], isset($exactvalue[$i])?$exactvalue[$i]:'', isset($filtervalue[$i])?$filtervalue[$i]:'', $cat_table, $mid, $bindvars, $i);
					if ($i)
						$mid .= " and  ttif$i.`itemId`=ttif0.`itemId` ";
					else
						$mid .= " and  ttif0.`itemId`=ttif.`itemId` ";
				}
			} else {
				$this->getSqlFilter($trackerId, $filterfield, $exactvalue, $filtervalue, $cat_table, $mid, $bindvars);
			}

			if ($numsort) {
				$query = "select tti.*, ttif.`value`,ttf.`type`, right(lpad(ttif.`value`,40,'0'),40) as ok from `tiki_tracker_items` tti, `tiki_tracker_item_fields` ttif, `tiki_tracker_fields` ttf $cat_table ";
				$query.= " $mid and tti.`itemId`=ttif.`itemId` and ttf.`fieldId`=ttif.`fieldId` group by tti.`itemId` order by ".$this->convert_sortmode('ok_'.$corder);
			} else {

				$query = "select tti.*, ttif.`value`,ttf.`type` from `tiki_tracker_items` tti, `tiki_tracker_item_fields` ttif, `tiki_tracker_fields` ttf $cat_table ";
				$query.= " $mid and tti.`itemId`=ttif.`itemId` and ttf.`fieldId`=ttif.`fieldId` group by tti.`itemId` order by ".$csort_mode.$corder;
			}
			$query_cant = "select count(distinct ttif.`itemId`) from `tiki_tracker_items` tti, `tiki_tracker_item_fields` ttif, `tiki_tracker_fields` ttf  $cat_table ";
			$query_cant.= " $mid and tti.`itemId`=ttif.`itemId` and ttf.`fieldId`=ttif.`fieldId` ";
		} else {

			$query = "select tti.*, ttif.`value` from `tiki_tracker_items` tti, `tiki_tracker_item_fields` ttif $mid and tti.`itemId`=ttif.`itemId` group by tti.`itemId` order by ".$this->convert_sortmode($sort_mode);
			$query_cant = "select count(distinct ttif.`itemId`) from `tiki_tracker_items` tti, `tiki_tracker_item_fields` ttif $mid and tti.`itemId`=ttif.`itemId`";
		}
		$result = $this->query($query,$bindvars,$maxRecords,$offset);
		$cant = $this->getOne($query_cant,$bindvars);
		$type = '';
		$ret = array();
		while ($res = $result->fetchRow()) {
			$fields = array();
			$opts = array();
			$itid = $res["itemId"];
			// Commented out because it incorrectly prevents every non-admin user
			// from seeing the content of fields whose 'isPublic' flag is not set.
			// This flag should only be used for the TRACKERLIST plugin.
			//if ($tiki_p_admin_trackers == 'y') {
				$mid = "";
				$bindvars = array((int) $res["itemId"]);
			//} else {
			//	$mid = "`isPublic`=? and ";
			//	$bindvars = array('y',(int) $res["itemId"]);
			//}
			$query2 = "select ttf.`fieldId`, `value`,`isPublic` from `tiki_tracker_item_fields` ttif, `tiki_tracker_fields` ttf
				where ttif.`fieldId`=ttf.`fieldId` and $mid `itemId`=? order by `position` asc";
			$result2 = $this->query($query2,$bindvars);
			$last = array();
			$res2 = array();
			$fil = array();
			$kx = "";
			while ($res1 = $result2->fetchRow()) {
				$inid = $res1['fieldId'];
				$fil["$inid"] = $res1['value'];
			}
			foreach ($listfields as $fieldId=>$fopt) {
				$fopt['fieldId'] = $fieldId;
				if (isset($fil[$fieldId])) {
					$fopt['value'] = $fil[$fieldId];
				} else {
					$fopt['value'] = "";
				}
				$fopt["linkId"] = '';
				if ($fopt["type"] == 'r') {
					$fopt["links"] = array();
					$opts = split(',',$fopt['options']);
					$fopt["linkId"] = $this->get_item_id($opts[0],$opts[1],$fopt["value"]);
					$fopt["trackerId"] = $opts[0];
				} elseif ($fopt["type"] == 'a') {
					$fopt["pvalue"] = $this->parse_data(trim($fopt["value"]));
				} elseif ($fopt["type"] == 's') {
					$key = 'tracker.'.$trackerId.'.'.$itid;
					if ($fopt["name"] == 'Rating') {
						$fopt["numvotes"] = $this->getOne("select count(*) from `tiki_user_votings` where `id`=?",array($key));
						if ($fopt["numvotes"] > 0) {
							$voteavg = $fopt["value"]/$fopt["numvotes"];
						} else $voteavg = '0';
						$fopt["voteavg"] = $voteavg;
					} else if ($fopt["name"] == 'ItemID') {
						$fopt["itemnum"] = $itid;
					}
				} elseif ($fopt["type"] == 'e') {
				  global $categlib; include_once('lib/categories/categlib.php');
					$mycats = $categlib->get_child_categories($fopt['options']);
					if (empty($zcatItemId) || $zcatItemId != $res['itemId']) {
						$zcatItemId = $res['itemId'];
						$zcats = $categlib->get_object_categories("tracker ".$trackerId,$res["itemId"]);
					}
					$cats = array();
					foreach ($mycats as $m) {
						if (in_array($m['categId'],$zcats)) {
							$cats[] = $m;
						}
					}
					$fopt['categs'] = $cats;
				} elseif ($fopt["type"] == 'l') {
					$optsl = split(',',$fopt['options']);
					$fopt["links"] = array();
					if (isset($optsl[2]) && ($lst = $fil[$optsl[2]])) {
						$links = $this->get_items_list($optsl[0],$optsl[1],$lst);
						foreach ($links as $link) {
							$fopt["links"][$link] = $this->get_item_value($optsl[0],$link,$optsl[3]);
						}
						$fopt["trackerId"] = $optsl[0];
					}
				}
				if (isset($fopt["options"])) {
					$fopt["options_array"] = split(',',$fopt["options"]);
					if ($fopt['type'] == 'i') {
						global $imagegallib; include_once('lib/imagegals/imagegallib.php');
						if ($imagegallib->readimagefromfile($fopt["value"])) {
							$imagegallib->getimageinfo();
							if (!isset($fopt['options_array'][1]))
								$fopt['options_array'][1] = 0;
							$t = $imagegallib->ratio($imagegallib->xsize, $imagegallib->ysize, $fopt['options_array'][0], $fopt['options_array'][1] );
							$fopt['options_array'][0] = $t * $imagegallib->xsize;
							$fopt['options_array'][1] = $t * $imagegallib->ysize;
							if (isset($fopt['options_array'][2])) {
								if (!isset($fopt['options_array'][3]))
									$fopt['options_array'][3] = 0;
								$t = $imagegallib->ratio($imagegallib->xsize, $imagegallib->ysize, $fopt['options_array'][2], $fopt['options_array'][3] );
								$fopt['options_array'][2] = $t * $imagegallib->xsize;
								$fopt['options_array'][3] = $t * $imagegallib->ysize;
							}
						}
					} else if ($fopt['type'] == 'd' || $fopt['type'] == 'D') {
						global $feature_multilingual;
						if ($feature_multilingual == 'y') {
							foreach ($fopt['options_array'] as $key=>$l) {
									$fopt['options_array'][$key] = tra($l);
							}
						}
						$fopt = $this->set_default_dropdown_option($fopt);						
					}
				}
				if (empty($asort_mode) || ($fieldId == $asort_mode)) {
					$kx = $fopt["value"].'.'.$itid;
				}
				$last[$fieldId] = $fopt["value"];
				$fields[] = $fopt;
			}
			$res["field_values"] = $fields;
			if ($kx == "") // ex: if the sort field is non visible, $kx is null
				$ret[] = $res;
			else
				$ret["$kx"] = $res;
		}

		$retval = array();
		$retval["data"] = array_values($ret);
		$retval["cant"] = $cant;
		return $retval;
	}

	function getSqlFilter($trackerId, $filterfield, $exactvalue, $filtervalue, &$cat_table, &$mid, &$bindvars, $suffix='') {
		global $feature_categories;
		$filter = $this->get_tracker_field($filterfield);
		if ($filter['type'] == 'e' && $feature_categories == 'y') { //category
			$cat_table .= ", `tiki_categorized_objects` tob$filterfield, `tiki_category_objects` tco$filterfield";
			$mid .= " and tob$filterfield.`catObjectId`=tco$filterfield.`catObjectId` and tob$filterfield.`type`='tracker $trackerId' and tob$filterfield.`objId`=tti.`itemId` and tco$filterfield.`categId` in ( 0 ";
			$value = empty($filtervalue)? $exactvalue: $filtervalue;
			if(!is_array($value) && $value != '') {
					$value = array($value);
				} 
			foreach ($value as $catId) {
				$bindvars[] = $catId;
				$mid .= ',?';
			}
			$mid .= " ) ";
			$mid .= " and ttif$suffix.`fieldId`=? ";
			$bindvars[] = $filterfield;
		} else if ($exactvalue) {
			if (is_array($exactvalue)) {
				$mid .= " and ttif$suffix.`value` in (".implode(',',array_fill(0,count($exactvalue),'?')).")";
				$bindvars = array_merge($bindvars, $exactvalue);
			} else {
				$mid.= " and ttif$suffix.`value`=? ";
				$bindvars[] = $exactvalue;
			}
			$mid .= " and ttif$suffix.`fieldId`=? ";
			$bindvars[] = $filterfield;
		} elseif ($filterfield && $filtervalue) {
			$filter = $this->get_tracker_field($filterfield);
			$mid.= " and ttif$suffix.`value` like ? ";
			if (substr($filtervalue,0,1) == '*') {
				$bindvars[] = '%'. substr($filtervalue,1);
			} elseif (substr($filtervalue,-1,1) == '*') {
				$bindvars[] = substr($filtervalue,0,strlen($filtervalue)-1). '%';
			} else {
				$bindvars[] = '%'.$filtervalue.'%';
			}
			$mid .= " and ttif$suffix.`fieldId`=? ";
			$bindvars[] = $filterfield;
		}
	}
	function replace_item($trackerId, $itemId, $ins_fields, $status = '', $ins_categs = array(), $bulk_import = false) {
		global $user;
		global $smarty;
		global $notificationlib;
		global $sender_email;
		global $cachelib;
		global $categlib;
		global $feature_categories;
		global $tiki_p_admin_trackers;

		$now = date("U");

		if ($itemId) {
			if ($status) {
				$oldStatus = $this->getOne("select `status` from `tiki_tracker_items` where `itemId`=?", array($itemId));
				$query = "update `tiki_tracker_items` set `status`=?,`lastModif`=? where `itemId`=?";
				$result = $this->query($query,array($status,(int) $now,(int) $itemId));
			} else {
				$query = "update `tiki_tracker_items` set `lastModif`=? where `itemId`=?";
				$result = $this->query($query,array((int) $now,(int) $itemId));
			}
		} else {
			if (!$status) {
				$status = $this->getOne("select `value` from `tiki_tracker_options` where `trackerId`=? and `name`=?",array((int) $trackerId,'newItemStatus'));
			}
			if (empty($status)) { $status = 'o'; }
			$query = "insert into `tiki_tracker_items`(`trackerId`,`created`,`lastModif`,`status`) values(?,?,?,?)";
			$result = $this->query($query,array((int) $trackerId,(int) $now,(int) $now,$status));
			$new_itemId = $this->getOne("select max(`itemId`) from `tiki_tracker_items` where `created`=? and `trackerId`=?",array((int) $now,(int) $trackerId));
		}

		if ($feature_categories == 'y') {
			global $categlib; include_once('lib/categories/categlib.php');
			$old_categs = $categlib->get_object_categories("tracker $trackerId", $itemId ? $itemId : $new_itemId);

			$new_categs = array_diff($ins_categs, $old_categs);
			$del_categs = array_diff($old_categs, $ins_categs);
			$remain_categs = array_diff($old_categs, $new_categs, $del_categs);
		}
		if (!empty($oldStatus) || !empty($status)) {
			$the_data = tra('Status:').' ';
			$statusTypes = $this->status_types();
			if (isset($oldStatus) && $oldStatus != $status) {
				$the_data .= $statusTypes[$oldStatus]['label'] . ' -> ';
			}
			if (!empty($status)) {
				$the_data .= $statusTypes[$status]['label'] . "\n\n";
			}
		} else {
			$the_data = '';
		}

		foreach($ins_fields["data"] as $i=>$array) {
			if (!isset($ins_fields['data'][$i]['type']) or $ins_fields['data'][$i]['type'] == 's' or 
				(isset($ins_fields['data'][$i]['isHidden']) && ($ins_fields['data'][$i]['isHidden'] == 'p' or $ins_fields['data'][$i]['isHidden'] == 'y')and $tiki_p_admin_trackers != 'y')) {
			    // system type, do nothing
					// hidden field type require tracker amdin perm
			} elseif (empty($ins_fields["data"][$i]["fieldId"])) {
					// can have been unset for a user field
			} else {

				// -----------------------------
				// save image on disk
				if ( $ins_fields["data"][$i]["type"] == 'i' && isset($ins_fields["data"][$i]['value'])) {
					$itId = $itemId ? $itemId : $new_itemId;
					$old_file = $this->get_item_value($trackerId, $itemId, $ins_fields["data"][$i]['fieldId']);

					if($ins_fields["data"][$i]["value"] == 'blank') {
						if(file_exists($old_file)) {
							unlink($old_file);
						}
						$ins_fields["data"][$i]["value"] = '';
					} else if( $ins_fields["data"][$i]['value'] != '' && $this->check_image_type( $ins_fields["data"][$i]['file_type'] ) ) {
						$opts = split(',', $ins_fields['data'][$i]["options"]);
						if (!empty($opts[4])) {
							global $imagegallib;include_once('lib/imagegals/imagegallib.php');
							$imagegallib->image = $ins_fields["data"][$i]['value'];
							$imagegallib->readimagefromstring();
							$imagegallib->getimageinfo();
							if ($imagegallib->xsize > $opts[4] || $imagegallib->xsize > $opts[4]) {
								$imagegallib->rescaleImage($opts[4], $opts[4]);
								$ins_fields["data"][$i]['value'] = $imagegallib->image;
							}
						}
						if ($ins_fields["data"][$i]['file_size'] <= $this->imgMaxSize) {

							$file_name = $this->get_image_filename(	$ins_fields["data"][$i]['file_name'],
																	$itemId,
																	$ins_fields["data"][$i]['fieldId']);

							$fw = fopen( $file_name, "wb");
							fwrite($fw, $ins_fields["data"][$i]['value']);
							fflush($fw);
							fclose($fw);
							chmod($file_name, 0644); // seems necessary on some system (see move_uploaded_file doc on php.net

							$ins_fields['data'][$i]['value'] = $file_name;

							if(file_exists($old_file) && $old_file != $file_name) {
								unlink($old_file);
							}
						}
					}
					else {
						continue;
					}
				}
				// ---------------------------

				$fieldId = $ins_fields["data"][$i]["fieldId"];
				if (isset($ins_fields["data"][$i]["name"])) {
					$name = $ins_fields["data"][$i]["name"];
				} else {
					$name = $this->getOne("select `name` from `tiki_tracker_fields` where `fieldId`=?",array((int)$fieldId));
				}
				$value = @ $ins_fields["data"][$i]["value"];


				if ($ins_fields["data"][$i]["type"] == 'e' && $feature_categories == 'y') {
				// category type

					$my_categs = $categlib->get_child_categories($ins_fields['data'][$i]["options"]);
					$aux = array();
					foreach ($my_categs as $cat) {
						$aux[] = $cat['categId'];
					}
					$my_categs = $aux;

					$my_new_categs = array_intersect($new_categs, $my_categs);
					$my_del_categs = array_intersect($del_categs, $my_categs);
					$my_remain_categs = array_intersect($remain_categs, $my_categs);

					if (sizeof($my_new_categs) + sizeof($my_del_categs) == 0) {
							$the_data .= "$name ".tra('(unchanged)') . ":\n";
					} else {
							$the_data .= "$name :\n";
					}

					if (sizeof($my_new_categs) > 0) {
							$the_data .= "  " . tra("Added:") . "\n";
							$the_data .= $this->_describe_category_list($my_new_categs);
					}
					if (sizeof($my_del_categs) > 0) {
							$the_data .= "  " . tra("Removed:") . "\n";
							$the_data .= $this->_describe_category_list($my_del_categs);
					}
					if (sizeof($my_remain_categs) > 0) {
							$the_data .= "  " . tra("Remaining:") . "\n";
							$the_data .= $this->_describe_category_list($my_remain_categs);
					}
					$the_data .= "\n";

					if ($itemId) {
						$query = "select `itemId` from `tiki_tracker_item_fields` where `itemId`=? and `fieldId`=?";
						if ($this->getOne($query,array((int) $itemId, (int) $fieldId))) {
							$query = "update `tiki_tracker_item_fields` set `value`=? where `itemId`=? and `fieldId`=?";
							$this->query($query,array('',(int) $itemId,(int) $fieldId));
						} else {
							$query = "insert into `tiki_tracker_item_fields`(`itemId`,`fieldId`,`value`) values(?,?,?)";
							$this->query($query,array((int) $itemId,(int) $fieldId,''));
						}
					} else {
						$query = "insert into `tiki_tracker_item_fields`(`itemId`,`fieldId`,`value`) values(?,?,?)";
						$this->query($query,array((int) $new_itemId,(int) $fieldId,''));
					}
				} else {

					$is_date = (isset($ins_fields["data"][$i]["type"]) and ($ins_fields["data"][$i]["type"] == 'f' or $ins_fields["data"][$i]["type"] == 'j'));
					$is_visible = !isset($ins_fields["data"][$i]["isHidden"]) || $ins_fields["data"][$i]["isHidden"] == 'n';

					if ($itemId) {
						$result = $this->query('select `value` from `tiki_tracker_item_fields` where `itemId`=? and `fieldId`=?',array((int) $itemId,(int) $fieldId));
						if ($row = $result->fetchRow()) {
							if ($is_visible) {
								$old_value = $row['value'];
								if ($is_date) {
									$old_value = date('r',(int)$old_value);
									$new_value = date('r',(int)$value);
								} else {
									$new_value = $value;
								}
								if ($old_value != $new_value) {
									$the_data .= "$name" . ":\n ".tra("Old:")." $old_value\n ".tra("New:")." $new_value\n\n";
								} else {
									$the_data .= "$name ".tra('(unchanged)') . ":\n $value\n\n";
								}
							}

							$query = "update `tiki_tracker_item_fields` set `value`=? where `itemId`=? and `fieldId`=?";
							$this->query($query,array($value,(int) $itemId,(int) $fieldId));
						} else {
							if ($is_visible) {
								if ($is_date) {
									$new_value = date('r',(int)$value);
								} else {
									$new_value = $value;
								}
								$the_data .= "$name".":\n   $value\n\n";
							}
							$query = "insert into `tiki_tracker_item_fields`(`itemId`,`fieldId`,`value`) values(?,?,?)";
							$this->query($query,array((int) $itemId,(int) $fieldId,(string)$value));
						}
					} else {
						if ($is_visible) {
							if ($is_date) {
								$new_value = date('r',(int)$value);
							} else {
								$new_value = $value;
							}
							$the_data .= "$name".":\n   $value\n\n";
						}

						$query = "insert into `tiki_tracker_item_fields`(`itemId`,`fieldId`,`value`) values(?,?,?)";
						$this->query($query,array((int) $new_itemId,(int) $fieldId,(string)$value));
					}
					$cachelib->invalidate('trackerfield'.$trackerId.'-'.$fieldId.'o');
					$cachelib->invalidate('trackerfield'.$trackerId.'-'.$fieldId.'c');
					$cachelib->invalidate('trackerfield'.$trackerId.'-'.$fieldId.'p');
					$cachelib->invalidate('trackerfield'.$trackerId.'-'.$fieldId.'op');
					$cachelib->invalidate('trackerfield'.$trackerId.'-'.$fieldId.'oc');
					$cachelib->invalidate('trackerfield'.$trackerId.'-'.$fieldId.'pc');
					$cachelib->invalidate('trackerfield'.$trackerId.'-'.$fieldId.'opc');
				}
			}
		}

		// Don't send a notification if this operation is part of a bulk import
		if(!$bulk_import) {
			$options = $this->get_tracker_options( $trackerId );

			global $notificationlib; include_once('lib/notifications/notificationlib.php');

			$emails = $notificationlib->get_mail_events('tracker_modified', $trackerId);
			$emails2 = $notificationlib->get_mail_events('tracker_item_modified', $itemId);

			if( array_key_exists( "outboundEmail", $options ) && $options["outboundEmail"] )
			{
				$emails3 = array( $options["outboundEmail"] );
			} else {
				$emails3 = array( );
			}

			$emails = array_merge($emails, $emails2, $emails3);

			if (!isset($_SERVER["SERVER_NAME"])) {
				$_SERVER["SERVER_NAME"] = $_SERVER["HTTP_HOST"];
			}

			if( array_key_exists( "simpleEmail", $options ) )
			{
				$simpleEmail = $options["simpleEmail"];
			} else {
				$simpleEmail = "n";
			}

			$trackerName = $this->getOne("select `name` from `tiki_trackers` where `trackerId`=?",array((int) $trackerId));

			if (count($emails) > 0) {
				if( $simpleEmail == "n" )
				{
					$smarty->assign('mail_date', $now);
					$smarty->assign('mail_user', $user);
					if ($itemId) {
						$mail_action = "\r\n".tra('Item Modification')."\r\n\r\n";
						$mail_action.= tra('Tracker').":\n   ".$trackerName."\r\n";
						$mail_action.= tra('Item').":\n   ".$itemId;
					} else {
						$mail_action = "\r\n".tra('Item creation')."\r\n\r\n";
						$mail_action.= tra('Tracker').': '.$trackerName;
					}
					$smarty->assign('mail_action', $mail_action);
					$smarty->assign('mail_data', $the_data);
					if ($itemId) {
						$smarty->assign('mail_itemId', $itemId);
					} else {
						$smarty->assign('mail_itemId', $new_itemId);
					}
					$smarty->assign('mail_trackerId', $trackerId);
					$smarty->assign('mail_trackerName', $trackerName);
					$foo = parse_url($_SERVER["REQUEST_URI"]);
					$machine = $this->httpPrefix(). $foo["path"];
					$smarty->assign('mail_machine', $machine);
					$parts = explode('/', $foo['path']);
					if (count($parts) > 1)
						unset ($parts[count($parts) - 1]);
					$smarty->assign('mail_machine_raw', $this->httpPrefix(). implode('/', $parts));


					$mail_data = $smarty->fetch('mail/tracker_changed_notification.tpl');

					include_once ('lib/webmail/tikimaillib.php');
					$mail = new TikiMail();
					$mail->setSubject($smarty->fetch('mail/tracker_changed_notification_subject.tpl'));
					$mail->setText($mail_data);
					$mail->setHeader("From", $sender_email);
					$mail->send($emails);
				} else {
			    		// Use simple email

			    		global $userlib;

						if (!empty($user)) {
							$my_sender = $userlib->get_user_email($user);
						} else { // look if a email field exists
							$fieldId = $this->get_field_id_from_type($trackerId, 'm');
							if (!empty($fieldId))
								$my_sender = $this->get_item_value($trackerId, (!empty($itemId)? $itemId:$new_itemId), $fieldId);
						}

			    		// Default subject
			    		$subject='['.$trackerName.'] '.tra('Tracker was modified at '). $_SERVER["SERVER_NAME"];

			    		// Try to find a Subject in $the_data
			    		$subject_test = preg_match( '/^Subject:\n   .*$/m', $the_data, $matches );

			    		if( $subject_test == 1 ) {
							$subject = preg_replace( '/^Subject:\n   /m', '', $matches[0] );
							// Remove the subject from $the_data
							$the_data = preg_replace( '/^Subject:\n   .*$/m', '', $the_data );
			    		}

			    		$the_data = preg_replace( '/^.+:\n   /m', '', $the_data );

			    		//outbound email ->  will be sent in utf8 - from sender_email
			    		include_once('lib/webmail/tikimaillib.php');
			    		$mail = new TikiMail();
			    		$mail->setSubject($subject);
			    		$mail->setText($the_data);

			    		if( ! empty( $my_sender ) ) {
							$mail->setHeader("From", $my_sender);
			    		}

			    		$mail->send( $emails );
				}
			}
		}

		$cant_items = $this->getOne("select count(*) from `tiki_tracker_items` where `trackerId`=?",array((int) $trackerId));
		$query = "update `tiki_trackers` set `items`=?,`lastModif`=?  where `trackerId`=?";
		$result = $this->query($query,array((int)$cant_items,(int) $now,(int) $trackerId));

		if (!$itemId) $itemId = $new_itemId;

		global $cachelib;
		require_once('lib/cache/cachelib.php');
		$cachelib->invalidate('trackerItemLabel'.$itemId);

		return $itemId;
	}

	function _format_data($field, $data) {
		$data = trim($data);
		if($field['type'] == 'a') {
			if(isset($field["options_array"][3]) and $field["options_array"][3] > 0 and strlen($data) > $field["options_array"][3]) {
				$data = substr($data,0,$field["options_array"][3])." (...)";
			}
		} elseif ($field['type'] == 'c') {
			if($data != 'y') $data = 'n';
		}
		return $data;
	}

	/* Experimental feature.
	 * PHP's execution time limit of 30 seconds may have to be extended when
	 * importing large files ( > 1000 items).
	 */
	function import_items($trackerId, $indexField, $csvHandle, $csvDelimiter = "," , $replace = true) {

		// Read the first line.  It contains the names of the fields to import
		if (($data = fgetcsv($csvHandle, 4096, $csvDelimiter)) === FALSE) return -1;
		$nColumns = count($data);
		for ($i = 0; $i < $nColumns; $i++) {
			$data[$i] = trim($data[$i]);
		}
		$fields = $this->list_tracker_fields($trackerId, 0, -1, 'position_asc', '');
		$temp_max = count($fields["data"]);
		$indexId = -1;
		for ($i = 0; $i < $temp_max; $i++) {
			$column[$i] = -1;
			for ($j = 0; $j < $nColumns; $j++) {
				if($fields["data"][$i]['name'] == $data[$j]) {
					$column[$i] = $j;
				}
				if($indexField == $data[$j]) {
					$indexId = $j;
				}
			}
		}

		// If a primary key was specified, check that it was found among the columns of the file
		if($indexField && $indexId == -1) return -1;

		$total = 0;
		while (($data = fgetcsv($csvHandle, 4096, $csvDelimiter)) !== FALSE) {
			$status = array_shift($data);
			$itemId = array_shift($data);
			for ($i = 0; $i < $temp_max-2; $i++) {
				if (isset($data[$i])) {
					$fields["data"][$i]['value'] = $data[$i];
				} else {
					$fields["data"][$i]['value'] = "";
				}
			}
			$this->replace_item($trackerId, $itemId, $fields, $status, array(), true);
			$total++;
		}

		// TODO: Send a notification indicating that an import has been done on this tracker

		return $total;
	}

	function import_csv($trackerId, $csvHandle, $replace = true) {
		$now = date('U');
		if (($data = fgetcsv($csvHandle,100000)) === FALSE) {
			return -1;
		}
		$total = 0;
		$fields = $this->list_tracker_fields($trackerId, 0, -1, 'position_asc', '');
		while (($data = fgetcsv($csvHandle,100000)) !== FALSE) {
			$status = array_shift($data);
			if (!$status) $status = 'o';
			$itemId = array_shift($data);
			$categs = array_shift($data);
			$max = count($data);
			$nextId = $this->getOne('select max(`itemId`) from `tiki_tracker_items`');
			$itemId = (int) $nextId + 1;
			$query = "insert into `tiki_tracker_items`(`trackerId`,`created`,`lastModif`,`status`,`itemId`) values(?,?,?,?,?)";
			$result = $this->query($query,array((int) $trackerId,(int) $now,(int) $now,$status,(int)$itemId));
			if (trim($categs)) {
				$cats = split(',',$categs);
				foreach ($cats as $c) {
					$this->categorized_item($trackerId, $itemId, "item $itemId", $cats);
				}
			}
			for ($i = 0; $i < $max; $i++) {
				if (isset($fields["data"][$i])) {
					$it = $fields["data"][$i];
					$fieldId = $it['fieldId'];
					$query = "insert into `tiki_tracker_item_fields`(`itemId`,`fieldId`,`value`) values(?,?,?)";
					if ($it['type'] == 'e' or $it['type'] == 's') {
						$data[$i] = '';
					} elseif ($it['type'] == 'a') {
						$data[$i] = preg_replace('/\%\%\%/',"\r\n",$data[$i]);
					}
					$this->query($query,array((int) $itemId,(int) $fieldId,$data[$i]));
				}
			}
			$total++;
		}
		return $total;
	}
	
	function _describe_category_list($categs) {
	    global $categlib;
	    $res = '';
	    foreach ($categs as $cid) {
		$info = $categlib->get_category($cid);
		$res .= '    ' . $info['name'] . "\n";
	    }
	    return $res;
	}

	// check the validity of each field values of a tracker item
	// and the presence of mandatory fields
	function check_field_values($ins_fields, $categorized_fields='') {
		$mandatory_fields = array();
		$erroneous_values = array();

		foreach($ins_fields['data'] as $f) {

			if (isset($f['isMandatory']) && $f['isMandatory'] == 'y') {
				if (isset($f['type']) &&  $f['type'] == 'e') {
					if (!in_array($f['fieldId'], $categorized_fields))
						$mandatory_fields[] = $f;
				} elseif (isset($f['type']) &&  ($f['type'] == 'u' || $f['type'] == 'g') && $f['options_array'][0] == 1) {
					;
				} elseif (!isset($f['value']) or strlen($f['value']) == 0) {
					$mandatory_fields[] = $f;
				}
			}
			if (!empty($f['value']) && isset($f['type'])) {

				switch ($f['type']) {
				// numeric
				case 'n':
					if(!is_numeric($f['value'])) {
						$f['error'] = tra('field is not numeric');
						$erroneous_values[] = $f;
					}
					break;

				// email
				case 'm':
					global $registrationlib,$dbTiki, $sender_email;
					if(!isset($registrationlib)) {
						require_once('lib/registration/registrationlib.php');
					}
					$res = $registrationlib->SnowCheckMail($f['value'], $sender_email, 'mini');
					if($res[0] == false) {
						$res[1];
						$erroneous_values[] = $f;
					}
					break;
				}
			}
		}

		$res = array();
		$res['err_mandatory'] = $mandatory_fields;
		$res['err_value'] = $erroneous_values;
		return $res;
	}

	function remove_tracker_item($itemId) {
		$now = date("U");

		$query = "select * from `tiki_tracker_items` where `itemId`=?";
		$result = $this->query($query, array((int) $itemId));
		$res = $result->fetchRow();
		$trackerId = $res['trackerId'];
		$status = $res['status'];

		// ---- save image list before sql query ---------------------------------
		$fieldList = $this->list_tracker_fields($trackerId, 0, -1, 'name_asc', '');
		$imgList = array();
		foreach($fieldList['data'] as $f) {
			if( $f['type'] == 'i' ) {
				$imgList[] = $this->get_item_value($trackerId, $itemId, $f['fieldId']);
			}
		}

		$query = "update `tiki_trackers` set `lastModif`=? where `trackerId`=?";
		$result = $this->query($query,array((int) $now,(int) $trackerId));
		$query = "update `tiki_trackers` set `items`=`items`-1 where `trackerId`=?";
		$result = $this->query($query,array((int) $trackerId));
		$query = "delete from `tiki_tracker_item_fields` where `itemId`=?";
		$result = $this->query($query,array((int) $itemId));
		$query = "delete from `tiki_tracker_items` where `itemId`=?";
		$result = $this->query($query,array((int) $itemId));
		$query = "delete from `tiki_tracker_item_comments` where `itemId`=?";
		$result = $this->query($query,array((int) $itemId));
		$query = "delete from `tiki_tracker_item_attachments` where `itemId`=?";
		$result = $this->query($query,array((int) $itemId));

		// ---- delete image from disk -------------------------------------
		foreach($imgList as $img) {
			if( file_exists($img) ) {
				unlink( $img );
			}
		}

		global $cachelib;
		require_once('lib/cache/cachelib.php');
		$cachelib->invalidate('trackerItemLabel'.$itemId);
		foreach($fieldList['data'] as $f) {
			$cachelib->invalidate('trackerfield'.$trackerId.'-'.$f['fieldId'].'o');
			$cachelib->invalidate('trackerfield'.$trackerId.'-'.$f['fieldId'].'p');
			$cachelib->invalidate('trackerfield'.$trackerId.'-'.$f['fieldId'].'c');
			$cachelib->invalidate('trackerfield'.$trackerId.'-'.$f['fieldId'].'op');
			$cachelib->invalidate('trackerfield'.$trackerId.'-'.$f['fieldId'].'oc');
			$cachelib->invalidate('trackerfield'.$trackerId.'-'.$f['fieldId'].'pc');
			$cachelib->invalidate('trackerfield'.$trackerId.'-'.$f['fieldId'].'opc');			
		}

		return true;
	}

	// Lists all the fields for an existing tracker
	function list_tracker_fields($trackerId, $offset=0, $maxRecords=-1, $sort_mode='position_asc', $find='', $tra_name=true,$filter='') {
		global $feature_multilingual, $language;
		if ($find) {
			$findesc = '%' . $find . '%';
			$mid = " where `trackerId`=? and (`name` like ?)";
			$bindvars=array((int) $trackerId,$findesc);
		} else {
			$mid = " where `trackerId`=? ";
			$bindvars=array((int) $trackerId);
		}

		if (!empty($filter)) {
			foreach ($filter as $type=>$val) {
				if ($type == 'fields') {
					if (count($val) > 0) {
						$mid .= ' and `fieldId` in ('.implode(",",array_fill(0,count($val),'?')).')';
						$bindvars = array_merge($bindvars, $val);
					}
				}
			}
		}

		$query = "select * from `tiki_tracker_fields` $mid order by ".$this->convert_sortmode($sort_mode);
		$query_cant = "select count(*) from `tiki_tracker_fields` $mid";
		$result = $this->query($query,$bindvars,$maxRecords,$offset);
		$cant = $this->getOne($query_cant,$bindvars);
		$ret = array();

		while ($res = $result->fetchRow()) {
			$res['options_array'] = split(',', $res['options']);
			if ($tra_name && $feature_multilingual == 'y' && $language != 'en')
				$res['name'] = tra($res['name']);
			if ($res['type'] == 'd' || $res['type'] == 'D') { // drop down
				if ($feature_multilingual == 'y') {
					foreach ($res['options_array'] as $key=>$l) {
						$res['options_array'][$key] = tra($l);
					}
				}
				$res = $this->set_default_dropdown_option($res);						
			}
			$ret[] = $res;
		}
		$retval = array();
		$retval["data"] = $ret;
		$retval["cant"] = $cant;
		return $retval;
	}

	// Inserts or updates a tracker
	function replace_tracker($trackerId, $name, $description, $options) {
		$now = date("U");
		if ($trackerId) {
			$old = $this->getOne('select count(*) from `tiki_trackers` where `trackerId`=?',array((int)$trackerId)); 
			if ($old) {
				$query = "update `tiki_trackers` set `name`=?,`description`=?,`lastModif`=? where `trackerId`=?";
				$this->query($query,array($name,$description,(int)date('U'),(int) $trackerId));
			} else {
				$query = "insert into `tiki_trackers` (`name`,`description`,`lastModif`,`trackerId`) values (?,?,?,?)";
				$this->query($query,array($name,$description,(int)date('U'),(int) $trackerId));
			}
		} else {
			$this->getOne("delete from `tiki_trackers` where `name`=?",array($name),false);
			$query = "insert into `tiki_trackers`(`name`,`description`,`created`,`lastModif`) values(?,?,?,?)";
			$this->query($query,array($name,$description,(int) $now,(int) $now));
			$trackerId = $this->getOne("select max(`trackerId`) from `tiki_trackers` where `name`=? and `created`=?",array($name,(int) $now));
		}
		$this->query("delete from `tiki_tracker_options` where `trackerId`=?",array((int)$trackerId));

		$rating = false;
		foreach ($options as $kopt=>$opt) {
			$this->query("insert into `tiki_tracker_options`(`trackerId`,`name`,`value`) values(?,?,?)",array((int)$trackerId,$kopt,$opt));
			if ($kopt == 'useRatings' and $opt == 'y') {
				$rating = true;
			} elseif ($kopt == 'ratingOptions') {
				$ratingoptions = $opt;
			} elseif ($kopt == 'showRatings') {
				$showratings = $opt;
			}
		}

		// Check System field for Ratings
		$ratingId = $this->get_field_id($trackerId,'Rating');
		if ($rating) {
			if (!$ratingId) $ratingId = 0;
			if (!isset($ratingoptions)) $ratingoptions = '';
			if (!isset($showratings)) $showratings = 'n';
			$this->replace_tracker_field($trackerId,$ratingId,'Rating','s','-','-',$showratings,'y','n','-',0,$ratingoptions);
		} else {
			$this->query('delete from `tiki_tracker_fields` where `fieldId`=?',array((int)$ratingId));
		}

		// Check System field for ItemID - Not Optional
		$itemId = $this->get_field_id($trackerId,'ItemID');
		if (!$itemId) {
			$itemId = 0;
			$this->replace_tracker_field($trackerId,$itemId,'ItemID','s','-','-','y','y','n','-',0,'');
		}

		$this->clear_tracker_cache($trackerId);
		return $trackerId;
	}

	function clear_tracker_cache($trackerId) {
		$query = "select `itemId` from `tiki_tracker_items` where `trackerId`=?";
		$result = $this->query($query,array((int)$trackerId));

		global $cachelib;
		require_once('lib/cache/cachelib.php');

		while ($res = $result->fetchRow()) {
		    $cachelib->invalidate('trackerItemLabel'.$res['itemId']);
		}
	}


	// If you pass a non-positive fieldId, the function will grab one past the last id.
	// If you pass a non-positive position, the function will grab one past the last position.
	// If you pass a 's' (system) field, it overrides the position and goes to the end.
	function replace_tracker_field($trackerId, $fieldId, $name, $type, $isMain, $isSearchable, $isTblVisible, $isPublic, $isHidden, $isMandatory, $position, $options) {
		if ($fieldId) {
			// -------------------------------------
			// remove images when needed
			$old_field = $this->get_tracker_field($fieldId);
			if ($old_field) {
				if( $old_field['type'] == 'i' && $type != 'i' ) {
					$this->remove_field_images( $fieldId );
				}
				if ($type == 's' && intval($position) <= 0) {
					$position = intval($this->getOne("select max(`position`) from `tiki_tracker_fields` where `trackerId`=?",array((int) $trackerId))) + 1;
				}
				$query = "update `tiki_tracker_fields` set `name`=? ,`type`=?,`isMain`=?,`isSearchable`=?,
					`isTblVisible`=?,`isPublic`=?,`isHidden`=?,`isMandatory`=?,`position`=?,`options`=? where `fieldId`=?";
				$bindvars=array($name,$type,$isMain,$isSearchable,$isTblVisible,$isPublic,$isHidden,$isMandatory,(int)$position,$options,(int) $fieldId);
			} else {
				if ($type == 's' && intval($position) <= 0) {
					$position = intval($this->getOne("select max(`position`) from `tiki_tracker_fields` where `trackerId`=?",array((int) $trackerId))) + 1;
				}
				$query = "insert into `tiki_tracker_fields` (`trackerId`,`name`,`type`,`isMain`,`isSearchable`,
					`isTblVisible`,`isPublic`,`isHidden`,`isMandatory`,`position`,`options`,`fieldId`) values (?,?,?,?,?,?,?,?,?,?,?,?);";
				$bindvars=array((int) $trackerId,$name,$type,$isMain,$isSearchable,$isTblVisible,$isPublic,$isHidden,$isMandatory,(int)$position,$options,(int) $fieldId);
			}
			$result = $this->query($query, $bindvars);
		} else {
			$this->getOne("delete from `tiki_tracker_fields` where `trackerId`=? and `name`=?",
				array((int) $trackerId,$name),false);
			if ($type == 's' && $position <= 0) {
				$position = intval($this->getOne("select max(`position`) from `tiki_tracker_fields` where `trackerId`=?",array((int) $trackerId))) + 1;
			}
			$query = "insert into `tiki_tracker_fields`(`trackerId`,`name`,`type`,`isMain`,`isSearchable`,`isTblVisible`,`isPublic`,`isHidden`,`isMandatory`,`position`,`options`)
                values(?,?,?,?,?,?,?,?,?,?,?)";
			$result = $this->query($query,array((int) $trackerId,$name,$type,$isMain,$isSearchable,$isTblVisible,$isPublic,$isHidden,$isMandatory,(int) $position,$options));

			// Now add the field to all the existing items
			$query = "select `itemId` from `tiki_tracker_items` where `trackerId`=?";
			$result = $this->query($query,array((int) $trackerId));

			while ($res = $result->fetchRow()) {
				$itemId = $res['itemId'];
				$this->getOne("delete from `tiki_tracker_item_fields` where `itemId`=? and `fieldId`=?",
					array((int) $itemId,(int) $fieldId),false);

				$query2 = "insert into `tiki_tracker_item_fields`(`itemId`,`fieldId`,`value`) values(?,?,?)";
				$this->query($query2,array((int) $itemId,(int) $fieldId,''));
			}
		}
		$this->clear_tracker_cache($trackerId);
		return $fieldId;
	}

	function replace_rating($trackerId,$itemId,$fieldId,$user,$new_rate) {
		$val = $this->getOne("select `value` from `tiki_tracker_item_fields` where `itemId`=? and `fieldId`=?", array((int)$itemId,(int)$fieldId));
		if ($val === NULL) {
			$query = "insert into `tiki_tracker_item_fields`(`value`,`itemId`,`fieldId`) values (?,?,?)";
			$newval = $new_rate;
			//echo "$newval";die;
		} else {
			$query = "update `tiki_tracker_item_fields` set `value`=? where `itemId`=? and `fieldId`=?";
			$olrate = $this->get_user_vote("tracker.$trackerId.$itemId",$user);
			if ($olrate === NULL) $olrate = 0;
			if ($new_rate === NULL) {
				$newval = $val - $olrate;
			} else {
				$newval = $val - $olrate + $new_rate;
			}
			//echo "$val - $olrate + $new_rate = $newval";die;
		}
		$this->query($query,array((int)$newval,(int)$itemId,(int)$fieldId));
		$this->register_user_vote($user, "tracker.$trackerId.$itemId", $new_rate);
		return $newval;
	}

	function remove_tracker($trackerId) {

		// ---- delete image from disk -------------------------------------
		$fieldList = $this->list_tracker_fields($trackerId, 0, -1, 'name_asc', '');
		foreach($fieldList['data'] as $f) {
			if( $f['type'] == 'i' ) {
				$this->remove_field_images($f['fieldId']);
			}
		}

		$bindvars=array((int) $trackerId);
		$query = "delete from `tiki_trackers` where `trackerId`=?";

		$result = $this->query($query,$bindvars);
		// Remove the fields
		$query = "delete from `tiki_tracker_fields` where `trackerId`=?";
		$result = $this->query($query,$bindvars);
		// Remove the items (Remove fields for each item for this tracker)
		$query = "select `itemId` from `tiki_tracker_items` where `trackerId`=?";
		$result = $this->query($query,$bindvars);

		while ($res = $result->fetchRow()) {
			$query2 = "delete from `tiki_tracker_item_fields` where `itemId`=?";
			$result2 = $this->query($query2,array((int) $res["itemId"]));
			$query2 = "delete from `tiki_tracker_item_comments` where `itemId`=?";
			$result2 = $this->query($query2,array((int) $res["itemId"]));
			$query2 = "delete from `tiki_tracker_item_attachments` where `itemId`=?";
			$result2 = $this->query($query2,array((int) $res["itemId"]));
		}

		$query = "delete from `tiki_tracker_items` where `trackerId`=?";
		$result = $this->query($query,$bindvars);

		$query = "delete from `tiki_tracker_options` where `trackerId`=?";
		$result = $this->query($query,$bindvars);

		$this->remove_object('tracker', $trackerId);

		$this->clear_tracker_cache($trackerId);

		return true;
	}

	function remove_tracker_field($fieldId,$trackerId) {
		global $cachelib;

		// -------------------------------------
		// remove images when needed
		$field = $this->get_tracker_field($fieldId);
		if( $field['type'] == 'i' ) {
			$this->remove_field_images($fieldId);
		}

		$query = "delete from `tiki_tracker_fields` where `fieldId`=?";
		$bindvars=array((int) $fieldId);
		$result = $this->query($query,$bindvars);
		$query = "delete from `tiki_tracker_item_fields` where `fieldId`=?";
		$result = $this->query($query,$bindvars);
		$cachelib->invalidate('trackerfield'.$trackerId.'-'.$fieldId.'o');
		$cachelib->invalidate('trackerfield'.$trackerId.'-'.$fieldId.'p');
		$cachelib->invalidate('trackerfield'.$trackerId.'-'.$fieldId.'c');
		$cachelib->invalidate('trackerfield'.$trackerId.'-'.$fieldId.'op');
		$cachelib->invalidate('trackerfield'.$trackerId.'-'.$fieldId.'oc');
		$cachelib->invalidate('trackerfield'.$trackerId.'-'.$fieldId.'pc');
		$cachelib->invalidate('trackerfield'.$trackerId.'-'.$fieldId.'opc');		

		$this->clear_tracker_cache($trackerId);

		return true;
	}

	function get_tracker_options($trackerId) {
		$query = "select * from `tiki_tracker_options` where `trackerId`=?";
		$result = $this->query($query,array((int) $trackerId));
		if (!$result->numRows()) return array();
		$res = array();
		while ($opt = $result->fetchRow()) {
			$res["{$opt['name']}"] = $opt['value'];
		}
		return $res;
	}

	function get_tracker_field($fieldId) {
		$query = "select * from `tiki_tracker_fields` where `fieldId`=?";
		$result = $this->query($query,array((int) $fieldId));
		if (!$result->numRows()) return false;
		$res = $result->fetchRow();
		return $res;
	}

	function get_field_id($trackerId,$name) {
		return $this->getOne("select `fieldId` from `tiki_tracker_fields` where `trackerId`=? and `name`=?",array((int)$trackerId,$name));
	}

	function get_field_id_from_type($trackerId, $type, $option=NULL) {
		$mid = ' `trackerId`=? and `type`=? ';
		$bindvars = array((int)$trackerId, $type);
		if (!empty($option)) {
			$mid .= ' and `options`=? ';
			$bindvars[] = $option;
		} 
		return $this->getOne("select `fieldId` from `tiki_tracker_fields` where $mid",$bindvars);
	}

/*
** function only used for the popup for more infos on attachements
*  returns an array with field=>value
*/
	function get_moreinfo($attId) {
		$query = "select o.`value`, o.`trackerId` from `tiki_tracker_options` o";
		$query.= " left join `tiki_tracker_items` i on o.`trackerId`=i.`trackerId` ";
		$query.= " left join `tiki_tracker_item_attachments` a on i.`itemId`=a.`itemId` ";
		$query.= " where a.`attId`=? and o.`name`=?";
		$result = $this->query($query,array((int)$attId, 'orderAttachments'));
		$resu = $result->fetchRow();
		if ($resu) {
			$resu['orderAttachments'] = $resu['value'];
		} else {
			$query = "select `orderAttachments`, t.`trackerId` from `tiki_trackers` t ";
			$query.= " left join `tiki_tracker_items` i on t.`trackerId`=i.`trackerId` ";
			$query.= " left join `tiki_tracker_item_attachments` a on i.`itemId`=a.`itemId` ";
			$query.= " where a.`attId`=? ";
			$result = $this->query($query,array((int)$attId));
			$resu = $result->fetchRow();
		}
		if (strstr($resu['orderAttachments'],'|')) {
			$fields = split(',',substr($resu['orderAttachments'],strpos($resu['orderAttachments'],'|')+1));
			$query = "select `".implode("`,`",$fields)."` from `tiki_tracker_item_attachments` where `attId`=?";
			$result = $this->query($query,array((int)$attId));
			$res = $result->fetchRow();
			$res["trackerId"] = $resu['trackerId'];
			$res["longdesc"] = $this->parse_data($res['longdesc']);
		} else {
			$res = array(tra("message") => tra("No extra information for that attached file. "));
			$res['trackerId'] = 0;
		}
		return $res;
	}

	function field_types() {
		$type['t'] = array(
			'label'=>tra('text field'),
			'opt'=>true,
			'options'=>array(
				'half'=>array('type'=>'bool','label'=>tra('half column')),
				'size'=>array('type'=>'int','label'=>tra('size')),
				'prepend'=>array('type'=>'str','label'=>tra('prepend')),
				'append'=>array('type'=>'str','label'=>tra('append')),
				'max'=>array('type'=>'int','label'=>tra('max')),
			),
			'help'=>tra('Text options: 1,size,prepend,append,max with size in chars, prepend will be displayed before the field append will be displayed just after, max is the maximum number of characters that can be saved, and initial 1 to make that next text field or checkbox is in same row. If you indicate only 1 it means next field is in same row too.'));
		$type['a'] = array(
			'label'=>tra('textarea'),
			'opt'=>true,
			'help'=>tra('Textarea options: quicktags,width,height,max,listmax - Use Quicktags is 1 or 0, widthis indicated in chars, height is indicated in lines, max is the maximum number of characters that can be saved, listmax isthe maximum number of characters that are displayed in list mode.'));
		$type['c'] = array(
			'label'=>tra('checkbox'),
			'opt'=>true,
			'help'=>tra('Checkbox options: put 1 if you need that next field is on the same row.'));
		$type['n'] = array(
			'label'=>tra('numeric field'),
			'opt'=>true,
			'help'=>tra('Numeric options: 1,size,prepend,append with size in chars, prepend will be displayed before the field append will be displayed just after, and initial 1 to make that next text field or checkbox is in same row. If you indicate only 1 it means next field is in same row too.'));
		$type['d'] = array(
			'label'=>tra('drop down'),
			'opt'=>true,
			'help'=>tra('Dropdown options: list of items separated with commas.').tra('Default value is specified by having the value indicated twice consecutively') );
		$type['D'] = array(
			'label'=>tra('drop down with other textfield'),
			'opt'=>true,
			'help'=>tra('Dropdown options: list of items separated with commas.').tra('Default value is specified by having the value indicated twice consecutively') );
		$type['u'] = array(
			'label'=>tra('user selector'),
			'opt'=>true,
			'help'=>tra('User Selector: use options for automatic field feeding : you can use 1 for author login or 2 for modificator login.'));
		$type['g'] = array(
			'label'=>tra('group selector'),
			'opt'=>true,
			'help'=>tra('Group Selector: use options for automatic field feeding : you can use 1 for group of creation and 2 for group where modification come from. The default group has to be set, or the first group that come is chosen for a user, or the default group is Registered.'));
		$type['y'] = array(
			'label'=>tra('country selector'),
			'opt'=>true,
			'help'=>tra('Country Selector options: 1|2 where 1 show only country name and 2 show only country flag. By default show both country name and flag') );
		$type['f'] = array(
			'label'=>tra('date and time'),
			'opt'=>false);
		$type['j'] = array(
			'label'=>tra('jscalendar'),
			'opt'=>false);
		$type['i'] = array(
			'label'=>tra('image'),
			'opt'=>true,
			'help'=>tra('Image options: xListSize,yListSize,xDetailsSize,yDetailsSize,uploadLimitScale indicated in pixels.')  );
		$type['x'] = array(
			'label'=>tra('action'),
			'opt'=>true,
			'help'=>tra('Action options: Label,post,tiki-index.php,page:fieldname,highlight=test') );
		$type['h'] = array(
			'label'=>tra('header'),
			'opt'=>false);
		$type['e'] = array(
			'label'=>tra('category'),
			'opt'=>true,
			'help'=>tra('Category options: parentId') );
		$type['r'] = array(
			'label'=>tra('item link'),
			'opt'=>true,
			'help'=>tra('Item Link options: trackerId,fieldId,linkToItem links to item from trackerId which fieldId matches the content of that field. linkToItem 1|0 to create a link to the item in view mode and listing') );
		$type['l'] = array(
			'label'=>tra('items list'),
			'opt'=>true,
			'help'=>tra('Items list options: trackerId,fieldIdThere, fieldIdHere, displayFieldIdThere, linkToItems displays the list of displayFieldIdThere from item in tracker trackerId where fieldIdThere matches fieldIdHere. linkToItems 1|0 to create a link to items in view mode and listing') );
		$type['m'] = array(
			'label'=>tra('email'),
			'opt'=>true,
			'help'=>tra('Email address options: 0|1|2 where 0 puts the address as plain text, 1 does a hex encoded mailto link (more difficult for web spiders to pick it up and spam) and 2 does the normal href mailto.') );
		$type['s'] = array(
			'label'=>tra('system'),
			'opt'=>false);

		return $type;
	}

	function status_types() {
		$status['o'] = array('label'=>tra('open'),'perm'=>'tiki_p_view_trackers','image'=>'img/icons2/status_open.gif');
		$status['p'] = array('label'=>tra('pending'),'perm'=>'tiki_p_view_trackers_pending','image'=>'img/icons2/status_pending.gif');
		$status['c'] = array('label'=>tra('closed'),'perm'=>'tiki_p_view_trackers_closed','image'=>'img/icons2/status_closed.gif');
		return $status;
	}

	function get_isMain_value($trackerId, $itemId) {
		$query = "select i.`value` from `tiki_tracker_item_fields` i, `tiki_tracker_fields` f where f.`trackerId`=? and i.`itemId`=? and f.`fieldId` = i.`fieldId` and f.`isMain`=?";
		$result = $this->getOne($query, array((int)$trackerId, (int)$itemId, "y"));
		return $result;
	}
	function categorized_item($trackerId, $itemId, $mainfield, $ins_categs) {
		global $categlib; include_once('lib/categories/categlib.php');
		$cat_type = "tracker $trackerId";
		$cat_objid = $itemId;
		$cat_desc = '';
		if (empty($mainfield))
			$cat_name = $itemId;
		else
			$cat_name = $mainfield;
		$cat_href = "tiki-view_tracker_item.php?trackerId=$trackerId&amp;itemId=$itemId";
		$categlib->uncategorize_object($cat_type, $cat_objid);
		foreach ($ins_categs as $cats) {
			$catObjectId = $categlib->is_categorized($cat_type, $cat_objid);
			if (!$catObjectId) {
				$catObjectId = $categlib->add_categorized_object($cat_type, $cat_objid, $cat_desc, $cat_name, $cat_href);
			}
			$categlib->categorize($catObjectId, $cats);
		}
	}
	function move_up_last_fields($trackerId, $position, $delta=1) {
		$query = 'update `tiki_tracker_fields`set `position`= `position`+ ? where `trackerId` = ? and `position` >= ?';
		$result = $this->query( $query, array((int)$delta, (int)$trackerId, (int)$position) );		
	}
	/* list all the values of a field
	 */
	function list_tracker_field_values($fieldId, $status='o') {
		$mid = '';
		$bindvars[] = (int)$fieldId;
		if (!$this->getSqlStatus($status, $mid, $bindvars))
			return null;
		$sort_mode = "value_asc";
		$query = "select distinct(ttif.`value`) from `tiki_tracker_item_fields` ttif, `tiki_tracker_items` tti where tti.`itemId`= ttif.`itemId`and ttif.`fieldId`=? $mid order by ".$this->convert_sortmode($sort_mode);
		$result = $this->query( $query, $bindvars);
		$ret = array();
		while ($res = $result->fetchRow()) {
			$ret[] = $res['value'];
		}
		return $ret;
	}
	/* find the best fieldwhere you can do a filter on the initial
	 * 1) if sort_mode and sort_mode is a text and the field is visible
	 * 2) the first main taht is text
	 */
	function get_initial_field($list_fields, $sort_mode) {
		if (preg_match('/^f_([^_]*)_?.*/', $sort_mode, $matches)) {
			if (isset($list_fields[$matches[1]])) {
				$type = $list_fields[$matches[1]]['type'];
				if ($type == 't' || $type == 'a' || $type == 'm')
					return $matches[1];
			}
		}
		foreach($list_fields as $fieldId=>$field) {
			if ($field['isMain'] == 'y' && ($field['type'] == 't' || $field['type'] == 'a' || $field['type'] == 'm'))
				return $fieldId;
		}
		return '';
	}
	function get_flags() {
		$flags = array();
		$h = opendir("img/flags/");
		while ($file = readdir($h)) {
			if (strstr($file, ".gif")) {
				$parts = explode('.', $file);
				$flags[] = $parts[0];
			}
		}
		closedir ($h);
		sort($flags, SORT_STRING);
		return $flags;	
	}
	// look for default value: a default value is 2 consecutive same value
	function set_default_dropdown_option($field) {
		for ($io = 0; $io < sizeof($field['options_array']); ++$io) {
			if ($io > 0 && $field['options_array'][$io] == $field['options_array'][$io - 1]) {
				$field['defaultvalue'] = $field['options_array'][$io];
				for (; $io < sizeof($field['options_array']) - 1; ++$io) {
					$field['options_array'][$io] = $field['options_array'][$io + 1];
				}
				unset($field['options_array'][$io]);
				break;
			}
		}
		return $field;
	}

}

global $dbTiki, $tikilib;
//if(isset($trk_with_mirror_tables) && $trk_with_mirror_tables == 'y') {
if($tikilib->get_preference('trk_with_mirror_tables') == 'y') {
	include_once ("trkWithMirrorTablesLib.php");
	$trklib = new TrkWithMirrorTablesLib($dbTiki);
}
else {
	$trklib = new TrackerLib($dbTiki);
}

?>
