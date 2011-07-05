{* $Header: /cvsroot/tikiwiki/tiki/templates/tiki-editpage.tpl,v 1.53.2.49 2007/08/14 17:44:12 jonnybradley Exp $ *}

{popup_init src="lib/overlib.js"}

{* Check to see if there is an editing conflict *}
{if $editpageconflict == 'y'}
<script type='text/javascript'>
<!-- //Hide Script
	alert("{tr}This page is being edited by{/tr} {$semUser}. {tr}Proceed at your own peril{/tr}.")
//End Hide Script -->
</script>
{/if}



{* Display edit time out *}
<script language='Javascript' type='text/javascript'>
{literal}

<!-- Begin

function Minutes(data) {
for (var i = 0; i < data.length; i++)
if (data.substring(i, i + 1) == ":")
break;
return (data.substring(0, i));
}

function Seconds(data) {
for (var i = 0; i < data.length; i++)
if (data.substring(i, i + 1) == ":")
break;
return (data.substring(i + 1, data.length));
}
function Display(min, sec) {
var disp;
if (min <= 9) disp = " 0";
else disp = " ";
disp += min + ":";
if (sec <= 9) disp += "0" + sec;
else disp += sec; 
return (disp);
}
function Down() { 
sec--;      
if (sec == -1) { sec = 59; min--; }
document.editpageform.clock.value = Display(min, sec);
window.status = "Your edit session will expire in: " + Display(min, sec);
if (min == 1 && sec == 0) {
alert("Your edit session will expire in 1 minute. You must PREVIEW or SAVE your work now, to avoid losing your edits.");
// window.location.href = timedouturl;
}
else down = setTimeout("Down()", 1000);
}
function timeIt() {
min = 1 * Minutes(document.editpageform.clock.value);
sec = 0 + Seconds(document.editpageform.clock.value);
Down();
}

{/literal}{if $page|lower eq 'sandbox' and $tiki_p_admin neq 'y'}
needToConfirm = false;
{/if}{literal}
//  End -->
{/literal}
</script>





<h1>{tr}Edit{/tr}: {$page|escape}{if $pageAlias ne ''}&nbsp;({$pageAlias|escape}){/if}</h1>
{if $page|lower eq 'sandbox'}
<div class="wikitext">
{tr}The SandBox is a page where you can practice your editing skills, use the preview feature to preview the appearance of the page, no versions are stored for this page.{/tr}
</div>
{/if}
{if $preview}
{include file="tiki-preview.tpl"}
{/if}
<form  enctype="multipart/form-data" method="post" action="tiki-editpage.php" id='editpageform' name='editpageform'>
{if $preview}
<input type="submit" class="wikiaction" name="preview" value="{tr}preview{/tr}" onclick="needToConfirm = false;" />
{if $page|lower neq 'sandbox'}
{if $tiki_p_minor eq 'y'}
<input type="checkbox" name="isminor" value="on" />{tr}Minor{/tr}
{/if}
<input type="submit" class="wikiaction" name="save" value="{tr}save{/tr}" onclick="needToConfirm = false;" /> &nbsp;&nbsp; <input type="submit" class="wikiaction" name="cancel_edit" value="{tr}cancel edit{/tr}" onclick="needToConfirm = false;" />
{/if}
{/if}
{if $page_ref_id}
<input type="hidden" name="page_ref_id" value="{$page_ref_id}" />
{/if}
{if $current_page_id}
<input type="hidden" name="current_page_id" value="{$current_page_id}" />
{/if}
{if $add_child}
<input type="hidden" name="add_child" value="true" />
{/if}
{if $can_wysiwyg}
{if !$wysiwyg}
<span class="button2"><a class="linkbut" href="?page={$page}&&wysiwyg=y">{tr}Use wysiwyg editor{/tr}</a></span>
{else}
<span class="button2"><a class="linkbut" href="?page={$page}&&wysiwyg=n">{tr}Use normal editor{/tr}</a></span>
{/if}
{/if}

<table class="normal">


{if $categIds}
{section name=o loop=$categIds}
<input type="hidden" name="cat_categories[]" value="{$categIds[o]}" />
{/section}
<input type="hidden" name="categId" value="{$categIdstr}" />
<input type="hidden" name="cat_categorize" value="on" />
{else}
{if $tiki_p_view_categories eq 'y' and $page|lower neq 'sandbox'}
{include file=categorize.tpl}
{/if}
{/if}
{include file=structures.tpl}

