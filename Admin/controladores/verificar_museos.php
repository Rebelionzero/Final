<?php
	include_once("../autoloader.php");

	$errores = false;
	$camposSeteados = false;
	if(isset($_SESSION['ErroresMuseos'])){
		$errores = $_SESSION['ErroresMuseos'];
		$camposSeteados = $_SESSION['campos'];
		unset($_SESSION['ErroresMuseos']);
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

	$campos_value = array('museo'=>'','direccion'=>'','mail'=>'','imagen'=>'');

	$formularioMuseos = new formularioMuseos('../controladores/controlador-museos.php','museos-form','museos',0,$campos_value,false);
	$formularioMuseos->crearForm();

	$queryMuseos = "SELECT museos.id id, museos.nombre museo, museos.direccion, museos.mail mail, museos.imagen imagen FROM museos ORDER BY museos.id";
	$claseQuery = new Queries($queryMuseos);
	$claseQuery->select();
	$listaMuseos = '';

	if($claseQuery->resultado != false){
		$tabla = new TablaMuseos($claseQuery->resultado);
		$tabla->crearTabla();
		$listaMuseos = $tabla->table;
	}else{		
	// No hay categorias
		$listaMuseos = "<h2 class='ningun-museo'>No hay ningun museo cargado en este momento</h2>";
	}

	$rightEchoMuseos ="<div class='tabs'><a href='#' class='tab-cargar focused-tab'>Cargar Museo</a><a href='#' class='tab-lista'>Lista de Museos</a></div>";
	$rightEchoMuseos .= "<div class='content_right'><div class='cargar block'>".$formularioMuseos->formulario."</div>";
	$rightEchoMuseos .= "<div class='lista none'><div class='lista-de-museos'>".$listaMuseos."</div></div>";

?>