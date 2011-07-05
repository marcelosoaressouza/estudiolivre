<?php /* Smarty version 2.6.18, created on 2011-06-15 02:11:10
         compiled from tiki-edit_translation.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'tiki-edit_translation.tpl', 1, false),array('modifier', 'count', 'tiki-edit_translation.tpl', 47, false),array('modifier', 'truncate', 'tiki-edit_translation.tpl', 88, false),array('function', 'cycle', 'tiki-edit_translation.tpl', 67, false),array('function', 'html_image', 'tiki-edit_translation.tpl', 72, false),)), $this); ?>
<h1><a href="tiki-edit_translation.php?type=<?php echo $this->_tpl_vars['type']; ?>
&amp;<?php if ($this->_tpl_vars['type'] == 'wiki page'): ?>page=<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
<?php else: ?>id=<?php echo $this->_tpl_vars['id']; ?>
<?php endif; ?>">Editar tradução:&nbsp;<?php echo $this->_tpl_vars['name']; ?>
</a>
<?php if ($this->_tpl_vars['feature_help'] == 'y'): ?>
<a href="<?php echo $this->_tpl_vars['helpurl']; ?>
i18n" target="tikihelp" class="tikihelp" title=" 
editar traduções"><img src="img/icons/help.gif" border="0" height="16" width="16" alt='auxílio' /></a>
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_view_tpl'] == 'y'): ?>
<a href="tiki-edit_templates.php?template=tiki-edit_translation.tpl" target="tikihelp" class="tikihelp" title="Visualizar template: editar traduções template"><img src="img/icons/info.gif" border="0" width="16" height="16" alt='Editar modelo' /></a>
<?php endif; ?>
</h1>

<?php if ($this->_tpl_vars['type'] == 'wiki page'): ?>
	<a href="tiki-index.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" class="linkbut" title="ver">Ver página</a>
<?php else: ?>
	<a href="tiki-read_article.php?articleId=<?php echo $this->_tpl_vars['id']; ?>
" class="linkbut" title="ver">Ver</a>
<?php endif; ?>

<?php if ($this->_tpl_vars['error']): ?>
	<div class="error">
	<?php if ($this->_tpl_vars['error'] == 'traLang'): ?>
		Você precisa especificar o objeto do idioma
	<?php elseif ($this->_tpl_vars['error'] == 'srcExists'): ?>
		O objeto não existe
	<?php elseif ($this->_tpl_vars['error'] == 'srcLang'): ?>
		O objeto não possui um idioma
	<?php elseif ($this->_tpl_vars['error'] == 'alreadyTrad'): ?>
		O objeto já tem uma tradução para esse idioma
	<?php elseif ($this->_tpl_vars['error'] == 'alreadySet'): ?>
		O objeto já está selecionado para traduções
	<?php endif; ?>
	</div>
	<br />
<?php endif; ?>

<form action="tiki-edit_translation.php" method="post">
<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
<input type="hidden" name="type" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['type'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />

<h2>Idioma: <?php echo $this->_tpl_vars['name']; ?>
</h2>
<p>Use essa sessão para definir o idioma da versão que você está trabalhando atualmente.</p>
<table>
<tr>
	<td><select name="langpage" size="1">
	<?php if (! $this->_tpl_vars['langpage'] || $this->_tpl_vars['langpage'] == 'NULL'): ?>
	<option value="">Desconhecido</option>
	<?php endif; ?>
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
	<?php if (in_array ( $this->_tpl_vars['languages'][$this->_sections['ix']['index']]['value'] , $this->_tpl_vars['available_languages'] ) || count($this->_tpl_vars['available_languages']) == 0): ?>
	<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['languages'][$this->_sections['ix']['index']]['value'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"<?php if ($this->_tpl_vars['langpage'] == $this->_tpl_vars['languages'][$this->_sections['ix']['index']]['value']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['languages'][$this->_sections['ix']['index']]['name']; ?>
</option>
	<?php endif; ?>
	<?php endfor; endif; ?></select>
	</td>
	<?php if (count ( trads )): ?>
		<td class="form">
		<input type="submit" value="Salvar" /><br />
		</td>
	<?php endif; ?>
</tr>
</table>
<br />

<?php if (! empty ( $this->_tpl_vars['langpage'] )): ?>
<h2>Espaço das traduções</h2>

<?php if (count($this->_tpl_vars['trads']) > 1): ?>
	<table class="normal">
	<tr><td class="heading">Idioma</td><td class="heading">Página</td><td class="heading">Ações</td></tr>
	<?php echo smarty_function_cycle(array('values' => "odd,even",'print' => false), $this);?>

	<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['trads']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
	<tr class="<?php echo smarty_function_cycle(array(), $this);?>
">
		<td><?php echo $this->_tpl_vars['trads'][$this->_sections['i']['index']]['langName']; ?>
</td>
		<td><?php if ($this->_tpl_vars['type'] == 'wiki page'): ?><a href="tiki-index.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['trads'][$this->_sections['i']['index']]['objName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php else: ?><a href="tiki-read_article.php?articleId=<?php echo ((is_array($_tmp=$this->_tpl_vars['trads'][$this->_sections['i']['index']]['objId'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php endif; ?><?php echo $this->_tpl_vars['trads'][$this->_sections['i']['index']]['objName']; ?>
</a></td>
		<td><a class="link" href="tiki-edit_translation.php?detach&amp;id=<?php echo ((is_array($_tmp=$this->_tpl_vars['id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;srcId=<?php echo ((is_array($_tmp=$this->_tpl_vars['trads'][$this->_sections['i']['index']]['objId'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;type=<?php echo ((is_array($_tmp=$this->_tpl_vars['type'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php echo smarty_function_html_image(array('file' => 'img/icons2/delete.gif','border' => '0','alt' => 'desanexar','title' => 'desanexar'), $this);?>
</a>
	</td></tr>
	<?php endfor; endif; ?>
	</table>
<?php endif; ?>

<?php if (count($this->_tpl_vars['trads']) <= 1): ?>
	<?php if ($this->_tpl_vars['articles']): ?>
		<p>Selecione o artigo para o qual o artigo atual é a tradução.</p>
		Tradução de:&nbsp;
	<?php else: ?>
		<p>Coloque o nome para o qual a página atual é a tradução.</p>
		Tradução de:&nbsp;
	<?php endif; ?>
<?php endif; ?>		
<?php if ($this->_tpl_vars['articles']): ?>
	<select name="srcId"><?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['articles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
?><?php if (! empty ( $this->_tpl_vars['articles'][$this->_sections['ix']['index']]['lang'] ) && $this->_tpl_vars['langpage'] != $this->_tpl_vars['articles'][$this->_sections['ix']['index']]['lang']): ?><option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['articles'][$this->_sections['ix']['index']]['articleId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['articles'][$this->_sections['ix']['index']]['articleId'] == $this->_tpl_vars['srcId']): ?>checked="checked"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['articles'][$this->_sections['ix']['index']]['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 80, "(...)", true) : smarty_modifier_truncate($_tmp, 80, "(...)", true)); ?>
</option><?php endif; ?><?php endfor; endif; ?></select>
<?php else: ?>
	<select name="srcName"><?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['pages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
?><?php if (! empty ( $this->_tpl_vars['pages'][$this->_sections['ix']['index']]['lang'] ) && $this->_tpl_vars['pages'][$this->_sections['ix']['index']]['lang'] != $this->_tpl_vars['langpage']): ?><option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['pages'][$this->_sections['ix']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['pages'][$this->_sections['ix']['index']]['pageName'] == $this->_tpl_vars['srcId']): ?>checked="checked"<?php endif; ?>><?php echo ((is_array($_tmp=$this->_tpl_vars['pages'][$this->_sections['ix']['index']]['pageName'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 80, "(...)", true) : smarty_modifier_truncate($_tmp, 80, "(...)", true)); ?>
</option><?php endif; ?><?php endfor; endif; ?></select>
<?php endif; ?>
&nbsp;
<?php if (count($this->_tpl_vars['trads']) <= 1): ?>
	<input type="submit" class="wikiaction" name="set" value="buscar"/>
<?php else: ?>
	<input type="submit" class="wikiaction" name="set" value="adicionar ao espaço de traduções"/>
<?php endif; ?>
<?php endif; ?>

</form>