{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-articles.tpl,v 1.3.12.2 2005/02/23 00:10:20 michael_davey Exp $ *}

{if $feature_articles eq 'y'}
{tikimodule title=$module_title name="articles" flip=$module_params.flip decorations=$module_params.decorations}
  <table  border="0" cellpadding="0" cellspacing="0">
    {section name=ix loop=$modArticles}
    <tr>
      {if $nonums != 'y'}
        <td class="module" valign="top">{$smarty.section.ix.index_next})</td>
      {/if}
      <td class="module">&nbsp;
        <a class="linkmodule" href="tiki-read_article.php?articleId={$modArticles[ix].articleId}">
          {$modArticles[ix].title}
        </a>
        </td>
    </tr>
    {/section}
  </table>
{/tikimodule}
{/if}
