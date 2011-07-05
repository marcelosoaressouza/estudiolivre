<?php /* Smarty version 2.6.18, created on 2011-04-05 19:36:52
         compiled from el-gallery_list_filters.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'el-gallery_list_filters.tpl', 1, false),array('block', 'tooltip', 'el-gallery_list_filters.tpl', 8, false),array('modifier', 'replace', 'el-gallery_list_filters.tpl', 9, false),)), $this); ?>
<?php echo smarty_function_css(array('extra' => "el-gallery_pagination"), $this);?>

<!-- List Options Begin -->
<table id="listOptions">
<tr>
<!-- Filters Begin -->
	<td class="left">
		
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Alternar visualização de áudios")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<img id="Audio" name="filterButton" class="pointer" alt="audio" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iAudioFilter<?php if (! in_array ( 'Audio' , $this->_tpl_vars['tipos'] )): ?>Off<?php endif; ?>.png" onClick="toggleFilter(this)"/>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Alternar visualização de vídeos")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<img id="Video" name="filterButton" class="pointer" alt="video" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iVideoFilter<?php if (! in_array ( 'Video' , $this->_tpl_vars['tipos'] )): ?>Off<?php endif; ?>.png" onClick="toggleFilter(this)"/>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Alternar visualização de imagens")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<img id="Imagem" name="filterButton" class="pointer" alt="imagem" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iImagemFilter<?php if (! in_array ( 'Imagem' , $this->_tpl_vars['tipos'] )): ?>Off<?php endif; ?>.png" onClick="toggleFilter(this)"/>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Alternar visualização de textos")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<img id="Texto" name="filterButton" class="pointer" alt="texto" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iTextoFilter<?php if (! in_array ( 'Texto' , $this->_tpl_vars['tipos'] )): ?>Off<?php endif; ?>.png" onClick="toggleFilter(this)"/>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Alternar visualização de outros")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<img id="Outro" name="filterButton" class="pointer" alt="outro" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iOutroFilter<?php if (! in_array ( 'Outro' , $this->_tpl_vars['tipos'] )): ?>Off<?php endif; ?>.png" onClick="toggleFilter(this)"/>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Alternar visualização entre todos/nenhum item")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<img id="Tudo" class="pointer" alt="tudo" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iTudoFilter<?php if (count ( $this->_tpl_vars['tipos'] ) < 4): ?>Off<?php endif; ?>.png" onClick="toggleAll()"/>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	
	</td>
<!-- Filters End -->

	<td><div id="ajax-listNav" class="listNav"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "el-gallery_pagination.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div></td>
  
    <td id="listOrder" class="right">
      <?php $this->_tag_stack[] = array('tooltip', array('name' => "home-crescente-decrescente",'text' => "Define ordenação crescente ou decrescente")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img alt="" onClick="toggleSortArrow(this,'<?php if ($this->_tpl_vars['sortDirection'] == 'Up'): ?>sortArrowDown.png<?php else: ?>sortArrowUp.png<?php endif; ?>')" 
      	   src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sortArrow<?php echo $this->_tpl_vars['sortDirection']; ?>
.png" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php $this->_tag_stack[] = array('tooltip', array('name' => "home-criterio-ordenacao",'text' => "Modifica critério da ordenação")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	      <select style="decoration:none" onChange="setSortMode(this)">
	        <option value="publishDate" <?php if ($this->_tpl_vars['sortMode'] == 'publishDate'): ?>selected<?php endif; ?>>日付</option>
			<option value="rating" <?php if ($this->_tpl_vars['sortMode'] == 'rating'): ?>selected<?php endif; ?>>Estrelas</option>
			<option value="downloads" <?php if ($this->_tpl_vars['sortMode'] == 'downloads'): ?>selected<?php endif; ?>>ダウンロード数</option>
			<option value="title" <?php if ($this->_tpl_vars['sortMode'] == 'title'): ?>selected<?php endif; ?>>Título</option>
			<option value="streams" <?php if ($this->_tpl_vars['sortMode'] == 'streams'): ?>selected<?php endif; ?>>Visualizações</option>
	      </select>
      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </td>
    
</tr>
</table>

<!-- List Options End -->