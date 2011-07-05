{* $Header: /cvsroot/arca/estudiolivre/src/templates/styles/obscur/modules/mod-login_box.tpl,v 1.1 2006-07-26 06:15:12 rhwinter Exp $ *}
{if !$user}
	{tikimodule title="{tr}Login{/tr}" name='login'}
		<form id="uLoginBox" action="tiki-login.php" method="post">
			{if $isIE}{tr}Usuário{/tr}: {/if}<input class="{if !$isIE}uText{/if}" type="text" name="user" id="login-user" size="12" {if $isIE}style="width:60%"{/if} value="{tr}user{/tr}" onFocus="if(this.value=='{tr}user{/tr}')this.value=''"/>
			{if $isIE}{tr}Senha{/tr}: {/if}<input class="{if !$isIE}uText{/if}" type="{if $isIE}password{else}text{/if}" name="pass" id="login-pass" size="10"	{if $isIE}style="width:70%"{/if} value="{if !$isIE}{tr}password{/tr}{/if}" onFocus="if(this.value=='{tr}password{/tr}')this.value='';this.type='password'"/>
			{tooltip text="Clique aqui ou aperte <i>Enter</i> para efetuar o login"}<input type="image" name="login" src="styles/estudiolivre/iLogin.png" />{/tooltip}
		      
			<div id="uLoginOptions">
				<a href="tiki-remind_password.php">&raquo; {tr}recuperar senha{/tr}</a><br>
				<a href="tiki-register.php">&raquo; {tr}cadastrar-se{/tr}</a>
			</div>
		      
		</form>
	{/tikimodule}
{else}
	{tikimodule title="{tr}User{/tr}</a>" name='user'}
	<div class="modCenterContent">
		<span id="uMenuName">
			{tooltip text="Navegue para a sua página pessoal para ver seus blogs, arquivos, mensagens e mudar as suas preferências."}{$user|userlink}{/tooltip}
		</span>
	
	    <img alt="" id="uOnlineThumb" class="uThumb" src="tiki-show_user_avatar.php?user={$user}"/>
	  
	    <div id="userNameStatsKarma">
	
	      <br>
	      <span id="uStats">
	        <img src="styles/estudiolivre/iOnline.png"> {tr}online{/tr}
	      </span>
	      <br>
	      <span id="uKarma">
	      	{*
	        <img alt="" src="styles/estudiolivre/iKarma.png">
		<img alt="" src="styles/estudiolivre/iKarma.png">
		<img alt="" src="styles/estudiolivre/iKarma.png">
		<img alt="" src="styles/estudiolivre/iKarmaInactive.png">
		<img alt="" src="styles/estudiolivre/iKarmaInactive.png">
		     *}
	      </span>
	    </div>
	    <br style="line-height:10px;"/>
	    <a href="tiki-logout.php?page={$current_location}">{tr}Logout{/tr}</a>
    </div>
	{/tikimodule}
{/if}