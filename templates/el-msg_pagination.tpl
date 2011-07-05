<!-- el-msg_pagination.tpl begin -->
{if $msgTotal > $msgMaxRecords}
	{if $msgPage-2 > 1}
		{tooltip text="Primeira página"}<a class="pointer" onClick="xajax_pgMsg(0, {$msgMaxRecords})">&laquo;</a>{/tooltip}
	{/if}
	{if $msgPage > 1}
		{tooltip text="Página anterior"}<a class="pointer" onClick="xajax_pgMsg({$msgOffset-$msgMaxRecords}, {$msgMaxRecords})">&lt;</a>{/tooltip}
	{/if}
	{if $msgPage-2 > 0}
		<a class="pointer" onClick="xajax_pgMsg({$msgOffset-2*$msgMaxRecords}, {$msgMaxRecords})">{$msgPage-2}</a>
	{/if}
	{if $msgPage-1 > 0}
		<a class="pointer" onClick="xajax_pgMsg({$msgOffset-$msgMaxRecords}, {$msgMaxRecords})">{$msgPage-1}</a>
	{/if}
	<span class="selected">{$msgPage}</span>
	{if $msgPage+1 <= $msgLastPage}
		<a class="pointer" onClick="xajax_pgMsg({$msgOffset+$msgMaxRecords}, {$msgMaxRecords})">{$msgPage+1}</a>
	{/if}				
	{if $msgPage+2 <= $msgLastPage}
		<a class="pointer" onClick="xajax_pgMsg({$msgOffset+2*$msgMaxRecords}, {$msgMaxRecords})">{$msgPage+2}</a>
	{/if}				
	{if $msgPage < $msgLastPage}
		{tooltip text="Próxima página"}<a class="pointer" onClick="xajax_pgMsg({$msgOffset+$msgMaxRecords}, {$msgMaxRecords})">&gt;</a>{/tooltip}
	{/if}
	{if $msgPage+2 < $msgLastPage}
		{tooltip text="Última página"}<a class="pointer" onClick="xajax_pgMsg({$msgMaxRecords*$msgLastPage-$msgMaxRecords}, {$msgMaxRecords})">&raquo;</a>{/tooltip}
	{/if}
{/if}
<!-- el-msg_pagination.tpl end -->
