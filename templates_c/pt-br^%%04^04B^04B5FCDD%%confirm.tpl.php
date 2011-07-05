<?php /* Smarty version 2.6.18, created on 2011-06-03 16:41:38
         compiled from styles/bolha/confirm.tpl */ ?>

<br/>
<br/>
<div class="cbox">
	<div class="cbox-data">
		<form action="<?php echo $this->_tpl_vars['confirmaction']; ?>
" method="post">
			<?php if ($this->_tpl_vars['ticket']): ?>
				<input value="<?php echo $this->_tpl_vars['ticket']; ?>
" name="ticket" type="hidden" />
			<?php endif; ?>
			<input type="submit" name="daconfirm" value="<?php echo $this->_tpl_vars['confirmation_text']; ?>
" />
			
			<br/>
			<br/>
			<br/>
			<span class="button2">
				<a href="javascript:history.back()" class="linkbut">
					Retornar
				</a>
			</span>
			<br/>
			<br/>
			<span class="button2">
				<a href="<?php echo $this->_tpl_vars['tikiIndex']; ?>
" class="linkbut">
					Retornar à página inicial
				</a>
			</span>
		</form>
	</div>
</div>