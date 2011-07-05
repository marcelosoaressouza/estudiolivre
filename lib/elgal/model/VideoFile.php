<?php
/*
 * Created on 05/12/2006
 *
 * by: nano
 * 
 * subclass of FileReference, must implement the superclass methods
 * has specific video properties
 * 
 */

require_once "FileReference.php";

class VideoFile extends FileReference {
	
	var $duration;
	var $width;
	var $height;
	var $hasAudio;
	var $hasColor;
	var $type = "Video";

	function extractFileInfo() {
		if (!class_exists('ffmpeg_movie')) {
			return;
		}
		$movie = new ffmpeg_movie($this->fullPath(), 0);
		if (!is_object($movie)) {
			return;
		}
		  
		$result = array();
		$result['width'] = $movie->getFrameWidth();
		$result['height'] = $movie->getFrameHeight();
		$result['duration'] = $movie->getDuration();
		$result['hasAudio'] = $movie->hasAudio();
		
		return $this->update($result);
	}
		
	function generateThumb() {
		
		global $tikilib;
		
		if (!class_exists('ffmpeg_movie')) {
			return;
		}
		$movie = new ffmpeg_movie($this->fullPath(), 0);
		if (!is_object($movie)) {
			return;
		}
		
		$width = $movie->getFrameWidth();
		if (!$width) $width = 100;
		$height = $movie->getFrameHeight();
		if (!$height) $height = 100;
		$frameTotal = $movie->getFrameCount();
		if (!$frameTotal) return;
		
		$thumbSide = $tikilib->get_preference('el_thumb_side', 100);
		$thumbVideoSize = $tikilib->get_preference('el_thumb_video_size', 10);
		
		$rate = (int)($frameTotal/$thumbVideoSize);
		$percent = ($width>$height) ? $thumbSide/$width : $thumbSide/$height;
		$width = (int)($percent*$width);
		$height = (int)($percent*$height);
		if($width%2 != 0) $width++;
		if($height%2 != 0) $height++;
		
		$thumbName = 'thumb_' . preg_replace("/^.*\//", "", $this->fileName);
		$thumbName = preg_replace('/\.(.+?)$/', '.gif', $thumbName);
		$gif = new ffmpeg_animated_gif($this->baseDir . $thumbName, $width, $height, 1, 0);
		
		for ($i=1; $i <= $frameTotal; $i+=$rate) {
			$gif->addFrame($movie->getFrame($i));
		}
		
		return $this->update(array('thumbnail' => $thumbName));
		
	}
	
	// class method
	function validateExtension($ext) {
		$extensions = array('mpg','mpeg','avi','ogg','theora','mp4','yuv','mp2','mkv','mxf','mov','swf','flv','3gp','3gpp');
	  	if (in_array($ext, $extensions)) {
	    	return true;
	    }
	    return false;
	}
	
	function checkField_duration($value) {
		return $this->checkNumericField($value, tra('Duração deve ser um número'));
	}
	function checkField_width($value) {
		return $this->checkNumericField($value, tra('Largura deve ser um número'));
	}
	function checkField_height($value) {
		return $this->checkNumericField($value, tra('Altura deve ser um número'));
	}
	
	function isViewable() {
		return preg_match("/.*\.ogg$/i", $this->fileName);
	}
	
}

?>
