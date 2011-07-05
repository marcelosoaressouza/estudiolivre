<a href="{$file->fullPath()}">
	<img src="{$file->fullPath()}" alt="{$file->fileName}"/>
</a>
<br/><br/>

{if $file->width || (!$file->width && $permission) }
	<span class="fInfo">{tr}Largura{/tr}:</span> {ajax_input permission=$permission value=$file->width id="width" display="inline" file=$viewFile} {tr}px{/tr}
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
{/if}
{if $file->height || (!$file->height && $permission) }
	<span class="fInfo">{tr}Altura{/tr}:</span> {ajax_input permission=$permission value=$file->height id="height" display="inline" file=$viewFile} {tr}px{/tr}
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
{/if}
{if $file->dpi || (!$file->dpi && $permission) }
	<span class="fInfo">{tr}DPI{/tr}:</span> {ajax_input permission=$permission value=$file->dpi id="dpi" display="inline" file=$viewFile}
{/if}
