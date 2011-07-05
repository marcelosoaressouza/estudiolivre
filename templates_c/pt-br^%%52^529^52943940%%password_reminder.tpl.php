<?php /* Smarty version 2.6.18, created on 2011-04-08 19:35:01
         compiled from mail/password_reminder.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'mail/password_reminder.tpl', 9, false),)), $this); ?>
Olá <?php echo $this->_tpl_vars['mail_user']; ?>
,

Alguém acessando do endereço IP <?php echo $this->_tpl_vars['mail_ip']; ?>
 <?php if ($this->_tpl_vars['clearpw'] == 'y'): ?>solicitou um lembrete de senha da sua conta<?php else: ?>solicitou que a senha para sua conta fosse recriada <?php endif; ?> (<?php echo $this->_tpl_vars['mail_site']; ?>
).

<?php if ($this->_tpl_vars['clearpw'] == 'y'): ?>
Sendo esse o seu endereço eletrônico a sua senha é <?php echo $this->_tpl_vars['mail_pass']; ?>

<?php else: ?>
Clique no link a seguir para confirmar que você deseja uma nova senhae vá para a página onde você deve escolher uma nova senha. Escolha uma senha que apenas você saiba e não compartilhe com ninguém.
<?php echo $this->_tpl_vars['mail_machine']; ?>
/tiki-remind_password.php?user=<?php echo ((is_array($_tmp=$this->_tpl_vars['mail_user'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&actpass=<?php echo $this->_tpl_vars['mail_apass']; ?>


Pronto! Você já deve estar logado.

Importante: Usuário e senha são sensíveis a caixa ALTA/baixa

Importante: a senha velha permanecerá ativa se você não clicar no link acima.
<?php endif; ?>