<?php /* Smarty version 2.6.18, created on 2011-04-19 20:28:13
         compiled from styles/bolha/textareasize.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/textareasize.tpl', 1, false),array('block', 'tooltip', 'styles/bolha/textareasize.tpl', 5, false),)), $this); ?>
<?php echo smarty_function_css(array(), $this);?>



<div id="textareasize">
	<?php $this->_tag_stack[] = array('tooltip', array('text' => "<b>Aumentar</b> a altura da caixa de edição de texto")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<a class="pointer" onClick="textareasize('<?php echo $this->_tpl_vars['area_name']; ?>
', +10, 0, '<?php echo $this->_tpl_vars['formId']; ?>
'); setCookie('editwikiRows', document.getElementById('editwiki').rows)">
		<img src="img/icons2/enlargeH.gif" border="0" />
	</a>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php $this->_tag_stack[] = array('tooltip', array('text' => "<b>Diminuir</b> a altura da caixa de edição de texto")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<a class="pointer" onClick="textareasize('<?php echo $this->_tpl_vars['area_name']; ?>
', -10, 0, '<?php echo $this->_tpl_vars['formId']; ?>
'); setCookie('editwikiRows', document.getElementById('editwiki').rows)">
		<img src="img/icons2/reduceH.gif" border="0"/>
	</a>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>