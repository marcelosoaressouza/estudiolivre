var myDelay = 600;
//images
preloadImgs(new Array("tooltipTop.png","tooltipMid.png","tooltipBottom.png"));

function tooltip (txt)  {
	overlib("<div class=\'tooltipCont\'><div class=\'tooltipTop\'></div>" +
				"<div class=\'tooltipMid\'>" + txt + "</div><div class='tooltipBottom'></div>" +
			"</div>", FULLHTML, DELAY, myDelay);
	myDelay = 0;
}

function fixedTooltip (txt)  {
	overlib("<div class=\'tooltipCont\'><div class=\'tooltipTop\'></div>" +
				"<div class=\'tooltipMid\'>" + txt + "</div><div class='tooltipBottom'></div>" +
			"</div>", FULLHTML,STICKY);
}
