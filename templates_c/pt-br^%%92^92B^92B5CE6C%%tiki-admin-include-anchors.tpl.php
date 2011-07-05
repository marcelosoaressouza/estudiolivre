<?php /* Smarty version 2.6.18, created on 2011-04-04 17:12:07
         compiled from tiki-admin-include-anchors.tpl */ ?>
<a href="tiki-admin.php?page=features" title="Recursos" class="link"><img border="0"
   src="img/icons/admin_features.png" alt="Recursos" /></a>
<a href="tiki-admin.php?page=general" title="Geral" class="link"><img border="0"
   src="img/icons/admin_general.png" alt="Geral" /></a>
<a href="tiki-admin.php?page=login" title="Login" class="link"><img border="0"
   src="img/icons/admin_login.png" alt="Login" /></a>
<?php if ($this->_tpl_vars['feature_wiki'] && $this->_tpl_vars['feature_wiki'] == 'y'): ?>
<a href="tiki-admin.php?page=wiki" title="Wiki" class="link"><img border="0"
   src="img/icons/admin_wiki.png" alt="Wiki" /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_galleries'] && $this->_tpl_vars['feature_galleries'] == 'y'): ?>
<a href="tiki-admin.php?page=gal" title="Galerias de imagens" class="link"><img border="0"
   src="img/icons/admin_imagegal.png" alt="Galerias de imagens" /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_articles'] && $this->_tpl_vars['feature_articles'] == 'y'): ?>
<a href="tiki-admin.php?page=cms" title="Artigos" class="link"><img border="0"
   src="img/icons/admin_articles.png" alt="Artigos" /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_blogs'] && $this->_tpl_vars['feature_blogs'] == 'y'): ?>
<a href="tiki-admin.php?page=blogs" title="Blogs" class="link"><img border="0"
   src="img/icons/admin_blogs.png" alt="Blogs" /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_forums'] && $this->_tpl_vars['feature_forums'] == 'y'): ?>
<a href="tiki-admin.php?page=forums" title="Fóruns" class="link"><img border="0"
   src="img/icons/admin_forums.png" alt="Fóruns" /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_directory'] && $this->_tpl_vars['feature_directory'] == 'y'): ?>
<a href="tiki-admin.php?page=directory" title="Diretórios" class="link"><img border="0"
   src="img/icons/admin_directory.png" alt="Diretórios" /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_file_galleries'] && $this->_tpl_vars['feature_file_galleries'] == 'y'): ?>
<a href="tiki-admin.php?page=fgal" title="Galerias de Arquivos" class="link"><img border="0"
   src="img/icons/admin_filegal.png" alt="Galerias de Arquivos" /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_faqs'] && $this->_tpl_vars['feature_faqs'] == 'y'): ?>
<a href="tiki-admin.php?page=faqs" title="FAQs" class="link"><img border="0"
   src="img/icons/admin_faqs.png" alt="FAQs" /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_maps'] && $this->_tpl_vars['feature_maps'] == 'y'): ?>
<a href="tiki-admin.php?page=maps" title="Mapas" class="link"><img border="0"
   src="img/icons/admin_maps.png" alt="Mapas" /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_trackers'] && $this->_tpl_vars['feature_trackers'] == 'y'): ?>
<a href="tiki-admin.php?page=trackers" title="Acompanhamentos" class="link"><img border="0"
   src="img/icons/admin_trackers.png" alt="Acompanhamentos" /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_userfiles'] && $this->_tpl_vars['feature_userfiles'] == 'y'): ?>
<a href="tiki-admin.php?page=userfiles" title="Arquivos do usuário" class="link"><img border="0"
   src="img/icons/admin_userfiles.png" alt="Arquivos do usuário" /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_webmail'] && $this->_tpl_vars['feature_webmail'] == 'y'): ?>
<a href="tiki-admin.php?page=webmail" title="Webmail" class="link"><img border="0"
   src="img/icons/admin_webmail.png" alt="Webmail" /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_polls'] && $this->_tpl_vars['feature_polls'] == 'y'): ?>
<a href="tiki-admin.php?page=polls" title="Enquetes" class="link"><img border="0"
   src="img/icons/admin_polls.png" alt="Enquetes" /></a>
<?php endif; ?>
<?php if (true): ?> 
<a href="tiki-admin.php?page=rss" title="RSS" class="link"><img border="0"
   src="img/icons/admin_rss.png" alt="RSS" /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_search'] && $this->_tpl_vars['feature_search'] == 'y'): ?>
<a href="tiki-admin.php?page=search" title="Busca" class="link"><img border="0"
   src="img/icons/admin_search.png" alt="Busca" /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_score'] && $this->_tpl_vars['feature_score'] == 'y'): ?>
<a href="tiki-admin.php?page=score" title="Pontuação" class="link"><img border="0"
   src="img/icons/admin_score.png" alt="Pontuação" /></a>
<?php endif; ?>
<?php if (true): ?> 
<a href="tiki-admin.php?page=metatags" title="Meta Tags" class="link"><img border="0"
   src="img/icons/admin_metatags.png" alt="Meta Tags" /></a>
<?php endif; ?>
<?php if (true): ?> 
<a href="tiki-admin.php?page=community" title="Comunidade" class="link"><img border="0"
   src="img/icons/admin_community.png" alt="Comunidade" /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_siteidentity'] && $this->_tpl_vars['feature_siteidentity'] == 'y'): ?>
<a href="tiki-admin.php?page=siteid" title="Identidade do site" class="link"><img border="0"
   src="img/icons/admin_siteid.png" alt="Identidade do site" /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_calendar'] && $this->_tpl_vars['feature_calendar'] == 'y'): ?>
<a href="tiki-admin.php?page=calendar" title="Calendário" class="link"><img border="0"
   src="img/icons/admin_calendar.png" alt="Calendário do site" /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_intertiki'] && $this->_tpl_vars['feature_intertiki'] == 'y'): ?>
<a href="tiki-admin.php?page=intertiki" title="Intertiki" class="link"><img border="0"
   src="img/icons/admin_intertiki.png" alt="InterTiki" /></a>
<?php endif; ?>
<a href="tiki-admin.php?page=i18n" title="Internacionalização" class="link"><img border="0"
   src="img/icons/admin_i18n.png" alt="Internacionalização" /></a>

<a href="tiki-admin.php?page=category" title="Categoria" class="link"><img border="0"
   src="img/icons/admin_category.png" alt="Categoria" /></a>

<a href="tiki-admin.php?page=module" title="Módulo" class="link"><img border="0"
   src="img/mytiki/modules.gif" alt="Módulo" /></a>   
   
<a href="tiki-admin.php?page=theme" title="Tema" class="link"><img border="0"
   src="img/icons/admin_theme.png" alt="Tema" /></a>

<a href="tiki-admin.php?page=textarea" title="Área para texto" class="link"><img border="0"
   src="img/icons/admin_textarea.png" alt="Área para texto" /></a>      
   