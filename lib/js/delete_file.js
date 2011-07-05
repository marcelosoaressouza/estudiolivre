var delId = null;

function deleteFile(id, dontAsk, pass) {
	if (!pass) {
		delId = id;
		if (!dontAsk) {
			showLightbox('askDelete');
		} else {
			document.location='el-gallery_delete.php?arquivoId='+id;
		}
	} else {
		document.location='el-gallery_delete.php?arquivoId='+delId+'&dontAskAgain='+dontAsk;
	}
}