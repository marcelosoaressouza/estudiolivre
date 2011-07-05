<!-- templates/tiki-preview.tpl start -->
{literal}
	<script language="javascript" type="text/javascript">
	var preview=1;
	</script>
{/literal}
<div id="wikiPreviewCont">
	<span id="label" class="wikiPreview hiddenPointer" onclick="javascript:flip('previewCont');javascript:flip('labelLine');toggleImage(document.getElementById('pTArrow'),'iArrowGreyRight.png');">
		<img id="pTArrow" src="styles/estudiolivre/iArrowGreyDown.png">
		{tr}Preview{/tr} {tr}da página{/tr} <b>{$page|escape|truncate:15:"(...)":true}</b>
	</span>

	<div id="previewCont" style="display:block">
		<div  id="wikitext" class="wikiPreview">
			{$parsed}
		</div>
		<!--form  enctype="multipart/form-data" method="post" action="tiki-editpage.php" id="previewpageform">
			<input type="hidden" name="page" value="{$page|escape}" / -->
			<span id="attention" class="wikiPreview">
				{tr}Note: Remember that this is only a preview, and has not yet been saved!{/tr}
				<div id="attentionSave">
			    <span class="pointer" name="preview" onclick="setPreview();">
					<div id="edtPreviewAtt">{tr}Gerar{/tr} {if $preview}{tr}nova{/tr} {/if}{tr}preview{/tr}</div>
				</span>
				{if $page|lower neq 'sandbox'}
					<div id="edtComentario">
					{tooltip text="<b>Comente</b> suscintamente as modificações feitas na edição"}
						<div>{tr}Comentário{/tr}:</div>
						<input id="iComP" class="wikitext" type="text" name="commentP" value="{$commentdata|escape}" onChange="document.editPage.comment.value=this.value"/>
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
						<div id="edtIsMinorP">
							<div>{tr}A modificação foi{/tr}:</div>					
							{tooltip text="Selecione se essa modificação foi <b>pequena</b> (ela não vai aparecer na página das ultimas alterações do site)"}<input type="radio" name="isminorPreview" value="on" onChange="document.editPage.isminor[0].checked=document.editPage.isminorPreview[0].checked"/>{tr}Pequena{/tr}<br>{/tooltip}
							{tooltip text="Selecione se essa modificação foi <b>grande</b> e você quer que tod@s a vejam"}<input type="radio" name="isminorPreview" value="" checked="checked" onChange="document.editPage.isminor[1].checked=document.editPage.isminorPreview[1].checked" />{tr}Grande{/tr}<br>{/tooltip}

						</div>
					{/if}

					{*ISSO NAO FUNCIONA!...
					<div id="save-exit" class="aSaveCancel" style="z-index: 10;">
					  {tooltip text="Salve as modificações que acaba de fazer"}<img name="save" src="styles/estudiolivre/bSave.png" onClick="document.forms.namedItem('form-edit-wiki').submit()" style="cursor: pointer">{/tooltip}&nbsp;&nbsp;&nbsp;
					  {tooltip text="Cancele as modificações que acaba de fazer"}<img name="cancel_edit" src="styles/estudiolivre/bCancelar.png" onClick="document.forms.namedItem('form-edit-wiki').submit()" style="cursor: pointer">{/tooltip}
					</div>
					*}
					<div id="edtSaveCancel">
					<img class="pointer" src="styles/estudiolivre/bSave.png" onclick="if(checkForm()) savePage()"/> &nbsp;&nbsp;
					{if $page|lower ne 'sandbox'}
						<input class="image" name="cancel_edit" src="styles/estudiolivre/bCancelar.png" type="image" value="{tr}cancel edit{/tr}"  onclick="cancelar=1"/>
					{/if}
					</div>
				{/if}
			</div>
			</span>
		<br />
	</div>
		<!--/form-->
	{if $has_footnote}
		<div  class="wikitext">{$parsed_footnote}</div>
	{/if}
	<div id="labelLine" style="border-bottom: 2px solid grey; display:none;width: 100%; height: 2px;"></div>
</div>
<!-- templates/tiki-preview.tpl end -->
