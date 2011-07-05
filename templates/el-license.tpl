<div id="el-license" class="none" style="width: 500px;">
	<h2>{tr}Escolha uma licença{/tr}:</h2>
	{tr}Agora você precisa escolher sob qual licença sua obra será publicada{/tr}.<br />
	{tr}As questões abaixo te ajudam nessa tarefa, mas se você tiver alguma dúvida, visite o FAQ sobre{/tr} <a href="tiki-index.php?page=faq+Direitos+Autorais" target="_blank">{tr}Direitos autorais e generosidade intelectual{/tr}</a>

	<div id="atribution">
	  <br />
 	  <b>{tr}Permitir o uso comercial de sua obra?{/tr}</b><br />
	  <input style="width: auto;" type="radio" name="resposta1" value="2" onclick="resposta1 = 0; testLicense();">&nbsp;{tr}Não{/tr}<br />
	  <input style="width: auto;" type="radio" name="resposta1" value="1" onclick="resposta1 = 1; testLicense();">&nbsp;{tr}Sim{/tr}<br />
	  <br />

	  <b>{tr}Permitir o uso de trechos de sua obra para a criação de obras derivadas (sampling, colagem etc.)?{/tr}</b><br />
	  <input style="width: auto;" type="radio" name="resposta2" value="2" onClick="resposta2 = 0; enableAttribution(); testLicense();">&nbsp;{tr}Não{/tr}<br />
	  <input style="width: auto;" type="radio" name="resposta2" value="1" onClick="resposta2 = 1; disableAttribution(); testLicense();">&nbsp;{tr}Sim{/tr}<br />
	  <br />

	  <b>{tr}Permitir modificações em sua obra?{/tr}</b><br />
	  <input style="width: auto;" type="radio" id="resposta3-0" name="resposta3" value="2" onclick="resposta3 = 0; testLicense();" disabled>&nbsp;{tr}Não{/tr}<br />
	  <input style="width: auto;" type="radio" id="resposta3-1" name="resposta3" value="1" onclick="resposta3 = 1; testLicense();" disabled>&nbsp;{tr}Sim{/tr}<br />
	  <input style="width: auto;" type="radio" id="resposta3-2" name="resposta3" value="3" onclick="resposta3 = 2; testLicense();" disabled>&nbsp;{tr}Sim, contanto que outros compartilhem pela mesma licença{/tr}<br />
	  <br />
	  <div id="ajax-licenseCont" style="display: none"><img id="ajax-licenseImg"><div id="ajax-licenseDesc"></div><br /></div>
      {if $upload}
	  <input id="uLicencaPadrao" type="checkbox" {if !$licenca}checked{/if}/> {tr}Definir como licença {/tr}{tooltip text="Nas próximas vezes que você for enviar um arquivo a licença utilizada será essa"}{tr}padrão{/tr}{/tooltip}.
      {/if}
	  <div id="licencaErro" style="display: none">
	  	<br/>
	  	<b>{tr}Você deve escolher uma licença!{/tr}</b>
	  	<br/>
	  </div>
	  <br/>
	  <br>
	  <input style="width: auto;" type="submit" value="{tr}Escolher{/tr}" onClick="saveLicenca();"/>&nbsp;&nbsp;&nbsp;
	  <input style="width: auto;" type="submit" value="{tr}Cancelar{/tr}" onClick="hideLightbox();"/>&nbsp;&nbsp;&nbsp;
	</div>
</div>
