{foreach from=$tag_suggestion item=t name=tag_suggest}
	<span class="pointer" onclick="addTag(this)">{$t}</span><span id="{$t}-v"{if $smarty.foreach.tag_suggest.last} style="display:none"{/if}>,</span>
{/foreach}