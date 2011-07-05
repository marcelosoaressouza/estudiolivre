<?php /* Smarty version 2.6.18, created on 2011-04-22 13:55:59
         compiled from footer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'footer.tpl', 11, false),array('modifier', 'tiki_long_datetime', 'footer.tpl', 11, false),)), $this); ?>

<?php if ($this->_tpl_vars['tiki_p_admin'] == 'y' && $this->_tpl_vars['feature_debug_console'] == 'y'): ?>
  
  <?php   include_once("tiki-debug_console.php");  ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-debug_console.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['lastup']): ?>
<div class="cvsup" style="font-size:x-small;text-align:center;color:#999;"><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Last update from CVS<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>: <?php echo ((is_array($_tmp=$this->_tpl_vars['lastup'])) ? $this->_run_mod_handler('tiki_long_datetime', true, $_tmp) : smarty_modifier_tiki_long_datetime($_tmp)); ?>
</div>
<?php endif; ?>
</body>
</html>  