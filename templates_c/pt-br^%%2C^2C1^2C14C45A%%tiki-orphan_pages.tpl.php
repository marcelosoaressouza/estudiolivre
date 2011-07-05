<?php /* Smarty version 2.6.18, created on 2011-04-07 03:12:26
         compiled from tiki-orphan_pages.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'tiki-orphan_pages.tpl', 8, false),array('modifier', 'truncate', 'tiki-orphan_pages.tpl', 60, false),array('modifier', 'tiki_short_datetime', 'tiki-orphan_pages.tpl', 70, false),array('modifier', 'userlink', 'tiki-orphan_pages.tpl', 73, false),array('modifier', 'kbsize', 'tiki-orphan_pages.tpl', 112, false),array('modifier', 'times', 'tiki-orphan_pages.tpl', 135, false),array('function', 'cycle', 'tiki-orphan_pages.tpl', 56, false),)), $this); ?>


<h1><a href="tiki-orphan_pages.php" class="pagetitle">Páginas Órfãs</a></h1>
<table class="findtable">
<tr><td class="findtitle">Buscar</td>
   <td class="findtitle">
   <form method="get" action="tiki-orphan_pages.php">
     <input type="text" name="find" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['find'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
     <input type="submit" name="search" value="buscar" />
     <input type="hidden" name="sort_mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['sort_mode'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
   </form>
   </td>
</tr>
</table>
<div align="center">
<table class="normal">
<tr>
<?php if ($this->_tpl_vars['wiki_list_name'] == 'y'): ?>
	<td class="heading"><a class="tableheading" href="tiki-orphan_pages.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'pageName_desc'): ?>pageName_asc<?php else: ?>pageName_desc<?php endif; ?>">Página</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_hits'] == 'y'): ?>
	<td class="heading"><a class="tableheading" href="tiki-orphan_pages.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'hits_desc'): ?>hits_asc<?php else: ?>hits_desc<?php endif; ?>">Visitas</a></td>
<?php endif; ?>	
<?php if ($this->_tpl_vars['wiki_list_lastmodif'] == 'y'): ?>
	<td class="heading"><a class="tableheading" href="tiki-orphan_pages.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'lastModif_desc'): ?>lastModif_asc<?php else: ?>lastModif_desc<?php endif; ?>">Última alteração</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_creator'] == 'y'): ?>
	<td class="heading"><a class="tableheading" href="tiki-orphan_pages.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'creator_desc'): ?>creator_asc<?php else: ?>creator_desc<?php endif; ?>">Criador</a></td>
<?php endif; ?>	

<?php if ($this->_tpl_vars['wiki_list_user'] == 'y'): ?>
	<td class="heading"><a class="tableheading" href="tiki-orphan_pages.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'user_desc'): ?>user_asc<?php else: ?>user_desc<?php endif; ?>">Último autor</a></td>
<?php endif; ?>	
<?php if ($this->_tpl_vars['wiki_list_lastver'] == 'y'): ?>
	<td class="heading"><a class="tableheading" href="tiki-orphan_pages.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'version_desc'): ?>version_asc<?php else: ?>version_desc<?php endif; ?>">Última versão</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_comment'] == 'y'): ?>
	<td class="heading"><a class="tableheading" href="tiki-orphan_pages.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'comment_desc'): ?>comment_asc<?php else: ?>comment_desc<?php endif; ?>">Com</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_status'] == 'y'): ?>
	<td class="heading"><a class="tableheading" href="tiki-orphan_pages.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'flag_desc'): ?>flag_asc<?php else: ?>flag_desc<?php endif; ?>">Estado</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_versions'] == 'y'): ?>
	<td class="heading"><a class="tableheading" href="tiki-orphan_pages.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'versions_desc'): ?>versions_asc<?php else: ?>versions_desc<?php endif; ?>">Vers</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_links'] == 'y'): ?>
	<td class="heading"><a class="tableheading" href="tiki-orphan_pages.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'links_desc'): ?>links_asc<?php else: ?>links_desc<?php endif; ?>">Links</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_backlinks'] == 'y'): ?>
	<td class="heading"><a class="tableheading" href="tiki-orphan_pages.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'backlinks_desc'): ?>backlinks_asc<?php else: ?>backlinks_desc<?php endif; ?>">Referências</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_size'] == 'y'): ?>
	<td class="heading"><a class="tableheading" href="tiki-orphan_pages.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'size_desc'): ?>size_asc<?php else: ?>size_desc<?php endif; ?>">Tamanho</a></td>
<?php endif; ?>
</tr>
<?php echo smarty_function_cycle(array('values' => "even,odd",'print' => false), $this);?>

<?php unset($this->_sections['changes']);
$this->_sections['changes']['name'] = 'changes';
$this->_sections['changes']['loop'] = is_array($_loop=$this->_tpl_vars['listpages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<tr>
<?php if ($this->_tpl_vars['wiki_list_name'] == 'y'): ?>
	<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><a href="tiki-index.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" class="link" title="<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['pageName']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['pageName'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "...", true) : smarty_modifier_truncate($_tmp, 20, "...", true)); ?>
</a>
	<?php if ($this->_tpl_vars['tiki_p_edit'] == 'y'): ?>
	<br />(<a class="link" href="tiki-editpage.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
">editar</a>)
	<?php endif; ?>
	</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_hits'] == 'y'): ?>	
	<td style="text-align:right;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['hits']; ?>
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_lastmodif'] == 'y'): ?>
	<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['lastModif'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_creator'] == 'y'): ?>
	<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['creator'])) ? $this->_run_mod_handler('userlink', true, $_tmp) : smarty_modifier_userlink($_tmp)); ?>
</td>
<?php endif; ?>

<?php if ($this->_tpl_vars['wiki_list_user'] == 'y'): ?>
	<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['user'])) ? $this->_run_mod_handler('userlink', true, $_tmp) : smarty_modifier_userlink($_tmp)); ?>
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_lastver'] == 'y'): ?>
	<td style="text-align:right;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['version']; ?>
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_comment'] == 'y'): ?>
	<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['comment']; ?>
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_status'] == 'y'): ?>
	<td style="text-align:center;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">
	<?php if ($this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['flag'] == 'locked'): ?>
		<img src='img/icons/lock_topic.gif' alt='travada' />
	<?php else: ?>
		<img src='img/icons/unlock_topic.gif' alt='destravada' />
	<?php endif; ?>
	</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_versions'] == 'y'): ?>
	<?php if ($this->_tpl_vars['feature_history'] == 'y' && $this->_tpl_vars['tiki_p_wiki_view_history'] == 'y'): ?>
	<td style="text-align:right;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><a class="link" href="tiki-pagehistory.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['versions']; ?>
</a></td>
	<?php else: ?>
	<td style="text-align:right;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['versions']; ?>
</td>
	<?php endif; ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_links'] == 'y'): ?>
	<td style="text-align:right;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['links']; ?>
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_backlinks'] == 'y'): ?>
	<?php if ($this->_tpl_vars['feature_backlinks'] == 'y'): ?>
	<td style="text-align:right;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><a class="link" href="tiki-backlinks.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['backlinks']; ?>
</a></td>
	<?php else: ?>
	<td style="text-align:right;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['backlinks']; ?>
</td>
	<?php endif; ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['wiki_list_size'] == 'y'): ?>
	<td style="text-align:right;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['len'])) ? $this->_run_mod_handler('kbsize', true, $_tmp) : smarty_modifier_kbsize($_tmp)); ?>
</td>
<?php endif; ?>
       <?php echo smarty_function_cycle(array('print' => false), $this);?>

</tr>
<?php endfor; else: ?>
<tr><td colspan="16">
<b>Nenhum registro encontrado</b>
</td></tr>
<?php endif; ?>
</table>
<br />
<!--
<div class="mini">
<?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
[<a class="prevnext" href="tiki-orphan_pages.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">ant</a>]
<?php endif; ?>
Página: <?php echo $this->_tpl_vars['actual_page']; ?>
/<?php echo $this->_tpl_vars['cant_pages']; ?>

<?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
[<a class="prevnext" href="tiki-orphan_pages.php?find=<?php echo $this->_tpl_vars['find']; ?>
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
<a class="prevnext" href="tiki-orphan_pages.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['selector_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
<?php echo $this->_sections['foo']['index_next']; ?>
</a>
<?php endfor; endif; ?>
<?php endif; ?>
</div>
-->
</div>