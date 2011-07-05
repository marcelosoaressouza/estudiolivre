<?php
// migrado pra 2.0!
global $user;

$ajaxlib->setPermission('get_license', $user);
$ajaxlib->registerFunction('get_license');
function get_license($r1, $r2, $r3) {
    
    require_once("lib/persistentObj/PersistentObjectController.php");
    
    $controller = new PersistentObjectController("License");
    $objResponse = new xajaxResponse();
    
    $answer = $r1 . $r2;
    if ($r3 != '-1') $answer .= $r3;

    $licenca = $controller->noStructureFindAll(array("answer" => $answer));
    $licenca =& $licenca[0];
	    
    $objResponse->addAssign('ajax-licenseImg', 'src', 'styles/estudiolivre/h_' . $licenca['imageName'] . '?rand='.rand());
    $objResponse->addAssign('ajax-licenseDesc', 'innerHTML', $licenca['description']);
    $objResponse->addScript("show('ajax-licenseCont');");

    return $objResponse;			
}

?>
