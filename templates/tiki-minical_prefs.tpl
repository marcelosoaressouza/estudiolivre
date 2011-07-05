<h1><a class="pagetitle" href="tiki-minical_prefs.php">{tr}Mini Calendar: Preferences{/tr}</a>

{if $feature_help eq 'y'}
<a href="{$helpurl}User+Calendar" target="tikihelp" class="tikihelp" title="{tr}User Calendar Doc{/tr}">
<img src="img/icons/help.gif" border="0" height="16" width="16" alt='{tr}help{/tr}' /></a>
{/if}

{if $feature_view_tpl eq 'y'}
<a href="tiki-edit_templates.php?template=tiki-minical_prefs.tpl" target="tikihelp" class="tikihelp" title="{tr}View tpl{/tr}: {tr}User Calendar Preferences Doc tpl{/tr}">
<img src="img/icons/info.gif" border="0" width="16" height="16" alt='{tr}edit template{/tr}' /></a>
{/if}</h1>

{include file=tiki-mytiki_bar.tpl}
<br />
<table border="0">
<tr>
<td><div class="button2"><a class="linkbut" href="tiki-minical.php#add">{tr}Add{/tr}</a></div></td>
<td><div class="button2"><a class="linkbut" href="tiki-minical_prefs.php">{tr}Prefs{/tr}</a></div></td>
<td><div class="button2"><a class="linkbut" href="tiki-minical.php?view=daily">{tr}Daily{/tr}</a></div></td>
<td><div class="button2"><a class="linkbut" href="tiki-minical.php?view=weekly">{tr}Weekly{/tr}</a></div></td>
<td><div class="button2"><a class="linkbut" href="tiki-minical.php?view=list">{tr}List{/tr}</a></div></td>
</tr>
</table>

<h2>{tr}Preferences{/tr}</h2>
<form action="tiki-minical_prefs.php" method="post">
<table class="normal">
<tr>
	<td class="formcolor">{tr}Calendar Interval in daily view{/tr}</td>
	<td class="formcolor">
	<select name="minical_interval">
	<option value="300" {if $minical_interval eq 300}selected="selected"{/if}>5 {tr}minutes{/tr}</option>
	<option value="600" {if $minical_interval eq 600}selected="selected"{/if}>10 {tr}minutes{/tr}</option>
	<option value="900" {if $minical_interval eq 900}selected="selected"{/if}>15 {tr}minutes{/tr}</option>
	<option value="1800" {if $minical_interval eq 1800}selected="selected"{/if}>30 {tr}minutes{/tr}</option>
	<option value="3600" {if $minical_interval eq 3600}selected="selected"{/if}>1 {tr}hour{/tr}</option>
	</select>
	</td>
</tr>
<tr>
	<td class="formcolor">{tr}Start hour for days{/tr}</td>
	<td class="formcolor">
	<select name="minical_start_hour">
	{html_options output=$hours values=$hours selected=$minical_start_hour}
	</select>
	</td>
</tr>
<tr>
	<td class="formcolor">{tr}End hour for days{/tr}</td>
	<td class="formcolor">
	<select name="minical_end_hour">
	{html_options output=$hours values=$hours selected=$minical_end_hour}
	</select>
	</td>
</tr>
<tr>
	<td class="formcolor">{tr}Upcoming events{/tr}</td>
	<td class="formcolor">
	<select name="minical_upcoming">
	{html_options output=$upcoming values=$upcoming selected=$minical_upcoming}
	</select>
	</td>
</tr>
<tr>
	<td class="formcolor">{tr}Reminders{/tr}</td>
	<td class="formcolor">
	<select name="minical_reminders">
    <option value="0" {if $minical_reminders eq 0}selected="selected"{/if}>{tr}no reminders{/tr}</option>
    <option value="60" {if $minical_reminders eq 60}selected="selected"{/if}>1 min</option>
    <option value="120" {if $minical_reminders eq 120}selected="selected"{/if}>2 min</option>
    <option value="300" {if $minical_reminders eq 300}selected="selected"{/if}>5 min</option>
    <option value="600" {if $minical_reminders eq 600}selected="selected"{/if}>10 min</option>
    <option value="900" {if $minical_reminders eq 900}selected="selected"{/if}>15 min</option>
	</select>
	</td>
</tr>

<tr>
	<td class="formcolor">&nbsp;</td>
	<td class="formcolor">
		<input type="submit" name="save" value="{tr}save{/tr}" />
	</td>
</tr>	
</table>
</form>
<a name="import"></a>
<h2>{tr}Import CSV file{/tr}</h2>
<form  enctype="multipart/form-data"  action="tiki-minical_prefs.php" method="post">
<table class="normal">
<tr>
  <td class="formcolor">{tr}Upload file{/tr}:</td><td class="formcolor"><input type="hidden" name="MAX_FILE_SIZE" value="10000000000000" /><input size="16" name="userfile1" type="file" /><input type="submit" name="import" value="{tr}import{/tr}" /></td>
</tr>
</table>
</form>

<h2>{tr}Admin topics{/tr}</h2>
<form  enctype="multipart/form-data"  action="tiki-minical_prefs.php" method="post">
<table class="normal">
<tr>
  <td class="formcolor">{tr}Name{/tr}:</td><td class="formcolor"><input type="text" name="name" /></td>
</tr>
<tr>
  <td class="formcolor">{tr}Upload file{/tr}:</td><td class="formcolor"><input type="hidden" name="MAX_FILE_SIZE" value="10000000000000" /><input size="16" name="userfile1" type="file" /></td>
</tr>
<tr>
  <td class="formcolor">{tr}Or enter path or URL{/tr}:</td><td class="formcolor"><input type="text" name="path" /></td>
</tr>
<tr>
  <td class="formcolor">&nbsp;</td>
  <td class="formcolor">
	<input type="submit" name="addtopic" value="{tr}add topic{/tr}" />
  </td>
</tr></table>
</form>
{if count($topics) > 0}
<div class="simplebox">
<table >
<tr>
{section name=numloop loop=$topics}
        <td>
        {if $topics[numloop].isIcon eq 'y'}
        <img src="{$topics[numloop].path}" alt="{tr}topic image{/tr}" />
        {else}
        <img src="tiki-view_minical_topic.php?topicId={$topics[numloop].topicId}" alt="{tr}topic image{/tr}" />
        {/if}
        {$topics[numloop].name}
        [<a class="link" href="tiki-minical_prefs.php?removetopic={$topics[numloop].topicId}">x</a>]
        </td>
        {* see if we should go to the next row *}
        {if not ($smarty.section.numloop.rownum mod $cols)}
                {if not $smarty.section.numloop.last}
                        </tr><tr>
                {/if}
        {/if}
        {if $smarty.section.numloop.last}
                {* pad the cells not yet created *}
                {math equation = "n - a % n" n=$cols a=$data|@count assign="cells"}
                {if $cells ne $cols}
                {section name=pad loop=$cells}
                        <td>&nbsp;</td>
                {/section}
                {/if}
                </tr>
        {/if}
    {/section}
</table>
</div>
{/if}
