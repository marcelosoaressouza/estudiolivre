{* $Header: /cvsroot/tikiwiki/tiki/templates/tiki-pagehistory.tpl,v 1.14.2.15 2005/03/03 13:41:54 sylvieg Exp $ *}

<h1><a class="pagetitle" href="tiki-pagehistory.php?page={$page|escape:"url"}{if $preview}&amp;preview={$preview}{elseif $source}&amp;source={$source}{elseif $diff_style}&amp;compare=1&amp;oldver={$old.version}&amp;newver={$new.version}&amp;diff_style={$diff_style}{/if}" title="{tr}history{/tr}">{tr}History{/tr}: {$page}</a></h1>

<div class="navbar"><a href="tiki-index.php?page={$page|escape:url}" class="linkbut" title="{tr}view{/tr}">{tr}View page{/tr}</a></div>

{if $preview}
<h2>{tr}Preview of version{/tr}: {$preview}
{if $info.version eq $preview}<small><small>{tr}(current){/tr}</small></small>{/if}
</h2>
{if $info.version ne $preview and  $tiki_p_rollback eq 'y'}
<div class="navbar"><a class="linkbut" href="tiki-rollback.php?page={$page|escape:"url"}&amp;version={$preview}" title="{tr}rollback{/tr}">{tr}rollback to this version{/tr}</a></div>
{/if}
<div  class="wikitext">{$previewd}</div>
{/if}

{if $source}
<h2>{tr}Source of version{/tr}: {$source}
{if $info.version eq $source}<small><small>{tr}(current){/tr}</small></small>{/if}
</h2>
{if $info.version ne $source and $tiki_p_rollback eq 'y'}
<div class="navbar"><a class="linkbut" href="tiki-rollback.php?page={$page|escape:"url"}&amp;version={$source}" title="{tr}rollback{/tr}">{tr}rollback to this version{/tr}</a></div>
{/if}
<div  class="wikitext">{$sourced}</div>
{/if}

{if $diff_style}
<h2>{tr}Comparing version {$old.version} with version {$new.version}{/tr}</h2>
<table class="normal diff">
<tr>
  <th colspan="2"><b>{tr}Version:{/tr} <a href="tiki-pagehistory.php?page={$page|escape:"url"}&amp;preview={$old.version}" title="{tr}view{/tr}">{$old.version}</a>{if $old.version == $info.version} ({tr}current{/tr})</a>{/if}</b></th>
  <th colspan="2"><b>{tr}Version:{/tr} <a href="tiki-pagehistory.php?page={$page|escape:"url"}&amp;preview={$new.version}" title="{tr}view{/tr}">{$new.version}{if $new.version == $info.version} ({tr}current{/tr})</a>{/if}</b></th>
</tr>
<tr>
  <td colspan="2">{if $tiki_p_wiki_view_author ne 'n'}{$old.user|userlink} - {/if}{$old.lastModif|tiki_short_datetime}</td>
  <td colspan="2">{if $tiki_p_wiki_view_author ne 'n'}{$new.user|userlink} - {/if}{$new.lastModif|tiki_short_datetime}</td>
</tr>
{if $old.comment || $new.comment}
<tr>
  <td colspan="2" class="editdate">{if $old.comment}{$old.comment}{else}&nbsp;{/if}</td>
  <td colspan="2" class="editdate">{if $new.comment}{$new.comment}{else}&nbsp;{/if}</td>
</tr>
{/if}
{if $old.description != $new.description}
<tr>
  <td colspan="2" class="diffdeleted">{if $old.description}{$old.description}{else}&nbsp;{/if}</td>
  <td colspan="2" class="diffadded">{if $new.description}{$new.description}{else}&nbsp;{/if}</td>
</tr>
{/if}
{/if}

{if $diff_style eq "sideview"}
<tr>
  <td colspan="2" valign="top" ><div class="wikitext">{$old.data}</div></td>
  <td colspan="2" valign="top" ><div class="wikitext">{$new.data}</div></td>
