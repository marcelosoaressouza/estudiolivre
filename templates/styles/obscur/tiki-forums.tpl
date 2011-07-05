{* $Header: /cvsroot/arca/estudiolivre/src/templates/styles/obscur/tiki-forums.tpl,v 1.1 2006-07-26 06:15:08 rhwinter Exp $ *}

<div id="forum">
	<h1>
		<a class="pagetitle" href="tiki-forums.php">
			{tr}Forums{/tr}
		</a>
	
		{if $tiki_p_admin eq 'y'}
			<a href="tiki-admin.php?page=forums" title="{tr}Configure/Options{/tr}">
				{html_image file='img/icons/config.gif' border='0'  alt="{tr}Configure/Options{/tr}"}
			</a>
		{/if}
	</h1>
	
	<div id="forumTable">
	
		<table class="normal" width="100%">
			<tr>
				<td  class="heading">
					<a class="tableheading" href="tiki-forums.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'name_desc'}name_asc{else}name_desc{/if}">
						<img src="styles/estudiolivre/sort{if $sort_mode eq 'name_desc'}ArrowUp{elseif $sort_mode eq 'name_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
					</a>{tr}Name{/tr}
				</td>
				{if $forum_list_topics eq 'y'}
					<td class="heading">
						<a class="tableheading" href="tiki-forums.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'threads_desc'}threads_asc{else}threads_desc{/if}">
							<img src="styles/estudiolivre/sort{if $sort_mode eq 'threads_desc'}ArrowUp{elseif $sort_mode eq 'threads_asc'}ArrowDown{else}GreyArrowDown{/if}.png">	
						</a>{tr}Topics{/tr}
					</td>
				{/if}	
				{if $forum_list_posts eq 'y'}
					<td class="heading">
						<a class="tableheading" href="tiki-forums.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'comments_desc'}comments_asc{else}comments_desc{/if}">
							<img src="styles/estudiolivre/sort{if $sort_mode eq 'comments_desc'}ArrowUp{elseif $sort_mode eq 'comments_asc'}ArrowDown{else}GreyArrowDown{/if}.png">	
						</a>{tr}Posts{/tr}
					</td>
				{/if}
				{*o que é isso?!? ppd = posts per day!... ah vá!*}	
				{*if $forum_list_ppd eq 'y'}
					<td class="heading">
						{tr}ppd{/tr}
					</td>
				{/if*}	
				{if $forum_list_lastpost eq 'y'}	
					<td class="heading">
						<a class="tableheading" href="tiki-forums.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'lastPost_desc'}lastPost_asc{else}lastPost_desc{/if}">
							<img src="styles/estudiolivre/sort{if $sort_mode eq 'lastPost_desc'}ArrowUp{elseif $sort_mode eq 'lastPost_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
						</a>{tr}Last post{/tr}
					</td>
				{/if}
				{if $forum_list_visits eq 'y'}
					<td class="heading">
						<a class="tableheading" href="tiki-forums.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'hits_desc'}hits_asc{else}hits_desc{/if}">
							<img src="styles/estudiolivre/sort{if $sort_mode eq 'hits_desc'}ArrowUp{elseif $sort_mode eq 'hits_asc'}ArrowDown{else}GreyArrowDown{/if}.png">	
						</a>{tr}Visits{/tr}
					</td>
				{/if}	
			</tr>
	
			{cycle values="odd,even" print=false}					
			{assign var=section_old value=""}
			{section name=user loop=$channels}
				{assign var=section value=$channels[user].section}
				{if $section ne $section_old}
					{assign var=section_old value=$section}
					<tr>
						<td class="forumName" colspan="6">
							<span>{$section}</span>
						</td>
					</tr>
				{/if}
				<tr class="{cycle}">
				
				{if ($channels[user].individual eq 'n') or ($tiki_p_admin eq 'y') or ($channels[user].individual_tiki_p_forum_read eq 'y')}
					<td class="forumTableCell">
						{if $forum_list_desc eq 'y'}
							{tooltip text="<b>Descrição: </b>"|cat:$channels[user].description|regex_replace:"/[\r\t\n]/":" "}
								<a class="forumname" href="tiki-view_forum.php?forumId={$channels[user].forumId}">
									{$channels[user].name}
								</a>
							{/tooltip}
						{else}
							{tooltip text="Fórum sem descrição"}
								<a class="forumname" href="tiki-view_forum.php?forumId={$channels[user].forumId}">
									{$channels[user].name}
								</a>
							{/tooltip}
						{/if}
				{else}
					<td class="forumTableCell">
							{$channels[user].name}
				{/if}
		
				{if ($tiki_p_admin eq 'y') or (($channels[user].individual eq 'n') and ($tiki_p_admin_forum eq 'y')) or ($channels[user].individual_tiki_p_admin_forum eq 'y')}
					<a class="admlink" title="{tr}configure forum{/tr}" href="tiki-admin_forums.php?forumId={$channels[user].forumId}">
						<img src="img/icons/config.gif" border="0" width="16" height="16" alt='{tr}Configure/Options{/tr}' />
					</a>
				{/if}
				
					</td>
		
				{if $forum_list_topics eq 'y'}
					<td class="forumTableCell">
						{$channels[user].threads}
					</td>
				{/if}
				
				{if $forum_list_posts eq 'y'}
					<td  class="forumTableCell">
						{$channels[user].comments}
					</td>
				{/if}
				
				{*if $forum_list_ppd eq 'y'}
					<td class="forumTableCell">
						{$channels[user].posts_per_day|string_format:"%.2f"}
					</td>
				{/if*}
				
				{if $forum_list_lastpost eq 'y'}	
					<td class="forumTableCell">
						{assign var=postName value=$channels[user].lastPostData.title}
						{tooltip text="<b>Título:</b><i> "|cat:$postName|cat:"</i><br> <b>Por:</b> <i>"|cat:$channels[user].lastPostData.userName|cat:"</i>" }
							{$channels[user].lastPost|date_format:"%d/%m às %H:%M"}
						{/tooltip}
					</td>
				{/if}
				
				{if $forum_list_visits eq 'y'}
					<td class="forumTableCell">
						{$channels[user].hits}
					</td>
				{/if}	
				</tr>
			{/section}
		</table>
		
		<br />
		
		<div class="paginacao">
			{if $prev_offset >= 0}
				<a class="forumprevnext" href="tiki-forums.php?find={$find}&amp;offset={$prev_offset}&amp;sort_mode={$sort_mode}">
					<img src="styles/estudiolivre/iArrowGreyLeft.png">
				</a>
			{/if}
			
			{tr}Page{/tr} {$actual_page} de {$cant_pages}
			
			{if $next_offset >= 0}
				<a class="forumprevnext" href="tiki-forums.php?find={$find}&amp;offset={$next_offset}&amp;sort_mode={$sort_mode}">
					<img src="styles/estudiolivre/iArrowGreyRight.png">
				</a>
			{/if}
			{if $direct_pagination eq 'y'}
				<br />
				{section loop=$cant_pages name=foo}
					{assign var=selector_offset value=$smarty.section.foo.index|times:$maxRecords}
						<a class="prevnext" href="tiki-forums.php?find={$find}&amp;offset={$selector_offset}&amp;sort_mode={$sort_mode}">
					{$smarty.section.foo.index_next}</a>
				{/section}
			{/if}
		</div>
	
	</div>
</div>