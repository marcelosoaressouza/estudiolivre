<?php

//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

class BannerLib extends TikiLib {
	function BannerLib($db) {
		# this is probably uneeded now
		if (!$db) {
			die ("Invalid db object passed to BannersLib constructor");
		}

		$this->db = $db;
	}

	function select_banner($zone) {
		// Things to check
		// UseDates and dates
		// Hours
		// weekdays
		// zone
		// maxImpressions and impressions
		# TODO localize
		$dw = "`".strtolower(date("D"))."`";

		$hour = date("H"). date("i");
		$now = date("U");
		$raw = '';
		//
		//
		$query = "select count(*) from `tiki_banners` where $dw = ? and  `hourFrom`<=? and `hourTo`>=? and
    		( ((`useDates` = ?) and (`fromDate`<=? and `toDate`>=?)) or (`useDates` = ?) ) and
    		`impressions`<`maxImpressions` and `zone`=?";
    		$bindvars=array('y',$hour,$hour,'y',(int) $now,(int) $now,'n',$zone);
		$rows=$this->getOne($query,$bindvars);

		if (!$rows)
			return false;

		$bid = rand(0, $rows - 1);
		//print("Rows: $rows bid: $bid");

		$query = "select * from `tiki_banners` where $dw = ? and  `hourFrom`<=? and `hourTo`>=? and
		( ((`useDates` = ?) and (`fromDate`<=? and `toDate`>=?)) or (`useDates` = ?) ) and
		`impressions`<`maxImpressions` and `zone`=?";
		$result = $this->query($query,$bindvars,1,$bid);

		$res = $result->fetchRow();
		$id = $res["bannerId"];

		switch ($res["which"]) {
		case 'useHTML':
			$raw = $res["HTMLData"];

			break;

		case 'useImage':
			$raw
				= "<div align='center'><a target='_blank' href='banner_click.php?id=" . $res["bannerId"] . "&amp;url=" . urlencode($res["url"]). "'><img alt='banner' border='0' src=\"banner_image.php?id=" . $res["bannerId"] . "\" /></a></div>";

			break;

		case 'useFixedURL':
			@$fp = fopen($res["fixedURLData"], "r");

			if ($fp) {
				$raw = '';

				while (!feof($fp)) {
					$raw .= fread($fp, 4096);
				}
			}

			fclose ($fp);
			break;

		case 'useText':
			$raw = "<a target='_blank' class='bannertext' href='banner_click.php?id=" . $res["bannerId"] . "&amp;url=" . urlencode(
				$res["url"]). "'>" . $res["textData"] . "</a>";

			break;
		}

		// Increment banner impressions here
		$id = $res["bannerId"];

		if ($id) {
			$query = "update `tiki_banners` set `impressions` = `impressions` + 1 where `bannerId` = ?";

			$result = $this->query($query,array($id));
		}

		return $raw;
	}

	function add_click($bannerId) {
		$query = "update `tiki_banners` set `clicks` = `clicks` + 1 where `bannerId`=?";

		$result = $this->query($query,array((int)$bannerId));
	}

