<div id="freeTagsPagination">
  	{if $prev_offset >= 0}
    	[<a class="prevnext" href="tiki-browse_freetags.php?find={$find}&amp;tag={$tag}&amp;type={$type}&amp;offset={$prev_offset}">{tr}prev{/tr}</a>]&nbsp;
    {/if}
    
    {tr}Page{/tr}: {$actual_page}/{$cant_pages}
    
    {if $next_offset >= 0}
    	&nbsp;[<a class="prevnext" href="tiki-browse_freetags.php?find={$find}&amp;tag={$tag}&amp;type={$type}&amp;offset={$next_offset}">{tr}next{/tr}</a>]
    {/if}
    
    {if $direct_pagination eq 'y'}
    	<br />
    	{section loop=$cant_pages name=foo}
    		{assign var=selector_offset value=$smarty.section.foo.index|times:$maxRecords}
    		<a class="prevnext" href="tiki-browse_freetags.php?find={$find}&amp;tag={$tag}&amp;type={$type}&amp;offset={$selector_offset}">
				{$smarty.section.foo.index_next}
			</a>&nbsp;
		{/section}
	{/if}
</div>