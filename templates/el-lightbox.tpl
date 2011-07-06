<div id="overlay" {*onClick="hideLightbox()" onMouseover="tooltip('Clique para cancelar e fechar essa janela');" onMouseout="nd();"*}></div>
<div id="lightbox">
	<div class="lightBoxTop">
		<div class="lightBoxTopLeft"></div>
		<div class="lightBoxTopMid"></div>
		<div class="lightBoxTopRight"><img src="styles/{$style|replace:".css":""}/img/close.png" onclick="hideLightbox();" id="closeButton" alt="lightbox"/></div>
	</div>
	
	<div id="lightboxCont">
		<div class="lightBoxLeft"></div>

		<div class="lightBoxRight"></div>
	</div>
	
	<div class="lightBoxBottom">
		<div class="lightBoxBottomLeft"></div>
		<div class="lightBoxBottomMid"></div>
		<div class="lightBoxBottomRight"></div>
	</div>
</div>
