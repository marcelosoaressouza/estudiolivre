<?php /* Smarty version 2.6.18, created on 2011-04-19 20:27:59
         compiled from modules/mod-el_gallery.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tikimodule', 'modules/mod-el_gallery.tpl', 1, false),array('block', 'tooltip', 'modules/mod-el_gallery.tpl', 3, false),array('modifier', 'replace', 'modules/mod-el_gallery.tpl', 11, false),array('modifier', 'default', 'modules/mod-el_gallery.tpl', 14, false),array('modifier', 'truncate', 'modules/mod-el_gallery.tpl', 14, false),)), $this); ?>
<?php $this->_tag_stack[] = array('tikimodule', array('title' => 'Gallery','name' => 'el_gallery','flip' => $this->_tpl_vars['module_params']['flip'])); $_block_repeat=true;smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	    <div class="modCenterContent">
	    	<?php $this->_tag_stack[] = array('tooltip', array('text' => "Veja os arquivos que você publicou")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="el-user.php?view_user=<?php echo $this->_tpl_vars['user']; ?>
#gallery">My files</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><br>
	    	<?php $this->_tag_stack[] = array('tooltip', array('text' => "Publique <b>sua obra</b> no Estúdio Livre!")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="el-gallery_upload.php">Publish</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	    </div>
	   <?php if (! preg_match ( "/el-gallery_upload.php/" , $this->_tpl_vars['current_location'] ) && sizeof ( $this->_tpl_vars['pendingUploadFiles'] ) > 0): ?>
  	    <hr>
	 		<span style="text-align:left">Unpublished files:</span><br/>
			<?php $_from = $this->_tpl_vars['pendingUploadFiles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pendente']):
?>
				<span id="ajax-pendente-<?php echo $this->_tpl_vars['pendente']->id; ?>
">
					<?php $this->_tag_stack[] = array('tooltip', array('text' => "<b>Apague</b> esse arquivo da lista (e do servidor)")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="el-gallery_delete.php?arquivoId=<?php echo $this->_tpl_vars['pendente']->id; ?>
"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iDelete.png"></a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php $this->_tag_stack[] = array('tooltip', array('text' => 'Clique para continuar o envio desse arquivo')); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
						<a href="el-gallery_upload.php?arquivoId=<?php echo $this->_tpl_vars['pendente']->id; ?>
">
							<?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=@$this->_tpl_vars['pendente']->title)) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['pendente']->filereferences[0]->fileName) : smarty_modifier_default($_tmp, @$this->_tpl_vars['pendente']->filereferences[0]->fileName)))) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['pendente']->id) : smarty_modifier_default($_tmp, @$this->_tpl_vars['pendente']->id)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "(...)") : smarty_modifier_truncate($_tmp, 20, "(...)")); ?>

						</a>
					<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				</span>
				<br/>
			<?php endforeach; endif; unset($_from); ?>
		 <?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tikimodule($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>