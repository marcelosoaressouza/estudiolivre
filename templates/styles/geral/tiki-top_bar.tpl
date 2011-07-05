{css}
<!-- tiki-top_bar.tpl begin -->

<div id="tiki-top">

  	{* Logo TESTE *}
    {if $showTeste}
  	 <a href="http://dev.estudiolivre.org/tiki-view_tracker.php?status=o&trackerId=13&offset=0&sort_mode=created_desc">
  	  {tooltip text="Clique aqui e <b>relate os bugs</b> encontrados! Ajude-nos a <b>melhorar</b> o EstúdioLivre!!!"}<img src="styles/{$style|replace:".css":""}/img/faixaTeste.{if $isIE}gif{else}png{/if}" style="position:absolute; top:-25px; left:0px; z-index:5"/>{/tooltip}
  	 </a>
    {/if}
  	<div id="logo">
		<a href="/">{tooltip name="navegue-home" text="Página Inicial"}
		<img src="styles/{$style|replace:".css":""}/img/logoTop.png" alt="estudiolivre.org">{/tooltip}
		</a>
	</div>
  
	<script language="JavaScript" src="lib/js/busca.js"></script>
	<div id="search" onLoad="marcaBusca(getCookie('busca'));">
		<form id='form-busca' name="searchForm" class="searchForm" method="get" action="tiki-searchresults.php" onSubmit="busca('{$category}', this.highlight.value); return false;">
			<input type="hidden" name="where" value="pages">
			<div class="searchOptions">
			<span id="busca-wiki" class="">{tooltip name="buscar-somente" text="Buscar somente nas páginas <b>wiki</b>"}<a onclick="marcaBusca('wiki')">{tr}wiki{/tr}</a>{/tooltip}</span> | 
			<span id="busca-gallery" class="">{tooltip name="buscar-acervo" text="Buscar no <b>acervo</b> do EstúdioLivre"}<a onclick="marcaBusca('gallery')">{tr}acervo{/tr}</a>{/tooltip}</span> | 
			<span id="busca-usuarios" class="">{tooltip text="Buscar <b>usuári@s</b> do EstúdioLivre"}<a onclick="marcaBusca('usuarios')">{tr}user{/tr}</a>{/tooltip}</span> |
			<span id="busca-tags" class="">{tooltip text="Buscar conteúdos com uma <b>tag</b>"}<a onclick="marcaBusca('tags')">{tr}tag{/tr}</a>{/tooltip}</span> | 
			<span id="busca-blogs" class="">{tooltip text="Buscar <b>blogs</b> do EstúdioLivre"}<a onclick="marcaBusca('blogs')">{tr}blog{/tr}</a>{/tooltip}</span> 
			</div>
			<input id="searchField" name="highlight" size="25" type="text" accesskey="s" value="{tr}Buscar{/tr}" onFocus="if(this.value=='{tr}Buscar{/tr}')this.value=''"/><input class="submit" type="image" name="search" src="styles/{$style|replace:".css":""}/img/bSearch.png"/>
		</form>
	</div>

<script language="JavaScript">marcaBusca(selectedBusca);</script>

	<div id="topMenu" >
		<div id="topMenuGeneral" class="topmenu az">
		<a href="tiki-index.php">{tr}wiki{/tr}&nbsp;</a><br/>
		<a href="tiki-forums.php">{tr}forums{/tr}&nbsp;</a><br/>
		<a href="tiki-list_blogs.php">{tr}blogs{/tr}&nbsp;</a><br/>
		<a href="el-tag_cloud.php">{tr}tags{/tr}&nbsp;</a>
		</div>
  
		<div id="topSubMenu" class="vm">
		<a href="tiki-index.php?page=sobre&bl">{tr}sobre{/tr}</a><br/>
		<a href="tiki-index.php?page=faq&bl">{tr}faq{/tr}</a><br/>
		<a href="tiki-index.php?page=contato&bl">{tr}contato{/tr}</a><br/>
		</div>
    
		<div id="topMenuCubesContainer" class="topmenu vr">
		<a href="el-gallery_home.php" {if $isIE}title="ACERVO.LIVRE"{/if}><span id="acervolivre" >{tr}acervo{/tr}&nbsp;</span></a><br /> 
		<a href="tiki-index.php?page=Áudio&bl" {if $isIE}title="AUDIO||LAB"{/if}><span id="audiolab">{tr}áudio{/tr}&nbsp;</span></a><br />
		<a href="tiki-index.php?page=Gráfico&bl" {if $isIE}title="GRAFI||LAB"{/if}><span id="grafilab">{tr}gráfico{/tr}&nbsp;</span></a><br />
		<a href="tiki-index.php?page=Vídeo&bl" {if $isIE}title="VIDEO||LAB"{/if}><span id="videolab">{tr}vídeo{/tr}&nbsp;</span></a><br />
		</div>
	</div>
	


</div>


<!-- tiki-top_bar.tpl end -->
