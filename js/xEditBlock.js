var xEditBlocks = new Array();

function xEditBlock(itemType, itemId, blockId) {

    this.itemType = itemType;
    this.itemId = itemId;
    this.id = blockId;

    this.init();
}

xEditBlock.method('init', function() {

    this.contentBuffer = '';

    this.blockEl = $('xEdit-block-' + this.id);
    
    this.error = '';
    this.errorEl = $('xEdit-error-' + this.id);

    this.editEl = $('xEdit-edit-' + this.id);
    this.saveEl = $('xEdit-save-' + this.id);
    this.cancelEl = $('xEdit-cancel-' + this.id);

    this.editEl.onclick = new Function("xEditBlocks['"+this.id+"'].edit();");
    this.saveEl.onclick = new Function("xEditBlocks['"+this.id+"'].callSave();");
    this.cancelEl.onclick = new Function("xEditBlocks['"+this.id+"'].cancel();");    

    this.fields = new Array();
    this.fieldIds = new Array();
    this.fieldMap = new Array();

    var nodes = this.blockEl.findAll('xEdit-field');
    for (var i = 0; i < nodes.length; i++) {
	this.addField(nodes[i].id);
    }

});

xEditBlock.method('addField', function(fieldEl) {
    var field = new xEditField(fieldEl);
    this.fields.push(field);
    this.fieldIds.push(field.id);
    this.fieldMap[field.id] = field;
});

xEditBlock.method('edit', function() {
    this.contentBuffer = this.blockEl.innerHTML;
    this.editEl.toggle();

    xajax_editBlock(this.itemType, this.itemId, this.id, this.fieldIds);

    this.saveEl.toggle();
    this.cancelEl.toggle();
});

xEditBlock.method('view', function() {
    this.editEl.toggle();

    this.saveEl.toggle();
    this.cancelEl.toggle();
});

xEditBlock.method('setFieldContents', function(contentMap) {
    for (var i = 0; i < this.fieldIds.length; i++) {
	var fieldName = this.fieldIds[i];
	if (contentMap[fieldName]) {
	    this.fieldMap[fieldName].setContent(contentMap[fieldName]);
	}
    }
});

xEditBlock.method('callSave', function() {
    var data = new Array();

    for (var i = 0; i < this.fields.length; i++) {
	data[this.fields[i].id] = this.fields[i].getEditValue();
    }

    xajax_saveItem(this.itemType, this.itemId, data, this.id);
    this.contentBuffer = '';
});

xEditBlock.method('cancel', function() {
    this.blockEl.update(this.contentBuffer);
    this.init();
});

xEditBlock.method('unsetError', function() {
    this.error = '';
    this.errorEl.update();
    this.errorEl.hide();
});

xEditBlock.method('setError', function(error) {
    this.error = error;
    this.errorEl.update(error);
    this.errorEl.show();
    
    return this;
});


// Global functions

function toggleEditMode() {
    $('wrapper').findAll('xEdit-edit-').each(function (element) {
	element.toggle();
    });
}

function setBlockContent(blockId, contentMap) {
    xEditBlocks[blockId].setFieldContents(contentMap);
}

function saveCallback(blockId, contentMap) {
    setBlockContent(blockId, contentMap);
    xEditBlocks[blockId].view();
}


