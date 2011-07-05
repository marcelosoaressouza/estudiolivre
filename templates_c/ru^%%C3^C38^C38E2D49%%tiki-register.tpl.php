<?php /* Smarty version 2.6.18, created on 2011-06-21 02:54:12
         compiled from tiki-register.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'tiki-register.tpl', 42, false),)), $this); ?>
<h2>Зарегистрироваться, как новый пользователь</h2>
<br />
<?php if ($this->_tpl_vars['showmsg'] == 'y'): ?>
<?php echo $this->_tpl_vars['msg']; ?>

<?php elseif ($this->_tpl_vars['notrecognized'] == 'y'): ?>
Your email could not be validated; make sure you email is correct and click register below.<br />
<form action="tiki-register.php" method="post">
<input type="text" name="email" value="<?php echo $this->_tpl_vars['email']; ?>
"/>
<input type="hidden" name="name" value="<?php echo $this->_tpl_vars['login']; ?>
"/>
<input type="hidden" name="pass" value="<?php echo $this->_tpl_vars['password']; ?>
"/>
<input type="hidden" name="novalidation" value="yes"/>
<input type="submit" name="register" value="регистрация" />
</form>
<?php else: ?>
<?php if ($this->_tpl_vars['rnd_num_reg'] == 'y'): ?>
<small>Ваш код регистрации:</small>
<img src="tiki-random_num_img.php" alt='Случайное изображение'/>
<br />
<?php endif; ?>
<form action="tiki-register.php" method="post"> <br />
<table class="normal">
<tr><td class="formcolor">Имя пользователя:</td><td class="formcolor"><input type="text" name="name" /></td></tr>
<?php if ($this->_tpl_vars['useRegisterPasscode'] == 'y'): ?>
<tr><td class="formcolor">Секретный код для регистрации (не Ваш личный пароль!):</td><td class="formcolor"><input type="password" name="passcode" /></td></tr>
<?php endif; ?>
<?php if ($this->_tpl_vars['rnd_num_reg'] == 'y'): ?>
<tr><td class="formcolor">Код регистрации:</td>
<td class="formcolor"><input type="text" maxlength="8" size="8" name="regcode" /></td></tr>
<?php endif; ?>

<tr><td class="formcolor">Пароль:</td><td class="formcolor"><input id='pass1' type="password" name="pass" /></td></tr>

<tr><td class="formcolor">Снова:</td><td class="formcolor"><input id='pass2' type="password" name="passAgain" /></td></tr>

<tr><td class="formcolor">Email:</td><td class="formcolor"><input type="text" name="email" />
<?php if ($this->_tpl_vars['validateUsers'] == 'y' && $this->_tpl_vars['validateEmail'] != 'y'): ?><br />A valid email is mandatory to register.<br /><br />
NOTE: Make sure to whitelist this domain to prevent<br />registration emails being canned by your spam filter!
<?php endif; ?></td></tr>


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
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>:</td>
<td class="form"><input type="text" name="<?php echo $this->_tpl_vars['customfields'][$this->_sections['ir']['index']]['prefName']; ?>
" value="<?php echo $this->_tpl_vars['customfields'][$this->_sections['ir']['index']]['value']; ?>
" /></td>
    </tr>
<?php endfor; endif; ?>

<tr><td  class="formcolor">&nbsp;</td><td class="formcolor"><input type="submit" name="register" value="регистрация" /></td></tr>

</table>
</form>
<br />
<table class="normal">
<tr><td class="formcolor"><a class="link" href="javascript:genPass('genepass','pass1','pass2');">Создать пароль</a></td>
<td class="formcolor"><input id='genepass' type="text" /></td></tr>
</table>
<?php endif; ?>