<!-- el-gallery_section.tpl begin -->
{css only='el-gallery_list_item'}
{if $isIE}<br/><br/><br/>{/if}
{foreach from=$arquivos item=p}
	{include file="el-gallery_list_item.tpl" arquivo=$p}
{/foreach}
<!-- el-gallery_section.tpl end -->
