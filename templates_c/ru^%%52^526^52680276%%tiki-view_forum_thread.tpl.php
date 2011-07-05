<?php /* Smarty version 2.6.18, created on 2011-04-05 05:38:11
         compiled from styles/bolha/tiki-view_forum_thread.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-view_forum_thread.tpl', 1, false),array('modifier', 'replace', 'styles/bolha/tiki-view_forum_thread.tpl', 41, false),array('modifier', 'avatarize', 'styles/bolha/tiki-view_forum_thread.tpl', 57, false),array('modifier', 'userlink', 'styles/bolha/tiki-view_forum_thread.tpl', 67, false),array('modifier', 'date_format', 'styles/bolha/tiki-view_forum_thread.tpl', 68, false),array('modifier', 'kbsize', 'styles/bolha/tiki-view_forum_thread.tpl', 74, false),)), $this); ?>
<?php echo smarty_function_css(array(), $this);?>

<div class="forumpost">
	<h1>
		Форум:
		<a href="tiki-view_forum.php?topics_offset=<?php echo $_REQUEST['topics_offset']; ?>
<?php echo $this->_tpl_vars['topics_sort_mode_param']; ?>
<?php echo $this->_tpl_vars['topics_threshold_param']; ?>
<?php echo $this->_tpl_vars['topics_find_param']; ?>
&amp;forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
" class="pagetitle">
			<?php echo $this->_tpl_vars['forum_info']['name']; ?>

		</a>
	</h1>
	
	<h5>
		<?php if (( $this->_tpl_vars['prev_topic'] && $this->_tpl_vars['prev_topic'] != $this->_tpl_vars['comments_parentId'] ) || $this->_tpl_vars['next_topic']): ?>
			<?php if ($this->_tpl_vars['prev_topic'] && $this->_tpl_vars['prev_topic'] != $this->_tpl_vars['comments_parentId']): ?>
				<a href="tiki-view_forum_thread.php?forumId=<?php echo $this->_tpl_vars['forumId']; ?>
&amp;comments_parentId=<?php echo $this->_tpl_vars['prev_topic']; ?>
&amp;topics_offset=<?php echo $this->_tpl_vars['topics_prev_offset']; ?>
<?php echo $this->_tpl_vars['topics_sort_mode_param']; ?>
<?php echo $this->_tpl_vars['topics_threshold_param']; ?>
<?php echo $this->_tpl_vars['topics_find_param']; ?>
<?php echo $this->_tpl_vars['comments_maxComments_param']; ?>
<?php echo $this->_tpl_vars['comments_style_param']; ?>
<?php echo $this->_tpl_vars['comments_sort_mode_param']; ?>
<?php echo $this->_tpl_vars['comments_threshold_param']; ?>
" class="link">
					пред. тема
				</a>
				<?php if ($this->_tpl_vars['next_topic']): ?> | <?php endif; ?>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['next_topic']): ?>
				<a href="tiki-view_forum_thread.php?forumId=<?php echo $this->_tpl_vars['forumId']; ?>
&amp;comments_parentId=<?php echo $this->_tpl_vars['next_topic']; ?>
&amp;topics_offset=<?php echo $this->_tpl_vars['topics_next_offset']; ?>
<?php echo $this->_tpl_vars['topics_sort_mode_param']; ?>
<?php echo $this->_tpl_vars['topics_threshold_param']; ?>
<?php echo $this->_tpl_vars['topics_find_param']; ?>
<?php echo $this->_tpl_vars['comments_maxComments_param']; ?>
<?php echo $this->_tpl_vars['comments_style_param']; ?>
<?php echo $this->_tpl_vars['comments_sort_mode_param']; ?>
<?php echo $this->_tpl_vars['comments_threshold_param']; ?>
" class="link">
					след. тема</a>
			<?php endif; ?>
		<?php endif; ?>
	</h5>
	
	<div id="edit">
		<?php if ($this->_tpl_vars['tiki_p_admin_forum'] == 'y'): ?>
			<a class="linkbut" title="Правка форума" href="tiki-admin_forums.php?forumId=<?php echo $this->_tpl_vars['forumId']; ?>
">Правка форума</a><br />
		<?php endif; ?>
	</div>
	
	<?php if ($this->_tpl_vars['feature_freetags'] == 'y' && $this->_tpl_vars['tiki_p_view_freetags'] == 'y' && isset ( $this->_tpl_vars['freetags']['data'][0] )): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "freetag_list.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

	<div>
		<div class="posthead">
			<div class="icons">
				<?php if ($this->_tpl_vars['tiki_p_admin_forum'] == 'y' || $this->_tpl_vars['thread_info']['userName'] == $this->_tpl_vars['user']): ?>
					<a href="tiki-view_forum.php?comments_offset=<?php echo $_REQUEST['topics_offset']; ?>
<?php echo $this->_tpl_vars['comments_sort_mode_param']; ?>
&amp;comments_threshold=<?php echo $_REQUEST['topics_threshold']; ?>
<?php echo $this->_tpl_vars['comments_find_param']; ?>
&amp;comments_threadId=<?php echo $this->_tpl_vars['thread_info']['threadId']; ?>
&amp;openpost=1&amp;forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
<?php echo $this->_tpl_vars['comments_maxComments_param']; ?>
"
					class="admlink">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiEdit.png" alt="Правка"/>
					</a>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['tiki_p_admin_forum'] == 'y'): ?>
					<a href="tiki-view_forum.php?comments_offset=<?php echo $_REQUEST['topics_offset']; ?>
<?php echo $this->_tpl_vars['comments_sort_mode_param']; ?>
&amp;comments_threshold=<?php echo $_REQUEST['topics_threshold']; ?>
<?php echo $this->_tpl_vars['comments_find_param']; ?>
&amp;comments_remove=1&amp;comments_threadId=<?php echo $this->_tpl_vars['thread_info']['threadId']; ?>
&amp;forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
<?php echo $this->_tpl_vars['comments_maxComments_param']; ?>
"
					class="admlink">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiRemove.png" alt="Удалить"/>
					</a>
				<?php endif; ?>     
				<?php if ($this->_tpl_vars['user'] && $this->_tpl_vars['feature_notepad'] == 'y' && $this->_tpl_vars['tiki_p_notepad'] == 'y'): ?>
					<a title="Сохранить в блокноте" href="tiki-view_forum_thread.php?topics_offset=<?php echo $_REQUEST['topics_offset']; ?>
<?php echo $this->_tpl_vars['topics_sort_mode_param']; ?>
<?php echo $this->_tpl_vars['topics_threshold_param']; ?>
<?php echo $this->_tpl_vars['topics_find_param']; ?>
&amp;comments_parentId=<?php echo $this->_tpl_vars['comments_parentId']; ?>
&amp;forumId=<?php echo $this->_tpl_vars['forumId']; ?>
<?php echo $this->_tpl_vars['comments_threshold_param']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['comments_offset']; ?>
<?php echo $this->_tpl_vars['comments_sort_mode_param']; ?>
<?php echo $this->_tpl_vars['comments_maxComments_param']; ?>
&amp;savenotepad=<?php echo $this->_tpl_vars['thread_info']['threadId']; ?>
">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iSave.png" alt="Сохранить"/>
					</a>
				<?php endif; ?>
			</div>
			<h1 id="threadTitle">
					<span style="float:left"><?php echo ((is_array($_tmp=$this->_tpl_vars['thread_info']['userName'])) ? $this->_run_mod_handler('avatarize', true, $_tmp) : smarty_modifier_avatarize($_tmp)); ?>
</span><?php echo $this->_tpl_vars['thread_info']['title']; ?>

			</h1>
		</div>
	</div>	  
	
	<div class="postbody">	  
		<?php echo $this->_tpl_vars['thread_info']['parsed']; ?>

	</div>
	
	<div class="postbottom">
		создано:<i><?php echo ((is_array($_tmp=$this->_tpl_vars['thread_info']['userName'])) ? $this->_run_mod_handler('userlink', true, $_tmp) : smarty_modifier_userlink($_tmp)); ?>
</i>
		в: <i><?php echo ((is_array($_tmp=$this->_tpl_vars['thread_info']['commentDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M - %d/%m") : smarty_modifier_date_format($_tmp, "%H:%M - %d/%m")); ?>
</i>
	
		<?php if (count ( $this->_tpl_vars['thread_info']['attachments'] ) > 0): ?>
			<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['thread_info']['attachments']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<a class="link" href="tiki-download_forum_attachment.php?attId=<?php echo $this->_tpl_vars['thread_info']['attachments'][$this->_sections['ix']['index']]['attId']; ?>
">
					<img src="img/icons/attachment.gif" border="0" width="10" height= "13" alt='вложение' />
					<?php echo $this->_tpl_vars['thread_info']['attachments'][$this->_sections['ix']['index']]['filename']; ?>
 (<?php echo ((is_array($_tmp=$this->_tpl_vars['thread_info']['attachments'][$this->_sections['ix']['index']]['filesize'])) ? $this->_run_mod_handler('kbsize', true, $_tmp) : smarty_modifier_kbsize($_tmp)); ?>
)
				</a>
				<?php if ($this->_tpl_vars['tiki_p_admin_forum'] == 'y'): ?>
					<a class="link" href="tiki-view_forum_thread.php?topics_offset=<?php echo $_REQUEST['topics_offset']; ?>
<?php echo $this->_tpl_vars['topics_sort_mode_param']; ?>
<?php echo $this->_tpl_vars['topics_find_param']; ?>
<?php echo $this->_tpl_vars['topics_threshold_param']; ?>
&amp;comments_offset=<?php echo $_REQUEST['topics_offset']; ?>
<?php echo $this->_tpl_vars['comments_sort_mode_param']; ?>
&amp;comments_threshold=<?php echo $_REQUEST['topics_threshold']; ?>
<?php echo $this->_tpl_vars['comments_find_param']; ?>
&amp;forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
<?php echo $this->_tpl_vars['comments_maxComments_param']; ?>
&amp;comments_parentId=<?php echo $this->_tpl_vars['comments_parentId']; ?>
&amp;remove_attachment=<?php echo $this->_tpl_vars['thread_info']['attachments'][$this->_sections['ix']['index']]['attId']; ?>
">
						<img src='img/icons2/delete.gif' border='0' alt='удалить' title='удалить' />
					</a>					
				<?php endif; ?>
				<br />
			<?php endfor; endif; ?>
		<?php endif; ?>
		&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
		прочтений: <i><?php echo $this->_tpl_vars['thread_info']['hits']; ?>
</i>
		&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
		<?php if ($this->_tpl_vars['tiki_p_forum_post'] == 'y'): ?>
			<a class="linkbut" href="#form" onclick="flip('comzone')">ответить</a>
		<?php endif; ?>
	</div>
	
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "comments.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	
	<?php if ($this->_tpl_vars['comments_threshold'] != 0): ?>
		<small>
			<?php echo $this->_tpl_vars['comments_below']; ?>
 Комментарии ниже Вашего порога видимости
		</small>
	<?php endif; ?>
</div>