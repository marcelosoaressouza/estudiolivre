<div id="ajax-commentCont-{$comment->id}" class="uMsgItem">
	<div class="uMsgAvatar">
		<img src="tiki-show_user_avatar.php?user={$comment->user}">
	</div>
	<div class="uMsgTxt">
		{if $user eq $comment->user}
		<div class="uMsgDel">
			<img class="pointer" alt="Deletar Mensagem" title="Deletar Mensagem" src="styles/{$style|replace:".css":""}/img/iDelete.png" onClick="xajax_deleteComment({$comment->id})"/>
		</div>
		{/if}
		<div class="uMsgDate">
			{$comment->date|date_format:"%H:%M"}<br />
			{$comment->date|date_format:"%d/%m/%y"}
		</div>
		<a href="el-user.php?view_user={$comment->user}">{$comment->user}</a>: {$comment->comment}
	</div>
</div>