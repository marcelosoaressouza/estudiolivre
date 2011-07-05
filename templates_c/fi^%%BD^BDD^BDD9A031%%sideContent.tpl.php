<?php /* Smarty version 2.6.18, created on 2011-04-18 13:07:01
         compiled from styles/bolha/sideContent.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/sideContent.tpl', 1, false),array('modifier', 'replace', 'styles/bolha/sideContent.tpl', 5, false),)), $this); ?>
<?php echo smarty_function_css(array('extra' => 'modules'), $this);?>

<div id="sideContent">
  <?php if ($this->_tpl_vars['category'] == "Áudio"): ?>
  
    <a href="tiki-index.php?page=Áudio&bl"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/logoAudio.png"></a>
	<div id="localMenu">
	<ul>
    <?php if ($this->_tpl_vars['page'] == "Softwares de Áudio"): ?>
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
  
    <a href="tiki-index.php?page=Gráfico&bl"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/logoGrafi.png"></a>
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
  
    <a href="tiki-index.php?page=Vídeo&bl"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/logoVideo.png"></a>
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
  
    <a href="el-gallery_home.php"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/logoAcervo.png"></a>
	<div id="localMenu">
	<ul>
    <?php if ($this->_tpl_vars['current_location'] == "el-gallery_upload.php"): ?>      
      	<li class="selectedAcervo">compartilhe sua obra</li>
    <?php else: ?>
    	<?php if ($this->_tpl_vars['user']): ?>
        	<li><a href="el-gallery_upload.php">compartilhe sua obra</a></li>
        <?php else: ?>
      		<div id="precisaLogar" class="none" style="width:200px;padding:5px">
      			Para compartilhar a sua obra no <b>Acervo Livre</b> é necessário se <a href="tiki-register.php">cadastrar</a> no site.<br><br>
      			Se for cadastrado, efetue o login:<br>

					    <form id="uLoginBox" action="tiki-login.php" method="post">
					      <input type="hidden" name="redirect" value="el-gallery_upload.php">
					      <input class="uText" type="text" name="user" id="login-user" size="12" value="käyttäjä" onFocus="this.value=''"/>
					      senha:<input class="uText" type="<?php if ($this->_tpl_vars['isIE']): ?>password<?php else: ?>text<?php endif; ?>" name="pass" id="login-pass" size="<?php if ($this->_tpl_vars['isIE']): ?>8<?php else: ?>10<?php endif; ?>" <?php if (! $this->_tpl_vars['isIE']): ?>value="senha" onFocus="this.value='';this.type='password'"<?php endif; ?>/>
					      <input type="image" name="login" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iLogin.png" />      
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
    
    <?php if ($this->_tpl_vars['current_location'] == "el-gallery_upload.php"): ?>      
      	<li class="selectedAcervo">canais ao vivo</li>
    <?php else: ?>
     	<li><a href="elIce.php">canais ao vivo</a></li>
    <?php endif; ?>
     <li><a href="tiki-index.php?page=faq">sobre o acervo</a></li>
	</ul>
	</div>
  <?php endif; ?>
  
  <?php $_from = $this->_tpl_vars['right_modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['module']):
?>
    <?php echo $this->_tpl_vars['module']['data']; ?>

  <?php endforeach; endif; unset($_from); ?>
</div>