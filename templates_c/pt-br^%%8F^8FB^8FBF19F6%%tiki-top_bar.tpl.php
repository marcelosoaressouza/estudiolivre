<?php /* Smarty version 2.6.18, created on 2011-05-03 19:41:11
         compiled from styles/original/tiki-top_bar.tpl */ ?>
<div id="tiki-top-cubos">
  <a href="tiki-index.php"><img id="logo" src="styles/estudiolivre_orig/logo_EL.png"></a>
  <!--<img id="delme-later" src="styles/estudiolivre_orig/delme-later.gif">-->

  <div id="links-dinamicos">
    <a href="tiki-index.php?page=sobre"><img id="oqeh" src="styles/estudiolivre_orig/oqeh.png"></a><br/>
    <a href="tiki-forums.php"><img id="conversando" src="styles/estudiolivre_orig/conversando.png"></a><br/>
    <a href="tiki-list_users.php"><img id="pessoas" src="styles/estudiolivre_orig/pessoas.png"></a><br/>
    <a href="tiki-index.php?page=faq"><img id="faq" src="styles/estudiolivre_orig/perg_freq.png"></a><br/>
  </div>

  <div id="links">
    <a href="tiki-index.php?page=Gráfico"><img src="styles/estudiolivre_orig/logo_grafi_p.png"></a><br/>
    <a href="tiki-index.php?page=Vídeo"><img src="styles/estudiolivre_orig/logo_video_p.png"></a><br/>
    <a href="tiki-index.php?page=Áudio"><img src="styles/estudiolivre_orig/logo_audio_p.png"></a><br/>
    <a href="el-gallery_home.php"><img src="styles/estudiolivre_orig/logo_acervo_livre_p.png"></a><br/>
    <a href="http://xango.metareciclagem.org"><img src="styles/estudiolivre_orig/logo_metarec_p.png"></a><br/>
  </div>
</div>


<div id="tiki-top-bottom">

 <?php if ($this->_tpl_vars['user']): ?>
   <div id="gretting">Olá <a class="link" href="tiki-user_preferences.php"><?php echo $this->_tpl_vars['user']; ?>
</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="tiki-logout.php">logout&nbsp;&nbsp;<img src="styles/estudiolivre_orig/sair.png" title="sair"></a></div>
 <?php else: ?>
  <div id="tiki-top-login">
    <form id="login-top" name="loginbox" action="<?php echo $this->_tpl_vars['login_url']; ?>
" method="post">

     <label for="login-user"><img src="styles/estudiolivre_orig/nome.png"></label>
     <?php if ($this->_tpl_vars['loginuser'] == ''): ?>
       <input type="text" name="user" id="login-user" size="20" />
     <?php else: ?>
       <input type="hidden" name="user" id="login-user" value="<?php echo $this->_tpl_vars['loginuser']; ?>
" /><b><?php echo $this->_tpl_vars['loginuser']; ?>
</b>
     <?php endif; ?>

     <label for="login-pass"><img src="styles/estudiolivre_orig/senha.png"></label>
     <input type="password" name="pass" id="login-pass" size="20" />
     <input class="submit" type="image" name="login" src="styles/estudiolivre_orig/entrar.png" />

   </form>
 
   <div id="login-options">
   
      <?php if ($this->_tpl_vars['allowRegister'] == 'y'): ?>
        <a href="tiki-register.php"><img src="styles/estudiolivre_orig/cadastrarse.png"></a><br/>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['forgotPass'] == 'y'): ?>
        <a href="tiki-remind_password.php"><img src="styles/estudiolivre_orig/perdisenha.png"></a>
      <?php endif; ?>

    </div>

  </div>   
    
<?php endif; ?>


<?php if ($this->_tpl_vars['feature_search'] == 'y'): ?>
 <div id="tiki-top-search">
    <form id="search-top" method="get" action="tiki-searchresults.php" >
      <input type="hidden" name="where" value="pages">
      <label for="search-field"><img src="styles/estudiolivre_orig/buscar.png"></label>
      <input id="search-field" name="highlight" size="35" type="text" accesskey="s"/>
      <input class="submit" type="image" name="search" src="styles/estudiolivre_orig/search.png">
    </form>
 </div>
<?php endif; ?>


</div>