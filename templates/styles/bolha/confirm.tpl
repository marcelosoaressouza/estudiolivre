<br/><br/><br/><br/>
<center>
<div class="cbox">
	<div class="cbox-data">
		<form action="{$confirmaction}" method="post">
			{if $ticket}
				<input value="{$ticket}" name="ticket" type="hidden" />
			{/if}
			<input type="submit" name="daconfirm" class="button" value="{$confirmation_text}" />
			
			<br/><br/><br/>
			<span class="button">
				<a href="javascript:history.back()" class="linkbut">
					{tr}Go back{/tr}
				</a>
			</span>
			<br/><br/>
		</form>
	</div>
</div>
</center>
