/*
	Based on Lokesh Dhakar's lightbox - http://huddletogether.com/projects/lightbox/
*/
//images
preloadImgs(new Array("lBox_tl.png","lBox_t.png","lBox_tr.png","lBox_l.png","lBox_r.png","lBox_lb.png","lBox_b.png","lBox_rb.png","overlay.png"));

var currentLightBoxDiv = null;
var checkFunction = new Array();

//
// getPageScroll()
// Returns array with x,y page scroll values.
// Core code from - quirksmode.org
//
function getPageScroll() {

	var yScroll;

	if (self.pageYOffset) {
		yScroll = self.pageYOffset;
	} else if (document.documentElement && document.documentElement.scrollTop){	 // Explorer 6 Strict
		yScroll = document.documentElement.scrollTop;
	} else if (document.body) {// all other Explorers
		yScroll = document.body.scrollTop;
	}

	arrayPageScroll = new Array('',yScroll) 
	return arrayPageScroll;
}

//
// getPageSize()
// Returns array with page width, height and window width, height
// Core code from - quirksmode.org
// Edit for Firefox by pHaez
//
function getPageSize() {
	
	var xScroll, yScroll;
	
	if (window.innerHeight && window.scrollMaxY) {	
		xScroll = document.body.scrollWidth;
		yScroll = window.innerHeight + window.scrollMaxY;
	} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
		xScroll = document.body.scrollWidth;
		yScroll = document.body.scrollHeight;
	} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
		xScroll = document.body.offsetWidth;
		yScroll = document.body.offsetHeight;
	}
	
	var windowWidth, windowHeight;
	if (self.innerHeight) {	// all except Explorer
		windowWidth = self.innerWidth;
		windowHeight = self.innerHeight;
	} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
		windowWidth = document.documentElement.clientWidth;
		windowHeight = document.documentElement.clientHeight;
	} else if (document.body) { // other Explorers
		windowWidth = document.body.clientWidth;
		windowHeight = document.body.clientHeight;
	}	
	
	// for small pages with total height less then height of the viewport
	if(yScroll < windowHeight){
		pageHeight = windowHeight;
	} else { 
		pageHeight = yScroll;
	}

	// for small pages with total width less then width of the viewport
	if(xScroll < windowWidth){	
		pageWidth = windowWidth;
	} else {
		pageWidth = xScroll;
	}

	arrayPageSize = new Array(pageWidth,pageHeight,windowWidth,windowHeight) 
	return arrayPageSize;
}

//
// showLightbox()
// Places a div in lightbox then centers and displays.
//
function showLightbox(divId) {

	// set lightBox on with divId as currentLightBoxDiv
	currentLightBoxDiv = divId;
	
	// get page properties
	var arrayPageSize = getPageSize();
	var arrayPageScroll = getPageScroll();

	// prep objects
	var overlay = document.getElementById("overlay");
	var content = document.getElementById(divId);
	var objLightbox = document.getElementById('lightbox');

	// set height of Overlay to take up whole page and show
	document.getElementById("overlay").style.height = (arrayPageSize[1] + 'px');
	document.getElementById('overlay').style.display = 'block';

	//if ((document.documentElement && document.documentElement.scrollTop) || document.body){	 // Explorers
		content.className = 'tc';
	//} else {// all other browsers
	//	content.style.display = 'table-cell';
	//}

	// get width of the content to define the position of the lightbox
	var width = (content.style.width).replace(new RegExp(/px/),"");
	var lightboxTop = arrayPageScroll[1] + ((arrayPageSize[3] - content.clientHeight - 35) / 2);
	var lightboxLeft = ((arrayPageSize[0] - width - 20) / 2);

	// set the position of the lightbox
	objLightbox.style.top = (lightboxTop < 0) ? "0px" : lightboxTop + "px";
	objLightbox.style.left = (lightboxLeft < 0) ? "0px" : lightboxLeft + "px";

	/* Hide select boxes as they will 'peek' through the image in IE
	selects = document.getElementsByTagName("select");
   	for (i = 0; i != selects.length; i++) {
		selects[i].style.visibility = "hidden";
	}*/
	
	//set the lightbox width to be the same as the content's
	//objLightbox.style.width=content.style.width;

	// append the content inside the lightboxCont
	// this is what we did before
	//objLightbox.appendChild(content);
	// now we will append the content before the second child
	var container=document.getElementById('lightboxCont');
	if(!content.className.match(new RegExp(/lightContent/)))
		content.className=content.className+" lightContent";
	container.insertBefore(content,container.childNodes[2]);
	////container.firstChild.appendChild(content);
	//container.appendChild(content);
	
	//display the lightbox and the content
	objLightbox.style.display = 'table';
	
}

//
// hideLightbox()
//
function hideLightbox() {
	
	//check to see if user has done whatever before he exits
	//has to be implemented for each particular case
	if(checkLightbox(currentLightBoxDiv)) {
	
		document.getElementById('overlay').style.display = 'none'; 
		document.getElementById('lightbox').style.display = 'none';
	
		// hide lightbox and overlay
		var content = document.getElementById(currentLightBoxDiv);
		//currentLightBoxDiv = null;
		content.className = 'none';
		setTimeout("document.body.appendChild(document.getElementById(currentLightBoxDiv))", 1);
	}
}

//
// setLightboxCheckFunction(divId)
//
function setLightboxCheckFunction(divId, func) {
	checkFunction[divId] = func;
}

function checkLightbox(divId) {
	var func = checkFunction[divId];
	if (!func) {
		return true;
	}
	return func();
}