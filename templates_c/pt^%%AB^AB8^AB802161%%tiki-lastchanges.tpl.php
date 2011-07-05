<?php /* Smarty version 2.6.18, created on 2011-06-26 18:52:17
         compiled from styles/bolha/tiki-lastchanges.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-lastchanges.tpl', 1, false),array('function', 'cycle', 'styles/bolha/tiki-lastchanges.tpl', 63, false),array('modifier', 'replace', 'styles/bolha/tiki-lastchanges.tpl', 7, false),array('modifier', 'date_format', 'styles/bolha/tiki-lastchanges.tpl', 67, false),array('modifier', 'cat', 'styles/bolha/tiki-lastchanges.tpl', 71, false),array('modifier', 'escape', 'styles/bolha/tiki-lastchanges.tpl', 72, false),array('modifier', 'truncate', 'styles/bolha/tiki-lastchanges.tpl', 73, false),array('modifier', 'times', 'styles/bolha/tiki-lastchanges.tpl', 136, false),array('block', 'tooltip', 'styles/bolha/tiki-lastchanges.tpl', 16, false),)), $this); ?>
<?php echo smarty_function_css(array('extra' => 'list'), $this);?>

<div id="listLastChanges">
	<h1>
		<?php if ($this->_tpl_vars['findwhat'] != ""): ?>
				Busca nas últimas alterações
		<?php else: ?> 
			Últimas Alterações &nbsp;&nbsp;&nbsp; <a href="tiki-wiki_rss.php?ver=2"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iRss.png"></a>
		<?php endif; ?>
	</h1>
	
	<h5>
		Busca <img class="pointer" onclick="javascript:flip('lastChangesOptions');toggleImage(this,'iArrowGreyDown.png')" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyLeft.png">
		<div id="lastChangesOptions" style="display:none">
			<form method="get" action="tiki-lastchanges.php">
				Modificações com texto: <br/>
				<?php $this->_tag_stack[] = array('tooltip', array('text' => "Dica: não escreva nada se quiser listar <b>todas</b> as modificções")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><input name="find" value="" type="text" class="input"><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br>
			    <b>Ou</b> nos últimos: <?php $this->_tag_stack[] = array('tooltip', array('text' => "Dica: coloque <b>0</b> para buscar em todos os dias")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><input name="days" value="0" size="2" type="text" class="input"><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> dias<br>
			    <input value="buscar" name="search" type="submit">
			    <input name="sort_mode" value="lastModif_desc" type="hidden">
		    </form>
		</div>
	</h5>
	
	<?php if ($this->_tpl_vars['findwhat'] != ""): ?>
		<h5>
			<?php echo $this->_tpl_vars['cant_records']; ?>
 resultado<?php if ($this->_tpl_vars['cant_users'] > 1): ?>s<?php endif; ?> para "<b><?php echo $this->_tpl_vars['findwhat']; ?>
</b>"<br>
			<a href="tiki-lastchanges.php?days=0">Veja todas as alterações</a>
		</h5>
	<?php elseif ($this->_tpl_vars['days'] > 0): ?>
		<h4>
			<b>Atenção:</b> listando somente as modificações feitas no<?php if ($this->_tpl_vars['days'] > 1): ?>s<?php endif; ?> último<?php if ($this->_tpl_vars['days'] > 1): ?>s<?php endif; ?> <b><?php echo $this->_tpl_vars['days']; ?>
</b> dia<?php if ($this->_tpl_vars['days'] > 1): ?>s<?php endif; ?>.<br>
			<a href="tiki-lastchanges.php?days=0">Veja as alterações feitas em qualquer dia</a>
		</h4>
	<?php endif; ?>		
		
	<div>
		<table class="normal">
			<tr>
				<td class="heading">
					<a class="tableheading" href="tiki-lastchanges.php?days=<?php echo $this->_tpl_vars['days']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'lastModif_desc'): ?>lastModif_asc<?php else: ?>lastModif_desc<?php endif; ?>">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'lastModif_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'lastModif_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">
					</a>Data
				</td>
				<td class="heading">
					<a class="tableheading" href="tiki-lastchanges.php?days=<?php echo $this->_tpl_vars['days']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'pageName_desc'): ?>pageName_asc<?php else: ?>pageName_desc<?php endif; ?>">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'pageName_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'pageName_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">
					</a>Página
				</td>
				
				<td class="heading">
					<a class="tableheading" href="tiki-lastchanges.php?days=<?php echo $this->_tpl_vars['days']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'user_desc'): ?>user_asc<?php else: ?>user_desc<?php endif; ?>">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'user_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'user_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">
					</a>Utilizador
				</td>
				
				<td class="heading">
					<a class="tableheading" href="tiki-lastchanges.php?days=<?php echo $this->_tpl_vars['days']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'comment_desc'): ?>comment_asc<?php else: ?>comment_desc<?php endif; ?>">
						<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/sort<?php if ($this->_tpl_vars['sort_mode'] == 'comment_desc'): ?>ArrowUp<?php elseif ($this->_tpl_vars['sort_mode'] == 'comment_asc'): ?>ArrowDown<?php else: ?>GreyArrowDown<?php endif; ?>.png">
					</a>Comentário
				</td>
			</tr>
			
			<?php echo smarty_function_cycle(array('values' => "even,odd",'print' => false), $this);?>

			<?php unset($this->_sections['changes']);
$this->_sections['changes']['name'] = 'changes';
$this->_sections['changes']['loop'] = is_array($_loop=$this->_tpl_vars['lastchanges']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<tr class="<?php echo smarty_function_cycle(array(), $this);?>
">
					<td>
						<?php echo ((is_array($_tmp=$this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['lastModif'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%M:%S de %d/%m") : smarty_modifier_date_format($_tmp, "%H:%M:%S de %d/%m")); ?>

					</td>
					
					<td>
						<?php $this->_tag_stack[] = array('tooltip', array('text' => ((is_array($_tmp="Ação realizada nessa modificação: ")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['action']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['action'])))); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
							<a href="tiki-index.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" class="tablename">
								<?php echo ((is_array($_tmp=$this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['pageName'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 18, "(...)", true) : smarty_modifier_truncate($_tmp, 18, "(...)", true)); ?>

							</a>
						<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					
					<?php if ($this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['version']): ?>
					<div style="text-align:right">
					<?php $this->_tag_stack[] = array('tooltip', array('text' => ((is_array($_tmp=((is_array($_tmp="A versão atual dessa página é <b>")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['version']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['version'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "</b>") : smarty_modifier_cat($_tmp, "</b>")))); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a class="link" href="tiki-pagehistory.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
">
					h</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;
					
					<a class="link" href="tiki-pagehistory.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;preview=<?php echo $this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['version']; ?>
"
					 title="ver">v</a>&nbsp;

					<?php if ($this->_tpl_vars['tiki_p_rollback'] == 'y'): ?>
						<a class="link" href="tiki-rollback.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;version=<?php echo $this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['version']; ?>
" title="restaurar">
						b</a>&nbsp;
					<?php endif; ?>
					<a class="link" href="tiki-pagehistory.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;diff=<?php echo $this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['version']; ?>
" title="comparar">
					c</a>&nbsp;
					<a class="link" href="tiki-pagehistory.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;diff2=<?php echo $this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['version']; ?>
" title="difer">
					d</a>&nbsp;
					<a class="link" href="tiki-pagehistory.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;source=<?php echo $this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['version']; ?>
" title="fonte">
					s</a>
					</div>
					<?php elseif ($this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['versionlast']): ?>
						<div style="text-align:right;margin-right:5em">
						<?php $this->_tag_stack[] = array('tooltip', array('text' => ((is_array($_tmp=((is_array($_tmp="A versão atual dessa página é <b>")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['version']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['version'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "</b>") : smarty_modifier_cat($_tmp, "</b>")))); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a class="link" href="tiki-pagehistory.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
">
						h</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
						</div>
					<?php endif; ?>
					</td>
					<td>
						<a href="el-user.php?view_user=<?php echo $this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['user']; ?>
"><?php echo $this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['user']; ?>
</a>
					</td>
					
					<td>
						<?php echo $this->_tpl_vars['lastchanges'][$this->_sections['changes']['index']]['comment']; ?>

					</td>
				</tr>
			<?php endfor; else: ?>
				<tr><td class="even" colspan="6">
				<b>Nenhum registro encontrado</b>
				</td>
				</tr>
			<?php endif; ?>
		</table>
		
		<div class="paginacao">
			<?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
				<a class="prevnext" href="tiki-lastchanges.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;days=<?php echo $this->_tpl_vars['days']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
					<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyLeft.png">
				</a>
			<?php endif; ?>
			
			Página <?php echo $this->_tpl_vars['actual_page']; ?>
 de <?php echo $this->_tpl_vars['cant_pages']; ?>

			
			<?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
				<a class="prevnext" href="tiki-lastchanges.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;days=<?php echo $this->_tpl_vars['days']; ?>
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
						<a class="prevnext" href="tiki-lastchanges.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;days=<?php echo $this->_tpl_vars['days']; ?>
&amp;offset=<?php echo $this->_tpl_vars['selector_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
					<?php echo $this->_sections['foo']['index_next']; ?>
</a>
				<?php endfor; endif; ?>
			<?php endif; ?>
		</div>
	
	</div>

</div>