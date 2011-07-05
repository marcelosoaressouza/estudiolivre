{* $Header: /cvsroot/tikiwiki/tiki/templates/styles/simple/modules/Attic/mod-switch_theme.tpl,v 1.1.2.1 2006/01/29 22:45:08 luciash Exp $ *}

{tikimodule title="{tr}Style{/tr}: $styleName" name="switch_theme" flip=$module_params.flip decorations=$module_params.decorations}
	{if $change_theme ne 'n' or $user eq ''}
	<form method="get" action="tiki-switch_theme.php">
		<select name="theme" size="1" onchange="this.form.submit();">
		{section name=ix loop=$styleslist}
			{if count($available_styles) == 0 || in_array($styleslist[ix], $available_styles)}
			<option value="{$styleslist[ix]|escape}"{if $style eq $styleslist[ix]} selected="selected"{/if}>{$styleslist[ix]}</option>
			{/if}
		{/section}
		</select>
		<noscript>
			<button type="submit">{tr}switch{/tr}</button>
		</noscript>
	</form>
	{else}
		{tr}Permission denied{/tr}
	{/if}
{/tikimodule}
