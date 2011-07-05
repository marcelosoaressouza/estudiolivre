<?php /* Smarty version 2.6.18, created on 2011-04-06 07:02:04
         compiled from styles/bolha/tiki-top_bar.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-top_bar.tpl', 1, false),array('block', 'tooltip', 'styles/bolha/tiki-top_bar.tpl', 9, false),array('modifier', 'replace', 'styles/bolha/tiki-top_bar.tpl', 9, false),)), $this); ?>
<?php echo smarty_function_css(array(), $this);?>

<!-- tiki-top_bar.tpl begin -->

<div id="tiki-top">
  <div id="topContainer">
  	
    <?php if ($this->_tpl_vars['showTeste']): ?>
  	 <a href="http://dev.estudiolivre.org/tiki-view_tracker.php?status=o&trackerId=13&offset=0&sort_mode=created_desc">
  	  <?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique aqui e <b>relate os bugs</b> encontrados! Ajude-nos a <b>melhorar</b> o EstúdioLivre!!!")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/faixaTeste.<?php if ($this->_tpl_vars['isIE']): ?>gif<?php else: ?>png<?php endif; ?>" style="position:absolute; top:-25px; left:0px; z-index:5"/><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  	 </a>
    <?php endif; ?>
  	<div id="logo">
      <a href="/">
        <?php $this->_tag_stack[] = array('tooltip', array('name' => "navegue-home",'text' => "Ir para a Página Inicial")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
          <img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/logoTop.png" alt="estudiolivre.org">
        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </a>
      
    </div>
  
    <script language="JavaScript" src="lib/js/busca.js"></script>

  <div id="search" onLoad="marcaBusca(getCookie('busca'));">
    <form id='form-busca' name="searchForm" class="searchForm" method="get" action="tiki-searchresults.php" onSubmit="busca('<?php echo $this->_tpl_vars['category']; ?>
', this.highlight.value); return false;">
      <input type="hidden" name="where" value="pages">
      <ul class="searchOptions">
        <li id="busca-wiki" class=""><?php $this->_tag_stack[] = array('tooltip', array('name' => "buscar-somente",'text' => "Buscar somente nas páginas <b>wiki</b>")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a onclick="marcaBusca('wiki')">Wiki</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
        <li id="busca-gallery" class=""><?php $this->_tag_stack[] = array('tooltip', array('name' => "buscar-acervo",'text' => "Buscar no <b>acervo</b> do EstúdioLivre")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a onclick="marcaBusca('gallery')">acervo</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
        <li id="busca-usuarios" class=""><?php $this->_tag_stack[] = array('tooltip', array('text' => "Buscar <b>usuári@s</b> do EstúdioLivre")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a onclick="marcaBusca('usuarios')">Benutzer</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
		<li id="busca-tags" class=""><?php $this->_tag_stack[] = array('tooltip', array('text' => "Buscar conteúdos com uma <b>tag</b>")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a onclick="marcaBusca('tags')">tag</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
		<li id="busca-blogs" class=""><?php $this->_tag_stack[] = array('tooltip', array('text' => "Buscar <b>blogs</b> do EstúdioLivre")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a onclick="marcaBusca('blogs')">Blog</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
      </ul>
      <input id="searchField" name="highlight" size="15" type="text" accesskey="s" value="Buscar" onFocus="if(this.value=='Buscar')this.value=''"/><input class="submit" type="image" name="search" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/bSearch.png"/>
    </form>
  </div>
</div>
<script language="JavaScript">marcaBusca(selectedBusca);</script>

<div id="topMenu">
  <div id="topMenuGeneral">
  &nbsp;&nbsp;
    <?php $this->_tag_stack[] = array('tooltip', array('name' => "saiba-estudiolivre",'text' => "Saiba <b>o que é</b> o EstúdioLivre")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="tiki-index.php?page=sobre&bl">sobre</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	|
	<?php $this->_tag_stack[] = array('tooltip', array('name' => "perguntas-frequentes",'text' => "<b>Perguntas</b> mais freqüêntes")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="tiki-index.php?page=faq&bl">FAQ</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	|
	<?php $this->_tag_stack[] = array('tooltip', array('name' => "entre-contato",'text' => "Entre em contato - descubra os <b>canais de comunicação</b> com a comunidade")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="tiki-index.php?page=contato&bl">contato</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
&nbsp;&nbsp;||&nbsp;&nbsp;
	<?php $this->_tag_stack[] = array('tooltip', array('name' => 'wiki','text' => "Página principal do <b>wiki</b> do EstúdioLivre")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="tiki-index.php">Wiki</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	|
    <?php $this->_tag_stack[] = array('tooltip', array('name' => "forum-discussoes",'text' => "Fóruns de <b>discussões</b> - tire suas dúvidas aqui")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="tiki-forums.php">Foren</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    | 
    <?php $this->_tag_stack[] = array('tooltip', array('text' => "Veja os <b>blogs</b> dos usuári@s do EstúdioLivre")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="tiki-list_blogs.php">Blogs</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    | 
    <?php $this->_tag_stack[] = array('tooltip', array('text' => "Navegue pelas <b>tags</b> mais populares do EstúdioLivre")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="el-tag_cloud.php">tags</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  </div>
    
	<div id="topMenuCubesContainer">
	
		
		<?php $this->assign('gallery', 'Green'); ?>
		<?php $this->assign('audio', 'Orange'); ?>
		<?php $this->assign('video', 'Red'); ?>
		<?php $this->assign('grafico', 'Purple'); ?>
		
		<?php if ($this->_tpl_vars['category'] == "Áudio"): ?><?php $this->assign('audioStyle', "opacity:0.3"); ?><?php endif; ?>
        <a style="<?php echo $this->_tpl_vars['audioStyle']; ?>
" href="tiki-index.php?page=Áudio&bl" <?php if ($this->_tpl_vars['isIE']): ?>title="AUDIO||LAB"<?php endif; ?>>
          <img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/cube<?php echo $this->_tpl_vars['audio']; ?>
.png">
	      <span id="audiolab">áudio</span>
        </a>
	        
	    <?php if ($this->_tpl_vars['category'] == "Gráfico"): ?><?php $this->assign('graficoStyle', "opacity:0.3"); ?><?php endif; ?>
        <a style="<?php echo $this->_tpl_vars['graficoStyle']; ?>
"  href="tiki-index.php?page=Gráfico&bl" <?php if ($this->_tpl_vars['isIE']): ?>title="GRAFI||LAB"<?php endif; ?>>
          <img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/cube<?php echo $this->_tpl_vars['grafico']; ?>
.png">
		  <span id="grafilab">gráfico</span>
        </a>

	    <?php if ($this->_tpl_vars['category'] == "Vídeo"): ?><?php $this->assign('videoStyle', "opacity:0.3"); ?><?php endif; ?>
        <a style="<?php echo $this->_tpl_vars['videoStyle']; ?>
"  href="tiki-index.php?page=Vídeo&bl" <?php if ($this->_tpl_vars['isIE']): ?>title="VIDEO||LAB"<?php endif; ?>>
          <img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/cube<?php echo $this->_tpl_vars['video']; ?>
.png">
	      <span id="videolab">vídeo</span>
        </a>
	    
	    <?php if ($this->_tpl_vars['category'] == 'gallery'): ?><?php $this->assign('galleryStyle', "opacity:0.3"); ?><?php endif; ?>
        <a style="<?php echo $this->_tpl_vars['galleryStyle']; ?>
" href="el-gallery_home.php" <?php if ($this->_tpl_vars['isIE']): ?>title="ACERVO.LIVRE"<?php endif; ?>>
	        <img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/cube<?php echo $this->_tpl_vars['gallery']; ?>
.png">
	        <span id="acervolivre">acervo</span>      
        </a> 
        
	</div>
</div>

</div>

<?php if ($this->_tpl_vars['isIE']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "ie_notsupported.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<!-- tiki-top_bar.tpl end -->