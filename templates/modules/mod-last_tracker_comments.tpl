{if $feature_trackers eq 'y'}
{if $nonums eq 'y'}
{eval var="{tr}Last `$module_rows` Modified Comments{/tr}" assign="tpl_module_title"}
{else}
{eval var="{tr}Last Modified Comments{/tr}" assign="tpl_module_title"}
{/if}
{tikimodule title=$tpl_module_title name="last_modif_tracker_comments" flip=$module_params.flip decorations=$mo\dule_params.decorations}
  <table  border="0" cellpadding="0" cellspacing="0">
    {section name=ix loop=$modLastModifComments}
      <tr>
        {if $nonums != 'y'}<td class="module" >{$smarty.section.ix.index_next})</td>{/if}
        <td class="module">
          <a class="linkmodule" href="tiki-view_tracker_item.php?itemId={$modLastModifComments[ix].itemId}">
              {$modLastModifComments[ix].title}
          </a>
        </td>
      </tr>
    {/section}
  </table>
{/tikimodule}

{/if}
