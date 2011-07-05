{if $file->typeOfImage || (!$file->typeOfImage && $permission) }
	<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">{tr}Tipo da publicação{/tr}:</div> {ajax_input permission=$permission value=$arquivo->typeOfPublication id="typeOfPublication" display="inline"}</div>
{/if}
