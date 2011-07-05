{if $feature_categories eq 'y' and (count($categories) gt 0 or $tiki_p_admin_categories eq 'y')}
<tr class="formcolor">
 <td>{tr}Categorize{/tr}</td>
 <td{if $colsCategorize} colspan="{$colsCategorize}"{/if}>
  [ <a class="link" href="javascript:show('categorizator');">{tr}show categories{/tr}</a>
  | <a class="link" href="javascript:hide('categorizator');">{tr}hide categories{/tr}</a> ]
  <div id="categorizator" {if $cat_categorize eq 'n' and $categ_checked ne 'y'}style="display:none;"{else}style="display:block;"{/if}>
{if $feature_help eq 'y'}
	<div class="simplebox">{tr}Tip: hold down CTRL to select multiple categories{/tr}</div>
{/if}
  {if count($categories) gt 0}
   <select name="cat_categories[]" multiple="multiple" size="5">
   {section name=ix loop=$categories}
    <option value="{$categories[ix].categId|escape}" {if $categories[ix].incat eq 'y'}selected="selected"{/if}>{$categories[ix].categpath}</option>
   {/section}
   </select><br />
   <label for="cat-check">{tr}categorize this object{/tr}:</label>
    <input type="checkbox" name="cat_categorize" id="cat-check" {if $cat_categorize eq 'y' or $categ_checked eq 'y'}checked="checked"{/if}/><br />
{if $feature_help eq 'y'}
    <div class="simplebox">{tr}Tip: uncheck the above checkbox to uncategorize this page/object{/tr}</div>
{/if}
  {else}
    {tr}No categories defined{/tr} <br />
  {/if}
  {if $tiki_p_admin_categories eq 'y'}
    <a href="tiki-admin_categories.php" class="link">{tr}Admin categories{/tr}</a>
  {/if}
  </div>
  </td>
</tr>
{/if}{* $feature_categories eq 'y' *}
