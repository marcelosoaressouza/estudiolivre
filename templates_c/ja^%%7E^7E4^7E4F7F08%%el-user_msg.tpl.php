<?php /* Smarty version 2.6.18, created on 2011-04-04 17:51:46
         compiled from el-user_msg.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'el-user_msg.tpl', 1, false),array('block', 'tooltip', 'el-user_msg.tpl', 15, false),array('modifier', 'replace', 'el-user_msg.tpl', 17, false),array('modifier', 'date_format', 'el-user_msg.tpl', 23, false),)), $this); ?>
<?php echo smarty_function_css(array(), $this);?>

<?php $_from = $this->_tpl_vars['userMessages']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['msg']):
?>
	<div 
		class="uMsgItem<?php if ($this->_tpl_vars['msg']['isRead'] != 'y'): ?> uUnreadMsgItem"<?php else: ?> "<?php endif; ?>
		<?php if ($this->_tpl_vars['msg']['isRead'] != 'y' && $this->_tpl_vars['permission']): ?>
			onmouseover="xajax_markMsgRead(<?php echo $this->_tpl_vars['msg']['msgId']; ?>
);setTimeout('nd();',2000);tooltip('Marcando mensagem <?php echo $this->_tpl_vars['msg']['msgId']; ?>
 como <b>lida</b>');"
		<?php endif; ?>
	>
    	<div class="uMsgAvatar">
        	<img alt="" title="" src="tiki-show_user_avatar.php?user=<?php echo $this->_tpl_vars['msg']['user_from']; ?>
">
        </div>
	<div class="uMsgTxt">
		<div class="uMsgDel">
        	<?php if ($this->_tpl_vars['permission'] || $this->_tpl_vars['user'] == $this->_tpl_vars['msg']['user_from']): ?>
        	 <?php $this->_tag_stack[] = array('tooltip', array('text' => 'Deletar Mensagem')); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        	 	<a class="pointer" onClick="xajax_delMsg('<?php echo $this->_tpl_vars['msg']['user_from']; ?>
', <?php echo $this->_tpl_vars['msg']['msgId']; ?>
)">
        	 		<img alt="" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iDelete.png">
        	 	</a>
        	 <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        	<?php endif; ?>
        </div>
        	<div class="uMsgDate">
              <?php echo ((is_array($_tmp=$this->_tpl_vars['msg']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M") : smarty_modifier_date_format($_tmp, "%H:%M")); ?>
<br />
              <?php echo ((is_array($_tmp=$this->_tpl_vars['msg']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>

            </div>
            <a href="el-user.php?view_user=<?php echo $this->_tpl_vars['msg']['user_from']; ?>
"><?php echo $this->_tpl_vars['msg']['user_from']; ?>
</a>: <?php echo $this->_tpl_vars['msg']['body']; ?>

        </div>
	</div>
<?php endforeach; else: ?>
Seja @ primeir@ a enviar uma mensagem para esse(a) usuári@!<br/>
<?php endif; unset($_from); ?>

<div id="uMsgSend">
<?php if ($this->_tpl_vars['user']): ?>
	<form onSubmit="sendMsg(); return false;">
		<input type="submit" name="" value="enviar" label="enviar" id="uMsgSendSubmit" onClick="sendMsg()">
	   	<input type="text" id="uMsgSendInput">
	</form>
<?php else: ?>
	Você não pode enviar recados pois não está logado no site.
<?php endif; ?>
</div>