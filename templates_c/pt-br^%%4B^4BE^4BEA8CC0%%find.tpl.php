<?php /* Smarty version 2.6.18, created on 2011-04-04 21:32:18
         compiled from find.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'find.tpl', 10, false),array('modifier', 'escape', 'find.tpl', 12, false),)), $this); ?>

<div align="center">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>
">

<?php if (! empty ( $this->_tpl_vars['sort_mode'] )): ?><input type="hidden" name="sort_mode" value="<?php echo $this->_tpl_vars['sort_mode']; ?>
" /><?php endif; ?>
<?php if (! empty ( $this->_tpl_vars['offset'] )): ?><input type="hidden" name="offset" value="<?php echo $this->_tpl_vars['offset']; ?>
" /><?php endif; ?>

<table class="findtable">
<tr>
<td class="findtitle"><?php if (empty ( $this->_tpl_vars['what'] )): ?>Buscar<?php else: ?><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['what']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?></td>
<td class="findtitle">
	<input type="text" name="find" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['find'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	<?php if (isset ( $this->_tpl_vars['exact_match'] )): ?>Correspondência&nbsp;exata<input type="checkbox" name="exact_match" <?php if ($this->_tpl_vars['exact_match'] != 'n'): ?>checked="checked"<?php endif; ?>/><?php endif; ?>
</td>

<?php if (! empty ( $this->_tpl_vars['types'] )): ?>
	<td class="findtitle">
		<select name="type">
		<option value='' <?php if ($this->_tpl_vars['find_type'] == ''): ?>selected="selected"<?php endif; ?>>qualquer tipo</option>
		<?php unset($this->_sections['t']);
$this->_sections['t']['name'] = 't';
$this->_sections['t']['loop'] = is_array($_loop=$this->_tpl_vars['types']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['t']['show'] = true;
$this->_sections['t']['max'] = $this->_sections['t']['loop'];
$this->_sections['t']['step'] = 1;
$this->_sections['t']['start'] = $this->_sections['t']['step'] > 0 ? 0 : $this->_sections['t']['loop']-1;
if ($this->_sections['t']['show']) {
    $this->_sections['t']['total'] = $this->_sections['t']['loop'];
    if ($this->_sections['t']['total'] == 0)
        $this->_sections['t']['show'] = false;
} else
    $this->_sections['t']['total'] = 0;
if ($this->_sections['t']['show']):

            for ($this->_sections['t']['index'] = $this->_sections['t']['start'], $this->_sections['t']['iteration'] = 1;
                 $this->_sections['t']['iteration'] <= $this->_sections['t']['total'];
                 $this->_sections['t']['index'] += $this->_sections['t']['step'], $this->_sections['t']['iteration']++):
$this->_sections['t']['rownum'] = $this->_sections['t']['iteration'];
$this->_sections['t']['index_prev'] = $this->_sections['t']['index'] - $this->_sections['t']['step'];
$this->_sections['t']['index_next'] = $this->_sections['t']['index'] + $this->_sections['t']['step'];
$this->_sections['t']['first']      = ($this->_sections['t']['iteration'] == 1);
$this->_sections['t']['last']       = ($this->_sections['t']['iteration'] == $this->_sections['t']['total']);
?>
			<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['types'][$this->_sections['t']['index']]['type'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['find_type'] == $this->_tpl_vars['types'][$this->_sections['t']['index']]['type']): ?>selected="selected"<?php endif; ?>><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['types'][$this->_sections['t']['index']]['type']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
		<?php endfor; endif; ?>
		</select>
	</td>
<?php endif; ?>

<?php if (! empty ( $this->_tpl_vars['topics'] )): ?>
	<td class="findtitle">
		<select name="topic">
		<option value='' <?php if ($this->_tpl_vars['find_topic'] == ''): ?>selected="selected"<?php endif; ?>>todos os tópicos</option>
		<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['topics']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['topics'][$this->_sections['ix']['index']]['topicId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['find_topic'] == $this->_tpl_vars['topics'][$this->_sections['ix']['index']]['topicId']): ?>selected="selected"<?php endif; ?>><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['topics'][$this->_sections['ix']['index']]['name']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
		<?php endfor; endif; ?>
		</select>
	</td>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_multilingual'] == 'y'): ?>
	<td class="findtitle">
		<select name="lang">
		<option value='' <?php if ($this->_tpl_vars['find_lang'] == ''): ?>selected="selected"<?php endif; ?>>qualquer idioma</option>
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
" <?php if ($this->_tpl_vars['find_lang'] == $this->_tpl_vars['languages'][$this->_sections['ix']['index']]['value']): ?>selected="selected"<?php endif; ?>><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['languages'][$this->_sections['ix']['index']]['name']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
			<?php endif; ?>
		<?php endfor; endif; ?>
		</select>
	</td>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_categories'] == 'y'): ?>
	<td class="findtitle">
		<select name="categId">
		<option value='' <?php if ($this->_tpl_vars['find_categId'] == ''): ?>selected="selected"<?php endif; ?>>qualquer categoria</option>
		<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['categories']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['find_categId'] == $this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categId']): ?>selected="selected"<?php endif; ?>><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categpath']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></option>
		<?php endfor; endif; ?>
		</select>
	</td>
<?php endif; ?>

<td class="findtitle"><input type="submit" name="search" value="buscar" /></td>
</tr>
</table>

</form>
</div>
 