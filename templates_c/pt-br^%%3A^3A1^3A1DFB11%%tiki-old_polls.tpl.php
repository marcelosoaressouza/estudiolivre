<?php /* Smarty version 2.6.18, created on 2011-04-04 18:05:46
         compiled from tiki-old_polls.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'tiki-old_polls.tpl', 7, false),array('modifier', 'tiki_short_datetime', 'tiki-old_polls.tpl', 25, false),array('modifier', 'times', 'tiki-old_polls.tpl', 63, false),)), $this); ?>
<h1><a class="pagetitle" href="tiki-old_polls.php">Enquetes</a></h1>
<div align="center">
<table class="findtable">
<tr><td class="findtable">Buscar</td>
   <td class="findtable">
   <form method="get" action="tiki-old_polls.php">
     <input type="text" name="find" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['find'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
     <input type="submit" value="buscar" name="search" />
     <input type="hidden" name="sort_mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['sort_mode'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
   </form>
   </td>
</tr>
</table>
<table class="normal">
<tr>
<td class="heading"><a class="tableheading" href="tiki-old_polls.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'title_desc'): ?>title_asc<?php else: ?>title_desc<?php endif; ?>">Título</a></td>
<td class="heading"><a class="tableheading" href="tiki-old_polls.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'publishDate_desc'): ?>publishDate_asc<?php else: ?>publishDate_desc<?php endif; ?>">Publicado</a></td>
<td class="heading"><a class="tableheading" href="tiki-old_polls.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'votes_desc'): ?>votes_asc<?php else: ?>votes_desc<?php endif; ?>">Votos</a></td>
<td class="heading">Ação</td>
</tr>
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
<?php if ($this->_sections['changes']['index'] % 2): ?>
<td class="odd">&nbsp;<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['title']; ?>
&nbsp;</td>
<td class="odd">&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['publishDate'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>
&nbsp;</td>
<td class="odd">&nbsp;<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['votes']; ?>
&nbsp;</td>
<td class="odd">
<a class="link" href="tiki-poll_results.php?pollId=<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['pollId']; ?>
">Resultados</a>
<?php if ($this->_tpl_vars['tiki_p_vote_poll'] != 'n'): ?>
	<a class="link" href="tiki-poll_form.php?pollId=<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['pollId']; ?>
">Votar</a>
<?php endif; ?>
</td>
<?php else: ?>
<td class="even">&nbsp;<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['title']; ?>
&nbsp;</td>
<td class="even">&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['publishDate'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>
&nbsp;</td>
<td class="even">&nbsp;<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['votes']; ?>
&nbsp;</td>
<td class="even">
<a class="link" href="tiki-poll_results.php?pollId=<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['pollId']; ?>
">Resultados</a>
<?php if ($this->_tpl_vars['tiki_p_vote_poll'] != 'n'): ?>
	<a class="link" href="tiki-poll_form.php?pollId=<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['pollId']; ?>
">Votar</a>
<?php endif; ?>
</td>
<?php endif; ?>
</tr>
<?php endfor; else: ?>
<tr><td colspan="6">
<b>Nenhum registro encontrado</b>
</td></tr>
<?php endif; ?>
</table>
<br />
<div class="mini">
<?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
[<a class="prevnext" href="tiki-old_polls.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">ant</a>]&nbsp;
<?php endif; ?>
Página: <?php echo $this->_tpl_vars['actual_page']; ?>
/<?php echo $this->_tpl_vars['cant_pages']; ?>

<?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
&nbsp;[<a class="prevnext" href="tiki-old_polls.php?find=<?php echo $this->_tpl_vars['find']; ?>
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
<a class="prevnext" href="tiki-old_polls.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['selector_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
<?php echo $this->_sections['foo']['index_next']; ?>
</a>&nbsp;
<?php endfor; endif; ?>
<?php endif; ?>

</div>
</div>