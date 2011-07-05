<?php
// Includes rss feed output in a wiki page
// Usage:
// {RSS(id=>feedId,max=>3,date=>1,author=>1,desc=>1)}{RSS}
// 
// Note that if you are combining feeds, "show publish date" must be checked in  
// the RSS module settings, in order to allow this plugin to sort the combined feeds. 

function wikiplugin_rss_help() {
	return tra("~np~{~/np~RSS(id=>feedId+feedId2,max=>3,date=>1,desc=>1,author=>1)}{RSS} Insert rss feed output into a wikipage");
}

function rss_sort($a,$b) {
	if (isset($a["pubDate"]) && $a["pubDate"] > '') {
  	$datea=strtotime($a["pubDate"]);
	} else {
		$datea=time();
	}
	if (isset($b["pubDate"]) && $b["pubDate"] > '') {
  	$dateb=strtotime($b["pubDate"]);
	} else {
		$dateb=time();
	}	
	if ($datea<$dateb) {
		return true;
	} else {
		return false;
	}
}

function wikiplugin_rss($data,$params) {
	global $smarty;
	global $tikilib;
	global $dbTiki;
	global $rsslib;

	if (!isset($rsslib)) {
		include_once ('lib/rss/rsslib.php');
	}

	extract($params,EXTR_SKIP);

	if (!isset($max)) {$max='10';}
	if (!isset($id)) { $id=1; }
	if (!isset($date)) { $date=0; }
	if (!isset($desc)) { $desc=0; }
	if (!isset($author)) { $author=0; }

	$now = date("U");

	$ids=explode("+",$id);
  
  $items=array();
  foreach ($ids as $val) {
		$rssdata = $rsslib->get_rss_module_content($val);
		$itemsrss = $rsslib->parse_rss_data($rssdata, $val);
		if (count($ids) > 1 && $itemsrss[0]["isTitle"]=="y") {
			$itemsrss=array_slice($itemsrss, 1);
 		}
		$items=array_merge($items,$itemsrss);		
 }
 
  
	$repl="";		
	if ($items[0]["isTitle"]=="y") {
		$repl .= '<div class="wiki"><a target="_blank" href="'.$items[0]["link"].'">'.$items[0]["title"].'</a></div><br />'; 
		$items = array_slice ($items, 1);
	}
	
	usort($items,"rss_sort");

	if (count($items)<$max) $max = count($items);

	$repl .= '<table class="normal">';
	for ($j = 0; $j < $max; $j++) {
		$repl .= '<tr><td class="heading"><a class="tableheading" target="_blank" href="'.$items[$j]["link"].'"><b>'.$items[$j]["title"].'</b></a>';
		if ($author==1 || $date==1) $repl .= '&nbsp;&nbsp;&nbsp;(';
	    if ($author==1 && isset($items[$j]["author"]) && $items[$j]["author"] <> '')
	    	{
	    		$repl .= $items[$j]["author"];
	    		if ($date==1) $repl .= ', ';
	    	}
	    if ($date==1 && isset($items[$j]["pubDate"]) && $items[$j]["pubDate"] <> '')
	    	{ $repl .= ''.$items[$j]["pubDate"]; }
		if ($author==1 || $date==1) $repl .= ')';
		$repl .= '</td></tr>';
		if ($desc==1) {
			$repl .= '<tr><td class="even" colspan="2">'.html_entity_decode($items[$j]["description"]).'</td></tr>';
		    $repl .= '</tr>';
		}
		if ($desc>1) {
					$repl .= '<tr><td class="even" colspan="2">'.substr(strip_tags(html_entity_decode($items[$j]["description"])),0,$desc).' <a class="wiki" href="'.$items[$j]["link"].'">[[...]</a></td></tr>';
		    $repl .= '</tr>';
		}
	}
	$repl .= '</table>';
	return $repl;
}

?>
