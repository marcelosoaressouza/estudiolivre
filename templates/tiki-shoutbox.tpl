{* $Header: /cvsroot/tikiwiki/tiki/templates/tiki-shoutbox.tpl,v 1.14.2.10 2007/08/04 16:59:13 marclaporte Exp $ *}
<h1><a class="pagetitle" href="tiki-shoutbox.php">{tr}Tiki Shoutbox{/tr}!</a>

{if $feature_help eq 'y'}
<a href="{$helpurl}Shoutbox" target="tikihelp" class="tikihelp" title="{tr}admin Tiki Shoutbox{/tr}">
<img src="img/icons/help.gif" border="0" height="16" width="16" alt='{tr}help{/tr}' /></a>
{/if}

{if $feature_view_tpl eq 'y' and $tiki_p_view_templates eq 'y'}
<a href="tiki-edit_templates.php?template=tiki-shoutbox.tpl" target="tikihelp" class="tikihelp" title="{tr}View tpl{/tr}: {tr}admin Tiki Shoutbox tpl{/tr}">
<img src="img/icons/info.gif" border="0" width="16" height="16" alt='{tr}edit template{/tr}' /></a>
{/if}</h1>

{if $tiki_p_admin_shoutbox eq 'y'}
<h2>{tr}Change shoutbox general settings{/tr}</h2>
<form action="tiki-shoutbox.php" method="post">
<table class="normal">
<tr><td class="odd">{tr}auto-link urls{/tr}</td><td class="odd"><input type="checkbox" name="shoutbox_autolink" value="on"{if $shoutbox_autolink eq 'y'} checked="checked"{/if}></td></tr>
<tr><td  class="formcolor">&nbsp;</td><td class="formcolor"><input type="submit" name="shoutbox_admin" value="{tr}Save{/tr}" /></td></tr>
</table>
</form>
{/if}

{if $tiki_p_post_shoutbox eq 'y'}
<h2>{tr}Post or edit a message{/tr}</h2>
{js_maxlength textarea=message maxlength=255}
<form action="tiki-shoutbox.php" method="post" onsubmit="return verifyForm(this);">
<input type="hidden" name="msgId" value="{$msgId|escape}" />
<input type="hidden" name="user" value="{$user}" />
<table class="normal">
<tr><td class="formcolor">{tr}message{/tr}:</td><td class="formcolor"><textarea rows="4" cols="60" name="message">{$message|escape}</textarea></td></tr>
<tr><td  class="formcolor">&nbsp;</td><td class="formcolor"><input type="submit" name="save" value="{tr}Save{/tr}" /></td></tr>
</table>
</form>
{/if}


<h2>{tr}Messages{/tr}</h2>
<table class="findtable">
<tr><td class="findtable">{tr}Find{/tr}</td>
   <td class="findtable">
   <form method="get" action="tiki-shoutbox.php">
     <input type="text" name="find" value="{$find|escape}" />
     <input type="submit" value="{tr}find{/tr}" name="search" />
     <input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
   </form>
   </td>
</tr>
</table>


{section name=user loop=$channels}
<div class="shoutboxmsg">
<b><a href="tiki-user_information.php?view_user={$channels[user].user}">{$channels[user].user}</a></b>, {$channels[user].timestamp|tiki_long_date}, {$channels[user].timestamp|tiki_long_time}
{if $tiki_p_admin_shoutbox eq 'y'}
  [
  <a href="tiki-shoutbox.php?find={$find}&amp;offset={$offset}&amp;sort_mode={$sort_mode}&amp;remove={$channels[user].msgId}" class="link">x</a>
  |
  <a href="tiki-shoutbox.php?find={$find}&amp;offset={$offset}&amp;sort_mode={$sort_mode}&amp;msgId={$channels[user].msgId}" class="link">edit</a>
  ]
{/if}
<br />
{$channels[user].message}
</div>
{/section}

<div align="center">
<div class="mini">
{if $prev_offset >= 0}
[<a class="prevnext" href="tiki-shoutbox.php?find={$find}&amp;offset={$prev_offset}&amp;sort_mode={$sort_mode}">{tr}prev{/tr}</a>]&nbsp;
{/if}
{tr}Page{/tr}: {$actual_page}/{$cant_pages}
{if $next_offset >= 0}
&nbsp;[<a class="prevnext" href="tiki-shoutbox.php?find={$find}&amp;offset={$next_offset}&amp;sort_mode={$sort_mode}">{tr}next{/tr}</a>]
{/if}
{if $direct_pagination eq 'y'}
<br />
{section loop=$cant_pages name=foo}
{assign var=selector_offset value=$smarty.section.foo.index|times:$maxRecords}
<a class="prevnext" href="tiki-shoutbox.php?find={$find}&amp;offset={$selector_offset}&amp;sort_mode={$sort_mode}">
{$smarty.section.foo.index_next}</a>&nbsp;
{/section}
{/if}

</div>
</div>
