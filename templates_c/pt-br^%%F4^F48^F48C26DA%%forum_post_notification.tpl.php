<?php /* Smarty version 2.6.18, created on 2011-06-23 14:06:11
         compiled from mail/forum_post_notification.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'tiki_short_datetime', 'mail/forum_post_notification.tpl', 6, false),)), $this); ?>
Uma nova mensagem foi enviada ao fórum: <?php echo $this->_tpl_vars['mail_forum']; ?>


<?php if ($this->_tpl_vars['new_topic']): ?>Novo tópico:<?php else: ?>Tópico:<?php endif; ?> <?php echo $this->_tpl_vars['mail_topic']; ?>

Autor: <?php echo $this->_tpl_vars['mail_author']; ?>

Título: <?php echo $this->_tpl_vars['mail_title']; ?>

Data: <?php echo ((is_array($_tmp=$this->_tpl_vars['mail_date'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>

<?php echo $this->_tpl_vars['mail_machine']; ?>
/tiki-view_forum_thread.php?forumId=<?php echo $this->_tpl_vars['forumId']; ?>
&comments_parentId=<?php echo $this->_tpl_vars['topicId']; ?>
<?php if ($this->_tpl_vars['threadId']): ?>#threadId<?php echo $this->_tpl_vars['threadId']; ?>
<?php endif; ?>

Mensagem:

<?php echo $this->_tpl_vars['mail_message']; ?>
