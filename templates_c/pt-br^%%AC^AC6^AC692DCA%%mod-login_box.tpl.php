<?php /* Smarty version 2.6.18, created on 2011-05-02 18:35:41
         compiled from styles/obscur/modules/mod-login_box.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tikimodule', 'styles/obscur/modules/mod-login_box.tpl', 3, false),array('block', 'tooltip', 'styles/obscur/modules/mod-login_box.tpl', 7, false),array('modifier', 'userlink', 'styles/obscur/modules/mod-login_box.tpl', 20, false),)), $this); ?>

<?php if (! $this->_tpl_vars['user']): ?>
	<?php $this->_tag_stack[] = array('tikimodule', array('title' => 'Login','name' => 'login')); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<form id="uLoginBox" action="tiki-login.php" method="post">
			<?php if ($this->_tpl_vars['isIE']): ?>Usuário: <?php endif; ?><input class="<?php if (! $this->_tpl_vars['isIE']): ?>uText<?php endif; ?>" type="text" name="user" id="login-user" size="12" <?php if ($this->_tpl_vars['isIE']): ?>style="width:60%"<?php endif; ?> value="usuári@" onFocus="if(this.value=='usuári@')this.value=''"/>
			<?php if ($this->_tpl_vars['isIE']): ?>Senha: <?php endif; ?><input class="<?php if (! $this->_tpl_vars['isIE']): ?>uText<?php endif; ?>" type="<?php if ($this->_tpl_vars['isIE']): ?>password<?php else: ?>text<?php endif; ?>" name="pass" id="login-pass" size="10"	<?php if ($this->_tpl_vars['isIE']): ?>style="width:70%"<?php endif; ?> value="<?php if (! $this->_tpl_vars['isIE']): ?>senha<?php endif; ?>" onFocus="if(this.value=='senha')this.value='';this.type='password'"/>
			<?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique aqui ou aperte <i>Enter</i> para efetuar o login")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><input type="image" name="login" src="styles/estudiolivre/iLogin.png" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		      
			<div id="uLoginOptions">
				<a href="tiki-remind_password.php">&raquo; recuperar senha</a><br>
				<a href="tiki-register.php">&raquo; cadastrar-se</a>
			</div>
		      
		</form>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php else: ?>
	<?php $this->_tag_stack[] = array('tikimodule', array('title' => "Usuári@</a>",'name' => 'user')); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<div class="modCenterContent">
		<span id="uMenuName">
			<?php $this->_tag_stack[] = array('tooltip', array('text' => "Navegue para a sua página pessoal para ver seus blogs, arquivos, mensagens e mudar as suas preferências.")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo ((is_array($_tmp=$this->_tpl_vars['user'])) ? $this->_run_mod_handler('userlink', true, $_tmp) : smarty_modifier_userlink($_tmp)); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</span>
	
	    <img alt="" id="uOnlineThumb" class="uThumb" src="tiki-show_user_avatar.php?user=<?php echo $this->_tpl_vars['user']; ?>
"/>
	  
	    <div id="userNameStatsKarma">
	
	      <br>
	      <span id="uStats">
	        <img src="styles/estudiolivre/iOnline.png"> on-line
	      </span>
	      <br>
	      <span id="uKarma">
	      	
	      </span>
	    </div>
	    <br style="line-height:10px;"/>
	    <a href="tiki-logout.php?page=<?php echo $this->_tpl_vars['current_location']; ?>
">Finalizar a sessão</a>
    </div>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php endif; ?>