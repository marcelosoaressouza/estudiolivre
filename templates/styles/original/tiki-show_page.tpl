<div id="menuPaginaWiki">

	{ if $print_page ne 'y'}
	{if !$lock}
		{if $tiki_p_edit eq 'y' or $page|lower eq 'sandbox'}
			{if $beingEdited eq 'y'}
				<span class="tabbut"><a title="{$semUser}" class="highlight" href="tiki-editpage.php?page={$page|escape:"url"}" class="tablink">{tr}edit{/tr}</a></span>
			{else}
				<span class="tabbut"><a href="tiki-editpage.php?page={$page|escape:"url"}" class="tablink">{tr}edit{/tr}</a></span>
			{/if}
		{/if}
	{/if}
	
	{if $page|lower ne 'sandbox'}
		{if $tiki_p_remove eq 'y'}
			<span class="tabbut"><a href="tiki-removepage.php?page={$page|escape:"url"}&amp;version=last" class="tablink">{tr}remove{/tr}</a></span>
		{/if}
		{if $tiki_p_rename eq 'y'}
			<span class="tabbut"><a href="tiki-rename_page.php?page={$page|escape:"url"}" class="tablink">{tr}rename{/tr}</a></span>
		{/if}
	{/if}
	
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
	
	{if $page|lower ne 'sandbox'}
		{if $feature_history eq 'y' and $tiki_p_wiki_view_history eq 'y'}
			<span class="tabbut"><a href="tiki-pagehistory.php?page={$page|escape:"url"}" class="tablink">{tr}history{/tr}</a></span>
		{/if}
	{/if}
	
	{if $feature_likePages eq 'y'}
		<span class="tabbut"><a href="tiki-likepages.php?page={$page|escape:"url"}" class="tablink">{tr}similar{/tr}</a></span>
	{/if}
	
	{if $feature_wiki_undo eq 'y' and $canundo eq 'y'}
		<span class="tabbut"><a href="tiki-index.php?page={$page|escape:"url"}&amp;undo=1" class="tablink">{tr}undo{/tr}</a></span>
	{/if}
	
	{if $wiki_uses_slides eq 'y'}
	{if $show_slideshow eq 'y'}
		<span class="tabbut"><a href="tiki-slideshow.php?page={$page|escape:"url"}" class="tablink">{tr}slides{/tr}</a></span>
	{elseif $structure eq 'y'}
		<span class="tabbut"><a href="tiki-slideshow2.php?page_ref_id={$page_info.page_ref_id}" class="tablink">{tr}slides{/tr}</a></span>
	{/if}
	{/if}
	
	{if $tiki_p_admin_wiki eq 'y'}
		<span class="tabbut"><a href="tiki-export_wiki_pages.php?page={$page|escape:"url"}" class="tablink">{tr}export{/tr}</a></span>
	{/if}
	
	{if $feature_wiki_discuss eq 'y'}
		<span class="tabbut"><a href="tiki-view_forum.php?forumId={$wiki_forum_id}&amp;comments_postComment=post&amp;comments_title={$page|escape:"url"}&amp;comments_data={"Use this thread to discuss the [tiki-index.php?page="}{$page}{"|"}{$page}{"] page."|escape:"url"}&amp;comment_topictype=n" class="tablink">{tr}discuss{/tr}</a></span>
	{/if}
	
	{if $feature_wiki_comments eq 'y' and $tiki_p_wiki_view_comments eq 'y' and $show_page eq 'y'}
		<span class="tabbut"><a href="#comments" onclick="javascript:flip('comzone{if $comments_show eq 'y'}open{/if}');" class="tablink">{if $comments_cant eq 0}{tr}comment{/tr}{elseif $comments_cant eq 1}1 {tr}comment{/tr}{else}{$comments_cant} {tr}comments{/tr}{/if}</a></span>
	{/if}
	{if $feature_wiki_attachments eq 'y' and $tiki_p_wiki_view_attachments eq 'y' and $show_page eq 'y'}
	<span class="tabbut"><a href="#attachments" onclick="javascript:flip('attzone{if $atts_show eq 'y'}open{/if}');" class="tablink">{if $atts_count eq 0}{tr}attach file{/tr}{elseif $atts_count eq 1}1 {tr}attachment{/tr}{else}{$atts_count} {tr}attachments{/tr}{/if}</a></span>
	{/if}
	{if $feature_multilingual eq 'y' and $tiki_p_edit eq 'y' and !$lock}
	     <span class="tabbut"><a href="tiki-edit_translation.php?page={$page|escape:'url'}" class="tablink">{tr}translation{/tr}</a></span>
	{/if}
	
	{/if}
</div>

{if $feature_page_title eq 'y'}<h1><a  href="tiki-index.php?page={$page|escape:"url"}" class="pagetitle">
  {if $structure eq 'y' and $page_info.page_alias ne ''}
    {$page_info.page_alias}
  {else}
    {$page}
  {/if}</a>
{if $lock and $print_page ne 'y'}
<img src="img/icons/lock_topic.gif" height="19" width="19" alt="{tr}locked{/tr}" title="{tr}locked by{/tr} {$page_user}" />
{/if}
</h1>{/if}
{if $feature_wiki_pageid eq 'y'}
	<small><a class="link" href="tiki-index.php?page_id={$page_id}">{tr}page id{/tr}: {$page_id}</a></small>
{/if}

