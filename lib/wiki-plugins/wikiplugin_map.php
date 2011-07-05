<?php

// Displays an inline map
// Use:
// {MAP()}
//  (mapfile=>) 
//  (extents=>)


function wikiplugin_map_help() {
	return tra("Displays a map").":<br />~np~{MAP(mapfile=>,extents=>,size=>,width=>,height=>) /}~/np~";
}

function wikiplugin_map($data, $params) {
	global $tikilib;
	global $feature_maps;

	extract ($params,EXTR_SKIP);

	$mapdata="";
	if (isset($mapfile)) {
		$mapdata='mapfile='.$mapfile.'&';
	}

	$extdata="";
	if (isset($extents)) {
		$dataext=explode("|",$extents);
		if (count($dataext)==4) {
			$minx=floatval($dataext[0]);
			$maxx=floatval($dataext[1]);
			$miny=floatval($dataext[2]);
			$maxy=floatval($dataext[3]);
			$extdata="minx=".$minx."&maxx=".$maxx."&miny=".$miny."&maxy=".$maxy."&zoom=1&";
		}
	}
	
	$sizedata="";
	if (isset($size)) {
		$sizedata="size=".intval($size)."&";
	}
	$widthdata="";
	if (isset($width)) {
		$widthdata='width="'.intval($width).'"';
	}
	$heightdata="";
	if (isset($height)) {
		$heightdata='height="'.intval($height).'"';
	}	
	if(@$feature_maps != 'y') {
		$map=tra("Feature disabled");
	} else {
		$map='<object border="0" hspace="0" vspace="0" type="text/html" data="tiki-map.phtml?'.$mapdata.$extdata.$sizedata.'maponly=frame" '.$widthdata.' '.$heightdata.'><a href="tiki-map.phtml?'.$mapdata.$extdata.$sizedata.'"><img src="tiki-map.phtml?'.$mapdata.$extdata.$sizedata.'maponly=yes"/></a></object>';

	}
	return $map;
}

?>