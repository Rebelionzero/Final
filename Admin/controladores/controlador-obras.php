<?php

	session_start();	
	include_once('../autoloader.php');

	if(isset($_SESSION['errores'])){
		unset($_SESSION['errores']);
	}

	if( isset( $_POST['seudonimo'] ) ){
		$seudonimo = $_POST['seudonimo'];
	}else{
		$seudonimo = false;
	}

	$campos = array(
		'titulo' => $_POST['titulo'],
		'descripcion' => $_POST['descripcion'],
		'autor' => $_POST['autor'],
		'anio' => $_POST['anio'],
		'categoria' => $_POST['categoria'],
		'museo' => $_POST['museo'],
		'imagen' => $_FILES['imagen']
	);

	$obra = $campos;
	$obra['seudonimo'] = $seudonimo;

	$verificacion = new ComprobarObra($campos);
	$verificacion->verificar();
	
	if( count($verificacion->errores) > 0 ){		
		$_SESSION['ErroresObras'] = $verificacion->errores;
		$_SESSION['campos'] = $obra;
		header('Location: ../vistas/obras.php');
	}else{
		$insertarObra = new Obra($obra);
		$insertarObra->insertarObra();
	}

	
?>