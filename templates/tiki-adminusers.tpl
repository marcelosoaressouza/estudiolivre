{popup_init src="lib/overlib.js"}
<center>
<h1>
<a href="tiki-adminusers.php" class="pagetitle">{tr}Admin users{/tr}</a>

{if $feature_help eq 'y'}
<a href="{$helpurl}Users+Management" target="tikihelp" class="tikihelp" title="{tr}admin users{/tr}">
<img src="img/icons/help.gif" border="0" height="16" width="16" alt='{tr}help{/tr}' /></a>{/if}

{if $feature_view_tpl eq 'y'}
<a href="tiki-edit_templates.php?template=tiki-adminusers.tpl" target="tikihelp" class="tikihelp" title="{tr}View template{/tr}: {tr}admin users template{/tr}"></a>{/if}
</h1>
</center>
<!--
{if $tiki_p_admin eq 'y'} {* only full admins can manage groups, not tiki_p_admin_users *}
<span class="button2"><a href="tiki-admingroups.php" class="linkbut">{tr}Admin groups{/tr}</a></span>
{/if}
-->
<!-- <span class="button2"><a href="tiki-adminusers.php" class="linkbut">{tr}Admin users{/tr}</a></span> -->

{if $userinfo.userId}
<!-- <span class="button2"><a href="tiki-adminusers.php?add=1" class="linkbut">{tr}Add a new user{/tr}</a></span> -->
{/if}

{if $feature_intertiki eq 'y' and !empty($feature_intertiki_mymaster)}
  <br /><br /><b>{tr}Warning: since this tiki site is in slave mode, all user information you enter manually will be automatically overriden by other site's data, including users permissions{/tr}</b>
{/if}
  
{if $tikifeedback}
<br /><div class="simplebox {if $tikifeedback[n].num > 0} highlight{/if}">{section name=n loop=$tikifeedback}{$tikifeedback[n].mes}<br />{/section}</div>
{/if}

{if $added != "" or $discarded != ""}
<div class="simplebox">
<h2>{tr}Batch Upload Results{/tr}</h2>
{tr}Added users{/tr}: {$added}
{if $discarded != ""}
- {tr}Rejected users{/tr}: {$discarded}<br /><br/>
<table class="normal">
<tr><td class="headingUser">{tr}Username{/tr}</td><td class="headingUser">{tr}Reason{/tr}</td></tr>
{section name=reject loop=$discardlist}
<tr><td class="odd">{$discardlist[reject].login}</td><td class="odd">{$discardlist[reject].reason}</td></tr>
{/section}
</table>
{/if}
{if $errors}
<br />
{section name=ix loop=$errors}
{$errors[ix]}<br />
{/section}
{/if}
</div>
{/if}

{if $feature_tabs eq 'y'}
{cycle name=tabs values="1,2,3,4" print=false advance=false reset=true}
<div id="page-bar">
<!-- <span id="tab{cycle name=tabs advance=false assign=tabi}{$tabi}" class="tabmark" style="border-color:{if $cookietab eq $tabi}black{else}white{/if};"><a href="javascript:tikitabs({cycle name=tabs},3);">{tr}Users{/tr}</a></span> -->
{if $userinfo.userId}
<!-- <center><h2><span id="tab{cycle name=tabs advance=false assign=tabi}{$tabi}" class="tabmark" style="border-color:{if $cookietab eq $tabi}black{else}white{/if};"><a href="javascript:tikitabs({cycle name=tabs},3);">{tr}Edit user{/tr} <i>{$userinfo.login}</i></a></span></h2></center> -->
{else}
<!-- <center><span id="tab{cycle name=tabs advance=false assign=tabi}{$tabi}" class="tabmark" style="border-color:{if $cookietab eq $tabi}black{else}white{/if};"><a href="javascript:tikitabs({cycle name=tabs},3);"><div class="warning">{tr}Add a new user{/tr}</div></a></span></center> -->
{/if}
</span>
</div>
{/if}
{cycle name=content values="1,2,3,4" print=false advance=false reset=true}
{* ---------------------- tab with list -------------------- *}
<div id="content{cycle name=content assign=focustab}{$focustab}" class="tabcontent"{if $feature_tabs eq 'y'} style="display:{if $focustab eq $cookietab}block{else}none{/if};"{/if}>
<center>
<h2>{tr}Users{/tr}</h2>

