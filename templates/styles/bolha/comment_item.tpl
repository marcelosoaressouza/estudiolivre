{css extra=el-user_msg}
{if $comment.doNotShow != 1 }
	<a name="threadId{$comment.threadId}"></a>
	<div class="comment">
		<div class="commentTitle">
			<a href="{$comments_complete_father}comments_parentId={$comment.threadId}&amp;comments_maxComments=1&amp;comments_style={$comments_style}">
				{$comment.title}
		   	</a>
		</div>

	    <div class="uMsgAvatar">
	       	<a href="el-user.php?view_user={$comment.userName}">
	       		<img src="tiki-show_user_avatar.php?user={$comment.userName}">
	       	</a>
	    </div>
		<div class="uMsgTxt">
			{if !$previevingComm}
				<div class="uMsgDel">
			       	{if ($tiki_p_remove_comments eq 'y' && $forum_mode ne 'y') || ($tiki_p_admin_forum eq 'y' and $forum_mode eq 'y')}  	
			        	 {tooltip text="Deletar Comentario"}
			        	 	<a class="pointer" href="{$comments_complete_father}comments_threshold={$comments_threshold}&amp;comments_threadId={$comment.threadId}&amp;comments_remove=1&amp;comments_offset={$comments_offset}&amp;comments_sort_mode={$comments_sort_mode}&amp;comments_maxComments={$comments_maxComments}&amp;comments_parentId={$comments_parentId}&amp;comments_style={$comments_style}">
			        	 		<img alt="" src="styles/{$style|replace:".css":""}/img/iWikiRemove.png">
			        	 	</a>
			        	 {/tooltip}
			       	{/if}
			       	<br/>
					{if $tiki_p_edit_comments eq 'y' || $user == $comment.userName || ($tiki_p_admin_forum eq 'y' and $forum_mode eq 'y')}
						{tooltip text="Editar Comentario"}
							<a href="{$comments_complete_father}comments_threadId={$comment.threadId}&amp;comments_threshold={$comments_threshold}&amp;comments_offset={$comments_offset}&amp;comments_sort_mode={$comments_sort_mode}&amp;comments_maxComments={$comments_maxComments}&amp;comments_parentId={$comments_parentId}&amp;comments_style={$comments_style}&amp;edit_reply=1#form">
								<img src="styles/{$style|replace:".css":""}/img/iWikiEdit.png"/>
							</a>
						{/tooltip}				
					{/if}
			    </div>
		    {/if}
		    <div class="uMsgDate">
				{$comment.commentDate|date_format:"%H:%M"}<br />
			    {$comment.commentDate|date_format:"%d/%m/%Y"}
			</div>
	   		{$comment.parsed}
		</div>
		{if !$previevingComm}		
			<div class="commReply">
		        {if ($tiki_p_post_comments == 'y' and $forum_mode ne 'y') or ($tiki_p_forum_post eq 'y' and $forum_mode eq 'y') }
					{if $forum_mode neq 'y'}
						<a class="linkbut" href="{$comments_complete_father}comments_threshold={$comments_threshold}&amp;comments_reply_threadId={$comment.threadId}&amp;comments_offset={$comments_offset}&amp;comments_sort_mode={$comments_sort_mode}&amp;comments_maxComments={$comments_maxComments}&amp;comments_grandParentId={$comment.parentId}&amp;comments_parentId={$comment.threadId}&amp;comments_style={$comments_style}&amp;post_reply=1#form">{tr}reply{/tr}</a>
					{else}
				   		{if $comments_grandParentId}
							<a class="linkbut" href="{$comments_complete_father}comments_threshold={$comments_threshold}&amp;comments_reply_threadId={$comment.threadId}&amp;comments_offset={$comments_offset}&amp;comments_sort_mode={$comments_sort_mode}&amp;comments_maxComments={$comments_maxComments}&amp;comments_grandParentId={$comments_grandParentId}&amp;comments_parentId={$comments_grandParentId}&amp;comments_style={$comments_style}&amp;post_reply=1#form">{tr}reply{/tr}</a>
				   		{else}
						  	<a class="linkbut" href="{$comments_complete_father}comments_threshold={$comments_threshold}&amp;comments_reply_threadId={$comment.threadId}&amp;comments_offset={$comments_offset}&amp;comments_sort_mode={$comments_sort_mode}&amp;comments_maxComments={$comments_maxComments}&amp;comments_grandParentId={$comment.parentId}&amp;comments_parentId={$comment.parentId}&amp;comments_style={$comments_style}&amp;post_reply=1#form">{tr}reply{/tr}</a>
						{/if}
				    {/if}
				{/if}
			</div>
		{/if}	
		
		{if ($comments_style != 'commentStyle_headers') and !$previevingComm}
			<br />
			{if count($comment.attachments) > 0}
				{section name=ix loop=$comment.attachments}
					<a class="link" href="tiki-download_forum_attachment.php?attId={$comment.attachments[ix].attId}">
					<img src="img/icons/attachment.gif" border="0" width="10" height= "13" alt='{tr}attachment{/tr}' />
					{$comment.attachments[ix].filename} ({$comment.attachments[ix].filesize|kbsize})</a>
					{if $tiki_p_admin_forum eq 'y'}
						<a class="link" href="tiki-view_forum_thread.php?topics_offset={$smarty.request.topics_offset}&amp;topics_sort_mode={$smarty.request.topics_sort_mode}&amp;topics_find={$smarty.request.topics_find}&amp;topics_threshold={$smarty.request.topics_threshold}&amp;comments_offset={$smarty.request.topics_offset}&amp;comments_sort_mode={$smarty.request.topics_sort_mode}&amp;comments_threshold={$smarty.request.topics_threshold}&amp;comments_find={$smarty.request.topics_find}&amp;forumId={$forum_info.forumId}&amp;comments_maxComments={$comments_maxComments}&amp;comments_parentId={$comments_parentId}&amp;remove_attachment={$comment.attachments[ix].attId}">
						<img src="img/icons2/delete.gif" border="0" width="16" height="16" alt='{tr}Remove{/tr}' />
						</a>
					{/if}
					<br />
				{/section}
			{/if}
		{/if}
	
		{if $comment.replies_info.numReplies > 0 && $comment.replies_info.numReplies != '' && !$previevingComm}
			{foreach from=$comment.replies_info.replies item="comment" name="com"}
			    <div class="subcomment">
					{include file="comment_item.tpl"  comment=$comment}
			    </div>
			  {/foreach}
		{/if}
	</div>
{else}
    {if $comment.replies_info.numReplies > 0 && $comment.replies_info.numReplies != ''}
		{foreach from=$comment.replies_info.replies item="comment"}
		    {include file="comment_item.tpl"  comment=$comment}
		{/foreach}
    {/if}
{/if}