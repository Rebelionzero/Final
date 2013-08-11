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
	if($requerimientos->respuesta == false){
		$rightEchoObras = '<div class="right_content"><h2>Para poder crear una nueva obra es necesaria la creacion previa de al menos un autor, una categoria y un museo</h2></div>';
	}else{
		// crear nuevo objeto de formulario
		// primero verifico que los campos del formulario esten vacios o no, si no estan vacios significa que hubo algun error en el ingreso de datos
		// esta parte de verificacion suplanta lo que hacia el archivo variables-formulario-obra.php
			
		if($camposSeteados == false){
			$campos_value = array('titulo'=>'','descripcion'=>'','autor'=>'seleccione','anio'=>'seleccione','categoria'=>'seleccione','museo'=>'seleccione','imagen'=>'','mail'=>'','seudonimo'=>'');
		}else{
			// llenar de datos el mismo array, obtenerlos del controlador de obras
			// pero para poder hacer esto, primero es necesario arreglar el javascript y los seudonimos y desactivar ajax
			$campos_value = $camposSeteados;
			
		}

		var_dump($campos_value);
		$formularioObras = new formularioObras('../controladores/controlador-obras.php','obras-form','obras',$requerimientos,$campos_value);
		$formularioObras->crearForm();

		$rightEchoObras ="<div class='tabs'><a href='#' class='tab-cargar focused-tab'>Cargar Obras</a><a href='#' class='tab-lista'>Lista de Obras</a></div>";
		$rightEchoObras .= "<div class='right_content_place'><div class='cargar block'>".$formularioObras->formulario."</div>";
		$rightEchoObras .= "<div class='lista none'><div class='lista-de-obras'>include_once('../controladores/lista-obras.php')</div></div></div>";
	}

?>
