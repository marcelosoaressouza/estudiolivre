<span class="categpath">
{foreach name=u key=k item=i from=$catp}
<a href="tiki-browse_categories.php?parentId={$k}" title="{tr}browse category{/tr}">{$i|replace:' ':'&nbsp;'}</a>{if !$smarty.foreach.u.last}&nbsp;{$site_crumb_seper|escape:"html"}&nbsp;{/if}
{/foreach}
</span>
|
