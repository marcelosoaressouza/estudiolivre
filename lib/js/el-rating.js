function acervoVota(nota) {
    var img_src = 'styles/estudiolivre/iStarOn.png';
    var blk_src = 'styles/estudiolivre/iStarOff.png';
    
    var src;

    for (var i=1; i<=5; i++) {
		if (i <= nota) {
		    src = img_src;
		} else {
		    src = blk_src;
		}
		document.getElementById('aRatingVote-'+i).src = src;
    }

    xajax_vota(nota);
}
