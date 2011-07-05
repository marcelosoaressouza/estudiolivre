<?php /* Smarty version 2.6.18, created on 2011-06-09 05:07:44
         compiled from styles/bolha/tiki-view_blog.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-view_blog.tpl', 1, false),array('modifier', 'replace', 'styles/bolha/tiki-view_blog.tpl', 17, false),array('modifier', 'times', 'styles/bolha/tiki-view_blog.tpl', 31, false),)), $this); ?>
<?php echo smarty_function_css(array('extra' => 'tiki-view_blog_post_item'), $this);?>

<div id="vBlog">
	
	
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "blog-heading.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
	
	
	<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['listpages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ix']['show'] = true;
$this->_sections['ix']['max'] = $this->_sections['ix']['loop'];
$this->_sections['ix']['step'] = 1;
$this->_sections['ix']['start'] = $this->_sections['ix']['step'] > 0 ? 0 : $this->_sections['ix']['loop']-1;
if ($this->_sections['ix']['show']) {
    $this->_sections['ix']['total'] = $this->_sections['ix']['loop'];
    if ($this->_sections['ix']['total'] == 0)
        $this->_sections['ix']['show'] = false;
} else
    $this->_sections['ix']['total'] = 0;
if ($this->_sections['ix']['show']):

            for ($this->_sections['ix']['index'] = $this->_sections['ix']['start'], $this->_sections['ix']['iteration'] = 1;
                 $this->_sections['ix']['iteration'] <= $this->_sections['ix']['total'];
                 $this->_sections['ix']['index'] += $this->_sections['ix']['step'], $this->_sections['ix']['iteration']++):
$this->_sections['ix']['rownum'] = $this->_sections['ix']['iteration'];
$this->_sections['ix']['index_prev'] = $this->_sections['ix']['index'] - $this->_sections['ix']['step'];
$this->_sections['ix']['index_next'] = $this->_sections['ix']['index'] + $this->_sections['ix']['step'];
$this->_sections['ix']['first']      = ($this->_sections['ix']['iteration'] == 1);
$this->_sections['ix']['last']       = ($this->_sections['ix']['iteration'] == $this->_sections['ix']['total']);
?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-view_blog_post_item.tpl", 'smarty_include_vars' => array('post' => $this->_tpl_vars['listpages'][$this->_sections['ix']['index']],'text' => $this->_tpl_vars['listpages'][$this->_sections['ix']['index']]['parsed_data'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endfor; endif; ?>
	<br />

	<div class="paginacao">
		<?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
			<a class="prevnext" href="tiki-view_blog.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;blogId=<?php echo $this->_tpl_vars['blogId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
				<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyLeft.png">
			</a>
		<?php endif; ?>
		
		Strona <?php echo $this->_tpl_vars['actual_page']; ?>
 de <?php echo $this->_tpl_vars['cant_pages']; ?>

		
		<?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
			<a class="prevnext" href="tiki-view_blog.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;blogId=<?php echo $this->_tpl_vars['blogId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['next_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
				<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyRight.png">
			</a>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['direct_pagination'] == 'y'): ?>
			<br />
			<?php unset($this->_sections['foo']);
$this->_sections['foo']['loop'] = is_array($_loop=$this->_tpl_vars['cant_pages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['show'] = true;
$this->_sections['foo']['max'] = $this->_sections['foo']['loop'];
$this->_sections['foo']['step'] = 1;
$this->_sections['foo']['start'] = $this->_sections['foo']['step'] > 0 ? 0 : $this->_sections['foo']['loop']-1;
if ($this->_sections['foo']['show']) {
    $this->_sections['foo']['total'] = $this->_sections['foo']['loop'];
    if ($this->_sections['foo']['total'] == 0)
        $this->_sections['foo']['show'] = false;
} else
    $this->_sections['foo']['total'] = 0;
if ($this->_sections['foo']['show']):

            for ($this->_sections['foo']['index'] = $this->_sections['foo']['start'], $this->_sections['foo']['iteration'] = 1;
                 $this->_sections['foo']['iteration'] <= $this->_sections['foo']['total'];
                 $this->_sections['foo']['index'] += $this->_sections['foo']['step'], $this->_sections['foo']['iteration']++):
$this->_sections['foo']['rownum'] = $this->_sections['foo']['iteration'];
$this->_sections['foo']['index_prev'] = $this->_sections['foo']['index'] - $this->_sections['foo']['step'];
$this->_sections['foo']['index_next'] = $this->_sections['foo']['index'] + $this->_sections['foo']['step'];
$this->_sections['foo']['first']      = ($this->_sections['foo']['iteration'] == 1);
$this->_sections['foo']['last']       = ($this->_sections['foo']['iteration'] == $this->_sections['foo']['total']);
?>
				<?php $this->assign('selector_offset', ((is_array($_tmp=$this->_sections['foo']['index'])) ? $this->_run_mod_handler('times', true, $_tmp, $this->_tpl_vars['maxRecords']) : smarty_modifier_times($_tmp, $this->_tpl_vars['maxRecords']))); ?>
					<a class="prevnext" href="tiki-view_blog.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;blogId=<?php echo $this->_tpl_vars['blogId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['selector_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
				<?php echo $this->_sections['foo']['index_next']; ?>
</a>
			<?php endfor; endif; ?>
		<?php endif; ?>
	</div>
	
</div>