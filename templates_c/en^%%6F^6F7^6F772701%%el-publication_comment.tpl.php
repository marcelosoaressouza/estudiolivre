<?php /* Smarty version 2.6.18, created on 2011-04-04 17:12:11
         compiled from el-publication_comment.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'el-publication_comment.tpl', 8, false),array('modifier', 'date_format', 'el-publication_comment.tpl', 12, false),)), $this); ?>
<div id="ajax-commentCont-<?php echo $this->_tpl_vars['comment']->id; ?>
" class="uMsgItem">
	<div class="uMsgAvatar">
		<img src="tiki-show_user_avatar.php?user=<?php echo $this->_tpl_vars['comment']->user; ?>
">
	</div>
	<div class="uMsgTxt">
		<?php if ($this->_tpl_vars['user'] == $this->_tpl_vars['comment']->user): ?>
		<div class="uMsgDel">
			<img class="pointer" alt="Deletar Mensagem" title="Deletar Mensagem" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iDelete.png" onClick="xajax_deleteComment(<?php echo $this->_tpl_vars['comment']->id; ?>
)"/>
		</div>
		<?php endif; ?>
		<div class="uMsgDate">
			<?php echo ((is_array($_tmp=$this->_tpl_vars['comment']->date)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
<br />
			<?php echo ((is_array($_tmp=$this->_tpl_vars['comment']->date)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%y") : smarty_modifier_date_format($_tmp, "%d/%m/%y")); ?>

		</div>
		<a href="el-user.php?view_user=<?php echo $this->_tpl_vars['comment']->user; ?>
"><?php echo $this->_tpl_vars['comment']->user; ?>
</a>: <?php echo $this->_tpl_vars['comment']->comment; ?>

	</div>
</div>