<?php /* Smarty version 2.6.18, created on 2011-04-04 21:25:58
         compiled from styles/bolha/blog-heading.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/blog-heading.tpl', 1, false),array('modifier', 'date_format', 'styles/bolha/blog-heading.tpl', 3, false),array('modifier', 'replace', 'styles/bolha/blog-heading.tpl', 22, false),array('modifier', 'string_format', 'styles/bolha/blog-heading.tpl', 26, false),)), $this); ?>
<?php echo smarty_function_css(array('extra' => 'list'), $this);?>

<div id="blogHead">
	<h1 onmouseover="tooltip('<b>Blogue Créé par:</b> <?php echo $this->_tpl_vars['creator']; ?>
 <br><b> le :</b> <?php echo ((is_array($_tmp=$this->_tpl_vars['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M - %d/%m/%y") : smarty_modifier_date_format($_tmp, "%H:%M - %d/%m/%y")); ?>
')" onmouseout="nd();">
		Blogue: <a href="tiki-view_blog.php?blogId=<?php echo $this->_tpl_vars['id']; ?>
"><?php echo $this->_tpl_vars['title']; ?>
</a>
	</h1>
	<?php if ($this->_tpl_vars['printingPost']): ?>
			
			<h4><a href="http://www.estudiolivre.org/tiki-view_blog_post.php?blogId=<?php echo $this->_tpl_vars['blogId']; ?>
&amp;postId=<?php echo $this->_tpl_vars['postId']; ?>
">http://www.estudiolivre.org/tiki-view_blog_post.php?blogId=<?php echo $this->_tpl_vars['blogId']; ?>
&amp;postId=<?php echo $this->_tpl_vars['postId']; ?>
</a></h4>
	<?php endif; ?>
	<?php if (! $this->_tpl_vars['nameOnly']): ?>
		<div id="desc">
			<?php if ($_COOKIE['blogDescCont'] == 'block'): ?>
				<?php $this->assign('bdisplay', 'block'); ?>
				<?php $this->assign('bimgCurrent', 'Down'); ?>
				<?php $this->assign('bimgChange', 'Left'); ?>
			<?php else: ?>
				<?php $this->assign('bdisplay', 'none'); ?>
				<?php $this->assign('bimgCurrent', 'Left'); ?>
				<?php $this->assign('bimgChange', 'Down'); ?>	
			<?php endif; ?>
				<div class="pointer" id="descFlipper" onclick="javascript:flip('moduleblogDescCont');toggleImage(document.getElementById('TArrowBlogDesc'),'iArrowGrey<?php echo $this->_tpl_vars['bimgChange']; ?>
.png');storeState('blogDescCont');">
			        Description<img id="TArrowBlogDesc"  src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGrey<?php echo $this->_tpl_vars['bimgCurrent']; ?>
.png">
				</div>
			<div id="moduleblogDescCont" style="display:<?php echo $this->_tpl_vars['bdisplay']; ?>
">
				<?php echo $this->_tpl_vars['description']; ?>

				<h5>Stats: <?php echo $this->_tpl_vars['posts']; ?>
 articles | <?php echo $this->_tpl_vars['hits']; ?>
 visites | Activité=<?php echo ((is_array($_tmp=$this->_tpl_vars['activity'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</h5>
			</div>
		</div>
		<h4>
			Modifié: <?php echo ((is_array($_tmp=$this->_tpl_vars['lastModif'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%y - %H:%M") : smarty_modifier_date_format($_tmp, "%d/%m/%y - %H:%M")); ?>

			<?php if ($this->_tpl_vars['rss_blog'] == 'y'): ?>
				&nbsp;&nbsp;&nbsp;
				<a class="bloglink" href="tiki-blog_rss.php?blogId=<?php echo $this->_tpl_vars['blogId']; ?>
">
					<img src='styles/estudiolivre/iRss.png' alt='Syndication RSS' title='Syndication RSS' />
				</a>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['user'] && $this->_tpl_vars['feature_user_watches'] == 'y'): ?>
			<br />
				<?php if ($this->_tpl_vars['user_watching_blog'] == 'n'): ?>
					<a href="tiki-view_blog.php?blogId=<?php echo $this->_tpl_vars['blogId']; ?>
&amp;watch_event=blog_post&amp;watch_object=<?php echo $this->_tpl_vars['blogId']; ?>
&amp;watch_action=add">
						surveiller ce blogue
					</a>
				<?php else: ?>
					<a href="tiki-view_blog.php?blogId=<?php echo $this->_tpl_vars['blogId']; ?>
&amp;watch_event=blog_post&amp;watch_object=<?php echo $this->_tpl_vars['blogId']; ?>
&amp;watch_action=remove">
						arrêter de surveiller ce blogue
					</a>
				<?php endif; ?>
			<?php endif; ?>
		</h4>
		<div id="edit">
				<?php if ($this->_tpl_vars['tiki_p_blog_post'] == 'y'): ?>
					<?php if (( $this->_tpl_vars['user'] && $this->_tpl_vars['creator'] == $this->_tpl_vars['user'] ) || $this->_tpl_vars['tiki_p_blog_admin'] == 'y' || $this->_tpl_vars['public'] == 'y'): ?>
						<a class="bloglink" href="tiki-blog_post.php?blogId=<?php echo $this->_tpl_vars['blogId']; ?>
">
							Publier
						</a>
					<?php endif; ?>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['tiki_p_blog_post'] == 'y' && ( ( $this->_tpl_vars['user'] && $this->_tpl_vars['creator'] == $this->_tpl_vars['user'] ) || $this->_tpl_vars['tiki_p_blog_admin'] == 'y' )): ?>
				&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;
				<?php endif; ?>
				<?php if (( $this->_tpl_vars['user'] && $this->_tpl_vars['creator'] == $this->_tpl_vars['user'] ) || $this->_tpl_vars['tiki_p_blog_admin'] == 'y'): ?>
					<a class="bloglink" href="tiki-edit_blog.php?blogId=<?php echo $this->_tpl_vars['blogId']; ?>
">
						Modifier le blogue
					</a>
				<?php endif; ?>
		</div>
	<?php endif; ?>
</div>