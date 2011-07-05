<?php /* Smarty version 2.6.18, created on 2011-04-05 05:31:15
         compiled from styles/bolha/tiki-poll.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-poll.tpl', 1, false),array('modifier', 'escape', 'styles/bolha/tiki-poll.tpl', 6, false),array('modifier', 'replace', 'styles/bolha/tiki-poll.tpl', 23, false),array('block', 'tr', 'styles/bolha/tiki-poll.tpl', 8, false),)), $this); ?>
<?php echo smarty_function_css(array(), $this);?>

<strong><?php echo $this->_tpl_vars['menu_info']['title']; ?>
</strong>
<br/>

<form method="post" action="<?php echo $this->_tpl_vars['ownurl']; ?>
">
	<input type="hidden" name="polls_pollId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['menu_info']['pollId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['channels']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	  <input type="radio" name="polls_optionId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['channels'][$this->_sections['ix']['index']]['optionId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['channels'][$this->_sections['ix']['index']]['title']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br />
	<?php endfor; endif; ?>
	<?php if ($this->_tpl_vars['tiki_p_vote_poll'] == 'y'): ?>
	<center>
		<input type="submit" name="pollVote" value="votar" />
	</center>
</form>
	<?php else: ?>
</form>
<center>
	<input type="submit" onclick="showLightbox('precisaLogar'); return false;" value="votar" />
</center>
<div id="precisaLogar" style="display:none;width:200px;">
	Para votar é necessário se <a href="tiki-register.php">cadastrar</a> no site.<br><br>
	Se for cadastrado, efetue o login:<br>
    <form id="uLoginBox" action="tiki-login.php" method="post"><input type="hidden" name="redirect" value="tiki-index.php?page=<?php echo $this->_tpl_vars['page']; ?>
"><input class="uText" type="text" name="user" id="login-user" size="12" value="usuári@" onFocus="this.value=null"/><input class="uText" type="text" name="pass" id="login-pass" size="10" value="senha" onFocus="this.value=null;this.type='password'"/><input type="image" name="login" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iLogin.png" />
    <div id="uLoginOptions">
        <a href="tiki-remind_password.php">&raquo; recuperar senha</a><br>
    </div>
    </form>
</div>
<?php endif; ?>
<center>
	<a class="linkmodule" href="tiki-poll_results.php?pollId=<?php echo $this->_tpl_vars['menu_info']['pollId']; ?>
">Ver Resultados</a><br />
	(Votos: <?php echo $this->_tpl_vars['menu_info']['votes']; ?>
)
	<?php if ($this->_tpl_vars['feature_poll_comments'] && $this->_tpl_vars['comments']): ?><br />(<a href="tiki-poll_results.php?pollId=<?php echo $this->_tpl_vars['menu_info']['pollId']; ?>
&amp;comzone=show#comments">Comentários: <?php echo $this->_tpl_vars['comments']; ?>
</a>)<?php endif; ?>
</center>
