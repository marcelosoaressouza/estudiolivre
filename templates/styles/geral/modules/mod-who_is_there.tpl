{* $Header: /cvsroot/arca/estudiolivre/src/templates/styles/geral/modules/mod-who_is_there.tpl,v 1.1 2007-07-21 14:28:58 garotasimpatica Exp $ *}
{math equation="count-1" count=$online_users|@count assign=numberOfUsers}
{tikimodule title="{tr}Usuári@s Online{/tr} ($numberOfUsers)" name="who_is_there" flip=$module_params.flip}
	{if $numberOfUsers >= 1}
      <div id='moduleWhoIsThereMore'>
		{foreach from=$online_users item='onlineUser'}
		  {if $onlineUser.user neq $user}
		    <a href="el-user.php?view_user={$onlineUser.user}">{$onlineUser.user}</a><br/>
		  {/if}
		{/foreach}
      </div>
    {else}
    	{tr}Não há usuári@s online{/tr}
    {/if}
{/tikimodule}