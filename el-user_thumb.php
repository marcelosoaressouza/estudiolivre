<?php

// esse arquivo salva o upload
require_once("tiki-setup.php");
include_once('lib/userprefs/userprefslib.php');
include_once('lib/imagegals/imagegallib.php');
require_once('lib/elgal/elgallib.php');

function error($errorMsg) {
    echo "<script language=\"javaScript\">alert('".$errorMsg."');</script>";
	exit;
}

if (isset($_FILES['thumb']) && !empty($_FILES['thumb']['name'])) {

	//TODO check_ticket('user-thumb');

	$type = $_FILES['thumb']['type'];
	$size = $_FILES['thumb']['size'];
	$name = $_FILES['thumb']['name'];

	preg_match("/(.+)\/.+/", $type, $arq_tipo);
    
    if ($arq_tipo[1] != "image") {
		error("O arquivo fornecido não é uma imagem.");
    }

	if (!is_uploaded_file($_FILES["thumb"]['tmp_name'])) {
		error(tra('Upload was not successful').': '.ELGalLib::convert_error_to_string($_FILES["thumb"]["error"]));
    } 

	$maxSize = $tikilib->get_preference('el_max_thumb_size', 200);
    if ($size > $maxSize * 1024) {
		error("O tamanho máximo da miniatura é de $maxSize kBytes.");
    }

    $data = $elgallib->create_thumb_imagem($_FILES['thumb']['tmp_name']);

    if (!$data) {
    	error("Não foi possível gerar o avatar");
    }
    
	$userprefslib->set_user_avatar($user, 'u', '', $name, $size, $type, $data);

    echo "<script>parent.document.getElementById('uThumbImg').src = 'tiki-show_user_avatar.php?user=" . $user . "&rand=" . rand() . "';</script>";
	echo "<script>parent.document.getElementById('uOnlineThumb').src = 'tiki-show_user_avatar.php?user=" . $user . "&rand=" . rand() . "';</script>";
	
}

?>
