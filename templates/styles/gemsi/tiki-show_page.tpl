{* $Header: /cvsroot/tikiwiki/tiki/templates/styles/gemsi/tiki-show_page.tpl,v 1.5.2.6 2005/04/23 16:48:40 michael_davey Exp $ *}

{if $feature_page_title eq 'y'}
<h1><a  href="tiki-index.php?page={$page|escape:"url"}" class="pagetitle">
{if $structure eq 'y' and $page_info.page_alias ne ''}{$page_info.page_alias}{else}{$page}{/if}</a>  
{if $lock}<img src="img/icons/lock_topic.gif" height="19" width="19" alt="{tr}locked{/tr}" title="{tr}locked by{/tr} {$page_user}" />{/if}
</h1>
{/if}
{if $feature_wiki_pageid eq 'y'}
	<small><a class="link" href="tiki-index.php?page_id={$page_id}">{tr}page id{/tr}: {$page_id}</a></small>
{/if}

<div class="wikitext">
{if $structure eq 'y'}
<div class="tocnav">
<table>
<tr>
{if $prev_info and $prev_info.page_ref_id}
<td align="left" width="33%"><a href="tiki-index.php?page_ref_id={$prev_info.page_ref_id}"><img src='img/icons2/nav_prev.gif' border='0' width="72" height="11" alt='{tr}Previous page{/tr}' 
{if $prev_info.page_alias}title='{$prev_info.page_alias}'{else}title='{$prev_info.pageName}'{/if} /></a>{else}<img src='img/icons2/8.gif' border='0'/></td>
{/if}
{if $parent_info}
<td style="text-align:center;" width="34%"><a href="tiki-index.php?page_ref_id={$parent_info.page_ref_id}"><img src='img/icons2/nav_home.gif' border='0' align="center" alt='{tr}Parent page{/tr}' 
{if $parent_info.page_alias}title='{$parent_info.page_alias}'{else}title='{$parent_info.pageName}'{/if}/></a>{else}<img src='img/icons2/8.gif' border='0'/></td>
{/if}
{if $next_info and $next_info.page_ref_id}
<td align="right" width="33%"><a href="tiki-index.php?page_ref_id={$next_info.page_ref_id}"><img src='img/icons2/nav_next.gif' border='0' width="72" height="11" align="right" alt='{tr}Next page{/tr}' 
{if $next_info.page_alias}title='{$next_info.page_alias}'{else}title='{$next_info.pageName}'{/if}/></a>{else}<img src='img/icons2/8.gif' border='0'/></td>
{/if}
</tr></table>
<div>
{section loop=$structure_path name=ix}
      {if $structure_path[ix].parent_id}&nbsp;{$site_crumb_seper}&nbsp;{/if}
	  <a href="tiki-index.php?page_ref_id={$structure_path[ix].page_ref_id}">
      {if $structure_path[ix].page_alias}
        {$structure_path[ix].page_alias}
	  {else}
        {$structure_path[ix].pageName}
	  {/if}
</a>
{/section}
</div>
</div>
{/if}
{if $feature_wiki_ratings eq 'y'}{include file="poll.tpl"}{/if}
{$parsed}
{if $pages > 1}
	<br />
	<div align="center">
		<a href="tiki-index.php?{if $page_info}page_ref_id={$page_info.page_ref_id}{else}page={$page|escape:"url"}{/if}&amp;pagenum={$first_page}"><img src='img/icons2/nav_first.gif' border='0' alt='{tr}First page{/tr}' title='{tr}First page{/tr}' /></a>
		<a href="tiki-index.php?{if $page_info}page_ref_id={$page_info.page_ref_id}{else}page={$page|escape:"url"}{/if}&amp;pagenum={$prev_page}"><img src='img/icons2/nav_dot_right.gif' border='0' alt='{tr}Previous page{/tr}' title='{tr}Previous page{/tr}' /></a>
		<small>{tr}page{/tr}:{$pagenum}/{$pages}</small>
		<a href="tiki-index.php?{if $page_info}page_ref_id={$page_info.page_ref_id}{else}page={$page|escape:"url"}{/if}&amp;pagenum={$next_page}"><img src='img/icons2/nav_dot_left.gif' border='0' alt='{tr}Next page{/tr}' title='{tr}Next page{/tr}' /></a>
		<a href="tiki-index.php?{if $page_info}page_ref_id={$page_info.page_ref_id}{else}page={$page|escape:"url"}{/if}&amp;pagenum={$last_page}">{html_image file='img/icons2/nav_last.gif' border='0' alt='{tr}Last page{/tr}' title='{tr}Last page{/tr}'}</a>
	</div>
{/if}
</div> {* End of main wiki page *}

{if $has_footnote eq 'y'}
<div class="wikitext">
{$footnote}
</div>
{/if}

{if isset($wiki_authors_style) && $wiki_authors_style eq 'business'}
<p class="editdate">
  {tr}Last edited by{/tr} {$lastUser|userlink}
  {section name=author loop=$contributors}
   {if $smarty.section.author.first}, {tr}based on work by{/tr}
   {else}
    {if !$smarty.section.author.last},
    {else} {tr}and{/tr}
    {/if}
   {/if}
   {$contributors[author]|userlink}
  {/section}.<br />                                         
  {tr}Page last modified on{/tr} {$lastModif|tiki_long_datetime}.
