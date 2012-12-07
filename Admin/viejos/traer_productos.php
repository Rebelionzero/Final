<?php
$table=$_SESSION['tabla'];
function consultar_bd($usuario,$conexion,$table){
		if($table != 'productos'){
			$select = "SELECT nombre FROM ".$table;
		}else{
			$select = "SELECT p.id AS id_p, p.nombre AS n_p, descripcion, imagen, precio, c.id AS id_c, c.nombre AS categoria, m.id AS id_m, m.nombre AS marca FROM ".$table." AS p, marcas AS m ,categorias AS c WHERE p.marca = m.id AND p.categoria = c.id";
		}
		$consulta = mysql_query($select, $conexion);
		$numf=mysql_num_rows($consulta); 
		
		if($numf == 0){
			return false;
		}else{
			while($resultado = mysql_fetch_assoc($consulta)){
				$array_datos[] = $resultado; // al ir llenando los arrays los valores de la columna nombre se van pisando una y otra vez con los valores de las columnas del mismo nombre en otras tablas
			}
			return $array_datos;
		}
	}
	$consultar= consultar_bd($usuario,$conexion,$table);
?>