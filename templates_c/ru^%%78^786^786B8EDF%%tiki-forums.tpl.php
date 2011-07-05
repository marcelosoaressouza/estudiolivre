<?php /* Smarty version 2.6.18, created on 2011-04-09 09:11:09
         compiled from styles/bolha/tiki-forums.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-forums.tpl', 1, false),array('function', 'html_image', 'styles/bolha/tiki-forums.tpl', 12, false),array('function', 'cycle', 'styles/bolha/tiki-forums.tpl', 58, false),array('modifier', 'replace', 'styles/bolha/tiki-forums.tpl', 23, false),array('modifier', 'cat', 'styles/bolha/tiki-forums.tpl', 75, false),array('modifier', 'regex_replace', 'styles/bolha/tiki-forums.tpl', 75, false),array('modifier', 'date_format', 'styles/bolha/tiki-forums.tpl', 118, false),array('modifier', 'times', 'styles/bolha/tiki-forums.tpl', 151, false),array('block', 'tooltip', 'styles/bolha/tiki-forums.tpl', 75, false),)), $this); ?>
<?php echo smarty_function_css(array('extra' => 'list'), $this);?>



<div id="forum">
	<h1>
		<a class="pagetitle" href="tiki-forums.php">
			Форумы
		</a>
	
		<?php if ($this->_tpl_vars['tiki_p_admin'] == 'y'): ?>
			<a href="tiki-admin.php?page=forums" title="Настройка/Опции">
				<?php echo smarty_function_html_image(array('file' => 'img/icons/config.gif','border' => '0','alt' => "Настройка/Опции"), $this);?>

			</a>
		<?php endif; ?>
	</h1>
	
	<div id="forumTable">
	
		<table class="normal" width="100%">
			<tr>
				<td  class="heading">
					<a class="tableheading" href="tiki-forums.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'name_desc'): ?>name_asc<?php else: ?>name_desc<?php endif; ?>">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'name_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'name_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">
					</a>Имя
				</td>
				<?php if ($this->_tpl_vars['forum_list_topics'] == 'y'): ?>
					<td class="heading">
						<a class="tableheading" href="tiki-forums.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'threads_desc'): ?>threads_asc<?php else: ?>threads_desc<?php endif; ?>">
							<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'threads_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'threads_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">	
						</a>Темы
					</td>
				<?php endif; ?>	
				<?php if ($this->_tpl_vars['forum_list_posts'] == 'y'): ?>
					<td class="heading">
						<a class="tableheading" href="tiki-forums.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'comments_desc'): ?>comments_asc<?php else: ?>comments_desc<?php endif; ?>">
							<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'comments_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'comments_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">	
						</a>Сообщений
					</td>
				<?php endif; ?>
					
					
				<?php if ($this->_tpl_vars['forum_list_lastpost'] == 'y'): ?>	
					<td class="heading">
						<a class="tableheading" href="tiki-forums.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'lastPost_desc'): ?>lastPost_asc<?php else: ?>lastPost_desc<?php endif; ?>">
							<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'lastPost_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'lastPost_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">
						</a>Последнее сообщение
					</td>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['forum_list_visits'] == 'y'): ?>
					<td class="heading">
						<a class="tableheading" href="tiki-forums.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'hits_desc'): ?>hits_asc<?php else: ?>hits_desc<?php endif; ?>">
							<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'hits_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'hits_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">	
						</a>Посещений
					</td>
				<?php endif; ?>	
			</tr>
	
			<?php echo smarty_function_cycle(array('values' => "odd,even",'print' => false), $this);?>
					
			<?php $this->assign('section_old', ""); ?>
			<?php unset($this->_sections['user']);
$this->_sections['user']['name'] = 'user';
$this->_sections['user']['loop'] = is_array($_loop=$this->_tpl_vars['channels']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['user']['show'] = true;
$this->_sections['user']['max'] = $this->_sections['user']['loop'];
$this->_sections['user']['step'] = 1;
$this->_sections['user']['start'] = $this->_sections['user']['step'] > 0 ? 0 : $this->_sections['user']['loop']-1;
if ($this->_sections['user']['show']) {
    $this->_sections['user']['total'] = $this->_sections['user']['loop'];
    if ($this->_sections['user']['total'] == 0)
        $this->_sections['user']['show'] = false;
} else
    $this->_sections['user']['total'] = 0;
if ($this->_sections['user']['show']):

            for ($this->_sections['user']['index'] = $this->_sections['user']['start'], $this->_sections['user']['iteration'] = 1;
                 $this->_sections['user']['iteration'] <= $this->_sections['user']['total'];
                 $this->_sections['user']['index'] += $this->_sections['user']['step'], $this->_sections['user']['iteration']++):
$this->_sections['user']['rownum'] = $this->_sections['user']['iteration'];
$this->_sections['user']['index_prev'] = $this->_sections['user']['index'] - $this->_sections['user']['step'];
$this->_sections['user']['index_next'] = $this->_sections['user']['index'] + $this->_sections['user']['step'];
$this->_sections['user']['first']      = ($this->_sections['user']['iteration'] == 1);
$this->_sections['user']['last']       = ($this->_sections['user']['iteration'] == $this->_sections['user']['total']);
?>
				<?php $this->assign('section', $this->_tpl_vars['channels'][$this->_sections['user']['index']]['section']); ?>
				<?php if ($this->_tpl_vars['section'] != $this->_tpl_vars['section_old']): ?>
					<?php $this->assign('section_old', $this->_tpl_vars['section']); ?>
					<tr>
						<td class="forumName" colspan="6">
							<span><?php echo $this->_tpl_vars['section']; ?>
</span>
						</td>
					</tr>
				<?php endif; ?>
				<tr class="<?php echo smarty_function_cycle(array(), $this);?>
">
				
				<?php if (( $this->_tpl_vars['channels'][$this->_sections['user']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['channels'][$this->_sections['user']['index']]['individual_tiki_p_forum_read'] == 'y' )): ?>
					<td class="forumTableCell">
						<?php if ($this->_tpl_vars['forum_list_desc'] == 'y'): ?>
							<?php $this->_tag_stack[] = array('tooltip', array('text' => ((is_array($_tmp=((is_array($_tmp="<b>Descrição: </b>")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['channels'][$this->_sections['user']['index']]['description']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['channels'][$this->_sections['user']['index']]['description'])))) ? $this->_run_mod_handler('regex_replace', true, $_tmp, "/[\r\t\n]/", ' ') : smarty_modifier_regex_replace($_tmp, "/[\r\t\n]/", ' ')))); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
								<a class="forumname" href="tiki-view_forum.php?forumId=<?php echo $this->_tpl_vars['channels'][$this->_sections['user']['index']]['forumId']; ?>
">
									<?php echo $this->_tpl_vars['channels'][$this->_sections['user']['index']]['name']; ?>

								</a>
							<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
						<?php else: ?>
							<?php $this->_tag_stack[] = array('tooltip', array('text' => "Fórum sem descrição")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
								<a class="forumname" href="tiki-view_forum.php?forumId=<?php echo $this->_tpl_vars['channels'][$this->_sections['user']['index']]['forumId']; ?>
">
									<?php echo $this->_tpl_vars['channels'][$this->_sections['user']['index']]['name']; ?>

								</a>
							<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
						<?php endif; ?>
				<?php else: ?>
					<td class="forumTableCell">
							<?php echo $this->_tpl_vars['channels'][$this->_sections['user']['index']]['name']; ?>

				<?php endif; ?>
		
				<?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( ( $this->_tpl_vars['channels'][$this->_sections['user']['index']]['individual'] == 'n' ) && ( $this->_tpl_vars['tiki_p_admin_forum'] == 'y' ) ) || ( $this->_tpl_vars['channels'][$this->_sections['user']['index']]['individual_tiki_p_admin_forum'] == 'y' )): ?>
					<a class="admlink" title="configure forum" href="tiki-admin_forums.php?forumId=<?php echo $this->_tpl_vars['channels'][$this->_sections['user']['index']]['forumId']; ?>
">
						<img src="img/icons/config.gif" border="0" width="16" height="16" alt='Настройка/Опции' />
					</a>
				<?php endif; ?>
				
					</td>
		
				<?php if ($this->_tpl_vars['forum_list_topics'] == 'y'): ?>
					<td class="forumTableCell">
						<?php echo $this->_tpl_vars['channels'][$this->_sections['user']['index']]['threads']; ?>

					</td>
				<?php endif; ?>
				
				<?php if ($this->_tpl_vars['forum_list_posts'] == 'y'): ?>
					<td  class="forumTableCell">
						<?php echo $this->_tpl_vars['channels'][$this->_sections['user']['index']]['comments']; ?>

					</td>
				<?php endif; ?>
				
				
				
				<?php if ($this->_tpl_vars['forum_list_lastpost'] == 'y'): ?>	
					<td class="forumTableCell">
						<?php $this->assign('postName', $this->_tpl_vars['channels'][$this->_sections['user']['index']]['lastPostData']['title']); ?>
						<?php $this->_tag_stack[] = array('tooltip', array('text' => ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp="<b>Título:</b><i> ")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['postName']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['postName'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "</i><br> <b>Por:</b> <i>") : smarty_modifier_cat($_tmp, "</i><br> <b>Por:</b> <i>")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['channels'][$this->_sections['user']['index']]['lastPostData']['userName']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['channels'][$this->_sections['user']['index']]['lastPostData']['userName'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "</i>") : smarty_modifier_cat($_tmp, "</i>")))); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
							<?php echo ((is_array($_tmp=$this->_tpl_vars['channels'][$this->_sections['user']['index']]['lastPost'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m às %H:%M") : smarty_modifier_date_format($_tmp, "%d/%m às %H:%M")); ?>

						<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					</td>
				<?php endif; ?>
				
				<?php if ($this->_tpl_vars['forum_list_visits'] == 'y'): ?>
					<td class="forumTableCell">
						<?php echo $this->_tpl_vars['channels'][$this->_sections['user']['index']]['hits']; ?>

					</td>
				<?php endif; ?>	
				</tr>
			<?php endfor; endif; ?>
		</table>
		
		<br />
		
		<div class="paginacao">
			<?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
				<a class="forumprevnext" href="tiki-forums.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
					<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyLeft.png">
				</a>
			<?php endif; ?>
			
			Страница <?php echo $this->_tpl_vars['actual_page']; ?>
 de <?php echo $this->_tpl_vars['cant_pages']; ?>

			
			<?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
				<a class="forumprevnext" href="tiki-forums.php?find=<?php echo $this->_tpl_vars['find']; ?>
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
						<a class="prevnext" href="tiki-forums.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['selector_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
					<?php echo $this->_sections['foo']['index_next']; ?>
</a>
				<?php endfor; endif; ?>
			<?php endif; ?>
		</div>
	
	</div>
</div>