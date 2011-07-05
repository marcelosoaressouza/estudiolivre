{* $Header: /cvsroot/arca/estudiolivre/src/templates/styles/geral/confirm.tpl,v 1.1 2007-06-14 21:52:03 garotasimpatica Exp $ *}
<br/>
<br/>
<div class="cbox">
	<div class="cbox-data">
		<form action="{$confirmaction}" method="post">
			{if $ticket}
				<input value="{$ticket}" name="ticket" type="hidden" />
			{/if}
			<input type="submit" name="daconfirm" value="{$confirmation_text}" />
			
			<br/>
			<br/>
			<br/>
			<span class="button2">
				<a href="javascript:history.back()" class="linkbut">
					{tr}Go back{/tr}
				</a>
			</span>
			<br/>
			<br/>
			<span class="button2">
				<a href="{$tikiIndex}" class="linkbut">
					{tr}Return to home page{/tr}
				</a>
			</span>
		</form>
	</div>
</div>
