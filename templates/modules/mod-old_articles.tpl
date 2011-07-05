{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-old_articles.tpl,v 1.7.10.1 2005/02/23 21:12:46 michael_davey Exp $ *}

{if $feature_articles eq 'y'}
{tikimodule title="{tr}Old articles{/tr}" name="old_articles" flip=$module_params.flip decorations=$module_params.decorations}
<table  border="0" cellpadding="0" cellspacing="0">
{section name=ix loop=$modOldArticles}
<tr><td   class="module">{$smarty.section.ix.index_next})&nbsp;<a class="linkmodule" href="tiki-read_article.php?articleId={$modOldArticles[ix].articleId}">{$modOldArticles[ix].title}</a></td></tr>
{/section}
</table>
{/tikimodule}
{/if}
