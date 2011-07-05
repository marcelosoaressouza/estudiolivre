<?php /* Smarty version 2.6.18, created on 2011-05-03 19:41:11
         compiled from modules/mod-switch_theme.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tikimodule', 'modules/mod-switch_theme.tpl', 1, false),array('modifier', 'escape', 'modules/mod-switch_theme.tpl', 7, false),)), $this); ?>
<?php $this->_tag_stack[] = array('tikimodule', array('title' => "Estilo: ".($this->_tpl_vars['styleName']),'name' => 'switch_theme','flip' => $this->_tpl_vars['module_params']['flip'],'decorations' => $this->_tpl_vars['module_params']['decorations'])); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['change_theme'] != 'n' || $this->_tpl_vars['user'] == ''): ?>
<form method="get" action="tiki-switch_theme.php" target="_self">
<select name="theme" size="1" onchange="this.form.submit();">
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
        <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['styleslist'][$this->_sections['ix']['index']])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['style'] == $this->_tpl_vars['styleslist'][$this->_sections['ix']['index']]): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['styleslist'][$this->_sections['ix']['index']]; ?>
</option>
      <?php endif; ?>
<?php endfor; endif; ?>
</select>
</form>
<?php else: ?>
Permissão negada
<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>