{if $feature_wiki_templates eq 'y' and $tiki_p_use_content_templates eq 'y' and !$templateId and $page|lower neq 'sandbox'}
<tr class="formcolor"><td>{tr}Apply template{/tr}:</td><td>
<select name="templateId" onchange="javascript:needToConfirm=false;document.getElementById('editpageform').submit();">
<option value="0">{tr}none{/tr}</option>
{section name=ix loop=$templates}
<option value="{$templates[ix].templateId|escape}" {if $templateId eq $templates[ix].templateId}selected="selected"{/if}>{tr}{$templates[ix].name}{/tr}</option>
{/section}
</select>
</td></tr>
{/if}

{if $feature_wiki_ratings eq 'y' and $tiki_p_wiki_admin_ratings eq 'y' and $page|lower neq 'sandbox'}
<tr class="formcolor"><td>{tr}Use rating{/tr}:</td><td>
{if $poll_rated.info}
<input type="hidden" name="poll_title" value="{$poll_rated.info.title|escape}" />
<a href="tiki-admin_poll_options.php?pollId={$poll_rated.info.pollId}">{$poll_rated.info.title}</a>
<span class="button2"><a class="linkbut" href="tiki-editpage.php?page={$page|escape:"url"}&amp;removepoll={$poll_rated.info.pollId}">{tr}disable{/tr}</a>
{if $tiki_p_admin_poll eq 'y'}
<span class="button2"><a class="linkbut" href="tiki-admin_polls.php">{tr}admin polls{/tr}</a></span>
{/if}
{else}
{if count($polls_templates)}
{tr}type{/tr}
<select name="poll_template">
<option value="0">{tr}none{/tr}</option>
{section name=ix loop=$polls_templates}
<option value="{$polls_templates[ix].pollId|escape}"{if $polls_templates[ix].pollId eq $poll_template} selected="selected"{/if}>{tr}{$polls_templates[ix].title}{/tr}</option>
{/section}
</select>
{tr}title{/tr}
<input type="text" name="poll_title" value="{$poll_title|escape}" size="22" />
{else}
{tr}There is no available poll template.{/tr}
{if $tiki_p_admin_polls ne 'y'}
{tr}You should ask an admin to create them.{/tr}
{/if}
{/if}
{if count($listpolls)}
{tr}or use{/tr}
<select name="olpoll">
<option value="">... {tr}an existing poll{/tr}</option>
{section name=ix loop=$listpolls}
<option value="{$listpolls[ix].pollId|escape}">{tr}{$listpolls[ix].title|default:"<i>... no title ...</i>"}{/tr} ({$listpolls[ix].votes} {tr}votes{/tr})</option>
{/section}
</select>
{/if}
{/if}
</td></tr>
{/if}

{if $feature_multilingual eq 'y' and $page|lower neq 'sandbox'}
<tr class="formcolor"><td>{tr}Language{/tr}:</td><td>
<select name="lang">
<option value="">{tr}Unknown{/tr}</option>
{section name=ix loop=$languages}
{if in_array($languages[ix].value, $available_languages) or $available_languages|@count eq 0}
<option value="{$languages[ix].value|escape}"{if $lang eq $languages[ix].value} selected="selected"{/if}>{$languages[ix].name}</option>
{/if}
{/section}
</select>
</td></tr>
{*<tr class="formcolor"><td>{tr}Is a translation of this page:{/tr}</td><td><input style="width:95%;" type="text" name="translation" value="{$translation|escape}" /></td></tr>*}
{/if}

{if $feature_smileys eq 'y'&&!$wysiwyg}
<tr class="formcolor"><td>{tr}Smileys{/tr}:</td><td>
{include file="tiki-smileys.tpl" area_name='editwiki'}
</td>
</tr>
{/if}
{if $feature_wiki_description eq 'y' and $page|lower neq 'sandbox'}
<tr class="formcolor"><td>{tr}Description{/tr}:</td><td><input style="width:95%;" class="wikitext" type="text" name="description" value="{$description|escape}" /></td></tr>
{/if}
<tr class="formcolor"><td>{tr}Edit{/tr}:<br /><br />
{if !$wysiwyg}
{include file="textareasize.tpl" area_name='editwiki' formId='editpageform'}<br /><br />
{include file=tiki-edit_help_tool.tpl area_name='editwiki'}
{/if}
</td>
<td>
   <input type="hidden" name="clock" value="{$edittimeout}" />

{if $page|lower neq 'sandbox'}
   <strong>Note</strong>: This edit session will expire in {$edittimeout} minutes. <strong>Preview</strong> or <strong>Save</strong> your work to restart the edit session timer.<br />
{/if}