</p>
{elseif isset($wiki_authors_style) &&  $wiki_authors_style eq 'collaborative'}
<p class="editdate">
  {tr}Contributors to this page{/tr}: {$lastUser|userlink}
  {section name=author loop=$contributors}
   {if !$smarty.section.author.last},
   {else} {tr}and{/tr}
   {/if}
   {$contributors[author]|userlink}
  {/section}.<br />
  {tr}Page last modified on{/tr} {$lastModif|tiki_long_datetime}.
</p>
{elseif isset($wiki_authors_style) &&  $wiki_authors_style eq 'none'}
{else}
<p class="editdate">
  {tr}Created by{/tr}: {$creator|userlink}
  {tr}last modification{/tr}: {$lastModif|tiki_long_datetime} {tr}by{/tr} {$lastUser|userlink}
</p>
{/if}

{if $wiki_feature_copyrights  eq 'y' and $wikiLicensePage}
  {if $wikiLicensePage == $page}
    {if $tiki_p_edit_copyrights eq 'y'}
      <p class="editdate">{tr}To edit the copyright notices{/tr} <a href="copyrights.php?page={$copyrightpage}">{tr}click here{/tr}</a>.</p>
    {/if}
  {else}
    <p class="editdate">{tr}The content on this page is licensed under the terms of the{/tr} <a href="tiki-index.php?page={$wikiLicensePage}&amp;copyrightpage={$page|escape:"url"}">{$wikiLicensePage}</a>.</p>
  {/if}
{/if}

{if $print_page eq 'y'}
<br />
<div class="mini">
{tr}The original document is available at{/tr} <a href="{$urlprefix}tiki-index.php?page{$page|escape:"url"}" class="linkmenu">{$urlprefix}tiki-index.php?page={$page|escape:"url"}</a>
</div>
{/if}


<table><tr>
{if $is_categorized eq 'y' and $feature_categories eq 'y' and $feature_categorypath eq 'y'}
<td align="right">{$display_catpath}</td>
{/if}

{if $print_page !== 'y'}
<td style="text-align:right;">

{if $user and $feature_notepad eq 'y' and $tiki_p_notepad eq 'y'}
<a title="{tr}Save to notepad{/tr}" href="tiki-index.php?page={$page|escape:"url"}&amp;savenotepad=1"><img src="img/icons/ico_save.gif" border="0"  width="16" height="16" alt='{tr}save{/tr}' /></a>
{/if}

{if $user and $feature_user_watches eq 'y'}
{if $user_watching_page eq 'n'}
<a href="tiki-index.php?page={$page|escape:"url"}&amp;watch_event=wiki_page_changed&amp;watch_object={$page|escape:"url"}&amp;watch_action=add"><img border='0' alt='{tr}monitor this page{/tr}' title='{tr}monitor this page{/tr}' src='img/icons/icon_watch.png' /></a>
{else}
<a href="tiki-index.php?page={$page|escape:"url"}&amp;watch_event=wiki_page_changed&amp;watch_object={$page|escape:"url"}&amp;watch_action=remove"><img border='0' alt='{tr}stop monitoring this page{/tr}' title='{tr}stop monitoring this page{/tr}' src='img/icons/icon_unwatch.png' /></a>
{/if}
{/if}
	
{if $wiki_feature_3d eq 'y'}
<a title="{tr}3d browser{/tr}" href="javascript:wiki3d_open('{$page|escape}',{$wiki_3d_width}, {$wiki_3d_height})"><img src="img/icons/ico_wiki3d.gif" border="0" width="13" height="16" alt='{tr}3d browser{/tr}' /></a>
{/if}

{if $feature_backlinks eq 'y' and $backlinks}
<select name=page onchange="go(this)">
<option value="tiki-index.php?page={$page|escape:"url"}">{tr}backlinks{/tr}...</option>
{section name=back loop=$backlinks}
<option value="tiki-index.php?page={$backlinks[back].fromPage|escape:"url"}">{$backlinks[back].fromPage}</option>
{/section}
</select>
{/if}
{if count($showstructs) ne 0}
<select name=page onchange="go(this)">
<option value="tiki-index.php?page={$page|escape:"url"}">{tr}Structures{/tr}...</option>
{section name=struct loop=$showstructs}
<option value="tiki-index.php?page_ref_id={$showstructs[struct].req_page_ref_id}">
{if $showstructs[struct].page_alias} 
{$showstructs[struct].page_alias}
{else}
{$showstructs[struct].pageName}
{/if}</option>
{/section}
</select>
{/if}
</td>
{/if}
{if $feature_multilingual == 'y'}{include file="translated-lang.tpl" td='y'}{/if}
</tr></table>

{if $is_categorized eq 'y' and $feature_categories eq 'y' and $feature_categoryobjects eq 'y'}
<div class="catblock">{$display_catobjects}</div>
{/if}
