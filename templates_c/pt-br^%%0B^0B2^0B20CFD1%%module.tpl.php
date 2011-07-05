<?php /* Smarty version 2.6.18, created on 2011-04-25 09:03:24
         compiled from styles/geral/module.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'styles/geral/module.tpl', 13, false),array('modifier', 'escape', 'styles/geral/module.tpl', 20, false),)), $this); ?>
<div class="userMenu">
	<?php $this->assign('display', 'block'); ?>
	<?php $this->assign('imgCurrent', 'Down'); ?>
	<?php $this->assign('imgChange', 'Left'); ?>
	<h1>
	<?php if ($this->_tpl_vars['module_flip'] == 'y'): ?>
		<?php if ($_COOKIE[$this->_tpl_vars['module_name']] == 'none'): ?>
		<?php $this->assign('display', 'none'); ?>
		<?php $this->assign('imgCurrent', 'Left'); ?>
		<?php $this->assign('imgChange', 'Down'); ?>	
		<?php endif; ?>
		<span class="pointer" onclick="javascript:flip('module<?php echo $this->_tpl_vars['module_name']; ?>
');toggleImage(document.getElementById('TArrow<?php echo $this->_tpl_vars['module_name']; ?>
'),'iArrowGrey<?php echo $this->_tpl_vars['imgChange']; ?>
.<?php if ($this->_tpl_vars['isIE']): ?>gif<?php else: ?>png<?php endif; ?>');storeState('<?php echo $this->_tpl_vars['module_name']; ?>
');">
	        <img id="TArrow<?php echo $this->_tpl_vars['module_name']; ?>
"  src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGrey<?php echo $this->_tpl_vars['imgCurrent']; ?>
.<?php if ($this->_tpl_vars['isIE']): ?>gif<?php else: ?>png<?php endif; ?>">&nbsp;<?php echo $this->_tpl_vars['module_title']; ?>

		</span>
	<?php else: ?>
		<?php echo $this->_tpl_vars['module_title']; ?>

	<?php endif; ?>
	
	<?php if (! $this->_tpl_vars['module_params']['noClose'] && $this->_tpl_vars['user']): ?>
	<span class="closeButton" ><a  href="<?php echo ((is_array($_tmp=$this->_tpl_vars['current_location'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['mpchar'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
mc_unassign=<?php echo ((is_array($_tmp=$this->_tpl_vars['module_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">x</a></span>
	<?php endif; ?>
	</h1>
	
	<div class="userMenuContent" id="module<?php echo $this->_tpl_vars['module_name']; ?>
" style="display:<?php echo $this->_tpl_vars['display']; ?>
">
		<?php echo $this->_tpl_vars['module_content']; ?>

	</div>
</div>