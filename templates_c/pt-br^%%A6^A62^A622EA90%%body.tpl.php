<?php /* Smarty version 2.6.18, created on 2011-04-25 09:03:24
         compiled from styles/geral/body.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup_init', 'styles/geral/body.tpl', 9, false),)), $this); ?>
<!-- body.tpl begin -->


<body>
	
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