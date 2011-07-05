{popup_init src="lib/overlib.js"}
{*Smarty template*}
<h1><a class="pagetitle" href="tiki-g-admin_processes.php">{tr}Admin processes{/tr}</a>


  
      {if $feature_help eq 'y'}
<a href="{$helpurl}Workflow" target="tikihelp" class="tikihelp" title="{tr}Galaxia Admin Processes{/tr}">
<img src="img/icons/help.gif" border="0" height="16" width="16" alt='{tr}help{/tr}' /></a>{/if}



      {if $feature_view_tpl eq 'y'}
<a href="tiki-edit_templates.php?template=tiki-g-admin_processes.tpl" target="tikihelp" class="tikihelp" title="{tr}View tpl{/tr}: {tr}Galaxia Admin Processes tpl{/tr}">
<img src="img/icons/info.gif" border="0" height="16" width="16" alt='{tr}edit tpl{/tr}' /></a>{/if}

<div class="rbox" name="tip">
<div class="rbox-title" name="tip">{tr}Tip{/tr}</div>
<div class="rbox-data" name="tip">{tr}To learn more about the <a class="rbox-link" target="tikihelp" href="http://workflow.tikiwiki.org">Galaxia workflow engine</a>{/tr}
</div>
</div>
<br />



</h1>
{include file=tiki-g-monitor_bar.tpl}
<h2>{tr}Add or edit a process{/tr} <a class="link" href="tiki-g-admin_processes.php?WHERE={$Where}&amp;offset={$offset}&amp;sort_mode={$sort_mode}&amp;pid=0">{tr}new{/tr}</a>
</h2>
{if $pid > 0}
{include file=tiki-g-proc_bar.tpl}
{/if}
{if $pid > 0 and count($errors)}
<div class="wikitext">
{tr}This process is invalid{/tr}:<br />
{section name=ix loop=$errors}
<small>{$errors[ix]}</small><br />
{/section}
</div>
{/if}
<form action="tiki-g-admin_processes.php" method="post">
<input type="hidden" name="version" value="{$info.version|escape}" />
<input type="hidden" name="pid" value="{$info.pId|escape}" />
<input type="hidden" name="offset" value="{$offset|escape}" />
<input type="hidden" name="where" value="{$where|escape}" />
<input type="hidden" name="find" value="{$find|escape}" />
<input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
<table class="normal">
	<tr>
		<td class="formcolor">{tr}Process Name{/tr}</td>
		<td class="formcolor"><input type="text" maxlength="80" name="name" value="{$info.name|escape}" /> {tr}ver:{/tr}{$info.version}</td>
	</tr>
	<tr>
	 	<td class="formcolor">{tr}Description{/tr}</td>
	 	<td class="formcolor"><textarea rows="5" cols="60" name="description">{$info.description|escape}</textarea></td>
	</tr>
	<tr>
		<td class="formcolor"><a {popup text="$is_active_help"}>{tr}is active?{/tr}</a></td>
		<td class="formcolor"><input type="checkbox" name="isActive" {if $info.isActive eq 'y'}checked="checked"{/if} /></td>
	</tr>
	<tr>
		<td class="formcolor">&nbsp;</td>
		<td class="formcolor"><input type="submit" name="save" value="{if $pid > 0}{tr}update{/tr}{else}{tr}create{/tr}{/if}" /></td>
	</tr>
</table>
</form>

<h2>{tr}Or upload a process using this form{/tr}</h2>
<form enctype="multipart/form-data" action="tiki-g-admin_processes.php" method="post">
<table class="normal">
<tr>
  <td class="formcolor">{tr}Upload file{/tr}:</td>
  <td class="formcolor">
      <input type="hidden" name="MAX_FILE_SIZE" value="10000000000000" />
      <input size="16" name="userfile1" type="file" />
      <input style="font-size:9px;" type="submit" name="upload" value="{tr}upload{/tr}" />
  </td>
</tr>
</table>
</form>


<h2>{tr}List of processes{/tr} ({$cant})</h2>
<form action="tiki-g-admin_processes.php" method="post">
<input type="hidden" name="offset" value="{$offset|escape}" />
<input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
{tr}Find{/tr}:<input size="8" type="text" name="find" value="{$find|escape}" />
{tr}Process{/tr}:
<select name="filter_name">
<option value="">{tr}All{/tr}</option>
{section loop=$all_procs name=ix}
<option  value="{$all_procs[ix].name|escape}">{$all_procs[ix].name}</option>
{/section}
</select>

{tr}Status{/tr}:
<select name="filter_active">
<option value="">{tr}All{/tr}</option>
<option value="y">{tr}Active{/tr}</option>
<option value="n">{tr}Inactive{/tr}</option>
</select>

