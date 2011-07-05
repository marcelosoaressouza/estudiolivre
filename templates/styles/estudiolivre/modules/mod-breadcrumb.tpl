{* $Header: /cvsroot/arca/estudiolivre/src/templates/styles/estudiolivre/modules/mod-breadcrumb.tpl,v 1.2 2006-07-26 07:18:15 rhwinter Exp $ *}
{if $elCrumbs}
	{tikimodule title="{tr}Bread Crumbs{/tr}" name="breadcrumb" flip=$module_params.flip}
		{elcrumbs crumbs=$elCrumbs}
	{/tikimodule}
{/if}
