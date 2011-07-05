<?php /* Smarty version 2.6.18, created on 2011-04-06 06:28:04
         compiled from el-gallery_view.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'el-gallery_view.tpl', 2, false),array('function', 'ajax_input', 'el-gallery_view.tpl', 14, false),array('function', 'math', 'el-gallery_view.tpl', 52, false),array('function', 'ajax_textarea', 'el-gallery_view.tpl', 130, false),array('modifier', 'replace', 'el-gallery_view.tpl', 11, false),array('modifier', 'date_format', 'el-gallery_view.tpl', 24, false),array('modifier', 'show_filesize', 'el-gallery_view.tpl', 43, false),array('modifier', 'default', 'el-gallery_view.tpl', 52, false),array('modifier', 'cat', 'el-gallery_view.tpl', 62, false),array('modifier', 'escape', 'el-gallery_view.tpl', 166, false),array('block', 'tooltip', 'el-gallery_view.tpl', 14, false),)), $this); ?>
<!-- el-gallery_view.tpl begin -->
<?php echo smarty_function_css(array('extra' => "el-gallery_metadata,el-user_msg,ajax_inputs"), $this);?>


<script language="JavaScript" src="lib/js/freetags.js"></script>
<script language="JavaScript" src="lib/js/el_array.js"></script>
<script language="JavaScript" src="lib/js/edit_field_ajax.js"></script>
<script language="JavaScript" src="lib/js/uploadThumb.js"></script>
<script language="JavaScript" src="lib/js/el-rating.js"></script>
<script language="JavaScript" src="lib/js/delete_file.js"></script>

<img id="pubType" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iUp<?php echo $this->_tpl_vars['arquivo']->type; ?>
.png">
<h1 id="pubTitle">
	<?php if ($this->_tpl_vars['permission']): ?>
		<?php $this->_tag_stack[] = array('tooltip', array('text' => 'Clique para modificar o nome desse arquivo')); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'id' => 'title','value' => $this->_tpl_vars['arquivo']->title,'default' => 'Titulo','display' => 'inline'), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php else: ?>
		<?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'id' => 'title','value' => $this->_tpl_vars['arquivo']->title,'default' => 'Titulo','display' => 'inline'), $this);?>

	<?php endif; ?>
</h1>

<div id="info">
	<div id="author">
		<b>autor:</b> <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'id' => 'author','value' => $this->_tpl_vars['arquivo']->author,'default' => 'Autor da Obra','display' => 'inline'), $this);?>
<br/>
		<b>por:</b> <a href="el-user.php?view_user=<?php echo $this->_tpl_vars['arquivo']->user; ?>
"><?php echo $this->_tpl_vars['arquivo']->user; ?>
</a>
		<b>em:</b> <i><?php echo ((is_array($_tmp=$this->_tpl_vars['arquivo']->publishDate)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>
</i><br/>
		<?php $this->_tag_stack[] = array('tooltip', array('text' => $this->_tpl_vars['arquivo']->license->description)); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<a href="<?php echo $this->_tpl_vars['arquivo']->license->humanReadableLink; ?>
"><img id="lic" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/h_<?php echo $this->_tpl_vars['arquivo']->license->imageName; ?>
"></a>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php if ($this->_tpl_vars['permission']): ?>
			<?php $this->_tag_stack[] = array('tooltip', array('text' => "Apagar essa publicação <br/>(e <b>todos</b> seus arquivos!)")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<img class="pointer" onClick="deleteFile(<?php echo $this->_tpl_vars['arquivo']->id; ?>
, <?php echo $this->_tpl_vars['dontAskDelete']; ?>
, 0);" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iDelete.png"/>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php endif; ?>
	</div>
	
	<span id="down">
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Copie todos os arquivos (para o seu computador)")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<a href="el-download.php?pub=<?php echo $this->_tpl_vars['arquivoId']; ?>
&action=downloadAll">
				<img class="fl" alt="baixe tudo" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iDownload.png">
				<div>
					baixe tudo
					<?php if ($this->_tpl_vars['allFileSize']): ?>
		 				(<?php echo ((is_array($_tmp=$this->_tpl_vars['allFileSize'])) ? $this->_run_mod_handler('show_filesize', true, $_tmp) : smarty_modifier_show_filesize($_tmp)); ?>
)
		 			<?php endif; ?>
				</div>
			</a>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	</span>
	
	<span id="pubRating">
		<?php $this->_tag_stack[] = array('tooltip', array('name' => "view-avaliacao",'text' => "Avaliação atual")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<img id="ajax-aRatingImg" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/star<?php echo smarty_function_math(array('equation' => "round(x)",'x' => ((is_array($_tmp=@$this->_tpl_vars['arquivo']->rating)) ? $this->_run_mod_handler('default', true, $_tmp, 'blk') : smarty_modifier_default($_tmp, 'blk'))), $this);?>
.png">
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php $this->assign('votes', $this->_tpl_vars['arquivo']->getArraySize('votes')); ?>
		<b><span id="ajax-aVoteTotal"><?php echo $this->_tpl_vars['votes']; ?>
</span> voto<?php if ($this->_tpl_vars['votes'] != 1): ?>s<?php endif; ?></b> 
		<?php if ($this->_tpl_vars['user']): ?>
			<br/>
			<span id="rate" class="none">
				<?php $this->assign('userVote', $this->_tpl_vars['arquivo']->getUserVote()); ?>
				<?php unset($this->_sections['rating']);
$this->_sections['rating']['name'] = 'rating';
$this->_sections['rating']['start'] = (int)1;
$this->_sections['rating']['loop'] = is_array($_loop=6) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['rating']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['rating']['show'] = true;
$this->_sections['rating']['max'] = $this->_sections['rating']['loop'];
if ($this->_sections['rating']['start'] < 0)
    $this->_sections['rating']['start'] = max($this->_sections['rating']['step'] > 0 ? 0 : -1, $this->_sections['rating']['loop'] + $this->_sections['rating']['start']);
else
    $this->_sections['rating']['start'] = min($this->_sections['rating']['start'], $this->_sections['rating']['step'] > 0 ? $this->_sections['rating']['loop'] : $this->_sections['rating']['loop']-1);
if ($this->_sections['rating']['show']) {
    $this->_sections['rating']['total'] = min(ceil(($this->_sections['rating']['step'] > 0 ? $this->_sections['rating']['loop'] - $this->_sections['rating']['start'] : $this->_sections['rating']['start']+1)/abs($this->_sections['rating']['step'])), $this->_sections['rating']['max']);
    if ($this->_sections['rating']['total'] == 0)
        $this->_sections['rating']['show'] = false;
} else
    $this->_sections['rating']['total'] = 0;
if ($this->_sections['rating']['show']):

            for ($this->_sections['rating']['index'] = $this->_sections['rating']['start'], $this->_sections['rating']['iteration'] = 1;
                 $this->_sections['rating']['iteration'] <= $this->_sections['rating']['total'];
                 $this->_sections['rating']['index'] += $this->_sections['rating']['step'], $this->_sections['rating']['iteration']++):
$this->_sections['rating']['rownum'] = $this->_sections['rating']['iteration'];
$this->_sections['rating']['index_prev'] = $this->_sections['rating']['index'] - $this->_sections['rating']['step'];
$this->_sections['rating']['index_next'] = $this->_sections['rating']['index'] + $this->_sections['rating']['step'];
$this->_sections['rating']['first']      = ($this->_sections['rating']['iteration'] == 1);
$this->_sections['rating']['last']       = ($this->_sections['rating']['iteration'] == $this->_sections['rating']['total']);
?>
					<?php if (! $this->_sections['rating']['first']): ?><?php $this->assign('plural', 's'); ?><?php endif; ?>
					<?php $this->_tag_stack[] = array('tooltip', array('text' => ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp="Clique para mudar o seu voto para <b>")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_sections['rating']['index']) : smarty_modifier_cat($_tmp, $this->_sections['rating']['index'])))) ? $this->_run_mod_handler('cat', true, $_tmp, ' estrela') : smarty_modifier_cat($_tmp, ' estrela')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['plural']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['plural'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "</b>") : smarty_modifier_cat($_tmp, "</b>")))); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				    	<?php if ($this->_tpl_vars['userVote']->rating && $this->_tpl_vars['userVote']->rating >= $this->_sections['rating']['index']): ?>
			  		    	<img class="pointer" id="aRatingVote-<?php echo $this->_sections['rating']['index']; ?>
" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iStarOn.png" onClick="acervoVota(<?php echo $this->_sections['rating']['index']; ?>
)"/>
				    	<?php else: ?>
				        	<img class="pointer" id="aRatingVote-<?php echo $this->_sections['rating']['index']; ?>
" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iStarOff.png" onClick="acervoVota(<?php echo $this->_sections['rating']['index']; ?>
)"/>
					    <?php endif; ?>
				    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			    <?php endfor; endif; ?>
			</span>
			<b class="pointer" onClick="toggleSpan('rate')">vote!</b>
		<?php endif; ?>
	</span>
	
</div>

<br/>
<?php if (isset ( $this->_tpl_vars['viewFile'] )): ?>
<div id="viewFile">
	<?php $this->assign('file', $this->_tpl_vars['arquivo']->filereferences[$this->_tpl_vars['viewFile']]); ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "meta-file.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php endif; ?>
<br/>

<span id="tags">
	<?php $this->assign('fileTags', $this->_tpl_vars['arquivo']->tags); ?>
	<?php if ($this->_tpl_vars['permission']): ?>
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique para editar as <b>tags</b> desse arquivo")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img class="pointer" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iTagEdit.png" onClick="editaCampo('tags')"><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php endif; ?>
	<div id="show-tags">
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "el-gallery_tags.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
	
	<?php if ($this->_tpl_vars['permission']): ?>
		<input id="input-tags" value="<?php echo $this->_tpl_vars['arquivo']->tagString; ?>
" onBlur="xajax_save_field('tags', this.value)" style="display:none;">
		<img id="error-tags" class="gUpErrorImg" style="display: none" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/errorImg.png" onMouseover="tooltip(errorMsg_tags);" onMouseout="nd();"> 
		<script language="JavaScript">  display["tags"] = "block";errorMsg_tags = "";</script>
	<?php endif; ?>
</span>

<br/>

<span id="more">
	<div id="files">
		<div class="sectionTitle">
			<span class="titleCont" onclick="flip('filesCont');toggleImage(document.getElementById('fileTArrow'),'iArrowGreyRight.png')">
				<img id="fileTArrow" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyDown.png">
				<h1>Arquivos da Publicação</h1>
			</span>
		</div>
		<div id="filesCont" class="itemCont" style="display:block">
			<div id="ajax-pubFilesCont">
				<?php $_from = $this->_tpl_vars['arquivo']->filereferences; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['file']):
?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "fileBox.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endforeach; endif; unset($_from); ?>
			</div>
		</div>
	</div>
		
	<div id="descriptionInfo">
		<div class="sectionTitle">
			<span class="titleCont titleContRight" onclick="flip('descCont');toggleImage(document.getElementById('desTArrow'),'iArrowGreyRight.png')" >
				<img id="desTArrow" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyDown.png">
				<h1>Descrição</h1>
			</span>
		</div>
		<div id="descCont" class="itemCont" style="display:block">
			<?php if ($this->_tpl_vars['permission']): ?>
				<?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique aqui para modificar a descri&ccedil;&atilde;o do arquivo")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo smarty_function_ajax_textarea(array('permission' => $this->_tpl_vars['permission'],'style' => "width: 250px; height:125px; border: 1px inset rgb(233, 233, 174);padding: 3px;font-size: 12px; font-family: Arial, Verdana, Helvetica, Lucida, Sans-Serif;background-color: #f1f1f1;margin-bottom: 5px;",'id' => 'description','value' => $this->_tpl_vars['arquivo']->description,'display' => 'block','wikiParsed' => 1), $this);?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php else: ?>
				<?php echo smarty_function_ajax_textarea(array('permission' => $this->_tpl_vars['permission'],'style' => "width: 250px; height:125px; border: 1px inset rgb(233, 233, 174);padding: 3px;font-size: 12px; font-family: Arial, Verdana, Helvetica, Lucida, Sans-Serif;background-color: #f1f1f1;margin-bottom: 5px;",'id' => 'description','value' => $this->_tpl_vars['arquivo']->description,'display' => 'block','wikiParsed' => 1), $this);?>

			<?php endif; ?>
		</div>
		<div class="sectionTitle">
			<span class="titleCont titleContRight" onclick="flip('infoCont');toggleImage(document.getElementById('detTArrow'),'iArrowGreyRight.png')" >
				<img id="detTArrow" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyDown.png">
				<h1>Detalhes da Publicação</h1>
			</span>
		</div>
		<div id="infoCont" class="itemCont" style="display:block">
			<?php if ($this->_tpl_vars['permission']): ?>
				<div class="none" id="pThumbForm">
					suba outra miniatura<br/>
			        <iframe name="thumbUpTargetM" style="display:none"></iframe>
					<form name="thumbFormM" target="thumbUpTargetM" action="el-gallery_upload_thumb.php?thumbNum=M" method="post" enctype="multipart/form-data">
						<input type="hidden" name="UPLOAD_IDENTIFIER" value="">
						<input type="hidden" name="arquivoId" value="<?php echo $this->_tpl_vars['arquivo']->id; ?>
">
						<input type="file" name="thumbM" onChange="thumbSelected('M')">
						&nbsp;&nbsp;<span id="js-thumbStatusM"></span>
					</form>
					<?php if (count ( $this->_tpl_vars['fileThumbs'] )): ?>
						<br/>ou<br/>
						<select onChange="changePubThumb(this)">
							<option value="-1"> - use a de um dos arquivos - </option>
							<?php $_from = $this->_tpl_vars['fileThumbs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fileNum'] => $this->_tpl_vars['fileName']):
?>
								<option value="<?php echo $this->_tpl_vars['fileNum']; ?>
"><?php echo $this->_tpl_vars['fileName']; ?>
</option>
							<?php endforeach; endif; unset($_from); ?>
						</select>
					<?php endif; ?>
			    </div>
			    
				<?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique para selecionar outra <b>miniatura</b> para a publicação")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					<div class="pointer" onClick="flip('pThumbForm');">
						<?php if ($this->_tpl_vars['arquivo']->thumbnail): ?>
							<img id="js-thumbnailM" src="<?php echo $this->_tpl_vars['arquivo']->fileDir(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['arquivo']->thumbnail)) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
">
						<?php else: ?>
							<img id="js-thumbnailM" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iThumb<?php echo $this->_tpl_vars['arquivo']->type; ?>
.png">
						<?php endif; ?>
						<br/>
						<span class="fInfo">trocar miniatura</span>
					</div>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php endif; ?>
			<br/><br/>
			<div id="gUpMoreOptions">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "el-gallery_metadata.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php if ($this->_tpl_vars['arquivo']->type != 'Texto'): ?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=((is_array($_tmp="el-gallery_metadata_")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['arquivo']->type) : smarty_modifier_cat($_tmp, $this->_tpl_vars['arquivo']->type)))) ? $this->_run_mod_handler('cat', true, $_tmp, ".tpl") : smarty_modifier_cat($_tmp, ".tpl")), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endif; ?>
			</div>
		</div>
		
		<?php if ($this->_tpl_vars['tiki_p_read_comments'] == 'y'): ?>
			<?php $this->assign('comments', $this->_tpl_vars['arquivo']->getArraySize('comments')); ?>
			
			<div class="sectionTitle">
				<span class="titleCont titleContRight" onclick="flip('ajax-aCommentsItemsCont');flip('aCommentSend');toggleImage(document.getElementById('comTArrow'),'iArrowGreyRight.png')">
					<img id="comTArrow" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyDown.png">
					<h1>Comentários (<span id="ajax-commentCount"><?php echo $this->_tpl_vars['comments']; ?>
</span>)</h1>
				</span>
			</div>
			<div id="ajax-aCommentsItemsCont" class="itemCont" style="display:block">
				<?php if ($this->_tpl_vars['comments'] > 0): ?>
				<?php $_from = $this->_tpl_vars['arquivo']->comments; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['comment']):
?>
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "el-publication_comment.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				<?php endforeach; endif; unset($_from); ?>
				<?php endif; ?>
			</div>
			<div id="aCommentSend" style="display:block">
				<?php if ($this->_tpl_vars['user'] && ( ( $this->_tpl_vars['tiki_p_forum_post'] == 'y' && $this->_tpl_vars['forum_mode'] == 'y' ) || ( $this->_tpl_vars['tiki_p_post_comments'] == 'y' && $this->_tpl_vars['forum_mode'] != 'y' ) )): ?>
				<div id="uMsgSend">
					<input type="submit" value="enviar" label="enviar" id="uMsgSendSubmit" onClick="xajax_comment(document.getElementById('uMsgSendInput').value);" />
					<?php if (! $this->_tpl_vars['comments']): ?>
						<?php $this->_tag_stack[] = array('tooltip', array('text' => "Seja @ primeir@ a comentar! Digite aqui o seu comentário e clique em <b>enviar</b>")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
							<input type="text" id="uMsgSendInput" name="comment" />
						<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php else: ?>
						<?php $this->_tag_stack[] = array('tooltip', array('text' => "Digite o seu comentário e clique em <b>enviar</b>")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
							<input type="text" id="uMsgSendInput" name="comment" />
						<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php endif; ?>
					<br /><br /><br />
				</div>
				<?php endif; ?>
				<?php if (! $this->_tpl_vars['user']): ?>
					Faça o login para comentar!
				<?php endif; ?>
			</div>
		<?php endif; ?>
		
	</div>
</span>

	<br/><br/><br/><br/>
		
	


			
			<!-- comentarios -->
			
		</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "el-gallery_confirm_delete.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>