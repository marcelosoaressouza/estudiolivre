{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-top_active_blogs.tpl,v 1.9.10.1 2005/02/23 21:05:09 michael_davey Exp $ *}

{if $feature_blogs eq 'y'}
{if $nonums eq 'y'}
{eval var="`$module_rows` {tr}Most Active blogs{/tr}" assign="tpl_module_title"}
{else}
{eval var="{tr}Most Active blogs{/tr}" assign="tpl_module_title"}
{/if}
{tikimodule title=$tpl_module_title name="top_active_blogs" flip=$module_params.flip decorations=$module_params.decorations}
<table  border="0" cellpadding="0" cellspacing="0">
{section name=ix loop=$modTopActiveBlogs}
<tr>{if $nonums != 'y'}<td class="module" valign="top">{$smarty.section.ix.index_next})</td>{/if}
<td class="module"><a class="linkmodule" href="tiki-view_blog.php?blogId={$modTopActiveBlogs[ix].blogId}">{$modTopActiveBlogs[ix].title}</a></td></tr>
{/section}
</table>
{/tikimodule}
{/if}