<form method="get" action="tiki-adminusers.php">
<table class="findtable"><tr>
<td>{tr}Find{/tr}</td>
<td><input type="text" name="find" value="{$find|escape}" /></td>
<td><input type="submit" class="button" value="{tr}find{/tr}" name="search" /></td>
<td>{tr}Number of displayed rows{/tr}</td>
<td><input type="text" size="4" name="numrows" value="{$numrows|escape}" />
<input type="hidden" name="sort_mode" value="{$sort_mode|escape}" /></td>
</tr></table>
</form>
<br/><br/>
{if $cant_pages > 1}
<div align="center">
{section name=ini loop=$initials}
{if $initial and $initials[ini] eq $initial}
<span class="button2"><span class="linkbuton">{$initials[ini]|capitalize}</span></span> . 
{else}
<a href="tiki-adminusers.php?initial={$initials[ini]}{if $find}&amp;find={$find|escape:"url"}{/if}{if $numrows}&amp;numrows={$numrows}{/if}{if $sort_mode}&amp;sort_mode={$sort_mode}{/if}" 
class="prevnext">{$initials[ini]}</a> . 
{/if}
{/section}
<a href="tiki-adminusers.php?initial={if $find}&amp;find={$find|escape:"url"}{/if}{if $numrows}&amp;numrows={$numrows}{/if}{if $sort_mode}&amp;sort_mode={$sort_mode}{/if}" 
class="prevnext">{tr}All{/tr}</a>
</div>
{/if}
<br/><br/>
<form name="checkform" method="post" action="{$smarty.server.PHP_SELF}{if $group_management_mode ne  'y' and $set_default_groups_mode ne 'y'}#multiple{/if}">
<table class="tableUser">
<tr class="trUser">
<td class="headingUser auto">&nbsp;</td>
<td class="headingUser"><a class="tableheading" href="tiki-adminusers.php?offset={$offset}&amp;numrows={$numrows}&amp;sort_mode={if $sort_mode eq 'login_desc'}login_asc{else}login_desc{/if}">{tr}Name{/tr}</a></td>
<td class="headingUser"><a class="tableheading" href="tiki-adminusers.php?offset={$offset}&amp;numrows={$numrows}&amp;sort_mode={if $sort_mode eq 'email_desc'}email_asc{else}email_desc{/if}">{tr}Email{/tr}</a></td>
<!-- <td class="headingUser">{tr}Real Name{/tr}</td> -->
<td class="headingUser"><a class="tableheading" href="tiki-adminusers.php?offset={$offset}&amp;numrows={$numrows}&amp;sort_mode={if $sort_mode eq 'currentLogin_desc'}currentLogin_asc{else}currentLogin_desc{/if}">{tr}Last login{/tr}</a></td>
<td class="headingUser">&nbsp;</td>
<td class="headingUser">&nbsp;</td>
<td class="headingUser">&nbsp;</td>
<!-- <td class="headingUser">{tr}Groups{/tr}</td> -->
<td class="headingUser">&nbsp;</td>
</tr>
{cycle print=false values="even,odd"}
{section name=user loop=$users}
<tr class="{cycle}">
<td class="thin"><input type="checkbox" name="checked[]" value="{$users[user].user}" {if $users[user].checked eq 'y'}checked="checked" {/if}/></td>

