<?php /* Smarty version 2.6.18, created on 2011-05-03 19:41:10
         compiled from modules/mod-last_modif_pages.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'eval', 'modules/mod-last_modif_pages.tpl', 5, false),array('block', 'tikimodule', 'modules/mod-last_modif_pages.tpl', 9, false),array('modifier', 'escape', 'modules/mod-last_modif_pages.tpl', 18, false),array('modifier', 'tiki_short_datetime', 'modules/mod-last_modif_pages.tpl', 18, false),array('modifier', 'truncate', 'modules/mod-last_modif_pages.tpl', 20, false),)), $this); ?>


<?php if ($this->_tpl_vars['feature_wiki'] == 'y'): ?>
<?php if ($this->_tpl_vars['nonums'] == 'y'): ?>
<?php echo smarty_function_eval(array('var' => "<a href=\"tiki-lastchanges.php\">Últimas ".($this->_tpl_vars['module_rows'])." alterações</a>",'assign' => 'tpl_module_title'), $this);?>

<?php else: ?>
<?php echo smarty_function_eval(array('var' => "<a href=\"tiki-lastchanges.php\">Últimas alterações</a>",'assign' => 'tpl_module_title'), $this);?>

<?php endif; ?>
<?php $this->_tag_stack[] = array('tikimodule', array('title' => $this->_tpl_vars['tpl_module_title'],'name' => 'last_modif_pages','flip' => $this->_tpl_vars['module_params']['flip'],'decorations' => $this->_tpl_vars['module_params']['decorations'])); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
   <table  border="0" cellpadding="0" cellspacing="0">
    <?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['modLastModif']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      <?php if ($this->_tpl_vars['nonums'] != 'y'): ?>
        <td class="module" valign="top"><?php echo $this->_sections['ix']['index_next']; ?>
)</td>
      <?php endif; ?>
      <td class="module">&nbsp;
		<?php if ($this->_tpl_vars['absurl'] == 'y'): ?>
          <a class="linkmodule" href="<?php echo $this->_tpl_vars['feature_server_name']; ?>
tiki-index.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['modLastModif'][$this->_sections['ix']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['modLastModif'][$this->_sections['ix']['index']]['lastModif'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>
, por <?php if ($this->_tpl_vars['modLastModif'][$this->_sections['ix']['index']]['user'] != ''): ?><?php echo $this->_tpl_vars['modLastModif'][$this->_sections['ix']['index']]['user']; ?>
<?php else: ?>Anônimo<?php endif; ?><?php if (( strlen ( $this->_tpl_vars['modLastModif'][$this->_sections['ix']['index']]['pageName'] ) > $this->_tpl_vars['maxlen'] ) && ( $this->_tpl_vars['maxlen'] > 0 )): ?>, <?php echo $this->_tpl_vars['modLastModif'][$this->_sections['ix']['index']]['pageName']; ?>
<?php endif; ?>">
        <?php if ($this->_tpl_vars['maxlen'] > 0): ?>
         <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['modLastModif'][$this->_sections['ix']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, $this->_tpl_vars['maxlen'], "...", true) : smarty_modifier_truncate($_tmp, $this->_tpl_vars['maxlen'], "...", true)); ?>

        <?php else: ?>
         <?php echo ((is_array($_tmp=$this->_tpl_vars['modLastModif'][$this->_sections['ix']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

        <?php endif; ?>
          </a>
		  <?php else: ?>
       <a class="linkmodule" href="tiki-index.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['modLastModif'][$this->_sections['ix']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['modLastModif'][$this->_sections['ix']['index']]['lastModif'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>
, por <?php if ($this->_tpl_vars['modLastModif'][$this->_sections['ix']['index']]['user'] != ''): ?><?php echo $this->_tpl_vars['modLastModif'][$this->_sections['ix']['index']]['user']; ?>
<?php else: ?>Anônimo<?php endif; ?><?php if (( strlen ( $this->_tpl_vars['modLastModif'][$this->_sections['ix']['index']]['pageName'] ) > $this->_tpl_vars['maxlen'] ) && ( $this->_tpl_vars['maxlen'] > 0 )): ?>, <?php echo $this->_tpl_vars['modLastModif'][$this->_sections['ix']['index']]['pageName']; ?>
<?php endif; ?>">
        <?php if ($this->_tpl_vars['maxlen'] > 0): ?>
         <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['modLastModif'][$this->_sections['ix']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, $this->_tpl_vars['maxlen'], "...", true) : smarty_modifier_truncate($_tmp, $this->_tpl_vars['maxlen'], "...", true)); ?>

        <?php else: ?>
         <?php echo ((is_array($_tmp=$this->_tpl_vars['modLastModif'][$this->_sections['ix']['index']]['pageName'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

        <?php endif; ?>
       </a>
	   <?php endif; ?>
      </td>
     </tr>
    <?php endfor; endif; ?>
   </table>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php endif; ?>