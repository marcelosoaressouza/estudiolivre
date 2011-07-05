<?php /* Smarty version 2.6.18, created on 2011-04-05 20:04:48
         compiled from styles/bolha/tiki-browse_freetags.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-browse_freetags.tpl', 1, false),array('function', 'cycle', 'styles/bolha/tiki-browse_freetags.tpl', 44, false),array('function', 'el_gallery_item', 'styles/bolha/tiki-browse_freetags.tpl', 48, false),array('function', 'el_wiki_item', 'styles/bolha/tiki-browse_freetags.tpl', 53, false),array('modifier', 'replace', 'styles/bolha/tiki-browse_freetags.tpl', 15, false),array('modifier', 'truncate', 'styles/bolha/tiki-browse_freetags.tpl', 51, false),array('block', 'tooltip', 'styles/bolha/tiki-browse_freetags.tpl', 16, false),)), $this); ?>
<?php echo smarty_function_css(array('extra' => "el-gallery_list_item,el-gallery_list_filters"), $this);?>

<!-- tiki-browse_freetags.tpl Begin -->

<div id="browseFreeTags">



<?php if ($this->_tpl_vars['feature_morcego'] == 'y' && $this->_tpl_vars['freetags_feature_3d'] == 'y'): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "browseRelatedTags.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<h2>Ítens com a tag: <span id="currentTag2"><?php echo $this->_tpl_vars['tag']; ?>
</span></h2>

<ul class="listFiltersButtons">
	<img id="listFilterImg0" alt="" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/bLeft<?php if (! $this->_tpl_vars['type']): ?>Act<?php else: ?>Inac<?php endif; ?>.png" />	
	<?php $this->_tag_stack[] = array('tooltip', array('name' => "browse-freetags-all",'text' => 'Ver todos os Itens com a tag')); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
		<li class="button<?php if (! $this->_tpl_vars['type']): ?>Active<?php else: ?>Inactive<?php endif; ?>"><a class="linkbut <?php if ($this->_tpl_vars['type'] == ''): ?> highlight<?php endif; ?>"  href="tiki-browse_freetags.php?tag=<?php echo $this->_tpl_vars['tag']; ?>
" id="typeAll">Todos</a></li>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	
    <?php if ($this->_tpl_vars['feature_wiki'] == 'y'): ?>
    	<?php $this->_tag_stack[] = array('tooltip', array('name' => "browse-freetags-all",'text' => "Ver <strong>apenas</strong> <b>paginas wiki</b> com a tag")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> 
    		<li class="button<?php if ($this->_tpl_vars['type'] == 'wiki page'): ?>Active<?php else: ?>Inactive<?php endif; ?>"><a class="linkbut <?php if ($this->_tpl_vars['type'] == 'wiki page'): ?> highlight<?php endif; ?>"  href="tiki-browse_freetags.php?tag=<?php echo $this->_tpl_vars['tag']; ?>
&amp;type=wiki%20page" id="typeWikiPage">páginas wiki</a></li>
    	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php endif; ?>
    
    <?php if ($this->_tpl_vars['feature_blogs'] == 'y'): ?>
    	<?php $this->_tag_stack[] = array('tooltip', array('name' => "browse-freetags-all",'text' => "Ver <strong>apenas</strong> <b>posts em blogs</b> com a tag")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?> 
    		<li class="button<?php if ($this->_tpl_vars['type'] == 'blog post'): ?>Active<?php else: ?>Inactive<?php endif; ?>"><a class="linkbut <?php if ($this->_tpl_vars['type'] == 'blog post'): ?> highlight<?php endif; ?>"  href="tiki-browse_freetags.php?tag=<?php echo $this->_tpl_vars['tag']; ?>
&amp;type=blog post" id="typeBlogPost">Posts em blog</a></li>
    	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php endif; ?>

    <?php $this->_tag_stack[] = array('tooltip', array('name' => "browse-freetags-all",'text' => "Ver <strong>apenas</strong> <b>publicações</b> com a tag")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>     
		<li class="button<?php if ($this->_tpl_vars['type'] == 'gallery'): ?>Active<?php else: ?>Inactive<?php endif; ?> buttonInactiveRight"><a class="linkbut" href="tiki-browse_freetags.php?tag=<?php echo $this->_tpl_vars['tag']; ?>
&amp;type=gallery"><?php if ($this->_tpl_vars['type'] == 'gallery'): ?><span class="highlight"><?php endif; ?>Acervo<?php if ($this->_tpl_vars['type'] == 'gallery'): ?></span><?php endif; ?></a></li>
		
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<img id="listFilterImg4" alt="" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/bRight<?php if ($this->_tpl_vars['type'] == 'gallery'): ?>Act<?php else: ?>Inac<?php endif; ?>.png" />
</ul>
     
<?php if ($this->_tpl_vars['cantobjects'] == 0): ?>
  <h3>nenhum resultado</h3>
<?php else: ?>
  <h3><?php echo $this->_tpl_vars['cantobjects']; ?>
 resultado<?php if ($this->_tpl_vars['cantobjects'] != 1): ?>s<?php endif; ?> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "browseFreeTags-pagination.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></h3>

  <?php echo smarty_function_cycle(array('values' => "odd,even",'print' => false), $this);?>

  <?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['objects']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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

    <?php if ($this->_tpl_vars['objects'][$this->_sections['ix']['index']]['type'] == 'gallery'): ?>
		<?php echo smarty_function_el_gallery_item(array('id' => $this->_tpl_vars['objects'][$this->_sections['ix']['index']]['itemId']), $this);?>

    <?php elseif ($this->_tpl_vars['objects'][$this->_sections['ix']['index']]['type'] == 'blog post'): ?>
		<a href="<?php echo $this->_tpl_vars['objects'][$this->_sections['ix']['index']]['href']; ?>
" class="catname"><?php echo $this->_tpl_vars['objects'][$this->_sections['ix']['index']]['name']; ?>
</a><br/>
		<?php echo ((is_array($_tmp=$this->_tpl_vars['objects'][$this->_sections['ix']['index']]['description'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 250) : smarty_modifier_truncate($_tmp, 250)); ?>

    <?php else: ?>
    	<?php echo smarty_function_el_wiki_item(array('id' => $this->_tpl_vars['objects'][$this->_sections['ix']['index']]['itemId']), $this);?>

    <?php endif; ?>
 
  <?php endfor; endif; ?>
  
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "browseFreeTags-pagination.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

</div>
<!-- tiki-browse_freetags.tpl End -->