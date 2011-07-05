<?php /* Smarty version 2.6.18, created on 2011-04-05 19:38:24
         compiled from el-gallery_tags.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tooltip', 'el-gallery_tags.tpl', 2, false),array('modifier', 'cat', 'el-gallery_tags.tpl', 2, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['fileTags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tags'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tags']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['t']):
        $this->_foreach['tags']['iteration']++;
?>
	<?php $this->_tag_stack[] = array('tooltip', array('text' => ((is_array($_tmp=((is_array($_tmp="Clique para ver outros arquivos com a tag <b>")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['t']['tag']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['t']['tag'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "</b>") : smarty_modifier_cat($_tmp, "</b>")))); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a class="freetag" href="tiki-browse_freetags.php?tag=<?php echo $this->_tpl_vars['t']['tag']; ?>
"><?php echo $this->_tpl_vars['t']['tag']; ?>
</a><?php if (! ($this->_foreach['tags']['iteration'] == $this->_foreach['tags']['total'])): ?>,<?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php endforeach; else: ?>
	<?php $this->_tag_stack[] = array('tooltip', array('text' => "Esse arquivo não tem tags")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>&nbsp;<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php endif; unset($_from); ?>