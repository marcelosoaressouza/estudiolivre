<?php /* Smarty version 2.6.18, created on 2011-04-22 13:55:59
         compiled from tiki.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'tiki.tpl', 18, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if ($this->_tpl_vars['feature_bidi'] == 'y'): ?>
<div dir="rtl">
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
  <?php if ($this->_tpl_vars['feature_left_column'] == 'user' || $this->_tpl_vars['feature_right_column'] == 'user'): ?>
			<div>
      <?php if ($this->_tpl_vars['feature_left_column'] == 'user'): ?>
        <span style="float: left"><a class="flip" href="javascript:icntoggle('leftcolumn');">
        <img  align="left" name="leftcolumnicn" class="colflip" src="img/icons/ofo.gif" border="0" alt="+/-" />&nbsp;<?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Show/Hide Left Menus<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;</a>
        </span>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['feature_right_column'] == 'user'): ?>
        <span style="float: right"><a class="flip" href="javascript:icntoggle('rightcolumn');">
        <img align="left" name="rightcolumnicn" class="colflip" src="img/icons/ofo.gif" border="0" alt="+/-" />&nbsp;<?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Show/Hide Right Menus<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;</a>
        </span>
      <?php endif; ?>
      <br clear="both" />
			</div>
  <?php endif; ?>
  <table id="tiki-midtbl" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
      <?php if ($this->_tpl_vars['feature_left_column'] != 'n'): ?>
      <td id="leftcolumn" valign="top">
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
          <?php if ($this->_tpl_vars['feature_left_column'] == 'user'): ?>
            <img src="images/none.gif" width="100%" height="0" />
            <?php echo '
              <script type="text/javascript">
                setfolderstate("leftcolumn");
              </script>
            '; ?>

          <?php endif; ?>
      </td>
      <?php endif; ?>
      <td width="100%" id="centercolumn" valign="top"><div id="tiki-center">
      
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['mid'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      
      <?php if ($this->_tpl_vars['show_page_bar'] == 'y'): ?>
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-page_bar.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      <?php endif; ?>
      </div>
      </td>
      <?php if ($this->_tpl_vars['feature_right_column'] != 'n'): ?>
      <td id="rightcolumn" valign="top">
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
          <?php if ($this->_tpl_vars['feature_right_column'] == 'user'): ?>
            <img src="images/none.gif" width="100%" height="0" />
            <?php echo '
              <script type="text/javascript">
                setfolderstate("rightcolumn");
              </script>
            '; ?>

          <?php endif; ?>
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
</div>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>