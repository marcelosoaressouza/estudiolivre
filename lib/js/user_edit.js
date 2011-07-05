tipos = new Array('Audio', 'Video', 'Imagem', 'Texto');

function sendMsg() {
	var body = document.getElementById('uMsgSendInput').value;
	if (body) {
		xajax_sendMsg('foobar', body);
	}
}

//implementacao da licenca

function saveLicenca() {
    if (resposta1 != null && resposta2 != null && (resposta2 == 1 || resposta3 != null)) {
		if (document.getElementById('resposta3-0').disabled) xajax_set_licenca(resposta1, resposta2, -1);
		else xajax_set_licenca(resposta1, resposta2, resposta3);
		hide('licencaErro');
		hideLightbox();
    } else {
		show('licencaErro');
    }
}

//TODO abstrair as funcoes de thumb pra outro js, ja que sao usadas no upload e no user...
function changeThumbStatus() {
    thumbUpId = document.thumbForm.UPLOAD_IDENTIFIER.value;
    document.thumbForm.submit();
    updateThumbUpInfo();
}

function updateThumbUpInfo() {
	if (!upThumbStarted) {
		upThumbStarted = true;
		show('gUserThumbStatus');
		// TODO: tosco
		if (document.getElementById('gUserThumbFormContainer')) {
		    hide('gUserThumbFormContainer');
		}
		if (document.getElementById('aThumbForm')) {
		    hide('aThumbForm');
		}
		document.getElementById('gUserThumbStatus').innerHTML = '0%';
	}
	xajax_upload_info(thumbUpId, 'updateThumbProgressMeter');
	thumbTimerId = setTimeout('updateThumbUpInfo()',1000);
}

function finishUpThumb() {
	if (thumbTimerId) {
		clearTimeout(thumbTimerId);
		upThumbStarted = false;
		// TODO: tosco
		if (document.getElementById('gUserThumbFormContainer')) {
		    show('gUserThumbFormContainer');
		}
		if (document.getElementById('aThumbForm')) {
		    show('aThumbForm');
		}
		hide('gUserThumbStatus');	
	}
}

function updateThumbProgressMeter(uploadInfo) {
    var normalized = uploadInfo['bytes_uploaded'] / uploadInfo['bytes_total'];
    var percent = Math.ceil(100 * normalized);
    if (percent) {
		document.getElementById('gUserThumbStatus').innerHTML = percent + '%';	
    }	
}
