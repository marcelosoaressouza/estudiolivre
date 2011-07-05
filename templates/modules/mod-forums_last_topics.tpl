{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-forums_last_topics.tpl,v 1.7.10.3 2007/06/11 10:40:59 sylvieg Exp $ *}

{if $feature_forums eq 'y'}
{if $nonums eq 'y'}
{eval var="{tr}Last `$module_rows` forum topics{/tr}" assign="tpl_module_title"}
{else}
{eval var="{tr}Last forum topics{/tr}" assign="tpl_module_title"}
{/if}
{tikimodule title=$tpl_module_title name="forums_last_topics" flip=$module_params.flip decorations=$module_params.decorations}
  <table  border="0" cellpadding="1" cellspacing="0" width="100%">
    {section name=ix loop=$modForumsLastTopics}
      <tr>
        {if $nonums != 'y'}<td valign="top" class="module">{$smarty.section.ix.index_next})</td>{/if}
        <td class="module">
		  {if $absurl == 'y'}
          <a class="linkmodule" href="{$feature_server_name}{$modForumsLastTopics[ix].href}" title="{$modForumsLastTopics[ix].date|tiki_short_datetime}, {tr}by{/tr} {if $modForumsLastTopics[ix].user ne ''}{$modForumsLastTopics[ix].user}{else}{tr}Anonymous{/tr}{/if}">
            {$modForumsLastTopics[ix].name}
          </a>
		  {else}
          <a class="linkmodule" href="{$modForumsLastTopics[ix].href}" title="{$modForumsLastTopics[ix].date|tiki_short_datetime}, {tr}by{/tr} {if $modForumsLastTopics[ix].user ne ''}{$modForumsLastTopics[ix].user}{else}{tr}Anonymous{/tr}{/if}">
            {$modForumsLastTopics[ix].name}
          </a>
		  {/if}
        </td>
      </tr>
    {/section}
  </table>
{/tikimodule}
{/if}
