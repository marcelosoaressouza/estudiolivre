<?php /* Smarty version 2.6.18, created on 2011-04-06 14:43:53
         compiled from el-gallery_metadata.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ajax_input', 'el-gallery_metadata.tpl', 2, false),)), $this); ?>
<?php if ($this->_tpl_vars['arquivo']->copyrightOwner || ( ! $this->_tpl_vars['arquivo']->copyrightOwner && $this->_tpl_vars['permission'] )): ?>
	<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">Detentor(a) dos DA:</div> <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'value' => $this->_tpl_vars['arquivo']->copyrightOwner,'id' => 'copyrightOwner','default' => "",'display' => 'inline'), $this);?>
</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['arquivo']->producer || ( ! $this->_tpl_vars['arquivo']->producer && $this->_tpl_vars['permission'] )): ?>
	<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">Produtora:</div> <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'value' => $this->_tpl_vars['arquivo']->producer,'id' => 'producer','default' => "",'display' => 'inline'), $this);?>
</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['arquivo']->contact || ( ! $this->_tpl_vars['arquivo']->contact && $this->_tpl_vars['permission'] )): ?>
	<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">Contato:</div> <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'value' => $this->_tpl_vars['arquivo']->contact,'id' => 'contact','default' => "",'display' => 'inline'), $this);?>
</div>
<?php endif; ?>