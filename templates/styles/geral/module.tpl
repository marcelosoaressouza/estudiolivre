<div class="userMenu">
	{assign var=display value="block"}
	{assign var=imgCurrent value="Down"}
	{assign var=imgChange value="Left"}
	<h1>
	{if $module_flip eq 'y'}
		{if $smarty.cookies.$module_name eq 'none'}
		{assign var=display value="none"}
		{assign var=imgCurrent value="Left"}
		{assign var=imgChange value="Down"}	
		{/if}
		<span class="pointer" onclick="javascript:flip('module{$module_name}');toggleImage(document.getElementById('TArrow{$module_name}'),'iArrowGrey{$imgChange}.{if $isIE}gif{else}png{/if}');storeState('{$module_name}');">
	        <img id="TArrow{$module_name}"  src="styles/{$style|replace:".css":""}/img/iArrowGrey{$imgCurrent}.{if $isIE}gif{else}png{/if}">&nbsp;{$module_title}
		</span>
	{else}
		{$module_title}
	{/if}
	
	{if !$module_params.noClose && $user}
	<span class="closeButton" ><a {*title="{tr}Unassign this module{/tr}"*} href="{$current_location|escape}{$mpchar|escape}mc_unassign={$module_name|escape}">x</a></span>
	{/if}
	</h1>
	
	<div class="userMenuContent" id="module{$module_name}" style="display:{$display}">
		{$module_content}
	</div>
</div>
