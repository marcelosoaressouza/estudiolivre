{popup_init src="lib/overlib.js"}
{*Smarty template*}
<h1><a class="pagetitle" href="tiki-admin_chart_items.php?chartId={$chartId}">{tr}Admin chart items{/tr}</a>
</h1><br /><br />

{if $tiki_p_admin_charts eq 'y'}
<a class="linkbut" href="tiki-admin_charts.php">{tr}charts{/tr}</a>
<a class="linkbut" href="tiki-admin_charts.php?chartId={$chartId}">{tr}edit chart{/tr}</a>
{/if}

<a class="linkbut" href="tiki-view_chart.php?chartId={$chartId}">{tr}view{/tr}</a>
<h3>{tr}Add or edit an item{/tr} <a class="link" href="tiki-admin_chart_items.php?chartId={$chartId}">{tr}new{/tr}</a>
</h3>
<form action="tiki-admin_chart_items.php" method="post">
<input type="hidden" name="chartId" value="{$chartId|escape}" />
<input type="hidden" name="itemId" value="{$info.itemId|escape}" />
<input type="hidden" name="offset" value="{$offset|escape}" />
<input type="hidden" name="where" value="{$where|escape}" />
<input type="hidden" name="find" value="{$find|escape}" />
<input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
<table class="normal">
	<tr class="formcolor">
		<td>{tr}Title{/tr}</td>
		<td><input type="text" maxlength="250" name="title" value="{$info.title|escape}" /></td>
	</tr>
	
	<tr class="formcolor">
		<td>{tr}Description{/tr}</td>
		<td><textarea rows="4" cols="40" name="description">{$info.description|escape}</textarea></td>
	</tr>
	
	<tr class="formcolor">
		<td>{tr}URL{/tr}</td>
		<td><input type="text" maxlength="250" name="URL" value="{$info.URL|escape}" /></td>
	</tr>

	<tr class="formcolor">
		<td>&nbsp;</td>
		<td><input type="submit" name="save" value="{if $itemId > 0}{tr}update{/tr}{else}{tr}create{/tr}{/if}" /></td>
	</tr>
</table>
</form>


<h3>{tr}Chart items{/tr}</h3>
<form action="tiki-admin_chart_items.php" method="post">
<input type="hidden" name="offset" value="{$offset|escape}" />
<input type="hidden" name="chartId" value="{$chartId|escape}" />
<input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
{tr}Find{/tr}:<input size="8" type="text" name="find" value="{$find|escape}" />
</form>
<form action="tiki-admin_chart_items.php" method="post">
<input type="hidden" name="offset" value="{$offset|escape}" />
<input type="hidden" name="chartId" value="{$chartId|escape}" />
<input type="hidden" name="find" value="{$find|escape}" />
<input type="hidden" name="where" value="{$where|escape}" />
<input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
<table class="normal">
<tr>

{if $tiki_p_admin_charts eq 'y'}
<td class="heading"><input type="submit" name="delete" value="{tr}x{/tr} " /></td>
{/if}

<td class="heading"><a class="tableheading" href="{if $sort_mode eq 'title_desc'}{sameurl sort_mode="title_asc"}{else}{sameurl sort_mode="title_desc"}{/if}">{tr}Title{/tr}</a></td>
<td class="heading"><a class="tableheading" href="{if $sort_mode eq 'URL_desc'}{sameurl sort_mode="URL_asc"}{else}{sameurl sort_mode="URL_desc"}{/if}">{tr}URL{/tr}</a></td>
</tr>
{cycle values="odd,even" print=false}
{section name=ix loop=$items}
<tr class="{cycle advance=false}">

{if $tiki_p_admin_charts eq 'y'}
	<td>
		<input type="checkbox" name="item[{$items[ix].itemId}]" />
	</td>
{/if}

	<td>
{if $tiki_p_admin_charts eq 'y'}
		<a class="link" href="{sameurl itemId=$items[ix].itemId}">{$items[ix].title}</a>
{else}
		{$items[ix].title}
{/if}
	</td>
	<td>
		{$items[ix].URL}
	</td>
</tr>
{sectionelse}
<tr class="{cycle advance=false}">
	<td colspan="5">
	{tr}No items defined yet{/tr}
	</td>
</tr>	
{/section}
</table>
</form>

<div class="mini" align="center">
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
 

