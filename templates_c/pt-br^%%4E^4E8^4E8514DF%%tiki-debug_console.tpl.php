<?php /* Smarty version 2.6.18, created on 2011-05-02 18:35:42
         compiled from tiki-debug_console.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'tiki-debug_console.tpl', 7, false),)), $this); ?>


<?php if ($this->_tpl_vars['tiki_p_admin'] == 'y' && $this->_tpl_vars['feature_debug_console'] == 'y'): ?>
<div class="debugconsole" id="debugconsole" style="<?php echo $this->_tpl_vars['debugconsole_style']; ?>
">


<form method="post" action="<?php echo ((is_array($_tmp=$this->_tpl_vars['console_father'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
<table border="0" >
  <tr><td colspan="3" align="right">
    <b>Console de Depuração Tiki</b>
    <a class="separator" href="javascript:toggle('debugconsole');" title="Fechar">
      <small>[x]</small>
    </a>
  </td></tr>
  <tr>
    <td class="formcolor"><small>Endereço atual:</small></td>
    <td class="formcolor"><?php echo ((is_array($_tmp=$this->_tpl_vars['console_father'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
  </tr>
  <tr>
    <td class="formcolor">Comando:</td>
    <td class="formcolor"><input type="text" name="command" size="70" value='<?php echo ((is_array($_tmp=$this->_tpl_vars['command'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
' /></td>
  </tr>
  <tr>
    <td class="formcolor"></td>
    <td class="formcolor">
      <input type="submit" name="exec" value="executar" /> &nbsp;&nbsp;&nbsp;&nbsp;
      <small>Digite <code>ajuda</code> para obter uma lista de comandos</small>
    </td>
  </tr>
</table>
</form>




<?php if (count ( $this->_tpl_vars['tabs'] ) > 1): ?>
  <table><tr>
  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['tabs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
    <td>
      <div class="button2">
        <a href="<?php echo $this->_tpl_vars['tabs'][$this->_sections['i']['index']]['button_href']; ?>
" class="linkbut"><?php echo $this->_tpl_vars['tabs'][$this->_sections['i']['index']]['button_caption']; ?>
</a>
      </div>
    </td>
  <?php endfor; endif; ?>
  </tr></table>
<?php endif; ?>


<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['tabs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
<div class="debugger-tab" id="<?php echo $this->_tpl_vars['tabs'][$this->_sections['i']['index']]['tab_id']; ?>
" style="display:<?php if ($this->_tpl_vars['tabs'][$this->_sections['i']['index']]['button_caption'] == 'console'): ?>block<?php else: ?>none<?php endif; ?>;">
    <?php echo $this->_tpl_vars['tabs'][$this->_sections['i']['index']]['tab_code']; ?>

</div><!-- Tab: <?php echo $this->_tpl_vars['tabs'][$this->_sections['i']['index']]['tab_id']; ?>
 -->
<?php endfor; endif; ?>

</div><!-- debug console -->
<?php endif; ?>