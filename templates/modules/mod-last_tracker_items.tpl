{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-last_tracker_items.tpl,v 1.7.10.3 2007/08/13 09:04:37 marclaporte Exp $ *}

{if $feature_trackers eq 'y'}
{if $nonums eq 'y'}
{eval var="{tr}Last `$module_rows` Items{/tr}" assign="tpl_module_title"}
{else}
{eval var="{tr}Last Items{/tr}" assign="tpl_module_title"}
{/if}
{tikimodule title=$tpl_module_title name="last_tracker_items" flip=$module_params.flip decorations=$module_params.decorations}
<table  border="0" cellpadding="0" cellspacing="0">
{section name=ix loop=$modLastItems}
<tr>{if $nonums != 'y'}<td class="module" >{$smarty.section.ix.index_next})</td>{/if}
<td class="module"><a class="linkmodule" href="tiki-view_tracker_item.php?itemId={$modLastItems[ix].itemId}">
{$modLastItems[ix].subject}
</a></td></tr>
{/section}
</table>
{/tikimodule}
{/if}
