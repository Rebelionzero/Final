<?php

	include_once('../autoloader.php');
	session_start();

	$user = $_POST['usr'];
	$pass = $_POST['pass'];

	if(strlen($user) <= 0 || strlen($pass) <= 0){
		// vacio
		$_SESSION['Login'] = false;
		header("Location:../vistas/login.php");
	}else{
		$login = new Login($user,$pass);
		$login->consultaUsuario();
	}

	