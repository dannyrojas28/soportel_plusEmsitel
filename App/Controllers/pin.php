<?php	
	function GetPing($ip=NULL) {
		
	 if(empty($ip)) {$ip = $_SERVER['REMOTE_ADDR'];}
	 if(getenv("OS")=="Windows_NT") {
	  $exec = exec("ping -c1 ".$ip);
	  return end(explode(" ", $exec ));
	 }
	 else {
	  $exec = exec("ping -c1 ".$ip);
	  $array = explode("/", end(explode("=", $exec )) );
	  return ceil($array[0]) . 'ms';
	 }
	}

	
	$ip = '11.1.1.140';
	if (GetPing($ip) == 'perdidos),') {
	    echo 'Tiempo agotado';
	} else if (GetPing($ip) == '0ms') {
	    echo 'servidor apagado';
	} else {
	    echo 'servidor con conectividad';
	}



?>
