<?php /* Smarty version 2.6.18, created on 2011-06-01 10:40:05
         compiled from tiki-edit_blog.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'eval', 'tiki-edit_blog.tpl', 22, false),array('modifier', 'escape', 'tiki-edit_blog.tpl', 26, false),)), $this); ?>
<h1>
<?php if ($this->_tpl_vars['blogId'] > 0): ?>
<a class="pagetitle" href="tiki-edit_blog.php?blogId=<?php echo $this->_tpl_vars['blogId']; ?>
">Editar Blog: <?php echo $this->_tpl_vars['title']; ?>
</a>
<?php else: ?>
<a class="pagetitle" href="tiki-edit_blog.php">Criar Blog</a>
<?php endif; ?>
  
      <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?>
<a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Blog" target="tikihelp" class="tikihelp" title="Editando e criando blogs">
<img src="img/icons/help.gif" border="0" height="16" width="16" alt='auxílio' /></a><?php endif; ?>

      <?php if ($this->_tpl_vars['feature_view_tpl'] == 'y' && $this->_tpl_vars['tiki_p_view_templates'] == 'y'): ?>
<a href="tiki-edit_templates.php?template=tiki-edit_blog.tpl" target="tikihelp" class="tikihelp" title="Exibir tpl: editar blog tpl">
<img src="img/icons/info.gif" border="0" height="16" width="16" alt='editar tpl' /></a><?php endif; ?></h1>

<div class="navbar">
<a class="linkbut" href="tiki-list_blogs.php">listar os blogs</a>
<a class="linkbut" href="tiki-view_blog.php?blogId=<?php echo $this->_tpl_vars['blogId']; ?>
">ver o blog</a>
</div>
<h2>Cabeçalho atual</h2>
<?php if (strlen ( $this->_tpl_vars['heading'] ) > 0): ?>
<?php echo smarty_function_eval(array('var' => $this->_tpl_vars['heading']), $this);?>

<?php endif; ?>

<?php if ($this->_tpl_vars['individual'] == 'y'): ?>
<a class="link" href="tiki-objectpermissions.php?objectName=<?php echo ((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;objectType=blog&amp;permType=blogs&amp;objectId=<?php echo $this->_tpl_vars['blogId']; ?>
">Existem permissões individuais definidas para este blog</a>
<?php endif; ?>
<form method="post" action="tiki-edit_blog.php" id="blog-edit-form">
<input type="hidden" name="blogId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['blogId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<table class="normal">
<tr class="editblogform"><td><label for="blog-title">Título</label></td><td><input type="text" name="title" id="blog-title" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></td></tr>
<tr><td class="editblogform"><label for="blog-desc">Descrição</label><br /><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "textareasize.tpl", 'smarty_include_vars' => array('area_name' => 'blog-desc','formId' => 'blog-edit-form')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td><td class="editblogform"><textarea class="wikiedit" name="description" id="blog-desc" rows="<?php echo $this->_tpl_vars['rows']; ?>
" cols="<?php echo $this->_tpl_vars['cols']; ?>
" wrap="virtual"><?php echo ((is_array($_tmp=$this->_tpl_vars['description'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea></td></tr>
<tr class="editblogform"><td><label for="blogs-number">Número de mensagens a exibir</label></td><td><input type="text" name="maxPosts" id="blogs-number" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['maxPosts'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></td></tr>
<tr class="editblogform"><td><label for="blogs-allow_others">Permitir a outr@s usuári@s escrever neste blog</label></td><td>
<input type="checkbox" name="public" id="blogs-allow_others" <?php if ($this->_tpl_vars['public'] == 'y'): ?>checked='checked'<?php endif; ?>/>
</td></tr>
<tr class="editblogform"><td><label for="blogs-titles">Utilizar títulos nas mensagens do blog</label></td><td>
<input type="checkbox" name="use_title" id="blogs-titles" <?php if ($this->_tpl_vars['use_title'] == 'y'): ?>checked='checked'<?php endif; ?>/>
</td></tr>
<tr class="editblogform"><td><label for="blogs-search">Permitir busca</label></td><td>
<input type="checkbox" name="use_find" id="blogs-search" <?php if ($this->_tpl_vars['use_find'] == 'y'): ?>checked='checked'<?php endif; ?>/>
</td></tr>
<tr class="editblogform"><td><label for="blogs-comments">Permitir comentários</label></td><td>
<input type="checkbox" name="allow_comments" id="blogs-comments" <?php if ($this->_tpl_vars['allow_comments'] == 'y' || $this->_tpl_vars['allow_comments'] == 'c'): ?>checked='checked'<?php endif; ?> />
</td></tr>
<tr class="editblogform"><td><label for="blogs-trackbackpings">Allow trackback pings</label></td><td>
<input type="checkbox" name="allow_trackbackpings" id="blogs-trackbackpings" <?php if ($this->_tpl_vars['allow_comments'] == 'y' || $this->_tpl_vars['allow_comments'] == 't'): ?>checked='checked'<?php endif; ?> />
</td></tr>
<tr class="editblogform"><td>Mostrar fotografia d@s usuári@s</td><td>
<input type="checkbox" name="show_avatar" <?php if ($this->_tpl_vars['show_avatar'] == 'y'): ?>checked='checked'<?php endif; ?> />
</td></tr>

<?php if ($this->_tpl_vars['tiki_p_edit_templates'] == 'y'): ?>
<tr class="editblogform"><td><label for="blogs-heading">Cabeçalho do Blog</label></td><td>
<textarea name="heading" id="blogs-heading" rows='10' cols='40'><?php echo ((is_array($_tmp=$this->_tpl_vars['heading'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
</td></tr>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "categorize.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<tr class="editblogform"><td>&nbsp;</td><td><input type="submit" class="wikiaction" name="preview" value="pré-visualização" /><input type="submit" class="wikiaction" name="save" value="salvar" /></td></tr>
</table>
</form>
<br />