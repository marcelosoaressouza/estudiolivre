<?php /* Smarty version 2.6.18, created on 2011-05-03 19:41:10
         compiled from modules/mod-admin_menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tikimodule', 'modules/mod-admin_menu.tpl', 3, false),)), $this); ?>


<?php $this->_tag_stack[] = array('tikimodule', array('title' => 'Administrar Menu','name' => 'admin_menu','flip' => $this->_tpl_vars['module_params']['flip'],'decorations' => $this->_tpl_vars['module_params']['decorations'])); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['tiki_p_admin'] == 'y' || $this->_tpl_vars['tiki_p_admin_chat'] == 'y' || $this->_tpl_vars['tiki_p_admin_categories'] == 'y' || $this->_tpl_vars['tiki_p_admin_banners'] == 'y' || $this->_tpl_vars['tiki_p_edit_templates'] == 'y' || $this->_tpl_vars['tiki_p_admin_mailin'] == 'y' || $this->_tpl_vars['tiki_p_admin_dynamic'] == 'y' || $this->_tpl_vars['tiki_p_admin_dynamic'] == 'y' || $this->_tpl_vars['tiki_p_edit_content_templates'] == 'y' || $this->_tpl_vars['tiki_p_edit_html_pages'] == 'y' || $this->_tpl_vars['tiki_p_view_referer_stats'] == 'y' || $this->_tpl_vars['tiki_p_admin_drawings'] == 'y' || $this->_tpl_vars['tiki_p_admin_shoutbox'] == 'y'): ?>
    <?php if ($this->_tpl_vars['feature_live_support'] == 'y' && ( $this->_tpl_vars['tiki_p_live_support_admin'] == 'y' || $this->_tpl_vars['user_is_operator'] == 'y' )): ?>
  		&nbsp;<a href="tiki-live_support_admin.php" class="linkmenu">Suporte On-line</a><br />
	<?php endif; ?>

	<?php if ($this->_tpl_vars['feature_banning'] == 'y' && ( $this->_tpl_vars['tiki_p_admin_banning'] == 'y' )): ?>
  		&nbsp;<a href="tiki-admin_banning.php" class="linkmenu">Banimento</a><br />
	<?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin'] == 'y'): ?>
      &nbsp;<a href="tiki-adminusers.php" class="linkmenu">Usuári@s</a><br />
      &nbsp;<a href="tiki-admingroups.php" class="linkmenu">Grupos</a><br />
      &nbsp;<a href="tiki-list_cache.php" class="linkmenu">Cache</a><br />
      &nbsp;<a href="tiki-admin_modules.php" class="linkmenu">Módulos</a><br />

<?php if ($this->_tpl_vars['feature_featuredLinks'] == 'y'): ?>
      &nbsp;<a href="tiki-admin_links.php" class="linkmenu">Links</a><br />
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_hotwords'] == 'y'): ?>
      &nbsp;<a href="tiki-admin_hotwords.php" class="linkmenu">Palavras-chaves</a><br />
<?php endif; ?>

      &nbsp;<a href="tiki-admin_rssmodules.php" class="linkmenu">Módulos RSS</a><br />
      &nbsp;<a href="tiki-admin_menus.php" class="linkmenu">Menus</a><br />

<?php if ($this->_tpl_vars['feature_polls'] == 'y'): ?>
      &nbsp;<a href="tiki-admin_polls.php" class="linkmenu">Enquetes</a><br />
<?php endif; ?>

 

      &nbsp;<a href="tiki-admin_notifications.php" class="linkmenu">Notificações por e-mail</a><br />

<?php if ($this->_tpl_vars['feature_search_stats'] == 'y'): ?>
      &nbsp;<a href="tiki-search_stats.php" class="linkmenu">Estatísticas de busca</a><br />
<?php endif; ?>

			&nbsp;<a href="tiki-admin_quicktags.php" class="linkmenu">QuickTags</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin_chat'] == 'y' && $this->_tpl_vars['feature_chat'] == 'y'): ?>
      &nbsp;<a href="tiki-admin_chat.php" class="linkmenu">Chat</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin_categories'] == 'y' && $this->_tpl_vars['feature_categories'] == 'y'): ?>
      &nbsp;<a href="tiki-admin_categories.php" class="linkmenu">Categorias</a><br />
    <?php endif; ?>   
    <?php if ($this->_tpl_vars['tiki_p_admin_banners'] == 'y' && $this->_tpl_vars['feature_banners'] == 'y'): ?>
      &nbsp;<a href="tiki-list_banners.php" class="linkmenu">Banners</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['feature_edit_templates'] == 'y' && $this->_tpl_vars['tiki_p_edit_templates'] == 'y'): ?>
      &nbsp;<a href="tiki-edit_templates.php" class="linkmenu">Editar padrões</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin_drawings'] == 'y' && $this->_tpl_vars['feature_drawings'] == 'y'): ?>
      &nbsp;<a href="tiki-admin_drawings.php" class="linkmenu">Administrar desenhos</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin_dynamic'] == 'y' && $this->_tpl_vars['feature_dynamic_content'] == 'y'): ?>
      &nbsp;<a href="tiki-list_contents.php" class="linkmenu">Conteúdo dinâmico</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_edit_cookies'] == 'y'): ?>
      &nbsp;<a href="tiki-admin_cookies.php" class="linkmenu">Cookies</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin_mailin'] == 'y' && $this->_tpl_vars['feature_mailin'] == 'y'): ?>
      &nbsp;<a href="tiki-admin_mailin.php" class="linkmenu">Mail-in</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_edit_content_templates'] == 'y'): ?>
      &nbsp;<a href="tiki-admin_content_templates.php" class="linkmenu">Padrões de conteúdo</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_edit_html_pages'] == 'y' && $this->_tpl_vars['feature_html_pages'] == 'y'): ?>
      &nbsp;<a href="tiki-admin_html_pages.php" class="linkmenu">Páginas HTML</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin_shoutbox'] == 'y' && $this->_tpl_vars['feature_shoutbox'] == 'y'): ?>
      &nbsp;<a href="tiki-shoutbox.php" class="linkmenu">Mural</a><br />
      &nbsp;<a href="tiki-admin_shoutbox_words.php" class="linkmenu">Palavras do quadro negro</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_view_referer_stats'] == 'y' && $this->_tpl_vars['feature_referer_stats'] == 'y'): ?>
    &nbsp;<a href="tiki-referer_stats.php" class="linkmenu">Estatísticas de referência</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin'] == 'y'): ?>


    &nbsp;<a href="tiki-phpinfo.php" class="linkmenu">phpinfo</a><br />
    &nbsp;<a href="tiki-admin_dsn.php" class="linkmenu">Administrar DSN</a><br />
    &nbsp;<a href="tiki-admin_external_wikis.php" class="linkmenu">Wikis externos</a><br />
    &nbsp;<a href="tiki-admin_system.php" class="linkmenu">Administração do sistema</a><br />
    &nbsp;<a href="tiki-admin_security.php" class="linkmenu">Administrar segurança</a><br />
    <?php endif; ?>
    <?php if ($this->_tpl_vars['tiki_p_admin_code_hilight'] == 'y'): ?>
    &nbsp;<a href="tiki-admin_code_syntax.php" class="linkmenu">Colorização de sintaxe</a><br />
    <?php endif; ?>
<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>