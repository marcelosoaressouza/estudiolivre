{* $Header: /cvsroot/arca/estudiolivre/src/templates/styles/obscur/tiki-view_forum.tpl,v 1.2 2007-07-25 18:34:54 sampaioprimo Exp $ *}
<div id="viewForum">
<h1>
	{tr}Forum{/tr}: 
	<a class="pagetitle" href="tiki-view_forum.php?forumId={$forum_info.forumId}">
		{$forum_info.name}
	</a>
</h1>
{if $forum_info.show_description eq 'y'}
	<div class="description">
		{$forum_info.description}
	</div>
{/if}


<h5>
  {if $tiki_p_forum_post_topic eq 'y'}
	<span class="pointer" onclick="flip('forumpost');"/>{tr}new topic{/tr}</span>
  	&nbsp;|&nbsp;
  {/if}
  {if $tiki_p_admin_forum eq 'y'}
    <a class="linkbut" href="tiki-admin_forums.php?forumId={$forum_info.forumId}">{tr}Edit Forum{/tr}</a>
    &nbsp;|&nbsp;
  {/if}
  {if $rss_forum eq 'y'}
	<a href="tiki-forum_rss.php?forumId={$forumId}">rss</a>
  {/if}
</h5>

{if $user and $feature_user_watches eq 'y'}
	{if $user_watching_forum eq 'n'}
		<a href="tiki-view_forum.php?forumId={$forumId}&amp;watch_event=forum_post_topic&amp;watch_object={$forumId}&amp;watch_action=add"><img border='0' alt='{tr}monitor this forum{/tr}' src='img/icons/icon_watch.png' /></a>
	{else}
		<a href="tiki-view_forum.php?forumId={$forumId}&amp;watch_event=forum_post_topic&amp;watch_object={$forumId}&amp;watch_action=remove"><img border='0' alt='{tr}stop monitoring this forum{/tr}' src='img/icons/icon_unwatch.png' /></a>
	{/if}
{/if}

{if $unread > 0}
	<a class='link' href='messu-mailbox.php'>{tr}You have {$unread} unread private messages{/tr}<br /></a>
{/if}

{if $was_queued eq 'y'}
<div class="wikitext">
<small>{tr}Your message has been queued for approval, the message will be posted after
a moderator approves it.{/tr}</small>
</div>
{/if}


{if $tiki_p_forum_post_topic eq 'y'}
  {if $comment_preview eq 'y'}
  <b>{tr}Preview{/tr}</b>
  <div class="commentscomment">
  <div class="commentheader">

  <div class="commentheader">
  <span class="commentstitle">{$comments_preview_title}</span><br />
  {tr}by{/tr} {$user}
  </div>

  
  <div class="commentheader">
  </div>


  </div>
  <div class="commenttext">
  {$comments_preview_data}
  <br />
  </div>
  </div>
  {/if}

  {if $warning eq 'y'}
  <br /><br />
  <div class="commentsedithelp"><br /><b>{tr}You have to enter a title and text{/tr}!</b><br /><br />
  </div>
  <br />
  {/if}

