// by Douglas Crockford from http://www.crockford.com/javascript/inheritance.html
// creating the "method" method, to add methods to classes
Function.prototype.method = function (name, func) {
    this.prototype[name] = func;
    return this;
};

// creating the extends method, to extend classes
// by Kevin Lindsey from http://www.kevlindev.com/tutorials/javascript/inheritance/
Function.method('extend', function (superClass) {
	function inheritance() {}
	inheritance.prototype = superClass.prototype;
	
	this.prototype = new inheritance();
	this.prototype.constructor = this;
	this.baseConstructor = superClass;
	this.superClass = superClass.prototype;
    
    return this;
});
