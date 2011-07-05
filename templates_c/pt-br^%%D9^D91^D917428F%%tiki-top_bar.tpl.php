<?php /* Smarty version 2.6.18, created on 2011-05-02 18:35:42
         compiled from styles/obscur/tiki-top_bar.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'tooltip', 'styles/obscur/tiki-top_bar.tpl', 12, false),array('modifier', 'replace', 'styles/obscur/tiki-top_bar.tpl', 17, false),)), $this); ?>
<!-- tiki-top_bar.tpl begin -->

<?php if ($this->_tpl_vars['isIE']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "ie_notsupported.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>

<div id="tiki-top">
<div id="topMenu">
  	
    <?php if ($this->_tpl_vars['showTeste']): ?>
  	 <a href="http://dev.estudiolivre.org/tiki-view_tracker.php?status=o&trackerId=13&offset=0&sort_mode=created_desc">
  	  <?php $this->_tag_stack[] = array('tooltip', array('text' => "Clique aqui e <b>relate os bugs</b> encontrados! Ajude-nos a <b>melhorar</b> o EstúdioLivre!!!")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><img src="styles/estudiolivre/faixaTeste.<?php if ($this->_tpl_vars['isIE']): ?>gif<?php else: ?>png<?php endif; ?>" style="position:absolute; top:-25px; left:0px; z-index:5"/><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  	 </a>
    <?php endif; ?>
      <a href="/">
        <?php $this->_tag_stack[] = array('tooltip', array('name' => "navegue-home",'text' => "Ir para a Página Inicial")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
          <img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/logoTop.png">
        <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </a>
      <div id="topMenuLinks">
    <?php $this->_tag_stack[] = array('tooltip', array('name' => "saiba-estudiolivre",'text' => "Saiba <b>o que é</b> o EstúdioLivre")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="tiki-index.php?page=sobre&bl">sobre</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    | 
  	<?php $this->_tag_stack[] = array('tooltip', array('name' => "forum-discussoes",'text' => "Fóruns de <b>discussões</b> - tire suas dúvidas aqui")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="tiki-forums.php">fóruns</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    | 
    <?php $this->_tag_stack[] = array('tooltip', array('name' => "lista-comunidade",'text' => "Veja a lista de <b>pessoas</b> que fazem parte da comunidade")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="tiki-list_users.php">usuários</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    | 
    <?php $this->_tag_stack[] = array('tooltip', array('text' => "Veja os <b>blogs</b> dos usuári@s do EstúdioLivre")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="tiki-list_blogs.php">blogs</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    | 
    <?php $this->_tag_stack[] = array('tooltip', array('name' => "perguntas-frequentes",'text' => "<b>Perguntas</b> mais freqüêntes")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="tiki-index.php?page=faq&bl">faq</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    | 
    <?php $this->_tag_stack[] = array('tooltip', array('name' => "entre-contato",'text' => "Entre em contato - descubra os <b>canais de comunicação</b> com a comunidade")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="tiki-index.php?page=contato&bl">contato</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </div>
  </div>
</div>

<!-- tiki-top_bar.tpl end -->