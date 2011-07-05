<?php /* Smarty version 2.6.18, created on 2011-04-21 19:30:49
         compiled from styles/bolha/comment_post.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/comment_post.tpl', 1, false),array('modifier', 'escape', 'styles/bolha/comment_post.tpl', 54, false),)), $this); ?>
<?php echo smarty_function_css(array(), $this);?>

<?php $this->assign('postclass', 'comzone'); ?>
<?php if ($this->_tpl_vars['user']): ?>
   <?php if ($this->_tpl_vars['forum_mode'] == 'y'): ?>
		<?php if ($this->_tpl_vars['post_reply'] > 0 || $this->_tpl_vars['edit_reply'] > 0 || $this->_tpl_vars['comment_preview'] == 'y'): ?>
			
			<div id='<?php echo $this->_tpl_vars['postclass']; ?>
' class="threadpost" >
		<?php else: ?>
			<div id='<?php echo $this->_tpl_vars['postclass']; ?>
' class="threadpost" style="display:none">
		<?php endif; ?>
   <?php endif; ?>
	<a name="form"></a>
   	<div class="comMainTitle">
		    <?php if ($this->_tpl_vars['forum_mode'] == 'y'): ?>
			    <?php if ($this->_tpl_vars['comments_threadId'] > 0): ?>
			    	Modifier la réponse
			    <?php elseif ($this->_tpl_vars['parent_com']): ?>
			    	Répondre au message sélectionné
		    	<?php else: ?>
		    		Publier un nouveau message
		    	<?php endif; ?>
	    	<?php else: ?>
		    	<?php if ($this->_tpl_vars['comments_threadId'] > 0): ?>
		    		Modifier le commentaire sélectionné
		    	<?php elseif ($this->_tpl_vars['parent_com']): ?>
		    		Répondre au commentaire sélectionné
		    	<?php else: ?>
		    		Publier un nouveau commentaire
		    	<?php endif; ?>
		    <?php endif; ?>
   	</div>
<div id="comPostCont">
	<?php if ($this->_tpl_vars['comment_preview'] == 'y'): ?>
		Aperçu
		<div class="commPreview">
			<?php 
			 	global $smarty;
				$vars=$smarty->_tpl_vars;
				
				$useComm = array( "title" => $vars["comments_preview_title"],
						   		  "commentDate" => time(),
							      "parsed" => $vars["comments_preview_data"],
							      "userName" => $vars["user"]
				);
				
				$smarty->assign('useComm',$useComm);
			 ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "comment_item.tpl", 'smarty_include_vars' => array('previewingComm' => 1,'comment' => $this->_tpl_vars['useComm'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	<?php endif; ?>


    <form enctype="multipart/form-data" method="post" action="<?php echo $this->_tpl_vars['comments_father']; ?>
" id='editpostform'>
	    <input type="hidden" name="comments_reply_threadId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_reply_threadId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />    
	    <input type="hidden" name="comments_grandParentId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_grandParentId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />    
	    <input type="hidden" name="comments_parentId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_parentId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	    <input type="hidden" name="comments_offset" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_offset'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	    <input type="hidden" name="comments_threadId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_threadId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	    <input type="hidden" name="comments_threshold" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_threshold'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	    <input type="hidden" name="comments_sort_mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comments_sort_mode'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	    
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
  		
  		<?php if ($this->_tpl_vars['parent_coms']): ?>
				Répondre à un message parent
		<?php else: ?>
				<?php if ($this->_tpl_vars['forum_mode'] == 'y'): ?>
					Répondre
				<?php endif; ?>
		<?php endif; ?>
		
		<h3>Titre</h3>
  		<input type="text" size="40" name="comments_title" id="comments-title" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['comment_title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />

  		

		<?php if ($this->_tpl_vars['quicktags']): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-edit_help_tool.tpl", 'smarty_include_vars' => array('area_name' => 'editpost2')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      	<?php endif; ?>

      	<br>
      	
	   	<h3>
	   	<?php if ($this->_tpl_vars['forum_mode'] == 'y'): ?>
	      	Répondre
	   	<?php else: ?>
	      	Commentaire
	   	<?php endif; ?>
	   	</h3>
  		<textarea id="editpost2" name="comments_data" rows="<?php echo $this->_tpl_vars['rows']; ?>
" cols="<?php echo $this->_tpl_vars['cols']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['comment_data'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
  				
		<input type="hidden" name="rows" value="<?php echo $this->_tpl_vars['rows']; ?>
"/>
		<input type="hidden" name="cols" value="<?php echo $this->_tpl_vars['cols']; ?>
"/>

		<?php if ($this->_tpl_vars['forum_mode'] == 'y' && ( ( $this->_tpl_vars['forum_info']['att'] == 'att_all' ) || ( $this->_tpl_vars['forum_info']['att'] == 'att_admin' && ( $this->_tpl_vars['tiki_p_admin_forum'] == 'y' || $this->_tpl_vars['forum_info']['moderator'] == $this->_tpl_vars['user'] ) ) || ( $this->_tpl_vars['forum_info']['att'] == 'att_perm' && $this->_tpl_vars['tiki_p_forum_attach'] == 'y' ) )): ?>
			Joindre un fichier
			<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['forum_info']['att_max_size'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
			<input name="userfile1" type="file" />
		<?php endif; ?>
		<div id="comButtons">
			<input type="submit" name="comments_previewComment" value="Aperçu"/>
			<input type="submit" name="comments_postComment" value="publier"/>
			
			<?php if ($this->_tpl_vars['forum_mode'] == 'y'): ?>
				<input type="button" name="comments_cancelComment" value="annuler" onclick="hide('<?php echo $this->_tpl_vars['postclass']; ?>
');"/>
		    <?php endif; ?>
	    </div>

    </form>

  	<?php if ($this->_tpl_vars['forum_mode'] == 'y'): ?>
	  	Publier des réponses:
  	<?php else: ?>
	  	Publier des commentaires:
  	<?php endif; ?>

	Utilisation [http://www.foo.com] ou [http://www.foo.com|description] pour les liens.<br />
	Les balises HTML sont 
interdites dans les messages.<br />

	<?php if ($this->_tpl_vars['forum_mode'] == 'y'): ?>
    	</div>
	<?php endif; ?>
</div>
<?php endif; ?>