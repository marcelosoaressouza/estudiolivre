{include file="blog-heading.tpl" nameOnly="y" title=$blog_data.title creator=$blog_data.user created=$blog_data.created id=$blogId}
<div id="vBlogPost">
	<h2>
		{tr}Viewing blog post{/tr}
	</h2>
	
	{include file="tiki-view_blog_post_item.tpl" text=$parsed_data post=$post_info use_title=$blog_data.use_title showPages=1}
	
	{*
	{if $post_info.trackbacks_from_count > 0}
		<h3>{tr}Trackback pings{/tr}:</h3>
		{cycle values="odd,even" print=false}
		{tr}Title{/tr}
		{tr}URI{/tr}
		{tr}Blog name{/tr}
		
		{foreach from=$post_info.trackbacks_from key=key item=item}
			{$item.title}
			<a href="{$key}" class="link" title="{$key}" target="_blank">
				{$key|truncate:"40"}
			</a>
			{$item.blog_name}
		{/foreach}
	{/if}
	*}
	
	{if $feature_blogposts_comments == 'y'
	  && $blog_data.allow_comments == 'y'
	  && (($tiki_p_read_comments  == 'y'
	  && $comments_cant != 0)
	  ||  $tiki_p_post_comments  == 'y'
	  ||  $tiki_p_edit_comments  == 'y')}
		{include file=comments.tpl}
	{/if}
	
	{if $show_comments}
		<script language="JavaScript">flip('comzone{if $comments_show eq 'y'}open{/if}');</script>
	{/if}
</div>