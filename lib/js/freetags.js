function addTag(tag) {
    var currentTags = document.getElementById('input-tags').value;
    
    if (currentTags.match(/\S/)) {
	    document.getElementById('input-tags').value += ', ';
    }
 
    document.getElementById('input-tags').value += tag.innerHTML;
    tag.style.display = 'none';
	document.getElementById(tag.innerHTML+"-v").style.display = "none";
    xajax_save_field('tags', document.getElementById('input-tags').value);
}
