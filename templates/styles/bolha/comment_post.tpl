{css}
{assign var=postclass value='comzone'}
{if $user}
   {if $forum_mode eq 'y'}
		{if $post_reply > 0 || $edit_reply > 0 || $comment_preview eq 'y'}
			{* posting a reply or editing or previwing a reply: show form *}
			<div id='{$postclass}' class="threadpost" >
		{else}
			<div id='{$postclass}' class="threadpost" style="display:none">
		{/if}
   {/if}
	<a name="form"></a>
   	<div class="comMainTitle">
		    {if $forum_mode eq 'y'}
			    {if $comments_threadId > 0}
			    	{tr}Editing reply{/tr}
			    {elseif $parent_com}
			    	{tr}Reply to the selected post{/tr}
		    	{else}
		    		{tr}Post new message{/tr}
		    	{/if}
	    	{else}
		    	{if $comments_threadId > 0}
		    		{tr}Editing comment{/tr}
		    	{elseif $parent_com}
		    		{tr}Comment on the selected post{/tr}
		    	{else}
		    		{tr}Post new comment{/tr}
		    	{/if}
		    {/if}
   	</div>
<div id="comPostCont">
	{if $comment_preview eq 'y'}
		{tr}Preview{/tr}
		<div class="commPreview">
			{php}
			 	global $smarty;
				$vars=$smarty->_tpl_vars;
				
				$useComm = array( "title" => $vars["comments_preview_title"],
						   		  "commentDate" => time(),
							      "parsed" => $vars["comments_preview_data"],
							      "userName" => $vars["user"]
				);
				
				$smarty->assign('useComm',$useComm);
			{/php}
			{include file="comment_item.tpl" previewingComm=1 comment=$useComm}
		</div>
	{/if}


    <form enctype="multipart/form-data" method="post" action="{$comments_father}" id='editpostform'>
	    <input type="hidden" name="comments_reply_threadId" value="{$comments_reply_threadId|escape}" />    
	    <input type="hidden" name="comments_grandParentId" value="{$comments_grandParentId|escape}" />    
	    <input type="hidden" name="comments_parentId" value="{$comments_parentId|escape}" />
	    <input type="hidden" name="comments_offset" value="{$comments_offset|escape}" />
	    <input type="hidden" name="comments_threadId" value="{$comments_threadId|escape}" />
	    <input type="hidden" name="comments_threshold" value="{$comments_threshold|escape}" />
	    <input type="hidden" name="comments_sort_mode" value="{$comments_sort_mode|escape}" />
	    {* Traverse request variables that were set to this page adding them as hidden data *}
    	{section name=i loop=$comments_request_data}
	    	<input type="hidden" name="{$comments_request_data[i].name|escape}" value="{$comments_request_data[i].value|escape}" />
    	{/section}
  		
  		{if $parent_coms}
				{tr}Reply to parent post{/tr}
		{else}
				{if $forum_mode eq 'y'}
					{tr}Reply{/tr}
				{/if}
		{/if}
		
		<h3>{tr}Title{/tr}</h3>
  		<input type="text" size="40" name="comments_title" id="comments-title" value="{$comment_title|escape}" />

  		{*include file="textareasize.tpl" area_name='editpost2' formId='editpostform'*}

		{if $quicktags}
			{include file=tiki-edit_help_tool.tpl area_name='editpost2'}
      	{/if}

      	<br>
      	
	   	<h3>
	   	{if $forum_mode eq 'y'}
	      	{tr}Reply{/tr}
	   	{else}
	      	{tr}Comment{/tr}
	   	{/if}
	   	</h3>
  		<textarea id="editpost2" name="comments_data" rows="{$rows}" cols="{$cols}">{$comment_data|escape}</textarea>
  				
		<input type="hidden" name="rows" value="{$rows}"/>
		<input type="hidden" name="cols" value="{$cols}"/>

		{if $forum_mode == "y" and (($forum_info.att eq 'att_all') or ($forum_info.att eq 'att_admin' and ($tiki_p_admin_forum eq 'y'  or $forum_info.moderator == $user)) or ($forum_info.att eq 'att_perm' and $tiki_p_forum_attach eq 'y'))}
			{tr}Attach file{/tr}
			<input type="hidden" name="MAX_FILE_SIZE" value="{$forum_info.att_max_size|escape}" />
			<input name="userfile1" type="file" />
		{/if}
		<div id="comButtons">
			<input type="submit" name="comments_previewComment" value="{tr}preview{/tr}"/>
			<input type="submit" name="comments_postComment" value="{tr}post{/tr}"/>
			
			{if $forum_mode eq 'y'}
				<input type="button" name="comments_cancelComment" value="{tr}cancel{/tr}" onclick="hide('{$postclass}');"/>
		    {/if}
	    </div>

    </form>

  	{if $forum_mode eq 'y'}
	  	{tr}Posting replies{/tr}:
  	{else}
	  	{tr}Posting comments{/tr}:
  	{/if}

	{tr}Use{/tr} [http://www.foo.com] {tr}or{/tr} [http://www.foo.com|{tr}description{/tr}] {tr}for links{/tr}.<br />
	{tr}HTML tags are not allowed inside posts{/tr}.<br />

	{if $forum_mode eq 'y'}
    	</div>
	{/if}
</div>
{/if}