function loadFile(url, width, height, video) {
	var player = document.applets[0];
	document.getElementById('ajax-gPlayer').style.width = width + 'px';
	document.getElementById('ajax-gPlayer').style.height = height + 'px';
	player.height = height;
	player.width = width;
	showLightbox('ajax-gPlayer');
	player.childNodes[1].value = url;
	player.childNodes[2].value = video;
}