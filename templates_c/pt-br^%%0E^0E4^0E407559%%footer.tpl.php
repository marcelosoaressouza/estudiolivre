<?php /* Smarty version 2.6.18, created on 2011-04-13 09:30:06
         compiled from footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tiki_long_datetime', 'footer.tpl', 11, false),)), $this); ?>


<?php if ($this->_tpl_vars['tiki_p_admin'] == 'y' && $this->_tpl_vars['feature_debug_console'] == 'y'): ?>
  

  <?php   include_once("tiki-debug_console.php");  ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-debug_console.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['lastup']): ?>
<div class="cvsup" style="font-size:x-small;text-align:center;color:#999;">Última atualização do CVS: <?php echo ((is_array($_tmp=$this->_tpl_vars['lastup'])) ? $this->_run_mod_handler('tiki_long_datetime', true, $_tmp) : smarty_modifier_tiki_long_datetime($_tmp)); ?>
</div>
<?php endif; ?>
</body>
</html>  