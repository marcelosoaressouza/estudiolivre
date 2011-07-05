<?php /* Smarty version 2.6.18, created on 2011-05-02 18:36:42
         compiled from styles/obscur/tiki-searchresults.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tr', 'styles/obscur/tiki-searchresults.tpl', 43, false),array('block', 'tooltip', 'styles/obscur/tiki-searchresults.tpl', 44, false),)), $this); ?>
<!-- tiki-searchresults.tpl begin -->
<div id="searchContainer">





<?php if (! ( $this->_tpl_vars['searchStyle'] == 'menu' )): ?>

  <div id="searchOptionsCont">



    <?php if ($this->_tpl_vars['feature_wiki'] == 'y'): ?> 
     <a class="linkbut<?php if ($this->_tpl_vars['where'] == 'wikis'): ?> selected<?php endif; ?>" href="tiki-searchresults.php?highlight=<?php echo $this->_tpl_vars['words']; ?>
&amp;where=wikis">wiki</a>
    <?php endif; ?>


    <?php if ($this->_tpl_vars['feature_forums'] == 'y'): ?>
     <a class="linkbut<?php if ($this->_tpl_vars['where'] == 'forums'): ?> selected<?php endif; ?>" href="tiki-searchresults.php?highlight=<?php echo $this->_tpl_vars['words']; ?>
&amp;where=forums">fóruns</a>
    <?php endif; ?>

  </div>

<?php endif; ?>

<form class="forms" method="get" action="tiki-searchresults.php">
     

    

    <input id="searchFieldResults" name="highlight" size="15" type="text" accesskey="s" value="<?php echo $this->_tpl_vars['words']; ?>
" /><input class="wikiaction" type="image" name="search" src="styles/estudiolivre/bSearch.png">

</form>


<?php if ($this->_tpl_vars['words']): ?>
	<?php if (! ( $this->_tpl_vars['searchNoResults'] )): ?>
		<?php if ($this->_tpl_vars['results']): ?>
			Encontrado "<?php echo $this->_tpl_vars['words']; ?>
" em <?php echo $this->_tpl_vars['cant_results']; ?>
 <?php echo $this->_tpl_vars['where2']; ?>

			<?php if (! $this->_tpl_vars['pageExists']): ?>
			<br />
				<?php if ($this->_tpl_vars['where'] != 'forums' && $this->_tpl_vars['user']): ?><?php $this->_tag_stack[] = array('tr', array()); $_block_repeat=true;smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Não existe uma página chamada <?php echo $this->_tpl_vars['words']; ?>
, mas você pode<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tr($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> 
					<?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique para criar a página e editá-la")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
						<a href="tiki-editpage.php?page=<?php echo $this->_tpl_vars['words']; ?>
">criá-la.</a>
					<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php $this->_tag_stack[] = array('tooltip', array('name' => "searchresult-pagina-orfa",'text' => "Nenhuma outra página do wiki levará a essa página. Assim ela estará, de certo modo, inacessível. Para resolver isso basta colocar um link para esta página em alguma outra página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					  (a página será órfã)
					<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
				<?php endif; ?>
			<?php endif; ?>
			<br /><br />
		<?php endif; ?>
		<div id="searchResults">
			<?php unset($this->_sections['search']);
$this->_sections['search']['name'] = 'search';
$this->_sections['search']['loop'] = is_array($_loop=$this->_tpl_vars['results']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['search']['show'] = true;
$this->_sections['search']['max'] = $this->_sections['search']['loop'];
$this->_sections['search']['step'] = 1;
$this->_sections['search']['start'] = $this->_sections['search']['step'] > 0 ? 0 : $this->_sections['search']['loop']-1;
if ($this->_sections['search']['show']) {
    $this->_sections['search']['total'] = $this->_sections['search']['loop'];
    if ($this->_sections['search']['total'] == 0)
        $this->_sections['search']['show'] = false;
} else
    $this->_sections['search']['total'] = 0;
if ($this->_sections['search']['show']):

            for ($this->_sections['search']['index'] = $this->_sections['search']['start'], $this->_sections['search']['iteration'] = 1;
                 $this->_sections['search']['iteration'] <= $this->_sections['search']['total'];
                 $this->_sections['search']['index'] += $this->_sections['search']['step'], $this->_sections['search']['iteration']++):
$this->_sections['search']['rownum'] = $this->_sections['search']['iteration'];
$this->_sections['search']['index_prev'] = $this->_sections['search']['index'] - $this->_sections['search']['step'];
$this->_sections['search']['index_next'] = $this->_sections['search']['index'] + $this->_sections['search']['step'];
$this->_sections['search']['first']      = ($this->_sections['search']['iteration'] == 1);
$this->_sections['search']['last']       = ($this->_sections['search']['iteration'] == $this->_sections['search']['total']);
?>
				<?php $this->assign('result', $this->_tpl_vars['results'][$this->_sections['search']['index']]); ?>
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "searchresult-item.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php endfor; else: ?>
			<div id="searchNoResults">
				Nenhuma página atendeu aos seus critérios de busca<br />
				<?php if ($this->_tpl_vars['where'] != 'forums' && $this->_tpl_vars['user']): ?>Você pode colaborar criando a página 
					<?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique para criar a página e editá-la")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
						<a href="tiki-editpage.php?page=<?php echo $this->_tpl_vars['words']; ?>
"><?php echo $this->_tpl_vars['words']; ?>
</a>
					<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
					<?php $this->_tag_stack[] = array('tooltip', array('name' => "searchresult-pagina-orfa",'text' => "Nenhuma outra página do wiki levará a essa página. Assim ela estará, de certo modo, inacessível. Para resolver isso basta colocar um link para esta página em alguma outra página")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					  (a página será órfã)
					<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
		<div align="center">
		<div class="mini">
	    <?php if ($this->_tpl_vars['prev_offset'] >= 0): ?>
	      [<a class="linkbut"
	      	  href="tiki-searchresults.php?where=<?php echo $this->_tpl_vars['where']; ?>
&amp;highlight=<?php echo $this->_tpl_vars['words']; ?>
&amp;offset=<?php echo $this->_tpl_vars['prev_offset']; ?>
">
	      	  ant
	      	  </a>]
	       &nbsp;
	    <?php endif; ?>
	<?php if ($this->_tpl_vars['cant_pages'] > 0): ?>
		Página: <?php echo $this->_tpl_vars['actual_page']; ?>
/<?php echo $this->_tpl_vars['cant_pages']; ?>

	<?php endif; ?>
	<?php if ($this->_tpl_vars['next_offset'] >= 0): ?>
		&nbsp;[<a class="linkbut"
				    href="tiki-searchresults.php?where=<?php echo $this->_tpl_vars['where']; ?>
&amp;highlight=<?php echo $this->_tpl_vars['words']; ?>
&amp;offset=<?php echo $this->_tpl_vars['next_offset']; ?>
">
				    próx
				</a>]
	<?php endif; ?>
		</div>
	</div>
<?php endif; ?>

<?php endif; ?>

</div>

<!-- tiki-searchresults.tpl begin -->