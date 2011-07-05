<h1><a class="pagetitle" href="tiki-admin_newcalendar.php">{tr}Admin calendar{/tr}</a>
{if $tiki_p_admin eq 'y'}
<a title="{tr}Configure/Options{/tr}" href="tiki-admin.php?page=calendar"><img src='pics/icons/wrench.png' border='0' width='16' height='16' alt='{tr}Configure/Options{/tr}' /></a>
{/if} 
</h1>
{* {if $prefs.feature_tabs eq 'y'}
<div class="tabs">
<span id="tab1" class="tab tabActive">{tr}List Calendars{/tr}</span>
<span id="tab2" class="tab">{tr}Create/edit Calendars{/tr}</span>
</div>
{/if} *}

{* --- tab with list --- *}
<div id="content1" class="content">
<h2>{tr}List of Calendars{/tr}</h2>
<div align="center">
<table class="findtable">
<tr><td class="findtable" width="10%">{tr}Find{/tr}</td>
   <td class="findtable">
   <form method="get" action="tiki-admin_newcalendar.php">
     <input type="text" name="find" value="{$find|escape}" />
     <input type="submit" value="{tr}Find{/tr}" name="search" />
     <input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
   </form>
   </td>
</tr>
</table>
<table class="normal">
<tr>
<td class="heading"><a class="tableheading" href="tiki-admin_newcalendar.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'calendarId_desc'}calendarId_asc{else}calendarId_desc{/if}">{tr}ID{/tr}</a></td>
<td class="heading"><a class="tableheading" href="tiki-admin_newcalendar.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'name_desc'}name_asc{else}name_desc{/if}">{tr}Name{/tr}</a></td>
<td class="heading"><a class="tableheading" href="tiki-admin_newcalendar.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'caltype_desc'}caltype_asc{else}caltype_desc{/if}">{tr}Type{/tr}</a></td>
<td class="heading">Permissions</td>
<td class="heading">Edit</td>
<td class="heading">Delete</td>
</tr>
{cycle values="odd,even" print=false}
{foreach key=id item=cal from=$calendars}
<tr class="{cycle}">
<td>{$id}</td>
<td><a class="tablename" href="tiki-calendar.php?calIds[]={$id}">{$cal.name}</a>{if $cal.show_calname eq 'y'} +{/if}</td>
<td>{$cal.customlocations}{if $cal.show_location eq 'y'} +{/if}</td>
<td>{$cal.customparticipants}{if $cal.show_participants eq 'y'} +{/if}</td>
<td>{$cal.customcategories}{if $cal.show_category eq 'y'} +{/if}</td>
<td>{$cal.customlanguages}{if $cal.show_language eq 'y'} +{/if}</td>
<td>{$cal.customurl}{if $cal.show_url eq 'y'} +{/if}</td>
<td>{$cal.custompriorities}</td>
<td>{$cal.customsubscription}</td>
<td>{$cal.personal}</td>
<td>
<a title="{tr}Permissions{/tr}" class="link" 
href="tiki-objectpermissions.php?objectName={$cal.name|escape:"url"}&amp;objectType=calendar&amp;permType=calendar&amp;objectId={$id}"><img 
src='pics/icons/key.png' border='0' width='16' height='16' alt='{tr}Permissions{/tr}' />{if $cal.individual gt 0} {$cal.individual}</a>{/if}</td>
<td>
   &nbsp;&nbsp;<a title="{tr}Edit{/tr}" class="link" href="tiki-admin_newcalendar.php?offset={$offset}&amp;sort_mode={$sort_mode}&amp;calendarId={$id}"><img src="pics/icons/page_edit.png" border="0" width="16" height="16"  alt='{tr}Edit{/tr}' /></a>
</td>
<td>
   <a title="{tr}Delete{/tr}" class="link" href="tiki-admin_newcalendar.php?offset={$offset}&amp;sort_mode={$sort_mode}&amp;drop={$id}" 
   title="{tr}Delete{/tr}"><img src="pics/icons/cross.png" border="0" height="16" width="16" alt='{tr}Delete{/tr}' /></a>
</td>
</tr>
{/foreach}
</table>
<br />

<div class="mini">
{if $prev_offset >= 0}
[<a class="prevnext" href="tiki-admin_newcalendar.php?find={$find}&amp;offset={$prev_offset}&amp;sort_mode={$sort_mode}">{tr}Prev{/tr}</a>]&nbsp;
{/if}
{tr}Page{/tr}: {$actual_page}/{$cant_pages}
{if $next_offset >= 0}
&nbsp;[<a class="prevnext" href="tiki-admin_newcalendar.php?find={$find}&amp;offset={$next_offset}&amp;sort_mode={$sort_mode}">{tr}Next{/tr}</a>]
{/if}
{if $prefs.direct_pagination eq 'y'}
<br />
{section loop=$cant_pages name=foo}
{assign var=selector_offset value=$smarty.section.foo.index|times:$prefs.maxRecords}
<a class="prevnext" href="tiki-admin_newcalendar.php?find={$find}&amp;offset={$selector_offset}&amp;sort_mode={$sort_mode}">
{$smarty.section.foo.index_next}</a>&nbsp;
{/section}
{/if}
</div>

</div>

{* --- tab with form --- *}
<div id="content2" class="content">
<h2>{tr}Create/edit Calendars{/tr}</h2>

