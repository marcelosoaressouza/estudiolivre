{if $forum_mode eq 'y'}
    <tr>
    <td>
{else}
    <a name="comments"></a>
    <div id="comzone"
    {if $comments_show eq 'y'}
		>
    {else}
		style="display:none">
    {/if}
{/if}


{* This section (comment) is only displayed * }
{* if a reply to it is being composed * }
{* The $parent_com is only set in this case *}
{if ($tiki_p_read_comments eq 'y'  and $forum_mode ne 'y') or ($tiki_p_forum_read eq 'y' and $forum_mode eq 'y')}
	{if $comments_cant gt 0}
		<form method="post" action="{$comments_father}" class="comments">
			{section name=i loop=$comments_request_data}
				<input type="hidden" name="{$comments_request_data[i].name|escape}" value="{$comments_request_data[i].value|escape}" />
			{/section}
			<input type="hidden" name="comments_parentId" value="{$comments_parentId|escape}" />    
			<input type="hidden" name="comments_grandParentId" value="{$comments_grandParentId|escape}" />    
			<input type="hidden" name="comments_reply_threadId" value="{$comments_reply_threadId|escape}" />    
			<input type="hidden" name="comments_offset" value="0" />
			<input type="hidden" name="topics_offset" value="{$smarty.request.topics_offset|escape}" />
			<input type="hidden" name="topics_find" value="{$smarty.request.topics_find|escape}" />
			<input type="hidden" name="topics_sort_mode" value="{$smarty.request.topics_sort_mode|escape}" />
			<input type="hidden" name="topics_threshold" value="{$smarty.request.topics_threshold|escape}" />
			<input type="hidden" name="forumId" value="{$forumId|escape}" />
			{if $tiki_p_admin_forum eq 'y' and $forum_mode eq 'y'}
				<table class="normal">
					<tr>
						<td colspan="3" class="heading">{tr}Moderator actions{/tr}</td>
					</tr>
					<tr>
						<td class="odd">
							<input type="submit" name="delsel" value="{tr}delete selected{/tr}" />
						</td>
					</tr>
					<tr>
						<td class="odd">
							{tr}Move to topic:{/tr}
							<select name="moveto" style="width:70%">
								{section name=ix loop=$topics}
									{if $topics[ix].threadId ne $comments_parentId}
										<option value="{$topics[ix].threadId|escape}">{$topics[ix].title}</option>
									{/if}
								{/section}
							</select>
							<input type="submit" name="movesel" value="{tr}move{/tr}" />
						</td>
						<td style="text-align:right;" class="odd">
							{if $reported > 0}
								<a class="link" href="tiki-forums_reported.php?forumId={$forumId}">
									{tr}reported:{/tr}{$reported}
								</a>
								|
							{/if}
							<a class="link" href="tiki-forum_queue.php?forumId={$forumId}">
								{tr}queued:{/tr}{$queued}
							</a>
						</td>
					</tr>
				</table>
			{/if}
			<div class="comMainTitle">
				{tr}Comentários{/tr}
			</div>
			{*
	 		<table class="normal">
				<tr>
				    <td class="heading">
				    	<label for="comments-maxcomm">
				    		{tr}Messages{/tr}
				    	</label>
				        <select name="comments_maxComments" id="comments-maxcomm">
					        <option value="10" {if $comments_maxComments eq 10 }selected="selected"{/if}>10</option>
					        <option value="20" {if $comments_maxComments eq 20 }selected="selected"{/if}>20</option>
					        <option value="30" {if $comments_maxComments eq 30 }selected="selected"{/if}>30</option>
					        <option value="999999" {if $comments_maxComments eq 999999 }selected="selected"{/if}>{tr}All{/tr}</option>
				        </select>
				    </td>
	    			<td class="heading">
	    				<label for="comments-style">{tr}Style{/tr}</label>
			        	<select name="comments_style" id="comments-style">
					        <option value="commentStyle_plain" {if $comments_style eq 'commentStyle_plain'}selected="selected"{/if}>{tr}Plain{/tr}</option>
					        <option value="commentStyle_threaded" {if $comments_style eq 'commentStyle_threaded'}selected="selected"{/if}>{tr}Threaded{/tr}</option>
					        <option value="commentStyle_headers" {if $comments_style eq 'commentStyle_headers'}selected="selected"{/if}>{tr}Headers Only{/tr}</option>
				        </select>
				    </td>
				    <td class="heading"><label for="comments-sort">{tr}Sort{/tr}</label>
				        <select name="comments_sort_mode" id="comments-sort">
					        <option value="commentDate_desc" {if $comments_sort_mode eq 'commentDate_desc'}selected="selected"{/if}>{tr}Newest first{/tr}</option>
					        <option value="commentDate_asc" {if $comments_sort_mode eq 'commentDate_asc'}selected="selected"{/if}>{tr}Oldest first{/tr}</option>
					        <option value="points_desc" {if $comments_sort_mode eq 'points_desc'}selected="selected"{/if}>{tr}Score{/tr}</option>
				        </select>
				    </td>
				    <td class="heading"><label for="comments-thresh">{tr}Threshold{/tr}</label>
				    	<select name="comments_threshold" id="comments-thresh">
					        <option value="0" {if $comments_threshold eq 0}selected="selected"{/if}>{tr}All{/tr}</option>
					        <option value="0.01" {if $comments_threshold eq '0.01'}selected="selected"{/if}>0</option>
					        <option value="1" {if $comments_threshold eq 1}selected="selected"{/if}>1</option>
					        <option value="2" {if $comments_threshold eq 2}selected="selected"{/if}>2</option>
					        <option value="3" {if $comments_threshold eq 3}selected="selected"{/if}>3</option>
					        <option value="4" {if $comments_threshold eq 4}selected="selected"{/if}>4</option>
				        </select>  
				    </td>
				    <td class="heading">
				    	<label for="comments-search">{tr}Find{/tr}</label>
				        <input type="text" size="7" name="comments_commentFind" id="comments-search" value="{$comments_commentFind|escape}" />
				    </td>
	
				    <td class="heading">
				    	<input type="submit" name="comments_setOptions" value="{tr}set{/tr}" />
				    </td>
				    <td class="heading" style="text-align: center; vertical-align: middle">
				    	<a class="link" href="{$comments_complete_father}comments_threshold={$comments_threshold}&amp;comments_offset={$comments_offset}{$comments_sort_mode_param}&amp;comments_maxComments={$comments_maxComments}&amp;comments_style={$comments_style}&amp;comments_parentId=0">
				    		{tr}Top{/tr}
				    	</a>
				    </td>
	
					{if $forum_mode ne 'y'}
					    <td class="heading" style="text-align: center; vertical-align: middle">
							<a class="link" href="{$comments_complete_father}comzone=hide">{tr}Hide all{/tr}</a>
					    </td>
					{/if}
				</tr>
			</table>
			*}
				{section name=rep loop=$comments_coms}
					<div id="comzoneItems">
						{include file="comment_item.tpl"  comment=$comments_coms[rep]}
					</div>
			  	{/section}
		</form>
	
		<br />
	
		<div>
	  		{if $comments_threshold ne 0}
	  			{$comments_below}&nbsp;{if $comments_below eq 1}{tr}reply{/tr}{else}{tr}replies{/tr}{/if} {tr}below your current threshold{/tr}
			{/if}
	  		<div class="paginacao">
				{if $comments_prev_offset >= 0}
					<a class="prevnext" href="{$comments_complete_father}comments_threshold={$comments_threshold}&amp;comments_parentId={$comments_parentId}&amp;comments_offset={$comments_prev_offset}{$comments_sort_mode_param}&amp;comments_maxComments={$comments_maxComments}&amp;comments_style={$comments_style}">
						<img src="styles/estudiolivre/iArrowGreyLeft.png">
					</a>
				{/if}
				
				{tr}Page{/tr} {$comments_actual_page} {tr}de{/tr} {$comments_cant_pages}
				
				{if $comments_next_offset >= 0}
					<a class="prevnext" href="{$comments_complete_father}comments_threshold={$comments_threshold}&amp;comments_parentId={$comments_parentId}&amp;comments_offset={$comments_next_offset}{$comments_sort_mode_param}&amp;comments_maxComments={$comments_maxComments}&amp;comments_style={$comments_style}">
						<img src="styles/estudiolivre/iArrowGreyRight.png">
					</a>
				{/if}
				{if $direct_pagination eq 'y'}
					<br />
					{section loop=$comments_cant_pages name=foo}
						{assign var=selector_offset value=$smarty.section.foo.index|times:$comments_maxComments}
							<a class="prevnext" href="{$comments_complete_father}comments_threshold={$comments_threshold}&amp;comments_parentId={$comments_parentId}&amp;comments_offset={$selector_offset}{$comments_sort_mode_param}&amp;comments_maxComments={$comments_maxComments}&amp;comments_style={$comments_style}">
						{$smarty.section.foo.index_next}</a>
					{/section}
				{/if}
			</div>		
			<br />
		</div>  
	{/if}
{/if}
{* end read comment *}


{* Post dialog *}
	{include file="comment_post.tpl"}
{* End of Post dialog *}


{if $forum_mode eq 'y'}
    </td>
    </tr>
{else}
    </div>
{/if}
