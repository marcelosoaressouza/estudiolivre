{css extra=list}
<div id="blogHead">
	<h1 onmouseover="tooltip('<b>{tr}Blog{/tr} {tr}Created by{/tr}:</b> {$creator} <br><b>{tr} on {/tr}:</b> {$created|date_format:"%H:%M - %d/%m/%y"}')" onmouseout="nd();">
		{tr}Blog{/tr}: <a href="tiki-view_blog.php?blogId={$id}">{$title}</a>
	</h1>
	{if $printingPost}
			{*TODO: mudar pra uma variável ao invés de estudiolivre.org!!!... *}
			<h4><a href="http://www.estudiolivre.org/tiki-view_blog_post.php?blogId={$blogId}&amp;postId={$postId}">http://www.estudiolivre.org/tiki-view_blog_post.php?blogId={$blogId}&amp;postId={$postId}</a></h4>
	{/if}
	{if !$nameOnly}
		<div id="desc">
			{if $smarty.cookies.blogDescCont eq 'block'}
				{assign var=bdisplay value="block"}
				{assign var=bimgCurrent value="Down"}
				{assign var=bimgChange value="Left"}
			{else}
				{assign var=bdisplay value="none"}
				{assign var=bimgCurrent value="Left"}
				{assign var=bimgChange value="Down"}	
			{/if}
				<div class="pointer" id="descFlipper" onclick="javascript:flip('moduleblogDescCont');toggleImage(document.getElementById('TArrowBlogDesc'),'iArrowGrey{$bimgChange}.png');storeState('blogDescCont');">
			        {tr}Description{/tr}<img id="TArrowBlogDesc"  src="styles/{$style|replace:".css":""}/img/iArrowGrey{$bimgCurrent}.png">
				</div>
			<div id="moduleblogDescCont" style="display:{$bdisplay}">
				{$description}
				<h5>{tr}Stats:{/tr} {$posts} {tr}posts{/tr} | {$hits} {tr}visits{/tr} | {tr}Activity={/tr}{$activity|string_format:"%.2f"}</h5>
			</div>
		</div>
		<h4>
			{tr}Last modified{/tr}: {$lastModif|date_format:"%d/%m/%y - %H:%M"}
			{if $rss_blog eq "y"}
				&nbsp;&nbsp;&nbsp;
				<a class="bloglink" href="tiki-blog_rss.php?blogId={$blogId}">
					<img src='styles/estudiolivre/iRss.png' alt='{tr}RSS feed{/tr}' title='{tr}RSS feed{/tr}' />
				</a>
			{/if}
			{if $user and $feature_user_watches eq 'y'}
			<br />
				{if $user_watching_blog eq 'n'}
					<a href="tiki-view_blog.php?blogId={$blogId}&amp;watch_event=blog_post&amp;watch_object={$blogId}&amp;watch_action=add">
						{tr}monitor this blog{/tr}
					</a>
				{else}
					<a href="tiki-view_blog.php?blogId={$blogId}&amp;watch_event=blog_post&amp;watch_object={$blogId}&amp;watch_action=remove">
						{tr}stop monitoring this blog{/tr}
					</a>
				{/if}
			{/if}
		</h4>
		<div id="edit">
				{if $tiki_p_blog_post eq "y"}
					{if ($user and $creator eq $user) or $tiki_p_blog_admin eq "y" or $public eq "y"}
						<a class="bloglink" href="tiki-blog_post.php?blogId={$blogId}">
							{tr}Post{/tr}
						</a>
					{/if}
				{/if}
				{if $tiki_p_blog_post eq "y" and (($user and $creator eq $user) or $tiki_p_blog_admin eq "y")}
				&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
				{/if}
				{if ($user and $creator eq $user) or $tiki_p_blog_admin eq "y"}
					<a class="bloglink" href="tiki-edit_blog.php?blogId={$blogId}">
						{tr}Edit blog{/tr}
					</a>
				{/if}
		</div>
	{/if}
</div>
