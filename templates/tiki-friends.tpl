<h1><a href="tiki-friends.php" class="pagetitle">{tr}Friendship Network{/tr}</a>
  
      {if $feature_help eq 'y'}
<a href="{$helpurl}Friendship+Network" target="tikihelp" class="tikihelp" title="{tr}Friendship Network{/tr}">
<img src="img/icons/help.gif" border="0" height="16" width="16" alt='{tr}help{/tr}' /></a>{/if}


      {if $feature_view_tpl eq 'y'}
<a href="tiki-edit_templates.php?template=tiki-friends.tpl" target="tikihelp" class="tikihelp" title="{tr}View tpl{/tr}: {tr}friends tpl{/tr}">
<img src="img/icons/info.gif" border="0" height="16" width="16" alt='{tr}edit tpl{/tr}' /></a>{/if}

</h1>

{if $msg}
<center>{$msg}</center>
<br /><br />
{/if}

{if $pending_requests|sizeof}
<p style="font-weight: bold;">{tr}Pending requests{/tr}</p>
<table class="userlist">
<tr>
  <td class="userlistheading">{tr}Login{/tr}</td>
  <td class="userlistheading">{tr}Request Time{/tr}</td>
  <td class="userlistheading">{tr}Actions{/tr}</td>
</tr>

{foreach from=$pending_requests item=time key=pending_user}
<tr>
  <td class="userlistodd">{$pending_user|userlink}</td>
  <td class="userlistodd">{$time|date_format}</td>
  <td class="userlistodd"><a href="tiki-friends.php?accept={$pending_user}">{tr}accept{/tr}</a>|<a href="tiki-friends.php?refuse={$pending_user}">{tr}refuse{/tr}</a></td>
</tr>
{/foreach}
</table>
{/if}

{if $waiting_requests|sizeof}
<p style="font-weight: bold;">{tr}Waiting requests{/tr}</p>
<table class="userlist">
<tr>
  <td class="userlistheading">{tr}Login{/tr}</td>
  <td class="userlistheading">{tr}Request Time{/tr}</td>
</tr>

{foreach from=$waiting_requests item=time key=wuser}
<tr>
  <td class="userlistodd">{$wuser|userlink}</td>
  <td class="userlistodd">{$time|date_format}</td>
</tr>
{/foreach}
</table>
{/if}
<p style="font-weight: bold;">{tr}Your friends{/tr}</p>
<table class="findtable">
<tr><td class="findtable">{tr}Find{/tr}</td>
   <td class="findtable">
   <form method="get" action="tiki-friends.php">
     <input type="text" name="find" value="{$find|escape}" />
     <input type="submit" value="{tr}find{/tr}" name="search" />
     <input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
   </form>
   </td>
</tr>
</table>

<table class="userlist">
{if $listpages}
<tr>
  <td class="userlistheading"><a class="userlistheading" href="tiki-friends.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'login_desc'}login_asc{else}login_desc{/if}">{tr}Login{/tr}</a></td>
  <td class="userlistheading"><a class="userlistheading" href="tiki-friends.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'realName_desc'}realName_asc{else}realName_desc{/if}">{tr}Real Name{/tr}</a></td>
  <td class="userlistheading">{tr}Action{/tr}</td>
</tr>
{/if}
{cycle values="odd,even" print=false}
{section name=changes loop=$listpages}
<tr>
  <td class="userlist{cycle advance=false}">
  <a class="userlistlogin{cycle advance=false}" href="tiki-user_information.php?view_user={$listpages[changes].login}">{$listpages[changes].login|userlink}</a>{if $feature_score eq 'y'}{$listpages[changes].score|star}{/if}
  </td>
  <td class="userlist{cycle advance=false}"><a class="userlistlogin{cycle advance=false}" href="tiki-user_information.php?view_user={$listpages[changes].login}">{$listpages[changes].realname}</a></td>
  <td class="userlist{cycle advance=true}"><a class="userlistlogin{cycle advance=false}" href="?break={$listpages[changes].login}"><img src="img/icons2/delete.gif" alt="{tr}break friendship{/tr}" border="0" /></a></td>
</tr>
{sectionelse}
<tr><td colspan="6" class="odd">
{tr}No records found{/tr}
</td></tr>
{/section}
</table>
<br />
<div class="mini" style="text-align: center;">
{if $prev_offset >= 0}
[<a class="userprevnext" href="tiki-friends.php?find={$find}&amp;offset={$prev_offset}&amp;sort_mode={$sort_mode}">{tr}prev{/tr}</a>]&nbsp;
{/if}
{tr}Page{/tr}: {$actual_page}/{$cant_pages}
{if $next_offset >= 0}
&nbsp;[<a class="userprevnext" href="tiki-friends.php?find={$find}&amp;offset={$next_offset}&amp;sort_mode={$sort_mode}">{tr}next{/tr}</a>]
{/if}
{if $direct_pagination eq 'y'}
<br />
{section loop=$cant_pages name=foo}
{assign var=selector_offset value=$smarty.section.foo.index|times:$maxRecords}
<a class="prevnext" href="tiki-friends.php?find={$find}&amp;offset={$selector_offset}&amp;sort_mode={$sort_mode}">
{$smarty.section.foo.index_next}</a>&nbsp;
{/section}
{/if}
</div>
