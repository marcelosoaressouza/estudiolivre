<?php
// migrado 2.0!
require_once("dumb_progress_meter.php");
require_once("el-gallery_file_edit_ajax.php");

global $userHasPermOnFile, $arquivoId, $el_p_upload_files;

$ajaxlib->setPermission('newUploadForm', $el_p_upload_files == 'y');
$ajaxlib->registerFunction('newUploadForm');
function newUploadForm($i) {
	global $smarty, $arquivo;
	$objResponse = new xajaxResponse();
	
	$smarty->assign('i', $i);
	$smarty->assign('arquivoId', $arquivo->id);
	
	$objResponse->addScript("uploadI++");
	$objResponse->addInsertAfter("uploadFormCont" . ($i-1), "span", "uploadFormCont" . $i);
	$objResponse->addAssign("uploadFormCont" . $i, 'innerHTML', $smarty->fetch("el-gallery_upload_form.tpl"));
	return $objResponse;
}

$ajaxlib->setPermission('create_file', $el_p_upload_files == 'y');
$ajaxlib->registerFunction('create_file');
function create_file($tipo, $fileName, $formNum) {
	$objResponse = new xajaxResponse();
	global $user, $smarty, $tikilib;
	
	$class = $tipo == "Imagem" ? "Image" : ($tipo == "Texto" ? "Text" : ($tipo == "Outro" ? "Other" : $tipo));
	
	$publicationClass = $class . "Publication";
	require_once("FileReference.php");
	require_once($publicationClass . ".php");
	
	if ($error = FileReference::isForbiddenExtension($fileName)) {
	    // Estranho ficar aqui, mas onde colocar?
	    $error .= ' Veja a <a href="tiki-index.php?page=Formatos+de+arquivos+do+Acervo+Livre">lista de formatos suportados</a>';
		$objResponse->addScript("setUploadErrorMsg('$error')");
		return $objResponse;
	}
	
	$fields = array("user" => $user);
	if ($licencaId = $tikilib->get_user_preference($user, 'licencaPadrao')) {
		$fields["licenseId"] = $licencaId;
	}
	
	$arquivo = new $publicationClass($fields);
	
	$objResponse->addScriptCall("setPublication", $arquivo->id);
	$objResponse->addScript("newUpload($formNum);");
	
	if (in_array($tipo, array('Audio','Video','Imagem'))) {
		$templateName = 'el-gallery_metadata_' . $tipo . '.tpl';
		$smarty->assign('permission', true);
		$content = $smarty->fetch($templateName);
		$objResponse->addAppend('ajax-gUpMoreOptionsContent', 'innerHTML', $content);
		$objResponse->addScript(_extractScripts($content));
	}
			
	return $objResponse;
}

$ajaxlib->setPermission('validateUpload', $userHasPermOnFile && $arquivoId);
$ajaxlib->registerFunction('validateUpload');
function validateUpload($fileName, $i) {
	
	$objResponse = new xajaxResponse();
	
	if ($error = FileReference::isForbiddenExtension($fileName)) {
	    // Estranho ficar aqui, mas onde colocar?
	    $error .= ' Veja a <a href="tiki-index.php?page=Formatos+de+arquivos+do+Acervo+Livre">lista de formatos suportados</a>';
		$objResponse->addScript("setUploadErrorMsg('$error')");
		return $objResponse;
	}

	$objResponse->addScript("newUpload($i);");
	return $objResponse;

}

$ajaxlib->setPermission('delete_file', $el_p_upload_files == 'y');
$ajaxlib->registerFunction('delete_file');
function delete_file($arquivoId) {
	global $user;
	require_once("lib/persistentObj/PersistentObjectFactory.php");
	$arquivo = PersistentObjectFactory::createObject("Publication", (int)$arquivoId);
	$objResponse = new xajaxResponse();
	
	if (!isset($arquivo->user) || $arquivo->user != $user) {
		return $objResponse;
	}
	
	$arquivo->delete();
	
	$objResponse->addRemove("ajax-pendente-$arquivoId");
	
	return $objResponse;
}

