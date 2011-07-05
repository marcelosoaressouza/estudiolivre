<?php /* Smarty version 2.6.18, created on 2011-04-04 17:12:41
         compiled from styles/bolha/modules/mod-login_box.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tikimodule', 'styles/bolha/modules/mod-login_box.tpl', 3, false),array('block', 'tooltip', 'styles/bolha/modules/mod-login_box.tpl', 7, false),)), $this); ?>

<?php if (! $this->_tpl_vars['user']): ?>
	<?php $this->_tag_stack[] = array('tikimodule', array('title' => "ログイン",'name' => 'login')); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<form id="uLoginBox" action="tiki-login.php" method="post">
			<?php if ($this->_tpl_vars['isIE']): ?>Usuári@: <?php endif; ?><input class="<?php if (! $this->_tpl_vars['isIE']): ?>uText<?php endif; ?>" type="text" name="user" id="login-user" size="12" <?php if ($this->_tpl_vars['isIE']): ?>style="width:60%"<?php endif; ?> <?php if (! $this->_tpl_vars['isIE']): ?>value="ユーザー" onFocus="if(this.value=='ユーザー')this.value=''"<?php endif; ?>/>
			<?php if ($this->_tpl_vars['isIE']): ?>Senha: <?php endif; ?><input class="<?php if (! $this->_tpl_vars['isIE']): ?>uText<?php endif; ?>" type="<?php if ($this->_tpl_vars['isIE']): ?>password<?php else: ?>text<?php endif; ?>" name="pass" id="login-pass" size="10"	<?php if ($this->_tpl_vars['isIE']): ?>style="width:68%"<?php endif; ?> <?php if (! $this->_tpl_vars['isIE']): ?>value="パスワード" onFocus="if(this.value=='パスワード')this.value='';this.type='password'"<?php endif; ?>/>
			<?php if ($this->_tpl_vars['isIE']): ?><center><input type="submit" value="ログイン" name="login"/></center><?php else: ?><?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique aqui ou aperte <i>Enter</i> para efetuar o login")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><input type="image" name="login" src="styles/estudiolivre/iLogin.png" /><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
		      
			<div id="uLoginOptions">
				<a href="tiki-remind_password.php">&raquo; recuperar senha</a><br>
				<a href="tiki-register.php">&raquo; cadastrar-se</a><br/>
				<a href="tiki-list_users.php">&raquo; registered users</a>
			</div>
		      
		</form>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php else: ?>
	<?php $this->_tag_stack[] = array('tikimodule', array('title' => "ユーザー</a>",'name' => 'user')); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<div id="userMod">		
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "Navegue para a sua página pessoal para ver seus blogs, arquivos, mensagens e mudar as suas preferências.")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<a id="nome" href="el-user.php?view_user=<?php echo $this->_tpl_vars['user']; ?>
">
				<img src="tiki-show_user_avatar.php?user=<?php echo $this->_tpl_vars['user']; ?>
"/>
				<br/>
				<?php echo $this->_tpl_vars['user']; ?>

			</a>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php $this->_tag_stack[] = array('tooltip', array('name' => "lista-comunidade",'text' => "Veja a lista de <b>pessoas</b> que fazem parte da comunidade")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="tiki-list_users.php">outros ユーザー</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<a href="tiki-logout.php?page=<?php echo $this->_tpl_vars['current_location']; ?>
">ログアウト</a>
	</div>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php endif; ?>