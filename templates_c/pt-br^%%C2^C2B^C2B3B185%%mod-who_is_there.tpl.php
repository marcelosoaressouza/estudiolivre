<?php /* Smarty version 2.6.18, created on 2011-05-02 18:35:42
         compiled from styles/obscur/modules/mod-who_is_there.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'math', 'styles/obscur/modules/mod-who_is_there.tpl', 2, false),array('modifier', 'count', 'styles/obscur/modules/mod-who_is_there.tpl', 2, false),array('block', 'tikimodule', 'styles/obscur/modules/mod-who_is_there.tpl', 3, false),)), $this); ?>

<?php echo smarty_function_math(array('equation' => "count-1",'count' => count($this->_tpl_vars['online_users']),'assign' => 'numberOfUsers'), $this);?>

<?php $this->_tag_stack[] = array('tikimodule', array('title' => "Usuári@s Online (".($this->_tpl_vars['numberOfUsers']).")",'name' => 'who_is_there','flip' => $this->_tpl_vars['module_params']['flip'])); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<?php if ($this->_tpl_vars['numberOfUsers'] >= 1): ?>
      <div id='moduleWhoIsThereMore'>
		<?php $_from = $this->_tpl_vars['online_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['onlineUser']):
?>
		  <?php if ($this->_tpl_vars['onlineUser']['user'] != $this->_tpl_vars['user']): ?>
		    <a href="el-user.php?view_user=<?php echo $this->_tpl_vars['onlineUser']['user']; ?>
"><?php echo $this->_tpl_vars['onlineUser']['user']; ?>
</a><br/>
		  <?php endif; ?>
		<?php endforeach; endif; unset($_from); ?>
      </div>
    <?php else: ?>
    	Não há usuári@s online
    <?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>