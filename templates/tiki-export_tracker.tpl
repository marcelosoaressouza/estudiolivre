"status","itemId","categories",{foreach item=x key=ix from=$listfields}"{$x.name} -- {$ix}",{/foreach}
{section name=user loop=$items}

"{$items[user].status}","{$items[user].itemId}","{$items[user].categs}",{
section name=ix loop=$items[user].field_values}{

if $items[user].field_values[ix].type eq 'a'}
"{$items[user].field_values[ix].value|replace:"\r\n":"%%%"}",{
else}
"{$items[user].field_values[ix].value}",{/if}
{/section}
{/section}

