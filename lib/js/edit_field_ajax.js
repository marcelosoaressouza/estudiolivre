var saveFieldCache = new Array();
var display = new Array();
var truncations = new Array();
var mudado = new Array();
var editing = new Array();
var waitingQueue = new Array();

function saveField(fieldObj, file){
    var field = fieldObj.id.replace(/^input-/,'');
    var value;
    if(fieldObj.type == "checkbox") {
    	value = (fieldObj.checked ? 1 : 0);
    } else {
	    value = fieldObj.value;
    }
    
    if (saveFieldCache[field] == null || saveFieldCache[field] != value) {
    	setWaiting(field, true);
    	if (typeof(file) != "undefined")
			xajax_save_field(field, value, file);
		else
			xajax_save_field(field, value);
    } else {
		exibeCampo(field, value);
    }
}

function setWaiting(field, waiting) {
	if (waiting) {
		waitingQueue.add(field);
	} else {
		waitingQueue.remove(field);
	}
}

function limpaCampo(field) {
	editing[field] = true;
    if (mudado[field] == null) {
		document.getElementById('input-'+field).value = '';
    }
}

function exibeCampo(field, value) {
	var editElement = document.getElementById("input-" + field);
	var type = editElement.type;
	var truncated;
	if (truncations[field] && value.length > (parseInt(truncations[field]) + 4) ) {
	    truncated = value.substring(0, truncations[field]) + '(...)';
	} else {
	    truncated = value;
	}
	if (value.length > 0 && type != 'checkbox') {
	    var showElement = document.getElementById("show-" + field);
		showElement.style.display = display[field];
		showElement.innerHTML = truncated; //replace(new RegExp(/\n/g), '<br/>'); - parse_data ja poe br
		editElement.style.display = "none";
		saveFieldCache[field] = value;		
	} else if (type == 'checkbox') {
	    if(value == '1') editElement.checked = 1;
	    else editElement.checked = 0;
	}
	
	hide('error-' + field);
	eval('errorMsg_' + field + ' = "";');
}


function showEdit(field) {
    document.getElementById("show-"  + field).style.display = "none";
    document.getElementById("input-" + field).style.display = display[field];	
}

function editaCampo(field) {
	showEdit(field);
    document.getElementById("input-" + field).focus();
}

function setEditData(field, value) {
	document.getElementById('input-'+field).value = value;
	mudado[field]=1;
}

function restoreField(field, value) {
	document.getElementById("input-" + field).value = value;
	document.getElementById("input-" + field).onfocus = new Function();
	showEdit(field);
}

function exibeErro(campo, msg) {
	eval('errorMsg_' + campo + ' = msg;');
	document.getElementById('error-' + campo).style.display = 'inline';
}

function cancelEdit() {
	saveFieldCache = new Array();
	xajax_rollback_arquivo();
	return true;
}
/* deprecated
function restoreEdit(id) {
	arquivoId = id;
	xajax_restore_edit(arquivoId);
}
*/
function checkWaiting(cmd) {
	if(!waitingQueue.length) {
		eval(cmd);
	}
	else {
		setTimeout("checkWaiting('"+cmd+"');", 200);
	}
}
