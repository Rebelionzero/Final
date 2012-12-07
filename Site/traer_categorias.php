<?php
    
    include_once("../Admin/conexion.php");
    
	
	$categorias = select_categorias($conexion);
    
	function select_categorias($conexion){
		$select = "SELECT id,nombre FROM categorias;";
		$consulta = mysql_query($select, $conexion);
		if(mysql_num_rows($consulta) > 0){
			while($row = mysql_fetch_assoc($consulta)){
				$resultado[]=$row;
			}
		}else{
			$resultado = false;
		}
		return $resultado;
	}
	
	$_SESSION['categorias'] = $categorias;
?>