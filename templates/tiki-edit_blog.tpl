<center>
<h1>
{if $blogId > 0}
<a class="pagetitle" href="tiki-edit_blog.php?blogId={$blogId}">{tr}Edit Blog{/tr}: {$title}</a>
{else}
<a class="pagetitle" href="tiki-edit_blog.php">{tr}Create Blog{/tr}</a>
{/if}
  
{if $feature_help eq 'y'}
<a href="{$helpurl}Blog" target="tikihelp" class="tikihelp" title="{tr}Editing and Creating Blogs{/tr}">
<img src="img/icons/help.gif" border="0" height="16" width="16" alt='{tr}help{/tr}' /></a>{/if}

{if $feature_view_tpl eq 'y' and $tiki_p_view_templates eq 'y'}
<a href="tiki-edit_templates.php?template=tiki-edit_blog.tpl" target="tikihelp" class="tikihelp" title="{tr}View tpl{/tr}: {tr}edit blog tpl{/tr}">
</a>{/if}</h1>

{if strlen($heading) > 0}
{eval var=$heading}
{/if}

<br/>
{if $individual eq 'y'}
<a class="link" href="tiki-objectpermissions.php?objectName={$title|escape:"url"}&amp;objectType=blog&amp;permType=blogs&amp;objectId={$blogId}">{tr}There are individual permissions set for this blog{/tr}</a>
{/if}
{include file=categorize.tpl}
<br/><br/>

<form method="post" action="tiki-edit_blog.php" id="blog-edit-form">
<input type="hidden" name="blogId" value="{$blogId|escape}" />

<table class="normal_blog">
<tr class="editblogform"><td class="editblogform" style="background:#FAA432;"><label for="blog-title">{tr}Title{/tr}</label></td><td class="editblogform" style="background:#FAA432;"><input type="text" name="title" size="48" id="blog-title" value="{$title|escape}" /></td></tr>
<tr class="editblogform"><td class="editblogform"><label for="blog-desc">{tr}Description{/tr}</label><br />{include file="textareasize.tpl" area_name='blog-desc' formId='blog-edit-form'}</td><td class="editblogform"><textarea class="wikiedit" name="description" id="blog-desc" rows="{$rows}" cols="{$cols}" wrap="virtual">{$description|escape}</textarea></td></tr>
<tr class="editblogform"><td class="editblogform" style="background:#FAA432;"><label for="blogs-number">{tr}Number of posts to show{/tr}</label></td><td class="editblogform" style="background:#FAA432;"><input type="text" name="maxPosts" id="blogs-number" value="{$maxPosts|escape}" /></td></tr>
<tr class="editblogform"><td class="editblogform"><label for="blogs-allow_others">{tr}Allow other user to post in this blog{/tr}</label></td><td class="editblogform"><input type="checkbox" name="public" id="blogs-allow_others" {if $public eq 'y'}checked='checked'{/if}/></td></tr>
<tr class="editblogform"><td class="editblogform" style="background:#FAA432;"><label for="blogs-titles">{tr}Use titles in blog posts{/tr}</label></td><td class="editblogform" style="background:#FAA432;"><input type="checkbox" name="use_title" id="blogs-titles" {if $use_title eq 'y'}checked='checked'{/if}/></td></tr>
<tr class="editblogform"><td class="editblogform"><label for="blogs-search">{tr}Allow search{/tr}</label></td><td class="editblogform"><input type="checkbox" name="use_find" id="blogs-search" {if $use_find eq 'y'}checked='checked'{/if}/></td></tr>
<tr class="editblogform"><td class="editblogform" style="background:#FAA432;"><label for="blogs-comments">{tr}Allow comments{/tr}</label></td><td class="editblogform" style="background:#FAA432;"><input type="checkbox" name="allow_comments" id="blogs-comments" {if $allow_comments eq 'y' or $allow_comments eq 'c'}checked='checked'{/if} /></td></tr>
<tr class="editblogform"><td class="editblogform"><label for="blogs-trackbackpings">{tr}Allow trackback pings{/tr}</label></td><td class="editblogform"><input type="checkbox" name="allow_trackbackpings" id="blogs-trackbackpings" {if $allow_comments eq 'y' or $allow_comments eq 't'}checked='checked'{/if} /></td></tr>
<tr class="editblogform"><td class="editblogform" style="background:#FAA432;">{tr}Show user avatar{/tr}</td><td class="editblogform" style="background:#FAA432;"><input type="checkbox" name="show_avatar" {if $show_avatar eq 'y'}checked='checked'{/if} /></td></tr>

{if $tiki_p_edit_templates eq 'y'}
<tr class="editblogform"><td class="editblogform"><label for="blogs-heading">{tr}Heading{/tr}</label><br/><td class="editblogform"><textarea name="heading" id="blogs-heading" rows='24' cols='80'>{$heading|escape}</textarea></td></tr>
{/if}

<tr class="editblogform">
	<td>&nbsp;</td><td><input type="submit" class="button" name="preview" value="{tr}preview{/tr}" />
	<input type="submit" class="button" name="save" value="{tr}save{/tr}" /></td>
</tr>
</table>
</form>
<br />
