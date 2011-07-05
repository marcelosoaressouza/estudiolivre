<?php /* Smarty version 2.6.18, created on 2011-04-25 09:03:24
         compiled from styles/geral/tiki-top_bar.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/geral/tiki-top_bar.tpl', 1, false),array('block', 'tooltip', 'styles/geral/tiki-top_bar.tpl', 9, false),array('modifier', 'replace', 'styles/geral/tiki-top_bar.tpl', 9, false),)), $this); ?>
﻿<?php echo smarty_function_css(array(), $this);?>

<!-- tiki-top_bar.tpl begin -->

<div id="tiki-top">

  	
    <?php if ($this->_tpl_vars['showTeste']): ?>
  	 <a href="http://dev.estudiolivre.org/tiki-view_tracker.php?status=o&trackerId=13&offset=0&sort_mode=created_desc">
  	  <?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique aqui e <b>relate os bugs</b> encontrados! Ajude-nos a <b>melhorar</b> o EstúdioLivre!!!")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/faixaTeste.<?php if ($this->_tpl_vars['isIE']): ?>gif<?php else: ?>png<?php endif; ?>" style="position:absolute; top:-25px; left:0px; z-index:5"/><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  	 </a>
    <?php endif; ?>
  	<div id="logo">
		<a href="/"><?php $this->_tag_stack[] = array('tooltip', array('name' => "navegue-home",'text' => "Página Inicial")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/logoTop.png" alt="estudiolivre.org"><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</a>
	</div>
  
	<script language="JavaScript" src="lib/js/busca.js"></script>
	<div id="search" onLoad="marcaBusca(getCookie('busca'));">
		<form id='form-busca' name="searchForm" class="searchForm" method="get" action="tiki-searchresults.php" onSubmit="busca('<?php echo $this->_tpl_vars['category']; ?>
', this.highlight.value); return false;">
			<input type="hidden" name="where" value="pages">
			<div class="searchOptions">
			<span id="busca-wiki" class=""><?php $this->_tag_stack[] = array('tooltip', array('name' => "buscar-somente",'text' => "Buscar somente nas páginas <b>wiki</b>")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a onclick="marcaBusca('wiki')">wiki</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span> | 
			<span id="busca-gallery" class=""><?php $this->_tag_stack[] = array('tooltip', array('name' => "buscar-acervo",'text' => "Buscar no <b>acervo</b> do EstúdioLivre")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a onclick="marcaBusca('gallery')">acervo</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span> | 
			<span id="busca-usuarios" class=""><?php $this->_tag_stack[] = array('tooltip', array('text' => "Buscar <b>usuári@s</b> do EstúdioLivre")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a onclick="marcaBusca('usuarios')">usuári@</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span> |
			<span id="busca-tags" class=""><?php $this->_tag_stack[] = array('tooltip', array('text' => "Buscar conteúdos com uma <b>tag</b>")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a onclick="marcaBusca('tags')">tag</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span> | 
			<span id="busca-blogs" class=""><?php $this->_tag_stack[] = array('tooltip', array('text' => "Buscar <b>blogs</b> do EstúdioLivre")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a onclick="marcaBusca('blogs')">blog</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span> 
			</div>
			<input id="searchField" name="highlight" size="25" type="text" accesskey="s" value="Buscar" onFocus="if(this.value=='Buscar')this.value=''"/><input class="submit" type="image" name="search" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/bSearch.png"/>
		</form>
	</div>

<script language="JavaScript">marcaBusca(selectedBusca);</script>

	<div id="topMenu" >
		<div id="topMenuGeneral" class="topmenu az">
		<a href="tiki-index.php">wiki&nbsp;</a><br/>
		<a href="tiki-forums.php">fóruns&nbsp;</a><br/>
		<a href="tiki-list_blogs.php">blogs&nbsp;</a><br/>
		<a href="el-tag_cloud.php">tags&nbsp;</a>
		</div>
  
		<div id="topSubMenu" class="vm">
		<a href="tiki-index.php?page=sobre&bl">sobre</a><br/>
		<a href="tiki-index.php?page=faq&bl">faq</a><br/>
		<a href="tiki-index.php?page=contato&bl">contato</a><br/>
		</div>
    
		<div id="topMenuCubesContainer" class="topmenu vr">
		<a href="el-gallery_home.php" <?php if ($this->_tpl_vars['isIE']): ?>title="ACERVO.LIVRE"<?php endif; ?>><span id="acervolivre" >acervo&nbsp;</span></a><br /> 
		<a href="tiki-index.php?page=Áudio&bl" <?php if ($this->_tpl_vars['isIE']): ?>title="AUDIO||LAB"<?php endif; ?>><span id="audiolab">áudio&nbsp;</span></a><br />
		<a href="tiki-index.php?page=Gráfico&bl" <?php if ($this->_tpl_vars['isIE']): ?>title="GRAFI||LAB"<?php endif; ?>><span id="grafilab">gráfico&nbsp;</span></a><br />
		<a href="tiki-index.php?page=Vídeo&bl" <?php if ($this->_tpl_vars['isIE']): ?>title="VIDEO||LAB"<?php endif; ?>><span id="videolab">vídeo&nbsp;</span></a><br />
		</div>
	</div>
	


</div>


<!-- tiki-top_bar.tpl end -->