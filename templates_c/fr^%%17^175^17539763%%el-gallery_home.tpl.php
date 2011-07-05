<?php /* Smarty version 2.6.18, created on 2011-05-12 04:28:43
         compiled from el-gallery_home.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'el-gallery_home.tpl', 2, false),array('block', 'tooltip', 'el-gallery_home.tpl', 26, false),array('modifier', 'replace', 'el-gallery_home.tpl', 27, false),)), $this); ?>
<!-- el-gallery_home.tpl begin -->
<?php echo smarty_function_css(array('extra' => "tiki-show_page"), $this);?>


<script language="JavaScript" src="lib/js/el_array.js"></script>
<script language="JavaScript" src="lib/elgal/el_home.js"></script>
<script language="JavaScript" src="lib/js/delete_file.js"></script>

<script language="JavaScript">
	init('<?php echo $this->_tpl_vars['find']; ?>
');
	<?php $_from = $this->_tpl_vars['tipos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tipo']):
?>tipos.add('<?php echo $this->_tpl_vars['tipo']; ?>
');<?php endforeach; endif; unset($_from); ?>
</script>

<?php if ($_COOKIE['gHomeWikiToggle'] == 'none'): ?>
	<?php $this->assign('display', 'none'); ?>
	<?php $this->assign('imgCurrent', 'iGreenArrowLeft'); ?>
	<?php $this->assign('imgChange', 'sortArrowDown'); ?>	
<?php else: ?>
	<?php $this->assign('display', 'block'); ?>
	<?php $this->assign('imgCurrent', 'sortArrowDown'); ?>
	<?php $this->assign('imgChange', 'iGreenArrowLeft'); ?>	
<?php endif; ?>

<!-- Feature Wiki Begin -->
<div id="gHomeWiki" <?php if ($this->_tpl_vars['tiki_p_edit'] == 'y'): ?> ondblclick="location.href='tiki-editpage.php?page=destak'"<?php endif; ?>>
	<span id="gHomeWikiTitle">
		<?php $this->_tag_stack[] = array('tooltip', array('name' => "home-flip-destaques",'text' => "Alternar a visualização dos destaques")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<img class="pointer" onclick="flip('modulegHomeWikiToggle');toggleImage(this,'<?php echo $this->_tpl_vars['imgChange']; ?>
.png');storeState('gHomeWikiToggle')" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/<?php echo $this->_tpl_vars['imgCurrent']; ?>
.png">
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	</span>
	<div id="modulegHomeWikiToggle" style="display:<?php echo $this->_tpl_vars['display']; ?>
;">
		<?php echo $this->_tpl_vars['destak']; ?>

	</div>
	
	<div id="gHomeWikiBottom">
		<?php $this->_tag_stack[] = array('tooltip', array('text' => "<i>Feed</i> &nbsp;<b>RSS</b> do acervo.livre")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			<a href="tiki-index.php?page=RSS+do+Acervo+Livre">
				<up style="position:relative; top:-4px;">Assinar RSS do acervo</up> <img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iRss.png">
			</a>
		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	</div>
</div>

<!-- Feature Wiki End -->
	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "el-gallery_list_filters.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="ajax-gListCont">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "el-gallery_section.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>

<center><div id="ajax-navBottom" class="listNav"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "el-gallery_pagination.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div></center>
	
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "el-gallery_confirm_delete.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<!-- el-gallery_home.tpl end -->