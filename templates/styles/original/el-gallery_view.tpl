<!-- el-gallery_view.rpl begin -->

<script language="JavaScript" src="lib/js/freetags.js"></script>
<script language="JavaScript" src="lib/js/el_array.js"></script>
<script language="JavaScript" src="lib/js/edit_field_ajax.js"></script>
<script language="JavaScript" src="lib/js/file_edit.js"></script>
<script language="JavaScript" src="lib/js/el-rating.js"></script>

{include file="avisoTemaNaoSuportado.tpl" texto="suporta a visualização de arquivos do acervo"}

<div id="arqCont">
	<div id="aTopCont">
		<div id="aThumbRatingLic">		
			<div id="aRating">
				{tooltip name="view-avaliacao" text="Avaliação atual"}
					<img id="ajax-aRatingImg" src="styles/estudiolivre/star{math equation="round(x)" x=$arquivo.rating|default:"blk"}.png">
				{/tooltip}
			</div>
			<div id="aThumbLic">
				<div id="aLic">
					     {tooltip name="arq-descricao-licenca" text=$arquivo.licenca.descricao}
					     <a href="{$arquivo.licenca.linkHumanReadable}"><img src="styles/estudiolivre/{$arquivo.licenca.linkImagem}"></a>
					     {/tooltip}
				</div>

				{if $arquivo.thumbnail}
					<img id="ajax-thumbnail" src="repo/{$arquivo.thumbnail}" height="100" width="100">
				{else}
					<img id="ajax-thumbnail" src="styles/estudiolivre/iThumb{$arquivo.tipo}.png" height="100" width="100">
				{/if}
				<div id="gUserThumbStatus"></div>
				{if $permission}
					<div id="aThumbForm">
				        {tooltip text="Clique para selecionar outra <b>miniatura</b> para o arquivo"}
				        <form action="el-gallery_upload_thumb.php?UPLOAD_IDENTIFIER=thumb.{$uploadId}" method="post" enctype="multipart/form-data" name="thumbForm" target="thumbUpTarget">
						  	<input type="hidden" name="UPLOAD_IDENTIFIER" value="thumb.{$uploadId}">
						  	<input type="hidden" name="arquivoId" value="{$arquivo.arquivoId}">
						  	<input type="file" name="thumb" onChange="changeThumbStatus()" id="aThumbFormButton">
				        </form>
				        {/tooltip}
				    </div>
					<iframe name="thumbUpTarget" style="display:none" onLoad="finishUpThumb();"></iframe>
				{/if}
			</div>
		</div>
		
		<div id="aMainInfo">
			<div id="aNameAuthorDown">
				<div id="aDown">
					<div id="gDownload">
						<span class="gDownloadCount">
							{$arquivo.hits}
						</span>
						{tooltip name="view-baixe-arquivo" text="Copie o arquivo (para o seu computador)"}
						<a href="el-download.php?arquivo={$arquivoId}&action=download">
						  <img alt="" src="styles/estudiolivre/iDownload.png">
						</a>
						{/tooltip}
					</div>
					<div id="gPlay">
						{if $arquivo.tipo eq "Video"}
							{assign var=tooltipText value="Assita a esse vídeo"}
						{elseif $arquivo.tipo eq "Audio"}
							{assign var=tooltipText value="Ouça essa música"}
						{elseif $arquivo.tipo eq "Imagem"}
							{assign var=tooltipText value="Veja essa imagem"}
						{/if}
						{if $tooltipText}
							<span class="gStreamCount">
								{$arquivo.streamHits}
							</span>
							{tooltip name="view-iplay-" text=$tooltipText}
								<img class="pointer" alt="" src="styles/estudiolivre/iPlay.png" onClick="xajax_streamFile({$arquivo.arquivoId}, '{$arquivo.tipo}')">
							{/tooltip}
						{/if}
					</div>
				</div>
				<div id="aNameAuthor">
					{if $permission}
						<a id="aDelete" href="el-gallery_delete.php?arquivoId={$arquivo.arquivoId}">{tooltip name="apagar-arquivo-acervo" text="Apagar esse arquivo"}<img src="styles/estudiolivre/iDelete.png"/>{/tooltip}</a>
					{/if}
					<div id="aName">
						{if $permission}
							{tooltip text="Clique para modificar o nome desse arquivo"}{ajax_input permission=$permission id="titulo" value=$arquivo.titulo default="Titulo" display="inline"}{/tooltip}
						{else}
							{ajax_input permission=$permission id="titulo" value=$arquivo.titulo default="Titulo" display="inline"}
						{/if}
					</div>
					<div id="aAuthorDate">
						autor: {ajax_input permission=$permission id="autor" value=$arquivo.autor default="Autor da Obra" display="inline"} - enviado por <a href="el-user.php?view_user={$arquivo.user}">{$arquivo.user}</a> em <i>{$arquivo.data_publicacao|date_format:"%d/%m/%Y"}</i>
					</div>
				</div>
			</div>
					
			<div id="aActions">
				{if $user}
					<div>
					{section name=rating start=1 loop=6 step=1}
						{if not $smarty.section.rating.first}{assign var=plural value="s"}{/if}
						{tooltip name="arquivo_vote" text="Clique para mudar o seu voto para <b>"|cat:$smarty.section.rating.index|cat:" estrela"|cat:$plural|cat:"</b>"}
					    	{if $arquivo.userRating && $arquivo.userRating >= $smarty.section.rating.index}
				  		    	<img class="pointer" id="aRatingVote-{$smarty.section.rating.index}" src="styles/estudiolivre/iStarOn.png" onClick="acervoVota({$smarty.section.rating.index})"/>
					    	{else}
					        	<img class="pointer" id="aRatingVote-{$smarty.section.rating.index}" src="styles/estudiolivre/iStarOff.png" onClick="acervoVota({$smarty.section.rating.index})"/>
						    {/if}
					    {/tooltip}
				    {/section}
				    </div>
			    {/if}
			</div>
			
			{assign var=fileTags value=$arquivo.tags}
			<div class="aTags" id="show-tags" {if $permission}onClick="editaCampo('tags')"{/if}>
				{include file="el-gallery_tags.tpl"}
			</div>
			{if $permission}
				<input class="aTags" id="input-tags" value="{$arquivo.tagString}" onBlur="xajax_editTags(this.value)" style="display:none; width:80%; padding-left:5px">
				<img id="error-tags" class="gUpErrorImg" style="display: none" src="styles/estudiolivre/errorImg.png" onMouseover="tooltip(errorMsg_tags);" onMouseout="nd();"> 
				<script language="JavaScript">  display["tags"] = "inline";errorMsg_tags = "";</script>
			{/if}
		</div>
	</div>
	<br style="line-height: 25px"/>
	<div id="aMiddle">
		
		<!-- comentarios -->

		{if $tiki_p_read_comments eq 'y'}
		<div id="aComments">
			<div id="aCommentsTitle" class="sectionTitle">
				<div class="aTitleCont">
					<img class="pointer" onclick="flip('aCommentsItemsCont'); flip('aCommentSend');this.toggleImage('iArrowGreyRight.png')" src="styles/estudiolivre/iArrowGreyDown.png">
					<h1>Comentários ({$comments_cant})</h1>
					<img id="aCommentsRss" src="styles/estudiolivre/iRss.png"/>
				</div>
			</div>
			<div id="aCommentsItemsCont" class="aItemsCont" style="display:block">
				{if $comments_cant > 0}
				{foreach from=$comments_coms item='comment'}
					<div class="uMsgItem">
						<div class="uMsgAvatar">
							<img alt="" title="" src="tiki-show_user_avatar.php?user={$comment.userName}">
						</div>
						<div class="uMsgTxt">
							{if ($tiki_p_remove_comments eq 'y' && $forum_mode ne 'y') || ($tiki_p_admin_forum eq 'y' and $forum_mode eq 'y')}
							<div class="uMsgDel">
								<a href="{$comments_complete_father}comments_threshold={$comments_threshold}&amp;comments_threadId={$comment.threadId}&amp;comments_remove=1&amp;comments_offset={$comments_offset}&amp;comments_sort_mode={$comments_sort_mode}&amp;comments_maxComments={$comments_maxComments}&amp;comments_parentId={$comments_parentId}&amp;comments_style={$comments_style}"><img alt="" title="Deletar Mensagem" src="styles/estudiolivre/iDelete.png"></a>
							</div>
							{/if}
							<div class="uMsgDate">
								{$comment.commentDate|date_format:"%H:%M"}<br />
								{$comment.commentDate|date_format:"%d/%m/%y"}
							</div>
							<a href="el-user.php?view_user={$comment.userName}">{$comment.userName}</a>: {$comment.parsed}
						</div>
					</div>
				{/foreach}
				{/if}
			</div>
			<div id="aCommentSend" style="display:block">
				{if $user and (($tiki_p_forum_post eq 'y' and $forum_mode eq 'y') or ($tiki_p_post_comments eq 'y' and $forum_mode ne 'y'))}
				<div id="uMsgSend">
					<form method="post" action="{$comments_father}" id='editpostform'>
		    			<input type="hidden" name="comments_reply_threadId" value="{$comments_reply_threadId|escape}" />    
					    <input type="hidden" name="comments_grandParentId" value="{$comments_grandParentId|escape}" />    
					    <input type="hidden" name="comments_parentId" value="{$comments_parentId|escape}" />
					    <input type="hidden" name="comments_offset" value="{$comments_offset|escape}" />
					    <input type="hidden" name="comments_threadId" value="{$comments_threadId|escape}" />
					    <input type="hidden" name="comments_threshold" value="{$comments_threshold|escape}" />
					    <input type="hidden" name="comments_sort_mode" value="{$comments_sort_mode|escape}" />
					    {* Traverse request variables that were set to this page adding them as hidden data *}
					    {section name=i loop=$comments_request_data}
						    <input type="hidden" name="{$comments_request_data[i].name|escape}" value="{$comments_request_data[i].value|escape}" />
					    {/section}
						<input type="hidden" name="comments_title" value="foobar" />
						<input type="submit" name="comments_postComment" value="enviar" label="enviar" id="uMsgSendSubmit" />
						{if !$comments_cant}
							{tooltip text="Seja o primeiro a comentar! Digite aqui o seu comentário e clique em <b>enviar</b>"}
								<input type="text" id="uMsgSendInput" name="comments_data" value="{$comment_data|escape}"/>
							{/tooltip}
						{else}
							{tooltip text="Digite o seu comentário e clique em <b>enviar</b>"}
								<input type="text" id="uMsgSendInput" name="comments_data" value="{$comment_data|escape}"/>
							{/tooltip}
						{/if}
					</form>
					<br /><br /><br />
				</div>
				{/if}
			</div>
		</div>
		{/if}
		<!-- fim dos comentarios -->
		
		<div id="aDescriptionInfo">
			<div id="aDesc">
				<div id="aDescTitle" class="sectionTitle">
					<div class="aTitleCont aTitleContRight">
						<img class="pointer" onclick="flip('aDescCont');this.toggleImage('iArrowGreyRight.png')" src="styles/estudiolivre/iArrowGreyDown.png">
						<h1>Descrição</h1>
					</div>
				</div>
				<div id="aDescCont" class="aItemsCont" style="display:block">
					{if $permission}
						{tooltip text="Clique aqui para modificar a descri&ccedil;&atilde;o do arquivo"}{ajax_textarea permission=$permission style="width: 250px; height:125px; border: 1px inset rgb(233, 233, 174);padding: 3px;font-size: 12px; font-family: Arial, Verdana, Helvetica, Lucida, Sans-Serif;background-color: #f1f1f1;margin-bottom: 5px;" id="descricao" value=$arquivo.descricao display="block" wikiParsed=1}{/tooltip}
					{else}
						{ajax_textarea permission=$permission style="width: 250px; height:125px; border: 1px inset rgb(233, 233, 174);padding: 3px;font-size: 12px; font-family: Arial, Verdana, Helvetica, Lucida, Sans-Serif;background-color: #f1f1f1;margin-bottom: 5px;" id="descricao" value=$arquivo.descricao display="block" wikiParsed=1}
					{/if}
				</div>
			</div>
			<div id="aInfo">
				<div id="aInfoTitle" class="sectionTitle">
					<div class="aTitleCont aTitleContRight">
						<img class="pointer" onclick="flip('aInfoCont');this.toggleImage('iArrowGreyRight.png')" src="styles/estudiolivre/iArrowGreyDown.png">
						<h1>Detalhes do Arquivo</h1>
					</div>
				</div>
				<div id="aInfoCont" class="aItemsCont" style="display:block">
					<div id="gUpMoreOptions">
						<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">Formato:</div> {$arquivo.tipo} - {$arquivo.formato|show_extension}</div>
						<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">Tamanho:</div> {$arquivo.tamanho|show_filesize}</div>
						{include file="el-gallery_metadata.tpl"}
						{if $arquivo.tipo neq "Texto"}
							{include file="el-gallery_metadata_"|cat:$arquivo.tipo|cat:".tpl"}
						{/if}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<br>
<div id="save-exit" class="aSaveCancel" style="z-index: 10; display: none;">
  {tooltip text="Salve as modificações que acaba de fazer"}<img src="styles/estudiolivre/bSave.png" onClick="checkWaiting('xajax_commit_arquivo()');hide('save-exit');nd();" style="cursor: pointer">{/tooltip}&nbsp;&nbsp;&nbsp;
  {tooltip text="Cancele as modificações que acaba de fazer"}<img src="styles/estudiolivre/bCancelar.png" onClick="cancelEdit();hide('save-exit');nd();" style="cursor: pointer">{/tooltip}
</div>

{if $arquivo.editCache && $permission && $arquivo.user eq $user}
<div id="lightFileAltered" style="display:none; width: 400px;">
	Atenção: este arquivo foi modificado e as alterações não foram salvas!<br/>
	<span onClick="cancelEdit(); hideLightbox();" style="cursor: pointer">Cancelar</span>&nbsp;&nbsp;&nbsp;
	<span onClick="restoreEdit({$arquivo.arquivoId}); hideLightbox();" style="cursor: pointer">Restaurar</span>
</div>
<script language="Javascript">
	showLightbox('lightFileAltered');
</script>
{/if}

<!-- el-gallery_view.rpl end -->
