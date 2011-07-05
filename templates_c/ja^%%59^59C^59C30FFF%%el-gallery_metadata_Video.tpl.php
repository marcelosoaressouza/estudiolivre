<?php /* Smarty version 2.6.18, created on 2011-04-04 19:23:33
         compiled from el-gallery_metadata_Video.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ajax_input', 'el-gallery_metadata_Video.tpl', 2, false),array('function', 'ajax_checkbox', 'el-gallery_metadata_Video.tpl', 6, false),array('function', 'ajax_textarea', 'el-gallery_metadata_Video.tpl', 17, false),)), $this); ?>
<?php if ($this->_tpl_vars['file']->language || ( ! $this->_tpl_vars['file']->language && $this->_tpl_vars['permission'] )): ?>
<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName">Idioma do Vídeo:</div> <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'value' => $this->_tpl_vars['arquivo']->language,'id' => 'language','default' => "",'display' => 'inline'), $this);?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['arquivo']->subtitled || ( ! $this->_tpl_vars['arquivo']->subtitled && $this->_tpl_vars['permission'] )): ?>
<div class="gUpMoreOptionsItem"><div class="gUpMoreOptionsName" onClick="flip('aLegenda')"><?php echo smarty_function_ajax_checkbox(array('permission' => $this->_tpl_vars['permission'],'id' => 'subtitled','value' => $this->_tpl_vars['arquivo']->subtitled), $this);?>
</div> Tem legenda</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['arquivo']->subtitleLanguage || ( ! $this->_tpl_vars['arquivo']->subtitleLanguage && $this->_tpl_vars['permission'] )): ?>
<div id="aLegenda" class="gUpMoreOptionsItem" style="display:<?php if ($this->_tpl_vars['arquivo']->subtitled): ?>block<?php else: ?>none<?php endif; ?>;">
<div class="gUpMoreOptionsName">Idioma da Legenda:</div> <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'value' => $this->_tpl_vars['arquivo']->subtitleLanguage,'id' => 'subtitleLanguage','default' => "",'display' => 'inline'), $this);?>
</div>
<br/>
<?php endif; ?>

<?php if ($this->_tpl_vars['arquivo']->details || ( ! $this->_tpl_vars['arquivo']->details && $this->_tpl_vars['permission'] )): ?>
<div class="gUpMoreOptionsItemSingle"><div class="gUpMoreOptionsName">Ficha Técnica:</div></div>
<?php echo smarty_function_ajax_textarea(array('permission' => $this->_tpl_vars['permission'],'value' => $this->_tpl_vars['arquivo']->details,'id' => 'details','default' => "",'display' => 'block','style' => "width: 235px; height:125px; border: 1px inset rgb(233, 233, 174);padding: 3px;font-size: 12px; font-family: Arial, Verdana, Helvetica, Lucida, Sans-Serif;background-color: #f1f1f1;margin-bottom: 5px;",'wikiParsed' => 1), $this);?>

<?php endif; ?>