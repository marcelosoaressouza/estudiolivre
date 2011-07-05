<?php /* Smarty version 2.6.18, created on 2011-04-23 12:19:38
         compiled from el-license.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tooltip', 'el-license.tpl', 25, false),)), $this); ?>
<div id="el-license" class="none" style="width: 500px;">
	<h2>Choose a license:</h2>
	You can now choose the license under which your work will be published.<br />
	The questions bellow will guide you in this task, but if you have any doubst check the FAQ on <a href="tiki-index.php?page=faq+Direitos+Autorais" target="_blank">Author Rights and intellectual generosity</a>

	<div id="atribution">
	  <br />
 	  <b>Would you like to allow commercial use of your work?</b><br />
	  <input style="width: auto;" type="radio" name="resposta1" value="2" onclick="resposta1 = 0; testLicense();">&nbsp;No<br />
	  <input style="width: auto;" type="radio" name="resposta1" value="1" onclick="resposta1 = 1; testLicense();">&nbsp;Yes<br />
	  <br />

	  <b>Do you allow others to use of parts of your work to create new derivative works (sampling)?</b><br />
	  <input style="width: auto;" type="radio" name="resposta2" value="2" onClick="resposta2 = 0; enableAttribution(); testLicense();">&nbsp;No<br />
	  <input style="width: auto;" type="radio" name="resposta2" value="1" onClick="resposta2 = 1; disableAttribution(); testLicense();">&nbsp;Yes<br />
	  <br />

	  <b>Allow others to modify your work?</b><br />
	  <input style="width: auto;" type="radio" id="resposta3-0" name="resposta3" value="2" onclick="resposta3 = 0; testLicense();" disabled>&nbsp;No<br />
	  <input style="width: auto;" type="radio" id="resposta3-1" name="resposta3" value="1" onclick="resposta3 = 1; testLicense();" disabled>&nbsp;Yes<br />
	  <input style="width: auto;" type="radio" id="resposta3-2" name="resposta3" value="3" onclick="resposta3 = 2; testLicense();" disabled>&nbsp;Yes, as long as they share it with the same license<br />
	  <br />
	  <div id="ajax-licenseCont" style="display: none"><img id="ajax-licenseImg"><div id="ajax-licenseDesc"></div><br /></div>
      <?php if ($this->_tpl_vars['upload']): ?>
	  <input id="uLicencaPadrao" type="checkbox" <?php if (! $this->_tpl_vars['licenca']): ?>checked<?php endif; ?>/> Use this license <?php $this->_tag_stack[] = array('tooltip', array('text' => "Nas próximas vezes que você for enviar um arquivo a licença utilizada será essa")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>always<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>.
      <?php endif; ?>
	  <div id="licencaErro" style="display: none">
	  	<br/>
	  	<b>You must choose a license!</b>
	  	<br/>
	  </div>
	  <br/>
	  <br>
	  <input style="width: auto;" type="submit" value="Choose" onClick="saveLicenca();"/>&nbsp;&nbsp;&nbsp;
	  <input style="width: auto;" type="submit" value="Cancel" onClick="hideLightbox();"/>&nbsp;&nbsp;&nbsp;
	</div>
</div>