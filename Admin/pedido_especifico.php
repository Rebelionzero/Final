<?php
	include_once("conexion.php");
	
	function consultar_bd($conexion){
		$select_categoria = "SELECT id, nombre FROM categorias;";
		$select_marca = "SELECT id, nombre FROM marcas;";
		
		$consulta_categ = mysql_query($select_categoria, $conexion);
		if(mysql_num_rows($consulta_categ) > 0){
			while($row = mysql_fetch_assoc($consulta_categ)){
				$resultado_categorias[]=$row;
			}
		}else{
			$resultado_categorias = false;
		}
		
		$consulta_marca = mysql_query($select_marca, $conexion);
		if(mysql_num_rows($consulta_marca) > 0){
			while($row = mysql_fetch_assoc($consulta_marca)){
				$resultado_marcas[]=$row;
			}
		}else{
			$resultado_marcas = false;
		}
		
		if($resultado_categorias == false || $resultado_marcas == false){
			return 'Para cargar un producto debe antes crear una categoria y una marca';
		}else{
			return $categoriasYmarcas = array($resultado_categorias,$resultado_marcas);
		}
	}
	$consultar= consultar_bd($conexion);
	mysql_close($conexion);
	$enviar = json_encode($consultar);	
	echo $enviar;
?>