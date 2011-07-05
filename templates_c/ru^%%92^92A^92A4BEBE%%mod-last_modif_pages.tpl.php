<?php /* Smarty version 2.6.18, created on 2011-04-04 17:29:55
         compiled from styles/bolha/modules/mod-last_modif_pages.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tikimodule', 'styles/bolha/modules/mod-last_modif_pages.tpl', 1, false),array('modifier', 'escape', 'styles/bolha/modules/mod-last_modif_pages.tpl', 3, false),array('modifier', 'replace', 'styles/bolha/modules/mod-last_modif_pages.tpl', 3, false),)), $this); ?>
<?php $this->_tag_stack[] = array('tikimodule', array('title' => "Últimas Alterações",'name' => 'last_modif_pages','flip' => $this->_tpl_vars['module_params']['flip'])); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	      	<?php $_from = $this->_tpl_vars['modLastModif']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['modModifPage']):
?>
				<a href="tiki-index.php?page=<?php echo $this->_tpl_vars['modModifPage']['pageName']; ?>
" onMouseover="tooltip('<?php if ($this->_tpl_vars['modModifPage']['comment']): ?><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['modModifPage']['comment'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes') : smarty_modifier_escape($_tmp, 'quotes')))) ? $this->_run_mod_handler('replace', true, $_tmp, '"', "\'") : smarty_modifier_replace($_tmp, '"', "\'")); ?>
<?php else: ?><i>Modificação não comentada</i><?php endif; ?><br>editado por: <b><?php echo $this->_tpl_vars['modModifPage']['user']; ?>
</b>')" onMouseout="nd()"><?php echo $this->_tpl_vars['modModifPage']['pageName']; ?>
</a><br/>
	     	<?php endforeach; endif; unset($_from); ?>
	     	<div class="modViewAll"><a href="tiki-lastchanges.php?days=0">ver mais</a></div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>