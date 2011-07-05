<?php /* Smarty version 2.6.18, created on 2011-06-18 03:53:56
         compiled from tiki-mytiki_bar.tpl */ ?>
<div>
<table>
<tr>

<?php if ($this->_tpl_vars['feature_userPreferences'] == 'y'): ?>
<td valign="top"><a class="link" href="tiki-my_tiki.php" title="MiTiki">
<img  border="0" src="img/mytiki/mytiki.gif" alt="MiTiki" />
</a></td>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_userPreferences'] == 'y'): ?>
<td valign="top"><a class="link" href="tiki-user_preferences.php" title="Preferencias">
<img  border="0" src="img/mytiki/prefs.gif" alt="Prefs" />
</a></td>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_messages'] == 'y' && $this->_tpl_vars['tiki_p_messages'] == 'y'): ?>
<td valign="top">
<div align="center">
<a class="link" href="messu-mailbox.php" title="Mensajes">
<img  border="0" src="img/mytiki/messages.gif" alt="Mensajes" /><br />
<small>(<?php echo $this->_tpl_vars['unread']; ?>
)</small>
</a></div></td>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_tasks'] == 'y' && $this->_tpl_vars['tiki_p_tasks'] == 'y'): ?>
<td valign="top"><a class="link" href="tiki-user_tasks.php" title="Tareas">
<img  border="0" src="img/mytiki/tasks.gif" alt="Tareas" /><br />
</a></td>
<?php endif; ?>


<?php if ($this->_tpl_vars['feature_user_bookmarks'] == 'y' && $this->_tpl_vars['tiki_p_create_bookmarks'] == 'y'): ?>
<td valign="top"><a class="link" href="tiki-user_bookmarks.php" title="Marcadores">
<img  border="0" src="img/mytiki/bookmarks.gif" alt="Marcadores" /><br />
</a></td>
<?php endif; ?>



<?php if ($this->_tpl_vars['user_assigned_modules'] == 'y' && $this->_tpl_vars['tiki_p_configure_modules'] == 'y'): ?>
<td valign="top"><a class="link" href="tiki-user_assigned_modules.php" title="Módulos">
<img  border="0" src="img/mytiki/modules.gif" alt="Módulos" /><br />
</a></td>
<?php endif; ?>


<?php if ($this->_tpl_vars['feature_newsreader'] == 'y' && $this->_tpl_vars['tiki_p_newsreader'] == 'y'): ?>
<td valign="top"><a class="link" href="tiki-newsreader_servers.php" title="Noticias">
<img  border="0" src="img/mytiki/news.gif" alt="Noticias" /><br />
</a></td>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_webmail'] == 'y' && $this->_tpl_vars['tiki_p_use_webmail'] == 'y'): ?>
<td valign="top"><a class="link" href="tiki-webmail.php" title="Webmail">
<img  border="0" src="img/mytiki/webmail.gif" alt="Webmail" /><br />
</a></td>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_notepad'] == 'y' && $this->_tpl_vars['tiki_p_notepad'] == 'y'): ?>
<td valign="top"><a class="link" href="tiki-notepad_list.php" title="Bloc de notas">
<img border="0" src="img/mytiki/notes.gif" alt="Bloc de notas" /><br />
</a></td>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_userfiles'] == 'y' && $this->_tpl_vars['tiki_p_userfiles'] == 'y'): ?>
<td valign="top"><a class="link" href="tiki-userfiles.php" title="MisArchivos">
<img  border="0" src="img/mytiki/myfiles.gif" alt="MisArchivos" /><br />
</a></td>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_minical'] == 'y' && $this->_tpl_vars['tiki_p_minical'] == 'y'): ?>
<td valign="top"><a class="link" href="tiki-minical.php" title="Mini Calendario">
<img  border="0" src="img/mytiki/minical.gif" alt="Mini Calendario" /><br />
</a></td>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_user_watches'] == 'y'): ?>
<td valign="top"><a class="link" href="tiki-user_watches.php" title="Mis watches">
<img  border="0" src="img/mytiki/mywatches.gif" alt="Mis watches" /><br />
</a></td>
<?php endif; ?>

</tr></table>
</div>
