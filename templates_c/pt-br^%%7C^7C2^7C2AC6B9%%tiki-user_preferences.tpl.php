<?php /* Smarty version 2.6.18, created on 2011-04-08 19:39:01
         compiled from styles/bolha/tiki-user_preferences.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-user_preferences.tpl', 1, false),array('function', 'cycle', 'styles/bolha/tiki-user_preferences.tpl', 48, false),array('modifier', 'escape', 'styles/bolha/tiki-user_preferences.tpl', 58, false),array('modifier', 'tiki_short_datetime', 'styles/bolha/tiki-user_preferences.tpl', 62, false),array('modifier', 'replace', 'styles/bolha/tiki-user_preferences.tpl', 86, false),)), $this); ?>
<?php echo smarty_function_css(array(), $this);?>

<div id="userPrefs">
<h1>
	<?php if ($this->_tpl_vars['userwatch'] != $this->_tpl_vars['user']): ?>
		<a class="pagetitle" href="tiki-user_preferences.php?view_user=<?php echo $this->_tpl_vars['userwatch']; ?>
">
			Preferências do Usuário: <?php echo $this->_tpl_vars['userwatch']; ?>

		</a>
	<?php else: ?>
		Preferências do Usuário
	<?php endif; ?>
</h1>	

<div class="hide">
	<?php if ($this->_tpl_vars['feature_help'] == 'y'): ?>
		<a href="<?php echo $this->_tpl_vars['helpurl']; ?>
User+Preferences" target="tikihelp" class="tikihelp" title="Preferências do Usuário">
		<img src="img/icons/help.gif" border="0" height="16" width="16" alt='auxílio' /></a>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['feature_view_tpl'] == 'y'): ?>
		<a href="tiki-edit_templates.php?template=tiki-user_preferences.tpl" target="tikihelp" class="tikihelp" title="Exibir tpl: Preferências do usuário tpl">
		<img src="img/icons/info.gif" border="0" width="16" height="16" alt='editar modelo' /></a>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['userwatch'] == $this->_tpl_vars['user'] || $this->_tpl_vars['userwatch'] == ""): ?>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-mytiki_bar.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['tikifeedback']): ?>
		<div class="simplebox highlight">
			<?php unset($this->_sections['n']);
$this->_sections['n']['name'] = 'n';
$this->_sections['n']['loop'] = is_array($_loop=$this->_tpl_vars['tikifeedback']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['n']['show'] = true;
$this->_sections['n']['max'] = $this->_sections['n']['loop'];
$this->_sections['n']['step'] = 1;
$this->_sections['n']['start'] = $this->_sections['n']['step'] > 0 ? 0 : $this->_sections['n']['loop']-1;
if ($this->_sections['n']['show']) {
    $this->_sections['n']['total'] = $this->_sections['n']['loop'];
    if ($this->_sections['n']['total'] == 0)
        $this->_sections['n']['show'] = false;
} else
    $this->_sections['n']['total'] = 0;
if ($this->_sections['n']['show']):

            for ($this->_sections['n']['index'] = $this->_sections['n']['start'], $this->_sections['n']['iteration'] = 1;
                 $this->_sections['n']['iteration'] <= $this->_sections['n']['total'];
                 $this->_sections['n']['index'] += $this->_sections['n']['step'], $this->_sections['n']['iteration']++):
$this->_sections['n']['rownum'] = $this->_sections['n']['iteration'];
$this->_sections['n']['index_prev'] = $this->_sections['n']['index'] - $this->_sections['n']['step'];
$this->_sections['n']['index_next'] = $this->_sections['n']['index'] + $this->_sections['n']['step'];
$this->_sections['n']['first']      = ($this->_sections['n']['iteration'] == 1);
$this->_sections['n']['last']       = ($this->_sections['n']['iteration'] == $this->_sections['n']['total']);
?>
				<?php echo $this->_tpl_vars['tikifeedback'][$this->_sections['n']['index']]['mes']; ?>

				<br />
			<?php endfor; endif; ?>
		</div>
	<?php else: ?>
	<?php endif; ?>
</div>
	
<table class="admin">
<tr>
  <!--The line below was <td valign="top" > for no real reason-->
  <td valign="top">

<?php if ($this->_tpl_vars['feature_tabs'] == 'y'): ?>



<?php endif; ?>

<?php echo smarty_function_cycle(array('name' => 'content','values' => "1,2,3",'print' => false,'advance' => false), $this);?>




<div class="tabcontent" >

  <div class="cbox">
  <div class="cbox-title">Preferências gerais</div>
  <div class="cbox-data">
  <form action="tiki-user_preferences.php" method="post">
  <input type="hidden" name="view_user" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['userwatch'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
  <input type="hidden" name="user" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['userwatch'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/> 
  <input type="hidden" value="public" name="user_information"/>
  <table class="admin">
  <tr><td class="form">Último login:</td><td class="form"><?php echo ((is_array($_tmp=$this->_tpl_vars['userinfo']['lastLogin'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>
</td></tr>
  <tr><td class="form">Endereço de email público? (utilizar ofuscação para evitar spam)</td><td class="form">
<?php if ($this->_tpl_vars['userinfo']['email']): ?>
  <select name="email_isPublic">
   <?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['scramblingMethods']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ix']['show'] = true;
$this->_sections['ix']['max'] = $this->_sections['ix']['loop'];
$this->_sections['ix']['step'] = 1;
$this->_sections['ix']['start'] = $this->_sections['ix']['step'] > 0 ? 0 : $this->_sections['ix']['loop']-1;
if ($this->_sections['ix']['show']) {
    $this->_sections['ix']['total'] = $this->_sections['ix']['loop'];
    if ($this->_sections['ix']['total'] == 0)
        $this->_sections['ix']['show'] = false;
} else
    $this->_sections['ix']['total'] = 0;
if ($this->_sections['ix']['show']):

            for ($this->_sections['ix']['index'] = $this->_sections['ix']['start'], $this->_sections['ix']['iteration'] = 1;
                 $this->_sections['ix']['iteration'] <= $this->_sections['ix']['total'];
                 $this->_sections['ix']['index'] += $this->_sections['ix']['step'], $this->_sections['ix']['iteration']++):
$this->_sections['ix']['rownum'] = $this->_sections['ix']['iteration'];
$this->_sections['ix']['index_prev'] = $this->_sections['ix']['index'] - $this->_sections['ix']['step'];
$this->_sections['ix']['index_next'] = $this->_sections['ix']['index'] + $this->_sections['ix']['step'];
$this->_sections['ix']['first']      = ($this->_sections['ix']['iteration'] == 1);
$this->_sections['ix']['last']       = ($this->_sections['ix']['iteration'] == $this->_sections['ix']['total']);
?>
      <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['scramblingMethods'][$this->_sections['ix']['index']])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['email_isPublic'] == $this->_tpl_vars['scramblingMethods'][$this->_sections['ix']['index']]): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['scramblingEmails'][$this->_sections['ix']['index']]; ?>
</option>
   <?php endfor; endif; ?>
  </select>
<?php else: ?>
  Não disponível - por favor defina seu e-mail abaixo
<?php endif; ?>
  </td></tr>
  <tr><td class="form">Seu cliente de e-mail precisa de codificação específica</td>
  <td class="form">
  <select name="mailCharset">
   <?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['mailCharsets']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ix']['show'] = true;
$this->_sections['ix']['max'] = $this->_sections['ix']['loop'];
$this->_sections['ix']['step'] = 1;
$this->_sections['ix']['start'] = $this->_sections['ix']['step'] > 0 ? 0 : $this->_sections['ix']['loop']-1;
if ($this->_sections['ix']['show']) {
    $this->_sections['ix']['total'] = $this->_sections['ix']['loop'];
    if ($this->_sections['ix']['total'] == 0)
        $this->_sections['ix']['show'] = false;
} else
    $this->_sections['ix']['total'] = 0;
if ($this->_sections['ix']['show']):

            for ($this->_sections['ix']['index'] = $this->_sections['ix']['start'], $this->_sections['ix']['iteration'] = 1;
                 $this->_sections['ix']['iteration'] <= $this->_sections['ix']['total'];
                 $this->_sections['ix']['index'] += $this->_sections['ix']['step'], $this->_sections['ix']['iteration']++):
$this->_sections['ix']['rownum'] = $this->_sections['ix']['iteration'];
$this->_sections['ix']['index_prev'] = $this->_sections['ix']['index'] - $this->_sections['ix']['step'];
$this->_sections['ix']['index_next'] = $this->_sections['ix']['index'] + $this->_sections['ix']['step'];
$this->_sections['ix']['first']      = ($this->_sections['ix']['iteration'] == 1);
$this->_sections['ix']['last']       = ($this->_sections['ix']['iteration'] == $this->_sections['ix']['total']);
?>
      <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['mailCharsets'][$this->_sections['ix']['index']])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['mailCharset'] == $this->_tpl_vars['mailCharsets'][$this->_sections['ix']['index']]): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['mailCharsets'][$this->_sections['ix']['index']]; ?>
</option>
   <?php endfor; endif; ?>
  </select>
  </td></tr>
  <?php if ($this->_tpl_vars['change_theme'] == 'y'): ?>
  <tr><td class="form">Tema:</td><td class="form"><select name="mystyle">
    <?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['styles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ix']['show'] = true;
$this->_sections['ix']['max'] = $this->_sections['ix']['loop'];
$this->_sections['ix']['step'] = 1;
$this->_sections['ix']['start'] = $this->_sections['ix']['step'] > 0 ? 0 : $this->_sections['ix']['loop']-1;
if ($this->_sections['ix']['show']) {
    $this->_sections['ix']['total'] = $this->_sections['ix']['loop'];
    if ($this->_sections['ix']['total'] == 0)
        $this->_sections['ix']['show'] = false;
} else
    $this->_sections['ix']['total'] = 0;
if ($this->_sections['ix']['show']):

            for ($this->_sections['ix']['index'] = $this->_sections['ix']['start'], $this->_sections['ix']['iteration'] = 1;
                 $this->_sections['ix']['iteration'] <= $this->_sections['ix']['total'];
                 $this->_sections['ix']['index'] += $this->_sections['ix']['step'], $this->_sections['ix']['iteration']++):
$this->_sections['ix']['rownum'] = $this->_sections['ix']['iteration'];
$this->_sections['ix']['index_prev'] = $this->_sections['ix']['index'] - $this->_sections['ix']['step'];
$this->_sections['ix']['index_next'] = $this->_sections['ix']['index'] + $this->_sections['ix']['step'];
$this->_sections['ix']['first']      = ($this->_sections['ix']['iteration'] == 1);
$this->_sections['ix']['last']       = ($this->_sections['ix']['iteration'] == $this->_sections['ix']['total']);
?>
      <?php if (count ( $this->_tpl_vars['available_styles'] ) == 0 || in_array ( $this->_tpl_vars['styles'][$this->_sections['ix']['index']] , $this->_tpl_vars['available_styles'] )): ?>
        <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['styles'][$this->_sections['ix']['index']])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['style'] == $this->_tpl_vars['styles'][$this->_sections['ix']['index']]): ?>selected="selected"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['styles'][$this->_sections['ix']['index']])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
</option>
      <?php endif; ?>
    <?php endfor; endif; ?>
        </select>
		<?php if ($this->_tpl_vars['feature_editcss'] == 'y' && $this->_tpl_vars['tiki_p_create_css'] == 'y'): ?>
			<br/><a href="tiki-edit_css.php" class="link" title="Editar CSS">Editar CSS</a>
		<?php endif; ?>
				</td></tr>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['change_language'] == 'y'): ?>
  <tr><td  class="form">Idioma:</td></tr>
  <tr>
  <td colspan=2 class="form">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <select name="language">
    <?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['languages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ix']['show'] = true;
$this->_sections['ix']['max'] = $this->_sections['ix']['loop'];
$this->_sections['ix']['step'] = 1;
$this->_sections['ix']['start'] = $this->_sections['ix']['step'] > 0 ? 0 : $this->_sections['ix']['loop']-1;
if ($this->_sections['ix']['show']) {
    $this->_sections['ix']['total'] = $this->_sections['ix']['loop'];
    if ($this->_sections['ix']['total'] == 0)
        $this->_sections['ix']['show'] = false;
} else
    $this->_sections['ix']['total'] = 0;
if ($this->_sections['ix']['show']):

            for ($this->_sections['ix']['index'] = $this->_sections['ix']['start'], $this->_sections['ix']['iteration'] = 1;
                 $this->_sections['ix']['iteration'] <= $this->_sections['ix']['total'];
                 $this->_sections['ix']['index'] += $this->_sections['ix']['step'], $this->_sections['ix']['iteration']++):
$this->_sections['ix']['rownum'] = $this->_sections['ix']['iteration'];
$this->_sections['ix']['index_prev'] = $this->_sections['ix']['index'] - $this->_sections['ix']['step'];
$this->_sections['ix']['index_next'] = $this->_sections['ix']['index'] + $this->_sections['ix']['step'];
$this->_sections['ix']['first']      = ($this->_sections['ix']['iteration'] == 1);
$this->_sections['ix']['last']       = ($this->_sections['ix']['iteration'] == $this->_sections['ix']['total']);
?>
      <?php if (count ( $this->_tpl_vars['available_languages'] ) == 0 || in_array ( $this->_tpl_vars['languages'][$this->_sections['ix']['index']]['value'] , $this->_tpl_vars['available_languages'] )): ?>
        <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['languages'][$this->_sections['ix']['index']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"
          <?php if ($this->_tpl_vars['langUser'] == $this->_tpl_vars['languages'][$this->_sections['ix']['index']]['value']): ?>selected="selected"<?php endif; ?>>
          <?php echo $this->_tpl_vars['languages'][$this->_sections['ix']['index']]['name']; ?>

        </option>
      <?php endif; ?>
    <?php endfor; endif; ?>
        </select></td></tr>
  <?php endif; ?>      
  <tr><td class="form">Número de páginas visitadas a lembrar:</td><td class="form">
  <select name="userbreadCrumb">
  <option value="1" <?php if ($this->_tpl_vars['userbreadCrumb'] == 1): ?>selected="selected"<?php endif; ?>>1</option>
  <option value="2" <?php if ($this->_tpl_vars['userbreadCrumb'] == 2): ?>selected="selected"<?php endif; ?>>2</option>
  <option value="3" <?php if ($this->_tpl_vars['userbreadCrumb'] == 3): ?>selected="selected"<?php endif; ?>>3</option>
  <option value="4" <?php if ($this->_tpl_vars['userbreadCrumb'] == 4): ?>selected="selected"<?php endif; ?>>4</option>
  <option value="5" <?php if ($this->_tpl_vars['userbreadCrumb'] == 5): ?>selected="selected"<?php endif; ?>>5</option>
  <option value="10" <?php if ($this->_tpl_vars['userbreadCrumb'] == 10): ?>selected="selected"<?php endif; ?>>10</option>
  </select>
  </td></tr>
  <tr><td class="form">Fuso horário exibido:</td>
  <td class="form">
  <input type="radio" name="display_timezone" value="UTC" <?php if ($this->_tpl_vars['display_timezone'] == 'UTC'): ?>checked="checked"<?php endif; ?>/> UTC
  <input type="radio" name="display_timezone" value="Local" <?php if ($this->_tpl_vars['display_timezone'] != 'UTC'): ?>checked="checked"<?php endif; ?>/> Local
  </td>
  </tr>
  
  
  <?php if ($this->_tpl_vars['feature_wiki'] == 'y'): ?>
  <tr><td class="form">Clique-duplo para editar páginas:</td>
  <td class="form">
  <input type="checkbox" name="user_dbl" <?php if ($this->_tpl_vars['user_dbl'] == 'y'): ?>checked="checked"<?php endif; ?> />
  </td>
  </tr>
  <tr><td class="form">Usar 'ctrl-enter' para salvar a página sendo editada (pode tornar a edição mais lenta):</td>
  <td class="form">
  <input type="checkbox" name="user_useEditJs" <?php if ($this->_tpl_vars['user_useEditJs'] == 'y'): ?>checked="checked"<?php endif; ?> />
  </td>
  </tr>
  
  <?php endif; ?>
  <?php if ($this->_tpl_vars['feature_community_mouseover'] == 'y'): ?>
  <tr><td class="form">Mouseover mostra informações do usuário:</td>
  <td class="form">
  <input type="checkbox" name="show_mouseover_user_info" <?php if ($this->_tpl_vars['show_mouseover_user_info'] == 'y'): ?>checked="checked"<?php endif; ?> />
  </td>
  </tr>
  <?php endif; ?>

  <tr><td colspan="2" class="button"><input type="submit" name="prefs" value="Alterar preferências" /></td></tr>
  </table>
  </form>
  </div>
  </div>

  <div class="cbox">
  <div class="cbox-title">Senha</div>
  <div class="cbox-data">
  <?php if ($this->_tpl_vars['auth_method'] != 'cas' || ( $this->_tpl_vars['cas_skip_admin'] == 'y' && $this->_tpl_vars['user'] == 'admin' )): ?>
  <?php if ($this->_tpl_vars['change_password'] != 'n'): ?>Deixe os campos "Nova senha" e "Confirmar nova senha" em branco para manter a senha atual<?php endif; ?>
  <?php endif; ?>
  <form action="tiki-user_preferences.php" method="post">
  <input type="hidden" name="view_user" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['userwatch'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/>
  <table class="admin">
  
<?php if ($this->_tpl_vars['auth_method'] != 'cas' || ( $this->_tpl_vars['cas_skip_admin'] == 'y' && $this->_tpl_vars['user'] == 'admin' )): ?>
  <?php if ($this->_tpl_vars['change_password'] != 'n'): ?>
  <tr><td class="form">Nova senha:</td><td class="form"><input type="password" name="pass1" /></td></tr>
  <tr><td class="form">Confirmar nova senha:</td><td class="form"><input type="password" name="pass2" /></td></tr>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['tiki_p_admin'] != 'y' || $this->_tpl_vars['userwatch'] == $this->_tpl_vars['user']): ?>
    <tr><td class="form">Senha atual (obrigatório):</td><td class="form"><input type="password" name="pass" /></td></tr>
  <?php endif; ?>
<?php endif; ?>
  <tr><td colspan="2" class="button"><input type="submit" name="chgadmin" value="Atualizar"/></td></tr>
  </table>
  </form>
  </div>
  </div>

</div>


<div class="tabcontent" >

<?php if ($this->_tpl_vars['feature_messages'] == 'y' && $this->_tpl_vars['tiki_p_messages'] == 'y'): ?>
  <div class="cbox">
  <div class="cbox-title">
	  <a href="el-user.php?view_user=<?php echo $this->_tpl_vars['user']; ?>
#messages">
		  Mensagens do usuário
	  </a>
  </div>
  <div class="cbox-data">
        <form action="tiki-user_preferences.php" method="post">
        <input type="hidden" name="view_user" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['userwatch'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/>
<table class="admin">
<tr>
  <td class="form">Mensagens por página</td>
  <td class="form">
    <select name="mess_maxRecords">
      <option value="2" <?php if ($this->_tpl_vars['mess_maxRecords'] == 2): ?>selected="selected"<?php endif; ?>>2</option>
      <option value="5" <?php if ($this->_tpl_vars['mess_maxRecords'] == 5): ?>selected="selected"<?php endif; ?>>5</option>
      <option value="10" <?php if ($this->_tpl_vars['mess_maxRecords'] == 10): ?>selected="selected"<?php endif; ?>>10</option>
      <option value="20" <?php if ($this->_tpl_vars['mess_maxRecords'] == 20): ?>selected="selected"<?php endif; ?>>20</option>
      <option value="30" <?php if ($this->_tpl_vars['mess_maxRecords'] == 30): ?>selected="selected"<?php endif; ?>>30</option>
      <option value="40" <?php if ($this->_tpl_vars['mess_maxRecords'] == 40): ?>selected="selected"<?php endif; ?>>40</option>
      <option value="50" <?php if ($this->_tpl_vars['mess_maxRecords'] == 50): ?>selected="selected"<?php endif; ?>>50</option>
    </select>
  </td>
</tr>
<tr>
  <td class="form">Permitir mensagens de outr@s usuári@s</td>
  <td class="form"><input type="checkbox" name="allowMsgs" <?php if ($this->_tpl_vars['allowMsgs'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
</tr>
<tr>
  <td class="form">Notificar o autor quando ler o e-mail dele</td>
  <td class="form"><input type="checkbox" name="mess_sendReadStatus" <?php if ($this->_tpl_vars['mess_sendReadStatus'] == 'y'): ?>checked="checked"<?php endif; ?>/></td>
</tr>
<tr>
  <td class="form">Envie-me um email para mensagens com prioridade igual ou maior que:</td>
  <td class="form">
    <select name="minPrio">
      <option value="1" <?php if ($this->_tpl_vars['minPrio'] == 1): ?>selected="selected"<?php endif; ?>>1 -Mínima-</option>
      <option value="2" <?php if ($this->_tpl_vars['minPrio'] == 2): ?>selected="selected"<?php endif; ?>>2 -Baixa-</option>
      <option value="3" <?php if ($this->_tpl_vars['minPrio'] == 3): ?>selected="selected"<?php endif; ?>>3 -Normal-</option>
      <option value="4" <?php if ($this->_tpl_vars['minPrio'] == 4): ?>selected="selected"<?php endif; ?>>4 -Alta-</option>
      <option value="5" <?php if ($this->_tpl_vars['minPrio'] == 5): ?>selected="selected"<?php endif; ?>>5 -Máxima-</option>
      <option value="6" <?php if ($this->_tpl_vars['minPrio'] == 6): ?>selected="selected"<?php endif; ?>>nenhum</option>
    </select>
  </td>
</tr>
<tr>
  <td class="form">Arquivar automaticamente mensagens lidas depois de x dias</td>
  <td class="form">
    <select name="mess_archiveAfter">
      <option value="0" <?php if ($this->_tpl_vars['mess_archiveAfter'] == 0): ?>selected="selected"<?php endif; ?>>nunca</option>
      <option value="1" <?php if ($this->_tpl_vars['mess_archiveAfter'] == 1): ?>selected="selected"<?php endif; ?>>1</option>
      <option value="2" <?php if ($this->_tpl_vars['mess_archiveAfter'] == 2): ?>selected="selected"<?php endif; ?>>2</option>
      <option value="5" <?php if ($this->_tpl_vars['mess_archiveAfter'] == 5): ?>selected="selected"<?php endif; ?>>5</option>
      <option value="10" <?php if ($this->_tpl_vars['mess_archiveAfter'] == 10): ?>selected="selected"<?php endif; ?>>10</option>
      <option value="20" <?php if ($this->_tpl_vars['mess_archiveAfter'] == 20): ?>selected="selected"<?php endif; ?>>20</option>
      <option value="30" <?php if ($this->_tpl_vars['mess_archiveAfter'] == 30): ?>selected="selected"<?php endif; ?>>30</option>
      <option value="40" <?php if ($this->_tpl_vars['mess_archiveAfter'] == 40): ?>selected="selected"<?php endif; ?>>40</option>
      <option value="50" <?php if ($this->_tpl_vars['mess_archiveAfter'] == 50): ?>selected="selected"<?php endif; ?>>50</option>
      <option value="60" <?php if ($this->_tpl_vars['mess_archiveAfter'] == 60): ?>selected="selected"<?php endif; ?>>60</option>
    </select>
  </td>
</tr>
<tr>
  <td colspan="2" class="button"><input type="submit" name="messprefs" value="Alterar preferências"></td>
</tr>
</table>
</form>
</div>
</div>

  <?php endif; ?>

<?php if ($this->_tpl_vars['feature_tasks'] == 'y' && $this->_tpl_vars['tiki_p_tasks'] == 'y'): ?>

  <div class="cbox">
  <div class="cbox-title">Tarefas do usuário</div>
  <div class="cbox-data">
        <form action="tiki-user_preferences.php" method="post">
        <input type="hidden" name="view_user" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['userwatch'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/>
<table class="admin">
<tr>
  <td class="form">Tarefas por página</td>
  <td class="form">
    <select name="tasks_maxRecords">
      <option value="2" <?php if ($this->_tpl_vars['tasks_maxRecords'] == 2): ?>selected="selected"<?php endif; ?>>2</option>
      <option value="5" <?php if ($this->_tpl_vars['tasks_maxRecords'] == 5): ?>selected="selected"<?php endif; ?>>5</option>
      <option value="10" <?php if ($this->_tpl_vars['tasks_maxRecords'] == 10): ?>selected="selected"<?php endif; ?>>10</option>
      <option value="20" <?php if ($this->_tpl_vars['tasks_maxRecords'] == 20): ?>selected="selected"<?php endif; ?>>20</option>
      <option value="30" <?php if ($this->_tpl_vars['tasks_maxRecords'] == 30): ?>selected="selected"<?php endif; ?>>30</option>
      <option value="40" <?php if ($this->_tpl_vars['tasks_maxRecords'] == 40): ?>selected="selected"<?php endif; ?>>40</option>
      <option value="50" <?php if ($this->_tpl_vars['tasks_maxRecords'] == 50): ?>selected="selected"<?php endif; ?>>50</option>
    </select>
  </td>
</tr>



<tr>
  <td colspan="2" class="button"><input type="submit" name="tasksprefs" value="Alterar preferências" ></td>
</tr>
</table>
</form>

</div>
</div>

  <?php endif; ?>

  <div class="cbox">
  <div class="cbox-title"><a href="tiki-my_tiki.php">Meu Tiki</a></div>
  <div class="cbox-data">

        <form action="tiki-user_preferences.php" method="post">
        <input type="hidden" name="view_user" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['userwatch'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/>
<table class="admin">

<?php if ($this->_tpl_vars['feature_wiki'] == 'y'): ?>
<tr><td class="form">Minhas páginas</td><td class="form"><input type="checkbox" name="mytiki_pages" <?php if ($this->_tpl_vars['mytiki_pages'] == 'y'): ?>checked="checked"<?php endif; ?> /></td></tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_blogs'] == 'y'): ?>
<tr><td class="form">Meus Blogs</td><td class="form"><input type="checkbox" name="mytiki_blogs" <?php if ($this->_tpl_vars['mytiki_blogs'] == 'y'): ?>checked="checked"<?php endif; ?> /></td></tr>
<?php endif; ?>



<?php if ($this->_tpl_vars['feature_messages'] == 'y' && $this->_tpl_vars['tiki_p_messages'] == 'y'): ?>
<tr><td class="form">Minhas mensagens</td><td class="form"><input type="checkbox" name="mytiki_msgs" <?php if ($this->_tpl_vars['mytiki_msgs'] == 'y'): ?>checked="checked"<?php endif; ?> /></td></tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_tasks'] == 'y' && $this->_tpl_vars['tiki_p_tasks'] == 'y'): ?>
<tr><td class="form">Minhas tarefas</td><td class="form"><input type="checkbox" name="mytiki_tasks" <?php if ($this->_tpl_vars['mytiki_tasks'] == 'y'): ?>checked="checked"<?php endif; ?> /></td></tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_trackers'] == 'y'): ?>
<tr><td class="form">Meus itens</td><td class="form"><input type="checkbox" name="mytiki_items" <?php if ($this->_tpl_vars['mytiki_items'] == 'y'): ?>checked="checked"<?php endif; ?> /></td></tr>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_workflow'] == 'y'): ?>
  <?php if ($this->_tpl_vars['tiki_p_use_workflow'] == 'y'): ?>
    <tr><td class="form">Minha workflow</td><td class="form"><input type="checkbox" name="mytiki_workflow" <?php if ($this->_tpl_vars['mytiki_workflow'] == 'y'): ?>checked="checked"<?php endif; ?> /></td></tr>
  <?php endif; ?>
<?php endif; ?>
<tr>
  <td colspan="2" class="button"><input type="submit" name="mytikiprefs" value="Alterar preferências" /--></td>
</tr>
</table>

</form>

</div>
</div>

</div>

</td>
</tr>
</table>

</div>