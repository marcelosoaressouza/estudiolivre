{* $Header: /cvsroot/arca/estudiolivre/src/templates/styles/geral/modules/mod-breadcrumb.tpl,v 1.1 2007-07-21 14:28:56 garotasimpatica Exp $ *}
{if $elCrumbs}
	{tikimodule title="{tr}Bread Crumbs{/tr}" name="breadcrumb" flip=$module_params.flip}
		{elcrumbs crumbs=$elCrumbs}
	{/tikimodule}
{/if}
