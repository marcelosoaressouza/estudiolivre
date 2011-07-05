<h1>{tr}Browse related tags{/tr}</h1>

<div class="morcego_embedded">
<h2>{tr}Network of Tags related to{/tr}: <span id="currentTag1">{$tag}</span></h2>
<applet codebase="./lib/wiki3d" archive="morcego-0.4.0.jar" code="br.arca.morcego.Morcego" width="{$freetags_3d_width}" height="{$freetags_3d_height}">
      <param name="serverUrl" value="{$base_url}/tiki-freetag3d_xmlrpc.php">
      <param name="startNode" value="{$tag}">
      <param name="windowWidth" value="{$freetags_3d_width}">
      <param name="windowHeight" value="{$freetags_3d_height}">
      <param name="viewWidth" value="{$freetags_3d_width}">
      <param name="viewHeight" value="{$freetags_3d_height}">
      <param name="navigationDepth" value="{$freetags_3d_navigation_depth}">
      <param name="feedAnimationInterval" value="{$freetags_3d_feed_animation_interval}">
      <param name="controlWindowName" value="tiki">
      
      <param name="showArcaLogo" value="false">
      <param name="showMorcegoLogo" value="false">

      <param name="loadPageOnCenter" value="{$freetags_3d_autoload|default:"true"}">
      
      <param name="cameraDistance" value="{$freetags_3d_camera_distance|default:"200"}">
      <param name="adjustCameraPosition" value="{$freetags_3d_adjust_camera|default:"true"}">

      <param name="fieldOfView" value="{$freetags_3d_fov|default:"250"}">
      <param name="nodeSize" value="{$freetags_3d_node_size|default:"30"}">
      <param name="textSize" value="{$freetags_3d_text_size|default:"40"}">

      <param name="frictionConstant" value="{$freetags_3d_friction_constant|default:"0.4f"}">
      <param name="elasticConstant" value="{$freetags_3d_elastic_constant|default:"0.5f"}">
      <param name="eletrostaticConstant" value="{$freetags_3d_eletrostatic_constant|default:"1000f"}">
      <param name="springSize" value="{$freetags_3d_spring_size|default:"100"}">
      <param name="nodeMass" value="{$freetags_3d_node_mass|default:"5"}">
      <param name="nodeCharge" value="{$freetags_3d_node_charde|default:"1"}">

</applet>
</div>