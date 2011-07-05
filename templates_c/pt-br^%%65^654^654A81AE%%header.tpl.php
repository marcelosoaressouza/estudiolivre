<?php /* Smarty version 2.6.18, created on 2011-05-03 19:41:11
         compiled from styles/original/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'breadcrumbs', 'styles/original/header.tpl', 32, false),array('function', 'popup_init', 'styles/original/header.tpl', 132, false),array('modifier', 'escape', 'styles/original/header.tpl', 36, false),)), $this); ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="UTF-8"<?php echo '?>'; ?>

<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php if ($this->_tpl_vars['metatag_keywords'] != ''): ?><meta name="keywords" content="<?php echo $this->_tpl_vars['metatag_keywords']; ?>
" />
<?php endif; ?>
<?php if ($this->_tpl_vars['metatag_author'] != ''): ?><meta name="author" content="<?php echo $this->_tpl_vars['metatag_author']; ?>
" />
<?php endif; ?>
<?php if ($this->_tpl_vars['metatag_description'] != ''): ?><meta name="description" content="<?php echo $this->_tpl_vars['metatag_description']; ?>
" />
<?php endif; ?>
<?php if ($this->_tpl_vars['metatag_geoposition'] != ''): ?><meta name="geo.position" content="<?php echo $this->_tpl_vars['metatag_geoposition']; ?>
" />
<?php endif; ?>
<?php if ($this->_tpl_vars['metatag_georegion'] != ''): ?><meta name="geo.region" content="<?php echo $this->_tpl_vars['metatag_georegion']; ?>
" />
<?php endif; ?>
<?php if ($this->_tpl_vars['metatag_geoplacename'] != ''): ?><meta name="geo.placename" content="<?php echo $this->_tpl_vars['metatag_geoplacename']; ?>
" />
<?php endif; ?>
<?php if ($this->_tpl_vars['metatag_robots'] != ''): ?><meta name="robots" content="<?php echo $this->_tpl_vars['metatag_robots']; ?>
" />
<?php endif; ?>
<?php if ($this->_tpl_vars['metatag_revisitafter'] != ''): ?><meta name="revisit-after" content="<?php echo $this->_tpl_vars['metatag_revisitafter']; ?>
" />
<?php endif; ?>


<?php  include("lib/tiki-dynamic-js.php");  ?>
<script type="text/javascript" src="lib/tiki-js.js"></script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "bidi.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<title>
<?php if ($this->_tpl_vars['trail']): ?><?php echo smarty_function_breadcrumbs(array('type' => 'fulltrail','loc' => 'head','crumbs' => $this->_tpl_vars['trail']), $this);?>

<?php else: ?>
<?php echo $this->_tpl_vars['siteTitle']; ?>

<?php if ($this->_tpl_vars['headtitle']): ?> : <?php echo $this->_tpl_vars['headtitle']; ?>

<?php elseif ($this->_tpl_vars['page'] != ''): ?> : <?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 
<?php elseif ($this->_tpl_vars['arttitle'] != ''): ?> : <?php echo $this->_tpl_vars['arttitle']; ?>

<?php elseif ($this->_tpl_vars['title'] != ''): ?> : <?php echo $this->_tpl_vars['title']; ?>

<?php elseif ($this->_tpl_vars['thread_info']['title'] != ''): ?> : <?php echo $this->_tpl_vars['thread_info']['title']; ?>

<?php elseif ($this->_tpl_vars['post_info']['title'] != ''): ?> : <?php echo $this->_tpl_vars['post_info']['title']; ?>

<?php elseif ($this->_tpl_vars['forum_info']['name'] != ''): ?> : <?php echo $this->_tpl_vars['forum_info']['name']; ?>

<?php elseif ($this->_tpl_vars['categ_info']['name'] != ''): ?> : <?php echo $this->_tpl_vars['categ_info']['name']; ?>

<?php elseif ($this->_tpl_vars['userinfo']['login'] != ''): ?> : <?php echo $this->_tpl_vars['userinfo']['login']; ?>

<?php endif; ?>
<?php endif; ?>
</title>

<?php if ($this->_tpl_vars['transition_style'] != '' && $this->_tpl_vars['transition_style'] != 'none'): ?>
<link rel="StyleSheet"  href="styles/transitions/<?php echo $this->_tpl_vars['transition_style']; ?>
" type="text/css" />
<?php endif; ?>
<link rel="StyleSheet"  href="styles/<?php echo $this->_tpl_vars['style']; ?>
" type="text/css" />
<?php if ($this->_tpl_vars['favicon']): ?><link rel="icon" href="<?php echo $this->_tpl_vars['favicon']; ?>
" /><?php endif; ?>

<?php if ($this->_tpl_vars['feature_jscalendar'] == 'y' && $this->_tpl_vars['uses_jscalendar'] == 'y'): ?>
<link rel="StyleSheet" href="lib/jscalendar/calendar-system.css" type="text/css"></link>
<script language="JavaScript" type="text/javascript"><!--
<?php if ($this->_tpl_vars['feature_phplayers'] == 'y'): ?><?php  include_once ("lib/phplayers/libjs/layersmenu-browser_detection.js");  ?><?php endif; ?>
// --></script>
<script type="text/javascript" src="lib/jscalendar/calendar.js"></script>
<?php if ($this->_tpl_vars['jscalendar_langfile']): ?>
<script type="text/javascript" src="lib/jscalendar/lang/calendar-<?php echo $this->_tpl_vars['jscalendar_langfile']; ?>
.js"></script>
<?php else: ?>
<script type="text/javascript" src="lib/jscalendar/lang/calendar-en.js"></script>
<?php endif; ?>
<script type="text/javascript" src="lib/jscalendar/calendar-setup.js"></script>
<?php endif; ?>


<?php if ($this->_tpl_vars['feature_phplayers'] == 'y'): ?>
<link rel="StyleSheet" href="lib/phplayers/layerstreemenu.css" type="text/css"></link>
<style type="text/css"><!-- @import url("lib/phplayers/layerstreemenu-hidden.css"); //--></style>
<script language="JavaScript" type="text/javascript"><!--
<?php  include_once ("lib/phplayers/libjs/layersmenu-browser_detection.js");  ?>
// --></script>
<script language="JavaScript" type="text/javascript" src="lib/phplayers/libjs/layersmenu-library.js"></script>

<script language="JavaScript" type="text/javascript" src="lib/phplayers/libjs/layerstreemenu-cookies.js"></script>
<?php endif; ?>


<?php if (strlen ( $this->_tpl_vars['integrator_css_file'] ) > 0): ?>
<link rel="StyleSheet" href="<?php echo $this->_tpl_vars['integrator_css_file']; ?>
" type="text/css" />
<?php endif; ?>
    

<?php if ($this->_tpl_vars['uses_tabs'] == 'y'): ?>

<?php endif; ?>


<?php if ($this->_tpl_vars['feature_wiki'] == 'y' && $this->_tpl_vars['rss_wiki'] == 'y'): ?>
<link rel="alternate" type="application/xml" title="RSS Wiki" href="tiki-wiki_rss.php?ver=<?php echo $this->_tpl_vars['rssfeed_default_version']; ?>
" />
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_blogs'] == 'y' && $this->_tpl_vars['rss_blogs'] == 'y'): ?>
<link rel="alternate" type="application/xml" title="RSS Blogs" href="tiki-blogs_rss.php?ver=<?php echo $this->_tpl_vars['rssfeed_default_version']; ?>
" />
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_articles'] == 'y' && $this->_tpl_vars['rss_articles'] == 'y'): ?>
<link rel="alternate" type="application/xml" title="RSS Artigos" href="tiki-articles_rss.php?ver=<?php echo $this->_tpl_vars['rssfeed_default_version']; ?>
" />
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_galleries'] == 'y' && $this->_tpl_vars['rss_image_galleries'] == 'y'): ?>
<link rel="alternate" type="application/xml" title="RSS Galeria de imagens" href="tiki-image_galleries_rss.php?ver=<?php echo $this->_tpl_vars['rssfeed_default_version']; ?>
" />
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_file_galleries'] == 'y' && $this->_tpl_vars['rss_file_galleries'] == 'y'): ?>
<link rel="alternate" type="application/xml" title="RSS Galeria de arquivos" href="tiki-file_galleries_rss.php?<?php echo $this->_tpl_vars['rssfeed_default_version']; ?>
" />
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_forums'] == 'y' && $this->_tpl_vars['rss_forums'] == 'y'): ?>
<link rel="alternate" type="application/xml" title="RSS Fóruns" href="tiki-forums_rss.php?ver=<?php echo $this->_tpl_vars['rssfeed_default_version']; ?>
" />
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_maps'] == 'y' && $this->_tpl_vars['rss_mapfiles'] == 'y'): ?>
<link rel="alternate" type="application/xml" title="RSS Mapas" href="tiki-map_rss.php?ver=<?php echo $this->_tpl_vars['rssfeed_default_version']; ?>
" />
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_directory'] == 'y' && $this->_tpl_vars['rss_directories'] == 'y'): ?>
<link rel="alternate" type="application/xml" title="RSS Diretórios" href="tiki-directories_rss.php?ver=<?php echo $this->_tpl_vars['rssfeed_default_version']; ?>
" />
<?php endif; ?>



<script language="JavaScript" type="text/javascript" src="lib/elgal/el.js"></script>



<?php echo $this->_tpl_vars['trl']; ?>


</head>

<body <?php if ($this->_tpl_vars['user_dbl'] == 'y' && $this->_tpl_vars['dblclickedit'] == 'y' && $this->_tpl_vars['tiki_p_edit'] == 'y'): ?>ondblclick="location.href='tiki-editpage.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
';"<?php endif; ?>
<?php if ($this->_tpl_vars['show_comzone'] == 'y'): ?>onload="javascript:flip('comzone');"<?php endif; ?><?php if ($this->_tpl_vars['section']): ?> class="tiki_<?php echo $this->_tpl_vars['section']; ?>
"<?php endif; ?>>
<?php if ($this->_tpl_vars['minical_reminders'] > 100): ?>
	<iframe width='0' height='0' frameborder="0" src="tiki-minical_reminders.php"></iframe>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_community_mouseover']): ?><?php echo smarty_function_popup_init(array('src' => "lib/overlib.js"), $this);?>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_siteidentity'] == 'y'): ?>

	<div id="siteheader">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-site_header.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
<?php endif; ?>