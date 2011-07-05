{* $Header: /cvsroot/tikiwiki/tiki/templates/styles/simple/modules/mod-search_box.tpl,v 1.1.2.1 2006/07/24 14:40:47 luciash Exp $ *}

{if $feature_search eq 'y'}
{tikimodule title="{tr}Search{/tr}" name="search_box" flip=$module_params.flip decorations=$module_params.decorations}
    <form class="forms" method="get" action="tiki-searchresults.php">
    <input id="fuser" name="highlight" size="14" type="text" accesskey="s" /> {tr}in:{/tr}<br />
    <select name="where">
    <option value="pages">{tr}Entire Site{/tr}</option>
    {if $feature_wiki eq 'y'}
    <option value="wikis">{tr}Wiki Pages{/tr}</option>
    {/if}
    {if $feature_directory eq 'y'}
    <option value="directory">{tr}Directory{/tr}</option>
    {/if}
    {if $feature_galleries eq 'y'}
    <option value="galleries">{tr}Image Gals{/tr}</option>
    <option value="images">{tr}Images{/tr}</option>
    {/if}
    {if $feature_file_galleries eq 'y'}
    <option value="files">{tr}Files{/tr}</option>
    {/if}
    {if $feature_articles eq 'y'}
    <option value="articles">{tr}Articles{/tr}</option>
    {/if}
    {if $feature_forums eq 'y'}
    <option value="forums">{tr}Forums{/tr}</option>
    {/if}
    {if $feature_blogs eq 'y'}
    <option value="blogs">{tr}Blogs{/tr}</option>
    <option value="posts">{tr}Blog Posts{/tr}</option>
    {/if}
    {if $feature_faqs eq 'y'}
    <option value="faqs">{tr}FAQs{/tr}</option>
    {/if}
    </select>
    <button type="submit" class="wikiaction" name="search" >{tr}go{/tr}</button> 
    </form>
{/tikimodule}
{/if}
