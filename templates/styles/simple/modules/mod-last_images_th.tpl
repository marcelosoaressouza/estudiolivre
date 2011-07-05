{* $Header: /cvsroot/tikiwiki/tiki/templates/styles/simple/modules/mod-last_images_th.tpl,v 1.1.2.1 2005/11/18 23:34:36 amette Exp $ *}

{if $feature_galleries eq 'y'}
  {tikimodule title="{tr}Last Images{/tr}" name="last_images_th" flip=$module_params.flip decorations=$module_params.decorations}
  {section name=ix loop=$modLastImages}
    {if $smarty.section.ix.index < 5}
       <div align="center">
       <a class="linkmodule" href="tiki-browse_image.php?imageId={$modLastImages[ix].imageId}">
       <img src="show_image.php?id={$modLastImages[ix].imageId}&amp;thumb=1" alt="{tr}image{/tr}" />
       </a>
       </div>
    {/if}
  {/section}
  {/tikimodule}
{/if}
