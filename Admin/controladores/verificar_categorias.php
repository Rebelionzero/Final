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
		$errMensaje->listaDeMensajesDeError();
	}

	$exito = false;
	if(isset($_SESSION['resultado_carga'])){
		$exito = $_SESSION['resultado_carga'];
		unset($_SESSION['resultado_carga']);
	}

	$borrado = false;
	if(isset($_SESSION['borrado_exitoso'])){
		$borrado = $_SESSION['borrado_exitoso'];
		unset($_SESSION['borrado_exitoso']);
	}

	$campos_value = array('categoria'=>'','descripcion'=>'');

	if($camposSeteados == false || $camposSeteados['tipoForm'] == 1){
		$campos_value = array('categoria'=>'','descripcion'=>'');
	}else{
		$campos_value = $camposSeteados;
	}

	$formularioCategorias = new formularioCategorias('../controladores/controlador-categorias.php','categorias-form','categorias',0,$campos_value,false);
	$formularioCategorias->crearForm();

	$queryCategorias = "SELECT categorias.id id, categorias.nombre categoria, categorias.descripcion FROM categorias ORDER BY categorias.id";
	$claseQuery = new Queries($queryCategorias);
	$claseQuery->select();
	$listaCategorias = '';

	if($claseQuery->resultado != false){
		$tabla = new TablaCategorias($claseQuery->resultado);
		$tabla->crearTabla();
		$listaCategorias = $tabla->table;
	}else{		
	// No hay categorias
		$listaCategorias = "<h2 class='ninguna-categoria'>No hay ninguna categoria cargada en este momento</h2>";
	}

	$rightEchoCategorias ="<div class='tabs'><a href='#' class='tab-cargar focused-tab'>Cargar Categoria</a><a href='#' class='tab-lista'>Lista de Categorias</a></div>";
	$rightEchoCategorias .= "<div class='content_right'><div class='cargar block'>".$formularioCategorias->formulario."</div>";
	$rightEchoCategorias .= "<div class='lista none'><div class='lista-de-categorias'>".$listaCategorias."</div></div>";

?>