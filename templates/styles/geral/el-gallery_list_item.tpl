{* para os tooltips *}
{assign var=file value=$arquivo->filereferences[0]}
{if $arquivo->type eq "Video"}
	{if preg_match("/.*\.ogg$/i", $file->fileName)}
		{assign var=tooltipText value="{tr}Assista a esse vídeo{/tr}"}
	{/if}
{elseif $arquivo->type eq "Audio"}
	{if preg_match("/.*\.ogg$/i", $file->fileName)}
		{assign var=tooltipText value="{tr}Ouça essa música{/tr}"}
	{/if}
{elseif $arquivo->type eq "Imagem"}
	{if !preg_match("/.*\.svg$/i", $file->fileName)}
		{assign var=tooltipText value="{tr}Veja essa imagem{/tr}"}
	{/if}
{else}
	{assign var=tooltipText value=0}
{/if}

<div class="listItem pb">
	<div class="listLeft">
		<div class="thumb">
		<a class="listThumb" href="el-gallery_view.php?arquivoId={$arquivo->id}">
			{if $arquivo->thumbnail}
				<img src="{$arquivo->fileDir()}{$arquivo->thumbnail|escape:'url'}" {if $isIE}width=100 height=100{/if}>
			{else}
				<img src="styles/{$style|replace:".css":""}/img/iThumb{$arquivo->type}.gif">
			{/if}
		</a></div>
		<div class="listRB">
		{assign var=ratings value=$arquivo->getArraySize('votes')}
		<img onmouseout="nd();" 
			 onmouseover="tooltip('{$ratings} {tr}voto{/tr}{if ($ratings>1 || $ratings<1) }s{/if}<br>{tr}Avaliação - entre na página do arquivo para votar{/tr}')"
			 alt="{$arquivo->rating} estrelas"
			 src="styles/{$style|replace:".css":""}/img/star{math equation="round(x)" x=$arquivo->rating|default:"blk"}.png"
			 class="listRating">
	
		{tooltip name="list-baixe-arquivo" text="Copie o arquivo (para o seu computador)"}
				<a href="el-download.php?pub={$arquivo->id}&action=downloadAll">
					{tr}baixar{/tr}
				</a>{/tooltip}<br />
				{if $tooltipText}
				{tooltip name="list-i-play" text=$tooltipText}
				<span class="pointer" alt="" onClick="xajax_streamFile({$arquivo->id},'{$arquivo->type}', getPageSize()[0]);nd();"><b>
					{tr}ver{/tr}</b>
				</span>
				<br /><br />
				{/tooltip}{/if}
				{if $arquivo->user eq $user or $el_p_admin_gallery eq "y"}{tooltip name="list-apagar-arquivo-acervo" text="Apagar esse arquivo do acervo"}
				<span class="pointer" onClick="deleteFile({$arquivo->id},{$dontAskDelete},0);nd();">
					{tr}apagar{/tr}
				</span><br />{/tooltip}{/if}
		
				<p class="mini">
					{tr}baixado{/tr}: {$file->downloads} {if $file->downloads == 1 }{tr}vez{/tr}{else}{tr}vezes{/tr}{/if}<br />
					{if $tooltipText}
					{tr}visto{/tr}: {$file->streams} {if $file->streams == 1 }{tr}vez{/tr}{else}{tr}vezes{/tr}{/if}{/if}<br />
					{tr}autor{/tr}: {$arquivo->author}<br/>
					{tr}enviado por{/tr} <a href="el-user.php?view_user={$arquivo->user}">{$arquivo->user}</a><br />					
					{$arquivo->publishDate|date_format:"%d/%m/%y"}<br/>
					{tr}tipo{/tr}: {tr}{$arquivo->type}{/tr}
				</p>
		</div>
	</div>
	<div class="listRight">
	<h2 class="title">
		<a href="el-gallery_view.php?arquivoId={$arquivo->id}">
			{$arquivo->title}
		</a>
	</h2>
	
	<span>
			{if strlen($arquivo->description) > 80}
				{$arquivo->description|truncate:80:"":true}
				<a href="el-gallery_view.php?arquivoId={$arquivo->id}">
					(...)
				</a>
			{elseif $arquivo->description}
				{$arquivo->description}
			{else}
				{tr}Arquivo sem descrição{/tr}!
			{/if}
		</span>
	<div class="listInfo">
	
		<h4>
			
		</h4>
		
		
		
		<h4>
			<div class="asRow">
				
				<span class="mid">
					{tr}comentários{/tr}:
					{assign var=commentsCount value=$arquivo->getArraySize('comments')}
						<em>
							{if $commentsCount == 0}
								{tooltip name="list-primeiro-comentar" text="Seja o primeiro a comentar sobre esse arquivo"}
								<a href="el-gallery_view.php?arquivoId={$arquivo->id}#comments">
								0
								</a>
								{/tooltip}
							{else}
								{tooltip name="list-ler-comentarios" text="Clique para ler os comentários"}
									<a href="el-gallery_view.php?arquivoId={$arquivo->id}#comments">
										{$commentsCount}
									</a>
								{/tooltip}
							{/if}
						</em>
				</span>
<br/>				
				<span class="rig">
					{tr}licença{/tr}:
						{tooltip name="list-descricao-licenca" text=$arquivo->license->description}
							<a href="{$arquivo->license->humanReadableLink}">
								<img src="styles/{$style|replace:".css":""}/img/h_{$arquivo->license->imageName}">
							</a>
						{/tooltip}
				</span>
			</div>
	
	
	</div>
	
	
	
		</h4>
		
		<h4>
			<span>
				tags:
				<em>
					{foreach from=$arquivo->tags item=t name=tags}{tooltip text="Clique para ver outros arquivos com a tag <b>"|cat:$t.tag|cat:"</b>"}<a href="tiki-browse_freetags.php?tag={$t.tag}">{$t.tag}</a>{if not $smarty.foreach.tags.last}, {/if}{/tooltip}{foreachelse}
						{tr}Esse arquivo não tem tags{/tr}.
					{/foreach}
				</em>
			</span>
		</h4>
	</div>
</div>