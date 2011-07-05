<?php /* Smarty version 2.6.18, created on 2011-04-19 20:27:59
         compiled from styles/bolha/modules/mod-user_blogs.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tikimodule', 'styles/bolha/modules/mod-user_blogs.tpl', 5, false),array('modifier', 'truncate', 'styles/bolha/modules/mod-user_blogs.tpl', 7, false),)), $this); ?>


<?php if ($this->_tpl_vars['user']): ?>
    <?php if ($this->_tpl_vars['feature_blogs'] == 'y'): ?>
		<?php $this->_tag_stack[] = array('tikimodule', array('title' => 'My blogs','name' => 'user_blogs','flip' => $this->_tpl_vars['module_params']['flip'])); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['modUserBlogs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			    <a href="tiki-view_blog.php?blogId=<?php echo $this->_tpl_vars['modUserBlogs'][$this->_sections['ix']['index']]['blogId']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['modUserBlogs'][$this->_sections['ix']['index']]['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "(...)") : smarty_modifier_truncate($_tmp, 20, "(...)")); ?>
</a>
			    <a class="modBlogPost" href="tiki-blog_post.php?blogId=<?php echo $this->_tpl_vars['modUserBlogs'][$this->_sections['ix']['index']]['blogId']; ?>
">(post)</a>
			    <br/>
			<?php endfor; endif; ?>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php endif; ?>
<?php endif; ?>