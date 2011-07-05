<?php /* Smarty version 2.6.18, created on 2011-04-08 17:29:14
         compiled from tiki-poll_results.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'tiki-poll_results.tpl', 15, false),array('function', 'cycle', 'tiki-poll_results.tpl', 38, false),array('modifier', 'escape', 'tiki-poll_results.tpl', 26, false),array('modifier', 'times', 'tiki-poll_results.tpl', 56, false),)), $this); ?>

<h1><a href="tiki-poll_results.php?pollId=<?php echo $this->_tpl_vars['poll_info']['pollId']; ?>
<?php if (! empty ( $this->_tpl_vars['list_votes'] )): ?>&amp;list=y<?php endif; ?>"><?php echo $this->_tpl_vars['poll_info']['title']; ?>
</a></h1>
<span class="button2"><a href="tiki-old_polls.php" class="linkbut">Outras enquetes</a></span>
<?php if ($this->_tpl_vars['tiki_p_admin_polls'] == 'y'): ?><span class=button2"><a href="tiki-poll_results.php?list=y&amp;pollId=<?php echo $this->_tpl_vars['poll_info']['pollId']; ?>
" class="linkbut">Votos</a></span><?php endif; ?>
<h2>Resultados</h2>
<div class="pollresults">
<table class="pollresults">
<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['options']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<tr><td class="pollr"><?php echo $this->_tpl_vars['options'][$this->_sections['ix']['index']]['title']; ?>
</td>
    <td class="pollr"><img src="img/leftbar.gif" alt="&lt;" /><img src="img/mainbar.gif" alt="-" height="14" width="<?php echo $this->_tpl_vars['options'][$this->_sections['ix']['index']]['width']; ?>
" /><img src="img/rightbar.gif" alt="&gt;" />  <?php echo $this->_tpl_vars['options'][$this->_sections['ix']['index']]['percent']; ?>
% (<?php echo $this->_tpl_vars['options'][$this->_sections['ix']['index']]['votes']; ?>
)</td></tr>
<?php endfor; endif; ?>
</table>
<br />
Total: <?php echo $this->_tpl_vars['poll_info']['votes']; ?>
 votos<br />
<?php if (isset ( $this->_tpl_vars['total'] ) && $this->_tpl_vars['total'] > 0): ?>Average: <?php echo smarty_function_math(array('equation' => "x/y",'x' => $this->_tpl_vars['total'],'y' => $this->_tpl_vars['poll_info']['votes'],'format' => "%.2f"), $this);?>
<?php endif; ?>
<br />
</div>

<?php if (isset ( $this->_tpl_vars['list_votes'] )): ?>
<h2>Listar votos</h2>
<div align="center">
<table class="findtable">
<tr><td class="findtable">Buscar</td>
   <td class="findtable">
   <form method="get" action="tiki-poll_results.php">
     <input type="text" name="find" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['find'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
     <input type="submit" value="buscar" name="search" />
     <input type="hidden" name="sort_mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['sort_mode'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	 <input type="hidden" name="pollId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['poll_info']['pollId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
	 <input type="hidden" name="list" value="y" />
   </form>
   </td>
</tr>
</table>
</div>
<table class="normal">
<tr><td class="heading">usuári@</td><td class="heading">opções</td></tr>
<?php echo smarty_function_cycle(array('values' => "odd,even",'print' => false), $this);?>

<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['list_votes']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<tr><td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['list_votes'][$this->_sections['ix']['index']]['user']; ?>
</td><td class="<?php echo smarty_function_cycle(array(), $this);?>
"><?php echo $this->_tpl_vars['list_votes'][$this->_sections['ix']['index']]['title']; ?>
</td></tr>
<?php endfor; else: ?>
<tr><td colspan="2">Nenhum registro encontrado</td></tr>
<?php endif; ?>
</table>	
<div class="mini" align="center">
<?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
[<a class="prevnext" href="tiki-poll_results.php?list=y&amp;pollId=<?php echo $this->_tpl_vars['poll_info']['pollId']; ?>
&amp;find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">ant</a>]&nbsp;
<?php endif; ?>
Página: <?php echo $this->_tpl_vars['actual_page']; ?>
/<?php echo $this->_tpl_vars['cant_pages']; ?>

<?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
&nbsp;[<a class="prevnext" href="tiki-poll_results.php?list=y&amp;pollId=<?php echo $this->_tpl_vars['poll_info']['pollId']; ?>
&amp;find=<?php echo $this->_tpl_vars['find']; ?>
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
<a class="prevnext" href="tiki-poll_results.php?list=y&amp;pollId=<?php echo $this->_tpl_vars['poll_info']['pollId']; ?>
&amp;find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['selector_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
<?php echo $this->_sections['foo']['index_next']; ?>
</a>&nbsp;
<?php endfor; endif; ?>
<?php endif; ?>

</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_poll_comments'] == 'y' && ( ( $this->_tpl_vars['tiki_p_read_comments'] == 'y' && $this->_tpl_vars['comments_cant'] != 0 ) || $this->_tpl_vars['tiki_p_post_comments'] == 'y' || $this->_tpl_vars['tiki_p_edit_comments'] == 'y' )): ?>
<div id="page-bar">
<span class="button2">
      <a href="#comments" onclick="javascript:flip('comzone<?php if ($this->_tpl_vars['comments_show'] == 'y'): ?>open<?php endif; ?>');" class="linkbut">
	<?php if ($this->_tpl_vars['comments_cant'] == 0): ?>
          comentário
        <?php elseif ($this->_tpl_vars['comments_cant'] == 1): ?>
          <span class="highlight">1 comentário</span>
        <?php else: ?>
          <span class="highlight"><?php echo $this->_tpl_vars['comments_cant']; ?>
 comentários</span>
        <?php endif; ?>
      </a>
</span>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "comments.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>