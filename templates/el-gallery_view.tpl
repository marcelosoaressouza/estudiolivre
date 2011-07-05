<!-- el-gallery_view.tpl begin -->
{css extra=el-gallery_metadata,el-user_msg,ajax_inputs}

<script language="JavaScript" src="lib/js/freetags.js"></script>
<script language="JavaScript" src="lib/js/el_array.js"></script>
<script language="JavaScript" src="lib/js/edit_field_ajax.js"></script>
<script language="JavaScript" src="lib/js/uploadThumb.js"></script>
<script language="JavaScript" src="lib/js/el-rating.js"></script>
<script language="JavaScript" src="lib/js/delete_file.js"></script>

<img id="pubType" src="styles/{$style|replace:".css":""}/img/iUp{$arquivo->type}.png">
<h1 id="pubTitle">
	{if $permission}
		{tooltip text="Clique para modificar o nome desse arquivo"}{ajax_input permission=$permission id="title" value=$arquivo->title default="Titulo" display="inline"}{/tooltip}
	{else}
		{ajax_input permission=$permission id="title" value=$arquivo->title default="Titulo" display="inline"}
	{/if}
</h1>

<div id="info">
	<div id="author">
		<b>{tr}autor{/tr}:</b> {ajax_input permission=$permission id="author" value=$arquivo->author default="Autor da Obra" display="inline"}<br/>
		<b>{tr}por{/tr}:</b> <a href="el-user.php?view_user={$arquivo->user}">{$arquivo->user}</a>
		<b>{tr}em{/tr}:</b> <i>{$arquivo->publishDate|date_format:"%d/%m/%Y"}</i><br/>
		{tooltip text=$arquivo->license->description}
			<a href="{$arquivo->license->humanReadableLink}"><img id="lic" src="styles/{$style|replace:".css":""}/img/h_{$arquivo->license->imageName}"></a>
		{/tooltip}
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		{if $permission}
			{tooltip text="Apagar essa publicação <br/>(e <b>todos</b> seus arquivos!)"}
				<img class="pointer" onClick="deleteFile({$arquivo->id}, {$dontAskDelete}, 0);" src="styles/{$style|replace:".css":""}/img/iDelete.png"/>
			{/tooltip}
		{/if}
	</div>
	
	<span id="down">
		{tooltip text="Copie todos os arquivos (para o seu computador)"}
			<a href="el-download.php?pub={$arquivoId}&action=downloadAll">
				<img class="fl" alt="{tr}baixe tudo{/tr}" src="styles/{$style|replace:".css":""}/img/iDownload.png">
				<div>
					{tr}baixe tudo{/tr}
					{if $allFileSize}
		 				({$allFileSize|show_filesize})
		 			{/if}
				</div>
			</a>
		{/tooltip}
	</span>
	
	<span id="pubRating">
		{tooltip name="view-avaliacao" text="Avaliação atual"}
			<img id="ajax-aRatingImg" src="styles/{$style|replace:".css":""}/img/star{math equation="round(x)" x=$arquivo->rating|default:"blk"}.png">
		{/tooltip}
		{assign var=votes value=$arquivo->getArraySize('votes')}
		<b><span id="ajax-aVoteTotal">{$votes}</span> {tr}voto{if $votes != 1}s{/if}{/tr}</b> 
		{if $user}
			<br/>
			<span id="rate" class="none">
				{assign var=userVote value=$arquivo->getUserVote()}
				{section name=rating start=1 loop=6 step=1}
					{if not $smarty.section.rating.first}{assign var=plural value="s"}{/if}
					{tooltip text="Clique para mudar o seu voto para <b>"|cat:$smarty.section.rating.index|cat:" estrela"|cat:$plural|cat:"</b>"}
				    	{if $userVote->rating && $userVote->rating >= $smarty.section.rating.index}
			  		    	<img class="pointer" id="aRatingVote-{$smarty.section.rating.index}" src="styles/{$style|replace:".css":""}/img/iStarOn.png" onClick="acervoVota({$smarty.section.rating.index})"/>
				    	{else}
				        	<img class="pointer" id="aRatingVote-{$smarty.section.rating.index}" src="styles/{$style|replace:".css":""}/img/iStarOff.png" onClick="acervoVota({$smarty.section.rating.index})"/>
					    {/if}
				    {/tooltip}
			    {/section}
			</span>
			<b class="pointer" onClick="toggleSpan('rate')">vote!</b>
		{/if}
	</span>
	