<textarea id='editwiki' class="wikiedit" name="edit" rows="{$rows}" cols="{$cols}" style="WIDTH: 100%;">{$pagedata|escape}</textarea>
{if $wysiwyg}
 <script type="text/javascript" src="lib/fckeditor/fckeditor.js"></script>
 <script type="text/javascript">
        sBasePath = 'lib/fckeditor/';
	var oFCKeditor = new FCKeditor( 'edit' ) ;
	oFCKeditor.BasePath	= sBasePath ;
	oFCKeditor.ReplaceTextarea() ;
 </script>
{/if}
<input type="hidden" name="rows" value="{$rows}"/>
<input type="hidden" name="cols" value="{$cols}"/>
</td></tr>

{if $feature_wiki_replace eq 'y'}
<script type="text/javascript">
{literal}
function searchrep() {
  c = document.getElementById('caseinsens')
  s = document.getElementById('search')
  r = document.getElementById('replace')
  t = document.getElementById('editwiki')

  var opt = 'g';
  if (c.checked == true) {
    opt += 'i'
  }
  var str = t.value
  var re = new RegExp(s.value,opt)
  t.value = str.replace(re,r.value)
}
{/literal}
</script>

<tr class="formcolor"><td>{tr}Regex search {/tr}:</td><td>
<input style="width:100;" class="wikitext" type="text" id="search"/>
Replace to:
<input style="width:100;" class="wikitext" type="text" id="replace"/>
<input type="checkbox" id="caseinsens" />{tr}Case Insensitivity{/tr}
<input type="button" value="{tr}replace{/tr}" onclick="javascript:searchrep();">
</td></tr>
{/if}

{if $feature_wiki_footnotes eq 'y' and $page|lower neq 'sandbox'}
{if $user}
<tr class="formcolor"><td>{tr}My Footnotes{/tr}:</td><td><textarea name="footnote" rows="8" cols="42" style="width:95%;" >{$footnote|escape}</textarea></td></tr>
{/if}
{/if}

{if $page|lower neq 'sandbox'}
<tr class="formcolor"><td>{tr}Edit Summary{/tr}:</td><td><input style="width:90%;" class="wikitext" type="text" name="comment" value="{$commentdata|escape}" /></td></tr>
{if $wiki_feature_copyrights  eq 'y'}
<tr class="formcolor"><td>{tr}Copyright{/tr}:</td><td>
<table border="0">
<tr class="formcolor"><td>{tr}Title:{/tr}</td><td><input size="40" class="wikitext" type="text" name="copyrightTitle" value="{$copyrightTitle|escape}" /></td>
{if !empty($copyrights)}<td rowspan="3"><a href="copyrights.php?page={$page|escape}">{tr}To edit the copyright notices{/tr}</a></td>{/if}</tr>
<tr class="formcolor"><td>{tr}Year:{/tr}</td><td><input size="4" class="wikitext" type="text" name="copyrightYear" value="{$copyrightYear|escape}" /></td></tr>
<tr class="formcolor"><td>{tr}Authors:{/tr}</td><td><input size="40" class="wikitext" name="copyrightAuthors" type="text" value="{$copyrightAuthors|escape}" /></td></tr>
</table>
</td></tr>
{/if}
{/if}
{if $feature_freetags eq 'y' and $tiki_p_freetags_tag eq 'y'}
{include file=freetag.tpl}
{/if}
{if $feature_wiki_allowhtml eq 'y' and $tiki_p_use_HTML eq 'y' and $page|lower neq 'sandbox'}
<tr class="formcolor"><td>{tr}Allow HTML{/tr}: </td><td><input type="checkbox" name="allowhtml" {if $allowhtml eq 'y'}checked="checked"{/if}/></td></tr>
{/if}
{if $wiki_spellcheck eq 'y'}
<tr class="formcolor"><td>{tr}Spellcheck{/tr}: </td><td><input type="checkbox" name="spellcheck" {if $spellcheck eq 'y'}checked="checked"{/if}/></td></tr>
{/if}

{if $feature_wiki_import_html eq 'y' and $page|lower neq 'sandbox'}
<tr class="formcolor">
  <td>{tr}Import HTML{/tr}:</td>
  <td>
    <input class="wikitext" type="text" name="suck_url" value="{$suck_url|escape}" />&nbsp;
  </td>
