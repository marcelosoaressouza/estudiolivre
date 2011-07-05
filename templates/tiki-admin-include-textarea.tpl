{* $Header: /cvsroot/tikiwiki/tiki/templates/tiki-admin-include-textarea.tpl,v 1.1.2.5 2007/08/13 15:09:31 luciash Exp $ *}

<div class="rbox" name="tip">
	<div class="rbox-title" name="tip">{tr}Tip{/tr}</div>  
	<div class="rbox-data" name="tip">
	
	{tr}Text area (that apply throughout many features){/tr}

	</div>
</div>
<br />

<div class="cbox">
	<div class="cbox-title">
		{tr}{$crumbs[$crumb]->description}{/tr}
		{help crumb=$crumbs[$crumb]}
	</div>


	<form action="tiki-admin.php?page=textarea" method="post">
		<table class="admin">
			<tr>
				<td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}Smileys" target="tikihelp" class="tikihelp" title="{tr}Allow Smileys{/tr}">{/if} {tr}Allow Smileys{/tr} {if $feature_help eq 'y'}</a>{/if} </td>
				<td><input type="checkbox" name="feature_smileys" {if $feature_smileys eq 'y'}checked="checked"{/if}/></td>
			</tr>
			<tr>
				<td class="form"> {if $feature_help eq 'y'}<a href="{$helpurl}AutoLinks" target="tikihelp" class="tikihelp" title="{tr}AutoLinks{/tr}">{/if} {tr}AutoLinks{/tr} {if $feature_help eq 'y'}</a>{/if}</td>
				<td><input type="checkbox" name="feature_autolinks" {if $feature_autolinks eq 'y'}checked="checked"{/if}/></td>
			</tr>
       		<tr>
       			<td class="form">{tr}Anonymous editors must input anti-bot code{/tr}:</td><td><input type="checkbox" name="feature_antibot" {if $feature_antibot eq 'y'}checked="checked"{/if}/></td>
       		</tr>
	<tr>
	        <td class="form"> <label for="general-ext_links">{tr}Open external links in new window{/tr}:</label></td>
	        <td><input type="checkbox" name="popupLinks" id="general-ext_links" {if $popupLinks eq 'y'}checked="checked"{/if}/></td>
       	</tr>
	<tr>	
		<td class="form"><label for="general-cache_ext_pages">{tr}Use cache for external pages{/tr}:</label></td>
		<td><input type="checkbox" name="cachepages" id="general-cache_ext_pages" {if $cachepages eq 'y'}checked="checked"{/if}/></td>
		</tr>
	<tr>	
		<td class="form"><label for="general-cache_ext_imgs">{tr}Use cache for external images{/tr}:</label></td>
		<td><input type="checkbox" name="cacheimages" id="general-cache_ext_imgs"{if $cacheimages eq 'y'}checked="checked"{/if}/></td>
       	</tr>
		
          <td colspan="2" class="button"><input type="submit" name="textareasetup" value="{tr}Save{/tr}" /></td>
		  
        </tr>
        </table>
      </form>

</div>