</tr>
</table>
{/if}

{if $diff_style eq 'unidiff'}
 <tr><td colspan="4">
 {if $diffdata}
   {section name=ix loop=$diffdata}
      {if $diffdata[ix].type == "diffheader"}
		{assign var="oldd" value=$diffdata[ix].old}
		{assign var="newd" value=$diffdata[ix].new}
           <br /><div class="diffheader">@@ {tr}-Lines: {$oldd} changed to +Lines: {$newd}{/tr} @@</div>
      {elseif $diffdata[ix].type == "diffdeleted"}
		<div class="diffdeleted">
			{section name=iy loop=$diffdata[ix].data}
				{if not $smarty.section.iy.first}<br />{/if}
				- {$diffdata[ix].data[iy]}
			{/section}
            </div>
      {elseif $diffdata[ix].type == "diffadded"}
            <div class="diffadded">
			{section name=iy loop=$diffdata[ix].data}
				{if not $smarty.section.iy.first}<br />{/if}
				+ {$diffdata[ix].data[iy]}
			{/section}
		</div>
      {elseif $diffdata[ix].type == "diffbody"}
            <div class="diffbody">
			{section name=iy loop=$diffdata[ix].data}
				{if not $smarty.section.iy.first}<br />{/if}
				{$diffdata[ix].data[iy]}
			{/section}
		</div>
      {/if}
   {/section}
 {else}
 <div class="diffheader">{tr}Versions are identical{/tr}</div>
 {/if}
</td></tr>
</table>
{/if}

{if $diff_style eq 'sidediff' || $diff_style eq 'minsidediff'}
  {if $diffdata}{$diffdata}{else}{tr}Versions are identical{/tr}</td></tr></table>{/if}
{/if}
<br />

{if (!isset($noHistory))}                                              
{if $preview || $source || $diff_style}<h2>{tr}History{/tr}</h2>{/if}
<form action="tiki-pagehistory.php" method="post">
<input type="hidden" name="page" value="{$page|escape}" />
<div style="text-align:center;">
<div class="simplebox"><b>{tr}Legend:{/tr}</b> {tr}v=view{/tr}, {tr}s=source{/tr}{if $default_wiki_diff_style eq "old"}, {tr}c=compare{/tr}, {tr}d=diff{/tr}{/if}{if $tiki_p_rollback eq 'y'}, {tr}b=rollback{/tr}{/if}</div>
{if $default_wiki_diff_style ne "old"}
<div style=" text-align:right;"><select name="diff_style">
	<option value="minsidediff" {if $diff_style == "minsidediff"}selected="selected"{/if}>{tr}Side-by-side diff{/tr}</option>
	<option value="sidediff" {if $diff_style == "sidediff"}selected="selected"{/if}>{tr}Full side-by-side diff{/tr}</option>
	<option value="unidiff" {if $diff_style == "unidiff"}selected="selected"{/if}>{tr}Unified diff{/tr}</option>
	<option value="sideview" {if $diff_style == "sideview"}selected="selected"{/if}>{tr}Side-by-side view{/tr}</option>
</select>
</div>
{/if}

