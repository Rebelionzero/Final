<?php
	include_once("conexion.php");
	session_start();
	if(isset($table)){unset($table);}
	
	if(!isset($_POST["algo"])){
		$table = $_POST["algo"];
	}else{
		$table = $_POST["algo"];
	}
	
	function consultar_bd($conexion,$table){
		if($table == 'productos'){
			$select = "SELECT productos.id, productos.nombre as producto, productos.precio, productos.descripcion, productos.imagen, productos.src, categorias.nombre as categoria, marcas.nombre as marca FROM productos, categorias, marcas WHERE productos.categoria = categorias.id AND productos.marca = marcas.id;";
		}else{
			$select = "SELECT * FROM ".$table.";";
		}
		
		$consulta = mysql_query($select, $conexion);
		if(mysql_num_rows($consulta) > 0){
			while($row = mysql_fetch_assoc($consulta)){
				$resultado[]=$row;
			}
		}else{
			$resultado=array(false,$table);
		}
		return $resultado;
	}		
	$consultar= consultar_bd($conexion,$table);
	mysql_close($conexion);
	$enviar = json_encode($consultar);	
	echo $enviar;
?>