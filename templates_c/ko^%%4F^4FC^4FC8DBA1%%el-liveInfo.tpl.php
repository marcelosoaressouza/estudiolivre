<?php /* Smarty version 2.6.18, created on 2011-04-13 06:03:26
         compiled from el-liveInfo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'css', 'el-liveInfo.tpl', 1, false),array('block', 'tooltip', 'el-liveInfo.tpl', 12, false),array('modifier', 'replace', 'el-liveInfo.tpl', 17, false),array('modifier', 'escape', 'el-liveInfo.tpl', 44, false),array('modifier', 'default', 'el-liveInfo.tpl', 57, false),)), $this); ?>
<?php echo smarty_function_css(array('extra' => "list,el-gallery_list_item"), $this);?>

<div id="live">
	<div class="titlebar head">
		Canais ao vivo
	</div>
	<p>
		<a href="tiki-index.php?page=faq+Ao+Vivo">Descubra como usar os canais ao vivo do estudiolivre</a>.
	</p>
	<?php $_from = $this->_tpl_vars['sources']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['source']):
?>
		<div class="listItem">
			<div class="listLeft">
				<?php $this->_tag_stack[] = array('tooltip', array('text' => "<b>Veja</b> esse canal clicando aqui")); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
					<a href="<?php echo $this->_tpl_vars['source']->listenurl; ?>
">
					<?php if ($this->_tpl_vars['source']->server_type == 'audio/mpeg' || ( $this->_tpl_vars['source']->server_type == 'application/ogg' && $this->_tpl_vars['source']->subtype == 'Vorbis' )): ?>
			  			
			  			<?php $this->assign('video', 0); ?>
			  			<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iThumbAudioPlay.png">
			  		<?php else: ?>
			  			<?php $this->assign('video', 1); ?>
			  			
			    		<img src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iThumbVideoPlay.png">
			  		<?php endif; ?>
			  		</a>
				<br/>
				<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>			
		  	</div>
		  	
		  	<h2>
		  		<?php if ($this->_tpl_vars['video']): ?>
		  			<?php $this->_tag_stack[] = array('tooltip', array('text' => 'Clique para ver o video')); $_block_repeat=true;smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
			  			<a class="pointer" onClick="xajax_streamStream('<?php echo $this->_tpl_vars['source']->listenurl; ?>
', '<?php echo $this->_tpl_vars['source']->frame_size; ?>
');">
			  				<?php echo $this->_tpl_vars['source']->server_name; ?>

			  			</a>
			  		<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_tooltip($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			  	<?php else: ?>
			  		<a href="<?php echo $this->_tpl_vars['source']->listenurl; ?>
">
			  			<?php echo $this->_tpl_vars['source']->server_name; ?>

		  			</a>
		  		<?php endif; ?>
		  	</h2>
		  	<h5><a href="<?php echo $this->_tpl_vars['source']->server_url; ?>
"><?php echo $this->_tpl_vars['source']->server_url; ?>
</a></h5>
		  	<div class="listInfo">
		  		<h3>
		  			<?php echo ((is_array($_tmp=$this->_tpl_vars['source']->server_description)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall') : smarty_modifier_escape($_tmp, 'htmlall')); ?>
 <br/>
		  		</h3>
		  		<h4>
				<div class="a<?php echo $this->_tpl_vars['source']->server_name; ?>

			  			</a>sRow">
					<span class="lef">
						Gênero: <em><?php echo $this->_tpl_vars['source']->genre; ?>
</em>
					</span>
					<span class="mid">
						Visitantes: <em><?php echo $this->_tpl_vars['source']->listeners; ?>
</em>
						Recorde de Visitantes: <em><?php echo $this->_tpl_vars['source']->listener_peak; ?>
</em><br>
					</span>	
					<span class="rig">
						BitRate: <em><?php echo ((is_array($_tmp=@$this->_tpl_vars['source']->bitrate)) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['source']->ice-$this->_tpl_vars['itrate']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['source']->ice-$this->_tpl_vars['itrate'])); ?>
</em>
					</span>
				</div>
				<br/>
				<div class="asRow">
						<?php if ($this->_tpl_vars['video']): ?>
							<span class="lef">
								크기: <em><?php echo $this->_tpl_vars['source']->frame_size; ?>
</em>
							</span>
							<span class="mid">
								Frame rate: <em><?php echo $this->_tpl_vars['source']->frame_rate; ?>
</em>
							</span>
						<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endforeach; else: ?>
		Nada ao vivo no EL no momento...
		<br/>
		Mas se você estiver procurando alguma coisa para ver, ouvir ou ler, não deixe de apreciar a diversidade do  <a href="el-gallery_home.php">acervo</a>!!!
	<?php endif; unset($_from); ?>
</div>