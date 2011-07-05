<?php /* Smarty version 2.6.18, created on 2011-05-02 18:35:42
         compiled from styles/obscur/content.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'styles/obscur/content.tpl', 7, false),)), $this); ?>
<!-- content.tpl begin -->

<div id="ajax-contentBubble">

    <?php if ($this->_tpl_vars['feature_usermenu'] == 'y'): ?>	
      <div id="usermenu">
        &nbsp;&nbsp;<a href="tiki-usermenu.php?url=<?php echo ((is_array($_tmp=$_SERVER['REQUEST_URI'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><img src='img/icons/add.gif' border='0' alt='adicionar' title='adicionar' /></a>
        <?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['usr_user_menus']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
          &nbsp;&nbsp;<img style="vertical-align:bottom;" src="styles/neat/logoIcon.gif" /><a <?php if ($this->_tpl_vars['usr_user_menus'][$this->_sections['ix']['index']]['mode'] == 'n'): ?>target='_blank'<?php endif; ?> href="<?php echo $this->_tpl_vars['usr_user_menus'][$this->_sections['ix']['index']]['url']; ?>
" class="tikitopmenu2"><?php echo $this->_tpl_vars['usr_user_menus'][$this->_sections['ix']['index']]['name']; ?>
</a>
        <?php endfor; endif; ?>
      
      </div>
    <?php endif; ?>
    
    
    
    
    <?php if ($this->_tpl_vars['category'] == "Áudio"): ?>
      <div id="tiki-midAudio">
    <?php elseif ($this->_tpl_vars['category'] == "Gráfico"): ?>
       <div id="tiki-midGraf">
    <?php elseif ($this->_tpl_vars['category'] == "Vídeo"): ?>
       <div id="tiki-midVideo">
    <?php elseif ($this->_tpl_vars['category'] == 'gallery'): ?>
        <div id="tiki-midAcervo">
    <?php else: ?>
        <div id="tiki-mid">
    <?php endif; ?>

<!--HIGHLIGHT BEGIN-->

    <?php echo $this->_tpl_vars['mid_data']; ?>


<!--HIGHLIGHT END-->
<!-- sasquatch -->
    </div>
    
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sideContent.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    
</div>
<!-- content.tpl end -->