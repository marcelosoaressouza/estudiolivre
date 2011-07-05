{* $Header: /cvsroot/arca/estudiolivre/src/templates/styles/estudiolivre/tiki-editpage.tpl,v 1.26 2007-08-16 21:27:24 sampaioprimo Exp $ *}

{*popup_init src="lib/overlib.js"*}

{* Check to see if there is an editing conflict *}
{if $editpageconflict == 'y'}
	<script language='Javascript' type='text/javascript'>
	<!-- //Hide Script
		alert("{tr}This page is being edited by{/tr} {$semUser}. {tr}Proceed at your own peril{/tr}.")
	//End Hide Script -->
	</script>
{/if}

<form  enctype="multipart/form-data" name="editPage" method="post" action="tiki-editpage.php" id="editpageform" onSubmit="return checkForm()">

	{if $preview}
		{include file="tiki-preview.tpl"}
	{/if}

	<div id="wikiEditCont">	
		
		<span id="labelRight" class="pointer" name="preview" onclick="setPreview();">
			{tr}gerar{/tr} {if $preview}{tr}nova{/tr} {/if}{tr}preview{/tr}
		</span>
		<span id="label" class="wikiEdit hiddenPointer" onclick="javascript:flip('editCont');javascript:flip('editLabelLine');toggleImage(document.getElementById('edTArrow'),'iArrowGreyRight.png');">
			<img id="edTArrow" src="styles/estudiolivre/iArrowGreyDown.png">
			{tr}Edição da página{/tr} <b>{$page|escape|truncate:20:"(...)":true}{if $pageAlias ne ''}&nbsp;({$pageAlias|escape}){/if}</b>
		</span>
		<div class="wikiEdit" id="editCont" style="display:block">
			<!--input type="submit" class="wikiaction" name="preview" value="{tr}preview{/tr}" style="float:right"/-->
			{literal}
				<script language="javascript" type="text/javascript">
					function setPreview(){
						var inputPreview = document.createElement('input');
						inputPreview.type = "hidden";
						inputPreview.name = "preview";
						inputPreview.value = "1";
						document.getElementById('editpageform').appendChild(inputPreview);
						document.getElementById('editpageform').submit();
					}
				</script>
			{/literal}
			
			{if $page|lower eq 'sandbox'}
				<div class="wikitext">
				{tr}The SandBox is a page where you can practice your editing skills, use the preview feature to preview the appearance of the page, no versions are stored for this page.{/tr}
				</div>
			{/if}
			
			{*
			<br/>
			{tr}Edit{/tr}:
			<br />
			*}
			
			{include file="textareasize.tpl" area_name='editwiki' formId='editpageform'}
			
			{if !$wysiwyg}
				{include file=tiki-edit_help.tpl}
				{include file=tiki-edit_help_tool.tpl area_name='editwiki'}
			{/if}
			
			{assign var='rows' value=$smarty.cookies.editwikiRows} {if !$rows}{assign var='rows' value=40}{/if}
			
			<textarea id='editwiki' class="wikiedit" name="edit" rows="{$rows}">{$pagedata|escape}</textarea>
			
			{if $feature_freetags eq 'y' and $tiki_p_freetags_tag eq 'y'}
				<br/>
				{include file=freetag.tpl}
			{/if}
			
			<div id="wikiEditExtra">
				{if $categIds}
					{section name=o loop=$categIds}
						<input type="hidden" name="cat_categories[]" value="{$categIds[o]}" />
					{/section}
					<input type="hidden" name="categId" value="{$categIdstr}" />
					<input type="hidden" name="cat_categorize" value="on" />
				{else}
				<br/>
					{if $tiki_p_view_categories eq 'y'}
						{include file=categorize.tpl}
					{/if}
				{/if}
				
				<br/>
				
				<span class="hiddenPointer" onclick="javascript:flip('maisOpcoes');toggleImage(document.getElementById('edtOptTArrow'),'iArrowGreyDown.png');" >
					<img class="pointer" id="edtOptTArrow" src="styles/estudiolivre/iArrowGreyRight.png">
					<b>{tr}Mais opções{/tr}</b>
				</span>
				<div id="maisOpcoes" style="display:none">
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
					
					{include file=structures.tpl}
					
					{if $feature_wiki_templates eq 'y' and $tiki_p_use_content_templates eq 'y' and !$templateId}
						<br/>
						{tr}Apply template{/tr}:
						<select name="templateId" onchange="javascript:document.getElementById('editpageform').submit();">
						<option value="0">{tr}none{/tr}</option>
						{section name=ix loop=$templates}
							<option value="{$templates[ix].templateId|escape}" {if $templateId eq $templates[ix].templateId}selected="selected"{/if}>{tr}{$templates[ix].name}{/tr}</option>
						{/section}
						</select>
					{/if}
					
					{if $feature_wiki_ratings eq 'y' and $tiki_p_wiki_admin_ratings eq 'y'}
						{tr}Use rating{/tr}:
						<br/>
						{if $poll_rated.info}
							<a href="tiki-admin_poll_options.php?pollId={$poll_rated.info.pollId}">{$poll_rated.info.title}</a>
							<span class="button2"><a class="linkbut" href="tiki-editpage.php?page={$page|escape:"url"}&amp;removepoll={$poll_rated.info.pollId}">{tr}disable{/tr}</a>
							<input type="hidden" name="poll_template" value="{$poll_rated.info.pollId}" />
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
								or use 
								<select name="olpoll">
								<option value="">... {tr}an existing poll{/tr}</option>
								{section name=ix loop=$listpolls}
									<option value="{$listpolls[ix].pollId|escape}">{tr}{$listpolls[ix].title|default:"<i>... no title ...</i>"}{/tr} ({$listpolls[ix].votes} {tr}votes{/tr})</option>
								{/section}
								</select>
							{/if}
						{/if}
					{/if}
					
					{if $feature_multilingual eq 'y'}
						{tr}Language{/tr}:
						<select name="lang">
							<option value="">{tr}Escolha o idioma dessa página...{/tr}</option>
							{section name=ix loop=$languages}
								<option value="{$languages[ix].value|escape}"{if $lang eq $languages[ix].value} selected="selected"{/if}>{$languages[ix].name}</option>
							{/section}
						</select>
						<br/>
						{*
						{tr}Is a translation of this page:{/tr}
						<br/>
						<input style="width:95%;" type="text" name="translation" value="{$translation|escape}" />
						<br/>
						*}
					{/if}
					
					{*os smileys são un FEATURE!!!!!! era só desabilitar!....*}
					{*if $feature_smileys eq 'y'&&!$wysiwyg}
						{tr}Smileys{/tr}:
						{include file="tiki-smileys.tpl" area_name='editwiki'}
					{/if*}
					
					{if $feature_wiki_description eq 'y'}
						<br/>
						{tr}Description{/tr}:<input class="wikitext" type="text" name="description" value="{$description|escape}" />
					{/if}
					
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
					
					{if $feature_wiki_footnotes eq 'y'}
						{if $user}
							{*<tr class="formcolor"><td>*}
							{tr}My Footnotes{/tr}:
							<textarea name="footnote" rows="8" cols="42" style="width:95%;" >{$footnote|escape}</textarea>
						{/if}
					{/if}
					
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
						{tr}Search {/tr}:
						<input class="wikitext" type="text" id="search"/>
						Replace to:
						<input class="wikitext" type="text" id="replace"/>
						<input type="checkbox" id="caseinsens" />{tr}Case Insensitivity{/tr}
						<input type="button" value="{tr}replace{/tr}" onclick="javascript:searchrep();">
					{/if}
					
					{if $wiki_spellcheck eq 'y'}
						<br/>
						{tr}Spellcheck{/tr}:
						<input type="checkbox" name="spellcheck" {if $spellcheck eq 'y'}checked="checked"{/if}/>
					{/if}
					
					{if $feature_wiki_import_html eq 'y'}
						  <br/>
						  {tr}Import HTML{/tr}:
						    <input class="wikitext" type="text" name="suck_url" value="{$suck_url|escape}" />&nbsp;
						    <input type="submit" class="wikiaction" name="do_suck" value="{tr}Import{/tr}" />&nbsp;
						    <input type="checkbox" name="parsehtml" {if $parsehtml eq 'y'}checked="checked"{/if}/>&nbsp;
						    {tr}Try to convert HTML to wiki{/tr}
					{/if}
					
					{if $tiki_p_admin_wiki eq 'y'}
						<br>
						{tr}Import page{/tr}:
						<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
						<input name="userfile1" type="file" />
						<a href="tiki-export_wiki_pages.php?page={$page|escape:"url"}&amp;all=1" class="link">{tr}export all versions{/tr}</a>
					{/if}
					
					{if $feature_wiki_pictures eq 'y' and $tiki_p_upload_picture eq 'y'}
						<br/>
						{tr}Upload picture{/tr}
						<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
						<input type="hidden" name="hasAlreadyInserted" value="" />
						<input type="hidden" name="prefix" value="/img/wiki_up/{if $tikidomain}{$tikidomain}/{/if}" />
						<input name="picfile1" type="file" onchange="javascript:insertImg('editwiki','picfile1','hasAlreadyInserted')"/>
						<div id="new_img_form"></div>
						<a href="javascript:addImgForm()" onclick="needToConfirm = false;">{tr}Add another image{/tr}</a>
					{/if}
					
					{if $feature_wiki_icache eq 'y'}
						{tr}Cache{/tr}
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
					{/if}
					
					<input type="hidden" name="page" value="{$page|escape}" />
					
					{if $feature_antibot eq 'y' && $anon_user eq 'y'}
						<br/>
						{tr}Anti-Bot verification code{/tr}:
						<img src="tiki-random_num_img.php" alt='{tr}Random Image{/tr}'/>
						{tr}Enter the code you see above{/tr}:
						<input type="text" maxlength="8" size="8" name="antibotcode" />
					{/if}
					
					{if $wiki_feature_copyrights  eq 'y'}
						<br/>
						{tr}License{/tr}:
						<a href="tiki-index.php?page={$wikiLicensePage}">{tr}{$wikiLicensePage}{/tr}</a>
						{if $wikiSubmitNotice neq ""}
							{tr}Important{/tr}:
							<b>{tr}{$wikiSubmitNotice}{/tr}</b>
						{/if}
					{/if}
					
					{if $feature_wiki_allowhtml eq 'y' and $tiki_p_use_HTML eq 'y'}
						<br/>
						{tooltip text="Permite a colocação de <b>tags HTML</b> no texto wiki. Só modifique essa opção se souber <b>muito</b> bem o que isso significa."}
							<input type="checkbox" name="allowhtml" {if $allowhtml eq 'y'}checked="checked"{/if}/>{tr}Allow HTML{/tr}
						{/tooltip}
					{/if}
				</div>	
			</div>
		</div>			
		<div id="editLabelLine" style="border-bottom: 2px solid grey; display:none;width: 100%; height: 2px;"></div>
		
			<div id="attention">
			    <span class="pointer" name="preview" onclick="setPreview();">
					<div id="edtPreviewAtt">{tr}Gerar{/tr} {if $preview}{tr}nova{/tr} {/if}{tr}preview{/tr}</div>
				</span>
				{if $page|lower neq 'sandbox'}
					<div id="edtComentario">
					{tooltip text="<b>Comente</b> suscintamente as modificações feitas na edição"}
						<div>{tr}Comentário{/tr}:</div>
						<input class="wikitext" id="iCom" type="text" name="comment" value="{$commentdata|escape}" onChange="if(self.preview)document.getElementById('iComP').value=this.value"/>
					{/tooltip}
					</div>
					{if $wiki_feature_copyrights  eq 'y'}
						{tr}Copyright{/tr}:
						<tr class="formcolor"><td>
						{tr}Title:{/tr}
						<input size="40" class="wikitext" type="text" name="copyrightTitle" value="{$copyrightTitle|escape}" />
						{tr}Year:{/tr}
								<input size="4" class="wikitext" type="text" name="copyrightYear" value="{$copyrightYear|escape}" />
						{tr}Authors:{/tr}
							<input size="40" class="wikitext" name="copyrightAuthors" type="text" value="{$copyrightAuthors|escape}" />
					{/if}
				{/if}
				
				{if $page|lower neq 'sandbox' or $tiki_p_admin eq 'y'}
					{if $tiki_p_minor eq 'y' and $page|lower ne 'sandbox'}
						<div id="edtIsMinor">
							<div>{tr}A modificação foi{/tr}:</div>					
							{tooltip text="Selecione se essa modificação foi <b>pequena</b> (ela não vai aparecer na página das ultimas alterações do site)"}<input type="radio" name="isminor" value="on" onChange="if(self.preview)document.editPage.isminorPreview[0].checked=document.editPage.isminor[0].checked"/>{tr}Pequena{/tr}<br>{/tooltip}
							{tooltip text="Selecione se essa modificação foi <b>grande</b> e você quer que tod@s a vejam"}<input type="radio" name="isminor" value="" checked="checked" onChange="if(self.preview)document.editPage.isminorPreview[1].checked=document.editPage.isminor[1].checked"/>{tr}Grande{/tr}<br>{/tooltip}

						</div>
					{/if}

					{*ISSO NAO FUNCIONA!...
					<div id="save-exit" class="aSaveCancel" style="z-index: 10;">
					  {tooltip text="Salve as modificações que acaba de fazer"}<img name="save" src="styles/estudiolivre/bSave.png" onClick="document.forms.namedItem('form-edit-wiki').submit()" style="cursor: pointer">{/tooltip}&nbsp;&nbsp;&nbsp;
					  {tooltip text="Cancele as modificações que acaba de fazer"}<img name="cancel_edit" src="styles/estudiolivre/bCancelar.png" onClick="document.forms.namedItem('form-edit-wiki').submit()" style="cursor: pointer">{/tooltip}
					</div>
					*}
					<div id="edtSaveCancel">
					<input class="image" name="save" src="styles/estudiolivre/bSave.png" type="image" value="{tr}save{/tr}" /> &nbsp;&nbsp;
					{if $page|lower ne 'sandbox'}
						<input class="image" name="cancel_edit" src="styles/estudiolivre/bCancelar.png" type="image" value="{tr}cancel edit{/tr}"  onclick="cancelar=1"/>
					{/if}
					</div>
				{/if}
			</div>

		
	</div>
