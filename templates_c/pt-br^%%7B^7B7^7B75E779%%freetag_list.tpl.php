<?php /* Smarty version 2.6.18, created on 2011-04-04 19:21:36
         compiled from freetag_list.tpl */ ?>
<?php if ($this->_tpl_vars['feature_freetags'] == 'y' && $this->_tpl_vars['tiki_p_view_freetags'] == 'y' && isset ( $this->_tpl_vars['freetags']['data'][0] )): ?>
<div class="freetaglist">Tags: 
<?php $_from = $this->_tpl_vars['freetags']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['taginfo']):
?>
<a class="freetag" href="tiki-browse_freetags.php?tag=<?php echo $this->_tpl_vars['taginfo']['tag']; ?>
"><?php echo $this->_tpl_vars['taginfo']['tag']; ?>
</a>
<?php endforeach; endif; unset($_from); ?>
</div>
<?php endif; ?>