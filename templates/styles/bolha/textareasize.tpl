{css}
{* $Header: /cvsroot/arca/estudiolivre/src/templates/styles/bolha/textareasize.tpl,v 1.1 2006-10-20 21:11:33 rhwinter Exp $ *}
{* \brief: the 4 buttoms to change a textarea size (only one per form)
  * \param: $area_name = the textarea id
  * \param: $formId = the form id
  * the form needs 2 hidden input named 'rows' and 'cols' to remember the settings for a preview
  *}
<div id="textareasize">
	{tooltip text="<b>Aumentar</b> a altura da caixa de edição de texto"}
	<a class="pointer" onClick="textareasize('{$area_name}', +10, 0, '{$formId}'); setCookie('editwikiRows', document.getElementById('editwiki').rows)">
		<img src="img/icons2/enlargeH.gif" border="0" />
	</a>
	{/tooltip}
	{tooltip text="<b>Diminuir</b> a altura da caixa de edição de texto"}
	<a class="pointer" onClick="textareasize('{$area_name}', -10, 0, '{$formId}'); setCookie('editwikiRows', document.getElementById('editwiki').rows)">
		<img src="img/icons2/reduceH.gif" border="0"/>
	</a>
	{/tooltip}
</div>
