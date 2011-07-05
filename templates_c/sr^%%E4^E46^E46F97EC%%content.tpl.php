<?php /* Smarty version 2.6.18, created on 2011-05-28 15:55:28
         compiled from styles/bolha/content.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/content.tpl', 1, false),)), $this); ?>
<?php echo smarty_function_css(array(), $this);?>


<?php if ($this->_tpl_vars['category'] == "Áudio"): ?>
	<?php $this->assign('midId', "tiki-midAudio"); ?>
<?php elseif ($this->_tpl_vars['category'] == "Gráfico"): ?>
	<?php $this->assign('midId', "tiki-midGraf"); ?>
<?php elseif ($this->_tpl_vars['category'] == "Vídeo"): ?>
	<?php $this->assign('midId', "tiki-midVideo"); ?>
<?php elseif ($this->_tpl_vars['category'] == 'gallery'): ?>
	<?php $this->assign('midId', "tiki-midAcervo"); ?>
<?php elseif ($this->_tpl_vars['section'] == 'wiki'): ?>
	<?php $this->assign('midId', "tiki-mid"); ?>
<?php else: ?>
	<?php $this->assign('midId', "tiki-midNaoWiki"); ?>
<?php endif; ?>

<!-- content.tpl begin -->
<div id="ajax-contentBubble">
   	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "sideContent.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<div id="<?php echo $this->_tpl_vars['midId']; ?>
">
	    <?php echo $this->_tpl_vars['mid_data']; ?>

    </div>
</div>
<!-- content.tpl end -->