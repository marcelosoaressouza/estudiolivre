{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-user_pages.tpl,v 1.10.10.1 2005/02/23 21:10:34 michael_davey Exp $ *}

{if $user}
  {if $feature_wiki eq 'y'}
       
       {tikimodule title="{tr}My Pages{/tr}" name="user_pages" flip=$module_params.flip decorations=$module_params.decorations}
       <table  border="0" cellpadding="0" cellspacing="0">
       {section name=ix loop=$modUserPages}
       <tr>
        {if $nonums != 'y'}
          <td class="module" valign="top">{$smarty.section.ix.index_next})</td>
        {/if}
        <td class="module">&nbsp;
         <a class="linkmodule" href="tiki-index.php?page={$modUserPages[ix].pageName|escape:"url"}">
          {$modUserPages[ix].pageName}
         </a>
        </td>
       </tr>
       {/section}
       </table>
       {/tikimodule}
       
  {/if} {* $feature_wiki eq 'y' *}
{/if}   {* $user *}
