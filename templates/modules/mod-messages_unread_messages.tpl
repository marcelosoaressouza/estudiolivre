{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/mod-messages_unread_messages.tpl,v 1.11.2.1 2005/02/23 15:35:08 michael_davey Exp $ *}

{if $user and $feature_messages eq 'y' and $tiki_p_messages eq 'y'}
{tikimodule title="{tr}Messages{/tr}" name="messages_unread_messages" flip=$module_params.flip decorations=$module_params.decorations}
{if $modUnread > 0}
	<a class="linkmodule" href="messu-mailbox.php"><span class="highlight">
	{tr}You have{/tr} {$modUnread} {if $modUnread !== '1'}{tr}new messages{/tr}{else}{tr}new message{/tr}{/if}</span>
{else}
	<a class="linkmodule" href="messu-mailbox.php">
	{tr}You have 0 new messages{/tr}
{/if}
</a>
{/tikimodule}
{/if}
