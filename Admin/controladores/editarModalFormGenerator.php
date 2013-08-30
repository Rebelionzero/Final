<?php
	include_once('../autoloader.php');

	$tabla = $_GET['dato1']; // dato que dice el nombre de la tabla donde se va a dirigir la consulta sql
	$id = $_GET['dato2']; // el id del elemento de la tabla que se va a pedir para editar
	$error_resp = 'Error al ejecutar el editor';

	if(!(isset($tabla)) || $tabla == '' || !(isset($id)) || $id == '' || is_nan($id)){
		echo $error_resp;
	}else{

		$query = '';
		switch($tabla){
			// a medida que voy agregando los editores de las distintas partes tengo que ir ampliando esta funcion
			case "Obra": $tabla = 'obra';
			$query = 'SELECT obras.nombre obra, obras.descripcion descripcion, '.utf8_decode("obras.año").' anio, obras.categoria categoria, obras.autor autor, obras.museo museo, obras.seudonimo seudonimo, obras.mail mail FROM obras WHERE obras.id = '.$id;
			$datosDeLaObra = consultar($query);
			
			/*
			$req = new RequerimientosObras();
			$categorias = consultar('SELECT id, value as categoria FROM categorias');
			$autores = consultar('SELECT id, value as autor, seudonimo FROM autores');
			$museos = consultar('SELECT id, value as museo FROM museos');
			*/
			break;
		}

	}

	function consultar($q){
		$objeto = new Queries($q);
		$objeto->select();
		return $objeto->resultado;
	}

?>