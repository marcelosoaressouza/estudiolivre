<?php
/*
 * Created on 01/12/2006
 *
 * by: nano
 *
 * this class stores information for a file in the disk
 *
 */

require_once "lib/persistentObj/PersistentObject.php";

class FileReference extends PersistentObject {

  var $publicationId;
  var $fileName;
  var $credits;
  var $thumbnail;
  var $mimeType;
  var $size;
  var $downloads;
  var $streams;
  var $baseDir = "repo/";

  /************************************************************/
  /* this is configuration for the relations with publication */
  var $belongsTo = array("Publication");
  var $actualClass = true;
  /************************************************************/

  function FileReference($fileRef, $referenced = false) {

    global $user;

    if(is_int($fileRef)) {
      parent::PersistentObject($fileRef, $referenced);
      $this->baseDir .= "$this->publicationId/";
      return $this;
    }

    $fields = array('mimeType' => $fileRef['type'],
                    'size' => $fileRef['size'],
                    'publicationId' => $fileRef['publicationId'],
                    'fileName' => $fileRef['name']);
    parent::PersistentObject($fields, $referenced);

    $this->baseDir .= "$this->publicationId/";

    if(!file_exists($this->baseDir)) mkdir($this->baseDir, 0755);

    if($fileRef['tmp_name'] != $fileRef['name']) {
      if(!move_uploaded_file($fileRef['tmp_name'], $this->fullPath())) {
        // should never happen, unless the file directory (baseDir) doesn't exist
        $this->delete();
        trigger_error("Impossible to move file to $path.", E_USER_ERROR);
      }
    }

    $this->extractFileInfo();
    $this->generateThumb();

  }

  function getClassName($lcName) {
    $classes = array("AudioFile" => "AudioFile",
                     "VideoFile" => "VideoFile",
                     "ImageFile" => "ImageFile",
                     "TextFile" => "TextFile",
                     "PlainFile" => "PlainFile",
                     "ZipFile" => "ZipFile");
    return $classes[$lcName];
  }

  function hitDownload() {
    return $this->update(array('downloads' => $this->downloads+1));
  }

  function hitStream() {
    return $this->update(array('streams' => $this->streams+1));
  }

  function delete($del = true) {
    parent::delete();

    if($del) {
      unlink($this->fullPath());

      if($this->thumbnail)
        unlink($this->baseDir . $this->thumbnail);
    }
  }

  function parseFileName() {
    preg_match("/(.+)\..+$/", $this->fileName, $match);
    $match = str_replace(array(".", "_"), " ", $match);

    return $match[1];
  }

  function fullPath() {
    return $this->baseDir . $this->fileName;
  }

  function extractFileInfo() {
    trigger_error("Subclass should have implemented", E_USER_ERROR);
  }

  function generateThumb() {
    trigger_error("Subclass should have implemented", E_USER_ERROR);
  }

  // use this one only to check for forbidden extensions
  function isForbiddenExtension($filename) {
    $extensions = array('php','htm', 'wmv','wma','doc','xls','ppt');

    if(!preg_match('/\.([^.]{2,4}$)/', $filename, $m)) {
      return tra("Erro: extensão de arquivo não suportada pelo acervo.");
    }

    foreach($extensions as $ext) {
      if(preg_match('/' . $ext . '/', strtolower($m[1]))) {
        return tra("Erro: extensão $m[1] não suportada pelo acervo.");
      }
    }
  }

  function checkNumericField($value, $msg) {
    if(!preg_match('/^\d*(\.\d+)?$/', $value)) {
      return $msg;
    }
  }

  // static method
  function getSubClass($fileName, $diskFile) {
    //php4 can't list subclasses of class, so we need to add each one here
    require_once("AudioFile.php");
    require_once("ImageFile.php");
    require_once("VideoFile.php");
    require_once("ZipFile.php");

    if(preg_match('/\.([^.]{2,4}$)/', $fileName, $m)) $ext = strtolower($m[1]);

    else return "PlainFile";

    if(ImageFile::validateExtension($ext))
      return "ImageFile";

    if(ZipFile::validateExtension($ext))
      return "ZipFile";

    $audioValid = AudioFile::validateExtension($ext);
    $videoValid = VideoFile::validateExtension($ext);

    if($audioValid && $videoValid) {
      exec(escapeshellcmd("file " . $diskFile), $out, $ret_error);

      if(preg_match("/video/", $out[0]) || preg_match("/movie/", $out[0])) {
        return "VideoFile";
      }

      else {
        return "AudioFile";
      }
    }

    if($audioValid) return "AudioFile";

    if($videoValid) return "VideoFile";

    return "PlainFile";

  }

  function isViewable() {
    return ($this->type == "Imagem" && !preg_match('/.*\.svg$/i', $this->fileName));
  }

}

?>
