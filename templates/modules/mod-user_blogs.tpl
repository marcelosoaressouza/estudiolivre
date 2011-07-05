{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-user_blogs.tpl,v 1.8.10.1 2005/02/23 21:15:42 michael_davey Exp $ *}

{if $user}
    {if $feature_blogs eq 'y'}
	{tikimodule title="{tr}My blogs{/tr}" name="user_blogs" flip=$module_params.flip decorations=$module_params.decorations}
	<table  border="0" cellpadding="0" cellspacing="0">
	{section name=ix loop=$modUserBlogs}
	    <tr>{if $nonums != 'y'}<td class="module" valign="top">{$smarty.section.ix.index_next})</td>{/if}
	    <td class="module"><a class="linkmodule" href="tiki-view_blog.php?blogId={$modUserBlogs[ix].blogId}">{$modUserBlogs[ix].title}</a></td></tr>
	{/section}
	</table>
	{/tikimodule}
    {/if}
{/if}
