{if $file->language || (!$file->language && $permission) }
<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">{tr}Idioma do Vídeo{/tr}:</div> {ajax_input permission=$permission value=$arquivo->language id="language" default="" display="inline"}</div>
{/if}

{if $arquivo->subtitled || (!$arquivo->subtitled && $permission) }
<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName" onClick="flip('aLegenda')">{ajax_checkbox permission=$permission id="subtitled" value=$arquivo->subtitled}</div> {tr}Tem legenda{/tr}</div>
{/if}

{if $arquivo->subtitleLanguage || (!$arquivo->subtitleLanguage && $permission) }
<div id="aLegenda" class="gUpMoreOptionsItem" style="display:{if $arquivo->subtitled}block{else}none{/if};">
<div class="gUpMoreOptionsName">{tr}Idioma da Legenda{/tr}:</div> {ajax_input permission=$permission value=$arquivo->subtitleLanguage id="subtitleLanguage" default="" display="inline"}</div>
<br/>
{/if}

{if $arquivo->details || (!$arquivo->details && $permission) }
<div class="gUpMoreOptionsItemSingle"><div class="gUpMoreOptionsName">{tr}Ficha Técnica{/tr}:</div></div>
{ajax_textarea permission=$permission value=$arquivo->details id="details" default="" display="block" style="width: 235px; height:125px; border: 1px inset rgb(233, 233, 174);padding: 3px;font-size: 12px; font-family: Arial, Verdana, Helvetica, Lucida, Sans-Serif;background-color: #f1f1f1;margin-bottom: 5px;" wikiParsed=1}
{/if}