{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-last_images_th.tpl,v 1.1.2.4 2005/02/23 15:10:54 michael_davey Exp $ *}

{if $feature_galleries eq 'y'}
  {tikimodule title="{tr}Last Images{/tr}" name="last_images_th" flip=$module_params.flip decorations=$module_params.decorations}
  {section name=ix loop=$modLastImages}
    {if $smarty.section.ix.index < 5}
       <table  cellpadding="0" cellspacing="0">
       <tr>
       <td align="center">
       <a class="linkmodule" href="tiki-browse_image.php?imageId={$modLastImages[ix].imageId}">
       <img src="show_image.php?id={$modLastImages[ix].imageId}&amp;thumb=1" alt="{tr}image{/tr}" />
       </a>
       </td></tr>
       </table>
    {/if}
  {/section}
  {/tikimodule}
{/if}
