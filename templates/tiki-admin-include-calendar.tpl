<br />
<div class="rbox" name="tip">
<div class="rbox-title" name="tip">{tr}Tip{/tr}</div>  
<div class="rbox-data" name="tip">{tr}To add/remove calendars, look for "Calendar" under "Admin" on the application menu, or{/tr} <a class="rbox-link" href="tiki-admin_calendars.php">{tr}click here{/tr}</a>.</div>
</div>
<br />

<div class="cbox">
<div class="cbox-title">
  {tr}{$crumbs[$crumb]->description}{/tr}
  {help crumb=$crumbs[$crumb]}
</div>
<div class="cbox-data">
<form action="tiki-admin.php?page=calendar" method="post">
<table class="admin">
<tr class="form">
<td><label>{tr}Group calendar sticky popup{/tr}</label></td>
<td><input type="checkbox" name="calendar_sticky_popup" {if $calendar_sticky_popup eq 'y'}checked="checked"{/if}/></td>
</tr>
<tr class="form">
<td><label>{tr}Group calendar item view tab{/tr}</label></td>
<td><input type="checkbox" name="calendar_view_tab" {if $calendar_view_tab eq 'y'}checked="checked"{/if}/></td>
</tr>
<tr class="form">
<td><label>{tr}Calendar manual selection of time/date{/tr}</label></td>
<td><input type="checkbox" name="feature_cal_manual_time" {if $feature_cal_manual_time eq 'y'}checked="checked"{/if}/></td>
</tr>
<tr class="form">
<td><label>{tr}JsCalendar{/tr}</label></td>
<td><input type="checkbox" name="feature_jscalendar" {if $feature_jscalendar eq 'y'}checked="checked"{/if}/></td>
</tr>
<tr>
<td colspan="2" class="button"><input type="submit" name="calprefs" value="{tr}Change settings{/tr}" /></td>
</tr>
</table>
</form>
</div>
</div>
