<?php /* Smarty version 2.6.18, created on 2011-04-04 19:27:32
         compiled from tiki-list_gallery.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'tiki-list_gallery.tpl', 31, false),array('modifier', 'truncate', 'tiki-list_gallery.tpl', 35, false),array('modifier', 'tiki_short_datetime', 'tiki-list_gallery.tpl', 40, false),array('modifier', 'kbsize', 'tiki-list_gallery.tpl', 43, false),array('modifier', 'times', 'tiki-list_gallery.tpl', 63, false),)), $this); ?>
<h1><a href="tiki-list_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
" class="pagetitle">Navegando pela Galeria: <?php echo $this->_tpl_vars['name']; ?>
</a></h1>

<?php if ($this->_tpl_vars['system'] == 'n'): ?>
  <?php if ($this->_tpl_vars['tiki_p_admin_galleries'] == 'y' || ( $this->_tpl_vars['user'] && $this->_tpl_vars['user'] == $this->_tpl_vars['owner'] )): ?>
    <a  href="tiki-galleries.php?edit_mode=1&amp;galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
" class="linkbut">editar galeria</a>
    <a href="tiki-list_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;rebuild=<?php echo $this->_tpl_vars['galleryId']; ?>
" class="linkbut">Recriar miniaturas</a>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['tiki_p_upload_images'] == 'y'): ?>
    <?php if ($this->_tpl_vars['tiki_p_admin_galleries'] == 'y' || ( $this->_tpl_vars['user'] && $this->_tpl_vars['user'] == $this->_tpl_vars['owner'] ) || $this->_tpl_vars['public'] == 'y'): ?>
        <a href="tiki-upload_image.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
" class="linkbut">carregar uma imagem</a>
    <?php endif; ?>
  <?php endif; ?>
<?php endif; ?>
<a href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
" class="linkbut">navegar pela galeria</a>
<br /><br /> 
<div class="galdesc">
  <?php echo $this->_tpl_vars['description']; ?>

</div>

  <h3>Imagens da Galeria</h3>
<div align="center">
<table class="normal">
<tr>
<td class="heading"><a class="tableheading" href="tiki-list_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'imageId_desc'): ?>imageId_asc<?php else: ?>imageId_desc<?php endif; ?>">ID</a></td>
<td class="heading"><a class="tableheading" href="tiki-list_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'name_desc'): ?>name_asc<?php else: ?>name_desc<?php endif; ?>">Nome</a></td>
<td class="heading"><a class="tableheading" href="tiki-list_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'created_desc'): ?>created_asc<?php else: ?>created_desc<?php endif; ?>">Criado em</a></td>
<td class="heading"><a class="tableheading" href="tiki-list_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'hits_desc'): ?>hits_asc<?php else: ?>hits_desc<?php endif; ?>">Visitas</a></td>
<td class="heading"><a class="tableheading" href="tiki-list_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'user_desc'): ?>user_asc<?php else: ?>user_desc<?php endif; ?>">Usuári@</a></td>
<td class="heading"><a class="tableheading" href="tiki-list_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'filesize_desc'): ?>filesize_asc<?php else: ?>filesize_desc<?php endif; ?>">Tamanho</a></td>
</tr>
<?php echo smarty_function_cycle(array('print' => false,'values' => "even,odd"), $this);?>

<?php unset($this->_sections['changes']);
$this->_sections['changes']['name'] = 'changes';
$this->_sections['changes']['loop'] = is_array($_loop=$this->_tpl_vars['images']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['images'][$this->_sections['changes']['index']]['imageId']; ?>
&nbsp;</td>
<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><a class="imagename" href="tiki-browse_image.php?<?php if ($this->_tpl_vars['images'][$this->_sections['changes']['index']]['galleryId']): ?>galleryId=<?php echo $this->_tpl_vars['images'][$this->_sections['changes']['index']]['galleryId']; ?>
&amp;<?php endif; ?>imageId=<?php echo $this->_tpl_vars['images'][$this->_sections['changes']['index']]['imageId']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['images'][$this->_sections['changes']['index']]['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 22, "...") : smarty_modifier_truncate($_tmp, 22, "...")); ?>
</a>&nbsp;
<?php if ($this->_tpl_vars['tiki_p_admin_galleries'] == 'y' || ( $this->_tpl_vars['user'] && $this->_tpl_vars['user'] == $this->_tpl_vars['owner'] )): ?>
<a class="gallink" href="tiki-list_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
&amp;remove=<?php echo $this->_tpl_vars['images'][$this->_sections['changes']['index']]['imageId']; ?>
">[x]</a>
<?php endif; ?>
</td>
<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['images'][$this->_sections['changes']['index']]['created'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>
&nbsp;</td>
<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['images'][$this->_sections['changes']['index']]['hits']; ?>
&nbsp;</td>
<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['images'][$this->_sections['changes']['index']]['user']; ?>
&nbsp;</td>
<td class="<?php echo smarty_function_cycle(array(), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['images'][$this->_sections['changes']['index']]['filesize'])) ? $this->_run_mod_handler('kbsize', true, $_tmp) : smarty_modifier_kbsize($_tmp)); ?>
&nbsp;</td>
</tr>
<?php endfor; else: ?>
<tr><td colspan="6">
<b>Nenhum registro encontrado</b>
</td></tr>
<?php endif; ?>
</table>

  <div class="mini">
      <?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
        [<a class="galprevnext" href="tiki-list_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">ant</a>]&nbsp;
      <?php endif; ?>
      Página: <?php echo $this->_tpl_vars['actual_page']; ?>
/<?php echo $this->_tpl_vars['cant_pages']; ?>

      <?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
      &nbsp;[<a class="galprevnext" href="tiki-list_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
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
<a class="prevnext" href="tiki-list_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['selector_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
<?php echo $this->_sections['foo']['index_next']; ?>
</a>&nbsp;
<?php endfor; endif; ?>
<?php endif; ?>
  </div>
</div>