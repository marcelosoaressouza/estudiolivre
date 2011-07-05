function setAlternatePath(image, image1) {
	var imageName = image.src.replace(new RegExp(/^.*(\/|\\)/), '');
	var path = image.src.replace(imageName, '');
	// we get the new image
	image['image1']=path+image1;
	// and add the one already there
	image['image2']= image.src;
}


function toggleImage(image, alternatePath){
	if(!image.image1) {setAlternatePath(image,alternatePath) }
	
	if(image.src == image.image1){
		image.src=image.image2;
	}else{
		image.src=image.image1;
	}
	this.blur();
	//alert(this.src);
}

function storeState(id){
	var d = document.getElementById('module'+id).style.display;
	setCookie(id,d);
}
