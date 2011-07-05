<?php /* Smarty version 2.6.18, created on 2011-04-12 13:01:49
         compiled from tiki-file_galleries.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'tiki-file_galleries.tpl', 29, false),array('modifier', 'tiki_short_datetime', 'tiki-file_galleries.tpl', 172, false),array('modifier', 'times', 'tiki-file_galleries.tpl', 243, false),array('function', 'cycle', 'tiki-file_galleries.tpl', 149, false),)), $this); ?>


<h1><a class="pagetitle" href="tiki-file_galleries.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
">ファイルギャラリー</a>

<?php if ($this->_tpl_vars['feature_help'] == 'y'): ?>
<a href="<?php echo $this->_tpl_vars['helpurl']; ?>
File+Gallery" target="tikihelp" class="tikihelp" title="ファイルギャラリー">
<img src="img/icons/help.gif" border="0" height="16" width="16" alt='ヘルプ' /></a>
<?php endif; ?>

<?php if ($this->_tpl_vars['feature_view_tpl'] == 'y' && $this->_tpl_vars['tiki_p_view_templates'] == 'y'): ?>
<a href="tiki-edit_templates.php?template=tiki-file_galleries.tpl" target="tikihelp" class="tikihelp" title="tplを見る: File Galleries tpl">
<img src="img/icons/info.gif" border="0" width="16" height="16" alt='テンプレートを変更する' /></a>
<?php endif; ?>

<?php if ($this->_tpl_vars['tiki_p_admin'] == 'y'): ?>
<a href="tiki-admin.php?page=fgal"><img src='img/icons/config.gif' border='0'  alt="この機能の一般管理パネル" title="この機能の一般管理パネル" /></a>
<?php endif; ?>
</h1>

<?php if ($this->_tpl_vars['tiki_p_create_file_galleries'] == 'y'): ?>
<?php if ($this->_tpl_vars['edit_mode'] == 'y'): ?>
<?php if ($this->_tpl_vars['galleryId'] == 0): ?>
<h3>ファイル・ギャラリーの新規作成</h3>
<?php else: ?>
<h3>次のファイル・ギャラリーを変更: <?php echo $this->_tpl_vars['name']; ?>
</h3>
<a class="linkbut" href="tiki-file_galleries.php?edit_mode=1&amp;galleryId=0">新規ギャラリー</a>
<?php endif; ?>
<?php if ($this->_tpl_vars['individual'] == 'y'): ?>
<a class="fgallink" href="tiki-objectpermissions.php?objectName=<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;objectType=file+gallery&amp;permType=file+galleries&amp;objectId=<?php echo $this->_tpl_vars['galleryId']; ?>
">このファイル・ギャラリーには個人権限が設定してあります</a>
<?php endif; ?>
<div style="text-align: center">
<form action="tiki-file_galleries.php" method="post">
<input type="hidden" name="galleryId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['galleryId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />

<table class="normal">
<tr><td class="formcolor">名前:</td><td class="formcolor"><input type="text" name="name" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/></td></tr>
<tr><td class="formcolor">説明:</td><td class="formcolor"><textarea rows="5" cols="40" name="description"><?php echo ((is_array($_tmp=$this->_tpl_vars['description'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</textarea></td></tr>
<!--<tr><td>テーマ:</td><td><select name="theme">
       <option value="default" <?php if ($this->_tpl_vars['theme'] == 'default'): ?>selected="selected"<?php endif; ?>>default</option>
       <option value="dark" <?php if ($this->_tpl_vars['theme'] == 'dark'): ?>selected="selected"<?php endif; ?>>dark</option>
       </select></td></tr>-->
<tr><td class="formcolor">管理者以外にこのギャラリーの閲覧を許可する?</td><td class="formcolor"><input type="checkbox" name="visible" <?php if ($this->_tpl_vars['visible'] == 'y'): ?>checked="checked"<?php endif; ?> /></td></tr>       
<tr>
	<td class="formcolor">一覧の設定</td>
	<td class="formcolor">
		<table >
			<tr>
				<td class="formcolor">アイコン</td>
				<td class="formcolor">ID</td>
				<td class="formcolor">名前</td>
				<td class="formcolor">サイズ</td>
				<td class="formcolor">説明</td>
				<td class="formcolor">作成日</td>
				<td class="formcolor">ダウンロード</td>
			</tr>
			<tr>
				<td class="formcolor"><input type="checkbox" name="show_icon" <?php if ($this->_tpl_vars['show_icon'] == 'y'): ?> checked="checked"<?php endif; ?> /></td>
				<td class="formcolor"><input type="checkbox" name="show_id" <?php if ($this->_tpl_vars['show_id'] == 'y'): ?> checked="checked"<?php endif; ?> /></td>
				<td class="formcolor">
					<select name="show_name">
						<option value="a" <?php if ($this->_tpl_vars['show_name'] == 'a'): ?>selected="selected"<?php endif; ?>>Name-filename</option>
						<option value="n" <?php if ($this->_tpl_vars['show_name'] == 'n'): ?>selected="selected"<?php endif; ?>>名前</option>
						<option value="f" <?php if ($this->_tpl_vars['show_name'] == 'f'): ?>selected="selected"<?php endif; ?>>Filename only</option>
					</select>
				</td>
				<td class="formcolor"><input type="checkbox" name="show_size" <?php if ($this->_tpl_vars['show_size'] == 'y'): ?> checked="checked"<?php endif; ?> /></td>
				<td class="formcolor"><input type="checkbox" name="show_description" <?php if ($this->_tpl_vars['show_description'] == 'y'): ?> checked="checked"<?php endif; ?> /></td>
				<td class="formcolor"><input type="checkbox" name="show_created" <?php if ($this->_tpl_vars['show_created'] == 'y'): ?> checked="checked"<?php endif; ?> /></td>
				<td class="formcolor"><input type="checkbox" name="show_dl" <?php if ($this->_tpl_vars['show_dl'] == 'y'): ?> checked="checked"<?php endif; ?> /></td>
			</tr>
		</table>
	</td>
</tr>
<tr>
	<td class="formcolor">Max description display size</td>
	<td class="formcolor"><input type="text" name="max_desc" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['max_desc'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></td>
</tr>
<tr><td class="formcolor">1ページあたりの最大行数:</td><td class="formcolor"><input type="text" name="maxRows" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['maxRows'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /></td></tr>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "categorize.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<tr><td class="formcolor">他のユーザーもギャラリーへのアップロードが出来ます:</td><td class="formcolor"><input type="checkbox" name="public" <?php if ($this->_tpl_vars['public'] == 'y'): ?>checked="checked"<?php endif; ?>/></td></tr>
<tr><td class="formcolor">&nbsp;</td><td class="formcolor"><input type="submit" value="保存" name="edit" /></td></tr>
</table>
</form>
</div>
<br />
<?php endif; ?>
<?php endif; ?>
<?php if ($this->_tpl_vars['galleryId'] > 0): ?>
<?php if ($this->_tpl_vars['edited'] == 'y'): ?>
<div class="wikitext">
次のURLを利用してファイル・ギャラリーのアクセスが出来ます: <a class="fgallink" href="<?php echo $this->_tpl_vars['url']; ?>
?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
"><?php echo $this->_tpl_vars['url']; ?>
?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
</a>
</div>
<?php endif; ?>
<?php endif; ?>

<h2>Available File Galleries</h2>
<?php if ($this->_tpl_vars['tiki_p_create_file_galleries'] == 'y'): ?>
<a class="linkbut" href="tiki-file_galleries.php?edit_mode=1&amp;galleryId=0">新規ギャラリー</a><br /><br />
<?php endif; ?>
<div style="text-align: center">

<?php if ($this->_tpl_vars['cant_pages'] > 1): ?>
<table class="findtable">
<tr><td class="findtable">検索</td>
   <td class="findtable">
   <form method="get" action="tiki-file_galleries.php">
     <input type="text" name="find" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['find'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
     <input type="submit" value="検索" name="search" />
     <input type="hidden" name="sort_mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['sort_mode'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
   </form>
   </td>
</tr>
</table>
<?php endif; ?>

<table class="normal">
<tr>
<?php $this->assign('cntcol', 1); ?>
<?php if ($this->_tpl_vars['fgal_list_name'] == 'y'): ?>
	<?php $this->assign('cntcol', $this->_tpl_vars['cntcol']+1); ?>
	<td class="heading"><a class="tableheading" href="tiki-file_galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'name_desc'): ?>name_asc<?php else: ?>name_desc<?php endif; ?>">名前</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['fgal_list_description'] == 'y'): ?>
	<?php $this->assign('cntcol', $this->_tpl_vars['cntcol']+1); ?>
	<td class="heading"><a class="tableheading" href="tiki-file_galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'description_desc'): ?>description_asc<?php else: ?>description_desc<?php endif; ?>">説明</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['fgal_list_created'] == 'y'): ?>
	<?php $this->assign('cntcol', $this->_tpl_vars['cntcol']+1); ?>
	<td class="heading"><a class="tableheading" href="tiki-file_galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'created_desc'): ?>created_asc<?php else: ?>created_desc<?php endif; ?>">作成日</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['fgal_list_lastmodif'] == 'y'): ?>
	<?php $this->assign('cntcol', $this->_tpl_vars['cntcol']+1); ?>
	<td class="heading"><a class="tableheading" href="tiki-file_galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'lastModif_desc'): ?>lastModif_asc<?php else: ?>lastModif_desc<?php endif; ?>">最終変更日時</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['fgal_list_user'] == 'y'): ?>
	<?php $this->assign('cntcol', $this->_tpl_vars['cntcol']+1); ?>
	<td class="heading"><a class="tableheading" href="tiki-file_galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'user_desc'): ?>user_asc<?php else: ?>user_desc<?php endif; ?>">ユーザー</a></td>
<?php endif; ?>
<?php if ($this->_tpl_vars['fgal_list_files'] == 'y'): ?>	
	<?php $this->assign('cntcol', $this->_tpl_vars['cntcol']+1); ?>
	<td style="text-align:right;" class="heading">ファイル</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['fgal_list_hits'] == 'y'): ?>
	<?php $this->assign('cntcol', $this->_tpl_vars['cntcol']+1); ?>
	<td style="text-align:right;"  class="heading"><a class="tableheading" href="tiki-file_galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php if ($this->_tpl_vars['sort_mode'] == 'hits_desc'): ?>hits_asc<?php else: ?>hits_desc<?php endif; ?>">ヒット数</a></td>
<?php endif; ?>
<td  class="heading">操作</td>
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
<?php if ($this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['visible'] == 'y' || $this->_tpl_vars['tiki_p_admin_file_galleries'] == 'y'): ?>
<tr>
	<?php if ($this->_tpl_vars['fgal_list_name'] == 'y'): ?>
		<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">
			<?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual_tiki_p_view_file_gallery'] == 'y' )): ?>
				<a class="fgalname" href="tiki-list_file_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['id']; ?>
">
			<?php endif; ?>
			<?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['name']; ?>

			<?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual_tiki_p_view_file_gallery'] == 'y' )): ?>
			</a>
			<?php endif; ?>
		</td>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['fgal_list_description'] == 'y'): ?>
		<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
">
			<?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['description']; ?>

		</td>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['fgal_list_created'] == 'y'): ?>	
		<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['created'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>
&nbsp;</td>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['fgal_list_lastmodif'] == 'y'): ?>
		<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['lastModif'])) ? $this->_run_mod_handler('tiki_short_datetime', true, $_tmp) : smarty_modifier_tiki_short_datetime($_tmp)); ?>
&nbsp;</td>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['fgal_list_user'] == 'y'): ?>
		<td class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['user']; ?>
&nbsp;</td>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['fgal_list_files'] == 'y'): ?>
		<td style="text-align:right;"  class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['files']; ?>
&nbsp;</td>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['fgal_list_hits'] == 'y'): ?>
		<td style="text-align:right;"  class="<?php echo smarty_function_cycle(array('advance' => false), $this);?>
"><?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['hits']; ?>
&nbsp;</td>
	<?php endif; ?>
	
	
	<td class="<?php echo smarty_function_cycle(array(), $this);?>
" nowrap="nowrap">
	<?php if ($this->_tpl_vars['tiki_p_admin_file_galleries'] == 'y' || ( $this->_tpl_vars['user'] && $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['user'] == $this->_tpl_vars['user'] )): ?>
		<?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual_tiki_p_create_file_galleries'] == 'y' )): ?>
			<a class="fgallink" href="tiki-file_galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
&amp;edit_mode=1&amp;galleryId=<?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['id']; ?>
"><img src="img/icons/config.gif" border="0" width="16" height="16" alt='管理・編集' title='管理・編集' /></a>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['tiki_p_upload_files'] == 'y'): ?>
		<?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual_tiki_p_upload_files'] == 'y' )): ?>
			<?php if ($this->_tpl_vars['tiki_p_admin_file_galleries'] == 'y' || ( $this->_tpl_vars['user'] && $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['user'] == $this->_tpl_vars['user'] ) || $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['public'] == 'y'): ?>
				<a class="fgallink" href="tiki-upload_file.php?galleryId=<?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['id']; ?>
"><img src='img/icons2/upload.gif' border='0' alt='アップロード' title='アップロード' /></a>
			<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['tiki_p_admin'] == 'y'): ?>
	    <?php if ($this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual'] == 'y'): ?>
		<a class="fgallink" href="tiki-objectpermissions.php?objectName=<?php echo ((is_array($_tmp=$this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;objectType=file+gallery&amp;permType=file+galleries&amp;objectId=<?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['id']; ?>
"><img src='img/icons/key_active.gif' alt='active perms' title='active perms' border='0' /></a>
	    <?php else: ?>
		<a class="fgallink" href="tiki-objectpermissions.php?objectName=<?php echo ((is_array($_tmp=$this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;objectType=file+gallery&amp;permType=file+galleries&amp;objectId=<?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['id']; ?>
"><img src='img/icons/key.gif' alt='権限' title='権限' border='0' /></a>
	    <?php endif; ?>
	<?php endif; ?>
<?php if ($this->_tpl_vars['tiki_p_admin_file_galleries'] == 'y' || ( $this->_tpl_vars['user'] && $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['user'] == $this->_tpl_vars['user'] )): ?>
                <?php if (( $this->_tpl_vars['tiki_p_admin'] == 'y' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual'] == 'n' ) || ( $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['individual_tiki_p_create_file_galleries'] == 'y' )): ?>
                &nbsp;&nbsp; <a class="fgallink" href="tiki-file_galleries.php?offset=<?php echo $this->_tpl_vars['offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
&amp;removegal=<?php echo $this->_tpl_vars['galleries'][$this->_sections['changes']['index']]['id']; ?>
"><img src='img/icons2/delete.gif' border='0' alt='削除' title='削除' /></a>
                <?php endif; ?>
        <?php endif; ?>
	
	</td>
</tr>
<?php endif; ?>
<?php endfor; else: ?>
<tr><td class="odd" colspan="<?php echo $this->_tpl_vars['cntcol']; ?>
">
<b>登録はありません</b>
</td></tr>
<?php endif; ?>
</table>

<?php if ($this->_tpl_vars['cant_pages'] > 1): ?>
<br />
<div class="mini">
<?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
[<a class="fgalprevnext" href="tiki-file_galleries.php?find=<?php echo $this->_tpl_vars['find']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
&amp;sort_mode=<?php echo $this->_tpl_vars['sort_mode']; ?>
">前</a>]&nbsp;
<?php endif; ?>
ページ: <?php echo $this->_tpl_vars['actual_page']; ?>
/<?php echo $this->_tpl_vars['cant_pages']; ?>

<?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
&nbsp;[<a class="fgalprevnext" href="tiki-file_galleries.php?find=<?php echo $this->_tpl_vars['find']; ?>
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
<a class="prevnext" href="tiki-file_galleries.php?find=<?php echo $this->_tpl_vars['find']; ?>
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