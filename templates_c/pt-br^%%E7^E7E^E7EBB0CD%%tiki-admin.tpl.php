<?php /* Smarty version 2.6.18, created on 2011-04-04 17:12:07
         compiled from tiki-admin.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'popup_init', 'tiki-admin.tpl', 1, false),array('function', 'breadcrumbs', 'tiki-admin.tpl', 3, false),array('block', 'tr', 'tiki-admin.tpl', 17, false),)), $this); ?>
<?php echo smarty_function_popup_init(array('src' => "lib/overlib.js"), $this);?>

<div id="pageheader">
<?php echo smarty_function_breadcrumbs(array('type' => 'trail','loc' => 'admin','crumbs' => $this->_tpl_vars['crumbs']), $this);?>

<?php echo smarty_function_breadcrumbs(array('type' => 'pagetitle','loc' => 'admin','crumbs' => $this->_tpl_vars['crumbs']), $this);?>

<?php echo smarty_function_breadcrumbs(array('type' => 'desc','loc' => 'page','crumbs' => $this->_tpl_vars['trail']), $this);?>

</div>

<?php if (in_array ( $_GET['page'] , array ( 'features' , 'general' , 'login' , 'wiki' , 'gal' , 'fgal' , 'cms' , 'polls' , 'search' , 'blogs' , 'forums' , 'faqs' , 'trackers' , 'webmail' , 'rss' , 'directory' , 'userfiles' , 'maps' , 'metatags' , 'wikiatt' , 'score' , 'community' , 'siteid' , 'calendar' , 'intertiki' , 'gmap' , 'i18n' , 'category' , 'module' , 'theme' , 'textarea' ) )): ?>
  <?php $this->assign('include', $_GET['page']); ?>
<?php else: ?>
  <?php $this->assign('include', "list-sections"); ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['include'] != "list-sections"): ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-admin-include-anchors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_version_checks'] == 'y' && $this->_tpl_vars['tiki_needs_upgrade'] == 'y'): ?>
<div class="simplebox highlight"><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>A new version of TikiWiki, <b><?php echo $this->_tpl_vars['tiki_release']; ?>
</b>, is available.  You are currently running <b><?php echo $this->_tpl_vars['tiki_version']; ?>
</b>. Please visit <a href="http://tikiwiki.org/Download">http://tikiwiki.org/Download</a>.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
<?php endif; ?>
<?php if ($this->_tpl_vars['tikifeedback']): ?>
<div class="simplebox highlight"><?php unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=$this->_tpl_vars['tikifeedback']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['n']['show'] = true;
$this->_sections['n']['max'] = $this->_sections['n']['loop'];
$this->_sections['n']['step'] = 1;
$this->_sections['n']['start'] = $this->_sections['n']['step'] > 0 ? 0 : $this->_sections['n']['loop']-1;
if ($this->_sections['n']['show']) {
    $this->_sections['n']['total'] = $this->_sections['n']['loop'];
    if ($this->_sections['n']['total'] == 0)
        $this->_sections['n']['show'] = false;
} else
    $this->_sections['n']['total'] = 0;
if ($this->_sections['n']['show']):

            for ($this->_sections['n']['index'] = $this->_sections['n']['start'], $this->_sections['n']['iteration'] = 1;
                 $this->_sections['n']['iteration'] <= $this->_sections['n']['total'];
                 $this->_sections['n']['index'] += $this->_sections['n']['step'], $this->_sections['n']['iteration']++):
$this->_sections['n']['rownum'] = $this->_sections['n']['iteration'];
$this->_sections['n']['index_prev'] = $this->_sections['n']['index'] - $this->_sections['n']['step'];
$this->_sections['n']['index_next'] = $this->_sections['n']['index'] + $this->_sections['n']['step'];
$this->_sections['n']['first']      = ($this->_sections['n']['iteration'] == 1);
$this->_sections['n']['last']       = ($this->_sections['n']['iteration'] == $this->_sections['n']['total']);
?><?php echo $this->_tpl_vars['tikifeedback'][$this->_sections['n']['index']]['mes']; ?>
<br /><?php endfor; endif; ?></div>
<?php endif; ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-admin-include-".($this->_tpl_vars['include']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<br /><br />
<div class="cbox">
<div class="cbox-title">Links relacionados com outros recursos e configurações</div>
<div class="cbox-data">
Outras sessões:<br />
<?php if ($this->_tpl_vars['feature_sheet'] == 'y'): ?> <a href="tiki-sheets.php">Spreadsheet</a> <?php endif; ?>
<?php if ($this->_tpl_vars['feature_newsletters'] == 'y'): ?> <a href="tiki-admin_newsletters.php">Comunicados</a> <?php endif; ?>
<?php if ($this->_tpl_vars['feature_surveys'] == 'y'): ?> <a href="tiki-admin_surveys.php">Pesquisas</a> <?php endif; ?>
<?php if ($this->_tpl_vars['feature_quizzes'] == 'y'): ?> <a href="tiki-edit_quiz.php">Testes</a> <?php endif; ?>
<?php if ($this->_tpl_vars['feature_integrator'] == 'y'): ?> <a href="tiki-admin_integrator.php">Integrador</a> <?php endif; ?>
<?php if ($this->_tpl_vars['feature_html_pages'] == 'y'): ?> <a href="tiki-admin_html_pages.php">Páginas HTML</a> <?php endif; ?>
<?php if ($this->_tpl_vars['feature_shoutbox'] == 'y'): ?> <a href="tiki-shoutbox.php">Mural</a> <a 
href="tiki-admin_shoutbox_words.php">Palavras do quadro negro</a> <?php endif; ?>
<?php if ($this->_tpl_vars['feature_live_support'] == 'y'): ?> <a href="tiki-live_support_admin.php">Suporte On-line</a> <?php endif; ?>
<?php if ($this->_tpl_vars['feature_chat'] == 'y'): ?> <a href="tiki-admin_chat.php">Chat</a> <?php endif; ?>
<?php if ($this->_tpl_vars['feature_charts'] == 'y'): ?> <a href="tiki-admin_charts.php">Gráficos</a> <?php endif; ?>
<?php if ($this->_tpl_vars['feature_eph'] == 'y'): ?> <a href="tiki-eph_admin.php">Curiosidades</a> <?php endif; ?>
<?php if ($this->_tpl_vars['feature_workflow'] == 'y'): ?> <a href="tiki-g-admin_processes.php">Workflow</a> <?php endif; ?>

<?php if ($this->_tpl_vars['feature_games'] == 'y'): ?> <a href="tiki-list_games.php">Jogos</a> <?php endif; ?>
<?php if ($this->_tpl_vars['feature_contact'] == 'y'): ?> <a href="tiki-contact.php">Entre em contato</a> <?php endif; ?>
<hr>

Recursos de administração:<br />
<a href="tiki-adminusers.php">Usuári@s</a> 
<a href="tiki-admingroups.php">Grupos</a> 
<a href="tiki-admin_security.php">Segurança</a> 
<a href="tiki-admin_system.php">Sistema</a> 
<a href="tiki-syslog.php">Logs do sistema</a> 
<a href="tiki-phpinfo.php">phpinfo</a> 
<a href="tiki-mods.php">Mods</a>



<?php if ($this->_tpl_vars['feature_banning'] == 'y'): ?><a href="tiki-admin_banning.php">Banimento</a> <?php endif; ?>

<?php if ($this->_tpl_vars['tiki_p_admin'] == 'y' && $this->_tpl_vars['feature_debug_console'] == 'y'): ?>
  <a href="javascript:toggle('debugconsole');">Console de depuração</a>
  (Click and scroll up to the top of the page)
<?php endif; ?>

<hr>

Recursos transversais (aqueles que se aplicam a mais de uma seção):<br />
<a href="tiki-admin_notifications.php">Notificações por e-mail</a> 
<?php if ($this->_tpl_vars['feature_mobile'] == 'y'): ?> <a href="tiki-mobile.php">Dispositivos móveis</a> <?php endif; ?>
<hr>

Recursos de navegação:<br />
<a href="tiki-admin_menus.php">Menus</a> 
<a href="tiki-admin_modules.php">Módulos</a>
<?php if ($this->_tpl_vars['feature_categories'] == 'y'): ?> <a href="tiki-admin_categories.php">Categorias</a> <?php endif; ?>
<?php if ($this->_tpl_vars['feature_featuredLinks'] == 'y'): ?><a href="tiki-admin_links.php">Links</a><?php endif; ?>
<hr>


Recursos de áreas de texto (recursos aplicáveis a todas as áreas de texto, como páginas wiki, artigos, blogs etc):<br />
<a href="tiki-admin_cookies.php">Cookies</a> 
<?php if ($this->_tpl_vars['feature_hotwords'] == 'y'): ?> <a href="tiki-admin_hotwords.php">Palavras-chaves</a> <?php endif; ?>
<a href="tiki-list_cache.php">Cache</a> 
<a href="tiki-admin_quicktags.php">QuickTags</a> 
<a href="tiki-admin_content_templates.php">Padrões de conteúdo</a> 
<a href="tiki-admin_dsn.php">DSN</a> 
<?php if ($this->_tpl_vars['feature_drawings'] == 'y'): ?><a href="tiki-admin_drawings.php">Desenhos</a> <?php endif; ?>
<?php if ($this->_tpl_vars['feature_dynamic_content'] == 'y'): ?><a href="tiki-list_contents.php">Conteúdo dinâmico</a> <?php endif; ?>
<a href="tiki-admin_external_wikis.php">Wikis externos</a> 
<?php if ($this->_tpl_vars['feature_mailin'] == 'y'): ?><a href="tiki-admin_mailin.php">Mail-in</a> <?php endif; ?>
<hr>

Stats &amp; banners:<br />
<?php if ($this->_tpl_vars['feature_stats'] == 'y'): ?> <a href="tiki-stats.php">Estatísticas</a> <?php endif; ?>
<?php if ($this->_tpl_vars['feature_referer_stats'] == 'y'): ?> <a href="tiki-referer_stats.php">Estatísticas de referência</a> <?php endif; ?>
<?php if ($this->_tpl_vars['feature_search'] == 'y' && $this->_tpl_vars['feature_search_stats'] == 'y'): ?> <a href="tiki-search_stats.php">Estatísticas de busca</a>  <?php endif; ?>
<?php if ($this->_tpl_vars['feature_banners'] == 'y'): ?> <a href="tiki-list_banners.php">Banners</a> <?php endif; ?>
</div>
</div>