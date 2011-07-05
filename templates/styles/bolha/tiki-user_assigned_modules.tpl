{css only=list,tiki-user_preferences}
<div id="userPrefs">
<h1>
	{tr}Modules{/tr}</a>
</h1>

<a class="linkbut" href="tiki-user_assigned_modules.php?recreate=1">{tr}Restore defaults{/tr}</a><br /><br />

<div class="tabcontent">
	<div class="cbox-title">{tr}User assigned modules{/tr}</div>
</div>
<div id="editMods">
	<table  class="normal">
		<tr>
			<td class="heading">{tr}Position{/tr}</td>
			<td class="heading">{tr}Name{/tr}</td>
			<td class="heading">{tr}Move{/tr}</td>
			<td class="heading">{tr}Delete{/tr}</td>
		</tr>
		{cycle values="even,odd" print=false}
		{section name=ix loop=$modules_r}
			<tr>
				<td class="{cycle advance=false} centerCellCont">{$modules_r[ix].ord}</td>
				<td class="{cycle advance=false}">{$modules_r[ix].name}</td>
				<td class="{cycle advance=false}">
				  <a class="link" href="tiki-user_assigned_modules.php?up={$modules_r[ix].name}"><img src='img/icons2/up.gif' alt='{tr}up{/tr}' title='{tr}up{/tr}' border='0' /></a>
				  <a class="link" href="tiki-user_assigned_modules.php?down={$modules_r[ix].name}"><img src='img/icons2/down.gif' alt='{tr}down{/tr}' title='{tr}down{/tr}' border='0' /></a>
				</td>
				<td class="{cycle}">
				  {if $modules_r[ix].name ne 'application_menu' and $modules_r[ix].name ne 'login_box' and $modules_r[ix].type ne 'P'}
						<a class="link" href="tiki-user_assigned_modules.php?unassign={$modules_r[ix].name}"><img src='img/icons2/delete.gif' border='0' alt='{tr}unassign{/tr}' title='{tr}unassign{/tr}' /></a> 
				  {/if}
				</td>
			</tr>
		{/section}
	</table>
</div>
{if $canassign eq 'y'}
	<br />
	<form action="tiki-user_assigned_modules.php" method="post">
	<input type="hidden" name="position" value="right">
<div class="tabcontent">
	<div class="cbox-title">{tr}Assign module{/tr}</div>
</div>
		<table class="normal">
			<tr>
				<td class="formcolor">{tr}Module{/tr}:</td>
				<td class="formcolor">
					<select name="module">
						{section name=ix loop=$assignables}
							<option value="{$assignables[ix].name|escape}">{$assignables[ix].name}</option>
						{/section}
					</select>
				</td>
			</tr>
			<tr>
				<td class="formcolor">{tr}Position{/tr}:</td>
				<td class="formcolor">
					<select name="order">
						{section name=ix loop=$orders}
							<option value="{$orders[ix]|escape}">{$orders[ix]}</option>
						{/section}
					</select>
				</td>
			</tr>
			<tr>
				<td class="formcolor">&nbsp;</td>
				<td class="formcolor"><input type="submit" name="assign" value="{tr}assign{/tr}" /></td>
			</tr>
		</table>
	</form>
{/if}
</div>