<?php /* Smarty version 2.6.18, created on 2011-06-08 09:43:01
         compiled from styles/bolha/modules/mod-admin_menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tikimodule', 'styles/bolha/modules/mod-admin_menu.tpl', 3, false),)), $this); ?>

<?php if ($this->_tpl_vars['tiki_p_admin'] == 'y'): ?>
<?php $this->_tag_stack[] = array('tikimodule', array('title' => 'Admin TikiWiki','name' => 'admin_menu','flip' => $this->_tpl_vars['module_params']['flip'],'decorations' => $this->_tpl_vars['module_params']['decorations'])); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['tiki_p_admin'] == 'y' || $this->_tpl_vars['tiki_p_admin_chat'] == 'y' || $this->_tpl_vars['tiki_p_admin_categories'] == 'y' || $this->_tpl_vars['tiki_p_admin_banners'] == 'y' || $this->_tpl_vars['tiki_p_edit_templates'] == 'y' || $this->_tpl_vars['tiki_p_admin_mailin'] == 'y' || $this->_tpl_vars['tiki_p_admin_dynamic'] == 'y' || $this->_tpl_vars['tiki_p_admin_dynamic'] == 'y' || $this->_tpl_vars['tiki_p_edit_content_templates'] == 'y' || $this->_tpl_vars['tiki_p_edit_html_pages'] == 'y' || $this->_tpl_vars['tiki_p_view_referer_stats'] == 'y' || $this->_tpl_vars['tiki_p_admin_drawings'] == 'y' || $this->_tpl_vars['tiki_p_admin_shoutbox'] == 'y'): ?>
    <?php if ($this->_tpl_vars['feature_live_support'] == 'y' && ( $this->_tpl_vars['tiki_p_live_support_admin'] == 'y' || $this->_tpl_vars['user_is_operator'] == 'y' )): ?>
  		&nbsp;<a href="tiki-live_support_admin.php" class="linkmenu">Підтримка живцем</a><br />
	<?php endif; ?>

	<?php if ($this->_tpl_vars['feature_banning'] == 'y' && ( $this->_tpl_vars['tiki_p_admin_banning'] == 'y' )): ?>
  		&nbsp;<a href="tiki-admin_banning.php" class="linkmenu">Заборони</a><br />
	<?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin'] == 'y'): ?>
      &nbsp;<a href="tiki-adminusers.php" class="linkmenu">Користувачі</a><br />
      &nbsp;<a href="tiki-admingroups.php" class="linkmenu">Групи</a><br />
      &nbsp;<a href="tiki-list_cache.php" class="linkmenu">Кеш</a><br />
      &nbsp;<a href="tiki-admin_modules.php" class="linkmenu">Модулі</a><br />
      &nbsp;<a href="tiki-admin_links.php" class="linkmenu">Посилання</a><br />
      &nbsp;<a href="tiki-admin_hotwords.php" class="linkmenu">Горячі слова</a><br />
      &nbsp;<a href="tiki-admin_rssmodules.php" class="linkmenu">Модулі RSS</a><br />
      &nbsp;<a href="tiki-admin_menus.php" class="linkmenu">Меню</a><br />
      &nbsp;<a href="tiki-admin_polls.php" class="linkmenu">Опити</a><br />
      &nbsp;<a href="tiki-backup.php" class="linkmenu">Резервні копії</a><br />
      &nbsp;<a href="tiki-admin_notifications.php" class="linkmenu">Поштові сповіщення</a><br />
      &nbsp;<a href="tiki-search_stats.php" class="linkmenu">Статистика пошуків</a><br />
			&nbsp;<a href="tiki-admin_quicktags.php" class="linkmenu">QuickTags</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin_chat'] == 'y'): ?>
      &nbsp;<a href="tiki-admin_chat.php" class="linkmenu">Балачки</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin_categories'] == 'y'): ?>
      &nbsp;<a href="tiki-admin_categories.php" class="linkmenu">Категорії</a><br />
    <?php endif; ?>   
    <?php if ($this->_tpl_vars['tiki_p_admin_banners'] == 'y'): ?>
      &nbsp;<a href="tiki-list_banners.php" class="linkmenu">Гасла</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_edit_templates'] == 'y'): ?>
      &nbsp;<a href="tiki-edit_templates.php" class="linkmenu">Редагувати шаблони</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin_drawings'] == 'y'): ?>
      &nbsp;<a href="tiki-admin_drawings.php" class="linkmenu">Адмініструвати діаграми</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin_dynamic'] == 'y'): ?>
      &nbsp;<a href="tiki-list_contents.php" class="linkmenu">Динамічний вміст</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_edit_cookies'] == 'y'): ?>
      &nbsp;<a href="tiki-admin_cookies.php" class="linkmenu">Коржики</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin_mailin'] == 'y'): ?>
      &nbsp;<a href="tiki-admin_mailin.php" class="linkmenu">Вхідна пошта</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_edit_content_templates'] == 'y'): ?>
      &nbsp;<a href="tiki-admin_content_templates.php" class="linkmenu">Шаблони вмісту</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_edit_html_pages'] == 'y'): ?>
      &nbsp;<a href="tiki-admin_html_pages.php" class="linkmenu">Сторінки HTML</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin_shoutbox'] == 'y'): ?>
      &nbsp;<a href="tiki-shoutbox.php" class="linkmenu">'Вголос'</a><br />
      &nbsp;<a href="tiki-admin_shoutbox_words.php" class="linkmenu"Shoutbox Words</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_view_referer_stats'] == 'y'): ?>
    &nbsp;<a href="tiki-referer_stats.php" class="linkmenu">Referer stats</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin'] == 'y'): ?>
    &nbsp;<a href="tiki-import_phpwiki.php" class="linkmenu">Import PHPWiki Dump</a><br />
    &nbsp;<a href="tiki-phpinfo.php" class="linkmenu">phpinfo</a><br />
    &nbsp;<a href="tiki-admin_dsn.php" class="linkmenu">Admin dsn</a><br />
    &nbsp;<a href="tiki-admin_external_wikis.php" class="linkmenu">Зовнішні Вікі</a><br />
    &nbsp;<a href="tiki-admin_system.php" class="linkmenu">System Admin</a><br />
    &nbsp;<a href="tiki-admin_security.php" class="linkmenu">Security Admin</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin_code_hilight'] == 'y'): ?>
    &nbsp;<a href="tiki-admin_code_syntax.php" class="linkmenu">Підсвітка синтаксису</a><br />
    <?php endif; ?>
<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php endif; ?>