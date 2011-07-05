<!-- tiki-top_bar.tpl begin -->

{if $isIE}
{include file="ie_notsupported.tpl"}
{/if}

<div id="tiki-top">
<div id="topMenu">
  	{* Logo TESTE *}
    {if $showTeste}
  	 <a href="http://dev.estudiolivre.org/tiki-view_tracker.php?status=o&trackerId=13&offset=0&sort_mode=created_desc">
  	  {tooltip text="Clique aqui e <b>relate os bugs</b> encontrados! Ajude-nos a <b>melhorar</b> o EstúdioLivre!!!"}<img src="styles/estudiolivre/faixaTeste.{if $isIE}gif{else}png{/if}" style="position:absolute; top:-25px; left:0px; z-index:5"/>{/tooltip}
  	 </a>
    {/if}
      <a href="/">
        {tooltip name="navegue-home" text="Ir para a Página Inicial"}
          <img src="styles/{$style|replace:".css":""}/logoTop.png">
        {/tooltip}
      </a>
      <div id="topMenuLinks">
    {tooltip name="saiba-estudiolivre" text="Saiba <b>o que é</b> o EstúdioLivre"}<a href="tiki-index.php?page=sobre&bl">{tr}sobre{/tr}</a>{/tooltip}
    | 
  	{tooltip name="forum-discussoes" text="Fóruns de <b>discussões</b> - tire suas dúvidas aqui"}<a href="tiki-forums.php">{tr}forums{/tr}</a>{/tooltip}
    | 
    {tooltip name="lista-comunidade" text="Veja a lista de <b>pessoas</b> que fazem parte da comunidade"}<a href="tiki-list_users.php">{tr}users{/tr}</a>{/tooltip}
    | 
    {tooltip text="Veja os <b>blogs</b> dos usuári@s do EstúdioLivre"}<a href="tiki-list_blogs.php">{tr}blogs{/tr}</a>{/tooltip}
    | 
    {tooltip name="perguntas-frequentes" text="<b>Perguntas</b> mais freqüêntes"}<a href="tiki-index.php?page=faq&bl">{tr}faq{/tr}</a>{/tooltip}
    | 
    {tooltip name="entre-contato" text="Entre em contato - descubra os <b>canais de comunicação</b> com a comunidade"}<a href="tiki-index.php?page=contato&bl">{tr}contato{/tr}</a>{/tooltip}
    </div>
  </div>
</div>

<!-- tiki-top_bar.tpl end -->
