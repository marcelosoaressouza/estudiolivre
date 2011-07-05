<?php /* Smarty version 2.6.18, created on 2011-04-20 08:57:08
         compiled from fileBox.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'fileBox.tpl', 3, false),array('modifier', 'replace', 'fileBox.tpl', 5, false),array('modifier', 'truncate', 'fileBox.tpl', 8, false),array('modifier', 'show_filesize', 'fileBox.tpl', 9, false),array('block', 'tooltip', 'fileBox.tpl', 11, false),)), $this); ?>
<div id="ajax-file<?php echo $this->_tpl_vars['key']; ?>
" class="file<?php if (isset ( $this->_tpl_vars['viewFile'] ) && ( $this->_tpl_vars['key'] == $this->_tpl_vars['viewFile'] )): ?> viewing<?php endif; ?>">
	<?php if ($this->_tpl_vars['file']->thumbnail): ?>
		<img id="ajax-thumbnail<?php echo $this->_tpl_vars['key']; ?>
" class="fl" src="<?php echo $this->_tpl_vars['file']->baseDir; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['file']->thumbnail)) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" height="100" width="100">
	<?php else: ?>
		<img id="ajax-thumbnail<?php echo $this->_tpl_vars['key']; ?>
" class="fl" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iThumb<?php echo $this->_tpl_vars['file']->type; ?>
.png" height="100" width="100">
	<?php endif; ?>
	<div class="info">
		<b><?php echo ((is_array($_tmp=$this->_tpl_vars['file']->fileName)) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "(...)") : smarty_modifier_truncate($_tmp, 20, "(...)")); ?>
<br/>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['file']->size)) ? $this->_run_mod_handler('show_filesize', true, $_tmp) : smarty_modifier_show_filesize($_tmp)); ?>
</b>
		<?php if ($this->_tpl_vars['permission']): ?>
			<?php $this->_tag_stack[] = array('tooltip', array('text' => "Apagar este arquivo!")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
				<img class="pointer delFile" onClick="xajax_deleteFileReference(<?php echo $this->_tpl_vars['key']; ?>
, <?php echo $this->_tpl_vars['file']->id; ?>
);" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iDelete.png"/>
			<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php endif; ?>
		<br/>
		<br/>
		<?php if ($this->_tpl_vars['file']->isViewable()): ?>
			<a href="el-gallery_view.php?arquivoId=<?php echo $this->_tpl_vars['arquivoId']; ?>
&file=<?php echo $this->_tpl_vars['key']; ?>
">ver</a> (<?php echo $this->_tpl_vars['file']->streams; ?>
 visualizações)<br/>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['file']->commandLine && $this->_tpl_vars['permission']): ?>
			<span class="pointer" onClick="xajax_expandFile(<?php echo $this->_tpl_vars['key']; ?>
)"><b>expandir</b></span><br/>
		<?php endif; ?>
		<a href="el-download.php?pub=<?php echo $this->_tpl_vars['arquivoId']; ?>
&file=<?php echo $this->_tpl_vars['key']; ?>
">baixar</a> (<?php echo $this->_tpl_vars['file']->downloads; ?>
 afhalingen)<br/>
		<a href="<?php echo $this->_tpl_vars['file']->fullPath(); ?>
">link pro arquivo</a><br/>
	</div>
</div>
<br class="c"/>