</form>

<div id="precisaComentar" style="display:none;width:200px;padding:5px">
  		{tr}É <b>recomendável</b> comentar as modificações realizadas. Assim todos podem saber qual modificação foi feita na página.{/tr}
  		<br/>
  		<br>
  		{tr}Faça o comentário no campo abaixo{/tr}:
  		<br/>
		<input class="wikitext" id="lightComment" type="text" name="lightComment" value="" {if $useJavascript eq "y"}onkeydown="lightBoxKey(event){/if}"/>
		<div id="edtSaveCancel">
			<img src="styles/estudiolivre/bSave.png" value="{tr}save{/tr}" onclick="comment()"/>
		</div>
	</form>
</div>

	{literal}
		<script language="javascript" type="text/javascript">
		
		function checkForm() {
			//for minor changes
			if (document.editPage.isminor[0].checked){
				return true;
			}
			
			//comments
			if(!document.editPage.comment.value && !cancelar){
				showLightbox('precisaComentar');
				// so that this gets the input focus!
				document.getElementById('lightComment').focus();
				return false;
			}
			return true;
		}
		
		function savePage(){
			var inputSave = document.createElement('input');
			inputSave.type = "hidden";
			inputSave.name = "save";
			inputSave.value = "1";
			document.getElementById('editpageform').appendChild(inputSave);
			document.getElementById('editpageform').submit();
		}
		
		function comment(){
			document.editPage.comment.value=document.getElementById('lightComment').value;
			savePage();
			hideLightbox();
		}
		
		//returns the keycode of the key associated with the given event
		function getKeyCode(e){
			var code=0;
			if (!e) var e = window.event;
			if (e.keyCode) code = e.keyCode;
			else if (e.which) code = e.which;		
			return code;
		}
		
		//used in the commenting lightbox
		function lightBoxKey(e){
			var code = getKeyCode(e);
			if(code==13){
				//we pressed enter!
				comment();
			}
		}
		
		//used in the whole page!
		function keyDown(e){
			doCtrlToggle(e);
			doSave(e);
		}
		
		//control key was pressed
		function doCtrlToggle(e) {
			var code= getKeyCode(e);
				if (code == 17){
				ctrlToggle=ctrlToggle*-1;
				tooltip('{tr}Aperte <b>control + enter</b> para salvar as modificações feitas na página.{/tr}');
			}
		}
	
		//control key was released
		function undoCtrlToggle(e) {
			if (ctrlToggle == 1){
				ctrlToggle=-1;
				nd();
			}
		}
	
		//saves pages if enter was pressed whilst control key was down
		function doSave(e) {
			var code= getKeyCode(e);
			if (code == 13 && ctrlToggle == 1){
				if(checkForm()){
					savePage();	
				}
			}
		}
	
		var cancelar=0;	
		var ctrlToggle=-1;

		</script>
	{/literal}
	
{if $useJavascript eq "y"}
	{literal}
		<script language="javascript" type="text/javascript">	
			document.onkeydown=keyDown;
			document.onkeyup=undoCtrlToggle;			
		</script>
	{/literal}		
{/if}
<br />
