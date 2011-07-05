<div id="vBlog">
	{*this is really nasty stuff!
	if strlen($heading) > 0}
		{eval var=$heading}
	{else}
	{/if*}
	
	{include file="blog-heading.tpl"}
	
	{*this too!
	 if $use_find eq 'y'}
		<div class="blogtools">
			<form action="tiki-view_blog.php" method="get">
			<input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
			<input type="hidden" name="blogId" value="{$blogId|escape}" />
			{tr}Find:{/tr}
			 <input type="text" name="find" /> <input type="submit" name="search" value="{tr}find{/tr}" />
			</form>
		</div>
	{/if *}
	
	{section name=ix loop=$listpages}
		{include file="tiki-view_blog_post_item.tpl" post=$listpages[ix] text=$listpages[ix].parsed_data}
	{/section}
	<br />

	<div class="paginacao">
		{if $prev_offset >= 0}
			<a class="prevnext" href="tiki-view_blog.php?find={$find}&amp;blogId={$blogId}&amp;offset={$prev_offset}&amp;sort_mode={$sort_mode}">
				<img src="styles/estudiolivre/iArrowGreyLeft.png">
			</a>
		{/if}
		
		{tr}Page{/tr} {$actual_page} {tr}de{/tr} {$cant_pages}
		
		{if $next_offset >= 0}
			<a class="prevnext" href="tiki-view_blog.php?find={$find}&amp;blogId={$blogId}&amp;offset={$next_offset}&amp;sort_mode={$sort_mode}">
				<img src="styles/estudiolivre/iArrowGreyRight.png">
			</a>
		{/if}
		{if $direct_pagination eq 'y'}
			<br />
			{section loop=$cant_pages name=foo}
				{assign var=selector_offset value=$smarty.section.foo.index|times:$maxRecords}
					<a class="prevnext" href="tiki-view_blog.php?find={$find}&amp;blogId={$blogId}&amp;offset={$selector_offset}&amp;sort_mode={$sort_mode}">
				{$smarty.section.foo.index_next}</a>
			{/section}
		{/if}
	</div>
	{* isso aqui só confunde tudo... (vou tirar e ver no que dá!)
	<hr>
	{if $feature_blog_comments == 'y'
	  && (($tiki_p_read_comments  == 'y'
	  && $comments_cant != 0)
	  ||  $tiki_p_post_comments  == 'y'
	  ||  $tiki_p_edit_comments  == 'y')}
		<div id="comments">
			<a href="#comments" onclick="javascript:flip('comzone{if $comments_show eq 'y'}open{/if}');" class="linkbut">
				{if $comments_cant == 0}
			        {tr}add comment{/tr}
			        {elseif $comments_cant == 1}
			          <span class="highlight">{tr}1 comment{/tr}</span>
			        {else}
			          <span class="highlight">{$comments_cant} {tr}comments{/tr}</span>
			        {/if}
			</a>
		</div>
		{include file=comments.tpl}
	{/if}
	<hr>
	*}
</div>