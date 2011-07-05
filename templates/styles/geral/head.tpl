<!-- head.tpl begin -->
{* --- IMPORTANT: If you edit this (or any other TPL file) file via the Tiki built-in TPL editor (tiki-edit_templates.php), all the javascript will be stripped. This will cause problems. (Ex.: menus stop collapsing/expanding).
You should only modify header.tpl via a text editor through console, or ssh, or FTP edit commands. And only if you know what you are doing ;-)
You are most likely wanting to modify the top of your Tiki site. Please consider using Site Identity feature or modifying tiki-top_bar.tpl which you can do safely via the web-based interface.       --- *}

<head>
  
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	{if $metatag_keywords ne ''}
		<meta name="keywords" content="{$metatag_keywords}" />
	{/if}
	{if $metatag_author ne ''}
		<meta name="author" content="{$metatag_author}" />
	{/if}
	{if $metatag_description ne ''}
		<meta name="description" content="{$metatag_description}" />
	{/if}
	{if $metatag_geoposition ne ''}
		<meta name="geo.position" content="{$metatag_geoposition}" />
	{/if}
	{if $metatag_georegion ne ''}
		<meta name="geo.region" content="{$metatag_georegion}" />
	{/if}
	{if $metatag_geoplacename ne ''}
		<meta name="geo.placename" content="{$metatag_geoplacename}" />
	{/if}
	{if $metatag_robots ne ''}
		<meta name="robots" content="{$metatag_robots}" />
	{/if}
	{if $metatag_revisitafter ne ''}
		<meta name="revisit-after" content="{$metatag_revisitafter}" />
	{/if}

	<title>
		{if $trail}
			{breadcrumbs type="fulltrail" loc="head" crumbs=$trail}
		{else}
			{$siteTitle}
			{if $headtitle} : {$headtitle}
			{elseif $page ne ''} : {$page|escape} {* add $description|escape if you want to put the description *}
			{elseif $arttitle ne ''} : {$arttitle}
			{elseif $title ne ''} : {$title}
			{elseif $thread_info.title ne ''} : {$thread_info.title}
			{elseif $post_info.title ne ''} : {$post_info.title}
			{elseif $forum_info.name ne ''} : {$forum_info.name}
			{elseif $categ_info.name ne ''} : {$categ_info.name}
			{elseif $userinfo.login ne ''} : {$userinfo.login}
			{/if}
		{/if}
	</title>
    
	<link rel="StyleSheet"  href="styles/{$style}" type="text/css" />
	<link rel="StyleSheet"  href="styles/{$style|replace:".css":""}/css/tooltip.css" type="text/css" />
  
	{* ---- JavaScripts ----*}
		<script language="JavaScript" type="text/javascript" src="lib/ajax/tiki-ajax.js"></script>
		{$xajax_js}
		<script type="text/javascript" src="lib/js/general.js"></script>		
		<script type="text/javascript" src="lib/js/toggleImage.js"></script>
		<script language="JavaScript" type="text/javascript" src="lib/js/tooltip.js"></script>
		<script language="JavaScript" src="lib/elgal/player/cortado.js"></script>
	{* ---- END ---- *}
	
	{if $favicon}
		{if $showTeste}
			<link rel="icon" href="favicon_teste.png" />
		{else}
			<link rel="icon" href="{$favicon}" />
		{/if}
	{/if}  
  
	{* --- Firefox RSS icons --- *}
	  <link rel="alternate" type="application/xml" title="{tr}RSS Acervo Livre{/tr}" href="el-gallery_rss.php?ver={$rssfeed_default_version}" />
	  {if $feature_wiki eq 'y' and $rss_wiki eq 'y'}
		  <link rel="alternate" type="application/xml" title="{tr}RSS Wiki{/tr}" href="tiki-wiki_rss.php?ver={$rssfeed_default_version}" />
	  {/if}
	  {if $feature_blogs eq 'y' and $rss_blogs eq 'y'}
		  <link rel="alternate" type="application/xml" title="{tr}RSS Blogs{/tr}" href="tiki-blogs_rss.php?ver={$rssfeed_default_version}" />
	  {/if}
	  {if $feature_articles eq 'y' and $rss_articles eq 'y'}
		  <link rel="alternate" type="application/xml" title="{tr}RSS Articles{/tr}" href="tiki-articles_rss.php?ver={$rssfeed_default_version}" />
	  {/if}
	  {if $feature_galleries eq 'y' and $rss_image_galleries eq 'y'}
		  <link rel="alternate" type="application/xml" title="{tr}RSS Image Galleries{/tr}" href="tiki-image_galleries_rss.php?ver={$rssfeed_default_version}" />
	  {/if}
	  {if $feature_file_galleries eq 'y' and $rss_file_galleries eq 'y'}
		  <link rel="alternate" type="application/xml" title="{tr}RSS File Galleries{/tr}" href="tiki-file_galleries_rss.php?{$rssfeed_default_version}" />
	  {/if}
	  {if $feature_forums eq 'y' and $rss_forums eq 'y'}
		  <link rel="alternate" type="application/xml" title="{tr}RSS Forums{/tr}" href="tiki-forums_rss.php?ver={$rssfeed_default_version}" />
	  {/if}
	  {if $feature_maps eq 'y' and $rss_mapfiles eq 'y'}
		  <link rel="alternate" type="application/xml" title="{tr}RSS Maps{/tr}" href="tiki-map_rss.php?ver={$rssfeed_default_version}" />
	  {/if}
	  {if $feature_directory eq 'y' and $rss_directories eq 'y'}
		  <link rel="alternate" type="application/xml" title="{tr}RSS Directories{/tr}" href="tiki-directories_rss.php?ver={$rssfeed_default_version}" />
	  {/if}
	{* ---- END ---- *}
	
	{* load tooltip images first *}
		<script>preloadImgsNow('{$style|replace:".css":""}');</script>
	{* --- *}
	
</head>
<!-- head.tpl end -->