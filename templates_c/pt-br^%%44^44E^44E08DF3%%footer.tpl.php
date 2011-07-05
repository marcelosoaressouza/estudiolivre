<?php /* Smarty version 2.6.18, created on 2011-05-02 18:35:42
         compiled from styles/obscur/footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tiki_long_datetime', 'styles/obscur/footer.tpl', 13, false),)), $this); ?>
<!-- footer.tpl begin -->
<div id="footer">




  

  <?php   include_once("tiki-debug_console.php");  ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-debug_console.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['lastup']): ?>
<div style="font-size:x-small;text-align:center;">Última atualização do CVS: <?php echo ((is_array($_tmp=$this->_tpl_vars['lastup'])) ? $this->_run_mod_handler('tiki_long_datetime', true, $_tmp) : smarty_modifier_tiki_long_datetime($_tmp)); ?>
</div>
<?php endif; ?>
</div>
<!-- footer.tpl end -->