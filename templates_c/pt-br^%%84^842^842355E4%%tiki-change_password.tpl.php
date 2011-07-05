<?php /* Smarty version 2.6.18, created on 2011-04-19 20:26:59
         compiled from tiki-change_password.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'tiki-change_password.tpl', 6, false),)), $this); ?>
<h1>Alteração obrigatória de senha</h1>
<form method="post" action="tiki-change_password.php" >
<table class="normal">
<tr>
  <td class="formcolor">Usuári@:</td>
  <td class="formcolor"><input type="text" name="user" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['user'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></td>
</tr>  
<tr>
  <td class="formcolor">Senha antiga:</td>
  <td class="formcolor"><input type="password" name="oldpass" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['oldpass'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></td>
</tr>     
<tr>
  <td class="formcolor">Nova senha:</td>
  <td class="formcolor"><input type="password" name="pass" /></td>
</tr>  
<tr>
  <td class="formcolor">Confirmar:</td>
  <td class="formcolor"><input type="password" name="pass2" /></td>
</tr>  
<tr>
  <td class="formcolor">&nbsp;</td>
  <td class="formcolor"><input type="submit" name="change" value="alterar" /></td>
</tr>  
</table>
</form>