<?php

// esse arquivo salva o upload
require_once ("tiki-setup.php");

include_once("el-gallery_set_publication.php");

$formNum = isset($_REQUEST['formNum']) ? $_REQUEST['formNum'] : "0";
$fileName = "arquivo" . $formNum;

if ($arquivoId && isset($_FILES[$fileName]) && !empty($_FILES[$fileName]['name'])) {

	$errorMsg = '';

	if (!is_uploaded_file($_FILES[$fileName]['tmp_name'])) {
		require_once ("lib/filegals/filegallib.php");
		$errorMsg = tra('Upload was not successful') . ': ' . FileGalLib :: convert_error_to_string($_FILES[$fileName]['error']);
	} elseif ($error = FileReference::isForbiddenExtension($_FILES[$fileName]['name'])) {
		$errorMsg = $error . ' Veja a <a href="tiki-index.php?page=Formatos+de+arquivos+do+Acervo+Livre">lista de formatos suportados</a>';
	}
	else {
		
		echo "<script language=\"javaScript\">parent.finishedUpload($formNum);</script>";
		
		require_once("FileReference.php");
		$fileClass = FileReference::getSubClass($_FILES[$fileName]['name'], $_FILES[$fileName]['tmp_name']);
		
		$fields = $_FILES[$fileName];
		$fields["publicationId"] = $arquivoId;
		
		require_once($fileClass . ".php");
		$file = new $fileClass($fields);
		
		if ($arquivo->allFile)
			unlink($arquivo->allFile);
		
	}

	if ($errorMsg) {
		echo "<script language=\"javaScript\">parent.setUploadErrorMsg('$errorMsg');</script>";
	}

}
?>
