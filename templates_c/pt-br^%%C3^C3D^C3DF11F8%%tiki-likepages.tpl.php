<?php /* Smarty version 2.6.18, created on 2011-04-26 17:14:50
         compiled from tiki-likepages.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'tiki-likepages.tpl', 6, false),)), $this); ?>
<h2>Páginas semelhantes:

<?php if ($this->_tpl_vars['page_exists'] == 'n'): ?>
'<?php echo $this->_tpl_vars['page']; ?>
'
<?php else: ?>
<a href="tiki-index.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" class="wiki"><?php echo $this->_tpl_vars['page']; ?>
</a>
<?php endif; ?></h2>

<?php unset($this->_sections['back']);
$this->_sections['back']['name'] = 'back';
$this->_sections['back']['loop'] = is_array($_loop=$this->_tpl_vars['likepages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['back']['show'] = true;
$this->_sections['back']['max'] = $this->_sections['back']['loop'];
$this->_sections['back']['step'] = 1;
$this->_sections['back']['start'] = $this->_sections['back']['step'] > 0 ? 0 : $this->_sections['back']['loop']-1;
if ($this->_sections['back']['show']) {
    $this->_sections['back']['total'] = $this->_sections['back']['loop'];
    if ($this->_sections['back']['total'] == 0)
        $this->_sections['back']['show'] = false;
} else
    $this->_sections['back']['total'] = 0;
if ($this->_sections['back']['show']):

            for ($this->_sections['back']['index'] = $this->_sections['back']['start'], $this->_sections['back']['iteration'] = 1;
                 $this->_sections['back']['iteration'] <= $this->_sections['back']['total'];
                 $this->_sections['back']['index'] += $this->_sections['back']['step'], $this->_sections['back']['iteration']++):
$this->_sections['back']['rownum'] = $this->_sections['back']['iteration'];
$this->_sections['back']['index_prev'] = $this->_sections['back']['index'] - $this->_sections['back']['step'];
$this->_sections['back']['index_next'] = $this->_sections['back']['index'] + $this->_sections['back']['step'];
$this->_sections['back']['first']      = ($this->_sections['back']['iteration'] == 1);
$this->_sections['back']['last']       = ($this->_sections['back']['iteration'] == $this->_sections['back']['total']);
?>
<a  href="tiki-index.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['likepages'][$this->_sections['back']['index']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" class="wiki"><?php echo $this->_tpl_vars['likepages'][$this->_sections['back']['index']]; ?>
</a><br />
<?php endfor; else: ?>
Nenhuma página encontrada
<?php endif; ?>
<br />