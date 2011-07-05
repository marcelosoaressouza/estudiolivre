{* $Header: /cvsroot/tikiwiki/tiki/templates/modules/user_module.tpl,v 1.8.6.2 2006/12/21 03:57:00 mose Exp $ *}

{tikimodule title=$user_title name=$user_module_name flip=$module_params.flip decorations=$module_params.decorations overflow=$module_params.overflow}
{* This will be nested 'box-data' div... *}
<div id="{$user_module_name}" {if $smarty.cookies.$user_module_name ne 'c'}style="display:block;"{else}style="display:none;"{/if}>
{eval var=$user_data}
</div>
{/tikimodule}
