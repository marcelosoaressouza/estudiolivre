<!-- head.tpl begin -->

{* --- IMPORTANT: If you edit this (or any other TPL file) file via the Tiki built-in TPL editor (tiki-edit_templates.php), all the javascript will be stripped. This will cause problems. (Ex.: menus stop collapsing/expanding).

You should only modify header.tpl via a text editor through console, or ssh, or FTP edit commands. And only if you know what you are doing ;-)

You are most likely wanting to modify the top of your Tiki site. Please consider using Site Identity feature or modifying tiki-top_bar.tpl which you can do safely via the web-based interface.       --- *}
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  {if $metatag_keywords ne ''}<meta name="keywords" content="{$metatag_keywords}" />
  {/if}
  {if $metatag_author ne ''}<meta name="author" content="{$metatag_author}" />
  {/if}
  {if $metatag_description ne ''}<meta name="description" content="{$metatag_description}" />
  {/if}
  {if $metatag_geoposition ne ''}<meta name="geo.position" content="{$metatag_geoposition}" />
  {/if}
  {if $metatag_georegion ne ''}<meta name="geo.region" content="{$metatag_georegion}" />
  {/if}
  {if $metatag_geoplacename ne ''}<meta name="geo.placename" content="{$metatag_geoplacename}" />
  {/if}
  {if $metatag_robots ne ''}<meta name="robots" content="{$metatag_robots}" />
  {/if}
  {if $metatag_revisitafter ne ''}<meta name="revisit-after" content="{$metatag_revisitafter}" />
  {/if}
  
  {* --- tikiwiki block --- *}
  {php} include("lib/tiki-dynamic-js.php"); {/php}
  <script type="text/javascript" src="lib/tiki-js.js"></script>
  <script type="text/javascript" src="lib/js/toggleImage.js"></script>
  {include file="bidi.tpl"}
  <title>
  {if $trail}{breadcrumbs type="fulltrail" loc="head" crumbs=$trail}
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
  
  {if $transition_style ne '' and $transition_style ne 'none' }
  <link rel="StyleSheet"  href="styles/transitions/{$transition_style}" type="text/css" />
  {/if}
  
  <link rel="StyleSheet"  href="styles/{$style}" type="text/css" />
  
  {* CSS com fixes do IE *}
  <!--[if lte IE 6]>
    <link rel="StyleSheet"  href="styles/estudiolivre/ie.css" type="text/css" />
  <![endif]-->
  
  
  {if $favicon}
	  {if $showTeste}
			<link rel="icon" href="favicon_teste.png" />
	  {else}
			<link rel="icon" href="{$favicon}" />
  	{/if}
  {/if}
  {* --- jscalendar block --- *}
  {if $feature_jscalendar eq 'y' and $uses_jscalendar eq 'y'}
  <link rel="StyleSheet" href="lib/jscalendar/calendar-system.css" type="text/css"></link>
  <script language="JavaScript" type="text/javascript"><!--
  {if $feature_phplayers eq 'y'}{php} include_once ("lib/phplayers/libjs/layersmenu-browser_detection.js"); {/php}{/if}
  // --></script>
  <script type="text/javascript" src="lib/jscalendar/calendar.js"></script>
  {if $jscalendar_langfile}
  <script type="text/javascript" src="lib/jscalendar/lang/calendar-{$jscalendar_langfile}.js"></script>
  {else}
  <script type="text/javascript" src="lib/jscalendar/lang/calendar-en.js"></script>
  {/if}
  <script type="text/javascript" src="lib/jscalendar/calendar-setup.js"></script>
  {/if}
  
  {* --- phplayers block --- *}
  {if $feature_phplayers eq 'y'}
  <link rel="StyleSheet" href="lib/phplayers/layerstreemenu.css" type="text/css"></link>
  <style type="text/css"><!-- @import url("lib/phplayers/layerstreemenu-hidden.css"); //--></style>
  <script language="JavaScript" type="text/javascript"><!--
  {php} include_once ("lib/phplayers/libjs/layersmenu-browser_detection.js"); {/php}
  // --></script>
  <script language="JavaScript" type="text/javascript" src="lib/phplayers/libjs/layersmenu-library.js"></script>
  {*
  <script language="JavaScript" type="text/javascript" src="lib/phplayers/libjs/layersmenu.js"></script>
  *}
  <script language="JavaScript" type="text/javascript" src="lib/phplayers/libjs/layerstreemenu-cookies.js"></script>
  {/if}
  
  {* --- Integrator block --- *}
  {if strlen($integrator_css_file) > 0}
  <link rel="StyleSheet" href="{$integrator_css_file}" type="text/css" />
  {/if}
  
  {* --- tabs block (for myTiki, calendar, and more to come) --- *}
  {if $uses_tabs eq 'y'}
  {* tabs lib removed because non-free *}
  {/if}
  
  {* --- Firefox RSS icons --- *}
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
  
  {* ------------ scripts do el --------------*}
  {$xajax_js}
  <script language="JavaScript" type="text/javascript" src="lib/js/tooltip.js"></script>
  <script language="JavaScript" src="lib/elgal/player/cortado.js"></script>
  <script language="JavaScript" type="text/javascript" src="lib/ajax/tiki-ajax.js"></script>
  
  {* ------- fim -------- *}
  
  {$trl}
  
  
  <!-- script para transparencia de pngs no browser Internet Explorer -->
  {literal}
  <script language="JavaScript" type="text/javascript">
  // Correctly handle PNG transparency in Win IE 5.5 or higher.
  // http://homepage.ntlworld.com/bobosola. Updated 02-March-2004
  
  function correctPNG() 
  {
  for(var i=0; i<document.images.length; i++)
  {
  var img = document.images[i]
  var imgName = img.src.toUpperCase()
  if (imgName.substring(imgName.length-3, imgName.length) == "PNG")
  {
  var imgID = (img.id) ? "id='" + img.id + "' " : ""
  var imgClass = (img.className) ? "class='" + img.className + "' " : ""
  var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' "
  var imgStyle = "display:inline-block;" + img.style.cssText 
  if (img.align == "left") imgStyle = "float:left;" + imgStyle
  if (img.align == "right") imgStyle = "float:right;" + imgStyle
  if (img.parentElement.href) imgStyle = "cursor:hand;" + imgStyle		
  var strNewHTML = "<span " + imgID + imgClass + imgTitle
  + " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";"
  + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
  + "(src=\'" + img.src + "\', sizingMethod='scale');\"></span>" 
  img.outerHTML = strNewHTML
  i = i-1
  }
  }
  }
  //window.attachEvent("onload", correctPNG);
  </script>
  {/literal}
  
<!-- head.tpl end -->
