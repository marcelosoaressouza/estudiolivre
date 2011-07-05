<?php /* Smarty version 2.6.18, created on 2011-05-01 16:01:59
         compiled from tiki-user_information.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'star', 'tiki-user_information.tpl', 12, false),array('modifier', 'tiki_short_datetime', 'tiki-user_information.tpl', 14, false),array('modifier', 'escape', 'tiki-user_information.tpl', 33, false),array('block', 'tr', 'tiki-user_information.tpl', 18, false),)), $this); ?>
<h1><a class="pagetitle" href="tiki-user_information.php?view_user=<?php echo $this->_tpl_vars['userwatch']; ?>
">Личная Информация</a></h1>
<table >
<tr>
  <td valign="top">
  <div class="cbox">
  <div class="cbox-title">Личная Информация</div>
  <div class="cbox-data">
  <div class="simplebox">
  <table>
  <tr><td class="form">Пользователь:</td><td><?php echo $this->_tpl_vars['userinfo']['login']; ?>
<?php if ($this->_tpl_vars['tiki_p_admin'] == 'y'): ?> <a class="link" href="tiki-user_preferences.php?view_user=<?php echo $this->_tpl_vars['userinfo']['login']; ?>
"><IMG SRC="img/icons/config.gif" title="Change user preferences" border="0" /> </a>  <?php endif; ?></td></tr>
<?php if ($this->_tpl_vars['feature_score'] == 'y'): ?>
  <tr><td class="form">Рейтинг:</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['userinfo']['score'])) ? $this->_run_mod_handler('star', true, $_tmp) : smarty_modifier_star($_tmp)); ?>
<?php echo $this->_tpl_vars['userinfo']['score']; ?>
</td></tr>
<?php endif; ?>
  <tr><td class="form">Последний Вход:</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['userinfo']['lastLogin'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>
</td></tr>
<?php if ($this->_tpl_vars['email_isPublic'] != 'n'): ?>  
  <tr><td class="form">Email:</td><td><?php echo $this->_tpl_vars['userinfo']['email']; ?>
</td></tr>
<?php endif; ?>  
  <tr><td class="form">Страна:</td><td><img alt="flag" src="img/flags/<?php echo $this->_tpl_vars['country']; ?>
.gif" /> <?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['country']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td></tr>
  <?php if ($this->_tpl_vars['change_theme'] != 'n'): ?><tr><td class="form">Тема:</td><td><?php echo $this->_tpl_vars['user_style']; ?>
</td></tr><?php endif; ?>
  <?php if ($this->_tpl_vars['change_language'] == 'y'): ?><tr><td  class="form">Есык =):</td><td><?php echo $this->_tpl_vars['user_language']; ?>
</td></tr><?php endif; ?>
  <tr><td class="form">Настоящее Имя:</td><td><?php echo $this->_tpl_vars['realName']; ?>
</td></tr>

  
  <?php unset($this->_sections['ir']);
$this->_sections['ir']['name'] = 'ir';
$this->_sections['ir']['loop'] = is_array($_loop=$this->_tpl_vars['customfields']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ir']['show'] = true;
$this->_sections['ir']['max'] = $this->_sections['ir']['loop'];
$this->_sections['ir']['step'] = 1;
$this->_sections['ir']['start'] = $this->_sections['ir']['step'] > 0 ? 0 : $this->_sections['ir']['loop']-1;
if ($this->_sections['ir']['show']) {
    $this->_sections['ir']['total'] = $this->_sections['ir']['loop'];
    if ($this->_sections['ir']['total'] == 0)
        $this->_sections['ir']['show'] = false;
} else
    $this->_sections['ir']['total'] = 0;
if ($this->_sections['ir']['show']):

            for ($this->_sections['ir']['index'] = $this->_sections['ir']['start'], $this->_sections['ir']['iteration'] = 1;
                 $this->_sections['ir']['iteration'] <= $this->_sections['ir']['total'];
                 $this->_sections['ir']['index'] += $this->_sections['ir']['step'], $this->_sections['ir']['iteration']++):
$this->_sections['ir']['rownum'] = $this->_sections['ir']['iteration'];
$this->_sections['ir']['index_prev'] = $this->_sections['ir']['index'] - $this->_sections['ir']['step'];
$this->_sections['ir']['index_next'] = $this->_sections['ir']['index'] + $this->_sections['ir']['step'];
$this->_sections['ir']['first']      = ($this->_sections['ir']['iteration'] == 1);
$this->_sections['ir']['last']       = ($this->_sections['ir']['iteration'] == $this->_sections['ir']['total']);
?>
    <tr><td class="form"><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['customfields'][$this->_sections['ir']['index']]['prefName']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</td><td><?php echo $this->_tpl_vars['customfields'][$this->_sections['ir']['index']]['value']; ?>
</td></tr>
  <?php endfor; endif; ?>

  <tr><td class="form">Аватара:</td><td><?php echo $this->_tpl_vars['avatar']; ?>
</td></tr>
  <tr><td class="form">Домашняя страница:</td><td><?php if ($this->_tpl_vars['homePage'] != ""): ?><a href="<?php echo $this->_tpl_vars['homePage']; ?>
" class="link" title="Домашняя страница пользователя"><?php echo $this->_tpl_vars['homePage']; ?>
</a><?php endif; ?></td></tr>
<?php if ($this->_tpl_vars['feature_wiki'] == 'y' && $this->_tpl_vars['feature_wiki_userpage'] == 'y'): ?>
  <tr><td class="form">Персональная Wiki-страница:</td><td>
<?php if ($this->_tpl_vars['userPage_exists']): ?>
<a class="link" href="tiki-index.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['feature_wiki_userpage_prefix'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['userinfo']['login'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php echo $this->_tpl_vars['feature_wiki_userpage_prefix']; ?>
<?php echo $this->_tpl_vars['userinfo']['login']; ?>
</a>
<?php elseif ($this->_tpl_vars['user'] == $this->_tpl_vars['userinfo']['login']): ?>
<?php echo $this->_tpl_vars['feature_wiki_userpage_prefix']; ?>
<?php echo $this->_tpl_vars['userinfo']['login']; ?>
<a class="link" href="tiki-editpage.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['feature_wiki_userpage_prefix'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['userinfo']['login'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" title="Создать страницу">?</a>
<?php else: ?>&nbsp;<?php endif; ?>
</td></tr>
<?php endif; ?>
  <tr><td class="form">Часовой пояс:</td><td><?php echo $this->_tpl_vars['display_timezone']; ?>
</td></tr>
<?php if ($this->_tpl_vars['feature_friends'] == 'y' && $this->_tpl_vars['user'] != $this->_tpl_vars['userwatch'] && $this->_tpl_vars['user']): ?>
  <?php if ($this->_tpl_vars['friend']): ?>
  <tr><td class="form">&nbsp;</td><td class="form">
    <img src="img/icons/ico_friend.gif" width="7" height="10" /> This user is your friend
  </td></tr>  
  <?php else: ?>
  <tr><td class="form">&nbsp;</td><td class="form">
    <img src="img/icons/ico_not_friend.png" /> <a class="link" href="tiki-friends.php?request_friendship=<?php echo $this->_tpl_vars['userinfo']['login']; ?>
">Request friendship from this user</a>
  </td></tr>  
  <?php endif; ?>
<?php endif; ?>
  </table>
  </form>
  </div>
  </div>
  </div>
</td></tr>
<?php if ($this->_tpl_vars['user'] && $this->_tpl_vars['feature_messages'] == 'y' && $this->_tpl_vars['tiki_p_messages'] == 'y' && $this->_tpl_vars['allowMsgs'] == 'y'): ?>
<?php if ($this->_tpl_vars['sent']): ?>
<?php echo $this->_tpl_vars['message']; ?>

<?php endif; ?>
<tr>
  <td valign="top">
  <div class="cbox">
  <div class="cbox-title">Отправить мне сообщение</div>
  <div class="cbox-data">
  <div class="simplebox">
  <form method="post" action="tiki-user_information.php" name="f">
  <input type="hidden" name="to" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['userwatch'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
  <input type="hidden" name="view_user" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['userwatch'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
  <table class="normalnoborder">
  <tr>
    <td class="form">Приоритет:</td><td class="form">
    <select name="priority">
      <option value="1" <?php if ($this->_tpl_vars['priority'] == 1): ?>selected="selected"<?php endif; ?>>1 -Низший-</option>
      <option value="2" <?php if ($this->_tpl_vars['priority'] == 2): ?>selected="selected"<?php endif; ?>>2 -Низкий-</option>
      <option value="3" <?php if ($this->_tpl_vars['priority'] == 3): ?>selected="selected"<?php endif; ?>>3 -Обычный-</option>
      <option value="4" <?php if ($this->_tpl_vars['priority'] == 4): ?>selected="selected"<?php endif; ?>>4 -Высокий-</option>
      <option value="5" <?php if ($this->_tpl_vars['priority'] == 5): ?>selected="selected"<?php endif; ?>>5 -Высший-</option>
    </select>
    <input type="submit" name="send" value="отослать" />
    </td>
  </tr>
  <tr>
    <td class="form">Тема:</td><td class="form"><input type="text" name="subject" value="" maxlength="255" style="width:100%;"/></td>
  </tr>
  <tr>
    <td colspan="2" style="text-align: center;" class="form"><textarea rows="20" cols="80" name="body"></textarea></td>
  </tr>
</table>

  
  </form>
  </div>
  </div>
  </div>

  </td>
</tr>  
<?php endif; ?>
</table>
<br /><br />  