<?php

	include_once('../autoloader.php');
	session_start();

	$query = '';

	if( isset($_POST['table']) ){
		$table = $_POST['table'];

		$query = "DELETE FROM ".$table." WHERE ";

		if( isset($_POST['obra']) ){
			$value = $_POST['obra'];
			$query .= "value = '".$value."'";

			// agregar funcion para borrar la iamgen de la carpeta imagenes
		}

		//if( isset($_POST['']) ){}
		//if( isset($_POST['']) ){}
		//if( isset($_POST['']) ){}
	}

	$borrar = new Queries($query);
	$borrar->delete();

?>