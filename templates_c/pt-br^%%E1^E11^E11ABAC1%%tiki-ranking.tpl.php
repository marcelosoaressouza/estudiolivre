<?php /* Smarty version 2.6.18, created on 2011-04-09 09:50:33
         compiled from tiki-ranking.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'tiki-ranking.tpl', 5, false),array('modifier', 'tiki_long_datetime', 'tiki-ranking.tpl', 25, false),)), $this); ?>
<h1><a class="pagetitle" href="<?php echo $this->_tpl_vars['rpage']; ?>
">Rankings</a></h1>
<form action="<?php echo $this->_tpl_vars['rpage']; ?>
" method="post">
<select name="which">
<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['allrankings']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['allrankings'][$this->_sections['ix']['index']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['which'] == $this->_tpl_vars['allrankings'][$this->_sections['ix']['index']]['value']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['allrankings'][$this->_sections['ix']['index']]['name']; ?>
</option>
<?php endfor; endif; ?>
</select>
<select name="limit">
<option value="10" <?php if ($this->_tpl_vars['limit'] == 10): ?>selected="selected"<?php endif; ?>>10 Mais</option>
<option value="20" <?php if ($this->_tpl_vars['limit'] == 20): ?>selected="selected"<?php endif; ?>>20 Mais</option>
<option value="50" <?php if ($this->_tpl_vars['limit'] == 50): ?>selected="selected"<?php endif; ?>>50 Mais</option>
<option value="100" <?php if ($this->_tpl_vars['limit'] == 100): ?>selected="selected"<?php endif; ?>>100 Mais</option>
</select>
<input type="submit" name="selrank" value="ver" />
</form>
<br /><br />
<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['rankings']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<div class="cbox">
<div class="cbox-title">
<?php echo $this->_tpl_vars['rankings'][$this->_sections['ix']['index']]['title']; ?>
 (<?php echo $this->_tpl_vars['rankings'][$this->_sections['ix']['index']]['y']; ?>
)
</div>
<div class="cbox-data">
<table >
<?php unset($this->_sections['xi']);
$this->_sections['xi']['name'] = 'xi';
$this->_sections['xi']['loop'] = is_array($_loop=$this->_tpl_vars['rankings'][$this->_sections['ix']['index']]['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['xi']['show'] = true;
$this->_sections['xi']['max'] = $this->_sections['xi']['loop'];
$this->_sections['xi']['step'] = 1;
$this->_sections['xi']['start'] = $this->_sections['xi']['step'] > 0 ? 0 : $this->_sections['xi']['loop']-1;
if ($this->_sections['xi']['show']) {
    $this->_sections['xi']['total'] = $this->_sections['xi']['loop'];
    if ($this->_sections['xi']['total'] == 0)
        $this->_sections['xi']['show'] = false;
} else
    $this->_sections['xi']['total'] = 0;
if ($this->_sections['xi']['show']):

            for ($this->_sections['xi']['index'] = $this->_sections['xi']['start'], $this->_sections['xi']['iteration'] = 1;
                 $this->_sections['xi']['iteration'] <= $this->_sections['xi']['total'];
                 $this->_sections['xi']['index'] += $this->_sections['xi']['step'], $this->_sections['xi']['iteration']++):
$this->_sections['xi']['rownum'] = $this->_sections['xi']['iteration'];
$this->_sections['xi']['index_prev'] = $this->_sections['xi']['index'] - $this->_sections['xi']['step'];
$this->_sections['xi']['index_next'] = $this->_sections['xi']['index'] + $this->_sections['xi']['step'];
$this->_sections['xi']['first']      = ($this->_sections['xi']['iteration'] == 1);
$this->_sections['xi']['last']       = ($this->_sections['xi']['iteration'] == $this->_sections['xi']['total']);
?>
<tr><td class="form" align="left" ><?php echo $this->_sections['xi']['index_next']; ?>
)</td><td  class="form" align="left"><a class="link" href="<?php echo $this->_tpl_vars['rankings'][$this->_sections['ix']['index']]['data'][$this->_sections['xi']['index']]['href']; ?>
"><?php if ($this->_tpl_vars['rankings'][$this->_sections['ix']['index']]['data'][$this->_sections['xi']['index']]['name'] == ""): ?>-<?php else: ?><?php echo $this->_tpl_vars['rankings'][$this->_sections['ix']['index']]['data'][$this->_sections['xi']['index']]['name']; ?>
<?php endif; ?></a></td><td  class="form" align="right"><?php if ($this->_tpl_vars['rankings'][$this->_sections['ix']['index']]['type'] == 'nb'): ?><?php echo $this->_tpl_vars['rankings'][$this->_sections['ix']['index']]['data'][$this->_sections['xi']['index']]['hits']; ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['rankings'][$this->_sections['ix']['index']]['data'][$this->_sections['xi']['index']]['hits'])) ? $this->_run_mod_handler('tiki_long_datetime', true, $_tmp) : smarty_modifier_tiki_long_datetime($_tmp)); ?>
<?php endif; ?></td></tr>
<?php endfor; endif; ?>
</table>
</div>
</div>
<br />
<?php endfor; endif; ?>