<div class="cbox">
<div class="cbox-title">
  {tr}{$crumbs[$crumb]->title}{/tr}
  {help crumb=$crumbs[$crumb]}
</div>
<div class="cbox-data">
<form action="tiki-admin.php?page=maps" method="post">
<table class="admin">
<tr><td class="form">{tr}full path to mapfiles{/tr}:</td><td><input type="text" name="map_path" value="{$map_path|escape}" size="50" /></td></tr>
<tr><td class="form">{tr}default mapfile{/tr}:</td><td><input type="text" name="default_map" value="{$default_map}" /> </td></tr>
<tr><td class="form">{tr}Wiki Page for Help{/tr}:</td><td><input type="text" name="map_help" value="{$map_help}" /> </td></tr>
<tr><td class="form">{tr}Wiki Page for Comments{/tr}:</td><td><input type="text" name="map_comments" value="{$map_comments}" /> </td></tr>
<tr><td class="form">{tr}Full path to gdaltindex{/tr}:</td><td><input type="text" name="gdaltindex" value="{$gdaltindex}" size="50" /> </td></tr>
<tr><td class="form">{tr}Full path to ogr2ogr{/tr}:</td><td><input type="text" name="ogr2ogr" value="{$ogr2ogr}" size="50" /> </td></tr>
<tr><td class="form">{tr}Map Zone{/tr}:</td><td>
{html_radios name="mapzone" options=$checkboxes_mapzone selected=$mapzone_id separator="  "}
</td></tr>
<tr><td colspan="2" class="button"><input type="submit" name="mapsset" value="{tr}Change preferences{/tr}" /></td></tr> 
<tr><td colspan="2" class="button"><input type="submit" name="mapuser" value="{tr}Generate User Map{/tr}" /></td></tr> 
{if $map_error neq ''}
<tr><td align="center" colspan="2">{$map_error}</td></tr>
{/if}   
</table>
</form>
</div>
</div>