<table width="100%">
{if $is_categorized eq 'y' and $feature_categories eq 'y' and $feature_categorypath eq 'y'}
<tr>
<td>
{if $feature_wiki_description eq 'y'}
<small>{$description}</small>
{/if}
{if $cached_page eq 'y'}
<small>({tr}cached{/tr})</small>
{/if}
</td>
<td align="right">
{$display_catpath}
</td>
</tr>
{else}
<tr>
<td>
{if $feature_wiki_description eq 'y'}
<small>{$description}</small>
{/if}
{if $cached_page eq 'y'}
<small>(cached)</small>
{/if}
</td>
<td>
</td>
</tr>
{/if}
<tr>
<td>
</td>
<td style="text-align:right;">
</td>
<div id="icones">
{if $feature_backlinks eq 'y' and $backlinks}
  <select name="page" onchange="go(this)">
    <option value="tiki-index.php?page={$page|escape:"url"}">{tr}backlinks{/tr}...</option>
	{section name=back loop=$backlinks}
	  <option value="tiki-index.php?page={$backlinks[back].fromPage|escape:"url"}">{$backlinks[back].fromPage}</option>
	{/section}
  </select>
<br />
{/if}
{if count($showstructs) ne 0}
  <select name="page" onchange="go(this)">
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
<br />
{/if}

{if $print_page ne 'y'}
{if !$lock and ($tiki_p_edit eq 'y' or $page|lower eq 'sandbox') and $beingEdited ne 'y'}
<a title="{tr}edit{/tr}" href="tiki-editpage.php?page={$page|escape:"url"}"><img src="img/icons/edit.gif" border="0" width="20" height="16"  alt='{tr}edit{/tr}'></a>
<br />
{/if}

{if $feature_backlinks eq 'y'}
<a title="{tr}backlinks{/tr}" href="tiki-backlinks.php?page={$page|escape:"url"}">{html_image file='img/icons/ico_link.gif' border='0' alt='{tr}backlinks{/tr}'}</a>
<br />
{/if}

{if $wiki_feature_3d eq 'y'}
<a title="{tr}3d browser{/tr}" href="javascript:wiki3d_open('{$page|escape}',{$wiki_3d_width}, {$wiki_3d_height})"><img src="img/icons/ico_wiki3d.gif" border="0" width="13" height="16" alt='{tr}3d browser{/tr}' /></a>
<br />
{/if}

{if $cached_page eq 'y'}
<a title="{tr}refresh{/tr}" href="tiki-index.php?page={$page|escape:"url"}&amp;refresh=1">{html_image file='img/icons/ico_redo.gif' border='0' alt='{tr}refresh{/tr}'}</a>
<br />
{/if}

<a title="{tr}print{/tr}" href="tiki-print.php?page={$page|escape:"url"}">{html_image file='img/icons/ico_print.gif' border='0' alt='{tr}print{/tr}'}</a>
<br />

{if $feature_wiki_pdf eq 'y'}
<a title="{tr}create pdf{/tr}" href="tiki-config_pdf.php?page={$page|escape:"url"}">{html_image file='img/icons/ico_pdf.gif' border='0' alt='{tr}pdf{/tr}'}</a>
<br />
{/if}

{if $user and $feature_notepad eq 'y' and $tiki_p_notepad eq 'y'}
<a title="{tr}Save to notepad{/tr}" href="tiki-index.php?page={$page|escape:"url"}&amp;savenotepad=1">{html_image file='img/icons/ico_save.gif' border='0' alt='{tr}save{/tr}'}</a>
<br />
{/if}

{if $user and $feature_user_watches eq 'y'}
  {if $user_watching_page eq 'n'}
    <a href="tiki-index.php?page={$page|escape:"url"}&amp;watch_event=wiki_page_changed&amp;watch_object={$page|escape:"url"}&amp;watch_action=add"><img border='0' alt='{tr}monitor this page{/tr}' title='{tr}monitor this page{/tr}' src='img/icons/icon_watch.png' /></a>
<br />
  {else}
    <a href="tiki-index.php?page={$page|escape:"url"}&amp;watch_event=wiki_page_changed&amp;watch_object={$page|escape:"url"}&amp;watch_action=remove"><img border='0' alt='{tr}stop monitoring this page{/tr}' title='{tr}stop monitoring this page{/tr}' src='img/icons/icon_unwatch.png' /></a>
<br />
  {/if}
{/if}

{/if}
</div>
{if $feature_multilingual == 'y'}{include file="translated-lang.tpl" td='y'}{/if}

</tr>
</table>

<div class="wikitext">
{if $structure eq 'y'}
<div class="tocnav">
<table width='100%'>
<tr>
	<td>
	{section loop=$structure_path name=ix}
		{if $structure_path[ix].parent_id}->{/if}
		<a href="tiki-index.php?page_ref_id={$structure_path[ix].page_ref_id}">
		{if $structure_path[ix].page_alias}
			{$structure_path[ix].page_alias}
		{else}
			{$structure_path[ix].pageName}
		{/if}
		</a>
	{/section}
	</td>
