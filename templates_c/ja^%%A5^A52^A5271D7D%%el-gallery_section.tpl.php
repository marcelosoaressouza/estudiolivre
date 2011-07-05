<?php /* Smarty version 2.6.18, created on 2011-04-04 17:51:46
         compiled from el-gallery_section.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'el-gallery_section.tpl', 2, false),)), $this); ?>
<!-- el-gallery_section.tpl begin -->
<?php echo smarty_function_css(array('only' => 'el-gallery_list_item'), $this);?>

<?php if ($this->_tpl_vars['isIE']): ?><br/><br/><br/><?php endif; ?>
<?php $_from = $this->_tpl_vars['arquivos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['p']):
?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "el-gallery_list_item.tpl", 'smarty_include_vars' => array('arquivo' => $this->_tpl_vars['p'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endforeach; endif; unset($_from); ?>
<!-- el-gallery_section.tpl end -->