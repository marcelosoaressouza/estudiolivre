{* $Header: /cvsroot/tikiwiki/tiki/templates/tiki-user_watches.tpl,v 1.9.2.16 2007/08/05 22:30:06 marclaporte Exp $ *}
<h1><a class="pagetitle" href="tiki-user_watches.php">{tr}User Watches{/tr}</a>

{if $feature_help eq 'y'}
<a href="{$helpurl}Watch" target="tikihelp" class="tikihelp" title="{tr}User Watches{/tr}">
<img src="img/icons/help.gif" border="0" height="16" width="16" alt='{tr}help{/tr}' /></a>
{/if}
{if $feature_view_tpl eq 'y'}
<a href="tiki-edit_templates.php?template=tiki-user_watches.tpl" target="tikihelp" class="tikihelp" title="{tr}View tpl{/tr}: {tr}User Watches tpl{/tr}">
<img src="img/icons/info.gif" border="0" width="16" height="16" alt='{tr}edit template{/tr}' /></a>
{/if}</h1>
{include file=tiki-mytiki_bar.tpl}


{if $feature_articles eq 'y' and $tiki_p_read_article eq 'y'}
<br />
<h2>{tr}Add Watch{/tr}</h2>
<form action="tiki-user_watches.php" method="post">
<table class="normal">
<tr>
<td class="formcolor">{tr}Event{/tr}:</td>
<td class="formcolor">
<select name="event">
<option value="article_submitted">{tr}A user submits an article{/tr}</option>
</select>
</td>
</tr>
<tr><td class="formcolor">&nbsp;</td>
<td class="formcolor"><input type="submit" name="add" value="{tr}add{/tr}" /></td>
</tr>
</table>
</form>
{/if}

<h2>{tr}Watches{/tr}</h2>
<form action="tiki-user_watches.php" method="post" id='formi'>
{tr}Event{/tr}:<select name="event" onchange="javascript:document.getElementById('formi').submit();">
<option value=""{if $smarty.request.event eq ''} selected="selected"{/if}>{tr}All{/tr}</option>
{section name=ix loop=$events}
<option value="{$events[ix]|escape}" {if $events[ix] eq $smarty.request.event}selected="selected"{/if}>
	{if $events[ix] eq 'article_submitted'}
		{tr}A user submits an article{/tr}
	{elseif $events[ix] eq 'blog_post'}
		{tr}A user submits a blog post{/tr}
	{elseif $events[ix] eq 'forum_post_thread'}
		{tr}A user posts a forum thread{/tr}
	{elseif $events[ix] eq 'forum_post_topic'}
		{tr}A user posts a forum topic{/tr}
	{elseif $events[ix] eq 'wiki_page_changed'}
		{tr}A user edited a wiki page{/tr}
	{else}{$events[ix]}{/if}
</option>
{/section}
</select>
</form>

<form action="tiki-user_watches.php" method="post">
<table class="normal">
<tr>
<td style="text-align:center;"  class="heading"><input type="submit" name="delete" value="{tr}x{/tr}"></td>
<td class="heading">{tr}event{/tr}</td>
<td class="heading">{tr}object{/tr}</td>
</tr>
{cycle values="odd,even" print=false}
{section name=ix loop=$watches}
<tr>
<td style="text-align:center;" class="{cycle advance=false}">
<input type="checkbox" name="watch[{$watches[ix].hash}]" />
</td>
<td class="{cycle advance=false}">
	{if $watches[ix].event eq 'article_submitted'}
		{tr}A user submits an article{/tr}
	{elseif $watches[ix].event eq 'blog_post'}
		{tr}A user submits a blog post{/tr}
	{elseif $watches[ix].event eq 'forum_post_thread'}
		{tr}A user posts a forum thread{/tr}
	{elseif $watches[ix].event eq 'forum_post_topic'}
		{tr}A user posts a forum topic{/tr}
	{elseif $watches[ix].event eq 'wiki_page_changed'}
		{tr}A user edited a wiki page{/tr}
	{/if}
	({$watches[ix].event})
</td>
<td class="{cycle}"><a class="link" href="{$watches[ix].url}">{tr}{$watches[ix].type}{/tr}: {$watches[ix].title}</a></td>
</tr>
{/section}
</table>
</form>
