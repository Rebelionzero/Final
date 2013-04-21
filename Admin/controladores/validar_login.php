<?php

	include_once('../autoloader.php');
	session_start();

	if(isset($_SESSION['Login'])){
		unset($_SESSION['Login']);
	}

	$user = $_POST['usr'];
	$pass = $_POST['pass'];

	if(strlen($user) <= 0 || strlen($pass) <= 0){
		// vacio
		$_SESSION['Login']['autenticacion'] = false;
		$_SESSION['Login']['respuesta'] = "Error: uno o ambos campos estan vacios.";
		header("Location:../vistas/login.php");
	}else{
		$login = new Login($user,$pass);
		$login->consultaUsuario();

		if ($login->respuesta === false) {
			$_SESSION['Login']['autenticacion'] = false;
			$_SESSION['Login']['respuesta'] = "Error: Usuario o contraseña erroneos";
			header("Location:../vistas/login.php");
		}elseif($login->respuesta === true) {
			$_SESSION['Login']['autenticacion'] = true;
			header('Location: ../vistas/admin.php');
		}
	}

	