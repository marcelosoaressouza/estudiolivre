<?php /* Smarty version 2.6.18, created on 2011-04-19 20:28:13
         compiled from styles/bolha/categorize.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'replace', 'styles/bolha/categorize.tpl', 3, false),array('modifier', 'escape', 'styles/bolha/categorize.tpl', 17, false),)), $this); ?>
<?php if ($this->_tpl_vars['feature_categories'] == 'y' && ( count ( $this->_tpl_vars['categories'] ) > 0 || $this->_tpl_vars['tiki_p_admin_categories'] == 'y' )): ?>
	<span class="hiddenPointer"  onclick="javascript:flip('categorizator');toggleImage(document.getElementById('catTArrow'),'iArrowGreyDown.png');">
		<img id="catTArrow" class="pointer" src="styles/<?php echo ((is_array($_tmp=$this->_tpl_vars['style'])) ? $this->_run_mod_handler('replace', true, $_tmp, ".css", "") : smarty_modifier_replace($_tmp, ".css", "")); ?>
/img/iArrowGreyRight.png">
		<b>Categorize</b>
	</span>
	  
	 
	<div id="categorizator" style="display:none;">
		<?php if ($this->_tpl_vars['feature_help'] == 'y'): ?>
			<!--div class="simplebox">Tip: hold down CTRL to select multiple categories</div-->
		<?php endif; ?>
		<?php if (count ( $this->_tpl_vars['categories'] ) > 0): ?>
	   		<div style="display:none">
		   		<select name="cat_categories[]" multiple="multiple" size="5" id="categorySelect">
		   			<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['categories']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				    	<?php if ($this->_tpl_vars['categories'][$this->_sections['ix']['index']]['incat'] == 'y'): ?>
				    		<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" selected="selected">
					    		<?php echo $this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categpath']; ?>

					    	</option>
				   		<?php endif; ?>
				   	<?php endfor; endif; ?>
		   		</select>
				<input type="checkbox" name="cat_categorize" id="cat-check" <?php if ($this->_tpl_vars['cat_categorize'] == 'y' || $this->_tpl_vars['categ_checked'] == 'y'): ?>checked="checked"<?php endif; ?>/>
	   	    </div>
	   		<div id="selected" style="float:right">
	   			Remove categories:<BR/>
	   			<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['categories']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			    	<?php if ($this->_tpl_vars['categories'][$this->_sections['ix']['index']]['incat'] == 'y'): ?>
				    	<span class="pointer" id="linkToRemove<?php echo ((is_array($_tmp=$this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" onclick="removeCategory(<?php echo ((is_array($_tmp=$this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
)" style="display:block">
				    		<?php echo $this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categpath']; ?>

				    	</span>
			    	<?php else: ?>
				    	<span class="pointer" id="linkToRemove<?php echo ((is_array($_tmp=$this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" onclick="removeCategory(<?php echo ((is_array($_tmp=$this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
)" style="display:none">
				    		<?php echo $this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categpath']; ?>

				    	</span>
			    	<?php endif; ?>
			   	<?php endfor; endif; ?>
	   		</div>
	   		<div id="notSelected" style="float:left">
	   			Add categories:<BR/>
	   			<?php unset($this->_sections['ix']);
$this->_sections['ix']['name'] = 'ix';
$this->_sections['ix']['loop'] = is_array($_loop=$this->_tpl_vars['categories']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			    	<?php if ($this->_tpl_vars['categories'][$this->_sections['ix']['index']]['incat'] == 'n'): ?>
				    	<span class="pointer" id="linkToAdd<?php echo ((is_array($_tmp=$this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" onclick="addCategory('<?php echo $this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categpath']; ?>
',<?php echo ((is_array($_tmp=$this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
)" style="display:block">
				    		<?php echo $this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categpath']; ?>

				    	</span>
			    	<?php else: ?>
				    	<span class="pointer" id="linkToAdd<?php echo ((is_array($_tmp=$this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" onclick="addCategory('<?php echo $this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categpath']; ?>
',<?php echo ((is_array($_tmp=$this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categId'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
)" style="display:none">
				    		<?php echo $this->_tpl_vars['categories'][$this->_sections['ix']['index']]['categpath']; ?>

				    	</span>
			    	<?php endif; ?>
			   	<?php endfor; endif; ?>
	   		</div>
	   				
			<?php if ($this->_tpl_vars['feature_help'] == 'y'): ?>
			    <!--div class="simplebox">Tip: uncheck the above checkbox to uncategorize this page/object</div-->
			<?php endif; ?>
		<?php else: ?>
		   	No categories defined <br />
		<?php endif; ?>
		
	</div>
	<?php if ($this->_tpl_vars['tiki_p_admin_categories'] == 'y'): ?>
			&nbsp;&nbsp;&nbsp;<a href="tiki-admin_categories.php" class="link">Admin categories</a>
	<?php endif; ?>
	<?php echo '
		<script language="javascript" type="text/javascript">
			var options=document.getElementById(\'categorySelect\').options;
			var checkbox=document.getElementById(\'cat-check\');
			addCategory = function(nome,id){
				//new Option(text, value, defaultSelected, selected)
				options[options.length]=new Option(nome, id, true, true);
				document.getElementById(\'linkToAdd\'+id).style.display=\'none\';
				document.getElementById(\'linkToRemove\'+id).style.display=\'block\';
				checkbox.checked=true;
			}
			removeCategory = function(id){
				//new Option(text, value, defaultSelected, selected)
				for (i in options){
					if(options[i]!=null)
						if(options[i].value==id){
							var remove=i;
						}
				}
				options[remove]=null;
				document.getElementById(\'linkToAdd\'+id).style.display=\'block\';
				document.getElementById(\'linkToRemove\'+id).style.display=\'none\';
				if(options.length==0){
					checkbox.checked=false;
				}	
			}
		</script>
	'; ?>

<?php endif; ?>
