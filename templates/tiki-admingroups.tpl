{* $Header: /cvsroot/tikiwiki/tiki/templates/tiki-admingroups.tpl,v 1.52.2.32 2007/09/03 19:49:27 sylvieg Exp $ *}
{popup_init src="lib/overlib.js"}
<center>
<h1><a class="pagetitle" href="tiki-admingroups.php">{tr}Admin groups{/tr}</a>
{if $feature_help eq 'y'}
<a href="{$helpurl}Permissions+Settings" target="tikihelp" class="tikihelp" title="{tr}admin groups{/tr}">
<img src="img/icons/help.gif" border="0" height="16" width="16" alt='{tr}help{/tr}' />{/if}
{if $feature_help eq 'y'}</a>{/if}

{if $feature_view_tpl eq 'y'}
<a href="tiki-edit_templates.php?template=tiki-admingroups.tpl" target="tikihelp" class="tikihelp" title="{tr}View tpl{/tr}: {tr}admin groups template{/tr}">
{/if}
{if $feature_view_tpl eq 'y'}</a>{/if}</h1>

<span class="button2"><a href="tiki-admingroups.php" class="linkbut">{tr}Admin groups{/tr}</a></span>
<span class="button2"><a href="tiki-adminusers.php" class="linkbut">{tr}Admin users{/tr}</a></span>
<span class="button2"><a href="tiki-admingroups.php?clean=y" class="linkbut">{tr}Clear cache{/tr}</a></span>
{if $groupname}
<span class="button2"><a href="tiki-admingroups.php?add=1{if $feature_tabs ne 'y'}#2{/if}" class="linkbut">{tr}Add new group{/tr}</a></span>
{/if}
<br /><br />

<br />

{if $feature_tabs eq 'y'}
{cycle name=tabs values="1,2,3,4" print=false advance=false reset=true}
<div id="page-bar">
<span id="tab{cycle name=tabs advance=false assign=tabi}{$tabi}" class="tabmark" style="border-color:{if $smarty.cookies.tab eq $tabi}black{else}white{/if};"><a href="javascript:tikitabs({cycle name=tabs},5);">{tr}List{/tr}</a></span>
{if $groupname}
<span id="tab{cycle name=tabs advance=false assign=tabi}{$tabi}" class="tabmark" style="border-color:{if $smarty.cookies.tab eq $tabi}black{else}white{/if};"><a href="javascript:tikitabs({cycle name=tabs},5);">{tr}Edit group{/tr} <i>{$groupname}</i></a></span>
<span id="tab{cycle name=tabs advance=false assign=tabi}{$tabi}" class="tabmark" style="border-color:{if $smarty.cookies.tab eq $tabi}black{else}white{/if};"><a href="javascript:tikitabs({cycle name=tabs},5);">{tr}Members{/tr}</a></span>
{else}
<span id="tab{cycle name=tabs advance=false assign=tabi}{$tabi}" class="tabmark" style="border-color:{if $smarty.cookies.tab eq $tabi}black{else}white{/if};"><a href="javascript:tikitabs({cycle name=tabs},5);">{tr}Add a new group{/tr}</a></span>
{/if}
</div>
{/if}

{cycle name=content values="1,2,3,4" print=false advance=false reset=true}
{* ----------------------- tab with list --------------------------------------- *}
<div id="content{cycle name=content assign=focustab}{$focustab}" class="tabcontent"{if $feature_tabs eq 'y'} style="display:{if $focustab eq $cookietab}block{else}none{/if};"{/if}>
<h2>{tr}List of existing groups{/tr}</h2>

<form method="get" action="tiki-admingroups.php">
<table class="findtable"><tr>
<td><label for="groups_find">{tr}Find{/tr}</label></td>
<td><input type="text" name="find" id="groups_find" value="{$find|escape}" /></td>
<td><input type="submit" class="button" value="{tr}find{/tr}" name="search" /></td>
<td>{tr}Number of displayed rows{/tr}</td>
<td><input type="text" size="4" name="numrows" value="{$numrows|escape}" />
<input type="hidden" name="sort_mode" value="{$sort_mode|escape}" /></td>
</tr></table>
</form>

