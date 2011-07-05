<?php /* Smarty version 2.6.18, created on 2011-06-01 00:42:46
         compiled from tiki-browse_gallery.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_image', 'tiki-browse_gallery.tpl', 34, false),array('function', 'jspopup', 'tiki-browse_gallery.tpl', 119, false),array('modifier', 'tiki_short_date', 'tiki-browse_gallery.tpl', 82, false),array('modifier', 'escape', 'tiki-browse_gallery.tpl', 83, false),array('modifier', 'times', 'tiki-browse_gallery.tpl', 149, false),)), $this); ?>

<h1><a class="pagetitle" href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
">
Browsing Gallery: <?php echo $this->_tpl_vars['name']; ?>

</a></h1>

<div class="navbar">
<span class="button2"><a href="tiki-galleries.php" class="linkbut" title="list galleries">list galleries</a></span>
<?php if ($this->_tpl_vars['system'] == 'n'): ?>
  <?php if ($this->_tpl_vars['tiki_p_admin_galleries'] == 'y' || ( $this->_tpl_vars['user'] && $this->_tpl_vars['user'] == $this->_tpl_vars['owner'] )): ?>
    <span class="button2"><a href="tiki-galleries.php?edit_mode=1&amp;galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
" class="linkbut">edit gallery</a></span>
    <span class="button2"><a href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;rebuild=<?php echo $this->_tpl_vars['galleryId']; ?>
" class="linkbut">rebuild thumbnails</a></span>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['tiki_p_upload_images'] == 'y'): ?>
    <?php if ($this->_tpl_vars['tiki_p_admin_galleries'] == 'y' || ( $this->_tpl_vars['user'] && $this->_tpl_vars['user'] == $this->_tpl_vars['owner'] ) || $this->_tpl_vars['public'] == 'y'): ?>
      <span class="button2"><a href="tiki-upload_image.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
" class="linkbut">upload image</a></span>
    <?php endif; ?>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['feature_gal_batch'] == 'y' && $this->_tpl_vars['tiki_p_batch_upload_image_dir'] == 'y'): ?>
    <?php if ($this->_tpl_vars['tiki_p_admin_galleries'] == 'y' || ( $this->_tpl_vars['user'] && $this->_tpl_vars['user'] == $this->_tpl_vars['owner'] ) || $this->_tpl_vars['public'] == 'y'): ?>
      <span class="button2"><a href="tiki-batch_upload.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
" class="linkbut">Directory batch</a></span>
    <?php endif; ?>
  <?php endif; ?>
<?php endif; ?>

<?php if ($this->_tpl_vars['tiki_p_admin_galleries'] == 'y'): ?>
<span class="button2"><a href="tiki-list_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
" class="linkbut">list gallery</a></span>
<span class="button2"><a href="tiki-show_all_images.php?id=<?php echo $this->_tpl_vars['galleryId']; ?>
" class="linkbut">All Images</a></span>
<?php endif; ?>
<?php if ($this->_tpl_vars['rss_image_gallery'] == 'y'): ?>
  <span class="button2"><a href="tiki-image_gallery_rss.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
" class="linkbut">RSS</a></span>
<?php endif; ?>
	<?php if ($this->_tpl_vars['user'] && $this->_tpl_vars['feature_user_watches'] == 'y'): ?>
		<?php if ($this->_tpl_vars['user_watching_gal'] == 'n'): ?>
			<a href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;watch_event=image_gallery_changed&amp;watch_object=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;watch_action=add" title="monitor this gallery"><?php echo smarty_function_html_image(array('file' => 'img/icons/icon_watch.png','border' => '0','alt' => 'monitor this gallery'), $this);?>
</a>
		<?php else: ?>
			<a href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;watch_event=image_gallery_changed&amp;watch_object=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;watch_action=remove" title="stop monitoring this gallery"><?php echo smarty_function_html_image(array('file' => 'img/icons/icon_unwatch.png','border' => '0','alt' => 'stop monitoring this gallery'), $this);?>
</a>
		<?php endif; ?>
	<?php endif; ?>
</div>

<?php if (strlen ( $this->_tpl_vars['description'] ) > 0): ?>
	<div class="imgaldescr">
	  <?php echo $this->_tpl_vars['description']; ?>

  </div>
<?php endif; ?>
<br />

	<span class="sorttitle">Sort Images by</span>
    [ <span class="sortoption"><a class="gallink" href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'name_desc'): ?>name_asc<?php else: ?>name_desc<?php endif; ?>">Name</a></span>
    | <span class="sortoption"><a class="gallink" href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'created_desc'): ?>created_asc<?php else: ?>created_desc<?php endif; ?>">Date</a></span>
    | <span class="sortoption"><a class="gallink" href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'hits_desc'): ?>hits_asc<?php else: ?>hits_desc<?php endif; ?>">Hits</a></span>
    | <span class="sortoption"><a class="gallink" href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'user_desc'): ?>user_asc<?php else: ?>user_desc<?php endif; ?>">User</a></span>
    | <span class="sortoption"><a class="gallink" href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'filesize_desc'): ?>filesize_asc<?php else: ?>filesize_desc<?php endif; ?>">Size</a></span> ]

<br /><br />
<div align="center">
<div class="mini">
      <?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
        [<a  class="galprevnext" href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">prev</a>]&nbsp;&nbsp;
      <?php endif; ?>
      Page: <?php echo $this->_tpl_vars['actual_page']; ?>
/<?php echo $this->_tpl_vars['cant_pages']; ?>

      <?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
      &nbsp;&nbsp;[<a class="galprevnext" href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['next_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">next</a>]
      <?php endif; ?>
  </div>
</div>

  <div class="thumbnails">
    <table class="galtable"  cellpadding="0" cellspacing="0">
      <tr>
        <?php if ($this->_tpl_vars['num_objects'] > 0): ?>
        <?php $_from = $this->_tpl_vars['subgals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
          <td align="center" <?php if (( ( $this->_tpl_vars['key'] / $this->_tpl_vars['rowImages'] ) % 2 )): ?>class="oddthumb"<?php else: ?>class="eventhumb"<?php endif; ?>>
          &nbsp;&nbsp;<br />
          <a href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['item']['galleryId']; ?>
"><img alt="subgallery <?php echo $this->_tpl_vars['item']['name']; ?>
" class="athumb" src="show_image.php?id=<?php echo $this->_tpl_vars['item']['imageId']; ?>
&amp;thumb=1" /></a>
	  <br />
	  <small class="caption">
		Subgallery: 
			<?php if ($this->_tpl_vars['showname'] == 'y' || $this->_tpl_vars['showfilename'] == 'y'): ?><?php echo $this->_tpl_vars['item']['name']; ?>
<br /><?php endif; ?>
			<?php if ($this->_tpl_vars['showimageid'] == 'y'): ?>ID: <?php echo $this->_tpl_vars['item']['galleryId']; ?>
<br /><?php endif; ?>
			<?php if ($this->_tpl_vars['showdescription'] == 'y'): ?><?php echo $this->_tpl_vars['item']['description']; ?>
<br /><?php endif; ?>
			<?php if ($this->_tpl_vars['showcreated'] == 'y'): ?>Created: <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['created'])) ? $this->_run_mod_handler('tiki_short_date', true, $_tmp) : smarty_modifier_tiki_short_date($_tmp)); ?>
<br /><?php endif; ?>
			<?php if ($this->_tpl_vars['showuser'] == 'y'): ?>User: <a href="tiki-user_information.php?user=<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['user'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo $this->_tpl_vars['item']['user']; ?>
</a><br /><?php endif; ?>
			<?php if ($this->_tpl_vars['showxysize'] == 'y' || $this->_tpl_vars['showfilesize'] == 'y'): ?>(<?php echo $this->_tpl_vars['item']['numimages']; ?>
 Images)<?php endif; ?>
			<?php if ($this->_tpl_vars['showhits'] == 'y'): ?>[<?php echo $this->_tpl_vars['item']['hits']; ?>
 <?php if ($this->_tpl_vars['item']['hits'] == 1): ?>hit<?php else: ?>hits<?php endif; ?>]<br /><?php endif; ?>
                        </small>
	  </td>
         <?php if ($this->_tpl_vars['key']%$this->_tpl_vars['rowImages'] == $this->_tpl_vars['rowImages2']): ?>
           </tr><tr>
         <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
        <?php $_from = $this->_tpl_vars['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
          <td align="center" <?php if (( ( ( $this->_tpl_vars['key'] + $this->_tpl_vars['num_subgals'] ) / $this->_tpl_vars['rowImages'] ) % 2 )): ?>class="oddthumb"<?php else: ?>class="eventhumb"<?php endif; ?>>
          &nbsp;&nbsp;<br />
          
          <a href="tiki-browse_image.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
&amp;imageId=<?php echo $this->_tpl_vars['item']['imageId']; ?>
&amp;scalesize=<?php echo $this->_tpl_vars['defaultscale']; ?>
"><img alt="thumbnail" class="athumb" src="show_image.php?id=<?php echo $this->_tpl_vars['item']['imageId']; ?>
&amp;thumb=1" /></a>
          <br />
          <small class="caption">
		<?php if ($this->_tpl_vars['showname'] == 'y'): ?><?php echo $this->_tpl_vars['item']['name']; ?>
<br /><?php endif; ?>
		<?php if ($this->_tpl_vars['showfilename'] == 'y'): ?>Filename: <?php echo $this->_tpl_vars['item']['filename']; ?>
<br /><?php endif; ?>
		<?php if ($this->_tpl_vars['showimageid'] == 'y'): ?>ID: <?php echo $this->_tpl_vars['item']['imageId']; ?>
<br /><?php endif; ?>
		<?php if ($this->_tpl_vars['showdescription'] == 'y'): ?><?php echo $this->_tpl_vars['item']['description']; ?>
<br /><?php endif; ?>
		<?php if ($this->_tpl_vars['showcreated'] == 'y'): ?>Created: <?php echo ((is_array($_tmp=$this->_tpl_vars['item']['created'])) ? $this->_run_mod_handler('tiki_short_date', true, $_tmp) : smarty_modifier_tiki_short_date($_tmp)); ?>
<br /><?php endif; ?>
		<?php if ($this->_tpl_vars['showuser'] == 'y'): ?>User: <a href="tiki-user_information.php?view_user=<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['user'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo $this->_tpl_vars['item']['user']; ?>
</a><br /><?php endif; ?>
		<?php if ($this->_tpl_vars['showxysize'] == 'y'): ?>(<?php echo $this->_tpl_vars['item']['xsize']; ?>
x<?php echo $this->_tpl_vars['item']['ysize']; ?>
)<?php endif; ?>
		<?php if ($this->_tpl_vars['showfilesize'] == 'y'): ?>(<?php echo $this->_tpl_vars['item']['filesize']; ?>
 Bytes)<?php endif; ?>
		<?php if ($this->_tpl_vars['showhits'] == 'y'): ?>[<?php echo $this->_tpl_vars['item']['hits']; ?>
 <?php if ($this->_tpl_vars['item']['hits'] == 1): ?>hit<?php else: ?>hits<?php endif; ?>]<?php endif; ?>
          <br />
          <?php if ($this->_tpl_vars['tiki_p_admin_galleries'] == 'y' || ( $this->_tpl_vars['user'] && $this->_tpl_vars['user'] == $this->_tpl_vars['owner'] )): ?>
	    		<?php if ($this->_tpl_vars['nextx'] != 0): ?>
            		<a class="gallink" href="tiki-browse_image.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
&amp;imageId=<?php echo $this->_tpl_vars['item']['imageId']; ?>
&amp;scalesize=0" title="original size"><img src='img/icons2/nav_dot.gif' border='0' width='8' height='11' alt='original size' title='original size' /></a>
	    		<?php endif; ?>
            	<?php if ($this->_tpl_vars['imagerotate']): ?>
            		<a class="gallink" href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;rotateright=<?php echo $this->_tpl_vars['item']['imageId']; ?>
" title="rotate right"><img src='img/icons2/admin_rotate.gif' border='0' width='11' height='11 alt='rotate' title='rotate' /></a>
            	<?php endif; ?>
            	<a class="gallink" href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;remove=<?php echo $this->_tpl_vars['item']['imageId']; ?>
" title="delete"><img src='img/icons2/admin_delete.gif' border='0' width='11' height='11 alt='delete' title='delete' /></a>
            	<a class="gallink" href="tiki-edit_image.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;edit=<?php echo $this->_tpl_vars['item']['imageId']; ?>
" title="edit"><img src='img/icons2/admin_move.gif' border='0' width='11' height='11 alt='edit' title='edit' /></a>
          <?php endif; ?>
          <a <?php echo smarty_function_jspopup(array('href' => "tiki-browse_image.php?galleryId=".($this->_tpl_vars['galleryId'])."&amp;sort_mode=".($this->_tpl_vars['sort_mode'])."&amp;imageId=".($this->_tpl_vars['item']['imageId'])."&amp;scalesize=".($this->_tpl_vars['defaultscale'])."&amp;popup=1"), $this);?>
 class="gallink">
<img src='img/icons2/admin_unhide.gif' border='0' width='11' height='11 alt='popup' title='popup' /></a>
          <br />
	</small>
         </td>
         <?php if (( $this->_tpl_vars['key'] + $this->_tpl_vars['num_subgals'] ) % $this->_tpl_vars['rowImages'] == $this->_tpl_vars['rowImages2']): ?>
           </tr><tr>
         <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
          <tr><td colspan="6">
            <p class="norecords">No records found</p>
          </td></tr>
        <?php endif; ?>
      </tr>
    </table>
  </div>

<div align="center">
<div class="mini">
      <?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
        [<a  class="galprevnext" href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">prev</a>]&nbsp;&nbsp;
      <?php endif; ?>
      Page: <?php echo $this->_tpl_vars['actual_page']; ?>
/<?php echo $this->_tpl_vars['cant_pages']; ?>

      <?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
      &nbsp;&nbsp;[<a class="galprevnext" href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
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
<?php $this->assign('selector_offset', ((is_array($_tmp=$this->_sections['foo']['index'])) ? $this->_run_mod_handler('times', true, $_tmp, $this->_tpl_vars['maxImages']) : smarty_modifier_times($_tmp, $this->_tpl_vars['maxImages']))); ?>
<a class="prevnext" href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['selector_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
<?php echo $this->_sections['foo']['index_next']; ?>
</a>&nbsp;
<?php endfor; endif; ?>
<?php endif; ?>
  </div>
</div>
<table class="findtable">
<tr><td class="findtable">Find
   <form method="get" action="tiki-browse_gallery.php">
     <input type="text" name="find" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['find'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
     <input type="submit" value="find" name="search" />
     <input type="hidden" name="sort_mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['sort_mode'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
     <input type="hidden" name="galleryId" value="<?php echo $this->_tpl_vars['galleryId']; ?>
" />
   </form>
   </td>
</tr>
</table>
<?php if ($this->_tpl_vars['feature_image_galleries_comments'] == 'y' && ( ( $this->_tpl_vars['tiki_p_read_comments'] == 'y' && $this->_tpl_vars['comments_cant'] != 0 ) || $this->_tpl_vars['tiki_p_post_comments'] == 'y' || $this->_tpl_vars['tiki_p_edit_comments'] == 'y' )): ?>
<div id="page-bar">
<table>
<tr><td>
<div class="button2">
      <a href="#comments" onclick="javascript:flip('comzone<?php if ($this->_tpl_vars['comments_show'] == 'y'): ?>open<?php endif; ?>');" class="linkbut">
	<?php if ($this->_tpl_vars['comments_cant'] == 0): ?>
          add comment
        <?php elseif ($this->_tpl_vars['comments_cant'] == 1): ?>
          <span class="highlight">1 comment</span>
        <?php else: ?>
          <span class="highlight"><?php echo $this->_tpl_vars['comments_cant']; ?>
 comments</span>
        <?php endif; ?>
      </a>
</div>
</td></tr></table>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "comments.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>