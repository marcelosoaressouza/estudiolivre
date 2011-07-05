var arquivoId = false;
var uploadIds = Array();
var uploadTimeouts = Array();
var originalWidth = 245;
var uploadI = 0;

// coloca o id do arquivo no request pra inicializar o arquivo nas chamadas ajax
function setRequestUri(id) {
	if (xajaxRequestUri.match(new RegExp(/arquivoId=/))) {
		xajaxRequestUri = xajaxRequestUri.replace(new RegExp(/arquivoId=\d+/), 'arquivoId='+id);
	} else {
		xajaxRequestUri += '?arquivoId=' + id;
	}
}

// depois de criada a publicacao, seta as infos nos formularios
function setPublication(id) {
	arquivoId = id;
	setRequestUri(id);
	document.uploadForm0.arquivoId.value = arquivoId;
	document.thumbFormM.arquivoId.value = arquivoId;
}

// funcoes de lidar com o tipo
var tipoSelecionado = false;
function acendeTipo(tipo) {
	if (!tipoSelecionado) {
		document.getElementById("js-icone" + tipo).src = "styles/"+style+"/img/iUp" + tipo + ".png";
	}
}
function apagaTipo(tipo) {
	if (!tipoSelecionado) {
		document.getElementById("js-icone" + tipo).src = "styles/"+style+"/img/iUp" + tipo + "Off.png";
	}
}
function selecionaTipo(tipo) {
	if (tipoSelecionado && !arquivoId) {
		document.getElementById("js-icone" + tipoSelecionado).src = "styles/"+style+"/img/iUp" + tipoSelecionado + "Off.png";
	}
	if (!arquivoId) {
		tipoSelecionado = tipo;
		document.getElementById("js-icone" + tipo).src = "styles/"+style+"/img/iUp" + tipo + ".png";
		show('js-browse');
		hide('js-pending');
	} else {
		fixedTooltip('Voc&ecirc; n&atilde;o pode mudar o tipo de arquivo depois de come&ccedil;ar o upload');
	}
}
// fim do tipo

// chamada no onChange dos formularios de arquivo
function fileSelected(fileName, formNum) {
	if (!arquivoId) {
		show('js-desc');
    	document.getElementById('js-thumbnailM').src = 'styles/'+style+'/img/iThumb'+tipoSelecionado+'.png';
    	xajax_create_file(tipoSelecionado, fileName, formNum);
	} else {
		xajax_validateUpload(fileName, formNum);
	}
}

// inicializa um novo upload
// seta o uploadId usado no progress meter e da um submit no formulario
// é sempre chamado pelo ajax
function newUpload(formNum) {
	var uploadId = Math.random().toString().replace(new RegExp(/0\./), '') + '.' + Date.now();
	uploadIds[formNum] = uploadId;
	setTimeout("startUploadProgress(" + formNum + ")", 250);
	eval("document.uploadForm" + formNum + ".UPLOAD_IDENTIFIER.setAttribute('value','" + uploadId + "')");
	eval("document.uploadForm" + formNum + ".submit()");
}

// inicializa os htmls de progress meter
function startUploadProgress(formNum) {
	document.getElementById('js-cancel' + formNum).innerHTML = '<span onClick="cancelUpload(' + formNum + ');">interromper</span>';
	document.getElementById('js-percent' + formNum).innerHTML = '0%';
	document.getElementById('js-statusBar' + formNum).style.width = '0px';
	updateUploadInfo(formNum);
}

// loop pra ficar atualizando o progress meter
function updateUploadInfo(formNum) {
	xajax_upload_info(uploadIds[formNum], formNum);
	uploadTimeouts[formNum] = setTimeout('updateUploadInfo(' + formNum + ')',1000);
}

