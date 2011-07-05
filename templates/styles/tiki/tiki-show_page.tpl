{if $print_page ne 'y'}
<div class="tabt1">

{if $cached_page eq 'y'}
<span class="tabbut"><a title="{tr}refresh{/tr}" href="tiki-index.php?page={$page|escape:"url"}&amp;refresh=1" class="tablink">{tr}refresh{/tr}</a></span>
{/if}

{if $feature_wiki_print eq 'y'}
<span class="tabbut"><a title="{tr}print{/tr}" href="tiki-print.php?page={$page|escape:"url"}" class="tablink">{tr}print{/tr}</a></span>
{/if}

{if $feature_wiki_pdf eq 'y'}
<span class="tabbut"><a title="{tr}create pdf{/tr}" href="tiki-config_pdf.php?page={$page|escape:"url"}" class="tablink">{tr}pdf{/tr}</a></span>
{/if}

{if $user and $feature_notepad eq 'y' and $tiki_p_notepad eq 'y'}
<span class="tabbut"><a title="{tr}Save to notepad{/tr}" href="tiki-index.php?page={$page|escape:"url"}&amp;savenotepad=1" class="tablink">{tr}save{/tr}</a></span>
{/if}

{if $wiki_feature_3d eq 'y'}
<span class="tabbut"><a title="{tr}3d browser{/tr}" href="javascript:wiki3d_open('{$page|escape}',{$wiki_3d_width}, {$wiki_3d_height})" class="tablink">{tr}3d browser{/tr}</a></span>
{/if}

{if $user and $feature_user_watches eq 'y'}
{if $user_watching_page eq 'n'}
<span class="tabbut"><a href="tiki-index.php?page={$page|escape:"url"}&amp;watch_event=wiki_page_changed&amp;watch_object={$page|escape:"url"}&amp;watch_action=add" class="tablink">{tr}monitor this page{/tr}</a></span>
{else}
<span class="tabbut"><a href="tiki-index.php?page={$page|escape:"url"}&amp;watch_event=wiki_page_changed&amp;watch_object={$page|escape:"url"}&amp;watch_action=remove" class="tablink">{tr}stop monitoring this page{/tr}</a></span>
{/if}
{/if}

{if $feature_backlinks eq 'y' and $backlinks}
<form action="tiki-index.php" method="get">
<select name="page" onchange="page.form.submit()">
<option>{tr}backlinks{/tr}...</option>
{section name=back loop=$backlinks}
<option value="{$backlinks[back].fromPage}">{$backlinks[back].fromPage}</option>
{/section}
</select>
</form>
{/if}

{if $feature_multilingual == 'y'}{include file="translated-lang.tpl"}{/if}
</div>
{/if}

{if $feature_page_title eq 'y'}<h1><a  href="tiki-index.php?page={$page|escape:"url"}" class="pagetitle">{$page}</a>
{if $lock and $print_page ne 'y'}
<img src="img/icons/lock_topic.gif" height="19" width="19" alt="{tr}locked{/tr}" title="{tr}locked by{/tr} {$page_user}" />
{/if}
</h1>{/if}
{if $feature_wiki_pageid eq 'y'}
	<small><a class="link" href="tiki-index.php?page_id={$page_id}">{tr}page id{/tr}: {$page_id}</a></small>
{/if}

{if $is_categorized eq 'y' and $feature_categories eq 'y' and $feature_categorypath eq 'y'}
<div style="float:right;">
{$display_catpath}
</div>
{/if}

<div>
{if $feature_wiki_description eq 'y'}
<small>{$description}</small>
{/if}
{if $cached_page eq 'y'}
<small>({tr}cached{/tr})</small>
{/if}
</div>

{if $show_page_bar !== 'n'}
<div class="tabt2">
{if $print_page ne 'y'}
{if !$lock}
	{if $tiki_p_edit eq 'y' or $page|lower eq 'sandbox'}
		{if $beingEdited eq 'y'}
			<span class="tabbut"><a title="{$semUser}" class="highlight" href="tiki-editpage.php?page={$page|escape:"url"}" class="tablink">{tr}edit{/tr}</a></span>
		{else}
			<span class="tabbut"><a href="tiki-editpage.php?page={$page|escape:"url"}" class="tablink">{tr}edit{/tr}</a></span>
		{/if}
	{/if}
{/if}
{/if}
{if $print_page ne 'y'}
{if $page|lower ne 'sandbox'}
	{if $tiki_p_remove eq 'y'}
		<span class="tabbut"><a href="tiki-removepage.php?page={$page|escape:"url"}&amp;version=last" class="tablink">{tr}remove{/tr}</a></span>
	{/if}
	{if $tiki_p_rename eq 'y'}
		<span class="tabbut"><a href="tiki-rename_page.php?page={$page|escape:"url"}" class="tablink">{tr}rename{/tr}</a></span>
	{/if}
{/if}
{/if}

