<?php /* Smarty version 2.6.18, created on 2011-04-11 14:19:11
         compiled from structures.tpl */ ?>
<?php if (count ( $this->_tpl_vars['showstructs'] ) != 0): ?>
<tr class="formcolor">
	<td>Estruturas:</td>
	<td>
  [ <a class="link" href="javascript:show('showstructs');">mostrar estruturas</a>
  | <a class="link" href="javascript:hide('showstructs');">esconder estruturas</a> ]
	<div id="showstructs" style="display:none;">
	<table>
		<?php $_from = $this->_tpl_vars['showstructs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['page_info']):
?>
			<tr><td><?php echo $this->_tpl_vars['page_info']['pageName']; ?>
<?php if (! empty ( $this->_tpl_vars['page_info']['page_alias'] )): ?>(<?php echo $this->_tpl_vars['page_info']['page_alias']; ?>
)<?php endif; ?></td></tr>
		<?php endforeach; endif; unset($_from); ?>  
	</table>
  
  <?php if ($this->_tpl_vars['tiki_p_edit_structures'] == 'y'): ?>
    <a href="tiki-admin_structures.php" class="link">Administrar estruturas</a>
  <?php endif; ?>
  </div>
  </td>
</tr>
<?php endif; ?>