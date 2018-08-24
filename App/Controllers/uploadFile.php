<?php

if (!empty($_POST['cod'])) {
	# code...
	$cod = $_POST['cod'];

    require_once '/var/www/html/soportel_plus/App/Controllers/PrincipalController.php';
    require_once '/var/www/html/soportel_plus/Config/vars.php';

    //inicializo el controlador Principal

    $PrincipalController = new PrincipalController();  
	$cod = $_POST['cod'];

	$carpeta = "Archives/";
	$name 	 = $cod.basename($_FILES['file']['name']);
	$destino = $carpeta.$name;
	$origen  = $_FILES["file"]["tmp_name"];

                    # movemos el archivo
    if(move_uploaded_file($origen, $destino)){
		if($PrincipalController->UpdateArchivoTarea($cod,$name)){
			echo true;
		}else{
			echo false;
		}
	} else{
		echo false;
	}

}

?>