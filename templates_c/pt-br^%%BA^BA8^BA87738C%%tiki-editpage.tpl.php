<?php /* Smarty version 2.6.18, created on 2011-06-27 19:52:23
         compiled from styles/geral/tiki-editpage.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/geral/tiki-editpage.tpl', 1, false),array('modifier', 'replace', 'styles/geral/tiki-editpage.tpl', 26, false),array('modifier', 'escape', 'styles/geral/tiki-editpage.tpl', 27, false),array('modifier', 'truncate', 'styles/geral/tiki-editpage.tpl', 27, false),array('modifier', 'lower', 'styles/geral/tiki-editpage.tpl', 44, false),array('modifier', 'default', 'styles/geral/tiki-editpage.tpl', 151, false),array('block', 'tr', 'styles/geral/tiki-editpage.tpl', 114, false),array('block', 'tooltip', 'styles/geral/tiki-editpage.tpl', 297, false),)), $this); ?>
<?php echo smarty_function_css(array(), $this);?>






<?php if ($this->_tpl_vars['editpageconflict'] == 'y'): ?>
	<script language='Javascript' type='text/javascript'>
	<!-- //Hide Script
		alert("Esta página está sendo validada por <?php echo $this->_tpl_vars['semUser']; ?>
. Prossiga por conta própria.")
	//End Hide Script -->
	</script>
<?php endif; ?>

<form  enctype="multipart/form-data" name="editPage" method="post" action="tiki-editpage.php" id="editpageform" onSubmit="return checkForm()">

	<?php if ($this->_tpl_vars['preview']): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-preview.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>

	<div id="wikiEditCont">	
	<span id="labelRight" class="pointer" name="preview" onclick="setPreview();">
	gerar <?php if ($this->_tpl_vars['preview']): ?>nova <?php endif; ?>pré-visualização
	</span><br>
	<span id="label" class="wikiEdit hiddenPointer" onclick="javascript:flip('editCont');javascript:flip('editLabelLine');toggleImage(document.getElementById('edTArrow'),'iArrowGreyRight.png');">
		<img id="edTArrow" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyDown.png">
			Edição da página <b><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "(...)", true) : smarty_modifier_truncate($_tmp, 20, "(...)", true)); ?>
<?php if ($this->_tpl_vars['pageAlias'] != ''): ?>&nbsp;(<?php echo ((is_array($_tmp=$this->_tpl_vars['pageAlias'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
)<?php endif; ?></b>
	</span>
	<div class="wikiEdit" id="editCont" style="display:block">
	<!--input type="submit" class="wikiaction" name="preview" value="pré-visualização" style="float:right"/-->
		<?php echo '
	<script language="javascript" type="text/javascript">
	function setPreview(){
		var inputPreview = document.createElement(\'input\');
		inputPreview.type = "hidden";
		inputPreview.name = "preview";
		inputPreview.value = "1";
		document.getElementById(\'editpageform\').appendChild(inputPreview);
		document.getElementById(\'editpageform\').submit();
		}
	</script>
		'; ?>

			
		<?php if (((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == 'sandbox'): ?>
		<div class="wikitext">
		A Caixa de Areia é uma página onde você pode praticar as técnicas de edição, usar o recurso de pré-visualização. Nenhuma versão da caixa de areia é armazenada.
		</div>
		<?php endif; ?>
			
		
			
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "textareasize.tpl", 'smarty_include_vars' => array('area_name' => 'editwiki','formId' => 'editpageform')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			
		<?php if (! $this->_tpl_vars['wysiwyg']): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-edit_help.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-edit_help_tool.tpl", 'smarty_include_vars' => array('area_name' => 'editwiki')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
			
			<?php $this->assign('rows', $_COOKIE['editwikiRows']); ?> <?php if (! $this->_tpl_vars['rows']): ?><?php $this->assign('rows', 40); ?><?php endif; ?>
			
		<textarea id='editwiki' class="wikiedit" name="edit" rows="<?php echo $this->_tpl_vars['rows']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['pagedata'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
			
		<?php if ($this->_tpl_vars['feature_freetags'] == 'y' && $this->_tpl_vars['tiki_p_freetags_tag'] == 'y'): ?>
		<br/>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "freetag.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		<?php endif; ?>
			<?php if ($this->_tpl_vars['categIds']): ?>
			<?php unset($this->_sections['o']);
$this->_sections['o']['name'] = 'o';
$this->_sections['o']['loop'] = is_array($_loop=$this->_tpl_vars['categIds']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['o']['show'] = true;
$this->_sections['o']['max'] = $this->_sections['o']['loop'];
$this->_sections['o']['step'] = 1;
$this->_sections['o']['start'] = $this->_sections['o']['step'] > 0 ? 0 : $this->_sections['o']['loop']-1;
if ($this->_sections['o']['show']) {
    $this->_sections['o']['total'] = $this->_sections['o']['loop'];
    if ($this->_sections['o']['total'] == 0)
        $this->_sections['o']['show'] = false;
} else
    $this->_sections['o']['total'] = 0;
if ($this->_sections['o']['show']):

            for ($this->_sections['o']['index'] = $this->_sections['o']['start'], $this->_sections['o']['iteration'] = 1;
                 $this->_sections['o']['iteration'] <= $this->_sections['o']['total'];
                 $this->_sections['o']['index'] += $this->_sections['o']['step'], $this->_sections['o']['iteration']++):
$this->_sections['o']['rownum'] = $this->_sections['o']['iteration'];
$this->_sections['o']['index_prev'] = $this->_sections['o']['index'] - $this->_sections['o']['step'];
$this->_sections['o']['index_next'] = $this->_sections['o']['index'] + $this->_sections['o']['step'];
$this->_sections['o']['first']      = ($this->_sections['o']['iteration'] == 1);
$this->_sections['o']['last']       = ($this->_sections['o']['iteration'] == $this->_sections['o']['total']);
?>
			<input type="hidden" name="cat_categories[]" value="<?php echo $this->_tpl_vars['categIds'][$this->_sections['o']['index']]; ?>
" />
			<?php endfor; endif; ?>
			<input type="hidden" name="categId" value="<?php echo $this->_tpl_vars['categIdstr']; ?>
" />
			<input type="hidden" name="cat_categorize" value="on" />
			<?php else: ?>
			<br/>
			<?php if ($this->_tpl_vars['tiki_p_view_categories'] == 'y'): ?>
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "categorize.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endif; ?>
		<?php endif; ?>
				
			<br/>
				
				<span class="hiddenPointer" onclick="javascript:flip('maisOpcoes');toggleImage(document.getElementById('edtOptTArrow'),'iArrowGreyDown.png');" >
				<img class="pointer" id="edtOptTArrow" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyRight.png">
				<b>Mais opções</b>
				</span>
				<div id="maisOpcoes" style="display:none">
					<?php if ($this->_tpl_vars['page_ref_id']): ?>
						<input type="hidden" name="page_ref_id" value="<?php echo $this->_tpl_vars['page_ref_id']; ?>
" />
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['current_page_id']): ?>
						<input type="hidden" name="current_page_id" value="<?php echo $this->_tpl_vars['current_page_id']; ?>
" />
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['add_child']): ?>
						<input type="hidden" name="add_child" value="true" />
					<?php endif; ?>
					<?php if ($this->_tpl_vars['can_wysiwyg']): ?>
						<?php if (! $this->_tpl_vars['wysiwyg']): ?>
							<span class="button2"><a class="linkbut" href="?page=<?php echo $this->_tpl_vars['page']; ?>
&&wysiwyg=y">Usar editor WYSIWYG</a></span>
						<?php else: ?>
							<span class="button2"><a class="linkbut" href="?page=<?php echo $this->_tpl_vars['page']; ?>
&&wysiwyg=n">Usar editor normal</a></span>
						<?php endif; ?>
					<?php endif; ?>
					
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "structures.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					
					<?php if ($this->_tpl_vars['feature_wiki_templates'] == 'y' && $this->_tpl_vars['tiki_p_use_content_templates'] == 'y' && ! $this->_tpl_vars['templateId']): ?>
						<br/>
						Aplicar um padrão:
						<select name="templateId" onchange="javascript:document.getElementById('editpageform').submit();">
						<option value="0">nenhum</option>
						<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['templates']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ix']['show'] = true;
$this->_sections['ix']['max'] = $this->_sections['ix']['loop'];
$this->_sections['ix']['step'] = 1;
$this->_sections['ix']['start'] = $this->_sections['ix']['step'] > 0 ? 0 : $this->_sections['ix']['loop']-1;
if ($this->_sections['ix']['show']) {
    $this->_sections['ix']['total'] = $this->_sections['ix']['loop'];
    if ($this->_sections['ix']['total'] == 0)
        $this->_sections['ix']['show'] = false;
} else
    $this->_sections['ix']['total'] = 0;
if ($this->_sections['ix']['show']):

            for ($this->_sections['ix']['index'] = $this->_sections['ix']['start'], $this->_sections['ix']['iteration'] = 1;
                 $this->_sections['ix']['iteration'] <= $this->_sections['ix']['total'];
                 $this->_sections['ix']['index'] += $this->_sections['ix']['step'], $this->_sections['ix']['iteration']++):
$this->_sections['ix']['rownum'] = $this->_sections['ix']['iteration'];
$this->_sections['ix']['index_prev'] = $this->_sections['ix']['index'] - $this->_sections['ix']['step'];
$this->_sections['ix']['index_next'] = $this->_sections['ix']['index'] + $this->_sections['ix']['step'];
$this->_sections['ix']['first']      = ($this->_sections['ix']['iteration'] == 1);
$this->_sections['ix']['last']       = ($this->_sections['ix']['iteration'] == $this->_sections['ix']['total']);
?>
						<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['templates'][$this->_sections['ix']['index']]['templateId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['templateId'] == $this->_tpl_vars['templates'][$this->_sections['ix']['index']]['templateId']): ?>selected="selected"<?php endif; ?>><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['templates'][$this->_sections['ix']['index']]['name']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
						<?php endfor; endif; ?>
						</select>
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['feature_wiki_ratings'] == 'y' && $this->_tpl_vars['tiki_p_wiki_admin_ratings'] == 'y'): ?>
						Usar classificação:
						<br/>
						<?php if ($this->_tpl_vars['poll_rated']['info']): ?>
							<a href="tiki-admin_poll_options.php?pollId=<?php echo $this->_tpl_vars['poll_rated']['info']['pollId']; ?>
"><?php echo $this->_tpl_vars['poll_rated']['info']['title']; ?>
</a>
							<span class="button2"><a class="linkbut" href="tiki-editpage.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;removepoll=<?php echo $this->_tpl_vars['poll_rated']['info']['pollId']; ?>
">desabilitar</a>
							<input type="hidden" name="poll_template" value="<?php echo $this->_tpl_vars['poll_rated']['info']['pollId']; ?>
" />
							<?php if ($this->_tpl_vars['tiki_p_admin_poll'] == 'y'): ?>
								<span class="button2"><a class="linkbut" href="tiki-admin_polls.php">administrar enquetes</a></span>
							<?php endif; ?>
						<?php else: ?>
							<?php if (count ( $this->_tpl_vars['polls_templates'] )): ?>
								tipo
								<select name="poll_template">
								<option value="0">nenhum</option>
								<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['polls_templates']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ix']['show'] = true;
$this->_sections['ix']['max'] = $this->_sections['ix']['loop'];
$this->_sections['ix']['step'] = 1;
$this->_sections['ix']['start'] = $this->_sections['ix']['step'] > 0 ? 0 : $this->_sections['ix']['loop']-1;
if ($this->_sections['ix']['show']) {
    $this->_sections['ix']['total'] = $this->_sections['ix']['loop'];
    if ($this->_sections['ix']['total'] == 0)
        $this->_sections['ix']['show'] = false;
} else
    $this->_sections['ix']['total'] = 0;
if ($this->_sections['ix']['show']):

            for ($this->_sections['ix']['index'] = $this->_sections['ix']['start'], $this->_sections['ix']['iteration'] = 1;
                 $this->_sections['ix']['iteration'] <= $this->_sections['ix']['total'];
                 $this->_sections['ix']['index'] += $this->_sections['ix']['step'], $this->_sections['ix']['iteration']++):
$this->_sections['ix']['rownum'] = $this->_sections['ix']['iteration'];
$this->_sections['ix']['index_prev'] = $this->_sections['ix']['index'] - $this->_sections['ix']['step'];
$this->_sections['ix']['index_next'] = $this->_sections['ix']['index'] + $this->_sections['ix']['step'];
$this->_sections['ix']['first']      = ($this->_sections['ix']['iteration'] == 1);
$this->_sections['ix']['last']       = ($this->_sections['ix']['iteration'] == $this->_sections['ix']['total']);
?>
								<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['polls_templates'][$this->_sections['ix']['index']]['pollId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"<?php if ($this->_tpl_vars['polls_templates'][$this->_sections['ix']['index']]['pollId'] == $this->_tpl_vars['poll_template']): ?> selected="selected"<?php endif; ?>><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['polls_templates'][$this->_sections['ix']['index']]['title']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
								<?php endfor; endif; ?>
								</select>
								título
								<input type="text" name="poll_title" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['poll_title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" size="22" />
							<?php else: ?>
								Não existe um modelo de enquete disponível.
								<?php if ($this->_tpl_vars['tiki_p_admin_polls'] != 'y'): ?>
									Você deve pedir para o administrador cria-los.
								<?php endif; ?>
							<?php endif; ?>
							<?php if (count ( $this->_tpl_vars['listpolls'] )): ?>
								or use 
								<select name="olpoll">
								<option value="">... uma enquete existente</option>
								<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['listpolls']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ix']['show'] = true;
$this->_sections['ix']['max'] = $this->_sections['ix']['loop'];
$this->_sections['ix']['step'] = 1;
$this->_sections['ix']['start'] = $this->_sections['ix']['step'] > 0 ? 0 : $this->_sections['ix']['loop']-1;
if ($this->_sections['ix']['show']) {
    $this->_sections['ix']['total'] = $this->_sections['ix']['loop'];
    if ($this->_sections['ix']['total'] == 0)
        $this->_sections['ix']['show'] = false;
} else
    $this->_sections['ix']['total'] = 0;
if ($this->_sections['ix']['show']):

            for ($this->_sections['ix']['index'] = $this->_sections['ix']['start'], $this->_sections['ix']['iteration'] = 1;
                 $this->_sections['ix']['iteration'] <= $this->_sections['ix']['total'];
                 $this->_sections['ix']['index'] += $this->_sections['ix']['step'], $this->_sections['ix']['iteration']++):
$this->_sections['ix']['rownum'] = $this->_sections['ix']['iteration'];
$this->_sections['ix']['index_prev'] = $this->_sections['ix']['index'] - $this->_sections['ix']['step'];
$this->_sections['ix']['index_next'] = $this->_sections['ix']['index'] + $this->_sections['ix']['step'];
$this->_sections['ix']['first']      = ($this->_sections['ix']['iteration'] == 1);
$this->_sections['ix']['last']       = ($this->_sections['ix']['iteration'] == $this->_sections['ix']['total']);
?>
									<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['listpolls'][$this->_sections['ix']['index']]['pollId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo ((is_array($_tmp=@$this->_tpl_vars['listpolls'][$this->_sections['ix']['index']]['title'])) ? $this->_run_mod_handler('default', true, $_tmp, "<i>... no title ...</i>") : smarty_modifier_default($_tmp, "<i>... no title ...</i>")); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<?php echo $this->_tpl_vars['listpolls'][$this->_sections['ix']['index']]['votes']; ?>
 votos)</option>
								<?php endfor; endif; ?>
								</select>
							<?php endif; ?>
						<?php endif; ?>
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['feature_multilingual'] == 'y'): ?>
						Idioma:
						<select name="lang">
							<option value="">Escolha o idioma dessa página...</option>
							<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['languages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ix']['show'] = true;
$this->_sections['ix']['max'] = $this->_sections['ix']['loop'];
$this->_sections['ix']['step'] = 1;
$this->_sections['ix']['start'] = $this->_sections['ix']['step'] > 0 ? 0 : $this->_sections['ix']['loop']-1;
if ($this->_sections['ix']['show']) {
    $this->_sections['ix']['total'] = $this->_sections['ix']['loop'];
    if ($this->_sections['ix']['total'] == 0)
        $this->_sections['ix']['show'] = false;
} else
    $this->_sections['ix']['total'] = 0;
if ($this->_sections['ix']['show']):

            for ($this->_sections['ix']['index'] = $this->_sections['ix']['start'], $this->_sections['ix']['iteration'] = 1;
                 $this->_sections['ix']['iteration'] <= $this->_sections['ix']['total'];
                 $this->_sections['ix']['index'] += $this->_sections['ix']['step'], $this->_sections['ix']['iteration']++):
$this->_sections['ix']['rownum'] = $this->_sections['ix']['iteration'];
$this->_sections['ix']['index_prev'] = $this->_sections['ix']['index'] - $this->_sections['ix']['step'];
$this->_sections['ix']['index_next'] = $this->_sections['ix']['index'] + $this->_sections['ix']['step'];
$this->_sections['ix']['first']      = ($this->_sections['ix']['iteration'] == 1);
$this->_sections['ix']['last']       = ($this->_sections['ix']['iteration'] == $this->_sections['ix']['total']);
?>
							<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['languages'][$this->_sections['ix']['index']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"<?php if ($this->_tpl_vars['lang'] == $this->_tpl_vars['languages'][$this->_sections['ix']['index']]['value']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['languages'][$this->_sections['ix']['index']]['name']; ?>
</option>
							<?php endfor; endif; ?>
						</select>
						<br/>
						
					<?php endif; ?>
					
					
					
					
					<?php if ($this->_tpl_vars['feature_wiki_description'] == 'y'): ?>
						<br/>
						Descrição:<input class="wikitext" type="text" name="description" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['description'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['wysiwyg']): ?>
						 <script type="text/javascript" src="lib/fckeditor/fckeditor.js"></script>
						 <script type="text/javascript">
					        sBasePath = 'lib/fckeditor/';
							var oFCKeditor = new FCKeditor( 'edit' ) ;
							oFCKeditor.BasePath	= sBasePath ;
							oFCKeditor.ReplaceTextarea() ;
						 </script>
					<?php endif; ?>
					
					<input type="hidden" name="rows" value="<?php echo $this->_tpl_vars['rows']; ?>
"/>
					<input type="hidden" name="cols" value="<?php echo $this->_tpl_vars['cols']; ?>
"/>
					
					<?php if ($this->_tpl_vars['feature_wiki_footnotes'] == 'y'): ?>
						<?php if ($this->_tpl_vars['user']): ?>
							
							Notas de rodapé:
							<textarea name="footnote" rows="8" cols="42" style="width:95%;" ><?php echo ((is_array($_tmp=$this->_tpl_vars['footnote'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea>
						<?php endif; ?>
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['feature_wiki_replace'] == 'y'): ?>
						<script type="text/javascript">
						<?php echo '
						function searchrep() {
						  c = document.getElementById(\'caseinsens\')
						  s = document.getElementById(\'search\')
						  r = document.getElementById(\'replace\')
						  t = document.getElementById(\'editwiki\')
						
						  var opt = \'g\';
						  if (c.checked == true) {
						    opt += \'i\'
						  }
						  var str = t.value
						  var re = new RegExp(s.value,opt)
						  t.value = str.replace(re,r.value)
						}
						'; ?>

						</script>
						Busca :
						<input class="wikitext" type="text" id="search"/>
						Replace to:
						<input class="wikitext" type="text" id="replace"/>
						<input type="checkbox" id="caseinsens" />Case Insensitivity
						<input type="button" value="substituir" onclick="javascript:searchrep();">
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['wiki_spellcheck'] == 'y'): ?>
						<br/>
						Verificação ortográfica:
						<input type="checkbox" name="spellcheck" <?php if ($this->_tpl_vars['spellcheck'] == 'y'): ?>checked="checked"<?php endif; ?>/>
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['feature_wiki_import_html'] == 'y'): ?>
						  <br/>
						  Importar HTML:
						    <input class="wikitext" type="text" name="suck_url" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['suck_url'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />&nbsp;
						    <input type="submit" class="wikiaction" name="do_suck" value="Importar" />&nbsp;
						    <input type="checkbox" name="parsehtml" <?php if ($this->_tpl_vars['parsehtml'] == 'y'): ?>checked="checked"<?php endif; ?>/>&nbsp;
						    Tentar converter HTML para wiki
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['tiki_p_admin_wiki'] == 'y'): ?>
						<br>
						Importar página:
						<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
						<input name="userfile1" type="file" />
						<a href="tiki-export_wiki_pages.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;all=1" class="link">exportar todas as versões</a>
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['feature_wiki_pictures'] == 'y' && $this->_tpl_vars['tiki_p_upload_picture'] == 'y'): ?>
						<br/>
						Carregar uma imagem
						<input type="hidden" name="MAX_FILE_SIZE" value="1000000000" />
						<input type="hidden" name="hasAlreadyInserted" value="" />
						<input type="hidden" name="prefix" value="/img/wiki_up/<?php if ($this->_tpl_vars['tikidomain']): ?><?php echo $this->_tpl_vars['tikidomain']; ?>
/<?php endif; ?>" />
						<input name="picfile1" type="file" onchange="javascript:insertImg('editwiki','picfile1','hasAlreadyInserted')"/>
						<input type="hidden" id="img_form_count" name="img_form_count" value="1" />
						<div id="new_img_form"></div>
						<a href="javascript:addImgForm()" onclick="needToConfirm = false;">Adicionar outra imagem</a>
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['feature_wiki_icache'] == 'y'): ?>
						Cache
						    <select name="wiki_cache">
						    <option value="0" <?php if ($this->_tpl_vars['wiki_cache'] == 0): ?>selected="selected"<?php endif; ?>>0 (sem cache)</option>
						    <option value="60" <?php if ($this->_tpl_vars['wiki_cache'] == 60): ?>selected="selected"<?php endif; ?>>1 minuto</option>
						    <option value="300" <?php if ($this->_tpl_vars['wiki_cache'] == 300): ?>selected="selected"<?php endif; ?>>5 minutos</option>
						    <option value="600" <?php if ($this->_tpl_vars['wiki_cache'] == 600): ?>selected="selected"<?php endif; ?>>10 minuto</option>
						    <option value="900" <?php if ($this->_tpl_vars['wiki_cache'] == 900): ?>selected="selected"<?php endif; ?>>15 minutos</option>
						    <option value="1800" <?php if ($this->_tpl_vars['wiki_cache'] == 1800): ?>selected="selected"<?php endif; ?>>30 minuto</option>
						    <option value="3600" <?php if ($this->_tpl_vars['wiki_cache'] == 3600): ?>selected="selected"<?php endif; ?>>1 hora</option>
						    <option value="7200" <?php if ($this->_tpl_vars['wiki_cache'] == 7200): ?>selected="selected"<?php endif; ?>>2 horas</option>
						    </select> 
					<?php endif; ?>
					
					<input type="hidden" name="page" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
					
					<?php if ($this->_tpl_vars['feature_antibot'] == 'y' && $this->_tpl_vars['anon_user'] == 'y'): ?>
						<br/>
						Código de verificação anti-robô:
						<img src="tiki-random_num_img.php" alt='Imagem Aleatória'/>
						Digite o código que está acima:
						<input type="text" maxlength="8" size="8" name="antibotcode" />
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['wiki_feature_copyrights'] == 'y'): ?>
						<br/>
						Licença:
						<a href="tiki-index.php?page=<?php echo $this->_tpl_vars['wikiLicensePage']; ?>
"><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['wikiLicensePage']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
						<?php if ($this->_tpl_vars['wikiSubmitNotice'] != ""): ?>
							Importante:
							<b><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['wikiSubmitNotice']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></b>
						<?php endif; ?>
					<?php endif; ?>
					
					<?php if ($this->_tpl_vars['feature_wiki_allowhtml'] == 'y' && $this->_tpl_vars['tiki_p_use_HTML'] == 'y'): ?>
						<br/>
						<?php $this->_tag_stack[] = array('tooltip', array('text' => "Permite a colocação de <b>tags HTML</b> no texto wiki. Só modifique essa opção se souber <b>muito</b> bem o que isso significa.")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
						<input type="checkbox" name="allowhtml" <?php if ($this->_tpl_vars['allowhtml'] == 'y'): ?>checked="checked"<?php endif; ?>/>Permitir HTML
						<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php endif; ?>
				</div>	
			</div>
		</div>			
		<div id="editLabelLine" style="border-bottom: 2px solid grey; display:none;width: 100%; height: 2px;"></div>
		
		<div id="attention">
			<span class="pointer" name="preview" onclick="setPreview();">
				<div id="edtPreviewAtt">Gerar <?php if ($this->_tpl_vars['preview']): ?>nova <?php endif; ?>pré-visualização</div>
			</span><br>
				<?php if (((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) != 'sandbox'): ?>
				<div id="edtComentario">
				<?php $this->_tag_stack[] = array('tooltip', array('text' => "<b>Comente</b> suscintamente as modificações feitas na edição")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					<b>Comentário:</b><br>
					<input class="wikitext" id="iCom" type="text" name="comment" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['commentdata'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" onChange="if(self.preview)document.getElementById('iComP').value=this.value"/>
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
						<div id="edtIsMinor">
							<div>A modificação foi:</div>					
						<input type="radio" name="isminor" value="on" onChange="if(self.preview)document.editPage.isminorPreview[0].checked=document.editPage.isminor[0].checked"/>Pequena<br>
					<input type="radio" name="isminor" value="" checked="checked" onChange="if(self.preview)document.editPage.isminorPreview[1].checked=document.editPage.isminor[1].checked"/>Grande<br>
						</div>
					<?php endif; ?>

					<div id="edtSaveCancel">
					<input class="image" name="save" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/bSave.png" type="image" value="salvar" /> &nbsp;&nbsp;
					<?php if (((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) != 'sandbox'): ?>
					<input class="image" name="cancel_edit" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/bCancelar.png" type="image" value="cancelar edição"  onclick="cancelar=1"/>
					<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

		
	</div>
</form>

<div id="precisaComentar" class="none" style="width:200px;padding:5px">
  		É <b>recomendável</b> comentar as modificações realizadas. Assim todos podem saber qual modificação foi feita na página.
  		<br/>
  		<br>
  		Faça o comentário no campo abaixo:
  		<br/>
		<input class="wikitext" id="lightComment" type="text" name="lightComment" value="" <?php if ($this->_tpl_vars['useJavascript'] == 'y'): ?>onkeydown="lightBoxKey(event)<?php endif; ?>"/>
		<div id="edtSaveCancel">
			<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/bSave.png" value="salvar" onclick="comment()"/>
		</div>
	</form>
</div>

	<?php echo '
		<script language="javascript" type="text/javascript">
		
		function checkForm() {
			//for minor changes
			if (document.editPage.isminor[0].checked){
				return true;
			}
			
			//comments
			if(!document.editPage.comment.value && !cancelar){
				showLightbox(\'precisaComentar\');
				// so that this gets the input focus!
				document.getElementById(\'lightComment\').focus();
				return false;
			}
			return true;
		}
		
		function savePage(){
			var inputSave = document.createElement(\'input\');
			inputSave.type = "hidden";
			inputSave.name = "save";
			inputSave.value = "1";
			document.getElementById(\'editpageform\').appendChild(inputSave);
			document.getElementById(\'editpageform\').submit();
		}
		
		function comment(){
			document.editPage.comment.value=document.getElementById(\'lightComment\').value;
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
				tooltip(\'Aperte <b>control + enter</b> para salvar as modificações feitas na página.\');
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
	'; ?>

	
<?php if ($this->_tpl_vars['useJavascript'] == 'y'): ?>
	<?php echo '
		<script language="javascript" type="text/javascript">	
			document.onkeydown=keyDown;
			document.onkeyup=undoCtrlToggle;			
		</script>
	'; ?>
		
<?php endif; ?>
<br />