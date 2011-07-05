{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-random_pages.tpl,v 1.5.10.2 2005/02/23 15:10:56 michael_davey Exp $ *}

{if $feature_wiki eq 'y'}
{tikimodule title="{tr}Random Pages{/tr}" name="random_pages" flip=$module_params.flip decorations=$module_params.decorations}
<table  border="0" cellpadding="0" cellspacing="0">
{section name=ix loop=$modRandomPages}
<tr><td   class="module"><a class="linkmodule" href="tiki-index.php?page={$modRandomPages[ix]|escape:'url'}">{$modRandomPages[ix]}</a></td></tr>
{/section}
</table>
{/tikimodule}
{/if}
