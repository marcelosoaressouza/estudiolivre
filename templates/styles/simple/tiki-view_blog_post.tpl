<!-- $Header: /cvsroot/tikiwiki/tiki/templates/styles/simple/tiki-view_blog_post.tpl,v 1.4.2.5 2006/07/27 08:55:50 toggg Exp $ -->
{if $feature_blogposts_pings == 'y'
  && ($blog_data.allow_comments == 'y' or $blog_data.allow_comments == 't')
  && $feature_trackbackpings  == 'y'}
<!--
<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
         xmlns:dc="http://purl.org/dc/elements/1.1/"
         xmlns:trackback="http://madskills.com/public/xml/rss/module/trackback/">
<rdf:Description
    rdf:about="{$uri}"
    dc:identifer="{$uri}"
    dc:title="{if $blog_data.use_title eq 'y'}{$post_info.title} {tr}posted by{/tr} {$post_info.user} on {$post_info.created|tiki_short_datetime}{else}{$post_info.created|tiki_short_datetime} {tr}posted by{/tr} {$post_info.user}{/if}"
    trackback:ping="{$uri2}" />
</rdf:RDF>
-->
{/if}
<div class="description">
<h1>{tr}Viewing blog post{/tr}</h1>
</div>
<a class="link" href="tiki-view_blog.php?find={$find}&amp;blogId={$blogId}&amp;offset={$offset}&amp;sort_mode={$sort_mode}">{tr}Return to blog{/tr}</a>
<br /><br />
<div class="posthead">
{if $blog_data.use_title eq 'y'}
	<h2>{$post_info.title}</h2>
{else}
	<h2>{$post_info.created|tiki_short_datetime}</h2>
{/if}
</div>

