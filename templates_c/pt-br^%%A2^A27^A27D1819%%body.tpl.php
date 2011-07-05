<?php /* Smarty version 2.6.18, created on 2011-05-02 18:35:42
         compiled from styles/obscur/body.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup_init', 'styles/obscur/body.tpl', 13, false),)), $this); ?>
<!-- body.tpl begin -->


<body <?php if ($this->_tpl_vars['show_comzone'] == 'y'): ?>onload="javascript:flip('comzone');"<?php endif; ?><?php if ($this->_tpl_vars['section']): ?> class="tiki_<?php echo $this->_tpl_vars['section']; ?>
"<?php endif; ?>>

  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "el-lightbox.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

  <?php if ($this->_tpl_vars['minical_reminders'] > 100): ?>
    <iframe width='0' height='0' frameborder="0" src="tiki-minical_reminders.php"></iframe>
  <?php endif; ?>

  <?php if ($this->_tpl_vars['feature_community_mouseover']): ?>
    <?php echo smarty_function_popup_init(array('src' => "lib/overlib.js"), $this);?>

  <?php endif; ?>
  
	
	  <?php if ($this->_tpl_vars['isIE']): ?>
	    <center>
	  	  <div style="text-align:left; width:760px; border-right:2px solid gray; border-left:2px solid gray">
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
		    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
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