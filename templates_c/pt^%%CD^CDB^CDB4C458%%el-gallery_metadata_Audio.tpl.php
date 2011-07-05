<?php /* Smarty version 2.6.18, created on 2011-04-04 18:24:40
         compiled from el-gallery_metadata_Audio.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ajax_input', 'el-gallery_metadata_Audio.tpl', 2, false),array('function', 'ajax_textarea', 'el-gallery_metadata_Audio.tpl', 15, false),)), $this); ?>
<?php if ($this->_tpl_vars['arquivo']->typeOfAudio || ( ! $this->_tpl_vars['arquivo']->typeOfAudio && $this->_tpl_vars['permission'] )): ?>
	<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">Tipo do audio:</div> <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'value' => $this->_tpl_vars['arquivo']->typeOfAudio,'id' => 'typeOfAudio','default' => "",'display' => 'inline'), $this);?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['arquivo']->genre || ( ! $this->_tpl_vars['arquivo']->genre && $this->_tpl_vars['permission'] )): ?>
<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">Gênero:</div> <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'value' => $this->_tpl_vars['arquivo']->genre,'id' => 'genre','default' => "",'display' => 'inline'), $this);?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['arquivo']->album || ( ! $this->_tpl_vars['arquivo']->album && $this->_tpl_vars['permission'] )): ?>
<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">Álbum:</div> <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'value' => $this->_tpl_vars['arquivo']->album,'id' => 'album','default' => "",'display' => 'inline'), $this);?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['arquivo']->lyrics || ( ! $this->_tpl_vars['arquivo']->lyrics && $this->_tpl_vars['permission'] )): ?>
<div class="gUpMoreOptionsItemSingle"><div class="gUpMoreOptionsName">lyrics:</div></div>
<?php echo smarty_function_ajax_textarea(array('permission' => $this->_tpl_vars['permission'],'value' => $this->_tpl_vars['arquivo']->lyrics,'id' => 'lyrics','default' => "",'display' => 'block','style' => "width: 235px; height:125px; border: 1px inset rgb(233, 233, 174);padding: 3px;font-size: 12px; font-family: Arial, Verdana, Helvetica, Lucida, Sans-Serif;background-color: #f1f1f1;margin-bottom: 5px;",'wikiParsed' => 1), $this);?>
<br/>
<?php endif; ?>

<?php if ($this->_tpl_vars['arquivo']->details || ( ! $this->_tpl_vars['arquivo']->details && $this->_tpl_vars['permission'] )): ?>
<div class="gUpMoreOptionsItemSingle"><div class="gUpMoreOptionsName">Ficha Técnica:</div></div>
<?php echo smarty_function_ajax_textarea(array('permission' => $this->_tpl_vars['permission'],'value' => $this->_tpl_vars['arquivo']->details,'id' => 'details','default' => "",'display' => 'block','style' => "width: 235px; height:125px; border: 1px inset rgb(233, 233, 174);padding: 3px;font-size: 12px; font-family: Arial, Verdana, Helvetica, Lucida, Sans-Serif;background-color: #f1f1f1;margin-bottom: 5px;",'wikiParsed' => 1), $this);?>
<br/>
<?php endif; ?>