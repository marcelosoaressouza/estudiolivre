<?php
/*
 * Created on 05/12/2006
 *
 * by: nano
 * 
 * subclass of FileReference, must implement the superclass methods
 * has specific text properties
 * 
 */

require_once "FileReference.php";

class PlainFile extends FileReference {
	
	var $typeOfFile;
	var $type = "Texto";

	function extractFileInfo() {
		return;
	}
	
	function generateThumb() {
		return;
	}
	
	// class method
	function validateExtension($ext) {
		return true;
	}
	
}

?>
