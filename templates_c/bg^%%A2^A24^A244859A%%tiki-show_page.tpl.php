<?php /* Smarty version 2.6.18, created on 2011-04-12 11:22:56
         compiled from styles/bolha/tiki-show_page.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'styles/bolha/tiki-show_page.tpl', 1, false),array('function', 'breadcrumbs', 'styles/bolha/tiki-show_page.tpl', 120, false),array('modifier', 'escape', 'styles/bolha/tiki-show_page.tpl', 4, false),array('modifier', 'lower', 'styles/bolha/tiki-show_page.tpl', 9, false),array('modifier', 'replace', 'styles/bolha/tiki-show_page.tpl', 11, false),array('modifier', 'userlink', 'styles/bolha/tiki-show_page.tpl', 232, false),array('modifier', 'tiki_long_datetime', 'styles/bolha/tiki-show_page.tpl', 234, false),array('modifier', 'date_format', 'styles/bolha/tiki-show_page.tpl', 251, false),array('block', 'tooltip', 'styles/bolha/tiki-show_page.tpl', 11, false),)), $this); ?>
<?php echo smarty_function_css(array(), $this);?>



<div <?php if ($this->_tpl_vars['user_dbl'] == 'y' && $this->_tpl_vars['dblclickedit'] == 'y' && $this->_tpl_vars['tiki_p_edit'] == 'y'): ?>ondblclick="location.href='tiki-editpage.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
';"<?php endif; ?>>	
	<div class="wikitopline"><!--do contextualMenu onclick="cancelBubble(event)"-->
	
	<?php if ($this->_tpl_vars['print_page'] != 'y'): ?>
		<?php if (! $this->_tpl_vars['lock']): ?>
			<?php if ($this->_tpl_vars['tiki_p_edit'] == 'y' || ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == 'sandbox'): ?>
				<?php if ($this->_tpl_vars['beingEdited'] == 'y'): ?>
					<?php $this->_tag_stack[] = array('tooltip', array('name' => "show-page-editar-pagina",'text' => "<b>Editar</b> essa página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><span class="tabbut"><a  class="highlight" href="tiki-editpage.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" class="tablink"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiEdit.png"></a></span><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php else: ?>
					<?php $this->_tag_stack[] = array('tooltip', array('name' => "show-page-editar-pagina",'text' => "<b>Editar</b> essa página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><span class="tabbut"><a href="tiki-editpage.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" class="tablink"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiEdit.png"></a></span><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['wiki_feature_3d'] == 'y'): ?>
			<?php $this->_tag_stack[] = array('tooltip', array('name' => "show-page-representacao-3d",'text' => "Representação <b>tridimensional</b> do wiki")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a  href="javascript:wiki3d_open('<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
',<?php echo $this->_tpl_vars['wiki_3d_width']; ?>
, <?php echo $this->_tpl_vars['wiki_3d_height']; ?>
)"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWiki3dWiki.png"></a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php endif; ?>
		
		<?php $this->_tag_stack[] = array('tooltip', array('name' => "show-page-abrir-impressao",'text' => "Abrir versão para <b>impressão</b>")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a  href="tiki-print.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiPrint.png" alt="принтиране" /></a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		
		<?php if ($this->_tpl_vars['feature_wiki_pdf'] == 'y'): ?>
			<?php $this->_tag_stack[] = array('tooltip', array('name' => "show-page-criar-pdf",'text' => "Criar um <b>PDF</b> dessa página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a  href="tiki-config_pdf.php?<?php if ($this->_tpl_vars['home_info'] && $this->_tpl_vars['home_info']['page_ref_id']): ?>page_ref_id=<?php echo $this->_tpl_vars['home_info']['page_ref_id']; ?>
<?php else: ?>page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
<?php endif; ?>"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiExport.png" alt="pdf"></a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php endif; ?>
		
		<?php if (((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) != 'sandbox'): ?>
			<?php if ($this->_tpl_vars['tiki_p_remove'] == 'y'): ?>
				<?php $this->_tag_stack[] = array('tooltip', array('name' => "show-page-remover-pagina",'text' => "<b>Remover</b> essa página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><span class="tabbut"><a href="tiki-removepage.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;version=last" class="tablink"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiRemove.png"></a></span><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['tiki_p_rename'] == 'y'): ?>
				<?php $this->_tag_stack[] = array('tooltip', array('name' => "show-page-renomear-pagina",'text' => "<b>Renomear</b> página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><span class="tabbut"><a href="tiki-rename_page.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" class="tablink"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiRename.png"></a></span><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php if (((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) != 'sandbox'): ?>
			<?php if ($this->_tpl_vars['lock'] && ( $this->_tpl_vars['tiki_p_admin_wiki'] == 'y' || ( $this->_tpl_vars['user'] && ( $this->_tpl_vars['user'] == $this->_tpl_vars['page_user'] || $this->_tpl_vars['user'] == 'admin' ) && ( $this->_tpl_vars['tiki_p_lock'] == 'y' ) && ( $this->_tpl_vars['feature_wiki_usrlock'] == 'y' ) ) )): ?>
				<?php $this->_tag_stack[] = array('tooltip', array('name' => "show-page-observar-pagina",'text' => "<b>Destravar</b> a página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><span class="tabbut"><a href="tiki-index.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;action=unlock" class="tablink"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiUnLock.png"></a></span><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php endif; ?>
			<?php if (! $this->_tpl_vars['lock'] && ( $this->_tpl_vars['tiki_p_admin_wiki'] == 'y' || ( ( $this->_tpl_vars['tiki_p_lock'] == 'y' ) && ( $this->_tpl_vars['feature_wiki_usrlock'] == 'y' ) ) )): ?>
				<?php $this->_tag_stack[] = array('tooltip', array('name' => "show-page-travar-pagina",'text' => "<b>Travar</b> essa página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><span class="tabbut"><a href="tiki-index.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
&amp;action=lock" class="tablink"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiLock.png"></a></span><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['tiki_p_admin_wiki'] == 'y'): ?>
				<?php $this->_tag_stack[] = array('tooltip', array('name' => "show-page-modificar-permissoes",'text' => "Modificar <b>permissões</b>")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><span class="tabbut"><a href="tiki-pagepermissions.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" class="tablink"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiPermissions.png"></a></span><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php endif; ?>
		<?php endif; ?>
		
		<?php if (((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) != 'sandbox'): ?>
			<?php if ($this->_tpl_vars['feature_history'] == 'y' && $this->_tpl_vars['tiki_p_wiki_view_history'] == 'y'): ?>
				<?php $this->_tag_stack[] = array('tooltip', array('name' => "show-page-historico-edicoes",'text' => "<b>Histórico</b> de edições da página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><span class="tabbut"><a href="tiki-pagehistory.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" class="tablink"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiHistory.png"></a></span><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php endif; ?>
		<?php endif; ?>
		
		
		
		<?php if ($this->_tpl_vars['feature_multilingual'] == 'y' && $this->_tpl_vars['tiki_p_edit'] == 'y' && ! $this->_tpl_vars['lock']): ?>
		     <?php $this->_tag_stack[] = array('tooltip', array('name' => "show-page-traduzir-pagina",'text' => "<b>Traduzir</b> página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><span class="tabbut"><a href="tiki-edit_translation.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
" class="tablink"><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiTranslate.png"></a></span><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['feature_multilingual'] == 'y' && count ( $this->_tpl_vars['trads'] ) > 1): ?>
			<?php $this->_tag_stack[] = array('tooltip', array('text' => "<b>Traduções</b> dessa página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiTranslations.png" onclick="document.getElementById('transHide').style.display='inline'" style="cursor:pointer"><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<span id="transHide" style="display:none">
				&nbsp;&nbsp;<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "translated-lang.tpl", 'smarty_include_vars' => array('td' => 'y')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</span>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['feature_backlinks'] == 'y' && $this->_tpl_vars['backlinks']): ?>
			<?php $this->_tag_stack[] = array('tooltip', array('name' => "show-page-ver-referencias",'text' => "Ver as páginas que referenciam esta página. Ou seja, que possuem links que trazem cá")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiRef.png" onclick="flip('backlinksId')" style="cursor:pointer"><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['feature_freetags'] == 'y'): ?>
				<?php $this->_tag_stack[] = array('tooltip', array('text' => "<b>Tags</b> dessa página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iWikiTags.png" onclick="flip('tagsHide')" style="cursor:pointer"><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
				<span id="tagsHide" style="display:none">
					<b>Tags:</b>
					<?php $_from = $this->_tpl_vars['freetags']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tag']):
?>
						<a href="tiki-browse_freetags.php?tag=<?php echo $this->_tpl_vars['tag']['tag']; ?>
"><?php echo $this->_tpl_vars['tag']['tag']; ?>
</a>&nbsp;
					<?php endforeach; else: ?>
						Essa página ainda não tem tags
					<?php endif; unset($_from); ?>
				</span>
		<?php endif; ?>
		
		<?php if ($this->_tpl_vars['feature_backlinks'] == 'y' && $this->_tpl_vars['backlinks']): ?>		
			<div style="display:none" id="backlinksId">
				páginas que citam esta:
				<?php unset($this->_sections['back']);
$this->_sections['back']['name'] = 'back';
$this->_sections['back']['loop'] = is_array($_loop=$this->_tpl_vars['backlinks']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['back']['show'] = true;
$this->_sections['back']['max'] = $this->_sections['back']['loop'];
$this->_sections['back']['step'] = 1;
$this->_sections['back']['start'] = $this->_sections['back']['step'] > 0 ? 0 : $this->_sections['back']['loop']-1;
if ($this->_sections['back']['show']) {
    $this->_sections['back']['total'] = $this->_sections['back']['loop'];
    if ($this->_sections['back']['total'] == 0)
        $this->_sections['back']['show'] = false;
} else
    $this->_sections['back']['total'] = 0;
if ($this->_sections['back']['show']):

            for ($this->_sections['back']['index'] = $this->_sections['back']['start'], $this->_sections['back']['iteration'] = 1;
                 $this->_sections['back']['iteration'] <= $this->_sections['back']['total'];
                 $this->_sections['back']['index'] += $this->_sections['back']['step'], $this->_sections['back']['iteration']++):
$this->_sections['back']['rownum'] = $this->_sections['back']['iteration'];
$this->_sections['back']['index_prev'] = $this->_sections['back']['index'] - $this->_sections['back']['step'];
$this->_sections['back']['index_next'] = $this->_sections['back']['index'] + $this->_sections['back']['step'];
$this->_sections['back']['first']      = ($this->_sections['back']['iteration'] == 1);
$this->_sections['back']['last']       = ($this->_sections['back']['iteration'] == $this->_sections['back']['total']);
?>
				<a href="tiki-index.php?page=<?php echo $this->_tpl_vars['backlinks'][$this->_sections['back']['index']]['fromPage']; ?>
&amp;bl"><?php echo $this->_tpl_vars['backlinks'][$this->_sections['back']['index']]['fromPage']; ?>
</a>
				<?php endfor; endif; ?>
			</div>
		<?php endif; ?>
			
		       
	
		
	
		
		
		
	
		
	
		
		
		
		
		
		
		
		
		
		
		
		
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['feature_wiki_pageid'] == 'y'): ?>
		<small><a class="link" href="tiki-index.php?page_id=<?php echo $this->_tpl_vars['page_id']; ?>
">номер на страница: <?php echo $this->_tpl_vars['page_id']; ?>
</a></small>
	<?php endif; ?>
	<?php echo smarty_function_breadcrumbs(array('type' => 'desc','loc' => 'page','crumbs' => $this->_tpl_vars['crumbs']), $this);?>

	<?php if ($this->_tpl_vars['cached_page'] == 'y'): ?><small>(кеширан/а)</small><?php endif; ?>
	
	<?php if ($this->_tpl_vars['is_categorized'] == 'y' && $this->_tpl_vars['feature_categories'] == 'y' && $this->_tpl_vars['feature_categorypath'] == 'y'): ?>
		<?php echo $this->_tpl_vars['display_catpath']; ?>

	<?php endif; ?>
	
	</div>
	
	<div id="wikitext" >
	
	<?php if ($this->_tpl_vars['structure'] == 'y'): ?>
	
	<div class="tocnav">
	<table>
	<tr>
	  <td>
	    <?php if ($this->_tpl_vars['prev_info'] && $this->_tpl_vars['prev_info']['page_ref_id']): ?>
			<a href="tiki-index.php?page_ref_id=<?php echo $this->_tpl_vars['prev_info']['page_ref_id']; ?>
"><img src="img/icons2/nav_dot_right.gif" border="0" height="11" width="8" alt="Предишна страница" 
	   			<?php if ($this->_tpl_vars['prev_info']['page_alias']): ?>
	   				title='<?php echo $this->_tpl_vars['prev_info']['page_alias']; ?>
'
	   			<?php else: ?>
	   				title='<?php echo $this->_tpl_vars['prev_info']['pageName']; ?>
'
	   			<?php endif; ?>/></a><?php else: ?><img src="img/icons2/8.gif" alt="" border="0" height="1" width="8" /><?php endif; ?>
		<?php if ($this->_tpl_vars['parent_info']): ?>
	   	<a href="tiki-index.php?page_ref_id=<?php echo $this->_tpl_vars['parent_info']['page_ref_id']; ?>
"><img src="img/icons2/nav_home.gif" border="0" height="11" width="13" alt="Родителска страница" 
	        <?php if ($this->_tpl_vars['parent_info']['page_alias']): ?>
	   	      title='<?php echo $this->_tpl_vars['parent_info']['page_alias']; ?>
'
	        <?php else: ?>
	   	      title='<?php echo $this->_tpl_vars['parent_info']['pageName']; ?>
'
	        <?php endif; ?>/></a><?php else: ?><img src="img/icons2/8.gif" alt="" border="0" height="1" width="8" /><?php endif; ?>
	   	<?php if ($this->_tpl_vars['next_info'] && $this->_tpl_vars['next_info']['page_ref_id']): ?>
	      <a href="tiki-index.php?page_ref_id=<?php echo $this->_tpl_vars['next_info']['page_ref_id']; ?>
"><img src="img/icons2/nav_dot_left.gif" height="11" width="8" border="0" alt="Следваща страница" 
			  <?php if ($this->_tpl_vars['next_info']['page_alias']): ?>
				  title='<?php echo $this->_tpl_vars['next_info']['page_alias']; ?>
'
			  <?php else: ?>
				  title='<?php echo $this->_tpl_vars['next_info']['pageName']; ?>
'
			  <?php endif; ?>/></a><?php else: ?><img src="img/icons2/8.gif" alt="" border="0" height="1" width="8" />
		<?php endif; ?>
		<?php if ($this->_tpl_vars['home_info']): ?>
	   	<a href="tiki-index.php?page_ref_id=<?php echo $this->_tpl_vars['home_info']['page_ref_id']; ?>
"><img src="img/icons2/home.gif" border="0" height="16" width="16" alt="TOC" 
			  <?php if ($this->_tpl_vars['home_info']['page_alias']): ?>
				  title='<?php echo $this->_tpl_vars['home_info']['page_alias']; ?>
'
			  <?php else: ?>
				  title='<?php echo $this->_tpl_vars['home_info']['pageName']; ?>
'
			  <?php endif; ?>/></a><?php endif; ?>
	  </td>
	  <td>
	
	<?php if ($this->_tpl_vars['tiki_p_edit_structures'] && $this->_tpl_vars['tiki_p_edit_structures'] == 'y'): ?>
	    <form action="tiki-editpage.php" method="post">
	      <input type="hidden" name="current_page_id" value="<?php echo $this->_tpl_vars['page_info']['page_ref_id']; ?>
" />
	      <input type="text" name="page" />
	      
	      <?php if ($this->_tpl_vars['page_info'] && ! $this->_tpl_vars['parent_info']): ?>
	      <input type="hidden" name="add_child" value="checked" /> 
	      <?php else: ?>
	      <input type="checkbox" name="add_child" /> Дъщерна
	      <?php endif; ?>      
	      <input type="submit" name="insert_into_struct" value="Добавяне на страница" />
	    </form>
	<?php endif; ?>
	  </td>
	</tr>
	<tr>
	  <td colspan="2">
	    <?php unset($this->_sections['ix']);
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['structure_path']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ix']['name'] = 'ix';
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
	      <?php if ($this->_tpl_vars['structure_path'][$this->_sections['ix']['index']]['parent_id']): ?>&nbsp;<?php echo $this->_tpl_vars['site_crumb_seper']; ?>
&nbsp;<?php endif; ?>
		  <a href="tiki-index.php?page_ref_id=<?php echo $this->_tpl_vars['structure_path'][$this->_sections['ix']['index']]['page_ref_id']; ?>
">
	      <?php if ($this->_tpl_vars['structure_path'][$this->_sections['ix']['index']]['page_alias']): ?>
	        <?php echo $this->_tpl_vars['structure_path'][$this->_sections['ix']['index']]['page_alias']; ?>

		  <?php else: ?>
	        <?php echo $this->_tpl_vars['structure_path'][$this->_sections['ix']['index']]['pageName']; ?>

		  <?php endif; ?>
		  </a>
		<?php endfor; endif; ?>
	  </td>
	</tr>
	</table>
	</div>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['feature_wiki_ratings'] == 'y'): ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "poll.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php endif; ?>
	<?php echo $this->_tpl_vars['parsed']; ?>

	<?php if ($this->_tpl_vars['pages'] > 1): ?>
		<br />
		<div align="center">
			<a href="tiki-index.php?<?php if ($this->_tpl_vars['page_info']): ?>page_ref_id=<?php echo $this->_tpl_vars['page_info']['page_ref_id']; ?>
<?php else: ?>page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
<?php endif; ?>&amp;pagenum=<?php echo $this->_tpl_vars['first_page']; ?>
"><img src="img/icons2/nav_first.gif" border="0" height="11" width="27" alt="Първа страница" title="Първа страница" /></a>
	
			<a href="tiki-index.php?<?php if ($this->_tpl_vars['page_info']): ?>page_ref_id=<?php echo $this->_tpl_vars['page_info']['page_ref_id']; ?>
<?php else: ?>page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
<?php endif; ?>&amp;pagenum=<?php echo $this->_tpl_vars['prev_page']; ?>
"><img src="img/icons2/nav_dot_right.gif" border="0" height="11" width="8" alt="Предишна страница" title="Предишна страница" /></a>
	
			<small>страница:<?php echo $this->_tpl_vars['pagenum']; ?>
/<?php echo $this->_tpl_vars['pages']; ?>
</small>
	
			<a href="tiki-index.php?<?php if ($this->_tpl_vars['page_info']): ?>page_ref_id=<?php echo $this->_tpl_vars['page_info']['page_ref_id']; ?>
<?php else: ?>page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
<?php endif; ?>&amp;pagenum=<?php echo $this->_tpl_vars['next_page']; ?>
"><img src="img/icons2/nav_dot_left.gif" border="0" height="11" width="8" alt="Следваща страница" title="Следваща страница" /></a>
	
	
			<a href="tiki-index.php?<?php if ($this->_tpl_vars['page_info']): ?>page_ref_id=<?php echo $this->_tpl_vars['page_info']['page_ref_id']; ?>
<?php else: ?>page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
<?php endif; ?>&amp;pagenum=<?php echo $this->_tpl_vars['last_page']; ?>
"><img src="img/icons2/nav_last.gif" border="0" height="11" width="27" alt="Последна страница" title="Последна страница" /></a>
		</div>
	<?php endif; ?>
	</div> 
	
	<?php if ($this->_tpl_vars['has_footnote'] == 'y'): ?><div class="wikitext wikifootnote"><?php echo $this->_tpl_vars['footnote']; ?>
</div><?php endif; ?>
	
	<?php if (isset ( $this->_tpl_vars['wiki_authors_style'] ) && $this->_tpl_vars['wiki_authors_style'] == 'business'): ?>
	<p class="editdate">
	  Последно редактиран/а от <a href="el-user.php?view_user=<?php echo $this->_tpl_vars['lastUser']; ?>
"><?php echo $this->_tpl_vars['lastUser']; ?>
</a>
	  <?php unset($this->_sections['author']);
$this->_sections['author']['name'] = 'author';
$this->_sections['author']['loop'] = is_array($_loop=$this->_tpl_vars['contributors']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['author']['show'] = true;
$this->_sections['author']['max'] = $this->_sections['author']['loop'];
$this->_sections['author']['step'] = 1;
$this->_sections['author']['start'] = $this->_sections['author']['step'] > 0 ? 0 : $this->_sections['author']['loop']-1;
if ($this->_sections['author']['show']) {
    $this->_sections['author']['total'] = $this->_sections['author']['loop'];
    if ($this->_sections['author']['total'] == 0)
        $this->_sections['author']['show'] = false;
} else
    $this->_sections['author']['total'] = 0;
if ($this->_sections['author']['show']):

            for ($this->_sections['author']['index'] = $this->_sections['author']['start'], $this->_sections['author']['iteration'] = 1;
                 $this->_sections['author']['iteration'] <= $this->_sections['author']['total'];
                 $this->_sections['author']['index'] += $this->_sections['author']['step'], $this->_sections['author']['iteration']++):
$this->_sections['author']['rownum'] = $this->_sections['author']['iteration'];
$this->_sections['author']['index_prev'] = $this->_sections['author']['index'] - $this->_sections['author']['step'];
$this->_sections['author']['index_next'] = $this->_sections['author']['index'] + $this->_sections['author']['step'];
$this->_sections['author']['first']      = ($this->_sections['author']['iteration'] == 1);
$this->_sections['author']['last']       = ($this->_sections['author']['iteration'] == $this->_sections['author']['total']);
?>
	   <?php if ($this->_sections['author']['first']): ?>, based on work by
	   <?php else: ?>
	    <?php if (! $this->_sections['author']['last']): ?>,
	    <?php else: ?> и
	    <?php endif; ?>
	   <?php endif; ?>
	   <?php echo ((is_array($_tmp=$this->_tpl_vars['contributors'][$this->_sections['author']['index']])) ? $this->_run_mod_handler('userlink', true, $_tmp) : smarty_modifier_userlink($_tmp)); ?>

	  <?php endfor; endif; ?>.<br />                                         
	  Страницата последно модифицирана на <?php echo ((is_array($_tmp=$this->_tpl_vars['lastModif'])) ? $this->_run_mod_handler('tiki_long_datetime', true, $_tmp) : smarty_modifier_tiki_long_datetime($_tmp)); ?>
.
	</p>
	<?php elseif (isset ( $this->_tpl_vars['wiki_authors_style'] ) && $this->_tpl_vars['wiki_authors_style'] == 'collaborative'): ?>
	<p class="editdate">
	  Contributors to this page: <?php echo ((is_array($_tmp=$this->_tpl_vars['lastUser'])) ? $this->_run_mod_handler('userlink', true, $_tmp) : smarty_modifier_userlink($_tmp)); ?>

	  <?php unset($this->_sections['author']);
$this->_sections['author']['name'] = 'author';
$this->_sections['author']['loop'] = is_array($_loop=$this->_tpl_vars['contributors']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['author']['show'] = true;
$this->_sections['author']['max'] = $this->_sections['author']['loop'];
$this->_sections['author']['step'] = 1;
$this->_sections['author']['start'] = $this->_sections['author']['step'] > 0 ? 0 : $this->_sections['author']['loop']-1;
if ($this->_sections['author']['show']) {
    $this->_sections['author']['total'] = $this->_sections['author']['loop'];
    if ($this->_sections['author']['total'] == 0)
        $this->_sections['author']['show'] = false;
} else
    $this->_sections['author']['total'] = 0;
if ($this->_sections['author']['show']):

            for ($this->_sections['author']['index'] = $this->_sections['author']['start'], $this->_sections['author']['iteration'] = 1;
                 $this->_sections['author']['iteration'] <= $this->_sections['author']['total'];
                 $this->_sections['author']['index'] += $this->_sections['author']['step'], $this->_sections['author']['iteration']++):
$this->_sections['author']['rownum'] = $this->_sections['author']['iteration'];
$this->_sections['author']['index_prev'] = $this->_sections['author']['index'] - $this->_sections['author']['step'];
$this->_sections['author']['index_next'] = $this->_sections['author']['index'] + $this->_sections['author']['step'];
$this->_sections['author']['first']      = ($this->_sections['author']['iteration'] == 1);
$this->_sections['author']['last']       = ($this->_sections['author']['iteration'] == $this->_sections['author']['total']);
?>
	   <?php if (! $this->_sections['author']['last']): ?>,
	   <?php else: ?> и
	   <?php endif; ?>
	   <?php echo ((is_array($_tmp=$this->_tpl_vars['contributors'][$this->_sections['author']['index']])) ? $this->_run_mod_handler('userlink', true, $_tmp) : smarty_modifier_userlink($_tmp)); ?>

	  <?php endfor; endif; ?>.<br />
	  Страницата последно модифицирана на <?php echo ((is_array($_tmp=$this->_tpl_vars['lastModif'])) ? $this->_run_mod_handler('tiki_long_datetime', true, $_tmp) : smarty_modifier_tiki_long_datetime($_tmp)); ?>
 от <?php echo ((is_array($_tmp=$this->_tpl_vars['lastUser'])) ? $this->_run_mod_handler('userlink', true, $_tmp) : smarty_modifier_userlink($_tmp)); ?>
.
	</p>
	<?php elseif (isset ( $this->_tpl_vars['wiki_authors_style'] ) && $this->_tpl_vars['wiki_authors_style'] == 'none'): ?>
	<?php else: ?>
	<p class="editdate">
	  
	  Последна модификация: <i><?php echo ((is_array($_tmp=$this->_tpl_vars['lastModif'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d/%m/%Y às %H:%M") : smarty_modifier_date_format($_tmp, "%d/%m/%Y às %H:%M")); ?>
</i>, от: <a href="el-user.php?view_user=<?php echo $this->_tpl_vars['lastUser']; ?>
"><?php echo $this->_tpl_vars['lastUser']; ?>
</a>
	</p>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['wiki_feature_copyrights'] == 'y' && $this->_tpl_vars['wikiLicensePage']): ?>
	  <?php if ($this->_tpl_vars['wikiLicensePage'] == $this->_tpl_vars['page']): ?>
	    <?php if ($this->_tpl_vars['tiki_p_edit_copyrights'] == 'y'): ?>
	      <p class="editdate">За да редактирате съобщението за авторски права <a href="copyrights.php?page=<?php echo $this->_tpl_vars['copyrightpage']; ?>
">Кликнете тук</a>.</p>
	    <?php endif; ?>
	  <?php else: ?>
	    <p class="editdate">Съдържанието на тази страница е лицензирано по силата на <a href="tiki-index.php?page=<?php echo $this->_tpl_vars['wikiLicensePage']; ?>
&amp;copyrightpage=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
"><?php echo $this->_tpl_vars['wikiLicensePage']; ?>
</a>.</p>
	  <?php endif; ?>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['print_page'] == 'y'): ?>
	  <div class="printFooter" align="center">
	  	<p>
		    The original document is available at:<br><b><?php echo $this->_tpl_vars['urlprefix']; ?>
tiki-index.php?page=<?php echo ((is_array($_tmp=$this->_tpl_vars['page'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'url') : smarty_modifier_escape($_tmp, 'url')); ?>
</b>
		</p>
	  </div>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['is_categorized'] == 'y' && $this->_tpl_vars['feature_categories'] == 'y' && $this->_tpl_vars['feature_categoryobjects'] == 'y'): ?>
	<div class="catblock"><?php echo $this->_tpl_vars['display_catobjects']; ?>
</div>
	<?php endif; ?>
</div>