<?php
	include_once("../autoloader.php");
	//include_once("formulario-obras.php");
	//var_dump($tabla);

	$form = new FormularioObras('../controladores/controlador-obras.php','editar-obras-form','obras',$requerimientos);	
	$form->crearForm();
	echo($form->formulario);

?>