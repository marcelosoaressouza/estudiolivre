function xEditField(id) {
	
    this.fieldEl = $(id);
    
    this.id = id.replace(/^xEdit-field-/,'');
    
    this.fieldEl.addClassName('editable');
}

xEditField.method('setContent', function(content) {
    this.fieldEl.innerHTML = content;
});

xEditField.method('getEditValue', function() {
    return this.fieldEl.findOne('xEdit-input').value;
});

