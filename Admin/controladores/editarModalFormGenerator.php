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
			$query = 'SELECT obras.nombre obra, obras.descripcion descripcion, '.utf8_decode("obras.año").' anio, obras.autor autor, obras.categoria categoria, obras.museo museo, obras.seudonimo seudonimo, obras.mail mail FROM obras WHERE obras.id = '.$id;
			$datosDeLaObra = consultar($query);
		
			$partesObra = array(
				'autores' => array(
					0 => array('id' => 'id'),
					1 => array('value' => 'valor'),
					2 => array('seudonimo' => 'seud')
				),
				'categorias' => array(
					0 => array('id' => 'id'),
					1 => array('value' => 'valor')
				),
				'museos' => array(
					0 => array('id' => 'id'),
					1 => array('value' => 'valor')
				),
			);

			$req = new RequerimientosObras($partesObra);
			$req->traer_requerimientos();
			//var_dump($req->arrayObjetos);
			var_dump($datosDeLaObra[0]);

			/* creando los campos para enviar al formulario de edicion */
			$autor = comparar(,$datosDeLaObra[0]['autor']);
			$categoria = comparar(,$datosDeLaObra[0]['categoria']);
			$museo = comparar(,$datosDeLaObra[0]['museo']);

			$camposValue = array(
				'titulo'=>$datosDeLaObra[0]['obra'],
				'descripcion'=>$datosDeLaObra[0]['descripcion'],
				'autor'=>$autor,
				'anio'=>$datosDeLaObra[0]['anio'],
				'categoria'=>$categoria,
				'museo'=>$museo,
				'imagen'=>'',
				'mail'=>$mail,
				'seudonimo'=>false
				);

			break;
		}

	}

	function consultar($q){
		$objeto = new Queries($q);
		$objeto->select();
		return $objeto->resultado;
	}

	function comparar($array,$datoABuscar){

	}

?>