<?php /* Smarty version 2.6.18, created on 2011-04-04 17:44:12
         compiled from styles/bolha/body.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'styles/bolha/body.tpl', 5, false),array('function', 'popup_init', 'styles/bolha/body.tpl', 11, false),)), $this); ?>
<!-- body.tpl begin -->


<body
		onLoad="preloadImgsNow('<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
')"
	 >
	
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "el-lightbox.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <?php if ($this->_tpl_vars['feature_community_mouseover']): ?>
    <?php echo smarty_function_popup_init(array('src' => "lib/js/overlib_mini.js"), $this);?>

  <?php endif; ?>
  
	
	  <?php if ($this->_tpl_vars['isIE']): ?>
	    <center>
	  	  <div style="text-align:left; width:954px">
	  <?php endif; ?>
	
		<div id="tiki-main">
	    	<?php if ($this->_tpl_vars['feature_top_bar'] == 'y'): ?>
		        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-top_bar.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		    <?php endif; ?>
		    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "content.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>

	  <?php if ($this->_tpl_vars['isIE']): ?>
	    </div>
	      <center>
	  <?php endif; ?>

</body>

<!-- body.tpl end -->