</div>

<br/>
{if isset($viewFile)}
<div id="viewFile">
	{assign var=file value=$arquivo->filereferences[$viewFile]}
	{include file="meta-file.tpl"}
</div>
{/if}
<br/>

<span id="tags">
	{assign var=fileTags value=$arquivo->tags}
	{if $permission}
		{tooltip text="Clique para editar as <b>tags</b> desse arquivo"}<img class="pointer" src="styles/{$style|replace:".css":""}/img/iTagEdit.png" onClick="editaCampo('tags')">{/tooltip}
	{/if}
	<div id="show-tags">
		{include file="el-gallery_tags.tpl"}
	</div>
	
	{if $permission}
		<input id="input-tags" value="{$arquivo->tagString}" onBlur="xajax_save_field('tags', this.value)" style="display:none;">
		<img id="error-tags" class="gUpErrorImg" style="display: none" src="styles/{$style|replace:".css":""}/img/errorImg.png" onMouseover="tooltip(errorMsg_tags);" onMouseout="nd();"> 
		<script language="JavaScript">  display["tags"] = "block";errorMsg_tags = "";</script>
	{/if}
</span>

<br/>

<span id="more">
	<div id="files">
		<div class="sectionTitle">
			<span class="titleCont" onclick="flip('filesCont');toggleImage(document.getElementById('fileTArrow'),'iArrowGreyRight.png')">
				<img id="fileTArrow" src="styles/{$style|replace:".css":""}/img/iArrowGreyDown.png">
				<h1>{tr}Arquivos da Publicação{/tr}</h1>
			</span>
		</div>
		<div id="filesCont" class="itemCont" style="display:block">
			<div id="ajax-pubFilesCont">
				{foreach from=$arquivo->filereferences item=file key=key}
					{include file="fileBox.tpl"}
				{/foreach}
			</div>
		</div>
	</div>
		
	<div id="descriptionInfo">
		<div class="sectionTitle">
			<span class="titleCont titleContRight" onclick="flip('descCont');toggleImage(document.getElementById('desTArrow'),'iArrowGreyRight.png')" >
				<img id="desTArrow" src="styles/{$style|replace:".css":""}/img/iArrowGreyDown.png">
				<h1>{tr}Descrição{/tr}</h1>
			</span>
		</div>
		<div id="descCont" class="itemCont" style="display:block">
			{if $permission}
				{tooltip text="Clique aqui para modificar a descri&ccedil;&atilde;o do arquivo"}{ajax_textarea permission=$permission style="width: 250px; height:125px; border: 1px inset rgb(233, 233, 174);padding: 3px;font-size: 12px; font-family: Arial, Verdana, Helvetica, Lucida, Sans-Serif;background-color: #f1f1f1;margin-bottom: 5px;" id="description" value=$arquivo->description display="block" wikiParsed=1}{/tooltip}
			{else}
				{ajax_textarea permission=$permission style="width: 250px; height:125px; border: 1px inset rgb(233, 233, 174);padding: 3px;font-size: 12px; font-family: Arial, Verdana, Helvetica, Lucida, Sans-Serif;background-color: #f1f1f1;margin-bottom: 5px;" id="description" value=$arquivo->description display="block" wikiParsed=1}
			{/if}
		</div>
		<div class="sectionTitle">
			<span class="titleCont titleContRight" onclick="flip('infoCont');toggleImage(document.getElementById('detTArrow'),'iArrowGreyRight.png')" >
				<img id="detTArrow" src="styles/{$style|replace:".css":""}/img/iArrowGreyDown.png">
				<h1>{tr}Detalhes da Publicação{/tr}</h1>
			</span>
		</div>
		<div id="infoCont" class="itemCont" style="display:block">
			{if $permission}
				<div class="none" id="pThumbForm">
					suba outra miniatura<br/>
			        <iframe name="thumbUpTargetM" style="display:none"></iframe>
					<form name="thumbFormM" target="thumbUpTargetM" action="el-gallery_upload_thumb.php?thumbNum=M" method="post" enctype="multipart/form-data">
						<input type="hidden" name="UPLOAD_IDENTIFIER" value="">
						<input type="hidden" name="arquivoId" value="{$arquivo->id}">
						<input type="file" name="thumbM" onChange="thumbSelected('M')">
						&nbsp;&nbsp;<span id="js-thumbStatusM"></span>
					</form>
					{if count($fileThumbs)}
						<br/>ou<br/>
						<select onChange="changePubThumb(this)">
							<option value="-1"> - use a de um dos arquivos - </option>
							{foreach from=$fileThumbs key=fileNum item=fileName}
								<option value="{$fileNum}">{$fileName}</option>
							{/foreach}
						</select>
					{/if}
			    </div>
			    
				{tooltip text="Clique para selecionar outra <b>miniatura</b> para a publicação"}
					<div class="pointer" onClick="flip('pThumbForm');">
						{if $arquivo->thumbnail}
							<img id="js-thumbnailM" src="{$arquivo->fileDir()}{$arquivo->thumbnail|escape:'url'}">
						{else}
							<img id="js-thumbnailM" src="styles/{$style|replace:".css":""}/img/iThumb{$arquivo->type}.png">
						{/if}
						<br/>
						<span class="fInfo">trocar miniatura</span>
					</div>
				{/tooltip}
			{/if}
			<br/><br/>
			<div id="gUpMoreOptions">
				{include file="el-gallery_metadata.tpl"}
				{if $arquivo->type neq "Texto"}
					{include file="el-gallery_metadata_"|cat:$arquivo->type|cat:".tpl"}
				{/if}
			</div>
		</div>
		
		{if $tiki_p_read_comments eq 'y'}
			{assign var=comments value=$arquivo->getArraySize('comments')}
			
			<div class="sectionTitle">
				<span class="titleCont titleContRight" onclick="flip('ajax-aCommentsItemsCont');flip('aCommentSend');toggleImage(document.getElementById('comTArrow'),'iArrowGreyRight.png')">
					<img id="comTArrow" src="styles/{$style|replace:".css":""}/img/iArrowGreyDown.png">
					<h1>{tr}Comentários{/tr} (<span id="ajax-commentCount">{$comments}</span>)</h1>
				</span>
			</div>
			<div id="ajax-aCommentsItemsCont" class="itemCont" style="display:block">
				{if $comments > 0}
				{foreach from=$arquivo->comments item='comment'}
					{include file="el-publication_comment.tpl"}
				{/foreach}
				{/if}
			</div>
			<div id="aCommentSend" style="display:block">
				{if $user and (($tiki_p_forum_post eq 'y' and $forum_mode eq 'y') or ($tiki_p_post_comments eq 'y' and $forum_mode ne 'y'))}
				<div id="uMsgSend">
					<input type="submit" value="{tr}enviar{/tr}" label="enviar" id="uMsgSendSubmit" onClick="xajax_comment(document.getElementById('uMsgSendInput').value);" />
					{if !$comments}
						{tooltip text="Seja @ primeir@ a comentar! Digite aqui o seu comentário e clique em <b>enviar</b>"}
							<input type="text" id="uMsgSendInput" name="comment" />
						{/tooltip}
					{else}
						{tooltip text="Digite o seu comentário e clique em <b>enviar</b>"}
							<input type="text" id="uMsgSendInput" name="comment" />
						{/tooltip}
					{/if}
					<br /><br /><br />
				</div>
				{/if}
				{if !$user}
					{tr}Faça o login para comentar!{/tr}
				{/if}
			</div>
		{/if}
		
	</div>
</span>

	<br/><br/><br/><br/>
		
	


			
			<!-- comentarios -->
			
		</div>

{include file="el-gallery_confirm_delete.tpl"}