Element.addMethods({
    
    findAll: function(element, pattern) {
	var list = new Array();
	var nodes = $(element).descendants();
	for (var i = 0; i < nodes.length; i++) {
	    if (nodes[i].id && nodes[i].id.match(new RegExp('^'+pattern))) {
		list.push(nodes[i]);
	    }
	}
	return list;
    },
    
    findOne: function(element, pattern) {
	var nodes = $(element).descendants();
	for (var i = 0; i < nodes.length; i++) {
	    if (nodes[i].id && nodes[i].id.match(new RegExp('^'+pattern))) {
		return nodes[i];
	    }
	}
    }

});
