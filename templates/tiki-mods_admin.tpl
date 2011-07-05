{* $Header: /cvsroot/tikiwiki/tiki/templates/tiki-mods_admin.tpl,v 1.1.2.5 2007/03/02 17:51:19 sylvieg Exp $ *}
<h1><a href="tiki-mods_admin.php" class="pagetitle">{tr}Tikiwiki Mods Configuration{/tr}</a></h1>
<div class="navbar"><span class="button2"><a href="tiki-mods.php" class="linkbut">{tr}Mods Install/uninstall{/tr}</a></span></div>

{section name=n loop=$tikifeedback}<div class="simplebox{if $tikifeedback[n].num > 0} highlight{/if}">{$tikifeedback[n].mes}</div>{/section}

<form method="post" action="tiki-mods_admin.php">

<table class="form">
<tr class="formrow">
<td>{tr}Enable Mods providing{/tr}</td>
<td><input type="checkbox" name="feature_mods_provider" value="on"{if $feature_mods_provider eq 'y'} checked="checked"{/if} /></td>
</tr>
<tr class="formrow">
<td>{tr}Mods local directory{/tr}</td>
<td><input type="text" name="mods_dir" value="{$mods_dir}" size="42" /></td>
</tr>
<tr class="formrow">
<td>{tr}Mods remote server{/tr}</td>
<td><input type="text" name="mods_server" value="{$mods_server}" size="42" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" name="save" value="{tr}Save{/tr}" /></td>
</tr>
</table>

<br /><br />

