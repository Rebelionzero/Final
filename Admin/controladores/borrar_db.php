<?php
	include_once("../autoloader.php");
	
	$tabla = $_POST['tabla'];
	$id = $_POST['id'];
	if($tabla == 'productos'){
		$nombre = '';
	}else{
		$nombre = $_POST['nombre'];
	}
	
	$eliminar = new BorrarBD($tabla,$id,$nombre);
	$eliminar->borrar_bd();

	$enviar = json_encode($eliminar->respuesta);
	echo $enviar;
?>