<?php /* Smarty version 2.6.18, created on 2011-05-03 19:41:10
         compiled from modules/mod-login_box.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tikimodule', 'modules/mod-login_box.tpl', 2, false),array('modifier', 'escape', 'modules/mod-login_box.tpl', 48, false),)), $this); ?>

<?php $this->_tag_stack[] = array('tikimodule', array('title' => 'Login','name' => 'login_box','flip' => $this->_tpl_vars['module_params']['flip'],'decorations' => $this->_tpl_vars['module_params']['decorations'])); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>

    <?php if ($this->_tpl_vars['user']): ?>
      logado como: <?php echo $this->_tpl_vars['user']; ?>
<br />
      <a class="linkmodule" href="tiki-logout.php">Finalizar a sessão</a><br />
      <?php if ($this->_tpl_vars['tiki_p_admin'] == 'y'): ?>
        <form action="<?php echo $this->_tpl_vars['login_url']; ?>
" method="post">
        <label for="login-switchuser">usuári@:</label>
        <input type="hidden" name="su" value="1" />
        <input type="text" name="username" id="login-switchuser" size="8" />
        <input type="submit" name="actsu" value="definir" />
        </form>
      <?php endif; ?>
	<?php elseif ($this->_tpl_vars['auth_method'] == 'cas' && $this->_tpl_vars['showloginboxes'] != 'y'): ?>
		<b><a class="linkmodule" href="tiki-login.php?user">Entrar com CAS</a></b>
		<?php if ($this->_tpl_vars['cas_skip_admin'] == 'y'): ?>
		<br /><a class="linkmodule" href="tiki-login_scr.php?user=admin">Logar como administrador</a>
		<?php endif; ?>
    <?php else: ?>
     <form name="loginbox" action="<?php echo $this->_tpl_vars['login_url']; ?>
" method="post" <?php if ($this->_tpl_vars['feature_challenge'] == 'y'): ?>onsubmit="doChallengeResponse()"<?php endif; ?>> 
     <?php if ($this->_tpl_vars['feature_challenge'] == 'y'): ?>
     <script type='text/javascript' src="lib/md5.js"></script>   
     <?php echo '
     <script type=\'text/javascript\'>
     <!--
     function doChallengeResponse() {
       hashstr = document.loginbox.user.value +
       document.loginbox.pass.value +
       document.loginbox.email.value;
       str = document.loginbox.user.value + 
       MD5(hashstr) +
       document.loginbox.challenge.value;
       document.loginbox.response.value = MD5(str);
       document.loginbox.pass.value=\'\';
       /*
       document.login.password.value = "";
       document.logintrue.username.value = document.login.username.value;
       document.logintrue.response.value = MD5(str);
       document.logintrue.submit();
       */
       document.loginbox.submit();
       return false;
     }
     // -->
    </script>
    '; ?>

     <input type="hidden" name="challenge" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['challenge'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
     <input type="hidden" name="response" value="" />
     <?php endif; ?>
      <table border="0">
      <tr>
        <td>
          <table>
          <tr><td class="module"><label for="login-user">usuári@:</label></td></tr>
		<?php if ($this->_tpl_vars['loginuser'] == ''): ?>
          <tr><td><input type="text" name="user" id="login-user" size="20" /></td></tr>
		<?php else: ?>
		  <tr><td><input type="hidden" name="user" id="login-user" value="<?php echo $this->_tpl_vars['loginuser']; ?>
" /><b><?php echo $this->_tpl_vars['loginuser']; ?>
</b></td></tr>
		<?php endif; ?>
          <?php if ($this->_tpl_vars['feature_challenge'] == 'y'): ?> <!-- quick hack to make challenge/response work until 1.8 tiki auth overhaul -->
          <tr><td class="module"><label for="login-email">e-mail:</label></td></tr>
          <tr><td><input type="text" name="email" id="login-email" size="20" /></td></tr>
          <?php endif; ?>
          <tr><td class="module"><label for="login-pass">senha:</label></td></tr>
          <tr><td><input type="password" name="pass" id="login-pass" size="20" /></td></tr>
          <tr><td><input type="submit" name="login" value="login" /></td></tr>
          <?php if ($this->_tpl_vars['rememberme'] != 'disabled'): ?>
          <tr><td class="module"><label for="login-remember">Lembre-se de mim</label> <input type="checkbox" name="rme" id="login-remember" value="on"/></td></tr>
          <?php endif; ?>
          <tr>
          <?php if ($this->_tpl_vars['forgotPass'] == 'y' && $this->_tpl_vars['allowRegister'] == 'y' && $this->_tpl_vars['change_password'] == 'y'): ?>
            <td  class="module" valign="bottom">[ <a class="linkmodule" href="tiki-register.php" title="Clique aqui para registrar">registrar-se</a> | <a class="linkmodule" href="tiki-remind_password.php" title="Clique aqui se você esqueceu sua senha">Esqueci minha senha</a> ]</td>
          <?php endif; ?>
          <?php if ($this->_tpl_vars['forgotPass'] == 'y' && $this->_tpl_vars['allowRegister'] != 'y' && $this->_tpl_vars['change_password'] == 'y'): ?>
            <td  class="module" valign="bottom"><a class="linkmodule" href="tiki-remind_password.php" title="Clique aqui se você esqueceu sua senha">Esqueci minha senha</a></td>
          <?php endif; ?>
          <?php if (( $this->_tpl_vars['forgotPass'] != 'y' || $this->_tpl_vars['change_password'] != 'y' ) && $this->_tpl_vars['allowRegister'] == 'y'): ?>
            <td  class="module" valign="bottom"><a class="linkmodule" href="tiki-register.php" title="Clique aqui para registrar">registrar-se</a></td>
          <?php endif; ?>
          <?php if (( $this->_tpl_vars['forgotPass'] != 'y' || $this->_tpl_vars['change_password'] != 'y' ) && $this->_tpl_vars['allowRegister'] != 'y'): ?>
          <td valign="bottom">&nbsp;</td>
          <?php endif; ?>
          </tr>
          <?php if ($this->_tpl_vars['http_login_url'] != '' || $this->_tpl_vars['https_login_url'] != ''): ?>
          <tr>
          <td  class="module" valign="bottom">
            <a class="linkmodule" href="<?php echo $this->_tpl_vars['http_login_url']; ?>
" title="Clique aqui para autenticar o protocolo padrão">padrão</a> |
            <a class="linkmodule" href="<?php echo $this->_tpl_vars['https_login_url']; ?>
" title="Clique aqui para se autenticar usando um protocolo seguro">seguro</a>
          </td>
          </tr>
          <?php endif; ?>
          <?php if ($this->_tpl_vars['show_stay_in_ssl_mode'] == 'y'): ?>
            <tr>
              <td class="module">
                <label for="login-stayssl">permanecer no modo seguro:</label>?
                <input type="checkbox" name="stay_in_ssl_mode" id="login-stayssl" <?php if ($this->_tpl_vars['stay_in_ssl_mode'] == 'y'): ?>checked="checked"<?php endif; ?> />
              </td>
            </tr>
          <?php endif; ?>
          </table>
        </td>
      </tr>
      </table>

      <?php if ($this->_tpl_vars['show_stay_in_ssl_mode'] != 'y'): ?>
        <input type="hidden" name="stay_in_ssl_mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['stay_in_ssl_mode'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
      <?php endif; ?>
			<?php if ($this->_tpl_vars['use_intertiki_auth'] == 'y'): ?>
				<select name='intertiki'>
					<option value="">conta local</option>
					<option value="">-----------</option>
					<?php $_from = $this->_tpl_vars['intertiki']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
					<option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['k']; ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			<?php endif; ?>
      </form>
    <?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>