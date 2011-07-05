function arrayContains(obj) {
	for(var i = 0; i < this.length; i++)
		if(this[i] == obj) return i;
	return -1;
}

function arrayRemove(obj) {
	var i = this.contains(obj);
	if(i >= 0)
		this.splice(i,1);
}

function arrayAdd(obj) {
	if(this.contains(obj) < 0) this.push(obj);
}

Array.prototype.contains = arrayContains;
Array.prototype.remove = arrayRemove;
Array.prototype.add = arrayAdd;