	function list_banners($offset = 0, $maxRecords = -1, $sort_mode = 'created_desc', $find = '', $user) {
		if ($user == 'admin') {
			$mid = '';
			$bindvars=array();
		} else {
			$mid = "where `client` = ?";
			$bindvars=array($user);
		}


		if ($find) {
			$findesc = '%' . $find . '%';
			$bindvars[]=$findesc;

			if ($mid) {
				$mid .= " and `url` like ? ";
			} else {
				$mid .= " where `url` like ? ";
			}
		}

		$query = "select * from `tiki_banners` $mid order by ".$this->convert_sortmode($sort_mode);
		$query_cant = "select count(*) from `tiki_banners` $mid";
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

	function list_zones() {
		$query = "select `zone` from `tiki_zones`";

		$query_cant = "select count(*) from `tiki_zones`";
		$result = $this->query($query,array());
		$cant = $this->getOne($query_cant,array());
		$ret = array();

		while ($res = $result->fetchRow()) {
			$ret[] = $res;
		}

		$retval = array();
		$retval["data"] = $ret;
		$retval["cant"] = $cant;
		return $retval;
	}

	function remove_banner($bannerId) {
		$query = "delete from `tiki_banners` where `bannerId`=?";

		$result = $this->query($query,array($bannerId));
	}

	function get_banner($bannerId) {
		$query = "select * from `tiki_banners` where `bannerId`=?";

		$result = $this->query($query,array($bannerId));

		if (!$result->numRows())
			return false;

		$res = $result->fetchRow();
		return $res;
	}

	function replace_banner($bannerId, $client, $url, $title = '', $alt = '', $use, $imageData, $imageType, $imageName, $HTMLData,
		$fixedURLData, $textData, $fromDate, $toDate, $useDates, $mon, $tue, $wed, $thu, $fri, $sat, $sun, $hourFrom, $hourTo,
		$maxImpressions, $zone) {
		$imageData = urldecode($imageData);
		//$imageData = '';
		$now = date("U");

		if ($bannerId) {
			$query = "update `tiki_banners` set
                `client` = ?,
                `url` = ?,
                `title` = ?,
                `alt` = ?,
                `which` = ?,
                `imageData` = ?,
                `imageType` = ?,
                `imageName` = ?,
                `HTMLData` = ?,
                `fixedURLData` = ?,
                `textData` = ?,
                `fromDate` = ?,
                `toDate` = ?,
                `useDates` = ?,
                `created` = ?,
                `zone` = ?,
                `hourFrom` = ?,
                `hourTo` = ?,
                `mon` = ? ,`tue` = ?, `wed` = ?, `thu` = ?, `fri` = ?, `sat` = ?, `sun` = ?,
                `maxImpressions` = ? where `bannerId`=?";

                $bindvars=array($client,$url,$title,$alt,$use,$imageData,$imageType,$imageName,$HTMLData,
                                $fixedURLData, $textData, $fromDate, $toDate, $useDates,$now,$zone,$hourFrom,$hourTo,
				$mon,$tue,$wed,$thu,$fri,$sat,$sun,$maxImpressions,$bannerId);

			$result = $this->query($query,$bindvars);
		} else {
			$query = "insert into `tiki_banners`(`client`, `url`, `title`, `alt`, `which`, `imageData`, `imageType`, `HTMLData`,
                `fixedURLData`, `textData`, `fromDate`, `toDate`, `useDates`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`, `sun`,
                `hourFrom`, `hourTo`, `maxImpressions`,`created`,`zone`,`imageName`,`impressions`,`clicks`)
                values(?,?,?,?,?,?,?,?,
                ?,?,?,?,?,?,?,?,?,
                ?,?,?,?,?,?,?,?,?,?,?)";

                $bindvars=array($client,$url,$title,$alt,$use,$imageData,$imageType,$HTMLData,
                                $fixedURLData, $textData, $fromDate, $toDate, $useDates, $mon,$tue,$wed,$thu,
                                $fri,$sat,$sun,$hourFrom,$hourTo,$maxImpressions,$now,$zone,$imageName,0,0);


			$result = $this->query($query,$bindvars);
			$query = "select max(`bannerId`) from `tiki_banners` where `created`=?";
			$bannerId = $this->getOne($query,array((int)$now));
		}

		return $bannerId;
	}

	function banner_add_zone($zone) {
		$query = "delete from `tiki_zones` where `zone`=?";
		$this->query($query,array($zone),-1,-1,false);
		$query = "insert into `tiki_zones`(`zone`) values(?)";
		$result = $this->query($query,array($zone));
		return true;
	}

	function banner_get_zones() {
		$query = "select * from `tiki_zones`";

		$result = $this->query($query,array());
		$ret = array();

		while ($res = $result->fetchRow()) {
			$ret[] = $res;
		}

		return $ret;
	}

	function banner_remove_zone($zone) {
		$query = "delete from `tiki_zones` where `zone`=?";

		$result = $this->query($query,array($zone));

/* this code following if (0) is never executed, right?
		if (0) {
			$query = "delete from `tiki_banner_zones` where `zoneName`=?";

			$result = $this->query($query,array($zone));
		}
*/

		return true;
	}
}
global $dbTiki;
$bannerlib = new BannerLib($dbTiki);

?>
