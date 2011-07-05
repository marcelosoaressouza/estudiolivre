{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-last_files.tpl,v 1.9.10.4 2005/02/23 14:44:25 michael_davey Exp $ *}

{if $feature_file_galleries eq 'y'}
{if $nonums eq 'y'}
{eval var="{tr}Last `$module_rows` Files{/tr}" assign="tpl_module_title"}
{else}
{eval var="{tr}Last Files{/tr}" assign="tpl_module_title"}
{/if}
{tikimodule title=$tpl_module_title name="last_files" flip=$module_params.flip decorations=$module_params.decorations}
  <table border="0" cellpadding="0" cellspacing="0">
    {section name=ix loop=$modLastFiles}
      <tr>
        {if $nonums != 'y'}<td class="module">{$smarty.section.ix.index_next})</td>{/if}
        <td class="module">
          <a class="linkmodule" href="tiki-download_file.php?fileId={$modLastFiles[ix].fileId}">
            {$modLastFiles[ix].filename}
          </a>
        </td>
      </tr>
    {/section}
  </table>
{/tikimodule}
{/if}
