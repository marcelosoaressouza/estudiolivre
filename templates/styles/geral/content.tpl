{css}

{if $category eq "Áudio"}
	{assign var="midId" value="tiki-midAudio"}
{elseif $category eq "Gráfico"}
	{assign var="midId" value="tiki-midGraf"}
{elseif $category eq "Vídeo"}
	{assign var="midId" value="tiki-midVideo"}
{elseif $category eq "gallery"}
	{assign var="midId" value="tiki-midAcervo"}
{elseif $section eq "wiki"}
	{assign var="midId" value="tiki-mid"}
{else}
	{assign var="midId" value="tiki-midNaoWiki"}
{/if}

<!-- content.tpl begin -->
<div id="ajax-contentBubble">
   	{include file="sideContent.tpl"}
	<div id="corpo">
	<div id="{$midId}">
	    {$mid_data}
    </div>
    </div>
</div>
<!-- content.tpl end -->
