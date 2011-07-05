{* $Header: /cvsroot/arca/estudiolivre/src/templates/styles/obscur/tiki-show_page.tpl,v 1.1 2006-07-26 06:15:08 rhwinter Exp $ *}

<div {if $user_dbl eq 'y' and $dblclickedit eq 'y' and $tiki_p_edit eq 'y'}ondblclick="location.href='tiki-editpage.php?page={$page|escape:"url"}';"{/if}>	
	<div class="wikitopline"><!--do contextualMenu onclick="cancelBubble(event)"-->
	
	{ if $print_page ne 'y'}
		{if !$lock}
			{if $tiki_p_edit eq 'y' or $page|lower eq 'sandbox'}
				{if $beingEdited eq 'y'}
					{tooltip name="show-page-editar-pagina" text="<b>Editar</b> essa página"}<span class="tabbut"><a {*title="{$semUser}"*} class="highlight" href="tiki-editpage.php?page={$page|escape:"url"}" class="tablink"><img src="styles/{$style|replace:".css":""}/iWikiEdit.png"></a></span>{/tooltip}
				{else}
					{tooltip name="show-page-editar-pagina" text="<b>Editar</b> essa página"}<span class="tabbut"><a href="tiki-editpage.php?page={$page|escape:"url"}" class="tablink"><img src="styles/{$style|replace:".css":""}/iWikiEdit.png"></a></span>{/tooltip}
				{/if}
			{/if}
		{/if}
		
		{if $wiki_feature_3d eq 'y'}
			{tooltip name="show-page-representacao-3d" text="Representação <b>tridimensional</b> do wiki"}<a {*title="{tr}3d browser{/tr}"*} href="javascript:wiki3d_open('{$page|escape}',{$wiki_3d_width}, {$wiki_3d_height})"><img src="styles/{$style|replace:".css":""}/iWiki3dWiki.png"></a>{/tooltip}
		{/if}
		
		{tooltip name="show-page-abrir-impressao" text="Abrir versão para <b>impressão</b>"}<a {*title="{tr}print{/tr}"*} href="tiki-print.php?page={$page|escape:"url"}"><img src="styles/{$style|replace:".css":""}/iWikiPrint.png" alt="{tr}print{/tr}" /></a>{/tooltip}
		
		{if $feature_wiki_pdf eq 'y'}
			{tooltip name="show-page-criar-pdf" text="Criar um <b>PDF</b> dessa página"}<a {*title="{tr}create pdf{/tr}"*} href="tiki-config_pdf.php?{if $home_info && $home_info.page_ref_id}page_ref_id={$home_info.page_ref_id}{else}page={$page|escape:"url"}{/if}"><img src="styles/{$style|replace:".css":""}/iWikiExport.png" alt="{tr}pdf{/tr}"></a>{/tooltip}
		{/if}
		
		{if $page|lower ne 'sandbox'}
			{if $tiki_p_remove eq 'y'}
				{tooltip name="show-page-remover-pagina" text="<b>Remover</b> essa página"}<span class="tabbut"><a href="tiki-removepage.php?page={$page|escape:"url"}&amp;version=last" class="tablink"><img src="styles/{$style|replace:".css":""}/iWikiRemove.png"></a></span>{/tooltip}
			{/if}
			{if $tiki_p_rename eq 'y'}
				{tooltip name="show-page-renomear-pagina" text="<b>Renomear</b> página"}<span class="tabbut"><a href="tiki-rename_page.php?page={$page|escape:"url"}" class="tablink"><img src="styles/{$style|replace:".css":""}/iWikiRename.png"></a></span>{/tooltip}
			{/if}
		{/if}
		
		{if $page|lower ne 'sandbox'}
			{if $lock and ($tiki_p_admin_wiki eq 'y' or ($user and ($user eq $page_user or $user eq "admin") and ($tiki_p_lock eq 'y') and ($feature_wiki_usrlock eq 'y')))}
				{tooltip name="show-page-observar-pagina" text="<b>Destravar</b> a página"}<span class="tabbut"><a href="tiki-index.php?page={$page|escape:"url"}&amp;action=unlock" class="tablink"><img src="styles/{$style|replace:".css":""}/iWikiUnLock.png"></a></span>{/tooltip}
			{/if}
			{if !$lock and ($tiki_p_admin_wiki eq 'y' or (($tiki_p_lock eq 'y') and ($feature_wiki_usrlock eq 'y')))}
				{tooltip name="show-page-travar-pagina" text="<b>Travar</b> essa página"}<span class="tabbut"><a href="tiki-index.php?page={$page|escape:"url"}&amp;action=lock" class="tablink"><img src="styles/{$style|replace:".css":""}/iWikiLock.png"></a></span>{/tooltip}
			{/if}
			{if $tiki_p_admin_wiki eq 'y'}
				{tooltip name="show-page-modificar-permissoes" text="Modificar <b>permissões</b>"}<span class="tabbut"><a href="tiki-pagepermissions.php?page={$page|escape:"url"}" class="tablink"><img src="styles/{$style|replace:".css":""}/iWikiPermissions.png"></a></span>{/tooltip}
			{/if}
		{/if}
		
		{if $page|lower ne 'sandbox'}
			{if $feature_history eq 'y' and $tiki_p_wiki_view_history eq 'y'}
				{tooltip name="show-page-historico-edicoes" text="<b>Histórico</b> de edições da página"}<span class="tabbut"><a href="tiki-pagehistory.php?page={$page|escape:"url"}" class="tablink"><img src="styles/{$style|replace:".css":""}/iWikiHistory.png"></a></span>{/tooltip}
			{/if}
		{/if}
		
		{if $feature_likePages eq 'y'}
			{tooltip name="show-page-buscar-similares" text="Buscar páginas <b>similares</b>"}<span class="tabbut"><a href="tiki-likepages.php?page={$page|escape:"url"}" class="tablink"><img src="styles/{$style|replace:".css":""}/iWikiSimilar.png"></a></span>{/tooltip}
		{/if}
		
		{if $feature_multilingual eq 'y' and $tiki_p_edit eq 'y' and !$lock}
		     {tooltip name="show-page-traduzir-pagina" text="<b>Traduzir</b> página"}<span class="tabbut"><a href="tiki-edit_translation.php?page={$page|escape:'url'}" class="tablink"><img src="styles/{$style|replace:".css":""}/iWikiTranslate.png"></a></span>{/tooltip}
		{/if}
		
		{if $feature_multilingual == 'y' and count($trads) > 1}
			{tooltip text="<b>Traduções</b> dessa página"}<img src="styles/{$style|replace:".css":""}/iWikiTranslations.png" onclick="document.getElementById('transHide').style.display='inline'" style="cursor:pointer">{/tooltip}
			<span id="transHide" style="display:none">
				&nbsp;&nbsp;{include file="translated-lang.tpl" td='y'}
			</span>
		{/if}
		
		{if $feature_backlinks eq 'y' and $backlinks}
			{tooltip name="show-page-ver-referencias" text="Ver as páginas que referenciam esta página. Ou seja, que possuem links que trazem cá"}<img src="styles/{$style|replace:".css":""}/iWikiRef.png" onclick="flip('backlinksId')" style="cursor:pointer">{/tooltip}
		{/if}
		
		{if $feature_freetags eq 'y'}
				{tooltip text="<b>Tags</b> dessa página"}<img src="styles/{$style|replace:".css":""}/iWikiTags.png" onclick="flip('tagsHide')" style="cursor:pointer">{/tooltip}
				<span id="tagsHide" style="display:none">
					<b>{tr}Tags{/tr}:</b>
					{foreach from=$freetags.data item='tag'}
						<a href="tiki-browse_freetags.php?tag={$tag.tag}">{$tag.tag}</a>&nbsp;
					{foreachelse}
						{tr}Essa página ainda não tem tags{/tr}
					{/foreach}
				</span>
		{/if}
		
		{if $feature_backlinks eq 'y' and $backlinks}		
			<div style="display:none" id="backlinksId">
				{tr}páginas que citam esta:{/tr}
				{section name=back loop=$backlinks}
				<a href="tiki-index.php?page={$backlinks[back].fromPage}&amp;bl">{$backlinks[back].fromPage}</a>
				{/section}
			</div>
		{/if}
			
		{* DESNECESSARIO if !$lock and ($tiki_p_edit eq 'y' or $page|lower eq 'sandbox') and $beingEdited ne 'y'}
			<a title="{tr}edit{/tr}" href="tiki-editpage.php?page={$page|escape:"url"}"><img src="img/icons/edit.gif" border="0"  width="20" height="16" alt="{tr}edit{/tr}" /></a>
		{/if*}       
	
		{* FEATURE DESABILITADO NO EL: if $cached_page eq 'y'}
			<a title="{tr}refresh{/tr}" href="tiki-index.php?page={$page|escape:"url"}&amp;refresh=1"><img src="img/icons/ico_redo.gif" border="0" height="16" width="16"  alt="{tr}refresh{/tr}"></a>
		{/if*}
	
		{* FEATURE DESABILITADO NO EL: if $user and $feature_notepad eq 'y' and $tiki_p_notepad eq 'y'}
			<a title="{tr}Save to notepad{/tr}" href="tiki-index.php?page={$page|escape:"url"}&amp;savenotepad=1"><img src="img/icons/ico_save.gif" border="0"  width="16" height="16" alt="{tr}save{/tr}" /></a>
		{/if *}
		
		{* FEATURE DESABILITADO NO EL: if $user and $feature_user_watches eq 'y'}
			{if $user_watching_page eq 'n'}
				<a href="tiki-index.php?page={$page|escape:"url"}&amp;watch_event=wiki_page_changed&amp;watch_object={$page|escape:"url"}&amp;watch_action=add">{html_image file='img/icons/icon_watch.png' border='0' alt="{tr}monitor this page{/tr}" title="{tr}monitor this page{/tr}"}</a>
			{else}
				<a href="tiki-index.php?page={$page|escape:"url"}&amp;watch_event=wiki_page_changed&amp;watch_object={$page|escape:"url"}&amp;watch_action=remove">{html_image file='img/icons/icon_unwatch.png' border='0' alt="{tr}stop monitoring this page{/tr}" title="{tr}stop monitoring this page{/tr}"}</a>
			{/if}
		{/if *}
	
		{* FEATURE DESABILITADO NO EL if !$page_ref_id and count($showstructs) ne 0}
			<form action="tiki-index.php" method="post">
			<select name="page_ref_id" onchange="page_ref_id.form.submit()">
			<option>{tr}Structures{/tr}...</option>
			{section name=struct loop=$showstructs}
			<option value="{$showstructs[struct].req_page_ref_id}">
			{if $showstructs[struct].page_alias} 
				{$showstructs[struct].page_alias}
			{else}
				{$showstructs[struct].pageName}
			{/if}
			</option>
			{/section}
			</select>
			</form>
		{/if*}
	
		{* if $feature_wiki_undo eq 'y' and $canundo eq 'y'}
			<span class="tabbut"><a href="tiki-index.php?page={$page|escape:"url"}&amp;undo=1" class="tablink">{tr}undo{/tr}</a></span>
		{/if *}
		
		{* if $wiki_uses_slides eq 'y'}
			{if $show_slideshow eq 'y'}
				<span class="tabbut"><a href="tiki-slideshow.php?page={$page|escape:"url"}" class="tablink">{tr}slides{/tr}</a></span>
			{elseif $structure eq 'y'}
				<span class="tabbut"><a href="tiki-slideshow2.php?page_ref_id={$page_info.page_ref_id}" class="tablink">{tr}slides{/tr}</a></span>
			{/if}
		{/if *}
		
		{* if $tiki_p_admin_wiki eq 'y'}
			<span class="tabbut"><a href="tiki-export_wiki_pages.php?page={$page|escape:"url"}" class="tablink">{tr}export{/tr}</a></span>
		{/if *}
		
		{* if $feature_wiki_discuss eq 'y'}
			<span class="tabbut"><a href="tiki-view_forum.php?forumId={$wiki_forum_id}&amp;comments_postComment=post&amp;comments_title={$page|escape:"url"}&amp;comments_data={"Use this thread to discuss the [tiki-index.php?page="}{$page}{"|"}{$page}{"] page."|escape:"url"}&amp;comment_topictype=n" class="tablink">{tr}discuss{/tr}</a></span>
		{/if *}
		
		{* if $feature_wiki_comments eq 'y' and $tiki_p_wiki_view_comments eq 'y' and $show_page eq 'y'}
			<span class="tabbut"><a href="#comments" onclick="javascript:flip('comzone{if $comments_show eq 'y'}open{/if}');" class="tablink">{if $comments_cant eq 0}{tr}comment{/tr}{elseif $comments_cant eq 1}1 {tr}comment{/tr}{else}{$comments_cant} {tr}comments{/tr}{/if}</a></span>
		{/if *}
		
		{* if $feature_wiki_attachments eq 'y' and $tiki_p_wiki_view_attachments eq 'y' and $show_page eq 'y'}
		<span class="tabbut"><a href="#attachments" onclick="javascript:flip('attzone{if $atts_show eq 'y'}open{/if}');" class="tablink">{if $atts_count eq 0}{tr}attach file{/tr}{elseif $atts_count eq 1}1 {tr}attachment{/tr}{else}{$atts_count} {tr}attachments{/tr}{/if}</a></span>
		{/if *}
		
	{/if}
	
	{if $feature_wiki_pageid eq 'y'}
		<small><a class="link" href="tiki-index.php?page_id={$page_id}">{tr}page id{/tr}: {$page_id}</a></small>
	{/if}
	{breadcrumbs type="desc" loc="page" crumbs=$crumbs}
	{if $cached_page eq 'y'}<small>({tr}cached{/tr})</small>{/if}
	
	{if $is_categorized eq 'y' and $feature_categories eq 'y' and $feature_categorypath eq 'y'}
		{$display_catpath}
	{/if}
	
	</div>
	
	<div id="wikitext" >
	
	{if $structure eq 'y'}
	
	<div class="tocnav">
	<table>
	<tr>
	  <td>
	    {if $prev_info and $prev_info.page_ref_id}
			<a href="tiki-index.php?page_ref_id={$prev_info.page_ref_id}"><img src="img/icons2/nav_dot_right.gif" border="0" height="11" width="8" alt="{tr}Previous page{/tr}" 
	   			{if $prev_info.page_alias}
	   				title='{$prev_info.page_alias}'
	   			{else}
	   				title='{$prev_info.pageName}'
	   			{/if}/></a>{else}<img src="img/icons2/8.gif" alt="" border="0" height="1" width="8" />{/if}
		{if $parent_info}
	   	<a href="tiki-index.php?page_ref_id={$parent_info.page_ref_id}"><img src="img/icons2/nav_home.gif" border="0" height="11" width="13" alt="{tr}Parent page{/tr}" 
	        {if $parent_info.page_alias}
	   	      title='{$parent_info.page_alias}'
	        {else}
	   	      title='{$parent_info.pageName}'
	        {/if}/></a>{else}<img src="img/icons2/8.gif" alt="" border="0" height="1" width="8" />{/if}
	   	{if $next_info and $next_info.page_ref_id}
	      <a href="tiki-index.php?page_ref_id={$next_info.page_ref_id}"><img src="img/icons2/nav_dot_left.gif" height="11" width="8" border="0" alt="{tr}Next page{/tr}" 
			  {if $next_info.page_alias}
				  title='{$next_info.page_alias}'
			  {else}
				  title='{$next_info.pageName}'
			  {/if}/></a>{else}<img src="img/icons2/8.gif" alt="" border="0" height="1" width="8" />
		{/if}
		{if $home_info}
	   	<a href="tiki-index.php?page_ref_id={$home_info.page_ref_id}"><img src="img/icons2/home.gif" border="0" height="16" width="16" alt="TOC" 
			  {if $home_info.page_alias}
				  title='{$home_info.page_alias}'
			  {else}
				  title='{$home_info.pageName}'
			  {/if}/></a>{/if}
	  </td>
	  <td>
	
	{if $tiki_p_edit_structures and $tiki_p_edit_structures eq 'y' }
	    <form action="tiki-editpage.php" method="post">
	      <input type="hidden" name="current_page_id" value="{$page_info.page_ref_id}" />
	      <input type="text" name="page" />
	      {* Cannot add peers to head of structure *}
	      {if $page_info and !$parent_info }
	      <input type="hidden" name="add_child" value="checked" /> 
	      {else}
	      <input type="checkbox" name="add_child" /> {tr}Child{/tr}
	      {/if}      
	      <input type="submit" name="insert_into_struct" value="{tr}Add Page{/tr}" />
	    </form>
	{/if}
	  </td>
	</tr>
	<tr>
	  <td colspan="2">
	    {section loop=$structure_path name=ix}
	      {if $structure_path[ix].parent_id}&nbsp;{$site_crumb_seper}&nbsp;{/if}
		  <a href="tiki-index.php?page_ref_id={$structure_path[ix].page_ref_id}">
	      {if $structure_path[ix].page_alias}
	        {$structure_path[ix].page_alias}
		  {else}
	        {$structure_path[ix].pageName}
		  {/if}
		  </a>
		{/section}
	  </td>
	</tr>
	</table>
	</div>
	{/if}
	{if $feature_wiki_ratings eq 'y'}{include file="poll.tpl"}{/if}
	{$parsed}
	{if $pages > 1}
		<br />
		<div align="center">
			<a href="tiki-index.php?{if $page_info}page_ref_id={$page_info.page_ref_id}{else}page={$page|escape:"url"}{/if}&amp;pagenum={$first_page}"><img src="img/icons2/nav_first.gif" border="0" height="11" width="27" alt="{tr}First page{/tr}" title="{tr}First page{/tr}" /></a>
	
			<a href="tiki-index.php?{if $page_info}page_ref_id={$page_info.page_ref_id}{else}page={$page|escape:"url"}{/if}&amp;pagenum={$prev_page}"><img src="img/icons2/nav_dot_right.gif" border="0" height="11" width="8" alt="{tr}Previous page{/tr}" title="{tr}Previous page{/tr}" /></a>
	
			<small>{tr}page{/tr}:{$pagenum}/{$pages}</small>
	
			<a href="tiki-index.php?{if $page_info}page_ref_id={$page_info.page_ref_id}{else}page={$page|escape:"url"}{/if}&amp;pagenum={$next_page}"><img src="img/icons2/nav_dot_left.gif" border="0" height="11" width="8" alt="{tr}Next page{/tr}" title="{tr}Next page{/tr}" /></a>
	
	
			<a href="tiki-index.php?{if $page_info}page_ref_id={$page_info.page_ref_id}{else}page={$page|escape:"url"}{/if}&amp;pagenum={$last_page}"><img src="img/icons2/nav_last.gif" border="0" height="11" width="27" alt="{tr}Last page{/tr}" title="{tr}Last page{/tr}" /></a>
		</div>
	{/if}
	</div> {* End of main wiki page *}
	
	{if $has_footnote eq 'y'}<div class="wikitext wikifootnote">{$footnote}</div>{/if}
	
	{if isset($wiki_authors_style) && $wiki_authors_style eq 'business'}
	<p class="editdate">
	  {tr}Last edited by{/tr} <a href="el-user.php?view_user={$lastUser}">{$lastUser}</a>
	  {section name=author loop=$contributors}
	   {if $smarty.section.author.first}, {tr}based on work by{/tr}
	   {else}
	    {if !$smarty.section.author.last},
	    {else} {tr}and{/tr}
	    {/if}
	   {/if}
	   {$contributors[author]|userlink}
	  {/section}.<br />                                         
	  {tr}Page last modified on{/tr} {$lastModif|tiki_long_datetime}.
	</p>
	{elseif isset($wiki_authors_style) &&  $wiki_authors_style eq 'collaborative'}
	<p class="editdate">
	  {tr}Contributors to this page{/tr}: {$lastUser|userlink}
	  {section name=author loop=$contributors}
	   {if !$smarty.section.author.last},
	   {else} {tr}and{/tr}
	   {/if}
	   {$contributors[author]|userlink}
	  {/section}.<br />
	  {tr}Page last modified on{/tr} {$lastModif|tiki_long_datetime} {tr}by{/tr} {$lastUser|userlink}.
	</p>
	{elseif isset($wiki_authors_style) &&  $wiki_authors_style eq 'none'}
	{else}
	<p class="editdate">
	  {*tr}Created by{/tr}: {$creator|userlink*}
	  {tr}Last modification{/tr}: <i>{$lastModif|date_format:"%d/%m/%Y {tr}às{/tr} %H:%M"}</i>, {tr}by{/tr}: <a href="el-user.php?view_user={$lastUser}">{$lastUser}</a>
	</p>
	{/if}
	
	{if $wiki_feature_copyrights  eq 'y' and $wikiLicensePage}
	  {if $wikiLicensePage == $page}
	    {if $tiki_p_edit_copyrights eq 'y'}
	      <p class="editdate">{tr}To edit the copyright notices{/tr} <a href="copyrights.php?page={$copyrightpage}">{tr}click here{/tr}</a>.</p>
	    {/if}
	  {else}
	    <p class="editdate">{tr}The content on this page is licensed under the terms of the{/tr} <a href="tiki-index.php?page={$wikiLicensePage}&amp;copyrightpage={$page|escape:"url"}">{$wikiLicensePage}</a>.</p>
	  {/if}
	{/if}
	
	{if $print_page eq 'y'}
	  <div class="printFooter" align="center">
	  	<p>
		    {tr}The original document is available at{/tr}:<br><b>{$urlprefix}tiki-index.php?page={$page|escape:"url"}</b>
		</p>
	  </div>
	{/if}
	
	{if $is_categorized eq 'y' and $feature_categories eq 'y' and $feature_categoryobjects eq 'y'}
	<div class="catblock">{$display_catobjects}</div>
	{/if}
</div>