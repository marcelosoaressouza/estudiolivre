<?php /* Smarty version 2.6.18, created on 2011-05-03 19:41:10
         compiled from styles/original/el-user.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tooltip', 'styles/original/el-user.tpl', 13, false),array('function', 'ajax_checkbox', 'styles/original/el-user.tpl', 14, false),array('function', 'ajax_input', 'styles/original/el-user.tpl', 29, false),array('modifier', 'cat', 'styles/original/el-user.tpl', 109, false),array('modifier', 'date_format', 'styles/original/el-user.tpl', 119, false),array('modifier', 'truncate', 'styles/original/el-user.tpl', 158, false),)), $this); ?>
<!-- tiki-user_information.tpl begin -->

<script language="JavaScript" src="lib/js/license.js"></script>
<script language="JavaScript" src="lib/js/user_edit.js"></script>
<script language="JavaScript" src="lib/js/edit_field_ajax.js"></script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "avisoTemaNaoSuportado.tpl", 'smarty_include_vars' => array('texto' => "suporta a visualização das páginas de usuári@s")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="userPage">
  <div id="uGeneralInfo">
    <div id="uName">
		<?php if ($this->_tpl_vars['permission']): ?>
			<?php $this->_tag_stack[] = array('tooltip', array('text' => "Selecione para tornar esta página pública")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<?php echo smarty_function_ajax_checkbox(array('permission' => $this->_tpl_vars['permission'],'class' => "",'id' => 'isPublic','value' => $this->_tpl_vars['isPublic']), $this);?>

			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php echo $this->_tpl_vars['userinfo']['login']; ?>

			<?php $this->_tag_stack[] = array('tooltip', array('text' => "Modifique as suas preferências")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<a href="tiki-user_preferences.php"><img src="img/mytiki/prefs.gif" height="15"></a>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php else: ?>
			<?php echo $this->_tpl_vars['userinfo']['login']; ?>

		<?php endif; ?>
    </div>
    
    <div id="uContactKarmaAccount">
      <div id="uContact" class="uContactInfoCont left">
        <?php if ($this->_tpl_vars['permission']): ?>
        	<?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique para modificar o seu <b>nome</b>")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	        	<?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'id' => 'realName','class' => 'uContactItem','value' => $this->_tpl_vars['realName'],'default' => 'Nome completo','display' => 'block'), $this);?>

        	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php else: ?>
        	
        	<?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'id' => 'realName','class' => 'uContactItem','value' => $this->_tpl_vars['realName'],'default' => 'Nome completo','display' => 'block'), $this);?>

        <?php endif; ?>
        <br />
        <?php if ($this->_tpl_vars['permission']): ?>
        	<?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique para modificar o seu <b>email</b>")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		        <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'id' => 'email','class' => 'uContactItem','value' => $this->_tpl_vars['userinfo']['email'],'default' => "E-mail",'display' => 'block','truncate' => '17'), $this);?>
        
		    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php else: ?>
        	
	        <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'id' => 'email','class' => 'uContactItem','value' => $this->_tpl_vars['userinfo']['email'],'default' => "E-mail",'display' => 'block','truncate' => '17'), $this);?>

	    <?php endif; ?>
		<br />
        <?php if ($this->_tpl_vars['permission']): ?>
        	<?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique para modificar o seu <b>site</b>")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		        <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'id' => 'site','class' => 'uContactItem','value' => $this->_tpl_vars['site'],'default' => 'Site','display' => 'block','truncate' => '17'), $this);?>
        
		    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php else: ?>		
            
	        <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'id' => 'site','class' => 'uContactItem','value' => $this->_tpl_vars['site'],'default' => 'Site','display' => 'block','truncate' => '17'), $this);?>

	    <?php endif; ?>
		<br />
        <?php if ($this->_tpl_vars['permission']): ?>
        	<?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique para modificar a sua <b>localização</b>")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		        <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'id' => 'local','class' => 'uContactItem','value' => $this->_tpl_vars['local'],'default' => "Localização",'display' => 'inline'), $this);?>
        
		    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        <?php else: ?>	
        		
	        <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'id' => 'local','class' => 'uContactItem','value' => $this->_tpl_vars['local'],'default' => "Localização",'display' => 'inline'), $this);?>

	    <?php endif; ?>
      </div>

      <div id="uKarmaThumb" class="uContactInfoCont center">
		<div id="uKarma">
		  
		</div>

	    <div id="gUserThumb">
		  <img id="uThumbImg" alt="" src="tiki-show_user_avatar.php?user=<?php echo $this->_tpl_vars['userinfo']['login']; ?>
"/>
		  <div id="gUserThumbStatus"></div>
		</div>

		<?php if ($this->_tpl_vars['permission']): ?>
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique aqui para selecionar um novo <b>avatar</b>")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<div id="gUserThumbFormContainer">
	      <div id="gUserThumbForm">
	        <iframe name="thumbUpTarget" style="display:none" onLoad="finishUpThumb();"></iframe>
	        <form action="el-user_thumb.php?UPLOAD_IDENTIFIER=thumb.<?php echo $this->_tpl_vars['uploadId']; ?>
" method="post" enctype="multipart/form-data" name="thumbForm" target="thumbUpTarget">
		      <input type="hidden" name="UPLOAD_IDENTIFIER" value="thumb.<?php echo $this->_tpl_vars['uploadId']; ?>
"/>
		      <input type="hidden" name="arquivoId" value=""/>
		      <input type="file" name="thumb" onChange="changeThumbStatus()" class="gUserThumbFormButton"/>
	        </form>
	      </div>
	    </div>
	    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	    <?php endif; ?>

	  </div>

      <div id="uAccountInfo" class="uContactInfoCont right">
        <!-- span class="uContactItem"><a href="#">(X) Amigos</a></span -->
        <br />
        
        <span class="uContactItem">
        	<span class="uContactItem">
        	<?php if ($this->_tpl_vars['permission']): ?>        		
        			<span class="pointer" onClick="showLightbox('el-license')">
        			<?php if ($this->_tpl_vars['licenca']): ?>
			    	   	<?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique para modificar a sua licença padrão")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			    	   		<img id="ajax-uLicence" src="styles/estudiolivre/h_<?php echo $this->_tpl_vars['licenca']['linkImagem']; ?>
"/>
			    	   	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			    	<?php else: ?>
	    		    	(Selecione sua licença Padrão)
	    		    <?php endif; ?>
	    		    </span>
	        <?php else: ?>
		        <?php if ($this->_tpl_vars['licenca']): ?>
			    	   	<?php $this->_tag_stack[] = array('tooltip', array('text' => ((is_array($_tmp="Licença padrão desse usuário: ")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['licenca']['descricao']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['licenca']['descricao'])))); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img id="ajax-uLicence" src="styles/estudiolivre/h_<?php echo $this->_tpl_vars['licenca']['linkImagem']; ?>
"/><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		    	<?php else: ?>
		        	(Usuário sem Licença Padrão)
		        <?php endif; ?>
		    <?php endif; ?>
        	</span>
        </span>
        <br />
        <span class="uContactItem"><a href="tiki-lastchanges.php?find=<?php echo $this->_tpl_vars['userinfo']['login']; ?>
&sort_mode=lastModif_desc&days=0">Contribuições Recentes</a></span>
        <br />
        <span class="uContactItem uLittle">Membro desde <?php echo ((is_array($_tmp=$this->_tpl_vars['userinfo']['registrationDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>
</span>
      </div>  
    </div>
    <div id="uGallery" class="uMainContainer">
      <div id="uGalleryTitle" class="sectionTitle uMainTitle uSectionsTitle">
		<a class="uRssCont" href="el-gallery_rss.php?user=<?php echo $this->_tpl_vars['userinfo']['login']; ?>
&ver=2"><img src="styles/estudiolivre/iRss.png"></a>
        <img class="pointer" onclick="javascript:flip('uGalleryItems');this.toggleImage('iArrowGreyRight.png')" src="styles/estudiolivre/iArrowGreyDown.png">
        &nbsp;
        <h1>
          <a name="gallery">Galeria pessoal</a>
        </h1>
      </div>
      <div id="uGalleryItems" class="uMainItemContainer" style="display:block">
      <?php if (sizeof ( $this->_tpl_vars['arquivos'] )): ?>
      	<div id="ajax-listNav" class="ulistNav"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "el-gallery_pagination.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
		<div id="ajax-gListCont"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "el-gallery_section.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
	  <?php else: ?>
	  	<?php if ($this->_tpl_vars['permission']): ?>
		  	<p> Você ainda não possui arquivos no acervo livre. <a href="el-gallery_upload.php">Compartilhe</a> sua obra!</p>
	  	<?php else: ?>
	  		<p> Esse usuário ainda não possui arquivos no acervo livre.</p>
	  	<?php endif; ?>
	  <?php endif; ?>
      </div>
    </div>
    <div id="uBlog" class="uMainContainer">
      <div id="uBlogTitle" class="sectionTitle uMainTitle">
        <a class="uRssCont" href="el-userblogs_rss.php?user=<?php echo $this->_tpl_vars['userinfo']['login']; ?>
&ver=2"><img src="styles/estudiolivre/iRss.png"></a>
      	<img class="pointer" onclick="javascript:flip('uBlogItems');this.toggleImage('iArrowGreyRight.png')" src="styles/estudiolivre/iArrowGreyDown.png">
        &nbsp;
        <h1>
          <a href="#">Blogs</a>
        </h1>
      </div>
      <div id="uBlogItems" class="uMainItemContainer" style="display:block">
        <?php if (sizeof ( $this->_tpl_vars['userPosts']['data'] )): ?>
	      	<?php $_from = $this->_tpl_vars['userPosts']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['post']):
?>
	        <div class="uBlogItem">
	          <div id="uBlogItemTitle">
	            <h1><?php echo ((is_array($_tmp=$this->_tpl_vars['post']['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 40) : smarty_modifier_truncate($_tmp, 40)); ?>
</h1> - <?php echo ((is_array($_tmp=$this->_tpl_vars['post']['created'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>

	          </div>
	          <div id="uBlogItemText">
	            <?php echo ((is_array($_tmp=$this->_tpl_vars['post']['data'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 150) : smarty_modifier_truncate($_tmp, 150)); ?>
 <a href="#" title="Ler mais...">(...)</a>
	          </div>
	          <div id="uBlogItemBottom">
	            <a href="tiki-view_blog_post.php?blogId=<?php echo $this->_tpl_vars['post']['blogId']; ?>
&postId=<?php echo $this->_tpl_vars['post']['postId']; ?>
">ler mais</a> | 
	            <a href="tiki-view_blog_post.php?blogId=<?php echo $this->_tpl_vars['post']['blogId']; ?>
&postId=<?php echo $this->_tpl_vars['post']['postId']; ?>
">permalink</a> | 
	            <a href="tiki-view_blog_post.php?blogId=<?php echo $this->_tpl_vars['post']['blogId']; ?>
&postId=<?php echo $this->_tpl_vars['post']['postId']; ?>
&show_comments=1#comments">(<?php echo $this->_tpl_vars['post']['commentsCount']; ?>
) comentaram</a>
	          </div>
	        </div>
	        <?php endforeach; endif; unset($_from); ?>
		<?php else: ?>
		  	<?php if ($this->_tpl_vars['permission']): ?>
			  	<p> Você ainda não possui blogs. <a href="tiki-edit_blog.php">Crie</a> um blog ou veja a <a href="tiki-list_blogs.php">lista</a> dos existentes.</p>
		  	<?php else: ?>
		  		<p> Esse usuário ainda não possui posts em blogs.</p>
			<?php endif; ?>
		<?php endif; ?>
      </div>
    </div>
    <?php if ($this->_tpl_vars['allowMsgs'] || $this->_tpl_vars['permission']): ?>
    <div id="uMsgs" class="uMainContainer">
      <div id="uMsgsTitle" class="sectionTitle uMainTitle">
        <a class="uRssCont" href="el-usermsgs_rss.php?user=<?php echo $this->_tpl_vars['userinfo']['login']; ?>
&ver=2"><img src="styles/estudiolivre/iRss.png"></a>
        <img class="pointer" onclick="javascript:flip('uMsgItems');this.toggleImage('iArrowGreyRight.png')" src="styles/estudiolivre/iArrowGreyDown.png">
        &nbsp;
        <h1><a href="#">Recados</a></h1>
        <?php if ($this->_tpl_vars['permission']): ?>
			<?php $this->_tag_stack[] = array('tooltip', array('text' => "Selecione para permitir que outr@s usuári@s mandem mensagens para você")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<?php echo smarty_function_ajax_checkbox(array('permission' => $this->_tpl_vars['permission'],'class' => "",'id' => 'allowMsgs','value' => $this->_tpl_vars['allowMsgs']), $this);?>

			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php endif; ?>
      </div>
      <div id="uMsgItems" class="uMainItemContainer" style="display:block">
      	<?php if ($this->_tpl_vars['allowMsgs']): ?>
	      	<div class="listNav" id="ajax-msgListNav"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "el-msg_pagination.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
	      	<span id="ajax-userMsgs"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "el-user_msg.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span>
	    <?php endif; ?>
      </div>
    </div>
    <?php endif; ?>
    <div id="uWiki" class="uMainContainer">
    	<div id="uWikiTitle" class="sectionTitle uMainTitle">
    		<a class="uRssCont" href="tiki-wiki_rss.php?ver=2"><img src="styles/estudiolivre/iRss.png"></a>
            <img class="pointer" onclick="javascript:flip('uWikiMid');this.toggleImage('iArrowGreyRight.png')" src="styles/estudiolivre/iArrowGreyDown.png">
        	&nbsp;
    		<h1>
    		  <a href="#" title="Wiki de <?php echo $this->_tpl_vars['userinfo']['login']; ?>
">Wiki</a>
    		</h1>
    	</div>
    	<div id="uWikiMid" style="display:block">
		  <?php if ($this->_tpl_vars['userWiki']): ?>
	    	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-show_page.tpl", 'smarty_include_vars' => array('parsed' => $this->_tpl_vars['userWiki'],'page' => $this->_tpl_vars['pageName'],'lastUser' => $this->_tpl_vars['modifUser'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	      <?php else: ?>
	      	<?php if ($this->_tpl_vars['permission']): ?>
	      		<p> Você ainda não tem uma página wiki pessoal. <a href="tiki-editpage.php?page=<?php echo $this->_tpl_vars['pageName']; ?>
">Crie</a> seu wiki!</p>
	      	<?php else: ?>
	      		<p> Esse usuário ainda não possui uma página wiki pessoal </p>
	      	<?php endif; ?>
	      <?php endif; ?>
        </div>
    </div>
  </div>
</div>

<?php if ($this->_tpl_vars['permission']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "el-license.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<!-- tiki-user_information.tpl end -->