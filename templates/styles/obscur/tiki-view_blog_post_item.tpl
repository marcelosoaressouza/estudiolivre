<div class="blogpost">
	<div class="posthead">
		{if !$printingPost}
			<div class="icons">
				{if ($ownsblog eq 'y') or ($user and $post.user eq $user) or $tiki_p_blog_admin eq 'y'}
					<a class="blogt" href="tiki-blog_post.php?blogId={$post.blogId}&amp;postId={$post.postId}">
						<img src="styles/estudiolivre/iWikiEdit.png" alt="{tr}Edit{/tr}"/>
					</a>
					<a class="blogt" href="tiki-view_blog.php?blogId={$blogId}&amp;remove={$post.postId}">
						<img src="styles/estudiolivre/iWikiRemove.png" alt="{tr}Remove{/tr}"/>
					</a>
				{/if}
				{if $user and $feature_notepad eq 'y' and $tiki_p_notepad eq 'y'}
					<a title="{tr}Save to notepad{/tr}" href="tiki-view_blog.php?blogId={$blogId}&amp;savenotepad={$post.postId}">
						<img src="styles/estudiolivre/iSave.png" alt="{tr}Save{/tr}"/>
					</a>
				{/if}
				<a href='tiki-send_blog_post.php?postId={$post.postId}'>
					<img src="styles/estudiolivre/iEmail.png" alt="{tr}email this post{/tr}"/>
				</a>
				<a href='tiki-print_blog_post.php?postId={$post.postId}'>
					<img src="styles/estudiolivre/iWikiPrint.png" alt="{tr}print{/tr}" />
				</a>
			</div>				
		{/if}
		{if $use_title eq 'y'}
			<h1>
				{$post.title}
			</h1>
		{else}
			<h1>
				{$post.created|tiki_short_datetime}
			</h1>
		{/if}		
	</div>
	<div class="postbody">
		{$text}
		{if $pages > 1 && $showPages}
			<div align="center">
				<a href="tiki-view_blog_post.php?blogId={$smarty.request.blogId}&amp;postId={$smarty.request.postId}&amp;page={$first_page}">
					<img src='img/icons2/nav_first.gif' border='0' alt='{tr}First page{/tr}' title='{tr}First page{/tr}' />
				</a>
		
				<a href="tiki-view_blog_post.php?blogId={$smarty.request.blogId}&amp;postId={$smarty.request.postId}&amp;page={$prev_page}">
					<img src='img/icons2/nav_dot_right.gif' border='0' alt='{tr}Previous page{/tr}' title='{tr}Previous page{/tr}' />
				</a>
		
				{tr}page{/tr}: {$pagenum}/{$pages}
		
				<a href="tiki-view_blog_post.php?blogId={$smarty.request.blogId}&amp;postId={$smarty.request.postId}&amp;page={$next_page}">
					<img src='img/icons2/nav_dot_left.gif' border='0' alt='{tr}Next page{/tr}' title='{tr}Next page{/tr}' />
				</a>
		
				<a href="tiki-view_blog_post.php?blogId={$smarty.request.blogId}&amp;postId={$smarty.request.postId}&amp;page={$last_page}">
					{html_image file='img/icons2/nav_last.gif' border='0' alt='{tr}Last page{/tr}' title='{tr}Last page{/tr}'}
				</a>
			</div>
		{/if}
	</div>
		<h4>
			<span>
				tags:
				<em>
					{foreach from=$post.tags item=tag name=tags}
					{tooltip text="Clique para ver outros arquivos com a tag <b>"|cat:$tag|cat:"</b>"}<a href="tiki-browse_freetags.php?tag={$tag}">{$tag}</a>{if not $smarty.foreach.tags.last}, {/if}
					{/tooltip}
					{foreachelse}
						{tr}Esse arquivo não tem tags{/tr}.
					{/foreach}
				</em>
			</span>
		</h4>
	<div class="postbottom">
		{tr}posted by{/tr}:<i> <a href="el-user.php?view_user={$post.user}">{$post.user}</a></i>
		{*if $show_avatar eq 'y'}
			{$post.avatar}
		{/if*} 
		{if $use_title eq 'y'}
			 {tr}on{/tr}: <i>{$post.created|date_format:"%H:%M - %d/%m"}</i>
		{/if}
		
		{if !$printingPost}
			&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
			{if $post.pages > 1}
				<a class="link" href="tiki-view_blog_post.php?blogId={$blogId}&amp;postId={$post.postId}">
				{tr}read more{/tr} ({$post.pages} {tr}pages{/tr})
				</a>
				&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
			{/if}
			<a class="link" href="tiki-view_blog_post.php?blogId={$blogId}&amp;postId={$post.postId}">
				{tr}permalink{/tr}
			</a>

			{*
			({tr}referenced by{/tr}: {$post.trackbacks_from_count} {tr}posts{/tr} / {tr}references{/tr}: {$post.trackbacks_to_count} {tr}posts{/tr})
			*}
			
			{if $allow_comments eq 'y' and $feature_blogposts_comments eq 'y'}
				{if $post.comments > 0}
					&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
					<a class="link" href="tiki-view_blog_post.php?find={$find}&amp;blogId={$blogId}&amp;offset={$offset}&amp;sort_mode={$sort_mode}&amp;postId={$post.postId}&amp;show_comments=1">
						({$post.comments}) {if $post.comments == 1}{tr}comment{/tr}{else}{tr}comments{/tr}{/if}
					</a>
				{/if}
				&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				<a class="link" href="tiki-view_blog_post.php?find={$find}&amp;blogId={$blogId}&amp;offset={$offset}&amp;sort_mode={$sort_mode}&amp;postId={$post.postId}&amp;show_comments=1">
					{tr}add comment{/tr}
				</a>
			{/if}

			{if $feature_blogposts_comments == 'y'
			  && $blog_data.allow_comments == 'y'
			  && (($tiki_p_read_comments  == 'y'
			  && $comments_cant != 0)
			  ||  $tiki_p_post_comments  == 'y'
			  ||  $tiki_p_edit_comments  == 'y')}
				&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				<a href="#comments" onclick="javascript:flip('comzone{if $comments_show eq 'y'}open{/if}');" class="linkbut">
					{if $comments_cant == 1}
						<span class="highlight">{tr}1 comment{/tr}</span>
					{else}
					    <span class="highlight">{$comments_cant} {tr}comments{/tr}</span>
				    {/if}
				</a>
				    &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				<a href="#comments" onclick="javascript:flip('comzone{if $comments_show eq 'y'}open{/if}');" class="linkbut">
				    {tr}add comment{/tr}
				</a>
			{/if}
		{/if}			
	</div>
	{* inclui os comentários caso estejamos imprimindo *}
	{if $printingPost && !$previewingPost}
					{if $feature_blogposts_comments == 'y'
				  && $blog_data.allow_comments == 'y'
				  && (($tiki_p_read_comments  == 'y'
				  && $comments_cant != 0)
				  ||  $tiki_p_post_comments  == 'y'
				  ||  $tiki_p_edit_comments  == 'y')}
						{include file=comments.tpl comments_show='y' tiki_p_post_comments='n'}
				{/if}
	{/if}
</div>