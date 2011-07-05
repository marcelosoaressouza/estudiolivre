<?php
/*
 * Created on 04/12/2006
 *
 * by: nano
 * 
 * specific publication of the type audio
 * this does not mean that it only has audio files
 * but that in essence it's an audio manifestation
 * 
 */

require_once "Publication.php";

class AudioPublication extends Publication {
	
	// to be backward compatible with acervo1
	var $type = "Audio";
	var $typeOfAudio;
	var $genre;
	var $lyrics;
	var $details;
	var $album;
	
}

?>
