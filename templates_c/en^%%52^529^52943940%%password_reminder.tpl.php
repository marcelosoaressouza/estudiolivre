<?php /* Smarty version 2.6.18, created on 2011-06-08 09:40:57
         compiled from mail/password_reminder.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'mail/password_reminder.tpl', 8, false),array('modifier', 'escape', 'mail/password_reminder.tpl', 9, false),)), $this); ?>
Hi <?php echo $this->_tpl_vars['mail_user']; ?>
,

Someone coming from IP Address <?php echo $this->_tpl_vars['mail_ip']; ?>
 <?php if ($this->_tpl_vars['clearpw'] == 'y'): ?>requested a reminder of the password for your account<?php else: ?>requested password reset for your account <?php endif; ?> (<?php echo $this->_tpl_vars['mail_site']; ?>
).

<?php if ($this->_tpl_vars['clearpw'] == 'y'): ?>
Since this is your registered email address we inform that the password for this account is <?php echo $this->_tpl_vars['mail_pass']; ?>

<?php else: ?>
<?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Please click on the following link to confirm you wish to reset your password and go to the screen where you must enter a new "permanent" password. Please pick a password only you will know, and don't share it with anyone else.
<?php echo $this->_tpl_vars['mail_machine']; ?>
/tiki-remind_password.php?user=<?php echo ((is_array($_tmp=$this->_tpl_vars['mail_user'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&actpass=<?php echo $this->_tpl_vars['mail_apass']; ?>


Done! You should be logged in.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

Important: Username & password are CaSe SenSitiVe

Important: The old password remains active if you don't click the link above.
<?php endif; ?>