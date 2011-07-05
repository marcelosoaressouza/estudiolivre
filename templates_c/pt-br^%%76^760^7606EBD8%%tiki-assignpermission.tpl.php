<?php /* Smarty version 2.6.18, created on 2011-04-04 17:46:47
         compiled from tiki-assignpermission.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'tiki-assignpermission.tpl', 36, false),array('modifier', 'times', 'tiki-assignpermission.tpl', 143, false),array('function', 'html_options', 'tiki-assignpermission.tpl', 59, false),array('function', 'cycle', 'tiki-assignpermission.tpl', 104, false),array('block', 'sortlinks', 'tiki-assignpermission.tpl', 78, false),array('block', 'tr', 'tiki-assignpermission.tpl', 80, false),)), $this); ?>




<h1><a href="tiki-assignpermission.php?group=<?php echo $this->_tpl_vars['group']; ?>
" class="pagetitle">Definir permissões para o grupo: <?php echo $this->_tpl_vars['group']; ?>
</a>
<?php if ($this->_tpl_vars['feature_help'] == 'y'): ?>
<a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Permissions" target="tikihelp" class="tikihelp" title="Editar Artigo">
<img src="img/icons/help.gif" border="0" height="16" width="16" alt='auxílio' /></a>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_view_tpl'] == 'y'): ?>
<a href="tiki-edit_templates.php?template=tiki-assignpermission.tpl" target="tikihelp" class="tikihelp" title="Exibir tpl: editar artigo tpl">
<img src="img/icons/info.gif" border="0" width="16" height="16" alt='editar modelo' /></a>
<?php endif; ?></h1>

<?php if ($this->_tpl_vars['tiki_p_admin'] == 'y'): ?> 
<span class="button2"><a href="tiki-admingroups.php" class="linkbut">Administrar grupos</a></span>
<?php endif; ?>
<span class="button2"><a href="tiki-adminusers.php" class="linkbut">Administrar usuários</a></span>

<br />

<h2>Informações do Grupo</h2>
<table class="normal">
<tr><td class="even">Nome:</td><td class="odd"><?php echo $this->_tpl_vars['group_info']['groupName']; ?>
</td></tr>
<tr><td class="even">Desc:</td><td class="odd"><?php echo $this->_tpl_vars['group_info']['groupDesc']; ?>
</td></tr>
<tr><td class="even">permissões:</td><td class="odd">
<?php unset($this->_sections['grp']);
$this->_sections['grp']['name'] = 'grp';
$this->_sections['grp']['loop'] = is_array($_loop=$this->_tpl_vars['group_info']['perms']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['grp']['show'] = true;
$this->_sections['grp']['max'] = $this->_sections['grp']['loop'];
$this->_sections['grp']['step'] = 1;
$this->_sections['grp']['start'] = $this->_sections['grp']['step'] > 0 ? 0 : $this->_sections['grp']['loop']-1;
if ($this->_sections['grp']['show']) {
    $this->_sections['grp']['total'] = $this->_sections['grp']['loop'];
    if ($this->_sections['grp']['total'] == 0)
        $this->_sections['grp']['show'] = false;
} else
    $this->_sections['grp']['total'] = 0;
if ($this->_sections['grp']['show']):

            for ($this->_sections['grp']['index'] = $this->_sections['grp']['start'], $this->_sections['grp']['iteration'] = 1;
                 $this->_sections['grp']['iteration'] <= $this->_sections['grp']['total'];
                 $this->_sections['grp']['index'] += $this->_sections['grp']['step'], $this->_sections['grp']['iteration']++):
$this->_sections['grp']['rownum'] = $this->_sections['grp']['iteration'];
$this->_sections['grp']['index_prev'] = $this->_sections['grp']['index'] - $this->_sections['grp']['step'];
$this->_sections['grp']['index_next'] = $this->_sections['grp']['index'] + $this->_sections['grp']['step'];
$this->_sections['grp']['first']      = ($this->_sections['grp']['iteration'] == 1);
$this->_sections['grp']['last']       = ($this->_sections['grp']['iteration'] == $this->_sections['grp']['total']);
?>
<?php echo $this->_tpl_vars['group_info']['perms'][$this->_sections['grp']['index']]; ?>
<?php if ($this->_tpl_vars['group_info']['perms'][$this->_sections['grp']['index']] != 'Anonymous'): ?>(<a class="link" href="tiki-assignpermission.php?type=<?php echo $this->_tpl_vars['type']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
&amp;permission=<?php echo $this->_tpl_vars['group_info']['perms'][$this->_sections['grp']['index']]; ?>
&amp;group=<?php echo $this->_tpl_vars['group']; ?>
&amp;action=remove">x</a>)<?php endif; ?>&nbsp;<br />
<?php endfor; endif; ?>
</td></tr>
</table>
<br />
<div class="advanced">recurso avançado: configurar os níveis:
<?php if ($this->_tpl_vars['advanced_features'] != 'y'): ?>
<a href="tiki-assignpermission.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;type=<?php echo $this->_tpl_vars['type']; ?>
&amp;group=<?php echo ((is_array($_tmp=$this->_tpl_vars['group'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
&amp;advanced_features=y">mostrar</a>
<?php else: ?>
<a href="tiki-assignpermission.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;type=<?php echo $this->_tpl_vars['type']; ?>
&amp;group=<?php echo $this->_tpl_vars['group']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">esconder</a>
<?php endif; ?><br /><br />

<div <?php if ($this->_tpl_vars['advanced_features'] != 'y'): ?>style="display:none;"<?php else: ?>style="display:block;"<?php endif; ?>>
<h2>Criar nível</h2>
<form method="post" action="tiki-assignpermission.php">
<input type="hidden" name="group" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['group'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<input type="hidden" name="type" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['type'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
Criar nível: <input type="text" name="level" /><input type="submit" name="createlevel" value="criar" />
</form>
<br />
<br />
<form method="post" action="tiki-assignpermission.php">
<input type="hidden" name="group" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['group'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<input type="hidden" name="type" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['type'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<select name="oper">
<option value="assign">atribuir</option>
<option value="remove">remover</option>
</select>
todas as permissões no nível:
<select name="level">
<?php echo smarty_function_html_options(array('output' => $this->_tpl_vars['levels'],'values' => $this->_tpl_vars['levels'],'selected' => $this->_tpl_vars['perms'][$this->_sections['user']['index']]['level']), $this);?>

</select>
<input type="submit" name="allper" value="atualizar" />
</form>
</div>
</div>
<br />
<a name="assign" ></a>
<h2>Designar Permissões</h2>
<table class="findtable">
<tr><td class="findtable">Buscar</td>
<td class="findtable">
<form method="post" action="tiki-assignpermission.php#assign" name="permselects">
<input type="hidden" name="group" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['group'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
<input type="text" name="find" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['find'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<input type="submit" value="buscar" name="search" />
<input type="hidden" name="sort_mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['sort_mode'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<select name="type" onchange="permselects.submit()">
<option value="">todos</a>
<?php $this->_tag_stack[] = array('sortlinks', array()); $_block_repeat=true;smarty_block_sortlinks($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php unset($this->_sections['v']);
$this->_sections['v']['name'] = 'v';
$this->_sections['v']['loop'] = is_array($_loop=$this->_tpl_vars['types']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['v']['show'] = true;
$this->_sections['v']['max'] = $this->_sections['v']['loop'];
$this->_sections['v']['step'] = 1;
$this->_sections['v']['start'] = $this->_sections['v']['step'] > 0 ? 0 : $this->_sections['v']['loop']-1;
if ($this->_sections['v']['show']) {
    $this->_sections['v']['total'] = $this->_sections['v']['loop'];
    if ($this->_sections['v']['total'] == 0)
        $this->_sections['v']['show'] = false;
} else
    $this->_sections['v']['total'] = 0;
if ($this->_sections['v']['show']):

            for ($this->_sections['v']['index'] = $this->_sections['v']['start'], $this->_sections['v']['iteration'] = 1;
                 $this->_sections['v']['iteration'] <= $this->_sections['v']['total'];
                 $this->_sections['v']['index'] += $this->_sections['v']['step'], $this->_sections['v']['iteration']++):
$this->_sections['v']['rownum'] = $this->_sections['v']['iteration'];
$this->_sections['v']['index_prev'] = $this->_sections['v']['index'] - $this->_sections['v']['step'];
$this->_sections['v']['index_next'] = $this->_sections['v']['index'] + $this->_sections['v']['step'];
$this->_sections['v']['first']      = ($this->_sections['v']['iteration'] == 1);
$this->_sections['v']['last']       = ($this->_sections['v']['iteration'] == $this->_sections['v']['total']);
?>
<option value="<?php echo $this->_tpl_vars['types'][$this->_sections['v']['index']]; ?>
"<?php if ($this->_tpl_vars['type'] == $this->_tpl_vars['types'][$this->_sections['v']['index']]): ?> selected="selected"<?php endif; ?>><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['types'][$this->_sections['v']['index']]; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
<?php endfor; endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_sortlinks($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
</select>
<select name="group" onchange="permselects.submit()">
<?php unset($this->_sections['v']);
$this->_sections['v']['name'] = 'v';
$this->_sections['v']['loop'] = is_array($_loop=$this->_tpl_vars['groups']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['v']['show'] = true;
$this->_sections['v']['max'] = $this->_sections['v']['loop'];
$this->_sections['v']['step'] = 1;
$this->_sections['v']['start'] = $this->_sections['v']['step'] > 0 ? 0 : $this->_sections['v']['loop']-1;
if ($this->_sections['v']['show']) {
    $this->_sections['v']['total'] = $this->_sections['v']['loop'];
    if ($this->_sections['v']['total'] == 0)
        $this->_sections['v']['show'] = false;
} else
    $this->_sections['v']['total'] = 0;
if ($this->_sections['v']['show']):

            for ($this->_sections['v']['index'] = $this->_sections['v']['start'], $this->_sections['v']['iteration'] = 1;
                 $this->_sections['v']['iteration'] <= $this->_sections['v']['total'];
                 $this->_sections['v']['index'] += $this->_sections['v']['step'], $this->_sections['v']['iteration']++):
$this->_sections['v']['rownum'] = $this->_sections['v']['iteration'];
$this->_sections['v']['index_prev'] = $this->_sections['v']['index'] - $this->_sections['v']['step'];
$this->_sections['v']['index_next'] = $this->_sections['v']['index'] + $this->_sections['v']['step'];
$this->_sections['v']['first']      = ($this->_sections['v']['iteration'] == 1);
$this->_sections['v']['last']       = ($this->_sections['v']['iteration'] == $this->_sections['v']['total']);
?>
<option value="<?php echo $this->_tpl_vars['groups'][$this->_sections['v']['index']]['groupName']; ?>
"<?php if ($this->_tpl_vars['group'] == $this->_tpl_vars['groups'][$this->_sections['v']['index']]['groupName']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['groups'][$this->_sections['v']['index']]['groupName']; ?>
</a>
<?php endfor; endif; ?>
</select>
</form>
</td></tr></table>

<form name="tiki-assignpermission.php" method="post">
<input type="hidden" name="group" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['group'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<input type="hidden" name="type" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['type'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<input type="submit" name="update" value="atualizar" /><br />
<table class="normal">
<tr>
<td class="heading">&nbsp;</td>
<td class="heading"><a class="tableheading" href="tiki-assignpermission.php?type=<?php echo $this->_tpl_vars['type']; ?>
&amp;group=<?php echo $this->_tpl_vars['group']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'permName_desc'): ?>permName_asc<?php else: ?>permName_desc<?php endif; ?>">nome</a></td>
<td class="heading" <?php if ($this->_tpl_vars['advanced_features'] != 'y'): ?>style="display:none;"<?php else: ?>style="display:block;"<?php endif; ?>>nível</td>
<td class="heading"><a class="tableheading" href="tiki-assignpermission.php?type=<?php echo $this->_tpl_vars['type']; ?>
&amp;group=<?php echo $this->_tpl_vars['group']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'type_desc'): ?>type_asc<?php else: ?>type_desc<?php endif; ?>">tipo</a></td>
<td class="heading"><a class="tableheading" href="tiki-assignpermission.php?type=<?php echo $this->_tpl_vars['type']; ?>
&amp;group=<?php echo $this->_tpl_vars['group']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'groupDesc_desc'): ?>permDesc_asc<?php else: ?>permDesc_desc<?php endif; ?>">desc</a></td>
</tr>
<?php echo smarty_function_cycle(array('values' => "odd,even",'print' => false), $this);?>

<?php unset($this->_sections['user']);
$this->_sections['user']['name'] = 'user';
$this->_sections['user']['loop'] = is_array($_loop=$this->_tpl_vars['perms']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['user']['show'] = true;
$this->_sections['user']['max'] = $this->_sections['user']['loop'];
$this->_sections['user']['step'] = 1;
$this->_sections['user']['start'] = $this->_sections['user']['step'] > 0 ? 0 : $this->_sections['user']['loop']-1;
if ($this->_sections['user']['show']) {
    $this->_sections['user']['total'] = $this->_sections['user']['loop'];
    if ($this->_sections['user']['total'] == 0)
        $this->_sections['user']['show'] = false;
} else
    $this->_sections['user']['total'] = 0;
if ($this->_sections['user']['show']):

            for ($this->_sections['user']['index'] = $this->_sections['user']['start'], $this->_sections['user']['iteration'] = 1;
                 $this->_sections['user']['iteration'] <= $this->_sections['user']['total'];
                 $this->_sections['user']['index'] += $this->_sections['user']['step'], $this->_sections['user']['iteration']++):
$this->_sections['user']['rownum'] = $this->_sections['user']['iteration'];
$this->_sections['user']['index_prev'] = $this->_sections['user']['index'] - $this->_sections['user']['step'];
$this->_sections['user']['index_next'] = $this->_sections['user']['index'] + $this->_sections['user']['step'];
$this->_sections['user']['first']      = ($this->_sections['user']['iteration'] == 1);
$this->_sections['user']['last']       = ($this->_sections['user']['iteration'] == $this->_sections['user']['total']);
?>
<input type="hidden" name="permName[<?php echo $this->_tpl_vars['perms'][$this->_sections['user']['index']]['permName']; ?>
]" />
<tr>
<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><input type="checkbox" name="perm[<?php echo $this->_tpl_vars['perms'][$this->_sections['user']['index']]['permName']; ?>
]" 
<?php $this->assign('has_inherited_one_perm', 'n'); ?>
<?php $this->assign('has_inherited_perm', ''); ?>
<?php $_from = $this->_tpl_vars['inherited_groups_perms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['gr'] => $this->_tpl_vars['it']):
?>
<?php if ($this->_tpl_vars['it'][$this->_sections['user']['index']]['hasPerm'] == 'y'): ?><?php $this->assign('has_inherited_one_perm', 'y'); ?><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['perms'][$this->_sections['user']['index']]['hasPerm'] == 'y' || $this->_tpl_vars['inherited_from_anon'][$this->_sections['user']['index']]['hasPerm'] == 'y' || $this->_tpl_vars['inherited_from_reg'][$this->_sections['user']['index']]['hasPerm'] == 'y' || $this->_tpl_vars['has_inherited_one_perm'] == 'y'): ?>checked="checked" <?php endif; ?>
<?php if ($this->_tpl_vars['inherited_from_anon'][$this->_sections['user']['index']]['hasPerm'] == 'y' || $this->_tpl_vars['inherited_from_reg'][$this->_sections['user']['index']]['hasPerm'] == 'y' || $this->_tpl_vars['has_inherited_one_perm'] == 'y'): ?>disabled="disabled" <?php endif; ?>/>
</td>
<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['perms'][$this->_sections['user']['index']]['permName']; ?>
</td>
<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
" <?php if ($this->_tpl_vars['advanced_features'] != 'y'): ?>style="display:none;"<?php else: ?>style="display:block;"<?php endif; ?>><select name="level[<?php echo $this->_tpl_vars['perms'][$this->_sections['user']['index']]['permName']; ?>
]"><?php echo smarty_function_html_options(array('output' => $this->_tpl_vars['levels'],'values' => $this->_tpl_vars['levels'],'selected' => $this->_tpl_vars['perms'][$this->_sections['user']['index']]['level']), $this);?>
</select></td>
<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['perms'][$this->_sections['user']['index']]['type']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
<td class="<?php echo smarty_function_cycle(array(), $this);?>
">
<?php if ($this->_tpl_vars['inherited_from_anon'][$this->_sections['user']['index']]['hasPerm'] == 'y'): ?><span style="float:right;font-size:80%;padding:1px 5px;border:1px solid #999;color:#262;background-color:#ada;">herdado de<a href="tiki-assignpermission.php?group=Anonymous"> Anonymous</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['inherited_from_reg'][$this->_sections['user']['index']]['hasPerm'] == 'y'): ?><span style="float:right;font-size:80%;padding:1px 5px;border:1px solid #999;color:#258;background-color:#acd;">herdado de<a href="tiki-assignpermission.php?group=Registered"> Registered</a></span><?php endif; ?>
<?php if ($this->_tpl_vars['has_inherited_one_perm'] == 'y'): ?><span style="float:right;font-size:80%;padding:1px 5px;border:1px solid #999;color:#852;background-color:#dca;">herdado</span><?php endif; ?>
<?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['perms'][$this->_sections['user']['index']]['permDesc']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
</tr>
<?php endfor; endif; ?>
</table>
<input type="submit" name="update" value="atualizar" />
</form>
<br />
<div align="center">
<div class="mini">
<?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
[<a class="prevnext" href="tiki-assignpermission.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;type=<?php echo $this->_tpl_vars['type']; ?>
&amp;group=<?php echo $this->_tpl_vars['group']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">ant</a>]&nbsp;
<?php endif; ?>
Página: <?php echo $this->_tpl_vars['actual_page']; ?>
/<?php echo $this->_tpl_vars['cant_pages']; ?>

<?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
&nbsp;[<a class="prevnext" href="tiki-assignpermission.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;type=<?php echo $this->_tpl_vars['type']; ?>
&amp;group=<?php echo $this->_tpl_vars['group']; ?>
&amp;offset=<?php echo $this->_tpl_vars['next_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">próx</a>]
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
<a class="prevnext" href="tiki-assignpermission.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;type=<?php echo $this->_tpl_vars['type']; ?>
&amp;group=<?php echo $this->_tpl_vars['group']; ?>
&amp;offset=<?php echo $this->_tpl_vars['selector_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
<?php echo $this->_sections['foo']['index_next']; ?>
</a>&nbsp;
<?php endfor; endif; ?>
<?php endif; ?>
</div>
</div>