<div id="sideContent">

<div class="userMenu catMenu">
	<h1 id="cat{$category}">

		{if $category neq "Áudio"}{assign var='audioStyle' value="unsel"}{/if}
        <a class="{$audioStyle}" href="tiki-index.php?page=Áudio&bl" {if $isIE}title="AUDIO||LAB"{/if}>
	      {tr}áudio{/tr}
        </a>
	        
	    {if $category neq "Gráfico"}{assign var='graficoStyle' value="unsel"}{/if}
        <a class="{$graficoStyle}"  href="tiki-index.php?page=Gráfico&bl" {if $isIE}title="GRAFI||LAB"{/if}>
		  <span>{tr}gráfico{/tr}</span>
        </a>

	    {if $category neq "Vídeo"}{assign var='videoStyle' value="unsel"}{/if}
        <a class="{$videoStyle}"  href="tiki-index.php?page=Vídeo&bl" {if $isIE}title="VIDEO||LAB"{/if}>
	      <span>{tr}vídeo{/tr}</span>
        </a>
	    
	    {if $category neq "gallery"}{assign var='galleryStyle' value="unsel"}{/if}
        <a class="{$galleryStyle}" href="el-gallery_home.php" {if $isIE}title="ACERVO.LIVRE"{/if}>
	        <span>{tr}acervo{/tr}</span>      
        </a> 
        
	</h1>
  {if $category eq "Áudio"}
  {********AUDIO*********}
	<div id="localMenu">
	<ul>
    {if $page eq "Softwares de Edição de Áudio"}
       <li class="selectedAudio">{tr}softwares{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=Softwares de Áudio">softwares</li>
    {/if}

    {if $page eq "equipamentos audio"}
       <li class="selectedAudio">{tr}equipamentos{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=equipamentos audio&bl">{tr}equipamentos{/tr}</a></li>
    {/if}

    {if $page eq "Produzindo Audio"}
       <li class="selectedAudio">{tr}produzindo{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=Produzindo+Audio&bl">{tr}produzindo{/tr}</a></li>
    {/if}
    
    {if $page eq "Links de Áudio"}
       <li class="selectedAudio">links</li>
    {else}
        <li><a href="tiki-index.php?page=Links+de+%C3%81udio&bl">{tr}links{/tr}</a></li>
    {/if}
	</ul>
	</div>
  {elseif $category eq "Gráfico"}
  {*********GRAFICO********}
	<div id="localMenu">
	<ul>
    {if $page eq "Softwares de Gráfico"}
       <li class="selectedGraf">{tr}softwares{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=Softwares de Gráfico&bl">softwares</a></li>
    {/if}
    
    {if $page eq "equipamentos grafico"}
       <li class="selectedGraf">{tr}equipamentos{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=equipamentos grafico&bl">{tr}equipamentos{/tr}</a></li>
    {/if}

    {if $page eq "Produzindo Gráfico"}
       <li class="selectedGraf">{tr}produzindo{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=Produzindo+Gráfico&bl">{tr}produzindo{/tr}</a></li>
    {/if}

    {if $page eq "Links de Gráfico"}
       <li class="selectedGraf">{tr}links{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=Links de Gráfico&bl">{tr}links{/tr}</a></li>
    {/if}
	</ul>
	</div>
  {elseif $category eq "Vídeo"}
  {*********VIDEO********}
	<div id="localMenu">
	<ul>
    {if $page eq "Softwares de Vídeo"}
       <li class="selectedVideo">{tr}softwares{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=Softwares de Vídeo&bl">{tr}softwares{/tr}</a></li>
    {/if}

    {if $page eq "equipamentos video"}
       <li class="selectedVideo">{tr}equipamentos{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=equipamentos video&bl">{tr}equipamentos{/tr}</a></li>
    {/if}
    
    {if $page eq "Produzindo Vídeo"}
       <li class="selectedVideo">{tr}produzindo{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=Produzindo+Vídeo&bl">{tr}produzindo{/tr}</a></li>
    {/if}

    {if $page eq "Links de Vídeo"}
       <li class="selectedVideo">{tr}links{/tr}</li>
    {else}
       <li><a href="tiki-index.php?page=Links de Vídeo&bl">{tr}links{/tr}</a></li>
    {/if}
	</ul>
	</div>
  {elseif $category eq "gallery"}
  {*********ACERVO********}
	<div id="localMenu">
	<ul>
    {if $current_location eq "el-gallery_upload.php"}      
      	<li class="selectedAcervo">{tr}compartilhe sua obra{/tr}</li>
    {else}
    	{if $user}
        	<li><a href="el-gallery_upload.php">{tr}compartilhe sua obra{/tr}</a></li>
        {else}
      		<div id="precisaLogar" style="display:none;width:200px;padding:5px">
      			{tr}Para compartilhar a sua obra no <b>Acervo Livre</b> é necessário se <a href="tiki-register.php">cadastrar</a> no site.{/tr}<br><br>
      			{tr}Se for cadastrado, efetue o login{/tr}:<br>

					    <form id="uLoginBox" action="tiki-login.php" method="post">
					      <input type="hidden" name="redirect" value="el-gallery_upload.php">
					      <input class="uText" type="text" name="user" id="login-user" size="12" value="{tr}user{/tr}" onFocus="this.value=''"/>
					      <input class="uText" type="text" name="pass" id="login-pass" size="10" value="{tr}senha{/tr}" onFocus="this.value='';this.type='password'"/>
					      <input type="image" name="login" src="styles/estudiolivre/iLogin.png" />      
					      <div id="uLoginOptions">
					        <a href="tiki-remind_password.php">&raquo; {tr}recuperar{/tr} {tr}senha{/tr}</a><br>
					      </div>
					   </form>

			  <br><br>
				{tr}Se preferir{/tr}, <a href="tiki-index.php?page=faq Acervo&bl">{tr}leia mais{/tr}</a> {tr}sobre o <b>Acervo Livre</b>{/tr}.
      		</div>
      		<li onclick="showLightbox('precisaLogar')" style="cursor:pointer"><a>{tr}compartilhe sua obra{/tr}</a></li>
        {/if}   
    {/if}
    
     <li><a href="tiki-index.php?page=faq">{tr}sobre o{/tr} {tr}acervo{/tr}</a></li>
	</ul>
	</div>
  {/if}
</div>

<div class="userMenu">
	<h1>
		{if $smarty.cookies.obsBusca eq 'none'}
				{assign var=display value="none"}
				{assign var=imgCurrent value="Left"}
				{assign var=imgChange value="Down"}	
		{/if}
		<span class="pointer" onclick="javascript:flip('moduleobsBusca');toggleImage(document.getElementById('TArrowobsBusca'),'iArrowGrey{$imgChange}.png');storeState('obsBusca');">
	        {tr}Buscar{/tr}<img id="TArrowobsBusca"  src="styles/estudiolivre/iArrowGrey{$imgCurrent}.png">
		</span>
	</h1>
	<div id="moduleobsBusca" style="display:{$display}">
		  <script language="JavaScript" src="lib/js/busca.js"></script>
		  <div id="search" onLoad="marcaBusca(getCookie('busca'));">
		    <form id='form-busca' name="searchForm" class="searchForm" method="get" action="tiki-searchresults.php" onSubmit="busca('{$category}', this.highlight.value); return false;">
		      <input type="hidden" name="where" value="pages">
		      <ul class="searchOptions">
		        <li id="busca-wiki" class="">{tooltip name="buscar-somente" text="Buscar somente nas páginas <b>wiki</b>"}<a onclick="marcaBusca('wiki')">{tr}wiki{/tr}</a>{/tooltip}</li>
		        <li id="busca-gallery" class="">{tooltip name="buscar-acervo" text="Buscar no <b>acervo</b> do EstúdioLivre"}<a onclick="marcaBusca('gallery')">{tr}acervo{/tr}</a>{/tooltip}</li>
		        <li id="busca-usuarios" class="">{tooltip text="Buscar <b>usuári@s</b> do EstúdioLivre"}<a onclick="marcaBusca('usuarios')">{tr}user{/tr}</a>{/tooltip}</li>
				<li id="busca-tags" class="">{tooltip text="Buscar conteúdos com uma <b>tag</b>"}<a onclick="marcaBusca('tags')">{tr}tag{/tr}</a>{/tooltip}</li>
				<li id="busca-blogs" class="">{tooltip text="Buscar <b>blogs</b> do EstúdioLivre"}<a onclick="marcaBusca('blogs')">{tr}blog{/tr}</a>{/tooltip}</li>
		      </ul>
		      <input id="searchField" name="highlight" size="15" type="text" accesskey="s"/><input class="submit" type="image" name="search" src="styles/{$style|replace:".css":""}/bSearch.png"/>
		    </form>
		  </div>
		  <script language="JavaScript">marcaBusca(selectedBusca);</script>
	</div>
</div>

  {foreach from=$right_modules item=module}
    {$module.data}
  {/foreach}
</div>