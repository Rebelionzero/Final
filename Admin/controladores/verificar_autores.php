<?php
	include_once("../autoloader.php");

	$errores = false;
	$camposSeteados = false;
	if(isset($_SESSION['ErroresCategorias'])){
		$errores = $_SESSION['ErroresCategorias'];
		$camposSeteados = $_SESSION['campos'];
		unset($_SESSION['ErroresCategorias']);
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

	$campos_value = array('nombre'=>'','seudonimo'=>'','mail'=>'');

	$formularioAutores = new formularioAutores('../controladores/controlador-autores.php','autores-form','autores',0,$campos_value,false);
	$formularioAutores->crearForm();

	$queryAutores = "SELECT autores.id id, autores.nombre autor, autores.seudonimo seudonimo, autores.mail FROM autores ORDER BY autores.id";
	$claseQuery = new Queries($queryAutores);
	$claseQuery->select();
	$listaAutores = '';

	if($claseQuery->resultado != false){
		$tabla = new TablaAutores($claseQuery->resultado);
		$tabla->crearTabla();
		$listaAutores = $tabla->table;
	}else{		
	// No hay ningun autor cargado
		$listaAutores = "<h2 class='ningun-autor'>No hay ningun autor registrado en este momento</h2>";
	}

	$rightEchoAutores ="<div class='tabs'><a href='#' class='tab-cargar focused-tab'>Registrar Autor</a><a href='#' class='tab-lista'>Lista de Autores</a></div>";
	$rightEchoAutores .= "<div class='content_right'><div class='cargar block'>".$formularioAutores->formulario."</div>";
	$rightEchoAutores .= "<div class='lista none'><div class='lista-de-autores'>".$listaAutores."</div></div>";

?>