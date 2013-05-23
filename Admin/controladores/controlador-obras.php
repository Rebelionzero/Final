<?php

	
	include_once('../autoloader.php');
	session_start();

	if(isset($_SESSION['errores'])){
		unset($_SESSION['errores']);
	}

	if( isset( $_POST['seudonimo'] ) ){
		$seudonimo = $_POST['seudonimo'];
	}else{
		$seudonimo = false;
	}

	$mail = $_POST['mail'];	

	$campos = array(
		'titulo' => utf8_decode($_POST['titulo']),
		'descripcion' => utf8_decode($_POST['descripcion']),
		'autor' => utf8_decode($_POST['autor']),
		'anio' => utf8_decode($_POST['anio']),
		'categoria' => utf8_decode($_POST['categoria']),
		'museo' => utf8_decode($_POST['museo']),
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
		if($insertarObra->nuevaObra->resultado !== false){
			// salio todo bien, redireccionar a obras.php
			$exitoMensaje = new MensajeHTML("La obra ha sido agregada correctamente");
			$exitoMensaje->mensajeExito();
			$_SESSION['carga_exitosa'] = $exitoMensaje;
			header('Location: ../vistas/obras.php');
		}else{
			// ocurrio un error de mysql, llamar a clase Error
		}
	}

	
?>