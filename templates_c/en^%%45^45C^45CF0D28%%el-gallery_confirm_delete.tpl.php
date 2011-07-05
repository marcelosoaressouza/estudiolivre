<?php /* Smarty version 2.6.18, created on 2011-04-04 17:12:11
         compiled from el-gallery_confirm_delete.tpl */ ?>
<div id="askDelete" class="none" style="width:300px">
	Are you sure you want to erase this file from the Gallery?<br/><br/>
	<input type="checkbox" id="askDeleteCheckbox">Never show this message again<br/><br/>
	<a class="pointer" onClick="deleteFile(0, (document.getElementById('askDeleteCheckbox').checked ? 1 : 0), 1);">YES</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a class="pointer" onClick="hideLightbox('askDelete')">NO</a>
</div>