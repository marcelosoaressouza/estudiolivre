var selectedBusca = getCookie('busca');

if (!selectedBusca) {
	selectedBusca = 'wiki';
}

function marcaBusca(name) {
    if (selectedBusca == 'wiki' || selectedBusca == 'gallery' || selectedBusca == 'forum' || selectedBusca == 'usuarios' || selectedBusca == 'blogs' || selectedBusca == 'tags') { 
		document.getElementById('busca-'+selectedBusca).className = '';
	}
	selectedBusca = name;
	setCookie('busca',selectedBusca);
	document.getElementById('busca-'+name).className = 'selected';
	if (selectedBusca == 'wiki' || selectedBusca == 'forum') {
		document.getElementById('searchField').name='highlight';
		document.getElementById('form-busca').action = 'tiki-searchresults.php';
		document.getElementById('form-busca').where.value = selectedBusca + 's';
	} else if (selectedBusca == 'usuarios') {
		document.getElementById('searchField').name='find';
		document.getElementById('form-busca').action = 'tiki-list_users.php';
	} else if (selectedBusca == 'blogs') {
		document.getElementById('searchField').name='find';
		document.getElementById('form-busca').action = 'tiki-list_blogs.php';
	} else if (selectedBusca == 'tags') {
		document.getElementById('searchField').name='tag';
		document.getElementById('form-busca').action = 'tiki-browse_freetags.php';
	} else {
		document.getElementById('searchField').name='highlight';		
		document.getElementById('form-busca').action = 'el-gallery_home.php';
	}
}

function busca(category, value) {
	if (/.*el-gallery_home.*/.test(document.location) && selectedBusca == 'gallery') {
		xajax_get_files(tipos, 0, 10, sortMode+sortDirection, '', value); 
		findValue = value; 
	} else {
		document.searchForm.submit();
	}
}

function limpaBusca(input) {
	if (input.value == "Buscar") {
		input.value = "";
	}
}