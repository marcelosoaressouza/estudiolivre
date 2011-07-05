<span id="ajax-live{$channel.mountPoint}">
	{if $permission}
		{tooltip text="Mudar a <b>senha</b> desse canal"}
		<img src="styles/{$style|replace:".css":""}/img/iWikiEdit.png" class="pointer"
		onClick="	   	
		{literal}
			if(document.getElementById('ajax-elIce').style.display == 'none'){
				flip('ajax-elIce');
			}
		{/literal}
		document.getElementById('ajax-elIceNome').innerHTML='{tr}Editando Canal...{/tr}';
		document.getElementById('ajax-elIcePto').style.display='none';
		document.getElementById('ajax-livePoint').value='{$channel.mountPoint}';
		document.getElementById('ajax-livePass').value='{$channel.password}';
		">
		{/tooltip}
		| 
		{tooltip text="<b>Remover</b> canal"}<img src="styles/{$style|replace:".css":""}/img/iWikiRemove.png" class="pointer" onClick="xajax_delete_mount_point('{$channel.mountPoint}')">{/tooltip}
	{/if}
	{$channel.mountPoint}
	<br/>
</span>