<?php

	include_once('../autoloader.php');
	session_start();

	$value = $_POST['obra'];
	$query = "DELETE FROM obras WHERE value = '".$value."'";

	$imagen_query = "SELECT src FROM obras WHERE value ='".$value."'";
	$select_img = new Queries($imagen_query);
	$select_img->select();

	$borrar = new Queries($query);
	$borrar->delete();

	if( file_exists("../Obras_images/".$select_img->resultado[0]['src']) ){
		if( unlink("../Obras_images/".$select_img->resultado[0]['src']) ){
			// borrado de imagen exitoso
			$unlink_img = true;
			$mensaje = "La obra ha sido borrada exitosamente";
		}else{
			// borrado de imagen no exitoso
			$unlink_img = false;
			$mensaje = "La obra ha sido borrada exitosamente de la base de datos, pero la imagen correspondiente a ella, no pudo ser borrada.";
		}		
	}else{
		// llamar a mensaje html tipo info que diga que la imagen no existe, pero fue borrada de la base
		$unlink_img = false;
		$mensaje = "La obra ha sido borrada exitosamente de la base de datos, pero la imagen correspondiente a ella, no existe.";
	}

	$mensaje_exito = new MensajeHTML($mensaje);
	if($unlink_img === true){
		$mensaje_exito->mensajeExito();
	}else{
		$mensaje_exito->mensajeAlert();
	}
	$_SESSION['borrado_exitoso'] = $mensaje_exito;
	header("Location: ../vistas/obras.php");

?>