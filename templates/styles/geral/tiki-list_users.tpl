{css only=list}
{* $Header: /cvsroot/arca/estudiolivre/src/templates/styles/geral/tiki-list_users.tpl,v 1.1 2007-06-14 21:52:12 garotasimpatica Exp $ *}
<div id="users">
<h1>
	{if !$find}
		{tr}Lista de usuári@s{/tr}
	{else}
		{tr}Busca de usuári@s{/tr}	
	{/if}
</h1>
{*================
	{if $feature_help eq 'y'}
		<a href="{$helpurl}UserList" target="tikihelp" class="tikihelp" title="{tr}User List{/tr}">
			<img src="img/icons/help.gif" border="0" height="16" width="16" alt='{tr}help{/tr}' />
		</a>
	{/if}
==================*}
<h5>
	{$cant_users}
		{if !$find}
			{tr}users registered{/tr}
		{else}
			{tr}resultado{/tr}{if $cant_users > 1}s{/if} {tr}para{/tr} "{$find}"<br>
			{tr}Veja{/tr} <a href="tiki-list_users.php">{tr}a lista de todos os usuári@s{/tr}</a>.
		{/if}
</h5>

{*===============
<table class="findtable">
<tr><td class="findtable">{tr}Find{/tr}</td>
   <td class="findtable">
   <form method="get" action="tiki-list_users.php">
     <input type="text" name="find" value="{$find|escape}" />
     <input type="submit" value="{tr}find{/tr}" name="search" />
     <input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
   </form>
   </td>
</tr>
</table>
==================*}

{*===============
para a sua apreciação: esse eh o codigo que era usado pelo tiki-view_trackers para colocar paginacao 'por letras'
{if $cant_pages > 1 or $initial}
	<div align="center">
		{section name=ini loop=$initials}
			{if $initial and $initials[ini] eq $initial}
				<span class="button2">
					<span class="linkbuton">{$initials[ini]|capitalize}</span>
				</span> . 
			{else}
				<a href="tiki-view_tracker.php?initial={$initials[ini]}&amp;trackerId={$trackerId}{if $sort_mode}&amp;sort_mode={$sort_mode}{/if}{if $status}&amp;status={$status|escape:"url"}{/if}" 
				class="prevnext">{$initials[ini]}</a> . 
			{/if}
		{/section}
		<a href="tiki-view_tracker.php?initial=&amp;trackerId={$trackerId}{if $sort_mode}&amp;sort_mode={$sort_mode}{/if}{if $status}&amp;status={$status|escape:"url"}{/if}" 
		class="prevnext">{tr}All{/tr}</a>
	</div>
{/if}
==================*}			
			
<table width="100%">
	<tr>
		<td class="heading">
				{tr}Avatar{/tr}
		</td>
		<td class="heading">
			{tooltip text="Clique para que a listagem seja por <b>ordem alfabética</b> de nome de usuári@"}
			<a href="tiki-list_users.php?{if $find}find={$find}&amp;{/if}offset={$offset}&amp;sort_mode={if $sort_mode eq 'login_desc'}login_asc{else}login_desc{/if}" class="userlistheading">
				<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'login_desc'}ArrowUp{elseif $sort_mode eq 'login_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
				{tr}User{/tr}
			</a>
			{/tooltip}
		</td>
		<td class="heading">
			{tooltip text="Clique para que a listagem seja por <b>ordem alfabética</b> de nome completo"}
			<a class="userlistheading" href="tiki-list_users.php?{if $find}find={$find}&amp;{/if}offset={$offset}&amp;sort_mode={if $sort_mode eq 'realName_desc'}realName_asc{else}realName_desc{/if}">
				<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'realName_desc'}ArrowUp{elseif $sort_mode eq 'realName_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
				{tr}Real Name{/tr}
			</a>
			{/tooltip}
		</td>
		{*================
		<td class="heading">
			Email
		</td>
		<td class="heading">
			Site
		</td>
		====================*}
		<td class="heading">
			{tooltip text="Clique para que a listagem seja por <b>ordem alfabética</b> de localização"}
			<a class="userlistheading" href="tiki-list_users.php?{if $find}find={$find}&amp;{/if}offset={$offset}&amp;sort_mode={if $sort_mode eq 'local_desc'}local_asc{else}local_desc{/if}">
				<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'local_desc'}ArrowUp{elseif $sort_mode eq 'local_asc'}ArrowDown{else}GreyArrowDown{/if}.png">
				{tr}Localização{/tr}
			</a>
			{/tooltip}
		</td>
		<td class="heading">
			{tooltip text="Clique para que a listagem seja por <b>ordem cronológica</b> de filiação ao site"}
				<a class="userlistheading" href="tiki-list_users.php?{if $find}find={$find}&amp;{/if}offset={$offset}&amp;sort_mode={if $sort_mode eq 'registrationDate_asc'}registrationDate_desc{else}registrationDate_asc{/if}">
					<img src="styles/{$style|replace:".css":""}/img/sort{if $sort_mode eq 'registrationDate_asc'}ArrowUp{elseif $sort_mode eq 'score_desc' || $sort_mode eq 'registrationDate_desc'}ArrowDown{else}GreyArrowDown{/if}.png">
					{tr}Membro desde{/tr}
				</a>
			{/tooltip}				
		</td>		
{*if $feature_score eq 'y'}
  <td class="heading"><a class="userlistheading" href="tiki-list_users.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'score_desc'}score_asc{else}score_desc{/if}">{tr}Score{/tr}</a>&nbsp;</td>
{/if*}