// chamada no final do upload do arquivo
// para o loop de progrees meter e puxa infos automaticas
function finishedUpload(formNum) {
	clearTimeout(uploadTimeouts[formNum]);
	uploadTimeouts[formNum] = 0;
	document.getElementById('js-cancel' + formNum).innerHTML = '';
	document.getElementById('js-statusBar' + formNum).className = "statusBar statusBarGo";
	document.getElementById('js-statusBar' + formNum).style.width = originalWidth + 'px';
	document.getElementById('js-percent' + formNum).innerHTML = '100%';
	eval("var fileName = document.uploadForm" + formNum + ".arquivo" + formNum+ ".value");
	document.getElementById('js-file' + formNum).innerHTML = fileName;
	if (formNum == "0" && thumbId == null && (tipoSelecionado == 'Imagem' || tipoSelecionado == 'Video')) {
		setTimeout('document.getElementById("js-thumbnailM").src = "styles/"+style+"/img/iProgress.gif"',100);
		xajax_setPubThumbFromFile(0);
	}
	if (formNum == "0")
		xajax_get_file_info();
}

// cancela um upload em progresso
function cancelUpload(formNum) {
	if (uploadTimeouts[formNum]) {
		window.stop();
		clearTimeout(uploadTimeouts[formNum]);
		uploadTimeouts[formNum] = 0;
		document.getElementById('js-cancel' + formNum).innerHTML = '';
		document.getElementById('js-percent' + formNum).innerHTML = '';
		document.getElementById('js-statusBar' + formNum).style.width = '0px';
	    document.getElementById('js-statusBar' + formNum).className = "statusBar statusBarGoing";
	    eval("document.uploadForm" + formNum + ".reset()");
	}
}

// busca mais sugestao de tags
var tagOffset = 0;
function getMoreTags() {
	tagOffset += 10;
	xajax_get_more_tags(tagOffset, 10);
}


// usada no ajax e no upload_file.php
function setUploadErrorMsg(msg) {
	document.getElementById('js-errorDiv').innerHTML = msg;
	showLightbox('js-errorDiv');
}

// salva a licenca escolhida no upload
function saveLicenca() {
	var padrao = false;
	if (resposta1 != null && resposta2 != null && (resposta2 == 1 || resposta3 != null)) {
		padrao = (document.getElementById("uLicencaPadrao").checked ? 1 : 0);
		if (document.getElementById('resposta3-0').disabled) xajax_set_arquivo_licenca(resposta1, resposta2, -1, padrao);
		else xajax_set_arquivo_licenca(resposta1, resposta2, resposta3, padrao);
		hide('licencaErro');
		hideLightbox();
	} else {
		show('licencaErro');
	}
}
//implementacao do checkLightBox para a licenca
setLightboxCheckFunction('el-license',hideLicencaErro);

// chamados somente pelo ajax
function setAutoFields(result) {
	for (var i=0; i<result.length; i += 2) {
		if (!editing[result[i]]) {
			setEditData(result[i], result[i+1]);
			exibeCampo(result[i], result[i+1]);		
		}
	}
}
function updateProgressMeter(uploadInfo, formNum) {
	var normalized = uploadInfo['bytes_uploaded'] / uploadInfo['bytes_total'];
	var percent = Math.ceil(100 * normalized);
	if (percent) {
		document.getElementById('js-percent' + formNum).innerHTML = percent + '%';
		document.getElementById('js-statusBar' + formNum).style.width = originalWidth*normalized + 'px';
	}	
}
// fim do ajax

// restauracao de arquivos pendentes
function restoreForm (id, tipo, arquivos, thumbnail, path) {
	selecionaTipo(tipo);
	arquivoId = id;
	setRequestUri(id);
	show('js-desc');
	for (var i=0; i < arquivos.length; i++) {
		document.getElementById('js-statusBar' + i).className = "statusBar statusBarGo";
		document.getElementById('js-statusBar' + i).style.width = originalWidth + 'px';
		document.getElementById('js-percent' + i).innerHTML = '100%';
		document.getElementById('js-file' + i).innerHTML = arquivos[i];
	}
	if (thumbnail) {
		document.getElementById('js-thumbnailM').src = path +thumbnail;
	} else {
		document.getElementById('js-thumbnailM').src = 'styles/'+style+'/img/iThumb' + tipo + '.png';
	}
}