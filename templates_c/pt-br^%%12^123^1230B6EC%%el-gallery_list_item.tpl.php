<?php /* Smarty version 2.6.18, created on 2011-06-23 10:53:47
         compiled from styles/obscur/el-gallery_list_item.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'styles/obscur/el-gallery_list_item.tpl', 3, false),array('modifier', 'date_format', 'styles/obscur/el-gallery_list_item.tpl', 5, false),array('modifier', 'default', 'styles/obscur/el-gallery_list_item.tpl', 9, false),array('modifier', 'cat', 'styles/obscur/el-gallery_list_item.tpl', 63, false),array('block', 'tooltip', 'styles/obscur/el-gallery_list_item.tpl', 9, false),array('function', 'math', 'styles/obscur/el-gallery_list_item.tpl', 9, false),)), $this); ?>
<div id="gListItem">
	<div class="title">
		<a href="el-gallery_view.php?arquivoId=<?php echo $this->_tpl_vars['arquivo']['arquivoId']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['arquivo']['titulo'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 15, "(...)") : smarty_modifier_truncate($_tmp, 15, "(...)")); ?>
</a>
		<h3>
		<a href="el-user.php?view_user=<?php echo $this->_tpl_vars['arquivo']['user']; ?>
"><?php echo $this->_tpl_vars['arquivo']['user']; ?>
</a> - <?php echo ((is_array($_tmp=$this->_tpl_vars['arquivo']['data_publicacao'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>

		</h3>
	</div>
	<h5>
    	<?php $this->_tag_stack[] = array('tooltip', array('name' => "list-avaliacao-votar",'text' => "Avaliação - entre na página do arquivo para votar")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img alt="<?php echo $this->_tpl_vars['arquivo']['rating']; ?>
 estrelas" src="styles/estudiolivre/star<?php echo smarty_function_math(array('equation' => "round(x)",'x' => ((is_array($_tmp=@$this->_tpl_vars['arquivo']['rating'])) ? $this->_run_mod_handler('default', true, $_tmp, 'blk') : smarty_modifier_default($_tmp, 'blk'))), $this);?>
.png"><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </h5>
	<h2>
	    	<?php $this->_tag_stack[] = array('tooltip', array('name' => "list-descricao-licenca",'text' => $this->_tpl_vars['arquivo']['descricaoLicenca'])); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	    		<a href="<?php echo $this->_tpl_vars['arquivo']['linkHumanReadable']; ?>
">
	    			<img src="styles/estudiolivre/<?php echo $this->_tpl_vars['arquivo']['linkImagem']; ?>
">
				</a>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		    <a href="el-gallery_view.php?arquivoId=<?php echo $this->_tpl_vars['arquivo']['arquivoId']; ?>
">
				<?php if ($this->_tpl_vars['arquivo']['thumbnail']): ?>
					<img height="51" src="<?php echo $this->_tpl_vars['arquivo']->fileDir(); ?>
<?php echo $this->_tpl_vars['arquivo']['thumbnail']; ?>
">
				<?php else: ?>
					<img height="51" src="styles/obscur/iThumb<?php echo $this->_tpl_vars['arquivo']['tipo']; ?>
.png">
				<?php endif; ?>
			</a>
  	</h2>
    <h6>
	    <?php if ($this->_tpl_vars['arquivo']['commentsCount'] == 0): ?>
	    	<?php $this->_tag_stack[] = array('tooltip', array('name' => "list-primeiro-comentar",'text' => 'Seja o primeiro a comentar sobre esse arquivo')); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="el-gallery_view.php?arquivoId=<?php echo $this->_tpl_vars['arquivo']['arquivoId']; ?>
#comments">0 comentários</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	    <?php else: ?>
	    	<?php $this->_tag_stack[] = array('tooltip', array('name' => "list-ler-comentarios",'text' => "Clique para ler os comentários")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="el-gallery_view.php?arquivoId=<?php echo $this->_tpl_vars['arquivo']['arquivoId']; ?>
#comments"><?php echo $this->_tpl_vars['arquivo']['commentsCount']; ?>
 comentário<?php if ($this->_tpl_vars['arquivo']['commentsCount'] != 1): ?>s<?php endif; ?></a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	    <?php endif; ?>
	    <br/>
	    <?php $this->_tag_stack[] = array('tooltip', array('name' => "list-baixe-arquivo",'text' => "Copie todos os arquivos (para o seu computador)")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		  <?php echo $this->_tpl_vars['arquivo']['hits']; ?>

	      <a href="el-download.php?pub=<?php echo $this->_tpl_vars['arquivo']['arquivoId']; ?>
&action=downloadAll">
	        downloads
	      </a>
	    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	  	<?php if ($this->_tpl_vars['arquivo']['tipo'] == 'Video'): ?>
	  		<?php if (preg_match ( "/.*\.ogg$/" , $this->_tpl_vars['arquivo']['arquivo'] )): ?>
		    	<?php $this->assign('tooltipText', "Assista a esse vídeo"); ?>
		    <?php endif; ?>
	    <?php elseif ($this->_tpl_vars['arquivo']['tipo'] == 'Audio'): ?>
	    	<?php if (preg_match ( "/.*\.ogg$/" , $this->_tpl_vars['arquivo']['arquivo'] )): ?>
		    	<?php $this->assign('tooltipText', "Ouça essa música"); ?>
		    <?php endif; ?>
	    <?php elseif ($this->_tpl_vars['arquivo']['tipo'] == 'Imagem'): ?>
	    	<?php $this->assign('tooltipText', 'Veja essa imagem'); ?>
	    <?php endif; ?>
	    	<br/>
	    <?php if ($this->_tpl_vars['tooltipText']): ?>
	    	<?php echo $this->_tpl_vars['arquivo']['streamHits']; ?>

	    	<?php $this->_tag_stack[] = array('tooltip', array('name' => "list-i-play",'text' => $this->_tpl_vars['tooltipText'])); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		    	<a onClick="xajax_streamFile(<?php echo $this->_tpl_vars['arquivo']['arquivoId']; ?>
, '<?php echo $this->_tpl_vars['arquivo']['tipo']; ?>
', getPageSize()[0])">streams</a>
		    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php else: ?>
			<br/>
	    <?php endif; ?>
	    
    </h6>	
    <div id="gTags">
    <?php $_from = $this->_tpl_vars['arquivo']['tags']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['tags'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['tags']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['t']):
        $this->_foreach['tags']['iteration']++;
?>
    	<?php if ($this->_foreach['tags']['iteration'] <= 4): ?>
	    	<?php $this->_tag_stack[] = array('tooltip', array('text' => ((is_array($_tmp=((is_array($_tmp="Clique para ver outros arquivos com a tag <b>")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['t']['tag']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['t']['tag'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "</b>") : smarty_modifier_cat($_tmp, "</b>")))); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="tiki-browse_freetags.php?tag=<?php echo $this->_tpl_vars['t']['tag']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['t']['tag'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, "(...)") : smarty_modifier_truncate($_tmp, 10, "(...)")); ?>
</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php if ($this->_foreach['tags']['iteration'] < 4 && ! ($this->_foreach['tags']['iteration'] == $this->_foreach['tags']['total'])): ?>,<?php elseif ($this->_foreach['tags']['total'] > 4): ?> (<?php echo $this->_foreach['tags']['total']; ?>
 tags)<?php endif; ?>
	    <?php endif; ?>
    <?php endforeach; else: ?>
      <?php $this->_tag_stack[] = array('tooltip', array('text' => "Esse arquivo não tem tags")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><div width="100%">&nbsp;</div><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php endif; unset($_from); ?>
   </div>
</div>