<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

/* Task properties:
   user, taskId, title, description, date, status, priority, completed, percentage
*/
class FaqLib extends TikiLib {
	function FaqLib($db) {
		# this is probably uneeded now
		if (!$db) {
			die ("Invalid db object passed to FAQLib constructor");
		}

		$this->db = $db;
	}

	function add_suggested_faq_question($faqId, $question, $answer, $user) {
		$question = strip_tags($question, '<a>');

		$answer = strip_tags($answer, '<a>');
		$now = date("U");
		$query = "insert into `tiki_suggested_faq_questions`(`faqId`,`question`,`answer`,`user`,`created`)
    values(?,?,?,?,?)";
		$result = $this->query($query,array($faqId,$question,$answer,$user,$now));
	}

	function list_suggested_questions($offset, $maxRecords, $sort_mode, $find, $faqId) {
		$bindvars=array();
		if ($find || $faqId) {
			$mid = " where ";
			if ($find) {
				$findesc = '%' . $find . '%';
				$mid .= "(`question` like ? or `answer` like ?)";
				$bindvars[]=$findesc;
				$bindvars[]=$findesc;
				if ($faqId) {
					$mid .= " and ";
				}
			}
			if ($faqId) {
				$mid .= "`faqId`=?";
				$bindvars[]=$faqId;
			}
		} else {
			$mid = "";
		}

		$query = "select * from `tiki_suggested_faq_questions` $mid order by ".$this->convert_sortmode($sort_mode);
		$query_cant = "select count(*) from `tiki_suggested_faq_questions` $mid";
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

	function list_all_faq_questions($offset, $maxRecords, $sort_mode, $find) {

		$bindvars=array();
		if ($find) {
			$findesc = '%' . $find . '%';

			$mid = " where (`question` like ? or `answer` like ?)";
			$bindvars[]=$findesc;
			$bindvars[]=$findesc;
		} else {
			$mid = "";
		}

		$query = "select * from `tiki_faq_questions` $mid order by ".$this->convert_sortmode($sort_mode);
		$query_cant = "select count(*) from `tiki_faq_questions` $mid";
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

	function remove_faq($faqId) {
		$query = "delete from `tiki_faqs` where `faqId`=?";

		$result = $this->query($query,array($faqId));
		$query = "delete from `tiki_faq_questions` where `faqId`=?";
		$result = $this->query($query,array($faqId));
		// Remove comments and/or individual permissions for faqs
		$this->remove_object('faq', $faqId);
		return true;
	}

	function remove_faq_question($questionId) {
		$faqId = $this->getOne("select `faqId` from `tiki_faq_questions` where `questionId`=?",array($questionId));

		$query = "delete from `tiki_faq_questions` where `questionId`=?";
		$result = $this->query($query,array($questionId));
		$query = "update `tiki_faqs` set `questions`=`questions`-1 where `faqId`=?";
		$result = $this->query($query,array($faqId));
		return true;
	}

	function get_faq_question($questionId) {
		$query = "select * from `tiki_faq_questions` where `questionId`=?";

		$result = $this->query($query,array($questionId));

		if (!$result->numRows())
			return false;

		$res = $result->fetchRow();
		return $res;
	}

	function add_faq_hit($faqId) {
		global $count_admin_pvs;

		global $user;

		if ($count_admin_pvs == 'y' || $user != 'admin') {
			$query = "update `tiki_faqs` set `hits`=`hits`+1 where `faqId`=?";

			$result = $this->query($query,array($faqId));
		}
	}

	function replace_faq_question($faqId, $questionId, $question, $answer) {

		// Check the name
		if ($questionId) {
			$query = "update `tiki_faq_questions` set `question`=?,`answer`=? where `questionId`=?";
			$bindvars=array($question,$answer,(int) $questionId);
			$result = $this->query($query,$bindvars);
		} else {
			$query = "update `tiki_faqs` set `questions`=`questions`+1 where `faqId`=?";

			$result = $this->query($query,array((int) $faqId));
			$query = "delete from `tiki_faq_questions` where `faqId`=? and question=?";
			$result = $this->query($query,array((int) $faqId,$question),-1,-1,false);
			$query = "insert into `tiki_faq_questions`(`faqId`,`question`,`answer`)
                		values(?,?,?)";
			$result = $this->query($query,array((int) $faqId,$question,$answer));
		}

		return true;
	}

	function replace_faq($faqId, $title, $description, $canSuggest) {

		// Check the name
		if ($faqId) {
			$query = "update `tiki_faqs` set `title`=?,`description`=? ,`canSuggest`=? where `faqId`=?";

			$result = $this->query($query,array($title,$description,$canSuggest,(int) $faqId));
		} else {
			$now = date("U");
			$query = "delete from `tiki_faqs`where `title`=?";
			$result = $this->query($query,array($title),-1,-1,false);
			$query = "insert into `tiki_faqs`(`title`,`description`,`created`,`hits`,`questions`,`canSuggest`)
                		values(?,?,?,?,?,?)";
			$result = $this->query($query,array($title,$description,(int) $now,0,0,$canSuggest));
			$faqId = $this->getOne("select max(`faqId`) from `tiki_faqs` where `title`=? and `created`=?",array($title,(int) $now));
		}

		return $faqId;
	}

	function list_faq_questions($faqId, $offset, $maxRecords, $sort_mode, $find) {

		if ($find) {
			$findesc = '%' . $find . '%';

			$mid = " where `faqId`=? and (`question` like ? or `answer` like ?)";
			$bindvars=array((int) $faqId,$findesc,$findesc);
		} else {
			$mid = " where `faqId`=? ";
			$bindvars=array((int) $faqId);
		}

		$query = "select * from `tiki_faq_questions` $mid order by ".$this->convert_sortmode($sort_mode);
		$query_cant = "select count(*) from `tiki_faq_questions` $mid";
		$result = $this->query($query,$bindvars,$maxRecords,$offset);
		$cant = $this->getOne($query_cant,$bindvars);
		$ret = array();

		while ($res = $result->fetchRow()) {
			$res['parsed'] = $this->parse_data($res['answer']);

			$ret[] = $res;
		}

		$retval = array();
		$retval["data"] = $ret;
		$retval["cant"] = $cant;
		return $retval;
	}

	function remove_suggested_question($sfqId) {
		$query = "delete from `tiki_suggested_faq_questions` where `sfqId`=?";

		$result = $this->query($query,array((int) $sfqId));
	}

	function approve_suggested_question($sfqId) {
		$info = $this->get_suggested_question($sfqId);

		$this->replace_faq_question($info["faqId"], 0, $info["question"], $info["answer"]);
		$this->remove_suggested_question($sfqId);
	}

	function get_suggested_question($sfqId) {
		$query = "select * from `tiki_suggested_faq_questions` where `sfqId`=?";

		$result = $this->query($query,array($sfqId));

		if (!$result->numRows())
			return false;

		$res = $result->fetchRow();
		return $res;
	}
}
global $dbTiki;
$faqlib = new FaqLib($dbTiki);

?>
