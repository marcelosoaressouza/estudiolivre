<?php
/*
 * Created on May 11, 2007
 *
 * by: nano
 */

class Find {
	var $keys = array();
	
	function Find($aKeys) {
		foreach ($aKeys as $key) {
			$this->keys[] = $key;
		}
		return $this;
	}
}

?>
