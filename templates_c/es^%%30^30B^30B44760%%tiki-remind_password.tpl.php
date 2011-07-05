<?php /* Smarty version 2.6.18, created on 2011-04-10 19:15:23
         compiled from tiki-remind_password.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'tiki-remind_password.tpl', 5, false),)), $this); ?>
<h1>Olvide mi contraseña</h1>

<?php if ($this->_tpl_vars['showmsg'] != 'n'): ?>
  <?php if ($this->_tpl_vars['showmsg'] == 'e'): ?><span class="warn"><?php endif; ?>
  <?php echo ((is_array($_tmp=$this->_tpl_vars['msg'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

  <?php if ($this->_tpl_vars['showmsg'] == 'e'): ?></span><?php endif; ?>
  <br /><br />
<?php endif; ?>

<?php if ($this->_tpl_vars['showfrm'] == 'y'): ?>
  <form action="tiki-remind_password.php" method="post">
  <table class="normal">
  <tr>
    <td class="formcolor">usuario</td>
    <td class="formcolor"><input type="text" name="username" /></td>
    <td class="formcolor"><input type="submit" name="remind"
                                 value="enviar mi contraseña" /></td>
  </tr>  
  </table>
  </form>
<?php endif; ?>
Important: Username & password are CaSe SenSitiVe

<br /><br />
<a href="<?php echo $this->_tpl_vars['tikiIndex']; ?>
" class="link">Regresar al inicio</a>