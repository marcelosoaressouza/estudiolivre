<?php

if (strpos($_SERVER["SCRIPT_NAME"],basename(__FILE__)) !== false) {
  header("location: index.php");
  exit;
}

function truncate($string, $max = 0, $rep = '(...)') {

    if(!$max) {
		return $string;
    }
    
    preg_match_all('/(\&\#\d+;)/', $string, $m);

    $maxOrig = $max;
	$margin = strlen($rep);

    if ($m[1] && is_array($m[1])) {
		$i = 0;
		foreach ($m[1] as $bigChar) {
		    if ($i < $maxOrig) {
				$max += strlen($bigChar) - 1;
		    } else {
		    	$margin += strlen($bigChar) - 1;
		    }
		    if ($i++ == $maxOrig + strlen($rep)) {
		    	break;
		    }
		    
		}
    }

    if(strlen($string) <= $max + $margin){
    	return $string;
    }else{
		return substr($string, 0, $max) . $rep;
    }
      
}
?>
