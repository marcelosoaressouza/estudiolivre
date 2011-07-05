<!-- tiki-user_information.tpl begin -->

<script language="JavaScript" src="lib/js/license.js"></script>
<script language="JavaScript" src="lib/js/user_edit.js"></script>
<script language="JavaScript" src="lib/js/edit_field_ajax.js"></script>

<div>
  <div>
    <div id="uName">
		{if $permission}
			{tooltip text="Selecione para tornar esta página pública"}
				{ajax_checkbox permission=$permission class="" id="isPublic" value=$isPublic}
			{/tooltip}
			{$userinfo.login}
			{tooltip text="Modifique as suas preferências"}
				<a href="tiki-user_preferences.php"><img src="img/mytiki/prefs.gif" height="15"></a>
			{/tooltip}
			{tooltip text="Modifique a organização de seus módulos"}
				<a href="tiki-user_assigned_modules.php"><img src="img/mytiki/modules.gif" height="15"></a>
			{/tooltip}
		{else}
			{$userinfo.login}
		{/if}
    </div>
    
    <div id="uContactKarmaAccount">
      <div id="uContact" class="uContactInfoCont left">
        {if $permission}
        	{tooltip text="Clique para modificar o seu <b>nome</b>"}
	        	{ajax_input permission=$permission id="realName" class="uContactItem" value=$realName default="{tr}Nome completo{/tr}" display="block"}
        	{/tooltip}
        {else}
        	{*TODO: mudar isso pra SPAN com tooltip*}
        	{ajax_input permission=$permission id="realName" class="uContactItem" value=$realName default="{tr}Nome completo{/tr}" display="block"}
        {/if}
        <br />
        {if $permission}
        	{tooltip text="Clique para modificar o seu <b>email</b>"}
		        {ajax_input permission=$permission id="email" class="uContactItem" value=$userinfo.email default="{tr}E-mail{/tr}" display="block" truncate='17'}        
		    {/tooltip}
        {else}
        	{*TODO mudar isso pra um mailto:*}
	        {ajax_input permission=$permission id="email" class="uContactItem" value=$userinfo.email default="{tr}E-mail{/tr}" display="block" truncate='17'}
	    {/if}
		<br />
        {if $permission}
        	{tooltip text="Clique para modificar o seu <b>site</b>"}
		        {ajax_input permission=$permission id="site" class="uContactItem" value=$site default="{tr}Site{/tr}" display="block" truncate='17'}        
		    {/tooltip}
        {else}
	        <a class="uContactItem" href="http://{$site|replace:'http://':''}" display="block">{$site|replace:'http://':''|truncate:22:"(...)":true}</a>
	    {/if}
		<br />
        {if $permission}
        	{tooltip text="Clique para modificar a sua <b>localização</b>"}
		        {ajax_input permission=$permission id="local" class="uContactItem" value=$local default="{tr}Localização{/tr}" display="inline"}        
		    {/tooltip}
        {else}	
        	{*TODO: mudar isso pra SPAN com tooltip*}	
	        {ajax_input permission=$permission id="local" class="uContactItem" value=$local default="{tr}Localização{/tr}" display="inline"}
	    {/if}
      </div>

      <div id="uKarmaThumb" class="uContactInfoCont center">
		<div id="uKarma">
		  {* TODO quando tiver karma
		  <img class="uKarmaImg" src="styles/estudiolivre/iKarma.png">
		  <img class="uKarmaImg" class="uKarmaImg" src="styles/estudiolivre/iKarma.png">
		  <img class="uKarmaImg" src="styles/estudiolivre/iKarmaInactive.png">
		  <img class="uKarmaImg" src="styles/estudiolivre/iKarmaInactive.png">
		  <img class="uKarmaImg" src="styles/estudiolivre/iKarmaInactive.png"> *}
		</div>

	    <div id="gUserThumb">
		  <img id="uThumbImg" alt="" src="tiki-show_user_avatar.php?user={$userinfo.login}" width="100px" />
		  <div id="gUserThumbStatus"></div>
		</div>

		{if $permission}
		{tooltip text="Clique aqui para selecionar um novo <b>avatar</b>"}
		<div id="gUserThumbFormContainer">
	      <div id="gUserThumbForm">
	        <iframe name="thumbUpTarget" style="display:none" onLoad="finishUpThumb();"></iframe>
	        <form action="el-user_thumb.php?UPLOAD_IDENTIFIER=thumb.{$uploadId}" method="post" enctype="multipart/form-data" name="thumbForm" target="thumbUpTarget">
		      <input type="hidden" name="UPLOAD_IDENTIFIER" value="thumb.{$uploadId}"/>
		      <input type="hidden" name="arquivoId" value=""/>
		      <input type="file" name="thumb" onChange="changeThumbStatus()" class="gUserThumbFormButton"/>
	        </form>
	      </div>
	    </div>
	    {/tooltip}
	    {/if}

	  </div>

      <div id="uAccountInfo" class="uContactInfoCont right">
        <!-- span class="uContactItem"><a href="#">(X) Amigos</a></span -->
        <br />
        {* TODO falar a descricao da licenca no tooltip *}
        <span class="uContactItem">
        	<span class="uContactItem">
        	{if $permission}        		
        			<span class="pointer" onClick="showLightbox('el-license')">
        			{if $licenca}
			    	   	{tooltip text="Clique para modificar a sua licença padrão"}
			    	   		<img id="ajax-uLicence" src="styles/estudiolivre/h_{$licenca.linkImagem}"/>
			    	   	{/tooltip}
			    	{else}
	    		    	<img id="ajax-uLicence" alt="({tr}Selecione sua licença Padrão{/tr})"/>
	    		    {/if}
	    		    </span>
	        {else}
		        {if $licenca}
			    	   	{tooltip text="Licença padrão desse(a) usuári@: "|cat:$licenca.descricao}<img id="ajax-uLicence" src="styles/estudiolivre/h_{$licenca.linkImagem}"/>{/tooltip}
		    	{else}
		        	({tr}Usuári@ sem Licença Padrão{/tr})
		        {/if}
		    {/if}
        	</span>
        </span>
        <br />
        <span class="uContactItem"><a href="tiki-lastchanges.php?find={$userinfo.login}&sort_mode=lastModif_desc&days=0">{tr}Contribuições Recentes{/tr}</a></span>
        <br />
        <span class="uContactItem uLittle">{tr}Membro desde{/tr} {$userinfo.registrationDate|date_format:"%d/%m/%Y"}</span>
      </div>  
    </div>
    <br>
    <div id="uGallery" class="uMainContainer">
      <div id="uGalleryTitle" class="sectionTitle uMainTitle uSectionsTitle">
		<a name="gallery" class="uRssCont" href="el-gallery_rss.php?user={$userinfo.login}&ver=2"><img src="styles/estudiolivre/iRss.png"></a>
        <h1>
           <span class="pointer" onclick="javascript:flip('uGalleryItems');toggleImage(document.getElementById('gTArrow'),'iArrowGreyRight.png')">
           	<img id="gTArrow" src="styles/estudiolivre/iArrowGreyDown.png">
        	&nbsp;
	        {tr}Galeria pessoal{/tr}
	       </span>
        </h1>
      </div>
      <div id="uGalleryItems" class="uMainItemContainer" style="display:block">
      {if sizeof($arquivos)}
      	<div id="ajax-listNav" class="ulistNav">{include file="el-gallery_pagination.tpl"}</div>
		<div id="ajax-gListCont">{include file="el-gallery_section.tpl"}</div>
	  {else}
	  	{if $permission}
		  	<p> {tr}Você ainda não possui arquivos no acervo livre{/tr}. <a href="el-gallery_upload.php">{tr}Compartilhe{/tr}</a> {tr}sua obra{/tr}!</p>
	  	{else}
	  		<p> {tr}Esse(a) usuári@ ainda não possui arquivos no acervo livre{/tr}.</p>
	  	{/if}
	  {/if}
      </div>
    </div>
    <div id="uBlog" class="uMainContainer">
      <div id="uBlogTitle" class="sectionTitle uMainTitle">
        <a name="blogs" class="uRssCont" href="el-userblogs_rss.php?user={$userinfo.login}&ver=2"><img src="styles/estudiolivre/iRss.png"></a>
        <h1>
          <span class="pointer" onclick="javascript:flip('uBlogItems');toggleImage(document.getElementById('bTArrow'),'iArrowGreyRight.png')" >
            <img id="bTArrow" src="styles/estudiolivre/iArrowGreyDown.png">
	        &nbsp;
          	{tr}Blogs{/tr}
          </span>
        </h1>
      </div>
      <div id="uBlogItems" class="uMainItemContainer" style="display:block">
        {if sizeof($userPosts.data)}
	      	{foreach from=$userPosts.data item='post'}
	        <div class="uBlogItem">
	          <div id="uBlogItemTitle">
	            <h1>{$post.title|truncate:40}</h1> - {$post.created|date_format:"%d/%m/%Y"}
	          </div>
	          <div id="uBlogItemText">
	            {$post.data|truncate:150} <a href="#" title="Ler mais...">(...)</a>
	          </div>
	          <div id="uBlogItemBottom">
	            <a href="tiki-view_blog_post.php?blogId={$post.blogId}&postId={$post.postId}">ler mais</a> | 
	            <a href="tiki-view_blog_post.php?blogId={$post.blogId}&postId={$post.postId}">permalink</a> | 
	            <a href="tiki-view_blog_post.php?blogId={$post.blogId}&postId={$post.postId}&show_comments=1#comments">({$post.commentsCount}) {tr}comentaram{/tr}</a>
	          </div>
	        </div>
	        {/foreach}
		{else}
		  	{if $permission}
			  	<p> {tr}Você ainda não possui blogs{/tr}. <a href="tiki-edit_blog.php">{tr}Crie</a> um blog ou veja a {/tr}<a href="tiki-list_blogs.php">{tr}lista{/tr}</a> {tr}dos existentes{/tr}.</p>
		  	{else}
		  		<p> {tr}Esse(a) usuári@ ainda não possui posts em blogs{/tr}.</p>
			{/if}
		{/if}
      </div>
    </div>
    {if $allowMsgs || $permission}
    <div id="uMsgs" class="uMainContainer">
      <div id="uMsgsTitle" class="sectionTitle uMainTitle">
        <a name="messages" class="uRssCont" href="el-usermsgs_rss.php?user={$userinfo.login}&ver=2"><img src="styles/estudiolivre/iRss.png"></a>
        <h1>
        	<span class="pointer" onclick="javascript:flip('uMsgItems');toggleImage(document.getElementById('rTArrow'),'iArrowGreyRight.png')">
        	  	<img id="rTArrow" src="styles/estudiolivre/iArrowGreyDown.png">
		        &nbsp;
		        {tr}Recados{/tr}
	        </span>
        </h1>
        {if $permission}
			{tooltip text="Selecione para permitir que outr@s usuári@s mandem mensagens para você"}
				&nbsp;&nbsp;&nbsp;&nbsp;
				{ajax_checkbox permission=$permission class="" id="allowMsgs" value=$allowMsgs}
			{/tooltip}
		{/if}
      </div>
      <div id="uMsgItems" class="uMainItemContainer" style="display:block">
      	{if $allowMsgs}
	      	<div class="listNav" id="ajax-msgListNav">{include file="el-msg_pagination.tpl"}</div>
	      	<span id="ajax-userMsgs">{include file="el-user_msg.tpl"}</span>
	    {/if}
      </div>
    </div>
    {/if}
    <div id="uWiki" class="uMainContainer">
    	<div id="uWikiTitle" class="sectionTitle uMainTitle">
    		<a class="uRssCont" href="tiki-wiki_rss.php?ver=2"><img src="styles/estudiolivre/iRss.png"></a>
    		<h1>
    		  <span class="pointer" title="Wiki de {$userinfo.login}" onclick="javascript:flip('uWikiMid');toggleImage(document.getElementById('wTArrow'),'iArrowGreyRight.png')" >
	    	 	<img id="wTArrow" src="styles/estudiolivre/iArrowGreyDown.png">
    	    	&nbsp;
    		  	{tr}Wiki{/tr}
    		  </span>
    		</h1>
    	</div>
    	<div id="uWikiMid" style="display:block">
		  {if $userWiki}
	    	{include file=tiki-show_page.tpl parsed=$userWiki page=$pageName lastUser=$modifUser}
	      {else}
	      	{if $permission}
	      		<p> {tr}Você ainda não tem uma página wiki pessoal{/tr}. <a href="tiki-editpage.php?page={$pageName}">{tr}Crie{/tr}</a> {tr}seu wiki{/tr}!</p>
	      	{else}
	      		<p> {tr}Esse(a) usuári@ ainda não possui uma página wiki pessoal{/tr} </p>
	      	{/if}
	      {/if}
        </div>
    </div>
  </div>
</div>

{if $permission}
	{include file="el-license.tpl"}
{/if}

<!-- tiki-user_information.tpl end -->
