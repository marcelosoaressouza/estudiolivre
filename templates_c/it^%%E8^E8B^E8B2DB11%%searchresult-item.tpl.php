<?php /* Smarty version 2.6.18, created on 2011-04-10 19:55:41
         compiled from styles/bolha/searchresult-item.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'cat', 'styles/bolha/searchresult-item.tpl', 2, false),array('modifier', 'strip_tags', 'styles/bolha/searchresult-item.tpl', 5, false),array('block', 'tooltip', 'styles/bolha/searchresult-item.tpl', 3, false),)), $this); ?>
<div class="searchResultItem">
	<?php if ($this->_tpl_vars['feature_search_fulltext'] == 'y'): ?><?php if ($this->_tpl_vars['result']['relevance'] <= 0): ?><?php $this->assign('tiptext', 'Busca Simples'); ?><?php else: ?><?php $this->assign('tiptext', ((is_array($_tmp="Relevância: ")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['result']['relevance']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['result']['relevance']))); ?><?php endif; ?><?php endif; ?>
	<?php $this->_tag_stack[] = array('tooltip', array('text' => ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['tiptext'])) ? $this->_run_mod_handler('cat', true, $_tmp, " - Hits: ") : smarty_modifier_cat($_tmp, " - Hits: ")))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['result']['hits']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['result']['hits'])))); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<a href="<?php echo $this->_tpl_vars['result']['href']; ?>
&amp;highlight=<?php echo $this->_tpl_vars['words']; ?>
" class="searchResultItemLink">
		<?php echo ((is_array($_tmp=$this->_tpl_vars['result']['pageName'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>

	</a>
	<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
	<?php if ($this->_tpl_vars['result']['type'] > ''): ?>
		<span class="searchType">
			(<?php echo $this->_tpl_vars['result']['type']; ?>
)
		</span>
	<?php endif; ?>				
	<br />
	<div class="searchdesc">
		<?php echo ((is_array($_tmp=$this->_tpl_vars['result']['data'])) ? $this->_run_mod_handler('strip_tags', true, $_tmp) : smarty_modifier_strip_tags($_tmp)); ?>

	</div>
	
	<br />
</div>