</tr>
<tr>
		<td>
			<table width='100%'>
				<tr>
	<td width='33%'>
		{if $prev_info and $prev_info.page_ref_id}
			<a class="tocnavlink" href="tiki-index.php?page_ref_id={$prev_info.page_ref_id}">&lt;&lt;
				{if $prev_info.page_alias}
					{$prev_info.page_alias}
				{else}
					{$prev_info.pageName}
				{/if}
			</a>

		{else}
			&nbsp;
		{/if}
	</td>
	<td align='center' width='33%'>
	{if $parent_info}
		<a class="tocnavlink" href="tiki-index.php?page_ref_id={$parent_info.page_ref_id}">
	        {if $parent_info.page_alias}
			{$parent_info.page_alias}
		{else}
			{$parent_info.pageName}
		{/if}
		</a>
	{/if}
	</td>
	<td align='right' width='33%'>
		{if $next_info and $next_info.page_ref_id}
				<a class="tocnavlink" href="tiki-index.php?page_ref_id={$next_info.page_ref_id}">
					{if $next_info.page_alias}
						{$next_info.page_alias}
					{else}
						{$next_info.pageName}
					{/if}
					&gt;&gt;
				</a>
			{else}
				&nbsp;
			{/if}</td>
				</tr>
			</table>
		</td>
	</tr>
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


{if $wiki_extras eq 'y'}
<br />
{if $feature_wiki_attachments eq 'y'}
{if $tiki_p_wiki_view_attachments eq 'y' or $tiki_p_wiki_admin_attachments eq 'y'}
<a name="attachments"></a>
<div id="attzone">
<table class="normal">
<tr>
  <td class="heading"><a class="tableheading" href="tiki-index.php?page={$page}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'filename_desc'}filename_asc{else}filename_desc{/if}">{tr}name{/tr}</a></td>
  <td class="heading"><a class="tableheading" href="tiki-index.php?page={$page}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'created_desc'}created_asc{else}created_desc{/if}">{tr}uploaded{/tr}</a></td>
  <td style="text-align:right;"   class="heading"><a class="tableheading" href="tiki-index.php?page={$page}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'size_desc'}size_asc{else}size_desc{/if}">{tr}size{/tr}</a></td>
  <td style="text-align:right;"   class="heading"><a class="tableheading" href="tiki-index.php?page={$page}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'downloads_desc'}downloads_asc{else}downloads_desc{/if}">{tr}dls{/tr}</a></td>
  <td class="heading"><a class="tableheading" href="tiki-index.php?page={$page}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'comment_desc'}comment_asc{else}comment_desc{/if}">{tr}desc{/tr}</a></td>
</tr>
{cycle values="odd,even" print=false}
{section name=ix loop=$atts}
<tr>
 <td class="{cycle advance=false}">
 {$atts[ix].filename|iconify}
 <a class="tablename" href="tiki-download_wiki_attachment.php?attId={$atts[ix].attId}">{$atts[ix].filename}</a>
 {if $tiki_p_wiki_admin_attachments eq 'y' or ($user and ($atts[ix].user eq $user))}
 <a class="link" href="tiki-index.php?page={$page}&amp;removeattach={$atts[ix].attId}&amp;offset={$offset}&amp;sort_mode={$sort_mode}">[x]</a>
 {/if}
 </td>
 <td class="{cycle advance=false}"><small>{$atts[ix].created|tiki_short_datetime}{if $atts[ix].user} {tr}by{/tr} {$atts[ix].user}{/if}</small></td>
 <td style="text-align:right;" class="{cycle advance=false}">{$atts[ix].filesize|kbsize}</td>
 <td style="text-align:right;" class="{cycle advance=false}">{$atts[ix].downloads}</td>
 <td class="{cycle}"><small>{$atts[ix].comment}</small></td>
</tr>
{sectionelse}
<tr>
 <td colspan="19" class="even">{tr}No attachments for this page{/tr}</td>
</tr>
{/section}
</table>
{if $tiki_p_wiki_attach_files eq 'y' or $tiki_p_wiki_admin_attachments eq 'y'}
<form enctype="multipart/form-data" action="tiki-index.php?page={$page}" method="post">
<table class="normal">
<tr>
 <td class="formcolor">{tr}Upload file{/tr}:<input type="hidden" name="MAX_FILE_SIZE" value="1000000000"><input  style="font-size:9px;" size="16" name="userfile1" type="file">
 {tr}comment{/tr}: <input  style="font-size:9px;"  type="text" name="attach_comment" maxlength="250" />
 <input style="font-size:9px;" type="submit" name="attach" value="{tr}attach{/tr}" />
 </td>
</tr>
</table>
</form>
{/if}
</div>
{/if}
{/if}
{if $feature_wiki_comments eq 'y' and $tiki_p_wiki_view_comments eq 'y'}
{include file=comments.tpl}
{/if}
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

