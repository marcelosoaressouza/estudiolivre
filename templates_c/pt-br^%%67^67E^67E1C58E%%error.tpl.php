<?php /* Smarty version 2.6.18, created on 2011-04-13 09:30:06
         compiled from error.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'error.tpl', 27, false),array('modifier', 'escape', 'error.tpl', 36, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if ($this->_tpl_vars['feature_bidi'] == 'y'): ?>
<table dir="rtl" ><tr><td>
<?php endif; ?>

<div id="tiki-main">
  <?php if ($this->_tpl_vars['feature_top_bar'] == 'y'): ?>
  <div id="tiki-top">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-top_bar.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  </div>
  <?php endif; ?>
  <div id="tiki-mid">
    <table border="0" cellpadding="0" cellspacing="0" id="tikimidtbl">
    <tr>
      <?php if ($this->_tpl_vars['feature_left_column'] == 'y'): ?>
      <td id="leftcolumn">
      <?php unset($this->_sections['homeix']);
$this->_sections['homeix']['name'] = 'homeix';
$this->_sections['homeix']['loop'] = is_array($_loop=$this->_tpl_vars['left_modules']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['homeix']['show'] = true;
$this->_sections['homeix']['max'] = $this->_sections['homeix']['loop'];
$this->_sections['homeix']['step'] = 1;
$this->_sections['homeix']['start'] = $this->_sections['homeix']['step'] > 0 ? 0 : $this->_sections['homeix']['loop']-1;
if ($this->_sections['homeix']['show']) {
    $this->_sections['homeix']['total'] = $this->_sections['homeix']['loop'];
    if ($this->_sections['homeix']['total'] == 0)
        $this->_sections['homeix']['show'] = false;
} else
    $this->_sections['homeix']['total'] = 0;
if ($this->_sections['homeix']['show']):

            for ($this->_sections['homeix']['index'] = $this->_sections['homeix']['start'], $this->_sections['homeix']['iteration'] = 1;
                 $this->_sections['homeix']['iteration'] <= $this->_sections['homeix']['total'];
                 $this->_sections['homeix']['index'] += $this->_sections['homeix']['step'], $this->_sections['homeix']['iteration']++):
$this->_sections['homeix']['rownum'] = $this->_sections['homeix']['iteration'];
$this->_sections['homeix']['index_prev'] = $this->_sections['homeix']['index'] - $this->_sections['homeix']['step'];
$this->_sections['homeix']['index_next'] = $this->_sections['homeix']['index'] + $this->_sections['homeix']['step'];
$this->_sections['homeix']['first']      = ($this->_sections['homeix']['iteration'] == 1);
$this->_sections['homeix']['last']       = ($this->_sections['homeix']['iteration'] == $this->_sections['homeix']['total']);
?>
      <?php echo $this->_tpl_vars['left_modules'][$this->_sections['homeix']['index']]['data']; ?>

      <?php endfor; endif; ?>
      </td>
      <?php endif; ?>
      <td id="centercolumn"><div id="tiki-center">
      <br />
        <div class="cbox">
        <div class="cbox-title">
        <?php echo ((is_array($_tmp=@$this->_tpl_vars['errortitle'])) ? $this->_run_mod_handler('default', true, $_tmp, 'Erro') : smarty_modifier_default($_tmp, 'Erro')); ?>

        </div>
        <div class="cbox-data">
        <br />
        <?php if (( $this->_tpl_vars['errortype'] == '404' )): ?>
           <?php if ($this->_tpl_vars['likepages']): ?>
          Talvez você esteja procurando por:
          <ul>
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
          <li><a  href="tiki-index.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['likepages'][$this->_sections['back']['index']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" class="wiki"><?php echo $this->_tpl_vars['likepages'][$this->_sections['back']['index']]; ?>
</a></li>
          <?php endfor; endif; ?>
          </ul>
          <?php else: ?>
          Não há nenhuma página wiki similar a '<?php echo $this->_tpl_vars['page']; ?>
'
          <br /><br />
          <?php endif; ?>
		  
		  <?php if ($this->_tpl_vars['feature_search'] == 'y'): ?>
          <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-searchindex.tpl", 'smarty_include_vars' => array('searchNoResults' => 'true','searchStyle' => 'menu','searchOrientation' => 'horiz','words' => ($this->_tpl_vars['page']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          <?php endif; ?>
		  
		  <br />
        <?php else: ?>
        <?php echo $this->_tpl_vars['msg']; ?>

        <br /><br />
        <?php endif; ?>
        <?php if ($this->_tpl_vars['page'] && $this->_tpl_vars['create'] == 'y' && ( $this->_tpl_vars['tiki_p_admin'] == 'y' || $this->_tpl_vars['tiki_p_admin_wiki'] == 'y' || $this->_tpl_vars['tiki_p_edit'] == 'y' )): ?><a href="tiki-editpage.php?page=<?php echo $this->_tpl_vars['page']; ?>
" class="linkmenu">Criar esta página</a> (a página será órfã)<br /><br /><?php endif; ?>
        <a href="javascript:history.back()" class="linkmenu">Retornar</a><br /><br />
        <a href="<?php echo $this->_tpl_vars['tikiIndex']; ?>
" class="linkmenu">Retornar à página inicial</a>
        </div>
        </div>
      </div></td>
      <?php if ($this->_tpl_vars['feature_right_column'] == 'y'): ?>
      <td id="rightcolumn">
      <?php unset($this->_sections['homeix']);
$this->_sections['homeix']['name'] = 'homeix';
$this->_sections['homeix']['loop'] = is_array($_loop=$this->_tpl_vars['right_modules']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['homeix']['show'] = true;
$this->_sections['homeix']['max'] = $this->_sections['homeix']['loop'];
$this->_sections['homeix']['step'] = 1;
$this->_sections['homeix']['start'] = $this->_sections['homeix']['step'] > 0 ? 0 : $this->_sections['homeix']['loop']-1;
if ($this->_sections['homeix']['show']) {
    $this->_sections['homeix']['total'] = $this->_sections['homeix']['loop'];
    if ($this->_sections['homeix']['total'] == 0)
        $this->_sections['homeix']['show'] = false;
} else
    $this->_sections['homeix']['total'] = 0;
if ($this->_sections['homeix']['show']):

            for ($this->_sections['homeix']['index'] = $this->_sections['homeix']['start'], $this->_sections['homeix']['iteration'] = 1;
                 $this->_sections['homeix']['iteration'] <= $this->_sections['homeix']['total'];
                 $this->_sections['homeix']['index'] += $this->_sections['homeix']['step'], $this->_sections['homeix']['iteration']++):
$this->_sections['homeix']['rownum'] = $this->_sections['homeix']['iteration'];
$this->_sections['homeix']['index_prev'] = $this->_sections['homeix']['index'] - $this->_sections['homeix']['step'];
$this->_sections['homeix']['index_next'] = $this->_sections['homeix']['index'] + $this->_sections['homeix']['step'];
$this->_sections['homeix']['first']      = ($this->_sections['homeix']['iteration'] == 1);
$this->_sections['homeix']['last']       = ($this->_sections['homeix']['iteration'] == $this->_sections['homeix']['total']);
?>
      <?php echo $this->_tpl_vars['right_modules'][$this->_sections['homeix']['index']]['data']; ?>

      <?php endfor; endif; ?>
      </td>
      <?php endif; ?>
    </tr>
    </table>
  </div>
  <?php if ($this->_tpl_vars['feature_bot_bar'] == 'y'): ?>
  <div id="tiki-bot">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-bot_bar.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  </div>
  <?php endif; ?>
</div>
<?php if ($this->_tpl_vars['feature_bidi'] == 'y'): ?>
</td></tr></table>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>