<?php /* Smarty version 2.6.18, created on 2011-04-05 04:46:12
         compiled from styles/bolha/tiki-view_forum.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-view_forum.tpl', 1, false),array('function', 'cycle', 'styles/bolha/tiki-view_forum.tpl', 179, false),array('function', 'math', 'styles/bolha/tiki-view_forum.tpl', 204, false),array('function', 'html_image', 'styles/bolha/tiki-view_forum.tpl', 221, false),array('block', 'tr', 'styles/bolha/tiki-view_forum.tpl', 40, false),array('modifier', 'escape', 'styles/bolha/tiki-view_forum.tpl', 76, false),array('modifier', 'truncate', 'styles/bolha/tiki-view_forum.tpl', 206, false),array('modifier', 'tiki_short_datetime', 'styles/bolha/tiki-view_forum.tpl', 239, false),array('modifier', 'userlink', 'styles/bolha/tiki-view_forum.tpl', 247, false),array('modifier', 'replace', 'styles/bolha/tiki-view_forum.tpl', 321, false),array('modifier', 'times', 'styles/bolha/tiki-view_forum.tpl', 335, false),)), $this); ?>
<?php echo smarty_function_css(array('extra' => "list,tiki-view_forum_thread"), $this);?>


<div id="viewForum">
<h1>
	フォーラム: 
	<a class="pagetitle" href="tiki-view_forum.php?forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
">
		<?php echo $this->_tpl_vars['forum_info']['name']; ?>

	</a>
</h1>
<?php if ($this->_tpl_vars['forum_info']['show_description'] == 'y'): ?>
	<div class="description">
		<?php echo $this->_tpl_vars['forum_info']['description']; ?>

	</div>
<?php endif; ?>


<h5>
  <?php if ($this->_tpl_vars['tiki_p_forum_post_topic'] == 'y'): ?>
	<span class="pointer" onclick="flip('forumpost');"/>new topic</span>
  	&nbsp;|&nbsp;
  <?php endif; ?>
  <?php if ($this->_tpl_vars['tiki_p_admin_forum'] == 'y'): ?>
    <a class="linkbut" href="tiki-admin_forums.php?forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
">フォーラム変更</a>
    &nbsp;|&nbsp;
  <?php endif; ?>
  <?php if ($this->_tpl_vars['rss_forum'] == 'y'): ?>
	<a href="tiki-forum_rss.php?forumId=<?php echo $this->_tpl_vars['forumId']; ?>
">rss</a>
  <?php endif; ?>
</h5>

<?php if ($this->_tpl_vars['user'] && $this->_tpl_vars['feature_user_watches'] == 'y'): ?>
	<?php if ($this->_tpl_vars['user_watching_forum'] == 'n'): ?>
		<a href="tiki-view_forum.php?forumId=<?php echo $this->_tpl_vars['forumId']; ?>
&amp;watch_event=forum_post_topic&amp;watch_object=<?php echo $this->_tpl_vars['forumId']; ?>
&amp;watch_action=add"><img border='0' alt='フォーラム監視開始' src='img/icons/icon_watch.png' /></a>
	<?php else: ?>
		<a href="tiki-view_forum.php?forumId=<?php echo $this->_tpl_vars['forumId']; ?>
&amp;watch_event=forum_post_topic&amp;watch_object=<?php echo $this->_tpl_vars['forumId']; ?>
&amp;watch_action=remove"><img border='0' alt='フォーラム監視中止' src='img/icons/icon_unwatch.png' /></a>
	<?php endif; ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['unread'] > 0): ?>
	<a class='link' href='messu-mailbox.php'><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You have <?php echo $this->_tpl_vars['unread']; ?>
 unread private messages<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br /></a>
<?php endif; ?>

<?php if ($this->_tpl_vars['was_queued'] == 'y'): ?>
<div class="wikitext">
<small>Your message has been queued for approval, the message will be posted after
a moderator approves it.</small>
</div>
<?php endif; ?>


<?php if ($this->_tpl_vars['tiki_p_forum_post_topic'] == 'y'): ?>
<div id='forumpost' <?php if (( $this->_tpl_vars['comment_preview'] != 'y' && $this->_tpl_vars['openpost'] != 'y' )): ?>style="display:none"<?php endif; ?>>
	<?php if ($this->_tpl_vars['comment_preview'] == 'y'): ?>
		<h1>プレビュー</h1>
		<div class="forumpost">
			<h1 id="threadTitle"><?php echo $this->_tpl_vars['comments_preview_title']; ?>
</h1>
			<div class="postbody">
				<?php echo $this->_tpl_vars['comments_preview_data']; ?>

			</div>
			<div class="postbottom">
				posted by: <?php echo $this->_tpl_vars['user']; ?>

			</div>
		</div>
	<?php endif; ?>

  <?php if ($this->_tpl_vars['warning'] == 'y'): ?>
  <br /><br />
  <div class="commentsedithelp"><br /><b>タイトルとテキストを入力して下さい!</b><br /><br />
  </div>
  <br />
  <?php endif; ?>
  

  <br />
  <?php if ($this->_tpl_vars['comments_threadId'] > 0): ?>
    <h1>コメントの編集: <?php echo ((is_array($_tmp=$this->_tpl_vars['comment_title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</h1> 
    <?php endif; ?>
    <form method="post" enctype="multipart/form-data" action="tiki-view_forum.php" id="editpageform">
    <input type="hidden" name="comments_offset" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_offset'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    <input type="hidden" name="comments_threadId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_threadId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    <input type="hidden" name="comments_threshold" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_threshold'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    <input type="hidden" name="comments_sort_mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_sort_mode'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    <input type="hidden" name="forumId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['forumId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />

      タイトル: <input type="text" name="comments_title" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comment_title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	  種類: 
	  	<select name="comment_topictype">
	      <option value="n" <?php if ($this->_tpl_vars['comment_topictype'] == 'n'): ?>selected="selected"<?php endif; ?>>normal</option>
	      <?php if ($this->_tpl_vars['tiki_p_admin_forum'] == 'y'): ?>
		      <option value="a" <?php if ($this->_tpl_vars['comment_topictype'] == 'a'): ?>selected="selected"<?php endif; ?>>announce</option>
		      <option value="h" <?php if ($this->_tpl_vars['comment_topictype'] == 'h'): ?>selected="selected"<?php endif; ?>>hot</option>
		      <option value="s" <?php if ($this->_tpl_vars['comment_topictype'] == 's'): ?>selected="selected"<?php endif; ?>>sticky</option>
		      <option value="l" <?php if ($this->_tpl_vars['comment_topictype'] == 'l'): ?>selected="selected"<?php endif; ?>>locked</option>
	      <?php endif; ?>
	   </select>
		      
      <br />
    <?php if ($this->_tpl_vars['forum_info']['topic_summary'] == 'y'): ?>
    	Summary
    	<br>
    		<input type="text" size="60" name="comment_topicsummary" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comment_topicsummary'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" maxlength="240" />
    	<br/>
    
    <?php endif; ?>
    <?php if ($this->_tpl_vars['feature_smileys'] == 'y'): ?>
		スマイリー
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-smileys.tpl", 'smarty_include_vars' => array('area_name' => 'editpost')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
    <?php endif; ?>
    	<br />
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "textareasize.tpl", 'smarty_include_vars' => array('area_name' => 'editpost','formId' => 'editpageform')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php if ($this->_tpl_vars['feature_forum_parse'] == 'y'): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-edit_help_tool.tpl", 'smarty_include_vars' => array('area_name' => 'editpost')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>		
      <textarea id='editpost' name="comments_data" rows="<?php echo $this->_tpl_vars['rows']; ?>
" cols="<?php echo $this->_tpl_vars['cols']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['comment_data'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
      <input type="hidden" name="rows" value="<?php echo $this->_tpl_vars['rows']; ?>
"/>
	  <input type="hidden" name="cols" value="<?php echo $this->_tpl_vars['cols']; ?>
"/>    
	  <br>
    <?php if (( $this->_tpl_vars['forum_info']['att'] == 'att_all' ) || ( $this->_tpl_vars['forum_info']['att'] == 'att_admin' && $this->_tpl_vars['tiki_p_admin_form'] == 'y' ) || ( $this->_tpl_vars['forum_info']['att'] == 'att_perm' && $this->_tpl_vars['tiki_p_forum_attach'] == 'y' )): ?>
    
	  Attach file
	  <br>
	  	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['forum_info']['att_max_size'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /><input name="userfile1" type="file" />
	     
    
    <?php endif; ?>
    
   	<?php if ($this->_tpl_vars['feature_freetags'] == 'y' && $this->_tpl_vars['tiki_p_freetags_tag'] == 'y'): ?>
    	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "freetag.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
    
      <br>
      <input type="submit" name="comments_previewComment" value="プレビュー"/>
      <input type="submit" name="comments_postComment" value="ポスト"/>
      <input type="button" name="comments_postComment" value="取消" onclick="window.location='tiki-view_forum.php?forumId=<?php echo ((is_array($_tmp=$this->_tpl_vars['forumId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
'"/>
    
    
    </form>
<br />
  <b>コメントの投稿:</b>
  <br />
  Use [http://www.foo.com] or [http://www.foo.com|description] for links<br />
  HTMLタグはコメント本文では使用できません<br />
</div>
<br />
<?php endif; ?>






<form method="post" action="tiki-view_forum.php">
    <input type="hidden" name="comments_offset" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_offset'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    <input type="hidden" name="comments_threadId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_threadId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    <input type="hidden" name="comments_threshold" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_threshold'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    <input type="hidden" name="comments_sort_mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_sort_mode'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    <input type="hidden" name="forumId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['forumId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<table class="normal">
<tr>
  <?php if ($this->_tpl_vars['tiki_p_admin_forum'] == 'y'): ?>
  <td class="heading">&nbsp;</td>
  <?php endif; ?>
  <td class="heading"><a class="tableheading" href="tiki-view_forum.php?comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['comments_offset']; ?>
&amp;comments_sort_mode=<?php if ($this->_tpl_vars['comments_sort_mode'] == 'type_desc'): ?>type_asc<?php else: ?>type_desc<?php endif; ?>">種類</a></td>
  
  <td class="heading"><a class="tableheading" href="tiki-view_forum.php?comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['comments_offset']; ?>
&amp;comments_sort_mode=<?php if ($this->_tpl_vars['comments_sort_mode'] == 'title_desc'): ?>title_asc<?php else: ?>title_desc<?php endif; ?>">題</a></td>
  <?php if ($this->_tpl_vars['forum_info']['topics_list_replies'] == 'y'): ?>
  	<td class="heading"><a class="tableheading" href="tiki-view_forum.php?comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['comments_offset']; ?>
&amp;comments_sort_mode=<?php if ($this->_tpl_vars['comments_sort_mode'] == 'replies_desc'): ?>replies_asc<?php else: ?>replies_desc<?php endif; ?>">replies</a></td>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['forum_info']['topics_list_reads'] == 'y'): ?>
  	<td class="heading"><a class="tableheading" href="tiki-view_forum.php?comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['comments_offset']; ?>
&amp;comments_sort_mode=<?php if ($this->_tpl_vars['comments_sort_mode'] == 'hits_desc'): ?>hits_asc<?php else: ?>hits_desc<?php endif; ?>">閲覧回数</a></td>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['forum_info']['topics_list_lastpost'] == 'y'): ?>
  	<td class="heading"><a class="tableheading" href="tiki-view_forum.php?comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['comments_offset']; ?>
&amp;comments_sort_mode=<?php if ($this->_tpl_vars['comments_sort_mode'] == 'lastPost_desc'): ?>lastPost_asc<?php else: ?>lastPost_desc<?php endif; ?>">last post</a></td>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['forum_info']['topics_list_author'] == 'y'): ?>
  	<td class="heading"><a class="tableheading" href="tiki-view_forum.php?comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['comments_offset']; ?>
&amp;comments_sort_mode=<?php if ($this->_tpl_vars['comments_sort_mode'] == 'userName_desc'): ?>userName_asc<?php else: ?>userName_desc<?php endif; ?>" title="sort by">作者</a></td>
  <?php endif; ?>
</tr>
<?php echo smarty_function_cycle(array('values' => "odd,even",'print' => false), $this);?>

<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['comments_coms']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<?php if ($this->_tpl_vars['userinfo'] && $this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['lastPost'] > $this->_tpl_vars['userinfo']['lastLogin']): ?>
<?php $this->assign('newtopic', '_new'); ?>
<?php else: ?>
<?php $this->assign('newtopic', ""); ?>
<?php endif; ?>
<tr>
  <?php if ($this->_tpl_vars['tiki_p_admin_forum'] == 'y'): ?>
  <td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">
  	
	<input type="checkbox" name="forumtopic[]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['threadId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  <?php if ($_REQUEST['forumtopic'] && in_array ( $this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['threadId'] , $_REQUEST['forumtopic'] )): ?>checked="checked"<?php endif; ?> />
  </td>
  <?php endif; ?>	
  <td style="text-align:center;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">
  <?php if ($this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['type'] == 'n'): ?><img src="img/icons/folder<?php echo $this->_tpl_vars['newtopic']; ?>
.gif" alt="normal" /><?php endif; ?>
  <?php if ($this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['type'] == 'a'): ?><img src="img/icons/folder_announce<?php echo $this->_tpl_vars['newtopic']; ?>
.gif" alt="announce" /><?php endif; ?>
  <?php if ($this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['type'] == 'h'): ?><img src="img/icons/folder_hot<?php echo $this->_tpl_vars['newtopic']; ?>
.gif" alt="hot" /><?php endif; ?>
  <?php if ($this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['type'] == 's'): ?><img src="img/icons/folder_sticky<?php echo $this->_tpl_vars['newtopic']; ?>
.gif" alt="sticky" /><?php endif; ?>
  <?php if ($this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['type'] == 'l'): ?><img src="img/icons/folder_locked<?php echo $this->_tpl_vars['newtopic']; ?>
.gif" alt="locked" /><?php endif; ?>
  </td>
    
  
  <td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">
  <table width="100%"><tr><td>
  <a <?php if ($this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['is_marked']): ?>class="forumnameread"<?php else: ?>class="forumname"<?php endif; ?>  href="tiki-view_forum_thread.php?comments_parentId=<?php echo $this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['threadId']; ?>
&amp;topics_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;topics_offset=<?php echo smarty_function_math(array('equation' => "x + y",'x' => $this->_tpl_vars['comments_offset'],'y' => $this->_sections['ix']['index']), $this);?>
&amp;topics_sort_mode=<?php echo $this->_tpl_vars['comments_sort_mode']; ?>
&amp;topics_find=<?php echo $this->_tpl_vars['comments_find']; ?>
&amp;forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
"><?php echo $this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['title']; ?>
</a>
  <?php if ($this->_tpl_vars['forum_info']['topic_summary'] == 'y'): ?>
  <br /><small><?php echo ((is_array($_tmp=$this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['summary'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 240, "...", true) : smarty_modifier_truncate($_tmp, 240, "...", true)); ?>
</small>     
  <?php endif; ?>
  </td>
  
  <td style="text-align:right;" nowrap="nowrap">
  <?php if (count ( $this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['attachments'] ) || $this->_tpl_vars['tiki_p_admin_forum'] == 'y'): ?>
  <?php if (count ( $this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['attachments'] )): ?>
  	<img src='img/icons/attachment.gif' alt='attachments' />
  <?php endif; ?>
  <?php else: ?>
  	&nbsp;
  <?php endif; ?>

  <?php if ($this->_tpl_vars['tiki_p_admin_forum'] == 'y' || ( $this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['userName'] == $this->_tpl_vars['user'] && $this->_tpl_vars['tiki_p_forum_post'] == 'y' )): ?>
  <a href="tiki-view_forum.php?openpost=1&amp;comments_threadId=<?php echo $this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['threadId']; ?>
&amp;forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
&amp;comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['comments_offset']; ?>
&amp;comments_sort_mode=<?php echo $this->_tpl_vars['comments_sort_mode']; ?>
&amp;comments_maxComments=<?php echo $this->_tpl_vars['comments_maxComments']; ?>
"
     class="admlink"><?php echo smarty_function_html_image(array('file' => 'img/icons/edit.gif','border' => '0','alt' => '管理・編集','title' => '管理・編集'), $this);?>
</a>
   <?php endif; ?>
  <?php if ($this->_tpl_vars['tiki_p_admin_forum'] == 'y'): ?>
   <a href="tiki-view_forum.php?comments_remove=1&amp;comments_threadId=<?php echo $this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['threadId']; ?>
&amp;forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
&amp;comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['comments_offset']; ?>
&amp;comments_sort_mode=<?php echo $this->_tpl_vars['comments_sort_mode']; ?>
&amp;comments_maxComments=<?php echo $this->_tpl_vars['comments_maxComments']; ?>
"
     class="admlink"><img src="img/icons2/delete.gif" border="0" width="16" height="16"  alt='削除' title='削除' /></a>
  <?php endif; ?>

  </td>   
  
  </tr></table>
  </td>
  <?php if ($this->_tpl_vars['forum_info']['topics_list_replies'] == 'y'): ?>
  	<td style="text-align:right;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['replies']; ?>
</td>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['forum_info']['topics_list_reads'] == 'y'): ?>
  	<td style="text-align:right;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['hits']; ?>
</td>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['forum_info']['topics_list_lastpost'] == 'y'): ?>
  	  <td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['lastPost'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>
 
	  <?php if ($this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['replies']): ?>
	  <br />
	  <small><i><?php echo $this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['lastPostData']['title']; ?>
</i> by <?php echo $this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['lastPostData']['userName']; ?>
</small>     
	  <?php endif; ?>
	  </td>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['forum_info']['topics_list_author'] == 'y'): ?>
  	<td class="<?php echo smarty_function_cycle(array(), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['userName'])) ? $this->_run_mod_handler('userlink', true, $_tmp) : smarty_modifier_userlink($_tmp)); ?>
</td>
  <?php endif; ?>
</tr>
<?php endfor; else: ?>
<tr>
	<td class="odd" colspan="8">No topics yet</td>
</tr>
<?php endif; ?>
<?php if ($this->_tpl_vars['tiki_p_admin_forum'] == 'y'): ?>
	<tr>
		<td colspan='18'>&nbsp;</td>
	</tr>
	<tr>
		<td class="heading" colspan='18'>moderator actions</td>
	</tr>
	<tr>	
		<td class="odd" colspan="3">
		<input type="image" name="movesel" src="img/icons/topic_move.gif" border='0' alt='移動' title='move selected topics' />
		<input type="image" name="unlocksel" src="img/icons/topic_unlock.gif" border='0' alt='ロック解除' title='unlock selected topics' />
		<input type="image" name="locksel" src="img/icons/topic_lock.gif" border='0' alt='ロック' title='lock selected topics' />
		<input type="image" name="delsel" src="img/icons/topic_delete.gif" border='0' alt='削除' title='delete selected topics' />
		<input type="image" name="splitsel" src="img/icons/topic_split.gif" border='0' alt='merge' title='merge selected topics' />
		</td>
		<td style="text-align:right;" class="odd" colspan="10">
		<?php if ($this->_tpl_vars['reported'] > 0): ?>
		<small><a class="link" href="tiki-forums_reported.php?forumId=<?php echo $this->_tpl_vars['forumId']; ?>
">reported messages:<?php echo $this->_tpl_vars['reported']; ?>
</a></small><br />
		<?php endif; ?>
		<small><a class="link" href="tiki-forum_queue.php?forumId=<?php echo $this->_tpl_vars['forumId']; ?>
">queued messages:<?php echo $this->_tpl_vars['queued']; ?>
</a></small>
		</td>
	</tr>
	<?php if ($_REQUEST['movesel_x']): ?> 
	<tr>
		<td class="odd" colspan="18">
		Move to:
		<select name="moveto">
			<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['all_forums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<?php if ($this->_tpl_vars['all_forums'][$this->_sections['ix']['index']]['forumId'] != $this->_tpl_vars['forumId']): ?>
					<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['all_forums'][$this->_sections['ix']['index']]['forumId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo $this->_tpl_vars['all_forums'][$this->_sections['ix']['index']]['name']; ?>
</option>
				<?php endif; ?>
			<?php endfor; endif; ?>
		</select>
		<input type='submit' name='movesel' value='移動' />
		
		</td>
	</tr>
	<?php endif; ?>
	<?php if ($_REQUEST['splitsel_x']): ?> 
	<tr>
		<td class="odd" colspan="18">
		Merge into topic:
		<select name="mergetopic">
			<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['comments_coms']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<?php if (in_array ( $this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['threadId'] , $_REQUEST['forumtopic'] )): ?>
					<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['threadId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo $this->_tpl_vars['comments_coms'][$this->_sections['ix']['index']]['title']; ?>
</option>
				<?php endif; ?>
			<?php endfor; endif; ?>
		</select>
		<input type="submit" name="mergesel" value="merge" />
		</td>
	</tr>
	<?php endif; ?>
	
	<tr id='moveop' style="display:none;">
		<td class="odd" colspan="18">
			move
		</td>
	</tr>
<?php endif; ?>
</table>
</form>

  		<div class="paginacao">
			<?php if ($this->_tpl_vars['comments_prev_offset'] >= 0): ?>
				<a href="tiki-view_forum.php?forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
&amp;comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['comments_prev_offset']; ?>
&amp;comments_sort_mode=<?php echo $this->_tpl_vars['comments_sort_mode']; ?>
&amp;comments_maxComments=<?php echo $this->_tpl_vars['comments_maxComments']; ?>
">
					<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyLeft.png">
				</a>
			<?php endif; ?>
			
			ページ <?php echo $this->_tpl_vars['comments_actual_page']; ?>
 de <?php echo $this->_tpl_vars['comments_cant_pages']; ?>

			
			<?php if ($this->_tpl_vars['comments_next_offset'] >= 0): ?>
				<a class="prevnext" href="tiki-view_forum.php?forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
&amp;comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['comments_next_offset']; ?>
&amp;comments_sort_mode=<?php echo $this->_tpl_vars['comments_sort_mode']; ?>
&amp;comments_maxComments=<?php echo $this->_tpl_vars['comments_maxComments']; ?>
">
					<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyRight.png">
				</a>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['comments_pagination'] == 'y'): ?>
				<br />
				<?php unset($this->_sections['foo']);
$this->_sections['foo']['loop'] = is_array($_loop=$this->_tpl_vars['comments_cant_pages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
						<a href="tiki-view_forum.php?forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
&amp;comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['selector_offset']; ?>
&amp;comments_sort_mode=<?php echo $this->_tpl_vars['comments_sort_mode']; ?>
&amp;comments_maxComments=<?php echo $this->_tpl_vars['comments_maxComments']; ?>
">
					<?php echo $this->_sections['foo']['index_next']; ?>
</a>
				<?php endfor; endif; ?>
			<?php endif; ?>
		</div>
		
<?php if ($this->_tpl_vars['forum_info']['forum_last_n'] > 0): ?>
	
	<?php echo smarty_function_cycle(array('values' => "odd,even",'print' => false), $this);?>

	<table class="normal">
	<tr>
	 	<td class="heading">以前 <?php echo $this->_tpl_vars['forum_info']['forum_last_n']; ?>
 このフォーラムのトピック</td>
	 	<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['last_comments']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	 	<tr>
	 		<td class="<?php echo smarty_function_cycle(array(), $this);?>
">
	 		<?php if ($this->_tpl_vars['last_comments'][$this->_sections['ix']['index']]['parentId'] == 0): ?>
	 		 	<?php $this->assign('idt', $this->_tpl_vars['last_comments'][$this->_sections['ix']['index']]['threadId']); ?>
	 		<?php else: ?>
	 			<?php $this->assign('idt', $this->_tpl_vars['last_comments'][$this->_sections['ix']['index']]['parentId']); ?>
	 		<?php endif; ?>
	 		<a class="forumname" href="tiki-view_forum_thread.php?comments_parentId=<?php echo $this->_tpl_vars['idt']; ?>
&amp;topics_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;topics_offset=<?php echo smarty_function_math(array('equation' => "x + y",'x' => $this->_tpl_vars['comments_offset'],'y' => $this->_sections['ix']['index']), $this);?>
&amp;topics_sort_mode=<?php echo $this->_tpl_vars['comments_sort_mode']; ?>
&amp;topics_find=<?php echo $this->_tpl_vars['comments_find']; ?>
&amp;forumId=<?php echo $this->_tpl_vars['forum_info']['forumId']; ?>
"><?php echo $this->_tpl_vars['last_comments'][$this->_sections['ix']['index']]['title']; ?>
</a>
	 		</td>
	 	</tr>
	 	<?php endfor; endif; ?>
	</tr>
	</table>
	<br />
<?php endif; ?>

<table >  
<tr>
<td style="text-align:left;">

<form id='time_control' method="post" action="tiki-view_forum.php">
    <input type="hidden" name="comments_offset" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_offset'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    <input type="hidden" name="comments_threadId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_threadId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    <input type="hidden" name="comments_threshold" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_threshold'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    <input type="hidden" name="comments_sort_mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_sort_mode'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    <input type="hidden" name="forumId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['forumId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    <small>Show posts:</small>
    <select name="time_control" onchange="javascript:document.getElementById('time_control').submit();">
    	<option value="" <?php if ($_REQUEST['time_control'] == ''): ?>selected="selected"<?php endif; ?>>全ポスト</option>
    	<option value="3600" <?php if ($_REQUEST['time_control'] == 3600): ?>selected="selected"<?php endif; ?>>Last hour</option>
    	<option value="86400" <?php if ($_REQUEST['time_control'] == 86400): ?>selected="selected"<?php endif; ?>>Last 24 hours</option>
    	<option value="172800" <?php if ($_REQUEST['time_control'] == 172800): ?>selected="selected"<?php endif; ?>>Last 48 hours</option>
    </select>
</form>
</td>
<td style="text-align:right;">
<?php if ($this->_tpl_vars['feature_forum_quickjump'] == 'y'): ?>
<form id='quick' method="post" action="tiki-view_forum.php">
<small>フォーラムへ移動:</small>
<select name="forumId" onchange="javascript:document.getElementById('quick').submit();">
<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['all_forums']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['all_forums'][$this->_sections['ix']['index']]['forumId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['all_forums'][$this->_sections['ix']['index']]['forumId'] == $this->_tpl_vars['forumId']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['all_forums'][$this->_sections['ix']['index']]['name']; ?>
</option>
<?php endfor; endif; ?>
</select>
</form>
<?php else: ?>
&nbsp;
<?php endif; ?>
</td>
</tr>
</table>



</div>