<?php
	include_once('../autoloader.php');
	session_start();

	// si esta seteado la session errores la dessetea
	if(isset($_SESSION['errores'])){
		unset($_SESSION['errores']);
	}

	if(isset($_POST['nrmus'])){
		$idMuseo = $_POST['nrmus'];
	}else{
		$idMuseo = '';
	}

	$campos = array(
		'museo' => utf8_decode($_POST['museo']),
		'direccion' => utf8_decode($_POST['direccion']),
		'mail' => utf8_decode($_POST['mailMuseo']),
		'imagen' => $_FILES['imagenMuseo'],
		'tipoForm' => $_POST['tipo'],
		'id' => $idMuseo
	);

	$museo = $campos;
	$verificacion = new ComprobarMuseos($campos);
	$verificacion->verificar();

	
	if( count($verificacion->errores) > 0 ){
		$_SESSION['ErroresMuseos'] = $verificacion->errores;
		$_SESSION['campos'] = $museo;
		header('Location: ../vistas/museos.php');
	}else{
		$museo = new Museo($campos);
		if($campos['tipoForm'] == 1){
			// si es 1, quiere decir que el museo es para editarse, por lo cual se crea un objeto de edicion			
			$museo->editarMuseo();

		}elseif($campos['tipoForm'] == 0){
			// si es 0, quiere decir que el museo es nuevo, por lo cual se crea un objeto de creacion
			$museo->insertarMuseo();
		}

		$mensajeParaElUsuario = new MensajeHTML($museo->mensajeResultado);
		$tipoDeMensaje = ( $museo->resultado === false ? $mensajeParaElUsuario->mensajeDeError() : $mensajeParaElUsuario->mensajeExito() );

		$_SESSION['resultado_carga'] = $mensajeParaElUsuario;
		header('Location: ../vistas/museos.php');
		
	}

?>