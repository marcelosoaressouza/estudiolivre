{* $Header: /cvsroot/tikiwiki/tiki/templates/Attic/tiki-pagepermissions.tpl,v 1.16.2.3 2005/05/12 20:41:32 sylvieg Exp $ *}

<h2>{tr}Assign permissions to page{/tr}: <a href="tiki-index.php?page={$page}">{$page}</a></h2>
<h3>{tr}Current permissions for this page{/tr}:</h3>
<table class="normal">
<tr><td class="heading">{tr}group{/tr}</td><td class="heading">{tr}permission{/tr}</td><td class="heading">{tr}action{/tr}</td></tr>
{cycle print=false values="even,odd"}
{section  name=pg loop=$page_perms}
<tr>
  <td class="{cycle advance=false}">{$page_perms[pg].groupName}</td>
  <td class="{cycle advance=false}">{$page_perms[pg].permName}</td>
  <td class="{cycle}">
    (<a class="link" href="tiki-pagepermissions.php?referer={$referer}&amp;action=remove&amp;objectName={$objectName}&amp;objectId={$objectId}&amp;objectType={$objectType}&amp;permType={$permType}&amp;page={$page}&amp;perm={$page_perms[pg].permName}&amp;group={$page_perms[pg].groupName}">{tr}remove from this page{/tr}</a>)
    {if $isStructure eq "y"}(<a class="link" href="tiki-pagepermissions.php?referer={$referer}&amp;action=removestructure&amp;objectName={$objectName}&amp;objectId={$objectId}&amp;objectType={$objectType}&amp;permType={$permType}&amp;page={$page}&amp;perm={$page_perms[pg].permName}&amp;group={$page_perms[pg].groupName}">{tr}remove from this structure{/tr}</a>){/if}
  </td></tr>
{sectionelse}
<tr><td>{tr}No individual permissions; category or global permissions apply{/tr}</td></tr>
{/section}
</table>
<h3>{tr}Assign permissions{/tr}</h3>
<form method="post" action="tiki-pagepermissions.php">
{tr}assign{/tr}
<input type="hidden" name="page" value="{$page|escape}" />
<select name="perm">
{section name=prm loop=$perms}
<option value="{$perms[prm].permName|escape}">{$perms[prm].permName}</option>
{/section}
</select>
{tr}to group{/tr}
<select name="group">
{section name=grp loop=$groups}
<option value="{$groups[grp].groupName|escape}">{$groups[grp].groupName}</option>
{/section}
</select>
{tr}for{/tr}
<input type="submit" name="assign" value="{tr}this page{/tr}" />
{if $inStructure eq "y"}<input type="submit" name="assignstructure" value="{tr}this structure{/tr}" />{/if}
</form>

<br /><br />
<h3>{tr}Current permissions for categories that this page belongs to{/tr}:</h3>
<table class="normal">
<tr><td class="heading">{tr}category{/tr}</td><td class="heading">{tr}group{/tr}</td><td class="heading">{tr}permission{/tr}</td></tr>
{cycle print=false values="even,odd"}
{section  name=x loop=$categ_perms}
	{section name=y loop=$categ_perms[x]}
<tr>
  <td class="{cycle advance=false}">{$categ_perms[x][0].catpath}</td>
  <td class="{cycle advance=false}">{$categ_perms[x][y].groupName}</td>
  <td class="{cycle advance=false}">{$categ_perms[x][y].permName}</td>
</tr>
	{/section}
{sectionelse}
<tr><td>{tr}No category permissions; global permissions apply{/tr}</td></tr>
{/section}
</table>

<br /><br /><br />
<h2>{tr}Send email notifications when this page changes to{/tr}:</h2>
<form action="tiki-pagepermissions.php" method="post">
<input type="hidden" name="page" value="{$page|escape}" />
{tr}add email{/tr}: <input type="text" name="email" />
<input type="submit" name="addemail" value="{tr}add{/tr}" />
</form>
<h3>{tr}Notifications{/tr}:</h3>
{section name=ix loop=$emails}
{$emails[ix]} (<a class="link" href="tiki-pagepermissions.php?page={$page}&amp;removeemail={$emails[ix]}">x</a>)<br />
{/section}