<!-- el-gallery_pagination.tpl begin -->
{if $total > $maxRecords}
	{if $page-2 > 1}
		{tooltip name="pagination-primeira-pagina" text="Primeira página"}<a class="pointer" onClick="xajax_get_files(tipos, 0, {$maxRecords}, '{$sort_mode}', '{$userName}', '{$find}')">&laquo;</a>{/tooltip}
	{/if}
	{if $page > 1}
		{tooltip text="Página anterior"}<a class="pointer" onClick="xajax_get_files(tipos, {$offset-$maxRecords}, {$maxRecords}, '{$sort_mode}', '{$userName}', '{$find}')">&lt;</a>{/tooltip}
	{/if}
	{if $page-2 > 0}
		<a class="pointer" onClick="xajax_get_files(tipos, {$offset-2*$maxRecords}, {$maxRecords}, '{$sort_mode}', '{$userName}', '{$find}')">{$page-2}</a>
	{/if}
	{if $page-1 > 0}
		<a class="pointer" onClick="xajax_get_files(tipos, {$offset-$maxRecords}, {$maxRecords}, '{$sort_mode}', '{$userName}', '{$find}')">{$page-1}</a>
	{/if}
	<span class="selected">{$page}</span>
	{if $page+1 <= $lastPage}
		<a class="pointer" onClick="xajax_get_files(tipos, {$offset+$maxRecords}, {$maxRecords}, '{$sort_mode}', '{$userName}', '{$find}')">{$page+1}</a>
	{/if}				
	{if $page+2 <= $lastPage}
		<a class="pointer" onClick="xajax_get_files(tipos, {$offset+2*$maxRecords}, {$maxRecords}, '{$sort_mode}', '{$userName}', '{$find}')">{$page+2}</a>
	{/if}				
	{if $page < $lastPage}
		{tooltip text="Próxima página"}<a class="pointer" onClick="xajax_get_files(tipos, {$offset+$maxRecords}, {$maxRecords}, '{$sort_mode}', '{$userName}', '{$find}')">&gt;</a>{/tooltip}
	{/if}
	{if $page+2 < $lastPage}
		{tooltip text="Última página"}<a class="pointer" onClick="xajax_get_files(tipos, {$maxRecords*$lastPage-$maxRecords}, {$maxRecords}, '{$sort_mode}', '{$userName}', '{$find}')">&raquo;</a>{/tooltip}
	{/if}
{/if}
<!-- el-gallery_pagination.tpl end -->
