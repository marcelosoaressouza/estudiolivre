{if $file->duracao || (!$file->duration && $permission) }
<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">{tr}Duração{/tr}:</div> {ajax_input permission=$permission value=$file->duration id="duration" default="" display="inline" file=$viewFile} s</div>
{/if}

{if $file->bpm || (!$file->bpm && $permission) }
<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">{tr}bpm{/tr}:</div> {ajax_input permission=$permission value=$file->bpm id="bpm" default="" display="inline" file=$viewFile}</div>
{/if}

{if $file->sampleRate || (!$file->sampleRate && $permission) }
<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">{tr}Sample Rate{/tr}:</div> {ajax_input permission=$permission value=$file->sampleRate id="sampleRate" default="" display="inline" file=$viewFile} hz</div>
{/if}

{if $file->bitRate || (!$file->bitRate && $permission) }
<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">{tr}Bit Rate{/tr}:</div> {ajax_input permission=$permission value=$file->bitRate id="bitRate" default="" display="inline" file=$viewFile} {tr}bits{/tr}</div>
{/if}