</tr>
<tr class="formcolor">
  <td>&nbsp;</td>
  <td>
    <input type="submit" class="wikiaction" name="do_suck" value="{tr}Import{/tr}" />&nbsp;
    <input type="checkbox" name="parsehtml" {if $parsehtml eq 'y'}checked="checked"{/if}/>&nbsp;
    {tr}Try to convert HTML to wiki{/tr}
  </td>
</tr>
{/if}

{if $tiki_p_admin_wiki eq 'y' && $feature_wiki_import_page eq 'y' and $page|lower neq 'sandbox'}
<tr class="formcolor"><td>{tr}Import page{/tr}:</td><td>
<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
<input name="userfile1" type="file" />
{if $feature_wiki_export eq 'y' and $tiki_p_admin_wiki eq 'y'}
<a href="tiki-export_wiki_pages.php?page={$page|escape:"url"}&amp;all=1" class="link">{tr}export all versions{/tr}</a>
{/if}
</td></tr>
{/if}

{if $feature_wiki_pictures eq 'y' and $tiki_p_upload_picture eq 'y' and $page|lower neq 'sandbox'}
<tr class="formcolor"><td>{tr}Upload picture{/tr}</td><td>
<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
<input type="hidden" name="hasAlreadyInserted" value="" />
<input type="hidden" name="prefix" value="/img/wiki_up/{if $tikidomain}{$tikidomain}/{/if}" />
<input name="picfile1" type="file" onchange="javascript:insertImg('editwiki','picfile1','hasAlreadyInserted')"/>
</td></tr>
{/if}
{if $feature_wiki_icache eq 'y' and $page|lower neq 'sandbox'}
<tr class="formcolor"><td>{tr}Cache{/tr}</td><td>
    <select name="wiki_cache">
    <option value="0" {if $wiki_cache eq 0}selected="selected"{/if}>0 ({tr}no cache{/tr})</option>
    <option value="60" {if $wiki_cache eq 60}selected="selected"{/if}>1 {tr}minute{/tr}</option>
    <option value="300" {if $wiki_cache eq 300}selected="selected"{/if}>5 {tr}minutes{/tr}</option>
    <option value="600" {if $wiki_cache eq 600}selected="selected"{/if}>10 {tr}minute{/tr}</option>
    <option value="900" {if $wiki_cache eq 900}selected="selected"{/if}>15 {tr}minutes{/tr}</option>
    <option value="1800" {if $wiki_cache eq 1800}selected="selected"{/if}>30 {tr}minute{/tr}</option>
    <option value="3600" {if $wiki_cache eq 3600}selected="selected"{/if}>1 {tr}hour{/tr}</option>
    <option value="7200" {if $wiki_cache eq 7200}selected="selected"{/if}>2 {tr}hours{/tr}</option>
    </select> 
</td></tr>
{/if}

<tr class="formcolor"><td>&nbsp;</td><td><input type="hidden" name="page" value="{$page|escape}" />
<input type="submit" class="wikiaction" name="preview" value="{tr}preview{/tr}" onclick="needToConfirm = false;" /></td></tr>

{if $feature_antibot eq 'y' && $anon_user eq 'y' and $page|lower neq 'sandbox'}
{include file=antibot.tpl}
{/if}

{if $wiki_feature_copyrights  eq 'y'}
<tr class="formcolor"><td>{tr}License{/tr}:</td><td><a href="tiki-index.php?page={$wikiLicensePage}">{tr}{$wikiLicensePage}{/tr}</a></td></tr>
{if $wikiSubmitNotice neq ""}
<tr class="formcolor"><td>{tr}Important{/tr}:</td><td><b>{tr}{$wikiSubmitNotice}{/tr}</b></td>
{/if}
{/if}
{if $page|lower neq 'sandbox' or $tiki_p_admin eq 'y'}
<tr class="formcolor"><td>&nbsp;</td><td>
{if $tiki_p_minor eq 'y' and $page|lower ne 'sandbox'}
<input type="checkbox" name="isminor" value="on" />{tr}Minor{/tr}
{/if}
<input type="submit" class="wikiaction" name="save" value="{tr}save{/tr}" onclick="needToConfirm = false;" /> &nbsp;&nbsp;
{if $page|lower ne 'sandbox'}
<input type="submit" class="wikiaction" name="cancel_edit" value="{tr}cancel edit{/tr}" onclick="needToConfirm = false;" />
{/if}
{/if}
</td></tr>
</table>
</form>
<br />
{if $wysiwyg ne 'y'}
{include file=tiki-edit_help.tpl}
{/if}
