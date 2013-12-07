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
			// Obras
			case "Obra": $tabla = 'obra';
			$query = 'SELECT obras.nombre obra, obras.descripcion descripcion, '.utf8_decode("obras.año").' anio, obras.autor autor, obras.categoria categoria, obras.museo museo, obras.seudonimo seudonimo, obras.mail mail FROM obras WHERE obras.id = '.$id;
			$datosDeLaObra = consultar($query);
		
			$partesObra = array(
				'autores' => array(
					0 => array('id' => 'id'),
					1 => array('nombre' => 'autor'),
					2 => array('value' => 'valor'),
					3 => array('seudonimo' => 'seud')
				),
				'categorias' => array(
					0 => array('id' => 'id'),
					1 => array('nombre' => 'categoria'),
					2 => array('value' => 'valor')
				),
				'museos' => array(
					0 => array('id' => 'id'),
					1 => array('nombre' => 'museo'),
					2 => array('value' => 'valor')
				)
			);

			$req = new RequerimientosObras($partesObra);
			$req->traer_requerimientos();
			
			/* creando los campos para enviar al formulario de edicion */
			$autor = comparar($req->arrayObjetos['autores'],$datosDeLaObra[0]['autor']);
			$categoria = comparar($req->arrayObjetos['categorias'],$datosDeLaObra[0]['categoria']);
			$museo = comparar($req->arrayObjetos['museos'],$datosDeLaObra[0]['museo']);
			$mail = '';
			$seudonimo = '';
			if($datosDeLaObra[0]['mail'] == "1"){$mail = 'museo';}elseif($datosDeLaObra[0]['mail'] == "0"){$mail = 'autor';}
			if($datosDeLaObra[0]['seudonimo'] == "0"){$seudonimo = false;}
			$camposValue = array(
				'titulo'=>$datosDeLaObra[0]['obra'],
				'descripcion'=>$datosDeLaObra[0]['descripcion'],
				'autor'=>$autor['valor'],
				'anio'=>$datosDeLaObra[0]['anio'],
				'categoria'=>$categoria['valor'],
				'museo'=>$museo['valor'],
				'imagen'=>'',
				'mail'=>$mail,
				'seudonimo'=>$seudonimo
			);
			
			$formularioEdit = new FormularioObras('../controladores/controlador-obras.php','editar-obras-form','obras edit-obras',1,$req->arrayObjetos,$camposValue,$id);
			$formularioEdit->cancelBtns();
			$formularioEdit->crearForm();
			echo($formularioEdit->formulario);
			break;

			// Categorias
			case "Categoria": $tabla = 'categoria';
			$query = 'SELECT nombre categoria, descripcion descripcion FROM categorias WHERE id = '.$id;
			$datosDeLaCategoria = consultar($query);
			$camposValue =  array('categoria'=>$datosDeLaCategoria[0]['categoria'],'descripcion'=>$datosDeLaCategoria[0]['descripcion']);
			$formularioEdit = new FormularioCategorias('../controladores/controlador-categorias.php','editar-categorias-form','categorias edit-categorias',1,$camposValue,$id);			
			$formularioEdit->cancelBtns();
			$formularioEdit->crearForm();
			echo($formularioEdit->formulario);
			break;

			// Autores
			case "Autor": $tabla = 'autor';
			$query = 'SELECT nombre autor, seudonimo seudonimo, mail mail FROM autores WHERE id = '.$id;
			$datosDelAutor = consultar($query);
			$camposValue =  array('nombre'=>$datosDelAutor[0]['autor'],'seudonimo'=>$datosDelAutor[0]['seudonimo'],'mail'=>$datosDelAutor[0]['mail']);
			$formularioEdit = new FormularioAutores('../controladores/controlador-autores.php','editar-autores-form','autores edit-autores',1,$camposValue,$id);			
			$formularioEdit->cancelBtns();
			$formularioEdit->crearForm();
			echo($formularioEdit->formulario);
			break;
						
		}

	}

	function consultar($q){
		$objeto = new Queries($q);
		$objeto->select();
		return $objeto->resultado;
	}

	function comparar($array,$datoABuscar){
		foreach ($array as $clave => $valor) {
			foreach ($valor as $nuevoArray => $nuevoValor) {
				if( $nuevoArray == 'id'){
					if($datoABuscar == $nuevoValor){
						return $valor;
					}else{
						continue;
					}
				}else{
					continue;
				}
			}			
		}

	}

?>