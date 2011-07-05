var resposta1 = null;
var resposta2 = null;
var resposta3 = null;

function hideLicencaErro() {
    hide('licencaErro');
    return true;
}

function disableAttribution() {
    document.getElementById('resposta3-0').disabled = true;
    document.getElementById('resposta3-1').disabled = true;
    document.getElementById('resposta3-2').disabled = true;
}

function enableAttribution() {
    document.getElementById('resposta3-0').disabled = false;
    document.getElementById('resposta3-1').disabled = false;
    document.getElementById('resposta3-2').disabled = false;
}

function testLicense() {
    if (resposta1 != null && resposta2 != null && (resposta2 == 1 || resposta3 != null)) {
    	if (document.getElementById('resposta3-0').disabled) xajax_get_license(resposta1, resposta2, -1);
		else xajax_get_license(resposta1, resposta2, resposta3);
    } else {
		hide('ajax-licenseCont');
    }
}
