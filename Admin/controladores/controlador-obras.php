<?php

	include_once('../autoloader.php');
	session_start();

	// si esta seteado la session errores la dessetea
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
	
	if(isset($_POST['nrobra'])){
		$idObra = $_POST['nrobra'];
	}else{
		$idObra = '';
	}

	$campos = array(
		'titulo' => utf8_decode($_POST['titulo']),
		'descripcion' => utf8_decode($_POST['descripcion']),
		'autor' => utf8_decode($_POST['autor']),
		'anio' => utf8_decode($_POST['anio']),
		'categoria' => utf8_decode($_POST['categoria']),
		'museo' => utf8_decode($_POST['museo']),
		'tipoForm' => $_POST['tipo'],
		'id' => $idObra,
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
		$obra = new Obra($obra);
		if($campos['tipoForm'] == 1){
			// si es 1, quiere decir que la obra es para editarse, por lo cual se crea un objeto de edicion			
			$obra->editarObra();

		}elseif($campos['tipoForm'] == 0){
			// si es 0, quiere decir que la obra es nueva, por lo cual se crea un objeto de creacion			
			$obra->insertarObra();
		}
		
		$mensajeParaElUsuario = new MensajeHTML($obra->mensajeResultado);
		$tipoDeMensaje = ( $obra->resultado === false ? $mensajeParaElUsuario->mensajeDeError() : $mensajeParaElUsuario->mensajeExito() );

		$_SESSION['resultado_carga'] = $mensajeParaElUsuario;
		header('Location: ../vistas/obras.php');
		
	}

?>