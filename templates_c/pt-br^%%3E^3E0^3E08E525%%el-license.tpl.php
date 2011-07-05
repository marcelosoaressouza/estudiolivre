<?php /* Smarty version 2.6.18, created on 2011-04-04 20:42:58
         compiled from el-license.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tooltip', 'el-license.tpl', 25, false),)), $this); ?>
<div id="el-license" class="none" style="width: 500px;">
	<h2>Escolha uma licença:</h2>
	Agora você precisa escolher sob qual licença sua obra será publicada.<br />
	As questões abaixo te ajudam nessa tarefa, mas se você tiver alguma dúvida, visite o FAQ sobre <a href="tiki-index.php?page=faq+Direitos+Autorais" target="_blank">Direitos autorais e generosidade intelectual</a>

	<div id="atribution">
	  <br />
 	  <b>Permitir o uso comercial de sua obra?</b><br />
	  <input style="width: auto;" type="radio" name="resposta1" value="2" onclick="resposta1 = 0; testLicense();">&nbsp;Não<br />
	  <input style="width: auto;" type="radio" name="resposta1" value="1" onclick="resposta1 = 1; testLicense();">&nbsp;Sim<br />
	  <br />

	  <b>Permitir o uso de trechos de sua obra para a criação de obras derivadas (sampling, colagem etc.)?</b><br />
	  <input style="width: auto;" type="radio" name="resposta2" value="2" onClick="resposta2 = 0; enableAttribution(); testLicense();">&nbsp;Não<br />
	  <input style="width: auto;" type="radio" name="resposta2" value="1" onClick="resposta2 = 1; disableAttribution(); testLicense();">&nbsp;Sim<br />
	  <br />

	  <b>Permitir modificações em sua obra?</b><br />
	  <input style="width: auto;" type="radio" id="resposta3-0" name="resposta3" value="2" onclick="resposta3 = 0; testLicense();" disabled>&nbsp;Não<br />
	  <input style="width: auto;" type="radio" id="resposta3-1" name="resposta3" value="1" onclick="resposta3 = 1; testLicense();" disabled>&nbsp;Sim<br />
	  <input style="width: auto;" type="radio" id="resposta3-2" name="resposta3" value="3" onclick="resposta3 = 2; testLicense();" disabled>&nbsp;Sim, contanto que outros compartilhem pela mesma licença<br />
	  <br />
	  <div id="ajax-licenseCont" style="display: none"><img id="ajax-licenseImg"><div id="ajax-licenseDesc"></div><br /></div>
      <?php if ($this->_tpl_vars['upload']): ?>
	  <input id="uLicencaPadrao" type="checkbox" <?php if (! $this->_tpl_vars['licenca']): ?>checked<?php endif; ?>/> Definir como licença <?php $this->_tag_stack[] = array('tooltip', array('text' => "Nas próximas vezes que você for enviar um arquivo a licença utilizada será essa")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>padrão<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.
      <?php endif; ?>
	  <div id="licencaErro" style="display: none">
	  	<br/>
	  	<b>Você deve escolher uma licença!</b>
	  	<br/>
	  </div>
	  <br/>
	  <br>
	  <input style="width: auto;" type="submit" value="Escolher" onClick="saveLicenca();"/>&nbsp;&nbsp;&nbsp;
	  <input style="width: auto;" type="submit" value="Cancelar" onClick="hideLightbox();"/>&nbsp;&nbsp;&nbsp;
	</div>
</div>