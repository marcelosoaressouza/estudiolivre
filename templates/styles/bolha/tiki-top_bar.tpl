{css}
<!-- tiki-top_bar.tpl begin -->

<div id="tiki-top">
  <div id="topContainer">
  	{* Logo TESTE *}
    {if $showTeste}
  	 <a href="http://dev.estudiolivre.org/tiki-view_tracker.php?status=o&trackerId=13&offset=0&sort_mode=created_desc">
  	  {tooltip text="Clique aqui e <b>relate os bugs</b> encontrados! Ajude-nos a <b>melhorar</b> o EstúdioLivre!!!"}<img src="styles/{$style|replace:".css":""}/img/faixaTeste.{if $isIE}gif{else}png{/if}" style="position:absolute; top:-25px; left:0px; z-index:5"/>{/tooltip}
  	 </a>
    {/if}
  	<div id="logo">
      <a href="/">
        {tooltip name="navegue-home" text="Ir para a Página Inicial"}
          <img src="styles/{$style|replace:".css":""}/img/logoTop.png" alt="estudiolivre.org">
        {/tooltip}
      </a>
      {* idéia
      <div>
	    {tooltip name="saiba-estudiolivre" text="Saiba <b>o que é</b> o EstúdioLivre"}<a href="tiki-index.php?page=sobre&bl">{tr}sobre{/tr}</a>{/tooltip}
	  	{tooltip name="perguntas-frequentes" text="<b>Perguntas</b> mais freqüêntes"}<a href="tiki-index.php?page=faq&bl">{tr}faq{/tr}</a>{/tooltip}
	    {tooltip name="entre-contato" text="Entre em contato - descubra os <b>canais de comunicação</b> com a comunidade"}<a href="tiki-index.php?page=contato&bl">{tr}contato{/tr}</a>{/tooltip}
	  </div>
	  *}
    </div>
  
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
      <input id="searchField" name="highlight" size="15" type="text" accesskey="s" value="{tr}Buscar{/tr}" onFocus="if(this.value=='{tr}Buscar{/tr}')this.value=''"/><input class="submit" type="image" name="search" src="styles/{$style|replace:".css":""}/img/bSearch.png"/>
    </form>
  </div>
</div>
<script language="JavaScript">marcaBusca(selectedBusca);</script>

<div id="topMenu">
  <div id="topMenuGeneral">
  &nbsp;&nbsp;
    {tooltip name="saiba-estudiolivre" text="Saiba <b>o que é</b> o EstúdioLivre"}<a href="tiki-index.php?page=sobre&bl">{tr}sobre{/tr}</a>{/tooltip}
	|
	{tooltip name="perguntas-frequentes" text="<b>Perguntas</b> mais freqüêntes"}<a href="tiki-index.php?page=faq&bl">{tr}faq{/tr}</a>{/tooltip}
	|
	{tooltip name="entre-contato" text="Entre em contato - descubra os <b>canais de comunicação</b> com a comunidade"}<a href="tiki-index.php?page=contato&bl">{tr}contato{/tr}</a>{/tooltip}
&nbsp;&nbsp;||&nbsp;&nbsp;
	{tooltip name="wiki" text="Página principal do <b>wiki</b> do EstúdioLivre"}<a href="tiki-index.php">{tr}wiki{/tr}</a>{/tooltip}
	|
    {tooltip name="forum-discussoes" text="Fóruns de <b>discussões</b> - tire suas dúvidas aqui"}<a href="tiki-forums.php">{tr}forums{/tr}</a>{/tooltip}
    | 
    {tooltip text="Veja os <b>blogs</b> dos usuári@s do EstúdioLivre"}<a href="tiki-list_blogs.php">{tr}blogs{/tr}</a>{/tooltip}
    | 
    {tooltip text="Navegue pelas <b>tags</b> mais populares do EstúdioLivre"}<a href="el-tag_cloud.php">{tr}tags{/tr}</a>{/tooltip}
  </div>
    
	<div id="topMenuCubesContainer">
	
		{* Cores das Categorias *}
		{assign var=gallery value="Green"}
		{assign var=audio value="Orange"}
		{assign var=video value="Red"}
		{assign var=grafico value="Purple"}
		
		{if $category eq "Áudio"}{assign var='audioStyle' value="opacity:0.3"}{/if}
        <a style="{$audioStyle}" href="tiki-index.php?page=Áudio&bl" {if $isIE}title="AUDIO||LAB"{/if}>
          <img src="styles/{$style|replace:".css":""}/img/cube{$audio}.png">
	      <span id="audiolab">{tr}áudio{/tr}</span>
        </a>
	        
	    {if $category eq "Gráfico"}{assign var='graficoStyle' value="opacity:0.3"}{/if}
        <a style="{$graficoStyle}"  href="tiki-index.php?page=Gráfico&bl" {if $isIE}title="GRAFI||LAB"{/if}>
          <img src="styles/{$style|replace:".css":""}/img/cube{$grafico}.png">
		  <span id="grafilab">{tr}gráfico{/tr}</span>
        </a>

	    {if $category eq "Vídeo"}{assign var='videoStyle' value="opacity:0.3"}{/if}
        <a style="{$videoStyle}"  href="tiki-index.php?page=Vídeo&bl" {if $isIE}title="VIDEO||LAB"{/if}>
          <img src="styles/{$style|replace:".css":""}/img/cube{$video}.png">
	      <span id="videolab">{tr}vídeo{/tr}</span>
        </a>
	    
	    {if $category eq "gallery"}{assign var='galleryStyle' value="opacity:0.3"}{/if}
        <a style="{$galleryStyle}" href="el-gallery_home.php" {if $isIE}title="ACERVO.LIVRE"{/if}>
	        <img src="styles/{$style|replace:".css":""}/img/cube{$gallery}.png">
	        <span id="acervolivre">{tr}acervo{/tr}</span>      
        </a> 
        
	</div>
</div>

</div>

{if $isIE}
{include file="ie_notsupported.tpl"}
{/if}

<!-- tiki-top_bar.tpl end -->