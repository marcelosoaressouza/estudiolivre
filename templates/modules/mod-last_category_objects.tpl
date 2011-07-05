{* 
$Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-last_category_objects.tpl,v 1.2.4.1 2005/02/23 15:42:19 michael_davey Exp $ 
parameters : id=1&type=*&maxlen=20
id is the categId of the parent categ to list
type is the type of object to list. default is 'wiki page' and * get all types
maxlen is the number of characters after which labels are truncated
note : lists the objects from a given category not a recursive tree
*}
{if $feature_categories eq 'y'}
{tikimodule title="{tr}Last{/tr} $type" name="last_category_objects" flip=$module_params.flip decorations=$module_params.decorations}
{section name=ix loop=$last}
<div><a class="linkmodule" href="{$last[ix].href|escape}" title="{$last[ix].type|escape}">
{if $maxlen > 0}
{$last[ix].name|truncate:$maxlen:"...":true}
{else}
{$last[ix].name}
{/if}
</a></div>
{/section}
{/tikimodule}
{/if}
