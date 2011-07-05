<!-- el-gallery_upload.tpl begin -->
{css extra=ajax_inputs}
<script language="JavaScript" src="lib/js/el_array.js"></script>
<script language="JavaScript" src="lib/js/license.js"></script>
<script language="JavaScript" src="lib/js/upload.js"></script>
<script language="JavaScript" src="lib/js/uploadThumb.js"></script>
<script language="JavaScript" src="lib/js/edit_field_ajax.js"></script>
<script language="JavaScript" src="lib/js/freetags.js"></script>

<h4>{tr}Selecione o tipo de publicação que deseja criar{/tr}:</h4>
{if $isIE}
	<center>
	<table id="tipos">
		<tr>
			<td>
				<img id="js-iconeAudio" class="pointer" onMouseOver="acendeTipo('Audio');" onMouseOut="apagaTipo('Audio'); return nd();" onClick="selecionaTipo('Audio')" alt="{tr}Áudio{/tr}" src="styles/{$style|replace:".css":""}/img/iUpAudioOff.png">
				<br/>
				{tr}Áudio{/tr}
			</td>
			
			<td>
				<img id="js-iconeImagem" class="pointer" onMouseOver="acendeTipo('Imagem');" onMouseOut="apagaTipo('Imagem'); return nd();" onClick="selecionaTipo('Imagem')" alt="{tr}Imagem{/tr}" src="styles/{$style|replace:".css":""}/img/iUpImagemOff.png">
				<br/>
				{tr}Imagem{/tr}
			</td>
			
			<td>
				<img id="js-iconeTexto" class="pointer" onMouseOver="acendeTipo('Texto');" onMouseOut="apagaTipo('Texto'); return nd();" onClick="selecionaTipo('Texto')" alt="{tr}Texto{/tr}" src="styles/{$style|replace:".css":""}/img/iUpTextoOff.png">
				<br/>
				{tr}Texto{/tr}
			</td>
			
			<td>
				<img id="js-iconeVideo" class="pointer" onMouseOver="acendeTipo('Video');" onMouseOut="apagaTipo('Video'); return nd();" onClick="selecionaTipo('Video')" alt="{tr}Vídeo{/tr}" src="styles/{$style|replace:".css":""}/img/iUpVideoOff.png">
				<br/>
				{tr}Vídeo{/tr}
			</td>
			
			<td>
				<img id="js-iconeOutro" class="pointer" onMouseOver="acendeTipo('Outro');" onMouseOut="apagaTipo('Outro'); return nd();" onClick="selecionaTipo('Outro')" alt="{tr}Outro{/tr}" src="styles/{$style|replace:".css":""}/img/iUpOutroOff.png">
				<br/>
				{tr}Outro{/tr}
			</td>
		</tr>
	</table>
	{*o center só fecha láááá em baixo*}
{else}
	<div id="tipos">
		<ul>
			<li>
				<img id="js-iconeAudio" class="pointer" onMouseOver="acendeTipo('Audio');" onMouseOut="apagaTipo('Audio'); return nd();" onClick="selecionaTipo('Audio')" alt="{tr}Áudio{/tr}" src="styles/{$style|replace:".css":""}/img/iUpAudioOff.png">
				<br/>
				{tr}Áudio{/tr}
			</li>
			
			<li>
				<img id="js-iconeImagem" class="pointer" onMouseOver="acendeTipo('Imagem');" onMouseOut="apagaTipo('Imagem'); return nd();" onClick="selecionaTipo('Imagem')" alt="{tr}Imagem{/tr}" src="styles/{$style|replace:".css":""}/img/iUpImagemOff.png">
				<br/>
				{tr}Imagem{/tr}
			</li>
			
			<li>
				<img id="js-iconeTexto" class="pointer" onMouseOver="acendeTipo('Texto');" onMouseOut="apagaTipo('Texto'); return nd();" onClick="selecionaTipo('Texto')" alt="{tr}Texto{/tr}" src="styles/{$style|replace:".css":""}/img/iUpTextoOff.png">
				<br/>
				{tr}Texto{/tr}
			</li>
			
			<li>
				<img id="js-iconeVideo" class="pointer" onMouseOver="acendeTipo('Video');" onMouseOut="apagaTipo('Video'); return nd();" onClick="selecionaTipo('Video')" alt="{tr}Vídeo{/tr}" src="styles/{$style|replace:".css":""}/img/iUpVideoOff.png">
				<br/>
				{tr}Vídeo{/tr}
			</li>
			
			<li>
				<img id="js-iconeOutro" class="pointer" onMouseOver="acendeTipo('Outro');" onMouseOut="apagaTipo('Outro'); return nd();" onClick="selecionaTipo('Outro')" alt="{tr}Outro{/tr}" src="styles/{$style|replace:".css":""}/img/iUpOutroOff.png">
				<br/>
				{tr}Outro{/tr}
			</li>
		</ul>
	</div>
{/if}

<br />
<br />
<div id="js-browse">
	<span id="ajax-uploadForms">
		{foreach from=$arquivo->filereferences item=file key=i}
			<span id="uploadFormCont{$i}">
				{include file="el-gallery_upload_form.tpl" i=$i}
			</span>
			<script>uploadI++;</script>
		{foreachelse}
			<span id="uploadFormCont0">
				{include file="el-gallery_upload_form.tpl" i=0}
			</span>
			<script>uploadI++;</script>
		{/foreach}
	</span>
	
	<div class="pointer flippers" onClick="xajax_newUploadForm(uploadI)">
		{tooltip text="Clique para adiocionar mais um arquivo nesta publicação"}
			{tr}mais um arquivo...{/tr}
		{/tooltip}	
	</div>
