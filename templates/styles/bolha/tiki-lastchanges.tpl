{css extra=list}
<div id="listLastChanges">
	<h1>
		{if $findwhat != ""}
				{tr}Busca nas últimas alterações{/tr}
		{else} 
			{tr}Last Changes{/tr} &nbsp;&nbsp;&nbsp; <a href="tiki-wiki_rss.php?ver=2"><img src="styles/{$style|replace:".css":""}/img/iRss.png"></a>
		{/if}
	</h1>
	
	<h5>
		{tr}Busca{/tr} <img class="pointer" onclick="javascript:flip('lastChangesOptions');toggleImage(this,'iArrowGreyDown.png')" src="styles/{$style|replace:".css":""}/img/iArrowGreyLeft.png">
		<div id="lastChangesOptions" style="display:none">
			<form method="get" action="tiki-lastchanges.php">
				{tr}Modificações com texto{/tr}: <br/>
				{tooltip text="Dica: não escreva nada se quiser listar <b>todas</b> as modificções"}<input name="find" value="" type="text" class="input">{/tooltip}<br>
			    {tr}<b>Ou</b> nos últimos{/tr}: {tooltip text="Dica: coloque <b>0</b> para buscar em todos os dias"}<input name="days" value="0" size="2" type="text" class="input">{/tooltip} {tr}dias{/tr}<br>
			    <input value="buscar" name="search" type="submit">
			    <input name="sort_mode" value="lastModif_desc" type="hidden">
		    </form>
		</div>
	</h5>
	
	{if $findwhat!=""}
		<h5>
			{$cant_records} {tr}resultado{/tr}{if $cant_users > 1}s{/if} {tr}para{/tr} "<b>{$findwhat}</b>"<br>
			<a href="tiki-lastchanges.php?days=0">{tr}Veja todas as alterações{/tr}</a>
		</h5>
	{elseif $days > 0}
		<h4>
			{tr}<b>Atenção:</b> listando somente as modificações feitas no{/tr}{if $days > 1}s{/if} {tr}último{/tr}{if $days > 1}s{/if} <b>{$days}</b> dia{if $days > 1}s{/if}.<br>
			<a href="tiki-lastchanges.php?days=0">{tr}Veja as alterações feitas em qualquer dia{/tr}</a>
		</h4>
	{/if}		
		
	<div>
		<table class="normal">
			<tr>
				<td class="heading">
					<a class="tableheading" href="tiki-lastchanges.php?days={$days}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'lastModif_desc'}lastModif_asc{else}lastModif_desc{/if}">
						<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'lastModif_desc'}ArrowUp{elseif $sort_mode eq 'lastModif_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
					</a>{tr}Date{/tr}
				</td>
				<td class="heading">
					<a class="tableheading" href="tiki-lastchanges.php?days={$days}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'pageName_desc'}pageName_asc{else}pageName_desc{/if}">
						<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'pageName_desc'}ArrowUp{elseif $sort_mode eq 'pageName_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
					</a>{tr}Page{/tr}
				</td>
				{*
				<td class="heading">
					<a class="tableheading" href="tiki-lastchanges.php?days={$days}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'action_desc'} action_asc{else}action_desc{/if}">
						<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'action_desc'}ArrowUp{elseif $sort_mode eq 'action_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
					</a>{tr}Action{/tr}
				</td>
				*}
				<td class="heading">
					<a class="tableheading" href="tiki-lastchanges.php?days={$days}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'user_desc'}user_asc{else}user_desc{/if}">
						<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'user_desc'}ArrowUp{elseif $sort_mode eq 'user_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
					</a>{tr}User{/tr}
				</td>
				{*
				<td class="heading">
					<a class="tableheading" href="tiki-lastchanges.php?days={$days}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'ip_desc'}ip_asc{else}ip_desc{/if}">
						<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'ip_desc'}ArrowUp{elseif $sort_mode eq 'ip_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
					</a>{tr}Ip{/tr}
				</td>
				*}
				<td class="heading">
					<a class="tableheading" href="tiki-lastchanges.php?days={$days}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'comment_desc'}comment_asc{else}comment_desc{/if}">
						<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'comment_desc'}ArrowUp{elseif $sort_mode eq 'comment_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
					</a>{tr}Comment{/tr}
				</td>
			</tr>
			
			{cycle values="even,odd" print=false}
			{section name=changes loop=$lastchanges}
				<tr class="{cycle}">
					<td>
						{$lastchanges[changes].lastModif|date_format:"%H:%M:%S de %d/%m"}
					</td>
					
					<td>
						{tooltip text="Ação realizada nessa modificação: "|cat:{tr}$lastchanges[changes].action{/tr}}
							<a href="tiki-index.php?page={$lastchanges[changes].pageName|escape:"url"}" class="tablename">
								{$lastchanges[changes].pageName|truncate:18:"(...)":true}
							</a>
						{/tooltip}
					
					{if $lastchanges[changes].version}
					<div style="text-align:right">
					{tooltip text="A versão atual dessa página é <b>"|cat:$lastchanges[changes].version|cat:"</b>"}<a class="link" href="tiki-pagehistory.php?page={$lastchanges[changes].pageName|escape:"url"}">
					h</a>{/tooltip}&nbsp;
					
					<a class="link" href="tiki-pagehistory.php?page={$lastchanges[changes].pageName|escape:"url"}&amp;preview={$lastchanges[changes].version}"
					 title="{tr}view{/tr}">v</a>&nbsp;

					{if $tiki_p_rollback eq 'y'}
						<a class="link" href="tiki-rollback.php?page={$lastchanges[changes].pageName|escape:"url"}&amp;version={$lastchanges[changes].version}" title="{tr}rollback{/tr}">
						b</a>&nbsp;
					{/if}
					<a class="link" href="tiki-pagehistory.php?page={$lastchanges[changes].pageName|escape:"url"}&amp;diff={$lastchanges[changes].version}" title="{tr}compare{/tr}">
					c</a>&nbsp;
					<a class="link" href="tiki-pagehistory.php?page={$lastchanges[changes].pageName|escape:"url"}&amp;diff2={$lastchanges[changes].version}" title="{tr}diff{/tr}">
					d</a>&nbsp;
					<a class="link" href="tiki-pagehistory.php?page={$lastchanges[changes].pageName|escape:"url"}&amp;source={$lastchanges[changes].version}" title="{tr}source{/tr}">
					s</a>
					</div>
					{elseif $lastchanges[changes].versionlast}
						<div style="text-align:right;margin-right:5em">
						{tooltip text="A versão atual dessa página é <b>"|cat:$lastchanges[changes].version|cat:"</b>"}<a class="link" href="tiki-pagehistory.php?page={$lastchanges[changes].pageName|escape:"url"}">
						h</a>{/tooltip}
						</div>
					{/if}
					</td>
					<td>
						<a href="el-user.php?view_user={$lastchanges[changes].user}">{$lastchanges[changes].user}</a>
					</td>
					{*<td>
						{$lastchanges[changes].ip}
					</td>*}
					<td>
						{$lastchanges[changes].comment}
					</td>
				</tr>
			{sectionelse}
				<tr><td class="even" colspan="6">
				<b>{tr}No records found{/tr}</b>
				</td>
				</tr>
			{/section}
		</table>
		
		<div class="paginacao">
			{if $prev_offset >= 0}
				<a class="prevnext" href="tiki-lastchanges.php?find={$find}&amp;days={$days}&amp;offset={$prev_offset}&amp;sort_mode={$sort_mode}">
					<img src="styles/{$style|replace:".css":""}/img/iArrowGreyLeft.png">
				</a>
			{/if}
			
			{tr}Page{/tr} {$actual_page} {tr}de{/tr} {$cant_pages}
			
			{if $next_offset >= 0}
				<a class="prevnext" href="tiki-lastchanges.php?find={$find}&amp;days={$days}&amp;offset={$next_offset}&amp;sort_mode={$sort_mode}">
					<img src="styles/{$style|replace:".css":""}/img/iArrowGreyRight.png">
				</a>
			{/if}
			{if $direct_pagination eq 'y'}
				<br />
				{section loop=$cant_pages name=foo}
					{assign var=selector_offset value=$smarty.section.foo.index|times:$maxRecords}
						<a class="prevnext" href="tiki-lastchanges.php?find={$find}&amp;days={$days}&amp;offset={$selector_offset}&amp;sort_mode={$sort_mode}">
					{$smarty.section.foo.index_next}</a>
				{/section}
			{/if}
		</div>
	
	</div>

</div>