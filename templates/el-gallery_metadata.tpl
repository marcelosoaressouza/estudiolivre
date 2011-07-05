{if $arquivo->copyrightOwner || (!$arquivo->copyrightOwner && $permission)}
	<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">{tr}Detentor(a) dos DA{/tr}:</div> {ajax_input permission=$permission value=$arquivo->copyrightOwner id="copyrightOwner" default="" display="inline"}</div>
{/if}
{if $arquivo->producer || (!$arquivo->producer && $permission)}
	<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">{tr}Produtora{/tr}:</div> {ajax_input permission=$permission value=$arquivo->producer id="producer" default="" display="inline"}</div>
{/if}
{if $arquivo->contact || (!$arquivo->contact && $permission)}
	<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">{tr}Contato{/tr}:</div> {ajax_input permission=$permission value=$arquivo->contact id="contact" default="" display="inline"}</div>
{/if}