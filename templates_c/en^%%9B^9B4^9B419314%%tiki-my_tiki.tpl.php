<?php /* Smarty version 2.6.18, created on 2011-06-06 12:50:45
         compiled from tiki-my_tiki.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'cycle', 'tiki-my_tiki.tpl', 30, false),array('modifier', 'escape', 'tiki-my_tiki.tpl', 33, false),array('modifier', 'truncate', 'tiki-my_tiki.tpl', 33, false),array('modifier', 'tiki_short_datetime', 'tiki-my_tiki.tpl', 36, false),array('modifier', 'strip', 'tiki-my_tiki.tpl', 149, false),)), $this); ?>


<h1><a class="pagetitle" href="tiki-my_tiki.php">My Tiki</a>

<?php if ($this->_tpl_vars['feature_help'] == 'y'): ?>
<a href="<?php echo $this->_tpl_vars['helpurl']; ?>
MyTiki" target="tikihelp" class="tikihelp" title="MyTiki">
<img src="img/icons/help.gif" border="0" height="16" width="16" alt='help' /></a>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_view_tpl'] == 'y'): ?>
<a href="tiki-edit_templates.php?template=tiki-my_tiki.tpl" target="tikihelp" class="tikihelp" title="View tpl: my tiki tpl">
<img src="img/icons/info.gif" border="0" width="16" height="16" alt='edit template' /></a>
<?php endif; ?></h1>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-mytiki_bar.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br /><br />

<?php ob_start(); ?>
<?php if ($this->_tpl_vars['feature_wiki'] == 'y' && $this->_tpl_vars['mytiki_pages'] == 'y'): ?>
<div id="content1" class="content">
  <div class="cbox">
  <div class="cbox-title"><?php if ($this->_tpl_vars['userwatch'] == $this->_tpl_vars['user']): ?>My pages<?php else: ?>User Pages<?php endif; ?></div>
  <div class="cbox-data">
  <table class="normal">
  <tr>
  <th class="heading"><a class="tableheading" href="tiki-my_tiki.php?sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'pageName_desc'): ?>pageName_asc<?php else: ?>pageName_desc<?php endif; ?>">Page</a></th>
  <th class="heading">Creator</th>
  <th class="heading">Last editor</th>
  <th class="heading"><a class="tableheading" href="tiki-my_tiki.php?sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'date_desc'): ?>date_asc<?php else: ?>date_desc<?php endif; ?>">Last modification</a></th><th class="heading">Actions</th></tr>
  <?php echo smarty_function_cycle(array('values' => "even,odd",'print' => false), $this);?>

  <?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['user_pages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
"><a class="link" title="view: <?php echo $this->_tpl_vars['user_pages'][$this->_sections['ix']['index']]['pageName']; ?>
" href="tiki-index.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['user_pages'][$this->_sections['ix']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['user_pages'][$this->_sections['ix']['index']]['pageName'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 40, "(...)") : smarty_modifier_truncate($_tmp, 40, "(...)")); ?>
</a></td>
  <td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
" style="text-align:center;"><?php if ($this->_tpl_vars['userwatch'] == $this->_tpl_vars['user_pages'][$this->_sections['ix']['index']]['creator']): ?>y<?php else: ?>&nbsp;<?php endif; ?></td>
  <td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
" style="text-align:center;"><?php if ($this->_tpl_vars['userwatch'] == $this->_tpl_vars['user_pages'][$this->_sections['ix']['index']]['lastEditor']): ?>y<?php else: ?>&nbsp;<?php endif; ?></td>
  <td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['user_pages'][$this->_sections['ix']['index']]['date'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>
</td>
  <td class="<?php echo smarty_function_cycle(array(), $this);?>
" style="text-align:center;"><a class="link" href="tiki-editpage.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['user_pages'][$this->_sections['ix']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><img border="0" alt="edit" title="edit: <?php echo $this->_tpl_vars['user_pages'][$this->_sections['ix']['index']]['pageName']; ?>
" src="img/icons/edit.gif" /></a></td>
  </tr>
  <?php endfor; endif; ?>
  </table>
  </div>
  </div>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_galleries'] == 'y' && $this->_tpl_vars['mytiki_gals'] == 'y'): ?>
<div id="content2" class="content">
  <div class="cbox">
  <div class="cbox-title"><?php if ($this->_tpl_vars['userwatch'] == $this->_tpl_vars['user']): ?>My galleries<?php else: ?>User Galleries<?php endif; ?></div>
  <div class="cbox-data">
  <table class="normal">
  <?php echo smarty_function_cycle(array('values' => "even,odd",'print' => false), $this);?>

  <?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['user_galleries']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
">
  <a class="link" href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['user_galleries'][$this->_sections['ix']['index']]['galleryId']; ?>
"><?php echo $this->_tpl_vars['user_galleries'][$this->_sections['ix']['index']]['name']; ?>
</a>
  </td><td class="<?php echo smarty_function_cycle(array(), $this);?>
" style="text-align:center;">
  <a class="link" href="tiki-galleries.php?editgal=<?php echo $this->_tpl_vars['user_galleries'][$this->_sections['ix']['index']]['galleryId']; ?>
"><img border="0" alt="edit" title="edit" src="img/icons/edit.gif" /></a>
  </td></tr>
  <?php endfor; endif; ?>
  </table>
  </div>
  </div>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_trackers'] == 'y' && $this->_tpl_vars['mytiki_items'] == 'y'): ?>
<div id="content3" class="content">
  <div class="cbox">
  <div class="cbox-title"><?php if ($this->_tpl_vars['userwatch'] == $this->_tpl_vars['user']): ?>My items<?php else: ?>Assigned items<?php endif; ?></div>
  <div class="cbox-data">
  <table class="normal">
  <tr><th class="heading">Item</th><th class="heading">Tracker</th></tr>
  <?php echo smarty_function_cycle(array('values' => "even,odd",'print' => false), $this);?>

   <?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['user_items']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
">
  <a class="link" title="view" href="tiki-view_tracker_item.php?trackerId=<?php echo $this->_tpl_vars['user_items'][$this->_sections['ix']['index']]['trackerId']; ?>
&amp;itemId=<?php echo $this->_tpl_vars['user_items'][$this->_sections['ix']['index']]['itemId']; ?>
"><?php echo $this->_tpl_vars['user_items'][$this->_sections['ix']['index']]['value']; ?>
</a></td>
   <td class="<?php echo smarty_function_cycle(array(), $this);?>
"><a class="link" title="view" href="tiki-view_tracker.php?trackerId=<?php echo $this->_tpl_vars['user_items'][$this->_sections['ix']['index']]['trackerId']; ?>
"><?php echo $this->_tpl_vars['user_items'][$this->_sections['ix']['index']]['name']; ?>
</a></td>
  </tr>
  <?php endfor; endif; ?>
  </table>
  </div>
  </div>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_messages'] == 'y' && $this->_tpl_vars['mytiki_msgs'] == 'y'): ?>
<div id="content4" class="content">
  <div class="cbox">
  <div class="cbox-title">Unread Messages</div>
  <table  class="normal">
  <tr><th class="heading">Subject</th><th class="heading">From</th><th class="heading">Date</th></tr>
  <?php echo smarty_function_cycle(array('values' => "even,odd",'print' => false), $this);?>

  <?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['msgs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
">
  <a class="link" title="view" href="messu-read.php?offset=0&amp;flag=&amp;flagval=&amp;find=&amp;sort_mode=date_desc&amp;priority=&amp;msgId=<?php echo $this->_tpl_vars['msgs'][$this->_sections['ix']['index']]['msgId']; ?>
"><?php echo $this->_tpl_vars['msgs'][$this->_sections['ix']['index']]['subject']; ?>
</a>
  </td>
  <td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['msgs'][$this->_sections['ix']['index']]['user_from']; ?>
</td><td class="<?php echo smarty_function_cycle(array(), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['msgs'][$this->_sections['ix']['index']]['date'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>
</td></tr>
  <?php endfor; endif; ?>
  </table>
  </div>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_tasks'] == 'y' && $this->_tpl_vars['mytiki_tasks'] == 'y'): ?>
<div id="content5" class="content">
  <div class="cbox">
  <div class="cbox-title"><?php if ($this->_tpl_vars['userwatch'] == $this->_tpl_vars['user']): ?>My tasks<?php else: ?>User tasks<?php endif; ?></div>
  <table  class="normal">
  <?php echo smarty_function_cycle(array('values' => "even,odd",'print' => false), $this);?>

  <?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['tasks']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
  <tr><td class="<?php echo smarty_function_cycle(array(), $this);?>
">
  <a class="link" href="tiki-user_tasks.php?taskId=<?php echo $this->_tpl_vars['tasks'][$this->_sections['ix']['index']]['taskId']; ?>
"><?php echo $this->_tpl_vars['tasks'][$this->_sections['ix']['index']]['title']; ?>
</a>
  </td></tr>
  <?php endfor; endif; ?>
  </table>
  </div>
</div>
<?php endif; ?>



<?php if ($this->_tpl_vars['feature_blogs'] == y && $this->_tpl_vars['mytiki_blogs'] == 'y'): ?>
<div id="content6" class="content">
  <div class="cbox">
  <div class="cbox-title"><?php if ($this->_tpl_vars['userwatch'] == $this->_tpl_vars['user']): ?>My blogs<?php else: ?>User Blogs<?php endif; ?></div>
  <table  class="normal">
  <?php echo smarty_function_cycle(array('values' => "even,odd",'print' => false), $this);?>

  <?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['user_blogs']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
">
  <a class="link" title="view" href="tiki-view_blog.php?blogId=<?php echo $this->_tpl_vars['user_blogs'][$this->_sections['ix']['index']]['blogId']; ?>
"><?php echo $this->_tpl_vars['user_blogs'][$this->_sections['ix']['index']]['title']; ?>
</a>
  </td><td class="<?php echo smarty_function_cycle(array(), $this);?>
" style="text-align:center;">
  <a class="link" href="tiki-edit_blog.php?blogId=<?php echo $this->_tpl_vars['user_blogs'][$this->_sections['ix']['index']]['blogId']; ?>
"><img border="0" alt="edit" title="edit" src="img/icons/edit.gif" /></a>
  </td></tr>
  <?php endfor; endif; ?>
  </table>
  </div>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_workflow'] == 'y' && $this->_tpl_vars['tiki_p_use_workflow'] == 'y' && $this->_tpl_vars['mytiki_workflow'] == 'y'): ?>
  <div id="content7" class="content">
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-g-my_activities.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      <br /><br />
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "tiki-g-my_instances.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  </div>
<?php endif; ?>
<?php $this->_smarty_vars['capture']['my'] = ob_get_contents(); ob_end_clean(); ?>
<?php echo $this->_smarty_vars['capture']['my']; ?>

<?php if (((is_array($_tmp=$this->_smarty_vars['capture']['my'])) ? $this->_run_mod_handler('strip', true, $_tmp, '') : smarty_modifier_strip($_tmp, '')) == ''): ?>To display the objects you participate to: <a href="tiki-user_preferences.php?tab3#MyTiki">My Tiki</a><?php endif; ?>