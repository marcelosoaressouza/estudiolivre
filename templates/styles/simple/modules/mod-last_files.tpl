{* $Header: /cvsroot/tikiwiki/tiki/templates/styles/simple/modules/mod-last_files.tpl,v 1.1.2.1 2005/11/18 23:34:36 amette Exp $ *}

{if $feature_file_galleries eq 'y'}
{if $nonums eq 'y'}
{eval var="{tr}Last `$module_rows` Files{/tr}" assign="tpl_module_title"}
{else}
{eval var="{tr}Last Files{/tr}" assign="tpl_module_title"}
{/if}
{tikimodule title=$tpl_module_title name="last_files" flip=$module_params.flip decorations=$module_params.decorations}
{if $nonums != 'y'}<ol>{/if}
    {section name=ix loop=$modLastFiles}
        {if $nonums != 'y'}<li>{/if}
          <a class="linkmodule" href="tiki-download_file.php?fileId={$modLastFiles[ix].fileId}">
            {$modLastFiles[ix].filename}
          </a>
	 {if $nonums != 'y'}</li>{else}<br />{/if}
    {/section}
{if $nonums != 'y'}</ol>{/if}
{/tikimodule}
{/if}
