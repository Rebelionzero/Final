<?php

	
	include_once('../autoloader.php');
	session_start();

	// si esta seteado la session errores la des setea
	if(isset($_SESSION['errores'])){
		unset($_SESSION['errores']);
	}

	// levanta el valor de los radios, si no hay ninguno seleccionado le asigna un valor false
	if(isset($_POST['mail'])){
		$mail = $_POST['mail'];
	}else{
		$mail = false;
	}

	// levanta el valor de seudonimos y si esta checkeado a mail le asigna el valor museo
	if( isset( $_POST['seudonimo'] ) ){
		$seudonimo = $_POST['seudonimo'];
		$mail = "museo";
	}else{
		$seudonimo = false;		
	}

	$campos = array(
		'titulo' => utf8_decode($_POST['titulo']),
		'descripcion' => utf8_decode($_POST['descripcion']),
		'autor' => utf8_decode($_POST['autor']),
		'anio' => utf8_decode($_POST['anio']),
		'categoria' => utf8_decode($_POST['categoria']),
		'museo' => utf8_decode($_POST['museo']),
		'imagen' => $_FILES['imagen'],
		'mail' => $mail
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
		//var_dump("controlador trae ". $insertarObra->resultado);

		if($insertarObra->resultado === false){
			// ocurrio un error de mysql, llamar a clase Error
			echo("error en la insercion de la obra en la base de datos");
		}else{
			// salio todo bien, redireccionar a obras.php
			$exitoMensaje = new MensajeHTML("La obra ha sido agregada correctamente");
			$exitoMensaje->mensajeExito();
			$_SESSION['carga_exitosa'] = $exitoMensaje;
			header('Location: ../vistas/obras.php');
		}	
	}

?>