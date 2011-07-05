<?php /* Smarty version 2.6.18, created on 2011-04-04 17:12:11
         compiled from el-lightbox.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'el-lightbox.tpl', 2, false),)), $this); ?>
<script type="text/javascript" src="lib/js/lightbox.js"></script>
<link rel="stylesheet" href="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/css/lightbox.css" type="text/css"/>
<div id="overlay" ></div>
<div id="lightbox">
	<div class="lightBoxTop">
		<div class="lightBoxTopLeft"></div>
		<div class="lightBoxTopMid"></div>
		<div class="lightBoxTopRight"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/close.png" onclick="hideLightbox();" id="closeButton"></div>
	</div>
	
	<div id="lightboxCont">
		<div class="lightBoxLeft"></div>

		<div class="lightBoxRight"></div>
	</div>
	
	<div class="lightBoxBottom">
		<div class="lightBoxBottomLeft"></div>
		<div class="lightBoxBottomMid"></div>
		<div class="lightBoxBottomRight"></div>
	</div>
</div>