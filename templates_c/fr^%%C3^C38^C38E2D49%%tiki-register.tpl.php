<?php /* Smarty version 2.6.18, created on 2011-06-18 09:41:25
         compiled from tiki-register.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'tiki-register.tpl', 42, false),)), $this); ?>
<h2>S'inscrire comme nouvel utilisateur</h2>
<br />
<?php if ($this->_tpl_vars['showmsg'] == 'y'): ?>
<?php echo $this->_tpl_vars['msg']; ?>

<?php elseif ($this->_tpl_vars['notrecognized'] == 'y'): ?>
Votre adresse électronique ne peut pas être validée, vérifier qu'il est correct et cliquer sur S'inscrire.<br />
<form action="tiki-register.php" method="post">
<input type="text" name="email" value="<?php echo $this->_tpl_vars['email']; ?>
"/>
<input type="hidden" name="name" value="<?php echo $this->_tpl_vars['login']; ?>
"/>
<input type="hidden" name="pass" value="<?php echo $this->_tpl_vars['password']; ?>
"/>
<input type="hidden" name="novalidation" value="yes"/>
<input type="submit" name="register" value="s'inscrire" />
</form>
<?php else: ?>
<?php if ($this->_tpl_vars['rnd_num_reg'] == 'y'): ?>
<small>Votre code d'enregistrement :</small>
<img src="tiki-random_num_img.php" alt='Image choisie au hasard'/>
<br />
<?php endif; ?>
<form action="tiki-register.php" method="post"> <br />
<table class="normal">
<tr><td class="formcolor">Nom d'utilisateur:</td><td class="formcolor"><input type="text" name="name" /></td></tr>
<?php if ($this->_tpl_vars['useRegisterPasscode'] == 'y'): ?>
<tr><td class="formcolor">Passcode pour s'inscrire (pas votre mot de passe d'utilisateur):</td><td class="formcolor"><input type="password" name="passcode" /></td></tr>
<?php endif; ?>
<?php if ($this->_tpl_vars['rnd_num_reg'] == 'y'): ?>
<tr><td class="formcolor">Code d'enregistrement:</td>
<td class="formcolor"><input type="text" maxlength="8" size="8" name="regcode" /></td></tr>
<?php endif; ?>

<tr><td class="formcolor">Mot de passe:</td><td class="formcolor"><input id='pass1' type="password" name="pass" /></td></tr>

<tr><td class="formcolor">Encore:</td><td class="formcolor"><input id='pass2' type="password" name="passAgain" /></td></tr>

<tr><td class="formcolor">Adresse électronique:</td><td class="formcolor"><input type="text" name="email" />
<?php if ($this->_tpl_vars['validateUsers'] == 'y' && $this->_tpl_vars['validateEmail'] != 'y'): ?><br />Une adresse électronique valide est nécessaire pour s'inscrire.<br /><br />
Remarque: Soyez sûr de mettre ce domaine en liste blanche pour empêcher<br />que les emails d'enregistrement ne soient pas mis à part par le filtre de spam!
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

<tr><td  class="formcolor">&nbsp;</td><td class="formcolor"><input type="submit" name="register" value="s'inscrire" /></td></tr>

</table>
</form>
<br />
<table class="normal">
<tr><td class="formcolor"><a class="link" href="javascript:genPass('genepass','pass1','pass2');">Générer un mot de passe</a></td>
<td class="formcolor"><input id='genepass' type="text" /></td></tr>
</table>
<?php endif; ?>