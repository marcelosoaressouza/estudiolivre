<?php /* Smarty version 2.6.18, created on 2011-04-25 09:03:24
         compiled from styles/geral/el-lightbox.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'styles/geral/el-lightbox.tpl', 2, false),)), $this); ?>
<script type="text/javascript" src="lib/js/lightbox.js"></script>
<link rel="stylesheet" href="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/css/lightbox.css" type="text/css"/>
<div id="overlay" ></div>
<div id="lightbox">
	
	
		<div class="ar"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/close.png" onclick="hideLightbox();" id="closeButton"></div>

	
	<div id="lightboxCont">
		<div class="lightBoxLeft"></div>

		<div class="lightBoxRight"></div>
	</div>
	
</div>