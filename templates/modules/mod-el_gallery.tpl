{tikimodule title="{tr}Acervo{/tr}" name='el_gallery' flip=$module_params.flip}
	    <div class="modCenterContent">
	    	{tooltip text="Veja os arquivos que você publicou"}<a href="el-user.php?view_user={$user}#gallery">{tr}Meus arquivos{/tr}</a>{/tooltip}<br>
	    	{tooltip text="Publique <b>sua obra</b> no Estúdio Livre!"}<a href="el-gallery_upload.php">{tr}Publicar{/tr}</a>{/tooltip}
	    </div>
	   {if !preg_match("/el-gallery_upload.php/", $current_location) && sizeof($pendingUploadFiles) > 0}
  	    <hr>
	 		<span style="text-align:left">{tr}Arquivos não publicados{/tr}:</span><br/>
			{foreach from=$pendingUploadFiles item=pendente}
				<span id="ajax-pendente-{$pendente->id}">
					{tooltip text="<b>Apague</b> esse arquivo da lista (e do servidor)"}<a href="el-gallery_delete.php?arquivoId={$pendente->id}"><img src="styles/{$style|replace:".css":""}/img/iDelete.png"></a>{/tooltip}
					{tooltip text="Clique para continuar o envio desse arquivo"}
						<a href="el-gallery_upload.php?arquivoId={$pendente->id}">
							{$pendente->title|default:$pendente->filereferences[0]->fileName|default:$pendente->id|truncate:20:"(...)"}
						</a>
					{/tooltip}
				</span>
				<br/>
			{/foreach}
		 {/if}
{/tikimodule}