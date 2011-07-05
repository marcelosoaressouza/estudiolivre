{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-forums_most_commented_forums.tpl,v 1.7.10.1 2005/02/23 19:43:32 michael_davey Exp $ *}

{if $feature_forums eq 'y'}
{if $nonums eq 'y'}
{eval var="`$module_rows` {tr}Most commented forums{/tr}" assign="tpl_module_title"}
{else}
{eval var="{tr}Most commented forums{/tr}" assign="tpl_module_title"}
{/if}
{tikimodule title=$tpl_module_title name="forums_most_commented_forums" flip=$module_params.flip decorations=$module_params.decorations}
  <table  border="0" cellpadding="0" cellspacing="0">
    {section name=ix loop=$modForumsMostCommentedForums}
      <tr>
        {if $nonums != 'y'}<td class="module" valign="top">{$smarty.section.ix.index_next})</td>{/if}
        <td class="module">
          <a class="linkmodule" href="{$modForumsMostCommentedForums[ix].href}">
            {$modForumsMostCommentedForums[ix].name}
          </a>
        </td>
      </tr>
    {/section}
  </table>
{/tikimodule}
{/if}
