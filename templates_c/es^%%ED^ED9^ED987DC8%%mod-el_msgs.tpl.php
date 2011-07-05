<?php /* Smarty version 2.6.18, created on 2011-06-18 03:40:25
         compiled from modules/mod-el_msgs.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tikimodule', 'modules/mod-el_msgs.tpl', 5, false),array('modifier', 'date_format', 'modules/mod-el_msgs.tpl', 11, false),array('modifier', 'truncate', 'modules/mod-el_msgs.tpl', 12, false),)), $this); ?>


<?php if ($this->_tpl_vars['mod_allowMsgs']): ?>
<div id="ajax-mod-el_msgs">
	<?php $this->_tag_stack[] = array('tikimodule', array('title' => "Mensajes (".($this->_tpl_vars['modUnread']).")",'name' => 'messages_unread_messages','flip' => $this->_tpl_vars['module_params']['flip'],'decorations' => $this->_tpl_vars['module_params']['decorations'])); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<?php if ($this->_tpl_vars['modUnread'] > 0): ?>
			<?php $_from = $this->_tpl_vars['mod_userMessages']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['mod_msg']):
?>
				<a href="el-user.php?view_user=<?php echo $this->_tpl_vars['mod_msg']['user_from']; ?>
">
					<?php echo $this->_tpl_vars['mod_msg']['user_from']; ?>

				</a>:
				<a href="el-user.php?view_user=<?php echo $this->_tpl_vars['user']; ?>
#messages" class="mod-el_msg-msg" onmouseover="tooltip('Enviada às: <i><?php echo ((is_array($_tmp=$this->_tpl_vars['mod_msg']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M - %d/%m") : smarty_modifier_date_format($_tmp, "%H:%M - %d/%m")); ?>
</i>');" onmouseout="nd();">
					<?php echo ((is_array($_tmp=$this->_tpl_vars['mod_msg']['body'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "(..)") : smarty_modifier_truncate($_tmp, 20, "(..)")); ?>

				</a>

				<br>
			<?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
			No new messages
		<?php endif; ?>
		<div class="modViewAll"><a href="el-user.php?view_user=<?php echo $this->_tpl_vars['user']; ?>
#messages">ver todas</a></div>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</div>
<?php endif; ?>