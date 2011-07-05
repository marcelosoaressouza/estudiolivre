<?php
//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

class MultilingualLib extends TikiLib {
	/** brief add a translation
	  */
	function MultilingualLib($db) {
		parent::TikiLib($db);
	}
	/* @brief add an object and its transaltion set into the set of translations of another one
	 * @param: type = (idem tiki_categ) 'wiki page'...
	 * @param: srcId = id of the source
	 * @param: srcLang = lang of the source
	 * @param: objId = id of the translation
	 * @param: objLang = lang of the translation
	 * @requirment: no translation of the source in this lang must exist
	 */
	function insertTranslation($type, $srcId, $srcLang, $objId, $objLang) {
		$srcTrads = $this->getTrads($type, $srcId);
		$objTrads = $this->getTrads($type, $objId);
		if (!$srcTrads && !$objTrads) {
			$query = "insert into `tiki_translated_objects` (`type`,`objId`,`lang`) values (?,?,?)";
			$this->query($query, array($type, $srcId, $srcLang));
			$query = "select max(`traId`) from `tiki_translated_objects` where `type`=? and `objId`=?";
			$tmp_traId = $this->getOne($query, array( $type, $srcId ) );
			$query = "insert into `tiki_translated_objects` (`type`,`objId`,`traId`,`lang`) values (?,?,?,?)";
			$this->query($query, array($type, $objId, $tmp_traId, $objLang));
			//last_insert_id is not postgres compatible
			//$query = "insert into `tiki_translated_objects` (`type`,`objId`,`traId`,`lang`) values (?,?,last_insert_id(),?)";
			//$this->query($query, array($type, $objId, $objLang));
			return  null;
		}
		elseif (!$srcTrads) {
			if ($this->exist($objTrads, $srcLang, 'lang'))
					return "alreadyTrad";
			$query = "insert into `tiki_translated_objects` (`type`,`objId`,`traId`,`lang`) values (?,?,?,?)";
			$this->query($query, array($type, $srcId, $objTrads[0]['traId'], $srcLang));
			return null;
		}
		elseif (!$objTrads) {
			if ($this->exist($srcTrads, $objLang, 'lang'))
					return "alreadyTrad";
			$query = "insert into `tiki_translated_objects` (`type`,`objId`,`traId`,`lang`) values (?,?,?,?)";
			$this->query($query, array($type, $objId, $srcTrads[0]['traId'], $objLang));
			return null;
		}
		elseif  ($srcTrads[0]['traId'] == $objTrads[0]['traId']) {
			return "alreadySet";
		}
		else {
			foreach ($srcTrads as $t) {
				if ($this->exist($objTrads, $t['lang'], 'lang'))
					return "alreadyTrad";
			}
			$query = "update `tiki_translated_objects`set `traId`=? where `traId`=?";
			$this->query = $this->query($query, array($srcTrads[0]['traId'], $objTrads[0]['traId']));
			return null;
		}
	}

	/* @brief update the object for the language of a translation set
	 * @param $objId: new object for the translation of $srcId of type $type in the language $objLang
	 */
	function updateTranslation($type, $srcId, $objId, $objLang) {
		$query = "update `tiki_translated_objects` set `objId`=? where `type`=? and `srcId`=? and `lang`=?";
		$this->query($query, array($objId, $type, $srcId, $objLang));
	}

	/** @brief get the translation in a language of an object if exists
	 * @return array(objId, traId)
	 */
	function getTranslation($type, $srcId, $objLang) {
		$query = "select t2.`objId`, t2.`traId` from `tiki_translated_objects` as t1, `tiki_translated_objects` as t2 where t1.`traId`=t2.`traId` and t1.`type`=? and  t1.`objId`=? and t2.`lang`=?";
		return $this->getOne($query, array($type, $srcId, $objLang));
	}

	function getTrads($type, $objId) {
		$query = "select t2.`traId`, t2.`objId`, t2.`lang` from `tiki_translated_objects` as t1, `tiki_translated_objects` as t2 where t1.`traId`=t2.`traId` and t1.`type`=? and  t1.`objId`=?";
		$result = $this->query($query, array($type, (string) $objId));
		$ret = array();
		while ($res = $result->fetchRow()) {
			$ret[] = $res;
		}
		return $ret;
	}

