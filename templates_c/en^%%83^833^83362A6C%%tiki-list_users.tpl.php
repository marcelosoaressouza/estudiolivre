<?php /* Smarty version 2.6.18, created on 2011-04-04 19:55:05
         compiled from styles/bolha/tiki-list_users.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-list_users.tpl', 1, false),array('function', 'cycle', 'styles/bolha/tiki-list_users.tpl', 69, false),array('block', 'tooltip', 'styles/bolha/tiki-list_users.tpl', 32, false),array('block', 'tr', 'styles/bolha/tiki-list_users.tpl', 93, false),array('modifier', 'replace', 'styles/bolha/tiki-list_users.tpl', 34, false),array('modifier', 'date_format', 'styles/bolha/tiki-list_users.tpl', 99, false),array('modifier', 'times', 'styles/bolha/tiki-list_users.tpl', 128, false),)), $this); ?>
<?php echo smarty_function_css(array('only' => 'list'), $this);?>


<div id="users">
<h1>
	<?php if (! $this->_tpl_vars['find']): ?>
		Lista de usuári@s
	<?php else: ?>
		Busca de usuári@s	
	<?php endif; ?>
</h1>

<h5>
	<?php echo $this->_tpl_vars['cant_users']; ?>

		<?php if (! $this->_tpl_vars['find']): ?>
			users registered
		<?php else: ?>
			resultado<?php if ($this->_tpl_vars['cant_users'] > 1): ?>s<?php endif; ?> para "<?php echo $this->_tpl_vars['find']; ?>
"<br>
			Veja <a href="tiki-list_users.php">a lista de todos os usuári@s</a>.
		<?php endif; ?>
</h5>



			
			
<table width="100%">
	<tr>
		<td class="heading">
				Avatar
		</td>
		<td class="heading">
			<?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique para que a listagem seja por <b>ordem alfabética</b> de nome de usuári@")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<a href="tiki-list_users.php?<?php if ($this->_tpl_vars['find']): ?>find=<?php echo $this->_tpl_vars['find']; ?>
&amp;<?php endif; ?>offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'login_desc'): ?>login_asc<?php else: ?>login_desc<?php endif; ?>" class="userlistheading">
				<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'login_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'login_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">
				User
			</a>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</td>
		<td class="heading">
			<?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique para que a listagem seja por <b>ordem alfabética</b> de nome completo")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<a class="userlistheading" href="tiki-list_users.php?<?php if ($this->_tpl_vars['find']): ?>find=<?php echo $this->_tpl_vars['find']; ?>
&amp;<?php endif; ?>offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'realName_desc'): ?>realName_asc<?php else: ?>realName_desc<?php endif; ?>">
				<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'realName_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'realName_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">
				Real Name
			</a>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</td>
		
		<td class="heading">
			<?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique para que a listagem seja por <b>ordem alfabética</b> de localização")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<a class="userlistheading" href="tiki-list_users.php?<?php if ($this->_tpl_vars['find']): ?>find=<?php echo $this->_tpl_vars['find']; ?>
&amp;<?php endif; ?>offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'local_desc'): ?>local_asc<?php else: ?>local_desc<?php endif; ?>">
				<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'local_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'local_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">
				Localização
			</a>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		</td>
		<td class="heading">
			<?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique para que a listagem seja por <b>ordem cronológica</b> de filiação ao site")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<a class="userlistheading" href="tiki-list_users.php?<?php if ($this->_tpl_vars['find']): ?>find=<?php echo $this->_tpl_vars['find']; ?>
&amp;<?php endif; ?>offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'registrationDate_asc'): ?>registrationDate_desc<?php else: ?>registrationDate_asc<?php endif; ?>">
					<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'registrationDate_asc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'score_desc' || $this->_tpl_vars['sort_mode'] == 'registrationDate_desc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">
					Membro desde
				</a>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>				
		</td>		



	</tr>
	<?php unset($this->_sections['changes']);
$this->_sections['changes']['name'] = 'changes';
$this->_sections['changes']['loop'] = is_array($_loop=$this->_tpl_vars['listusers']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['changes']['show'] = true;
$this->_sections['changes']['max'] = $this->_sections['changes']['loop'];
$this->_sections['changes']['step'] = 1;
$this->_sections['changes']['start'] = $this->_sections['changes']['step'] > 0 ? 0 : $this->_sections['changes']['loop']-1;
if ($this->_sections['changes']['show']) {
    $this->_sections['changes']['total'] = $this->_sections['changes']['loop'];
    if ($this->_sections['changes']['total'] == 0)
        $this->_sections['changes']['show'] = false;
} else
    $this->_sections['changes']['total'] = 0;
if ($this->_sections['changes']['show']):

            for ($this->_sections['changes']['index'] = $this->_sections['changes']['start'], $this->_sections['changes']['iteration'] = 1;
                 $this->_sections['changes']['iteration'] <= $this->_sections['changes']['total'];
                 $this->_sections['changes']['index'] += $this->_sections['changes']['step'], $this->_sections['changes']['iteration']++):
$this->_sections['changes']['rownum'] = $this->_sections['changes']['iteration'];
$this->_sections['changes']['index_prev'] = $this->_sections['changes']['index'] - $this->_sections['changes']['step'];
$this->_sections['changes']['index_next'] = $this->_sections['changes']['index'] + $this->_sections['changes']['step'];
$this->_sections['changes']['first']      = ($this->_sections['changes']['iteration'] == 1);
$this->_sections['changes']['last']       = ($this->_sections['changes']['iteration'] == $this->_sections['changes']['total']);
?>
	<?php echo smarty_function_cycle(array('values' => "odd,even",'assign' => 'currentClass','print' => false), $this);?>

		<tr class="<?php echo $this->_tpl_vars['currentClass']; ?>
">
			<td class="foto">
				<a href="el-user.php?view_user=<?php echo $this->_tpl_vars['listusers'][$this->_sections['changes']['index']]['login']; ?>
">
					<img src="tiki-show_user_avatar.php?user=<?php echo $this->_tpl_vars['listusers'][$this->_sections['changes']['index']]['login']; ?>
" width=50 height=50/>
				</a>
			</td>
			<td>
				<a href="el-user.php?view_user=<?php echo $this->_tpl_vars['listusers'][$this->_sections['changes']['index']]['login']; ?>
">
					<?php echo $this->_tpl_vars['listusers'][$this->_sections['changes']['index']]['login']; ?>

				</a>
			</td>
			
			<td>
				<?php echo $this->_tpl_vars['listusers'][$this->_sections['changes']['index']]['realName']; ?>

			</td>
			
			<?php if ($this->_tpl_vars['feature_score'] == 'y'): ?>
			   <td class="odd">&nbsp;<?php echo $this->_tpl_vars['listusers'][$this->_sections['changes']['index']]['score']; ?>
&nbsp;</td>
			<?php endif; ?>
			
			
			
			<td>
				<?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['listuserscountry'][$this->_sections['changes']['index']]; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			</td>
  			
  			
			 <td>
			 	<?php $this->assign('listusersreg', $this->_tpl_vars['listusers'][$this->_sections['changes']['index']]['registrationDate']); ?>
				 <?php echo ((is_array($_tmp=$this->_tpl_vars['listusersreg'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y") : smarty_modifier_date_format($_tmp, "%d/%m/%Y")); ?>

			 </td>
		</tr>
	<?php endfor; else: ?>
		<tr>
			<td colspan="6">
				<b>No records found</b>
			</td>
		</tr>
	<?php endif; ?>
</table>
<br />
<div class="paginacao">
	<?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
		<a class="userprevnext" href="tiki-list_users.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
			<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyLeft.png">
		</a>
	<?php endif; ?>
	
	Page <?php echo $this->_tpl_vars['actual_page']; ?>
 de <?php echo $this->_tpl_vars['cant_pages']; ?>

	
	<?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
		<a class="userprevnext" href="tiki-list_users.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['next_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
			<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyRight.png">
		</a>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['direct_pagination'] == 'y'): ?>
		<br />
		<?php unset($this->_sections['foo']);
$this->_sections['foo']['loop'] = is_array($_loop=$this->_tpl_vars['cant_pages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['show'] = true;
$this->_sections['foo']['max'] = $this->_sections['foo']['loop'];
$this->_sections['foo']['step'] = 1;
$this->_sections['foo']['start'] = $this->_sections['foo']['step'] > 0 ? 0 : $this->_sections['foo']['loop']-1;
if ($this->_sections['foo']['show']) {
    $this->_sections['foo']['total'] = $this->_sections['foo']['loop'];
    if ($this->_sections['foo']['total'] == 0)
        $this->_sections['foo']['show'] = false;
} else
    $this->_sections['foo']['total'] = 0;
if ($this->_sections['foo']['show']):

            for ($this->_sections['foo']['index'] = $this->_sections['foo']['start'], $this->_sections['foo']['iteration'] = 1;
                 $this->_sections['foo']['iteration'] <= $this->_sections['foo']['total'];
                 $this->_sections['foo']['index'] += $this->_sections['foo']['step'], $this->_sections['foo']['iteration']++):
$this->_sections['foo']['rownum'] = $this->_sections['foo']['iteration'];
$this->_sections['foo']['index_prev'] = $this->_sections['foo']['index'] - $this->_sections['foo']['step'];
$this->_sections['foo']['index_next'] = $this->_sections['foo']['index'] + $this->_sections['foo']['step'];
$this->_sections['foo']['first']      = ($this->_sections['foo']['iteration'] == 1);
$this->_sections['foo']['last']       = ($this->_sections['foo']['iteration'] == $this->_sections['foo']['total']);
?>
			<?php $this->assign('selector_offset', ((is_array($_tmp=$this->_sections['foo']['index'])) ? $this->_run_mod_handler('times', true, $_tmp, $this->_tpl_vars['maxRecords']) : smarty_modifier_times($_tmp, $this->_tpl_vars['maxRecords']))); ?>
				<a class="prevnext" href="tiki-list_users.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['selector_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
			<?php echo $this->_sections['foo']['index_next']; ?>
</a>
		<?php endfor; endif; ?>
	<?php endif; ?>
</div>
</div>