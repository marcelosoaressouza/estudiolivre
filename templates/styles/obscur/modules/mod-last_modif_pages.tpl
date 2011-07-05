{tikimodule title="{tr}Últimas Alterações{/tr}" name='last_modif_pages' flip=$module_params.flip}
	      	{foreach from=$modLastModif item='modModifPage'}
				<a href="tiki-index.php?page={$modModifPage.pageName}" onMouseover="tooltip('{if $modModifPage.comment}{$modModifPage.comment|escape:'quotes'|replace:'"':"\'"}{else}<i>{tr}Modificação não comentada{/tr}</i>{/if}<br>{tr}editado por{/tr}: <b>{$modModifPage.user}</b>')" onMouseout="nd()">{$modModifPage.pageName}</a><br/>
	     	{/foreach}
	     	<div class="modViewAll"><a href="tiki-lastchanges.php?days=0">{tr}ver mais{/tr}</a></div>
{/tikimodule}