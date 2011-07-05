<?php /* Smarty version 2.6.18, created on 2011-06-08 09:43:01
         compiled from styles/bolha/modules/mod-breadcrumb.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tikimodule', 'styles/bolha/modules/mod-breadcrumb.tpl', 3, false),array('function', 'elcrumbs', 'styles/bolha/modules/mod-breadcrumb.tpl', 4, false),)), $this); ?>

<?php if ($this->_tpl_vars['elCrumbs']): ?>
	<?php $this->_tag_stack[] = array('tikimodule', array('title' => 'Bread Crumbs','name' => 'breadcrumb','flip' => $this->_tpl_vars['module_params']['flip'])); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php echo smarty_function_elcrumbs(array('crumbs' => $this->_tpl_vars['elCrumbs']), $this);?>

	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php endif; ?>