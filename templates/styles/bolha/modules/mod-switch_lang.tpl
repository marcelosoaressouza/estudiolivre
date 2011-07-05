{* $Header: /cvsroot/arca/estudiolivre/src/templates/styles/bolha/modules/mod-switch_lang.tpl,v 1.1 2006-10-20 21:11:31 rhwinter Exp $ *}
{*: {/tr}`$language`*}

{tikimodule title="{tr}Language{/tr}" name="switch_lang" flip=$module_params.flip decorations=$module_params.decorations}
{if $change_language ne 'n' or $user eq ''}
<div class="modCenterContent">
    {section name=ix loop=$languages}
    	{if count($available_languages) == 0 || in_array($languages[ix].value, $available_languages)}
		    {if $language neq $languages[ix].value}
				<a href="tiki-switch_lang.php?language={$languages[ix].value|escape}">{$languages[ix].name}</a><br/>
			{/if}
		{/if}
	{/section}
</div>	
{else}
{tr}Permission denied{/tr}
{/if}
{/tikimodule}
