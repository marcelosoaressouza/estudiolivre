<?php


//this script may only be included - so its better to die if called directly.
if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

include ('lib/pdflib/class.ezpdf.php');
include ('lib/htmlparser/htmlparser.inc');

class TikiPdfLib extends Cezpdf
{

function TikiPdfLib(&$pdfopts) 
{
  $this->Cezpdf();
  //defaults
  //may be configurable from a tiki menu
  $this->tiki_font="lib/pdflib/fonts/".$pdfopts["font"].".afm";
  $this->tiki_textheight=$pdfopts["textheight"];
  $this->tiki_h1height=$pdfopts["h1height"];
  $this->tiki_h2height=$pdfopts["h2height"];
  $this->tiki_h3height=$pdfopts["h3height"];
  $this->tiki_tbheight=$pdfopts["tbheight"];
  $this->tiki_imagescale=$pdfopts["imagescale"];

  $this->selectFont($this->tiki_font);

  $grammarfile='lib/htmlparser/htmlgrammar.cmp';
	if(!$fp=@fopen($grammarfile,'r')) die();
  $this->html_grammar=unserialize(fread($fp,filesize($grammarfile)));
	fclose($fp);
}

function insert_html(&$data)
{
  // new code starts here
  // read grammar
//  $grammarfile='lib/htmlparser/htmlgrammar.cmp';
//  if(!$fp=@fopen($grammarfile,'r')) die();
//  $grammar=unserialize(fread($fp,filesize($grammarfile)));
//  fclose($fp);
  // create parser object and insert html code
  $htmlparser=new HtmlParser($data,$this->html_grammar,'',0);
  // parse it
  $htmlparser->Parse();
  //debug output
  /*
  echo "<pre>";
  echo $data;
  echo "\n\n und jetzt geparsed:\n\n";
  print_r($htmlparser->content);
  echo  "</pre>";
  */

  // now set it together
  $src='';
  $dummy=array();
  $this->WalkParsedArray($htmlparser->content,$src,$dummy);
  /*
  echo "<pre>";
  echo "Walk array:\n\n";
  echo $src;
  echo "</pre>";
  die();
  */
  $this->flush($src);
  // new code ends here
  

  /* old code starts here
  //$fpd=fopen("/tmp/tikidebug",'a');fwrite($fpd,"data before parsing:\n$data\n");fclose($fpd);
  //parse data

  //replace <br />
  $data=preg_replace("#<br />#","\n",$data);
  //replace <br />
  $data=preg_replace("#<br />#","\n",$data);
  $data=preg_replace("#<br />#","\n",$data);
  // titlebar
  $data=preg_replace("#<div class=['\"]titlebar['\"]>(.+)</div>#","<C:titlebar:\$1>",$data);
  //$data=preg_replace("#<div class='titlebar'>(.+)</div>#e","'<C:titlebar:\$1>'.$this->add_linkdestination('$1')",$data);
  //line
  $data=preg_replace("#<hr/>#","<C:hr:>",$data);
  //headings
  $data=preg_replace("#<h1>(.+)</h1>#","<C:h1:\$1>",$data);
  $data=preg_replace("#<h2>(.+)</h2>#","<C:h2:\$1>",$data);
  $data=preg_replace("#<h3>(.+)</h3>#","<C:h3:\$1>",$data);
  //images
  $data=preg_replace("#<img(.+)src=[\"\']([^\"|^\']+)[\"\'].*\\>#","<C:img:\$2>",$data);
  //links
  $data=preg_replace("#<a.+href=[\"\']([^\"|^\']+)[\"\'].*>(.*)</a>#e","\$this->whatlink('$1','$2')",$data);

  //$fpd=fopen("/tmp/tikidebug",'a');fwrite($fpd,"before adding text\n");fclose($fpd);
  //$fpd=fopen("/tmp/tikidebug",'a');fwrite($fpd,"data:\n$data\n");fclose($fpd);
  $this->ezText($data,$this->tiki_textheight);
  //$fpd=fopen("/tmp/tikidebug",'a');fwrite($fpd,"after adding text\n");fclose($fpd);
  iold code ends here */
}

function flush($src) {
  $this->ezText($src,$this->tiki_textheight);
}

function WalkParsedArray(&$c,&$src,&$parms) { // stolen from common.inc of the htmlparser lib
  $parms["descend"]=isset($parms["descend"])?$parms["descend"]:true;
  $parms["listlevel"]=isset($parms["listlevel"])?$parms["listlevel"]:0;
  $parms["orderedlist"]=isset($parms["orderedlist"])?$parms["orderedlist"]:array();
  //$descend=true; //recusively descend the array
  //$listlevel=0; //level for lists
  if (!is_array($c)) return;
  for ($i=0;$i<=$c["contentpos"];$i++) { // loop though elements
    switch ($c[$i]["type"]) { // switch type of element (text, tag, ...)
      case "comment":
      case "text":
        if(array_key_exists("tabrow",$parms)) {
	  $parms["tabdata"][$parms["tabrow"]][$parms["tabcol"]]=$c[$i]["data"];
	} else {
          $src.=$c[$i]["data"];
	}
        break;
      case "tag":
        switch($c[$i]["data"]["type"]) { // switch open or close a tag
          case "open":
	    switch($c[$i]["data"]["name"]) { //switch tagname
	      case "br":
	        $src.="\n";
	        break;
	      case "hr":
	        $src.="<C:hr:>\n";
		break;
	      case "h1":
	        $src.="<C:h1:";
		break;
	      case "h2":
	        $src.="<C:h2:";
		break;
	      case "h3":
	        $src.="<C:h3:";
		break;
	      case "img":
	        $src.="<C:img:".$c[$i]["pars"]["src"]["value"].">";
		break;
	      case "b":
	        $src.="<b>";
		break;
	      case "i":
	        $src.="<i>";
		break;
	      case "ul":
	        $parms["listlevel"]=$parms["listlevel"]+1;
		break;
	      case "ol":
	        $parms["listlevel"]=$parms["listlevel"]+1;
	        $parms["orderedlist"][$parms["listlevel"]]=0;
		break;
	      case "li":
	        if (array_key_exists($parms["listlevel"],$parms["orderedlist"])) {
		  $parms["orderedlist"][$parms["listlevel"]]=$parms["orderedlist"][$parms["listlevel"]]+1;
                  for ($j=1; $j<count($parms["orderedlist"])+1;$j++) {
		    $src.=$parms["orderedlist"][$j].".";
		    }
		} else {
	          $src.=str_repeat(" ",$parms["listlevel"])."* ";
		}
		break;
	      case "div":
	        $keys=array_keys($c[$i]["pars"]);
		if (array_key_exists("class",$c[$i]["pars"])) {
		  $classval=$c[$i]["pars"]["class"]["value"];
		  switch($classval) {
                    case "titlebar":
		      $src.="<C:titlebar:";
		      break;
		    case "underline":
		      $src.="<c:uline>";
		      $parms["closetag"]="</c:uline>";
		      break;
		  } // end switch classname
		} // end if
		break;
	      case "span":
	        $keys=array_keys($c[$i]["pars"]);
		if (array_key_exists("style",$c[$i]["pars"])) {
		  $styleval=$c[$i]["pars"]["style"]["value"];
		  switch($styleval) {
		    case "text-decoration:underline;":
		    $src.="<c:uline>";
		    $parms["closetag"]='</c:uline>';
		    break;
		  } // end switch styleval
		} // end if
		break;
	      case "a":
		if (array_key_exists("href",$c[$i]["pars"])) {
	          $hrefsrc=$c[$i]["pars"]["href"]["value"];
		  $hreftext=$c[$i]["content"]["0"]["data"]; //always ["0"] ?
		  $src.=$this->whatlink($hrefsrc,$hreftext);
		} // end if
		$parms["descend"]=false;
		break;
	      //tables
	      case "table":
	        $parms["tabdata"]=array();
		$parms["tabrow"]=-1;
		$parms["tabcol"]=-1;
		$parms["tabmaxcol"]=1;
	        break;
	      case "tr":
		$parms["tabrow"]=$parms["tabrow"]+1;
		$parms["tabdata"][$parms["tabrow"]]=array();
		break;
	      case "td":
		$parms["tabcol"]=$parms["tabcol"]+1;
	      // next case in tags
	      } // end switch tagname
            break;
          case "close":
	    switch($c[$i]["data"]["name"]) { // switch tagname on close
	      case "br":
	      case "img":
	      case "hr":
	      case "a":
	        break;
	      case "b":
	        $src.="</b>";
		break;
	      case "i":
	        $src.="</i>";
		break;
	      case "ul":
	        $parms["listlevel"]=$parms["listlevel"]-1;
		break;
	      case "ol":
		unset($parms["orderedlist"][$parms["listlevel"]]);
	        $parms["listlevel"]=$parms["listlevel"]-1;
		break;
	      case "li":
	        $src.="\n";
		break;
	      case "div":
	      case "span":
	        if(array_key_exists("closetag",$parms)) {
		  $src.=$parms["closetag"];
		  unset($parms["closetag"]);
		} else {
	          $src.=">\n";
		}
		break;
              //tables:
	      case "table":
	        $this->flush($src);
		$src="";
		// fill array
		for ($j=0;$j<count($parms["tabdata"]);$j++)
		  for ($k=0;$k<$parms["tabmaxcol"]+1;$k++)
		    if(!isset($parms["tabdata"][$j][$k]))
		      $parms["tabdata"][$j][$k]="";
		// add table
		$this->ezTable($parms["tabdata"],null,null,array("showHeadings" => 0));
		unset ($parms["tabdata"]);
                unset ($parms["tabrow"]);
		unset ($parms["tabcol"]);
	        break;
	      case "tr":
	        if($parms["tabmaxcol"]<$parms["tabcol"]) $parms["tabmaxcol"]=$parms["tabcol"];
	        $parms["tabcol"]=-1;
	        break;
	      case "td":
	        break;
	      case "h1":
	      case "h2":
	      case "h3":
	        $src.=">\n";
		break;
	      default:
                $src.=">";
		break;
	    } // end switch tagname on close
            break;
        } // end switch tag open or close
        break;
    } // switch type of element (text, tag, ...)
    if ($parms["descend"]) {
      if (isset($c[$i]["content"])) $this->WalkParsedArray($c[$i]["content"],$src,$parms); // recursion
    } else {
      $parms["descend"]=true; //reset mode
    }
  } // end loop though elements
  return ($parms);
}


function completeLink($link)
{
  if (strpos($link,"http") === 0) return($link);
  $https_mode = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on';
  $port=":".$_SERVER['SERVER_PORT'];

  if ($https_mode) {
    $http_prefix="https://" ; }
  else {
    $http_prefix="http://";
    if ($port == ":80") $port="";}
 
  $http_path=preg_replace("#tiki-export_pdf.php#","",$_SERVER["SCRIPT_NAME"]);
	if (!isset($_SERVER["SERVER_NAME"])) {
		$_SERVER["SERVER_NAME"] = $_SERVER["HTTP_HOST"];
	}
  //echo "returning: ".$http_prefix.$_SERVER["SERVER_NAME"].$port.$http_path.$link;
  return($http_prefix.$_SERVER["SERVER_NAME"].$port.$http_path.$link);
}

function whatlink($link,$text)
{
  //$fpd=fopen("/tmp/tikidebug",'a');fwrite($fpd,"whatlink: link: $link text: $text\n");fclose($fpd);
  // for building non-relative links
  $https_mode = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on';
  $port=":".$_SERVER['SERVER_PORT'];
  $http_path=preg_replace("#tiki-export_pdf.php#","",$_SERVER["SCRIPT_NAME"]);
  
  if ($https_mode) {
    $http_prefix="https://" ; }
  else {
    $http_prefix="http://";
    if ($port == ":80") $port="";}

	if (!isset($_SERVER["SERVER_NAME"])) {
		$_SERVER["SERVER_NAME"] = $_SERVER["HTTP_HOST"];
	}

  //wiki link?
  if (strpos($link,"tiki-index.php") === 0) {
    //internal link?
    $linkpage=preg_replace("#tiki-index.php\?page=#","",$link);
    if (array_search($linkpage,$this->linkdest)!== FALSE) {
      //$fpd=fopen("/tmp/tikidebug",'a');fwrite($fpd,"<c:ilink:$linkpage>$text</c:ilink>\n");fclose($fpd);
      return("<c:ilink:$linkpage>$text</c:ilink>");
    } else {
      //$fpd=fopen("/tmp/tikidebug",'a');fwrite($fpd,"<c:alink:".$http_prefix.$_SERVER["SERVER_NAME"].$port.$http_path.$link.">$text</c:alink>\n");fclose($fpd);
      return("<c:alink:".$http_prefix.$_SERVER["SERVER_NAME"].$port.$http_path.$link.">$text</c:alink>");
    }
  }

  if (strpos($link,"http") === FALSE)
  {
    $link=$http_prefix.$_SERVER["SERVER_NAME"].$port.$http_path.$link;
  }
  //$fpd=fopen("/tmp/tikidebug",'a');fwrite($fpd,"<c:alink:$link>$text</c:alink>\n");fclose($fpd);
  return ("<c:alink:$link>$text</c:alink>");
}

function insert_linkdestinations($convertpages)
{
  $this->linkdest=$convertpages;
}

function add_linkdestination($ld)
{
  $this->linkdest[]=$ld;
}

function page($info)
{
  $this->currentpage=$info["p"];
  $this->addDestination($info["p"],"Fit");
  $this->ezText($info["p"],$this->tiki_h1height);
}

function hr($info)
{
  $this->line($this->ez['leftMargin'], $this->y,
	      $this->ez['pageWidth']-$this->ez['rightMargin'],$this->y);
}


function img($info)
{
  $info["p"]=$this->completeLink($info["p"]);
  $info["p"]=str_replace("&amp;","&",$info["p"]);
  //hope GD is installed properly and the image is a jpg!
  $fp = fopen($info["p"],"r");
  if($fp) {
    $data = fread($fp, 1000000);
    fclose($fp);
  } else {
    $this->ezText($info["p"]." could not be uploaded.\n",$this->tiki_textheight);
    return;
  }

  $data=imagecreatefromstring($data);
  $x=round(imagesx($data)*$this->tiki_imagescale);
  $y=round(imagesy($data)*$this->tiki_imagescale);
  //add some space for the image
  $this->ezSetDy(-$y,'makeSpace');
  //insert image
  $this->addImage($data,$info["x"],$info["y"]-$y,$x,$y);
}

function h1($info)
{
  $this->ezText($info["p"],$this->tiki_h1height);
}

function h2($info)
{
  $this->ezText($info["p"],$this->tiki_h2height);
}

function h3($info)
{
  $this->ezText($info["p"],$this->tiki_h3height);
}

//Callback functions. See ezpdf manual

function titlebar($info)
{
  $this->transaction('start');
  $ok=0;
  while (!$ok){
    // not working and not yet useful:
    //$this->addDestination($this->currentpage."-".$info["p"],"left");
    $thisPageNum = $this->ezPageCount;
    $this->saveState();
    $this->setColor(0.9,0.9,0.9);
    $this->filledRectangle($this->ez['leftMargin'],
		$this->y-$this->getFontHeight($this->tiki_tbheight)+
		$this->getFontDecender($this->tiki_tbheight),
		$this->ez['pageWidth']-$this->ez['leftMargin']-
		$this->ez['rightMargin'],
		$this->getFontHeight($this->tiki_tbheight));
    $this->restoreState();
    $this->ezText($info["p"],$this->tiki_tbheight,
		array('justification'=>'center'));
    if ($this->ezPageCount==$thisPageNum){
      $this->transaction('commit');
      $ok=1;
    } else {
      // then we have moved onto a new page, bad bad, as the background colour will be on the old one
      $this->transaction('rewind');
      $this->ezNewPage();
    }
  }
}


}


?>
