<?php /* Smarty version 2.6.18, created on 2011-05-02 18:35:41
         compiled from styles/obscur/module.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'styles/obscur/module.tpl', 8, false),)), $this); ?>
<div class="userMenu">
	<?php $this->assign('display', 'block'); ?>
	<?php $this->assign('imgCurrent', 'Down'); ?>
	<?php $this->assign('imgChange', 'Left'); ?>
	<h1>
		<?php if (! $this->_tpl_vars['module_params']['noClose'] && $this->_tpl_vars['user']): ?>
			<span class="closeButton" >
				<a  href="<?php echo ((is_array($_tmp=$this->_tpl_vars['current_location'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['mpchar'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
mc_unassign=<?php echo ((is_array($_tmp=$this->_tpl_vars['module_name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
					x
				</a>
			</span>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['module_flip'] == 'y'): ?>
			<?php if ($_COOKIE[$this->_tpl_vars['module_name']] == 'none'): ?>
				<?php $this->assign('display', 'none'); ?>
				<?php $this->assign('imgCurrent', 'Left'); ?>
				<?php $this->assign('imgChange', 'Down'); ?>	
			<?php endif; ?>
				<span class="pointer" onclick="javascript:flip('module<?php echo $this->_tpl_vars['module_name']; ?>
');toggleImage(document.getElementById('TArrow<?php echo $this->_tpl_vars['module_name']; ?>
'),'iArrowGrey<?php echo $this->_tpl_vars['imgChange']; ?>
.png');storeState('<?php echo $this->_tpl_vars['module_name']; ?>
');">
			        <?php echo $this->_tpl_vars['module_title']; ?>
<img id="TArrow<?php echo $this->_tpl_vars['module_name']; ?>
"  src="styles/estudiolivre/iArrowGrey<?php echo $this->_tpl_vars['imgCurrent']; ?>
.png">
				</span>
		<?php else: ?>
			<?php echo $this->_tpl_vars['module_title']; ?>

		<?php endif; ?>
	</h1>
	<div class="userMenuContent" id="module<?php echo $this->_tpl_vars['module_name']; ?>
" style="display:<?php echo $this->_tpl_vars['display']; ?>
">
		<?php echo $this->_tpl_vars['module_content']; ?>

	</div>
</div>