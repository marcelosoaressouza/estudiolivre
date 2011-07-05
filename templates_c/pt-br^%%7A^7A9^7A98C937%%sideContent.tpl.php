<?php /* Smarty version 2.6.18, created on 2011-05-02 18:35:42
         compiled from styles/obscur/sideContent.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tooltip', 'styles/obscur/sideContent.tpl', 168, false),array('modifier', 'replace', 'styles/obscur/sideContent.tpl', 174, false),)), $this); ?>
<div id="sideContent">

<div class="userMenu catMenu">
	<h1 id="cat<?php echo $this->_tpl_vars['category']; ?>
">

		<?php if ($this->_tpl_vars['category'] != "Áudio"): ?><?php $this->assign('audioStyle', 'unsel'); ?><?php endif; ?>
        <a class="<?php echo $this->_tpl_vars['audioStyle']; ?>
" href="tiki-index.php?page=Áudio&bl" <?php if ($this->_tpl_vars['isIE']): ?>title="AUDIO||LAB"<?php endif; ?>>
	      áudio
        </a>
	        
	    <?php if ($this->_tpl_vars['category'] != "Gráfico"): ?><?php $this->assign('graficoStyle', 'unsel'); ?><?php endif; ?>
        <a class="<?php echo $this->_tpl_vars['graficoStyle']; ?>
"  href="tiki-index.php?page=Gráfico&bl" <?php if ($this->_tpl_vars['isIE']): ?>title="GRAFI||LAB"<?php endif; ?>>
		  <span>gráfico</span>
        </a>

	    <?php if ($this->_tpl_vars['category'] != "Vídeo"): ?><?php $this->assign('videoStyle', 'unsel'); ?><?php endif; ?>
        <a class="<?php echo $this->_tpl_vars['videoStyle']; ?>
"  href="tiki-index.php?page=Vídeo&bl" <?php if ($this->_tpl_vars['isIE']): ?>title="VIDEO||LAB"<?php endif; ?>>
	      <span>vídeo</span>
        </a>
	    
	    <?php if ($this->_tpl_vars['category'] != 'gallery'): ?><?php $this->assign('galleryStyle', 'unsel'); ?><?php endif; ?>
        <a class="<?php echo $this->_tpl_vars['galleryStyle']; ?>
" href="el-gallery_home.php" <?php if ($this->_tpl_vars['isIE']): ?>title="ACERVO.LIVRE"<?php endif; ?>>
	        <span>acervo</span>      
        </a> 
        
	</h1>
  <?php if ($this->_tpl_vars['category'] == "Áudio"): ?>
  
	<div id="localMenu">
	<ul>
    <?php if ($this->_tpl_vars['page'] == "Softwares de Edição de Áudio"): ?>
       <li class="selectedAudio">softwares</li>
    <?php else: ?>
       <li><a href="tiki-index.php?page=Softwares de Áudio">softwares</li>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['page'] == 'equipamentos audio'): ?>
       <li class="selectedAudio">equipamentos</li>
    <?php else: ?>
       <li><a href="tiki-index.php?page=equipamentos audio&bl">equipamentos</a></li>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['page'] == 'Produzindo Audio'): ?>
       <li class="selectedAudio">produzindo</li>
    <?php else: ?>
       <li><a href="tiki-index.php?page=Produzindo+Audio&bl">produzindo</a></li>
    <?php endif; ?>
    
    <?php if ($this->_tpl_vars['page'] == "Links de Áudio"): ?>
       <li class="selectedAudio">links</li>
    <?php else: ?>
        <li><a href="tiki-index.php?page=Links+de+%C3%81udio&bl">links</a></li>
    <?php endif; ?>
	</ul>
	</div>
  <?php elseif ($this->_tpl_vars['category'] == "Gráfico"): ?>
  
	<div id="localMenu">
	<ul>
    <?php if ($this->_tpl_vars['page'] == "Softwares de Gráfico"): ?>
       <li class="selectedGraf">softwares</li>
    <?php else: ?>
       <li><a href="tiki-index.php?page=Softwares de Gráfico&bl">softwares</a></li>
    <?php endif; ?>
    
    <?php if ($this->_tpl_vars['page'] == 'equipamentos grafico'): ?>
       <li class="selectedGraf">equipamentos</li>
    <?php else: ?>
       <li><a href="tiki-index.php?page=equipamentos grafico&bl">equipamentos</a></li>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['page'] == "Produzindo Gráfico"): ?>
       <li class="selectedGraf">produzindo</li>
    <?php else: ?>
       <li><a href="tiki-index.php?page=Produzindo+Gráfico&bl">produzindo</a></li>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['page'] == "Links de Gráfico"): ?>
       <li class="selectedGraf">links</li>
    <?php else: ?>
       <li><a href="tiki-index.php?page=Links de Gráfico&bl">links</a></li>
    <?php endif; ?>
	</ul>
	</div>
  <?php elseif ($this->_tpl_vars['category'] == "Vídeo"): ?>
  
	<div id="localMenu">
	<ul>
    <?php if ($this->_tpl_vars['page'] == "Softwares de Vídeo"): ?>
       <li class="selectedVideo">softwares</li>
    <?php else: ?>
       <li><a href="tiki-index.php?page=Softwares de Vídeo&bl">softwares</a></li>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['page'] == 'equipamentos video'): ?>
       <li class="selectedVideo">equipamentos</li>
    <?php else: ?>
       <li><a href="tiki-index.php?page=equipamentos video&bl">equipamentos</a></li>
    <?php endif; ?>
    
    <?php if ($this->_tpl_vars['page'] == "Produzindo Vídeo"): ?>
       <li class="selectedVideo">produzindo</li>
    <?php else: ?>
       <li><a href="tiki-index.php?page=Produzindo+Vídeo&bl">produzindo</a></li>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['page'] == "Links de Vídeo"): ?>
       <li class="selectedVideo">links</li>
    <?php else: ?>
       <li><a href="tiki-index.php?page=Links de Vídeo&bl">links</a></li>
    <?php endif; ?>
	</ul>
	</div>
  <?php elseif ($this->_tpl_vars['category'] == 'gallery'): ?>
  
	<div id="localMenu">
	<ul>
    <?php if ($this->_tpl_vars['current_location'] == "el-gallery_upload.php"): ?>      
      	<li class="selectedAcervo">compartilhe sua obra</li>
    <?php else: ?>
    	<?php if ($this->_tpl_vars['user']): ?>
        	<li><a href="el-gallery_upload.php">compartilhe sua obra</a></li>
        <?php else: ?>
      		<div id="precisaLogar" style="display:none;width:200px;padding:5px">
      			Para compartilhar a sua obra no <b>Acervo Livre</b> é necessário se <a href="tiki-register.php">cadastrar</a> no site.<br><br>
      			Se for cadastrado, efetue o login:<br>

					    <form id="uLoginBox" action="tiki-login.php" method="post">
					      <input type="hidden" name="redirect" value="el-gallery_upload.php">
					      <input class="uText" type="text" name="user" id="login-user" size="12" value="usuári@" onFocus="this.value=''"/>
					      <input class="uText" type="text" name="pass" id="login-pass" size="10" value="senha" onFocus="this.value='';this.type='password'"/>
					      <input type="image" name="login" src="styles/estudiolivre/iLogin.png" />      
					      <div id="uLoginOptions">
					        <a href="tiki-remind_password.php">&raquo; recuperar senha</a><br>
					      </div>
					   </form>

			  <br><br>
				Se preferir, <a href="tiki-index.php?page=faq Acervo&bl">leia mais</a> sobre o <b>Acervo Livre</b>.
      		</div>
      		<li onclick="showLightbox('precisaLogar')" style="cursor:pointer"><a>compartilhe sua obra</a></li>
        <?php endif; ?>   
    <?php endif; ?>
    
     <li><a href="tiki-index.php?page=faq">sobre o acervo</a></li>
	</ul>
	</div>
  <?php endif; ?>
</div>

<div class="userMenu">
	<h1>
		<?php if ($_COOKIE['obsBusca'] == 'none'): ?>
				<?php $this->assign('display', 'none'); ?>
				<?php $this->assign('imgCurrent', 'Left'); ?>
				<?php $this->assign('imgChange', 'Down'); ?>	
		<?php endif; ?>
		<span class="pointer" onclick="javascript:flip('moduleobsBusca');toggleImage(document.getElementById('TArrowobsBusca'),'iArrowGrey<?php echo $this->_tpl_vars['imgChange']; ?>
.png');storeState('obsBusca');">
	        Buscar<img id="TArrowobsBusca"  src="styles/estudiolivre/iArrowGrey<?php echo $this->_tpl_vars['imgCurrent']; ?>
.png">
		</span>
	</h1>
	<div id="moduleobsBusca" style="display:<?php echo $this->_tpl_vars['display']; ?>
">
		  <script language="JavaScript" src="lib/js/busca.js"></script>
		  <div id="search" onLoad="marcaBusca(getCookie('busca'));">
		    <form id='form-busca' name="searchForm" class="searchForm" method="get" action="tiki-searchresults.php" onSubmit="busca('<?php echo $this->_tpl_vars['category']; ?>
', this.highlight.value); return false;">
		      <input type="hidden" name="where" value="pages">
		      <ul class="searchOptions">
		        <li id="busca-wiki" class=""><?php $this->_tag_stack[] = array('tooltip', array('name' => "buscar-somente",'text' => "Buscar somente nas páginas <b>wiki</b>")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a onclick="marcaBusca('wiki')">wiki</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
		        <li id="busca-gallery" class=""><?php $this->_tag_stack[] = array('tooltip', array('name' => "buscar-acervo",'text' => "Buscar no <b>acervo</b> do EstúdioLivre")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a onclick="marcaBusca('gallery')">acervo</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
		        <li id="busca-usuarios" class=""><?php $this->_tag_stack[] = array('tooltip', array('text' => "Buscar <b>usuári@s</b> do EstúdioLivre")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a onclick="marcaBusca('usuarios')">usuári@</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
				<li id="busca-tags" class=""><?php $this->_tag_stack[] = array('tooltip', array('text' => "Buscar conteúdos com uma <b>tag</b>")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a onclick="marcaBusca('tags')">tag</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
				<li id="busca-blogs" class=""><?php $this->_tag_stack[] = array('tooltip', array('text' => "Buscar <b>blogs</b> do EstúdioLivre")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a onclick="marcaBusca('blogs')">blog</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></li>
		      </ul>
		      <input id="searchField" name="highlight" size="15" type="text" accesskey="s"/><input class="submit" type="image" name="search" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/bSearch.png"/>
		    </form>
		  </div>
		  <script language="JavaScript">marcaBusca(selectedBusca);</script>
	</div>
</div>

  <?php $_from = $this->_tpl_vars['right_modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['module']):
?>
    <?php echo $this->_tpl_vars['module']['data']; ?>

  <?php endforeach; endif; unset($_from); ?>
</div>