<div id='forumpost' style="display:none">
  <br />
  {if $comments_threadId > 0}
    {tr}Editing comment{/tr}: {$comments_threadId} (<a class="forumbutlink" href="tiki-view_forum.php?openpost=1&amp;forumId={$forum_info.forumId}&amp;comments_threadId=0&amp;comments_threshold={$comments_threshold}&amp;comments_offset={$comments_offset}&amp;comments_sort_mode={$comments_sort_mode}&amp;comments_maxComments={$comments_maxComments}">{tr}post new comment{/tr}</a>)
    {/if}
    <form method="post" enctype="multipart/form-data" action="tiki-view_forum.php" id="editpageform">
    <input type="hidden" name="comments_offset" value="{$comments_offset|escape}" />
    <input type="hidden" name="comments_threadId" value="{$comments_threadId|escape}" />
    <input type="hidden" name="comments_threshold" value="{$comments_threshold|escape}" />
    <input type="hidden" name="comments_sort_mode" value="{$comments_sort_mode|escape}" />
    <input type="hidden" name="forumId" value="{$forumId|escape}" />

      {tr}Title{/tr}
	  <input type="text" name="comments_title" value="{$comment_title|escape}" />
	  &nbsp;&nbsp;&nbsp;&nbsp;
    {if $forum_info.forum_use_password ne 'n'}
      {tr}Password{/tr}  	
    		<input type="password" name="password" />
      &nbsp;&nbsp;&nbsp;&nbsp;
    {/if}
	  {tr}Type{/tr}
      <select name="comment_topictype">
	      <option value="n" {if $comment_topictype eq 'n'}selected="selected"{/if}>{tr}normal{/tr}</option>
	      {if $tiki_p_admin_forum eq 'y'}
	      <option value="a" {if $comment_topictype eq 'a'}selected="selected"{/if}>{tr}announce{/tr}</option>
	      <option value="h" {if $comment_topictype eq 'h'}selected="selected"{/if}>{tr}hot{/tr}</option>
	      <option value="s" {if $comment_topictype eq 's'}selected="selected"{/if}>{tr}sticky{/tr}</option>
	      <option value="l" {if $comment_topictype eq 'l'}selected="selected"{/if}>{tr}locked{/tr}</option>
	      {/if}
	      </select>
	      {if $forum_info.topic_smileys eq 'y'}
	      <select name="comment_topicsmiley">
	      <option value="" {if $comment_topicsmiley eq ''}selected="selected"{/if}>{tr}no feeling{/tr}</option>
	      <option value="icon_frown.gif" {if $comment_topicsmiley eq 'icon_frown.gif'}selected="selected"{/if}>{tr}frown{/tr}</option>
	      <option value="icon_exclaim.gif" {if $comment_topicsmiley eq 'icon_exclaim.gif'}selected="selected"{/if}>{tr}exclaim{/tr}</option>
	      <option value="icon_idea.gif" {if $comment_topicsmiley eq 'icon_idea.gif'}selected="selected"{/if}>{tr}idea{/tr}</option>
	      <option value="icon_mad.gif" {if $comment_topicsmiley eq 'icon_mad.gif'}selected="selected"{/if}>{tr}mad{/tr}</option>      
	      <option value="icon_neutral.gif" {if $comment_topicsmiley eq 'icon_neutral.gif'}selected="selected"{/if}>{tr}neutral{/tr}</option>      
	      <option value="icon_question.gif" {if $comment_topicsmiley eq 'icon_question.gif'}selected="selected"{/if}>{tr}question{/tr}</option>      
	      <option value="icon_sad.gif" {if $comment_topicsmiley eq 'icon_sad.gif'}selected="selected"{/if}>{tr}sad{/tr}</option>      
	      <option value="icon_smile.gif" {if $comment_topicsmiley eq 'icon_smile.gif'}selected="selected"{/if}>{tr}happy{/tr}</option>
	      <option value="icon_wink.gif" {if $comment_topicsmiley eq 'icon_wink.gif'}selected="selected"{/if}>{tr}wink{/tr}</option>
      </select>
      {/if}
      <br />
    {if $forum_info.topic_summary eq 'y'}
    	{tr}Summary{/tr}
    	<br>
    		<input type="text" size="60" name="comment_topicsummary" value="{$comment_topicsummary|escape}" maxlength="240" />
    	<br/>
    
    {/if}
    {if $feature_smileys eq 'y'}
		{tr}Smileys{/tr}
		{include file="tiki-smileys.tpl" area_name='editpost'} 
    {/if}
      {tr}Comment{/tr}
    	<br />
			{include file="textareasize.tpl" area_name='editpost' formId='editpageform'}

	{if $feature_forum_parse eq 'y'}
	{include file=tiki-edit_help_tool.tpl area_name="editpost"}
	{/if}
			
      <textarea id='editpost' name="comments_data" rows="{$rows}" cols="{$cols}">{$comment_data|escape}</textarea>
      <input type="hidden" name="rows" value="{$rows}"/>
	  <input type="hidden" name="cols" value="{$cols}"/>    
	  <br>
    {if ($forum_info.att eq 'att_all') or ($forum_info.att eq 'att_admin' and $tiki_p_admin_form eq 'y') or ($forum_info.att eq 'att_perm' and $tiki_p_forum_attach eq 'y')}
    
	  {tr}Attach file{/tr}
	  <br>
	  	<input type="hidden" name="MAX_FILE_SIZE" value="{$forum_info.att_max_size|escape}" /><input name="userfile1" type="file" />
	     
    
    {/if}
        
   	{if $feature_freetags eq 'y' and $tiki_p_freetags_tag eq 'y'}
    	{include file=freetag.tpl}
	{/if}
    
      <br>
      <input type="submit" name="comments_previewComment" value="{tr}preview{/tr}"/>
      <input type="submit" name="comments_postComment" value="{tr}post{/tr}"/>
      <input type="button" name="comments_postComment" value="{tr}cancel{/tr}" onclick="hide('{$postclass}');"/>
      
    
    
    </form>
