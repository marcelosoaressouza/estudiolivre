<!-- tiki-searchresults.tpl begin -->
<div id="searchContainer">


{*if !( $searchNoResults ) }
<h1>{tr}Search results{/tr}:</h1>
{/if*}


{if !( $searchStyle eq "menu" )}

  <div id="searchOptionsCont">

{*
    <a class="linkbut{if $where eq 'pages'} selected{/if}" href="tiki-searchresults.php?highlight={$words}&amp;where=pages">{tr}All{/tr}</a>
*}

    {if $feature_wiki eq 'y'} 
     <a class="linkbut{if $where eq 'wikis'} selected{/if}" href="tiki-searchresults.php?highlight={$words}&amp;where=wikis">{tr}wiki{/tr}</a>
    {/if}
{* isso não rola!!
     <a class="linkbut{if $where eq 'wikis'} selected{/if}" href="el-gallery_search.php?highlight={$words}">{tr}acervo{/tr}</a>
     *}
{*    
    {if $feature_galleries eq 'y'}
     <a class="linkbut{if $where eq 'galleries'} selected{/if}" href="tiki-searchresults.php?highlight={$words}&amp;where=galleries">{tr}galleries{/tr}</a>

     <a class="linkbut{if $where eq 'images'} selected{/if}" href="tiki-searchresults.php?highlight={$words}&amp;where=images">{tr}images{/tr}</a>
    {/if}
    
    {if $feature_file_galleries eq 'y'}
     <a class="linkbut{if $where eq 'files'} selected{/if}" href="tiki-searchresults.php?highlight={$words}&amp;where=files">{tr}files{/tr}</a>
    {/if}
*}
    {if $feature_forums eq 'y'}
     <a class="linkbut{if $where eq 'forums'} selected{/if}" href="tiki-searchresults.php?highlight={$words}&amp;where=forums">{tr}forums{/tr}</a>
    {/if}
{*
    {if $feature_faqs eq 'y'}
     <a class="linkbut{if $where eq 'faqs'} selected{/if}" href="tiki-searchresults.php?highlight={$words}&amp;where=faqs">{tr}faqs{/tr}</a>
    {/if}
    {if $feature_blogs eq 'y'}
     <a class="linkbut{if $where eq 'blogs'} selected{/if}" href="tiki-searchresults.php?highlight={$words}&amp;where=blogs">{tr}blogs{/tr}</a>
     <a class="linkbut{if $where eq 'posts'} selected{/if}" href="tiki-searchresults.php?highlight={$words}&amp;where=posts">{tr}blog posts{/tr}</a>
    {/if}
    {if $feature_directory eq 'y'}
     <a class="linkbut{if $where eq 'directory'} selected{/if}" href="tiki-searchresults.php?highlight={$words}&amp;where=directory">{tr}directory{/tr}</a>
    {/if}

    {if $feature_articles eq 'y'}
     <a class="linkbut{if $where eq 'articles'} selected{/if}" href="tiki-searchresults.php?highlight={$words}&amp;where=articles">{tr}articles{/tr}</a>
    {/if}
*}
  </div>

{/if}

<form class="forms" method="get" action="tiki-searchresults.php">
    {*tr}Find{/tr*} {* <input id="fuser" name="highlight" size="14" type="text" accesskey="s" value="{$words}"/> *}
{*if ( $searchStyle eq "menu" )}
    {tr}in{/tr}
    <select name="where">
    <option value="pages">{tr}entire site{/tr}</option>
    {if $feature_wiki eq 'y'}
       <option value="wikis">{tr}wiki pages{/tr}</option>
    {/if}
    {if $feature_galleries eq 'y'}
       <option value="galleries">{tr}galleries{/tr}</option>
       <option value="images">{tr}images{/tr}</option>
    {/if}
    {if $feature_file_galleries eq 'y'}
       <option value="files">{tr}files{/tr}</option>
    {/if}
    {if $feature_forums eq 'y'}
       <option value="forums">{tr}forums{/tr}</option>
    {/if}
    {if $feature_faqs eq 'y'}
       <option value="faqs">{tr}faqs{/tr}</option>
    {/if}
    {if $feature_blogs eq 'y'}
       <option value="blogs">{tr}blogs{/tr}</option>
       <option value="posts">{tr}blog posts{/tr}</option>
    {/if}
    {if $feature_directory eq 'y'}
       <option value="directory">{tr}directory{/tr}</option>
    {/if}
    {if $feature_articles eq 'y'}
       <option value="articles">{tr}articles{/tr}</option>
    {/if}
    </select>
{else}
    <input type="hidden" name="where" value="{$where|escape}" />
{/if*}
    {* input type="submit" class="wikiaction" name="search" value="{tr}go{/tr}"/> *}

    <input id="searchFieldResults" name="highlight" size="15" type="text" accesskey="s" value="{$words}" /><input class="wikiaction" type="image" name="search" src="styles/estudiolivre/bSearch.png">

</form>


{if $words}
	{if !($searchNoResults) }
		{if $results}
			{tr}Found{/tr} "{$words}" {tr}in{/tr} {$cant_results} {$where2}
			{if !$pageExists}
			<br />
				{if $where ne 'forums' and $user}{tr}Não existe uma página chamada {$words}, mas você pode{/tr} 
					{tooltip text="Clique para criar a página e editá-la"}
						<a href="tiki-editpage.php?page={$words}">{tr}criá-la{/tr}.</a>
					{/tooltip}
					{tooltip name="searchresult-pagina-orfa" text="Nenhuma outra página do wiki levará a essa página. Assim ela estará, de certo modo, inacessível. Para resolver isso basta colocar um link para esta página em alguma outra página"}
					  {tr}(a página será órfã){/tr}
					{/tooltip}</a>
				{/if}
			{/if}
			<br /><br />
		{/if}
		<div id="searchResults">
			{section  name=search loop=$results}
				{assign var=result value=$results[search]}
				{include file="searchresult-item.tpl"}
			{sectionelse}
			<div id="searchNoResults">
				{tr}No pages matched the search criteria{/tr}<br />
				{if $where ne 'forums' and $user}{tr}Você pode colaborar criando a página{/tr} 
					{tooltip text="Clique para criar a página e editá-la"}
						<a href="tiki-editpage.php?page={$words}">{$words}</a>
					{/tooltip}
					{tooltip name="searchresult-pagina-orfa" text="Nenhuma outra página do wiki levará a essa página. Assim ela estará, de certo modo, inacessível. Para resolver isso basta colocar um link para esta página em alguma outra página"}
					  {tr}(a página será órfã){/tr}
					{/tooltip}</a>
				{/if}
			</div>
			{/section}
		</div>
		<div align="center">
		<div class="mini">
	    {if $prev_offset >= 0}
	      [<a class="linkbut"
	      	  href="tiki-searchresults.php?where={$where}&amp;highlight={$words}&amp;offset={$prev_offset}">
	      	  {tr}prev{/tr}
	      	  </a>]
	       &nbsp;
	    {/if}
	{if $cant_pages>0}
		{tr}Page{/tr}: {$actual_page}/{$cant_pages}
	{/if}
	{if $next_offset >= 0}
		&nbsp;[<a class="linkbut"
				    href="tiki-searchresults.php?where={$where}&amp;highlight={$words}&amp;offset={$next_offset}">
				    {tr}next{/tr}
				</a>]
	{/if}
		</div>
	</div>
{/if}

{/if}

</div>

<!-- tiki-searchresults.tpl begin -->