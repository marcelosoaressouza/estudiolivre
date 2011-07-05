<?php /* Smarty version 2.6.18, created on 2011-05-03 10:58:03
         compiled from styles/bolha/error_mid.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'styles/bolha/error_mid.tpl', 7, false),)), $this); ?>
<br>
<?php if (( $this->_tpl_vars['errortype'] == '404' )): ?>
	<?php if ($this->_tpl_vars['likepages']): ?>
    	Perhaps you were looking for:
			<ul>
				<?php unset($this->_sections['back']);
$this->_sections['back']['name'] = 'back';
$this->_sections['back']['loop'] = is_array($_loop=$this->_tpl_vars['likepages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['back']['show'] = true;
$this->_sections['back']['max'] = $this->_sections['back']['loop'];
$this->_sections['back']['step'] = 1;
$this->_sections['back']['start'] = $this->_sections['back']['step'] > 0 ? 0 : $this->_sections['back']['loop']-1;
if ($this->_sections['back']['show']) {
    $this->_sections['back']['total'] = $this->_sections['back']['loop'];
    if ($this->_sections['back']['total'] == 0)
        $this->_sections['back']['show'] = false;
} else
    $this->_sections['back']['total'] = 0;
if ($this->_sections['back']['show']):

            for ($this->_sections['back']['index'] = $this->_sections['back']['start'], $this->_sections['back']['iteration'] = 1;
                 $this->_sections['back']['iteration'] <= $this->_sections['back']['total'];
                 $this->_sections['back']['index'] += $this->_sections['back']['step'], $this->_sections['back']['iteration']++):
$this->_sections['back']['rownum'] = $this->_sections['back']['iteration'];
$this->_sections['back']['index_prev'] = $this->_sections['back']['index'] - $this->_sections['back']['step'];
$this->_sections['back']['index_next'] = $this->_sections['back']['index'] + $this->_sections['back']['step'];
$this->_sections['back']['first']      = ($this->_sections['back']['iteration'] == 1);
$this->_sections['back']['last']       = ($this->_sections['back']['iteration'] == $this->_sections['back']['total']);
?>
					<li><a  href="tiki-index.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['likepages'][$this->_sections['back']['index']])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" class="wiki"><?php echo $this->_tpl_vars['likepages'][$this->_sections['back']['index']]; ?>
</a></li>
				<?php endfor; endif; ?>
			</ul>       
	<?php else: ?>
		هيج صفحه‌ي ويكي مشابه '<?php echo $this->_tpl_vars['page']; ?>
' وجود ندارد
			<br/><br/>
	<?php endif; ?>
        
<?php else: ?>
	<?php echo $this->_tpl_vars['msg']; ?>

	<br /><br />
<?php endif; ?>
	
<?php if ($this->_tpl_vars['page'] && $this->_tpl_vars['create'] == 'y' && ( $this->_tpl_vars['tiki_p_admin'] == 'y' || $this->_tpl_vars['tiki_p_admin_wiki'] == 'y' || $this->_tpl_vars['tiki_p_edit'] == 'y' )): ?>
	<a href="tiki-editpage.php?page=<?php echo $this->_tpl_vars['page']; ?>
" class="linkmenu">اين صفحه را ايجاد كن</a>
	(page will be orphaned)<br /><br/>
<?php endif; ?>
<a href="javascript:history.back()" class="linkmenu">به جاي قبلي بازگرد</a><br /><br />
<a href="<?php echo $this->_tpl_vars['tikiIndex']; ?>
" class="linkmenu">به صفحه‌ي مبدا بازگرد</a>