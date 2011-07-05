<?php

// esse arquivo salva o upload dos thumbnails
require_once("tiki-setup.php");
require_once("lib/filegals/filegallib.php");
include_once("el-gallery_set_publication.php");

function error($errorMsg, $num) {
	global $arquivo;
	
	if ($num != "M") $type = $arquivo->filereferences[(int)$num]->type;
	else $type = $arquivo->type;
	echo "<script language=\"javaScript\">parent.thumbError('$errorMsg', '$num', '$type');</script>";
	exit;
}

$thumbNum = isset($_REQUEST['thumbNum']) ? $_REQUEST['thumbNum'] : '';
$fileName = "thumb" . $thumbNum;

if ($arquivoId && isset($_FILES[$fileName]) && !empty($_FILES[$fileName]['name'])) {

    preg_match("/(.+)\/.+/", $_FILES[$fileName]["type"], $arq_tipo);
    
    if ($arq_tipo[1] != "image") {
		error(tra("O arquivo fornecido não é uma imagem."), $thumbNum);
    }

    // Were there any problems with the upload?  If so, report here.
    if (!is_uploaded_file($_FILES[$fileName]['tmp_name'])) {
		error(tra('Upload was not successful').': '.FileGalLib::convert_error_to_string($_FILES[$fileName]['error']), $thumbNum);
    } 
    
    $maxSize = $tikilib->get_preference('el_max_thumb_size', 200);

    if ($_FILES[$fileName]["size"] > $maxSize * 1024) {
		error(tra("O tamanho máximo da miniatura é de $maxSize kBytes."), $thumbNum);
    }
    
	if (isset($_REQUEST['forFile'])) $forFile = $_REQUEST['forFile'];
	else $forFile = -1;
    $result = $arquivo->uploadThumb($_FILES[$fileName]['tmp_name'], $forFile);
    if (!$result) {
		error(tra('Impossível gravar miniatura'), $thumbNum);
    }
    
    echo "<script>parent.finishedUpThumb('$thumbNum', '$result');</script>";
    
}

?>
