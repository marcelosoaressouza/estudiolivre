<?php
/*
 * Created on 05/12/2006
 *
 * by: nano
 * 
 * subclass of FileReference, must implement the superclass methods
 * has specific audio properties
 * 
 */

require_once "FileReference.php";

class AudioFile extends FileReference {
	
	var $duration;
	var $bpm;
	var $sampleRate;
	var $bitRate;
	var $type = "Audio";
	
	function extractFileInfo() {
		if (!class_exists('ffmpeg_movie')) {
			return;
		}

		$audio = new ffmpeg_movie($this->baseDir . $this->fileName, 0);
		if (!is_object($audio)) {
			return;
		}
		  
		$result = array();
		$result['duration'] = (int)$audio->getDuration();
		$result['bitRate'] = (int)$audio->getBitRate();
		
		return $this->update($result);
	}
		
	function generateThumb() {
		return true;
	}
	
	// class method
	function validateExtension($ext) {
		$extensions = array('mp3','ogg','wav','aiff','avi','flac','mp2','mid','mxf', 'mp4');
		if (in_array($ext, $extensions)) {
	    	return true;
	    }
	    return false;
	}
	
	function checkField_duration($value) {
		return $this->checkNumericField($value, tra('Duração deve ser um número em segundos'));
	}
	function checkField_bpm($value) {
		return $this->checkNumericField($value, tra('BPM deve ser um número'));
	}
	function checkField_sampleRate($value) {
		return $this->checkNumericField($value, tra('"Sample rate" deve ser um número'));
	}
	function checkField_bitRate($value) {
		return $this->checkNumericField($value, tra('"Bit rate" deve ser um número'));
	}
	
}

?>
