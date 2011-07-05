{* $Header: /cvsroot/tikiwiki/tiki/templates/tiki-list_articles.tpl,v 1.27.2.19 2007/08/02 13:03:56 sylvieg Exp $ *}

<h1><a class="pagetitle" href="tiki-list_articles.php">{tr}Articles{/tr}</a>

{if $feature_help eq 'y'}
<a href="{$helpurl}Articles" target="tikihelp" class="tikihelp" title="{tr}List Articles{/tr}">
<img src="img/icons/help.gif" border="0" height="16" width="16" alt='{tr}help{/tr}' /></a>
{/if}

{if $feature_view_tpl eq 'y'}
<a href="tiki-edit_templates.php?template=tiki-list_articles.tpl" target="tikihelp" class="tikihelp" title="{tr}View tpl{/tr}: {tr}list articles tpl{/tr}">
<img src="img/icons/info.gif" border="0" width="16" height="16" alt='{tr}edit template{/tr}' /></a>
{/if}</h1>

{if $tiki_p_edit_article eq 'y'}
  <a class="linkbut" href="tiki-edit_article.php">{tr}edit new article{/tr}</a>
{/if}
<a class="linkbut" href="tiki-view_articles.php">{tr}view articles{/tr}</a>
{if $feature_submissions == 'y' && ($tiki_p_approve_submission == "y" || $tiki_p_remove_submission == "y" || $tiki_p_edit_submission == "y")}
<a class="linkbut" href="tiki-list_submissions.php">{tr}View submissions{/tr}</a>
{/if}
{if $tiki_p_admin eq 'y'}
<a href="tiki-admin.php?page=cms"><img src='img/icons/config.gif' border='0'  alt="{tr}configure listing{/tr}" title="{tr}configure listing{/tr}" /></a>
{/if}

{include file="find.tpl"}

<table class="normal">
<tr>
{if $art_list_title eq 'y'}
	<td class="heading"><a class="tableheading" href="tiki-list_articles.php?topic={$find_topic}&amp;type={$find_type}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'title_desc'}title_asc{else}title_desc{/if}">{tr}Title{/tr}</a></td>
{/if}
{if $art_list_type eq 'y'}	
	<td class="heading"><a class="tableheading" href="tiki-list_articles.php?topic={$find_topic}&amp;type={$find_type}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'type_desc'}type_asc{else}type_desc{/if}">{tr}Type{/tr}</a></td>
{/if}
{if $art_list_topic eq 'y'}	
	<td class="heading"><a class="tableheading" href="tiki-list_articles.php?topic={$find_topic}&amp;type={$find_type}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'topicName_desc'}topicName_asc{else}topicName_desc{/if}">{tr}Topic{/tr}</a></td>
{/if}
{if $art_list_date eq 'y'}
	<td class="heading"><a class="tableheading" href="tiki-list_articles.php?topic={$find_topic}&amp;type={$find_type}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'publishDate_desc'}publishDate_asc{else}publishDate_desc{/if}">{tr}PublishDate{/tr}</a></td>
{/if}
{if $art_list_expire eq 'y'}
	<td class="heading"><a class="tableheading" href="tiki-list_articles.php?topic={$find_topic}&amp;type={$find_type}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'expireDate_desc'}expireDate_asc{else}expireDate_desc{/if}">{tr}ExpireDate{/tr}</a></td>
{/if}
{if $art_list_visible eq 'y'}
	<td class="heading"><span class="tableheading">{tr}Visible{/tr}</span></td>
{/if}
{if $art_list_author eq 'y'}
	<td class="heading"><a class="tableheading" href="tiki-list_articles.php?topic={$find_topic}&amp;type={$find_type}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'authorName_desc'}authorName_asc{else}authorName_desc{/if}">{tr}AuthorName{/tr}</a></td>
{/if}
{if $art_list_reads eq 'y'}
	<td style="text-align:right;" class="heading"><a class="tableheading" 
