{css}
<strong>{$menu_info.title}</strong>
<br/>

<form method="post" action="{$ownurl}">
	<input type="hidden" name="polls_pollId" value="{$menu_info.pollId|escape}" />
	{section name=ix loop=$channels}
	  <input type="radio" name="polls_optionId" value="{$channels[ix].optionId|escape}" />{tr}{$channels[ix].title}{/tr}<br />
	{/section}
	{if $tiki_p_vote_poll eq 'y'}
	<center>
		<input type="submit" name="pollVote" value="{tr}vote{/tr}" />
	</center>
</form>
	{else}
</form>
<center>
	<input type="submit" onclick="showLightbox('precisaLogar'); return false;" value="{tr}vote{/tr}" />
</center>
<div id="precisaLogar" style="display:none;width:200px;">
	{tr}Para votar é necessário se {/tr}<a href="tiki-register.php">{tr}cadastrar{/tr}</a> {tr}no site{/tr}.<br><br>
	{tr}Se for cadastrado, efetue o login{/tr}:<br>
    <form id="uLoginBox" action="tiki-login.php" method="post"><input type="hidden" name="redirect" value="tiki-index.php?page={$page}"><input class="uText" type="text" name="user" id="login-user" size="12" value="{tr}usuári@{/tr}" onFocus="this.value=null"/><input class="uText" type="text" name="pass" id="login-pass" size="10" value="{tr}senha{/tr}" onFocus="this.value=null;this.type='password'"/><input type="image" name="login" src="styles/{$style|replace:".css":""}/img/iLogin.png" />
    <div id="uLoginOptions">
        <a href="tiki-remind_password.php">&raquo; {tr}recuperar senha{/tr}</a><br>
    </div>
    </form>
</div>
{/if}
<center>
	<a class="linkmodule" href="tiki-poll_results.php?pollId={$menu_info.pollId}">{tr}View Results{/tr}</a><br />
	({tr}Votes{/tr}: {$menu_info.votes})
	{if $feature_poll_comments and $comments}<br />(<a href="tiki-poll_results.php?pollId={$menu_info.pollId}&amp;comzone=show#comments">{tr}Comments{/tr}: {$comments}</a>){/if}
</center>