{if $print_page ne 'y'}
{if $page|lower ne 'sandbox'}

	{if $lock and ($tiki_p_admin_wiki eq 'y' or ($user and ($user eq $page_user or $user eq "admin") and ($tiki_p_lock eq 'y') and ($feature_wiki_usrlock eq 'y')))}
			<span class="tabbut"><a href="tiki-index.php?page={$page|escape:"url"}&amp;action=unlock" class="tablink">{tr}unlock{/tr}</a></span>
	{/if}
	{if !$lock and ($tiki_p_admin_wiki eq 'y' or (($tiki_p_lock eq 'y') and ($feature_wiki_usrlock eq 'y')))}
		<span class="tabbut"><a href="tiki-index.php?page={$page|escape:"url"}&amp;action=lock" class="tablink">{tr}lock{/tr}</a></span>
	{/if}

	{if $tiki_p_admin_wiki eq 'y'}
		<span class="tabbut"><a href="tiki-pagepermissions.php?page={$page|escape:"url"}" class="tablink">{tr}perms{/tr}</a></span>
	{/if}
{/if}
{/if}

{if $print_page ne 'y'}
{if $page|lower ne 'sandbox'}
	{if $feature_history eq 'y' and $tiki_p_wiki_view_history eq 'y'}
		<span class="tabbut"><a href="tiki-pagehistory.php?page={$page|escape:"url"}" class="tablink">{tr}history{/tr}</a></span>
	{/if}
{/if}
{/if}

{if $print_page ne 'y'}
{if $feature_likePages eq 'y'}
	<span class="tabbut"><a href="tiki-likepages.php?page={$page|escape:"url"}" class="tablink">{tr}similar{/tr}</a></span>
{/if}
{/if}

{if $print_page ne 'y'}
{if $feature_wiki_undo eq 'y' and $canundo eq 'y'}
	<span class="tabbut"><a href="tiki-index.php?page={$page|escape:"url"}&amp;undo=1" class="tablink">{tr}undo{/tr}</a></span>
{/if}
{/if}

{if $print_page ne 'y'}
{if $wiki_uses_slides eq 'y'}
{if $show_slideshow eq 'y'}
	<span class="tabbut"><a href="tiki-slideshow.php?page={$page|escape:"url"}" class="tablink">{tr}slides{/tr}</a></span>
{elseif $structure eq 'y'}
	<span class="tabbut"><a href="tiki-slideshow2.php?page_ref_id={$page_info.page_ref_id}}" class="tablink">{tr}slides{/tr}</a></span>
{/if}
{/if}
{/if}

{if $print_page ne 'y'}
{if $feature_wiki_export eq 'y' and $tiki_p_admin_wiki eq 'y'}
        <span class="tabbut"><a href="tiki-export_wiki_pages.php?page={$page|escape:"url"}" class="tablink">{tr}export{/tr}</a></span>
{/if}
{/if}

{if $print_page ne 'y'}
{if $feature_wiki_discuss eq 'y'}
	<span class="tabbut"><a href="tiki-view_forum.php?forumId={$wiki_forum_id}&amp;comments_postComment=post&amp;comments_title={$page|escape:"url"}&amp;comments_data={"Use this thread to discuss the [tiki-index.php?page="}{$page}{"|"}{$page}{"] page."|escape:"url"}&amp;comment_topictype=n" class="tablink">{tr}discuss{/tr}</a></span>
{/if}
{/if}

{if $print_page ne 'y'}
{if $show_page eq 'y' && $feature_wiki_comments == 'y' && $tiki_p_wiki_view_comments == 'y'}
<span class="tabbut">
{if $comments_cant > 0}
	<a href="#comments" onclick="javascript:flip('comzone{if $comments_show eq 'y'}open{/if}');" class="tablink" style="background: #FFAAAA">{if $comments_cant eq 1}1 {tr}comment{/tr}{else}{$comments_cant} {tr}comments{/tr}{/if}</a></span>
{else}
	<a href="#comments" onclick="javascript:flip('comzone{if $comments_show eq 'y'}open{/if}');" class="tablink">{tr}comment{/tr}</a></span>
{/if}
{/if}
{/if}

