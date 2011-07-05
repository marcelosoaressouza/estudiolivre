<?php /* Smarty version 2.6.18, created on 2011-04-21 19:30:49
         compiled from styles/bolha/comments.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/comments.tpl', 1, false),array('modifier', 'escape', 'styles/bolha/comments.tpl', 21, false),array('modifier', 'replace', 'styles/bolha/comments.tpl', 88, false),array('modifier', 'times', 'styles/bolha/comments.tpl', 102, false),)), $this); ?>
<?php echo smarty_function_css(array('extra' => 'list'), $this);?>

<?php if ($this->_tpl_vars['forum_mode'] == 'y'): ?>
    <tr>
    <td>
<?php else: ?>
    <a name="comments"></a>
    <div id="comzone"
    <?php if ($this->_tpl_vars['comments_show'] == 'y'): ?>
		>
    <?php else: ?>
		style="display:none">
    <?php endif; ?>
<?php endif; ?>



<?php if (( $this->_tpl_vars['tiki_p_read_comments'] == 'y' && $this->_tpl_vars['forum_mode'] != 'y' ) || ( $this->_tpl_vars['tiki_p_forum_read'] == 'y' && $this->_tpl_vars['forum_mode'] == 'y' )): ?>
	<?php if ($this->_tpl_vars['comments_cant'] > 0): ?>
		<form method="post" action="<?php echo $this->_tpl_vars['comments_father']; ?>
" class="comments">
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['comments_request_data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
				<input type="hidden" name="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_request_data'][$this->_sections['i']['index']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_request_data'][$this->_sections['i']['index']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
			<?php endfor; endif; ?>
			<input type="hidden" name="comments_parentId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_parentId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />    
			<input type="hidden" name="comments_grandParentId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_grandParentId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />    
			<input type="hidden" name="comments_reply_threadId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_reply_threadId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />    
			<input type="hidden" name="comments_offset" value="0" />
			<input type="hidden" name="topics_offset" value="<?php echo ((is_array($_tmp=$_REQUEST['topics_offset'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
			<input type="hidden" name="topics_find" value="<?php echo ((is_array($_tmp=$_REQUEST['topics_find'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
			<input type="hidden" name="topics_sort_mode" value="<?php echo ((is_array($_tmp=$_REQUEST['topics_sort_mode'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
			<input type="hidden" name="topics_threshold" value="<?php echo ((is_array($_tmp=$_REQUEST['topics_threshold'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
			<input type="hidden" name="forumId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['forumId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
			<?php if ($this->_tpl_vars['tiki_p_admin_forum'] == 'y' && $this->_tpl_vars['forum_mode'] == 'y'): ?>
				<table class="normal">
					<tr>
						<td colspan="3" class="heading">Actions du modérateur</td>
					</tr>
					<tr>
						<td class="odd">
							<input type="submit" name="delsel" value="effacer les sélectionnés" />
						</td>
					</tr>
					<tr>
						<td class="odd">
							Déplacer vers le sujet :
							<select name="moveto" style="width:70%">
								<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['topics']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
									<?php if ($this->_tpl_vars['topics'][$this->_sections['ix']['index']]['threadId'] != $this->_tpl_vars['comments_parentId']): ?>
										<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['topics'][$this->_sections['ix']['index']]['threadId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo $this->_tpl_vars['topics'][$this->_sections['ix']['index']]['title']; ?>
</option>
									<?php endif; ?>
								<?php endfor; endif; ?>
							</select>
							<input type="submit" name="movesel" value="déplacer" />
						</td>
						<td style="text-align:right;" class="odd">
							<?php if ($this->_tpl_vars['reported'] > 0): ?>
								<a class="link" href="tiki-forums_reported.php?forumId=<?php echo $this->_tpl_vars['forumId']; ?>
">
									dénoncé :<?php echo $this->_tpl_vars['reported']; ?>

								</a>
								|
							<?php endif; ?>
							<a class="link" href="tiki-forum_queue.php?forumId=<?php echo $this->_tpl_vars['forumId']; ?>
">
								en attente :<?php echo $this->_tpl_vars['queued']; ?>

							</a>
						</td>
					</tr>
				</table>
			<?php endif; ?>
			<div class="comMainTitle">
				Comentários
			</div>
			
				<?php unset($this->_sections['rep']);
$this->_sections['rep']['name'] = 'rep';
$this->_sections['rep']['loop'] = is_array($_loop=$this->_tpl_vars['comments_coms']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rep']['show'] = true;
$this->_sections['rep']['max'] = $this->_sections['rep']['loop'];
$this->_sections['rep']['step'] = 1;
$this->_sections['rep']['start'] = $this->_sections['rep']['step'] > 0 ? 0 : $this->_sections['rep']['loop']-1;
if ($this->_sections['rep']['show']) {
    $this->_sections['rep']['total'] = $this->_sections['rep']['loop'];
    if ($this->_sections['rep']['total'] == 0)
        $this->_sections['rep']['show'] = false;
} else
    $this->_sections['rep']['total'] = 0;
if ($this->_sections['rep']['show']):

            for ($this->_sections['rep']['index'] = $this->_sections['rep']['start'], $this->_sections['rep']['iteration'] = 1;
                 $this->_sections['rep']['iteration'] <= $this->_sections['rep']['total'];
                 $this->_sections['rep']['index'] += $this->_sections['rep']['step'], $this->_sections['rep']['iteration']++):
$this->_sections['rep']['rownum'] = $this->_sections['rep']['iteration'];
$this->_sections['rep']['index_prev'] = $this->_sections['rep']['index'] - $this->_sections['rep']['step'];
$this->_sections['rep']['index_next'] = $this->_sections['rep']['index'] + $this->_sections['rep']['step'];
$this->_sections['rep']['first']      = ($this->_sections['rep']['iteration'] == 1);
$this->_sections['rep']['last']       = ($this->_sections['rep']['iteration'] == $this->_sections['rep']['total']);
?>
					<div id="comzoneItems">
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "comment_item.tpl", 'smarty_include_vars' => array('comment' => $this->_tpl_vars['comments_coms'][$this->_sections['rep']['index']])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					</div>
			  	<?php endfor; endif; ?>
		</form>
	
		<br />
	
		<div>
	  		<?php if ($this->_tpl_vars['comments_threshold'] != 0): ?>
	  			<?php echo $this->_tpl_vars['comments_below']; ?>
&nbsp;<?php if ($this->_tpl_vars['comments_below'] == 1): ?>répondre<?php else: ?>réponses<?php endif; ?> en dessous de votre seuil courant
			<?php endif; ?>
	  		<div class="paginacao">
				<?php if ($this->_tpl_vars['comments_prev_offset'] >= 0): ?>
					<a class="prevnext" href="<?php echo $this->_tpl_vars['comments_complete_father']; ?>
comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;comments_parentId=<?php echo $this->_tpl_vars['comments_parentId']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['comments_prev_offset']; ?>
<?php echo $this->_tpl_vars['comments_sort_mode_param']; ?>
&amp;comments_maxComments=<?php echo $this->_tpl_vars['comments_maxComments']; ?>
&amp;comments_style=<?php echo $this->_tpl_vars['comments_style']; ?>
">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyLeft.png">
					</a>
				<?php endif; ?>
				
				Page <?php echo $this->_tpl_vars['comments_actual_page']; ?>
 de <?php echo $this->_tpl_vars['comments_cant_pages']; ?>

				
				<?php if ($this->_tpl_vars['comments_next_offset'] >= 0): ?>
					<a class="prevnext" href="<?php echo $this->_tpl_vars['comments_complete_father']; ?>
comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;comments_parentId=<?php echo $this->_tpl_vars['comments_parentId']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['comments_next_offset']; ?>
<?php echo $this->_tpl_vars['comments_sort_mode_param']; ?>
&amp;comments_maxComments=<?php echo $this->_tpl_vars['comments_maxComments']; ?>
&amp;comments_style=<?php echo $this->_tpl_vars['comments_style']; ?>
">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyRight.png">
					</a>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['direct_pagination'] == 'y'): ?>
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
						<?php $this->assign('selector_offset', ((is_array($_tmp=$this->_sections['foo']['index'])) ? $this->_run_mod_handler('times', true, $_tmp, $this->_tpl_vars['comments_maxComments']) : smarty_modifier_times($_tmp, $this->_tpl_vars['comments_maxComments']))); ?>
							<a class="prevnext" href="<?php echo $this->_tpl_vars['comments_complete_father']; ?>
comments_threshold=<?php echo $this->_tpl_vars['comments_threshold']; ?>
&amp;comments_parentId=<?php echo $this->_tpl_vars['comments_parentId']; ?>
&amp;comments_offset=<?php echo $this->_tpl_vars['selector_offset']; ?>
<?php echo $this->_tpl_vars['comments_sort_mode_param']; ?>
&amp;comments_maxComments=<?php echo $this->_tpl_vars['comments_maxComments']; ?>
&amp;comments_style=<?php echo $this->_tpl_vars['comments_style']; ?>
">
						<?php echo $this->_sections['foo']['index_next']; ?>
</a>
					<?php endfor; endif; ?>
				<?php endif; ?>
			</div>		
			<br />
		</div>  
	<?php endif; ?>
<?php endif; ?>




	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "comment_post.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>



<?php if ($this->_tpl_vars['forum_mode'] == 'y'): ?>
    </td>
    </tr>
<?php else: ?>
    </div>
<?php endif; ?>