	/* @brief gets all the translations of an object
	 * @param type = (idem tiki_categ) 'wiki page'...
	 * @param objId = object Id
	 * @return if long is false: array(objId, lang, langName ) with langName=localized language name
	 * @return if long id true: array(objId, objName, lang, langLongFormat)
	 */
	function getTranslations($type, $objId, $objName, $objLang, $long=false) {
		if ($type == 'wiki page') {
			$query = "select t2.`objId`, t2.`lang`, p.`pageName`as `objName` from `tiki_translated_objects` as t1, `tiki_translated_objects` as t2 LEFT JOIN `tiki_pages` p ON p.`page_id`=t2.`objId` where t1.`traId`=t2.`traId` and t2.`objId`!= t1.`objId` and t1.`type`=? and  t1.`objId`=?";
		}
		elseif ($long) {
			$query = "select t2.`objId`, t2.`lang`, a.`title` as `objName` from `tiki_translated_objects` as t1, `tiki_translated_objects` as t2, `tiki_articles` as a where t1.`traId`=t2.`traId` and t2.`objId`!= t1.`objId` and t1.`type`=? and  t1.`objId`=? and a.`articleId`=t2.`objId`";
		}
		else {
			$query = "select t2.`objId`, t2.`lang` from `tiki_translated_objects` as t1, `tiki_translated_objects` as t2 where t1.`traId`=t2.`traId` and t2.`objId`!= t1.`objId` and t1.`type`=? and  t1.`objId`=?";
		}
		$result = $this->query($query, array($type, $objId));
		$ret = array();
		if ($long) {
			$l = $this->format_language_list(array($objLang));
			$ret0 = array('objId'=>$objId, 'objName'=>$objName, 'lang'=> $objLang, 'langName'=>$l[0]['name']);
			while ($res = $result->fetchRow()) {
				$l = $this->format_language_list(array($res['lang']));
				$res['langName'] = $l[0]['name'];
				$ret[] = $res;
			}
		}
		else {
			$l = $this->format_language_list(array($objLang), 'y');
			$ret0 = array('objId'=>$objId, 'objName'=>$objName, 'lang'=> $objLang, 'langName'=>$l[0]['name']);
			while ($res = $result->fetchRow()) {
				$l = $this->format_language_list(array($res['lang']), 'y');
				$res['langName'] = $l[0]['name'];
				$ret[] = $res;
				}
		}
		usort($ret, array('MultilingualLib', 'compare_lang'));
		array_unshift($ret, $ret0);
		return $ret;
	}

	/* @brief sort function on langName string
	 */
	function compare_lang($l1, $l2) {
		return strcmp($l1['langName'], $l2['langName']);
	}

	/* @brief: update lang in all tiki pages
	 */
	function updatePageLang($type, $objId, $lang, $optimisation = false) {
		if ($this->getTranslation($type, $objId, $lang))
			return 'alreadyTrad';
		if (!$optimisation) {
			if ($type == 'wiki page')
				$query = "update `tiki_pages` set `lang`=? where `page_id`=?";
			else
				$query = "update `tiki_articles` set `lang`=? where `articleId`=?";
			$this->query($query,array($lang, $objId));
		}

		$query = "update `tiki_translated_objects` set `lang`=? where `objId`=?";
		$this->query($query,array($lang, $objId));
		return null;
	}

	/* @brief: detach one translation
	 */
	function detachTranslation($type, $objId) {
		$query = "delete from `tiki_translated_objects` where `type`= ? and `objId`=?";
		$this->query($query,array($type, $objId));
//@@TODO: delete the set if only one remaining object - not necesary but will clean the table
	}
	
	/* @brief : test if val exists in a list of objects
	 */
	function exist($tab, $val, $col) {
		foreach ($tab as $t) {
			if ($t[$col] == $val)
				return true;
		}
		return false;
	}

