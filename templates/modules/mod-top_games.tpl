{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-top_games.tpl,v 1.8.2.1 2005/02/23 15:42:20 michael_davey Exp $ *}

{if $feature_games eq 'y'}
{if $nonums neq 'y'}
{eval var="{tr}Top `$module_rows` games{/tr}" assign="tpl_module_title"}
{else}
{eval var="{tr}Top games{/tr}" assign="tpl_module_title"}
{/if}

{tikimodule title=$tpl_module_title name="top_games" flip=$module_params.flip decorations=$module_params.decorations}
<table  border="0" cellpadding="0" cellspacing="0">
{section name=ix loop=$modTopGames}
<tr>{if $nonums neq 'y'}<td class="module" valign="top">{$smarty.section.ix.index_next})</td>{/if}
<td class="module"><a class="linkmodule" href="tiki-list_games.php?game={$modTopGames[ix].gameName}">{$modTopGames[ix].thumbName}</a></td></tr>
{/section}
</table>
{/tikimodule}
{/if}
