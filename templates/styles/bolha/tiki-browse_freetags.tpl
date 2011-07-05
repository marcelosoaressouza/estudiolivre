{css extra=el-gallery_list_item,el-gallery_list_filters}
<!-- tiki-browse_freetags.tpl Begin -->

<div id="browseFreeTags">

{* if $feature_ajax eq 'y'}
	<script src="lib/cpaint/cpaint2.inc.compressed.js" type="text/javascript"></script>
	<script src="lib/freetag/freetag_ajax.js" type="text/javascript"></script>
{/if *}

{if $feature_morcego eq 'y' and $freetags_feature_3d eq 'y'}
	{include file="browseRelatedTags.tpl"}
{/if}

<h2>{tr}Ítens com a tag{/tr}: <span id="currentTag2">{$tag}</span></h2>

<ul class="listFiltersButtons">
	<img id="listFilterImg0" alt="" src="styles/{$style|replace:".css":""}/img/bLeft{if !$type}Act{else}Inac{/if}.png" />	
	{tooltip name="browse-freetags-all" text="Ver todos os Itens com a tag"}
		<li class="button{if !$type}Active{else}Inactive{/if}"><a class="linkbut {if $type eq ''} highlight{/if}"  href="tiki-browse_freetags.php?tag={$tag}" id="typeAll">{tr}All{/tr}</a></li>
	{/tooltip}
	
    {if $feature_wiki eq 'y'}
    	{tooltip name="browse-freetags-all" text="Ver <strong>apenas</strong> <b>paginas wiki</b> com a tag"} 
    		<li class="button{if $type eq 'wiki page'}Active{else}Inactive{/if}"><a class="linkbut {if $type eq "wiki page"} highlight{/if}"  href="tiki-browse_freetags.php?tag={$tag}&amp;type=wiki%20page" id="typeWikiPage">{tr}Wiki pages{/tr}</a></li>
    	{/tooltip}
    {/if}
    
    {if $feature_blogs eq 'y'}
    	{tooltip name="browse-freetags-all" text="Ver <strong>apenas</strong> <b>posts em blogs</b> com a tag"} 
    		<li class="button{if $type eq 'blog post'}Active{else}Inactive{/if}"><a class="linkbut {if $type eq "blog post"} highlight{/if}"  href="tiki-browse_freetags.php?tag={$tag}&amp;type=blog post" id="typeBlogPost">{tr}Posts em blog{/tr}</a></li>
    	{/tooltip}
    {/if}

    {tooltip name="browse-freetags-all" text="Ver <strong>apenas</strong> <b>publicações</b> com a tag"}     
		<li class="button{if $type eq 'gallery'}Active{else}Inactive{/if} buttonInactiveRight"><a class="linkbut" href="tiki-browse_freetags.php?tag={$tag}&amp;type=gallery">{if $type eq 'gallery'}<span class="highlight">{/if}{tr}Acervo{/tr}{if $type eq 'gallery'}</span>{/if}</a></li>
		
	{/tooltip}
	<img id="listFilterImg4" alt="" src="styles/{$style|replace:".css":""}/img/bRight{if $type eq 'gallery'}Act{else}Inac{/if}.png" />
</ul>
     
{if $cantobjects eq 0}
  <h3>nenhum resultado</h3>
{else}
  <h3>{$cantobjects} {tr}resultado{/tr}{if $cantobjects != 1}s{/if} {include file="browseFreeTags-pagination.tpl"}</h3>

  {cycle values="odd,even" print=false}
  {section name=ix loop=$objects}

    {if $objects[ix].type eq 'gallery'}
		{el_gallery_item id=$objects[ix].itemId}
    {elseif $objects[ix].type eq 'blog post'}
		<a href="{$objects[ix].href}" class="catname">{$objects[ix].name}</a><br/>
		{$objects[ix].description|truncate:250}
    {else}
    	{el_wiki_item id=$objects[ix].itemId}
    {/if}
 
  {/section}
  
  {include file="browseFreeTags-pagination.tpl"}
{/if}

</div>
<!-- tiki-browse_freetags.tpl End -->