href="tiki-list_articles.php?topic={$find_topic}&amp;type={$find_type}&amp;offset={$offset}&amp;sort_mode={if 
$sort_mode eq 'nbreads_desc'}nbreads_asc{else}nbreads_desc{/if}">{tr}Reads{/tr}</a></td>
{/if}
{if $art_list_size eq 'y'}
	<td style="text-align:right;" class="heading"><a class="tableheading" href="tiki-list_articles.php?topic={$find_topic}&amp;type={$find_type}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'size_desc'}size_asc{else}size_desc{/if}">{tr}Size{/tr}</a></td>
{/if}
{if $art_list_img eq 'y'}
	<td class="heading">{tr}Img{/tr}</td>
{/if}
{if $tiki_p_edit_article eq 'y' or $tiki_p_remove_article eq 'y' or isset($oneEditPage)}<td  class="heading">{tr}Action{/tr}</td>{/if}
</tr>
{cycle values="odd,even" print=false}
{section name=changes loop=$listpages}
<tr>
{if $art_list_title eq 'y'}
	<td class="{cycle advance=false}">
	{if $tiki_p_read_article eq 'y'}
		<a class="artname" href="tiki-read_article.php?articleId={$listpages[changes].articleId}" title="{$listpages[changes].title|escape}">
	{/if}
	{$listpages[changes].title|truncate:20:"...":true}
	{if $listpages[changes].type eq 'Review'}(r){/if}
	{if $tiki_p_read_article eq 'y'}
		</a>
	{/if}
	</td>
{/if}
{if $art_list_type eq 'y'}	
	<td class="{cycle advance=false}">{tr}{$listpages[changes].type}{/tr}</td>
{/if}
{if $art_list_topic eq 'y'}	
	<td class="{cycle advance=false}">{$listpages[changes].topicName}</td>
{/if}
{if $art_list_date eq 'y'}
	<td class="{cycle advance=false}">{$listpages[changes].publishDate|tiki_short_datetime}</td>
{/if}
{if $art_list_expire eq 'y'}
	<td class="{cycle advance=false}">{$listpages[changes].expireDate|tiki_short_datetime}</td>
{/if}
{if $art_list_visible eq 'y'}
	<td class="{cycle advance=false}">{tr}{$listpages[changes].disp_article}{/tr}</td>
{/if}
{if $art_list_author eq 'y'}	
	<td class="{cycle advance=false}">{$listpages[changes].authorName}</td>
{/if}
{if $art_list_reads eq 'y'}
	<td style="text-align:right;" class="{cycle advance=false}">{$listpages[changes].nbreads}</td>
{/if}
{if $art_list_size eq 'y'}
	<td style="text-align:right;" class="{cycle advance=false}">{$listpages[changes].size|kbsize}</td>
{/if}
{if $art_list_img eq 'y'}
	<td class="{cycle advance=false}">{tr}{$listpages[changes].hasImage}{/tr}/{tr}{$listpages[changes].useImage}{/tr}</td>
{/if}
<td class="{cycle}">
{if $tiki_p_edit_article eq 'y' or ($listpages[changes].author eq $user and $listpages[changes].creator_edit eq 'y')}
	<a class="link" href="tiki-edit_article.php?articleId={$listpages[changes].articleId}"><img src='img/icons/edit.gif' border='0' alt='{tr}Edit{/tr}' title='{tr}Edit{/tr}' /></a>
{/if}
{if $tiki_p_remove_article eq 'y'}
	<a class="link" href="tiki-list_articles.php?offset={$offset}&amp;sort_mode={$sort_mode}&amp;remove={$listpages[changes].articleId}"><img src='img/icons2/delete.gif' border='0' alt='{tr}Remove{/tr}' title='{tr}Remove{/tr}' /></a>
{/if}
</td>
</tr>
{sectionelse}
<tr><td class="odd" colspan="11">
<b>{tr}No records found{/tr}</b>
</td></tr>
{/section}
</table>
<br />

{if count($listpages) > 0}
<div class="mini">
{if $prev_offset >= 0}
[<a class="artprevnext" href="tiki-list_articles.php?topic={$find_topic}&amp;type={$find_type}&amp;find={$find}&amp;offset={$prev_offset}&amp;sort_mode={$sort_mode}">{tr}prev{/tr}</a>]&nbsp;
{/if}
{tr}Page{/tr}: {$actual_page}/{$cant_pages}
{if $next_offset >= 0}
&nbsp;[<a class="artprevnext" href="tiki-list_articles.php?topic={$find_topic}&amp;type={$find_type}&amp;find={$find}&amp;offset={$next_offset}&amp;sort_mode={$sort_mode}">{tr}next{/tr}</a>]
{/if}
{if $direct_pagination eq 'y'}
<br />
{section loop=$cant_pages name=foo}
{assign var=selector_offset value=$smarty.section.foo.index|times:$maxRecords}
<a class="prevnext" href="tiki-list_articles.php?topic={$find_topic}&amp;type={$find_type}&amp;find={$find}&amp;offset={$selector_offset}&amp;sort_mode={$sort_mode}">
{$smarty.section.foo.index_next}</a>&nbsp;
{/section}
{/if}
</div>
{/if}

