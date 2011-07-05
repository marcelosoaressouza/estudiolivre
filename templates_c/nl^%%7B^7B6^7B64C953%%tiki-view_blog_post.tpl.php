<?php /* Smarty version 2.6.18, created on 2011-05-22 08:20:13
         compiled from styles/bolha/tiki-view_blog_post.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-view_blog_post.tpl', 1, false),)), $this); ?>
<?php echo smarty_function_css(array('extra' => 'tiki-view_blog_post_item'), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "blog-heading.tpl", 'smarty_include_vars' => array('nameOnly' => 'y','title' => $this->_tpl_vars['blog_data']['title'],'creator' => $this->_tpl_vars['blog_data']['user'],'created' => $this->_tpl_vars['blog_data']['created'],'id' => $this->_tpl_vars['blogId'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="vBlogPost">
	<h2>
		Journaalbijdrage bekijken
	</h2>
	
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-view_blog_post_item.tpl", 'smarty_include_vars' => array('text' => $this->_tpl_vars['parsed_data'],'post' => $this->_tpl_vars['post_info'],'use_title' => $this->_tpl_vars['blog_data']['use_title'],'showPages' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
	
	
	<?php if ($this->_tpl_vars['feature_blogposts_comments'] == 'y' && $this->_tpl_vars['blog_data']['allow_comments'] == 'y' && ( ( $this->_tpl_vars['tiki_p_read_comments'] == 'y' && $this->_tpl_vars['comments_cant'] != 0 ) || $this->_tpl_vars['tiki_p_post_comments'] == 'y' || $this->_tpl_vars['tiki_p_edit_comments'] == 'y' )): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "comments.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['show_comments']): ?>
		<script language="JavaScript">flip('comzone<?php if ($this->_tpl_vars['comments_show'] == 'y'): ?>open<?php endif; ?>');</script>
	<?php endif; ?>
</div>