<?php /* Smarty version 2.6.18, created on 2011-04-10 07:13:01
         compiled from el-msg_pagination.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tooltip', 'el-msg_pagination.tpl', 4, false),)), $this); ?>
<!-- el-msg_pagination.tpl begin -->
<?php if ($this->_tpl_vars['msgTotal'] > $this->_tpl_vars['msgMaxRecords']): ?>
	<?php if ($this->_tpl_vars['msgPage']-2 > 1): ?>
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Primeira página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a class="pointer" onClick="xajax_pgMsg(0, <?php echo $this->_tpl_vars['msgMaxRecords']; ?>
)">&laquo;</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['msgPage'] > 1): ?>
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Página anterior")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a class="pointer" onClick="xajax_pgMsg(<?php echo $this->_tpl_vars['msgOffset']-$this->_tpl_vars['msgMaxRecords']; ?>
, <?php echo $this->_tpl_vars['msgMaxRecords']; ?>
)">&lt;</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['msgPage']-2 > 0): ?>
		<a class="pointer" onClick="xajax_pgMsg(<?php echo $this->_tpl_vars['msgOffset']-2*$this->_tpl_vars['msgMaxRecords']; ?>
, <?php echo $this->_tpl_vars['msgMaxRecords']; ?>
)"><?php echo $this->_tpl_vars['msgPage']-2; ?>
</a>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['msgPage']-1 > 0): ?>
		<a class="pointer" onClick="xajax_pgMsg(<?php echo $this->_tpl_vars['msgOffset']-$this->_tpl_vars['msgMaxRecords']; ?>
, <?php echo $this->_tpl_vars['msgMaxRecords']; ?>
)"><?php echo $this->_tpl_vars['msgPage']-1; ?>
</a>
	<?php endif; ?>
	<span class="selected"><?php echo $this->_tpl_vars['msgPage']; ?>
</span>
	<?php if ($this->_tpl_vars['msgPage']+1 <= $this->_tpl_vars['msgLastPage']): ?>
		<a class="pointer" onClick="xajax_pgMsg(<?php echo $this->_tpl_vars['msgOffset']+$this->_tpl_vars['msgMaxRecords']; ?>
, <?php echo $this->_tpl_vars['msgMaxRecords']; ?>
)"><?php echo $this->_tpl_vars['msgPage']+1; ?>
</a>
	<?php endif; ?>				
	<?php if ($this->_tpl_vars['msgPage']+2 <= $this->_tpl_vars['msgLastPage']): ?>
		<a class="pointer" onClick="xajax_pgMsg(<?php echo $this->_tpl_vars['msgOffset']+2*$this->_tpl_vars['msgMaxRecords']; ?>
, <?php echo $this->_tpl_vars['msgMaxRecords']; ?>
)"><?php echo $this->_tpl_vars['msgPage']+2; ?>
</a>
	<?php endif; ?>				
	<?php if ($this->_tpl_vars['msgPage'] < $this->_tpl_vars['msgLastPage']): ?>
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Próxima página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a class="pointer" onClick="xajax_pgMsg(<?php echo $this->_tpl_vars['msgOffset']+$this->_tpl_vars['msgMaxRecords']; ?>
, <?php echo $this->_tpl_vars['msgMaxRecords']; ?>
)">&gt;</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['msgPage']+2 < $this->_tpl_vars['msgLastPage']): ?>
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Última página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a class="pointer" onClick="xajax_pgMsg(<?php echo $this->_tpl_vars['msgMaxRecords']*$this->_tpl_vars['msgLastPage']-$this->_tpl_vars['msgMaxRecords']; ?>
, <?php echo $this->_tpl_vars['msgMaxRecords']; ?>
)">&raquo;</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php endif; ?>
<?php endif; ?>
<!-- el-msg_pagination.tpl end -->