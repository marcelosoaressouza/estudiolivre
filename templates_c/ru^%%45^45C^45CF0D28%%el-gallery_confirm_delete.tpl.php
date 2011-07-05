<?php /* Smarty version 2.6.18, created on 2011-04-04 17:29:55
         compiled from el-gallery_confirm_delete.tpl */ ?>
<div id="askDelete" class="none" style="width:300px">
	Tem certeza que quer apagar esse arquivo do acervo?<br/><br/>
	<input type="checkbox" id="askDeleteCheckbox">Não mostrar este aviso novamente<br/><br/>
	<a class="pointer" onClick="deleteFile(0, (document.getElementById('askDeleteCheckbox').checked ? 1 : 0), 1);">SIM</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="pointer" onClick="hideLightbox('askDelete')">NÃO</a>
</div>