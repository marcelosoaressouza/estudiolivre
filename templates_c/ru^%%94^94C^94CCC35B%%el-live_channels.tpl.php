<?php /* Smarty version 2.6.18, created on 2011-04-05 15:09:38
         compiled from el-live_channels.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tooltip', 'el-live_channels.tpl', 3, false),array('modifier', 'replace', 'el-live_channels.tpl', 4, false),)), $this); ?>
<span id="ajax-live<?php echo $this->_tpl_vars['channel']['mountPoint']; ?>
">
	<?php if ($this->_tpl_vars['permission']): ?>
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Mudar a <b>senha</b> desse canal")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiEdit.png" class="pointer"
		onClick="	   	
		<?php echo '
			if(document.getElementById(\'ajax-elIce\').style.display == \'none\'){
				flip(\'ajax-elIce\');
			}
		'; ?>

		document.getElementById('ajax-elIceNome').innerHTML='Editando Canal...';
		document.getElementById('ajax-elIcePto').style.display='none';
		document.getElementById('ajax-livePoint').value='<?php echo $this->_tpl_vars['channel']['mountPoint']; ?>
';
		document.getElementById('ajax-livePass').value='<?php echo $this->_tpl_vars['channel']['password']; ?>
';
		">
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		| 
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "<b>Remover</b> canal")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiRemove.png" class="pointer" onClick="xajax_delete_mount_point('<?php echo $this->_tpl_vars['channel']['mountPoint']; ?>
')"><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php endif; ?>
	<?php echo $this->_tpl_vars['channel']['mountPoint']; ?>

	<br/>
</span>