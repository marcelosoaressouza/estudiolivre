{* $Header: /cvsroot/arca/estudiolivre/src/templates/styles/estudiolivre/modules/mod-user_blogs.tpl,v 1.2 2006-07-21 11:14:42 rhwinter Exp $ *}

{if $user}
    {if $feature_blogs eq 'y'}
		{tikimodule title="{tr}My blogs{/tr}" name="user_blogs" flip=$module_params.flip}
			{section name=ix loop=$modUserBlogs}
			    <a href="tiki-view_blog.php?blogId={$modUserBlogs[ix].blogId}">{$modUserBlogs[ix].title|truncate:20:"(...)"}</a>
			    <a class="modBlogPost" href="tiki-blog_post.php?blogId={$modUserBlogs[ix].blogId}">({tr}post{/tr})</a>
			    <br/>
			{/section}
		{/tikimodule}
    {/if}
{/if}
