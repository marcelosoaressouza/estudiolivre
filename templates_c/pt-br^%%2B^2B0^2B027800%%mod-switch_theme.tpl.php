<?php /* Smarty version 2.6.18, created on 2011-04-25 09:03:24
         compiled from styles/geral/modules/mod-switch_theme.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tikimodule', 'styles/geral/modules/mod-switch_theme.tpl', 3, false),array('modifier', 'replace', 'styles/geral/modules/mod-switch_theme.tpl', 7, false),array('modifier', 'escape', 'styles/geral/modules/mod-switch_theme.tpl', 7, false),)), $this); ?>
<?php if ($this->_tpl_vars['change_theme'] != 'n' || $this->_tpl_vars['user'] == ''): ?>
	
	<?php $this->_tag_stack[] = array('tikimodule', array('title' => 'Mudar Estilo','name' => 'switch_theme','flip' => $this->_tpl_vars['module_params']['flip'],'decorations' => $this->_tpl_vars['module_params']['decorations'])); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['styleslist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<?php if (count ( $this->_tpl_vars['available_styles'] ) == 0 || in_array ( $this->_tpl_vars['styleslist'][$this->_sections['ix']['index']] , $this->_tpl_vars['available_styles'] )): ?>
				<?php if ($this->_tpl_vars['style'] != $this->_tpl_vars['styleslist'][$this->_sections['ix']['index']]): ?>
			        <a onmouseout="nd();" onmouseover="tooltip('<img src=\'styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/<?php echo ((is_array($_tmp=$this->_tpl_vars['styleslist'][$this->_sections['ix']['index']])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
Icon.png\'/>')" href="tiki-switch_theme.php?theme=<?php echo ((is_array($_tmp=$this->_tpl_vars['styleslist'][$this->_sections['ix']['index']])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['styleslist'][$this->_sections['ix']['index']])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
</a>
		        <?php else: ?>
		        	<?php echo ((is_array($_tmp=$this->_tpl_vars['styleslist'][$this->_sections['ix']['index']])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
 (atual)
			    <?php endif; ?>
			    <br/>
			<?php endif; ?>
		<?php endfor; endif; ?>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php endif; ?>