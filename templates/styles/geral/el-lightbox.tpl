<script type="text/javascript" src="lib/js/lightbox.js"></script>
<link rel="stylesheet" href="styles/{$style|replace:".css":""}/css/lightbox.css" type="text/css"/>
<div id="overlay" {*onClick="hideLightbox()" onMouseover="tooltip('Clique para cancelar e fechar essa janela');" onMouseout="nd();"*}></div>
<div id="lightbox">
	
	
		<div class="ar"><img src="styles/{$style|replace:".css":""}/img/close.png" onclick="hideLightbox();" id="closeButton"></div>

	
	<div id="lightboxCont">
		<div class="lightBoxLeft"></div>

		<div class="lightBoxRight"></div>
	</div>
	
</div>