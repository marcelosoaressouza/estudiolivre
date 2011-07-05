<?php
/*
 * Created on 05/12/2006
 *
 * by: nano
 * 
 * subclass of FileReference, must implement the superclass methods
 * has specific image properties
 * 
 */

require_once "FileReference.php";

class ImageFile extends FileReference {
	
	var $width;
	var $height;
	var $dpi;
	var $type = "Imagem";

	function extractFileInfo() {
		if (!function_exists('getimagesize')) {
			return;
		}
		
		$result = array();
		list($result['width'], $result['height']) = getimagesize($this->baseDir . $this->fileName);
		
		return $this->update($result);
	}
	
	function generateThumb() {
		
		global $tikilib;
		
		if (!function_exists('imagepng')) {
			return;
		}
		$fp = fopen($this->baseDir . $this->fileName, 'rb');
		if (!$fp) return;
		
		$data = '';
		while (!feof($fp)) {
		  $data .= fread($fp, 8192 * 16);
		}
		fclose($fp);
		
		//bloco que acha a proporcao pro thumbnail		
		$thumbSide = $tikilib->get_preference('el_thumb_side', 100);
		list($width, $height) = getimagesize($this->baseDir . $this->fileName);
		if ($width > $thumbSide || $height > $thumbSide) {
			$sourceX = 0;
			$sourceY = 0;
			$destX = 0;
			$destY = 0;
			$sourceW = $width;
			$sourceH = $height;
			
			// crop normal
			if ($width > $height) {
				$sourceX = ($width - $height) / 2;
				$sourceW = $height;
				
			} elseif ($height > $width) {
				$sourceY = ($height - $width) / 2;
				$sourceH = $width;
			
			}
			
			$destW = $thumbSide;
			$destH = $thumbSide;

			// se o lado da imagem eh menor q o thumb
			if ($height < $thumbSide) {
				$destY = ($thumbSide - $height) / 2;
				$destH = $height;
			}
			if ($width < $thumbSide) {
				$destX = ($thumbSide - $width) / 2;
				$destW = $width;
			}
			
			$src = imagecreatefromstring($data);
			$img = imagecreatetruecolor($thumbSide, $thumbSide);
			imagecopyresized($img, $src, $destX, $destY, $sourceX, $sourceY, $destW, $destH, $sourceW, $sourceH);

			ob_start();
			imagepng($img);
			$data = ob_get_contents();
			ob_end_clean();
		}
		
		$thumbName = 'thumb_' . preg_replace("/^.*\//", "", $this->fileName);
		$thumbName = preg_replace('/\.(.+?)$/', '.png', $thumbName);
		
		$fp = fopen($this->baseDir . $thumbName, "w");
		if (!$fp) return;
		fwrite($fp, $data);
		fclose($fp);
		
		return $this->update(array('thumbnail' => $thumbName));
		
	}
	
	// class method
	function validateExtension($ext) {
		$extensions = array('png','jpg','jpeg','gif','tiff','svg','bmp','psd','xcf','eps','swf','xar');
		if (in_array($ext, $extensions)) {
	    	return true;
	    }
	    return false;
	}
	
	function checkField_width($value) {
		return $this->checkNumericField($value, tra('Largura deve ser um número'));
	}
	function checkField_height($value) {
		return $this->checkNumericField($value, tra('Altura deve ser um número'));
	}
	function checkField_dpi($value) {
		return $this->checkNumericField($value, tra('DPI deve ser um número'));
	}
	
}

?>