<td class="thin"><a class="link" href="tiki-adminusers.php?offset={$offset}&amp;numrows={$numrows}&amp;sort_mode={$sort_mode}&amp;user={$users[user].userId}{if feature_tabs ne 'y'}#2{/if}" title="{tr}edit account settings{/tr}">{$users[user].user}</a></td>
<td class="thin">{$users[user].email}</td>
<!-- <td class="thin">{$users[user].realName}</td> -->
<td class="thin">{if $users[user].currentLogin eq ''}{tr}Never{/tr} <i>({$users[user].age|duration_short})</i>{else}{$users[user].currentLogin|dbg|tiki_long_datetime}{/if}</td>

<td class="thin"><a class="link" href="tiki-user_preferences.php?view_user={$users[user].user}" title="{tr}Change user preferences{/tr}: {$users[user].user}"><img border="0" alt="{tr}Change user preferences{/tr}: {$users[user].user}" src="img/icons/config.gif" /></a></td>
<td class="thin"><a class="link" href="tiki-adminusers.php?offset={$offset}&amp;numrows={$numrows}&amp;sort_mode={$sort_mode}&amp;user={$users[user].userId}{if feature_tabs ne 'y'}#2{/if}"  
title="{tr}edit account settings{/tr}: {$users[user].user}"><img border="0" alt="{tr}edit account settings{/tr}: {$users[user].user}" src="img/icons/edit.gif" /></a></td>

<td class="thin"><a class="link" href="tiki-assignuser.php?assign_user={$users[user].user|escape:url}" title="{tr}Assign Group{/tr}"><img border="0" alt="{tr}Assign Group{/tr}" src="img/icons/key.gif" /></a></td>
<!--
<td class="thin">
{foreach from=$users[user].groups key=grs item=what}
{if $grs != "Anonymous"}
{if $what eq 'included'}<i>{/if}<a class="link" href="tiki-admingroups.php?group={$grs|escape:"url"}" title={if $what eq 'included'}"{tr}edit included group{/tr}"{else}"{tr}edit{/tr}"{/if}>{$grs}</a>{if $what eq 'included'}</i>{/if}
{if $what ne 'included' and $grs != "Anonymous" and $grs != "Registered"}(<a class="link" href="tiki-adminusers.php?offset={$offset}&amp;numrows={$numrows}&amp;sort_mode={$sort_mode}&amp;user={$users[user].user}&amp;action=removegroup&amp;group={$grs|escape:"url"}" title="{tr}remove{/tr}">x</a>){/if}
{if $grs eq $users[user].default_group} {tr}default{/tr}{/if}<br />
{/if}
{/foreach}
-->
<td  class="thin">{if $users[user].user ne 'admin'}<a class="link" href="tiki-adminusers.php?offset={$offset}&amp;numrows={$numrows}&amp;sort_mode={$sort_mode}&amp;action=delete&amp;user={$users[user].user|escape:url}"
title="{tr}delete{/tr}"><img src="img/icons2/delete.gif" border="0" alt='{tr}delete{/tr}' /></a>{/if}
</td>
</tr>
{/section}
  <script type='text/javascript'>
  <!--
  // check / uncheck all.
  // in the future, we could extend this to happen serverside as well for the convenience of people w/o javascript.
  // for now those people just have to check every single box
  document.write("<tr><td class=\"thin\"><input name=\"switcher\" id=\"clickall\" type=\"checkbox\" onclick=\"switchCheckboxes(this.form,'checked[]',this.checked)\"/></td>");
  document.write("<td class=\"form\" colspan=\"18\"><label for=\"clickall\">{tr}select all{/tr}</label></td></tr>");
  //-->                     
  </script>
  <tr>
  <td class="form" colspan="18">
  <a name="multiple"></a><p align="left"> {*on the left to have it close to the checkboxes*}
  {if $group_management_mode neq 'y' && $set_default_groups_mode neq 'y'}
  {tr}Perform action with checked:{/tr}
  <select name="submit_mult">
    <option value="" selected>-</option>
    <option value="remove_users" >{tr}remove{/tr}</option>
    {if $feature_wiki_userpage == 'y'}<option value="remove_users_with_page">{tr}remove users and their userpages{/tr}</option>{/if}
    <option value="assign_groups" >{tr}manage group assignments{/tr}</option>
    <option value="set_default_groups">{tr}set default groups{/tr}</option>
  </select>
  <input type="submit" class="button" value="{tr}ok{/tr}" />
  {elseif $group_management_mode eq 'y'}
  <select name="group_management">
  	<option value="add">{tr}Assign selected to{/tr}</option>
  	<option value="remove">{tr}Remove selected from{/tr}</option>
  </select>
  {tr}the following groups:{/tr}<br />
  <select name="checked_groups[]" multiple="multiple" size="20">
  {section name=ix loop=$groups}
  	<option value="{$groups[ix].groupName}">{$groups[ix].groupName}</option>
  {/section}
  </select><br /><input type="submit" value="{tr}ok{/tr}" /><div class="simplebox">{tr}Tip: hold down CTRL to select multiple{/tr}</div>
  {elseif $set_default_groups_mode eq 'y'}
  {tr}Set the default group of the selected users to{/tr}:<br />
  <select name="checked_group" size="20">
  {section name=ix loop=$groups}
  	<option value="{$groups[ix].groupName|escape}" />{$groups[ix].groupName}</option>
  {/section}
  </select><br /><input type="submit" value="{tr}ok{/tr}" />
  <input type="hidden" name="set_default_groups" value="{$set_default_groups_mode}" />
  {/if}
  </p>
  </td></tr>
  </table>
  
