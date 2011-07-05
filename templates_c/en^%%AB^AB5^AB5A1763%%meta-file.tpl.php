<?php /* Smarty version 2.6.18, created on 2011-04-04 20:44:27
         compiled from meta-file.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'meta-file.tpl', 2, false),array('modifier', 'lower', 'meta-file.tpl', 2, false),array('block', 'tooltip', 'meta-file.tpl', 9, false),)), $this); ?>
<?php if ($this->_tpl_vars['file']->type != 'Zip'): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp="meta-")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['file']->actualClass) : smarty_modifier_cat($_tmp, $this->_tpl_vars['file']->actualClass)))) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)))) ? $this->_run_mod_handler('cat', true, $_tmp, ".tpl") : smarty_modifier_cat($_tmp, ".tpl")), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<br/>
<?php if ($this->_tpl_vars['file']->mimeType): ?>
	<span class="fInfo">Format:</span> <?php echo $this->_tpl_vars['file']->mimeType; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php endif; ?>
<?php if ($this->_tpl_vars['permission']): ?>
	<?php $this->_tag_stack[] = array('tooltip', array('text' => "O <b>arquivo de capa</b> será visualizado sempre que alguém entrar na página desta publicação")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<label class="pointer"><input type="checkbox"<?php if (isset ( $this->_tpl_vars['arquivo']->mainFile ) && $this->_tpl_vars['arquivo']->mainFile == $this->_tpl_vars['viewFile']): ?> checked<?php endif; ?> onClick="xajax_setMainFile(this.checked ? 1 : 0, <?php echo $this->_tpl_vars['viewFile']; ?>
)"/>
		<span class="fInfo">arquivo de capa</span></label>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php endif; ?>