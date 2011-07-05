{if $file->type neq "Zip"}
	{include file="meta-"|cat:$file->actualClass|lower|cat:".tpl"}
{/if}
<br/>
{if $file->mimeType}
	<span class="fInfo">{tr}Formato{/tr}:</span> {$file->mimeType}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
{/if}
{if $permission}
	{tooltip text="O <b>arquivo de capa</b> será visualizado sempre que alguém entrar na página desta publicação"}
		<label class="pointer"><input type="checkbox"{if $arquivo->mainFile == $viewFile} checked{/if} onClick="xajax_setMainFile(this.checked ? 1 : 0, {$viewFile})"/>
		<span class="fInfo">arquivo de capa</span></label>
	{/tooltip}
{/if}
