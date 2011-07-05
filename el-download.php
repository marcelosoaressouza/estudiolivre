<?
//migrado pra 2.0!
require_once("tiki-setup.php");
require_once("lib/persistentObj/PersistentObjectFactory.php");

// compativel com os links antigos
if (isset($_REQUEST['arquivo']) && !isset($_REQUEST['pub'])) {
	$_REQUEST['pub'] = $_REQUEST['arquivo'];
	$_REQUEST['file'] = 0;
}

if (!isset($_REQUEST['pub']) || $_REQUEST['pub'] == 0) {
    $smarty->assign('msg', tra("Publicação inexistente"));
    $smarty->display("error.tpl");
    die;
}

$pub = PersistentObjectFactory::createObject("Publication", (int)$_REQUEST['pub']);

if (isset($_REQUEST['file'])) {
	$file =& $pub->filereferences[(int)$_REQUEST['file']];
	$file->hitDownload();
	$location = $file->fullPath();
    if ($file->mimeType == 'audio/mpeg') addMp3Headers($location, $file->size); //para forçar o download
} elseif (isset($_REQUEST['action']) && $_REQUEST['action'] == 'downloadAll') {
	if (count($pub->filereferences) == 1) {
		$file =& $pub->filereferences[0];
		$file->hitDownload();
		$location = $file->fullPath();
        if ($file->mimeType == 'audio/mpeg') addMp3Headers($location, $file->size); //para forçar o download
	} else {
		$fileList = "";
		foreach ($pub->filereferences as $file) {
			$file->hitDownload();
		}
		if (!$pub->allFile) {
			$tarFullPath = $pub->fileDir() . $pub->id . ".tar";
			exec("tar -cf $tarFullPath --exclude thumb* -C repo/ $pub->id", $a, $out);
			if (!$out) $pub->update(array("allFile" => $tarFullPath));
		}
		$location = $pub->allFile;
	}
}

function addMp3Headers($filename, $size) {
   // required for IE, otherwise Content-disposition is ignored
       if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off'); }
       
       // build file headers
   header("Pragma: public");
   header("Expires: 0");
   header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
   header("Cache-Control: private",false);
   header("Content-Type: audio/x-mp3");
   header("Content-Disposition: attachment; filename=\"$filename\";" );
   header("Content-Transfer-Encoding: binary");
   header("Content-Length: $size");
   readfile($filename);
   exit;
}

header("location: $location");
exit;

?>