{*==============
  <td class="heading">{tr}Country{/tr}&nbsp;</td>
  <td class="heading">{tr}Distance (km){/tr}&nbsp;</td>
===============*}
	</tr>
	{section name=changes loop=$listusers}
	{cycle values="odd,even" assign="currentClass" print=false}
		<tr class="{$currentClass}">
			<td class="foto">
				<a href="el-user.php?view_user={$listusers[changes].login}">
					<img src="tiki-show_user_avatar.php?user={$listusers[changes].login}" width=50 height=50/>
				</a>
			</td>
			<td>
				<a href="el-user.php?view_user={$listusers[changes].login}">
					{$listusers[changes].login}
				</a>
			</td>
			
			<td>
				{$listusers[changes].realName}
			</td>
			
			{if $feature_score eq 'y'}
			   <td class="odd">&nbsp;{$listusers[changes].score}&nbsp;</td>
			{/if}
			
			{*===============
			<td>
				{tr}{$listusers[changes].email}{/tr}
			</td>
			
			<td>
				{tr}{$listusers[changes].site}{/tr}
			</td>
			================*}
			
			<td>
				{tr}{$listuserscountry[changes]}{/tr}
			</td>
  			
  			{*===========================
				  {if $listuserscountry[changes] == "None" || $listuserscountry[changes] == "Other" || $listuserscountry[changes] == ""}
				  {html_image file='img/flags/Other.gif' border='0' hspace='4' vspace='1' alt='{tr}flag{/tr}' title='{tr}flag{/tr}'}
				  {else}
				  {html_image file="img/flags/$listuserscountry[changes].gif" hspace='4' vspace='1' alt='{tr}flag{/tr}' title='{tr}flag{/tr}'}
				  &nbsp;{tr}{$listuserscountry[changes]}{/tr}
			      {/if}    
				  &nbsp;</td>
				  <td>&nbsp;{$listdistance[changes]}&nbsp;</td>
			 =========================*}
			 <td>
			 	{assign var=listusersreg value=$listusers[changes].registrationDate}
				 {$listusersreg|date_format:"%d/%m/%Y"}
			 </td>
		</tr>
	{sectionelse}
		<tr>
			<td colspan="6">
				<b>{tr}No records found{/tr}</b>
			</td>
		</tr>
	{/section}
</table>
<br />
<div class="paginacao">
	{if $prev_offset >= 0}
		<a class="userprevnext" href="tiki-list_users.php?find={$find}&amp;offset={$prev_offset}&amp;sort_mode={$sort_mode}">
			<img src="styles/{$style|replace:".css":""}/img/iArrowGreyLeft.png">
		</a>
	{/if}
	
	{tr}Page{/tr} {$actual_page} {tr}de{/tr} {$cant_pages}
	
	{if $next_offset >= 0}
		<a class="userprevnext" href="tiki-list_users.php?find={$find}&amp;offset={$next_offset}&amp;sort_mode={$sort_mode}">
			<img src="styles/{$style|replace:".css":""}/img/iArrowGreyRight.png">
		</a>
	{/if}
	{if $direct_pagination eq 'y'}
		<br />
		{section loop=$cant_pages name=foo}
			{assign var=selector_offset value=$smarty.section.foo.index|times:$maxRecords}
				<a class="prevnext" href="tiki-list_users.php?find={$find}&amp;offset={$selector_offset}&amp;sort_mode={$sort_mode}">
			{$smarty.section.foo.index_next}</a>
		{/section}
	{/if}
</div>
</div>