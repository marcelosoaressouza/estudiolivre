<div id="xEdit-block-{$blockName}">
  {$blockText}
  <span style="display: none" class="xEdit-edit" id="xEdit-edit-{$blockName}"><img src="img/btn-edit.gif" alt="Clique para editar" /></span>
  <div style="display: none" class="xEdit-save" id="xEdit-save-{$blockName}">Salvar</div>
  <div style="display: none" class="xEdit-cancel" id="xEdit-cancel-{$blockName}">Cancelar</div>
  <div style="display: none" class="xEdit-error" id="xEdit-error-{$blockName}"></div>
</div>
<script language="JavaScript">
  xEditBlocks['{$blockName}'] = new xEditBlock('{$itemType}',{$itemId},'{$blockName}');
</script>