function _extractScripts($content) {
	preg_match_all('/<script[^>]*>(.+?)<\/script>/', $content, $matches);
	$script = '';
	for ($i=0; $i<sizeof($matches[1]); $i++) {
		$script .= $matches[1][$i];
		$script .= ";\n"; 
	}
	return $script;
}

$ajaxlib->setPermission('get_file_info', $userHasPermOnFile && $arquivoId);
$ajaxlib->registerFunction('get_file_info');
function get_file_info() {
	global $tikilib, $arquivo, $user;
	
	$objResponse = new xajaxResponse();

	$file = &$arquivo->filereferences[0];

	$result = array();
	if (!$arquivo->title)
		$result['title'] = $file->parseFileName();
	if (($autor = $tikilib->get_user_preference($user, 'realName')) && !$arquivo->author)
		 $result['author'] = $autor;
	$arquivo->update($result);

	$formattedResult = array();
	foreach ($result as $key => $value) {
		array_push($formattedResult, $key, $value);
	}
	
	if (count($result) > 0) {
		$objResponse->addScriptCall('setAutoFields', $formattedResult);
	}
		
	return $objResponse;
}


$ajaxlib->setPermission('set_arquivo_licenca', $userHasPermOnFile && $arquivoId);
$ajaxlib->registerFunction('set_arquivo_licenca');
function set_arquivo_licenca ($r1, $r2, $r3, $padrao = false) {

    global $userlib, $arquivo, $style;
    require_once("lib/persistentObj/PersistentObjectController.php");
    
    $controller = new PersistentObjectController("License");
    $objResponse = new xajaxResponse();
    
    $answer = $r1 . $r2;
    if ($r3 != '-1') $answer .= $r3;

    $licenca = $controller->noStructureFindAll(array("answer" => $answer));
    $licenca =& $licenca[0];
	
	if ($padrao) {
	  	$result = $userlib->set_user_field('licencaPadrao', $licenca["id"]);
	   	if(!$result) $objResponse->addAlert("Não foi possivel editar o campo licencaPadrao");
	}
	
	if (!$arquivo->update(array("licenseId" => $licenca["id"]))) {
		$objResponse->addAlert("Não foi possivel editar o campo licencaId");
	} else {
	  	$objResponse->addAssign('ajax-uImagemLicenca', 'src', 'styles/' . preg_replace('/\.css/', '', $style) . '/img/h_' . $licenca["imageName"] . '?rand='.rand());
	}
		
	return $objResponse;
	
}

function _publish_arquivo() {
    global $arquivo;
    $objResponse = new xajaxResponse();
    
    if ($arquivo->publish()) {
    	$objResponse->addRedirect("el-gallery_view.php?arquivoId=$arquivo->id");
    } else {
    	$objResponse->addAlert("Não foi possível publicar o arquivo");
    }

    return $objResponse;
}

$ajaxlib->setPermission('check_publish', $userHasPermOnFile && $arquivoId);
$ajaxlib->registerFunction('check_publish');
function check_publish($showDisclaimer = true, $dontShowAgain = false) {
    global $user, $userlib, $arquivo, $isIE;
    $objResponse = new xajaxResponse();
	
    if ($errorList = $arquivo->checkPublish()) {
    	$errorMsgs = '';
    	foreach ($errorList as $field => $error) {
    		$errorMsgs .= $error . ($isIE ? "" : "<br/>") . "\n";
    		$objResponse->addScriptCall('exibeErro',$field, $error);
    	}
    	if ($isIE) {
    		$objResponse->addAlert($errorMsgs);
    	} else {
    		$objResponse->addAssign("ajax-gUpErrorList", "innerHTML", $errorMsgs);
    		$objResponse->addScript("showLightbox('ajax-gUpError')");
    	}
    } else {
		if (!$showDisclaimer || $userlib->get_user_preference($user, 'el_disclaimer_seen', false)) {
		    if ($dontShowAgain) {
				global $userlib, $user;
				$userlib->set_user_preference($user, "el_disclaimer_seen", true);
		    }
		    return _publish_arquivo();
		} else {
		    $objResponse->addScript("showLightbox('ajax-el-publish')");
		}
    }
    return $objResponse;    
}

?>
