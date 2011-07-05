{* $Header: /cvsroot/tikiwiki/tiki/templates/styles/simple/modules/mod-last_blog_posts.tpl,v 1.1.2.1 2005/11/18 23:21:39 amette Exp $ *}

{if $feature_blogs eq 'y'}
{if $nonums eq 'y'}
{eval var="{tr}Last `$module_rows` blog posts{/tr}" assign="tpl_module_title"}
{else}
{eval var="{tr}Last blog posts{/tr}" assign="tpl_module_title"}
{/if}
{tikimodule title=$tpl_module_title name="last_blog_posts" flip=$module_params.flip decorations=$module_params.decorations}
{if $nonums != 'y'}<ol>{/if}
  {section name=ix loop=$modLastBlogPosts}
       {if $nonums != 'y'}<li>{/if}
         <a class="linkmodule" href="tiki-view_blog.php?blogId={$modLastBlogPosts[ix].blogId}">
           <b>{$modLastBlogPosts[ix].blogTitle}</b>: {$modLastBlogPosts[ix].title}<br />
           {if $modLastBlogPostsTitle eq "title" and $modLastBlogPosts[ix].title}
             {$modLastBlogPosts[ix].title}
           {else}
             {$modLastBlogPosts[ix].created|tiki_short_datetime}
           {/if}
         </a>
	{if $nonums != 'y'}</li>{else}<br />{/if}
  {/section}
{if $nonums != 'y'}</ol>{/if}
{/tikimodule}
{/if}
