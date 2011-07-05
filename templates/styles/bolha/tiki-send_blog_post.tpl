{css only=tiki-view_blog_post_item,tiki-show_page}
{include file='header.tpl'}

{include file="blog-heading.tpl" nameOnly="y" title=$blog_data.title creator=$blog_data.user created=$blog_data.created id=$blogId postId=$postId}

<h2>{tr}Send blog post{/tr}</h2>

{include file="tiki-view_blog_post_item.tpl" text=$parsed_data post=$post_info use_title=$blog_data.use_title showPages=1}
<br>
{if $sent eq 'y'}
	<h3>{tr}A link to this post was sent to the following addresses:{/tr}</h3>
	<div class="wikitext">
		{$addresses}
	</div>
{else}
	<h3>
		{tr}Send post to this addresses{/tr}
	</h3>
	<form method="post" action="tiki-send_blog_post.php">
		<input type="hidden" name="postId" value="{$postId|escape}" />
		{tr}List of email addresses separated by commas{/tr}
		<br/>
		<textarea cols="60" rows="5" name="addresses">{$addresses|escape}</textarea>
		<br/>
		<input type="submit" name="send" value="{tr}send{/tr}" />
	</form>
{/if}	
<br />


