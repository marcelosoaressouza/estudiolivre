<?php
/*
 * Created on 05/12/2006
 *
 * by: nano
 * 
 * subclass of FileReference, must implement the superclass methods
 * has specific zip properties and methods like unpack
 * 
 */

require_once "FileReference.php";

class ZipFile extends FileReference {
	
	var $commandLine;
	var $type = "Zip";

	function ZipFile($fileRef, $referenced = false) {
				
		if (is_int($fileRef)) {
			return parent::FileReference($fileRef, $referenced);
		}
		
		parent::FileReference($fileRef, $referenced);
				
		preg_match('/\.([^.]{2,4}$)/', $fileRef['name'], $m);
		$ext = strtolower($m[1]);
		if ($ext == "zip")
			$commandLine = "unzip";
		elseif ($ext == "tar")
			$commandLine = "tar vxf";
		/* nao funcionou :(
		elseif ($ext == "gz" || $ext == "tgz")
			$commandLine = "gunzip";
		elseif ($ext == "bz2" || $ext == "tbz2")
			$commandLine = "bunzip2";
		 TODO quebrar tgz e tbz2 em dois comandos pra contornar o safe_mode
		elseif ($ext == "tgz")
			$commandLine = "tar vxzf";
		elseif ($ext == "tbz2")
			$commandLine = "tar vxjf";
		elseif ($ext == "gz") {
			if (preg_match('/\.tar\.gz$/', $fileRef['name']))
				$commandLine = "tar vxzf";
		}
		elseif ($ext == "bz2") {
			if (preg_match('/\.tar\.bz2$/', $fileRef['name']))
				$commandLine = "tar vxjf";
		}
		*/
		$this->update(array("commandLine" => $commandLine));
		return $this;
		
	}
	
	function parseUnzipOutput($out) {
		$ret = array();
		foreach ($out as $key => $fileName) {
			if (preg_match('/Archive\:.*$/', $fileName) || preg_match('/\s*creating\:.*$/', $fileName)) {
				unset($out[$key]);
			} else {
				$fileName = preg_replace('/\s*inflating\:\s/', "", $fileName);
				$fileName = preg_replace('/\s*extracting\:\s/', "", $fileName);
				$ret[] = $fileName;
			}
		}
		return $ret;
	}

	function expand() {
		if ($this->commandLine) {
			$pwd = getcwd();
			chdir($this->baseDir);
			exec(escapeshellcmd($this->commandLine . " " . $this->fileName), $out, $ret_error);
			chdir($pwd);
			$files = array();
			if (!$ret_error) {
				if ($this->commandLine == "unzip") $out = $this->parseUnzipOutput($out);
				foreach ($out as $key => $fileName) {
					if (is_file($this->baseDir . $fileName)) {
						if (function_exists('mime_content_type')) $type = mime_content_type($fileName);
						else $type = '';
						$fields = array('type' => $type,
										'size' => filesize($this->baseDir . $fileName),
										'publicationId' => $this->publicationId,
										'name' => $fileName,
										'tmp_name' => $fileName);
						$fileClass = FileReference::getSubClass($fileName, $this->baseDir . $fileName);
						require_once($fileClass . ".php");
						$files[] =& new $fileClass($fields);
					} else {
						unset($out[$key]);
					}
				}
			}
			return $files;
		}
	}

	function extractFileInfo() {
		return;
	}
		
	function generateThumb() {
		return;
	}
	
	// class method
	function validateExtension($ext) {
		$extensions = array('zip','gz','bz2','tgz','tar','tbz2');
		if (in_array($ext, $extensions)) {
	    	return true;
	    }
	    return false;
	}
	
}

?>
