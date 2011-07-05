<?php /* Smarty version 2.6.18, created on 2011-04-04 17:12:07
         compiled from tiki-admin-include-features.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'tiki-admin-include-features.tpl', 13, false),array('function', 'help', 'tiki-admin-include-features.tpl', 14, false),)), $this); ?>



<div class="rbox" name="tip">
<div class="rbox-title" name="tip">Dica</div>  
<div class="rbox-data" name="tip">Veja a <a class="rbox-link" target="tikihelp" href="http://doc.tikiwiki.org/tiki-index.php?page=Features">avaliação de cada recurso</a> no site de desenvolvimento do Tiki.</div>
</div>
<br /> 
 
<form action="tiki-admin.php?page=features" method="post">
  <div class="cbox">
    <div class="cbox-title">
      <?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['crumbs'][$this->_tpl_vars['crumb']]->title; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php echo smarty_function_help(array('crumb' => $this->_tpl_vars['crumbs'][$this->_tpl_vars['crumb']]), $this);?>

    </div>

<div class="cbox-data">
<table width="100%" class="admin">
  <tr>
    <td class="heading" colspan="7" align="center">Seções e recursos do Tiki</td>
  </tr>
  
  <tr>
    <td ><input type="checkbox" name="feature_wiki"
            <?php if ($this->_tpl_vars['feature_wiki'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form" > <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Wiki" target="tikihelp" class="tikihelp" title="Wiki"><?php endif; ?> Wiki <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    
    <td >&nbsp;</td>
    <td><input type="checkbox" name="feature_blogs"
            <?php if ($this->_tpl_vars['feature_blogs'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    
    <td class="form" > <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Blog" target="tikihelp" class="tikihelp" title="Wiki"><?php endif; ?> Blogs <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    </tr>
  
  <tr>
    <td><input type="checkbox" name="feature_galleries"
            <?php if ($this->_tpl_vars['feature_galleries'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Image+Gallery" target="tikihelp" class="tikihelp" title="Galerias de imagens"><?php endif; ?> Galerias de imagens <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_file_galleries"
            <?php if ($this->_tpl_vars['feature_file_galleries'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
File+Gallery" target="tikihelp" class="tikihelp" title="Galerias de Arquivos"><?php endif; ?> Galerias de Arquivos <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_articles"
            <?php if ($this->_tpl_vars['feature_articles'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Articles" target="tikihelp" class="tikihelp" title="Artigos"><?php endif; ?> Artigos <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_forums"
            <?php if ($this->_tpl_vars['feature_forums'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Forum" target="tikihelp" class="tikihelp" title="Fóruns"><?php endif; ?> Fóruns <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_faqs"
            <?php if ($this->_tpl_vars['feature_faqs'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
FAQ" target="tikihelp" class="tikihelp" title="FAQs"><?php endif; ?> FAQs <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_shoutbox"
            <?php if ($this->_tpl_vars['feature_shoutbox'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Shoutbox" target="tikihelp" class="tikihelp" title="Mural"><?php endif; ?> Mural <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_chat"
            <?php if ($this->_tpl_vars['feature_chat'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Chat" target="tikihelp" class="tikihelp" title="Chat"><?php endif; ?> Chat <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_trackers"
            <?php if ($this->_tpl_vars['feature_trackers'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Trackers" target="tikihelp" class="tikihelp" title="Acompanhamentos"><?php endif; ?> 
Acompanhamentos <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_directory"
            <?php if ($this->_tpl_vars['feature_directory'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Directory" target="tikihelp" class="tikihelp" title="Diretórios"><?php endif; ?> Diretórios <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_webmail"
            <?php if ($this->_tpl_vars['feature_webmail'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Webmail" target="tikihelp" class="tikihelp" title="Webmail"><?php endif; ?> Webmail <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?> </td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_newsreader"
            <?php if ($this->_tpl_vars['feature_newsreader'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Newsreader" target="tikihelp" class="tikihelp" title="Notícias"><?php endif; ?> Notícias <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?> </td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_surveys"
            <?php if ($this->_tpl_vars['feature_surveys'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Survey" target="tikihelp" class="tikihelp" title="Pesquisas"><?php endif; ?> Pesquisas <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_polls"
            <?php if ($this->_tpl_vars['feature_polls'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Polls" target="tikihelp" class="tikihelp" title="Enquetes"><?php endif; ?> Enquetes <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_eph"
            <?php if ($this->_tpl_vars['feature_eph'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Ephemerides" target="tikihelp" class="tikihelp" title="Curiosidades"><?php endif; ?> Curiosidades <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_quizzes"
            <?php if ($this->_tpl_vars['feature_quizzes'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Quiz" target="tikihelp" class="tikihelp" title="Testes"><?php endif; ?> Testes <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td ><input type="checkbox" name="feature_search"
            <?php if ($this->_tpl_vars['feature_search'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Search" target="tikihelp" class="tikihelp" title="Busca"><?php endif; ?> Busca <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_featuredLinks"
            <?php if ($this->_tpl_vars['feature_featuredLinks'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Featured+Links" target="tikihelp" class="tikihelp" title="Auxílio oferecido"><?php endif; ?> Links oferecidos <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_banners"
            <?php if ($this->_tpl_vars['feature_banners'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Banners" target="tikihelp" class="tikihelp" title="Banners"><?php endif; ?> Banners <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_games" 
            <?php if ($this->_tpl_vars['feature_games'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Games" target="tikihelp" class="tikihelp" title="Jogos"><?php endif; ?> Jogos <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_workflow"
            <?php if ($this->_tpl_vars['feature_workflow'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Workflow" target="tikihelp" class="tikihelp" title="Workflow"><?php endif; ?> Gerenciador de Workflow <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_newsletters"
            <?php if ($this->_tpl_vars['feature_newsletters'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Newsletters" target="tikihelp" class="tikihelp" title="Comunicados"><?php endif; ?> Comunicados <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_live_support"
            <?php if ($this->_tpl_vars['feature_live_support'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Live+Support" target="tikihelp" class="tikihelp" title="Suporte on-line"><?php endif; ?> Sistema de auxílio on-line <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    </tr>
  <tr> 
      <td><input type="checkbox" name="feature_minical"
            <?php if ($this->_tpl_vars['feature_minical'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
      <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Calendar" target="tikihelp" class="tikihelp" title="Mini-Calendário"><?php endif; ?> Mini-Calendário <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
      <td>&nbsp;</td>
      <td><input type="checkbox" name="feature_maps"
            <?php if ($this->_tpl_vars['feature_maps'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
      <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Map" target="tikihelp" class="tikihelp" title="Mapas"><?php endif; ?> 
Mapas <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
            </tr>
  
  <tr>
    <td>&nbsp; </td>
    <td class="form"><a href="tiki-admin.php?page=general#help">Sistema de Ajuda</a></td>
    <td>&nbsp;</td>
    
    <td></td>
    <td class="form"> <a href="tiki-admin.php?page=category">Categorias</a> </td>
  </tr>
  <tr>
    <td></td>
    <td class="form"> <a href="tiki-admin.php?page=module">Mostrar Controle de Módulos</a></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_calendar"
					<?php if ($this->_tpl_vars['feature_calendar'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Calendar" target="tikihelp" class="tikihelp" title="Calendário"><?php endif; ?> Calendário Tiki <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td></tr>
    <tr>
    <td><input type="checkbox" name="feature_mailin"
				<?php if ($this->_tpl_vars['feature_mailin'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Mail-in" target="tikihelp" class="tikihelp" title="Mail-in"><?php endif; ?> 
Mail-in <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td></td>
    <td class="form"> <a href="tiki-admin.php?page=theme"> Visualização de Modelos Tiki </a></td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_integrator"
            <?php if ($this->_tpl_vars['feature_integrator'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Integrator" target="tikihelp" class="tikihelp" title="Integrador"><?php endif; ?> Integrador <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_phplayers" <?php if ($this->_tpl_vars['feature_phplayers'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="http://themes.tikiwiki.org/tiki-index.php?page=PhpLayersMenu" 
target="tikihelp" class="tikihelp" title="PHPLayers"><?php endif; ?> Menus dinâmicos PhpLayers <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_jscalendar" <?php if ($this->_tpl_vars['feature_jscalendar'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Js+Calendar" target="tikihelp" class="tikihelp" title="Calendário Java Script"><?php endif; ?> Calendário Java Script <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td class="form"> <a href="tiki-admin.php?page=theme">Usar Tabs</a> </td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_score" <?php if ($this->_tpl_vars['feature_score'] == 'y'): ?>checked="checked"<?php endif; ?> /></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Score" target="tikihelp" class="tikihelp" title="Pontuação"><?php endif; ?> Pontuação<?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_sheet" <?php if ($this->_tpl_vars['feature_sheet'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Spreadsheet" target="tikihelp" class="tikihelp" title="Planilha Tiki"><?php endif; ?> Planilha Tiki <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
  </tr><tr>
    <td><input type="checkbox" name="feature_friends" <?php if ($this->_tpl_vars['feature_friends'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Friendship+Network" target="tikihelp" class="tikihelp" title="Rede de amigos"><?php endif; ?> Rede de amigos <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_siteidentity" <?php if ($this->_tpl_vars['feature_siteidentity'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Site+Identity" target="tikihelp" class="tikihelp" title="Logo do site e identidade"><?php endif; ?> Logo do site e identidade <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
  </tr><tr>
    <td><input type="checkbox" name="feature_mobile" <?php if ($this->_tpl_vars['feature_mobile'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Mobile" target="tikihelp" class="tikihelp" title="Dispositivos móveis"><?php endif; ?> Dispositivos móveis <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_gmap" <?php if ($this->_tpl_vars['feature_gmap'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Gmap" target="tikihelp" class="tikihelp" title="Google Maps"><?php endif; ?> Google Maps <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>    
  </tr></table>    

<table width="100%" class="admin">
  <tr>
    <td class="heading" colspan="5"
            align="center">Recursos de Conteúdo</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_hotwords" 
            <?php if ($this->_tpl_vars['feature_hotwords'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Hotwords" target="tikihelp" class="tikihelp" title="Palavras-chaves"><?php endif; ?> Palavras-chaves <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td class="form">&nbsp;</td>

    <td><input type="checkbox" name="feature_hotwords_nw"
            <?php if ($this->_tpl_vars['feature_hotwords_nw'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Hotwords" target="tikihelp" class="tikihelp" title="Palavras-chaves em novas janelas"><?php endif; ?> Palavras-chaves em novas janelas <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>

  </tr>
  <tr>
    <td><input type="checkbox" name="feature_custom_home"
            <?php if ($this->_tpl_vars['feature_custom_home'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Custom+Home" target="tikihelp" class="tikihelp" title="Página Inicial Personalizada"><?php endif; ?> Página Inicial Personalizada <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td class="form">&nbsp;</td>
    
    <td><input type="checkbox" name="feature_html_pages"
            <?php if ($this->_tpl_vars['feature_html_pages'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Html+Pages" target="tikihelp" class="tikihelp" title="Páginas HTML"><?php endif; ?> Páginas HTML <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_drawings"
            <?php if ($this->_tpl_vars['feature_drawings'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Drawings" target="tikihelp" class="tikihelp" title="Desenhos"><?php endif; ?> Desenhos <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td class="form">&nbsp;</td>
    <td><input type="checkbox" name="feature_dynamic_content"
            <?php if ($this->_tpl_vars['feature_dynamic_content'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Dynamic+Content" target="tikihelp" class="tikihelp" title="Sistema de Conteúdo Dinâmico"><?php endif; ?> Sistema de Conteúdo Dinâmico <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_charts"
            <?php if ($this->_tpl_vars['feature_charts'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Charts" target="tikihelp" class="tikihelp" title="Gráficos"><?php endif; ?> Gráficos <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td class="form">&nbsp;</td>
    <td>
    </td>
    <td class="form"> <a href="tiki-admin.php?page=textarea">Permitir Emoticons</a> </td>
  </tr>
  <tr>
    <td></td>
    <td class="form"><a href="tiki-admin.php?page=textarea"> AutoLinks </a> </td>
    <td class="form">&nbsp;</td>
    <td><input type="checkbox" name="feature_use_quoteplugin"
            <?php if ($this->_tpl_vars['feature_use_quoteplugin'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> Use o plugin QUOTE em vez de &ldquo;>&rdquo; para citar </td>
  </tr>
</table>

<table width="100%" class="admin">
  <tr>
    <td class="heading" colspan="5" 
            align="center">Recursos de administração</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_banning"
            <?php if ($this->_tpl_vars['feature_banning'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Banning" target="tikihelp" class="tikihelp" title="Sistema de Banimento"><?php endif; ?> Sistema de banimento <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_debug_console"
            <?php if ($this->_tpl_vars['feature_debug_console'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Debugger+Console" target="tikihelp" class="tikihelp" title="Console de depuração"><?php endif; ?> Console de depuração <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_stats"
            <?php if ($this->_tpl_vars['feature_stats'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Stats" target="tikihelp" class="tikihelp" title="Estatísticas"><?php endif; ?> Estatísticas <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_comm"
            <?php if ($this->_tpl_vars['feature_comm'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Communication+Center" target="tikihelp" class="tikihelp" title="Comunicação (enviar/receber objetos)"><?php endif; ?> Comunicação (enviar/receber objetos) <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?> </td>
    </tr>
  <tr>
    <td></td>
    <td class="form"> <a href="tiki-admin.php?page=theme">Controle de temas</a></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_xmlrpc"
            <?php if ($this->_tpl_vars['feature_xmlrpc'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Xmlrpc" target="tikihelp" class="tikihelp" title="API de XMLRPC"><?php endif; ?> API de XMLRPC <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    </tr>
  <tr>
    <td><input type="checkbox" name="feature_referer_stats"
            <?php if ($this->_tpl_vars['feature_referer_stats'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Stats" target="tikihelp" class="tikihelp" title="Estatísticas de Referências"><?php endif; ?> Estatísticas de Referências <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_contact"
            <?php if ($this->_tpl_vars['feature_contact'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Contact" target="tikihelp" class="tikihelp" title="Entre em Contato"><?php endif; ?> Entre em Contato <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    </tr>
  <tr>
    <td><input type="checkbox" name="contact_anon"
            <?php if ($this->_tpl_vars['contact_anon'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Contact" target="tikihelp" class="tikihelp" title="Entre em Contato"><?php endif; ?> Contate-nos (Anônimo) <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="feature_redirect_on_error"
    	<?php if ($this->_tpl_vars['feature_redirect_on_error'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> Redirecionar em caso de erro </td>
    </tr>
</table>

<table width="100%" class="admin">
  <tr>
    <td class="heading" colspan="5"
            align="center">Recursos do Usuário</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_userPreferences"
            <?php if ($this->_tpl_vars['feature_userPreferences'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
User+Preferences" target="tikihelp" class="tikihelp" title="Tela de Preferências do Usuário"><?php endif; ?> Tela de Preferências do Usuário <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td align="right"><div align="right">
      <input type="checkbox" name="user_assigned_modules"
            <?php if ($this->_tpl_vars['user_assigned_modules'] == 'y'): ?>checked="checked"<?php endif; ?>/>
    </div></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Users+Configure+Modules" target="tikihelp" class="tikihelp" title="Usuários podem configurar módulos"><?php endif; ?> Usuários podem configurar módulos <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_user_bookmarks"
            <?php if ($this->_tpl_vars['feature_user_bookmarks'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Bookmarks" target="tikihelp" class="tikihelp" title="Favoritos"><?php endif; ?> Favoritos <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td><select name="user_flip_modules">
      <option value="y" <?php if ($this->_tpl_vars['user_flip_modules'] == 'y'): ?>selected="selected"<?php endif; ?>>sempre</option>
      <option value="module" <?php if ($this->_tpl_vars['user_flip_modules'] == 'module'): ?>selected="selected"<?php endif; ?>>módulo decide</option>
      <option value="n" <?php if ($this->_tpl_vars['user_flip_modules'] == 'n'): ?>selected="selected"<?php endif; ?>>nunca</option>
    </select></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Users+Shade+Modules" target="tikihelp" class="tikihelp" title="Usuários podem sombrear módulos"><?php endif; ?> Usuários podem sombrear módulos <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_user_watches"
            <?php if ($this->_tpl_vars['feature_user_watches'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Watch" target="tikihelp" class="tikihelp" title="Notificações do usuário"><?php endif; ?> Notificações do usuário <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td align="right"><div align="right">
      <input type="checkbox" name="feature_user_watches_translations"
            <?php if ($this->_tpl_vars['feature_user_watches_translations'] == 'y'): ?>checked="checked"<?php endif; ?>/>
    </div></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Watch" target="tikihelp" class="tikihelp" title="Usuários acompanham as traduções"><?php endif; ?> Usuários acompanham as traduções <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_usermenu"
            <?php if ($this->_tpl_vars['feature_usermenu'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
User+Menu" target="tikihelp" class="tikihelp" title="Menu do Usuário"><?php endif; ?> Menu do Usuário <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td align="right"><div align="right">
      <input type="checkbox" name="feature_tasks"
            <?php if ($this->_tpl_vars['feature_tasks'] == 'y'): ?>checked="checked"<?php endif; ?>/>
    </div></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Task" target="tikihelp" class="tikihelp" title="Tarefas do usuário"><?php endif; ?> Tarefas do usuário <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_messages"
            <?php if ($this->_tpl_vars['feature_messages'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Inter-User+Messages" target="tikihelp" class="tikihelp" title="Mensagens do usuário"><?php endif; ?> Mensagens do usuário <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
    <td align="right"><div align="right">
      <input type="checkbox" name="feature_userfiles"
            <?php if ($this->_tpl_vars['feature_userfiles'] == 'y'): ?>checked="checked"<?php endif; ?>/>
    </div></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
User+Files" target="tikihelp" class="tikihelp" title="Arquivos do usuário"><?php endif; ?> Arquivos do usuário <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="feature_notepad"
            <?php if ($this->_tpl_vars['feature_notepad'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
    <td class="form"> <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Notepad" target="tikihelp" class="tikihelp" title="Bloco de notas do usuário"><?php endif; ?> Bloco de notas do usuário <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?></td>
    <td>&nbsp;</td>
  </tr>
</table>

<table class="admin" width="100%">
<tr>


        <td class="heading" colspan="5" 
            align="center">Opções gerais de layout</td>
      </tr><tr>
        <td class="form">
	        	<?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Users+Flip+Columns" target="tikihelp" class="tikihelp" title="Usuários podem mudam colunas"><?php endif; ?>
        		Coluna da esquerda
        		<?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?>
        		:</td>
        <td><select name="feature_left_column">
            <option value="y" <?php if ($this->_tpl_vars['feature_left_column'] == 'y'): ?>selected="selected"<?php endif; ?>>sempre</option>
            <option value="user" <?php if ($this->_tpl_vars['feature_left_column'] == 'user'): ?>selected="selected"<?php endif; ?>>usuário decide</option>
            <option value="n" <?php if ($this->_tpl_vars['feature_left_column'] == 'n'): ?>selected="selected"<?php endif; ?>>nunca</option>
        </select></td>

      </tr><tr>
        <td class="form">
	        	<?php if ($this->_tpl_vars['feature_help'] == 'y'): ?><a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Users+Flip+Columns" target="tikihelp" class="tikihelp" title="Usuários podem mudam colunas"><?php endif; ?>
        		Coluna da direita
        		<?php if ($this->_tpl_vars['feature_help'] == 'y'): ?></a><?php endif; ?>
        		:</td>
        <td><select name="feature_right_column">
            <option value="y" <?php if ($this->_tpl_vars['feature_right_column'] == 'y'): ?>selected="selected"<?php endif; ?>>sempre</option>
            <option value="user" <?php if ($this->_tpl_vars['feature_right_column'] == 'user'): ?>selected="selected"<?php endif; ?>>usuário decide</option>
            <option value="n" <?php if ($this->_tpl_vars['feature_right_column'] == 'n'): ?>selected="selected"<?php endif; ?>>nunca</option>
        </select></td>

      </tr><tr>
        <td class="form">Layout por sessão</td>
        <td><input type="checkbox" name="layout_section"
            <?php if ($this->_tpl_vars['layout_section'] == 'y'): ?>checked="checked"/> <a href="tiki-admin_layout.php" class="link">Administrar layout por sessão</a> <?php endif; ?>
	</td>
      </tr><tr>
        <td class="form">Barra superior</td>
        <td><input type="checkbox" name="feature_top_bar"
            <?php if ($this->_tpl_vars['feature_top_bar'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
        <td colspan="3">&nbsp;</td>
      </tr><tr>
        <td class="form">Barra inferior</td>
        <td><input type="checkbox" name="feature_bot_bar"
            <?php if ($this->_tpl_vars['feature_bot_bar'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
        <td colspan="3">&nbsp;</td>
      </tr><tr>
      <td class="form">Ícones da barra inferior</td>
        <td><input type="checkbox" name="feature_bot_bar_icons"
            <?php if ($this->_tpl_vars['feature_bot_bar_icons'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
        <td colspan="3">&nbsp;</td>
      </tr><tr>
        <td class="form">Informações de <i>debug</i> na barra inferior</td>
        <td><input type="checkbox" name="feature_bot_bar_debug"
	    <?php if ($this->_tpl_vars['feature_bot_bar_debug'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
	<td colspan="3">&nbsp;</td>
      </tr><tr>
        <td colspan="5" class="button">
          <input type="submit" name="features" value="Alterar preferências" />
        </td>
      </tr></table>
    </div>
  </div>
</form>