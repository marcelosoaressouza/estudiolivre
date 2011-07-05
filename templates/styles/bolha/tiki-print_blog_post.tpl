{capture assign='mid_data'}
	{css  only=tiki-view_blog_post_item,print}
	{include file="tiki-print_top_bar.tpl"}	
	{include file="blog-heading.tpl" nameOnly="y" printingPost=1 title=$blog_data.title creator=$blog_data.user created=$blog_data.created id=$blogId postId=$postId}
	
	<h2>{tr}Viewing blog post{/tr}</h2>
	{include file="tiki-view_blog_post_item.tpl" text=$parsed_data post=$post_info use_title=$blog_data.use_title printingPost=1 showPages=1}
	<br/>
{/capture}
{include file='tiki.tpl'}

