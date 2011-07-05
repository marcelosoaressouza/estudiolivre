<?php /* Smarty version 2.6.18, created on 2011-06-27 19:53:24
         compiled from styles/geral/tiki-preview.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/geral/tiki-preview.tpl', 1, false),array('modifier', 'replace', 'styles/geral/tiki-preview.tpl', 10, false),array('modifier', 'escape', 'styles/geral/tiki-preview.tpl', 11, false),array('modifier', 'truncate', 'styles/geral/tiki-preview.tpl', 11, false),array('modifier', 'lower', 'styles/geral/tiki-preview.tpl', 26, false),array('block', 'tooltip', 'styles/geral/tiki-preview.tpl', 28, false),)), $this); ?>
<?php echo smarty_function_css(array('extra' => 'tiki-show_page'), $this);?>

<!-- templates/tiki-preview.tpl start -->
<?php echo '
	<script language="javascript" type="text/javascript">
	var preview=1;
	</script>
'; ?>

<div id="wikiPreviewCont">
	<span id="label" class="wikiPreview hiddenPointer" onclick="javascript:flip('previewCont');javascript:flip('labelLine');toggleImage(document.getElementById('pTArrow'),'iArrowGreyRight.png');">
		<img id="pTArrow" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyDown.png">
		Pré-visualização da página <b><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 15, "(...)", true) : smarty_modifier_truncate($_tmp, 15, "(...)", true)); ?>
</b>
	</span>

	<div id="previewCont" style="display:block">
		<div  id="wikitext" class="wikiPreview">
			<?php echo $this->_tpl_vars['parsed']; ?>

		</div>
		<!--form  enctype="multipart/form-data" method="post" action="tiki-editpage.php" id="previewpageform">
			<input type="hidden" name="page" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" / -->
			<span id="attention" class="wikiPreview">
				Nota: lembre-se que isto é apenas uma visualização, ainda não foi salvo.
				<div id="attentionSave">
			    <span class="pointer" name="preview" onclick="setPreview();">
					<div id="edtPreviewAtt">Gerar <?php if ($this->_tpl_vars['preview']): ?>nova <?php endif; ?>pré-visualização</div>
				</span>
				<?php if (((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) != 'sandbox'): ?>
					<div id="edtComentario">
					<?php $this->_tag_stack[] = array('tooltip', array('text' => "<b>Comente</b> suscintamente as modificações feitas na edição")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
						<div>Comentário:</div>
						<input id="iComP" class="wikitext" type="text" name="commentP" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['commentdata'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" onChange="document.editPage.comment.value=this.value"/>
					<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					</div>
					<?php if ($this->_tpl_vars['wiki_feature_copyrights'] == 'y'): ?>
						Copyright:
						<tr class="formcolor"><td>
						Título:
						<input size="40" class="wikitext" type="text" name="copyrightTitle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['copyrightTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
						Ano:
								<input size="4" class="wikitext" type="text" name="copyrightYear" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['copyrightYear'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
						Autores:
							<input size="40" class="wikitext" name="copyrightAuthors" type="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['copyrightAuthors'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
					<?php endif; ?>
				<?php endif; ?>
				
				<?php if (((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) != 'sandbox' || $this->_tpl_vars['tiki_p_admin'] == 'y'): ?>
					<?php if ($this->_tpl_vars['tiki_p_minor'] == 'y' && ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) != 'sandbox'): ?>
						<div id="edtIsMinorP">
							<div>A modificação foi:</div>					
							<?php $this->_tag_stack[] = array('tooltip', array('text' => "Selecione se essa modificação foi <b>pequena</b> (ela não vai aparecer na página das ultimas alterações do site)")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><input type="radio" name="isminorPreview" value="on" onChange="document.editPage.isminor[0].checked=document.editPage.isminorPreview[0].checked"/>Pequena<br><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
							<?php $this->_tag_stack[] = array('tooltip', array('text' => "Selecione se essa modificação foi <b>grande</b> e você quer que tod@s a vejam")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><input type="radio" name="isminorPreview" value="" checked="checked" onChange="document.editPage.isminor[1].checked=document.editPage.isminorPreview[1].checked" />Grande<br><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>

						</div>
					<?php endif; ?>

					
					<div id="edtSaveCancel">
					<img class="pointer" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/bSave.png" onclick="if(checkForm()) savePage()"/> &nbsp;&nbsp;
					<?php if (((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) != 'sandbox'): ?>
						<input class="image" name="cancel_edit" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/bCancelar.png" type="image" value="cancelar edição"  onclick="cancelar=1"/>
					<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
			</span>
		<br />
	</div>
		<!--/form-->
	<?php if ($this->_tpl_vars['has_footnote']): ?>
		<div  class="wikitext"><?php echo $this->_tpl_vars['parsed_footnote']; ?>
</div>
	<?php endif; ?>
	<div id="labelLine" style="border-bottom: 2px solid grey; display:none;width: 100%; height: 2px;"></div>
</div>
<!-- templates/tiki-preview.tpl end -->