	/* @brief : returns an ordered list of prefered languages
	 * @param $langContext: optional the language the user comes from
	 */
	function preferedLangs($langContext = null) {
		global $user, $language, $tikilib;
		$langs = array();

		if ($langContext) {
			$langs[] = $langContext;
			if (strchr($langContext, "-")) // add en if en-uk
				$langs[] = $this->rootLang($langContext);
		}
		
		if ($language && !in_array($language, $langs)) {
			$langs[] = $language;
			$l = $this->rootLang($language);
			if (!in_array($l, $langs))
				$langs[] = $l;
		}

		if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
			$ls = preg_split('/\s*,\s*/', preg_replace('/;q=[0-9.]+/','',$_SERVER['HTTP_ACCEPT_LANGUAGE'])); // browser
			foreach ($ls as $l) {
				if (!in_array($l, $langs)) {
					$langs[] = $l;
					$l = $this->rootLang($l);
					if (!in_array($l, $langs))
						$langs[] = $l;
				}
			}
		}

		$l = $tikilib->get_preference("language", "en");
		if (!in_array($l, $langs)) {
			$langs[] = $l; // site language
			$l = $this->rootLang($language);
			if (!in_array($l, $langs))
				$langs[] = $l;
		}
		return $langs;	
	}
	/* @brief : return the root language ex: en-uk returns en
	 */
	function rootLang($lang) {
		return ereg_replace("(.*)-(.*)", "\\1", $lang);
	}

	/* @brief : fitler a list of object to have only one objet in the set of translations with the best language
	 */
	function selectLangList($type, $listObjs, $langContext = null) {
		if (!$listObjs || count($listObjs) <= 1)
			return $listObjs;
		$langs = $this->preferedLangs($langContext);
//echo "<pre>";print_r($langs);echo "</pre>";
		$max = count($listObjs);
		for ($i = 0; $i < $max; ++$i) {
			if (!isset($listObjs[$i]) || !isset($listObjs[$i]['lang']))
				continue; // previously withdrawn or no language
			if ($type == 'wiki page')
				$objId = $listObjs[$i]['page_id'];
			else if ($type == 'objId')
				$objId = $listObjs[$i]['objId'];
			else
				$objId = $listObjs[$i]['articleId'];
			$trads = $this->getTrads($type, $objId);
			if (!$trads)
				continue;
			for ($j = $i + 1; $j < $max; ++$j) {
				if (!isset($listObjs[$j]))
					continue;
				if ($type == 'wiki page')
					$objId2 = $listObjs[$j]['page_id'];
				else if ($type == 'objId')
					$objId2 = $listObjs[$j]['objId'];
				else
					$objId2 = $listObjs[$j]['articleId'];
				if ($this->exist($trads, $objId2, 'objId')) {
					$iord = array_search($listObjs[$i]['lang'] , $langs);
					if (!$iord && strchr($listObjs[$i]['lang'], "-"))
						$iord = array_search($this->rootLang($listObjs[$i]['lang']), $langs);
					$jord = array_search($listObjs[$j]['lang'] , $langs);
					if (!$jord && strchr($listObjs[$j]['lang'], "-"))
						$jord = array_search($this->rootLang($listObjs[$j]['lang']), $langs);
					if ($jord === false) {
						unset($listObjs[$j]); // not in the pref langs
					}
					else if ($iord === false) {
						unset($listObjs[$i]);
						break;
					}
					else if ($iord > $jord) {
						unset($listObjs[$i]);
						break;
					}
					else {
						unset($listObjs[$j]);
					}
					// if none in the pref lang, pick the first (sorted by date)
				}
			}
		}
		return array_merge($listObjs);// take away the unset rows
	}

	/* @brief : select the object with the best language from another object
	 */
	function selectLangObj($type, $objId, $langContext = null) {
		$trads = $this->getTrads($type, $objId);
		if (!$trads)
			return $objId;
		$langs = $this->preferedLangs($langContext);
		foreach ($langs as $l) {
			foreach ($trads as $trad) {
				if ($trad['lang'] == $l)
					return $trad['objId'];
			}
		}
		return $objId;
	}
}
global $dbTiki;
$multilinguallib = new MultilingualLib($dbTiki);
?>
