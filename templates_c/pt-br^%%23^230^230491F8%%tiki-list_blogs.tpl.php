<?php /* Smarty version 2.6.18, created on 2011-07-03 20:45:36
         compiled from tiki-list_blogs.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'tiki-list_blogs.tpl', 17, false),array('modifier', 'truncate', 'tiki-list_blogs.tpl', 58, false),array('modifier', 'tiki_short_date', 'tiki-list_blogs.tpl', 64, false),array('modifier', 'tiki_short_datetime', 'tiki-list_blogs.tpl', 67, false),array('modifier', 'userlink', 'tiki-list_blogs.tpl', 71, false),array('modifier', 'avatarize', 'tiki-list_blogs.tpl', 73, false),array('modifier', 'times', 'tiki-list_blogs.tpl', 136, false),array('function', 'cycle', 'tiki-list_blogs.tpl', 54, false),)), $this); ?>
<h1><a class="pagetitle" href="tiki-list_blogs.php">Blogs</a>
<?php if ($this->_tpl_vars['tiki_p_admin'] == 'y'): ?>
<a href="tiki-admin.php?page=blogs"><img src='img/icons/config.gif' border='0'  alt="configurar a listagem" title="configurar a listagem" /></a>
<?php endif; ?>
</h1>
<?php if ($this->_tpl_vars['tiki_p_create_blogs'] == 'y'): ?>
<div class="navbar"><a class="linkbut" href="tiki-edit_blog.php">criar um novo blog</a></div>
<?php endif; ?>

<div style="text-align: center">

<?php if ($this->_tpl_vars['cant_pages'] > 1): ?>
<table class="findtable" style="text-align: left">
<tr><td class="findtable">Buscar</td>
   <td class="findtable">
   <form method="get" action="tiki-list_blogs.php">
     <input type="text" name="find" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['find'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
     <input type="submit" value="buscar" name="search" />
     <input type="hidden" name="sort_mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['sort_mode'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
   </form>
   </td>
</tr>
</table>
<?php endif; ?>

<table class="bloglist" style="text-align: left">
<tr>
<?php if ($this->_tpl_vars['blog_list_title'] == 'y'): ?>
	<td class="bloglistheading"><a class="bloglistheading" href="tiki-list_blogs.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'title_desc'): ?>title_asc<?php else: ?>title_desc<?php endif; ?>">Título</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['blog_list_description'] == 'y'): ?>
	<td class="bloglistheading">Descrição</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['blog_list_created'] == 'y'): ?>
	<td class="bloglistheading"><a class="bloglistheading" href="tiki-list_blogs.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'created_desc'): ?>created_asc<?php else: ?>created_desc<?php endif; ?>">Criado em</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['blog_list_lastmodif'] == 'y'): ?>
	<td class="bloglistheading"><a class="bloglistheading" href="tiki-list_blogs.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'lastModif_desc'): ?>lastModif_asc<?php else: ?>lastModif_desc<?php endif; ?>">Última Modificação</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['blog_list_user'] != 'disabled'): ?>
	<td class="bloglistheading"><a class="bloglistheading" href="tiki-list_blogs.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'user_desc'): ?>user_asc<?php else: ?>user_desc<?php endif; ?>">Usuári@</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['blog_list_posts'] == 'y'): ?>
	<td style="text-align:right;"  class="bloglistheading"><a class="bloglistheading" href="tiki-list_blogs.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'posts_desc'): ?>posts_asc<?php else: ?>posts_desc<?php endif; ?>">Mensagens</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['blog_list_visits'] == 'y'): ?>
	<td style="text-align:right;"  class="bloglistheading"><a class="bloglistheading" href="tiki-list_blogs.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'hits_desc'): ?>hits_asc<?php else: ?>hits_desc<?php endif; ?>">Visitas</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['blog_list_activity'] == 'y'): ?>
	<td style="text-align:right;"  class="bloglistheading"><a class="bloglistheading" href="tiki-list_blogs.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'activity_desc'): ?>activity_asc<?php else: ?>activity_desc<?php endif; ?>">Atividade</a></td>
<?php endif; ?>
<td class="bloglistheading">Ação</td>
</tr>
<?php echo smarty_function_cycle(array('values' => "odd,even",'print' => false), $this);?>

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
<?php if ($this->_tpl_vars['blog_list_title'] == 'y'): ?>
	<td class="bloglistname<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual_tiki_p_read_blog'] == 'y' )): ?><a class="blogname" href="tiki-view_blog.php?blogId=<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['blogId']; ?>
" title="<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['title']; ?>
"><?php endif; ?><?php if ($this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['title']): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "...", true) : smarty_modifier_truncate($_tmp, 20, "...", true)); ?>
<?php else: ?>&nbsp;<?php endif; ?><?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual_tiki_p_read_blog'] == 'y' )): ?></a><?php endif; ?></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['blog_list_description'] == 'y'): ?>
	<td class="bloglistdescription<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['description']; ?>
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['blog_list_created'] == 'y'): ?>
	<td class="bloglistcreated<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['created'])) ? $this->_run_mod_handler('tiki_short_date', true, $_tmp) : smarty_modifier_tiki_short_date($_tmp)); ?>
&nbsp;</td><!--tiki_date_format:"%b %d" -->
<?php endif; ?>
<?php if ($this->_tpl_vars['blog_list_lastmodif'] == 'y'): ?>
	<td class="bloglistlastModif<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['lastModif'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>
&nbsp;</td><!--tiki_date_format:"%d of %b [%H:%M]"-->
<?php endif; ?>
<?php if ($this->_tpl_vars['blog_list_user'] != 'disabled'): ?>
<?php if ($this->_tpl_vars['blog_list_user'] == 'link'): ?>
	<td class="bloglistuser<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['user'])) ? $this->_run_mod_handler('userlink', true, $_tmp) : smarty_modifier_userlink($_tmp)); ?>
&nbsp;</td>
<?php elseif ($this->_tpl_vars['blog_list_user'] == 'avatar'): ?>
	<td class="bloglistuser<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['user'])) ? $this->_run_mod_handler('avatarize', true, $_tmp) : smarty_modifier_avatarize($_tmp)); ?>
&nbsp;<br />
	&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['user'])) ? $this->_run_mod_handler('userlink', true, $_tmp) : smarty_modifier_userlink($_tmp)); ?>
&nbsp;</td>
<?php else: ?>
	<td class="bloglistuser<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">&nbsp;<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['user']; ?>
&nbsp;</td>
<?php endif; ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['blog_list_posts'] == 'y'): ?>
	<td style="text-align:right;" class="bloglistposts<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">&nbsp;<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['posts']; ?>
&nbsp;</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['blog_list_visits'] == 'y'): ?>
	<td style="text-align:right;" class="bloglistvisits<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">&nbsp;<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['hits']; ?>
&nbsp;</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['blog_list_activity'] == 'y'): ?>	
	<td style="text-align:right;" class="bloglistactivity<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">&nbsp;<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['activity']; ?>
&nbsp;</td>
<?php endif; ?>
<td class="bloglistactions<?php echo smarty_function_cycle(array(), $this);?>
" nowrap="nowrap">
	<?php if (( $this->_tpl_vars['user'] && $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['user'] == $this->_tpl_vars['user'] ) || ( $this->_tpl_vars['tiki_p_blog_admin'] == 'y' )): ?>
		<?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual_tiki_p_blog_create_blog'] == 'y' )): ?>
			<a class="bloglink" href="tiki-edit_blog.php?blogId=<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['blogId']; ?>
"><img border='0' title='editar' alt='editar' src='img/icons/config.gif' /></a>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['tiki_p_blog_post'] == 'y'): ?>
		<?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual_tiki_p_blog_post'] == 'y' )): ?>
			<?php if (( $this->_tpl_vars['user'] && $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['user'] == $this->_tpl_vars['user'] ) || ( $this->_tpl_vars['tiki_p_blog_admin'] == 'y' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['public'] == 'y' )): ?>
				<a class="bloglink" href="tiki-blog_post.php?blogId=<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['blogId']; ?>
"><img border='0' title='enviar' alt='enviar' src='img/icons/edit.gif' /></a>
			<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['tiki_p_admin'] == 'y'): ?>
	    <?php if ($this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual'] == 'y'): ?>
		<a class="bloglink" href="tiki-objectpermissions.php?objectName=<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;objectType=blog&amp;permType=blogs&amp;objectId=<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['blogId']; ?>
"><img border='0' title='permissões ativas' alt='permissões ativas' src='img/icons/key_active.gif' /></a>
	    <?php else: ?>
		<a class="bloglink" href="tiki-objectpermissions.php?objectName=<?php echo ((is_array($_tmp=$this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;objectType=blog&amp;permType=blogs&amp;objectId=<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['blogId']; ?>
"><img border='0' title='permissões' alt='permissões' src='img/icons/key.gif' /></a>
	    <?php endif; ?>
	<?php endif; ?>
        <?php if (( $this->_tpl_vars['user'] && $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['user'] == $this->_tpl_vars['user'] ) || ( $this->_tpl_vars['tiki_p_blog_admin'] == 'y' )): ?>
                <?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['individual_tiki_p_blog_create_blog'] == 'y' )): ?>
                        &nbsp;&nbsp;<a class="bloglink" href="tiki-list_blogs.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
&amp;remove=<?php echo $this->_tpl_vars['listpages'][$this->_sections['changes']['index']]['blogId']; ?>
"><img border='0' title='remover' alt='remover' src='img/icons2/delete.gif' /></a>
                <?php endif; ?>
        <?php endif; ?>
	
</td>
</tr>
<?php endfor; else: ?>
<tr><td colspan="9" class="odd">
Nenhum registro encontrado
</td></tr>
<?php endif; ?>
</table>

<?php if ($this->_tpl_vars['cant_pages'] > 1): ?>
<br />
<div class="mini">
<?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
[<a class="blogprevnext" href="tiki-list_blogs.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">ant</a>]&nbsp;
<?php endif; ?>
Página: <?php echo $this->_tpl_vars['actual_page']; ?>
/<?php echo $this->_tpl_vars['cant_pages']; ?>

<?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
&nbsp;[<a class="blogprevnext" href="tiki-list_blogs.php?find=<?php echo $this->_tpl_vars['find']; ?>
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
<a class="prevnext" href="tiki-list_blogs.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['selector_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
<?php echo $this->_sections['foo']['index_next']; ?>
</a>&nbsp;
<?php endfor; endif; ?>
<?php endif; ?>
</div>
<?php endif; ?>

</div>