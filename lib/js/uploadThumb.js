var thumbId = null;
var thumbTimeouts = Array();
var uploadThumbIds = Array();

function thumbSelected(num) {
    uploadThumbIds[num] = Math.random().toString().replace(new RegExp(/0\./), '') + '.' + Date.now();
    eval("document.thumbForm" + num + ".UPLOAD_IDENTIFIER.setAttribute('value','" +  uploadThumbIds[num] + "')");
	eval("document.thumbForm" + num + ".submit()");
	startThumbProgress(num);
}

function startThumbProgress(num) {
	document.getElementById("js-thumbnail" + num).src = "styles/"+style+"/img/iProgress.gif" + "?rand=" + Math.random();
	document.getElementById('js-thumbStatus' + num).innerHTML = '0%';
	updateThumbInfo(num);
}

function updateThumbInfo(num) {
	xajax_upload_info(uploadThumbIds[num], num, 'updateThumbProgressMeter');
	thumbTimeouts[num] = setTimeout('updateThumbInfo("'+num+ '")',1000);
}

function updateThumbProgressMeter(uploadInfo, num) {
    var normalized = uploadInfo['bytes_uploaded'] / uploadInfo['bytes_total'];
    var percent = Math.ceil(100 * normalized);
    if (percent) {
		document.getElementById('js-thumbStatus' + num).innerHTML = percent + '%';	
    }
}

function finishedUpThumb(num, src) {
	clearTimeout(thumbTimeouts[num]);
	hide('js-thumbForm' + num);
	thumbId = src;
	document.getElementById('js-thumbStatus' + num).innerHTML = '';
	document.getElementById("js-thumbnail" + num).src = src + "?rand=" + Math.random();
}

function thumbError(errorMsg, num, type) {
	finishedUpThumb(num, "styles/" + style + "/img/iThumb" + type + ".png");
	alert(errorMsg);
}

function changePubThumb(select) {
	if (select.value >= 0){
		document.getElementById("js-thumbnailM").src = "styles/"+style+"/img/iProgress.gif";
		hide('pThumbForm');
		xajax_setPubThumbFromFile(select.value);
	}
}