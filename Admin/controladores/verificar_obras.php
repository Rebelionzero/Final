<?php

	include_once("../autoloader.php");

	$requerimientos = new TraerObras();
	$requerimientos->traer_requerimientos();

	$errores = false;
	$camposSeteados = false;
	if(isset($_SESSION['ErroresObras'])){
		$errores = $_SESSION['ErroresObras'];
		$camposSeteados = $_SESSION['campos'];
		unset($_SESSION['ErroresObras']);
		unset($_SESSION['campos']);
		$errMensaje = new MensajeHTML($errores);
		$errMensaje->mensajeError();
	}

	$exito = false;
	if(isset($_SESSION['carga_exitosa'])){
		$exito = $_SESSION['carga_exitosa'];
		unset($_SESSION['carga_exitosa']);
	}

	$borrado = false;
	if(isset($_SESSION['borrado_exitoso'])){
		$borrado = $_SESSION['borrado_exitoso'];
		unset($_SESSION['borrado_exitoso']);
	}

?>
