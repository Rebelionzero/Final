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

	$campos_value = array('categoria'=>'','descripcion'=>'');

	$formularioCategorias = new formularioCategorias('../controladores/controlador-categorias.php','categorias-form','categorias',0,$campos_value);
	$formularioCategorias->crearForm();

	$queryCategorias = "SELECT categorias.id id, categorias.nombre categoria, categorias.descripcion FROM categorias ORDER BY obras.id";
	$claseQuery = new Queries($queryCategorias);
	
	/* seguir por aca!!!
	$claseQuery->select();
	$listaObras = '';

	if($claseQuery->resultado != false){
		$tabla = new TablaObras($claseQuery->resultado);
		$tabla->crearTabla();
		$listaObras = $tabla->table;
	}else{		
	// No hay ninguna obra cargada
		$listaObras = "<h2 class='ninguna-obra'>No hay ninguna obra cargada en este momento</h2>";
	}
	$rightEchoObras ="<div class='tabs'><a href='#' class='tab-cargar focused-tab'>Cargar Obras</a><a href='#' class='tab-lista'>Lista de Obras</a></div>";
	$rightEchoObras .= "<div class='content_right'><div class='cargar block'>".$formularioObras->formulario."</div>";
	$rightEchoObras .= "<div class='lista none'><div class='lista-de-obras'>".$listaObras."</div></div></div>";*/

?>