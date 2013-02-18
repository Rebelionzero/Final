<?php
	include_once("../autoloader.php");
	
	function consultar_bd(){
		$select_categoria = "SELECT id, nombre FROM categorias;";
		$select_marca = "SELECT id, nombre FROM marcas;";
		
		$consulta_categ = new Queries($select_categoria);
		$consulta_categ->select();

		$consulta_marca = new Queries($select_marca);
		$consulta_marca->select();
		
		if($consulta_categ->resultado === false || $consulta_marca->resultado === false){
			return 'Para cargar un producto debe antes crear una categoria y una marca';
		}else{
			return $categoriasYmarcas = array($consulta_categ->resultado,$consulta_marca->resultado);
		}
	}

	$funcionConsultar = consultar_bd();

	$enviar = json_encode($funcionConsultar);
	echo $enviar;
?>