<br />
  <b>{tr}Posting comments{/tr}:</b>
  <br />
  {tr}Use{/tr} [http://www.foo.com] {tr}or{/tr} [http://www.foo.com|description] {tr}for links{/tr}<br />
  {tr}HTML tags are not allowed inside comments{/tr}<br />
</div>
<br />
{/if}

{*---------------------------------------------------------*}
{*---------------------------------------------------------*}
{*---------------------------------------------------------*}
{*---------------------------------------------------------*}

<form method="post" action="tiki-view_forum.php">
    <input type="hidden" name="comments_offset" value="{$comments_offset|escape}" />
    <input type="hidden" name="comments_threadId" value="{$comments_threadId|escape}" />
    <input type="hidden" name="comments_threshold" value="{$comments_threshold|escape}" />
    <input type="hidden" name="comments_sort_mode" value="{$comments_sort_mode|escape}" />
    <input type="hidden" name="forumId" value="{$forumId|escape}" />
<table class="normal">
<tr>
  {if $tiki_p_admin_forum eq 'y'}
  <td class="heading">&nbsp;</td>
  {/if}
  <td class="heading"><a class="tableheading" href="tiki-view_forum.php?comments_threshold={$comments_threshold}&amp;forumId={$forum_info.forumId}&amp;comments_offset={$comments_offset}&amp;comments_sort_mode={if $comments_sort_mode eq 'type_desc'}type_asc{else}type_desc{/if}">{tr}type{/tr}</a></td>
  {if $forum_info.topic_smileys eq 'y'}
  <td class="heading"><a class="tableheading" href="tiki-view_forum.php?comments_threshold={$comments_threshold}&amp;forumId={$forum_info.forumId}&amp;comments_offset={$comments_offset}&amp;comments_sort_mode={if $comments_sort_mode eq 'smiley_desc'}smiley_asc{else}smiley_desc{/if}">{tr}emot{/tr}</a></td>
  {/if}
  <td class="heading"><a class="tableheading" href="tiki-view_forum.php?comments_threshold={$comments_threshold}&amp;forumId={$forum_info.forumId}&amp;comments_offset={$comments_offset}&amp;comments_sort_mode={if $comments_sort_mode eq 'title_desc'}title_asc{else}title_desc{/if}">{tr}title{/tr}</a></td>
  {if $forum_info.topics_list_replies eq 'y'}
  	<td class="heading"><a class="tableheading" href="tiki-view_forum.php?comments_threshold={$comments_threshold}&amp;forumId={$forum_info.forumId}&amp;comments_offset={$comments_offset}&amp;comments_sort_mode={if $comments_sort_mode eq 'replies_desc'}replies_asc{else}replies_desc{/if}">{tr}replies{/tr}</a></td>
  {/if}
  {if $forum_info.topics_list_reads eq 'y'}
  	<td class="heading"><a class="tableheading" href="tiki-view_forum.php?comments_threshold={$comments_threshold}&amp;forumId={$forum_info.forumId}&amp;comments_offset={$comments_offset}&amp;comments_sort_mode={if $comments_sort_mode eq 'hits_desc'}hits_asc{else}hits_desc{/if}">{tr}reads{/tr}</a></td>
  {/if}
  {if $forum_info.topics_list_lastpost eq 'y'}
  	<td class="heading"><a class="tableheading" href="tiki-view_forum.php?comments_threshold={$comments_threshold}&amp;forumId={$forum_info.forumId}&amp;comments_offset={$comments_offset}&amp;comments_sort_mode={if $comments_sort_mode eq 'lastPost_desc'}lastPost_asc{else}lastPost_desc{/if}">{tr}last post{/tr}</a></td>
  {/if}
  {if $forum_info.topics_list_author eq 'y'}
  	<td class="heading"><a class="tableheading" href="tiki-view_forum.php?comments_threshold={$comments_threshold}&amp;forumId={$forum_info.forumId}&amp;comments_offset={$comments_offset}&amp;comments_sort_mode={if $comments_sort_mode eq 'userName_desc'}userName_asc{else}userName_desc{/if}" title="sort by">{tr}author{/tr}</a></td>
  {/if}
</tr>
{cycle values="odd,even" print=false}
{section name=ix loop=$comments_coms}
{if $userinfo && $comments_coms[ix].lastPost > $userinfo.lastLogin}
{assign var="newtopic" value="_new"}
{else}
{assign var="newtopic" value=""}
{/if}
<tr>
  {if $tiki_p_admin_forum eq 'y'}
  <td class="{cycle advance=false}">
  	
	<input type="checkbox" name="forumtopic[]" value="{$comments_coms[ix].threadId|escape}"  {if $smarty.request.forumtopic and in_array($comments_coms[ix].threadId,$smarty.request.forumtopic)}checked="checked"{/if} />
  </td>
  {/if}	
  <td style="text-align:center;" class="{cycle advance=false}">
  {if $comments_coms[ix].type eq 'n'}<img src="img/icons/folder{$newtopic}.gif" alt="{tr}normal{/tr}" />{/if}
  {if $comments_coms[ix].type eq 'a'}<img src="img/icons/folder_announce{$newtopic}.gif" alt="{tr}announce{/tr}" />{/if}
  {if $comments_coms[ix].type eq 'h'}<img src="img/icons/folder_hot{$newtopic}.gif" alt="{tr}hot{/tr}" />{/if}
  {if $comments_coms[ix].type eq 's'}<img src="img/icons/folder_sticky{$newtopic}.gif" alt="{tr}sticky{/tr}" />{/if}
  {if $comments_coms[ix].type eq 'l'}<img src="img/icons/folder_locked{$newtopic}.gif" alt="{tr}locked{/tr}" />{/if}
  </td>
  {if $forum_info.topic_smileys eq 'y'}
  <td style="text-align:center;" class="{cycle advance=false}">
  	{if strlen($comments_coms[ix].smiley) > 0}
  		<img src='img/smiles/{$comments_coms[ix].smiley}' alt=''/>
  	{else}
  	&nbsp;{$comments_coms[ix].smiley}
  	{/if}
  </td>
  {/if}  
  
  <td class="{cycle advance=false}">
  <table width="100%"><tr><td>
  <a {if $comments_coms[ix].is_marked}class="forumnameread"{else}class="forumname"{/if}  href="tiki-view_forum_thread.php?comments_parentId={$comments_coms[ix].threadId}&amp;topics_threshold={$comments_threshold}&amp;topics_offset={math equation="x + y" x=$comments_offset y=$smarty.section.ix.index}&amp;topics_sort_mode={$comments_sort_mode}&amp;topics_find={$comments_find}&amp;forumId={$forum_info.forumId}">{$comments_coms[ix].title}</a>
  {if $forum_info.topic_summary eq 'y'}
  <br /><small>{$comments_coms[ix].summary|truncate:240:"...":true}</small>     
  {/if}
  </td>
  
  <td style="text-align:right;" nowrap="nowrap">
  {if count($comments_coms[ix].attachments) or $tiki_p_admin_forum eq 'y'}
  {if count($comments_coms[ix].attachments)}
  	<img src='img/icons/attachment.gif' alt='attachments' />
  {/if}
  {else}
  	&nbsp;
  {/if}

  {if $tiki_p_admin_forum eq 'y' or ($comments_coms[ix].userName == $user && $tiki_p_forum_post eq 'y') }
  <a href="tiki-view_forum.php?openpost=1&amp;comments_threadId={$comments_coms[ix].threadId}&amp;forumId={$forum_info.forumId}&amp;comments_threshold={$comments_threshold}&amp;comments_offset={$comments_offset}&amp;comments_sort_mode={$comments_sort_mode}&amp;comments_maxComments={$comments_maxComments}"
     class="admlink">{html_image file='img/icons/edit.gif' border='0' alt='{tr}edit{/tr}' title='{tr}edit{/tr}'}</a>
   {/if}
  {if $tiki_p_admin_forum eq 'y' }
   <a href="tiki-view_forum.php?comments_remove=1&amp;comments_threadId={$comments_coms[ix].threadId}&amp;forumId={$forum_info.forumId}&amp;comments_threshold={$comments_threshold}&amp;comments_offset={$comments_offset}&amp;comments_sort_mode={$comments_sort_mode}&amp;comments_maxComments={$comments_maxComments}"
     class="admlink"><img src="img/icons2/delete.gif" border="0" width="16" height="16"  alt='{tr}remove{/tr}' title='{tr}remove{/tr}' /></a>
  {/if}

  </td>   
  
  </tr></table>
  </td>
  {if $forum_info.topics_list_replies eq 'y'}
  	<td style="text-align:right;" class="{cycle advance=false}">{$comments_coms[ix].replies}</td>
  {/if}
  {if $forum_info.topics_list_reads eq 'y'}
  	<td style="text-align:right;" class="{cycle advance=false}">{$comments_coms[ix].hits}</td>
  {/if}
  {if $forum_info.topics_list_lastpost eq 'y'}
  	  <td class="{cycle advance=false}">{$comments_coms[ix].lastPost|tiki_short_datetime} {*date_format:"%b %d [%H:%M]" *}
	  {if $comments_coms[ix].replies}
	  <br />
	  <small><i>{$comments_coms[ix].lastPostData.title}</i> {tr}by{/tr} {$comments_coms[ix].lastPostData.userName}</small>     
	  {/if}
	  </td>
  {/if}
  {if $forum_info.topics_list_author eq 'y'}
  	<td class="{cycle}">{$comments_coms[ix].userName|userlink}</td>
  {/if}
</tr>
{sectionelse}
<tr>
	<td class="odd" colspan="8">{tr}No topics yet{/tr}</td>
</tr>
{/section}
{if $tiki_p_admin_forum eq 'y'}
	<tr>
		<td colspan='18'>&nbsp;</td>
	</tr>
	<tr>
		<td class="heading" colspan='18'>{tr}moderator actions{/tr}</td>
	</tr>
	<tr>	
		<td class="odd" colspan="3">
		<input type="image" name="movesel" src="img/icons/topic_move.gif" border='0' alt='{tr}move{/tr}' title='{tr}move selected topics{/tr}' />
		<input type="image" name="unlocksel" src="img/icons/topic_unlock.gif" border='0' alt='{tr}unlock{/tr}' title='{tr}unlock selected topics{/tr}' />
		<input type="image" name="locksel" src="img/icons/topic_lock.gif" border='0' alt='{tr}lock{/tr}' title='{tr}lock selected topics{/tr}' />
		<input type="image" name="delsel" src="img/icons/topic_delete.gif" border='0' alt='{tr}delete{/tr}' title='{tr}delete selected topics{/tr}' />
		<input type="image" name="splitsel" src="img/icons/topic_split.gif" border='0' alt='{tr}merge{/tr}' title='{tr}merge selected topics{/tr}' />
		</td>
		<td style="text-align:right;" class="odd" colspan="10">
		{if $reported > 0}
		<small><a class="link" href="tiki-forums_reported.php?forumId={$forumId}">{tr}reported messages:{/tr}{$reported}</a></small><br />
		{/if}
		<small><a class="link" href="tiki-forum_queue.php?forumId={$forumId}">{tr}queued messages:{/tr}{$queued}</a></small>
		</td>
	</tr>
	{if $smarty.request.movesel_x} 
	<tr>
		<td class="odd" colspan="18">
		{tr}Move to{/tr}:
		<select name="moveto">
			{section name=ix loop=$all_forums}
				{if $all_forums[ix].forumId ne $forumId}
					<option value="{$all_forums[ix].forumId|escape}">{$all_forums[ix].name}</option>
				{/if}
			{/section}
		</select>
		<input type='submit' name='movesel' value='{tr}move{/tr}' />
		
		</td>
	</tr>
	{/if}
	{if $smarty.request.splitsel_x} 
	<tr>
		<td class="odd" colspan="18">
		{tr}Merge into topic{/tr}:
		<select name="mergetopic">
			{section name=ix loop=$comments_coms}
				{if in_array($comments_coms[ix].threadId,$smarty.request.forumtopic)}
					<option value="{$comments_coms[ix].threadId|escape}">{$comments_coms[ix].title}</option>
				{/if}
			{/section}
		</select>
		<input type="submit" name="mergesel" value="{tr}merge{/tr}" />
		</td>
	</tr>
	{/if}
	
	<tr id='moveop' style="display:none;">
		<td class="odd" colspan="18">
			move
		</td>
	</tr>
{/if}
</table>
</form>

  		<div class="paginacao">
			{if $comments_prev_offset >= 0}
				<a href="tiki-view_forum.php?forumId={$forum_info.forumId}&amp;comments_threshold={$comments_threshold}&amp;comments_offset={$comments_prev_offset}&amp;comments_sort_mode={$comments_sort_mode}&amp;comments_maxComments={$comments_maxComments}">
					<img src="styles/estudiolivre/iArrowGreyLeft.png">
				</a>
			{/if}
			
			{tr}Page{/tr} {$comments_actual_page} {tr}de{/tr} {$comments_cant_pages}
			
			{if $comments_next_offset >= 0}
				<a class="prevnext" href="tiki-view_forum.php?forumId={$forum_info.forumId}&amp;comments_threshold={$comments_threshold}&amp;comments_offset={$comments_next_offset}&amp;comments_sort_mode={$comments_sort_mode}&amp;comments_maxComments={$comments_maxComments}">
					<img src="styles/estudiolivre/iArrowGreyRight.png">
				</a>
			{/if}
			{if $comments_pagination eq 'y'}
				<br />
				{section loop=$comments_cant_pages name=foo}
					{assign var=selector_offset value=$smarty.section.foo.index|times:$maxRecords}
						<a href="tiki-view_forum.php?forumId={$forum_info.forumId}&amp;comments_threshold={$comments_threshold}&amp;comments_offset={$selector_offset}&amp;comments_sort_mode={$comments_sort_mode}&amp;comments_maxComments={$comments_maxComments}">
					{$smarty.section.foo.index_next}</a>
				{/section}
			{/if}
		</div>
		
{if $forum_info.forum_last_n > 0}
	{* Last n titles *}
	{cycle values="odd,even" print=false}
	<table class="normal">
	<tr>
	 	<td class="heading">{tr}Last{/tr} {$forum_info.forum_last_n} {tr}topics in this forum{/tr}</td>
	 	{section name=ix loop=$last_comments}
	 	<tr>
	 		<td class="{cycle}">
	 		{if $last_comments[ix].parentId eq 0}
	 		 	{assign var="idt" value=$last_comments[ix].threadId}
	 		{else}
	 			{assign var="idt" value=$last_comments[ix].parentId}
	 		{/if}
	 		<a class="forumname" href="tiki-view_forum_thread.php?comments_parentId={$idt}&amp;topics_threshold={$comments_threshold}&amp;topics_offset={math equation="x + y" x=$comments_offset y=$smarty.section.ix.index}&amp;topics_sort_mode={$comments_sort_mode}&amp;topics_find={$comments_find}&amp;forumId={$forum_info.forumId}">{$last_comments[ix].title}</a>
	 		</td>
	 	</tr>
	 	{/section}
	</tr>
	</table>
	<br />
{/if}

<table >  
<tr>
<td style="text-align:left;">

<form id='time_control' method="post" action="tiki-view_forum.php">
    <input type="hidden" name="comments_offset" value="{$comments_offset|escape}" />
    <input type="hidden" name="comments_threadId" value="{$comments_threadId|escape}" />
    <input type="hidden" name="comments_threshold" value="{$comments_threshold|escape}" />
    <input type="hidden" name="comments_sort_mode" value="{$comments_sort_mode|escape}" />
    <input type="hidden" name="forumId" value="{$forumId|escape}" />
    <small>{tr}Show posts{/tr}:</small>
    <select name="time_control" onchange="javascript:document.getElementById('time_control').submit();">
    	<option value="" {if $smarty.request.time_control eq ''}selected="selected"{/if}>{tr}All posts{/tr}</option>
    	<option value="3600" {if $smarty.request.time_control eq 3600}selected="selected"{/if}>{tr}Last hour{/tr}</option>
    	<option value="86400" {if $smarty.request.time_control eq 86400}selected="selected"{/if}>{tr}Last 24 hours{/tr}</option>
    	<option value="172800" {if $smarty.request.time_control eq 172800}selected="selected"{/if}>{tr}Last 48 hours{/tr}</option>
    </select>
</form>
</td>
<td style="text-align:right;">
{if $feature_forum_quickjump eq 'y'}
<form id='quick' method="post" action="tiki-view_forum.php">
<small>{tr}Jump to forum{/tr}:</small>
<select name="forumId" onchange="javascript:document.getElementById('quick').submit();">
{section name=ix loop=$all_forums}
<option value="{$all_forums[ix].forumId|escape}" {if $all_forums[ix].forumId eq $forumId}selected="selected"{/if}>{$all_forums[ix].name}</option>
{/section}
</select>
</form>
{else}
&nbsp;
{/if}
</td>
</tr>
</table>



</div>