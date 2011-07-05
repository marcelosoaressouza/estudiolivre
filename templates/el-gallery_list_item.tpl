<div class="listItem">
	<div class="listLeft">
		<a href="el-gallery_view.php?arquivoId={$arquivo->id}">
			{if $arquivo->thumbnail}
				<img src="{$arquivo->fileDir()}{$arquivo->thumbnail|escape:'url'}" {if $isIE}width=100 height=100{/if}>
			{else}
				<img src="styles/{$style|replace:".css":""}/img/iThumb{$arquivo->type}.png">
			{/if}
		</a>
		{assign var=ratings value=$arquivo->getArraySize('votes')}
		<img onmouseout="nd();" 
			 onmouseover="tooltip('{$ratings} {tr}voto{/tr}{if ($ratings>1 || $ratings<1) }s{/if}<br>{tr}Avaliação - entre na página do arquivo para votar{/tr}')"
			 alt="{$arquivo->rating} estrelas"
			 src="styles/{$style|replace:".css":""}/img/star{math equation="round(x)" x=$arquivo->rating|default:"blk"}.png"
			 class="listRating">
		<br />
		{tooltip name="list-baixe-arquivo" text="Copie todos os arquivos (para o seu computador)"}
			<a href="el-download.php?pub={$arquivo->id}&action=downloadAll">
				{tr}baixar{/tr}
			</a>
		{/tooltip}	
		{if $tooltipText}
		<br />
			<a href="el-gallery_view.php?arquivoId={$arquivo->id}">
				{tr}ver{/tr}
			</a>
		{/if}
		{if $arquivo->user eq $user or $el_p_admin_gallery eq "y"}
			<br />
			{tooltip name="list-apagar-arquivo-acervo" text="Apagar esse arquivo do acervo"}
				<span class="pointer" onClick="deleteFile({$arquivo->id},{$dontAskDelete},0);nd();">{tr}apagar{/tr}</span>
			{/tooltip}
		{/if}
	</div>
	
	<h2>
		<a href="el-gallery_view.php?arquivoId={$arquivo->id}">
			{$arquivo->title}
		</a>
	</h2>
	
	
	<div class="listInfo">
	
		<h4>
			<div class="asRow">
				<span class="lef">
					{tr}autor{/tr}: <em>{$arquivo->author}</em>
				</span>
				<span class="mid">
					{tr}enviado por{/tr}: <em><a href="el-user.php?view_user={$arquivo->user}">{$arquivo->user}</a></em>
					<br />
					{tr}em{/tr}: <em>{$arquivo->publishDate|date_format:"%d/%m/%y"}</em>
				</span>
				<span class="rig">
					{tr}tipo{/tr}: <em>{tr}{$arquivo->type}{/tr}</em>
				</span>
			</div>
		</h4>
		
		<h3>
			{if strlen($arquivo->description) > 150}
				{$arquivo->description|truncate:150:"":true}
				<a href="el-gallery_view.php?arquivoId={$arquivo->id}">
					({tr}ler mais{/tr}...)
				</a>
			{elseif $arquivo->description}
				{$arquivo->description}
			{else}
				{tr}Arquivo sem descrição{/tr}!
			{/if}
		</h3>
		
		<h4>
			<div class="asRow">
				<span class="lef">
					{tr}baixado{/tr}: <em>{$file->downloads} {if $file->downloads == 1 }{tr}vez{/tr}{else}{tr}vezes{/tr}{/if}</em>
					{if $tooltipText}
						<br />
						{tr}visto{/tr}: <em>{$file->streams} {if $file->streams == 1 }{tr}vez{/tr}{else}{tr}vezes{/tr}{/if}</em>
					{/if}
				</span>
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
				<span class="rig">
					{tr}licença{/tr}:
						{tooltip name="list-descricao-licenca" text=$arquivo->license->description}
							<a href="{$arquivo->license->humanReadableLink}">
								<img src="styles/{$style|replace:".css":""}/img/h_{$arquivo->license->imageName}">
							</a>
						{/tooltip}
				</span>
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