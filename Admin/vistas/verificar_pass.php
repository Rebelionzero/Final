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
		$errMensaje->listaDeMensajesDeError();
	}

	$exito = false;
	if(isset($_SESSION['resultado_carga'])){
		$exito = $_SESSION['resultado_carga'];
		unset($_SESSION['resultado_carga']);
	}

	
	$rightEchoPass ="<div class='tabs'><a href='#' class='tab-cargar focused-tab'>Cargar Museo</a><a href='#' class='tab-lista'>Lista de Museos</a></div>";
	$rightEchoPass .= "<div class='content_right'><div class='cargar block'>".$formularioMuseos->formulario."</div>";
	$rightEchoPass .= "<div class='lista none'><div class='lista-de-museos'>".$listaMuseos."</div></div>";
	
?>