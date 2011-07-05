{* $Id: tiki-syslog.tpl,v 1.4.4.12 2007/09/02 13:36:32 sylvieg Exp $ *}
<h1><a class="pagetitle" href="tiki-syslog.php">{tr}SysLog{/tr}</a>

{if $feature_help eq 'y'}
<a href="{$helpurl}System+log" target="tikihelp" class="tikihelp" title="{tr}Tikiwiki.org help{/tr}: {tr}system logs{/tr}">
<img border='0' src='img/icons/help.gif' alt="{tr}help{/tr}" /></a>{/if}

{if $feature_view_tpl eq 'y'}
<a href="tiki-edit_templates.php?template=tiki-syslog.tpl" target="tikihelp" class="tikihelp" title="{tr}View tpl{/tr}: {tr}system logs tpl{/tr}">
<img src="img/icons/info.gif" border="0" height="16" width="16" alt='{tr}edit tpl{/tr}' /></a>{/if}
</h1>

{if $tikifeedback}
<br />{section name=n loop=$tikifeedback}<div class="simplebox {if $tikifeedback[n].num > 0} highlight{/if}">{$tikifeedback[n].mes}</div>{/section}
{/if}

<br /><br />

<form method="get" action="tiki-syslog.php">
{tr}Clean logs older than{/tr}&nbsp;
<input type="text" name="months" size="4" /> {tr}months{/tr}
<input type="submit" value="{tr}clean{/tr}" name="clean" />
</form>

<div align="center">
<table class="findtable">
<tr><td class="findtable">{tr}Find{/tr}</td>
<td class="findtable">
<form method="get" action="tiki-syslog.php">
<input type="text" name="find" value="{$find|escape}" />
<input type="submit" value="{tr}find{/tr}" name="search" />
<input type="text" name="max" value="{$maxRecords|escape}" size="4" /> {tr}rows{/tr}
<input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
</form>
</td></tr></table>
</div>

<div class="simplebox">
<table class="normal">
<tr>
<td class="heading"><a href="tiki-syslog.php?find={$find|escape}&amp;max={$maxRecords}&amp;offset={$offset}&amp;sort_mode=logid_{if $sort_mode eq 'logid_desc'}asc{else}desc{/if}" class="tableheading">{tr}Id{/tr}</a></td>
<td class="heading"><a href="tiki-syslog.php?find={$find|escape}&amp;max={$maxRecords}&amp;offset={$offset}&amp;sort_mode=logtype_{if $sort_mode eq 'logtype_desc'}asc{else}desc{/if}" class="tableheading">{tr}Type{/tr}</a></td>
<td class="heading"><a href="tiki-syslog.php?find={$find|escape}&amp;max={$maxRecords}&amp;offset={$offset}&amp;sort_mode=logtime_{if $sort_mode eq 'logtime_desc'}asc{else}desc{/if}" class="tableheading">{tr}Time{/tr}</a></td>
<td class="heading"><a href="tiki-syslog.php?find={$find|escape}&amp;max={$maxRecords}&amp;offset={$offset}&amp;sort_mode=loguser_{if $sort_mode eq 'loguser_desc'}asc{else}desc{/if}" class="tableheading">{tr}User{/tr}</a></td>
<td class="heading"><a href="tiki-syslog.php?find={$find|escape}&amp;max={$maxRecords}&amp;offset={$offset}&amp;sort_mode=logmessage_{if $sort_mode eq 'logmessage_desc'}asc{else}desc{/if}" class="tableheading">{tr}Message{/tr}</a></td>
<td class="heading"><a href="tiki-syslog.php?find={$find|escape}&amp;max={$maxRecords}&amp;offset={$offset}&amp;sort_mode=logip_{if $sort_mode eq 'logip_desc'}asc{else}desc{/if}" class="tableheading">{tr}IP{/tr}</a></td>
<td class="heading"><a href="tiki-syslog.php?find={$find|escape}&amp;max={$maxRecords}&amp;offset={$offset}&amp;sort_mode=logclient_{if $sort_mode eq 'logclient_desc'}asc{else}desc{/if}" class="tableheading">{tr}Client{/tr}</a></td>
</tr>
{cycle values="odd,even" print=false}
{section name=ix loop=$list}
<tr class="{cycle}">
<td>{$list[ix].logId}</td>
<td>{$list[ix].logtype}</td>
<td><span title="{$list[ix].logtime|tiki_long_datetime}">{$list[ix].logtime|tiki_short_time}</span></td>
<td>{$list[ix].loguser}</td>
<td title="{$list[ix].logmessage|escape:'html'}">{$list[ix].logmessage|truncate:60|escape:'html'}</td>
<td>{$list[ix].logip|escape:"html"}</td>
<td><span title="{$list[ix].logclient|escape:'html'}">{$list[ix].logclient|truncate:24:"..."|escape:'html'}</span></td>
</tr>
{/section}
</table>

{include file="tiki-pagination.tpl"}
</div>
