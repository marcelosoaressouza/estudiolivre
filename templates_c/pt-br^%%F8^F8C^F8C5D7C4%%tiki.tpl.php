<?php /* Smarty version 2.6.18, created on 2011-05-03 19:41:11
         compiled from styles/original/tiki.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'styles/original/tiki.tpl', 17, false),)), $this); ?>
<script type="text/javascript" src="lib/js/toggleImage.js"></script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>



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
 
<div id="tiki-mid-tudo">
  <div id="tiki-mid-fundo">
  
    <?php if ($this->_tpl_vars['category'] == "Vídeo"): ?>
      <span class="page-title">
      video||LAB
      </span>
    <?php elseif ($this->_tpl_vars['category'] == "Áudio"): ?>
      <span class="page-title">
      audio||LAB
      </span>
    <?php elseif ($this->_tpl_vars['category'] == "Gráfico"): ?>
      <span class="page-title">
      grafi||LAB
      </span>

    <?php endif; ?>

    <div id="tiki-mid">
    <?php echo $this->_tpl_vars['mid_data']; ?>

    </div>

   
  </div>

  <?php if ($this->_tpl_vars['category'] == "Vídeo"): ?>
	  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mod-el_menu_video.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	  <link rel="StyleSheet"  href="styles/estudiolivre_orig/css/estudiolivre_video.css" type="text/css" />
  <?php elseif ($this->_tpl_vars['category'] == "Áudio"): ?>
  	  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mod-el_menu_audio.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  	  <link rel="StyleSheet"  href="styles/estudiolivre_orig/css/estudiolivre_audio.css" type="text/css" />
  <?php elseif ($this->_tpl_vars['category'] == "Gráfico"): ?>
  	  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mod-el_menu_grafico.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  	  <link rel="StyleSheet"  href="styles/estudiolivre_orig/css/estudiolivre_grafico.css" type="text/css" />
  <?php endif; ?>

  <div id="tiki-coluna-direita">
  
    <?php if ($this->_tpl_vars['feature_right_column'] != 'n'): ?>
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
      
    <?php endif; ?>
  
  </div>
  
  
</div>
  

</div>



     

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


 