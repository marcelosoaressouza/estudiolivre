<?php /* Smarty version 2.6.18, created on 2011-04-04 17:12:39
         compiled from el-tag_cloud.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'el-tag_cloud.tpl', 1, false),array('modifier', 'userlink', 'el-tag_cloud.tpl', 5, false),array('modifier', 'replace', 'el-tag_cloud.tpl', 13, false),)), $this); ?>
<?php echo smarty_function_css(array(), $this);?>

<div id="tagCloud">
	<h1>
		<?php if ($this->_tpl_vars['tagsForUser']): ?>
			Tags do usuário <?php echo ((is_array($_tmp=$this->_tpl_vars['tagsForUser'])) ? $this->_run_mod_handler('userlink', true, $_tmp) : smarty_modifier_userlink($_tmp)); ?>

		<?php else: ?>
			Tags do estúdiolivre.org
		<?php endif; ?>
	</h1>
	
	<h5>
		<span class="pointer" onclick="javascript:flip('tagOptions');toggleImage(document.getElementById('TArrowTag'),'iArrowGreyDown.png');">
			Especificar... <?php echo $this->_tpl_vars['module_title']; ?>
<img id="TArrowTag"  src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyLeft.png">
		</span>
		<div id="tagOptions" style="display: none;">
			<form method="get" action="el-tag_cloud.php">
				Usuário: <br>
				<input name="tagsForUser" value="" class="input" type="text"><br>
			    <input value="buscar" type="submit">
		    </form>
		</div>
	</h5>
	<span>
	<?php $_from = $this->_tpl_vars['popularTags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tag']):
?>
		<a href="tiki-browse_freetags.php?tag=<?php echo $this->_tpl_vars['tag']['tag']; ?>
" style="font-size:<?php echo $this->_tpl_vars['tag']['size']+6; ?>
pt"><?php echo $this->_tpl_vars['tag']['tag']; ?>
</a>&nbsp;&nbsp;
	<?php endforeach; else: ?>
		Esse usuário não tem tags! Veja uma lista com <a href="el-tag_cloud.php">todas</a> as tags.
	<?php endif; unset($_from); ?>
	</span>
	<?php if ($this->_tpl_vars['tagsForUser']): ?>
		<h5>
			<a href="el-tag_cloud.php">Ver tags de todos</a>
		</h5>
	<?php endif; ?>
</div>