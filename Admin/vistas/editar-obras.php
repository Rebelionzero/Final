<?php
	include_once("../autoloader.php");
	// include once no funciona porque el formulario ya fue includio
	// hacer el formulario como clase
	//include_once("formulario-obras.php");
	//var_dump($tabla);

	$form = new FormularioObras('../controladores/controlador-obras.php','editar-obras-form','obras',$requerimientos);	
	$form->crearForm();
	echo($form->formulario);

?>