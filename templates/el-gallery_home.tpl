<!-- el-gallery_home.tpl begin -->
{css extra=tiki-show_page}

<script language="JavaScript" src="lib/js/el_array.js"></script>
<script language="JavaScript" src="lib/elgal/el_home.js"></script>
<script language="JavaScript" src="lib/js/delete_file.js"></script>

<script language="JavaScript">
	init('{$find}');
	{foreach from=$tipos item=tipo}tipos.add('{$tipo}');{/foreach}
</script>

{if $smarty.cookies.gHomeWikiToggle eq 'none'}
	{assign var=display value="none"}
	{assign var=imgCurrent value="iGreenArrowLeft"}
	{assign var=imgChange value="sortArrowDown"}	
{else}
	{assign var=display value="block"}
	{assign var=imgCurrent value="sortArrowDown"}
	{assign var=imgChange value="iGreenArrowLeft"}	
{/if}

<!-- Feature Wiki Begin -->
<div id="gHomeWiki" {if $tiki_p_edit eq 'y'} ondblclick="location.href='tiki-editpage.php?page=destak'"{/if}>
	<span id="gHomeWikiTitle">
		{tooltip name="home-flip-destaques" text="Alternar a visualização dos destaques"}
			<img class="pointer" onclick="flip('modulegHomeWikiToggle');toggleImage(this,'{$imgChange}.png');storeState('gHomeWikiToggle')" src="styles/{$style|replace:".css":""}/img/{$imgCurrent}.png">
		{/tooltip}
	</span>
	<div id="modulegHomeWikiToggle" style="display:{$display};">
		{$destak}
	</div>
	
	<div id="gHomeWikiBottom">
		{tooltip text="<i>Feed</i> &nbsp;<b>RSS</b> do acervo.livre"}
			<a href="tiki-index.php?page=RSS+do+Acervo+Livre">
				<up style="position:relative; top:-4px;">{tr}Assinar RSS do acervo{/tr}</up> <img src="styles/{$style|replace:".css":""}/img/iRss.png">
			</a>
		{/tooltip}
	</div>
</div>

<!-- Feature Wiki End -->
	
{include file="el-gallery_list_filters.tpl"}

<div id="ajax-gListCont">
	{include file="el-gallery_section.tpl"}
</div>

<center><div id="ajax-navBottom" class="listNav">{include file="el-gallery_pagination.tpl"}</div></center>
	
{include file="el-gallery_confirm_delete.tpl"}

<!-- el-gallery_home.tpl end -->