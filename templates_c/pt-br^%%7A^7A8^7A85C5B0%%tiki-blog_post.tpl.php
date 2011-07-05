<?php /* Smarty version 2.6.18, created on 2011-04-14 15:37:18
         compiled from styles/bolha/tiki-blog_post.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-blog_post.tpl', 1, false),array('modifier', 'replace', 'styles/bolha/tiki-blog_post.tpl', 19, false),array('modifier', 'escape', 'styles/bolha/tiki-blog_post.tpl', 43, false),)), $this); ?>
<?php echo smarty_function_css(array('extra' => 'tiki-view_blog_post_item'), $this);?>



<?php if ($this->_tpl_vars['blogId'] > 0): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "blog-heading.tpl", 'smarty_include_vars' => array('nameOnly' => 1,'id' => $this->_tpl_vars['blogId'],'creator' => $this->_tpl_vars['blog_data']['user'],'created' => $this->_tpl_vars['blog_data']['created'],'title' => $this->_tpl_vars['blog_data']['title'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<div id="blogPosting">
	<h2>
		<?php if ($this->_tpl_vars['postId']): ?>
			Editar Mensagem: <a class="pagetitle" href="tiki-blog_post.php?blogId=<?php echo $this->_tpl_vars['blogId']; ?>
&amp;postId=<?php echo $this->_tpl_vars['postId']; ?>
"><?php echo $this->_tpl_vars['title']; ?>
</a>
		<?php else: ?>
			Editar Mensagem
		<?php endif; ?>
	</h2>
	<?php if ($this->_tpl_vars['preview'] == 'y'): ?>
	<div id="blogPostPrev">
		<h3>
			<span class="pointer" onclick="javascript:flip('postPrevCont');toggleImage(document.getElementById('TArrowBlogPr'),'iArrowGreyRight.png');">
				<img id="TArrowBlogPr" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyDown.png" />Pré-visualização
			</span>
		</h3>
		<div id="postPrevCont" style="display:block">
			<?php $this->assign('coco', 'teste'); ?>
			<?php 
			 	global $smarty;
				$vars=$smarty->_tpl_vars;
				
				$usePost = array( "title" => $vars["title"],
								 "user" => $vars["user"],
								 "blogId" => $vars["blogId"],
								 "created" => time()
				);
				
				$smarty->assign('usePost',$usePost);
			 ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-view_blog_post_item.tpl", 'smarty_include_vars' => array('previewingPost' => 1,'text' => $this->_tpl_vars['parsed_data'],'post' => $this->_tpl_vars['usePost'],'use_title' => $this->_tpl_vars['blog_data']['use_title'],'printingPost' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		<div style="border-bottom:1px solid gray;height:1px;margin-top:2px"></div>
	</div>
	<?php endif; ?>
	
	<form enctype="multipart/form-data" name='blogpost' method="post" action="tiki-blog_post.php" id ='editpageform'>
		<input type="hidden" name="wysiwyg" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['wysiwyg'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
		<input type="hidden" name="postId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['postId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
		<input type="hidden" name="blogId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['blogId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
		<h3>Blog</h3>
		<select name="blogId">
			<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['blogs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['blogs'][$this->_sections['ix']['index']]['blogId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['blogs'][$this->_sections['ix']['index']]['blogId'] == $this->_tpl_vars['blogId']): ?>selected="selected"<?php endif; ?>>
					<?php echo $this->_tpl_vars['blogs'][$this->_sections['ix']['index']]['title']; ?>

				</option>
			<?php endfor; endif; ?>
		</select>
		
		<?php $this->assign('area_name', 'blogedit'); ?>
		
		<?php if ($this->_tpl_vars['feature_smileys'] == 'y'): ?>
			Emoticons
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-smileys.tpl", 'smarty_include_vars' => array('area_name' => 'blogedit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
	
		<br/>	
		<?php if ($this->_tpl_vars['blog_data']['use_title'] == 'y' || ! $this->_tpl_vars['blogId']): ?>
			<h3>Título</h3>
			<input class="blogEdit" type="text" size="80" name="title" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
		<?php endif; ?>
		<br/>
		
		<div id="blogeditCont">
			<?php if ($this->_tpl_vars['wysiwyg'] == 'n'): ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-edit_help.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "textareasize.tpl", 'smarty_include_vars' => array('area_name' => 'blogedit','formId' => 'editpageform')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-edit_help_tool.tpl", 'smarty_include_vars' => array('area_name' => 'blogedit')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
			<textarea id='blogedit' class="blogEdit" name="data" rows="<?php echo $this->_tpl_vars['rows']; ?>
" cols="<?php echo $this->_tpl_vars['cols']; ?>
" wrap="virtual"><?php echo ((is_array($_tmp=$this->_tpl_vars['data'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
			<input type="hidden" name="rows" value="<?php echo $this->_tpl_vars['rows']; ?>
"/>
			<input type="hidden" name="cols" value="<?php echo $this->_tpl_vars['cols']; ?>
"/>
		</div>
		<?php if ($this->_tpl_vars['wysiwyg'] == 'y'): ?>
			<script type="text/javascript" src="lib/htmlarea/htmlarea.js"></script>
			<script type="text/javascript" src="lib/htmlarea/htmlarea-lang-en.js"></script>
			<script type="text/javascript" src="lib/htmlarea/dialog.js"></script>
			<style type="text/css">
				@import url(lib/htmlarea/htmlarea.css);
			</style>
			<script defer='defer'>(new HTMLArea(document.forms['blogpost']['data'])).generate();</script>
		<?php endif; ?>
		<br />
		<?php if ($this->_tpl_vars['feature_freetags'] == 'y' && $this->_tpl_vars['tiki_p_freetags_tag'] == 'y'): ?>
				<br/>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "freetag.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>


		<div class="blogPostHelp">
			Utilize ...page... para separar as páginas em uma mensagem multi-página
			<br/>
			Note: if you want to use images please save the post first and you
				will be able to edit/post images. Use the &lt;img&gt; snippet to include uploaded images in the textarea editor
				or use the image URL to include images using the WYSIWYG editor. 
		</div>
		
		<?php if ($this->_tpl_vars['postId'] > 0): ?>
		<br/>
			Carregar uma imagem para esta mensagem
			<br/>
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
			<input name="userfile1" class="blogEdit" type="file" />
			<br/><br/>
			<?php if (count ( $this->_tpl_vars['post_images'] ) > 0): ?>
				Imagens:
				<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['post_images']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<br/>
						<a href="tiki-blog_post.php?postId=<?php echo $this->_tpl_vars['postId']; ?>
&amp;remove_image=<?php echo $this->_tpl_vars['post_images'][$this->_sections['ix']['index']]['imgId']; ?>
">
							<img border='0' src='styles/estudiolivre/iDelete.png' alt='Lixeira'/>
						</a>
						<a class="link" href="tiki-view_blog_post_image.php?imgId=<?php echo $this->_tpl_vars['post_images'][$this->_sections['ix']['index']]['imgId']; ?>
"><?php echo $this->_tpl_vars['post_images'][$this->_sections['ix']['index']]['filename']; ?>
</a>:  <?php echo ((is_array($_tmp=$this->_tpl_vars['post_images'][$this->_sections['ix']['index']]['link'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
						
				<?php endfor; endif; ?>
			<?php endif; ?>
		<?php endif; ?>
		
		<br/>
		Marcar entrada como privada:
		<input type="checkbox" name="blogpriv" <?php if ($this->_tpl_vars['blogpriv'] == 'y'): ?>checked="checked"<?php endif; ?> />

		
		<input type="hidden" name="trackback" value="">
		
		<?php if ($this->_tpl_vars['blog_spellcheck'] == 'y'): ?>
		<br/>
			Verificação ortográfica:
				<input type="checkbox" name="spellcheck" <?php if ($this->_tpl_vars['spellcheck'] == 'y'): ?>checked="checked"<?php endif; ?> />
		<?php endif; ?>
		<br/>
		<div id="comButtons">
			<input type="submit" class="wikiaction" name="save" value="salvar" />
			<input type="submit" class="wikiaction" name="preview" value="pré-visualização" />
			<input type="submit" class="wikiaction" name="save_exit" value="salvar e sair" />
		</div>
	</form>
</div>


	