<?php
$connection = ssh2_connect('200.75.46.69', 2222);

if (ssh2_auth_password($connection, 'root', 'voip5724422ems01')) {
 // echo "Authentication Successful!\n";
  	$stream = ssh2_exec($connection, "asterisk -rx 'sip show peers' | grep claro | grep OK");
  	//$stream = ssh2_exec($connection, "asterisk -rx 'sip show peers' | grep movilvz ");
  	//$stream = ssh2_exec($connection, "asterisk -rx 'sip show peers like movilvz' ");

	$errorStream = ssh2_fetch_stream($stream, SSH2_STREAM_STDERR);

	// Enable blocking for both streams
	stream_set_blocking($errorStream, true);
	stream_set_blocking($stream, true);

// Whichever of the two below commands is listed first will receive its appropriate output.  The second command receives nothing
	$sr = stream_get_contents($stream);
	$lo = "<pre>".$sr."</pre>";
	echo $lo;
	$array = explode("OK", $lo);
	echo count($array) -1 ;
	/*echo count($sr);
	echo count("<pre>".$sr."</pre>");*/
	//print_r($sr);

} else {
  die('Authentication Failed...');
}

?>