<form action="tiki-admin_newcalendar.php" method="post">
<input type="hidden" name="calendarId" value="{$calendarId|escape}" />
<table class="normal">
{if $tiki_p_view_categories eq 'y'}
{include file=categorize.tpl}
{/if}
<tr class="formcolor"><td>{tr}Name{/tr}:</td><td><input type="text" name="name" value="{$name|escape}" />
{tr}Show in popup box{/tr}
<input type="checkbox" name="show[calname]" value="on"{if $show_calname eq 'y'} checked="checked"{/if} />
</td></tr>
<tr class="formcolor"><td>{tr}Description{/tr}:</td><td><textarea name="description" rows="5" wrap="virtual" style="width:100%;">{$description|escape}</textarea>
<br />
{tr}Show in popup box{/tr}
<input type="checkbox" name="show[description]" value="on"{if $show_description eq 'y'} checked="checked"{/if} />
</td></tr>
<tr class="formcolor"><td>{tr}Custom Locations{/tr}:</td><td>
<select name="customlocations">
<option value='y' {if $customlocations eq 'y'}selected="selected"{/if}>{tr}yes{/tr}</option>
<option value='n' {if $customlocations eq 'n'}selected="selected"{/if}>{tr}no{/tr}</option>
</select>
{tr}Show in popup box{/tr}
<input type="checkbox" name="show[location]" value="on"{if $show_location eq 'y'} checked="checked"{/if} />
</td></tr>
<tr class="formcolor"><td>{tr}Custom Participants{/tr}:</td><td>
<select name="customparticipants">
<option value='y' {if $customparticipants eq 'y'}selected="selected"{/if}>{tr}yes{/tr}</option>
<option value='n' {if $customparticipants eq 'n'}selected="selected"{/if}>{tr}no{/tr}</option>
</select>
{tr}Show in popup box{/tr}
<input type="checkbox" name="show[participants]" value="on"{if $show_participants eq 'y'} checked="checked"{/if} />
</td></tr>
<tr class="formcolor"><td>{tr}Custom Categories{/tr}:</td><td>
<select name="customcategories">
<option value='y' {if $customcategories eq 'y'}selected="selected"{/if}>{tr}yes{/tr}</option>
<option value='n' {if $customcategories eq 'n'}selected="selected"{/if}>{tr}no{/tr}</option>
</select>
{tr}Show in popup box{/tr}
<input type="checkbox" name="show[category]" value="on"{if $show_category eq 'y'} checked="checked"{/if} />
</td></tr>
<tr class="formcolor"><td>{tr}Custom Languages{/tr}:</td><td>
<select name="customlanguages">
<option value='y' {if $customlanguages eq 'y'}selected="selected"{/if}>{tr}yes{/tr}</option>
<option value='n' {if $customlanguages eq 'n'}selected="selected"{/if}>{tr}no{/tr}</option>
</select>
{tr}Show in popup box{/tr}
<input type="checkbox" name="show[language]" value="on"{if $show_language eq 'y'} checked="checked"{/if} />
</td></tr>
<tr class="formcolor"><td>{tr}Custom URL{/tr}:</td><td>
<select name="options[customurl]">
<option value='y' {if $customurl eq 'y'}selected="selected"{/if}>{tr}yes{/tr}</option>
<option value='n' {if $customurl eq 'n'}selected="selected"{/if}>{tr}no{/tr}</option>
</select>
{tr}Show in popup box{/tr}
<input type="checkbox" name="show[url]" value="on"{if $show_url eq 'y'} checked="checked"{/if} />
</td></tr>
{if $prefs.feature_newsletters eq 'y'}
<tr class="formcolor"><td>{tr}Custom Subscription List{/tr}:</td><td>
<select name="customsubscription">
<option value='y' {if $customsubscription eq 'y'}selected="selected"{/if}>{tr}yes{/tr}</option>
<option value='n' {if $customsubscription eq 'n'}selected="selected"{/if}>{tr}no{/tr}</option>
</select>
</td></tr>
{/if}
<tr class="formcolor"><td>{tr}Custom Priorities{/tr}:</td><td>
<select name="custompriorities">
<option value='y' {if $custompriorities eq 'y'}selected="selected"{/if}>{tr}yes{/tr}</option>
<option value='n' {if $custompriorities eq 'n'}selected="selected"{/if}>{tr}no{/tr}</option>
</select>
</td></tr>
<tr class="formcolor"><td>{tr}Personal Calendar{/tr}:</td><td>
<select name="personal">
<option value='y' {if $personal eq 'y'}selected="selected"{/if}>{tr}yes{/tr}</option>
<option value='n' {if $personal eq 'n'}selected="selected"{/if}>{tr}no{/tr}</option>
</select>
</td></tr>
<tr class="formcolor"><td>{tr}Start of day{/tr}:</td><td>
<select name="startday_Hour">{foreach item=h from=$hours}<option value="{$h}"{if $h eq $startday} selected="selected"{/if}>{$h}</option>{/foreach}</select>{tr}h{/tr}
</td></tr>
<tr class="formcolor"><td>{tr}End of day{/tr}:</td><td>
<select name="endday_Hour">{foreach item=h from=$hours}<option value="{$h}"{if $h eq $endday} selected="selected"{/if}>{$h}</option>{/foreach}</select>{tr}h{/tr}
</td></tr>
<tr class="formcolor"><td>{tr}Custom foreground color{/tr}:</td><td>
<input type="text" name="options[customfgcolor]" value="{$customfgcolor}" size="6" />
</td></tr>
<tr class="formcolor"><td>{tr}Custom background color{/tr}:</td><td>
<input type="text" name="options[custombgcolor]" value="{$custombgcolor}" size="6" />
</td></tr>
<tr class="formcolor"><td>&nbsp;</td><td><input type="submit" name="save" value="{tr}Save{/tr}" /></td></tr>
</table>
</form>

</div>
