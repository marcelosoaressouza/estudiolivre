<?php /* Smarty version 2.6.18, created on 2011-04-14 20:00:51
         compiled from styles/bolha/tiki-view_blog_post_item.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'styles/bolha/tiki-view_blog_post_item.tpl', 7, false),array('modifier', 'tiki_short_datetime', 'styles/bolha/tiki-view_blog_post_item.tpl', 32, false),array('modifier', 'cat', 'styles/bolha/tiki-view_blog_post_item.tpl', 65, false),array('modifier', 'date_format', 'styles/bolha/tiki-view_blog_post_item.tpl', 77, false),array('function', 'html_image', 'styles/bolha/tiki-view_blog_post_item.tpl', 55, false),array('block', 'tooltip', 'styles/bolha/tiki-view_blog_post_item.tpl', 65, false),)), $this); ?>
<div class="blogpost">
	<div class="posthead">
		<?php if (! $this->_tpl_vars['printingPost']): ?>
			<div class="icons">
				<?php if (( $this->_tpl_vars['ownsblog'] == 'y' ) || ( $this->_tpl_vars['user'] && $this->_tpl_vars['post']['user'] == $this->_tpl_vars['user'] ) || $this->_tpl_vars['tiki_p_blog_admin'] == 'y'): ?>
					<a class="blogt" href="tiki-blog_post.php?blogId=<?php echo $this->_tpl_vars['post']['blogId']; ?>
&amp;postId=<?php echo $this->_tpl_vars['post']['postId']; ?>
">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiEdit.png" alt="Modifica"/>
					</a>
					<a class="blogt" href="tiki-view_blog.php?blogId=<?php echo $this->_tpl_vars['blogId']; ?>
&amp;remove=<?php echo $this->_tpl_vars['post']['postId']; ?>
">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiRemove.png" alt="Elimina"/>
					</a>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['user'] && $this->_tpl_vars['feature_notepad'] == 'y' && $this->_tpl_vars['tiki_p_notepad'] == 'y'): ?>
					<a title="Salva nel blocco note" href="tiki-view_blog.php?blogId=<?php echo $this->_tpl_vars['blogId']; ?>
&amp;savenotepad=<?php echo $this->_tpl_vars['post']['postId']; ?>
">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iSave.png" alt="Salva"/>
					</a>
				<?php endif; ?>
				<a href='tiki-send_blog_post.php?postId=<?php echo $this->_tpl_vars['post']['postId']; ?>
'>
					<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iEmail.png" alt="email this post"/>
				</a>
				<a href='tiki-print_blog_post.php?postId=<?php echo $this->_tpl_vars['post']['postId']; ?>
'>
					<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiPrint.png" alt="stampa" />
				</a>
			</div>				
		<?php endif; ?>
		<?php if ($this->_tpl_vars['use_title'] == 'y'): ?>
			<h1>
				<?php echo $this->_tpl_vars['post']['title']; ?>

			</h1>
		<?php else: ?>
			<h1>
				<?php echo ((is_array($_tmp=$this->_tpl_vars['post']['created'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>

			</h1>
		<?php endif; ?>		
	</div>
	<div class="postbody">
		<?php echo $this->_tpl_vars['text']; ?>

		<?php if ($this->_tpl_vars['pages'] > 1 && $this->_tpl_vars['showPages']): ?>
			<div align="center">
				<a href="tiki-view_blog_post.php?blogId=<?php echo $_REQUEST['blogId']; ?>
&amp;postId=<?php echo $_REQUEST['postId']; ?>
&amp;page=<?php echo $this->_tpl_vars['first_page']; ?>
">
					<img src='img/icons2/nav_first.gif' border='0' alt='First page' title='First page' />
				</a>
		
				<a href="tiki-view_blog_post.php?blogId=<?php echo $_REQUEST['blogId']; ?>
&amp;postId=<?php echo $_REQUEST['postId']; ?>
&amp;page=<?php echo $this->_tpl_vars['prev_page']; ?>
">
					<img src='img/icons2/nav_dot_right.gif' border='0' alt='Previous page' title='Previous page' />
				</a>
		
				pagina: <?php echo $this->_tpl_vars['pagenum']; ?>
/<?php echo $this->_tpl_vars['pages']; ?>

		
				<a href="tiki-view_blog_post.php?blogId=<?php echo $_REQUEST['blogId']; ?>
&amp;postId=<?php echo $_REQUEST['postId']; ?>
&amp;page=<?php echo $this->_tpl_vars['next_page']; ?>
">
					<img src='img/icons2/nav_dot_left.gif' border='0' alt='Next page' title='Next page' />
				</a>
		
				<a href="tiki-view_blog_post.php?blogId=<?php echo $_REQUEST['blogId']; ?>
&amp;postId=<?php echo $_REQUEST['postId']; ?>
&amp;page=<?php echo $this->_tpl_vars['last_page']; ?>
">
					<?php echo smarty_function_html_image(array('file' => 'img/icons2/nav_last.gif','border' => '0','alt' => 'Last page','title' => 'Last page'), $this);?>

				</a>
			</div>
		<?php endif; ?>
	</div>
		<h4>
			<span>
				tags:
				<em>
					<?php $_from = $this->_tpl_vars['post']['tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tags'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tags']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['tag']):
        $this->_foreach['tags']['iteration']++;
?>
					<?php $this->_tag_stack[] = array('tooltip', array('text' => ((is_array($_tmp=((is_array($_tmp="Clique para ver outros posts com a tag <b>")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['tag']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['tag'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "</b>") : smarty_modifier_cat($_tmp, "</b>")))); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="tiki-browse_freetags.php?tag=<?php echo $this->_tpl_vars['tag']; ?>
&type=blog post"><?php echo $this->_tpl_vars['tag']; ?>
</a><?php if (! ($this->_foreach['tags']['iteration'] == $this->_foreach['tags']['total'])): ?>, <?php endif; ?>
					<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php endforeach; else: ?>
						Este post não tem tags.
					<?php endif; unset($_from); ?>
				</em>
			</span>
		</h4>
	<div class="postbottom">
		posted by:<i> <a href="el-user.php?view_user=<?php echo $this->_tpl_vars['post']['user']; ?>
"><?php echo $this->_tpl_vars['post']['user']; ?>
</a></i>
		 
		<?php if ($this->_tpl_vars['use_title'] == 'y'): ?>
			 il: <i><?php echo ((is_array($_tmp=$this->_tpl_vars['post']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M - %d/%m") : smarty_modifier_date_format($_tmp, "%H:%M - %d/%m")); ?>
</i>
		<?php endif; ?>
		
		<?php if (! $this->_tpl_vars['printingPost']): ?>
			&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
			<?php if ($this->_tpl_vars['post']['pages'] > 1): ?>
				<a class="link" href="tiki-view_blog_post.php?blogId=<?php echo $this->_tpl_vars['blogId']; ?>
&amp;postId=<?php echo $this->_tpl_vars['post']['postId']; ?>
">
				read more (<?php echo $this->_tpl_vars['post']['pages']; ?>
 pagine)
				</a>
				&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
			<?php endif; ?>
			<a class="link" href="tiki-view_blog_post.php?blogId=<?php echo $this->_tpl_vars['blogId']; ?>
&amp;postId=<?php echo $this->_tpl_vars['post']['postId']; ?>
">
				permalink
			</a>

			
			
			<?php if ($this->_tpl_vars['allow_comments'] == 'y' && $this->_tpl_vars['feature_blogposts_comments'] == 'y'): ?>
				<?php if ($this->_tpl_vars['post']['comments'] > 0): ?>
					&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
					<a class="link" href="tiki-view_blog_post.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;blogId=<?php echo $this->_tpl_vars['blogId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
&amp;postId=<?php echo $this->_tpl_vars['post']['postId']; ?>
&amp;show_comments=1">
						(<?php echo $this->_tpl_vars['post']['comments']; ?>
) <?php if ($this->_tpl_vars['post']['comments'] == 1): ?>commento<?php else: ?>commenti<?php endif; ?>
					</a>
				<?php endif; ?>
				&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				<a class="link" href="tiki-view_blog_post.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;blogId=<?php echo $this->_tpl_vars['blogId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
&amp;postId=<?php echo $this->_tpl_vars['post']['postId']; ?>
&amp;show_comments=1">
					comentar
				</a>
			<?php endif; ?>

			<?php if ($this->_tpl_vars['feature_blogposts_comments'] == 'y' && $this->_tpl_vars['blog_data']['allow_comments'] == 'y' && ( ( $this->_tpl_vars['tiki_p_read_comments'] == 'y' && $this->_tpl_vars['comments_cant'] != 0 ) || $this->_tpl_vars['tiki_p_post_comments'] == 'y' || $this->_tpl_vars['tiki_p_edit_comments'] == 'y' )): ?>
				&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				<a href="#comments" onclick="javascript:flip('comzone<?php if ($this->_tpl_vars['comments_show'] == 'y'): ?>open<?php endif; ?>');" class="linkbut">
					<?php if ($this->_tpl_vars['comments_cant'] == 1): ?>
						<span class="highlight">1 comment</span>
					<?php else: ?>
					    <span class="highlight"><?php echo $this->_tpl_vars['comments_cant']; ?>
 commenti</span>
				    <?php endif; ?>
				</a>
				    &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
				<a href="#comments" onclick="javascript:flip('comzone<?php if ($this->_tpl_vars['comments_show'] == 'y'): ?>open<?php endif; ?>');" class="linkbut">
				    comentar
				</a>
			<?php endif; ?>
		<?php endif; ?>			
	</div>
	
	<?php if ($this->_tpl_vars['printingPost'] && ! $this->_tpl_vars['previewingPost']): ?>
					<?php if ($this->_tpl_vars['feature_blogposts_comments'] == 'y' && $this->_tpl_vars['blog_data']['allow_comments'] == 'y' && ( ( $this->_tpl_vars['tiki_p_read_comments'] == 'y' && $this->_tpl_vars['comments_cant'] != 0 ) || $this->_tpl_vars['tiki_p_post_comments'] == 'y' || $this->_tpl_vars['tiki_p_edit_comments'] == 'y' )): ?>
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "comments.tpl", 'smarty_include_vars' => array('comments_show' => 'y','tiki_p_post_comments' => 'n')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endif; ?>
	<?php endif; ?>
</div>