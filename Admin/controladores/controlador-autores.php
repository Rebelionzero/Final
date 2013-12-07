<?php
	include_once('../autoloader.php');
	session_start();

	// si esta seteado la session errores la dessetea
	if(isset($_SESSION['errores'])){
		unset($_SESSION['errores']);
	}

	if(isset($_POST['nraut'])){
		$idAutor = $_POST['nraut'];
	}else{
		$idAutor = '';
	}

	$campos = array(
		'nombre' => utf8_decode($_POST['autor']),
		'seudonimo' => utf8_decode($_POST['seudonimo']),
		'mail' => utf8_decode($_POST['mailAutor']),
		'tipoForm' => $_POST['tipo'],
		'id' => $idAutor
	);
	
	$verificacion = new ComprobarAutores($campos);
	$verificacion->verificar();

	if( count($verificacion->errores) > 0 ){
		$_SESSION['ErroresAutores'] = $verificacion->errores;
		$_SESSION['campos'] = $categoria;
		header('Location: ../vistas/autores.php');
	}else{
		$autor = new Autor($campos);
		if($campos['tipoForm'] == 1){
			// si es 1, quiere decir que el autor es para editarse, por lo cual se crea un objeto de edicion			
			$autor->editarAutor();

		}elseif($campos['tipoForm'] == 0){
			// si es 0, quiere decir que el autor es nuevo, por lo cual se crea un objeto de creacion
			$autor->insertarAutor();
		}
		
		if($autor->resultado === false){
			// ocurrio un error de mysql, llamar a clase Error
			
		}elseif($autor->resultado === true){
			// salio todo bien, redireccionar a autores.php
			$exitoMensaje = new MensajeHTML($autor->mensajeResultado);
			$exitoMensaje->mensajeExito();
			
			// crear un if para el caso de que el autor no haya ingresado un seudonimo

			$_SESSION['carga_exitosa'] = $exitoMensaje;
			header('Location: ../vistas/autores.php');
		}
	}

?>