<h1><a class="pagetitle" href="tiki-admin_polls.php">{tr}Admin Polls{/tr}</a>

      {if $feature_help eq 'y'}
<a href="{$helpurl}Polls" target="tikihelp" class="tikihelp" title="{tr}admin polls{/tr}">
<img src="img/icons/help.gif" border="0" height="16" width="16" alt='{tr}help{/tr}' /></a>{/if}

      {if $feature_view_tpl eq 'y'}
<a href="tiki-edit_templates.php?template=tiki-admin_polls.tpl" target="tikihelp" class="tikihelp" title="{tr}View template{/tr}: {tr}admin polls template{/tr}">
<img src="img/icons/info.gif" border="0" width="16" height="16" alt='{tr}edit{/tr}' /></a>{/if}</h1>

{if $tiki_p_admin eq 'y'}
<a href="tiki-admin.php?page=polls"><img src='img/icons/config.gif' border='0'  alt="{tr}configure polls{/tr}" title="{tr}configure polls{/tr}" /></a>
{/if}


<br /><br />
<a href="tiki-admin_polls.php?setlast=1" class="linkbut">{tr}Set last poll as current{/tr}</a>
<a href="tiki-admin_polls.php?closeall=1" class="linkbut">{tr}Close all polls but last{/tr}</a>
<a href="tiki-admin_polls.php?activeall=1" class="linkbut">{tr}Activate all polls{/tr}</a>
<h2>{tr}Create/edit Polls{/tr}</h2>
<form action="tiki-admin_polls.php" method="post">
<input type="hidden" name="pollId" value="{$pollId|escape}" />
<table class="normal">
<tr><td class="formcolor">{tr}Title{/tr}:</td><td class="formcolor"><input type="text" name="title" value="{$title|escape}" /></td></tr>
<tr><td class="formcolor">{tr}Active{/tr}:</td><td class="formcolor">
<select name="active">
<option value='a' {if $active eq 'a'}selected="selected"{/if}>{tr}active{/tr}</option>
<option value='c' {if $active eq 'c'}selected="selected"{/if}>{tr}current{/tr}</option>
<option value='x' {if $active eq 'x'}selected="selected"{/if}>{tr}closed{/tr}</option>
<option value='t' {if $active eq 't'}selected="selected"{/if} style="border-top:1px solid black;">{tr}template{/tr}</option>
<option value='o' {if $active eq 'o'}selected="selected"{/if}>{tr}object{/tr}</option>
</select>
</td></tr>
{include file=categorize.tpl}
<tr><td class="formcolor">{tr}PublishDate{/tr}:</td><td class="formcolor">
{html_select_date time=$publishDate end_year="+1"} {tr}at{/tr} {html_select_time time=$publishDate display_seconds=false}
</td></tr>
<tr><td  class="formcolor">&nbsp;</td><td class="formcolor"><input type="submit" name="save" value="{tr}Save{/tr}" /></td></tr>
</table>
</form>
<h2>{tr}Polls{/tr}</h2>
<div align="center">
<table class="findtable">
<tr><td class="findtable">{tr}Find{/tr}</td>
   <td class="findtable">
   <form method="get" action="tiki-admin_polls.php">
     <input type="text" name="find" value="{$find|escape}" />
     <input type="submit" value="{tr}find{/tr}" name="search" />
     <input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
   </form>
   </td>
</tr>
</table>
<table class="normal">
<tr>
<td class="heading"><a class="tableheading" href="tiki-admin_polls.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'pollId_desc'}pollId_asc{else}pollId_desc{/if}">{tr}ID{/tr}</a></td>
<td class="heading"><a class="tableheading" href="tiki-admin_polls.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'title_desc'}title_asc{else}title_desc{/if}">{tr}title{/tr}</a></td>
<td class="heading"><a class="tableheading" href="tiki-admin_polls.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'active_desc'}active_asc{else}active_desc{/if}">{tr}active{/tr}</a></td>
<td class="heading"><a class="tableheading" href="tiki-admin_polls.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'votes_desc'}votes_asc{else}votes_desc{/if}">{tr}votes{/tr}</a></td>
<td class="heading"><a class="tableheading" href="tiki-admin_polls.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'publishDate_desc'}publishDate_asc{else}publishDate_desc{/if}">{tr}Publish{/tr}</a></td>
<td class="heading">{tr}options{/tr}</td>
<td class="heading">{tr}action{/tr}</td>
</tr>
{section name=user loop=$channels}
{if $smarty.section.user.index % 2}
<tr>
<td class="odd">{$channels[user].pollId}</td>
<td class="odd"><a class="tablename" href="tiki-poll_results.php?pollId={$channels[user].pollId}">{$channels[user].title}</a></td>
<td class="odd">{$channels[user].active}</td>
<td class="odd">{$channels[user].votes}</td>
<td class="odd">{$channels[user].publishDate|tiki_short_datetime}</td>
<td class="odd">{$channels[user].options}</td>
<td class="odd">
   <a class="link" href="tiki-admin_polls.php?offset={$offset}&amp;sort_mode={$sort_mode}&amp;remove={$channels[user].pollId}">{tr}delete{/tr}</a>
   <a class="link" href="tiki-admin_polls.php?offset={$offset}&amp;sort_mode={$sort_mode}&amp;pollId={$channels[user].pollId}">{tr}edit{/tr}</a>
   <a class="link" href="tiki-admin_poll_options.php?pollId={$channels[user].pollId}">{tr}options{/tr}</a>
</td>
</tr>
{else}
<tr>
<td class="even">{$channels[user].pollId}</td>
<td class="even"><a class="tablename" href="tiki-poll_results.php?pollId={$channels[user].pollId}">{$channels[user].title}</a></td>
<td class="even">{$channels[user].active}</td>
<td class="even">{$channels[user].votes}</td>
<td class="even">{$channels[user].publishDate|tiki_short_datetime}</td>
<td class="even">{$channels[user].options}</td>
<td class="even">
   <a class="link" href="tiki-admin_polls.php?offset={$offset}&amp;sort_mode={$sort_mode}&amp;remove={$channels[user].pollId}">{tr}delete{/tr}</a>
   <a class="link" href="tiki-admin_polls.php?offset={$offset}&amp;sort_mode={$sort_mode}&amp;pollId={$channels[user].pollId}">{tr}edit{/tr}</a>
   <a class="link" href="tiki-admin_poll_options.php?pollId={$channels[user].pollId}">{tr}options{/tr}</a>
</td>
</tr>
{/if}
{sectionelse}
<tr><td colspan="7" class="odd">{tr}No records found{/tr}</td></tr>
{/section}
</table>
<br />
<div class="mini">
{if $prev_offset >= 0}
[<a class="prevnext" href="tiki-admin_polls.php?find={$find}&amp;offset={$prev_offset}&amp;sort_mode={$sort_mode}">{tr}prev{/tr}</a>]&nbsp;
{/if}
{tr}Page{/tr}: {$actual_page}/{$cant_pages}
{if $next_offset >= 0}
&nbsp;[<a class="prevnext" href="tiki-admin_polls.php?find={$find}&amp;offset={$next_offset}&amp;sort_mode={$sort_mode}">{tr}next{/tr}</a>]
{/if}
{if $direct_pagination eq 'y'}
<br />
{section loop=$cant_pages name=foo}
{assign var=selector_offset value=$smarty.section.foo.index|times:$maxRecords}
<a class="prevnext" href="tiki-admin_polls.php?find={$find}&amp;offset={$selector_offset}&amp;sort_mode={$sort_mode}">
{$smarty.section.foo.index_next}</a>&nbsp;
{/section}
{/if}
</div>
</div>

