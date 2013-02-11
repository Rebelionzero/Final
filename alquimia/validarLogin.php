<?php
	
	session_start();
	include_once('conexion.php');
	include_once('traerElementos.php');
	include_once('objetoLogin.php');

	$user = $_POST['usr'];
	$pass = $_POST['pass'];

	if($user != "" && $user != " "){ // mejorar esta validacion
		// ok
		$userOk = true;
	}else{
		// generic error msg
	}

	if($pass != "" && $pass != " "){ // mejorar esta validacion
		// ok
		$passOk = true;
	}else{
		// generic error msg
	}

	if($userOk === true && $passOk === true){
		$login = new objetoLogin($user,$pass);
		$login->comprobarUsuario();
		$login->devolverResultado();
		$_SESSION['estado'] = $login->resultadoConexion;

	}

?>