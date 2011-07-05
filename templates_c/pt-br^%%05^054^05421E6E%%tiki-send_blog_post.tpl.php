<?php /* Smarty version 2.6.18, created on 2011-04-04 18:19:32
         compiled from styles/bolha/tiki-send_blog_post.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-send_blog_post.tpl', 1, false),array('modifier', 'escape', 'styles/bolha/tiki-send_blog_post.tpl', 20, false),)), $this); ?>
<?php echo smarty_function_css(array('only' => "tiki-view_blog_post_item,tiki-show_page"), $this);?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'header.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "blog-heading.tpl", 'smarty_include_vars' => array('nameOnly' => 'y','title' => $this->_tpl_vars['blog_data']['title'],'creator' => $this->_tpl_vars['blog_data']['user'],'created' => $this->_tpl_vars['blog_data']['created'],'id' => $this->_tpl_vars['blogId'],'postId' => $this->_tpl_vars['postId'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h2>Enviar mensagem blog</h2>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-view_blog_post_item.tpl", 'smarty_include_vars' => array('text' => $this->_tpl_vars['parsed_data'],'post' => $this->_tpl_vars['post_info'],'use_title' => $this->_tpl_vars['blog_data']['use_title'],'showPages' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
<?php if ($this->_tpl_vars['sent'] == 'y'): ?>
	<h3>Um link para esta mensagem foi enviada para os seguintes endereços:</h3>
	<div class="wikitext">
		<?php echo $this->_tpl_vars['addresses']; ?>

	</div>
<?php else: ?>
	<h3>
		Enviar a mensagem para estes endereços
	</h3>
	<form method="post" action="tiki-send_blog_post.php">
		<input type="hidden" name="postId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['postId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
		Lista de endereços de email separados por vírgulas
		<br/>
		<textarea cols="60" rows="5" name="addresses"><?php echo ((is_array($_tmp=$this->_tpl_vars['addresses'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
		<br/>
		<input type="submit" name="send" value="enviar" />
	</form>
<?php endif; ?>	
<br />

