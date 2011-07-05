<?php /* Smarty version 2.6.18, created on 2011-04-25 09:03:35
         compiled from styles/geral/el-gallery_list_item.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'styles/geral/el-gallery_list_item.tpl', 24, false),array('modifier', 'replace', 'styles/geral/el-gallery_list_item.tpl', 26, false),array('modifier', 'default', 'styles/geral/el-gallery_list_item.tpl', 34, false),array('modifier', 'date_format', 'styles/geral/el-gallery_list_item.tpl', 59, false),array('modifier', 'truncate', 'styles/geral/el-gallery_list_item.tpl', 73, false),array('modifier', 'cat', 'styles/geral/el-gallery_list_item.tpl', 135, false),array('function', 'math', 'styles/geral/el-gallery_list_item.tpl', 34, false),array('block', 'tooltip', 'styles/geral/el-gallery_list_item.tpl', 37, false),array('block', 'tr', 'styles/geral/el-gallery_list_item.tpl', 60, false),)), $this); ?>
﻿
<?php $this->assign('file', $this->_tpl_vars['arquivo']->filereferences[0]); ?>
<?php if ($this->_tpl_vars['arquivo']->type == 'Video'): ?>
	<?php if (preg_match ( "/.*\.ogg$/i" , $this->_tpl_vars['file']->fileName )): ?>
		<?php $this->assign('tooltipText', "Assista a esse vídeo"); ?>
	<?php endif; ?>
<?php elseif ($this->_tpl_vars['arquivo']->type == 'Audio'): ?>
	<?php if (preg_match ( "/.*\.ogg$/i" , $this->_tpl_vars['file']->fileName )): ?>
		<?php $this->assign('tooltipText', "Ouça essa música"); ?>
	<?php endif; ?>
<?php elseif ($this->_tpl_vars['arquivo']->type == 'Imagem'): ?>
	<?php if (! preg_match ( "/.*\.svg$/i" , $this->_tpl_vars['file']->fileName )): ?>
		<?php $this->assign('tooltipText', 'Veja essa imagem'); ?>
	<?php endif; ?>
<?php else: ?>
	<?php $this->assign('tooltipText', 0); ?>
<?php endif; ?>

<div class="listItem pb">
	<div class="listLeft">
		<div class="thumb">
		<a class="listThumb" href="el-gallery_view.php?arquivoId=<?php echo $this->_tpl_vars['arquivo']->id; ?>
">
			<?php if ($this->_tpl_vars['arquivo']->thumbnail): ?>
				<img src="<?php echo $this->_tpl_vars['arquivo']->fileDir(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['arquivo']->thumbnail)) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" <?php if ($this->_tpl_vars['isIE']): ?>width=100 height=100<?php endif; ?>>
			<?php else: ?>
				<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iThumb<?php echo $this->_tpl_vars['arquivo']->type; ?>
.gif">
			<?php endif; ?>
		</a></div>
		<div class="listRB">
		<?php $this->assign('ratings', $this->_tpl_vars['arquivo']->getArraySize('votes')); ?>
		<img onmouseout="nd();" 
			 onmouseover="tooltip('<?php echo $this->_tpl_vars['ratings']; ?>
 voto<?php if (( $this->_tpl_vars['ratings'] > 1 || $this->_tpl_vars['ratings'] < 1 )): ?>s<?php endif; ?><br>Avaliação - entre na página do arquivo para votar')"
			 alt="<?php echo $this->_tpl_vars['arquivo']->rating; ?>
 estrelas"
			 src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/star<?php echo smarty_function_math(array('equation' => "round(x)",'x' => ((is_array($_tmp=@$this->_tpl_vars['arquivo']->rating)) ? $this->_run_mod_handler('default', true, $_tmp, 'blk') : smarty_modifier_default($_tmp, 'blk'))), $this);?>
.png"
			 class="listRating">
	
		<?php $this->_tag_stack[] = array('tooltip', array('name' => "list-baixe-arquivo",'text' => "Copie o arquivo (para o seu computador)")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<a href="el-download.php?pub=<?php echo $this->_tpl_vars['arquivo']->id; ?>
&action=downloadAll">
					baixar
				</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br />
				<?php if ($this->_tpl_vars['tooltipText']): ?>
				<?php $this->_tag_stack[] = array('tooltip', array('name' => "list-i-play",'text' => $this->_tpl_vars['tooltipText'])); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<span class="pointer" alt="" onClick="xajax_streamFile(<?php echo $this->_tpl_vars['arquivo']->id; ?>
,'<?php echo $this->_tpl_vars['arquivo']->type; ?>
', getPageSize()[0]);nd();"><b>
					ver</b>
				</span>
				<br /><br />
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
				<?php if ($this->_tpl_vars['arquivo']->user == $this->_tpl_vars['user'] || $this->_tpl_vars['el_p_admin_gallery'] == 'y'): ?><?php $this->_tag_stack[] = array('tooltip', array('name' => "list-apagar-arquivo-acervo",'text' => 'Apagar esse arquivo do acervo')); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<span class="pointer" onClick="deleteFile(<?php echo $this->_tpl_vars['arquivo']->id; ?>
,<?php echo $this->_tpl_vars['dontAskDelete']; ?>
,0);nd();">
					apagar
				</span><br /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
		
				<p class="mini">
					baixado: <?php echo $this->_tpl_vars['file']->downloads; ?>
 <?php if ($this->_tpl_vars['file']->downloads == 1): ?>vez<?php else: ?>vezes<?php endif; ?><br />
					<?php if ($this->_tpl_vars['tooltipText']): ?>
					visto: <?php echo $this->_tpl_vars['file']->streams; ?>
 <?php if ($this->_tpl_vars['file']->streams == 1): ?>vez<?php else: ?>vezes<?php endif; ?><?php endif; ?><br />
					autor: <?php echo $this->_tpl_vars['arquivo']->author; ?>
<br/>
					enviado por <a href="el-user.php?view_user=<?php echo $this->_tpl_vars['arquivo']->user; ?>
"><?php echo $this->_tpl_vars['arquivo']->user; ?>
</a><br />					
					<?php echo ((is_array($_tmp=$this->_tpl_vars['arquivo']->publishDate)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%y") : smarty_modifier_date_format($_tmp, "%d/%m/%y")); ?>
<br/>
					tipo: <?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['arquivo']->type; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				</p>
		</div>
	</div>
	<div class="listRight">
	<h2 class="title">
		<a href="el-gallery_view.php?arquivoId=<?php echo $this->_tpl_vars['arquivo']->id; ?>
">
			<?php echo $this->_tpl_vars['arquivo']->title; ?>

		</a>
	</h2>
	
	<span>
			<?php if (strlen ( $this->_tpl_vars['arquivo']->description ) > 80): ?>
				<?php echo ((is_array($_tmp=$this->_tpl_vars['arquivo']->description)) ? $this->_run_mod_handler('truncate', true, $_tmp, 80, "", true) : smarty_modifier_truncate($_tmp, 80, "", true)); ?>

				<a href="el-gallery_view.php?arquivoId=<?php echo $this->_tpl_vars['arquivo']->id; ?>
">
					(...)
				</a>
			<?php elseif ($this->_tpl_vars['arquivo']->description): ?>
				<?php echo $this->_tpl_vars['arquivo']->description; ?>

			<?php else: ?>
				Arquivo sem descrição!
			<?php endif; ?>
		</span>
	<div class="listInfo">
	
		<h4>
			
		</h4>
		
		
		
		<h4>
			<div class="asRow">
				
				<span class="mid">
					comentários:
					<?php $this->assign('commentsCount', $this->_tpl_vars['arquivo']->getArraySize('comments')); ?>
						<em>
							<?php if ($this->_tpl_vars['commentsCount'] == 0): ?>
								<?php $this->_tag_stack[] = array('tooltip', array('name' => "list-primeiro-comentar",'text' => 'Seja o primeiro a comentar sobre esse arquivo')); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
								<a href="el-gallery_view.php?arquivoId=<?php echo $this->_tpl_vars['arquivo']->id; ?>
#comments">
								0
								</a>
								<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
							<?php else: ?>
								<?php $this->_tag_stack[] = array('tooltip', array('name' => "list-ler-comentarios",'text' => "Clique para ler os comentários")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
									<a href="el-gallery_view.php?arquivoId=<?php echo $this->_tpl_vars['arquivo']->id; ?>
#comments">
										<?php echo $this->_tpl_vars['commentsCount']; ?>

									</a>
								<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
							<?php endif; ?>
						</em>
				</span>
<br/>				
				<span class="rig">
					licença:
						<?php $this->_tag_stack[] = array('tooltip', array('name' => "list-descricao-licenca",'text' => $this->_tpl_vars['arquivo']->license->description)); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
							<a href="<?php echo $this->_tpl_vars['arquivo']->license->humanReadableLink; ?>
">
								<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/h_<?php echo $this->_tpl_vars['arquivo']->license->imageName; ?>
">
							</a>
						<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				</span>
			</div>
	
	
	</div>
	
	
	
		</h4>
		
		<h4>
			<span>
				tags:
				<em>
					<?php $_from = $this->_tpl_vars['arquivo']->tags; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tags'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tags']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['t']):
        $this->_foreach['tags']['iteration']++;
?><?php $this->_tag_stack[] = array('tooltip', array('text' => ((is_array($_tmp=((is_array($_tmp="Clique para ver outros arquivos com a tag <b>")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['t']['tag']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['t']['tag'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "</b>") : smarty_modifier_cat($_tmp, "</b>")))); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="tiki-browse_freetags.php?tag=<?php echo $this->_tpl_vars['t']['tag']; ?>
"><?php echo $this->_tpl_vars['t']['tag']; ?>
</a><?php if (! ($this->_foreach['tags']['iteration'] == $this->_foreach['tags']['total'])): ?>, <?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endforeach; else: ?>
						Esse arquivo não tem tags.
					<?php endif; unset($_from); ?>
				</em>
			</span>
		</h4>
	</div>
</div>