</div>
	
<div id="js-desc">

	<img id="js-thumbnailM" />

	<div id="tituloAutor">
		{ajax_input permission=$permission id="title" value=$arquivo->title default="{tr}Título{/tr}" display="inline" truncate=50}
		<br/>
		<span>
			<em>{tr}Autor{/tr}:</em> {ajax_input permission=$permission id="author" value=$arquivo->author default="{tr}Autor da obra{/tr}" display="inline"}
		</span>
	</div>

	<div class="pointer flippers" onClick="flip('js-thumbFormM')">{tr}outra miniatura...{/tr}</div>
	<span id="js-thumbFormM" style="display:none">
		<iframe name="thumbUpTargetM" style="display:none"></iframe>
		<form name="thumbFormM" target="thumbUpTargetM" action="el-gallery_upload_thumb.php?thumbNum=M" method="post" enctype="multipart/form-data">
			<input type="hidden" name="UPLOAD_IDENTIFIER" value="">
			<input type="hidden" name="arquivoId" value="{$arquivo->id}">
			<input type="file" name="thumbM" onChange="thumbSelected('M')" class="gUpThumbFormButton">
			&nbsp;&nbsp;<span id="js-thumbStatusM"></span>
		</form>
	</span>
	<br/>
	{ajax_textarea permission=$permission  display="block" style="width:370px;height:175px;border:1px inset rgb(233, 233, 174);padding:3px;font-size:11pt;font-family:Arial,Verdana,Helvetica,Lucida,Sans-Serif;background-color:#f1f1f1;margin-bottom:5px;" id="description" value=$arquivo->description default="{tr}Escreva aqui a descrição da sua obra{/tr}"}
	
	<div id="license">
		<em>{tr}Licença{/tr}:</em>
		<img class="pointer" id="ajax-uImagemLicenca" src="styles/{$style|replace:".css":""}/img/h_{$licenca.imageName}" alt="Escolha uma licença" onClick="showLightbox('el-license')"/>
	</div>
		
	{include file="el-license.tpl" upload=1}
		
	{if $feature_freetags eq 'y' && $tiki_p_freetags_tag eq 'y'}
		<em>{tr}Tags{/tr}:</em>
		{tooltip text="Escreva aqui as tags desse arquivo (separadas por <b>vírgula</b>)"}
			{ajax_input permission=$permission id="tags" value=$arquivo->tagString noclear=1 display="inline"}
		{/tooltip}
		
		{tooltip text="Clique nas tags para adiocioná-las ao campo acima"}
			<div id="ajax-gUpTagListItem">
				{include file="el-tag_suggest_list.tpl"}
			</div> 
		{/tooltip}
		
		<div id="ajax-gUpTagSuggestMore" class="pointer flippers" onclick="getMoreTags();">
			ver mais tags
		</div>
	{/if freetags}
	
	{tooltip text="Clique para definir outras propriedades do arquivo"}
		<div class="pointer flippers" id="info" onclick="flip('ajax-gUpMoreOptionsContent');">
			{tr}Outras informações deste arquivo...{/tr}
		</div>
	{/tooltip}
	
	<div style="display:none" id="ajax-gUpMoreOptionsContent">
		{include file="el-gallery_metadata.tpl"}
		{if $arquivo && $arquivo->type neq "Texto"}
			{include file="el-gallery_metadata_"|cat:$arquivo->type|cat:".tpl"}
		{/if}
	</div>
	
	<div id="save-exit">
		<img src="styles/{$style|replace:".css":""}/img/bPublicar.png" class="pointer" onClick="checkWaiting('xajax_check_publish()')"/>
	</div>
</div>

{if $isIE}
	</center>
{/if}

<div id="js-pending">
	{if $pending && $permission}
		{tr}Arquivos não publicados{/tr}:<br/>
		<ul>
		{foreach from=$pending item=pendente}
			<li id="ajax-pendente-{$pendente->id}">
				<span class="pointer" onClick="xajax_delete_file({$pendente->id})"><img src="styles/{$style|replace:".css":""}/img/iDelete.png"></span>
				{tooltip text="Clique para continuar o envio desse arquivo"}
					<a href="el-gallery_upload.php?arquivoId={$pendente->id}">
						{$pendente->title|default:$pendente->filereferences[0]->fileName|default:$pendente->id}
					</a>
				{/tooltip}
			</li>
		{/foreach}
		</ul>
	{/if}
</div>

{include file="el-gallery_publish.tpl"}
{include file="el-gallery_error.tpl"}
<div id="js-errorDiv" class="none" style="width:200px"></div>

{if $arquivo}
	<script language="JavaScript">
		files = Array();
		{foreach from=$arquivo->filereferences item=upFile}
			files[files.length] = '{$upFile->fileName}';
		{/foreach}
		restoreForm({$arquivo->id}, '{$arquivo->type}', files, '{$arquivo->thumbnail}', '{$arquivo->fileDir()}');
	</script>
{/if}

<!-- el-gallery_upload.tpl end -->
