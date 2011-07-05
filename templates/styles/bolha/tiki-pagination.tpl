{if $cant_pages > 1}
	<div class="paginacao">
		{if $prev_offset >= 0}
			<a class="prevnext" href="{$smarty.server.PHP_SELF}?offset={$prev_offset}{foreach key=arg item=val from=$urlquery}{if $val}&amp;{$arg|escape:"url"}={$val|escape:"url"}{/if}{/foreach}">
				<img src="styles/{$style|replace:".css":""}/img/iArrowGreyLeft.png">
			</a>
		{/if}
		
		{tr}Page{/tr} {$actual_page} de {$cant_pages}
		
		{if $next_offset >= 0}
			<a class="prevnext" href="{$smarty.server.PHP_SELF}?offset={$next_offset}{foreach key=arg item=val from=$urlquery}{if $val}&amp;{$arg|escape:"url"}={$val|escape:"url"}{/if}{/foreach}">
				<img src="styles/{$style|replace:".css":""}/img/iArrowGreyRight.png">
			</a>
		{/if}
		{if $direct_pagination eq 'y'}
			{section loop=$cant_pages name=foo}
				{assign var=selector_offset value=$smarty.section.foo.index|times:$maxRecords}
				<a class="prevnext" href="{$smarty.server.PHP_SELF}?offset={$selector_offset}{foreach key=arg item=val from=$urlquery}{if $val}&amp;{$arg|escape:"url"}={$val|escape:"url"}{/if}{/foreach}">
					{$smarty.section.foo.index_next}
				</a>
			{/section}
		{/if}
	</div>
{/if}

