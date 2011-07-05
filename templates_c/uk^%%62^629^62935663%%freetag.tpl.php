<?php /* Smarty version 2.6.18, created on 2011-06-08 09:43:08
         compiled from styles/bolha/freetag.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tooltip', 'styles/bolha/freetag.tpl', 23, false),array('modifier', 'escape', 'styles/bolha/freetag.tpl', 23, false),)), $this); ?>
<!-- begin freetag.tpl -->
<?php if ($this->_tpl_vars['feature_freetags'] == 'y'): ?>
	<script language="JavaScript">
		<?php echo '
		  function addTag(tag) {
		      var currentTags = document.getElementById(\'tagBox\');
    
		      if (currentTags.value != \'\') {
			  	currentTags.value += \', \';
		      }
		      
		      currentTags.value += tag.innerHTML;
		      tag.style.display = \'none\';
		      document.getElementById(tag.innerHTML+"-v").style.display = "none";
		  }
		'; ?>

	</script>
	<div id="freetager">
	Tags: 
		<?php if ($this->_tpl_vars['feature_help'] == 'y'): ?>
			
		<?php endif; ?>
	    <?php $this->_tag_stack[] = array('tooltip', array('text' => "Escreva aqui as tags dessa página (separadas por <b>vírgula</b>)")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><input type="text" id="tagBox" name="freetag_string" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['taglist'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="60" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br />
		<?php $_from = $this->_tpl_vars['tag_suggestion']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tag_suggest'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tag_suggest']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['t']):
        $this->_foreach['tag_suggest']['iteration']++;
?>
			<span onclick="addTag(this)" class="pointer"><?php echo $this->_tpl_vars['t']; ?>
</span><span id="<?php echo $this->_tpl_vars['t']; ?>
-v"<?php if (($this->_foreach['tag_suggest']['iteration'] == $this->_foreach['tag_suggest']['total'])): ?> style="display:none"<?php endif; ?>>,</span>
		<?php endforeach; endif; unset($_from); ?>
	</div>
<?php endif; ?>
<!--end freetag.tpl-->
