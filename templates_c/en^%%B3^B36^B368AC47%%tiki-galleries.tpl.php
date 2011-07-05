<?php /* Smarty version 2.6.18, created on 2011-04-04 18:42:22
         compiled from tiki-galleries.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'tiki-galleries.tpl', 26, false),array('modifier', 'tiki_short_datetime', 'tiki-galleries.tpl', 181, false),array('modifier', 'times', 'tiki-galleries.tpl', 252, false),array('function', 'cycle', 'tiki-galleries.tpl', 166, false),array('function', 'html_image', 'tiki-galleries.tpl', 198, false),)), $this); ?>
<h1><a href="tiki-galleries.php" class="pagetitle">Galleries</a>

      <?php if ($this->_tpl_vars['feature_help'] == 'y'): ?>
<a href="<?php echo $this->_tpl_vars['helpurl']; ?>
Image+Gallery" target="tikihelp" class="tikihelp" title="Image Gallery">
<img src="img/icons/help.gif" border="0" height="16" width="16" alt='help' /></a><?php endif; ?>


      <?php if ($this->_tpl_vars['feature_view_tpl'] == 'y' && $this->_tpl_vars['tiki_p_view_templates'] == 'y'): ?>
<a href="tiki-edit_templates.php?template=tiki-galleries.tpl" target="tikihelp" class="tikihelp" title="View tpl: galleries tpl">
<img src="img/icons/info.gif" border="0" height="16" width="16" alt='edit tpl' /></a><?php endif; ?>

<?php if ($this->_tpl_vars['tiki_p_admin'] == 'y'): ?>
<a href="tiki-admin.php?page=gal"><img src='img/icons/config.gif' border='0'  alt="configure listing" title="configure listing" /></a>
<?php endif; ?></h1>

<?php if ($this->_tpl_vars['tiki_p_create_galleries'] == 'y'): ?>
<?php if ($this->_tpl_vars['edit_mode'] != 'y' || $this->_tpl_vars['galleryId'] != 0): ?><div class="navbar"><a class="linkbut" href="tiki-galleries.php?edit_mode=1&amp;galleryId=0">create new gallery</a><?php if ($this->_tpl_vars['feature_gal_imgcache'] == 'y'): ?> <a class="linkbut" href="tiki-galleries.php?rebuild_imgcache=1&amp;galleryId=0">rebuild cache</a><?php endif; ?></div><?php endif; ?>
<?php if ($this->_tpl_vars['edit_mode'] == 'y'): ?>
<?php if ($this->_tpl_vars['galleryId'] == 0): ?>
<h2>Create a gallery</h2>
<?php else: ?>
<h2>Edit this gallery: <?php echo $this->_tpl_vars['name']; ?>
</h2>
<?php endif; ?>
<div align="center">
<?php if ($this->_tpl_vars['individual'] == 'y'): ?>
<a class="gallink" href="tiki-objectpermissions.php?objectName=<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;objectType=image+gallery&amp;permType=image+galleries&amp;objectId=<?php echo $this->_tpl_vars['galleryId']; ?>
">There are individual permissions set for this gallery</a>
<?php endif; ?>
<form action="tiki-galleries.php" method="post" id="gal-edit-form">
<input type="hidden" name="galleryId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['galleryId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<table class="normal">
<tr><td class="formcolor">Name:</td><td class="formcolor"><input type="text" name="name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/></td></tr>
<tr><td class="formcolor">Description:<br /><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "textareasize.tpl", 'smarty_include_vars' => array('area_name' => 'gal-desc','formId' => 'gal-edit-form')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td><td class="formcolor"><textarea   rows="<?php echo $this->_tpl_vars['rows']; ?>
" cols="<?php echo $this->_tpl_vars['cols']; ?>
" name="description" id="gal-desc"><?php echo ((is_array($_tmp=$this->_tpl_vars['description'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea></td></tr>
<?php if ($this->_tpl_vars['tiki_p_admin_galleries'] == 'y'): ?>
<tr><td class="formcolor">Gallery is visible to non-admin users?</td><td class="formcolor"><input type="checkbox" name="visible" <?php if ($this->_tpl_vars['visible'] == 'y'): ?>checked="checked"<?php endif; ?> /></td></tr>

<?php else: ?>
<input type="hidden" name="visible" value="on" />
<?php endif; ?>
<?php if ($this->_tpl_vars['feature_maps'] == 'y'): ?>
<tr><td class="formcolor">Geographic:</td><td class="formcolor"><input type="checkbox" name="geographic" <?php if ($this->_tpl_vars['geographic'] == 'y'): ?>checked="checked"<?php endif; ?> /></td></tr>
<?php endif; ?>
<tr><td class="formcolor">Max Rows per page:</td><td class="formcolor"><input type="text" name="maxRows" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['maxRows'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></td></tr>
<tr><td class="formcolor">Images per row:</td><td class="formcolor"><input type="text" name="rowImages" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['rowImages'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></td></tr>
<tr><td class="formcolor">Thumbnails size X:</td><td class="formcolor"><input type="text" name="thumbSizeX" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['thumbSizeX'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></td></tr>
<tr><td class="formcolor">Thumbnails size Y:</td><td class="formcolor"><input type="text" name="thumbSizeY" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['thumbSizeY'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></td></tr>
<tr><td class="formcolor">Default sort order:</td><td class="formcolor"><select name="sortorder">
<?php $_from = $this->_tpl_vars['options_sortorder']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($this->_tpl_vars['sortorder'] == $this->_tpl_vars['item']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['key']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
<input type="radio" name="sortdirection" value="desc" <?php if ($this->_tpl_vars['sortdirection'] == 'desc'): ?>checked="checked"<?php endif; ?> />descending
<input type="radio" name="sortdirection" value="asc" <?php if ($this->_tpl_vars['sortdirection'] == 'asc'): ?>checked="checked"<?php endif; ?> />ascending
</td></tr>
<tr><td class="formcolor">Fields to show during browsing the gallery:</td>
<td class="formcolor">
	<input type="checkbox" name="showname" value="y" <?php if ($this->_tpl_vars['showname'] == 'y'): ?>checked="checked"<?php endif; ?> />Name<br />
	<input type="checkbox" name="showimageid" value="y" <?php if ($this->_tpl_vars['showimageid'] == 'y'): ?>checked="checked"<?php endif; ?> />Image ID<br />
	<input type="checkbox" name="showdescription" value="y" <?php if ($this->_tpl_vars['showdescription'] == 'y'): ?>checked="checked"<?php endif; ?> />Description<br />
	<input type="checkbox" name="showcreated" value="y" <?php if ($this->_tpl_vars['showcreated'] == 'y'): ?>checked="checked"<?php endif; ?> />Creation Date<br />
	<input type="checkbox" name="showuser" value="y" <?php if ($this->_tpl_vars['showuser'] == 'y'): ?>checked="checked"<?php endif; ?> />User<br />
	<input type="checkbox" name="showhits" value="y" <?php if ($this->_tpl_vars['showhits'] == 'y'): ?>checked="checked"<?php endif; ?> />Hits<br />
	<input type="checkbox" name="showxysize" value="y" <?php if ($this->_tpl_vars['showxysize'] == 'y'): ?>checked="checked"<?php endif; ?> />XY-Size<br />
	<input type="checkbox" name="showfilesize" value="y" <?php if ($this->_tpl_vars['showfilesize'] == 'y'): ?>checked="checked"<?php endif; ?> />Filesize<br />
	<input type="checkbox" name="showfilename" value="y" <?php if ($this->_tpl_vars['showfilename'] == 'y'): ?>checked="checked"<?php endif; ?> />Filename<br />
</td></tr>
<tr><td class="formcolor">Gallery Image:</td><td class="formcolor"><select name="galleryimage">
<?php $_from = $this->_tpl_vars['options_galleryimage']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($this->_tpl_vars['galleryimage'] == $this->_tpl_vars['item']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['key']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td></tr>
<tr><td class="formcolor">Parent gallery:</td><td class="formcolor"><select name="parentgallery">
<option value="-1" <?php if ($this->_tpl_vars['parentgallery'] == -1): ?> selected="selected"<?php endif; ?>>none</option>
<?php $_from = $this->_tpl_vars['galleries_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
<option value="<?php echo $this->_tpl_vars['item']['galleryId']; ?>
" <?php if ($this->_tpl_vars['parentgallery'] == $this->_tpl_vars['item']['galleryId']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item']['name']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
</td></tr>
<tr><td class="formcolor">Available scales:</td><td class="formcolor">
<?php unset($this->_sections['scales']);
$this->_sections['scales']['name'] = 'scales';
$this->_sections['scales']['loop'] = is_array($_loop=$this->_tpl_vars['scaleinfo']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['scales']['show'] = true;
$this->_sections['scales']['max'] = $this->_sections['scales']['loop'];
$this->_sections['scales']['step'] = 1;
$this->_sections['scales']['start'] = $this->_sections['scales']['step'] > 0 ? 0 : $this->_sections['scales']['loop']-1;
if ($this->_sections['scales']['show']) {
    $this->_sections['scales']['total'] = $this->_sections['scales']['loop'];
    if ($this->_sections['scales']['total'] == 0)
        $this->_sections['scales']['show'] = false;
} else
    $this->_sections['scales']['total'] = 0;
if ($this->_sections['scales']['show']):

            for ($this->_sections['scales']['index'] = $this->_sections['scales']['start'], $this->_sections['scales']['iteration'] = 1;
                 $this->_sections['scales']['iteration'] <= $this->_sections['scales']['total'];
                 $this->_sections['scales']['index'] += $this->_sections['scales']['step'], $this->_sections['scales']['iteration']++):
$this->_sections['scales']['rownum'] = $this->_sections['scales']['iteration'];
$this->_sections['scales']['index_prev'] = $this->_sections['scales']['index'] - $this->_sections['scales']['step'];
$this->_sections['scales']['index_next'] = $this->_sections['scales']['index'] + $this->_sections['scales']['step'];
$this->_sections['scales']['first']      = ($this->_sections['scales']['iteration'] == 1);
$this->_sections['scales']['last']       = ($this->_sections['scales']['iteration'] == $this->_sections['scales']['total']);
?>
Remove:<input type="checkbox" name="removescale_<?php echo ((is_array($_tmp=$this->_tpl_vars['scaleinfo'][$this->_sections['scales']['index']]['scale'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<?php echo $this->_tpl_vars['scaleinfo'][$this->_sections['scales']['index']]['scale']; ?>
x<?php echo $this->_tpl_vars['scaleinfo'][$this->_sections['scales']['index']]['scale']; ?>
 (Bounding box) <input type="radio" name="defaultscale" value="<?php echo $this->_tpl_vars['scaleinfo'][$this->_sections['scales']['index']]['scale']; ?>
" <?php if ($this->_tpl_vars['defaultscale'] == $this->_tpl_vars['scaleinfo'][$this->_sections['scales']['index']]['scale']): ?>checked="checked"<?php endif; ?> />default scale<br />
<?php endfor; else: ?>
No scales available
<?php endif; ?><br />
Original image is default scale<input type="radio" name="defaultscale" value="o" <?php if ($this->_tpl_vars['defaultscale'] == 'o'): ?>checked="checked"<?php endif; ?> />
</td></tr>
<tr><td class="formcolor">Add scaled images with bounding box of square size:</td><td class="formcolor"><input type="text" name="scaleSize" /> pixels</td></tr>
<tr><td class="formcolor">Owner of the gallery:</td><td class="formcolor"><input type="text" name="owner" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['owner'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/></td></tr>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "categorize.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<tr><td class="formcolor">Other users can upload images to this gallery:</td><td class="formcolor"><input type="checkbox" name="public" <?php if ($this->_tpl_vars['public'] == 'y'): ?>checked="checked"<?php endif; ?>/></td></tr>
<tr><td class="formcolor">&nbsp;</td><td class="formcolor"><input type="submit" value="save" name="edit" /></td></tr>
</table>
</form>
</div>
<br />
<?php endif; ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['galleryId'] > 0): ?>
<?php if ($this->_tpl_vars['edited'] == 'y'): ?>
<div class="wikitext">
You can access the gallery using the following URL: <a class="gallink" href="<?php echo $this->_tpl_vars['url']; ?>
?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
"><?php echo $this->_tpl_vars['url']; ?>
?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
</a>
</div>
<?php endif; ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['tiki_p_create_galleries'] == 'y' && $this->_tpl_vars['galleryId'] != 0): ?>
<div class="navbar"><a class="linkbut" href="tiki-galleries.php?edit_mode=1&amp;galleryId=0">create new gallery</a></div>
<?php endif; ?>
<h2>Available Galleries</h2>
<div align="center">

<?php if ($this->_tpl_vars['cant_pages'] > 1): ?>
<table class="findtable">
<tr><td class="findtable">Find</td>
   <td class="findtable">
   <form method="get" action="tiki-galleries.php">
     <input type="text" name="find" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['find'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
     <input type="submit" value="find" name="search" />
     <input type="hidden" name="sort_mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['sort_mode'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
   </form>
   </td>
</tr>
</table>


<div>
<form action="tiki-galleries.php" method="get">
<select name="filter">
<option value="">Choose a filter</option>
<option value="topgal"<?php if ($this->_tpl_vars['filter'] == 'topgal'): ?> selected="selected"<?php endif; ?>>Top</option>
<option value="parentgal"<?php if ($this->_tpl_vars['filter'] == 'parentgal'): ?> selected="selected"<?php endif; ?>>Parent gallery</option>

</select>
<input type="submit" value="filter" />
</form>
</div>
<?php endif; ?> 


<table class="normal">
<tr>
<?php if ($this->_tpl_vars['gal_list_name'] == 'y'): ?>
<td class="heading"><a class="tableheading" href="tiki-galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'name_desc'): ?>name_asc<?php else: ?>name_desc<?php endif; ?>">Name</a></td>
<td class="heading">Parent</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_list_description'] == 'y'): ?>
<td class="heading"><a class="tableheading" href="tiki-galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'description_desc'): ?>description_asc<?php else: ?>description_desc<?php endif; ?>">Description</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_list_created'] == 'y'): ?>
<td class="heading"><a class="tableheading" href="tiki-galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'created_desc'): ?>created_asc<?php else: ?>created_desc<?php endif; ?>">Created</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_list_lastmodif'] == 'y'): ?>
<td class="heading"><a class="tableheading" href="tiki-galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'lastModif_desc'): ?>lastModif_asc<?php else: ?>lastModif_desc<?php endif; ?>">Last modified</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_list_user'] == 'y'): ?>
<td class="heading"><a class="tableheading" href="tiki-galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'user_desc'): ?>user_asc<?php else: ?>user_desc<?php endif; ?>">User</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_list_imgs'] == 'y'): ?>
<td style="text-align:right;"  class="heading"><a class="tableheading" href="tiki-galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'images_desc'): ?>images_asc<?php else: ?>images_desc<?php endif; ?>">Imgs</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_list_visits'] == 'y'): ?>
<td style="text-align:right;"  class="heading"><a class="tableheading" href="tiki-galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'hits_desc'): ?>hits_asc<?php else: ?>hits_desc<?php endif; ?>">Visits</a></td>
<?php endif; ?>
<td  class="heading">Actions</td>
</tr>
<?php echo smarty_function_cycle(array('values' => "odd,even",'print' => false), $this);?>

<?php unset($this->_sections['changes']);
$this->_sections['changes']['name'] = 'changes';
$this->_sections['changes']['loop'] = is_array($_loop=$this->_tpl_vars['galleries']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['changes']['show'] = true;
$this->_sections['changes']['max'] = $this->_sections['changes']['loop'];
$this->_sections['changes']['step'] = 1;
$this->_sections['changes']['start'] = $this->_sections['changes']['step'] > 0 ? 0 : $this->_sections['changes']['loop']-1;
if ($this->_sections['changes']['show']) {
    $this->_sections['changes']['total'] = $this->_sections['changes']['loop'];
    if ($this->_sections['changes']['total'] == 0)
        $this->_sections['changes']['show'] = false;
} else
    $this->_sections['changes']['total'] = 0;
if ($this->_sections['changes']['show']):

            for ($this->_sections['changes']['index'] = $this->_sections['changes']['start'], $this->_sections['changes']['iteration'] = 1;
                 $this->_sections['changes']['iteration'] <= $this->_sections['changes']['total'];
                 $this->_sections['changes']['index'] += $this->_sections['changes']['step'], $this->_sections['changes']['iteration']++):
$this->_sections['changes']['rownum'] = $this->_sections['changes']['iteration'];
$this->_sections['changes']['index_prev'] = $this->_sections['changes']['index'] - $this->_sections['changes']['step'];
$this->_sections['changes']['index_next'] = $this->_sections['changes']['index'] + $this->_sections['changes']['step'];
$this->_sections['changes']['first']      = ($this->_sections['changes']['iteration'] == 1);
$this->_sections['changes']['last']       = ($this->_sections['changes']['iteration'] == $this->_sections['changes']['total']);
?>
<?php if (( $this->_tpl_vars['filter'] == 'topgal' && $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['parentgallery'] == -1 ) || ( $this->_tpl_vars['filter'] == 'parentgal' && $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['parentgal'] == 'y' ) || ( $this->_tpl_vars['filter'] == '' )): ?>
<?php if ($this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['visible'] == 'y' || $this->_tpl_vars['tiki_p_admin_galleries'] == 'y'): ?>
<tr>
<?php if ($this->_tpl_vars['gal_list_name'] == 'y'): ?>
  <td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><a class="galname" href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['galleryId']; ?>
"><?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['name']; ?>
</a></td><td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">
  <?php if ($this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['parentgallery'] != -1): ?><a class="galname" href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['parentgallery']; ?>
"><?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['parentgalleryName']; ?>
</a><?php endif; ?>
  <?php if ($this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['parentgal'] == 'y'): ?><i>Parent</i><?php endif; ?>
  </td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_list_description'] == 'y'): ?>
  <td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['description']; ?>
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_list_created'] == 'y'): ?>
  <td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['created'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_list_lastmodif'] == 'y'): ?>
  <td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['lastModif'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_list_user'] == 'y'): ?>
  <td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['user']; ?>
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_list_imgs'] == 'y'): ?>
  <td style="text-align:right;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['images']; ?>
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_list_visits'] == 'y'): ?>
  <td style="text-align:right;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['hits']; ?>
</td>
<?php endif; ?>
  <td class="<?php echo smarty_function_cycle(array(), $this);?>
" nowrap="nowrap">
  <?php if ($this->_tpl_vars['tiki_p_admin_galleries'] == 'y' || ( $this->_tpl_vars['user'] && $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['user'] == $this->_tpl_vars['user'] )): ?>
  <?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual_tiki_p_create_galleries'] == 'y' )): ?>
    <a class="gallink" title="edit" href="tiki-galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
&amp;edit_mode=1&amp;galleryId=<?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['galleryId']; ?>
"><?php echo smarty_function_html_image(array('file' => 'img/icons/edit.gif','alt' => 'Edit','title' => 'Edit','border' => '0'), $this);?>
</a>
  <?php endif; ?>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['tiki_p_upload_images'] == 'y'): ?>
  <?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual_tiki_p_upload_images'] == 'y' )): ?>
  <?php if ($this->_tpl_vars['tiki_p_admin_galleries'] == 'y' || ( $this->_tpl_vars['user'] && $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['user'] == $this->_tpl_vars['user'] ) || $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['public'] == 'y'): ?>
    <a class="gallink" href="tiki-upload_image.php?galleryId=<?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['galleryId']; ?>
"><img src='img/icons2/upload.gif' border='0' height="16" width="16" alt='Upload' title='Upload' /></a>
  <?php if (( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['geographic'] == 'y' )): ?>
    <a class="gallink" href="tiki-galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
&amp;make_map=1&amp;galleryId=<?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['galleryId']; ?>
"><img src='img/icons/config.gif' alt='Make Map' title='Make Map' height="16" width="16" border='0' /></a>
  <?php endif; ?>
  <?php endif; ?>
  <?php endif; ?>
  <?php endif; ?>
  <?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual_tiki_p_view_image_gallery'] == 'y' )): ?>
  <a class="gallink" href="tiki-list_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['galleryId']; ?>
"><img border='0' height="16" width="18" src='img/icons/ico_table.gif' title='List' alt='List' /></a>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['tiki_p_admin'] == 'y'): ?>
    <?php if ($this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual'] == 'y'): ?>
	<a class="gallink" href="tiki-objectpermissions.php?objectName=<?php echo ((is_array($_tmp=$this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;objectType=image+gallery&amp;permType=image+galleries&amp;objectId=<?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['galleryId']; ?>
"><img src='img/icons/key_active.gif' alt='active perms' title='active perms' height="16" width="17" border='0' /></a>
    <?php else: ?>
	<a class="gallink" href="tiki-objectpermissions.php?objectName=<?php echo ((is_array($_tmp=$this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;objectType=image+gallery&amp;permType=image+galleries&amp;objectId=<?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['galleryId']; ?>
"><img src='img/icons/key.gif' alt='perms' title='perms' height="16" width="17" border='0' /></a>
    <?php endif; ?>
  <?php endif; ?>
<?php if ($this->_tpl_vars['tiki_p_admin_galleries'] == 'y' || ( $this->_tpl_vars['user'] && $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['user'] == $this->_tpl_vars['user'] )): ?>
  <?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual_tiki_p_create_galleries'] == 'y' )): ?>
    &nbsp;&nbsp;<a class="gallink" title="delete" href="tiki-galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
&amp;removegal=<?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['galleryId']; ?>
"><img src='img/icons2/delete.gif' height="16" width="16" border='0' alt='delete' title='delete' /></a>
  <?php endif; ?>
  <?php endif; ?>

  </td>
</tr>
<?php endif; ?>
<?php endif; ?>
<?php endfor; else: ?>
<tr><td class="odd" colspan="9">
No records found
</td></tr>
<?php endif; ?>
</table>
<br />
<?php echo $this->_tpl_vars['map_error']; ?>


<?php if ($this->_tpl_vars['cant_pages'] > 1): ?>
<div class="mini">
<?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
[<a class="galprevnext" href="tiki-galleries.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">prev</a>]&nbsp;
<?php endif; ?>
Page: <?php echo $this->_tpl_vars['actual_page']; ?>
/<?php echo $this->_tpl_vars['cant_pages']; ?>

<?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
&nbsp;[<a class="galprevnext" href="tiki-galleries.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['next_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">next</a>]
<?php endif; ?>
<?php if ($this->_tpl_vars['direct_pagination'] == 'y'): ?>
<br />
<?php unset($this->_sections['foo']);
$this->_sections['foo']['loop'] = is_array($_loop=$this->_tpl_vars['cant_pages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['foo']['name'] = 'foo';
$this->_sections['foo']['show'] = true;
$this->_sections['foo']['max'] = $this->_sections['foo']['loop'];
$this->_sections['foo']['step'] = 1;
$this->_sections['foo']['start'] = $this->_sections['foo']['step'] > 0 ? 0 : $this->_sections['foo']['loop']-1;
if ($this->_sections['foo']['show']) {
    $this->_sections['foo']['total'] = $this->_sections['foo']['loop'];
    if ($this->_sections['foo']['total'] == 0)
        $this->_sections['foo']['show'] = false;
} else
    $this->_sections['foo']['total'] = 0;
if ($this->_sections['foo']['show']):

            for ($this->_sections['foo']['index'] = $this->_sections['foo']['start'], $this->_sections['foo']['iteration'] = 1;
                 $this->_sections['foo']['iteration'] <= $this->_sections['foo']['total'];
                 $this->_sections['foo']['index'] += $this->_sections['foo']['step'], $this->_sections['foo']['iteration']++):
$this->_sections['foo']['rownum'] = $this->_sections['foo']['iteration'];
$this->_sections['foo']['index_prev'] = $this->_sections['foo']['index'] - $this->_sections['foo']['step'];
$this->_sections['foo']['index_next'] = $this->_sections['foo']['index'] + $this->_sections['foo']['step'];
$this->_sections['foo']['first']      = ($this->_sections['foo']['iteration'] == 1);
$this->_sections['foo']['last']       = ($this->_sections['foo']['iteration'] == $this->_sections['foo']['total']);
?>
<?php $this->assign('selector_offset', ((is_array($_tmp=$this->_sections['foo']['index'])) ? $this->_run_mod_handler('times', true, $_tmp, $this->_tpl_vars['maxRecords']) : smarty_modifier_times($_tmp, $this->_tpl_vars['maxRecords']))); ?>
<a class="prevnext" href="tiki-galleries.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['selector_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
<?php echo $this->_sections['foo']['index_next']; ?>
</a>&nbsp;
<?php endfor; endif; ?>
<?php endif; ?>
</div>
<?php endif; ?>

</div>