<div class="postinfo">
{if $blog_data.use_title eq 'y'}
	<small> {tr}posted by{/tr} {$post_info.user} {tr}on{/tr} {$post_info.created|tiki_short_datetime}</small>
{else}
	<small> {tr}posted by{/tr} {$post_info.user}</small>
{/if}
</div>
<div stlye="float:right">
{if ($ownsblog eq 'y') or ($user and $post_info.user eq $user) or $tiki_p_blog_admin eq 'y'}
<a class="blogt" href="tiki-blog_post.php?blogId={$post_info.blogId}&amp;postId={$post_info.postId}"><img border='0' src='img/icons/edit.gif' title='{tr}Edit{/tr}' alt='{tr}Edit{/tr}' /></a>
<a class="blogt" href="tiki-view_blog.php?blogId={$post_info.blogId}&amp;remove={$post_info.postId}"><img border='0' src='img/icons2/delete.gif' title='{tr}Remove{/tr}' alt='{tr}Remove{/tr}' /></a>
{/if}
{if $user and $feature_notepad eq 'y' and $tiki_p_notepad eq 'y'}
<a title="{tr}Save to notepad{/tr}" href="tiki-view_blog_post.php?blogId={$smarty.request.blogId}&amp;postId={$smarty.request.postId}&amp;savenotepad=1">{html_image file='img/icons/ico_save.gif' border='0' alt='{tr}save{/tr}'}</a>
{/if}
</div>
<div class="postbody">
{$parsed_data}
{if $pages > 1}
	<div align="center">
		<a href="tiki-view_blog_post.php?blogId={$smarty.request.blogId}&amp;postId={$smarty.request.postId}&amp;page={$first_page}"><img src='img/icons2/nav_first.gif' border='0' alt='{tr}First page{/tr}' title='{tr}First page{/tr}' /></a>

		<a href="tiki-view_blog_post.php?blogId={$smarty.request.blogId}&amp;postId={$smarty.request.postId}&amp;page={$prev_page}"><img src='img/icons2/nav_dot_right.gif' border='0' alt='{tr}Previous page{/tr}' title='{tr}Previous page{/tr}' /></a>

		<small>{tr}page{/tr}:{$pagenum}/{$pages}</small>

		<a href="tiki-view_blog_post.php?blogId={$smarty.request.blogId}&amp;postId={$smarty.request.postId}&amp;page={$next_page}"><img src='img/icons2/nav_dot_left.gif' border='0' alt='{tr}Next page{/tr}' title='{tr}Next page{/tr}' /></a>


		<a href="tiki-view_blog_post.php?blogId={$smarty.request.blogId}&amp;postId={$smarty.request.postId}&amp;page={$last_page}">{html_image file='img/icons2/nav_last.gif' border='0' alt='{tr}Last page{/tr}' title='{tr}Last page{/tr}'}</a>
	</div>
{/if}
<div class="postfooter">
<small>
<a class="link" href="tiki-view_blog_post.php?blogId={$blogId}&amp;postId={$postId}">{tr}Permalink{/tr}</a>
({tr}referenced by{/tr}: {$post_info.trackbacks_from_count} {tr}posts{/tr} {tr}references{/tr}: {$post_info.trackbacks_to_count} {tr}posts{/tr})
{if $allow_comments eq 'y' and $feature_blogposts_comments eq 'y'}
{$listpages[ix].comments} {tr}comments{/tr}
 [<a class="link" href="tiki-view_blog_post.php?find={$find}&amp;blogId={$blogId}&amp;offset={$offset}&amp;sort_mode={$sort_mode}&amp;postId={$listpages[ix].postId}">{tr}view comments{/tr}</a>]
{/if}
</small>
<a href='tiki-print_blog_post.php?postId={$postId}'><img src='img/icons/ico_print.gif' border='0' alt='{tr}print{/tr}' title='{tr}print{/tr}' /></a>
<a href='tiki-send_blog_post.php?postId={$postId}'><img src='img/icons/email.gif' border='0' alt='{tr}email this post{/tr}' title='{tr}email this post{/tr}' /></a>
</div>
</div>
{if $post_info.trackbacks_from_count > 0}
<h3>{tr}Trackback pings{/tr}:</h3>
{cycle values="odd,even" print=false}
<table class="normal">
<tr>
	<td class="heading">{tr}Title{/tr}</td>
	<td class="heading">{tr}URI{/tr}</td>
	<td class="heading">{tr}Blog name{/tr}</td>
{if ($ownsblog eq 'y') or ($user and $post_info.user eq $user) or $tiki_p_blog_admin eq 'y'}
	<td class="heading">{tr}Action{/tr}</td>
{/if}
</tr>
{foreach from=$post_info.trackbacks_from key=key item=item}
<tr>
  <td  class="{cycle advance=false}">{$item.title|htmlentities}</td>
  <td  class="{cycle advance=false}"><a href="{$key}" class="link" title="{$key}" target="_blank">{$key|truncate:"40"|htmlentities}</td>
  <td  class="{cycle}">{$item.blog_name|htmlentities}</td>
  {if ($ownsblog eq 'y') or ($user and $post_info.user eq $user) or $tiki_p_blog_admin eq 'y'}
    <td  class="{cycle advance=false}"><a href="tiki-view_blog_post.php?postId={$postId}&amp;deltrack={$key|urlencode}"><img border='0' src='img/icons2/delete.gif' title='{tr}Remove{/tr}' alt='{tr}Remove{/tr}' /></a></td>
  {/if}
</tr>
{/foreach}
</table>
{/if}

{if $feature_blogposts_comments == 'y'
  && ($blog_data.allow_comments == 'y' or $blog_data.allow_comments == 'c')
  && (($tiki_p_read_comments  == 'y'
  && $comments_cant != 0)
  ||  $tiki_p_post_comments  == 'y'
  ||  $tiki_p_edit_comments  == 'y')}
<div id="page-bar">
<div class="button2">
      <a href="#comments" onclick="javascript:flip('comzone{if $comments_show eq 'y'}open{/if}');" class="linkbut">
	{if $comments_cant == 0}
          {tr}add comment{/tr}
        {elseif $comments_cant == 1}
          <span class="highlight">{tr}1 comment{/tr}</span>
        {else}
          <span class="highlight">{$comments_cant} {tr}comments{/tr}</span>
        {/if}
      </a>
</div>
</div>
{include file=comments.tpl}
{/if}
{if $show_comments}
<script type="text/javascript">flip('comzone{if $comments_show eq 'y'}open{/if}');</script>
{/if}
