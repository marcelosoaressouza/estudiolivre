var butStatus = new Array('Inac','Inac','Inac','Inac');
var tipos = new Array();
var acervo_cache = new Array();
var sortMode = 'publishDate';
var sortDirection = '_desc';
var findValue = '';
var maxRecords = 10;

function init(findVal) {
	
	if(getCookie('sortMode')) {
		sortMode = getCookie('sortMode');
	}
	if(getCookie('sortDirection')) {
		sortDirection = getCookie('sortDirection');
	}
	
	findValue = findVal;
	
}

function acervoCache(tipos,offet, maxRecords, sort_mode, findValue, filters) {
    acervo_cache[tipos+offset+maxRecords+sort_mode+findValue+filters] = document.getElementById('ajax-gListCont').innerHTML;
}

function el_get_files(tipos, offset, maxRecords, sort_mode, findValue, filters) {
    if(acervo_cache[tipos+offset+maxRecords+sort_mode+findValue+filters]) {
		document.getElementById('ajax-gListCont').innerHTML = acervo_cache[tipos+offset+maxRecords+sort_mode+findValue+filters];
    }
    else {
		xajax_get_files(tipos, offset, maxRecords, sort_mode, findValue, filters);
    }
}

function toggleFilter(button) {
	setButton(button);
	xajax_get_files(tipos, 0, maxRecords, sortMode+sortDirection, '', findValue);
}

function setButton(button) {
	
	if(tipos.contains(button.id)>=0) {
		if (tipos.length == 4)
			buttonOff(document.getElementById('Tudo'));
		buttonOff(button);
		tipos.remove(button.id);
	} else {
		buttonOn(button);
		tipos.add(button.id);
		if (tipos.length == 4)
			buttonOn(document.getElementById('Tudo'));
	}

}

function buttonOff(button) {
	button.src = button.src.replace(new RegExp(/Filter\.png/), 'FilterOff.png');
	setCookie(button.id, 0);
}

function buttonOn(button) {
	button.src = button.src.replace(new RegExp(/\Off.png/), '.png');
	setCookie(button.id, 1);
}

function toggleAll() {
	var buttons = document.getElementsByName('filterButton');
	if(!getCookie('Tudo') || getCookie('Tudo') == '1') {
		for (i = 0; i < buttons.length; i++) {
			buttonOff(buttons[i]);
			tipos.remove(buttons[i].id);
		}
		buttonOff(document.getElementById('Tudo'));
	} else {
		for (i = 0; i < buttons.length; i++) {
			buttonOn(buttons[i]);
			tipos.add(buttons[i].id);
		}
		buttonOn(document.getElementById('Tudo'));
	}
	
	xajax_get_files(tipos, 0, maxRecords, sortMode+sortDirection, '', findValue);
	
}

function toggleSortArrow(img, alternate) {

	toggleImage(img,alternate);

	/*TODO: esse tro?o tb pode ser refatorado -> interface de cookies do estudiolivre! */
	if (sortDirection == '_desc') {
		sortDirection = '_asc';
	} else {
		sortDirection = '_desc';
	}
	setCookie('sortDirection', sortDirection);
	xajax_get_files(tipos, 0, maxRecords, sortMode+sortDirection, '', findValue);
}

function setSortMode(sel) {
	sortMode = sel.value;
	setCookie('sortMode', sortMode);
	xajax_get_files(tipos, 0, maxRecords, sortMode+sortDirection, '', findValue);
}
