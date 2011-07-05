<?php /* Smarty version 2.6.18, created on 2011-04-06 12:05:19
         compiled from meta-videofile.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'ajax_input', 'meta-videofile.tpl', 20, false),array('function', 'ajax_checkbox', 'meta-videofile.tpl', 36, false),)), $this); ?>
<applet code="com.fluendo.player.Cortado.class" 
        archive="lib/elgal/player/cortado-ovt.jar" 
		width="<?php if ($this->_tpl_vars['file']->width): ?><?php echo $this->_tpl_vars['file']->width; ?>
<?php else: ?>400<?php endif; ?>" height="<?php if ($this->_tpl_vars['file']->height): ?><?php echo $this->_tpl_vars['file']->height; ?>
<?php else: ?>300<?php endif; ?>">
	<param name="url" value="http://estudiolivre.org/<?php echo $this->_tpl_vars['file']->fullPath(); ?>
"/>
	<param name="video" value="true"/>
	<param name="local" value="false"/>
	<param name="keepAspect" value="true"/>
	<param name="audio" value="<?php if ($this->_tpl_vars['file']->hasAudio): ?>true<?php else: ?>false<?php endif; ?>"/>
	<?php if ($this->_tpl_vars['file']->duration): ?>
		<param name="duration" value="<?php echo $this->_tpl_vars['file']->duration; ?>
"/>
	<?php endif; ?>
	<param name="seekable" value="true"/>
	<param name="autoPlay" value="false"/>
	<param name="showStatus" value="show"/>
</applet>

<br/><br/>

<?php if ($this->_tpl_vars['file']->duration || ( ! $this->_tpl_vars['file']->duration && $this->_tpl_vars['permission'] )): ?>
	<span class="fInfo">Duration:</span> <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'value' => $this->_tpl_vars['file']->duration,'id' => 'duration','default' => "",'display' => 'inline','file' => $this->_tpl_vars['viewFile']), $this);?>
 s
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php endif; ?>

<?php if ($this->_tpl_vars['file']->width || ( ! $this->_tpl_vars['file']->width && $this->_tpl_vars['permission'] )): ?>
	<span class="fInfo">Width:</span> <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'id' => 'width','value' => $this->_tpl_vars['file']->width,'default' => "",'display' => 'inline','file' => $this->_tpl_vars['viewFile']), $this);?>
 px
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php endif; ?>

<?php if ($this->_tpl_vars['file']->height || ( ! $this->_tpl_vars['file']->height && $this->_tpl_vars['permission'] )): ?>
	<span class="fInfo">Height:</span> <?php echo smarty_function_ajax_input(array('permission' => $this->_tpl_vars['permission'],'id' => 'height','value' => $this->_tpl_vars['file']->height,'default' => "",'display' => 'inline','file' => $this->_tpl_vars['viewFile']), $this);?>
 px
<?php endif; ?>

<br/>

<?php if ($this->_tpl_vars['permission']): ?>
	<?php echo smarty_function_ajax_checkbox(array('permission' => $this->_tpl_vars['permission'],'id' => 'hasAudio','value' => $this->_tpl_vars['file']->hasAudio,'file' => $this->_tpl_vars['viewFile']), $this);?>
 <span class="fInfo">Has audio</span>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php elseif ($this->_tpl_vars['file']->hasAudio): ?>
	<span class="fInfo">Has audio</span>
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php endif; ?>

<?php if ($this->_tpl_vars['permission']): ?>
	<?php echo smarty_function_ajax_checkbox(array('permission' => $this->_tpl_vars['permission'],'id' => 'hasColor','value' => $this->_tpl_vars['file']->hasColor,'file' => $this->_tpl_vars['viewFile']), $this);?>
 <span class="fInfo">Is Colored</span>
<?php elseif ($this->_tpl_vars['file']->hasColor): ?>
	<span class="fInfo">Is Colored</span>
<?php endif; ?>