<?php /* Smarty version 2.6.18, created on 2011-04-16 10:26:57
         compiled from el-gallery_metadata_Outro.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ajax_input', 'el-gallery_metadata_Outro.tpl', 2, false),)), $this); ?>
<?php if ($this->_tpl_vars['file']->typeOfImage || ( ! $this->_tpl_vars['file']->typeOfImage && $this->_tpl_vars['permission'] )): ?>
	<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">Tipo da publicação:</div> <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'value' => $this->_tpl_vars['arquivo']->typeOfPublication,'id' => 'typeOfPublication','display' => 'inline'), $this);?>
</div>
<?php endif; ?>