{if $cant_pages > 1}
<div align="center">
{section name=ini loop=$initials}
{if $initial and $initials[ini] eq $initial}
<span class="button2"><span class="linkbut">{$initials[ini]|capitalize}</span></span> . 
{else}
<a href="tiki-admingroups.php?initial={$initials[ini]}{if $find}&amp;find={$find|escape:"url"}{/if}{if $numrows}&amp;numrows={$numrows}{/if}{if $sort_mode}&amp;sort_mode={$sort_mode}{/if}" 
class="prevnext">{$initials[ini]}</a> . 
{/if}
{/section}
<a href="tiki-admingroups.php?initial={if $find}&amp;find={$find|escape:"url"}{/if}{if $numrows}&amp;numrows={$numrows}{/if}{if $sort_mode}&amp;sort_mode={$sort_mode}{/if}" 
class="prevnext">{tr}All{/tr}</a>
</div>
{/if}

<table class="normal">
<tr>
<td class="heading" style="width: 20px;">&nbsp;</td>
<td class="heading"><a class="tableheading" href="tiki-admingroups.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'groupName_desc'}groupName_asc{else}groupName_desc{/if}">{tr}name{/tr}</a></td>
<td class="heading"><a class="tableheading" href="tiki-admingroups.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'groupDesc_desc'}groupDesc_asc{else}groupDesc_desc{/if}">{tr}desc{/tr}</a></td>
<td class="heading">{tr}Includes{/tr}</td>
<td class="heading">{tr}Permissions{/tr}</td>
<td class="heading" style="width: 20px;">&nbsp;</td>
</tr>
{cycle values="even,odd" print=false}
{section name=user loop=$users}
<tr class="{cycle}">
<td style="width: 20px;"><a class="link" href="tiki-admingroups.php?group={$users[user].groupName|escape:"url"}" title="{tr}edit{/tr}"><img src="img/icons/edit.gif" border="0" width="20" height="16"  alt='{tr}edit{/tr}' /></a></td>
<td><a class="link" href="tiki-admingroups.php?group={$users[user].groupName|escape:"url"}{if $feature_tabs ne 'y'}#2{/if}" title="{tr}edit{/tr}">{$users[user].groupName}</a></td>
<td>{tr}{$users[user].groupDesc}{/tr}</td>
<td>
{section name=ix loop=$users[user].included}
{$users[user].included[ix]}<br />
{/section}
</td>
<td>
<a class="link" href="tiki-assignpermission.php?group={$users[user].groupName|escape:"url"}" title="{tr}permissions{/tr}"><img border="0" alt="{tr}permissions{/tr}" src="img/icons/key.gif" /> {$users[user].permcant}</a>
</td>
<td style="width: 20px;">
{if $users[user].groupName ne 'Anonymous' and $users[user].groupName ne 'Registered' and $users[user].groupName ne 'Admins'}<a class="link" href="tiki-admingroups.php?offset={$offset}&amp;sort_mode={$sort_mode}&amp;action=delete&amp;group={$users[user].groupName|escape:"url"}" 
title="{tr}delete{/tr}"><img border="0" alt="{tr}remove{/tr}" src="img/icons2/delete.gif" /></a>{/if}
</td>
</tr>
{/section}
</table>
{if $cant_pages > 1}
<br />
<div class="mini" align="center">
{if $prev_offset >= 0}
[<a class="prevnext" href="tiki-admingroups.php?find={$find|escape:"url"}&amp;{if $initial}initial={$initial}&amp;{/if}offset={$prev_offset}&amp;sort_mode={$sort_mode}&amp;numrows={$numrows}">{tr}prev{/tr}</a>]&nbsp;
{/if}
{tr}Page{/tr}: {$actual_page}/{$cant_pages}
{if $next_offset >= 0}
&nbsp;[<a class="prevnext" href="tiki-admingroups.php?find={$find|escape:"url"}&amp;{if $initial}initial={$initial}&amp;{/if}offset={$next_offset}&amp;sort_mode={$sort_mode}&amp;numrows={$numrows}">{tr}next{/tr}</a>]
{/if}
{if $direct_pagination eq 'y'}
<br />
{section loop=$cant_pages name=foo}
{assign var=selector_offset value=$smarty.section.foo.index|times:$numrows}
<a class="prevnext" href="tiki-admingroups.php?find={$find|escape:"url"}&amp;{if $initial}initial={$initial}&amp;{/if}offset={$selector_offset}&amp;sort_mode={$sort_mode}&amp;numrows={$numrows}">
{$smarty.section.foo.index_next}</a>&nbsp;
{/section}
{/if}
</div>
{/if}
</div>

