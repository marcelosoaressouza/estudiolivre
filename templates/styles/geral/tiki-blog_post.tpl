{css extra='tiki-view_blog_post_item'}
{*popup_init src="lib/overlib.js"*}

{if $blogId > 0 }
	{include file="blog-heading.tpl" nameOnly=1 id=$blogId creator=$blog_data.user created=$blog_data.created title=$blog_data.title}
{/if}
<div id="blogPosting">
	<h2>
		{if $postId}
			{tr}Edit Post{/tr}: <a class="pagetitle" href="tiki-blog_post.php?blogId={$blogId}&amp;postId={$postId}">{$title}</a>
		{else}
			{tr}Edit Post{/tr}
		{/if}
	</h2>
	{if $preview eq 'y'}
	<div id="blogPostPrev">
		
			<span class="pointer" onclick="javascript:flip('postPrevCont');toggleImage(document.getElementById('TArrowBlogPr'),'iArrowGreyRight.png');">
				<img id="TArrowBlogPr" src="styles/{$style|replace:".css":""}/img/iArrowGreyDown.png" />{tr}Preview{/tr}
			</span>
		
		<div id="postPrevCont" style="display:block">
			{assign var=coco value="teste"}
			{php}
			 	global $smarty;
				$vars=$smarty->_tpl_vars;
				
				$usePost = array( "title" => $vars["title"],
								 "user" => $vars["user"],
								 "blogId" => $vars["blogId"],
								 "created" => time()
				);
				
				$smarty->assign('usePost',$usePost);
			{/php}
			{include file="tiki-view_blog_post_item.tpl" previewingPost=1 text=$parsed_data post=$usePost use_title=$blog_data.use_title printingPost=1}
		</div>
		<div style="border-bottom:1px solid gray;height:1px;margin-top:2px"></div>
	</div>
	{/if}
	
	<form enctype="multipart/form-data" name='blogpost' method="post" action="tiki-blog_post.php" id ='editpageform'>
		<input type="hidden" name="wysiwyg" value="{$wysiwyg|escape}" />
		<input type="hidden" name="postId" value="{$postId|escape}" />
		<input type="hidden" name="blogId" value="{$blogId|escape}" />
		<h3>{tr}Blog{/tr}</h3>
		<select name="blogId">
			{section name=ix loop=$blogs}
				<option value="{$blogs[ix].blogId|escape}" {if $blogs[ix].blogId eq $blogId}selected="selected"{/if}>
					{$blogs[ix].title}
				</option>
			{/section}
		</select>
		
		{assign var=area_name value="blogedit"}
		
		{if $feature_smileys eq 'y'}
			{tr}Smileys{/tr}
			{include file="tiki-smileys.tpl" area_name='blogedit'}
		{/if}
	
		<br/>	
		{if $blog_data.use_title eq 'y' || !$blogId}
			<h3>{tr}Title{/tr}</h3>
			<input class="blogEdit" type="text" size="80" name="title" value="{$title|escape}" />
		{/if}
		<br/>
		
		<div id="blogeditCont">
			{if $wysiwyg eq 'n'}
				{include file=tiki-edit_help.tpl}
			{/if}
			{include file="textareasize.tpl" area_name='blogedit' formId='editpageform'}
			{include file=tiki-edit_help_tool.tpl area_name="blogedit"}
	
			<textarea id='blogedit' class="blogEdit" name="data" rows="{$rows}" cols="{$cols}" wrap="virtual">{$data|escape}</textarea>
			<input type="hidden" name="rows" value="{$rows}"/>
			<input type="hidden" name="cols" value="{$cols}"/>
		</div>
		{if $wysiwyg eq 'y'}
			<script type="text/javascript" src="lib/htmlarea/htmlarea.js"></script>
			<script type="text/javascript" src="lib/htmlarea/htmlarea-lang-en.js"></script>
			<script type="text/javascript" src="lib/htmlarea/dialog.js"></script>
			<style type="text/css">
				@import url(lib/htmlarea/htmlarea.css);
			</style>
			<script defer='defer'>(new HTMLArea(document.forms['blogpost']['data'])).generate();</script>
		{/if}
		<br />
		{if $feature_freetags eq 'y' and $tiki_p_freetags_tag eq 'y'}
				<br/>
				{include file=freetag.tpl}
		{/if}


		<div class="blogPostHelp">
			{tr}Use ...page... to separate pages in a multi-page post{/tr}
			<br/>
			{tr}Note: if you want to use images please save the post first and you
				will be able to edit/post images. Use the &lt;img&gt; snippet to include uploaded images in the textarea editor
				or use the image URL to include images using the WYSIWYG editor. {/tr}
		</div>
		
		{if $postId > 0}
		<br/>
			{tr}Upload image for this post{/tr}
			<br/>
			<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
			<input name="userfile1" class="blogEdit" type="file" />
			<br/><br/>
			{if count($post_images) > 0}
				{tr}Images{/tr}:
				{section name=ix loop=$post_images}
						<br/>
						<a href="tiki-blog_post.php?postId={$postId}&amp;remove_image={$post_images[ix].imgId}">
							<img border='0' src='styles/estudiolivre/iDelete.png' alt='{tr}Trash{/tr}'/>
						</a>
						<a class="link" href="tiki-view_blog_post_image.php?imgId={$post_images[ix].imgId}">{$post_images[ix].filename}</a>:  {$post_images[ix].link|escape}						
				{/section}
			{/if}
		{/if}
		
		<br/>
		{tr}Mark entry as private:{/tr}
		<input type="checkbox" name="blogpriv" {if $blogpriv eq 'y'}checked="checked"{/if} />

		{*
		<br/>
		{tr}Send trackback pings to:{/tr}<small>{tr}(comma separated list of URIs){/tr}</small>
		<textarea class="blogEdit" name="trackback" rows="3" cols="60">{section name=ix loop=$trackbacks_to}{if not $smarty.section.ix.first},{/if}{$trackbacks_to[ix]}{/section}</textarea>
		*}
		<input type="hidden" name="trackback" value="">
		
		{if $blog_spellcheck eq 'y'}
		<br/>
			{tr}Spellcheck{/tr}:
				<input type="checkbox" name="spellcheck" {if $spellcheck eq 'y'}checked="checked"{/if} />
		{/if}
		<br/>
		<div id="comButtons">
			<input type="submit" class="wikiaction" name="save" value="{tr}save{/tr}" />
			<input type="submit" class="wikiaction" name="preview" value="{tr}preview{/tr}" />
			<input type="submit" class="wikiaction" name="save_exit" value="{tr}save and exit{/tr}" />
		</div>
	</form>
</div>


	{*
	{if $wysiwyg eq 'n'}
		<span class="button2">
			<a class="linkbut" href="tiki-blog_post.php?{if $blogId ne ''}blogId={$blogId}&amp;{/if}{if $postId ne ''}&amp;postId={$postId}{/if}&amp;wysiwyg=y">
			{tr}Use wysiwyg editor{/tr}
			</a>
		</span>
	{else}
		<span class="button2">
			<a class="linkbut" href="tiki-blog_post.php?{if $blogId ne ''}blogId={$blogId}&amp;{/if}{if $postId ne ''}&amp;postId={$postId}{/if}&amp;wysiwyg=n">
				{tr}Use normal editor{/tr}
			</a>
		</span>
	{/if}
	<span class="button2"><a class="linkbut" href="tiki-list_blogs.php">{tr}list blogs{/tr}</a></span>
	*}