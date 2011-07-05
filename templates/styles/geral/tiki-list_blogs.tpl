{css only=list}
<div id="blogs">
	<h1>
		{if !$find}
			{tr}Blogs{/tr}
		{else}
			{tr}Busca em blogs{/tr}
		{/if}
		{if $tiki_p_admin eq 'y'}
			<a href="tiki-admin.php?page=blogs">
				<img src='img/icons/config.gif' border='0'  alt="{tr}configure listing{/tr}" title="{tr}configure listing{/tr}" />
			</a>
		{/if}
	</h1>
	
	{if $tiki_p_create_blogs eq 'y'}
		<h5>
		<div class="navbar">
			<a class="linkbut" href="tiki-edit_blog.php">
				{tr}create new blog{/tr}
			</a>
		</div>
		</h5>
	{/if}
	
	<table class="bloglist">
		<tr>
			{if $blog_list_title eq 'y'}
				<td class="heading">
					<a class="heading" href="tiki-list_blogs.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'title_desc'}title_asc{else}title_desc{/if}">
						<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'title_desc'}ArrowUp{elseif $sort_mode eq 'title_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
					</a>{tr}Title{/tr}
				</td>
			{/if}
			
			{if $blog_list_user ne 'disabled'}
				<td class="heading">
					<a class="heading" href="tiki-list_blogs.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'user_desc'}user_asc{else}user_desc{/if}">
						<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'user_desc'}ArrowUp{elseif $sort_mode eq 'user_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
					</a>{tr}User{/tr}
				</td>
			{/if}
			
			{*if $blog_list_description eq 'y'}
				<td class="heading">
					{tr}Description{/tr}
				</td>
			{/if*}
	
			{if $blog_list_created eq 'y'}
				<td class="heading">
					<a class="heading" href="tiki-list_blogs.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'created_desc'}created_asc{else}created_desc{/if}">
						<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'created_desc'}ArrowUp{elseif $sort_mode eq 'created_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
					</a>{tr}Created{/tr}
				</td>
			{/if}
	
			{if $blog_list_lastmodif eq 'y'}
				<td class="heading">
					<a class="heading" href="tiki-list_blogs.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'lastModif_desc'}lastModif_asc{else}lastModif_desc{/if}">
						<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'lastModif_desc'}ArrowUp{elseif $sort_mode eq 'lastModif_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
					</a>{tr}Last Modified{/tr}
				</td>
			{/if}
			
			{if $blog_list_posts eq 'y'}
				<td class="heading">
					<a class="heading" href="tiki-list_blogs.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'posts_desc'}posts_asc{else}posts_desc{/if}">
						<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'posts_desc'}ArrowUp{elseif $sort_mode eq 'posts_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
					</a>{tr}Posts{/tr}
				</td>
			{/if}
			{if $blog_list_visits eq 'y'}
				<td class="heading">
					<a class="heading" href="tiki-list_blogs.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'hits_desc'}hits_asc{else}hits_desc{/if}">
						<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'hits_desc'}ArrowUp{elseif $sort_mode eq 'hits_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
					</a>{tr}Visits{/tr}
				</td>
			{/if}
			{*if $blog_list_activity eq 'y'}
				<td class="heading">
					<a class="bloglistheading" href="tiki-list_blogs.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'activity_desc'}activity_asc{else}activity_desc{/if}">
						<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'activity_desc'}ArrowUp{elseif $sort_mode eq 'activity_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
					</a>{tr}Activity{/tr}
				</td>
			{/if*}
			
			{*
			<td class="heading">
				{tr}Action{/tr}
			</td>
			*}
		</tr>
	
		{cycle values="odd,even" print=false}
		{section name=changes loop=$listpages}
			<tr class={cycle}>
				{if $blog_list_title eq 'y'}
					<td>
						{tooltip text="<b>Descrição: </b>"|cat:$listpages[changes].description|regex_replace:"/[\r\t\n]/":" "}
						{if ($tiki_p_admin eq 'y') or ($listpages[changes].individual eq 'n') or ($listpages[changes].individual_tiki_p_read_blog eq 'y' ) }

							<a class="blogname" href="tiki-view_blog.php?blogId={$listpages[changes].blogId}">
						{/if}
						{if $listpages[changes].title}
								{$listpages[changes].title|truncate:20:"...":true}
							</a>

						{else}
							&nbsp;
						{/if}
						{/tooltip}
					</td>
				{/if}
				
				{if $blog_list_user ne 'disabled'}
					{if $blog_list_user eq 'link'}
						<td>
							&nbsp;{$listpages[changes].user|userlink}&nbsp;
						</td>
					{elseif $blog_list_user eq 'avatar'}
						<td>
							&nbsp;{$listpages[changes].user|avatarize}&nbsp;
							<br />
							&nbsp;{$listpages[changes].user|userlink}&nbsp;
						</td>
					{else}
						<td>
							&nbsp;<a href="el-user.php?view_user={$listpages[changes].user}">{$listpages[changes].user}</a>&nbsp;
						</td>
					{/if}
				{/if}
				
				{*if $blog_list_description eq 'y'}
					<td>
						{$listpages[changes].description}
					</td>
				{/if*}
		
				{if $blog_list_created eq 'y'}
					<td>
						&nbsp;{$listpages[changes].created|date_format:"%d/%m/%y"}&nbsp;
					</td><!--tiki_date_format:"%b %d" -->
				
				{/if}
				{if $blog_list_lastmodif eq 'y'}
					<td>
						&nbsp;{$listpages[changes].lastModif|date_format:"%d/%m às %H:%M"}&nbsp;
					</td><!--tiki_date_format:"%d of %b [%H:%M]"-->
				{/if}
		
				{if $blog_list_posts eq 'y'}
					<td>
						&nbsp;{$listpages[changes].posts}&nbsp;
					</td>
				{/if}
				{if $blog_list_visits eq 'y'}
					<td>
						&nbsp;{$listpages[changes].hits}&nbsp;
					</td>
				{/if}
				
				{*if $blog_list_activity eq 'y'}	
					<td>
						&nbsp;{$listpages[changes].activity}&nbsp;
					</td>
				{/if*}
					{if ($user and $listpages[changes].user eq $user) or ($tiki_p_blog_admin eq 'y')}
						{if ($tiki_p_admin eq 'y') or ($listpages[changes].individual eq 'n') or ($listpages[changes].individual_tiki_p_blog_create_blog eq 'y' ) }
							<td>
								<a class="bloglink" href="tiki-edit_blog.php?blogId={$listpages[changes].blogId}">
									<img title='{tr}edit{/tr}' alt='{tr}edit{/tr}' src='img/icons/config.gif' />
								</a>
							</td>
						{/if}
					{/if}
					
					{if $tiki_p_blog_post eq 'y'}
						{if ($tiki_p_admin eq 'y') or ($listpages[changes].individual eq 'n') or ($listpages[changes].individual_tiki_p_blog_post eq 'y' ) }
							{if ($user and $listpages[changes].user eq $user) or ($tiki_p_blog_admin eq 'y') or ($listpages[changes].public eq 'y')}
								<td>
								<a class="bloglink" href="tiki-blog_post.php?blogId={$listpages[changes].blogId}">
									<img title='{tr}post{/tr}' alt='{tr}post{/tr}' src='img/icons/edit.gif' />
								</a>
								</td>
							{/if}
						{/if}
					{/if}
					{if $tiki_p_admin eq 'y'}
					    {if $listpages[changes].individual eq 'y'}
					    	<td>
							<a class="bloglink" href="tiki-objectpermissions.php?objectName={$listpages[changes].title|escape:"url"}&amp;objectType=blog&amp;permType=blogs&amp;objectId={$listpages[changes].blogId}">
								<img title='{tr}active perms{/tr}' alt='{tr}active perms{/tr}' src='img/icons/key_active.gif' />
							</a>
							</td>
					    {else}
					    	<td>
							<a class="bloglink" href="tiki-objectpermissions.php?objectName={$listpages[changes].title|escape:"url"}&amp;objectType=blog&amp;permType=blogs&amp;objectId={$listpages[changes].blogId}">
								<img title='{tr}perms{/tr}' alt='{tr}perms{/tr}' src='img/icons/key.gif' />
							</a>
							</td>
					    {/if}
					{/if}		
			
			        {if ($user and $listpages[changes].user eq $user) or ($tiki_p_blog_admin eq 'y')}
		                {if ($tiki_p_admin eq 'y') or ($listpages[changes].individual eq 'n') or ($listpages[changes].individual_tiki_p_blog_create_blog eq 'y' ) }
		                	<td>
		                    <a class="bloglink" href="tiki-list_blogs.php?offset={$offset}&amp;sort_mode={$sort_mode}&amp;remove={$listpages[changes].blogId}">
		                      	<img title='{tr}remove{/tr}' alt='{tr}remove{/tr}' src='img/icons2/delete.gif' />
		                    </a>
		                    </td>
		                {/if}
		    	    {/if}
			</tr>
		{sectionelse}
			<tr>
				<td colspan="9" class="odd">
					{tr}No records found{/tr}
				</td>
			</tr>
		{/section}
	</table>
	<br/>
	<div class="paginacao">
		{if $prev_offset >= 0}
			<a class="userprevnext" href="tiki-list_blogs.php?find={$find}&amp;offset={$prev_offset}&amp;sort_mode={$sort_mode}">
				<img src="styles/{$style|replace:".css":""}/img/iArrowGreyLeft.png">
			</a>
		{/if}
		
		{tr}Page{/tr} {$actual_page} {tr}de{/tr} {$cant_pages}
		
		{if $next_offset >= 0}
			<a class="userprevnext" href="tiki-list_blogs.php?find={$find}&amp;offset={$next_offset}&amp;sort_mode={$sort_mode}">
				<img src="styles/{$style|replace:".css":""}/img/iArrowGreyRight.png">
			</a>
		{/if}
		{if $direct_pagination eq 'y'}
			<br />
			{section loop=$cant_pages name=foo}
				{assign var=selector_offset value=$smarty.section.foo.index|times:$maxRecords}
					<a class="prevnext" href="tiki-list_blogs.php?find={$find}&amp;offset={$selector_offset}&amp;sort_mode={$sort_mode}">
				{$smarty.section.foo.index_next}</a>
			{/section}
		{/if}
	</div>
</div>