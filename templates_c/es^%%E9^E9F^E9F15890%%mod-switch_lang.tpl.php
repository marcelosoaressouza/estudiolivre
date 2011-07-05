<?php /* Smarty version 2.6.18, created on 2011-04-04 17:44:12
         compiled from styles/bolha/modules/mod-switch_lang.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tikimodule', 'styles/bolha/modules/mod-switch_lang.tpl', 4, false),array('modifier', 'escape', 'styles/bolha/modules/mod-switch_lang.tpl', 10, false),)), $this); ?>



<?php $this->_tag_stack[] = array('tikimodule', array('title' => 'Lenguaje','name' => 'switch_lang','flip' => $this->_tpl_vars['module_params']['flip'],'decorations' => $this->_tpl_vars['module_params']['decorations'])); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['change_language'] != 'n' || $this->_tpl_vars['user'] == ''): ?>
<div class="modCenterContent">
    <?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['languages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    	<?php if (count ( $this->_tpl_vars['available_languages'] ) == 0 || in_array ( $this->_tpl_vars['languages'][$this->_sections['ix']['index']]['value'] , $this->_tpl_vars['available_languages'] )): ?>
		    <?php if ($this->_tpl_vars['language'] != $this->_tpl_vars['languages'][$this->_sections['ix']['index']]['value']): ?>
				<a href="tiki-switch_lang.php?language=<?php echo ((is_array($_tmp=$this->_tpl_vars['languages'][$this->_sections['ix']['index']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo $this->_tpl_vars['languages'][$this->_sections['ix']['index']]['name']; ?>
</a><br/>
			<?php endif; ?>
		<?php endif; ?>
	<?php endfor; endif; ?>
</div>	
<?php else: ?>
Permiso denegado
<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>