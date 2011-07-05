{css}
{foreach from=$userMessages.data item='msg'}
	<div 
		class="uMsgItem{if $msg.isRead ne "y"} uUnreadMsgItem"{else} "{/if}
		{if $msg.isRead ne "y" && $permission}
			onmouseover="xajax_markMsgRead({$msg.msgId});setTimeout('nd();',2000);tooltip('{tr}Marcando mensagem{/tr} {$msg.msgId} {tr}como <b>lida</b>{/tr}');"
		{/if}
	>
    	<div class="uMsgAvatar">
        	<img alt="" title="" src="tiki-show_user_avatar.php?user={$msg.user_from}">
        </div>
	<div class="uMsgTxt">
		<div class="uMsgDel">
        	{if $permission || $user eq $msg.user_from}
        	 {tooltip text="Deletar Mensagem"}
        	 	<a class="pointer" onClick="xajax_delMsg('{$msg.user_from}', {$msg.msgId})">
        	 		<img alt="" src="styles/{$style|replace:".css":""}/img/iDelete.png">
        	 	</a>
        	 {/tooltip}
        	{/if}
        </div>
        	<div class="uMsgDate">
              {$msg.date|date_format:"%H:%M"}<br />
              {$msg.date|date_format:"%d/%m/%Y"}
            </div>
            <a href="el-user.php?view_user={$msg.user_from}">{$msg.user_from}</a>: {$msg.body}
        </div>
	</div>
{foreachelse}
{tr}Seja @ primeir@ a enviar uma mensagem para esse(a) usuári@!{/tr}<br/>
{/foreach}

<div id="uMsgSend">
{if $user}
	<form onSubmit="sendMsg(); return false;">
		<input type="submit" name="" value="{tr}enviar{/tr}" label="enviar" id="uMsgSendSubmit" onClick="sendMsg()">
	   	<input type="text" id="uMsgSendInput">
	</form>
{else}
	{tr}Você não pode enviar recados pois não está logado no site{/tr}.
{/if}
</div>