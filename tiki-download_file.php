<?php
// CVS: $Id: tiki-download_file.php,v 1.17.2.11 2007/10/26 15:31:56 sylvieg Exp $
// Initialization
$output_zip = 'n';
require_once('tiki-setup.php');
include_once ('lib/stats/statslib.php');

if($feature_file_galleries != 'y') {
  $smarty->assign('msg',tra("This feature is disabled"));
  $smarty->display("error.tpl");
  die;
}

/*
Borrowed from http://php.net/manual/en/function.readfile.php#54295
to come over the 2MB readfile() limitation
*/
function readfile_chunked($filename,$retbytes=true) {
   $chunksize = 1*(1024*1024); // how many bytes per chunk
   $buffer = '';
   $cnt =0;
   $handle = fopen($filename, 'rb');
   if ($handle === false) {
       return false;
   }
   while (!feof($handle)) {
       $buffer = fread($handle, $chunksize);
       echo $buffer;
       ob_flush();
       flush();
       if ($retbytes) {
           $cnt += strlen($buffer);
       }
   }
       $status = fclose($handle);
   if ($retbytes && $status) {
       return $cnt; // return num. bytes delivered like readfile() does.
   }
   return $status;
}

if (isset($_REQUEST["fileId"])) {
	$info = $tikilib->get_file($_REQUEST["fileId"]);
}
elseif (isset($_REQUEST["galleryId"]) && isset($_REQUEST["name"])) {
	$info = $tikilib->get_file_by_name($_REQUEST["galleryId"], $_REQUEST["name"]);
	$_REQUEST["fileId"] = $info['fileId'];
}
else {
  die;
}
if (!is_array($info)) {
	$smarty->assign('msg',tra('Incorrect param'));
	$smarty->display('error.tpl');
	die;
}

$fgal_use_db=$tikilib->get_preference('fgal_use_db','y');
$fgal_use_dir=$tikilib->get_preference('fgal_use_dir','');

if ($tiki_p_admin_file_galleries != 'y' && !$tikilib->user_has_perm_on_object($user, $info['galleryId'], 'file gallery', 'tiki_p_download_files')) {
	$smarty->assign('msg',tra("You can not download files"));
	$smarty->display("error.tpl");
	die;
}

if (!IsSet($_SERVER['REQUEST_URI'])) { 
	$_SERVER['REQUEST_URI'] = ''; 
	
	if (IsSet($_SERVER['PHP_SELF'])) { 
	$_SERVER['REQUEST_URI'] = $_SERVER 
	['REQUEST_URI'].$_SERVER['PHP_SELF']; 
	} 
	
	if (IsSet($_SERVER['QUERY_STRING'])) { 
	$_SERVER['REQUEST_URI'] = $_SERVER 
	['REQUEST_URI'].'?'.$_SERVER['QUERY_STRING']; 
	} 
}

$foo = parse_url($_SERVER["REQUEST_URI"]);
$foo1=str_replace("tiki-browse_image","tiki-browse_image",$foo["path"]);
$foo2=str_replace("tiki-browse_image","show_image",$foo["path"]);
$smarty->assign('url_browse',$tikilib->httpPrefix().$foo1);
$smarty->assign('url_show',$tikilib->httpPrefix().$foo2);

$tikilib->add_file_hit($_REQUEST["fileId"]);

$type=&$info["filetype"];
$file=&$info["filename"];
$content=&$info["data"];

//add a hit
$statslib->stats_hit($file,"file",$_REQUEST["fileId"]);

// close the session in case of large downloads to enable further browsing
session_write_close();

//print("File:$file<br />");
//die;
header("Content-type: $type");

// Added by Jenolan  31/8/2003 /////////////////////////////////////////////
// File galleries should always be attachments (files) not inline (textual)
header( "Content-Disposition: attachment; filename=\"$file\"" );
//header( "Content-Disposition: inline; filename=$file" );

if( $info["path"] )
{
	header("Content-Length: ". filesize( $fgal_use_dir.$info["path"] ) );
}
else
{
	header("Content-Length: ". $info[ "filesize" ] );
}

////////////////////////////////////////////////////////////////////////////
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Pragma: public");
if($info["path"]) {
  readfile_chunked($fgal_use_dir.$info["path"]);
} else {
  echo "$content";
}
?>
