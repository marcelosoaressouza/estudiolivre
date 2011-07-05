<?php /* Smarty version 2.6.18, created on 2011-04-04 18:04:12
         compiled from tiki-browse_image.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_image', 'tiki-browse_image.tpl', 35, false),array('function', 'jspopup', 'tiki-browse_image.tpl', 58, false),array('modifier', 'tiki_long_datetime', 'tiki-browse_image.tpl', 108, false),array('modifier', 'escape', 'tiki-browse_image.tpl', 114, false),)), $this); ?>


<?php if ($this->_tpl_vars['popup']): ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="UTF-8"<?php echo '?>'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="StyleSheet"  href="styles/<?php echo $this->_tpl_vars['style']; ?>
" type="text/css" />
<script type="text/javascript" src="lib/imagegals/imagegallib.js"></script>
</head>
<body>
<div id="<?php echo $this->_tpl_vars['rootid']; ?>
browse_image">
<?php else: ?>
<div id="<?php echo $this->_tpl_vars['rootid']; ?>
browse_image">
  <h2><a class="pagetitle pixurl" href="<?php echo $this->_tpl_vars['url_base']; ?>
<?php echo $this->_tpl_vars['imageId']; ?>
">Visualizando Imagem: <span class="noslideshow"><?php echo $this->_tpl_vars['name']; ?>
</span><span class="slideshow_i pixurl" style="display: none">#<?php echo $this->_tpl_vars['imageId']; ?>
</span></a></h2>
  <p>
    <a class="linkbut" href="tiki-browse_gallery.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;offset=<?php echo $this->_tpl_vars['offset']; ?>
" style="float: left;">retornar à galeria</a>
    <?php if ($this->_tpl_vars['tiki_p_admin_galleries'] == 'y' || ( $this->_tpl_vars['user'] && $this->_tpl_vars['user'] == $this->_tpl_vars['owner'] )): ?>
      <a class="linkbut pixurl" href="tiki-edit_image.php?galleryId=<?php echo $this->_tpl_vars['galleryId']; ?>
&amp;edit=<?php echo $this->_tpl_vars['imageId']; ?>
" style="float: right;">editar imagem</a>
    <?php endif; ?>
  </p>
<?php endif; ?>

<?php ob_start(); ?>


  <div align="center" class="noslideshow">


	<a href="<?php echo $this->_tpl_vars['url_base']; ?>
<?php echo $this->_tpl_vars['firstId']; ?>
<?php echo $this->_tpl_vars['same_scale']; ?>
"
		class="gallink"<?php if ($this->_tpl_vars['imageId'] == $this->_tpl_vars['firstId']): ?> style="display: none;"<?php endif; ?>><?php echo smarty_function_html_image(array('file' => 'img/icons2/nav_first.gif','border' => 'none','alt' => 'primeira imagem','title' => 'primeira imagem'), $this);?>
</a>


	<?php if ($this->_tpl_vars['scaleinfo']['prevscale']): ?>
   	  <a href="<?php echo $this->_tpl_vars['url_base']; ?>
<?php echo $this->_tpl_vars['imageId']; ?>
&amp;scalesize=<?php echo $this->_tpl_vars['scaleinfo']['prevscale']; ?>
" class="gallink"><?php echo smarty_function_html_image(array('file' => 'img/icons/zoom-.gif','border' => 'none','alt' => 'menor','title' => 'menor'), $this);?>
</a>
	<?php endif; ?>


	<?php if ($this->_tpl_vars['resultscale']): ?>
	  <a href="<?php echo $this->_tpl_vars['url_base']; ?>
<?php echo $this->_tpl_vars['imageId']; ?>
&amp;scalesize=0" class="gallink"><?php echo smarty_function_html_image(array('file' => 'img/icons/zoom_equal.gif','border' => 'none','alt' => 'tamanho original','title' => 'tamanho original'), $this);?>
</a>
	<?php endif; ?>


	<?php if ($this->_tpl_vars['scaleinfo']['nextscale']): ?>
	  <a href="<?php echo $this->_tpl_vars['url_base']; ?>
<?php echo $this->_tpl_vars['imageId']; ?>
&amp;scalesize=<?php echo $this->_tpl_vars['scaleinfo']['nextscale']; ?>
" class="gallink"><?php echo smarty_function_html_image(array('file' => 'img/icons/zoom+.gif','border' => 'none','alt' => 'maior','title' => 'maior'), $this);?>
</a>
	<?php endif; ?>
	    

	<a href="<?php echo $this->_tpl_vars['url_base']; ?>
<?php echo $this->_tpl_vars['previmg']; ?>
<?php echo $this->_tpl_vars['same_scale']; ?>
"
    	class="gallink" style="padding-right:6px;<?php if (! $this->_tpl_vars['previmg']): ?> display: none;<?php endif; ?>">    	<?php echo smarty_function_html_image(array('file' => 'img/icons2/nav_dot_right.gif','border' => 'none','alt' => 'imagem anterior','title' => 'imagem anterior'), $this);?>
</a>


	<?php if (! $this->_tpl_vars['popup']): ?>
	  <a <?php echo smarty_function_jspopup(array('height' => ($this->_tpl_vars['winy']),'width' => ($this->_tpl_vars['winx']),'href' => ($this->_tpl_vars['url_base']).($this->_tpl_vars['imageId'])."&amp;popup=1&amp;scalesize=".($this->_tpl_vars['defaultscale'])), $this);?>
 class="gallink">
        <?php echo smarty_function_html_image(array('file' => 'img/icons2/admin_unhide.gif','border' => 'none','alt' => 'Janela de popup','title' => 'janela de popup'), $this);?>
</a>
	<?php endif; ?>


	<a href="<?php echo $this->_tpl_vars['url_base']; ?>
<?php echo $this->_tpl_vars['nextimg']; ?>
<?php echo $this->_tpl_vars['same_scale']; ?>
"
    	class="gallink" style="padding-left:6px;<?php if (! $this->_tpl_vars['nextimg']): ?> display: none;<?php endif; ?>">    	<?php echo smarty_function_html_image(array('file' => 'img/icons2/nav_dot_left.gif','border' => 'none','alt' => 'próxima imagem','title' => 'próxima imagem'), $this);?>
</a>


	<?php if ($this->_tpl_vars['listImgId']): ?>
	  <a href="javascript:thepix.toggle('start')"><?php echo smarty_function_html_image(array('file' => 'img/icons2/cycle_next.gif','border' => 'none','alt' => 'avançar slide','title' => 'avançar slide'), $this);?>
</a>
	<?php endif; ?>


	<a href="<?php echo $this->_tpl_vars['url_base']; ?>
<?php echo $this->_tpl_vars['lastId']; ?>
<?php echo $this->_tpl_vars['same_scale']; ?>
"
		class="gallink"<?php if ($this->_tpl_vars['imageId'] == $this->_tpl_vars['lastId']): ?> style="display: none;"<?php endif; ?>><?php echo smarty_function_html_image(array('file' => 'img/icons2/nav_last.gif','border' => 'none','alt' => 'última imagem','title' => 'última imagem'), $this);?>
</a>    
  </div>


  <div class="slideshow" style="display: none;" align="center">


	<a href="javascript:thepix.toggle('stop')"><?php echo smarty_function_html_image(array('file' => 'img/icons2/admin_delete.gif','border' => 'none','alt' => 'parar','title' => 'parar'), $this);?>
</a>

	<a href="javascript:thepix.toggle('toTheEnd')"><?php echo smarty_function_html_image(array('file' => 'img/icons/ico_redo.gif','border' => 'none','alt' => 'Cyclic','title' => 'Cyclic'), $this);?>
</a>

	<a href="javascript:thepix.toggle('backward')"><?php echo smarty_function_html_image(array('file' => 'img/icons/ico_mode.gif','border' => 'none','alt' => 'Direção','title' => 'Direção'), $this);?>
</a>
  </div>
<?php $this->_smarty_vars['capture']['buttons'] = ob_get_contents(); ob_end_clean(); ?>
<?php echo $this->_smarty_vars['capture']['buttons']; ?>


<div class="showimage" <?php if (( $this->_tpl_vars['popup'] )): ?>style="height: 400px"<?php endif; ?>>
<?php if ($this->_tpl_vars['scaleinfo']['clickscale'] >= 0): ?>
  <a href="<?php echo $this->_tpl_vars['url_base']; ?>
<?php echo $this->_tpl_vars['imageId']; ?>
&amp;scalesize=<?php echo $this->_tpl_vars['scaleinfo']['clickscale']; ?>
" title="Clique para dar zoom">
<?php endif; ?>
<img src="show_image.php?id=<?php echo $this->_tpl_vars['imageId']; ?>
&amp;scalesize=<?php echo $this->_tpl_vars['resultscale']; ?>
&amp;nocount=y" alt="imagem" id="thepix" />
<?php if ($this->_tpl_vars['scaleinfo']['clickscale'] >= 0): ?>
</a>
<?php endif; ?>
</div>
  
<?php if (! $this->_tpl_vars['popup']): ?>
  <?php echo $this->_smarty_vars['capture']['buttons']; ?>

<?php endif; ?>

  
<?php if ($this->_tpl_vars['popup'] == ""): ?>
  <br /><br />
  <table class="normal noslideshow">
	<tr><td class="odd">Nome da Imagem:</td><td class="odd"><?php echo $this->_tpl_vars['name']; ?>
</td></tr>
	<tr><td class="even">Criado em:</td><td class="even"><?php echo ((is_array($_tmp=$this->_tpl_vars['created'])) ? $this->_run_mod_handler('tiki_long_datetime', true, $_tmp) : smarty_modifier_tiki_long_datetime($_tmp)); ?>
</td></tr>
	<tr><td class="odd">Tamanho da imagem:</td><td class="odd"><?php echo $this->_tpl_vars['xsize']; ?>
x<?php echo $this->_tpl_vars['ysize']; ?>
</td></tr>
	<tr><td class="even">escaladeimagem:</td><td class="even"><?php if ($this->_tpl_vars['resultscale']): ?><?php echo $this->_tpl_vars['xsize_scaled']; ?>
x<?php echo $this->_tpl_vars['ysize_scaled']; ?>
<?php else: ?>tamanho original<?php endif; ?></td></tr>
	<tr><td class="odd">Visitas:</td><td class="odd"><?php echo $this->_tpl_vars['hits']; ?>
</td></tr>
	<tr><td class="even">Descrição:</td><td class="even"><?php echo $this->_tpl_vars['description']; ?>
</td></tr>
	<?php if ($this->_tpl_vars['feature_maps'] == 'y'): ?>
  		<tr><td class="odd">Latitude (WGS84/decimal graus):</td><td class="odd"><?php echo ((is_array($_tmp=$this->_tpl_vars['lat'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td></tr>
  		<tr><td class="even">Longitude (WGS84/decimal graus):</td><td class="even"><?php echo ((is_array($_tmp=$this->_tpl_vars['lon'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td></tr>
  	<?php endif; ?>
	<tr><td class="odd">Autor:</td><td class="odd"><?php echo $this->_tpl_vars['image_user']; ?>
</td></tr>
	<?php if ($this->_tpl_vars['tiki_p_admin_galleries'] == 'y' || ( $this->_tpl_vars['user'] && $this->_tpl_vars['user'] == $this->_tpl_vars['owner'] )): ?>
	  <tr><td class="even">Mover a imagem:</td><td class="odd">
	  <form action="tiki-browse_image.php" method="post">
		<input type="hidden" name="scalesize" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['scalesize'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" />
		<input type="hidden" name="sort_mode" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['sort_mode'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/>
		<input type="hidden" name="imageId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['imageId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/>
		<input type="hidden" name="galleryId" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['galleryId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"/>
		<input type="text" name="newname" value="<?php echo $this->_tpl_vars['name']; ?>
" />
		<select name="newgalleryId">
	    <?php unset($this->_sections['idx']);
$this->_sections['idx']['name'] = 'idx';
$this->_sections['idx']['loop'] = is_array($_loop=$this->_tpl_vars['galleries']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['idx']['show'] = true;
$this->_sections['idx']['max'] = $this->_sections['idx']['loop'];
$this->_sections['idx']['step'] = 1;
$this->_sections['idx']['start'] = $this->_sections['idx']['step'] > 0 ? 0 : $this->_sections['idx']['loop']-1;
if ($this->_sections['idx']['show']) {
    $this->_sections['idx']['total'] = $this->_sections['idx']['loop'];
    if ($this->_sections['idx']['total'] == 0)
        $this->_sections['idx']['show'] = false;
} else
    $this->_sections['idx']['total'] = 0;
if ($this->_sections['idx']['show']):

            for ($this->_sections['idx']['index'] = $this->_sections['idx']['start'], $this->_sections['idx']['iteration'] = 1;
                 $this->_sections['idx']['iteration'] <= $this->_sections['idx']['total'];
                 $this->_sections['idx']['index'] += $this->_sections['idx']['step'], $this->_sections['idx']['iteration']++):
$this->_sections['idx']['rownum'] = $this->_sections['idx']['iteration'];
$this->_sections['idx']['index_prev'] = $this->_sections['idx']['index'] - $this->_sections['idx']['step'];
$this->_sections['idx']['index_next'] = $this->_sections['idx']['index'] + $this->_sections['idx']['step'];
$this->_sections['idx']['first']      = ($this->_sections['idx']['iteration'] == 1);
$this->_sections['idx']['last']       = ($this->_sections['idx']['iteration'] == $this->_sections['idx']['total']);
?>
	      <option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['galleries'][$this->_sections['idx']['index']]['id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" <?php if ($this->_tpl_vars['galleries'][$this->_sections['idx']['index']]['id'] == $this->_tpl_vars['galleryId']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['galleries'][$this->_sections['idx']['index']]['name']; ?>
</option>
	    <?php endfor; endif; ?>
		</select>
		<input type="submit" name="move_image" value="mover" />
	  </form>
	  </td></tr>
	<?php endif; ?>
  </table>
  <br /><br />    
  <table class="normal noslideshow">
  <tr>
  	<td class="even">
  	<small>
    Você pode visualizar esta imagem em seu navegador usando:<br /><br />
    <a class="gallink" href="<?php echo $this->_tpl_vars['url_browse']; ?>
?imageId=<?php echo $this->_tpl_vars['imageId']; ?>
"><?php echo $this->_tpl_vars['url_browse']; ?>
?imageId=<?php echo $this->_tpl_vars['imageId']; ?>
</a><br />
    </small>
    </td>
  </tr>
  <tr>
    <td class="even">
    <small>
    Você pode incluir imagens no código HTML usando uma dessas linhas:<br /><br />
    <?php if ($this->_tpl_vars['resultscale'] == $this->_tpl_vars['defaultscale']): ?>
    &lt;img src="<?php echo $this->_tpl_vars['url_show']; ?>
?id=<?php echo $this->_tpl_vars['imageId']; ?>
" /&gt;<br />
    &lt;img src="<?php echo $this->_tpl_vars['url_show']; ?>
?name=<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" /&gt;<br />
    <?php elseif (! $this->_tpl_vars['resultscale']): ?>
    &lt;img src="<?php echo $this->_tpl_vars['url_show']; ?>
?id=<?php echo $this->_tpl_vars['imageId']; ?>
&amp;scalesize=0" /&gt;<br />
    &lt;img src="<?php echo $this->_tpl_vars['url_show']; ?>
?name=<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&amp;scalesize=0" /&gt;<br />
    <?php else: ?>
    &lt;img src="<?php echo $this->_tpl_vars['url_show']; ?>
?id=<?php echo $this->_tpl_vars['imageId']; ?>
&amp;scalesize=<?php echo $this->_tpl_vars['resultscale']; ?>
" /&gt;<br />
    &lt;img src="<?php echo $this->_tpl_vars['url_show']; ?>
?name=<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&amp;scalesize=<?php echo $this->_tpl_vars['resultscale']; ?>
" /&gt;<br />
    <?php endif; ?>
    </small>
    </td>
  </tr>
  <tr>
    <td class="even">
    <small>
    Você pode incluir imagens numa página tiki usando uma dessas linhas:<br /><br />
    <?php if ($this->_tpl_vars['resultscale'] == $this->_tpl_vars['defaultscale']): ?>
    <?php echo '{'; ?>
img src=show_image.php?id=<?php echo $this->_tpl_vars['imageId']; ?>
 <?php echo '}'; ?>
<br />
    <?php echo '{'; ?>
img src=show_image.php?name=<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 <?php echo '}'; ?>
<br />
    <?php elseif (! $this->_tpl_vars['resultscale']): ?>
    <?php echo '{'; ?>
img src=show_image.php?id=<?php echo $this->_tpl_vars['imageId']; ?>
&amp;scalesize=0 <?php echo '}'; ?>
<br />
    <?php echo '{'; ?>
img src=show_image.php?name=<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&amp;scalesize=0 <?php echo '}'; ?>
<br />
    <?php else: ?>
    <?php echo '{'; ?>
img src=<?php echo $this->_tpl_vars['url_show']; ?>
?id=<?php echo $this->_tpl_vars['imageId']; ?>
&amp;scaled&amp;scalesize=<?php echo $this->_tpl_vars['resultscale']; ?>
 <?php echo '}'; ?>
<br />
    <?php echo '{'; ?>
img src=<?php echo $this->_tpl_vars['url_show']; ?>
?name=<?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
&amp;scalesize=<?php echo $this->_tpl_vars['resultscale']; ?>
 <?php echo '}'; ?>
<br />
    <?php endif; ?>
    </small>
    </td>
  </tr>
  </table>
<?php endif; ?>  

</div> 

<?php if ($this->_tpl_vars['listImgId']): ?>

<script type='text/javascript'>
<!--
var tmp = window.location.search.match(/delay=(\d+)/);
tmp = tmp ? parseInt(tmp[1]) : 3000;
var thepix = new Diaporama('thepix', [<?php echo $this->_tpl_vars['listImgId']; ?>
], {
	  startId: <?php echo $this->_tpl_vars['imageId']; ?>
,
	  root: '<?php echo $this->_tpl_vars['rootid']; ?>
browse_image',
	  resetUrl: 1,
	  delay: tmp
	});
//-->
</script>

<?php endif; ?>

<?php if ($this->_tpl_vars['popup']): ?>
</body></html>
<?php endif; ?>