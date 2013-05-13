<?php

	session_start();	
	include_once('../autoloader.php');

	if(isset($_SESSION['errores'])){
		unset($_SESSION['errores']);
	}

	$obra = array(
		'titulo' => $_POST['titulo'],
		'descripcion' => $_POST['descripcion'],
		'autor' => $_POST['autor'],
		'anio' => $_POST['anio'],
		'categoria' => $_POST['categoria'],
		'museo' => $_POST['museo'],
		'imagen' => $_FILES['imagen'],
		'seudonimo' => $_POST['seudonimo']
	);

	$verificacion = new ComprobarObra($obra);
	$verificacion->verificar();
	var_dump($verificacion->vacios);

		
?>