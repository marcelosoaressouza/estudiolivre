<?php /* Smarty version 2.6.18, created on 2011-04-11 09:09:14
         compiled from styles/bolha/tiki.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'styles/bolha/tiki.tpl', 16, false),)), $this); ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="UTF-8"<?php echo '?>'; ?>


<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "body.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  	
	<?php if ($this->_tpl_vars['isIE']): ?>
		<link rel="StyleSheet"  href="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/css/ie.css" type="text/css" />
	<?php endif; ?>
	
</html>