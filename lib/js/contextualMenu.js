function showMenu(e){
    if (!e) var e = window.event;
	cancelBubble(e);
	
	if (typeof e.pageY == 'number'){
		mouseY = e.pageY;
		mouseX = e.	pageX;
	}
	else{
		mouseY = e.clientY;
		mouseX = e.clientX;
	}
	if (mouseY - 75 < 0) mouseY = 75;
	if (mouseX - 75 < 0) mouseX = 75;
	var menu = document.getElementById('menu');
	menu.style.display = 'block';
	menu.style.top=(mouseY-75)+'px';
	menu.style.left=(mouseX-75)+'px';
}

function forceHideMenu(e){
	cancelBubble(e);
	document.getElementById('menu').style.display = 'none';
}

function cancelBubble(e) {
	if (!e) var e = window.event;
	e.cancelBubble = true;
	if (e.stopPropagation) e.stopPropagation();
}

function hideMenu(e){
	if (!e) var e = window.event;
	var reltg = (e.relatedTarget) ? e.relatedTarget : e.toElement;
	if (reltg.className == 'menu') return;
	document.getElementById('menu').style.display = 'none';
}

function hoverSubMenu(menuItem){
	document.getElementById('menuImg'+menuItem).src=document.getElementById('menuImg'+menuItem).src.replace(new RegExp(/.png/),"S.png");
}

function outSubMenu(menuItem){
	document.getElementById('menuImg'+menuItem).src=document.getElementById('menuImg'+menuItem).src.replace(new RegExp(/S.png/),".png");
}