<input type="hidden" name="find" value="{$find|escape}" />
<input type="hidden" name="numrows" value="{$numrows|escape}" />
<input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
<input type="hidden" name="offset" value="{$offset|escape}" />
</form>

{if $cant_pages > 1}
<br />
<div class="mini">
{if $prev_offset >= 0}
[<a class="prevnext" href="tiki-adminusers.php?{if $find}find={$find|escape:"url"}&amp;{/if}{if $initial}initial={$initial}&amp;{/if}offset={$prev_offset}&amp;numrows={$numrows}&amp;sort_mode={$sort_mode}">{tr}prev{/tr}</a>]&nbsp;
{/if}
{tr}Page{/tr}: {$actual_page}/{$cant_pages}
{if $next_offset >= 0}
&nbsp;[<a class="prevnext" href="tiki-adminusers.php?{if $find}find={$find|escape:"url"}&amp;{/if}{if $initial}initial={$initial}&amp;{/if}offset={$next_offset}&amp;numrows={$numrows}&amp;sort_mode={$sort_mode}">{tr}next{/tr}</a>]
{/if}
{if $direct_pagination eq 'y'}
<br />
{section loop=$cant_pages name=foo}
{assign var=selector_offset value=$smarty.section.foo.index|times:$maxRecords}

<a class="prevnext" href="tiki-adminusers.php?find={$find|escape:"url"}&amp;{if $initial}initial={$initial}&amp;{/if}offset={$selector_offset}&amp;numrows={$numrows}&amp;sort_mode={$sort_mode}">
{$smarty.section.foo.index_next}</a>&nbsp;
{/section}
{/if}

</div>
{/if}
</div>

{* ---------------------- tab with form -------------------- *}
<a name="2" ></a>
<div id="content{cycle name=content assign=focustab}{$focustab}" class="tabcontent"{if $feature_tabs eq 'y'} style="display:{if $focustab eq $cookietab}block{else}none{/if};"{/if}>
{if $userinfo.userId}
<center><h2>{tr}Edit user{/tr}: {$userinfo.login}</h2></center><br/>
<!-- <a class="linkbut" href="tiki-assignuser.php?assign_user={$userinfo.login|escape:url}">{tr}assign to groups{/tr}: {$userinfo.login}</a> -->
{else}
<h2>{tr}Add a new user{/tr}</h2>
{/if}
<form action="tiki-adminusers.php" method="post" enctype="multipart/form-data">
<table class="normal">
<tr class="formcolor"><td>{tr}User{/tr}:</td><td><input type="text" name="name"  disabled value="{$userinfo.login|escape}" /><br />

