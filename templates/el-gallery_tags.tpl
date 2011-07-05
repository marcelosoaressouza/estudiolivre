{foreach from=$fileTags item=t name=tags}
	{tooltip text="Clique para ver outros arquivos com a tag <b>"|cat:$t.tag|cat:"</b>"}<a class="freetag" href="tiki-browse_freetags.php?tag={$t.tag}">{$t.tag}</a>{if not $smarty.foreach.tags.last},{/if}{/tooltip}
{foreachelse}
	{tooltip text="Esse arquivo não tem tags"}&nbsp;{/tooltip}
{/foreach}