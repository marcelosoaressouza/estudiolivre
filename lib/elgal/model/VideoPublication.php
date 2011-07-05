<?php
/*
 * Created on 04/12/2006
 *
 * by: nano
 * 
 * specific publication of the type video
 * this does not mean that it only has video files
 * but that in essence it's an video manifestation
 * 
 */

require_once "Publication.php";

class VideoPublication extends Publication {
	
	var $type = "Video";
	var $language;
	var $subtitled;
	var $subtitleLanguage;
	var $details;
	
}

?>