<input type="submit" name="filter" value="{tr}filter{/tr}" />
</form>
<form action="tiki-g-admin_processes.php" method="post">
<input type="hidden" name="offset" value="{$offset|escape}" />
<input type="hidden" name="find" value="{$find|escape}" />
<input type="hidden" name="where" value="{$where|escape}" />
<input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
<table class="normal">
<tr>
<td style="text-align:center;"  class="heading"><input type="submit" name="delete" value="x " /></td>
<td  class="heading" ><a class="tableheading" href="tiki-g-admin_processes.php?find={$find}&amp;filter_name={$filter_name}&amp;filter_active={$filter_active}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'name_desc'}name_asc{else}name_desc{/if}">{tr}Name{/tr}</a></td>
<td  class="heading" ><a class="tableheading" href="tiki-g-admin_processes.php?find={$find}&amp;filter_name={$filter_name}&amp;filter_active={$filter_active}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'version_desc'}version_asc{else}version_desc{/if}">{tr}version{/tr}</a></td>
<td  class="heading" ><a class="tableheading" href="tiki-g-admin_processes.php?find={$find}&amp;filter_name={$filter_name}&amp;filter_active={$filter_active}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'isActive_desc'}isActive_asc{else}isActive_desc{/if}">{tr}act{/tr}</a></td>
<td  class="heading" ><a class="tableheading" href="tiki-g-admin_processes.php?find={$find}&amp;filter_name={$filter_name}&amp;filter_active={$filter_active}&amp;offset={$offset}&amp;sort_mode={if $sort_mode eq 'isValid_desc'}isValid_asc{else}isActive_desc{/if}">{tr}val{/tr}</a></td>
<td  class="heading" >{tr}Action{/tr}</td>
</tr>
{cycle values="odd,even" print=false}
{section name=ix loop=$items}
<tr>
	<td style="text-align:center;" class="{cycle advance=false}">
		{if $items[ix].isActive eq 'y'}
		*
		{else}
		<input type="checkbox" name="process[{$items[ix].pId}]" />
		{/if}
	</td>
	<td class="{cycle advance=false}">
	  <a class="link" href="tiki-g-admin_processes.php?find={$find}&amp;filter_name={$filter_name}&amp;filter_active={$filter_active}&amp;offset={$offset}&amp;sort_mode={$sort_mode}&amp;pid={$items[ix].pId}">{$items[ix].name}</a>
	</td>
	<td style="text-align:right;" class="{cycle advance=false}">
	  {$items[ix].version}
	</td>
		<td class="{cycle advance=false}" style="text-align:center;">
	  {if $items[ix].isActive eq 'y'}
	  <img src='lib/Galaxia/img/icons/refresh2.gif' alt=' ({tr}active{/tr}) ' title='{tr}active process{/tr}' />
	  {else}
	  &nbsp;
	  {/if}
	</td>
	<td class="{cycle advance=false}" style="text-align:center;">
	  {if $items[ix].isValid eq 'n'}
	  <img src='lib/Galaxia/img/icons/red_dot.gif' alt=' ({tr}invalid{/tr}) ' title='{tr}invalid process{/tr}' />
	  {else}
	  <img src='lib/Galaxia/img/icons/green_dot.gif' alt=' ({tr}valid{/tr}) ' title='{tr}valid process{/tr}' />
	  {/if}

	</td>

	<td class="{cycle}">
	  <a class="link" href="tiki-g-admin_activities.php?pid={$items[ix].pId}">{tr}activities{/tr}</a><br />
	  <a class="link" href="tiki-g-admin_shared_source.php?pid={$items[ix].pId}">{tr}code{/tr}</a><br />
	  <a class="link" href="tiki-g-admin_graph.php?pid={$items[ix].pId}">{tr}graph{/tr}</a><br />
	  <a class="link" href="tiki-g-admin_roles.php?pid={$items[ix].pId}">{tr}roles{/tr}</a><br />
	  <a class="link" href="tiki-g-save_process.php?pid={$items[ix].pId}">{tr}export{/tr}</a><br />
	  <a class="link" href="tiki-g-admin_processes.php?find={$find}&amp;filter_name={$filter_name}&amp;filter_active={$filter_active}&amp;offset={$offset}&amp;sort_mode={$sort_mode}&amp;newminor={$items[ix].pId}">{tr}new minor{/tr}</a><br />
	  <a class="link" href="tiki-g-admin_processes.php?find={$find}&amp;filter_name={$filter_name}&amp;filter_active={$filter_active}&amp;offset={$offset}&amp;sort_mode={$sort_mode}&amp;newmajor={$items[ix].pId}">{tr}new major{/tr}</a><br />
	</td>
</tr>
{sectionelse}
<tr>
	<td class="{cycle advance=false}" colspan="15">
	{tr}No processes defined yet{/tr}
	</td>
</tr>	
{/section}
</table>
</form>

{if $cant > 0}
<div class="wikitext">
*Note: It is not possible to delete an active process. To delete a process, deactivate it first.
</div>
{/if}

<div class="mini">
<div align="center">
{if $prev_offset >= 0}
[<a class="prevnext" href="{sameurl offset=$prev_offset}">{tr}prev{/tr}</a>]&nbsp;
{/if}
{tr}Page{/tr}: {$actual_page}/{$cant_pages}
{if $next_offset >= 0}
&nbsp;[<a class="prevnext" href="{sameurl offset=$next_offset}">{tr}next{/tr}</a>]
{/if}
{if $direct_pagination eq 'y'}
<br />
{section loop=$cant_pages name=foo}
{assign var=selector_offset value=$smarty.section.foo.index|times:$maxRecords}
<a class="prevnext" href="{sameurl offset=$selector_offset}">
{$smarty.section.foo.index_next}</a>&nbsp;
{/section}
{/if}
</div>
</div> 
