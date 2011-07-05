<?php /* Smarty version 2.6.18, created on 2011-04-27 17:14:23
         compiled from styles/bolha/comment_item.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/comment_item.tpl', 1, false),array('block', 'tooltip', 'styles/bolha/comment_item.tpl', 20, false),array('modifier', 'replace', 'styles/bolha/comment_item.tpl', 22, false),array('modifier', 'date_format', 'styles/bolha/comment_item.tpl', 37, false),array('modifier', 'kbsize', 'styles/bolha/comment_item.tpl', 64, false),)), $this); ?>
<?php echo smarty_function_css(array('extra' => "el-user_msg"), $this);?>

<?php if ($this->_tpl_vars['comment']['doNotShow'] != 1): ?>
	<a name="threadId<?php echo $this->_tpl_vars['comment']['threadId']; ?>
"></a>
	<div class="comment">
		<div class="commentTitle">
			<a href="<?php echo $this->_tpl_vars['comments_complete_father']; ?>
comments_parentId=<?php echo $this->_tpl_vars['comment']['threadId']; ?>
&amp;comments_maxComments=1&amp;comments_style=<?php echo $this->_tpl_vars['comments_style']; ?>
">
				<?php echo $this->_tpl_vars['comment']['title']; ?>

		   	</a>
		</div>

	    <div class="uMsgAvatar">
	       	<a href="el-user.php?view_user=<?php echo $this->_tpl_vars['comment']['userName']; ?>
">
	       		<img src="tiki-show_user_avatar.php?user=<?php echo $this->_tpl_vars['comment']['userName']; ?>
">
	       	</a>
	    </div>
		<div class="uMsgTxt">
			<?php if (! $this->_tpl_vars['previevingComm']): ?>
				<div class="uMsgDel">
			       	<?php if (( $this->_tpl_vars['tiki_p_remove_comments'] == 'y' && $this->_tpl_vars['forum_mode'] != 'y' ) || ( $this->_tpl_vars['tiki_p_admin_forum'] == 'y' && $this->_tpl_vars['forum_mode'] == 'y' )): ?>  	
			        	 <?php $this->_tag_stack[] = array('tooltip', array('text' => 'Deletar Comentario')); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			        	 	<a class="pointer" href="<?php echo $this->_tpl_vars['comments_complete_father']; ?>
comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;comments_threadId=<?php echo $this->_tpl_vars['comment']['threadId']; ?>
&amp;comments_remove=1&amp;comments_offset=<?php echo $this->_tpl_vars['comments_offset']; ?>
&amp;comments_sort_mode=<?php echo $this->_tpl_vars['comments_sort_mode']; ?>
&amp;comments_maxComments=<?php echo $this->_tpl_vars['comments_maxComments']; ?>
&amp;comments_parentId=<?php echo $this->_tpl_vars['comments_parentId']; ?>
&amp;comments_style=<?php echo $this->_tpl_vars['comments_style']; ?>
">
			        	 		<img alt="" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiRemove.png">
			        	 	</a>
			        	 <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			       	<?php endif; ?>
			       	<br/>
					<?php if ($this->_tpl_vars['tiki_p_edit_comments'] == 'y' || $this->_tpl_vars['user'] == $this->_tpl_vars['comment']['userName'] || ( $this->_tpl_vars['tiki_p_admin_forum'] == 'y' && $this->_tpl_vars['forum_mode'] == 'y' )): ?>
						<?php $this->_tag_stack[] = array('tooltip', array('text' => 'Editar Comentario')); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
							<a href="<?php echo $this->_tpl_vars['comments_complete_father']; ?>
comments_threadId=<?php echo $this->_tpl_vars['comment']['threadId']; ?>
&amp;comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['comments_offset']; ?>
&amp;comments_sort_mode=<?php echo $this->_tpl_vars['comments_sort_mode']; ?>
&amp;comments_maxComments=<?php echo $this->_tpl_vars['comments_maxComments']; ?>
&amp;comments_parentId=<?php echo $this->_tpl_vars['comments_parentId']; ?>
&amp;comments_style=<?php echo $this->_tpl_vars['comments_style']; ?>
&amp;edit_reply=1#form">
								<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiEdit.png"/>
							</a>
						<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>				
					<?php endif; ?>
			    </div>
		    <?php endif; ?>
		    <div class="uMsgDate">
				<?php echo ((is_array($_tmp=$this->_tpl_vars['comment']['commentDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
<br />
			    <?php echo ((is_array($_tmp=$this->_tpl_vars['comment']['commentDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>

			</div>
	   		<?php echo $this->_tpl_vars['comment']['parsed']; ?>

		</div>
		<?php if (! $this->_tpl_vars['previevingComm']): ?>		
			<div class="commReply">
		        <?php if (( $this->_tpl_vars['tiki_p_post_comments'] == 'y' && $this->_tpl_vars['forum_mode'] != 'y' ) || ( $this->_tpl_vars['tiki_p_forum_post'] == 'y' && $this->_tpl_vars['forum_mode'] == 'y' )): ?>
					<?php if ($this->_tpl_vars['forum_mode'] != 'y'): ?>
						<a class="linkbut" href="<?php echo $this->_tpl_vars['comments_complete_father']; ?>
comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;comments_reply_threadId=<?php echo $this->_tpl_vars['comment']['threadId']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['comments_offset']; ?>
&amp;comments_sort_mode=<?php echo $this->_tpl_vars['comments_sort_mode']; ?>
&amp;comments_maxComments=<?php echo $this->_tpl_vars['comments_maxComments']; ?>
&amp;comments_grandParentId=<?php echo $this->_tpl_vars['comment']['parentId']; ?>
&amp;comments_parentId=<?php echo $this->_tpl_vars['comment']['threadId']; ?>
&amp;comments_style=<?php echo $this->_tpl_vars['comments_style']; ?>
&amp;post_reply=1#form">antworten</a>
					<?php else: ?>
				   		<?php if ($this->_tpl_vars['comments_grandParentId']): ?>
							<a class="linkbut" href="<?php echo $this->_tpl_vars['comments_complete_father']; ?>
comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;comments_reply_threadId=<?php echo $this->_tpl_vars['comment']['threadId']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['comments_offset']; ?>
&amp;comments_sort_mode=<?php echo $this->_tpl_vars['comments_sort_mode']; ?>
&amp;comments_maxComments=<?php echo $this->_tpl_vars['comments_maxComments']; ?>
&amp;comments_grandParentId=<?php echo $this->_tpl_vars['comments_grandParentId']; ?>
&amp;comments_parentId=<?php echo $this->_tpl_vars['comments_grandParentId']; ?>
&amp;comments_style=<?php echo $this->_tpl_vars['comments_style']; ?>
&amp;post_reply=1#form">antworten</a>
				   		<?php else: ?>
						  	<a class="linkbut" href="<?php echo $this->_tpl_vars['comments_complete_father']; ?>
comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;comments_reply_threadId=<?php echo $this->_tpl_vars['comment']['threadId']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['comments_offset']; ?>
&amp;comments_sort_mode=<?php echo $this->_tpl_vars['comments_sort_mode']; ?>
&amp;comments_maxComments=<?php echo $this->_tpl_vars['comments_maxComments']; ?>
&amp;comments_grandParentId=<?php echo $this->_tpl_vars['comment']['parentId']; ?>
&amp;comments_parentId=<?php echo $this->_tpl_vars['comment']['parentId']; ?>
&amp;comments_style=<?php echo $this->_tpl_vars['comments_style']; ?>
&amp;post_reply=1#form">antworten</a>
						<?php endif; ?>
				    <?php endif; ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>	
		
		<?php if (( $this->_tpl_vars['comments_style'] != 'commentStyle_headers' ) && ! $this->_tpl_vars['previevingComm']): ?>
			<br />
			<?php if (count ( $this->_tpl_vars['comment']['attachments'] ) > 0): ?>
				<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['comment']['attachments']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<a class="link" href="tiki-download_forum_attachment.php?attId=<?php echo $this->_tpl_vars['comment']['attachments'][$this->_sections['ix']['index']]['attId']; ?>
">
					<img src="img/icons/attachment.gif" border="0" width="10" height= "13" alt='Anhang' />
					<?php echo $this->_tpl_vars['comment']['attachments'][$this->_sections['ix']['index']]['filename']; ?>
 (<?php echo ((is_array($_tmp=$this->_tpl_vars['comment']['attachments'][$this->_sections['ix']['index']]['filesize'])) ? $this->_run_mod_handler('kbsize', true, $_tmp) : smarty_modifier_kbsize($_tmp)); ?>
)</a>
					<?php if ($this->_tpl_vars['tiki_p_admin_forum'] == 'y'): ?>
						<a class="link" href="tiki-view_forum_thread.php?topics_offset=<?php echo $_REQUEST['topics_offset']; ?>
&amp;topics_sort_mode=<?php echo $_REQUEST['topics_sort_mode']; ?>
&amp;topics_find=<?php echo $_REQUEST['topics_find']; ?>
&amp;topics_threshold=<?php echo $_REQUEST['topics_threshold']; ?>
&amp;comments_offset=<?php echo $_REQUEST['topics_offset']; ?>
&amp;comments_sort_mode=<?php echo $_REQUEST['topics_sort_mode']; ?>
&amp;comments_threshold=<?php echo $_REQUEST['topics_threshold']; ?>
&amp;comments_find=<?php echo $_REQUEST['topics_find']; ?>
&amp;forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
&amp;comments_maxComments=<?php echo $this->_tpl_vars['comments_maxComments']; ?>
&amp;comments_parentId=<?php echo $this->_tpl_vars['comments_parentId']; ?>
&amp;remove_attachment=<?php echo $this->_tpl_vars['comment']['attachments'][$this->_sections['ix']['index']]['attId']; ?>
">
						<img src="img/icons2/delete.gif" border="0" width="16" height="16" alt='Entfernen' />
						</a>
					<?php endif; ?>
					<br />
				<?php endfor; endif; ?>
			<?php endif; ?>
		<?php endif; ?>
	
		<?php if ($this->_tpl_vars['comment']['replies_info']['numReplies'] > 0 && $this->_tpl_vars['comment']['replies_info']['numReplies'] != '' && ! $this->_tpl_vars['previevingComm']): ?>
			<?php $_from = $this->_tpl_vars['comment']['replies_info']['replies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['com'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['com']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['comment']):
        $this->_foreach['com']['iteration']++;
?>
			    <div class="subcomment">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "comment_item.tpl", 'smarty_include_vars' => array('comment' => $this->_tpl_vars['comment'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			    </div>
			  <?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
	</div>
<?php else: ?>
    <?php if ($this->_tpl_vars['comment']['replies_info']['numReplies'] > 0 && $this->_tpl_vars['comment']['replies_info']['numReplies'] != ''): ?>
		<?php $_from = $this->_tpl_vars['comment']['replies_info']['replies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['comment']):
?>
		    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "comment_item.tpl", 'smarty_include_vars' => array('comment' => $this->_tpl_vars['comment'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>
<?php endif; ?>