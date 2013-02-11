<?php
	
	include_once('conexion.php');
	
	$tabla = $_POST['tabla'];
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];
	
	$editar = new Editar();

	if($tabla == 'categorias' || $tabla == 'marcas'){
		// codigo aca
		if(strlen($nombre) > 0 && strlen($nombre) < 31){
			if(preg_match('/^\pL+$/u', $nombre)){
				$conectar = conectar_bd();
				$update_db = 'UPDATE '.$tabla.' SET nombre="'.$nombre.'" WHERE id='.intval($id);
				$consulta = mysql_query($update_db, $conexion);
				if($consulta){
					$respuesta = 'La edicion se realizo exitosamente';
				}else{
					$respuesta = "Error ".mysql_errno();
				}
			}else{
				$respuesta = 'Error: Caracteres erroneos fueron ingresados';
			}
		}else{
			$respuesta = 'Error: solo puede ingresar 30 caracteres como maximo y un minimo de 1 caracter';
		}
	}else{
		$respuesta = 'Error: El parametro enviado no corresponde a ninguna tabla';
	}
	
	$enviar = json_encode($respuesta);
	echo $enviar;
	
	
?>