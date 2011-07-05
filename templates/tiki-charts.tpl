{popup_init src="lib/overlib.js"}
{*Smarty template*}
<h1><a class="pagetitle" href="tiki-charts.php">{tr}Charts{/tr}</a></h1>
<h2>{tr}Charts{/tr}</h2>
<form action="tiki-charts.php" method="post">
<input type="hidden" name="offset" value="{$offset|escape}" />
<input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
{tr}Find{/tr}:<input size="8" type="text" name="find" value="{$find|escape}" />
</form>
<form action="tiki-charts.php" method="post">
<input type="hidden" name="offset" value="{$offset|escape}" />
<input type="hidden" name="find" value="{$find|escape}" />
<input type="hidden" name="where" value="{$where|escape}" />
<input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
<table class="normal">
<tr>
<td class="heading" ><a class="tableheading" href=tiki-charts.php?{if $sort_mode eq 'title_desc'}sort_mode=title_asc{else}sort_mode=title_desc{/if}>{tr}Title{/tr}</a></td>
</tr>
{cycle values="odd,even" print=false}
{section name=ix loop=$items}
<tr>
	<td class="{cycle advance=false}">
		<a class="link" href="tiki-view_chart.php?chartId={$items[ix].chartId}">{$items[ix].title}</a>
	</td>
</tr>
{sectionelse}
<tr>
	<td class="{cycle advance=false}" colspan="5">
	{tr}No charts defined yet{/tr}
	</td>
</tr>	
{/section}
</table>
</form>

<div class="mini">
<div align="center">
{if $prev_offset >= 0}
[<a class="prevnext" href="{sameurl offset=$prev_offset}">{tr}prev{/tr}</a>]&nbsp;
{/if}
{tr}Page{/tr}: {$actual_page}/{$cant_pages}
{if $next_offset >= 0}
&nbsp;[<a class="prevnext" href="{sameurl offset=$next_offset}">{tr}next{/tr}</a>]
{/if}
{if $direct_pagination eq 'y'}
<br />
{section loop=$cant_pages name=foo}
{assign var=selector_offset value=$smarty.section.foo.index|times:$maxRecords}
<a class="prevnext" href="{sameurl offset=$selector_offset}">
{$smarty.section.foo.index_next}</a>&nbsp;
{/section}
{/if}
</div>
</div> 
 

