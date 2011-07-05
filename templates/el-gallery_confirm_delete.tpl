<div id="askDelete" class="none" style="width:300px">
	{tr}Tem certeza que quer apagar esse arquivo do acervo?{/tr}<br/><br/>
	<input type="checkbox" id="askDeleteCheckbox">{tr}Não mostrar este aviso novamente{/tr}<br/><br/>
	<a class="pointer" onClick="deleteFile(0, (document.getElementById('askDeleteCheckbox').checked ? 1 : 0), 1);">{tr}SIM{/tr}</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="pointer" onClick="hideLightbox('askDelete')">{tr}NÃO{/tr}</a>
</div>