<table border="1" cellpadding="2" cellspacing="0">
<tr>
{if $tiki_p_remove eq 'y'}<th class="heading"><input type="submit" name="delete" value="{tr}del{/tr}" /></th>{/if}
<th class="heading">{tr}Date{/tr}</th>
<th class="heading">{tr}User{/tr}</th>
{if $feature_wiki_history_ip ne 'n'}<th class="heading">{tr}Ip{/tr}</th>{/if}
<th class="heading">{tr}Comment{/tr}</th>
<th class="heading">{tr}Version{/tr}</th>
<th class="heading">{tr}Action{/tr}</th>
{if $default_wiki_diff_style != "old" and $history}
<th class="heading" colspan="2">
<input type="submit" name="compare" value="{tr}compare{/tr}" /><br />
</th>
{/if}
</tr>
<tr>
{if $tiki_p_remove eq 'y'}
<td class="odd">&nbsp;</td>
{/if}
<td class="odd">{$info.lastModif|tiki_short_datetime}</td>
{if $tiki_p_wiki_view_author ne 'n'}<td class="odd">{$info.user}</td>{/if}
{if $feature_wiki_history_ip ne 'n'}<td class="odd">{$info.ip}</td>{/if}
<td class="odd">{if $info.comment}{$info.comment}{else}&nbsp;{/if}</td>
<td class="odd button">{$info.version}<br />{tr}current{/tr}</td>
<td class="odd button">&nbsp;<a class="link" href="tiki-pagehistory.php?page={$page|escape:"url"}&amp;preview={$info.version}" title="{tr}view{/tr}">v</a>
&nbsp;<a class="link" href="tiki-pagehistory.php?page={$page|escape:"url"}&amp;source={$info.version}" title="{tr}source{/tr}">s</a>
</td>
{if $default_wiki_diff_style ne "old" and $history}
<td class="odd button"><input type="radio" name="oldver" value="0" title="{tr}compare{/tr}" {if $old.version == $info.version}checked="checked"{/if} /></td>
<td class="odd button"><input type="radio" name="newver" value="0" title="{tr}compare{/tr}" {if $new.version == $info.version or !$diff_style}checked="checked"{/if}  /></td>
{/if}
</tr>
{cycle values="odd,even" print=false}
{section name=hist loop=$history}
<tr>
{if $tiki_p_remove eq 'y'}
<td class="{cycle advance=false} button"><input type="checkbox" name="hist[{$history[hist].version}]" /></td>
{/if}
<td class="{cycle advance=false}">{$history[hist].lastModif|tiki_short_datetime}</td>
{if $tiki_p_wiki_view_author ne 'n'}<td class="{cycle advance=false}">{$history[hist].user}</td>{/if}
{if $feature_wiki_history_ip ne 'n'}<td class="{cycle advance=false}">{$history[hist].ip}</td>{/if}
<td class="{cycle advance=false}">{if $history[hist].comment}{$history[hist].comment}{else}&nbsp;{/if}</td>
<td class="{cycle advance=false} button">{$history[hist].version}</td>
<td class="{cycle advance=false} button">
&nbsp;<a class="link" href="tiki-pagehistory.php?page={$page|escape:"url"}&amp;preview={$history[hist].version}" title="{tr}view{/tr}">v</a>
&nbsp;<a class="link" href="tiki-pagehistory.php?page={$page|escape:"url"}&amp;source={$history[hist].version}" title="{tr}source{/tr}">s</a>
{if $default_wiki_diff_style eq "old"}
&nbsp;<a class="link" href="tiki-pagehistory.php?page={$page|escape:"url"}&amp;diff2={$history[hist].version}&amp;diff_style=sideview" title="{tr}compare{/tr}">c</a>
&nbsp;<a class="link" href="tiki-pagehistory.php?page={$page|escape:"url"}&amp;diff2={$history[hist].version}&amp;diff_style=unidiff" title="{tr}diff{/tr}">d</a>
{/if}
{if $tiki_p_rollback eq 'y'}
&nbsp;<a class="link" href="tiki-rollback.php?page={$page|escape:"url"}&amp;version={$history[hist].version}" title="{tr}rollback{/tr}">b</a>
{/if}
&nbsp;
</td>
{if $default_wiki_diff_style ne "old"}
<td class="{cycle advance=false} button">
<input type="radio" name="oldver" value="{$history[hist].version}" title="{tr}older version{/tr}" {if $old.version == $history[hist].version or (!$diff_style and $smarty.section.hist.first)}checked="checked"{/if} />
</td>
<td class="{cycle} button">
{* if $smarty.section.hist.last &nbsp; *}
<input type="radio" name="newver" value="{$history[hist].version}" title="Select a newer version for comparison" {if $new.version == $history[hist].version}checked="checked"{/if} />
</td>
{/if}
</tr>
{/section}
</table>
</div>
</form>
{/if}
