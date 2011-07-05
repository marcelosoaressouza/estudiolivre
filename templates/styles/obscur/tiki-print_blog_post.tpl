{include file='header.tpl'}
<link rel="StyleSheet"  href="styles/obscur/css/print.css" type="text/css" />

<div id="printLogo">
	<img src="styles/estudiolivre/logoTop.png">
</div>

<div id="printSite">
www.estudiolivre.org
</div>

{include file="blog-heading.tpl" nameOnly="y" printingPost=1 title=$blog_data.title creator=$blog_data.user created=$blog_data.created id=$blogId postId=$postId}

<h2>{tr}Viewing blog post{/tr}</h2>

{include file="tiki-view_blog_post_item.tpl" text=$parsed_data post=$post_info use_title=$blog_data.use_title printingPost=1 showPages=1}
<br/>