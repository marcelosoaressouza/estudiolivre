<?php /* Smarty version 2.6.18, created on 2011-05-03 19:41:11
         compiled from modules/mod-who_is_there.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tikimodule', 'modules/mod-who_is_there.tpl', 3, false),array('function', 'math', 'modules/mod-who_is_there.tpl', 25, false),array('modifier', 'userlink', 'modules/mod-who_is_there.tpl', 26, false),)), $this); ?>


<?php $this->_tag_stack[] = array('tikimodule', array('title' => "Usuári@s on-line",'name' => 'who_is_there','flip' => $this->_tpl_vars['module_params']['flip'],'decorations' => $this->_tpl_vars['module_params']['decorations'])); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<div>
<?php if ($this->_tpl_vars['cluster']): ?>
<?php $_from = $this->_tpl_vars['logged_cluster_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tikihost'] => $this->_tpl_vars['cant']):
?>
<?php echo $this->_tpl_vars['cant']; ?>

<?php if ($this->_tpl_vars['cant'] > 1): ?>
usuári@s on-line
<?php elseif ($this->_tpl_vars['cant'] > 0): ?>
usuário on-line
<?php endif; ?>
no servidor <?php echo $this->_tpl_vars['tikihost']; ?>

</div>
<?php endforeach; endif; unset($_from); ?>
<?php $_from = $this->_tpl_vars['online_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ix'] => $this->_tpl_vars['online_user']):
?>
<?php if ($this->_tpl_vars['user'] && $this->_tpl_vars['feature_messages'] == 'y' && $this->_tpl_vars['tiki_p_messages'] == 'y'): ?>
<?php if ($this->_tpl_vars['online_user']['allowMsgs'] == 'n'): ?>
<img src="img/icons/icon_ultima_no.gif" width="18" height="9" hspace="2" vspace="0" border="0" alt="-&gt;" />
<?php else: ?>
<a class="linkmodule" href="messu-compose.php?to=<?php echo $this->_tpl_vars['online_user']['user']; ?>
" title="Enviar uma mensagem para <?php echo $this->_tpl_vars['online_user']['user']; ?>
"><img src="img/icons/icon_ultima.gif" width="18" height="9" hspace="2" vspace="0" border="0" alt="Enviar mensagem" /></a>
<?php endif; ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['online_user']['user_information'] == 'public'): ?>
<?php echo smarty_function_math(array('equation' => "x - y",'x' => time(),'y' => $this->_tpl_vars['online_user']['timestamp'],'assign' => 'idle'), $this);?>

<?php echo ((is_array($_tmp=$this->_tpl_vars['online_user']['user'])) ? $this->_run_mod_handler('userlink', true, $_tmp, 'linkmodule', $this->_tpl_vars['idle']) : smarty_modifier_userlink($_tmp, 'linkmodule', $this->_tpl_vars['idle'])); ?>

<?php else: ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['online_user']['user'])) ? $this->_run_mod_handler('userlink', true, $_tmp, 'linkmodule') : smarty_modifier_userlink($_tmp, 'linkmodule')); ?>

<?php endif; ?>
(<?php echo $this->_tpl_vars['online_user']['tikihost']; ?>
)<br />
<?php endforeach; endif; unset($_from); ?>
<?php else: ?>
<?php echo $this->_tpl_vars['logged_users']; ?>
 
<?php if ($this->_tpl_vars['logged_users'] > 1): ?>
usuári@s on-line
<?php elseif ($this->_tpl_vars['logged_users'] > 0): ?>
usuário on-line
<?php endif; ?>
</div>
<?php $_from = $this->_tpl_vars['online_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ix'] => $this->_tpl_vars['online_user']):
?>
<?php if ($this->_tpl_vars['user'] && $this->_tpl_vars['feature_messages'] == 'y' && $this->_tpl_vars['tiki_p_messages'] == 'y'): ?>
<?php if ($this->_tpl_vars['online_user']['allowMsgs'] == 'n'): ?>
<img src="img/icons/icon_ultima_no.gif" width="18" height="9" hspace="2" vspace="0" border="0" alt="-&gt;" />
<?php else: ?>
<a class="linkmodule" href="messu-compose.php?to=<?php echo $this->_tpl_vars['online_user']['user']; ?>
" title="Enviar uma mensagem para <?php echo $this->_tpl_vars['online_user']['user']; ?>
"><img src="img/icons/icon_ultima.gif" width="18" height="9" hspace="2" vspace="0" border="0" alt="Enviar mensagem" /></a>
<?php endif; ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['online_user']['user_information'] == 'public'): ?>
<?php echo smarty_function_math(array('equation' => "x - y",'x' => time(),'y' => $this->_tpl_vars['online_user']['timestamp'],'assign' => 'idle'), $this);?>

<?php echo ((is_array($_tmp=$this->_tpl_vars['online_user']['user'])) ? $this->_run_mod_handler('userlink', true, $_tmp, 'linkmodule', $this->_tpl_vars['idle']) : smarty_modifier_userlink($_tmp, 'linkmodule', $this->_tpl_vars['idle'])); ?>
<br />
<?php else: ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['online_user']['user'])) ? $this->_run_mod_handler('userlink', true, $_tmp, 'linkmodule') : smarty_modifier_userlink($_tmp, 'linkmodule')); ?>
<br />
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
