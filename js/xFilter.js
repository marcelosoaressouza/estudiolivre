var xFilters = new Array();

Event.observe(window, 'load', function() {
    $('filters').findAll('xFilter-').each(function(element) {
	if (!element.id.match(/widget$/)) {
	    xFilters.push(new xFilter(element));
	}
    });
});

var xFilter = Class.create();

xFilter.prototype = {
    
    initialize: function(filterElement) {
	this.filter = filterElement;
	this.widget = $(filterElement.id + '-widget');

	Event.observe(filterElement, 'click', this.onClick.bindAsEventListener(this));
    },

    onClick: function(element) {
	this.widget.toggle();
    }
    
};
