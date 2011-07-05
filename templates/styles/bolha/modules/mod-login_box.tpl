{* $Header: /cvsroot/arca/estudiolivre/src/templates/styles/bolha/modules/mod-login_box.tpl,v 1.3 2007-05-10 21:24:40 nano Exp $ *}
{if !$user}
	{tikimodule title="{tr}Login{/tr}" name='login'}
		<form id="uLoginBox" action="tiki-login.php" method="post">
			{if $isIE}{tr}Usuári@{/tr}: {/if}<input class="{if !$isIE}uText{/if}" type="text" name="user" id="login-user" size="12" {if $isIE}style="width:60%"{/if} {if !$isIE}value="{tr}user{/tr}" onFocus="if(this.value=='{tr}user{/tr}')this.value=''"{/if}/>
			{if $isIE}{tr}Senha{/tr}: {/if}<input class="{if !$isIE}uText{/if}" type="{if $isIE}password{else}text{/if}" name="pass" id="login-pass" size="10"	{if $isIE}style="width:68%"{/if} {if !$isIE}value="{tr}password{/tr}" onFocus="if(this.value=='{tr}password{/tr}')this.value='';this.type='password'"{/if}/>
			{if $isIE}<center><input type="submit" value="{tr}login{/tr}" name="login"/></center>{else}{tooltip text="Clique aqui ou aperte <i>Enter</i> para efetuar o login"}<input type="image" name="login" src="styles/estudiolivre/iLogin.png" />{/tooltip}{/if}
		      
			<div id="uLoginOptions">
				<a href="tiki-remind_password.php">&raquo; {tr}recuperar senha{/tr}</a><br>
				<a href="tiki-register.php">&raquo; {tr}cadastrar-se{/tr}</a><br/>
				<a href="tiki-list_users.php">&raquo; {tr}registered users{/tr}</a>
			</div>
		      
		</form>
	{/tikimodule}
{else}
	{tikimodule title="{tr}User{/tr}</a>" name='user'}
	<div id="userMod">		
		{tooltip text="Navegue para a sua página pessoal para ver seus blogs, arquivos, mensagens e mudar as suas preferências."}
			<a id="nome" href="el-user.php?view_user={$user}">
				<img src="tiki-show_user_avatar.php?user={$user}"/>
				<br/>
				{$user}
			</a>
		{/tooltip}
		{tooltip name="lista-comunidade" text="Veja a lista de <b>pessoas</b> que fazem parte da comunidade"}<a href="tiki-list_users.php">{tr}outros{/tr} {tr}users{/tr}</a>{/tooltip}
		<a href="tiki-logout.php?page={$current_location}">{tr}Logout{/tr}</a>
	</div>
	{/tikimodule}
{/if}