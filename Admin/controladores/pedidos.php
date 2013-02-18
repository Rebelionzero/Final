<?php
	include_once("../autoloader.php");

	if(isset($table)){unset($table);}
	
	if(!isset($_POST["algo"])){
		$table = $_POST["algo"];
	}else{
		$table = $_POST["algo"];
	}
	
	function consultar_bd($table){
		if($table == 'productos'){
			$select = "SELECT productos.id, productos.nombre as producto, productos.precio, productos.descripcion, productos.imagen, productos.src, categorias.nombre as categoria, marcas.nombre as marca FROM productos, categorias, marcas WHERE productos.categoria = categorias.id AND productos.marca = marcas.id;";
		}else{
			$select = "SELECT * FROM ".$table.";";
		}
		
		$query = new Queries($select);
		$query->select();

		if($query->resultado === false){
			$devolver = array(false,$table);
		}else{
			$devolver = $query->resultado;
		}
		return $devolver;
	}

	$funcionConsultar = consultar_bd($table);

	$enviar = json_encode($funcionConsultar);
	echo $enviar;
?>