<?php /* Smarty version 2.6.18, created on 2011-04-06 09:20:32
         compiled from el-gallery_pagination.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tooltip', 'el-gallery_pagination.tpl', 4, false),)), $this); ?>
<!-- el-gallery_pagination.tpl begin -->
<?php if ($this->_tpl_vars['total'] > $this->_tpl_vars['maxRecords']): ?>
	<?php if ($this->_tpl_vars['page']-2 > 1): ?>
		<?php $this->_tag_stack[] = array('tooltip', array('name' => "pagination-primeira-pagina",'text' => "Primeira página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a class="pointer" onClick="xajax_get_files(tipos, 0, <?php echo $this->_tpl_vars['maxRecords']; ?>
, '<?php echo $this->_tpl_vars['sort_mode']; ?>
', '<?php echo $this->_tpl_vars['userName']; ?>
', '<?php echo $this->_tpl_vars['find']; ?>
')">&laquo;</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['page'] > 1): ?>
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Página anterior")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a class="pointer" onClick="xajax_get_files(tipos, <?php echo $this->_tpl_vars['offset']-$this->_tpl_vars['maxRecords']; ?>
, <?php echo $this->_tpl_vars['maxRecords']; ?>
, '<?php echo $this->_tpl_vars['sort_mode']; ?>
', '<?php echo $this->_tpl_vars['userName']; ?>
', '<?php echo $this->_tpl_vars['find']; ?>
')">&lt;</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['page']-2 > 0): ?>
		<a class="pointer" onClick="xajax_get_files(tipos, <?php echo $this->_tpl_vars['offset']-2*$this->_tpl_vars['maxRecords']; ?>
, <?php echo $this->_tpl_vars['maxRecords']; ?>
, '<?php echo $this->_tpl_vars['sort_mode']; ?>
', '<?php echo $this->_tpl_vars['userName']; ?>
', '<?php echo $this->_tpl_vars['find']; ?>
')"><?php echo $this->_tpl_vars['page']-2; ?>
</a>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['page']-1 > 0): ?>
		<a class="pointer" onClick="xajax_get_files(tipos, <?php echo $this->_tpl_vars['offset']-$this->_tpl_vars['maxRecords']; ?>
, <?php echo $this->_tpl_vars['maxRecords']; ?>
, '<?php echo $this->_tpl_vars['sort_mode']; ?>
', '<?php echo $this->_tpl_vars['userName']; ?>
', '<?php echo $this->_tpl_vars['find']; ?>
')"><?php echo $this->_tpl_vars['page']-1; ?>
</a>
	<?php endif; ?>
	<span class="selected"><?php echo $this->_tpl_vars['page']; ?>
</span>
	<?php if ($this->_tpl_vars['page']+1 <= $this->_tpl_vars['lastPage']): ?>
		<a class="pointer" onClick="xajax_get_files(tipos, <?php echo $this->_tpl_vars['offset']+$this->_tpl_vars['maxRecords']; ?>
, <?php echo $this->_tpl_vars['maxRecords']; ?>
, '<?php echo $this->_tpl_vars['sort_mode']; ?>
', '<?php echo $this->_tpl_vars['userName']; ?>
', '<?php echo $this->_tpl_vars['find']; ?>
')"><?php echo $this->_tpl_vars['page']+1; ?>
</a>
	<?php endif; ?>				
	<?php if ($this->_tpl_vars['page']+2 <= $this->_tpl_vars['lastPage']): ?>
		<a class="pointer" onClick="xajax_get_files(tipos, <?php echo $this->_tpl_vars['offset']+2*$this->_tpl_vars['maxRecords']; ?>
, <?php echo $this->_tpl_vars['maxRecords']; ?>
, '<?php echo $this->_tpl_vars['sort_mode']; ?>
', '<?php echo $this->_tpl_vars['userName']; ?>
', '<?php echo $this->_tpl_vars['find']; ?>
')"><?php echo $this->_tpl_vars['page']+2; ?>
</a>
	<?php endif; ?>				
	<?php if ($this->_tpl_vars['page'] < $this->_tpl_vars['lastPage']): ?>
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Próxima página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a class="pointer" onClick="xajax_get_files(tipos, <?php echo $this->_tpl_vars['offset']+$this->_tpl_vars['maxRecords']; ?>
, <?php echo $this->_tpl_vars['maxRecords']; ?>
, '<?php echo $this->_tpl_vars['sort_mode']; ?>
', '<?php echo $this->_tpl_vars['userName']; ?>
', '<?php echo $this->_tpl_vars['find']; ?>
')">&gt;</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['page']+2 < $this->_tpl_vars['lastPage']): ?>
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Última página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a class="pointer" onClick="xajax_get_files(tipos, <?php echo $this->_tpl_vars['maxRecords']*$this->_tpl_vars['lastPage']-$this->_tpl_vars['maxRecords']; ?>
, <?php echo $this->_tpl_vars['maxRecords']; ?>
, '<?php echo $this->_tpl_vars['sort_mode']; ?>
', '<?php echo $this->_tpl_vars['userName']; ?>
', '<?php echo $this->_tpl_vars['find']; ?>
')">&raquo;</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php endif; ?>
<?php endif; ?>
<!-- el-gallery_pagination.tpl end -->