<?php
	
	include_once('../autoloader.php');
	
	$tabla = $_POST['tabla'];
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	
	$editar = new Editar(array($tabla,$id,$nombre));
	$editar->editarCM();
	
	$enviar = json_encode($editar->respuesta);
	echo $enviar;
	
	
?>