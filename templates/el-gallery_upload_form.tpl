<iframe name="uploadTarget{$i}" style="display:none"></iframe>
	
<form name="uploadForm{$i}" target="uploadTarget{$i}" action="el-gallery_upload_file.php?formNum={$i}" method="post" enctype="multipart/form-data">
	<input type="hidden" name="UPLOAD_IDENTIFIER" value="">
	<input type="hidden" name="arquivoId" value="{$arquivoId}">
	<span id="js-file{$i}"><input type="file" name="arquivo{$i}" onChange="fileSelected(this.value, {$i});"></span>
</form>

<div class="browseCont">
	<div id="js-statusBar{$i}" class="statusBar statusBarGoing"></div>
	<div id="js-percent{$i}" class="percent"></div>
</div>

<h4 id="js-cancel{$i}" class="pointer"></h4>