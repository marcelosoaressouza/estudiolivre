<?php /* Smarty version 2.6.18, created on 2011-06-23 15:12:14
         compiled from styles/bolha/tiki-list_blogs.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-list_blogs.tpl', 1, false),array('function', 'cycle', 'styles/bolha/tiki-list_blogs.tpl', 81, false),array('modifier', 'replace', 'styles/bolha/tiki-list_blogs.tpl', 31, false),array('modifier', 'cat', 'styles/bolha/tiki-list_blogs.tpl', 86, false),array('modifier', 'regex_replace', 'styles/bolha/tiki-list_blogs.tpl', 86, false),array('modifier', 'truncate', 'styles/bolha/tiki-list_blogs.tpl', 92, false),array('modifier', 'userlink', 'styles/bolha/tiki-list_blogs.tpl', 105, false),array('modifier', 'avatarize', 'styles/bolha/tiki-list_blogs.tpl', 109, false),array('modifier', 'date_format', 'styles/bolha/tiki-list_blogs.tpl', 124, false),array('modifier', 'escape', 'styles/bolha/tiki-list_blogs.tpl', 170, false),array('modifier', 'times', 'styles/bolha/tiki-list_blogs.tpl', 219, false),array('block', 'tooltip', 'styles/bolha/tiki-list_blogs.tpl', 86, false),)), $this); ?>
<?php echo smarty_function_css(array('only' => 'list'), $this);?>

<div id="blogs">
	<h1>
		<?php if (! $this->_tpl_vars['find']): ?>
			Blog
		<?php else: ?>
			Busca em blogs
		<?php endif; ?>
		<?php if ($this->_tpl_vars['tiki_p_admin'] == 'y'): ?>
			<a href="tiki-admin.php?page=blogs">
				<img src='img/icons/config.gif' border='0'  alt="configure listing" title="configure listing" />
			</a>
		<?php endif; ?>
	</h1>
	
	<?php if ($this->_tpl_vars['tiki_p_create_blogs'] == 'y'): ?>
		<h5>
		<div class="navbar">
			<a class="linkbut" href="tiki-edit_blog.php">
				create new blog
			</a>
		</div>
		</h5>
	<?php endif; ?>
	
	<table class="bloglist">
		<tr>
			<?php if ($this->_tpl_vars['blog_list_title'] == 'y'): ?>
				<td class="heading">
					<a class="heading" href="tiki-list_blogs.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'title_desc'): ?>title_asc<?php else: ?>title_desc<?php endif; ?>">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'title_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'title_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">
					</a>Titolo
				</td>
			<?php endif; ?>
			
			<?php if ($this->_tpl_vars['blog_list_user'] != 'disabled'): ?>
				<td class="heading">
					<a class="heading" href="tiki-list_blogs.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'user_desc'): ?>user_asc<?php else: ?>user_desc<?php endif; ?>">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'user_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'user_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">
					</a>Utenti
				</td>
			<?php endif; ?>
			
			
	
			<?php if ($this->_tpl_vars['blog_list_created'] == 'y'): ?>
				<td class="heading">
					<a class="heading" href="tiki-list_blogs.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'created_desc'): ?>created_asc<?php else: ?>created_desc<?php endif; ?>">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'created_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'created_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">
					</a>Creato
				</td>
			<?php endif; ?>
	
			<?php if ($this->_tpl_vars['blog_list_lastmodif'] == 'y'): ?>
				<td class="heading">
					<a class="heading" href="tiki-list_blogs.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'lastModif_desc'): ?>lastModif_asc<?php else: ?>lastModif_desc<?php endif; ?>">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'lastModif_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'lastModif_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">
					</a>Ultima Modifica
				</td>
			<?php endif; ?>
			
			<?php if ($this->_tpl_vars['blog_list_posts'] == 'y'): ?>
				<td class="heading">
					<a class="heading" href="tiki-list_blogs.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'posts_desc'): ?>posts_asc<?php else: ?>posts_desc<?php endif; ?>">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'posts_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'posts_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">
					</a>Messaggi
				</td>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['blog_list_visits'] == 'y'): ?>
				<td class="heading">
					<a class="heading" href="tiki-list_blogs.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'hits_desc'): ?>hits_asc<?php else: ?>hits_desc<?php endif; ?>">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'hits_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'hits_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">
					</a>Visite
				</td>
			<?php endif; ?>
			
			
			
		</tr>
	
		<?php echo smarty_function_cycle(array('values' => "odd,even",'print' => false), $this);?>

		<?php unset($this->_sections['changes']);
$this->_sections['changes']['name'] = 'changes';
$this->_sections['changes']['loop'] = is_array($_loop=$this->_tpl_vars['listpages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['changes']['show'] = true;
$this->_sections['changes']['max'] = $this->_sections['changes']['loop'];
$this->_sections['changes']['step'] = 1;
$this->_sections['changes']['start'] = $this->_sections['changes']['step'] > 0 ? 0 : $this->_sections['changes']['loop']-1;
if ($this->_sections['changes']['show']) {
    $this->_sections['changes']['total'] = $this->_sections['changes']['loop'];
    if ($this->_sections['changes']['total'] == 0)
        $this->_sections['changes']['show'] = false;
} else
    $this->_sections['changes']['total'] = 0;
if ($this->_sections['changes']['show']):

            for ($this->_sections['changes']['index'] = $this->_sections['changes']['start'], $this->_sections['changes']['iteration'] = 1;
                 $this->_sections['changes']['iteration'] <= $this->_sections['changes']['total'];
                 $this->_sections['changes']['index'] += $this->_sections['changes']['step'], $this->_sections['changes']['iteration']++):
$this->_sections['changes']['rownum'] = $this->_sections['changes']['iteration'];
$this->_sections['changes']['index_prev'] = $this->_sections['changes']['index'] - $this->_sections['changes']['step'];
$this->_sections['changes']['index_next'] = $this->_sections['changes']['index'] + $this->_sections['changes']['step'];
$this->_sections['changes']['first']      = ($this->_sections['changes']['iteration'] == 1);
$this->_sections['changes']['last']       = ($this->_sections['changes']['iteration'] == $this->_sections['changes']['total']);
?>
			<tr class=<?php echo smarty_function_cycle(array(), $this);?>
>
				<?php if ($this->_tpl_vars['blog_list_title'] == 'y'): ?>
					<td>
						<?php $this->_tag_stack[] = array('tooltip', array('text' => ((is_array($_tmp=((is_array($_tmp="<b>Descrição: </b>")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['description']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['description'])))) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\r\t\n]/", ' ') : smarty_modifier_regex_replace($_tmp, "/[\r\t\n]/", ' ')))); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
						<?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual_tiki_p_read_blog'] == 'y' )): ?>

							<a class="blogname" href="tiki-view_blog.php?blogId=<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['blogId']; ?>
">
						<?php endif; ?>
						<?php if ($this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['title']): ?>
								<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "...", true) : smarty_modifier_truncate($_tmp, 20, "...", true)); ?>

							</a>

						<?php else: ?>
							&nbsp;
						<?php endif; ?>
						<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					</td>
				<?php endif; ?>
				
				<?php if ($this->_tpl_vars['blog_list_user'] != 'disabled'): ?>
					<?php if ($this->_tpl_vars['blog_list_user'] == 'link'): ?>
						<td>
							&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['user'])) ? $this->_run_mod_handler('userlink', true, $_tmp) : smarty_modifier_userlink($_tmp)); ?>
&nbsp;
						</td>
					<?php elseif ($this->_tpl_vars['blog_list_user'] == 'avatar'): ?>
						<td>
							&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['user'])) ? $this->_run_mod_handler('avatarize', true, $_tmp) : smarty_modifier_avatarize($_tmp)); ?>
&nbsp;
							<br />
							&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['user'])) ? $this->_run_mod_handler('userlink', true, $_tmp) : smarty_modifier_userlink($_tmp)); ?>
&nbsp;
						</td>
					<?php else: ?>
						<td>
							&nbsp;<a href="el-user.php?view_user=<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['user']; ?>
"><?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['user']; ?>
</a>&nbsp;
						</td>
					<?php endif; ?>
				<?php endif; ?>
				
				
		
				<?php if ($this->_tpl_vars['blog_list_created'] == 'y'): ?>
					<td>
						&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%y") : smarty_modifier_date_format($_tmp, "%d/%m/%y")); ?>
&nbsp;
					</td><!--tiki_date_format:"%b %d" -->
				
				<?php endif; ?>
				<?php if ($this->_tpl_vars['blog_list_lastmodif'] == 'y'): ?>
					<td>
						&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['lastModif'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m às %H:%M") : smarty_modifier_date_format($_tmp, "%d/%m às %H:%M")); ?>
&nbsp;
					</td><!--tiki_date_format:"%d of %b [%H:%M]"-->
				<?php endif; ?>
		
				<?php if ($this->_tpl_vars['blog_list_posts'] == 'y'): ?>
					<td>
						&nbsp;<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['posts']; ?>
&nbsp;
					</td>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['blog_list_visits'] == 'y'): ?>
					<td>
						&nbsp;<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['hits']; ?>
&nbsp;
					</td>
				<?php endif; ?>
				
				
					<?php if (( $this->_tpl_vars['user'] && $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['user'] == $this->_tpl_vars['user'] ) || ( $this->_tpl_vars['tiki_p_blog_admin'] == 'y' )): ?>
						<?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual_tiki_p_blog_create_blog'] == 'y' )): ?>
							<td>
								<a class="bloglink" href="tiki-edit_blog.php?blogId=<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['blogId']; ?>
">
									<img title='modifica' alt='modifica' src='img/icons/config.gif' />
								</a>
							</td>
						<?php endif; ?>
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['tiki_p_blog_post'] == 'y'): ?>
						<?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual_tiki_p_blog_post'] == 'y' )): ?>
							<?php if (( $this->_tpl_vars['user'] && $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['user'] == $this->_tpl_vars['user'] ) || ( $this->_tpl_vars['tiki_p_blog_admin'] == 'y' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['public'] == 'y' )): ?>
								<td>
								<a class="bloglink" href="tiki-blog_post.php?blogId=<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['blogId']; ?>
">
									<img title='invia' alt='invia' src='img/icons/edit.gif' />
								</a>
								</td>
							<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['tiki_p_admin'] == 'y'): ?>
					    <?php if ($this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual'] == 'y'): ?>
					    	<td>
							<a class="bloglink" href="tiki-objectpermissions.php?objectName=<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;objectType=blog&amp;permType=blogs&amp;objectId=<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['blogId']; ?>
">
								<img title='active perms' alt='active perms' src='img/icons/key_active.gif' />
							</a>
							</td>
					    <?php else: ?>
					    	<td>
							<a class="bloglink" href="tiki-objectpermissions.php?objectName=<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;objectType=blog&amp;permType=blogs&amp;objectId=<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['blogId']; ?>
">
								<img title='perms' alt='perms' src='img/icons/key.gif' />
							</a>
							</td>
					    <?php endif; ?>
					<?php endif; ?>		
			
			        <?php if (( $this->_tpl_vars['user'] && $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['user'] == $this->_tpl_vars['user'] ) || ( $this->_tpl_vars['tiki_p_blog_admin'] == 'y' )): ?>
		                <?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual_tiki_p_blog_create_blog'] == 'y' )): ?>
		                	<td>
		                    <a class="bloglink" href="tiki-list_blogs.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
&amp;remove=<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['blogId']; ?>
">
		                      	<img title='elimina' alt='elimina' src='img/icons2/delete.gif' />
		                    </a>
		                    </td>
		                <?php endif; ?>
		    	    <?php endif; ?>
			</tr>
		<?php endfor; else: ?>
			<tr>
				<td colspan="9" class="odd">
					Nessun record trovato
				</td>
			</tr>
		<?php endif; ?>
	</table>
	<br/>
	<div class="paginacao">
		<?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
			<a class="userprevnext" href="tiki-list_blogs.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
				<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyLeft.png">
			</a>
		<?php endif; ?>
		
		Pagina <?php echo $this->_tpl_vars['actual_page']; ?>
 de <?php echo $this->_tpl_vars['cant_pages']; ?>

		
		<?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
			<a class="userprevnext" href="tiki-list_blogs.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['next_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
				<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyRight.png">
			</a>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['direct_pagination'] == 'y'): ?>
			<br />
			<?php unset($this->_sections['foo']);
$this->_sections['foo']['loop'] = is_array($_loop=$this->_tpl_vars['cant_pages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['show'] = true;
$this->_sections['foo']['max'] = $this->_sections['foo']['loop'];
$this->_sections['foo']['step'] = 1;
$this->_sections['foo']['start'] = $this->_sections['foo']['step'] > 0 ? 0 : $this->_sections['foo']['loop']-1;
if ($this->_sections['foo']['show']) {
    $this->_sections['foo']['total'] = $this->_sections['foo']['loop'];
    if ($this->_sections['foo']['total'] == 0)
        $this->_sections['foo']['show'] = false;
} else
    $this->_sections['foo']['total'] = 0;
if ($this->_sections['foo']['show']):

            for ($this->_sections['foo']['index'] = $this->_sections['foo']['start'], $this->_sections['foo']['iteration'] = 1;
                 $this->_sections['foo']['iteration'] <= $this->_sections['foo']['total'];
                 $this->_sections['foo']['index'] += $this->_sections['foo']['step'], $this->_sections['foo']['iteration']++):
$this->_sections['foo']['rownum'] = $this->_sections['foo']['iteration'];
$this->_sections['foo']['index_prev'] = $this->_sections['foo']['index'] - $this->_sections['foo']['step'];
$this->_sections['foo']['index_next'] = $this->_sections['foo']['index'] + $this->_sections['foo']['step'];
$this->_sections['foo']['first']      = ($this->_sections['foo']['iteration'] == 1);
$this->_sections['foo']['last']       = ($this->_sections['foo']['iteration'] == $this->_sections['foo']['total']);
?>
				<?php $this->assign('selector_offset', ((is_array($_tmp=$this->_sections['foo']['index'])) ? $this->_run_mod_handler('times', true, $_tmp, $this->_tpl_vars['maxRecords']) : smarty_modifier_times($_tmp, $this->_tpl_vars['maxRecords']))); ?>
					<a class="prevnext" href="tiki-list_blogs.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['selector_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
				<?php echo $this->_sections['foo']['index_next']; ?>
</a>
			<?php endfor; endif; ?>
		<?php endif; ?>
	</div>
</div>