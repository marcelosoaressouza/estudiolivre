<h1><a class="pagetitle" href="tiki-newsletter_archives.php?nlId={$nlId}">{tr}Sent editions{/tr}{if $nl_info}: {$nl_info.name}{/if}</a>
 {if $feature_help eq 'y'}
<a href="{$helpurl}Newsletters" target="tikihelp" class="tikihelp" title="{tr}Newsletters{/tr}">
<img src="img/icons/help.gif" border="0" height="16" width="16" alt='{tr}help{/tr}' /></a>{/if}
 {if $feature_view_tpl eq 'y'}
<a href="tiki-edit_templates.php?template=tiki-newsletter_archives.tpl" target="tikihelp" class="tikihelp" title="{tr}View template{/tr}: {tr}admin newsletters template{/tr}">
<img src="img/icons/info.gif" border="0" width="16" height="16" alt='{tr}edit{/tr}' /></a>{/if}</h1>

<a class="linkbut" href="tiki-newsletters.php">{tr}list newsletters{/tr}</a>{if $tiki_p_subscribe_newsletters eq "y"}<a class="linkbut" href="tiki-newsletters.php?nlId={$nlId}&amp;info=1">{tr}subscribe{/tr}</a>{/if}
{if $tiki_p_send_newsletters eq "y"}<a class="linkbut" href="tiki-send_newsletters.php?nlId={$nlId}">{tr}send newsletters{/tr}</a>{/if}
{if $tiki_p_admin_newsletters eq "y"}<a class="linkbut" href="tiki-admin_newsletters.php">{tr}admin newsletters{/tr}</a>{/if}

{if $edition}
<h2>{tr}Sent edition{/tr}</h2>
{tr}Subject{/tr}
<div class="wikitext">{$edition.subject}</div>
{tr}Data{/tr}
<div class="wikitext">{$edition.dataparsed}</div>
{assign var="sent" value=$edition.users}
{tr}The newsletter was sent to {$sent} email addresses{/tr}<br />
{$edition.sent|tiki_short_datetime}
{/if}

{include file=sent_newsletters.tpl }
