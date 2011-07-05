<?php /* Smarty version 2.6.18, created on 2011-06-15 14:30:14
         compiled from el-gallery_list_item.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'el-gallery_list_item.tpl', 5, false),array('modifier', 'replace', 'el-gallery_list_item.tpl', 7, false),array('modifier', 'default', 'el-gallery_list_item.tpl', 14, false),array('modifier', 'date_format', 'el-gallery_list_item.tpl', 53, false),array('modifier', 'truncate', 'el-gallery_list_item.tpl', 63, false),array('modifier', 'cat', 'el-gallery_list_item.tpl', 117, false),array('function', 'math', 'el-gallery_list_item.tpl', 14, false),array('block', 'tooltip', 'el-gallery_list_item.tpl', 17, false),array('block', 'tr', 'el-gallery_list_item.tpl', 56, false),)), $this); ?>
<div class="listItem">
	<div class="listLeft">
		<a href="el-gallery_view.php?arquivoId=<?php echo $this->_tpl_vars['arquivo']->id; ?>
">
			<?php if ($this->_tpl_vars['arquivo']->thumbnail): ?>
				<img src="<?php echo $this->_tpl_vars['arquivo']->fileDir(); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['arquivo']->thumbnail)) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" <?php if ($this->_tpl_vars['isIE']): ?>width=100 height=100<?php endif; ?>>
			<?php else: ?>
				<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iThumb<?php echo $this->_tpl_vars['arquivo']->type; ?>
.png">
			<?php endif; ?>
		</a>
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
		<br />
		<?php $this->_tag_stack[] = array('tooltip', array('name' => "list-baixe-arquivo",'text' => "Copie todos os arquivos (para o seu computador)")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<a href="el-download.php?pub=<?php echo $this->_tpl_vars['arquivo']->id; ?>
&action=downloadAll">
				baixar
			</a>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>	
		<?php if ($this->_tpl_vars['tooltipText']): ?>
		<br />
			<a href="el-gallery_view.php?arquivoId=<?php echo $this->_tpl_vars['arquivo']->id; ?>
">
				versjon
			</a>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['arquivo']->user == $this->_tpl_vars['user'] || $this->_tpl_vars['el_p_admin_gallery'] == 'y'): ?>
			<br />
			<?php $this->_tag_stack[] = array('tooltip', array('name' => "list-apagar-arquivo-acervo",'text' => 'Apagar esse arquivo do acervo')); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<span class="pointer" onClick="deleteFile(<?php echo $this->_tpl_vars['arquivo']->id; ?>
,<?php echo $this->_tpl_vars['dontAskDelete']; ?>
,0);nd();">apagar</span>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php endif; ?>
	</div>
	
	<h2>
		<a href="el-gallery_view.php?arquivoId=<?php echo $this->_tpl_vars['arquivo']->id; ?>
">
			<?php echo $this->_tpl_vars['arquivo']->title; ?>

		</a>
	</h2>
	
	
	<div class="listInfo">
	
		<h4>
			<div class="asRow">
				<span class="lef">
					autor: <em><?php echo $this->_tpl_vars['arquivo']->author; ?>
</em>
				</span>
				<span class="mid">
					enviado por: <em><a href="el-user.php?view_user=<?php echo $this->_tpl_vars['arquivo']->user; ?>
"><?php echo $this->_tpl_vars['arquivo']->user; ?>
</a></em>
					<br />
					em: <em><?php echo ((is_array($_tmp=$this->_tpl_vars['arquivo']->publishDate)) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%y") : smarty_modifier_date_format($_tmp, "%d/%m/%y")); ?>
</em>
				</span>
				<span class="rig">
					tipo: <em><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['arquivo']->type; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></em>
				</span>
			</div>
		</h4>
		
		<h3>
			<?php if (strlen ( $this->_tpl_vars['arquivo']->description ) > 150): ?>
				<?php echo ((is_array($_tmp=$this->_tpl_vars['arquivo']->description)) ? $this->_run_mod_handler('truncate', true, $_tmp, 150, "", true) : smarty_modifier_truncate($_tmp, 150, "", true)); ?>

				<a href="el-gallery_view.php?arquivoId=<?php echo $this->_tpl_vars['arquivo']->id; ?>
">
					(ler mais...)
				</a>
			<?php elseif ($this->_tpl_vars['arquivo']->description): ?>
				<?php echo $this->_tpl_vars['arquivo']->description; ?>

			<?php else: ?>
				Arquivo sem descrição!
			<?php endif; ?>
		</h3>
		
		<h4>
			<div class="asRow">
				<span class="lef">
					baixado: <em><?php echo $this->_tpl_vars['file']->downloads; ?>
 <?php if ($this->_tpl_vars['file']->downloads == 1): ?>vez<?php else: ?>vezes<?php endif; ?></em>
					<?php if ($this->_tpl_vars['tooltipText']): ?>
						<br />
						visto: <em><?php echo $this->_tpl_vars['file']->streams; ?>
 <?php if ($this->_tpl_vars['file']->streams == 1): ?>vez<?php else: ?>vezes<?php endif; ?></em>
					<?php endif; ?>
				</span>
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