{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-users_rank.tpl,v 1.1.2.7 2007/08/12 00:24:47 marclaporte Exp $ *}

{if $feature_score eq 'y'}

{if $feature_friends eq 'y'}

{tikimodule title="<a href=\"tiki-list_users.php\">{tr}Top users{/tr}</a>" name="users_rank" flip=$module_params.flip decorations=$module_params.decorations}
<table border="0" cellpadding="0" cellspacing="0">
{section loop=$users_rank name=u}
  <tr>
    <td class="module">{$users_rank[u].position})&nbsp;</td>
    <td class="module">{$users_rank[u].score}</td>
    <td class="module">&nbsp;{$users_rank[u].login|userlink}</td>
  </tr>
{/section}
</table>
{/tikimodule}

{else}

{tikimodule title="{tr}Top users{/tr}" name="users_rank" flip=$module_params.flip decorations=$module_params.decorations}
<table border="0" cellpadding="0" cellspacing="0">
{section loop=$users_rank name=u}
  <tr>
    <td class="module">{$users_rank[u].position})&nbsp;</td>
    <td class="module">{$users_rank[u].score}</td>
    <td class="module">&nbsp;{$users_rank[u].login|userlink}</td>
  </tr>
{/section}
</table>
{/tikimodule}
{/if}

{/if}

