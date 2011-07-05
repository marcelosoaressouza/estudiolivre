{* $Header: /cvsroot/tikiwiki/tiki/templates/tiki-upload_image.tpl,v 1.22.2.26 2007/09/13 19:37:12 ohertel Exp $ *}
<h1><a href="tiki-upload_image.php{if $galleryId}?galleryId={$galleryId}{/if}" class="pagetitle">{tr}Upload Image{/tr}</a>

{if $feature_help eq 'y'}
<a href="{$helpurl}Image+Gallery" target="tikihelp" class="tikihelp" title="{tr}Image Gallery{/tr}">
<img src="img/icons/help.gif" border="0" height="16" width="16" alt='{tr}help{/tr}' /></a>
{/if}

{if $feature_view_tpl eq 'y'}
<a href="tiki-edit_templates.php?template=tiki-upload_image.tpl" target="tikihelp" class="tikihelp" title="{tr}View tpl{/tr}: {tr}Image Gallery tpl{/tr}">
<img src="img/icons/info.gif" border="0" width="16" height="16" alt='{tr}edit template{/tr}' /></a>
{/if}</h1>

{* link button *}

<span class="button2">
{if $galleryId ne ''}
<a href="tiki-browse_gallery.php?galleryId={$galleryId}" class="linkbut">
{else}
<a href="tiki-galleries.php" class="linkbut">
{/if}
{tr}Browse gallery{/tr}</a></span>
  {if $feature_gal_batch eq "y" and $tiki_p_batch_upload_image_dir eq 'y'}
    {if $tiki_p_admin_galleries eq 'y' or ($user and $user eq $owner) or $public eq 'y'}
      <span class="button2"><a href="tiki-batch_upload.php{if $galleryId}?galleryId={$galleryId}{/if}" class="linkbut">{tr}Directory batch{/tr}</a></span>
    {/if}
  {/if}
<br /><br />
{if count($galleries) > 0}
	<div align="center">
	<form enctype="multipart/form-data" action="tiki-upload_image.php" method="post">
	<table class="normal">
	<tr>
	<td class="formcolor">{tr}Image Name{/tr}:</td>
	<td class="formcolor">
	<input type="text" size ="50" name="name" /><br />{tr}or use filename{/tr}: <input type="checkbox" name="use_filename" />
	</td>
	</tr>
  {if $feature_maps eq 'y' && $geogallery eq 'y'}
  <tr><td class="formcolor">{tr}Latitude (WGS84/decimal degrees){/tr}:</td><td class="formcolor"><input type="text" name="lat" value="{$lat|escape}" /></td></tr>
  <tr><td class="formcolor">{tr}Longitude (WGS84/decimal degrees){/tr}:</td><td class="formcolor"><input type="text" name="lon" value="{$lon|escape}" /></td></tr>
  {/if}
	<tr><td class="formcolor">{tr}Image Description{/tr}:</td><td class="formcolor">
	<textarea rows="5" cols="50" name="description"></textarea></td></tr>
	<tr><td class="formcolor">{tr}Gallery{/tr}:</td><td class="formcolor">
	<select name="galleryId">
	{section name=idx loop=$galleries}
	{if ($galleries[idx].individual eq 'n') or ($galleries[idx].individual_tiki_p_upload_images eq 'y')}
	<option  value="{$galleries[idx].galleryId|escape}" {if $galleries[idx].galleryId eq $galleryId}selected="selected"{/if}>{$galleries[idx].name}</option>
	{/if}
	{/section}
	</select>
	</td></tr>
{include file=categorize.tpl}
	<tr class="formcolor">
	<td  class="formcolor" colspan="2"><b>{tr}Now enter the image URL{/tr}{tr} or upload a local image from your disk{/tr}</td></tr>
	<tr><td class="formcolor">URL:</td><td class="formcolor"><input size="50" type="text" name="url" /></td></tr>
	<tr>
	<td class="formcolor">{tr}Upload from disk{/tr} / {tr}Batch upload{/tr}:</td><td class="formcolor">
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
	<input size="50" name="userfile1" type="file" />
	</td></tr>
	<tr><td class="formcolor">{tr}Thumbnail (optional, overrides automatic thumbnail generation){/tr}:</td><td class="formcolor">
	<input name="userfile2" size ="50" type="file" />
	</td></tr>
	<tr><td class="formcolor">{tr}Upload from disk{/tr}:</td><td class="formcolor">
	<input name="userfile3" type="file" />
	<input name="userfile4" type="file" /><br />
	<input name="userfile5" type="file" />
	<input name="userfile6" type="file" /><br />
	<input name="userfile7" type="file" />
	<input name="userfile8" type="file" />
	</td></tr>
	<tr><td class="formcolor">&nbsp;</td><td class="formcolor"><input type="submit" name="upload" value="{tr}upload{/tr}" /> <span class="rbox-data">{tr}Note: Maximum image size is limited to{/tr} {$max_img_upload_size|kbsize}</span></td></tr>
	</table>
	</form>
	</div>
	{if $show eq 'y'}
	<br />
	<hr/>
	<h2>{tr}Upload successful!{/tr}</h2>
	<h3>{tr}The following image was successfully uploaded{/tr}:</h3>
	<div align="center">
	<img src="show_image.php?id={$imageId}" alt="{tr}Image ID{/tr}" /><br />
	<b>{tr}Thumbnail{/tr}:</b><br />
	<img src="show_image.php?id={$imageId}&amp;thumb=1" alt="{tr}Image ID thumb{/tr}" /><br /><br />
	<div class="wikitext">
	{tr}You can view this image in your browser using{/tr}: <a class="link" href="{$url_browse}?imageId={$imageId}">{$url_browse}?imageId={$imageId}</a><br /><br />
	{tr}You can include the image in an Wiki page using{/tr}:  <form><textarea rows="3" cols="60" style="width: 90%">{literal}{{/literal}img src=show_image.php?id={$imageId}{literal}}{/literal}</textarea></form>
	</div>
	</div>
	{/if}
	{if $batchRes}
	<h2>{tr}Batch Upload Results{/tr}</h2>
	<table class="normal">
	{cycle values="odd,even" print=false}
	{section name=ix loop=$batchRes}
		<tr><td class="{cycle advance=false}">{$batchRes[ix].filename}</td>
		{if $batchRes[ix].msg}
			<td class="{cycle advance=false}">{$batchRes[ix].msg}</td><td class="{cycle advance=false}">&nbsp;</td><td class="{cycle}">&nbsp;</td>
		{else}
			<td class="{cycle advance=false}">{tr}Upload successful!{/tr}</td><td class="{cycle advance=false}">{$batchRes[ix].imageId}</td><td class="{cycle}"><img src="{$url_show}?id={$batchRes[ix].imageId}&amp;thumb=1" alt="{$batchRes[ix].filename}" /></td>
		{/if}
		</tr>
	{/section}
	</table>
	{/if}
{else}
	<a class="linkbut" href="tiki-galleries.php">{tr}You have to create a gallery first!{/tr}</a>
{/if}


