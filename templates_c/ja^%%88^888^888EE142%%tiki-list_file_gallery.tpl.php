<?php /* Smarty version 2.6.18, created on 2011-04-04 19:09:53
         compiled from tiki-list_file_gallery.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'tiki-list_file_gallery.tpl', 24, false),array('modifier', 'iconify', 'tiki-list_file_gallery.tpl', 157, false),array('modifier', 'kbsize', 'tiki-list_file_gallery.tpl', 177, false),array('modifier', 'truncate', 'tiki-list_file_gallery.tpl', 181, false),array('modifier', 'tiki_short_date', 'tiki-list_file_gallery.tpl', 185, false),array('modifier', 'times', 'tiki-list_file_gallery.tpl', 222, false),array('function', 'html_image', 'tiki-list_file_gallery.tpl', 43, false),array('function', 'cycle', 'tiki-list_file_gallery.tpl', 141, false),)), $this); ?>


<h1><a class="pagetitle" href="tiki-list_file_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
">ギャラリーの一覧: <?php echo $this->_tpl_vars['name']; ?>
</a></h1>

<table><tr>
<td style="vertical-align:top;">

<a href="tiki-file_galleries.php" class="linkbut" title="list galleries">list galleries</a>

<?php if ($this->_tpl_vars['tiki_p_admin_file_galleries'] == 'y' || $this->_tpl_vars['user'] == $this->_tpl_vars['owner']): ?>
  <a href="tiki-file_galleries.php?edit_mode=1&amp;galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
" class="linkbut">ギャラリーの変更</a>
<?php endif; ?>
<?php if ($this->_tpl_vars['tiki_p_upload_files'] == 'y' && ( $this->_tpl_vars['tiki_p_admin_file_galleries'] == 'y' || $this->_tpl_vars['user'] == $this->_tpl_vars['owner'] || $this->_tpl_vars['public'] == 'y' )): ?>
  <a href="tiki-upload_file.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
" class="linkbut">ファイルのアップロード</a>
<?php endif; ?>
<?php if ($this->_tpl_vars['rss_file_gallery'] == 'y'): ?>
<a href="tiki-file_gallery_rss.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
" class="linkbut">RSS</a>
<?php endif; ?><br /><br />
<?php if ($this->_tpl_vars['tiki_p_create_file_galleries'] == 'y'): ?>
<?php if ($this->_tpl_vars['edit_mode'] == 'y'): ?>
<h2>Edit a file using this form</h2>
<div  align="center">
<form action="tiki-list_file_gallery.php" method="post">
<input type="hidden" name="galleryId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['galleryId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<input type="hidden" name="fileId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fileId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<table class="normal">
<tr><td class="formcolor">ファイル名:</td><td class="formcolor"><?php echo ((is_array($_tmp=$this->_tpl_vars['filename'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td></tr>
<tr><td class="formcolor">名前:</td><td class="formcolor"><input type="text" name="fname" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['fname'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/></td></tr>
<tr><td class="formcolor">説明:</td><td class="formcolor"><textarea rows="5" cols="40" name="fdescription"><?php echo ((is_array($_tmp=$this->_tpl_vars['fdescription'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea></td></tr>
<tr><td class="formcolor">&nbsp;</td><td class="formcolor"><input type="submit" value="管理・編集" name="edit" /></td></tr>
</table>
</form>
</div>
<br />
<?php endif; ?>
<?php endif; ?>

</td>
<td style="text-align:right;width:142px;wrap:nowrap">

       <?php if ($this->_tpl_vars['user'] && $this->_tpl_vars['feature_user_watches'] == 'y'): ?>
		<?php if ($this->_tpl_vars['user_watching_file_gallery'] == 'n'): ?>
			<a href="tiki-list_file_gallery.php?galleryId=<?php echo ((is_array($_tmp=$this->_tpl_vars['galleryId'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;galleryName=<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;watch_event=file_gallery_changed&amp;watch_object=<?php echo ((is_array($_tmp=$this->_tpl_vars['galleryId'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;watch_action=add"><?php echo smarty_function_html_image(array('file' => 'img/icons/icon_watch.png','border' => '0','alt' => 'monitor this gallery','title' => 'monitor this gallery'), $this);?>
</a>
		<?php else: ?>
			<a href="tiki-list_file_gallery.php?galleryId=<?php echo ((is_array($_tmp=$this->_tpl_vars['galleryId'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;galleryName=<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;watch_event=file_gallery_changed&amp;watch_object=<?php echo ((is_array($_tmp=$this->_tpl_vars['galleryId'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;watch_action=remove"><?php echo smarty_function_html_image(array('file' => 'img/icons/icon_unwatch.png','border' => '0','alt' => 'stop monitoring this gallery','title' => 'stop monitoring this gallery'), $this);?>
</a>
		<?php endif; ?>
	<?php endif; ?>  

</td></tr></table>
       
<?php if (strlen ( $this->_tpl_vars['description'] ) > 0): ?>
    <?php echo $this->_tpl_vars['description']; ?>

    <br />
<?php endif; ?>

  <h2>ギャラリーのファイル</h2>
<div align="center">
<table class="findtable">
<tr><td class="findtable">検索</td>
   <td class="findtable">
   <form method="get" action="tiki-list_file_gallery.php">
     <input type="hidden" name="galleryId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['galleryId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
     <input type="text" name="find" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['find'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
     <input type="submit" value="検索" name="search" />
     <input type="hidden" name="sort_mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['sort_mode'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
   </form>
   </td>
</tr>
</table>
<form method="get" action="tiki-list_file_gallery.php">
	<input type="hidden" name="galleryId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['galleryId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    <input type="hidden" name="find" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['find'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
    <input type="hidden" name="sort_mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['sort_mode'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
<table class="normal">
<?php if ($this->_tpl_vars['tiki_p_admin_file_galleries'] == 'y'): ?>
<tr>
	<td class="heading" colspan="16">
	操作
	</td>
</tr>
<tr>	
	<td class="even" colspan="16">
	
	<input type="image" name="movesel" src="img/icons/topic_move.gif" alt="移動" title="選択ファイルを移動" />
	<input type="image" name="delsel" src="img/icons/topic_delete.gif" alt="削除" title="選択ファイルを削除" />
	
	</td>
</tr>
<?php if ($_REQUEST['movesel_x']): ?> 
<tr>
	<td class="even" colspan="18">
	Move to:
	<select name="moveto">
		<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['all_galleries']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ix']['show'] = true;
$this->_sections['ix']['max'] = $this->_sections['ix']['loop'];
$this->_sections['ix']['step'] = 1;
$this->_sections['ix']['start'] = $this->_sections['ix']['step'] > 0 ? 0 : $this->_sections['ix']['loop']-1;
if ($this->_sections['ix']['show']) {
    $this->_sections['ix']['total'] = $this->_sections['ix']['loop'];
    if ($this->_sections['ix']['total'] == 0)
        $this->_sections['ix']['show'] = false;
} else
    $this->_sections['ix']['total'] = 0;
if ($this->_sections['ix']['show']):

            for ($this->_sections['ix']['index'] = $this->_sections['ix']['start'], $this->_sections['ix']['iteration'] = 1;
                 $this->_sections['ix']['iteration'] <= $this->_sections['ix']['total'];
                 $this->_sections['ix']['index'] += $this->_sections['ix']['step'], $this->_sections['ix']['iteration']++):
$this->_sections['ix']['rownum'] = $this->_sections['ix']['iteration'];
$this->_sections['ix']['index_prev'] = $this->_sections['ix']['index'] - $this->_sections['ix']['step'];
$this->_sections['ix']['index_next'] = $this->_sections['ix']['index'] + $this->_sections['ix']['step'];
$this->_sections['ix']['first']      = ($this->_sections['ix']['iteration'] == 1);
$this->_sections['ix']['last']       = ($this->_sections['ix']['iteration'] == $this->_sections['ix']['total']);
?>
			<?php if ($this->_tpl_vars['all_galleries'][$this->_sections['ix']['index']]['galleryId'] != $this->_tpl_vars['galleryId']): ?>
				<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['all_galleries'][$this->_sections['ix']['index']]['galleryId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo $this->_tpl_vars['all_galleries'][$this->_sections['ix']['index']]['name']; ?>
</option>
			<?php endif; ?>
		<?php endfor; endif; ?>
	</select>
	<input type='submit' name='movesel' value="移動" />
	</td>
</tr>
<?php endif; ?>
<?php endif; ?>

<tr>
<?php if ($this->_tpl_vars['tiki_p_admin_file_galleries'] == 'y'): ?>
<td  class="heading">&nbsp;</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_info']['show_id'] == 'y'): ?>
	<td class="heading"><a class="tableheading" href="tiki-list_file_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'fileId_desc'): ?>fileId_asc<?php else: ?>fileId_desc<?php endif; ?>">ID</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_info']['show_icon'] == 'y'): ?>
	<td class="heading"><a class="tableheading" href="tiki-list_file_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'filetype_desc'): ?>filetype_asc<?php else: ?>filetype_desc<?php endif; ?>">種類</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_info']['show_name'] == 'a' || $this->_tpl_vars['gal_info']['show_name'] == 'n'): ?>
<td class="heading"><a class="tableheading" href="tiki-list_file_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'name_desc'): ?>name_asc<?php else: ?>name_desc<?php endif; ?>">名前</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_info']['show_name'] == 'a' || $this->_tpl_vars['gal_info']['show_name'] == 'f'): ?>
<td class="heading"><a class="tableheading" href="tiki-list_file_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'filename_desc'): ?>filename_asc<?php else: ?>filename_desc<?php endif; ?>">ファイル名</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_info']['show_size'] == 'y'): ?>
	<td  style="text-align:right;" class="heading"><a class="tableheading" href="tiki-list_file_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'filesize_desc'): ?>filesize_asc<?php else: ?>filesize_desc<?php endif; ?>">ファイル・サイズ</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_info']['show_description'] == 'y'): ?>
	<td  class="heading"><a class="tableheading" href="tiki-list_file_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'description_desc'): ?>description_asc<?php else: ?>description_desc<?php endif; ?>">説明</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_info']['show_created'] == 'y'): ?>
	<td  class="heading"><a class="tableheading" href="tiki-list_file_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'created_desc'): ?>created_asc<?php else: ?>created_desc<?php endif; ?>">作成日</a></td>
	<td  class="heading"><a class="tableheading" href="tiki-list_file_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'user_desc'): ?>user_asc<?php else: ?>user_desc<?php endif; ?>">作成者</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_info']['show_dl'] == 'y'): ?>
	<td style="text-align:right;"  class="heading"><a class="tableheading" href="tiki-list_file_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'downloads_desc'): ?>downloads_asc<?php else: ?>downloads_desc<?php endif; ?>">Dls</a></td>
<?php endif; ?>
<td  class="heading">操作</td>
</tr>




<?php echo smarty_function_cycle(array('values' => "odd,even",'print' => false), $this);?>

<?php unset($this->_sections['changes']);
$this->_sections['changes']['name'] = 'changes';
$this->_sections['changes']['loop'] = is_array($_loop=$this->_tpl_vars['images']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<tr>

<?php if ($this->_tpl_vars['tiki_p_admin_file_galleries'] == 'y'): ?>
<td  style="text-align:center;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">
	<input type="checkbox" name="file[]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['images'][$this->_sections['changes']['index']]['fileId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"  <?php if ($_REQUEST['file'] && in_array ( $this->_tpl_vars['images'][$this->_sections['changes']['index']]['fileId'] , $_REQUEST['file'] )): ?>checked="checked"<?php endif; ?> />
</td>
<?php endif; ?>

<?php if ($this->_tpl_vars['gal_info']['show_id'] == 'y'): ?>
	<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['images'][$this->_sections['changes']['index']]['fileId']; ?>
</td>
<?php endif; ?>

<?php if ($this->_tpl_vars['gal_info']['show_icon'] == 'y'): ?>
	<td style="text-align:center;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">
		<?php echo ((is_array($_tmp=$this->_tpl_vars['images'][$this->_sections['changes']['index']]['filename'])) ? $this->_run_mod_handler('iconify', true, $_tmp) : smarty_modifier_iconify($_tmp)); ?>

	</td>
<?php endif; ?>
	
<?php if ($this->_tpl_vars['gal_info']['show_name'] == 'a' || $this->_tpl_vars['gal_info']['show_name'] == 'n'): ?>
	<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">
		<?php if ($this->_tpl_vars['tiki_p_download_files'] == 'y'): ?><a class="fgalname" href="tiki-download_file.php?fileId=<?php echo $this->_tpl_vars['images'][$this->_sections['changes']['index']]['fileId']; ?>
"><?php endif; ?>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['images'][$this->_sections['changes']['index']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

		<?php if ($this->_tpl_vars['tiki_p_download_files'] == 'y'): ?></a><?php endif; ?>
	</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['gal_info']['show_name'] == 'a' || $this->_tpl_vars['gal_info']['show_name'] == 'f'): ?>
	<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">
		<?php if ($this->_tpl_vars['tiki_p_download_files'] == 'y'): ?><a class="fgalname" href="tiki-download_file.php?fileId=<?php echo $this->_tpl_vars['images'][$this->_sections['changes']['index']]['fileId']; ?>
"><?php endif; ?>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['images'][$this->_sections['changes']['index']]['filename'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

		<?php if ($this->_tpl_vars['tiki_p_download_files'] == 'y'): ?></a><?php endif; ?>
	</td>
<?php endif; ?>

<?php if ($this->_tpl_vars['gal_info']['show_size'] == 'y'): ?>
	<td style="text-align:right;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['images'][$this->_sections['changes']['index']]['filesize'])) ? $this->_run_mod_handler('kbsize', true, $_tmp) : smarty_modifier_kbsize($_tmp)); ?>
</td>
<?php endif; ?>

<?php if ($this->_tpl_vars['gal_info']['show_description'] == 'y'): ?>
	<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['images'][$this->_sections['changes']['index']]['description'])) ? $this->_run_mod_handler('truncate', true, $_tmp, $this->_tpl_vars['gal_info']['max_desc'], "...") : smarty_modifier_truncate($_tmp, $this->_tpl_vars['gal_info']['max_desc'], "...")))) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
<?php endif; ?>
	
<?php if ($this->_tpl_vars['gal_info']['show_created'] == 'y'): ?>
	<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['images'][$this->_sections['changes']['index']]['created'])) ? $this->_run_mod_handler('tiki_short_date', true, $_tmp) : smarty_modifier_tiki_short_date($_tmp)); ?>
</td>
	<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['images'][$this->_sections['changes']['index']]['user'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
<?php endif; ?>

<?php if ($this->_tpl_vars['gal_info']['show_dl'] == 'y'): ?>
	<td style="text-align:right;" class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['images'][$this->_sections['changes']['index']]['downloads']; ?>
</td>
<?php endif; ?>

<td style="text-align:center;" class="<?php echo smarty_function_cycle(array(), $this);?>
">
	<?php if ($this->_tpl_vars['tiki_p_admin_file_galleries'] == 'y' || ( $this->_tpl_vars['user'] && $this->_tpl_vars['user'] == $this->_tpl_vars['owner'] )): ?>
		<a class="link" href="tiki-upload_file.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;fileId=<?php echo $this->_tpl_vars['images'][$this->_sections['changes']['index']]['fileId']; ?>
"><img src='img/icons/edit.gif' border='0' alt="管理・編集" title="管理・編集" /></a>
		<a class="link" href="tiki-list_file_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
&amp;remove=<?php echo $this->_tpl_vars['images'][$this->_sections['changes']['index']]['fileId']; ?>
"><img src='img/icons2/delete.gif' border='0' alt="削除" title="削除" /></a>
	<?php endif; ?>
	&nbsp;
</td>
<!--<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['images'][$this->_sections['changes']['index']]['user']; ?>
&nbsp;</td>-->
</tr>
<?php endfor; else: ?>
<tr><td colspan="16">
<b>登録はありません</b>
</td></tr>
<?php endif; ?>
</table>
</form>

<br />
  <div class="mini">
      <?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
        [<a class="fgalprevnext" href="tiki-list_file_gallery.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">前</a>]&nbsp;
      <?php endif; ?>
      ページ: <?php echo $this->_tpl_vars['actual_page']; ?>
/<?php echo $this->_tpl_vars['cant_pages']; ?>

      <?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
      &nbsp;[<a class="fgalprevnext" href="tiki-list_file_gallery.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['next_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">次</a>]
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
<a class="prevnext" href="tiki-list_file_gallery.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['selector_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">
<?php echo $this->_sections['foo']['index_next']; ?>
</a>&nbsp;
<?php endfor; endif; ?>
<?php endif; ?>

  </div>
</div>
<?php if ($this->_tpl_vars['feature_file_galleries_comments'] == 'y' && ( ( $this->_tpl_vars['tiki_p_read_comments'] == 'y' && $this->_tpl_vars['comments_cant'] != 0 ) || $this->_tpl_vars['tiki_p_post_comments'] == 'y' || $this->_tpl_vars['tiki_p_edit_comments'] == 'y' )): ?>
<div id="page-bar">
<table>
<tr><td>
<div class="button2">
      <a href="#comments" onclick="javascript:flip('comzone<?php if ($this->_tpl_vars['comments_show'] == 'y'): ?>open<?php endif; ?>');" class="linkbut">
	<?php if ($this->_tpl_vars['comments_cant'] == 0): ?>
          コメントする
        <?php elseif ($this->_tpl_vars['comments_cant'] == 1): ?>
          <span class="highlight">1 comment</span>
        <?php else: ?>
          <span class="highlight"><?php echo $this->_tpl_vars['comments_cant']; ?>
 コメント</span>
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