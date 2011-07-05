<?php /* Smarty version 2.6.18, created on 2011-04-05 12:37:51
         compiled from styles/bolha/tiki-print_blog_post.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-print_blog_post.tpl', 2, false),)), $this); ?>
<?php ob_start(); ?>
	<?php echo smarty_function_css(array('only' => "tiki-view_blog_post_item,print"), $this);?>

	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-print_top_bar.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>	
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "blog-heading.tpl", 'smarty_include_vars' => array('nameOnly' => 'y','printingPost' => 1,'title' => $this->_tpl_vars['blog_data']['title'],'creator' => $this->_tpl_vars['blog_data']['user'],'created' => $this->_tpl_vars['blog_data']['created'],'id' => $this->_tpl_vars['blogId'],'postId' => $this->_tpl_vars['postId'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
	<h2>Viewing blog post</h2>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-view_blog_post_item.tpl", 'smarty_include_vars' => array('text' => $this->_tpl_vars['parsed_data'],'post' => $this->_tpl_vars['post_info'],'use_title' => $this->_tpl_vars['blog_data']['use_title'],'printingPost' => 1,'showPages' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<br/>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('mid_data', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'tiki.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
