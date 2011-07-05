<?php /* Smarty version 2.6.18, created on 2011-06-18 03:57:33
         compiled from styles/bolha/tiki-user_assigned_modules.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-user_assigned_modules.tpl', 1, false),array('function', 'cycle', 'styles/bolha/tiki-user_assigned_modules.tpl', 20, false),array('modifier', 'escape', 'styles/bolha/tiki-user_assigned_modules.tpl', 51, false),)), $this); ?>
<?php echo smarty_function_css(array('only' => "list,tiki-user_preferences"), $this);?>

<div id="userPrefs">
<h1>
	Módulos</a>
</h1>

<a class="linkbut" href="tiki-user_assigned_modules.php?recreate=1">Recuperar valores por defecto</a><br /><br />

<div class="tabcontent">
	<div class="cbox-title">Módulos asignados por el usuario</div>
</div>
<div id="editMods">
	<table  class="normal">
		<tr>
			<td class="heading">Posición</td>
			<td class="heading">Nombre</td>
			<td class="heading">Mover</td>
			<td class="heading">Borrar</td>
		</tr>
		<?php echo smarty_function_cycle(array('values' => "even,odd",'print' => false), $this);?>

		<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['modules_r']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<tr>
				<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
 centerCellCont"><?php echo $this->_tpl_vars['modules_r'][$this->_sections['ix']['index']]['ord']; ?>
</td>
				<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['modules_r'][$this->_sections['ix']['index']]['name']; ?>
</td>
				<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">
				  <a class="link" href="tiki-user_assigned_modules.php?up=<?php echo $this->_tpl_vars['modules_r'][$this->_sections['ix']['index']]['name']; ?>
"><img src='img/icons2/up.gif' alt='subir' title='subir' border='0' /></a>
				  <a class="link" href="tiki-user_assigned_modules.php?down=<?php echo $this->_tpl_vars['modules_r'][$this->_sections['ix']['index']]['name']; ?>
"><img src='img/icons2/down.gif' alt='bajar' title='bajar' border='0' /></a>
				</td>
				<td class="<?php echo smarty_function_cycle(array(), $this);?>
">
				  <?php if ($this->_tpl_vars['modules_r'][$this->_sections['ix']['index']]['name'] != 'application_menu' && $this->_tpl_vars['modules_r'][$this->_sections['ix']['index']]['name'] != 'login_box' && $this->_tpl_vars['modules_r'][$this->_sections['ix']['index']]['type'] != 'P'): ?>
						<a class="link" href="tiki-user_assigned_modules.php?unassign=<?php echo $this->_tpl_vars['modules_r'][$this->_sections['ix']['index']]['name']; ?>
"><img src='img/icons2/delete.gif' border='0' alt='inhabilitar' title='inhabilitar' /></a> 
				  <?php endif; ?>
				</td>
			</tr>
		<?php endfor; endif; ?>
	</table>
</div>
<?php if ($this->_tpl_vars['canassign'] == 'y'): ?>
	<br />
	<form action="tiki-user_assigned_modules.php" method="post">
	<input type="hidden" name="position" value="right">
<div class="tabcontent">
	<div class="cbox-title">Asignar módulo</div>
</div>
		<table class="normal">
			<tr>
				<td class="formcolor">Módulo:</td>
				<td class="formcolor">
					<select name="module">
						<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['assignables']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['assignables'][$this->_sections['ix']['index']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo $this->_tpl_vars['assignables'][$this->_sections['ix']['index']]['name']; ?>
</option>
						<?php endfor; endif; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="formcolor">Posición:</td>
				<td class="formcolor">
					<select name="order">
						<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['orders']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
							<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['orders'][$this->_sections['ix']['index']])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo $this->_tpl_vars['orders'][$this->_sections['ix']['index']]; ?>
</option>
						<?php endfor; endif; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="formcolor">&nbsp;</td>
				<td class="formcolor"><input type="submit" name="assign" value="asignar" /></td>
			</tr>
		</table>
	</form>
<?php endif; ?>
</div>