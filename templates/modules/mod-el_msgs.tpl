{* $Header: /cvsroot/arca/estudiolivre/src/templates/modules/mod-el_msgs.tpl,v 1.3 2006-11-08 05:37:55 nano Exp $ *}

{if $mod_allowMsgs}
<div id="ajax-mod-el_msgs">
	{tikimodule title="{tr}Messages{/tr} ($modUnread)" name="messages_unread_messages" flip=$module_params.flip decorations=$module_params.decorations}
		{if $modUnread > 0}
			{foreach from=$mod_userMessages.data item='mod_msg'}
				<a href="el-user.php?view_user={$mod_msg.user_from}">
					{$mod_msg.user_from}
				</a>:
				<a href="el-user.php?view_user={$user}#messages" class="mod-el_msg-msg" onmouseover="tooltip('{tr}Enviada às{/tr}: <i>{$mod_msg.date|date_format:"%H:%M - %d/%m"}</i>');" onmouseout="nd();">
					{$mod_msg.body|truncate:20:"(..)"}
				</a>

				<br>
			{/foreach}
		{else}
			{tr}No new messages{/tr}
		{/if}
		<div class="modViewAll"><a href="el-user.php?view_user={$user}#messages">{tr}ver todas{/tr}</a></div>
	{/tikimodule}
</div>
{/if}
