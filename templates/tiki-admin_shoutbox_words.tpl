<h1><a class="pagetitle" href="tiki-admin_shoutbox_words.php">{tr}Admin Shoutbox Words{/tr}</a>

  
      {if $feature_help eq 'y'}
<a href="{$helpurl}Shoutbox" target="tikihelp" class="tikihelp" title="{tr}Manage Banned Words in Shoutbox{/tr}">
<img border='0' src='img/icons/help.gif' alt="{tr}help{/tr}" /></a>{/if}



      {if $feature_view_tpl eq 'y'}
<a href="tiki-edit_templates.php?template=tiki-admin_shoutbox_words.tpl" target="tikihelp" class="tikihelp" title="{tr}View template{/tr}: {tr}admin shoutbox words template{/tr}">
<img src="img/icons/info.gif" border="0" width="16" height="16" alt='{tr}edit template{/tr}' /></a>{/if}</h1>



<h2>{tr}Add Banned Word{/tr}</h2>

<form method="post" action="tiki-admin_shoutbox_words.php">
<table class="normal">
<tr><td class="formcolor">{tr}Word{/tr}</td><td class="formcolor"><input type="text" name="word" /></td></tr>
<tr><td class="formcolor">&nbsp;</td><td class="formcolor"><input type="submit" name="add" value="{tr}Add{/tr}" /></td></tr>
</table>
</form>
<br />
<div  align="center">
<table class="findtable">
<tr><td class="findtable">{tr}Find{/tr}</td>
   <td class="findtable">
   <form method="get" action="tiki-admin_shoutbox_words.php">
     <input type="text" name="find" value="{$find|escape}" />
     <input type="submit" value="{tr}find{/tr}" name="search" />
     <input type="hidden" name="sort_mode" value="{$sort_mode|escape}" />
   </form>
   </td>
</tr>
</table>
</div>
<table class="normal">
<tr>
<td class="heading"><a class="tableheading" href="tiki-admin_shoutbox_words.php?offset={$offset}&amp;sort_mode={if $sort_mode eq 'word_desc'}word_asc{else}word_desc{/if}">{tr}Word{/tr}</a></td>
<td class="heading">{tr}action{/tr}</td>
</tr>
{section name=user loop=$words}
{if $smarty.section.user.index % 2}
<tr>
<td class="odd">{$words[user].word}</td>
<td class="odd">
&nbsp;&nbsp;<a class="link" href="tiki-admin_shoutbox_words.php?offset={$offset}&amp;sort_mode={$sort_mode}&amp;remove={$words[user].word}" 
onclick="return confirmTheLink(this,'{tr}Are you sure you want to delete this word?{/tr}')" 
title="{tr}delete{/tr}"><img src="img/icons2/delete.gif" border="0" height="16" width="16" alt='{tr}delete{/tr}' /></a>&nbsp;&nbsp;
</td>
</tr>
{else}
<tr>
<td class="even">{$words[user].word}</td>
<td class="even">
&nbsp;&nbsp;<a class="link" href="tiki-admin_shoutbox_words.php?offset={$offset}&amp;sort_mode={$sort_mode}&amp;remove={$words[user].word}" 
onclick="return confirmTheLink(this,'{tr}Are you sure you want to delete this word?{/tr}')" 
title="{tr}delete{/tr}"><img src="img/icons2/delete.gif" border="0" height="16" width="16" alt='{tr}delete{/tr}' /></a>&nbsp;&nbsp;
</td>
</tr>
{/if}
{sectionelse}
<tr><td colspan="2" class="odd">{tr}No records found{/tr}</td></tr>
{/section}
</table>
<div class="mini">
{if $prev_offset >= 0}
[<a class="prevnext" class="link" href="tiki-admin_shoutbox_words.php?find={$find}&amp;offset={$prev_offset}&amp;sort_mode={$sort_mode}">{tr}prev{/tr}</a>]&nbsp;
{/if}
{tr}Page{/tr}: {$actual_page}/{$cant_pages}
{if $next_offset >= 0}
&nbsp;[<a class="prevnext" class="link" href="tiki-admin_shoutbox_words.php?find={$find}&amp;offset={$next_offset}&amp;sort_mode={$sort_mode}">{tr}next{/tr}</a>]
{/if}
{if $direct_pagination eq 'y'}
<br />
{section loop=$cant_pages name=foo}
{assign var=selector_offset value=$smarty.section.foo.index|times:$maxRecords}
<a class="prevnext" href="tiki-admin_shoutbox_words.php?find={$find}&amp;offset={$selector_offset}&amp;sort_mode={$sort_mode}">
{$smarty.section.foo.index_next}</a>&nbsp;
{/section}
{/if}
</div>