{* ----------------------- tab with form --------------------------------------- *}
<a name="2" ></a>
<div id="content{cycle name=content assign=focustab}{$focustab}" class="tabcontent"{if $feature_tabs eq 'y'} style="display:{if $focustab eq $cookietab}block{else}none{/if};"{/if}>
{if $groupname}
<h2>{tr}Edit group{/tr} {$groupname}</h2>
<a class="linkbut" href="tiki-assignpermission.php?group={$groupname}">{tr}assign permissions{/tr}</a>
{else}
<h2>{tr}Add new group{/tr}</h2>
{/if}
<form action="tiki-admingroups.php" method="post">
<table class="normal">
<tr class="formcolor"><td><label for="groups_group">{tr}Group{/tr}:</label></td><td>{if $groupname neq 'Anonymous' and $groupname neq 'Registered' and $groupname neq 'Admins'}<input type="text" name="name" id="groups_group" value="{$groupname|escape}" />{else}<input type="hidden" name="name" id="groups_group" value="{$groupname|escape}" />{$groupname}{/if}</td></tr>
<tr class="formcolor"><td><label for="groups_desc">{tr}Description{/tr}:</label></td><td><textarea rows="5" cols="20" name="desc" id="groups_desc">{$groupdesc}</textarea></td></tr>
<tr class="formcolor"><td><label for="groups_inc">{tr}Include{/tr}:</label><br /><i>{tr}The group will have all the permissions of the included groups{/tr}</i></td><td>
{if $inc|@count > 20 and $hasOneIncludedGroup eq "y"}
{foreach key=gr item=yn from=$inc}{if $yn eq 'y'}{$gr|escape} {/if}{/foreach}<br />
{/if}
<select name="include_groups[]" id="groups_inc" multiple="multiple" size="4">
{foreach key=gr item=yn from=$inc}
<option value="{$gr|escape}" {if $yn eq 'y'} selected="selected"{/if}>{$gr|truncate:"52":" ..."}</option>
{/foreach}
</select>
</td></tr>
<tr class="formcolor"><td><label for="groups_home">{tr}Group Homepage{/tr}:<br />
({tr}Use wiki page name or full URL{/tr})<br />
To use a relative link, use ex.: <i>http:tiki-forums.php</i>
</label></td><td><input type="text" size="40" name="home" id="groups_home" value="{$grouphome|escape}" /></td></tr>
{if $groupTracker eq 'y'}
<tr class="formcolor"><td><label for="groupTracker">{tr}Group Information Tracker{/tr}</label></td><td>
<select name="groupstracker">
<option value="0">{tr}choose a group tracker ...{/tr}</option>
{foreach key=tid item=tit from=$trackers}
<option value="{$tid}"{if $tid eq $grouptrackerid} {assign var="ggr" value="$tit"}selected="selected"{/if}>{$tit}</option>
{/foreach}
</select>
{if $grouptrackerid}
<br />
<select name="groupfield">
<option value="0">{tr}choose a field ...{/tr}</option>
{section name=ix loop=$groupFields}
<option value="{$groupFields[ix].fieldId}"{if $groupFields[ix].fieldId eq $groupfieldid} selected="selected"{/if}>{$groupFields[ix].name}</option>
{/section}
</select>
{/if}
<span class="button2"><a href="{if $grouptrackerid}tiki-admin_tracker_fields.php?trackerId={$grouptrackerid}{else}tiki-admin_trackers.php{/if}" class="linkbut">{tr}admin{/tr} {$ggr}</a>
</td></tr>
{/if}
{if $userTracker eq 'y'}
<tr class="formcolor"><td><label for="userstracker">{tr}Users Information Tracker{/tr}</label></td><td>
<select name="userstracker">
<option value="0">{tr}choose a users tracker ...{/tr}</option>
{foreach key=tid item=tit from=$trackers}
<option value="{$tid}"{if $tid eq $userstrackerid} {assign var="ugr" value="$tit"}selected="selected"{/if}>{$tit}</option>
{/foreach}
</select>
{if $userstrackerid}
<br />
<select name="usersfield">
<option value="0">{tr}choose a field ...{/tr}</option>
{section name=ix loop=$usersFields}
<option value="{$usersFields[ix].fieldId}"{if $usersFields[ix].fieldId eq $usersfieldid} selected="selected"{/if}>{$usersFields[ix].name}</option>
{/section}
</select>
{/if}
<span class="button2"><a href="{if $grouptrackerid}tiki-admin_tracker_fields.php?trackerId={$userstrackerid}{else}tiki-admin_trackers.php{/if}" class="linkbut">{tr}admin{/tr} {$ugr}</a>
</td></tr>
{/if}
{if $group ne ''}
<tr class="formcolor"><td>&nbsp;
<input type="hidden" name="olgroup" value="{$group|escape}" />
</td><td><input type="submit" name="save" value="{tr}Save{/tr}" /></td></tr>
{else}
<tr class="formcolor"><td >&nbsp;</td><td><input type="submit" name="newgroup" value="{tr}Add{/tr}" /></td></tr>
{/if}
</table>
</form>
<br /><br />

