{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-search_wiki_page_new.tpl,v 1.1.2.1 2005/03/01 23:09:55 michael_davey Exp $ *}

{tikimodule title="{tr}Search Wiki PageName{/tr}" name="search_wiki_page" flip=$module_params.flip decorations=$module_params.decorations}
  <form class="forms" method="post" action="tiki-listpages.php">
    <input name="find" size="14" type="text" accesskey="s" value="{$find}"/>
    {tr}Exact&nbsp;match{/tr}<input type="checkbox" name="exact_match" {if $exact_match ne 'n'}checked="checked"{/if}/>
    <input type="submit" class="wikiaction" name="search" value="{tr}go{/tr}"/> 
  </form>
{/tikimodule}
