{include file="header.tpl"}
{* Index we display a wiki page here *}
{if $feature_bidi eq 'y'}
<table dir="rtl" ><tr><td>
{/if}

{if $feature_top_bar eq 'y'}
<div id="tiki-top">
{include file="tiki-top_bar.tpl"}
</div>
{/if}


<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr valign="top">

{if $feature_left_column ne 'n' and count($left_modules)}
<td id="leftcolumn">
{section name=homeix loop=$left_modules}
{$left_modules[homeix].data}
{/section}
</td>
<td class="vertline"><img src="styles/smartiki/spacer.gif" width="2" height="2" border="0" alt="" /></td>
{/if}

<td id="centercolumn">
{include file=$mid}
{if $show_page_bar eq 'y'}
{include file="tiki-page_bar.tpl"}
{/if}

</td>

{if $feature_right_column ne 'n'  and count($right_modules)}
<td class="vertline"><img src="styles/smartiki/spacer.gif" width="2" height="2" border="0" alt="" /></td>
<td id="rightcolumn">
{section name=homeix loop=$right_modules}
{$right_modules[homeix].data}
{/section}

</td>
{/if}
</tr></table>
{if $feature_bot_bar eq 'y'}
<div id="tiki-bottom">
{include file="tiki-bot_bar.tpl"}
</div>
{/if}


{if $feature_bidi eq 'y'}
</td></tr></table>
{/if}

{include file="footer.tpl"}
