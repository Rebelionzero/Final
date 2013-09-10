<?php

	include_once("../autoloader.php");

	$parametrosObra = array(
		'autores' => array(
			0 => array('nombre' => 'autor'),
			1 => array('value' => 'valor'),
			2 => array('seudonimo' => 'seud')
		),
		'categorias' => array(
			0 => array('nombre' => 'categoria'),
			1 => array('value' => 'valor')
		),
		'museos' => array(
			0 => array('nombre' => 'museo'),
			1 => array('value' => 'valor')
		),
	);
	$requerimientos = new RequerimientosObras($parametrosObra);
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


	/* right-obras.php define que se muestra en el lado derecho de obras: un mensaje de error, o el formulario */
	if($requerimientos->resultadoVacio == true){
		$rightEchoObras = '<div class="right_content"><h2>Para poder crear una nueva obra es necesaria la creacion previa de al menos un autor, una categoria y un museo</h2></div>';
	}else{
		// crear nuevo objeto de formulario
		// primero verifico que los campos del formulario esten vacios o no, si no estan vacios significa que hubo algun error en el ingreso de datos
		// esta parte de verificacion suplanta lo que hacia el archivo variables-formulario-obra.php
			
		if($camposSeteados == false){
			$campos_value = array('titulo'=>'','descripcion'=>'','autor'=>'seleccione','anio'=>'seleccione','categoria'=>'seleccione','museo'=>'seleccione','imagen'=>'','mail'=>'','seudonimo'=>false);
		}else{
			// llenar de datos el mismo array, obtenerlos del controlador de obras
			// pero para poder hacer esto, primero es necesario arreglar el javascript y los seudonimos y desactivar ajax
			$campos_value = $camposSeteados;
		}

		//var_dump($campos_value);
		$formularioObras = new FormularioObras('../controladores/controlador-obras.php','obras-form','obras',false,$requerimientos->arrayObjetos,$campos_value);
		$formularioObras->crearForm();

		$queryObras = "SELECT obras.id id, obras.nombre obra, obras.value valor, autores.nombre autor, obras.descripcion descripcion, ".utf8_decode('obras.año')." anio, obras.seudonimo seudonimo, categorias.nombre categoria, museos.nombre museo, obras.mail mail, obras.imagen alt, obras.src src FROM obras, autores, categorias, museos WHERE obras.autor = autores.id AND obras.categoria = categorias.id AND obras.museo = museos.id ORDER BY obras.id";
		$claseQuery = new Queries($queryObras);
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
		$rightEchoObras .= "<div class='right_content_place'><div class='cargar block'>".$formularioObras->formulario."</div>";
		$rightEchoObras .= "<div class='lista none'><div class='lista-de-obras'>".$listaObras."</div></div></div>";
	}

?>
