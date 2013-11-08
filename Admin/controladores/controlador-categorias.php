<?php
	include_once('../autoloader.php');
	session_start();

	// si esta seteado la session errores la dessetea
	if(isset($_SESSION['errores'])){
		unset($_SESSION['errores']);
	}

	if(isset($_POST['nrcate'])){
		$idCate = $_POST['nrcate'];
	}else{
		$idCate = '';
	}

	$campos = array(
		'nombre' => utf8_decode($_POST['categoria']),
		'descripcion' => utf8_decode($_POST['descripcion']),
		'tipoForm' => $_POST['tipo'],
		'id' => $idCate
	);

	
?>