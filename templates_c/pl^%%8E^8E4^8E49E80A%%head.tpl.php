<?php /* Smarty version 2.6.18, created on 2011-04-15 16:07:58
         compiled from styles/bolha/head.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'breadcrumbs', 'styles/bolha/head.tpl', 34, false),array('modifier', 'escape', 'styles/bolha/head.tpl', 38, false),array('modifier', 'replace', 'styles/bolha/head.tpl', 51, false),)), $this); ?>
<!-- head.tpl begin -->


<head>
  
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php if ($this->_tpl_vars['metatag_keywords'] != ''): ?>
		<meta name="keywords" content="<?php echo $this->_tpl_vars['metatag_keywords']; ?>
" />
	<?php endif; ?>
	<?php if ($this->_tpl_vars['metatag_author'] != ''): ?>
		<meta name="author" content="<?php echo $this->_tpl_vars['metatag_author']; ?>
" />
	<?php endif; ?>
	<?php if ($this->_tpl_vars['metatag_description'] != ''): ?>
		<meta name="description" content="<?php echo $this->_tpl_vars['metatag_description']; ?>
" />
	<?php endif; ?>
	<?php if ($this->_tpl_vars['metatag_geoposition'] != ''): ?>
		<meta name="geo.position" content="<?php echo $this->_tpl_vars['metatag_geoposition']; ?>
" />
	<?php endif; ?>
	<?php if ($this->_tpl_vars['metatag_georegion'] != ''): ?>
		<meta name="geo.region" content="<?php echo $this->_tpl_vars['metatag_georegion']; ?>
" />
	<?php endif; ?>
	<?php if ($this->_tpl_vars['metatag_geoplacename'] != ''): ?>
		<meta name="geo.placename" content="<?php echo $this->_tpl_vars['metatag_geoplacename']; ?>
" />
	<?php endif; ?>
	<?php if ($this->_tpl_vars['metatag_robots'] != ''): ?>
		<meta name="robots" content="<?php echo $this->_tpl_vars['metatag_robots']; ?>
" />
	<?php endif; ?>
	<?php if ($this->_tpl_vars['metatag_revisitafter'] != ''): ?>
		<meta name="revisit-after" content="<?php echo $this->_tpl_vars['metatag_revisitafter']; ?>
" />
	<?php endif; ?>

	<title>
		<?php if ($this->_tpl_vars['trail']): ?>
			<?php echo smarty_function_breadcrumbs(array('type' => 'fulltrail','loc' => 'head','crumbs' => $this->_tpl_vars['trail']), $this);?>

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
    
	<link rel="StyleSheet"  href="styles/<?php echo $this->_tpl_vars['style']; ?>
" type="text/css" />
	<link rel="StyleSheet"  href="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/css/tooltip.css" type="text/css" />
  
	
		<script language="JavaScript" type="text/javascript" src="lib/ajax/tiki-ajax.js"></script>
		<?php echo $this->_tpl_vars['xajax_js']; ?>

		<script type="text/javascript" src="lib/js/general.js"></script>		
		<script type="text/javascript" src="lib/js/toggleImage.js"></script>
		<script language="JavaScript" type="text/javascript" src="lib/js/tooltip.js"></script>
		<script language="JavaScript" src="lib/elgal/player/cortado.js"></script>
		<script language="JavaScript">var style = '<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
'</script>
	
	
	<?php if ($this->_tpl_vars['favicon']): ?>
		<?php if ($this->_tpl_vars['showTeste']): ?>
			<link rel="icon" href="favicon_teste.png" />
		<?php else: ?>
			<link rel="icon" href="<?php echo $this->_tpl_vars['favicon']; ?>
" />
		<?php endif; ?>
	<?php endif; ?>  
  
	
	  <link rel="alternate" type="application/xml" title="RSS Acervo Livre" href="el-gallery_rss.php?ver=<?php echo $this->_tpl_vars['rssfeed_default_version']; ?>
" />
	  <?php if ($this->_tpl_vars['feature_wiki'] == 'y' && $this->_tpl_vars['rss_wiki'] == 'y'): ?>
		  <link rel="alternate" type="application/xml" title="RSS Wiki" href="tiki-wiki_rss.php?ver=<?php echo $this->_tpl_vars['rssfeed_default_version']; ?>
" />
	  <?php endif; ?>
	  <?php if ($this->_tpl_vars['feature_blogs'] == 'y' && $this->_tpl_vars['rss_blogs'] == 'y'): ?>
		  <link rel="alternate" type="application/xml" title="RSS Blogs" href="tiki-blogs_rss.php?ver=<?php echo $this->_tpl_vars['rssfeed_default_version']; ?>
" />
	  <?php endif; ?>
	  <?php if ($this->_tpl_vars['feature_articles'] == 'y' && $this->_tpl_vars['rss_articles'] == 'y'): ?>
		  <link rel="alternate" type="application/xml" title="RSS Articles" href="tiki-articles_rss.php?ver=<?php echo $this->_tpl_vars['rssfeed_default_version']; ?>
" />
	  <?php endif; ?>
	  <?php if ($this->_tpl_vars['feature_galleries'] == 'y' && $this->_tpl_vars['rss_image_galleries'] == 'y'): ?>
		  <link rel="alternate" type="application/xml" title="RSS Image Galleries" href="tiki-image_galleries_rss.php?ver=<?php echo $this->_tpl_vars['rssfeed_default_version']; ?>
" />
	  <?php endif; ?>
	  <?php if ($this->_tpl_vars['feature_file_galleries'] == 'y' && $this->_tpl_vars['rss_file_galleries'] == 'y'): ?>
		  <link rel="alternate" type="application/xml" title="RSS File Galleries" href="tiki-file_galleries_rss.php?<?php echo $this->_tpl_vars['rssfeed_default_version']; ?>
" />
	  <?php endif; ?>
	  <?php if ($this->_tpl_vars['feature_forums'] == 'y' && $this->_tpl_vars['rss_forums'] == 'y'): ?>
		  <link rel="alternate" type="application/xml" title="RSS Forums" href="tiki-forums_rss.php?ver=<?php echo $this->_tpl_vars['rssfeed_default_version']; ?>
" />
	  <?php endif; ?>
	  <?php if ($this->_tpl_vars['feature_maps'] == 'y' && $this->_tpl_vars['rss_mapfiles'] == 'y'): ?>
		  <link rel="alternate" type="application/xml" title="RSS Maps" href="tiki-map_rss.php?ver=<?php echo $this->_tpl_vars['rssfeed_default_version']; ?>
" />
	  <?php endif; ?>
	  <?php if ($this->_tpl_vars['feature_directory'] == 'y' && $this->_tpl_vars['rss_directories'] == 'y'): ?>
		  <link rel="alternate" type="application/xml" title="RSS Directories" href="tiki-directories_rss.php?ver=<?php echo $this->_tpl_vars['rssfeed_default_version']; ?>
" />
	  <?php endif; ?>
	
	
</head>
<!-- head.tpl end -->