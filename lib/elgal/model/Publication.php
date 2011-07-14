<?php
/*
 * Created on 04/12/2006
 *
 * by: nano
 *
 * abstract superclass for the publications in the gallery
 * implements the intersection of methods and properties of
 * the publications in estudiolivre
 *
 */

require_once "lib/persistentObj/PersistentObject.php";

class Publication extends PersistentObject {

  var $user;
  var $publishDate;
  var $author;
  var $title;
  var $description;
  var $thumbnail;
  var $mainFile;
  var $copyrightOwner;
  var $producer;
  var $contact;
  var $site;
  var $rating;
  var $allFile;

  /*************************************************************/
  /* this is configuration for the persistent object framework */
  var $belongsTo = array("License");
  var $licenseId;
  var $collectionId;

  var $hasMany = array("FileReference" => "Publication", "Vote" => "Publication", "Comment" => "Publication");
  var $filereferences = array();
  var $votes = array();
  var $comments = array();

  var $actualClass = true;
  var $extraStructure = array("TikiTags");
  var $tagType = "gallery";
  /*************************************************************/

  function getClassName($lcName) {
    $classes = array("AudioPublication" => "AudioPublication",
                     "VideoPublication" => "VideoPublication",
                     "ImagePublication" => "ImagePublication",
                     "TextPublication"  => "TextPublication",
                     "OtherPublication" => "OtherPublication");
    return $classes[$lcName];
  }

  function checkRequiredField($value, $msg) {
    if(preg_match('/^\s*$/',$value)) {
      return $msg;
    }
  }

  function checkField_title($value) {
    return $this->checkRequiredField($value, tra('O título é obrigatório'));
  }
  function checkField_author($value) {
    return $this->checkRequiredField($value, tra('O autor é obrigatório'));
  }
  function checkField_description($value) {
    return $this->checkRequiredField($value, tra('A descrição é obrigatória'));
  }

  function checkPublish() {
    $error = array();

    if($msg = $this->checkField_author($this->author)) $error["author"] = $msg;

    if($msg = $this->checkField_title($this->title)) $error["title"] = $msg;

    if($msg = $this->checkField_description($this->description)) $error["description"] = $msg;

    if(!$this->licenseId) {
      $error['license'] = tra('Você deve escolher uma licença');
    }

/* [Debugando]
    if(!count($this->filereferences)) {
      $error['arquivo'] = tra('Você não terminou de enviar o arquivo');
    }
*/

    return $error;
  }

  function publish() {
    return $this->update(array('publishDate' => time()));
  }

  function getUserVote($userR = false) {
    global $user;

    if(!$userR) $userR = $user;

    if(!$userR) return 0;

    foreach($this->votes as $vote) {
      if($vote->user == $userR)
        return $vote;
    }
    return false;
  }

  function getArraySize($var) {
    return count($this->$var);
  }

  function vote($userR, $rating) {
    $num = 0;
    $total = 0;
    $hasVote = false;
    foreach($this->votes as $vote) {
      if($vote->user == $userR) {
        if($vote->rating == $rating) {
          return true;
        }

        else {
          $vote->update(array('rating' => $rating));
        }

        $hasVote = true;
      }

      $total += $vote->rating;
      $num++;
    }

    if(!$hasVote) {
      $vote = new Vote(array('publicationId' => $this->id, 'rating' => $rating, 'user' => $userR));
      array_push($this->votes, $vote);
      $total += $vote->rating;
      $num++;
    }

    $this->update(array('rating' => $total/$num));
  }

  function uploadThumb($fileName, $forFile = -1) {

    global $tikilib;

    if(!function_exists('imagepng')) {
      return;
    }

    $fp = fopen($fileName, 'rb');

    if(!$fp) return;

    $data = '';

    while(!feof($fp)) {
      $data .= fread($fp, 8192 * 16);
    }

    fclose($fp);

    //bloco que acha a proporcao pro thumbnail
    $thumbSide = $tikilib->get_preference('el_thumb_side', 100);
    list($width, $height) = getimagesize($fileName);

    if($width > $thumbSide || $height > $thumbSide) {
      $sourceX = 0;
      $sourceY = 0;
      $destX = 0;
      $destY = 0;
      $sourceW = $width;
      $sourceH = $height;

      // crop normal
      if($width > $height) {
        $sourceX = ($width - $height) / 2;
        $sourceW = $height;

      }

      elseif($height > $width) {
        $sourceY = ($height - $width) / 2;
        $sourceH = $width;

      }

      $destW = $thumbSide;
      $destH = $thumbSide;

      // se o lado da imagem eh menor q o thumb
      if($height < $thumbSide) {
        $destY = ($thumbSide - $height) / 2;
        $destH = $height;
      }

      if($width < $thumbSide) {
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

    if($forFile < 0)
      $thumbName = "thumb_$this->id.png";

    else
      $thumbName = "thumb_$forFile.png";

    $fp = fopen($this->fileDir() . $thumbName, "w");

    if(!$fp) return;

    fwrite($fp, $data);
    fclose($fp);

    unlink($fileName);

    if($forFile < 0)
      $this->update(array('thumbnail' => $thumbName));

    else
      $this->filereferences[$forFile]->update(array('thumbnail' => $thumbName));

    return $this->fileDir() . $thumbName;
  }

  function delete() {
    parent::delete();

    if($this->thumbnail)
    {
      if (file_exists($this->fileDir() . $this->thumbnail))
      {
        unlink($this->fileDir() . $this->thumbnail);
      }
    }

    if($this->allFile)
      unlink($this->allFile);

    rmdir($this->fileDir());
  }

  function fileDir() {
    return "repo/$this->id/";
  }

  function allFileSize() {
    if($this->allFile)
      return filesize($this->allFile);

    else return 0;
  }

}

?>
