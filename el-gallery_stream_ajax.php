<?php
// migrado pra 2.0!
global $el_p_view;

$ajaxlib->setPermission('streamFile', $el_p_view == 'y');
$ajaxlib->registerFunction("streamFile");
function streamFile($arquivoId, $type, $screenSize) {
	global $smarty;
	require_once("lib/persistentObj/PersistentObjectFactory.php");

    $objResponse = new xajaxResponse();
    
    if (!$arquivoId) {
    	return $objResponse;
    }
    
    $arquivo = PersistentObjectFactory::createObject("Publication", (int)$arquivoId);
    $file =& $arquivo->filereferences[0];
    $file->hitStream();
    
    $screenSize-=250;
    if ($type == 'Imagem') {
    	$smarty->assign('src', $file->baseDir . $file->fileName);
    	if($file->width > $screenSize){
    		$file->height = $screenSize*($file->height/$file->width);
    		$file->width = $screenSize;
    		$smarty->assign('note', tra("Imagem redimensionada"));
    	} else {
    		$smarty->assign('note', '');
    	}
    	$objResponse->addRemove('ajax-gPlayerImagem');
    	$objResponse->addAppend('ajax-contentBubble', 'innerHTML', $smarty->fetch('el-playerImage.tpl'));
    	$objResponse->addAssign('ajax-gImagem', 'style.maxWidth', $screenSize . "px");
    	$objResponse->addAssign('ajax-gPlayerImagem', 'style.width', $file->width . "px");
    	$objResponse->addAssign('ajax-gPlayerImagem', 'style.height', $file->height . "px");
    	$objResponse->addScript("showLightbox('ajax-gPlayerImagem')");
    	
    	return $objResponse;
    }
    
    $validUrl = 'http://' . $_SERVER['HTTP_HOST'] .  $_SERVER['REQUEST_URI'];
    $validUrl = preg_replace('/el-.+\.php.*$/','',$validUrl);
    $validUrl .= $file->baseDir . $file->fileName;
   	
    if ($type == 'Video') {
    	$width = $file->width;
    	$height = $file->height;
    	$video = "true";
    } else {
    	$width = 200;
    	$height = 20;
    	$video = "false";
    }
        
    /*pra quando rolar tutoriais em swf
     * if (preg_match('/.*\.swf$/i', $arquivo.arquivo)) {
    	$smarty->assign('src', 'repo/' . $arquivo['arquivo']);
    	$objResponse->addRemove('gPlayerSwf');
    	$objResponse->addAppend('ajax-contentBubble', 'innerHTML', $smarty->fetch('el-playerSwf.tpl'));
    	$objResponse->addScript("showLightbox('gPlayerSwf')");	
    } else {
    */
    	$objResponse->addRemove('ajax-gPlayer');
   		$objResponse->addAppend('ajax-contentBubble', 'innerHTML', $smarty->fetch('el-player.tpl'));
    	$objResponse->addScript("loadFile('$validUrl', $width, $height, '$video')");
    //}
    
    return $objResponse;
    
}

$ajaxlib->setPermission('streamStream', $el_p_view == 'y');
$ajaxlib->registerFunction("streamStream");
function streamStream($url, $size) {
	
	global $smarty;
	$objResponse = new xajaxResponse();
	
	preg_match('/(\d+)\sx\s(\d+)/', $size, $matches);
	$width = (int)$matches[1];
	$height = (int)$matches[1];
	
	$objResponse->addRemove('ajax-gPlayer');
   	$objResponse->addAppend('ajax-contentBubble', 'innerHTML', $smarty->fetch('el-player.tpl'));
    $objResponse->addScript("loadFile('$url', $width, $height, 'true')");
    
    return $objResponse;  
}

?>