{if $userinfo.login eq 'admin'}
<div class="highlight">
{tr}Warning: Are you sure you want to rename the "admin" user? It's better to add a new user and to assign this new user to the "Admins" group{/tr}<br />
</div>
{/if}
<!--
{if $userinfo.userId}
  {if $feature_intertiki_server eq 'y'}
    <i>{tr}Warning: changing the username will require the user to change his password and will mess with slave intertiki sites that use this one as master{/tr}</i>
  {else}
    <i>{tr}Warning: changing the username will require the user to change his password{/tr}</i>
  {/if}
{/if}
-->
</td></tr>
<tr class="formcolor"><td>{tr}Pass{/tr}:</td><td><input type="password" name="pass" id="pass" /></td></tr>
<tr class="formcolor"><td>{tr}Again{/tr}:</td><td><input type="password" name="pass2" id="pass2" /></td></tr>
<tr class="formcolor"><td>{tr}Email{/tr}:</td><td><input type="text" name="email" size="30"  value="{$userinfo.email|escape}" /></td></tr>
<tr class="formcolor"><td>{tr}Real Name{/tr}:</td><td><input type="text" name="realname" size="50"  value="{$userinfo.realName|escape}" /></td></tr>
{if $userinfo.userId != 0}
<tr class="formcolor"><td>{tr}Created{/tr}:</td><td>{$userinfo.created|tiki_long_datetime}</td></tr>
<tr class="formcolor"><td>{tr}Registration{/tr}:</td><td>{if $userinfo.registrationDate}{$userinfo.registrationDate|tiki_long_datetime}{/if}</td></tr>
<!-- <tr class="formcolor"><td>{tr}Last login{/tr}:</td><td>{if $userinfo.lastLogin}{$userinfo.lastLogin|tiki_long_datetime}{/if}</td></tr> -->
{/if}
{if $userinfo.userId}

<tr class="formcolor"><td>&nbsp;</td><td>
<input type="hidden" name="user" value="{$userinfo.userId|escape}" />
<input type="hidden" name="edituser" value="1" />
<br/>
<input type="submit" name="submit" class="button" value="{tr}Save{/tr}" />

{else}
<tr class="formcolor"><td>&nbsp;</td><td>
<input type="submit" name="submit" value="{tr}Add{/tr}" />
</td></tr>

<tr class="formcolor"><td>
<a class="link" href="javascript:genPass('genepass','pass','pass2');">{tr}Generate a password{/tr}</a></td>
<td><input id='genepass' type="text" /></td></tr>
</table>
<br />
<h2>{tr}Batch upload{/tr}</h2>
<table>
<tr class="formcolor"><td>{tr}Batch upload (CSV file<a {popup text='login,password,email,groups<br />user1,password1,email1,&quot;group1,group2&quot;<br />user2,password2,email2'}><img src="img/icons/help.gif" border="0" height="16" width="16" alt='{tr}help{/tr}' /></a>){/tr}:</td><td><input type="file" name="csvlist"/><br />{tr}Overwrite{/tr}: <input type="checkbox" name="overwrite" checked="checked" /></td></tr>
<tr class="formcolor"><td>&nbsp;</td><td>
<input type="hidden" name="newuser" value="1" />
<input type="submit" name="submit" value="{tr}Add{/tr}" />
{/if}
</td></tr>
</table>
</form>
<br /><br />

{if $userTracker eq 'y'}
{if $userstrackerid and $usersitemid}
{tr}User tracker item : {$usersitemid}{/tr} <span class="button2"><a href="tiki-view_tracker_item.php?trackerId={$userstrackerid}&amp;itemId={$usersitemid}&amp;show=mod" class="linkbut">{tr}Edit item{/tr}</a></span>
{/if}
<br /><br />
{/if}

</div>

