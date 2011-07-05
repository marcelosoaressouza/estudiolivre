{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-forums_best_voted_topics.tpl,v 1.8.8.1 2005/02/23 15:51:34 michael_davey Exp $ *}

{if $feature_forums eq 'y'}
{if $nonums eq 'y'}
{eval var="{tr}Top `$module_rows` topics{/tr}" assign="tpl_module_title"}
{else}
{eval var="{tr}Top topics{/tr}" assign="tpl_module_title"}
{/if}
{tikimodule title=$tpl_module_title name="forums_best_voted_topics" flip=$module_params.flip decorations=$module_params.decorations}
  <table  border="0" cellpadding="0" cellspacing="0">
    {section name=ix loop=$modForumsTopTopics}
      <tr>
        {if $nonums != 'y'}<td class="module" valign="top">{$smarty.section.ix.index_next})</td>{/if}
        <td class="module">
          <a class="linkmodule" href="{$modForumsTopTopics[ix].href}">
            {$modForumsTopTopics[ix].name}
          </a>
        </td>
      </tr>
    {/section}
  </table>
{/tikimodule}
{/if}
