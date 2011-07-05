{css}
<div class="forumpost">
	<h1>
		{tr}Forum{/tr}:
		<a href="tiki-view_forum.php?topics_offset={$smarty.request.topics_offset}{$topics_sort_mode_param}{$topics_threshold_param}{$topics_find_param}&amp;forumId={$forum_info.forumId}" class="pagetitle">
			{$forum_info.name}
		</a>
	</h1>
	
	<h5>
		{if ($prev_topic and $prev_topic ne $comments_parentId) or $next_topic}
			{if $prev_topic and $prev_topic ne $comments_parentId}
				<a href="tiki-view_forum_thread.php?forumId={$forumId}&amp;comments_parentId={$prev_topic}&amp;topics_offset={$topics_prev_offset}{$topics_sort_mode_param}{$topics_threshold_param}{$topics_find_param}{$comments_maxComments_param}{$comments_style_param}{$comments_sort_mode_param}{$comments_threshold_param}" class="link">
					{tr}prev topic{/tr}
				</a>
				{if $next_topic} | {/if}
			{/if}
			{if $next_topic}
				<a href="tiki-view_forum_thread.php?forumId={$forumId}&amp;comments_parentId={$next_topic}&amp;topics_offset={$topics_next_offset}{$topics_sort_mode_param}{$topics_threshold_param}{$topics_find_param}{$comments_maxComments_param}{$comments_style_param}{$comments_sort_mode_param}{$comments_threshold_param}" class="link">
					{tr}next topic{/tr}</a>
			{/if}
		{/if}
	</h5>
	
	<div id="edit">
		{if $tiki_p_admin_forum eq "y"}
			<a class="linkbut" title="{tr}Edit Forum{/tr}" href="tiki-admin_forums.php?forumId={$forumId}">{tr}Edit Forum{/tr}</a><br />
		{/if}
	</div>
	
	{if $feature_freetags eq 'y' and $tiki_p_view_freetags eq 'y' and isset($freetags.data[0])}
		{include file="freetag_list.tpl"}
	{/if}

	<div>
		<div class="posthead">
			<div class="icons">
				{if $tiki_p_admin_forum eq 'y' or $thread_info.userName == $user}
					<a href="tiki-view_forum.php?comments_offset={$smarty.request.topics_offset}{$comments_sort_mode_param}&amp;comments_threshold={$smarty.request.topics_threshold}{$comments_find_param}&amp;comments_threadId={$thread_info.threadId}&amp;openpost=1&amp;forumId={$forum_info.forumId}{$comments_maxComments_param}"
					class="admlink">
						<img src="styles/{$style|replace:".css":""}/img/iWikiEdit.png" alt="{tr}Edit{/tr}"/>
					</a>
				{/if}
				{if $tiki_p_admin_forum eq 'y'}
					<a href="tiki-view_forum.php?comments_offset={$smarty.request.topics_offset}{$comments_sort_mode_param}&amp;comments_threshold={$smarty.request.topics_threshold}{$comments_find_param}&amp;comments_remove=1&amp;comments_threadId={$thread_info.threadId}&amp;forumId={$forum_info.forumId}{$comments_maxComments_param}"
					class="admlink">
						<img src="styles/{$style|replace:".css":""}/img/iWikiRemove.png" alt="{tr}Remove{/tr}"/>
					</a>
				{/if}     
				{if $user and $feature_notepad eq 'y' and $tiki_p_notepad eq 'y'}
					<a title="{tr}Save to notepad{/tr}" href="tiki-view_forum_thread.php?topics_offset={$smarty.request.topics_offset}{$topics_sort_mode_param}{$topics_threshold_param}{$topics_find_param}&amp;comments_parentId={$comments_parentId}&amp;forumId={$forumId}{$comments_threshold_param}&amp;comments_offset={$comments_offset}{$comments_sort_mode_param}{$comments_maxComments_param}&amp;savenotepad={$thread_info.threadId}">
						<img src="styles/{$style|replace:".css":""}/img/iSave.png" alt="{tr}Save{/tr}"/>
					</a>
				{/if}
			</div>
			<h1 id="threadTitle">
					<span style="float:left">{$thread_info.userName|avatarize}</span>{$thread_info.title}
			</h1>
		</div>
	</div>	  
	
	<div class="postbody">	  
		{$thread_info.parsed}
	</div>
	
	<div class="postbottom">
		{tr}posted by{/tr}:<i>{$thread_info.userName|userlink}</i>
		{tr}on{/tr}: <i>{$thread_info.commentDate|date_format:"%H:%M - %d/%m"}</i>
	
		{if count($thread_info.attachments) > 0}
			{section name=ix loop=$thread_info.attachments}
				<a class="link" href="tiki-download_forum_attachment.php?attId={$thread_info.attachments[ix].attId}">
					<img src="img/icons/attachment.gif" border="0" width="10" height= "13" alt='{tr}attachment{/tr}' />
					{$thread_info.attachments[ix].filename} ({$thread_info.attachments[ix].filesize|kbsize})
				</a>
				{if $tiki_p_admin_forum eq 'y'}
					<a class="link" href="tiki-view_forum_thread.php?topics_offset={$smarty.request.topics_offset}{$topics_sort_mode_param}{$topics_find_param}{$topics_threshold_param}&amp;comments_offset={$smarty.request.topics_offset}{$comments_sort_mode_param}&amp;comments_threshold={$smarty.request.topics_threshold}{$comments_find_param}&amp;forumId={$forum_info.forumId}{$comments_maxComments_param}&amp;comments_parentId={$comments_parentId}&amp;remove_attachment={$thread_info.attachments[ix].attId}">
						<img src='img/icons2/delete.gif' border='0' alt='{tr}remove{/tr}' title='{tr}remove{/tr}' />
					</a>					
				{/if}
				<br />
			{/section}
		{/if}
		&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
		{tr}reads{/tr}: <i>{$thread_info.hits}</i>
		&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
		{if $tiki_p_forum_post eq 'y'}
			<a class="linkbut" href="#form" onclick="flip('comzone')">{tr}reply{/tr}</a>
		{/if}
	</div>
	
	{include file="comments.tpl"}
	
	{if $comments_threshold ne 0}
		<small>
			{$comments_below} {tr}Comments below your current threshold{/tr}
		</small>
	{/if}
</div>