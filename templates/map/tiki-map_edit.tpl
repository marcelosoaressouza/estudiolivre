{* $Header: /cvsroot/tikiwiki/tiki/templates/map/tiki-map_edit.tpl,v 1.9.2.7 2006/02/22 02:20:25 luciash Exp $ *}

<a class="pagetitle" href="tiki-map_edit.php?mode=listing">{tr}Mapfiles{/tr}</a><br />
<a href="http://mapserver.gis.umn.edu/doc/mapfile-reference.html">http://mapserver.gis.umn.edu/doc/mapfile-reference.html</a><br /><br />
{if $mapfile}<h2>{tr}Mapfile{/tr}: {$mapfile}</h2>{/if}
{if $mode eq 'listing'}
<h3>{tr}Available mapfiles{/tr}:</h3>
<table class="normal">
<tr>
<td class="heading">{tr}Mapfile{/tr}</td>
<td class="heading" width="20%">{tr}Actions{/tr}</td>
<td class="heading" width="10%">{tr}hits{/tr}</td>
<td class="heading" width="10%">{tr}hits last 7 days{/tr}</td>
</tr>
{section name=user loop=$files}
{if $smarty.section.user.index % 2}
<tr>
<td class="odd">
<a class="link" href="tiki-map.phtml?mapfile={$files[user]}">{$files[user]}</a>
</td>
<td class="odd">
{if $tiki_p_map_edit eq 'y'}
<a class="link" href="tiki-map_edit.php?mapfile={$files[user]}&amp;mode=editing">
<img src="img/icons/config.gif" border="0"  alt="{tr}edit{/tr}" title="{tr}edit{/tr}" />
</a>
{/if}
{if $user and $feature_user_watches eq 'y'}
 {if $user_watching_map[user] eq 'n'}
  	<a href="tiki-map_edit.php?watch_event=map_changed&amp;watch_object={$files[user]}&amp;watch_action=add"><img border='0' alt='{tr}monitor this map{/tr}' title='{tr}monitor this map{/tr}' src='img/icons/icon_watch.png' /></a>
	{else}
		<a href="tiki-map_edit.php?watch_event=map_changed&amp;watch_object={$files[user]}&amp;watch_action=remove"><img border='0' alt='{tr}stop monitoring this map{/tr}' title='{tr}stop monitoring this map{/tr}' src='img/icons/icon_unwatch.png' /></a>
	{/if}
{/if}
</td>
<td class="odd">
{$mapstats[user]}
</td>
<td class="odd">
{$mapstats7days[user]}
</td>
</tr>
{else}
<tr>
<td class="even">
<a class="link" href="tiki-map.phtml?mapfile={$files[user]}">{$files[user]}</a>
</td>
<td class="even">
{if $tiki_p_map_edit eq 'y'}
<a class="link" href="tiki-map_edit.php?mapfile={$files[user]}&amp;mode=editing">
<img src="img/icons/config.gif" border="0" alt="{tr}edit{/tr}" title="{tr}edit{/tr}" />
</a>
{/if}
{if $user and $feature_user_watches eq 'y'}
 {if $user_watching_map[user] eq 'n'}
  	<a href="tiki-map_edit.php?watch_event=map_changed&amp;watch_object={$files[user]}&amp;watch_action=add"><img border='0' alt='{tr}monitor this map{/tr}' title='{tr}monitor this map{/tr}' src='img/icons/icon_watch.png' /></a>
	{else}
		<a href="tiki-map_edit.php?watch_event=map_changed&amp;watch_object={$files[user]}&amp;watch_action=remove"><img border='0' alt='{tr}stop monitoring this map{/tr}' title='{tr}stop monitoring this map{/tr}' src='img/icons/icon_unwatch.png' /></a>
	{/if}
{/if}	
</td>
<td class="even">
{$mapstats[user]}
</td>
<td class="even">
{$mapstats7days[user]}
</td>
</tr>
{/if}
{sectionelse}
<tr><td colspan="2" class="odd">{tr}No records found{/tr}</td></tr>
{/section}
</table>
{if $tiki_p_map_create eq 'y'}
<h3>{tr}Create a new mapfile{/tr}</h3>
<form action="tiki-map_edit.php" method="post">
<input type="text" name="newmapfile" size="20" />
<input type="submit" name="create" value="{tr}create{/tr}" />
{/if}
{/if}
{if $mode eq 'editing'}
<a class="link" href="tiki-map_edit.php">{tr}Mapfile listing{/tr}</a><br /><br />
<form enctype="multipart/form-data" action="tiki-map_edit.php" method="post" id='editpageform'>
{assign var=area_name value="mapdata"}
<a class="link" href="tiki-map_edit.php?mapfile={$mapfile}&mode=editing">{tr}Reload{/tr}</a>&nbsp;&nbsp;
<a class="link" href="tiki-map_history.php?mapfile={$mapfile}">{tr}History{/tr}</a><br />
<table class="normal">
<tr class="formcolor">
<td>
{include file="textareasize.tpl" area_name='mapdata' formId='editpageform'}<br /><br />
{include file=tiki-edit_help_tool.tpl}<br /><br />
</td><td>
<textarea id='mapdata' class="wikiedit" name="pagedata" rows="{$rows}" wrap="virtual" cols="{$cols}">{$pagedata|escape}</textarea>
<input type="hidden" name="rows" value="{$rows}"/>
<input type="hidden" name="cols" value="{$cols}"/>
<input type="hidden" name="mapfile" value="{$mapfile}" />
<input type="hidden" name="mode" value="{$mode}" />
</td></tr>
</table>
<div align="center">
<input type="submit" class="wikiaction" name="save" value="{tr}save{/tr}" /> 
</div>
</form>
{if $tiki_p_map_delete eq 'y'}
<hr />
<div align="center">
<form class="wikiaction" action="tiki-map_edit.php" method="get" id='editpageform'>
<input type="hidden" name="mapfile" value="{$mapfile}" />
<input type="submit" name="delete" value="{tr}delete{/tr}" />
</form>
</div>
{/if}
  <br />
  <div align="center">
  <table class="normal">
  <tr>
  	<td class="even">
  	<small>
    {tr}You can view this map in your browser using{/tr}: <a class="maplink" href="{$url_browse}?mapfile={$mapfile}">{$url_browse}?mapfile={$mapfile}</a><br />
    </small>
    </td>
  </tr>
  </table>
</div>
{/if}

