{if $change_theme ne 'n' or $user eq ''}
	{*assign var=stn value=$styleName|replace:".css":""*}
	{tikimodule title="{tr}Change{/tr} {tr}Style{/tr}" name="switch_theme" flip=$module_params.flip decorations=$module_params.decorations}
		{section name=ix loop=$styleslist}
			{if count($available_styles) == 0 || in_array($styleslist[ix], $available_styles)}
				{if $style neq $styleslist[ix]}
			        <a onmouseout="nd();" onmouseover="tooltip('<img src=\'styles/{$style|replace:".css":""}/img/{$styleslist[ix]|replace:".css":""}Icon.png\'/>')" href="tiki-switch_theme.php?theme={$styleslist[ix]|escape}">{$styleslist[ix]|replace:".css":""}</a>
		        {else}
		        	{$styleslist[ix]|replace:".css":""} ({tr}current{/tr})
			    {/if}
			    <br/>
			{/if}
		{/section}
	{/tikimodule}
{/if}
