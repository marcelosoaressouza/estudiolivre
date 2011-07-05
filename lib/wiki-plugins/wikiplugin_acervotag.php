<?php

function wikiplugin_acervotag_help() {
    $help = tra("Este wikiplugin ficou obsoleto e foi substituído pelo ACERVO") . "<br/>";
    return $help;
}

function wikiplugin_acervotag($data, $params) {
    $help = 'O plugin ACERVOTAG foi renomeado para ACERVO. Use:<br><br>';
    
    $help.= "~np~{ACERVO(";
    foreach ($params as $key => $value) {
	$help .= "$key => $value, ";
    }
    $help = preg_replace('/, $/', '', $help);
    $help .= ")}{ACERVO}~/np~" . "<br/>";

    return '<div style="border: 1px solid red">'.$help.'</div>';
}

?>

