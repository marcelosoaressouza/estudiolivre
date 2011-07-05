<div class="searchResultItem">
	{if $feature_search_fulltext eq 'y'}{if $result.relevance <= 0}{assign var=tiptext value="{tr}Busca Simples{/tr}"}{else}{assign var=tiptext value="{tr}Relevância{/tr}: "|cat:$result.relevance}{/if}{/if}
	{tooltip text=$tiptext|cat:" - {tr}Hits{/tr}: "|cat:$result.hits}
	<a href="{$result.href}&amp;highlight={$words}" class="searchResultItemLink">
		{$result.pageName|strip_tags}
	</a>
	{/tooltip}
	{if $result.type > ''}
		<span class="searchType">
			({$result.type})
		</span>
	{/if}				
	<br />
	<div class="searchdesc">
		{$result.data|strip_tags}
	</div>
	{*<div class="searchdate">
		{tr}Last modification date{/tr}: {$result.lastModif|tiki_long_datetime}
	</div>*}
	<br />
</div>