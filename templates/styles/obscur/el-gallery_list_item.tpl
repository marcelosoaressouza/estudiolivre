<div id="gListItem">
	<div class="title">
		<a href="el-gallery_view.php?arquivoId={$arquivo.arquivoId}">{$arquivo.titulo|truncate:15:"(...)"}</a>
		<h3>
		<a href="el-user.php?view_user={$arquivo.user}">{$arquivo.user}</a> - {$arquivo.data_publicacao|date_format:"%d/%m/%Y"}
		</h3>
	</div>
	<h5>
    	{tooltip name="list-avaliacao-votar" text="Avaliação - entre na página do arquivo para votar"}<img alt="{$arquivo.rating} estrelas" src="styles/estudiolivre/star{math equation="round(x)" x=$arquivo.rating|default:"blk"}.png">{/tooltip}
    </h5>
	<h2>
	    	{tooltip name="list-descricao-licenca" text=$arquivo.descricaoLicenca}
	    		<a href="{$arquivo.linkHumanReadable}">
	    			<img src="styles/estudiolivre/{$arquivo.linkImagem}">
				</a>
			{/tooltip}
		    <a href="el-gallery_view.php?arquivoId={$arquivo.arquivoId}">
				{if $arquivo.thumbnail}
					<img height="51" src="{$arquivo->fileDir()}{$arquivo.thumbnail}">
				{else}
					<img height="51" src="styles/obscur/iThumb{$arquivo.tipo}.png">
				{/if}
			</a>
  	</h2>
    <h6>
	    {if $arquivo.commentsCount == 0}
	    	{tooltip name="list-primeiro-comentar" text="Seja o primeiro a comentar sobre esse arquivo"}<a href="el-gallery_view.php?arquivoId={$arquivo.arquivoId}#comments">0 {tr}comentários{/tr}</a>{/tooltip}
	    {else}
	    	{tooltip name="list-ler-comentarios" text="Clique para ler os comentários"}<a href="el-gallery_view.php?arquivoId={$arquivo.arquivoId}#comments">{$arquivo.commentsCount} {tr}comentário{/tr}{if $arquivo.commentsCount != 1}s{/if}</a>{/tooltip}
	    {/if}
	    <br/>
	    {tooltip name="list-baixe-arquivo" text="Copie todos os arquivos (para o seu computador)"}
		  {$arquivo.hits}
	      <a href="el-download.php?pub={$arquivo.arquivoId}&action=downloadAll">
	        {tr}downloads{/tr}
	      </a>
	    {/tooltip}
	  	{if $arquivo.tipo eq "Video"}
	  		{if preg_match("/.*\.ogg$/", $arquivo.arquivo)}
		    	{assign var=tooltipText value="{tr}Assista a esse vídeo{/tr}"}
		    {/if}
	    {elseif $arquivo.tipo eq "Audio"}
	    	{if preg_match("/.*\.ogg$/", $arquivo.arquivo)}
		    	{assign var=tooltipText value="{tr}Ouça essa música{/tr}"}
		    {/if}
	    {elseif $arquivo.tipo eq "Imagem"}
	    	{assign var=tooltipText value="{tr}Veja essa imagem{/tr}"}
	    {/if}
	    	<br/>
	    {if $tooltipText}
	    	{$arquivo.streamHits}
	    	{tooltip name="list-i-play" text=$tooltipText}
		    	<a onClick="xajax_streamFile({$arquivo.arquivoId}, '{$arquivo.tipo}', getPageSize()[0])">{tr}streams{/tr}</a>
		    {/tooltip}
		{else}
			<br/>
	    {/if}
	    
    </h6>	
    <div id="gTags">
    {foreach from=$arquivo.tags.data item=t name=tags}
    	{if $smarty.foreach.tags.iteration <= 4}
	    	{tooltip text="Clique para ver outros arquivos com a tag <b>"|cat:$t.tag|cat:"</b>"}<a href="tiki-browse_freetags.php?tag={$t.tag}">{$t.tag|truncate:10:"(...)"}</a>{/tooltip}{if $smarty.foreach.tags.iteration < 4 && !$smarty.foreach.tags.last},{elseif $smarty.foreach.tags.total > 4} ({$smarty.foreach.tags.total} tags){/if}
	    {/if}
    {foreachelse}
      {tooltip text="Esse arquivo não tem tags"}<div width="100%">&nbsp;</div>{/tooltip}
    {/foreach}
   </div>
</div>
