{if $file->typeOfImage || (!$file->typeOfImage && $permission) }
	<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">{tr}Tipo de imagem{/tr}:</div> {ajax_input permission=$permission value=$arquivo->typeOfImage id="typeOfImage" display="inline"}</div>
{/if}