{if $groupTracker eq 'y'}
{if $grouptrackerid and $groupitemid}
{tr}Group tracker item : {$groupitemid}{/tr} <span class="button2"><a href="tiki-view_tracker_item.php?trackerId={$grouptrackerid}&amp;itemId={$groupitemid}&amp;show=mod" class="linkbut">{tr}Edit item{/tr}</a></span>
{elseif $grouptrackerid}
{if $groupfieldid}
{tr}Group tracker item not found{/tr} <span class="button2"><a href="tiki-view_tracker.php?trackerId={$grouptrackerid}" class="linkbut">{tr}Create item{/tr}</a></span>
{else}
{tr}choose a field ...{/tr}
{/if}
{else}
{tr}choose a group tracker ...{/tr}
{/if}
<br /><br />
{/if}
</div>

{* ----------------------- tab with memberlist --------------------------------------- *}
<a name="3" ></a>
{if $groupname}
<div id="content{cycle name=content assign=focustab}{$focustab}" class="tabcontent"{if $feature_tabs eq 'y'} style="display:{if $focustab eq $cookietab}block{else}none{/if};"{/if}>
<h2>{tr}Members List{/tr}: {$groupname}</h2>
<table class="normal"><tr>
{if $memberslist}
{cycle name=table values=',,,,</tr><tr>' print=false advance=false}
{section name=ix loop=$memberslist}
<td class="formcolor auto"><a href="tiki-adminusers.php?user={$memberslist[ix]|escape:"url"}&action=removegroup&group={$groupname}{if $feature_tabs ne 'y'}#2{/if}" class="link" title="{tr}remove from group{/tr}"><img src="img/icons2/delete.gif" border="0" width="16" height="16"  alt='{tr}remove{/tr}'></a> <a href="tiki-adminusers.php?user={$memberslist[ix]|escape:"url"}{if $feature_tabs ne 'y'}#2{/if}" class="link" title="{tr}edit{/tr}"><img src="img/icons/edit.gif" border="0" width="20" height="16"  alt='{tr}edit{/tr}'></a> {$memberslist[ix]|userlink}</td>{cycle name=table}
{/section}
</tr></table>
<div class="box">{$smarty.section.ix.total} {tr}users in group{/tr} {$groupname}</div>
</div>
{else}
<td class="formcolor auto"><a href="tiki-admingroups.php?group={$groupname}&show=1{if $feature_tabs ne 'y'}#3{/if}" class="linkbut">{tr}List all members{/tr}</a></td>
</tr></table>
</div>
{/if}
{/if}
</center>
