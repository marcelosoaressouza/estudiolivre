{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-featured_links.tpl,v 1.10.10.1 2005/02/23 21:10:34 michael_davey Exp $ *}

{if $feature_featuredLinks eq 'y'}
  {tikimodule title="{tr}Featured links{/tr}" name="featured_links" flip=$module_params.flip decorations=$module_params.decorations}
   <table  border="0" cellpadding="0" cellspacing="0">
    {section name=ix loop=$featuredLinks}
     {if $featuredLinks[ix].type eq 'f'}
      <tr>
       <td class="module">
        <a class="linkmodule" href="tiki-featured_link.php?type={$featuredLinks[ix].type}&amp;url={$featuredLinks[ix].url|escape:"url"}">
         {$featuredLinks[ix].title}
        </a>
       </td>
      </tr>
     {else}
      <tr>
       <td class="module">
        <a class="linkmodule" {if $featuredLinks[ix].type eq 'n'}target='_blank'{/if} href="{$featuredLinks[ix].url}">
         {$featuredLinks[ix].title}
        </a>
       </td>
      </tr>
     {/if}
    {/section}
   </table>
  {/tikimodule}
{/if}
