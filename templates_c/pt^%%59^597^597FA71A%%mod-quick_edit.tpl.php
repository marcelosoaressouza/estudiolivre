<?php /* Smarty version 2.6.18, created on 2011-04-30 20:05:10
         compiled from modules/mod-quick_edit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tikimodule', 'modules/mod-quick_edit.tpl', 4, false),)), $this); ?>


<?php if ($this->_tpl_vars['tiki_p_edit'] == 'y'): ?>
<?php $this->_tag_stack[] = array('tikimodule', array('title' => $this->_tpl_vars['module_title'],'name' => 'quick_edit','flip' => $this->_tpl_vars['module_params']['flip'],'decorations' => $this->_tpl_vars['module_params']['decorations'])); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<form method="get" action="tiki-editpage.php">
<?php if ($this->_tpl_vars['categId']): ?><input type="hidden" name="categId" value="<?php echo $this->_tpl_vars['categId']; ?>
" /><?php endif; ?>
<?php if ($this->_tpl_vars['templateId']): ?><input type="hidden" name="templateId" value="<?php echo $this->_tpl_vars['templateId']; ?>
" /><?php endif; ?>
<?php if ($this->_tpl_vars['mod_quickedit_heading']): ?><div class="bod-data"><?php echo $this->_tpl_vars['mod_quickedit_heading']; ?>
</div><?php endif; ?>
<input type="text" size="<?php echo $this->_tpl_vars['size']; ?>
" name="page" />
<input type="submit" name="quickedit" value="<?php echo $this->_tpl_vars['submit']; ?>
" />
</form>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php else: ?>
<!-- no perm -->
<?php endif; ?>