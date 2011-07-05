<?php /* Smarty version 2.6.18, created on 2011-04-05 05:31:15
         compiled from styles/bolha/tiki-plugin_poll.tpl */ ?>
<strong><?php echo $this->_tpl_vars['poll_title']; ?>
</strong><br />
<div>
	<?php echo $this->_tpl_vars['menu_info']['name']; ?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-poll.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>