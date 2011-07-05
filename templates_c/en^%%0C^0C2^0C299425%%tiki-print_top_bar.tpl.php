<?php /* Smarty version 2.6.18, created on 2011-04-05 00:49:30
         compiled from styles/bolha/tiki-print_top_bar.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-print_top_bar.tpl', 1, false),array('modifier', 'replace', 'styles/bolha/tiki-print_top_bar.tpl', 3, false),)), $this); ?>
<?php echo smarty_function_css(array(), $this);?>

<div id="printLogo">
	<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/logoTop.png">
</div>

<div id="printSite">
	www.estudiolivre.org
</div>