<?php /* Smarty version 2.6.18, created on 2011-04-16 02:14:36
         compiled from tiki-wiki3d.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'tiki-wiki3d.tpl', 18, false),)), $this); ?>
<html>

  <body style="margin-top: 0px; margin-left: 0px">
    <applet codebase="./lib/wiki3d" archive="morcego-0.4.0.jar" code="br.arca.morcego.Morcego" width="<?php echo $this->_tpl_vars['wiki_3d_width']; ?>
" height="<?php echo $this->_tpl_vars['wiki_3d_height']; ?>
">
      <param name="serverUrl" value="<?php echo $this->_tpl_vars['base_url']; ?>
/tiki-wiki3d_xmlrpc.php">
      <param name="startNode" value="<?php echo $this->_tpl_vars['page']; ?>
">
      <param name="windowWidth" value="<?php echo $this->_tpl_vars['wiki_3d_width']; ?>
">
      <param name="windowHeight" value="<?php echo $this->_tpl_vars['wiki_3d_height']; ?>
">
      <param name="viewWidth" value="<?php echo $this->_tpl_vars['wiki_3d_width']; ?>
">
      <param name="viewHeight" value="<?php echo $this->_tpl_vars['wiki_3d_height']; ?>
">
      <param name="navigationDepth" value="<?php echo $this->_tpl_vars['wiki_3d_navigation_depth']; ?>
">
      <param name="feedAnimationInterval" value="<?php echo $this->_tpl_vars['wiki_3d_feed_animation_interval']; ?>
">
      <param name="controlWindowName" value="tiki">
      
      <param name="showArcaLogo" value="false">
      <param name="showMorcegoLogo" value="false">

      <param name="loadPageOnCenter" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['wiki_3d_autoload'])) ? $this->_run_mod_handler('default', true, $_tmp, 'true') : smarty_modifier_default($_tmp, 'true')); ?>
">
      
      <param name="cameraDistance" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['wiki_3d_camera_distance'])) ? $this->_run_mod_handler('default', true, $_tmp, '200') : smarty_modifier_default($_tmp, '200')); ?>
">
      <param name="adjustCameraPosition" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['wiki_3d_adjust_camera'])) ? $this->_run_mod_handler('default', true, $_tmp, 'true') : smarty_modifier_default($_tmp, 'true')); ?>
">

      <param name="fieldOfView" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['wiki_3d_fov'])) ? $this->_run_mod_handler('default', true, $_tmp, '250') : smarty_modifier_default($_tmp, '250')); ?>
">
      <param name="nodeSize" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['wiki_3d_node_size'])) ? $this->_run_mod_handler('default', true, $_tmp, '30') : smarty_modifier_default($_tmp, '30')); ?>
">
      <param name="textSize" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['wiki_3d_text_size'])) ? $this->_run_mod_handler('default', true, $_tmp, '40') : smarty_modifier_default($_tmp, '40')); ?>
">

      <param name="frictionConstant" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['wiki_3d_friction_constant'])) ? $this->_run_mod_handler('default', true, $_tmp, "0.4f") : smarty_modifier_default($_tmp, "0.4f")); ?>
">
      <param name="elasticConstant" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['wiki_3d_elastic_constant'])) ? $this->_run_mod_handler('default', true, $_tmp, "0.5f") : smarty_modifier_default($_tmp, "0.5f")); ?>
">
      <param name="eletrostaticConstant" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['wiki_3d_eletrostatic_constant'])) ? $this->_run_mod_handler('default', true, $_tmp, '1000f') : smarty_modifier_default($_tmp, '1000f')); ?>
">
      <param name="springSize" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['wiki_3d_spring_size'])) ? $this->_run_mod_handler('default', true, $_tmp, '100') : smarty_modifier_default($_tmp, '100')); ?>
">
      <param name="nodeMass" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['wiki_3d_node_mass'])) ? $this->_run_mod_handler('default', true, $_tmp, '5') : smarty_modifier_default($_tmp, '5')); ?>
">
      <param name="nodeCharge" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['wiki_3d_node_charde'])) ? $this->_run_mod_handler('default', true, $_tmp, '1') : smarty_modifier_default($_tmp, '1')); ?>
">

    </applet>

  </body>
</html>