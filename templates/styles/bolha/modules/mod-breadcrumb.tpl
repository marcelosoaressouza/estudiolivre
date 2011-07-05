{* $Header: /cvsroot/arca/estudiolivre/src/templates/styles/bolha/modules/mod-breadcrumb.tpl,v 1.1 2006-10-20 21:11:31 rhwinter Exp $ *}
{if $elCrumbs}
	{tikimodule title="{tr}Bread Crumbs{/tr}" name="breadcrumb" flip=$module_params.flip}
		{elcrumbs crumbs=$elCrumbs}
	{/tikimodule}
{/if}
