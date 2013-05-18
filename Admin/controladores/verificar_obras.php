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


?>