{if $print_page ne 'y'}
{if $feature_wiki_attachments eq 'y' and $tiki_p_wiki_view_attachments eq 'y' and $show_page eq 'y'}
<span class="tabbut"><a href="#attachments" onclick="javascript:flip('attzone{if $atts_show eq 'y'}open{/if}');" class="tablink">{if $atts_count eq 0}{tr}attach file{/tr}{elseif $atts_count eq 1}1 {tr}attachment{/tr}{else}{$atts_count} {tr}attachments{/tr}{/if}</a></span>
{/if}
{/if}

{if $print_page ne 'y' &&  $feature_multilingual == 'y' && $tiki_p_edit eq 'y'  and !$lock}
<span class="tabbut"><a href="tiki-edit_translation.php?page={$page|escape:'url'}" class="tablink">{tr}translation{/tr}</a></span>
{/if}

</div>
{/if}

<div class="wikitext">{if $structure eq 'y'}
<div class="tocnav">
<table width='100%'>
{foreach from=$struct_prev_next item=struct name=str key=key}
	<tr>
		<td width='33%'>
			{if $struct.prev_page}
				<a class="tocnavlink" href="tiki-index.php?page={$struct.prev_page}&amp;structID={$key}">&lt;&lt;
					{if $struct.prev_page_alias}
						{$struct.prev_page_alias}
					{else}
						{$struct.prev_page}
					{/if}
				</a>

			{else}
				&nbsp;
			{/if}
		</td>
		<td align='center' width='33%'>
{*			<a class="tocnavlink" href="tiki-index.php?page=">{$key}</a> *}
			{$key}
		</td>
		<td align='right' width='33%'>
			{if $struct.next_page}
				<a class="tocnavlink" href="tiki-index.php?page={$struct.next_page}&amp;structID={$key}">
					{if $struct.next_page_alias}
						{$struct.next_page_alias}
					{else}
						{$struct.next_page}
					{/if}
					&gt;&gt;
				</a>
			{else}
				&nbsp;
			{/if}</td>
	</tr>
{/foreach}
</table>
</div>
{/if}
{if $feature_wiki_ratings eq 'y'}{include file="poll.tpl"}{/if}
{$parsed}
{if $pages > 1}
	<br />
	<div align="center">
		<a href="tiki-index.php?page={$page|escape:"url"}&amp;pagenum={$first_page}"><img src='img/icons2/nav_first.gif' border='0' alt='{tr}First page{/tr}' title='{tr}First page{/tr}' /></a>

		<a href="tiki-index.php?page={$page|escape:"url"}&amp;pagenum={$prev_page}"><img src='img/icons2/nav_dot_right.gif' border='0' alt='{tr}Previous page{/tr}' title='{tr}Previous page{/tr}' /></a>

		<small>{tr}page{/tr}:{$pagenum}/{$pages}</small>

		<a href="tiki-index.php?page={$page|escape:"url"}&amp;pagenum={$next_page}"><img src='img/icons2/nav_dot_left.gif' border='0' alt='{tr}Next page{/tr}' title='{tr}Next page{/tr}' /></a>


		<a href="tiki-index.php?page={$page|escape:"url"}&amp;pagenum={$last_page}">{html_image file='img/icons2/nav_last.gif' border='0' alt='{tr}Last page{/tr}' title='{tr}Last page{/tr}'}</a>
	</div>
{/if}
</div>

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

{if $wiki_extras eq 'y' && $feature_wiki_attachments eq 'y' and $tiki_p_wiki_view_attachments eq 'y'}
{include file=attachments.tpl}
{/if}

{if $feature_wiki_comments eq 'y' and $tiki_p_wiki_view_comments eq 'y'}
{include file=comments.tpl}
{/if}

{if $print_page eq 'y'}
<div class="editdate" align="center">
<p>{tr}The original document is available at{/tr} {$urlprefix}tiki-index.php?page={$page|escape:"url"}
</p>
</div>
{/if}
{if $is_categorized eq 'y' and $feature_categories eq 'y' and $feature_categoryobjects eq 'y'}
<div class="catblock">{$display_catobjects}</div>
{/if}
