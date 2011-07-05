<?php /* Smarty version 2.6.18, created on 2011-05-11 09:42:03
         compiled from meta-imagefile.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ajax_input', 'meta-imagefile.tpl', 7, false),)), $this); ?>
<a href="<?php echo $this->_tpl_vars['file']->fullPath(); ?>
">
	<img src="<?php echo $this->_tpl_vars['file']->fullPath(); ?>
" alt="<?php echo $this->_tpl_vars['file']->fileName; ?>
"/>
</a>
<br/><br/>

<?php if ($this->_tpl_vars['file']->width || ( ! $this->_tpl_vars['file']->width && $this->_tpl_vars['permission'] )): ?>
	<span class="fInfo">Largura:</span> <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'value' => $this->_tpl_vars['file']->width,'id' => 'width','display' => 'inline','file' => $this->_tpl_vars['viewFile']), $this);?>
 px
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php endif; ?>
<?php if ($this->_tpl_vars['file']->height || ( ! $this->_tpl_vars['file']->height && $this->_tpl_vars['permission'] )): ?>
	<span class="fInfo">Altura:</span> <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'value' => $this->_tpl_vars['file']->height,'id' => 'height','display' => 'inline','file' => $this->_tpl_vars['viewFile']), $this);?>
 px
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php endif; ?>
<?php if ($this->_tpl_vars['file']->dpi || ( ! $this->_tpl_vars['file']->dpi && $this->_tpl_vars['permission'] )): ?>
	<span class="fInfo">DPI:</span> <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'value' => $this->_tpl_vars['file']->dpi,'id' => 'dpi','display' => 'inline','file' => $this->_tpl_vars['viewFile']), $this);?>

<?php endif; ?>