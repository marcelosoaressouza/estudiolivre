<?php /* Smarty version 2.6.18, created on 2011-04-04 19:13:37
         compiled from styles/bolha/browseFreeTags-pagination.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'times', 'styles/bolha/browseFreeTags-pagination.tpl', 15, false),)), $this); ?>
<div id="freeTagsPagination">
  	<?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
    	[<a class="prevnext" href="tiki-browse_freetags.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;tag=<?php echo $this->_tpl_vars['tag']; ?>
&amp;type=<?php echo $this->_tpl_vars['type']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
">이전</a>]&nbsp;
    <?php endif; ?>
    
    페이지: <?php echo $this->_tpl_vars['actual_page']; ?>
/<?php echo $this->_tpl_vars['cant_pages']; ?>

    
    <?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
    	&nbsp;[<a class="prevnext" href="tiki-browse_freetags.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;tag=<?php echo $this->_tpl_vars['tag']; ?>
&amp;type=<?php echo $this->_tpl_vars['type']; ?>
&amp;offset=<?php echo $this->_tpl_vars['next_offset']; ?>
">다음</a>]
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
    		<a class="prevnext" href="tiki-browse_freetags.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;tag=<?php echo $this->_tpl_vars['tag']; ?>
&amp;type=<?php echo $this->_tpl_vars['type']; ?>
&amp;offset=<?php echo $this->_tpl_vars['selector_offset']; ?>
">
				<?php echo $this->_sections['foo']['index_next']; ?>

			</a>&nbsp;
		<?php endfor; endif; ?>
	<?php endif; ?>
</div>